<?php
session_start();
include("db.php");
include( 'functions.php');
checklogin();

    $title = "Guess";
    include("header.php");
    include("profilenav.php");
    ?>

    <div class="row height">   
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrap fullscreen">

    <div class="row">   
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 makeaguess">

	    <form action="createguess.php" method='POST'>

                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">

                <input type="hidden" name="fixture_id" value="<?php echo $_GET['FixtureID'];?>">

                <input type="hidden" name="created_guesses_id" value="<?php echo $_GET['created_guesses_id'];?>">

                <input type="hidden" name="notify" value="<?php echo $_GET['notify'];?>">

<!-- get first scorer ids -->


    
                <?php

                if ($_GET['notify'] == 1) {

                    $result1 = mysqli_query($con,"SELECT first_scorer FROM guesses WHERE created_guesses_id = ".$_GET['created_guesses_id']."") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    while($row1 = mysqli_fetch_array( $result1 )) {
                        $player_picked = $player_picked.",".$row1['first_scorer'];
                        
                    } 

                    $player_picked = substr($player_picked, 1);


                    //     players picked
                     //echo $player_picked;

                }
                ?>


                <select name="player_id">
                <?php

                if ($_GET['notify'] == 1) {

                    $result = mysqli_query($con,"SELECT * FROM players WHERE player_id NOT IN(".$player_picked.") AND team_id = ".$_GET['TeamID1']." ORDER BY team_id ASC") 
                    or die(mysqli_error());  

                } else{     

                    $result = mysqli_query($con,"SELECT * FROM players WHERE team_id = ".$_GET['TeamID1']." ORDER BY team_id ASC") 
                    or die(mysqli_error());

                }


                     $result2 = mysqli_query($con,"SELECT team_name FROM teams WHERE id = ".$_GET['TeamID1']."") 
                    or die(mysqli_error()); 

                     $row2 = mysqli_fetch_array( $result2 );

                     ?>

                     <optgroup label="<?php echo $row2['team_name'];?>">

                     <?php

                    // keeps getting the next row until there are no more to get
                    while($row = mysqli_fetch_array( $result )) {
                        // Print out the contents of each row into a table
                        echo "<option value='" . $row["player_id"]. "'>" . $row["name"]. "</option>"; 
                    } 

                ?>
                    </optgroup>



                <?php

                    if ($_GET['notify'] == 1) {

                    $result3 = mysqli_query($con,"SELECT * FROM players WHERE player_id NOT IN(".$player_picked.") AND team_id = ".$_GET['TeamID2']." ORDER BY team_id ASC") 
                    or die(mysqli_error());  

                } else {

                    $result3 = mysqli_query($con,"SELECT * FROM players WHERE team_id = ".$_GET['TeamID2']." ORDER BY team_id ASC") 
                    or die(mysqli_error());

                }

                     $result4 = mysqli_query($con,"SELECT team_name FROM teams WHERE id = ".$_GET['TeamID2']."") 
                    or die(mysqli_error()); 

                     $row3 = mysqli_fetch_array( $result4 );

                     ?>

                     <optgroup label="<?php echo $row3['team_name'];?>">

                     <?php

                    // keeps getting the next row until there are no more to get
                    while($row4 = mysqli_fetch_array( $result3 )) {
                        // Print out the contents of each row into a table
                        echo "<option value='" . $row4["player_id"]. "'>" . $row4["name"]. "</option>"; 
                    } 

                ?>
                    </optgroup>

                </select>
                    
        <input class="submit width" type='submit' value='Send'>

        </form>
	    </div>
    </div>
    	</div>
    </div>
	<?php 
	include("footer.php");
	?>

	