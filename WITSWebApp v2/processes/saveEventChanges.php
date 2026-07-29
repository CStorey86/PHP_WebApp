<?php
    require('../includes/conn.inc.php');
    require('../includes/sessions.inc.php');

    //get values from form
    $eventID = $_GET['eventID'];
    $eventTitle = $_POST['eventTitle'];
    $eventStart = $_POST['eventStart'];
    $eventEnd = $_POST['eventEnd'];
    $eventDetails = $_POST['eventDetails'];
    $eventAdminNotes = $_POST['eventAdminNotes'];
    $eventImageLink = $_POST['eventImageLink'];
    $eventImageAlt = $_POST['eventImageAlt'];
    $eventImage = $_POST['eventImage'];
    $eventRoom = $_POST['eventRoom'];
    $eventBuilding = $_POST['eventBuilding'];
    $eventVenue = $_POST['eventVenue'];
    $eventCampus = $_POST['eventCampus'];
    $AddressLine1 = $_POST['AddressLine1'];
    $AddressLine2= $_POST['AddressLine2'];
    $eventCity = $_POST['eventCity'];
    $eventPostcode = $_POST['eventPostcode'];

    //update table
    $updateEvent = " UPDATE events
        SET firstname = :firstname, eventTitle = :eventTitle, eventStart = :eventStart,
        eventEnd = :eventEnd, eventDetails = :eventDetails, eventAdminNotes = :eventAdminNotes, eventImageLink = :eventImageLink,
        eventImageAlt = :eventImageAlt, eventImage = :eventImage, eventRoom = :eventRoom, eventBuilding = :eventBuilding,
        eventVenue = :eventVenue, eventCampus = :eventCampus, AddressLine1 = :AddressLine1, AddressLine2 = :AddressLine2,
        eventCity = :eventCity , eventPostcode = :eventPostcode
        WHERE eventID = $eventID";

    $stmt = $pdo->prepare($updateEvent);
    $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindParam(":eventID", $eventID, PDO::PARAM_STR);
    $stmt->bindParam(":eventTitle", $eventTitle, PDO::PARAM_STR);
    $stmt->bindParam(":eventStart", $eventStart, PDO::PARAM_STR);
    $stmt->bindParam(":eventEnd", $eventEnd, PDO::PARAM_STR);
    $stmt->bindParam(":eventDetails", $eventDetails, PDO::PARAM_STR);
    $stmt->bindParam(":eventAdminNotes", $eventAdminNotes, PDO::PARAM_STR);
    $stmt->bindParam(":eventImageLink", $eventImageLink, PDO::PARAM_STR);
    $stmt->bindParam(":eventImageAlt", $eventImageAlt, PDO::PARAM_STR);
    $stmt->bindParam(":eventImage", $eventImage, PDO::PARAM_STR);
    $stmt->bindParam(":eventRoom", $eventRoom, PDO::PARAM_STR);
    $stmt->bindParam(":eventBuilding", $eventBuilding, PDO::PARAM_STR);
    $stmt->bindParam(":eventVenue", $eventVenue, PDO::PARAM_STR);
    $stmt->bindParam(":eventCampus", $eventCampus, PDO::PARAM_STR);
    $stmt->bindParam(":AddressLine1", $AddressLine1, PDO::PARAM_STR);
    $stmt->bindParam(":AddressLine2", $AddressLine2, PDO::PARAM_STR);
    $stmt->bindParam(":eventCity", $eventCity, PDO::PARAM_STR);
    $stmt->bindParam(":eventPostcode", $eventPostcode, PDO::PARAM_STR);

    $stmt->execute();

    $referer = "members_area/admin\viewSingleEvent.php?eventID=$eventID\"";
    $_SESSION['updated']=1;
    header("Location: ../".$referer);
    exit; 

?>