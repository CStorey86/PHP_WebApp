<?php
echo"<h2>Past Events</h2>";

                    $today = date("Y-m-d");
                    $myEvents = "SELECT * FROM ticketSales 
                                 LEFT JOIN events
                                 ON ticketSales.eventID = events.eventID
                                 WHERE start < '$today' AND ticketSales.userID = '$user'";
                    $stmt = $pdo->query($myEvents);
                    
                    $eventCount = $stmt->rowCount();  

                    echo"<p class=\"numberStmt\"> You have <span class=\"numberCount\">$eventCount</span> past event(s).</p>";
        

                        
                            echo"<table>";
                                echo"<thead>";
                                    echo"<tr>";
                                        echo"<td>Sale ID</td>";
                                        echo"<td>Event Title</td>";
                                        echo"<td>Start Date</td>";
                                        echo"<td>Time</td>";
                                        echo"<td>QTY</td>";
                                    echo"</tr>";
                                echo"</thead>";
                                echo"<tbody";
                                    while($row = $stmt->fetchObject()){
                                        $eventID = $row->eventID;

                                        $timestampDate = strtotime($row->start);
                                        $endtimestampDate = strtotime($row->end);
                                        $eventDate = date("D d M Y", $timestampDate);
                                        $startTime = date("h:i A", $timestampDate);
                                        $endTime = date("h:i A", $endtimestampDate);  
                                    
                                        echo"<tr>";
                                            echo"<td>$row->saleID</td>";
                                            echo"<td>";
                                                echo"<a href=\"viewSingleEvent.php?eventID=".$eventID."\">";
                                                    echo"<p>$row->eventTitle</p>";
                                                echo"</a>";
                                            echo"</td>";
                                            echo"<td>$eventDate</td>";
                                            echo"<td>$startTime - $endTime </td>";
                                            echo"<td>$row->qty</td>";
                                        echo"</tr>";
                                    }
                                echo"</tbody>";
                            echo"</table>";   


?>