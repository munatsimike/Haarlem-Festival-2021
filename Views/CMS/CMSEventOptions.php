<?php

class CMSEventOptions{


        public static function displayTickets(array $tickets) : void
        {
            echo"<form class= 'ticketForm' action ='' method = 'POST'>
                    <table class ='ticketsTable'>";
                        foreach ($tickets as $row) {
                            echo "<tr class='ticket'>
                                    <td class='ticketImage' width = '6%'></td>
                                    <input type ='hidden' class ='id'  value = '$row->ID'>
                                    <td width='14%' class = 'title'>
                                    " . $row->getTitle() . " <br>".
                                        date('D d M Y', strtotime($row->date)).' | '."<i class='bi-alarm' style='color:#cc6011'></i>"." ".$row->start.' - '.$row->end."<br>".
                                        ' '.$row->venue->name.
                                    "</td>
                                    <td width= '2%' class='price'>€ $row->price</td>
                                </tr>";
                        }
                    echo"</table>
                </form>";
        }

}