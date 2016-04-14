<?php require_once("connect.php")?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pass the Book - Admin</title>

    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

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
    <h1 style="text-align: center; color: #00b7bb">Pass the Book - Remove a User</h1>
    <hr><br>

    <?php
    $message = "";
    if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']))
    {
        // Grab the user data from the GET
        $id = $_GET['id'];
        $date = $_GET['date'];
        $name = $_GET['name'];
    }
    else if (isset($_POST['id']) && isset($_POST['name']))
    {
        // Grab the user data from the POST
        $id = $_POST['id'];
        $name = $_POST['name'];
    }
    else
    {
        $message= "Sorry, no user was specified for removal.";
    }

    if (isset($_POST['submit']))
    {
        if ($_POST['confirm'] == 'Yes')
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
            $message = $name . ' was successfully removed.';
        }
        else
        {
            $message = "The high score was not removed.";
        }
    }

    else if (isset($id) && isset($name) && isset($date))
    {
    ?>
    <div>
        <?php
        echo '<p style="margin-left: 457px">Are you sure you want to delete the following user?</p>';
        echo '<p style="margin-left: 457px"><strong>Name: </strong>' . $name . '<br /><strong>Date Created: </strong>' . $date;
        echo '<form style="margin-left: 457px" method="post" action="remove.php">';
        echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
        echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
        echo '<input class="btn-primary" style="margin-top: 10px" type="submit" value="Submit" name="submit" />';
        echo '<input type="hidden" name="id" value="' . $id . '" />';
        echo '<input type="hidden" name="name" value="' . $name . '" />';
        echo '</form>';
    }
        echo '<p style="margin-left: 457px">' . $message . '</p>';
        echo '<p style="margin-top: 15px; margin-left: 457px"><a href= "admin.php">&lt;&lt; Back to admin page</a></p>';
    ?>
    </div>
</body>
</html>