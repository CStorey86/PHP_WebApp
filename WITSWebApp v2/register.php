<?php
    require('includes/sessions.inc.php');
    require('includes/conn.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Hallam Women In Tech Society - Register</title>

  <!-- links and includes-->
  <link href="css/mobile.css" rel="stylesheet"/>
  <link href="css/desktop.css" rel="stylesheet" media="only screen and (min-width : 720px)"/>
  <link href="css/bootstrap/bootstrap-grid.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  

</head>

<body>
<div class="container">
    <!--  Navigation Bar  -->
    <?php
            include('includes/outerNavbar.php');
            //Navbar when not logged in.
        ?>
    <!-- end navigation bar -->
    

    <!-- main content -->
    <div class="mainContent">
		<div class="register">
            <h1>Register</h1>
            
        <?php
        //Error messages
            if(isset($_SESSION['regError'])){
                switch($_SESSION['regError']){
                    case 1:
                        echo"<p class=\"error\">Invalid Email Address</p>";
                    break;
                    case 2:
                        echo"<p class=\"error\">Please confirm your password</p>";
                    break;
                    case 3:
                        echo"<p class=\"error\">Email already registered</p>";
                    break;
                }  
            }
                    //Success message
            if(isset($_SESSION['successReg'])){
                if($_SESSION['successReg'] = 1){
                    echo"<p class=\"error\">You are now Registered - Please 
                    <a href=\"login.php\">Login</a></p>";
            };
        };
        ?>

        <form action="processes/userRegistration.php" method="post" autocomplete="off" id="registrationForm">

                    <label for="email"><i class="fas fa-envelope"></i></label>
                    <input type="email" name="email" placeholder="Email" id="email" required>
                
                    <label for="userpassword"><i class="fas fa-lock"></i></label>
                    <input type="password" name="userpassword" placeholder="Password" id="userpassword" required>

                    <label for="passwordConfirm"><i class="fas fa-lock"></i></label>
                    <input type="password" name="passwordConfirm" placeholder="Confirm Password" id="passwordConfirm" required>
                    
                    <div class="g-reCAPTCHA" data-sitekey="6Ld83LoZAAAAABjuEoVWkk-_XOepjTJ7eJQhkpXq"></div>
 
                    <input type="submit" value="Register" >
                               
        </form>
        
        </div>

    </div> 
    <!-- end main content-->
    <!-- footer -->
    <?php
                include('includes/footer.php');
            ?>
   <!-- end footer -->
</div>

    <!-- Javascript links here -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
    <!--<script src="https://www.google.com/recaptcha/api.js"></script> -->  



</body>
</html>
