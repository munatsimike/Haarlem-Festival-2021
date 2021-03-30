
<?php
require_once '../myAutoLoader.php';
if (Cart::getCartTotal() !== null && $_SESSION['customer'] !== null) {
    $cartTotal = Cart::getCartTotal(); // total before tax;
    $customer = $_SESSION['customer'];
  }else {
    header("location: ../../index.php");
  }
 
  //save transaction
  $transaction = new TransactionController();
  $transactionId = $transaction->storeTransaction(new Transaction(Cart::getCartItems()));
  
  // display pdf invoice
require_once('../../Service/fpdf/fpdf.php');

  //create fpdf object with parameters
  $pdf = new fpdf('p','mm','A4');
  //add page
  $pdf->addPage();
  //set font to bold , arial ,14pt
  $pdf->setFont('Arial','B',16);
  // add cell(width,height,text,border,endline,align)
  $pdf->Cell(130,5,'Haarlem Festival',0,0);
  $pdf->Cell(59,5,'Receipt',0,1); // end of line

  //set font to regular , arial ,12pt
  $pdf->setFont('Arial','',11);
  $pdf->Cell(130,5,'45 Parklaan Street, 2011KR',0,0);
  $pdf->Cell(59,5,'',0,1);

  $pdf->Cell(130,5,'Haarlem',0,0);
  $pdf->Cell(25,5,'Date:',0,0);
  $pdf->Cell(34,5, date("d-m-Y"),0,1);

  $pdf->Cell(130,5,'Netherlands',0,0);
  $pdf->Cell(25,5,'Receipt #',0,0);
  $pdf->Cell(34,5,$transactionId,0,1);

  $pdf->Cell(130,5,'Phone [+31 774 163 923]',0,0);
  $pdf->Cell(25,5,'',0,0);
  $pdf->Cell(34,5,'',0,1);
  $pdf->Cell(130,5,'    Fax [+31 774 163 923]',0,0);

  // make a dummy empty cells
  $pdf->Cell(189,10,'',0,1);
  // billing address
  $pdf->setFont('Arial','B',12);

  $pdf->Cell(100,5,'Bill To',0,1);
  $pdf->setFont('Arial','',11);

  // make a dummy cells
  $pdf->Cell(10, 5,'', 0, 0);
  $pdf->Cell(90, 5,'Name: '.ucfirst(strtolower($customer->firstName)).' '.ucfirst(strtolower($customer->lastName)), 0 ,1);

  $pdf->Cell(10,5,'',0 ,0);
  $pdf->Cell(90,5,'Email: '.$customer->email, 0, 1);

  $pdf->Cell(10,5,'',0,0);
  $pdf->Cell(90,5,'Phone: ',0,1);

  // make a dummy cell
  $pdf->Cell(189,10,'',0,1);

  // invoice content
  //set set
  $pdf->setFont('Arial','',12);

  // column headers
  $pdf->setFont('Arial','B',12);
  $pdf->Cell(10,5,'Qty',1,0);
  $pdf->Cell(134,5,'Description',1,0);
  $pdf->Cell(20,5,'Price',1,0);
  $pdf->Cell(30,5,'Total (Euro)',1,1,'C');

  $pdf->setFont('Arial','',11);
  // display items
  if (Cart::getCartItems() !== []) {
    foreach (Cart::getCartItems() as $row) {
      $pdf->Cell(10, 5, $row->quantity, 1, 0, 'C');
      $pdf->Cell(134, 5, $row->title, 1, 0);
      $pdf->Cell(20, 5, number_format($row->unitPrice, 2), 1, 0, 'C');
      $pdf->Cell(30, 5, number_format(20, 2), 1, 1, 'R');
    }
  }
  // add qrcode to the invoice
    $pdf->image('http://localhost/Service/QrGenerator/qrcodegen.php?paymentId='.md5($transactionId), 138, 34, 30, 30, "png");

  // summary
  $pdf->Cell(144,5,'',0,0);
  $pdf->Cell(20,5,'Subtotal',0,0);
  $pdf->Cell(30,5,number_format($cartTotal, 2),1,1, 'R');
  $pdf->Cell(144,5,'',0,0);
  $pdf->Cell(20,5,'Tax 15%', 0,0);
  $pdf->Cell(30,5,number_format($_SESSION['tax'],2),1,1, 'R');

  // set set
  $pdf->setFont('Arial','B',12);

  $pdf->Cell(144,5,'',0,0);
  $pdf->Cell(20,5,'Total',0,0);
  $pdf->Cell(30,5,number_format($_SESSION['total'], 2),1,1, 'R');

  $pdf->Cell(189,15,'',0,1);
  $pdf->Cell(130,5,'NB:',0,1);
  $pdf->Cell(130,5,'Visit www.haarlemfestival.com/tickets to print your ticket(s)',0,1);

  // email receipt to the customer
  $sender = new ReceiptSender($customer->email, $customer->firstName, $pdf->Output("", "S"));
  $sender->sendReceipt();

  // display receipt to the browser
  $pdf->Output();
 
  // destroy all sessions
  session_unset();

 ?>
 


 