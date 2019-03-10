<?php
require 'config.php';

if(isset($error)){ echo $error; } /// figure out later (check)
 
 $sql = "SELECT * FROM user_profile"; // filter out user list as per your added contacts - SPRINT 3
 $result = $connect->query($sql);
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>View contacts</title>
    <link rel="stylesheet" href="assets/css/colours.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
<!--- Header --->   <!--- Header --->
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
    <div style=" border: solid 1px #006D9C; " align="center">
        <?php
        if(isset($errMsg)){
            echo '<div style="color:green;text-align:center;font-size:17px;">'.$errMsg.'</div>';
        }
        ?>
        <section class="main-container">
            <div style="background-color:grey; color:#FFFFFF; padding:10px;"><h3>View Contacts</h3></div>
            <div style="margin: 15px">
<div class="container">
	<div class="row">
		<table class="table">
			<tr>
				<th>Id</th>
				<th>Full Name</th>
				<th>E-Mail</th>
				<th>Job Title</th>
				<th>Company</th>
                <th>Job Desc</th>
                <th>Telephone</th>
                <th>Linkedin</th>
                <th>Twitter</th>
                <th>Instagram</th>
                <th>Facebook</th>
				<th>Manage</th>
            </tr>
			<?php 
			while($r = $result->fetch(PDO::FETCH_ASSOC)){
			?>
			<tr>
				<td><?php echo $r['id']; ?></td>
				<td><?php echo $r['firstname'] . " " . $r['lastname']; ?></td>
				<td><?php echo $r['email']; ?></td>
				<td><?php echo $r['jobtitle']; ?></td>
				<td><?php echo $r['company']; ?></td>
                <td><?php echo $r['job_desc']; ?></td>
                <td><?php echo $r['telephone']; ?></td>
                <td><?php echo $r['linkedin']; ?></td>
                <td><?php echo $r['twitter']; ?></td>
                <td><?php echo $r['instagram']; ?></td>
                <td><?php echo $r['facebook']; ?></td>
				<td><a href="updatecontact.php?id=<?php echo $r['id']; ?>">Edit</a> <a href="deletecontact.php?id=<?php echo $r['id']; ?>">Delete</a></td>
			</tr>
			<?php } ?>
		</table>
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