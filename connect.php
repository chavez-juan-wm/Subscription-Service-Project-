<?php
    /*** mysql hostname ***/
    $hostname = 'localhost';
    /*** mysql username ***/
    $username = 'root';
    /*** mysql password ***/
    $password = 'root';

    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=subscription", $username, $password);
        // set the PDO error mode to exception
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

    date_default_timezone_set('America/Phoenix');

//  Gets the current user from the database
    $sql = "SELECT currentUser FROM users WHERE userId = 1";
    $currentUser = $dbh->prepare($sql);
    $currentUser -> execute();
    $currentUser2 = $currentUser->fetch();
    $currentUser3 = $currentUser2['currentUser'];

    if($currentUser3 == 1)
        $who = "Sign In";
    else
        $who = "Profile";