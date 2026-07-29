<?php
    require('../includes/conn.inc.php');
    include('../includes/functions.inc.php');
    $_SESSION['successCreate'] = 0;

    //get values to be inputted

        //main details
        $eventTitle = $_POST['eventTitle'];
        $Details = $_POST['Details'];
        $price = $_POST['price'];
        $capacity = $_POST['maxCap'];
        $adminNotes= $_POST['adminNotes'];
        
        if($eventTitle ==""){
            $_SESSION['createError'] = 1;
        }
        elseif($Details ==""){
            $_SESSION['createError'] = 2;
        }
        elseif($capacity ==""){
            $_SESSION['createError'] = 3;
        }   
            
        //Image
        $imgLink = $_POST['imgLink'];

        $imgAlt = $_POST['imgAlt'];
        if($imgLink!=""  && $imgAlt ==""){
            $_SESSION['createError'] = 4;
        }

        $imgUp = $_POST['imgUp'];
        if($imgLink!="" && $imgAlt !="" && $imgUp==""){
            $_SESSION['createError'] = 5;
        }
        else{
        //if file upload= not blank
        $target_dir = "../images/events/";
        $target_file = basename($_FILES["imgUp"]["name"]);
        $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["imgUp"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $_SESSION['createError'] = 6;
                        $uploadOk = 0;
                    }
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['createError'] = 6;
                $uploadOk = 0;
            }
            //check file upload matches Imagename
            if(($imgLink != $target_file)||($imgLink=="" && $target_file !="")){
                $_SESSION['createError'] = 6;
                $uploadOk = 1;
            }
        }
        //Date and Time
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            if($startDate =="" || $endDate="" ){
                $_SESSION['createError'] = 7;
            }

        //Location
            $onlineRadio = $_POST['online'];
            
            if ($onlineRadio == 'online') {
                $locID = 1;
                $online=1;
            }
            else if ($onlineRadio == 'notOnline') {

                $venueSelect = $_POST['locations'];
                $online=0;
                
                if($venueSelect = "other"){
                    $venueName = $_POST['venue'];
                    $address1 = $_POST['address_Line1'];
                    $address2 = $_POST['address_Line2'];
                    $city = $_POST['city'];
                    $postcode = $_POST['postcode'];
                    $county = $_POST['county'];
                    $country = $_POST['country'];
                    $venueValue= substr($venueName,20);
                    $campus = $_POST['campus'];

                    //add to venue table, then add to locations table
                    $newVenue="INSERT INTO venue (venueName, venueValue, venueName, campus,address_line1, address_line2,
                    city, postcode,county,country)
                    VALUES(:venueName, :venueValue, :venueName, :campus, :address1, :address2,
                    :city, :postcode, :county, :country)";
                    $stmt = $pdo->prepare($newVenue);
                    $stmt->bindParam(":venueValue", $venueValue, PDO::PARAM_STR);
                    $stmt->bindParam(":venueName", $venueName, PDO::PARAM_STR);
                    $stmt->bindParam(":campus", $campus, PDO::PARAM_STR);
                    $stmt->bindParam(":address1", $address1, PDO::PARAM_STR);
                    $stmt->bindParam(":address2", $address2, PDO::PARAM_STR);
                    $stmt->bindParam(":city", $city, PDO::PARAM_STR);
                    $stmt->bindParam(":postcode", $postcode, PDO::PARAM_STR);
                    $stmt->bindParam(":county", $county, PDO::PARAM_STR);
                    $stmt->bindParam(":country", $country, PDO::PARAM_STR);
                    $stmt->execute();

                    //get venue ID
                    $sql="SELECT * FROM venue WHERE venueValue=$venueName ";
                    $venID=$pdo->query($sql);
                    $row =$venID->fetchObject();

                    $venueID=$row->venueID;
                    $room = NULL;
                    $buildingID=NULL;
                    //add to locations table
                    $newLocation="INSERT INTO locations(room,buildingID,VenueID)
                    VALUES(:room, :buildingID, :VenueID)";
                    $locStmt = $pdo->prepare($locStmt);
                    $stmt->bindParam(":room", $room, PDO::PARAM_STR);
                    $stmt->bindParam(":buidingID", $buidingID, PDO::PARAM_INT);
                    $stmt->bindParam(":venueID", $venueID, PDO::PARAM_INT);
                    $stmt->execute();

                    //get locID
                    $sql="SELECT locID FROM locations WHERE room==$room AND buildingID ==$buildingID AND venueID==$venueID ";
                    $venID=$pdo->query($sql);
                    $row =$venID->fetchObject();
                    $locID = $row->locID;
                }
                else{
                    //add venueDI based on selection.
                    $sql="SELECT * FROM venue WHERE venueValue=$venueSelect ";
                    $venID=$pdo->query($sql);
                    $row =$venID->fetchObject();
                    $venueID=$row->venueID;

                    $building = $_POST['building'];
                    //lookup building ID
                    $sqls="SELECT * FROM building WHERE venueName=$building ";
                    $buildID=$pdo->query($sqls);
                    $row =$buildID->fetchObject();
                    $buildingID=$row->buildingID;

                    $room = $_POST['room'];

                    //add to location, then add to locations table
                    $newLocation="INSERT INTO locations(room,buildingID,VenueID)
                    VALUES(:room, :buildingID, :VenueID)";
                    $locStmt = $pdo->prepare($locStmt);
                    $stmt->bindParam(":room", $room, PDO::PARAM_STR);
                    $stmt->bindParam(":buidingID", $buidingID, PDO::PARAM_INT);
                    $stmt->bindParam(":venueID", $venueID, PDO::PARAM_INT);
                    $stmt->execute();

                    //get locID
                    $sql="SELECT locID FROM locations WHERE room==$room AND buildingID ==$buildingID AND venueID==$venueID ";
                    $venID=$pdo->query($sql);
                    $row =$venID->fetchObject();
                    $locID = $row->locID;
                }  
            }
    
     //insert statment      
    $createNewEvent ="INSERT INTO events(eventTitle, Details, imageLink, imgAltTxt,start,end,online,locID,adminNotes,price,userID,maxCapacity)
                      VALUES(:eventTitle, :Details, :imageLink, :imgAltTxt,:starts,:ends,:online,:locID,:adminNotes,:price,:userID,:maxCapacity)";
    //prepare and bindparameters
    $stmt=$pdo->prepare($createNewEvent);
    $stmt->bindParam(":eventTitle", $eventTitle, PDO::PARAM_STR);
    $stmt->bindParam(":Details", $Details, PDO::PARAM_STR);
    $stmt->bindParam(":imageLink", $imgLink, PDO::PARAM_STR);
    $stmt->bindParam(":imgAltTxt", $imgAlt, PDO::PARAM_STR);
    $stmt->bindParam(":starts", $startDate, PDO::PARAM_STR);
    $stmt->bindParam(":ends", $endDate, PDO::PARAM_STR);
    $stmt->bindParam(":online", $online, PDO::PARAM_INT);
    $stmt->bindParam(":locID", $locID, PDO::PARAM_INT);
    $stmt->bindParam(":adminNotes", $adminNotes, PDO::PARAM_STR);
    $stmt->bindParam(":price", $price, PDO::PARAM_STR);
    $stmt->bindParam(":userID", $user, PDO::PARAM_INT);
    $stmt->bindParam(":maxCapacity", $capacity, PDO::PARAM_STR);     

    $stmt->execute();
 
    $_SESSION['successCreate'] = 1;

    if($_SESSION["successCreate"] == 1){
 
        $referer = "members_area/admin.php";
        header("Location: ../".$referer); 
    }

?>