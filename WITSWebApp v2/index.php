<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Hallam Women In Tech Society</title>

  <!-- links and includes-->
  <link href="css/mobile.css" rel="stylesheet"/>
  <link href="css/desktop.css" rel="stylesheet" media="only screen and (min-width : 720px)"/>
  <link href="css/bootstrap/bootstrap-grid.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

</head>

<body>
<div class="container">

    <!--  Navigation Bar  -->
    <?php
            include('includes/outerNavbar.php');
            //Navbar when not logged in.
        ?>
    <!-- end navigation bar -->
    <div class="title">
            <h1>Sheffield Hallam Women in Tech Society</h1>
    </div>
    <!-- main content -->
    <div class="mainContent">
    <div class="section1">
            <h2>About Us</h2>
            <p class="text1">
                The Sheffield Hallam Women in Tech Society, has been recently reformed as part of Hallam Student's Union in 2017.
                <br><br>
                The purpose of the society is to provide opportunities for women studying at Hallam on technical courses, to socialise, network and promote opportunities to support each other. 
                This includes attending conferences, entering competitions, organising trips, and much more. 
               </p>

            <img id="about1" alt="Photo of Sheffield at Night overlooking city campus" src="images/sheffieldNight.jpeg">


            <p class="text2">
                The society also looks at ways to increase participation and recruitment levels for women on technical courses, including working alongside local schools, colleges, and charities to further this aim.
                <br><br>
                Our Society is open to anyone (regardless of gender) who supports women in technology, and the aim of increasing their representation in technical industries.
                <br><br><br>
            </p>
        </div>
        </div>
    <!-- footer -->
        <?php
            include('includes/footer.php');
        ?>
    <!-- end footer -->
   
</div>

    <!-- Javascript links here -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
