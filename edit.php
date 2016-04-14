<?php require_once("connect.php")?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pass the Book - Admin</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Files for menu bar -->
    <script src="js/navbar.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <style>
        input, select
        {
            height: 35px;
            width: 210px;
        }
        label
        {
            margin-top: 10px;
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
                echo '<li style="float: right;"><a href="checkout.php"><span>Profile</span></a></li>';
            else
                echo '<li style="float: right;"><a href="profile.php"><span>Profile</span></a></li>';
        }
        ?>
        <li style="float: right"><a href='index.php#plan'><span>Subscription Plans</span></a></li>
    </ul>
</div>
<h1 style="text-align: center; color: #00b7bb">Pass the Book - Edit User Information</h1>
<hr><br>

<?php
    $message = "";
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];

        //  Gets the current user's account info from the database
        $sql = "SELECT * FROM users WHERE userId = :userId";
        $stmt = $dbh->prepare($sql);
        $stmt -> execute(array("userId"=>$id));
        $user = $stmt->fetch();

        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $email = $user['email'];
        $password = $user['password'];
        $step = $user['step'];
        $plan = $user['plan'];

        if($plan == 1)
            $plan = 19.92;
        else if($plan == 2)
            $plan = 58.56;
        else
            $plan = 113.52;


        //  Gets the current user's billing info from the database
        $sql = "SELECT * FROM billing WHERE userId = :userId";
        $stmt = $dbh->prepare($sql);
        $stmt -> execute(array("userId"=>$id));
        $billing = $stmt->fetch();
    }

    else if (isset($_POST['id']))
        $id = $_POST['id'];

    else
        $message= "Sorry, no user was specified to edit.";

    if (isset($_POST['submit']))
    {
        // Delete the user data from the users table
        $query = "DELETE FROM users WHERE userId = :id LIMIT 1";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array('id'=>$id));

        // Delete the user data from the payment table
        $query = "DELETE FROM payment WHERE userId = :id LIMIT 1";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array('id'=>$id));

        // Delete the user data from the billing table
        $query = "DELETE FROM billing WHERE userId = :id LIMIT 1";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array('id'=>$id));

        // Confirm success with the user
        $message = $name . ' was successfully edited.';
    }

    else if (isset($id))
    { ?>
    <div style="margin-left: 10px">
        <h2>Account Information</h2>
        <form name="Update" method="post">
            <div style="float: left">
                <label for="firstName">First Name</label> <br>
                <input type="text" id="firstName" name="firstName" value="<?= $firstName ?>" required autofocus> <br>

                <label for="lastName">Last Name</label> <br>
                <input type="text" id="lastName" name="lastName" value="<?= $lastName ?>" required> <br>

                <label for="email">Email</label> <br>
                <input type="email" id="email" name="email" value="<?= $email ?>" required> <br>

                <input class="btn-primary" style="margin-top: 10px" type="submit" value="Update" name="submit" />
                <input type="hidden" name="id" value="<?= $id ?>" />
                <p> <?= $message ?> </p>
                <p style="margin-top: 15px"><a href= "admin.php">&lt;&lt; Back to admin page</a></p>
            </div>

            <div style="float: left; margin-left: 10px">
                <label for="password">Password</label> <br>
                <input type="text" id="password" name="firstName" value="<?= $password ?>" required autofocus> <br>

                <label for="step">Step</label> <br>
                <select name="step" id="step" form="Update">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
                <br>

                <label for="plan">Plan</label> <br>
                <select name="plan" id="plan" form="Update">
                    <option value="19.92">One Month - Total: $19.92</option>
                    <option value="58.56">Three Months - Total: $58.56</option>
                    <option value="113.52">Six Months - Total: $113.52</option>
                </select>
            </div>
        </form>

    </div>
    <?php } ?>

<script>
    $(document).ready(function()
    {
        var sel = document.getElementById('plan');
        var val = "<?= $plan ?>";
        for(var i = 0, j = sel.options.length; i < j; ++i)
        {
            if(sel.options[i].value == val)
                sel.selectedIndex = i;
        }

        var selected = document.getElementById('step');
        var value = "<?= $step ?>";
        for(var counter = 0, m = selected.options.length; counter < m; ++counter)
        {
            if(selected.options[counter].value == value)
                selected.selectedIndex = counter;
        }
    });
</script>
</body>
</html>