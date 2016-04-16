<?php
    require_once('connect.php');

    //  Gets the current user's account info from the database
    $sql = "SELECT * FROM users WHERE userId = :userId";
    $stmt = $dbh->prepare($sql);
    $stmt -> execute(array("userId"=>$currentUser));
    $general = $stmt->fetch();

    //  Gets the current user's shipping info from the database
    $sql = "SELECT * FROM shipping WHERE userId = :userId";
    $stmt = $dbh->prepare($sql);
    $stmt -> execute(array("userId"=>$currentUser));
    $shipping = $stmt->fetch();

    if(@$_POST['logout'])
    {
        if (isset($_COOKIE['user']))
        {
            unset($_COOKIE['user']);
            setcookie('user', '', time() - 3600, '/'); // empty value and old timestamp
        }
        header("Location: login.php");
    }

    if(@$_POST['edit'])
    {
        header("Location: editPersonal.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Files for menu bar -->
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <!-- Scripts for slider -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>

    <style>
        p{
            font-size: medium;
            line-height: 32px;
        }
    </style>
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
    <div>
        <div style="margin-top: 20px; margin-left: 80px; float: left">
            <img class="img-rounded" src="pictures/<?= $general['profilePic'] ?>" style="width: 300px; height: 280px">
            <form method='post' name='logout' style="margin-top: 30px">
                <button class='btn-primary' type='submit' name='logout' value='1'>Log Out</button>
                <button class='btn-primary' type='submit' name='edit' value='5'>Edit Profile</button>
            </form>
        </div>

        <div style="float: left;  margin-left: 12.5%;">
            <h3>Contact Information</h3>
            <p>Email: <?= $general['email'] ?> </p>

            <br>
            <h3>General Information</h3>
            <p>
                First Name: <?= $general['firstName'] ?><br>
                Last Name: <?= $general['lastName'] ?><br>
                Current Plan: <?php
                if($general['plan'] == 1)
                    echo "One Month Plan";
                else if($general['plan'] == 2)
                    echo "Three Months Plan";
                else if($general['plan'] == 3)
                    echo "Six Months Plan";
                else
                    echo "No Plan"; ?>
                <br>
                Member Since: <?php $date = strtotime($general['created']);
                echo date('m-d-Y',$date); ?>
            </p>
        </div>

        <div style="float: left; margin-left: 95px">
            <h3>Shipping Information</h3>
            <p>
                Shipping Address: <?= $shipping['addressLine1'] ?><br>
                Shipping Address 2: <?= $shipping['addressLine2'] ?><br>
                Shipping City: <?= $shipping['city'] ?><br>
                Shipping Zip Code: <?= $shipping['zip_code'] ?><br>
                Shipping State: <?= $shipping['state'] ?><br>
                Shipping Country: <?= $shipping['country'] ?><br>
            </p>
        </div>
    </div>
</div>
</body>
</html>