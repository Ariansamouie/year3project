<?php
session_start();
include( 'db.php');
include( 'functions.php');


$action = $_GET['action'];
$user = $_GET['user'];
$my_id = $_SESSION['user_id'];


if($action == 'send'){
	mysqli_query($con,"INSERT INTO frnd_req VALUES('', '$my_id', '$user')");
}

if($action == 'cancel'){
	mysqli_query($con,"DELETE FROM `frnd_req` WHERE `from`='$my_id' AND `to`='$user'");
}


if($action == 'accept'){
	mysqli_query($con,"DELETE FROM `frnd_req` WHERE `from`='$user' AND `to`='$my_id'");
	mysqli_query($con,"INSERT INTO frnds VALUES('', '$user', '$my_id')");
}

if($action == 'unfriend'){
	mysqli_query($con,"DELETE FROM frnds WHERE (user_one='$my_id' AND user_two='$user') OR(user_one='$user' AND user_two='$my_id')");
}

if ($action == 'ignorerequest') {
	mysqli_query($con,"DELETE FROM `frnd_req` WHERE `to` = '$my_id'");
	header('location: req.php');
	die;
}


header('location: profile.php?user='.$user);

?>

