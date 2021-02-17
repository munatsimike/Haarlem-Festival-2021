<?php
require 'cart.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>home</title>
<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<h1>HAARLEM FESTIVAL JAZZ PROGRAM </h1>
            <ul>
                <li><a href="?day=1" name="thursady">Thursday</a></li>
                <li><a href="?day=2" name="friday">Friday</a></li>
                <li><a href="?day=3" name="saturday">Saturday</a></li>
                <li><a href="?day=4" name="sunday">Sunday</a></li>
            </ul>

						<form>
								<p>
								<label for="">Sort by</label>
						    <input type="radio"name="sort" checked>
						    <label for="date"> Date </label>
						    <input type="radio"name="sort">
						    <label for="artist">Artist</label>
							</p>
						</form>

						<table>

            <?php
			if(isset($_GET['day'])){
				$date="";
        $day=$_GET['day'];
        if ($day == '1'){
					$date = "2020-07-26" ;
        }
        elseif ($day == '2'){
					$date = "2020-07-27" ;

        }
        elseif ($day == '3'){
					$date = "2020-07-28" ;

        }
        else{
					$date = "2020-07-26" ;
        }
				Get_Ticketsby_Day($date);

			}else{

				DisplayTickets();
			}
				?>

					</table>

</body>
</html>
