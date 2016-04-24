<?php

include("db.php");

if (isset($_POST['email']) && !empty($_POST['email'])) {

    $reset_hash = sha1(uniqid(mt_rand()));

    $email = $_POST['email'];

    $sql = mysqli_query($con,"SELECT `username`, `email` FROM `users` WHERE `email` = '{$email}'");

    if (mysqli_num_rows($sql) == 0) die('User not found');

    $user = mysqli_fetch_assoc($sql);

    $sql = "UPDATE `users` SET `reset` = '{$reset_hash}' WHERE `email` = '{$email}'";
    if (!mysqli_query($sql)) die('Could not update db =>' . mysqli_error());

    $username = $user['username'];

    $to = $user['email'];
    $subject = 'Password Reset';
    $message = "Your username is: {$username} \n\nPlease click the link below to reset your password:\n\n<a href=\"http://ehustudent.co.uk/cis2115-group1/reset_password.php?reset={$reset_hash}\">Reset Password</a>";
//    $from = 'FROM: accounts@scorchedkiln.com';

    if(!mail($to, $subject, $message)) {
        die('Could not send email.');
    }

}

header('Location: login.php');


?>

