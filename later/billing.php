<?php
    require_once("connect.php");

//    Redirects the page to the payment page when they submit all of the required info in the form
    $sql = "SELECT * FROM address WHERE userId='".$currentUser."'";
    $res = $dbh->prepare($sql);
    $res->execute();
    $info = $res->fetch();
    $count = $res->rowCount();

    if ($count == 1)
    {
        if($info['addressLine2'] == '')
            $addressLine2 = "placeholder = 'Address Line 2'";
        else
            $addressLine2 = "value = " . $info['addressLine2'];

        $addressLine1 = "value = " . $info['addressLine1'];
        $city = "value = " . $info['city'];
        $state = "value = " . $info['state'];
        $postcode = "value = " . $info['postcode'];
        $country = "value = " . $info['country'];
    }
    else
    {
        $addressLine1 = "placeholder = 'Address Line 1'";
        $addressLine2 = "placeholder = 'Address Line 2'";
        $city = "placeholder = 'City'";
        $state = "placeholder = 'State'";
        $postcode = "placeholder = 'Post Code'";
        $country = "placeholder = 'Country'";
    }

    if(@$_POST['billing'])
    {
        if ($count == 1)
        {
            $sql = "UPDATE `shopping_cart`.`address` SET `addressLine1`='".$_POST['addressLine1']."', `addressLine2`='".$_POST['addressLine2']."', `city`='".$_POST['city']."', `state`='".$_POST['state']."', `postcode`='".$_POST['postcode']."', `country`='".$_POST['country']."' WHERE `userId`='".$currentUser."'";
            $res = $dbh->prepare($sql);
            $res->execute();
        }
        else
        {
            $stmt = $dbh->prepare('INSERT INTO address (userId, addressLine1, addressLine2, city, state, postcode, country) VALUES (:userId, :addressLine1, :addressLine2, :city, :state, :postcode, :country)');
            $result = $stmt->execute(
                array(
                    'userId'=>$currentUser,
                    'addressLine1'=>$_POST['addressLine1'],
                    'addressLine2'=>$_POST['addressLine2'],
                    'city'=>$_POST['city'],
                    'state'=>$_POST['state'],
                    'postcode'=>$_POST['postcode'],
                    'country'=>$_POST['country']
                )
            );
        }
        header("Location: payment.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Billing Information</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Files for menu bar -->
    <script src="../js/navbar.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../css/navbar.css"/>

    <style>
        body
        {
            overflow-x: hidden;
        }
    </style>
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
            <li style="float: right;"><a href='../login.php'><span>Profile</span></a></li>
        </ul>
    </div>

    <!-- Start of the address details -->
    <div style="margin-top: 3%">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form class="form-horizontal" name="billing" method="post">
                    <!-- Form Name -->
                    <legend>Address Details</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="textinput">Line 1</label>
                        <div class="col-sm-10">
                            <input type="text" <?= $addressLine1 ?> name="addressLine1" class="form-control" required>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="textinput">Line 2</label>
                        <div class="col-sm-10">
                            <input type="text" <?= $addressLine2 ?> name="addressLine2" class="form-control">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="textinput">City</label>
                        <div class="col-sm-10">
                            <input type="text" <?= $city ?> name="city" class="form-control" required>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="textinput">State</label>
                        <div class="col-sm-4">
                            <input type="text" <?= $state ?> name="state" class="form-control" required>
                        </div>

                        <label class="col-sm-2 control-label" for="textinput">Postcode</label>
                        <div class="col-sm-4">
                            <input type="text" <?= $postcode ?> name="postcode" class="form-control" required>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="textinput">Country</label>
                        <div class="col-sm-10">
                            <input type="text" <?= $country ?> name="country" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="pull-right">
                                <a href="cart.php" class="btn btn-default" role="button">Cancel</a>
                                <button type="submit" class="btn btn-primary" name="billing" value="1">Next</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </div>
</body>
</html>
