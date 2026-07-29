<?php
    require('../includes/conn.inc.php');
    include('../includes/functions.inc.php');

$userID = $_GET['userID'] ?? null;
$suserID = safeInt($userID);

$deleteMember ="DELETE FROM registeredUsers WHERE userID = :userID";
$stmt = $pdo->prepare($deleteMember);
$stmt->bindParam(':userID', $suserID, PDO::PARAM_INT);
$stmt->execute();

$referer = "members_area/admin.php"; 
header("Location: ../".$referer);
exit;

?>