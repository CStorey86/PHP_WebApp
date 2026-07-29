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
                echo"<h1>Edit: $event->eventTitle</h1>";
            ?>
    </div>
    <!-- main content -->
    
    <div class="mainContent"> 
        <form name="editSingleEvent" method="post" action="" action="../../processes/saveEventChanges.php">
            <button class="saveAllChanges">Save All </button>
                <a href="../admin.php">
                    <button class="saveAllChanges" action="../../members_area/admin.php">Cancel</button>
                </a>
            <div class="editFormSection">
            <!-- Event Title -->
                <div class = "eventForm">      
                    <label for="eventTitle">Event Title:</label>
                    <input type="text" name="eventTitle" id="eventTitle" class="editForm" value="<?php echo"$event->eventTitle";?>">
                    <button class="saveChanges" action="../../processes/saveEventChanges.php">Save</button>
                </div>
            <!-- Event Start -->
                <div class = "eventForm">      
                    <label for="eventStart">Start:</label>
                    <input type="datetime" name="eventStart" id="eventStart" class="editForm" value="<?php echo"$event->start";?>">
                    <button class="saveChanges" action="../../processes/saveEventChanges.php">Save</button>
                </div>
             <!-- Event End -->
                <div class = "eventForm">      
                    <label for="eventEnd">End:</label>
                    <input type="datetime" name="eventEnd" id="eventEnd" class="editForm" value="<?php echo"$event->end";?>">
                    <button class="saveChanges" action="../../processes/saveEventChanges.php">Save</button>
                </div>                       
             <!-- Event Details -->
                <div class = "eventForm">      
                    <label for="eventDetails">Details:</label>
                    <input type="textarea" name="eventDetails" id="eventDetails" class="editForm" value="<?php echo"$event->Details";?>">
                    <button class="saveChanges" action="../../processes/saveEventChanges.php">Save</button>
                </div>
            <!-- Event Admin Notes -->
                <div class = "eventForm">      
                    <label for="eventAdminNotes">Admin Notes:</label>
                    <input type="textarea" name="eventAdminNotes" id="eventAdminNotes" class="editForm" value="<?php echo"$event->adminNotes";?>">
                    <button class="saveChanges" action="../../processes/saveEventChanges.php">Save</button>
                </div>
            <!-- Event Image -->
                <div class = "eventForm">      
                    <label for="eventImage">Image:</label>
                <div class = "eventForm">
                    <label for="eventImageLink">Image name:</label>
                    <input type="text" name="eventImageLink" id="eventImageLink" class="editForm" value="<?php echo"$event->imageLink";?>">
                    <button class="saveChanges" action="../../processes/saveEventChanges.php">Save</button>
                </div>
                <div class = "eventForm">
                    <label for="eventImageAlt">Alt Image Text:</label>
                    <input type="text" name="eventImageAlt" id="eventImageAlt" class="editForm" value="<?php echo"$event->imgAltTxt";?>">
                    <button class="saveChanges" action="../../processes/saveEventChanges.php">Save</button>
                </div>
                <div class = "eventForm">  
                    <label for="eventChangeImage">Change Image:</label>
                    <input type="file" name="eventImage" id="eventImage" class="editForm" value="<?php echo"$event->imageLink";?>">
                    <button class="saveChanges" action="../../processes/saveEventChanges.php">Save</button>
                </div> 
            <!-- Event Location -->
                <div class = "eventForm">      
                    <label for="Location">Location:</label>
                </div>
                    <?php
                        $locationID = $event->locID;

                        $locationDetails ="SELECT * FROM locations WHERE locID = $locationID";
                        $stm = $pdo->query($locationDetails);
                        $rows = $stm->fetchObject();

                        if($locationID == 1){
                            //event is online

                echo"<div class = \"eventForm\"> ";
                            echo"<label for=\"eventRoom\">Room:</label>";
                            echo"<input type=\"text\" name=\"eventRoom\" 
                                id=\"eventRoom\" class=\"editForm\" value=\"Online\">";
                            echo"<button class=\"saveChanges\" action=\"../../processes/saveEventChanges.php\">Save</button>";
                echo"</div>";
                        }
                        else{

                echo"<div class = \"eventForm\"> ";
                            echo"<label for=\"eventRoom\">Room:</label>";
                            echo"<input type=\"text\" name=\"eventRoom\" 
                                id=\"eventRoom\" class=\"editForm\" value=\"$rows->room\">";
                            echo"<button class=\"saveChanges\" action=\"../../processes/saveEventChanges.php\">Save</button>";
                echo"</div>";
                        }
                            //get building name
                                $building = "SELECT * FROM locations 
                                LEFT JOIN building 
                                ON locations.buildingID = building.buildingID
                                WHERE locID = $locationID";
                                $stmt = $pdo->query($building);
                                $row = $stmt->fetchObject();
                echo"<div class = \"eventForm\"> ";           
                            echo"<label for=\"eventBuilding\">Building:</label>";
                            echo"<input type=\"text\" name=\"eventBuilding\" 
                                    id=\"eventBuilding\" class=\"editForm\" value=\"$row->buildingName\">";
                            echo"<button class=\"saveChanges\" action=\"../../processes/saveEventChanges.php\">Save</button>";
                echo"</div>";
                            //get rest of address

                                $venue = "SELECT * FROM locations
                                LEFT JOIN venue
                                ON locations.venueID = venue.venueID
                                WHERE locID = $locationID";
                                $stm = $pdo->query($venue);
                                $row = $stm->fetchObject();
                echo"<div class = \"eventForm\"> ";
                            echo"<label for=\"eventVenue\">Venue:</label>";
                            echo"<input type=\"text\" name=\"eventVenue\" 
                                    id=\"eventVenue\" class=\"editForm\" value=\"$row->venueName\">";
                            echo"<button class=\"saveChanges\" action=\"../../processes/saveEventChanges.php\">Save</button>";
                echo"</div>";
                echo"<div class = \"eventForm\"> ";
                            echo"<label for=\"eventCampus\">Campus:</label>";
                            echo"<input type=\"text\" name=\"eventCampus\" 
                                    id=\"eventCampus\" class=\"editForm\" value=\"$row->campus\">";
                            echo"<button class=\"saveChanges\" action=\"../../processes/saveEventChanges.php\">Save</button>";
                echo"</div>";
                echo"<div class = \"eventForm\"> ";
                            echo"<label for=\"eventAddressLine1\">Address Line 1:</label>";
                            echo"<input type=\"text\" name=\"AddressLine1\" 
                                    id=\"AddressLine1\" class=\"editForm\" value=\"$row->address_line1\">";
                            echo"<button class=\"saveChanges\" action=\"../../processes/saveEventChanges.php\">Save</button>";
                echo"</div>";
                echo"<div class = \"eventForm\"> ";
                            echo"<label for=\"eventAddressLine2\">Address Line 2:</label>";
                            echo"<input type=\"text\" name=\"AddressLine2\" 
                                    id=\"AddressLine2\" class=\"editForm\" value=\"$row->address_line2\">";
                            echo"<button class=\"saveChanges\" action=\"../../processes/saveEventChanges.php\">Save</button>";
                echo"</div>";
                echo"<div class = \"eventForm\"> ";
                            echo"<label for=\"eventCity\">City</label>";
                            echo"<input type=\"text\" name=\"eventCity\" 
                                    id=\"eventCity\" class=\"editForm\" value=\"$row->city\">";
                            echo"<button class=\"saveChanges\" action=\"../../processes/saveEventChanges.php\">Save</button>";
                echo"</div>";
                echo"<div class = \"eventForm\"> ";
                            echo"<label for=\"eventPostcode\">Postcode</label>";
                            echo"<input type=\"text\" name=\"eventPostcode\" 
                                    id=\"eventPostcode\" class=\"editForm\" value=\"$row->postcode\">";
                            echo"<button class=\"saveChanges\" action=\"../../processes/saveEventChanges.php\">Save</button>";
                echo"</div>";

                            //option to add county and country here if events take place elsewhere
                    
                ?>

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
