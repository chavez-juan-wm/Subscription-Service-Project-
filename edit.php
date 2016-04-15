<?php require_once("authorize.php"); require_once("connect.php")?>
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
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <style>
        .edit input, select
        {
            height: 35px;
            width: 190px;
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
<h1 style="text-align: center; color: #00b7bb">Pass the Book - Edit User Information</h1>
<hr>

<?php
    $message = "<div style='margin-left: 30px;'>
    <p style=\"margin-top: 20px\"><a href= \"admin.php\">&lt;&lt; Back to admin page</a></p>
</div>";
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
        $plan = $user['plan'];

        if($plan == 1)
            $plan = 19.92;
        else if($plan == 2)
            $plan = 58.56;
        else if ($plan == 3)
            $plan = 113.52;
        else
            $plan = 0;


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
        $state = $shipping['state'];

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
        $message = "<div style='margin-left: 457px;'>
    <p style=\"margin-top: 20px\">Sorry, no user was specified to edit. <br><br> <a href= \"admin.php\">&lt;&lt; Back to admin page</a></p> </div>";

    if (isset($_POST['submit']))
    {
        if($_POST['plan'] == 19.92)
            $plan = 1;
        else if($_POST['plan'] == 58.56)
            $plan = 2;
        else if($_POST['plan'] == 113.52)
            $plan = 3;
        else
            $plan = null;

        $query = "UPDATE users SET firstName= :firstName, lastName= :lastName, email= :email, password= :password, plan= :plan WHERE userId= :id;";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(
            'firstName'=>$_POST['firstName'],
            'lastName'=>$_POST['lastName'],
            'email'=>$_POST['email'],
            'password'=>$_POST['password'],
            'plan'=>$plan,
            'id'=>$id
        ));

        $query = "UPDATE shipping SET addressLine1= :address1, addressLine2= :address2, city= :city, state= :state, zip_code= :zipCode, full_name= :fullName WHERE userId= :id;";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(
            'address1'=>$_POST['address1'],
            'address2'=>$_POST['address2'],
            'city'=>$_POST['city'],
            'state'=>$_POST['state'],
            'zipCode'=>$_POST['zip_code'],
            'fullName'=>$_POST['fullName'],
            'id'=>$id
        ));

        $query = "UPDATE payment SET cardNumber= :cardNumber, month= :month, year= :year, cvvCode= :cvvCode, cardName= :name WHERE userId= :id;";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(
            'cardNumber'=>$_POST['cardNumber'],
            'month'=>$_POST['exp_month'],
            'year'=>$_POST['exp_year'],
            'cvvCode'=>$_POST['cvvCode'],
            'name'=>$_POST['cardName'],
            'id'=>$id
        ));
        // Confirm success with the user
        $message = "<div style='margin-left: 457px;'>
    <p style=\"margin-top: 20px\">$name was successfully edited. <br><br> <a href= \"admin.php\">&lt;&lt; Back to admin page</a> </p></div>";
    }

    else if (isset($id))
    { ?>
<div style="margin-left: 25px" class="edit">
    <form id="Update" name="Update" method="post">
        <div style="float: left; margin-left: 30px">
            <h2>Account Information</h2>
            <div style="float: left">
                <label for="firstName">First Name</label> <br>
                <input type="text" id="firstName" name="firstName" value="<?= $firstName ?>" autofocus> <br>

                <label for="lastName">Last Name</label> <br>
                <input type="text" id="lastName" name="lastName" value="<?= $lastName ?>"> <br>

                <label for="email">Email</label> <br>
                <input type="email" id="email" name="email" value="<?= $email ?>"> <br>

                <input type="hidden" name="id" value="<?= $id ?>" />
            </div>

            <div style="float: left; margin-left: 10px">
                <label for="password">Password</label> <br>
                <input type="text" id="password" name="password" value="<?= $password ?>"> <br>

                <label for="plan">Plan</label> <br>
                <select name="plan" id="plan" form="Update">
                    <option value="0">No Plan</option>
                    <option value="19.92">One Month - Total: $19.92</option>
                    <option value="58.56">Three Months - Total: $58.56</option>
                    <option value="113.52">Six Months - Total: $113.52</option>
                </select>
            </div>
        </div>

        <div style="float: left; margin-left: 30px">
            <h2>Shipping Information</h2>
            <div style="float: left">
                <label for="fullName">Full Name</label> <br>
                <input type="text" id="fullName" name="fullName" value="<?= $fullName ?>"> <br>

                <label for="address1">Address Line 1</label> <br>
                <input type="text" id="address1" name="address1" value="<?= $address1 ?>"> <br>

                <label for="address2">Address Line 2</label> <br>
                <input type="text" id="address2" name="address2" value="<?= $address2 ?>"> <br>
            </div>

            <div style="float: left; margin-left: 10px">
                <label for="city">City</label> <br>
                <input type="text" id="city" name="city" value="<?= $city ?>"> <br>

                <label for="zip_code">Zip Code</label> <br>
                <input type="number" name="zip_code" id="zip_code" value="<?= $zip_code ?>"> <br>

                <label for="state">Shipping State</label> <br>
                <select id="state" name="state" form="Update">
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

        <div style="float: left; margin-left: 30px">
            <h2>Billing Information</h2>
            <div style="float: left">
                <label for="cardName">Name on Card</label> <br>
                <input type="text" id="cardName" name="cardName" value="<?= $cardName ?>"> <br>

                <label for="cardNumber">Card Number</label> <br>
                <input type="number" id="cardNumber" name="cardNumber" value="<?= $cardNumber ?>"> <br>

                <label for="cvvCode">CVV Code</label> <br>
                <input type="number" id="cvvCode" name="cvvCode" value="<?= $cvvCode ?>"> <br>
            </div>

            <div style="float: left; margin-left: 10px">
                <label for="exp_month">Exp. Month</label> <br>
                <select id="exp_month" name="exp_month" form="Update">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select> <br>

                <label for="exp_year">Exp. Year</label> <br>
                <input type="number" name="exp_year" id="exp_year" value="<?= $exp_year ?>"> <br>
            </div>
        </div>

        <div>
            <br>
            <input class="btn-primary" style="margin-top: 295px; font-size: larger; width: 98.5%; display: block" type="submit" value="Update" name="submit" />
        </div>
    </form>
</div>
    <?php } ?>

    <?= $message ?>

<script>
    $(document).ready(function()
    {
        var values = ["<?= $plan ?>", "<?= $state ?>", "<?= $month ?>"];
        var id = ["plan", "state", "exp_month"];

        for(var counter = 0; counter <= 2; counter++)
        {
            var sel = document.getElementById(id[counter]);
            var val = values[counter];

            for(var i = 0, j = sel.options.length; i < j; i++)
            {
                if(sel.options[i].value == val)
                    sel.selectedIndex = i;
            }
        }
    });
</script>
</body>
</html>