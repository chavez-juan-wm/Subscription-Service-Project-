<?php
require_once("connect.php");

if(@$_POST['addUser'])
{
    // Inserts the user's information when signing up
    if($_POST['plan'] && $_POST['state'])
    {
        echo $_POST['plan'];
        echo $_POST['state'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create an Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Files for menu bar -->
    <script src="js/navbar.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <style>
        .card-container.card
        {
            max-width: 40%;
            padding: 40px 40px;
        }
    </style>
</head>

<body>

<div style="z-index: 10" id='cssmenu'>
    <ul>
        <li><a href='index.php'><span>Home</span></a></li>

        <?php
        if($who == "Sign In")
            echo '<li class="active" style="float: right;"><a href="login.php"><span>Sign In</span></a></li>';
        else if($who == "Profile")
            echo '<li class= "active" style="float: right;"><a href="profile.php"><span>Profile</span></a></li>';
        ?>
        <li style="float: right"><a href='index.php#plan'><span>Subscription Plans</span></a></li>
    </ul>
</div>

<div id = bodyText>
    <h1 style="text-align: center; color: #00b7bb; margin-top: 2.5%">Checkout</h1>
    <hr/>
    <div class="container">
        <div class="card" style="margin-top: 8px; width: auto">
            <form name="addUser" method = "post" class="form-signin" id="addUser">
                <div class="row" style="margin: 0 auto">
                    <div>
                        <div class="row" style="margin-left: 1.6%">
                            <h2>Account Information</h2>
                            <label for="plan">Your Plan</label> <br>
                            <select name="plan" id="plan" form="addUser">
                                <option value="1">One Month - Total: $19.92</option>
                                <option value="2">Three Months - Total: $58.56</option>
                                <option value="3">Six Months - Total: $113.52</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <div style="float: left">
                                <h2>Shipping Information</h2>
                                <label for="name">Full Name</label>
                                <input type="text" name="name" id="name" required>

                                <label for="address1">Shipping Address</label>
                                <input type="text" name="address1" id="address1" placeholder=" Street Address or P.O. Box" required>

                                <label for="city">Shipping City</label>
                                <input type="text" name="city" id="city" required>

                                <label for="state">Shipping State</label> <br>
                                <select id="state" name="state" form="addUser" required>
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
                                </select>
                            </div>

                            <div style="float: left">
                                <br><br><br><label for="country">Shipping Country</label> <br>
                                <select id="country" name="country">
                                    <option value="us">United States</option>
                                </select>

                                <br><br><label for="address2">Shipping Address 2</label>
                                <input type="text" name="address2" id="address2">

                                <label for="zip_code">Shipping Zip Code</label> <br>
                                <input type="number" name="zip_code" id="zip_code" required>
                            </div>
                        </div>

                        <div>
                            <div style="float: left; margin-left: 55px">
                                <h2>Billing Information</h2>
                                <label for="card_name">Name on Card</label>
                                <input type="text" name="card_name" id="card_name" required>

                                <label for="card_number">Card Number</label> <br>
                                <input type="number" name="card_number" id="card_number" required>

                                <br><br>
                                <label for="exp_month">Exp. Month</label> <br>
                                <select id="exp_month" name="exp_month" form="addUser" required>
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
                                </select>
                            </div>

                            <div style="float: left">
                                <br><br><br><br><label for="card_name">
                                    <img src="https://1upbox.com/images/cardvisa.png">
                                    <img src="https://1upbox.com/images/cardmaster.png">
                                    <img src="https://1upbox.com/images/carddiscover.png">
                                    <img src="https://1upbox.com/images/cardamex.png">
                                </label> <br><br>

                                <label for="cvv">Card Security Code (CVV)</label> <br>
                                <input type="number" name="cvv" id="cvv" required>

                                <br><br>
                                <label for="exp_year">Exp. Year</label> <br>
                                <input type="number" name="exp_year" id="exp_year" required>
                            </div>
                        </div>
                    </div>
                </div>
                <button style="margin-top: 40px" type="submit" name="addUser" value="1" class="btn btn-primary btn-signin">Sign Up</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</div>
</body>

</html>