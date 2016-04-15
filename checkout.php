<?php
    require_once("connect.php");

    function send_mail($email,$message,$subject)
    {
        require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->AddAddress($email);
        $mail->Username="juan.chavez@west-mec.org";
        $mail->Password="8Bc9ZZ15";
        $mail->SetFrom('juan.chavez@west-mec.org','Pass the Book');
        $mail->AddReplyTo("juan.chavez@west-mec.org","Pass the Book");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }

    if(@$_POST['addUser'])
    {
        if(@$_POST['plan'] && @$_POST['name'] && @$_POST['address1'] && @$_POST['city'] && @$_POST['state'] && @$_POST['country']
            && @$_POST['zip_code'] && @$_POST['card_name'] && @$_POST['card_number'] && @$_POST['exp_month'] && @$_POST['exp_year'] && @$_POST['cvv'])
        {
            $query = "INSERT INTO shipping (userId, addressLine1, addressLine2, city, state, zip_code, country, full_name) VALUES (:userId, :addressLine1, :addressLine2, :city, :state, :postcode, :country, :full_name)";
            $stmt = $dbh->prepare($query);
            $stmt->execute(
                array(
                    'userId'=>$currentUser,
                    'addressLine1'=>$_POST['address1'],
                    'addressLine2'=>$_POST['address2'],
                    'city'=>$_POST['city'],
                    'state'=>$_POST['state'],
                    'postcode'=>$_POST['zip_code'],
                    'country'=>$_POST['country'],
                    'full_name'=>$_POST['name']
                )
            );

            $query = "INSERT INTO payment (userId, cardNumber, month, year, cvvCode, cardName) VALUES (:userId, :cardNumber, :month, :year, :cvvCode, :name)";
            $stmt = $dbh->prepare($query);
            $stmt->execute(
                array(
                    'userId'=>$currentUser,
                    'cardNumber'=>$_POST['card_number'],
                    'month'=>$_POST['exp_month'],
                    'year'=>$_POST['exp_year'],
                    'cvvCode'=>$_POST['cvv'],
                    'name'=>$_POST['card_name']
                )
            );

            if($_POST['plan'] == 19.92)
                $plan = 1;
            else if($_POST['plan'] == 58.56)
                $plan = 2;
            else
                $plan = 3;

            $query = "UPDATE users SET plan = :plan, step = 2 WHERE userId= :userId";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array('plan'=>$plan, 'userId'=>$currentUser));

            $query = "SELECT * FROM users WHERE userId= :userId";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array('userId'=>$currentUser));
            $result = $stmt->fetch();
            $email = $result['email'];
            send_mail($email, "Thank you for signing up! We are pleased to have another book lover join our family. We hope you enjoy our service!", "New Account");

            header("Location:thankyou.php");
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
</head>

<body>

<script>
    $(document).ready(function()
    {
        var sel = document.getElementById('plan');
        var val = localStorage.getItem("plan");
        var value = val;
        for(var i = 0, j = sel.options.length; i < j; ++i)
        {
            if(sel.options[i].value == val)
                sel.selectedIndex = i;
        }
        document.getElementById("price").innerHTML = "<h2 style='text-align: center; color: firebrick' id='price'>Total Price: $" + value + "</h2>";

        $('#plan').on("change", function(){
            var value = document.getElementById("plan").value;
            document.getElementById("price").innerHTML = "<h2 style='text-align: center; color: firebrick' id='price'>Total Price: $" + value + "</h2>";
            localStorage.setItem("plan", value);
        });

    });
</script>

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
        <li class="active" style="float: right"><a href='index.php#plan'><span>Subscription Plans</span></a></li>
    </ul>
</div>

<div>
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
                                <option value="19.92">One Month - Total: $19.92</option>
                                <option value="58.56">Three Months - Total: $58.56</option>
                                <option value="113.52">Six Months - Total: $113.52</option>
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
                                    <option value="US">United States</option>
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
                <h2 style="text-align: center; color: firebrick" id="price">Total Price: $19.92</h2>
                <button style="margin-top: 35px" type="submit" name="addUser" value="1" class="btn btn-primary btn-signin">Sign Up</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

</div>
</body>

</html>