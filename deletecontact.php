<?php
try{
	require_once('config.php');
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
	$error = $e->getMessage();
}

 $DelSql = "DELETE FROM `user_profile` WHERE id=?";
 $result = $connect->prepare($DelSql);
 $res = $result->execute(array($_GET['id']));
 if($res){
 	header('location: viewcontact.php');
 }else{
 	echo "Failed to Delete Contact";
 }
?>