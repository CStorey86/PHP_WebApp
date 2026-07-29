<?php
    require('../includes/sessions.inc.php');
    require('../includes/conn.inc.php');

    if($_SESSION['login'] != 1){
        //if not logged in, bounce back to login.php
        $referer = "../login.php";
        header("Location: ../".$referer); 
    }
    else{
        //load member details from database based on userID passed by session['user'].
        $user = $_SESSION['user'];
    }



?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Hallam Women In Tech Society - Upcoming  Events</title>

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
                <h1>Upcoming Events</h1>
    </div>

    <!-- main content -->
    <div class="mainContent">
        <form>
            <div class="search-container">
                <input type="text" placeholder="Search By Event Title" name="searchEventTitle">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <?php
        //if something has been searched for
            if(isset($_GET['searchEventTitle'])){
                $searchEventTitle = "%".$_GET['searchEventTitle']."%";
            }

            if(isset($searchEventTitle)){
                //show search results
                $today = date("Y-m-d");
                $upcomingEvents = "SELECT * FROM events WHERE start >= '$today' AND eventTitle LIKE :searchEventTitle";
                $stmt = $pdo->prepare($upcomingEvents);
                $stmt->bindParam(':searchEventTitle', $searchEventTitle , PDO::PARAM_STR);
                $stmt->execute(); 

                $eventCount = $stmt->rowCount();   
                echo"<p class=\"numberStmt\"> There are <span class=\"numberCount\">$eventCount</span> upcoming events that match your search.</p>";
    
            }
            else{
                //show all upcoming events
                $today = date("Y-m-d");
                $upcomingEvents = "SELECT * FROM events WHERE start >= '$today'";
                $stmt = $pdo->query($upcomingEvents);

                $eventCount = $stmt->rowCount();   
                echo"<p class=\"numberStmt\"> There are <span class=\"numberCount\">$eventCount</span> upcoming events.</p>";
        
            }

            $eventCount = $stmt->rowCount();   

        echo"<div class=\"eventsBox\">";
            while($row=$stmt->fetchObject()){

                    $timestampDate = strtotime($row->start);
                    $endtimestampDate = strtotime($row->end);
                    $eventDate = date("D d M Y", $timestampDate);
                    $startTime = date("h:i A", $timestampDate);
                    $endTime = date("h:i A", $endtimestampDate);  
                    
                    $eventID = $row->eventID;
                
                    echo"<div class=\"eventWrapper\">";
                        //Event image
                        echo"<img class=\"eventImg\" src=\"../images/events/".$row->imageLink."\"></img>";
                        //Details
                        echo"<div class=\"eventText\">";
                            echo"<a href=\"viewSingleEvent.php?eventID=".$eventID."\">";
                                echo"<h2>".$row->eventTitle."</h2>";
                            echo"</a>";
                            echo"<p>". $eventDate."</p>";
                            echo"<p>". $startTime." - ". $endTime."</p>";

                            if($row->price=0){
                                echo"<p class=\"price\">FREE</p>";
                            }
                            else{
                                echo"<p class=\"price\">£". $row->price."</p>";
                            }                          
                        echo"</div>";    
                    echo"</div>";  
                
            };   
        echo"</div>";
            $_SESSION['searchText'] = $_GET['searchEventTitle'];
            $_SESSION['EventID'] = $eventID;
        ?>
    </div>
  

    <!-- end main content-->

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
