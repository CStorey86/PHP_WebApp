<?php
    require('../includes/sessions.inc.php');
    require('../includes/conn.inc.php');

    //get details from the form
    $senderEmail = $_POST['senderEmail'];
    $subject = $_POST['subject'];
    $message = $email.":".$_POST['message'];

    //all three are "required" so can not be submitted if blank.
    //Could add futher checks for valid email address etc.

    // send email
    mail("shuwitsoc@gmail.com",$subject,
    $message);


?>