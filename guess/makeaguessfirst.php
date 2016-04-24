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
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 available">
                <h3>Pick a Match</h3>
	    </div>
    </div>

    <div class="row">   
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 available">
                <div class="game">


                <?php // SELECT * tbl_fixtures ORDER BY Date DESC - this is where your loop neeeds to start 

                $result2 = mysqli_query($con,"SELECT * FROM fixtures WHERE fixture_date >= DATE (NOW()) ORDER BY fixture_date ASC") 
                or die(mysqli_error());  

                // keeps getting the next row until there are no more to get
                while($row2 = mysqli_fetch_array( $result2 )) {

                $fixtureID1 = $row2['team1_id'];
                $fixtureID2 =  $row2['team2_id'];

                ?>


                <a href="makeaguessfirstchooce.php?TeamID1=<?php echo $fixtureID1;?>&TeamID2=<?php echo $fixtureID2;?>&FixtureID=<?php echo $row2['id']?>">
                <button type="button">

                <?php

                    $result = mysqli_query($con,"SELECT * FROM teams WHERE id = $fixtureID1") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    $row = mysqli_fetch_array( $result );
        

                    $result1 = mysqli_query($con,"SELECT * FROM teams WHERE id = $fixtureID2") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    $row1 = mysqli_fetch_array( $result1 )

                ?> 
                <div class="teamchoose teamleft">
                 <p><span><?php echo $row["team_name"]; ?></span> 
                 </p>
                 </div>

                <div class="vsother"> vs </div> 

                 <div class="teamchoose teamright">
                 <p><span><?php echo $row1["team_name"]; ?></span></p> 
                 </div>

                

                </button></a>

                <?php } ?>

                </div>
	    </div>
    </div>
   

    	

	<?php 
	include("footer.php");
	?>

	