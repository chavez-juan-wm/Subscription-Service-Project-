<?php
    require_once("connect.php");

    if(@$_POST['signIn'])
    {
        $message = "";
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $res = $dbh->prepare($sql);
        $res -> execute(
            array(
                'email'=>$email,
                'password'=>$password
            )
        );
        $count = $res->rowCount();

        if ($count == 1)
        {
            $result = $res->fetch();
            $currentUser = $result['userId'];

            $sql = "UPDATE users SET currentUser = :userId WHERE userId = '1'";
            $set = $dbh->prepare($sql);
            $set -> execute(
                array('userId'=>$currentUser)
            );

            //  Gets the current step from the database
            $sql = "SELECT step FROM users WHERE userId = :userId";
            $stmt = $dbh->prepare($sql);
            $stmt -> execute(array("userId"=>$currentUser));
            $result = $stmt->fetch();
            $step = $result['step'];

            if($step == 1)
                header("Location: checkout.php");
            else
                header("Location: profile.php");
        }
        else
        {
            $sql = "SELECT * FROM users WHERE email = :email";
            $res = $dbh->prepare($sql);
            $res -> execute(
                array('email'=>$email));
            $count = $res->rowCount();

            if($count == 1)
                $message = "Your password is incorrect.";
            else
                $message = "That email has not been registered.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Files for menu bar -->
    <script src="js/navbar.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>
</head>

<body>
    <div style="z-index: 10" id='cssmenu'>
        <ul>
            <li><a href='index.php'><span>Home</span></a></li>

            <?php
                if($who == "Sign In")
                    echo '<li class="active" style="float: right;"><a href="login.php"><span>Sign In</span></a></li>';
                else if($who == "Profile")
                {
                    if($step == 1)
                        echo '<li class= "active" style="float: right;"><a href="checkout.php"><span>Profile</span></a></li>';
                    else
                        echo '<li class= "active" style="float: right;"><a href="profile.php"><span>Profile</span></a></li>';
                }
            ?>
            <li style="float: right"><a href='index.php#plan'><span>Subscription Plans</span></a></li>
        </ul>
    </div>

    <h1 style="text-align: center; color: #00b7bb; margin-top: 4%">Sign In</h1>
    <hr/>
    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="pictures/profile.png"/>
            <span style="color: orangered"><?= $message ?></span>
            <form name="signIn" method = "post" class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" class="form-control, inputEmail" name="email" placeholder="Email address" required autofocus>
                <input type="password" class="form-control, inputPassword" name="password" placeholder="Password" required>

                <button name="signIn" value="1" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form>
            <!-- /form -->

            <a href="reset.php" class="forgot-password">
                <p style="margin-bottom: 0">Forgot your password?</p>
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>