<?php
    require_once("connect.php");

    $message ="";

    $firstName = 'placeholder="First Name"';
    $lastName = 'placeholder="Last Name"';
    $password = 'placeholder="Password"';
    $repeat = 'placeholder="Repeat Password"';
    $email = 'placeholder="Email"';

    if(@$_POST['addUser'])
    {
        $message ="";
        // Inserts the user's information when signing up
        if($_POST['firstName'] && $_POST['lastName'] && $_POST['password'] && $_POST['email'])
        {
            $sql = "SELECT * FROM users WHERE email = :email";
            $res = $dbh->prepare($sql);
            $res -> execute(
                array('email'=>$_POST['email']));
            $count = $res->rowCount();

            if($count == 0)
            {
                $stmt = $dbh->prepare('INSERT INTO users (firstName, lastName, email, password, created) VALUES (:firstName, :lastName, :email, :password, NOW())');
                $result = $stmt->execute(
                    array(
                        'firstName'=>$_POST['firstName'],
                        'lastName'=>$_POST['lastName'],
                        'email'=>$_POST['email'],
                        'password'=>$_POST['password'],
                    )
                );

                $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
                $res = $dbh->prepare($sql);
                $res -> execute(
                    array(
                        'email'=>$_POST['email'],
                        'password'=>$_POST['password']
                    )
                );
                $count = $res->rowCount();

                if ($count == 1)
                {
                    $result = $res->fetch();
                    $cookie_value = $result['userId'];
                    setcookie("user", $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                    $currentUser = $_COOKIE['user'];
                }

                header("Location: checkout.php");
            }
            else
            {
                $message = "That email has already been registered.";

                $firstName = "value = " . $_POST['firstName'];
                $lastName = "value = " . $_POST['lastName'];
                $password = "value = " . $_POST['password'];
                $repeat = "value = " . $_POST['password'];
                $email = "value = " . $_POST['email'];
            }

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

    <script>
//      Makes sure the password and confirm password are equal to each other
        $(document).ready(function()
        {
            $("#confirm").on('change', function(){
                if(document.getElementById("password").value != document.getElementById("confirm").value)
                {
                    $("#confirm").css("border-color", "red");
                    $("#password").css("border-color", "gray");

                }
                else if(document.getElementById("password").value == document.getElementById("confirm").value)
                {
                    $("#confirm").css("border-color", "green");
                    $("#password").css("border-color", "green");
                }
            });

            $("#password").on('change', function(){
                if(document.getElementById("password").value != document.getElementById("confirm").value)
                {
                    $("#confirm").css("border-color", "red");
                    $("#password").css("border-color", "gray");

                }
                else if(document.getElementById("password").value == document.getElementById("confirm").value)
                {
                    $("#confirm").css("border-color", "green");
                    $("#password").css("border-color", "green");
                }
            });

            $("button").click(function (event)
            {
                if(document.getElementById("password").value != document.getElementById("confirm").value)
                {
                    event.preventDefault();
                    document.getElementById("error").innerHTML = "<span style='color: orangered' id='error'>The passwords do not match.</span>"
                }


            });
        });
    </script>

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
            <li class="active" style="float: right"><a href='index.php#plan'><span>Subscription Plans</span></a></li>
        </ul>
    </div>

    <div>
        <h1 style="text-align: center; color: #00b7bb; margin-top: 4%">Create Your Account</h1>
        <hr/>
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="pictures/profile.png"/>
                <span style="color: orangered" id="error"><?= $message ?></span>
                <form name="addUser" method = "post" class="form-signin" action="<?= $_SERVER['PHP_SELF']; ?>">
                    <span id="reauth-email" class="reauth-email"></span>
                    <div style="width: 50%; float: left; padding-right: 2%">
                        <input type="text" class="form-control, inputEmail" name="firstName" <?= $firstName ?> required autofocus>
                        <input type="text" class="form-control, inputEmail" name="lastName" <?= $lastName ?> required>
                        <input type="email" class="form-control, inputEmail" name="email" placeholder="Email Address" required>
                    </div>

                    <div style="width: 50%; float: left">
                        <input type="password" class="form-control, inputPassword" id="password" name="password" <?= $password ?> required>
                        <input type="password" class="form-control, inputPassword" id="confirm" name="confirmPassword" <?= $repeat ?> required>
                    </div>

                    <button type="submit" name="addUser" value="1" class="btn btn-lg btn-primary btn-block btn-signin">Sign Up</button>
                </form>
                <!-- /form -->

                <a href="login.php" class="forgot-password">
                    <p style="margin-bottom: 0">Already have an account? Sign in</p>
                </a>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </div>
</body>

</html>