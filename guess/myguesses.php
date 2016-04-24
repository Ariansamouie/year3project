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
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 available">
	    	 <div class="game">


                        <?php // SELECT * tbl_fixtures ORDER BY Date DESC - this is where your loop neeeds to start 

                        $result2 = mysqli_query($con,"SELECT * FROM fixtures WHERE fixture_date <= DATE (NOW()) ORDER BY fixture_date DESC") 
                        or die(mysqli_error());  

                        // keeps getting the next row until there are no more to get
                        while($row2 = mysqli_fetch_array( $result2 )) {

                        $fixtureID1 = $row2['team1_id'];
                        $fixtureID2 =  $row2['team2_id'];
                        $scorehome =  $row2['team1_score'];
                        $scoreaway =  $row2['team2_score'];

                        ?>

                        <!-- this needs fixing -->
                <?php

                    $resultscroe1 = mysqli_query($con,"SELECT * FROM fixtures WHERE id = $scorehome") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    $row3 = mysqli_fetch_array( $resultscroe1 )
            
                ?>  

                		<!-- this needs fixing -->
                <?php

                    $resultscroe2 = mysqli_query($con,"SELECT * FROM fixtures WHERE id = $scoreaway") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    $row4 = mysqli_fetch_array( $resultscroe2 )
            
                ?>  

                <?php

                    $result = mysqli_query($con,"SELECT * FROM teams WHERE id = $fixtureID1") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    $row = mysqli_fetch_array( $result )
            
                ?>  

                <?php

                    $result1 = mysqli_query($con,"SELECT * FROM teams WHERE id = $fixtureID2") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    $row1 = mysqli_fetch_array( $result1 )

                ?> 





                <div class="onefixture">
	                <div class="teamchoose teamleft teamfixold">
	                	<h3><span><?php echo $row["team_name"]; ?></span></h3>
	                </div>

	                <div class="scorefixtureold">
	                	<span><?php echo $row3["team1_score"]; ?></span>
	                </div>

	                <div class="vsold"> <h2>vs</h2> </div> 

	                <div class="scorefixtureold">
	                	<span><?php echo $row4["team2_score"]; ?></span>
	                </div>

	                <div class="teamchoose teamright teamfixold">
	                	<h3><span><?php echo $row1["team_name"]; ?></span></h3> 
	                </div>

	                

                 </div>


                <?php } ?>

                </div>




	    </div>
    </div>




	<?php 
	include("footer.php");
	?>

	