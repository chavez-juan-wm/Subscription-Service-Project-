<?php require_once("connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


    <!-- Files for menu bar -->
    <script src="js/navbar.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <!-- Scripts for slider -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
</head>

<body>
    <div style="z-index: 10" id='cssmenu'>
        <ul>
            <li><a href='index.php'><span>Home</span></a></li>

            <?php
            if($who == "Sign In")
                echo '<li class="active" style="float: right;"><a href="login.php"><span>Sign In</span></a></li>';
            else if($who == "Profile")
                echo '<li style="float: right;"><a href="profile.php"><span>Profile</span></a></li>';
            ?>
            <li style="float: right"><a href='#'><span>Subscription Plans</span></a></li>
        </ul>
    </div>

    <div>
        <h1 style="text-align: center; color: #00b7bb; margin-top: 4%">Please enter the email on your account.</h1>
        <h3 align="center" style="margin-top: 4%">We will send you an email with a secure link where you can reset your password.</h3>

        <form method="POST">
            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
                <label for="email">Email</label>
                <input class="form-control" autofocus="autofocus" name="email" type="email" id="email">
            </div>
            <div class=" col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
                <input class="btn btn-primary btn-block" type="submit" value="Send">
            </div>
        </form>
    </div>
</body>
</html>