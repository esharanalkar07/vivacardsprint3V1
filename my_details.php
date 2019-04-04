<?php
// include QR_BarCode class
include "QR_BarCode.php";

//// Selecting from Database
include_once 'config.php';
$username = $_SESSION['username']; ///Verifying the logged in user
$sql = "SELECT * FROM user_profile  WHERE username = :username";
$stmt1 = $connect->prepare($sql);
$stmt1->bindValue(':username', $username);

$stmt1->execute();

$row = $stmt1->fetch(PDO::FETCH_ASSOC);

if($row['username'] > 0 ) {


    foreach ($connect->query($sql) as $row);
}


if(isset($errMsg)){
    echo '<div style="color:green;text-align:center;font-size:17px;">'.$errMsg.'</div>';
}


$tempDir = 'temp/';
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$email = $row['email'];
$jobtitle = $row['jobtitle'];
$company = $row['company'];
$job_desc = $row['job_desc'];
$telephone = $row['telephone'];
$linkedin = $row['linkedin'];
$twitter = $row['twitter'];
$instagram = $row['instagram'];
$facebook= $row['facebook'];


?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Your profile</title>
    <link rel="stylesheet" href="assets/css/colours.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/card.css">
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
    <div style=" border: solid 1px #006D9C; " align="left">
        <?php
        if(isset($errMsg)){
            echo '<div style="color:green;text-align:center;font-size:17px;">'.$errMsg.'</div>';
        }
        $sql="SELECT * FROM user_profile";
        $result = $connect->query($sql);
        ?>

        <!--- Main body start --->
        <section class="main-container">
            <h2 style="text-transform: uppercase"><?php echo $row['firstname']; ?>'s card</h2>
            <!-- Insert info into page from database --->

            <div class='card'>


                <img class='top-image' src='vivacarduploads/esha.JPG' alt="user photo" title="user photo" ">


                 <p class="logo">VIVA CARD</p>

                <p><?php echo $row['firstname']; ?>  <?php echo $row['lastname']; ?></p>

                <p><?php echo $row['company']; ?></p>

                <p><?php echo $row['jobtitle']; ?></p>

                <p><?php echo $row['telephone']; ?></p>

                <p><a href="mailto:<?php echo $row['email']?>;">
                        <img src="assets/Images/email.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>

                    <a href="<?php echo $row['linkedin']; ?>">
                        <img src="assets/Images/linkedin.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>

                    <a href="<?php echo $row['twitter']; ?>">
                        <img src="assets/Images/twitter.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>

                    <a href="<?php echo $row['instagram']; ?>"><p></p>
                <img src="assets/Images/instagram.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>

                <a href="<?php echo $row['facebook']; ?>">
                    <img src="assets/Images/facebook.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a></p>



            </div>


    </div>







    <!--- Main body end --->
    <!---       <section class="main-container">
            <fieldset style="margin: 15px">
                <fieldset>
                    <form class="signup-form" action="" method="get">
                        Firstname <br>
                        <input type="text" name="firstname" value="<?php echo $_SESSION['firstname']; ?>" class="box" readonly/><br /><br />
                        Lastname <br>
                        <input type="text" name="lastname" value="<?php echo $_SESSION['lastname']; ?>" class="box" readonly/><br /><br />
                        Email <br>
                        <a href="mailto:<?php echo $_SESSION['email']; ?>"><input type="email" name="email" value="<?php echo $_SESSION['email']; ?>"  class="box" readonly/></a><br /><br />
                        Job Title <br>
                        <input type="text" name="jobtitle" value="<?php echo $_SESSION['jobtitle']; ?>" class="box" readonly/><br /><br />
                        Company <br>
                        <input type="text" name="company" value="<?php echo $_SESSION['company']; ?>" class="box" readonly/><br /><br />
                        Job Description <br>
                        <input type="text" name="job_desc"  value="<?php echo $_SESSION['job_desc']; ?>" class="box" readonly/><br /><br />
                        Telephone <br>
                        <input type="int" name="telephone"  value="<?php echo $_SESSION['telephone']; ?>" class="box" readonly/><br /><br />
                        Linkedin <br>
                        <a href="?php echo $_SESSION['linkedin']; ?>"><input type="url" name="linkedin" value="<?php echo $_SESSION['linkedin']; ?>" class="box" readonly/></a><br /><br />
                        Twitter <br>
                        <a href="<?php echo $_SESSION['twitter']; ?>"></a><input type="url" name="twitter" value="<?php echo $_SESSION['twitter']; ?>" class="box" readonly/></a><br /><br />
                        Instagram <br>
                        <a href="<?php echo $_SESSION['instagram']; ?>" ><input type="url" name="instagram" value="<?php echo $_SESSION['instagram']; ?>" class="box" readonly/></a><br /><br />
                        Facebook <br>
                        <a href="<?php echo $_SESSION['facebook']; ?>"><input type="url" name="facebook" value="<?php echo $_SESSION['facebook']; ?>" class="box" readonly/></a><br /><br />
                    </form>
                </fieldset>
    </div>
</div>
</section>
</div>   --->
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