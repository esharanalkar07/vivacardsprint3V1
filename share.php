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
$password = $row['password']
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Your Card</title>
    <link rel="stylesheet" href="assets/css/colours.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/card.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


</head>
<body>
<div class="container-fluid">

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


    <?php
    if(isset($_POST['submit'])){
        require('PHPMailer/src/PHPMailer.php');
        require("PHPMailer/src/SMTP.php");
        $mail = new PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP
        $mail->AddEmbeddedImage("img/cw-qr.png","qr");
        $from = $_POST['from_email']; // this is the sender's Email address
        $to = $_POST['to_email'];
        $subject = $_POST['subject'];
        $message = '<p>Scan me</p> <img src="cid:-qr">';
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = $email;
        $mail->Password = $password;
        $mail->SetFrom($from);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AddAddress($to);
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message has been sent";
            header("Location: ./viewcard.php");
        }
        //$from = $_POST['from_email']; // this is the sender's Email address
        //$subject = $_POST['subject'];
        //$message = " <p>Hello</p>";
        //$headers = "MIME-Version: 1.0" . "\n";
        //$headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
        //$headers = "From:" . $from;
        //mail($to,$subject,$message,$headers);
    }
    ?>

    <HTML>
    <title>Form</title>
    <body>
    <center>
        <form action="" method="post">
            To Email: <br>
            <input type="text" name="to_email"><br>
            From Email: <br>
            <input type="text" name="from_email"><br>
            Subject: <br>
            <input type="text" name="subject"><br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </center>
    </body>
    </HTML>


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