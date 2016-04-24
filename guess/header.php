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
     <link href='https://fonts.googleapis.com/css?family=Chewy' rel='stylesheet' type='text/css'>
    <!-- jquery link -->
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
   
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title><?php echo "Guess That - ".$title; ?></title>
  </head>


<body class="bodyin">

        <div class="row headpos">   
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 headpos">
        		<nav>
        			<ul>
                		<li><a href="home.php" ><i class="fa fa-home"></i></a></li>
                        <li><a href="profile.php" ><i class="fa fa-user"></i></i></i></a></li>
                        <li><a href="notifications.php" ><i id="notif" class="fa fa-dot-circle-o"></i></i></a></li> 
                        <li><a href="makeaguessfirst.php" ><i class="fa fa-futbol-o"></i></i></a></li>
                        <li><a href="members.php" ><i class="fa fa-users"></i></i></a></li>
                        <li><a href="leaderboard.php" ><i class="fa fa-bar-chart"></i></i></a></li>
                        <li><a id="logout" href="logout.php"><i class="fa fa-sign-out"></i></a></li>	
                    </ul>
                </nav>
            </div>
        </div>
       
  
<?php include("db1.php"); ?>


<?php 

    $results = mysqli_query($con,"SELECT * FROM notifications WHERE user_to = ".$_SESSION['user_id']." AND notification_status = 0")  or die(mysqli_error());  
        

    ($rowsnot = mysqli_fetch_array($results)); 



    if ($rowsnot < 1) { ?>

        
<?php

    }
    else { 

    ?>
        <style type="text/css">
            #notif
            {
                color:#337ab7!important;
            }
        </style>

<?php
    }  

?>
