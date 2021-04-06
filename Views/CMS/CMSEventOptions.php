<?php

require_once 'djs-modal.php';

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
                                    "</td>
                                    <td>
                                    date : <input type ='date' class ='date'  value = '$row->date' min='2020-07-26' max='2020-17-29'>
                                    time : <input type ='time' class ='start'  value = '$row->start'>
                                    <input type ='time' class ='end'  value = '$row->end'><br>
                                    price : €<input type='number' class = 'price' value = '$row->price' min='0.00' max='1000.00' step='0.01' />
                                    seats : <input type ='number' class ='seats'  value = '$row->seats' min='0' max='10000'><br>";
                                    
                                    if($row instanceof JazzTicket){
                                        echo "  type : <input class ='type'  value = 'Jazz' size = '7' disabled>
                                                artist: <input class ='artist'  value = '$row->artist' disabled>";
                                    }
                                    elseif($row instanceof DanceTicket){
                                        echo "  type : <input class ='type'  value = 'Dance' size = '7' disabled><br>
                                                djs:<select>";
                                        foreach($row->djs as $dj){
                                            echo "<option value=$dj>$dj</option>";
                                        }
                                        echo "  </select>   <button type='button' class='djEdit' data-toggle='modal' data-target='#djs-modal' disabled>change</button><br>
                                                session:<input class ='session'  value = '$row->session' disabled>";
                                    }
                                        
                        
                                    echo "</td>
                                    <td>
                                        <button type='button' class='save' name='savebtn' style='height:30px; width:100px'>save</button><br>
                                        <button type='button' class='reset' name='resetbtn' style='height:30px; width:100px'>reset</button><br>
                                        <button type='button' class='delete' name='deletebtn' style='height:30px; width:100px'>delete</button><br>
                                    </td>
                                </tr>";
                        }
                    echo "</table>
                </form>";
        }

}