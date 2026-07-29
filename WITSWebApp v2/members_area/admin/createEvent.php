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
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>
        Hallam Women In Tech Society
     </title>

  <!-- links and includes-->
  <link href="../../css/mobile.css" rel="stylesheet"/>
  <link href="../../css/desktop.css" rel="stylesheet" media="only screen and (min-width : 720px)"/>
  <link href="../../css/bootstrap/bootstrap-grid.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../../js/ajax.js"></script>
  
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
            <h1>Create New Event</h1>
    </div>

    <!-- main content -->
    <div class="mainContent"> 
        <?php
            //error messages here
                if(isset($_SESSION['createError'])){
                    switch($_SESSION['createError']){
                        case 1:
                            echo"<p class=\"error\">Invalid Email Address</p>";
                        break;
                        //possible errors - list case for each possibility.                          
                    }                    
                }            
        ?>
            <div class="createEvent">
                        <a href="../admin.php">
                            <button class="cancel">Back</button>
                        </a>
                <form method="post" action="../../processes/addNewEvent.php">
                    <div class="createFormLine3">
                            <div class="createFormLine">    
                                <h2>Title and Details</h2>
                            </div>
                            <div class="createFormLine">
                                <p class="errorInputs">All sections marked with * are required</p>
                            </div>
                            <div class="createFormLine">
                                <label for="eventTitle">Event Title*:</label>
                                <input type="text" name="eventTitle" id="eventTitle" placeholder="Event Title">
                            </div>
                            <div class="createFormLine">
                                <label for="Details">Details*:</label>
                                <textarea name="Details" id="Details" placeholder="Details of Event"></textarea>
                            </div>
                            <div class="createFormLine">
                                <label for="price">Price (£):</label>
                                <input type="number" name="price" id="Details" value="0.00"></textarea>
                            </div>
                            <div class="createFormLine">
                                <label for="maxCap">Maximum Capacity*:</label>
                                <input type="number" min="1" name="maxCap" id="maxCap" value="300"></textarea>
                            </div>
                    </div>
                    <div class="createFormLine3">
                            <div class="createFormLine">    
                                <h2>Image Details</h2>
                            </div>
                            <div class="createFormLine2">
                                <div class="createFormLine"> 
                                    <div class="halfFormSection">
                                        <label for="imgLink">Image Name:</label>
                                        <input type="text" name="imgLink" id="imgLink" value="event.png">
                                    </div>
                                    <div class="halfFormSection">
                                        <label for="imgAlt">Image Alt Description:</label>
                                        <input type="text" name="imgAlt" id="imgAlt" value="event.png">
                                    </div>
                                </div>           
                                <div class="createFormLine">   
                                        <label for="imgUp">Upload Image:</label>
                                        <input type="file" name="imgUp" id="imgUp" placeholder="image.jpg" value="Upload Image">     
                                </div>            
                            </div>                
                    </div>
                    <div class="createFormLine3">
                        <div class="createFormLine2">
                            <?php
                                $today=date("dd/mm/yyyy");
                            ?>
                                    <div class="createFormLine">    
                                        <h2>Date and Time</h2>
                                    </div>
                                    <div class="createFormLine">    
                                        <div class="halfFormSection">
                                            <label for="startDate">Start Date and Time*</label>
                                            <input type="datetime-local" name="startDate" min="<?php $today ?>" id="startDate" >
                                        </div>    
                                        <div class="halfFormSection">
                                            <label for="endDate">End Date*</label>
                                            <input type="datetime-local" name="endDate" id="endDate" min="<?php $today ?>" >
                                        </div>    
                                    </div>                                    
                        </div>              
                    </div>
                    <div class="createFormLine3">
                            <div class="createFormLine">    
                                <h2>Location Details*</h2>
                            </div>
                            <div class="createFormLine">
                                <div class="halfFormSection">                             
                                    <label for="online" class="onlineLabel">
                                        <input type="radio" name="online" id="online" value="online" checked>
                                        Online
                                    </label>
                                </div>  
                                <div class="halfFormSection">                             
                                    <label for="imgLink" class="onlineLabel">
                                        <input type="radio" name="online" id="notOnline" value="notOnline" >
                                        Not Online
                                    </label>
                                </div> 
                            </div>

                            <div class="online box"></div>
                            <!-- if not online, more details needed -->
                            <div class="notOnline box">
                                <div id="venueList">
                                    <div class="createFormLine">                         
                                        <label for="location">Venue*:</label>
                                            <select name="locations" id="locations">
                                                <?php
                                                    $sql ="SELECT * FROM venue";
                                                    $stmt=$pdo->query($sql);
                                                while($row =$stmt->fetchObject()){
                                                    echo"<option value=\"$row->venueValue\">".$row->venueName."</option>";
                                                }
                                                ?>
                                                <option value="other">Other</option>
                                            </select>  
                                    </div>
                                </div>
                                <!-- if preset venue chosen, the rest of the form isn't required -->
                                <div class="createFormLine">
                                    <div id="hallam" class="venueOptions">
                                        <div class="createFormLineOther">                                    
                                            <label for="building">Building:</label>
                                            <select name="buildings" id="buildings">
                                                <?php
                                                    //list all possible Hallam Buildings
                                                    $sql="SELECT*FROM building";
                                                    $build = $pdo->query($sql);
                                                    
                                                    while($row = $build->fetchObject()){
                                                        $name = $row->buildingName;
                                                        $bID = $row->buildingID;
                                                        echo"<option value=\"".$bID."\">";
                                                            echo"$name";
                                                        echo"</option>";
                                                    }
                                                ?>
                                            </select>  
                                            <div class="createFormLineOther">                           
                                                <label for="room">Room:</label>
                                                <input type="text" name="room" id="room" value="">

                                        </div>
                                        <div class="createFormLineOther"> 
                                            <label for="campus">Campus:</label>
                                            <input type="text" name="campus" id="campus" value="">
                                        </div>
                                        </div>
                                    </div>
                                    <div id="hallamUnion" class="venueOptions">
                                        <div class="createFormLineOther">                                    
                                            <label for="building">Building:</label>
                                            <select name="buildings" id="buildings">
                                                <option value="The HUBS">The HUBS</option>";
                                                <option value="hallam">Collegiate Union Office</option>
                                            </select> 
                                        </div> 
                                        <div class="createFormLineOther">                           
                                            <label for="room">Room:</label>
                                            <input type="text" name="room" id="room" value="">
                                        </div>
                                        <div class="createFormLineOther"> 
                                            <label for="campus">Campus:</label>
                                            <input type="text" name="campus" id="campus" value="">
                                        </div>
                                    </div>
                                    <div id="other" class="venueOptions">
                                        <div class="createFormLineOther">                      
                                            <label for="venue">Other:</label>
                                            <input type="text" name="venue" id="venue" value="">
                                        </div>
                                        <div class="createFormLineOther">                                                     
                                            <label for="address_Line1">Address Line 1:</label>
                                            <input type="text" name="address_Line1" id="address_Line1" value="">
                                        </div>
                                        <div class="createFormLineOther">                           
                                            <label for="address_Line2">Address Line 1:</label>
                                            <input type="text" name="address_Line2" id="address_Line2" value="">
                                        </div>
                                        <div class="createFormLineOther">                           
                                            <label for="city">City</label>
                                            <input type="text" name="city" id="city" value="">
                                        </div>
                                        <div class="createFormLineOther">                           
                                            <label for="postcode">Postcode</label>
                                            <input type="text" name="postcode" id="postcode" value="">
                                        </div>
                                        <div class="createFormLineOther">                           
                                            <label for="county">County</label>
                                            <input type="text" name="county" id="county" value="">
                                        </div>
                                        <div class="createFormLineOther">                           
                                            <label for="country">Country</label>
                                            <input type="text" name="country" id="country" value="">
                                        </div>
                                    </div>
                            </div> 
                    </div>
                     <div class="createFormLine">    
                        <h2>Admin Notes</h2>
                    </div>
                    <div class="createFormLine">    
                        <div class="halfFormSection">
                            <label for="startDate">Admin Notes</label>
                                <input type="textarea" name="adminNotes">
                        </div>  
                    </div>                                               
                    <div class="createFormLine"> 
                        <a href="../../processes/addNewMember.php">
                            <button class="createNew">Submit</button>
                        </a>    
                    </div> 
                </form>
            </div>   
    </div>  
    <?php
        $user=$_SESSION['user'];
    ?>
    <!-- footer -->
        <?php
            include('../../includes/footer.php');
        ?>
    <!-- end footer -->
</div>

    <!-- Javascript links here -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/myJquery.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    


</body>
</html>
