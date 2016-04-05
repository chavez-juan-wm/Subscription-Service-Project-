<?php require_once('connect.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

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
        <li class="active"><a href='index.php'><span>Home</span></a></li>

        <?php
        if($who == "Sign In")
            echo '<li style="float: right;"><a href="login.php"><span>Sign In</span></a></li>';
        else if($who == "Profile")
            echo '<li style="float: right;"><a href="profile.php"><span>Profile</span></a></li>';
        ?>
        <li style="float: right"><a href='#'><span>Subscription Plans</span></a></li>
    </ul>
</div>

<div>

</div>

</body>
</html>