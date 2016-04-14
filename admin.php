<?php
    // User name and password for authentication
    $username = 'JMC';
    $password = '2229';

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
        ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password))
    {
    // The user name/password are incorrect so send the authentication headers
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm= Pass the Book');
        exit('<h2>Guitar Wars</h2>Sorry, you must enter a valid user name and password to ' .
            'access this page.');
    }

    require_once("connect.php");

    $query = "SELECT * FROM users WHERE userId != 1";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll();
?>

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

    <style>
        td
        {
            text-align: left;
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

<div style="text-align: center">

    <h1 style="text-align: center; color: #00b7bb">Pass the Book - User Administration</h1>
    <hr>

    <table class="table" align="center">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Plan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user){ ?>
                <tr>
                    <td><?= $user['firstName']; ?></td>
                    <td><?= $user['lastName']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['plan']; ?></td>
                    <td><a href="remove.php?id=' . $user['userId'] . '&amp;date=' . $result['date'] .
        '&amp;name=' . $result['firstName'] . '">Remove</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
