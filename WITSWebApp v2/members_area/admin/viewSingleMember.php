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

    $userID = $_GET['userID'] ?? null;
    $suserID = safeInt($userID);
    $memberList = "SELECT * FROM registeredUsers LEFT JOIN memberStatus ON registeredUsers.statusID = memberStatus.statusID WHERE userID = :userID";
    $members = $pdo->prepare($memberList);
    $members->bindParam(':userID', $suserID, PDO::PARAM_INT);
    $members->execute();
    $member = $members->fetchObject();
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
            <?php
                echo"<h1>".$member->firstname." ".$member->surname."</h1>";
            ?>
    </div>
    <!-- main content -->
    
    <div class="mainContent"> 

        <div class="errorMessages">
            <?php
                if(isset($_SESSION['updated'])){
                    $updated =$_SESSION['updated'];
                }
                else{
                    $updated=0;
                }

                if($updated==1){
                    echo"<p class=\"errorInputs\">Member Details Changed</p>";
                }
                else{
                    echo"<p class=\"errorInputs\"></p>";
                }                         
            ?>
        </div>
        <div class="middleLine">
            <div class="displaysection1">    
                <?php
                    echo"<a href=\"editSingleMember.php?userID=".$userID."\">";
                        echo"<button class=\"editBtn\">Edit</button>";
                    echo"</a>";
                ?>
            </div>
            <div class="displaysection1">
            <?php     
                echo"<div class=\"displayLine\">";             
                    echo"<p class=\"memberCatagory\">First Name: <span class=\"memberCatagoryText\">$member->firstname</span></p>";
                echo"</div>";
                echo"<div class=\"displayLine\">"; 
                    echo"<p class=\"memberCatagory\">Surname: <span class=\"memberCatagoryText\">$member->surname</span></p>";
                echo"</div>";
                echo"<div class=\"displayLine\">"; 
                    echo"<p class=\"memberCatagory\">Email: <span class=\"memberCatagoryText\">$member->email</span></p>";
                echo"</div>";
                echo"<div class=\"displayLine\">";     
                    echo"<p class=\"memberCatagory\">Status: <span class=\"memberCatagoryText\">$member->status</span></p>";
                echo"</div>";
            ?>
            </div>
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
    <script src="../../js/jquery.js"></script>


</body>
</html>
