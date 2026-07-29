<?php
    $user = $_SESSION['user'];
    $sql = "SELECT * FROM registeredUsers WHERE userID = $user";
    $stmt = $pdo->query($sql);
    $row =$stmt->fetchObject();

    echo"<div class=\"topnav\">";
        echo"<a href=\"loggedin.php\" class=\"active\">";
        echo"<img class=\"logo1\" src=\"../images/logo2.PNG\" alt=\"Women In Tech Society Logo\"></a>";
     
        //links for all inner pages
        echo"<div id=\"myLinks\">";
            //home
            echo"<a href=\"loggedin.php\"><i class=\"fas fa-home\"></i>
            &nbsp;&nbsp; Home</a>";

            //Admin Menu (if user is admin)
            $status = $row->statusID;
            if($status=="1"){
                echo"<a href=\"admin.php\"><i class=\"fas fa-cogs\"></i>
                &nbsp;&nbsp; Admin Panel</a>";
            }

            //My Details
            echo"<a href=\"myDetails.php\"><i class=\"fas fa-user\"></i>
            &nbsp;&nbsp; My Details</a>";

            //My Events
            echo"<a href=\"myEvents.php\"><i class=\"fas fa-calendar-check\"></i>
            &nbsp;&nbsp; My Events</a>";

            //Find Events
            echo"<a href=\"upcomingEvents.php?searchEventTitle=\"><i class=\"fas fa-calendar-alt\"></i>
            &nbsp;&nbsp; Upcoming Events</a>";

            //Contact Us
            echo"<a href=\"innerContact.php\"><i class=\"fas fa-envelope-open-text\"></i>
            &nbsp;&nbsp; Contact Us</a>";
            
            //Logout
            echo"<a href=\"../processes/logout.php\"><i class=\"fas fa-sign-out-alt\">
            </i> &nbsp;&nbsp;  Logout </a>";   

        echo"</div>";

        echo"<a href=\"javascript:void(0);\" class=\"webicon\" onclick=\"topNavBar()\">";
            echo"<i class=\"fa fa-bars fa-2x\"></i>";
        echo"</a>";
        echo"<a href=\"javascript:void(0);\" class=\"icon\" onclick=\"topNavBar()\">";
            echo"<i class=\"fa fa-bars\"></i>";
        echo"</a>";

    echo"</div>";
?>