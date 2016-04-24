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

    <div class="container theme-showcase" role="main">

    <div class="row">
                
    <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">

        <div id="loginh1">
            <h1>Guess That</h1>
        </div>

        <div class="login">
            <form action='process_login.php' method='POST'>

            <div id="logopic">
                <div id="move"><img src="images/logo.jpg" alt="logo image"></div>
            </div>

            <div id="loginput">
                <input class="info width" type='text' name='username' placeholder="Username">
                <input class="info width" type='password' name='password' placeholder="Password">
                <input class="submit forbut" type='submit' value='Login'>
            </div>
            </form>
        </div>

        <div id="accbutton">
                <div class="forgotbutton"><a href="create.php">CREATE NEW ACCOUNT</a></div>
                <div class="forgotbutton"><a href="forgot.html">Fotgot Username or Password</a></div>
        </div>

        <div id="socialshare">
            <div id="socialbox">
                <div class="social" id="facebook"> <a href="https://www.facebook.com/sharer/sharer.php?u=http://alloistudio.me.uk.gridhosted.co.uk/guess/login.php" onclick="window.open(this.href, 'mywin', 'left=10,top=10,width=500,height=500,toolbar=1,resizable=0'); return false;"><i class="fa fa-facebook-square"></i></a>
                </div>

                <div class="social"> <a href="https://twitter.com/home?status=http://alloistudio.me.uk.gridhosted.co.uk/guess/login.php" onclick="window.open(this.href, 'mywin', 'left=10,top=10,width=500,height=500,toolbar=1,resizable=0'); return false;"><i class="fa fa-twitter-square"></i></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript"></script>
</body>
</html>
