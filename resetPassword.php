<?php
    require_once("connect.php");

    if(isset($_GET['action']))
    {
        if($_GET['action']=="reset")
            $email = $_GET['email'];
    }

    else if(isset($_POST['reset']))
    {
        $password = $_POST['password'];
        $email = $_POST['email'];

        $query = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array('password'=>$password, 'email'=>$email));

        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">


    <!-- Files for menu bar -->
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <!-- Scripts for slider -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
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
                document.getElementById("error").innerHTML = "<span style='color: orangered' id='error'>The passwords do not match.</span>";
            }
        });
    });
</script>

<div style="z-index: 10" id='cssmenu'>
    <ul>
        <li><a href='index.php'><span>Home</span></a></li>

        <?php
        if($who == "Sign In")
            echo '<li class="active" style="float: right;"><a href="login.php"><span>Sign In</span></a></li>';
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

<div>
    <h1 style="text-align: center; color: #00b7bb; margin-top: 4%">Please enter your new password</h1>
    <hr>

    <div class="container">
        <div class="card card-container">
            <form name="reset" method = "post" class="form-signin" action="<?= $_SERVER['PHP_SELF']; ?>">
                <span style="text-align: center"></span>
                <span style="color: orangered" id="error"></span>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="hidden" name="email" value=<?=$_GET['email']?>>
                <input type="password" class="inputPassword" id="password" name="password" placeholder="New Password" required>
                <input type="password" class="inputPassword" id="confirm" name="confirmPassword" placeholder="Repeat New Password" required>
                <button type="submit" name="reset" value="1" class="btn btn-lg btn-primary btn-block btn-signin">Submit</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</div>
</body>
</html>