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
</div>
</body>
</html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
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
<div id="vivacard" class="container-fluid" >



    <!--- Main body start
    <section class="main-container">
        <h2 style="text-transform: uppercase"><?php echo $row['firstname']; ?>'s card</h2>
--->
        <div class='card' style="margin-top: 150px; margin-left: 550px">

            <img  class='top-image' src='vivacarduploads/esha.JPG' alt="user photo" title="user photo">
            <p style="text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Name: </font></em> </strong><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></p>

            <p style="text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Company: </font></em> </strong> <?php echo $row['company']; ?></p>

            <p style="text-transform: uppercase"><strong ><em> <font size="4.5"; color="teal">  Job Tilte: </font></em> </strong> <?php echo $row['jobtitle']; ?></p>

            <!--<a href="my_details.php"><img class='bottom-image' src='assets/Images/smartcard.png' alt="QR code" title="QR code"></a> -->
            <div class="qr-field">

                <center>
                    <div  style="margin-left: 70%; ">
                        <?php echo '<img src="img/cw-qr.png" style="width:150px; height:150px; "><br>'; ?>
                    </div>


                    <!--  <a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="download.php?file=<?/*php echo $filename; */?>.png ">Download QR Code</a>-->


                </center>
            </div>
            <br>

<a style="border-style: solid" id="btn-Convert-Html2Image" href="#">Download</a>
<br/>




<script style="margin-top: 150px; margin-left: 350px">
    $(document).ready(function(){


        var element = $("#vivacard"); // global variable
        var getCanvas; // global variable

        $("#btn-Convert-Html2Image").on('click', function () {
            html2canvas(element, {
                onrendered: function (canvas) {

                    getCanvas = canvas;

                }

            });
        });

        $("#btn-Convert-Html2Image").on('click', function () {
            var imgageData = getCanvas.toDataURL("image/png");
            // Now browser starts downloading it instead of just showing it
    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
    $image= newData;
    file_put_contents('/img/image.png', $image);
        });

    });

</script>
</body>
</html>