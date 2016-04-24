<?php

$conn = mysqli_connect("10.169.0.9","alloistu_guess","guess123$","alloistu_guess");
mysqli_select_db("alloistu_guess",$conn) or die ("Couldn't find db");

if (!empty($_POST['password']) && ! empty($_POST['confirm_password'])) {

    extract($_POST);

    if ($password !== $confirm_password) die('The passwords do not match.');

    $password = sha1($password);

    $sql = "UPDATE `users` SET `password` = '{$password}' WHERE `reset` = '{$reset_hash}'";
    if (!mysqli_query($sql)) die(mysqli_error());

    header('location: login.php');

}

die('You need to enter a new password! :@');