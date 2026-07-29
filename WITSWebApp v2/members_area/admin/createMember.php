<?php
    require('../../includes/sessions.inc.php');
    require('../../includes/conn.inc.php');
    include('../../includes/functions.inc.php');

    if($_SESSION['login'] != 1){
        //if not logged in, bounce back to login.php
        $referer = "../../login.php";
        header("Location: ../".$referer); 
    }
    else{
        //load member details from database based on userID passed by session['user'].
        $user = $_SESSION['user'];
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>
        Hallam Women In Tech Society
     </title>

  <!-- links and includes-->
  <link href="../../css/mobile.css" rel="stylesheet"/>
  <link href="../../css/desktop.css" rel="stylesheet" media="only screen and (min-width : 720px)"/>
  <link href="../../css/bootstrap/bootstrap-grid.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
</head>

<body>
<div class="container">
    <!--  Navigation Bar  -->
        <?php
            include('innerNavbar.php');
            //Navbar when logged in.
        ?>
    <!-- end navigation bar -->
    <div class="title">
            <h1>Create New User</h1>
    </div>
    <!-- main content -->
    <div class="mainContent"> 
        <?php
            //error messages here
                if(isset($_SESSION['createError'])){
                    switch($_SESSION['createError']){
                        case 1:
                            echo"<p class=\"error\">Invalid Email Address</p>";
                        break;
                        case 2:
                            echo"<p class=\"error\">Please confirm the password</p>";
                        break;
                        case 3:
                            echo"<p class=\"error\">Email already registered</p>";
                        break;
                    }                    
                }            
        ?>
            <div class="createMember">
                        <a href="../admin.php">
                            <button class="cancel">Back</button>
                        </a>
                <form method="post" action="../../processes/addNewMember.php">
                    <div class="createFormLine">
                        <label for="firstname">First Name:</label>
                        <br>
                            <input type="text" name="firstname" id="firstname" placeholder="First Name">
                    </div>
                    <div class="createFormLine">
                        <label for="surname">Surname:</label>
                        <br>
                            <input type="text" name="surname" id="surname" Placeholder="Surname">
                    </div>
                    <div class="createFormLine">
                        <label for="email">Email:</label>
                        <br>
                            <input type="text" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="createFormLine">
                        <label for="Status">Status:</label>
                        <br>
                            <select name="status" id="status">
                                <option value="admin"><p>Admin</p></option>
                                <option selected="" value="member"><p>Member</p></option>
                                <option value="formerMember"><p>Former Member</p></option>
                            </select>
                    </div>
                            <br><br>
                    <div class="createFormLine2">
                        <div class="createFormLine">                  
                            <label for="userpassword">Password</label>
                                <br>
                                <input type="password" name="userpassword" placeholder="Password" id="userpassword" required>
                        </div>
                        <div class="createFormLine">                
                            <label for="passwordConfirm">Password </label>
                                <br>
                                <input type="password" name="passwordConfirm" placeholder="Confirm Password" id="passwordConfirm" required>
                        </div>
                    </div>
                    <div class="createFormLine2">
                        <div class="createFormLine"> 
                            <a href="../../processes/addNewMember.php">
                                <button class="createNew">Submit</button>
                            </a>    
                        </div>                
                    </div>
                </form>
            </div>   
    </div>  

    <!-- footer -->
        <?php
            include('../../includes/footer.php');
        ?>
    <!-- end footer -->
</div>

    <!-- Javascript links here -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/main.js"></script>
    


</body>
</html>
