<?php
require 'config.php';
if(empty($_SESSION['firstname']))
    header('Location: login.php');



    // Get data from the parameters below
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email = $_SESSION['email'];
    $jobtitle = $_SESSION['jobtitle'];
    $company = $_SESSION['company'];
    $job_desc = $_SESSION['job_desc'];
    $telephone = $_SESSION['telephone'];
    $linkedin = $_SESSION['linkedin'];
    $twitter = $_SESSION['twitter'];
    $instagram = $_SESSION['instagram'];
    $facebook= $_SESSION['facebook'];


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
        <section class="main-container">
            <div style="background-color:grey; color:#FFFFFF; padding:10px;"><b><?php echo $_SESSION['firstname'] ?> <?php echo $_SESSION['lastname'] ?> </b></div>
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
