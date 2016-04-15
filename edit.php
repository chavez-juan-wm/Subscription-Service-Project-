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
<hr>

<?php
    $message = "";
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];

        //  Gets the user's account info from the database
        $sql = "SELECT * FROM users WHERE userId = :userId";
        $stmt = $dbh->prepare($sql);
        $stmt -> execute(array("userId"=>$id));
        $user = $stmt->fetch();

        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $name = $firstName . " " . $lastName;
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


        //  Gets the user's shipping info from the database
        $sql = "SELECT * FROM shipping WHERE userId = :userId";
        $stmt = $dbh->prepare($sql);
        $stmt -> execute(array("userId"=>$id));
        $shipping = $stmt->fetch();

        $fullName = $shipping['full_name'];
        $address1 = $shipping['addressLine1'];
        $address2 = $shipping['addressLine2'];
        $city = $shipping['city'];
        $zip_code = $shipping['zip_code'];
        $stae = $shipping['state'];

        //  Gets the user's billing info from the database
        $sql = "SELECT * FROM payment WHERE userId = :userId";
        $stmt = $dbh->prepare($sql);
        $stmt -> execute(array("userId"=>$id));
        $billing = $stmt->fetch();

        $cardName = $billing['cardName'];
        $cardNumber = $billing['cardNumber'];
        $cvvCode = $billing['cvvCode'];
        $exp_year = $billing['year'];
        $month = $billing['month'];
    }

    else if (isset($_POST['id']))
        $id = $_POST['id'];

    else
        $message = "Sorry, no user was specified to edit.";

    if (isset($_POST['submit']))
    {
        // Confirm success with the user
        $message = $name . ' was successfully edited.';
    }

    else if (isset($id))
    { ?>
<div style="margin-left: 25px">
    <form name="Update" method="post">
        <div style="float: left">
            <h2>Account Information</h2>
            <div style="float: left">
                <label for="firstName">First Name</label> <br>
                <input type="text" id="firstName" name="firstName" value="<?= $firstName ?>" required autofocus> <br>

                <label for="lastName">Last Name</label> <br>
                <input type="text" id="lastName" name="lastName" value="<?= $lastName ?>" required> <br>

                <label for="email">Email</label> <br>
                <input type="email" id="email" name="email" value="<?= $email ?>" required> <br>

                <input type="hidden" name="id" value="<?= $id ?>" />
            </div>

            <div style="float: left; margin-left: 10px">
                <label for="password">Password</label> <br>
                <input type="text" id="password" name="firstName" value="<?= $password ?>" required> <br>

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
        </div>

        <div style="float: left; margin-left: 40px">
            <h2>Shipping Information</h2>
            <div style="float: left">
                <label for="fullName">Full Name</label> <br>
                <input type="text" id="fullName" name="fullName" value="<?= $fullName ?>" required> <br>

                <label for="address1">Address Line 1</label> <br>
                <input type="text" id="address1" name="address1" value="<?= $address1 ?>" required> <br>

                <label for="address2">Address Line 2</label> <br>
                <input type="text" id="address2" name="address2" value="<?= $address2 ?>"> <br>
            </div>

            <div style="float: left; margin-left: 10px">
                <label for="city">City</label> <br>
                <input type="text" id="city" name="city" value="<?= $city ?>" required> <br>

                <label for="zip_code">Zip Code</label> <br>
                <input type="number" name="zip_code" id="zip_code" value="<?= $zip_code ?>" required> <br>

                <label for="state">Shipping State</label> <br>
                <select id="state" name="state" form="Update" required>
                    <option value="" selected="selected">PLEASE SELECT</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AR">Arkansas</option>
                    <option value="AZ">Arizona</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                    <option value="PR">Puerto Rico</option>
                </select><br>
                <br>
            </div>
        </div>

        <div style="float: left; margin-left: 40px">
            <h2>Billing Information</h2>
            <div style="float: left">
                <label for="cardName">Name on Card</label> <br>
                <input type="text" id="cardName" name="cardName" value="<?= $cardName ?>" required> <br>

                <label for="cardNumber">Card Number</label> <br>
                <input type="number" id="cardNumber" name="cardNumber" value="<?= $cardNumber ?>" required> <br>

                <label for="cvvCode">CVV Code</label> <br>
                <input type="number" id="cvvCode" name="cvvCode" value="<?= $cvvCode ?>" required> <br>
            </div>

            <div style="float: left; margin-left: 10px">
                <label for="exp_month">Exp. Month</label> <br>
                <select id="exp_month" name="exp_month" form="Update" required>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select> <br>

                <label for="exp_year">Exp. Year</label> <br>
                <input type="number" name="exp_year" id="exp_year" value="<?= $exp_year ?>" required> <br>
            </div>
        </div>

        <div>
            <br>
            <input class="btn-primary" style="margin-top: 295px; font-size: larger; width: 98.7%; display: block" type="submit" value="Update" name="submit" />
            <p> <?= $message ?> </p>
            <p style="margin-top: 15px"><a href= "admin.php">&lt;&lt; Back to admin page</a></p>
        </div>
    </form>
</div>
    <?php } ?>

<script>
    $(document).ready(function()
    {
        var values = ["<?= $plan ?>", "<?= $step ?>", "<?= $state ?>"];
        var id = ["plan", "step", "state", "exp_month"];

        var sel = document.getElementById('plan');
        var val = "<?= $plan ?>";
        for(var i = 0, j = sel.options.length; i < j; ++i)
        {
            if(sel.options[i].value == val)
                sel.selectedIndex = i;
        }
    });
</script>
</body>
</html>