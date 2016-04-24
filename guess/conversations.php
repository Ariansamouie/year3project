<?php
include( 'db.php');
include( 'functions.php');
checklogin();
$title = "Conversations";


$my_id = mysqli_escape_string($con,$_SESSION['user_id']);
$hash = ((isset($_GET['hash']) && ! empty($_GET['hash'])) ? $_GET['hash'] : '' );

/**
 * Post new message
 */
if(isset($_POST['message']) && !empty($_POST['message'])){
	$new_message = $_POST['message'];
	mysqli_query("INSERT INTO messages VALUES('', '$hash', '$my_id', '$new_message')");
	header('location: conversations.php?hash='.$hash.'#message');
}
include("header.php");
include("profilenav.php"); 
?>
<div class="show"> 

<h1>Messages</h1>
	<?php
	include("message_title_bar.php"); 
	?>



<div class="messages">
<?php
if(isset($_GET['hash']) && !empty($_GET['hash'])){
	$message_query = mysqli_query($con,"SELECT from_id, message FROM messages WHERE group_hash='$hash'");
	while($run_message = mysqli_fetch_array($message_query)){
		$from_id = $run_message['from_id'];
		$message = $run_message['message'];

		$user_query = mysqli_query($con,"SELECT username FROM users WHERE id='$from_id'");
		$run_user = mysqli_fetch_array($user_query);
		$from_username = $run_user['username'];

		echo "<p><b>$from_username</b><br/>$message</p>";
	}
?>

	<div class="sendbox">
		<form method='post'>
			<div class="area"><textarea class="buttontext" name='message' rows='3' cols='29' id="message"></textarea></div>

			<input type='submit' value="Send" class="button"/>
		</form>
	</div>


<?php

} else{
	$get_con = mysqli_query($con,"SELECT `hash`, `user_one`, `user_two`  FROM message_group WHERE user_one='$my_id' OR user_two='$my_id'");
	while ($run_con = mysqli_fetch_array($get_con)) {
		$hash = $run_con['hash'];
		$user_one = $run_con['user_one'];
		$user_two = $run_con['user_two'];

		if($user_one == $my_id){
			$select_id = $user_two;
		}else{
			$select_id = $user_one;
		}

			$user_get = mysqli_query($con,"SELECT username FROM users WHERE id='$select_id'");
			$run_user = mysqli_fetch_array($user_get);
			$select_username = $run_user['username'];

		echo "<div><a href='conversations.php?hash=$hash#message' class='box'>$select_username</a></div>";
	}
}

?>
</div>
</div>
<?php 
include("footer.php");
?>

	