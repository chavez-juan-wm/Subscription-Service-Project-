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
    if(@$_COOKIE['user'])
    {
        $currentUser = $_COOKIE['user'];
        //  Gets the current step from the database
        $sql = "SELECT step FROM users WHERE userId = :userId";
        $stmt = $dbh->prepare($sql);
        $stmt -> execute(array("userId"=>$currentUser));
        $result = $stmt->fetch();
        $step = $result['step'];
    }
    else
    {
        $currentUser = 0;
        $step = 0;
    }

    if($currentUser == 0)
        $who = "Sign In";
    else
        $who = "Profile";