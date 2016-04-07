<?php
require_once("connect.php");

if(@$_POST['addUser'])
{
    // Inserts the user's information when signing up
    if($_POST['firstName'] && $_POST['lastName'] && $_POST['password'] && $_POST['email'])
    {
        $stmt = $dbh->prepare('INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)');
        $result = $stmt->execute(
            array(
                'firstName'=>$_POST['firstName'],
                'lastName'=>$_POST['lastName'],
                'email'=>$_POST['email'],
                'password'=>$_POST['password'],
            )
        );
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create an Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Files for menu bar -->
    <script src="js/navbar.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <style>
        .card-container.card
        {
            max-width: 40%;
            padding: 40px 40px;
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
            echo '<li class= "active" style="float: right;"><a href="profile.php"><span>Profile</span></a></li>';
        ?>
        <li style="float: right"><a href='index.php#plan'><span>Subscription Plans</span></a></li>
    </ul>
</div>

<div id = bodyText>
    <h1 style="text-align: center; color: #00b7bb; margin-top: 4%">Checkout</h1>
    <hr/>
    <div class="container">
        <div class="card card-container">
            <form name="addUser" method = "post" class="form-signin">

                <button type="submit" name="addUser" value="1" class="btn btn-lg btn-primary btn-block btn-signin">Sign Up</button>
            </form>
            <!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</div>
</body>

</html>