<?php
require 'config.php';

if(isset($_POST['register'])) {
    $errMsg = '';

    // Get data from FROM
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

   /* $jobtitle = $_POST['jobtitle'];
    $company = $_POST['company'];
    $job_desc = $_POST['job_desc'];
    $telephone = $_POST['telephone'];
    $linkedin = $_POST['linkedin'];
    $twitter= $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $facebook= $_POST['facebook'];*/

    if($firstname == '')
        $errMsg = 'Enter firstname';
    if($lastname == '')
        $errMsg = 'Enter lastname';
   if($email == '')
        $errMsg = 'Enter email';
   if($username == '')
        $errMsg = 'Enter username';
    if($password == '')
        $errMsg = 'Enter password';
    if($c_password == '')
    $errMsg = 'Confirm password';

    if($password != $c_password)
    $errMsg = 'Password not matched.';



    if($errMsg == ''){

        $sql = "SELECT COUNT(username) AS num FROM user_profile WHERE username = :username";
        $stmt1 = $connect->prepare($sql);
        $stmt1->bindValue(':username', $username);

        $stmt1->execute();

          $row = $stmt1->fetch(PDO::FETCH_ASSOC);

        if($row['num'] > 0) {

             die('Username Already Exists !!!');

             }

        }


            try {
                $stmt = $connect->prepare('INSERT INTO user_profile (firstname, lastname, email, username, password )VALUES (:firstname, :lastname, :email, :username, :password)');
                $stmt->execute(array(
                    ':firstname' => $firstname,
                    ':lastname' => $lastname,
                    ':email' => $email,
                    ':username' => $username,
                    ':password' => $password,


                    /*':jobtitle' => $jobtitle,
                    ':company' => $company,
                    ':job_desc' => $job_desc,
                    ':telephone' => $telephone,
                    ':linkedin' => $linkedin,
                    ':twitter' => $twitter,
                    ':instagram' => $instagram,
                    ':facebook' => $facebook */

                ));
                header('Location: register.php?action=joined');
                exit;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }


}

if(isset($_GET['action']) && $_GET['action'] == 'joined') {
    $errMsg = 'Account created. Now you can <a href="login.php">Sign in</a>';
}

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Create account</title>
    <link rel="stylesheet" href="assets/css/colours.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


</head>

<body>
<div class="container-fluid">

    <!--- Header --->
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="active navbar-brand" href="#">VIVA CARD</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
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
		<div style=" border: solid 1px #006D9C; " align="center">
			<?php
				if(isset($errMsg)){
					echo '<div style="color:green;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
            <section class="main-container">
			<div style="background-color:grey; color:#FFFFFF; padding:10px;"><h3>Create account</h3></div>
			<div style="margin: 15px">
				<form class="signup-form" action="" method="post">
                    <input type="text" name="firstname" required="required" placeholder="First name" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="text" name="lastname" required="required" placeholder="Last name" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="email" name="email" required="required" placeholder="E-mail" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="text" name="username" required="required" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="password" name="password" required="required" maxlength="20" placeholder="Password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="password" name="c_password" required="required" maxlength="20" placeholder=" Confirm Password" value="<?php if(isset($_POST['c_password'])) echo $_POST['c_password'] ?>" autocomplete="off" class="box"/><br /><br />


                 <!--  <input type="text" name="jobtitle" placeholder="Job Title" value=" <?php /*if(isset($_POST['jobtitle'])) echo $_POST['jobtitle'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="text" name="company" placeholder="Company" value="<?php if(isset($_POST['company'])) echo $_POST['company'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="text" name="job_desc" placeholder="Job Desc" value="<?php if(isset($_POST['job_desc'])) echo $_POST['job_desc'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="number" name="telephone" placeholder="Telephone" value="<?php if(isset($_POST['telephone'])) echo $_POST['telephone'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="url" name="linkedin" placeholder="Linkedin" value="<?php if(isset($_POST['linkedin'])) echo $_POST['linkedin'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="url" name="instagram" placeholder="Instagram" value="<?php if(isset($_POST['instagram'])) echo $_POST['instagram'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="url" name="twitter" placeholder="Twitter" value="<?php if(isset($_POST['twitter'])) echo $_POST['twitter'] ?>" autocomplete="off" class="box"/><br /><br />
                    <input type="url" name="facebook" placeholder="Facebook" value="<?php if(isset($_POST['facebook'])) echo $_POST['facebook'] */?>" autocomplete="off" class="box"/><br /><br /> -->


					<input type="submit" name='register' value="Register" class='submit'>
				</form>
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
