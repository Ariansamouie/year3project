<?php
session_start();
include("db.php");
include( 'functions.php');
checklogin();
$title = "Send";
include("header.php");
include("profilenav.php"); 
?>


<div class="newmess">

	<h1> Friends</h1>

</div>


<div>



<?php
if(isset($_GET['user']) && !empty($_GET['user'])){
?>

	<form method='post'>
	<?php
	if(isset($_POST['message']) && !empty($_POST['message'])){
		$my_id = $_SESSION['user_id'];
		$user = $_GET['user'];
		$random_number = rand();
		$message = $_POST['message'];

		$check_con = mysqli_query($con,"SELECT `hash` FROM `message_group` WHERE (`user_one`='$my_id' AND `user_two`='$user') OR (`user_one`='$user' AND `user_two`='$my_id')");

		if(mysqli_num_rows($check_con) == 1){
			echo "<p>Conversation Already stared</p>";
		} 

		else{
			mysqli_query("INSERT INTO message_group VALUES('$my_id', '$user', '$random_number')");
			mysqli_query("INSERT INTO messages VALUES('', '$random_number', '$my_id', '$message')");
			echo "<p>Conversation Started</p>";
		} 
	
	}

	?>


	Enter Message: <br/>
	<textarea name='message' rows='7' cols='30'>  </textarea>
	<br/><br/>
	<input type='submit' value="Send Message"/> 
	</form>


<?php
}else{	

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
		echo "<a href='send.php?user=$user' class='box'>$username</a>";
	}

	/*while($run_user = mysqli_fetch_array($user_list)){
		$user = $run_user['id'];
		$username = $run_user['username'];

		echo "<p><a href='send.php?user=$user'>$username</a></p>";
	}*/
}
?>

</div>

	<?php 
	include("footer.php");
	?>

	