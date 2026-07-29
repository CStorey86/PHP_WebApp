<?php   
    require('../includes/sessions.inc.php');
    require('../includes/conn.inc.php');
        
    $eventID = $_SESSION['eventID'];
    $user = $_SESSION['user'];
    $event = $_SESSION['title'];
    $qty =  $_GET['quantity'];

        
    //store into the database table:"ticketSales"
    $sql="INSERT INTO ticketSales(eventID,qty,userID) VALUES (:eventID, :qty, :userID)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":eventID", $eventID, PDO::PARAM_INT);
    $stmt->bindParam(":qty", $qty, PDO::PARAM_INT);
    $stmt->bindParam(":userID", $user, PDO::PARAM_INT);
    $stmt->execute();    

    //display success message (overlay)
    $_SESSION['tickets'] = 1;
    echo"<p>You have bought ".$qty." tickets for".$event.".</p>";
    echo"<p>Details of your tickets have now been added to your \"My Events\" page ".$qty." tickets for".$event.".</p>";

    $_SESSION['successPurchase'] = 1;
    $referer = "members_area/myEvents.php"; 
    header("Location: ../".$referer);
    exit;

?>