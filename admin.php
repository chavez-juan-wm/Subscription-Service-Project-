<?php
    require_once("connect.php");

    $query = "SELECT * FROM users";
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
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <style>
        td
        {
            text-align: left;
        }
        table
        {
            table-layout: fixed;
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

    <h1 style="text-align: center; color: #00b7bb">Pass the Book - User Administration</h1>
    <hr><br>
    <div style="text-align: left"><?php require_once("authorize.php"); ?></div>

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
                    <td>
                        <?php
                            if($user['plan'] == 1)
                                echo "One Month Plan";
                            else if($user['plan'] == 2)
                                echo "Three Months Plan";
                            else if($user['plan'] == 3)
                                echo "Six Months Plan";
                            else
                                echo "No Plan";
                        ?>
                    </td>
                    <?php
                        echo '<td><a href="remove.php?id=' . $user['userId'] . '&amp;date=' . $user['created'] .
                            '&amp;name=' . $user['firstName'] . " " . $user['lastName'] . '">Remove</a>';

                        echo ' / <a href="edit.php?id=' . $user['userId'] .'">Edit</a></td>';
                    ?>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>