<?php
    require('../includes/conn.inc.php');
    require('../includes/sessions.inc.php');
    
    //Get values from form
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmNewPassword'];
    $user = $_SESSION['user'];

    //Check if new password and confirm match are same.
        if($newPassword != $confirmPassword || $newPassword==""){
            //doesn't match: show error message
            
            $referer = "members_area/myDetails.php?errorMsg=\"1\"";
            header("Location: ../".$referer); 
            exit;
        }
        else{
            //does match: update database.
            $updatePassword = "UPDATE registeredUsers SET userpassword = :newPassword WHERE userID = $user";
            $stmt = $pdo->prepare($updatePassword);
            $hashedPW = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt->bindParam(":newPassword", $hashedPW, PDO::PARAM_STR);
            $stmt->execute();        
            
            $referer = "members_area/myDetails.php?errorMsg=\"2\"";
            header("Location: ../".$referer);
            exit;            
        }

?>
