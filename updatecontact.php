<?php
require 'config.php';


 $selsql = "SELECT * FROM `user_profile` WHERE id=?";



 
 if(isset($_POST) & !empty($_POST)){
 	$sql = "UPDATE user_profile SET firstname=:firstname, lastname=:lastname, email=:email, jobtitle=:jobtitle, company=:company, job_desc=:job_desc, telephone=:telephone, linkedin=:linkedin, twitter=:twitter, instagram=:instagram, facebook=:facebook WHERE id=:id";
	$result = $connect->prepare($sql);
	$res = $result->execute(array(':firstname' 	=> $_POST['firstname'],
									':lastname' 	=> $_POST['lastname'],
									'email' 		=> $_POST['email'],
									'jobtitle' 		=> $_POST['jobtitle'],
									'company' 			=> $_POST['company'],
                                     ':job_desc' 	=> $_POST['job_desc'],
                                    'telephone' 		=> $_POST['telephone'],
                                     'linkedin' 		=> $_POST['linkedin'],
                                     'twitter' 			=> $_POST['twitter'],
                                     'instagram' 		=> $_POST['instagram'],
                                     'facebook' 			=> $_POST['facebook'],
									'id' 			=> $_GET['id']
									));

	 if($res){
	 	echo " Contact details successfully updated, <a href='viewcontact.php'>View</a> ";
	 }else{
	 	echo " Contact update failed. Try again";
	 }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Update contact</title>
    <link rel="stylesheet" href="assets/css/colours.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
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
<div class="container">
    <div style="background-color:grey; color:#FFFFFF; padding:10px;"><h3>Update Contacts</h3></div>
    <div style="margin: 15px">
	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3">
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">First Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="firstname"  class="form-control" id="input1" value="<?php echo $r['firstname'] ?>" placeholder="First Name" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Last Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="lastname"  class="form-control" id="input1" value="<?php echo $r['lastname'] ?>" placeholder="Last Name" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">E-Mail</label>
			    <div class="col-sm-10">
			      <input type="email" name="email"  class="form-control" id="input1" value="<?php echo $r['email'] ?>" placeholder="E-Mail" />
			    </div>
			</div>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Job Title</label>
                <div class="col-sm-10">
                    <input type="text" name="jobtitle"  class="form-control" id="input1" value="<?php echo $r['jobtitle'] ?>" placeholder="Job Title" />
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Company</label>
                <div class="col-sm-10">
                    <input type="text" name="company"  class="form-control" id="input1" value="<?php echo $r['company'] ?>" placeholder="Company" />
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Job Desc</label>
                <div class="col-sm-10">
                    <input type="text" name="job_desc"  class="form-control" id="input1" value="<?php echo $r['job_desc'] ?>" placeholder="Job Desc" />
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Telephone</label>
                <div class="col-sm-10">
                    <input type="number" name="telephone"  class="form-control" id="input1" value="<?php echo $r['telephone'] ?>" placeholder="Telephone" />
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Linkedin</label>
                <div class="col-sm-10">
                    <input type="url" name="linkedin"  class="form-control" id="input1" value="<?php echo $r['linkedin'] ?>" placeholder="Linkedin" />
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Twitter</label>
                <div class="col-sm-10">
                    <input type="url" name="twitter"  class="form-control" id="input1" value="<?php echo $r['twitter'] ?>" placeholder="Twitter" />
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Instagram</label>
                <div class="col-sm-10">
                    <input type="url" name="instagram"  class="form-control" id="input1" value="<?php echo $r['instagram'] ?>" placeholder="Instagram" />
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Facebook</label>
                <div class="col-sm-10">
                    <input type="url" name="facebook"  class="form-control" id="input1" value="<?php echo $r['facebook'] ?>" placeholder="Facebook" />
                </div>
            </div>

			<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Update" />
		</form>
	</div>
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