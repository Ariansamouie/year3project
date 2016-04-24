<?php
session_start();
include("db.php");
include( 'functions.php');
checklogin();
$title = "Requests";
include("header.php");
?>

    
<?php
include("profilenav.php");   
?>

	<div class="row">   
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    	<div class="show">

	    	<h3>Requests:</h3>

	    	<?php

	    	$my_id = $_SESSION['user_id'];
	    	$req_query = mysqli_query($con,"SELECT `from` FROM `frnd_req` WHERE `to`='$my_id'");

	    	while($run_req = mysqli_fetch_array($req_query)){
	    		$from = $run_req['from'];
	    		$from_username = getuser($from, 'username');
	    		echo "<a href='profile.php?user=$from' class='box'>$from_username</a>";
	    	}

	    	?>
	    	</div>
	    </div>
	</div>
	
	<?php 
	include("footer.php");
	?>

	