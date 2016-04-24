<?php
session_start();

function checkLogin( $loginRequired = true ){
    if ( !isset( $_SESSION['login']) && $loginRequired === true){
        header( 'location: home.php?loggedIn=no' );
    }
}



function getuser($id, $field) {
	global $con;
	$querystring = "SELECT $field FROM users WHERE id='$id'";
	$query = mysqli_query($con,$querystring);
	$run = mysqli_fetch_array($query);
	return $run[$field];
}



