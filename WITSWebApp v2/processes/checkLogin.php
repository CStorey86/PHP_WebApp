<?php
       require('../includes/sessions.inc.php');
       require('../includes/conn.inc.php');
       
       $userLogin = filter_var($_POST['loginemail'], FILTER_VALIDATE_EMAIL);
        
        if($userLogin){
            //email good      
            $sql= "SELECT * FROM registeredUsers WHERE email = :userLogin"; 
            $stmt = $pdo->prepare($sql); 
            $stmt->bindParam(':userLogin', $userLogin, PDO::PARAM_STR); 
            $stmt->execute();
            $numUsers = $stmt->rowCount();

                if($numUsers == 0){  
                        // email not in database error  
                        $_SESSION['loginError'] = 1;  
                        $referer = "login.php";
                        header("Location: ../".$referer); 
                }
                else{       
                // check password
                    $row =$stmt->fetchObject(); 
                    $dbPasswordHash = $row->userpassword;
                
                    if(password_verify($_POST['loginpassword'], $dbPasswordHash)) {   
                        unset($_SESSION['loginError']);   
                        $_SESSION['login'] = 1;
                        $_SESSION['user']= $row->userID;
                        $referer = "members_area/loggedin.php";                       
                        header("Location: ../".$referer); 
                    }
                
                    else{   
                        // database does not match error   
                        $_SESSION['loginError'] = 1;  
                        $referer = "login.php";
                        header("Location: ../".$referer); 
                    }  
            }
        }
        else {  
            // not valid email error  
            $_SESSION['loginError'] = 1;  
            $referer = "login.php";
            header("Location: ../".$referer); 
        } 


        

?>