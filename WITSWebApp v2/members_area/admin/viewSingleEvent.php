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

    $eventID = $_GET['eventID'] ?? null;
    $seventID = safeInt($eventID);
    $upcomingEvents = "SELECT * FROM events WHERE eventID = :eventID";
    $events = $pdo->prepare($upcomingEvents);
    $events->bindParam(':eventID', $seventID, PDO::PARAM_INT);
    $events->execute();
    $event = $events->fetchObject();
?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>
        Hallam Women In Tech Society - Upcoming Event
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
                echo"<h1>$event->eventTitle</h1>";
            ?>
    </div>
    <!-- main content -->
    
    <div class="mainContent"> 
    <div class="errorMessages">
            <?php
                if(isset($_SESSION['updated'])){
                    $updated =$_SESSION['updated'];
                }

                if($updated==1){
                    echo"<p class=\"errorInputs\">Event Details Changed</p>";
                }
                else{
                    echo"<p class=\"errorInputs\"></p>";
                }                         
            ?>
    </div>
        <div class="middleLine">
            <a href="editSingleEvent.php?eventID=".$eventID.>
                <button class="saveChanges">Edit</button> 
            </a>
            <div class = "eventDateTimes">      
                <?php        
                    $timestampDate = strtotime($event->start);
                    $endtimestampDate = strtotime($event->end);
                    $eventDate = date("D d M Y", $timestampDate);
                    $eventEndDate = date("D d M Y", $endtimestampDate);

                    //if event ends on a different date, show end date
                    if($eventEndDate == $eventDate){
                        echo"<p>". $eventDate."</p>";
                    }
                    else{
                        echo"<p>". $eventDate." - ". $eventEndDate."</p>";
                    }  
                ?>
            </div>
            <div class = "eventDateTimes">
                <?php
                    $startTime = date("h:i A", $timestampDate);
                    $endTime = date("h:i A", $endtimestampDate); 

                    echo"<p>". $startTime." - ". $endTime."</p>";
                ?>
            </div> 
            <div class = "singleEventImage">
                <?php
                    echo"<img src=\"../../images/events/".$event->imageLink."\" alt=\"".$event->imgAltTxt."\"></img>";
                ?>
            </div>
            <div class = "eventLocation">
                <?php
                    $locationID = $event->locID;

                    if($locationID == 1){
                        echo"<p>
                                This event will be held Online.<br>
                                    <br>
                                Full details will be emailed to registered participants on the day
                            </p>";
                    }
                    else{                                             
                        $locationDetails ="SELECT * FROM locations WHERE locID = $locationID";
                        $stm = $pdo->query($locationDetails);
                        $rows = $stm->fetchObject();
                                //get building name
                                    $building = "SELECT * FROM locations 
                                        LEFT JOIN building 
                                        ON locations.buildingID = building.buildingID
                                        WHERE locID = $locationID";
                                    $stmt = $pdo->query($building);
                                    $row = $stmt->fetchObject();
                        echo"<p>".$rows->room.",".$row->buildingName."</p>";
                                //get rest of address

                                    $venue = "SELECT * FROM locations
                                                LEFT JOIN venue
                                                ON locations.venueID = venue.venueID
                                                WHERE locID = $locationID";
                                    $stm = $pdo->query($venue);
                                    $row = $stm->fetchObject();
                        echo"<p>
                                $row->venueName <br>
                                $row->campus <br>
                                $row->address_line1 <br>
                                $row->address_line2
                                $row->city <br>
                                $row->postcode</p>";

                                //option to add county and country here if events take place elsewhere
                    } 
                ?>
            </div>
            <div class = "eventDescription">
                <?php
                    echo"<p>$event->Details</p>";
                    echo"<hr>";
                    echo"<p class=\"notes\">$event->adminNotes</p>";
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
