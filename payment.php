<?php
    require_once("connect.php");

    $sql = "SELECT * FROM payment WHERE userId= :userId";
    $res = $dbh->prepare($sql);
    $res->execute(array('userId'=>$currentUser3));
    $info = $res->fetch();
    $count = $res->rowCount();

    if ($count == 1)
    {
        $cardNumber = "value = " . $info['cardNumber'];
        $month = "value = " . $info['month'];
        $year = "value = " . $info['year'];
        $cvCode = "value = " . $info['cvCode'];
    }
    else
    {
        $cardNumber = "placeholder = 'Valid Card Number'";
        $month = "placeholder = 'MM'";
        $year = "placeholder = 'YY'";
        $cvCode = "placeholder = 'CV'";
    }

    if(@$_POST['continue'])
    {
        if ($count == 1)
        {
            $sql = "UPDATE payment SET cardNumber = :cardNumber, month = :month, year = :year, cvCode = :cvCode WHERE userId = :userId";
            $res = $dbh->prepare($sql);
            $res->execute(
                array(
                    'cardNumber'=>$_POST['cardNumber'],
                    'month'=>$_POST['month'],
                    'year'=>$_POST['year'],
                    'cvCode'=>$_POST['cvCode'],
                    'userId'=>$currentUser3
                )
            );
        }
        else
        {
            $stmt = $dbh->prepare('INSERT INTO payment (cardNumber, month, year, cvCode, userId) VALUES (:cardNumber, :month, :year, :cvCode, :userId)');
            $result = $stmt->execute(
                array(
                    'cardNumber'=>$_POST['cardNumber'],
                    'month'=>$_POST['month'],
                    'year'=>$_POST['year'],
                    'cvCode'=>$_POST['cvCode'],
                    'userId'=>$currentUser3
                )
            );
        }

        $sql = "SELECT * FROM orders WHERE userId = :userId";
        $res= $dbh->prepare($sql);
        $res -> execute(array('userId'=>$currentUser3));
        $info = $res->fetchAll();

        foreach($info as $value)
        {
            $stmt = $dbh->prepare('INSERT INTO history (productId, userId, quantity, date) VALUES (:productId, :userId, :quantity, :date)');
            $result = $stmt->execute(
                array(
                    'productId'=>$value['productId'],
                    'userId'=>$value['userId'],
                    'quantity'=>$value['quantity'],
                    'date'=>date('Y/m/d')
                )
            );
        }
        header("Location: receipt.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Payment</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Files for menu bar -->
    <script src="js/navbar.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>
</head>

<body>
    <div style="z-index: 10" id='cssmenu'>
        <ul>
            <li><a href='index.html'><span>Home</span></a></li>
            <li><a href='#'><span>About</span></a>
                <ul>
                    <li class='has-sub'><a href='aboutUs.html'><span>About Us</span></a></li>
                    <li class='has-sub'><a href='FAQ.html'><span>Frequently Asked Questions</span></a></li>
                </ul>
            </li>
            <li><a href='products.php'><span>Products</span></a></li>
            <li class="active"><a href='cart.php'><span>Cart</span></a></li>
            <li style="float: right;"><a href='login.php'><span>Profile</span></a></li>
        </ul>
    </div>

    <div class="container">
        <div class="card card-container">
            <form id="payment-form" class="form-horizontal" method="post" name="continue">
                <!--		<form role="form">    -->
                <fieldset>
                    <legend>Payment Details</legend>

                    <div class="form-group">
                        <label for="cardNumber">Card Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber" <?= $cardNumber ?> required autofocus />
					<span class="input-group-addon">
					  <span class="glyphicon glyphicon-lock"></span>
					</span>
                        </div> <!-- .input-group -->
                    </div> <!-- .form-group -->
                    <div class="row">
                        <div class="col-xs-7 col-md-7">
                            <div class="form-group">
                                <label for="expiryMonth">Card Expiry Date</label>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityMonth" name="month" <?= $month ?> required />
                                </div> <!-- .col-xs-6 .col-lg-6 .pl-ziro -->
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityYear" name="year" <?= $year ?> required />
                                </div> <!-- .col-xs-6 .col-lg-6 .pl-ziro -->
                            </div> <!-- .form-group -->
                        </div> <!-- .col-xs-7 .col-md-7 -->
                        <div class="col-xs-5 col-md-5 pull-right">
                            <div class="form-group">
                                <label for="cvCode">CV Code</label>
                                <input type="password" class="form-control" id="cvCode" name="cvCode" <?= $cvCode ?> required />
                            </div> <!-- .form-group -->
                        </div> <!-- .col-xs-5 .col-md-5 .pull-right -->
                    </div> <!-- .row -->

                    <button type="submit" class="btn btn-success btn-block" name="continue" value="1"> Pay </button>
                    <a href="cart.php" class="btn btn-default btn-block" role="button">Cancel</a>
            </form>
        </div><!-- /card-container -->
    </div><!-- /container -->

</body>
</html>
