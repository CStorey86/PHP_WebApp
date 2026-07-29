<?php
    require('includes/sessions.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Hallam Women In Tech Society - Login</title>

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
            <h1>Login</h1>
            
        <?php
            if(isset($_SESSION['loginError'])){
                  echo "<p class=\"error\">Invalid Login Details</p>"; 
            }
        ?>

        <form action="processes/checkLogin.php" method="post" autocomplete="off">

                    <label for="loginemail"><i class="fas fa-envelope"></i></label>
                    <input type="email" name="loginemail" placeholder="Email" id="loginemail" required>
                
                    <label for="loginpassword"><i class="fas fa-lock"></i></label>
                    <input type="password" name="loginpassword" placeholder="Password" id="loginpassword" required>

                    <input type="submit" value="Login">          
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

</body>
</html>
