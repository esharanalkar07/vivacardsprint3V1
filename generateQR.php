<?php
// include QR_BarCode class

include "QR_BarCode.php";

//// Selecting from Database
include_once 'config.php';
$username = $_SESSION['username'];
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

// QR_BarCode object
$qr = new QR_BarCode();


// create content QR code
$qr->content("$firstname",
    "$lastname",
    "$email",
    "$jobtitle",
    "$company",
    "$job_desc",
    "$telephone",
    "$linkedin",
    "$twitter",
    "$instagram",
    "$facebook" );

// display QR code image
$qr->qrCode();

// save QR code image

/// Should save a new image for new user >>>> need to check later
$qr->qrCode(500,'img/cw-qr.png');

header('Location: viewcard.php');
?>