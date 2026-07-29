<?php
    require('../includes/conn.inc.php');
    
    
    //get values to be inputted
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $statusSelection = $_POST['status'];
        // find status
            $statusSQL = "SELECT statusID FROM memberStatus WHERE status=:statuses";
            $stmt = $pdo->prepare($statusSQL);
            $stmt->bindParam(':statuses', $statusSelection, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetchObject();

        $statusID = $row->statusID;
        $password = $_POST['userpassword'];
        $passwordConfirm = $_POST['passwordConfirm'];

    //invalid email
        if(!$email){
            $_SESSION['createError'] = 1;
            $_SESSION["successCreate"] = 0;
            $referer = "members_area/admin/createMember.php?".$_SESSION['createError'];
            header("Location: ../".$referer); 
            exit;  
        }
    //check password matches
        if($password != $passwordConfirm || $password ==""){
            //doesn't match
            $_SESSION['createError'] = 2;
            $_SESSION["successCreate"] = 0;
            $referer = "members_area/admin/createMember.php?".$_SESSION['createError'];
            header("Location: ../".$referer); 
        exit;
    }
    //check if user exists
        //matching email - check if exists already.
            $check="SELECT*FROM registeredUsers WHERE email = :email";
            $stmt = $pdo->prepare($check);
            $stmt->bindParam(':email',$email, PDO::PARAM_STR);
            $stmt->execute();
            $numUsers = $stmt->rowCount();
            if($numUsers==1){
                $_SESSION['regError'] = 3;
                $_SESSION["successReg"] = 0;
                $referer = "members_area/admin/createMember.php?".$_SESSION['createError'];
                header("Location: ../".$referer); 
                exit;
            }
            else{
                //store into the database

                $newMember="INSERT INTO registeredUsers (email,userpassword, statusID, firstname, surname)
                            VALUES(:emails, :passwords, :statusID, :firstname, :surname )";
                $stmt = $pdo->prepare($newMember);
                $hashedPW = password_hash($password, PASSWORD_BCRYPT);
                $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
                $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
                $stmt->bindParam(":emails", $email, PDO::PARAM_STR);
                $stmt->bindParam(":statusID", $statusID, PDO::PARAM_INT);
                $stmt->bindParam(":passwords", $hashedPW, PDO::PARAM_STR);
                $stmt->execute();

                $_SESSION['successCreate'] = 1;
            }

    if($_SESSION["successCreate"] == 1){
 
        $referer = "members_area/admin.php";
        header("Location: ../".$referer); 
    }

?>