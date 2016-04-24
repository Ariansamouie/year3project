<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ERROR);
include( 'functions.php');

if (isset($_POST['team_name'])) {
    $team_name =$_POST['team_name'];
  
    mysqli_query("INSERT INTO teams(team_name) VALUES('$team_name') ") 
    or die(mysqli_error());

    header( 'location: input.php' );

}    

if (isset($_POST['team1_id'])) {
    $team1_id =$_POST['team1_id'];
    $team2_id =$_POST['team2_id'];
    $fixture_date =$_POST['fixture_date'];
  
    mysqli_query("INSERT INTO fixtures(team1_id, team2_id, fixture_date) VALUES('$team1_id', '$team2_id', '$fixture_date') ") 
    or die(mysqli_error());

    header( 'location: input.php' );

}    


if (isset($_POST['team_id'])) {
    $team_id = $_POST['team_id'];
    $name = $_POST['name']; 
    $player_number = $_POST['player_number']; 

    mysqli_query("INSERT INTO players(name, team_id,player_number) VALUES('$name', '$team_id', '$player_number') ") 
    or die(mysqli_error());


    header( 'location: input.php' );
}    








?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- jquery link -->
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Guess That Login</title>
  </head>

<body>

        <div class="hold">

        <div id="loginh1">
            <h1>Add Team</h1>
        </div>

        <div class="login smaller">
            <div id="loginput" class="logincreate">

                <form action='input.php' method='POST'>
                    <input class="width team" type='text' name='team_name' placeholder="Team">
                
                <input class="submit width" type='submit' value='Send'>
                </form>
            </div>
        </div>

        <div id="loginh1">
            <h1 class="moving">Add Player</h1>
        </div>

        <div class="">

                <form action='input.php' method='POST'>
                <select name="team_id">
                <?php

                    $result55 = mysqli_query($con,"SELECT * FROM teams ORDER BY team_name ASC") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    while($row12 = mysqli_fetch_array( $result55 )) {
                        // Print out the contents of each row into a table
                        echo "<option value='" . $row12["id"]. "'>" . $row12["team_name"]. " </option>"; 

                    } 


                ?>
        
                </select>
                    <input class='width moving' type='text' name='player_number' placeholder='number'>
                    <input class='width' type='text' name='name' placeholder='Player'>
                    <input class="submit width" type='submit' value='Send'>
                </form>

        </div>

        <div id="accbutton">

                <div class="forgotbutton"><a href="http://alloistudio.me.uk.gridhosted.co.uk/guess/home.php" target="blank">Login</a></div>

        </div>

        </div>

        <div class="hold">
        <div id="loginh1">
            <h1>View Players</h1>
        </div>
        
        <div class="login">
        <div id="loginput" class="logincreate">
        
        <select id="Player_id" name="Player_id">
            <?php
            $player_id = mysqli_query($con,"SELECT * FROM teams ORDER BY team_name ASC") 
                    or die(mysqli_error());  

                   
                    // keeps getting the next row until there are no more to get
                    while($row = mysqli_fetch_array( $player_id )) {
                        // Print out the contents of each row into a table
                        echo "<option value='" . $row["id"]. "'>" . $row["team_name"]. "</option>"; 
                    } 
            ?>
        </select>
        <!-- <input class="submit width" type='submit' value='Send'> -->
        <div id="resultsbox"></div>
        
        </div>
        </div>
        </div>

        <div class="hold">

        <div id="loginh1">

            <h1>Add Game</h1>

        </div>



        <div class="login smaller">

            <div id="loginput" class="logincreate">

                <form action='input.php' name="team1_id" method='POST'>

                    <input class="width" type='date' name='fixture_date' placeholder="Date">

                    <input class="width" type='text' name='team1_id' placeholder="Team Home ID">

                    <input class="width" type='text' name='team2_id' placeholder="Team Away ID">

              

                    <input class="submit width" type='submit' value='Send'>

                </form>

            </div>

        </div>

        <div id="loginh1">

            <h1 class="moving">Teams</h1>

        </div>
        

        <div class="login">

        <div id="loginput" class="logincreate">

        

            <?php
            $player_id = mysqli_query($con,"SELECT * FROM teams ORDER BY team_name ASC") 
                    or die(mysqli_error());  

                    
                    // keeps getting the next row until there are no more to get
                    while($row = mysqli_fetch_array( $player_id )) {
                        // Print out the contents of each row into a table
                         echo "<option value='" . $row["id"]. "'>" . $row["id"]. " " . $row["team_name"]. "</option>"; 
                    } 

            ?>

        
        </div>
        </div>
        </div>



















<?php

if (isset($_POST['player_id'])) {


    mysqli_query($con,"UPDATE `fixtures` SET `team1_score` = '".$_POST['home_team']."', `team2_score` = '".$_POST['away_team']."' , `first_scorer` = '".$_POST['player_id']."' WHERE id = '".$_POST['id']."'") 
                    or die(mysqli_error());  

    echo "Updated";

    
} else {

}

?>
         <div class="hold fix">
        <div id="loginh1">
            <h1>Fixtures</h1>
        </div>
        <div class="fixtures">


                <?php // SELECT * tbl_fixtures ORDER BY Date DESC - this is where your loop starts 

                $result2 = mysqli_query($con,"SELECT * FROM fixtures WHERE fixture_date >= DATE (NOW()) ORDER BY fixture_date ASC") 
                or die(mysqli_error());  

                // keeps getting the next row until there are no more to get
                while($row2 = mysqli_fetch_array( $result2 )) {

                $fixtureID1 = $row2['team1_id'];
                $fixtureID2 =  $row2['team2_id'];

                ?>


                <form action="input.php" name="update" method="POST">

                <?php

                    $result = mysqli_query($con,"SELECT * FROM teams WHERE id = $fixtureID1") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    $row4 = mysqli_fetch_array( $result )
            
                ?>  

                 <?php

                    $result1 = mysqli_query($con,"SELECT * FROM teams WHERE id = $fixtureID2") 
                    or die(mysqli_error());  

                    // keeps getting the next row until there are no more to get
                    $row1 = mysqli_fetch_array( $result1 )

                ?> 
                <div class="teamchoose teamleft">
                    <p><span><?php echo $row4["team_name"]; ?></span></p> 
                    <input class="score" type="text" name="home_team">
                </div>

                <div class="vsother"> vs </div> 

                <div class="teamchoose teamright">
                    <input class="score" type="text" name="away_team">
                    <p><span><?php echo $row1["team_name"]; ?></span></p> 
                </div>

                <!-- this needs fixing -->
                <select name="player_id">
                <?php


                    $resultfix = mysqli_query($con,"SELECT * FROM players WHERE team_id = $fixtureID1 OR team_id = $fixtureID2 ORDER BY team_id ASC") 
                    or die(mysqli_error());  

     
                    while($rowfix = mysqli_fetch_array( $resultfix )) {

                        echo "<option value='" . $rowfix["player_id"]. "' name='first'>" . $rowfix["name"]. "</option>"; 
                    } 



                ?>
                </select>


                <input type="hidden" value="<?php echo $row2["id"]; ?>" name="id">

                <?php } ?>


                <input type="submit" class="fixcolbutt" value="updatescorer">
               


                </form>



<a href="parse.php"><button>Update Points</button></a>








              

        </div>


        </div>










































<script type="text/javascript">
$( document ).ready(function() {
// this starts the page with a team already selected
        
        $("#resultsbox").html('');

        $.ajax({
            type: "POST",
            url: "playerlist.php",
            data: 'selectedteam=1',
            success: function(data) {
                $("#resultsbox").html(data);
            }
        });

// changes when selected team changes

    $("#Player_id").change(function(){
      var selectedteam = $(this).children("option:selected").attr("value");

        $("#resultsbox").html('');

        $.ajax({
            type: "POST",
            url: "playerlist.php",
            data: 'selectedteam=' + selectedteam,
            success: function(data) {
                $("#resultsbox").html(data);
            }
        });
    });

});
</script>



</body>

</html>