<?php
    require_once("connect.php");
    $error = "";
    function send_mail($email,$message,$subject)
    {
        require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->AddAddress($email);
        $mail->Username="juan.chavez@west-mec.org";
        $mail->Password="8Bc9ZZ15";
        $mail->SetFrom('juan.chavez@west-mec.org','Pass the Book');
        $mail->AddReplyTo("juan.chavez@west-mec.org","Pass the Book");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }

    if(@$_POST['reset'])
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $res = $dbh->prepare($sql);
        $res -> execute(array('email'=>$_POST['email']));
        $result = $res->fetch();
        $count = $res->rowCount();

        if($count == 1)
        {
            $email = $_POST['email'];
            $name = $result['firstName'] . ' ' . $result['lastName'];
            $message = 'Hi, ' . $name . ' <br><br> Click here to reset your password http://localhost:8090/Subscription-Service-Project-/resetPassword.php?email=' . $email . '&action=reset   <br/> <br/>--<br>PasstheBook.com<br>Solve your problems.';
            send_mail($email, $message, "Reset Password");
            $error = "The email has been sent. <br><br>";
        }
        else
            $error = "Account not found please signup now! <br><br>";

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


    <!-- Files for menu bar -->
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
        <h1 style="text-align: center; color: #00b7bb; margin-top: 4%">Please enter the email on your account.</h1>
        <h3 align="center" style="margin-top: 2%">We will send you an email with a secure link where you can reset your password.</h3>
        <hr>

        <form name = "reset" method="post" style="margin-top: 2%">
            <div style="width: 20%; margin-left: auto; margin-right: auto">
                <span style="color: orangered; text-align: center"><?= $error ?></span>
                <label for="email">Email</label>
                <input style="height: 40px" class="form-control" autofocus="autofocus" name="email" type="email" id="email" required>
            </div>
            <div style="width: 20%; margin-left: auto; margin-right: auto; margin-top: 1%">
                <input style="height: 40px" class="btn btn-primary btn-block" type="submit" value="Send" name="reset">
            </div>
        </form>
    </div>
</body>
</html>