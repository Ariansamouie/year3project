<?php
include("db.php");
$selectedteam = mysqli_query($con,"SELECT * FROM players WHERE team_id = ".$_POST['selectedteam']." ORDER BY name ASC") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    while($row = mysqli_fetch_array( $selectedteam )) {
                        // Print out the contents of each row into a table
                        $playerlist = $playerlist."<div class='playerlistname'>" .$row["player_number"]." - " .$row["name"]."</div>"; 
                    } 

                    echo $playerlist;
?>