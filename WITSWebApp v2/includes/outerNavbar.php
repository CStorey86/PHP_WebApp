<?php
    echo"<div class=\"topnav\">";
        echo"<a href=\"index.php\" class=\"active\">";
        echo"<img class=\"logo1\" src=\"images/logo2.PNG\" alt=\"Women In Tech Society Logo\"></a>";
     
        echo"<div id=\"myLinks\">";
            echo"<a href=\"index.php\">Home</a>";
            echo"<a href=\"login.php\">Login</a>";
            echo"<a href=\"register.php\">Register</a>";
            echo"<a href=\"contact.php\">Contact Us</a>";
        echo"</div>";

        echo"<a href=\"javascript:void(0);\" class=\"webicon\" onclick=\"topNavBar()\">";
            echo"<i class=\"fa fa-bars fa-2x\"></i>";
        echo"</a>";
        echo"<a href=\"javascript:void(0);\" class=\"icon\" onclick=\"topNavBar()\">";
            echo"<i class=\"fa fa-bars\"></i>";
        echo"</a>";
    echo"</div>";
?>