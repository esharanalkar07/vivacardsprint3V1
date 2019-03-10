<?php
include 'config.php';

$username = $_SESSION['username'];
$sql = "SELECT * FROM user_profile  WHERE username = :username";

$stmt1 = $connect->prepare($sql);
$stmt1->bindValue(':username', $username);

    $stmt1->execute();

$row = $stmt1->fetch(PDO::FETCH_ASSOC);

if($row['username'] > 0 ) {


    foreach ($connect->query($sql) as $row);
    }
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>User Profile</title>
    <link rel="stylesheet" href="assets/css/colours.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


</head>

<body>
<!--- Header --->
<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="active navbar-brand" href="index.php">VIVA CARD</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="dashboard.php">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Support</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

        </div>
    </nav>
</header>
<!--- Header End--->
<div align="center">
    <div style=" border: solid black; background-color: lightgray" align="left">

        <h2 style="text-align: center; text-transform: uppercase"><strong><font size="5"; color="teal"> <?php echo $row['firstname']; ?>'s Details</h2></strong></font>

        <fieldset style="margin: 15px">
            <fieldset>


                <form style="text-align: left; " class="signup-form" action="generateQR.php" method="post"  ">
                <p style="border-style: groove ; text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Name: </font></em> </strong><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></p>
                <p style="border-style: groove ;text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Email: </font></em> </strong> <?php echo $row['email']; ?></p>
                <p style="border-style: groove ;text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Username: </font></em> </strong> <?php echo $row['username']; ?></p>
                <p style="border-style: groove ;text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Job Tilte: </font></em> </strong> <?php echo $row['jobtitle']; ?></p>
                <p style="border-style: groove ;text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Company: </font></em> </strong> <?php echo $row['company']; ?></p>
                <p style="border-style: groove ;text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Job Description: </font></em> </strong> <?php echo $row['job_desc']; ?></p>
                <p style="border-style: groove ;text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Telephone: </font></em> </strong> <?php echo $row['telephone']; ?></p>
                <p style="border-style: groove ;text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Linkedin: </font></em> </strong> <?php echo $row['linkedin']; ?></p>
                <p style="border-style: groove ;text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Twitter: </font></em> </strong> <?php echo $row['twitter']; ?></p>
                <p style="border-style: groove ;text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Instagram: </font></em> </strong> <?php echo $row['instagram']; ?></p>
                <p style="border-style: groove ;text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Facebook: </font></em> </strong> <?php echo $row['facebook']; ?></p>
                <button type="submit">Generate Card </button>
                </form>
            </fieldset>
    </div>
</div>
</section>
</div>
<!---Footer start--->
<div class="container-fluid text-center">
    <footer class=“col-md-12">
        <div class=‘row'>
            <section class="col-md-2">
                <a href="#"><h6>Meet the team</h6></a>
            </section>
            <section class="col-md-2">
                <a href="#"><h6>Privacy</h6></a>
            </section>
            <section class="col-md-2">
                <a href="#"><h6>Sitemap</h6></a>
            </section>
            <section class="col-md-2">
                <a href="#"><h6>Complaints</h6></a>
            </section>
            <section class="col-md-2">
                <a href="#"><h6>User Policy</h6></a>
            </section>
            <section class="col-md-2">
                <address>
                    <a href="mailto:groupe_cmm004@live.rgu.ac.uk"><h6>Contact Information</h6></a>
                </address>
            </section>
            <address>
                <h6><center>Visit us at<br>
                        Robert Gordon University, Garthdee House,<br>
                        Garthdee Road, Aberdeen, AB10 7QB, Scotland,<br>
                        UK<br>
                        <a href="mailto:groupe_cmm004@live.rgu.ac.uk">
                            <img src="assets/Images/email.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                        <a href="#">
                            <img src="assets/Images/facebook.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                        <a href="#">
                            <img src="assets/Images/twitter.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                        <a href="#">
                            <img src="assets/Images/github.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                    </center> </h6>
            </address>
        </div>
    </footer>
</div>
<!---Footer end--->
</body>
</html>