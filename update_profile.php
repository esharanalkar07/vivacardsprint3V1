<?php
require 'config.php';

if (isset($_SESSION['username']))
{

    if(isset($_POST['update'])) {
    $errMsg = '';

    // Get data from the parameters below
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $jobtitle = $_POST['jobtitle'];
    $company = $_POST['company'];
    $job_desc = $_POST['job_desc'];
    $telephone = $_POST['telephone'];
    $linkedin = $_POST['linkedin'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $facebook= $_POST['facebook'];


  /*  if($password != $c_password)
        $errMsg = 'Password not matched.'; */

    if($errMsg == '') {
        try {
            $sql = "UPDATE user_profile SET firstname = :firstname, lastname = :lastname, email = :email, jobtitle =:jobtitle, company= :company, job_desc=:job_desc, telephone=:telephone, linkedin=:linkedin, twitter=:twitter, instagram=:instagram, facebook= :facebook WHERE username = :username";  // add the extra variable list here
            $stmt = $connect->prepare($sql);
            $stmt->execute(array(
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':email' => $email,
                ':username' => $_SESSION['username'],
                /* ':password' => $password,*/
                ':jobtitle' => $jobtitle,
                ':company' => $company,
                ':job_desc' => $job_desc,
                ':telephone' => $telephone,
                ':linkedin' => $linkedin,
                ':twitter' => $twitter,
                ':instagram' => $instagram,
                ':facebook' => $facebook,

            ));
            header('Location: update_profile1.php?action=updated');
            //  exit;

            /// add a refresh code here so that new changes are displayed on the same page
        } catch (PDOException $e) {
            $errMsg = $e->getMessage();
        }

    }
    }
}

/*if(isset($_GET['action']) && $_GET['action'] == 'updated')
        $errMsg = 'Profile updated. <a href="qrcode.php">Generate QR Code</a>'; */ /// if refresh code added successfully remove (comment out) this part
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Update Profile</title>
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
        ?>
        <section class="main-container">
        <div style="background-color:grey; color:#FFFFFF; padding:10px;"><b><?php echo $_SESSION['firstname'] ?></b></div>
        <fieldset style="margin: 15px">
            <fieldset>


            <form class="signup-form" action="" method="post">
                Firstname <br>
                <input type="text" name="firstname" value="<?php echo $_SESSION['firstname']; ?>" autocomplete="off" class="box"/><br /><br />
                Lastname <br>
                <input type="text" name="lastname" value="<?php echo $_SESSION['lastname']; ?>" autocomplete="off" class="box"/><br /><br />
                Email <br>
                <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" autocomplete="off" class="box"/><br /><br />
                Username <br>
               <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" disabled autocomplete="off" class="box"/><br /><br />
                Job Title <br>
                <input type="text" name="jobtitle" value="<?php echo $_SESSION['jobtitle']; ?>"autocomplete="off" class="box"/><br /><br />
                Company <br>
                <input type="text" name="company" value="<?php echo $_SESSION['company']; ?>"  autocomplete="off" class="box"/><br /><br />
                Job Description <br>
                <input type="text" name="job_desc"  value="<?php echo $_SESSION['job_desc']; ?>" autocomplete="off" class="box"/><br /><br />
                Telephone <br>
                <input type="int" name="telephone"  value="<?php echo $_SESSION['telephone']; ?>"autocomplete="off" class="box"/><br /><br />
                Linkedin <br>
                <input type="url" name="linkedin" value="<?php echo $_SESSION['linkedin']; ?>" autocomplete="off" class="box"/><br /><br />
                Twitter <br>
                <input type="url" name="twitter" value="<?php echo $_SESSION['twitter']; ?>" autocomplete="off" class="box"/><br /><br />
                Instagram <br>
                <input type="url" name="instagram" value="<?php echo $_SESSION['instagram']; ?>" autocomplete="off" class="box"/><br /><br />
                Facebook <br>
                <input type="url" name="facebook" value="<?php echo $_SESSION['facebook']; ?>"  autocomplete="off" class="box"/><br /><br />


                <input type="submit" name='update' value="Update" class='submit'/><br />
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
