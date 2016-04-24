<?php
include( 'db.php');


if (isset($_POST['delete_fixture'])) {
	$delfix = $_POST['id'];

	mysqli_query("DELETE FROM `fixtures` WHERE `id` = '$delfix'");
	header('location:input.php');
	die;
}






?>