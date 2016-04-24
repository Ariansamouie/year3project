<?php
session_start();
include("db.php");
include( 'functions.php');
checklogin();
 $title = "edit";

if (isset($_GET['user']) && !empty($_GET['user'])){
	$user = $_GET['user'];
} else {
	$user = $_SESSION['user_id'];
}

$my_id = $_SESSION['user_id'];
$username = getuser($user, 'username');
$firstname = getuser($user, 'firstname');
$lastname = getuser($user, 'lastname');


include("header.php");     
include("profilenav.php");
?>

    <div class="row editpage">

        <form action='profile.php' method='POST'>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
            
            <div class="edittext"><p>Team:</p></div>
            <div class="edittext"><p>First Name:</p></div>
            <div class="edittext"><p>Surname:</p></div>


        </div>


        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 edit">

                    <?php
                    $getusername = mysqli_query($con,"SELECT * FROM users WHERE id = $my_id");
                    $content = mysqli_fetch_array($getusername);
                    ?>

				

                    <select name="supported_team">

                        <?php
                            $pick = mysqli_query($con,"SELECT * FROM teams ORDER BY team_name ASC") 
                            or die(mysqli_error());  

                            // keeps getting the next row until there are no more to get
                            while($row = mysqli_fetch_array( $pick )) {
                                // Print out the contents of each row into a table
                                echo "<option value='" . $row['id']. "'".($content['supported_team'] == $row['id'] ? 'selected' : ''). ">" .$row["team_name"]."</option>";
                            } 
                        ?>
                    </select>

                    <input class="width" type='text' value="<?php echo $content['firstname']; ?>" name='firstname' placeholder="First Name">
                    <input class="width" type='text' value="<?php echo $content['lastname']; ?>" name='lastname' placeholder="Last Name">
                   
                

        </div>
                 <input class="submit editsub" type='submit' value='Save'>
            </form>
    </div>
<?php 
include("footer.php");
?>
