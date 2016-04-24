<?php
include("db.php");

$_POST['password'] = sha1($_POST['password']);

$sql = mysqli_query($con,"SELECT `email` FROM `users` WHERE `email` = '{$_POST['email']}'") or die(mysqli_error());
if (mysqli_num_rows($sql) == 1) {

    @session_start();
    $_SESSION['form_error'] = 'That Email address is already in use.';
    header('location: create.php');
    exit;

}

$sql = mysqli_query($con,"SELECT `username` FROM `users` WHERE `username` = '{$_POST['username']}'") or die(mysqli_error());
if (mysqli_num_rows($sql) == 1) {

    @session_start();
    $_SESSION['form_error'] = 'That username is already taken.';
    header('location: create.php');
    exit;

}


$fields = '`' . implode('`, `', array_keys($_POST)) . '`';
$values = "'" . implode("', '", $_POST) . "'";

$sql = "INSERT INTO `users` ({$fields}) VALUES ($values)";

$sql = mysqli_query($con,$sql) or die('Could not create user.');

header('Location: index.php');


?>