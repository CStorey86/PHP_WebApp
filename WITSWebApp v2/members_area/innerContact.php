<?php
    require('../includes/sessions.inc.php');
    require('../includes/conn.inc.php');

    if($_SESSION['login'] != 1){
        //if not logged in, bounce back to login.php
        $referer = "../login.php";
        header("Location: ../".$referer); 
    }
    else{
        //load member details from database based on userID passed by session['user'].
        $user = $_SESSION['user'];
        $sql = "SELECT * FROM registeredUsers WHERE userID = $user";
        $stmt = $pdo->query($sql);
    }
        
    //check user status
    $row =$stmt->fetchObject();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Hallam Women In Tech Society - Contact Us</title>

  <!-- links and includes-->
  <link href="../css/mobile.css" rel="stylesheet"/>
  <link href="../css/desktop.css" rel="stylesheet" media="only screen and (min-width : 720px)"/>
  <link href="../css/bootstrap/bootstrap-grid.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

</head>

<body>
<div class="container">
    <!--  Navigation Bar  -->
        <?php
            include('../includes/innerNavbar.php');
            //Navbar when not logged in.
        ?>
    <!-- end navigation bar -->

    <!-- main content -->
    <div class="mainContent">
            <h1>Contact Us</h1>
            <hr>
                <?php
                    include('../includes/contact.inc.php');

                ?>
    </div>
    <!-- end of main content -->
    
    <!-- footer -->
        <?php
            include('../includes/footer.php');
        ?>
    <!-- end footer -->

</div>

    <!-- Javascript links here -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/overlays.js"></script>

</body>
</html>
