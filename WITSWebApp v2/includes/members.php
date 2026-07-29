<?php
    require('conn.inc.php');

    $membersList = "SELECT * FROM registeredUsers";
    $stmt = $pdo->query($membersList);
    
echo"<div class=\"memberList\" >";
    
    echo"<div class=\"newEvent\">";
        echo"<a href=\"admin/createMember.php\">";
            echo"<button class=\"view\">Create New Member</button>";
        echo"</a>";

        echo"<button class=\"view\">Download <i class=\"fas fa-file-download\"></i></button>";
    echo"</div>";
    $memberCount = $stmt->rowCount(); 
    echo"<p class=\"numberStmt\"> There are 
        <span class=\"numberCount\">$memberCount</span> registered members</p>";
    
    echo"<table>";
        echo"<thead>";
            echo"<tr>";
                echo"<td class=\"idNum\">User ID</td>";
                echo"<td>Email</td>";
                echo"<td class=\"btn\">View</td>";
                echo"<td class=\"btn\">Edit</td>";
                echo"<td class=\"btn\">Delete</td>";
            echo"</tr>";
        echo"</thead>";
        echo"<tbody>";

        while($row =$stmt->fetchObject()){
            $userID = $row->userID;
            echo"<tr>";
                echo"<td class=\"idNum\">$userID</td>";
                echo"<td>$row->email</td>";
                echo"<td class=\"btn\">";
                    echo"<a href=\"admin/viewSingleMember.php?userID=".$userID."\">";    
                        echo"<button class=\"view\"><i class=\"far fa-plus-square\"></i></button>";
                    echo"</a>";
                echo"</td>";
                echo"<td>";
                    echo"<a href=\"admin/editSingleMember.php?userID=".$userID."\">";    
                        echo"<button class=\"view\"><i class=\"far fa-edit\"></i></button>";
                    echo"</a>";
                echo"</td>";
                echo"<td>";
                    echo"<a href=\"admin/deleteSingleMember.php?userID=".$userID."\">";    
                        echo"<button class=\"view\"><i class=\"far fa-trash-alt\"></i></button>";
                    echo"</a>";
                echo"</td>";
            echo"</tr>";
        }
        echo"</tbody>";
    echo"</table>";
echo"</div>";

?>
