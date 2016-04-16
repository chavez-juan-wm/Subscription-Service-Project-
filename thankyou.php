<?php require_once('connect.php')?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pass the Book</title>

    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Files for menu bar -->
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <!-- Scripts for slider -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/slider.css">

    <style>
        p
        {
            font-size: x-large;
        }
    </style>
</head>

<body>

<div style="z-index: 10" id='cssmenu'>
    <ul>
        <li><a href='index.php'><span>Home</span></a></li>

        <?php
        if($who == "Sign In")
            echo '<li style="float: right;"><a href="login.php"><span>Sign In</span></a></li>';
        else if($who == "Profile")
        {
             if($step == 1)
                    echo '<li style="float: right;"><a href="checkout.php"><span>Profile</span></a>';
                else
                    echo '<li style="float: right;"><a href="profile.php"><span>Profile</span></a>';
            ?>
                <ul>
                    <li style="background-color: black; width: 60%">
                    <form method="post" name="logout" action="profile.php">
                        <input class="btn-link" style="color: white" type="submit" value="Log Out" name="logout">
                    </form>
                    </li>
                </ul>
                </li>
            <?php
            }
        ?>
        <li style="float: right"><a href='index.php#plan'><span>Subscription Plans</span></a></li>
    </ul>
</div>

<div style="text-align: center">

    <h1 style="text-align: center; color: #00b7bb">Welcome to our Family!</h1>
    <hr>
    <p style="line-height: 36px; margin-bottom: 30px">
        Thank you for choosing our service! We are delighted to welcome another member that loves to read <br> books as much as us.
        We hope that you will love every book you receive, and for those who don't necessarily <br> like our service you can always cancel your plan anytime.
        And remember: <i>One World, Many Stories<i>
    </p>

    <div style="background-color: #fbfbfd; width: 100%; height: 100%">
        <img src="pictures/PasstheBook.png" style="width: 42%; margin-top: 20px">
    </div>

</body>
</html>