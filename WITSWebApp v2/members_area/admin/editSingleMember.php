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
                echo"<h1>Edit: $member->firstname $member->surname</h1>";
            ?>
    </div>
    <!-- main content -->
    
    <div class="mainContent">
        <?php
        echo"<a href=\"viewSingleMember.php?userID=$userID\">";?>
            <button class="editBtn">Cancel</button>
        </a> 
    <form name="editSingleMember" method="post" action="changeUserDetails">
        <div class="editFormSection">
            <!-- Member First Name -->
                <div class = "eventForm">  
                    <h2>User Details</h2>    
                </div>
                <div class = "eventForm">      
                    <label for="eventTitle">First Name:</label>
                    <input type="text" name="firstname" id="firstname" class="editForm" value="<?php echo"$member->firstname";?>">
                </div>
            <!-- Member Surname -->
                <div class = "eventForm">      
                    <label for="eventTitle">Surname:</label>
                    <input type="text" name="surname" id="surname" class="editForm" value="<?php echo"$member->surname";?>">
                </div>
            <!-- Member Email -->
                <div class = "eventForm">      
                    <label for="eventTitle">Email:</label>
                    <input type="email" name="email" id="email" class="editForm" value="<?php echo"$member->email";?>">
                </div>
            <!-- Member Email -->
                <div class = "eventForm">      
                    <label for="eventTitle">Status:</label>
                    <input type="text" name="status" id="status" class="editForm" value="<?php echo"$member->status";?>">
                </div>
            </div>
        </form>

        <form name="editSingleMember" method="post" action="changeUserPassword">
        <div class="editFormSection">
                <div class = "eventForm">  
                    <h2>Change Password</h2>    
                </div>
            <!-- New Password -->
                <div class = "eventForm">      
                    <label for newPassword>New Password</label>
                    <input type="password" name="newPassword" id="newPassword">
                </div>
            <!-- Confirm -->
                <div class = "eventForm">      
                    <label for confirmNewPassword>Confirm Password</label>
                    <input type="password" name="confirmNewPassword" id="confirmNewPassword">
                </div>
                <div class = "eventForm">      
                        <button class="editBtn">Change Password</button>
                </div>
        </div>   
        </form>
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
