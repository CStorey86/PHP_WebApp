<?php

    require('../includes/conn.inc.php');
    require('../includes/sessions.inc.php');

    //Get values from form
    $firstname = $_POST['firstname'];
    $surname= $_POST['surname'];
    $email= $_POST['email'];
    $user = $_GET['userID'];

    //update table
    $updatePassword = " UPDATE registeredUsers 
                        SET firstname = :firstname, 
                            surname = :surname, 
                            email = :email 
                        WHERE userID = $user";
    $stmt = $pdo->prepare($updatePassword);
    $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();

    $referer = "members_area/admin/viewSingleMember.php?eventID=$user\"";
    $_SESSION['updated']=1;
    header("Location: ../".$referer);
    exit; 


?>