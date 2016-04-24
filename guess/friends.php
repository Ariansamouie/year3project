<?php
session_start();
include("db.php");
include( 'functions.php');
checklogin();
?>

	<?php 
    $title = "Home";
    include("header.php");
    ?>

    <div class="row">   
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    	<?php

	    	$my_id = $_SESSION['user_id'];
	    	$frnd_query = mysqli_query($con,"SELECT user_one, user_two FROM frnds WHERE user_one='$my_id' OR user_two='$my_id'");
	    	while($run_frnd = mysqli_fetch_array($frnd_query)){
	    		$user_one = $run_frnd['user_one'];
	    		$user_two = $run_frnd['user_two'];
	    		if($user_one == $my_id){
	    			$user = $user_two;
	    		} else {
	    			$user = $user_one;
	    		}
	    		$username = getuser($user, 'username');
	    		echo "<a href='profile.php?user=$user' class='box'>$username</a>";
	    	}
	    	?>
	    </div>
    </div>




	<?php 
	include("footer.php");
	?>