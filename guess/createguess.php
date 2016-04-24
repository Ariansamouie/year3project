<?php
session_start();
include("db.php");

$last_id = 0;
if ($_POST['notify'] == 1) {

// This guess has come from notification page

 $result3 = mysqli_query($con,"SELECT * FROM created_guesses WHERE id = ".$_POST['created_guesses_id']."") 
                    or die(mysqli_error());  

        $row3 = mysqli_fetch_array($result3);

                       

    // inset a guess for this user also
    $guess3 = "INSERT INTO guesses SET user_id=".$_POST['user_id'].", created_guesses_id = ".$row3['id'].", first_scorer = ".$_POST['player_id']."";

	if ($con->query($guess3) === TRUE) {
	 //   echo "Record updated successfully";

	} else {
	    echo "Error updating record: " . $con->error;
	}

	//update notificationstatus

	$guess7 = "UPDATE notifications SET notification_status = 1 WHERE created_guesses_id = ".$row3['id']."";

	if ($con->query($guess7) === TRUE) {
	 //   echo "Record updated successfully";

	} else {
	    echo "Error updating record: " . $con->error;
	}

	header("location:lobby.php?created_guesses_id=".$_POST['created_guesses_id']."");

} else{

//  This is a new guess and creates a new lobby (created guesses)
$createguess = $con->prepare("INSERT INTO created_guesses(user_id,fixture_id) VALUES (?, ?)");

 $createguess->bind_param('ii',$_POST['user_id'],$_POST['fixture_id']);
 $createguess->execute();
 $createguess->close();

 $result = mysqli_query($con,"SELECT id AS last_id FROM created_guesses ORDER BY id DESC") 
                    or die(mysqli_error());  

        $row = mysqli_fetch_array($result);
                       

    // inset a guess for this user also
    $guess = "INSERT INTO guesses SET user_id=".$_POST['user_id'].", created_guesses_id = ".$row['last_id'].", first_scorer = ".$_POST['player_id']."";

	if ($con->query($guess) === TRUE) {
	 //   echo "Record updated successfully";

	} else {
	    echo "Error updating record: " . $con->error;
	}


}


$title = "Guess";
include("header.php");
?>

<?php
// if you created the guess
if ($_POST['notify'] != 1) {
?>



Which friends?


				<form method="post" action="sendnot.php">

                <?php


                $my_id = $_SESSION['user_id'];

	    		$frnd_query = mysqli_query($con,"SELECT user_one, user_two FROM frnds WHERE user_one='$my_id' OR user_two='$my_id'");

	    		while($run_frnd = mysqli_fetch_assoc($frnd_query)){
	    			
	    			$user_one = $run_frnd['user_one'];
	    			$user_two = $run_frnd['user_two'];

		    		if($user_one == $my_id){
		    			$user = $user_two;
		    		} else {
		    			$user = $user_one;
		    		}

		    		$query1 = mysqli_query($con,"SELECT username FROM users WHERE id='$user'");
					$run = mysqli_fetch_assoc($query1);
					$username = $run['username'];
	    		// $username = getuser($user, 'username');

	    		echo "<div class='box'> $username<div class='pull-right'>

	    		<input type='checkbox' class='choosbox' id='friend_list[$user]' name='friend_list[$user]' value='$user'></div></div> ";
	    		
	    		}

                ?>
              
            	<input type="hidden" name="created_guesses_id" value="<?php echo $row['last_id']; ?>">
                <input class="submit width" type='submit' value='Next'>

                </form>


<?php } ?>

<?php 
	include("footer.php");
?>
