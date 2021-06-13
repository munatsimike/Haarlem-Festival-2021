<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Service/fpdf/fpdf.php';

  class PdfInvoiceHandler extends PdfHandler
  {

    private array $orderItems;
    private int $orderId;
    private Customer $customer;

    function __construct(array $orderItems, int $orderId, Customer $customer)
    {
      $this->orderItems = $orderItems;
      $this->orderId = $orderId;
      $this->customer =  $customer;
    }

      
    public function createPdfInvoice() : fpdf
    {
       try {
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
          $pdf->Cell(34,5,$this->orderId,0,1);

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
          $pdf->Cell(90, 5,'Name: '.(string)$this->customer, 0 ,1);

          $pdf->Cell(10,5,'',0 ,0);
          $pdf->Cell(90,5,'Email: '.$this->customer->email, 0, 1);

          $pdf->Cell(10,5,'',0,0);
          $pdf->Cell(90,5,'',0,1);

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
            foreach ($this->orderItems as $row) {
              $pdf->Cell(10, 5, $row['quantity'], 1, 0, 'C');
              $pdf->Cell(134, 5, $row['description'], 1, 0);
              $pdf->Cell(20, 5, number_format($row['unitPrice'], 2), 1, 0, 'C');
              $pdf->Cell(30, 5, number_format(90, 2), 1, 1, 'R');
          }
          // add qrcode to the invoice
            $pdf->image('http://localhost/Service/QrGenerator/qrcodegen.php?paymentId='.md5($this->orderId), 138, 34, 30, 30, "png");

          // summary
          $pdf->Cell(144,5,'',0,0);
          $pdf->Cell(20,5,'Subtotal',0,0);
          $pdf->Cell(30,5,number_format($_SESSION['subtotal'], 2),1,1, 'R');
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

          return $pdf;

      } catch (Exception $e) {
          
        echo $e->getMessage(); 
      }
    }
}
  
 ?>
 


 