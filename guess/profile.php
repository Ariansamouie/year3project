<?php
session_start();
include("db.php");
include( 'functions.php');

checklogin();
 $title = "Profile";


if (isset($_GET['user']) && !empty($_GET['user'])){
	$user = $_GET['user'];
} else {
	$user = $_SESSION['user_id'];
}

$my_id = $_SESSION['user_id'];
$supported_team = getuser($user, 'supported_team');
$username = getuser($user, 'username');
$firstname = getuser($user, 'firstname');
$lastname = getuser($user, 'lastname');


if (isset($_POST['supported_team'])) {
		$support_change = $_POST['supported_team'];

		mysqli_query($con,"UPDATE `users` SET `supported_team` = '{$support_change}' WHERE `id` = '{$my_id}'");
		header('location:profile.php');
} else{

}

if (isset($_POST['firstname'])) {
		$change_firtsname = $_POST['firstname'];

		mysqli_query($con,"UPDATE `users` SET `firstname` = '{$change_firtsname}' WHERE `id` = '{$my_id}'");
		header('location:profile.php');
} else{

}

if (isset($_POST['lastname'])) {
		$change_lastname = $_POST['lastname'];

		mysqli_query($con,"UPDATE `users` SET `lastname` = '{$change_lastname}' WHERE `id` = '{$my_id}'");
		header('location:profile.php');
} else{

}

include("header.php");     
include("profilenav.php");


$selectscore = mysqli_query($con,"SELECT * FROM users WHERE username = '".$username."'") or die(mysqli_error()); 

	$rowscore = mysqli_fetch_array($selectscore);
	$userscore = $rowscore['user_score'];


$selectedteam = mysqli_query($con,"SELECT * FROM teams WHERE id = ".$supported_team."") or die(mysqli_error());  

        $row = mysqli_fetch_array($selectedteam);

?>


<div class="row">   
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 show">
		
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 propic">
	    	<img src="pictures/<?php echo $row['images'];?>">
	    </div>


<a href="score.php">score</a>


	    <?php
	    if($user != $my_id){
	    	$check_frnd_query = mysqli_query($con,"SELECT id FROM  frnds WHERE (user_one='$my_id' AND user_two='$user') OR (user_one='$user' AND user_two='$my_id')");
	    	if(mysqli_num_rows($check_frnd_query) == 1){
	    		echo "
	    				<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 request'>
	    				
	    		<a href='actions.php?action=unfriend&user=$user' class=''><i class='fa fa-star'></i><p>Unfriend</p></a></div>";
	    	} else{ 
	    		$from_query = mysqli_query($con,"SELECT `id` FROM `frnd_req` WHERE `from`='$user' AND `to`='$my_id'");
	    		$to_query = mysqli_query($con,"SELECT `id` FROM `frnd_req` WHERE `from`='$my_id' AND `to`='$user'");

	    		if(mysqli_num_rows($from_query) == 1){
	    			echo "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 request'><a href='action.php?action=ignorerequest&user=$user' class=''>Ignore</a></div> 

	    				<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 request'><a href='action.php?action=accept&user=$user' class=''>Accept</a></div>";
	    		} else if(mysqli_num_rows($to_query) == 1){
	    			echo "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 request'><a href='action.php?action=cancel&user=$user' class=' '><i class='fa fa-star-half-o'></i></a></div>";
	    		} else{
	    			echo "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 request'><a href='action.php?action=send&user=$user' class=''><i class='fa fa-star-o'></i></a></div>";
	    		}
	    	}
	    }








	    ?>

	    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<h3><?php echo $firstname; ?></h3>
			<h3><?php echo $lastname; ?></h3>
	    </div>

	    
	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	    	<h4><?php echo $username; ?></h4>
	    </div>

	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 score">
	    	<h4>Score - <?php echo $userscore; ?></h4>
	    </div>











</div>
</div>


<?php 
include("footer.php");
?>

	