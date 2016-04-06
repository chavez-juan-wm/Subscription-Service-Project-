<?php
    require_once('connect.php');

    if(@$_POST['logout'])
    {
        $sql = "UPDATE users SET currentUser = '1' WHERE userId = '1';";
        $set = $dbh->prepare($sql);
        $set -> execute();

        header("Location: login.php");
    }
?>
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
        <li><a href='index.php'><span>Home</span></a></li>

        <?php
        if($who == "Sign In")
            echo '<li class="active" style="float: right;"><a href="login.php"><span>Sign In</span></a></li>';
        else if($who == "Profile")
            echo '<li class="active" style="float: right;"><a href="profile.php"><span>Profile</span></a></li>';
        ?>
        <li style="float: right"><a href='index.php#plan'><span>Subscription Plans</span></a></li>
    </ul>
</div>

<div>
    <form method='post' name='logout'>
        <button class='btn-primary' type='submit' name='logout' value='1'>Log Out</button>
    </form>
</div>
</body>
</html>