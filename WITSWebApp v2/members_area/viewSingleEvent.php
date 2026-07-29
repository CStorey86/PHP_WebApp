<?php
    require('../includes/sessions.inc.php');
    require('../includes/conn.inc.php');
    include('../includes/functions.inc.php');

    if($_SESSION['login'] != 1){
        //if not logged in, bounce back to login.php
        $referer = "../login.php";
        header("Location: ../".$referer); 
    }
    else{
        //load member details from database based on userID passed by session['user'].
        $user = $_SESSION['user'];
    }

    $eventID = $_GET['eventID'];
    $upcomingEvents = "SELECT * FROM events WHERE eventID = $eventID";
    $events = $pdo->query($upcomingEvents);
    $event = $events->fetchObject();
    $title = $event->eventTitle;
    $eventID = $event->eventID;
    $maxCap = $event->maxCapacity;
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
            <?php
                echo"<h1>$title</h1>";
                //if tickets purchased
                //if($_SESSION['successPurchase'] = 1){
                    //echo"<p class=\"numberStmt\">You have purchased  
                        //tickets for this event.</p>";
                //}
            ?>
    </div>


    <div class = "singleEventImg">
                <?php
                     echo"<img class=\"singleEventImg\" 
                            src=\"../images/events/".$event->imageLink."\" alt=\"".$event->imgAltTxt."\"></img>";
                    echo"<p class=\"price2\">£". $event->price."</p>";
                ?>
    </div>
    <!-- main content -->
    <div class="mainContentEvent">

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
                ?>
            </div>   
        </div>  
        <!-- end main content-->
        <div class="singleEventPurchase">
            <?php
            $_SESSION['eventID'] = $eventID;
            $_SESSION['title'] = $title;

            echo"<form action=\"../processes/buyTickets.php\">";
                echo"<Label>QTY</label>";
                echo"<input type=\"number\" placeholder=\"1\" name=\"quantity\" min=\"1\" max=$maxCap>";
                echo"<button class=\"buyTickets\">Buy Tickets</button>";
            echo"</form>";
            
            //on submission...run buytickets.php, and display overlay message confirming purchase.
            ?>
        </div>
    <!-- end main content-->
    <div class="backBar">
        <?php
            echo"<a href=\"upcomingEvents.php?searchEventTitle=".$_SESSION['searchText']."\">";
        ?>
            <i class="fas fa-caret-square-left fa-2x"></i>
        </a> 
    </div>

    <!-- footer -->
        <?php
            include('../includes/footer.php');
        ?>
    <!-- end footer -->
</div>

    <!-- Javascript links here -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/main.js"></script>


</body>
</html>
