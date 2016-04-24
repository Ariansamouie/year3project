<?php
include("db.php");
include( 'functions.php');


// find unparsed fixtures before current date
$result = mysqli_query($con,"SELECT * FROM `fixtures` WHERE `fixture_date` < CURDATE() AND `parsed` = 0") 
                or die(mysqli_error());  

while ($row = mysqli_fetch_assoc($result)) {
	

// find original created guesses against this fixture
		$result1 = mysqli_query($con,"SELECT * FROM created_guesses WHERE fixture_id = '".$row['id']."' ") 
		                or die(mysqli_error()); 

		while ($row1 = mysqli_fetch_assoc($result1)) {

				// find all guesses against the created guess
				$result2 = mysqli_query($con,"SELECT * FROM guesses WHERE created_guesses_id = '".$row1['id']."' AND first_scorer = '".$row['first_scorer']."'") 
		                or die(mysqli_error()); 

				while ($row2 = mysqli_fetch_assoc($result2)) {


						// update scores of users who guessed
						$result3 = mysqli_query($con,"SELECT * FROM users WHERE id = '".$row1['user_id']."' ") 
				                or die(mysqli_error()); 

						while ($row3 = mysqli_fetch_assoc($result3)) {

							mysqli_query($con,"UPDATE `users` SET `user_score` = `user_score` + 10 WHERE id = '".$row3['id']."'") 
                   			 or die(mysqli_error()); 

						}

				}

		}

// update fixture parsed to equal 1
mysqli_query($con,"UPDATE `fixtures` SET `parsed` = 1 WHERE id = '".$row['id']."'") 
                    or die(mysqli_error());  


}


header( 'location: input.php' );

?>