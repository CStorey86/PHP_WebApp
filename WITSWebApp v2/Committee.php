<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Hallam Union- Women In Tech Society</title>

  <!-- links and includes-->
  <link href="css/mobile.css" rel="stylesheet"/>
  <link href="css/desktop.css" rel="stylesheet" media="only screen and (min-width : 720px)"/>
  <link href="css/bootstrap/bootstrap-grid.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <?php  
        require('includes/conn.inc.php');  

        $committeeMembers = "SELECT committee.position, committee.imagePath, committee.altText, 
                            committee.aboutText, members.firstName, members.surname, members.memberID
                             FROM committee
                             LEFT JOIN members ON committee.memberID = members.memberID
                             ORDER BY members.memberID";

        $stmt = $pdo->query($committeeMembers);         
  ?> 

</head>

<body>

<div class="container">

    <!-- header -->
    <div class="header">
        <div class="logo">
            <img class="logo1" alt="Sheffield Hallam Women In tech Society Logo" src="images/WitsLogo.png">
        </div>        
    </div>
           
    <!-- navigation bar -->
    <div class="navPanel">
        <div class="burgerMenu">
            <div class="bars">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
            <br>
        <nav class="mainNav">
            <div class="navItem"><a href="About.html">About</a></div>
            <div class="navItem"><a href="Committee.html">Committee</a></div>
            <div class="navItem"><a href="index.php">Login/Register</a></div>
            <div class="navItem"><a href="FAQ.html">FAQ's</a></div>
            <div class="navItem"><a href="Contact.html">Contact Us</a></div>     
        </nav> 
    </div> 
    
    <!-- main content -->
    <div class="mainContent">

        <p ID="committeeStatement">The elected committee for the 2020-21 academic year are as follows:</p>
        <p class="subtext1">Click on a picture to view more details.</p>

        <div class="wrapper">   
        <?php 
            while ($row =$stmt->fetchObject()){
                echo"<div class=\"item\">";
                    echo "<div class=\"polaroid\" onclick=\"on$row->memberID()\">";
                        echo "<img src=\"$row->imagePath\" alt=\"$row->altText\">";
                        echo "<div class=\"caption\">";
                            echo "<p>$row->position</p>";
                         echo "</div>";
                    echo "</div>"; 
                echo "</div> ";


                echo "<div id=\"overlay$row->memberID\" onclick=\"off$row->memberID()\">";
                    echo"<div class=\"positionCardText\">";
                        echo "<div class=\"positionCardTitle\">$row->position: $row->firstName $row->surname</div>";
                        echo "<p>$row->aboutText</p>";
                        echo"<hr class=\"closeLine\"><br>";
                        echo"<div class=\"close\"><p>CLOSE &nbsp;</p><i class=\"fa fa-window-close\" aria-hidden=\"true\"></i></div>";
                echo"</div>";
        }   
        ?> 
        </div>


    </div>
        
    <!-- footer -->
    <div class="footer">
        <div class="footerItemLeft">
                <ul>
                    <li><a href="https://www.hallamstudentsunion.com/gdpr/">Privacy Policy</a></li>
                    <li><a href="https://www.hallamstudentsunion.com/representation/democracy/currentpolicies/">Hallam Union Policies</a></li>
                    <li><a href="Contact.html">Contact Us</a></li>
                </ul>      
        </div>
        <div class="footerItemRight">&copy; C.Storey 2020</div>
    </div>  
   
</div>

    <!-- Javascript links here -->
    <script src="js/main.js"></script>

</body>
</html>
