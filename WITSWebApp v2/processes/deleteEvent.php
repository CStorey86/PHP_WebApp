<?php
    require('../includes/conn.inc.php');
    include('../includes/functions.inc.php');

$eventID = $_GET['eventID'] ?? null;
$seventID = safeInt($eventID);

$deleteMember ="DELETE FROM events WHERE eventID = :eventID";
$stmt = $pdo->prepare($deleteMember);
$stmt->bindParam(':eventID', $seventID, PDO::PARAM_INT);
$stmt->execute();

$referer = "members_area/admin.php"; 
header("Location: ../".$referer);
exit;

?>