<?php
    require('conn.inc.php');

    $eventsList = "SELECT * FROM events";
    $stmt = $pdo->query($eventsList);
    
echo"<div class=\"memberList\" >";
    
    echo"<div class=\"newEvent\">";
        echo"<a href=\"admin/createEvent.php\"><button class=\"view\">Create New Event</button></a>";
        echo"<button class=\"view\" onclick=\"showdownloadBox()\" >Download 
                        <i class=\"fas fa-file-download\"></i>
             </button>";
    echo"</div>";

    $eventCount = $stmt->rowCount(); 
    echo"<p class=\"numberStmt\"> There are 
        <span class=\"numberCount\">$eventCount</span> events</p>";
    
    echo"<table>";
        echo"<thead>";
            echo"<tr>";
                echo"<td class=\"idNum\">Event ID</td>";
                echo"<td>Event Title</td>";
                echo"<td class=\"btn\">View</td>";
                echo"<td class=\"btn\">Edit</td>";
                echo"<td class=\"btn\">Delete</td>";
            echo"</tr>";
        echo"</thead>";
        echo"<tbody>";

        while($row =$stmt->fetchObject()){
            $eventID = $row->eventID;
            echo"<tr>";
                echo"<td class=\"idNum\">$eventID</td>";
                echo"<td>$row->eventTitle</td>";
                
                echo"<td class=\"btn\">";
                    echo"<a href=\"admin/viewSingleEvent.php?eventID=".$eventID."\">";    
                        echo"<button class=\"view\"><i class=\"far fa-plus-square\"></i></button>";
                    echo"</a>";
                echo"</td>";

                echo"<td class=\"btn\">";
                echo"<a href=\"admin/editSingleEvent.php?eventID=".$eventID."\">";    
                    echo"<button class=\"view\"><i class=\"far fa-edit\"></i></button>";
                echo"</a>";
                echo"</td>";

                echo"<td>";
                    echo"<a href=\"admin/deleteSingleEvent.php?eventID=".$eventID."\">";    
                        echo"<button class=\"view\"><i class=\"far fa-trash-alt\"></i></button>";
                    echo"</a>";
                echo"</td>";
            echo"</tr>";
        }
        echo"</tbody>";
    echo"</table>";





echo"</div>";




?>
