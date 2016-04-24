<?php
session_start();
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
    <?php include("db.php");?>

  </head>
<body>

        <div id="loginh1">
            <h1>Guess That</h1>
        </div>

        <div id="createerror">
            <?php
            if (isset($_SESSION['form_error'])) echo '<p class="error">'.$_SESSION['form_error'].'</p>';
            unset($_SESSION['form_error']);
            ?>
        </div>

        <div class="login">
            <div id="loginput" class="logincreate">
                <form action='create_process.php' method='POST'>
                    <input class="width" type='text' name='firstname' placeholder="First Name" required>
                    <input class="width" type='text' name='lastname' placeholder="Last Name" required>
                    <input class="width" type='text' name='username' placeholder="Username" required>
                    <input class="width" type='password' name='password' placeholder="Password" required>
                    <input class="width" type='email' name='email' placeholder="Email" required>
                    <select name="supported_team" required>
                        <?php
                            $pick = mysqli_query($con,"SELECT * FROM teams ORDER BY team_name ASC") 
                            or die(mysqli_error());  

                            // keeps getting the next row until there are no more to get
                            while($row = mysqli_fetch_array( $pick )) {
                                // Print out the contents of each row into a table
                                echo "<option value='" . $row["id"]. "' >" . $row["team_name"]. " </option>";
                            } 
                        ?>
                    </select>
                    <input class="submit" type='submit' value='Create Account'>
                </form>
            </div>
        </div>

        <div id="accbutton">
                <div class="forgotbutton"><a href="login.php">Back to Login</a></div>
        </div>



</body>
</html>