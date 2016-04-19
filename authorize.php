<?php
    // User name and password for authentication
    $username = 'Book';
    $password = 'Lovers';

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
        ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password))
    {
        // The user name/password are incorrect so send the authentication headers
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm= Pass the Book');
        exit('<div style="margin-left: 440px">Sorry, you must enter a valid user name and password to ' .
            'access this page.</div>');
    }