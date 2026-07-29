<?php
    require('../includes/sessions.inc.php');
    require('../includes/conn.inc.php');

    $regLogin = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $regPassword = $_POST['userpassword'];
    $regPasswordConfirm = $_POST['passwordConfirm'];

    //invalid email
    if(!$regLogin){
        $_SESSION['regError'] = 1;
        $_SESSION["successReg"] = 0;
        exit;  
    }

    //password match
    if($regPassword !=$regPasswordConfirm || $regPassword==""){
        //doesn't match
        $_SESSION['regError'] = 2;
        $_SESSION["successReg"] = 0;
        $referer = "register.php";
        header("Location: ../".$referer); 
        exit;
    }

    else{
        //matching email - check if exists already.
        $sql="SELECT*FROM registeredUsers WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email',$regLogin, PDO::PARAM_STR);
        $stmt->execute();
        $numUsers = $stmt->rowCount();
        if($numUsers==1){
            $_SESSION['regError'] = 3;
            $_SESSION["successReg"] = 0;
            $referer = "register.php";
            header("Location: ../".$referer); 
            exit;
        }
        else{
            //store into the database
            $sql="INSERT INTO registeredUsers(email,userpassword)
            VALUES (:email, :userpassword)";
            $stmt = $pdo->prepare($sql);
            $hashedPW = password_hash($regPassword, PASSWORD_BCRYPT);
            $stmt->bindParam(":email", $regLogin, PDO::PARAM_STR);
            $stmt->bindParam(":userpassword", $hashedPW, PDO::PARAM_STR);
            $stmt->execute();
            if(isset($_SESSION['regError'])){
                unset($_SESSION['regError']);
            }
            $_SESSION['successReg'] = 1;
            $referer = "register.php"; 
            header("Location: ../".$referer);
            exit;
        }
    }
    
    header("Location: ../".$referer);
    exit;


?>