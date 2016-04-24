<?php
session_start();
include("db.php");

foreach($_POST['friend_list'] as $item){


	$my_id = mysqli_real_escape_string($con,$_SESSION['user_id']);
	$created_guesses_id = mysqli_real_escape_string($con,$_POST['created_guesses_id']);
	$friend_id = mysqli_real_escape_string($con,$item);


	$createguess = $con->prepare("INSERT INTO notifications(user_from,user_to, created_guesses_id) VALUES (?, ?, ?)");

 $createguess->bind_param('iii',$my_id,$friend_id,$created_guesses_id);
 $createguess->execute();
 $createguess->close();

}

header("location:lobby.php?created_guesses_id=$created_guesses_id");



?>