<?php
    $contacts = "SELECT * FROM contactDetails";
    $stmt = $pdo->query($contacts); 

    //Contact List Buttons
    echo"<div class=\"contactList\">"; 

        while ($row =$stmt->fetchObject()){    
            if($row->contactID==4){                   
                echo"<div class=\"contactItem\" onclick=\"showEmailForm()\">";
                    echo"<a>";
                        echo"<i class=\"".$row->icon."\"></i>";
                            echo"<p>".$row->name."</p>";
                    echo"</a>";
                echo"</div>";
            }
            else{
                echo"<div class=\"contactItem\">";
                    echo"<a href=\"".$row->urlLink."target=\"_blank\">";
                        echo"<i class=\"".$row->icon."\"></i>";
                            echo"<p>".$row->name."</p>";
                    echo"</a>";
                echo"</div>";
            }
        }
    echo"</div>";
    
    //Overlay for mobile view
    echo"<div id=\"emailOverlay\">";
        echo"<div class=\"contactForm\">";
            echo"<div class=\"close\" onclick=\"hideEmailForm()\">";
            echo"<i class=\"fas fa-window-close fa-2x\"></i>";
        echo"</div>";

        echo"<h1>Email Us</h1>";
        echo"<hr>";
        echo"<form action=\"processes/sendEmail\" method=\"post\ autocomplete=\"off\" id=\"registrationForm\">";
        

        if($_SESSION['login'] != 1){
            //if not logged in, leave blank
            echo"<label for=\"email\">Your Email</label>";
            echo"<input type=\"email\" name=\"senderEmail\" placeholder=\"Your Email Address\" id=\"senderEmail\" required>";
         
        }
        else{
            //if logged in, autofill email address
            $user = $_SESSION['user'];
            $sql = "SELECT email FROM registeredUsers WHERE userID = $user";
            $stmt = $pdo->query($sql);
            $row =$stmt->fetchObject();
            $_POST['senderEmail'] =$row->email;
            
            echo"<label for=\"senderEmail\">".$row->email."</label>";
            echo"<br><br>";
        }
            echo"<label for=\"subject\">Subject</label>";
            echo"<input type=\"text\" name=\"subject\" placeholder=\"Subject\" id=\"subject\" required>";
        
            echo"<label for=\"message\">Message</label>";
            echo"<textarea name=\"message\" placeholder=\"Type your message here...\" id=\"message\" required></textarea>";
    
            echo"<div class=\"g-reCAPTCHA\" data-sitekey=\"6Ld83LoZAAAAABjuEoVWkk-_XOepjTJ7eJQhkpXq\"></div>";
            
            echo"<input type=\"submit\" value=\"Send\">";         
        
        echo"</form>";
    echo"</div></div>";

    //form box for web.
    echo"<div id=\"emailBox\">";
        echo"<div class=\"contactForm\">";
            echo"<h1>Email Us</h1>";
            echo"<hr>";
            echo"<form action=\"processes/sendEmail.php\" method=\"post\" autocomplete=\"off\" id=\"outerContactForm\">";

            if($_SESSION['login'] != 1){
                //if not logged in, leave blank
                echo"<label for=\"email\">Your Email</label>";
                echo"<input type=\"email\" name=\"senderEmail\" placeholder=\"Your Email Address\" id=\"senderEmail\" required>";
                
            }
            else{
                //if logged in, autofill email address
                $user = $_SESSION['user'];
                $sql = "SELECT email FROM registeredUsers WHERE userID = $user";
                $stmt = $pdo->query($sql);
                $row =$stmt->fetchObject();
                echo"<label for=\"email\">".$row->email."</label>";
                echo"<br><br>";
            }
            echo"<label for=\"subject\">Subject</label>";
            echo"<input type=\"text\" name=\"subject\" placeholder=\"Subject\" id=\"subject\" required>";
    
            echo"<label for=\"message\">Message</label>";
            echo"<textarea name=\"message\" placeholder=\"Type your message here...\" id=\"message\" required></textarea>";
    
            echo"<input type=\"submit\" value=\"Send\" > ";      
            echo"</form>";
        echo"</div>";
    echo"</div>";
        
    








?>