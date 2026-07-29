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
        $sql = "SELECT * FROM registeredUsers WHERE userID = :user";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":user", $user, PDO::PARAM_STR);
        $stmt->execute();
        $row =$stmt->fetchObject();
        $dbPasswordHash=$row->userpassword;
    }
    if(isset($_GET['errorMsg'])){
        $errorCode = $_GET['errorMsg'];
    }
    else{
        $errorCode = 0;
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Hallam Women In Tech Society</title>

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
            //Navbar when logged in.
        ?>
    <!-- end navigation bar -->
    <div class="title">
            <h1>My Details</h1>
    </div>
    <div class="errorMessages">
            <?php
                if(isset($_GET['errorMsg'])){
                    $errorCode = $_GET['errorMsg'];
                }
                else{
                    $errorCode = 0;
                }


                if($errorCode==1){
                    echo"<p class=\"errorInputs\">Passwords Don't Match - Try again!</p>";
                }
                elseif($errorCode==2){
                    echo"<p class=\"errorInputs\">Password Changed</p>";
                }
                elseif($errorCode==3){
                    echo"<p class=\"errorInputs\">Details Updated</p>";
                }
                else{
                    echo"<p class=\"errorInputs\"></p>";
                }                         
            ?>
    </div>

    <!-- main content -->
    <div class="mainContent">
        <div class="detailsTableSection">
                <?php
                    echo"<table id=\"details\">";
                        echo"<tr>";
                            echo"<td class=\"detailHeader\">First name:</td>";
                            echo"<td class=\"detail\">".$row->firstname."</td>";
                        echo"</tr>";
                        echo"<tr>";
                            echo"<td class=\"detailHeader\">Surname:</td>";
                            echo"<td class=\"detail\">".$row->surname."</td>";
                        echo"</tr>";
                        echo"<tr>";
                            echo"<td class=\"detailHeader\">Email:</td>";
                            echo"<td class=\"detail\">".$row->email."</td>";
                        echo"</tr>";
                    echo"</table>";
                ?>
                <div class="editButtonWeb">
                    <button class="editBtn" onclick="showEditFormBox()">Edit</button>
                </div>
                <div class="editButtonWeb">
                    <button class="editBtn2" onclick="showPasswordBox()">Change Password</button>
                </div>
        </div>
        <div id="webEditBox">
            <div class="editFormBox">
                <div class="close" onclick="hideEditFormBox()">
                        <i class="fas fa-window-close fa-2x"></i>
                </div>
                <div class="editBoxMain">
                    <h1>Edit Your Details</h1>
                        <?php
                            echo"<form method=\"post\" action=\"../processes/changeMyDetails.php\" autocomplete=\"off\" class=\"changeMyDetailsBox\">";
                                    echo"<label for=\"firstname\">First Name(s):</label>";
                                    echo"<input type=\"text\" name=\"firstname\" value=".$row->firstname." id=\"firstName\">";
                
                                    echo"<label for=\"surname\">Surname:</label>";
                                    echo"<input type=\"text\" name=\"surname\"value=".$row->surname." id=\"surname\">";
                        
                                    echo"<label for=\"email\">Email:</label>";
                                    echo"<input type=\"email\" name=\"email\" value=".$row->email." id=\"email\">";

                                    echo"<input type=\"submit\" value=\"Update Details\" >  ";
                            echo"</form>";
                        ?>
                </div>
            </div>            
        </div>

        <div id="passEditBox">
            <div class="editFormBox">
                <div class="close" onclick="hidePasswordBox()">
                        <i class="fas fa-window-close fa-2x"></i>
                </div>
                <div class="editBoxMain">
                    <h1>Change Password</h1>
                        <?php
                            echo"<form method=\"post\" action=\"../processes/changeMyPassword.php\" class=\"changeMyDetailsBox\">";
                                    echo"<label for newPassword>New Password</label>";
                                    echo"<input type=\"password\" name=\"newPassword\" id=\"newPassword\">";
                
                                    echo"<label for confirmNewPassword>Confirm Password</label>";
                                    echo"<input type=\"password\" name=\"confirmNewPassword\" id=\"confirmNewPassword\">";
                        
                                    echo"<input type=\"submit\" value=\"Change Password\">";
                            echo"</form>";
                        ?>
                </div>
            </div>            
        </div>

    </div>
    <!-- end main content-->

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