<?php
session_start();


$username = $_POST['username'];
$password = sha1($_POST['password']);


if($username&&$password){

include("db.php");


    $query = mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
    $numrows = mysqli_num_rows ($query);

    if ($numrows!=0){
        $_SESSION['login'] = true;

        while ($row = mysqli_fetch_assoc($query)){
            $dbusername = $row['username'];
            $dbpassword = $row['password'];
            $userid = $row['id'];
        }
        //check to see if they match
        if ($username==$dbusername&&$password==$dbpassword){
            $_SESSION['user_id'] = $userid;
            header("location:home.php");
        }
        else

            header("location:incorrect.php");
    }
    else
        header("location:incorrect.php");

}

else
    header("location:incorrect.php");

?>