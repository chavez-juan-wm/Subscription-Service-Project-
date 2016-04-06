<?php require_once('connect.php')?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Files for menu bar -->
    <script src="js/navbar.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <!-- Scripts for slider -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/slider.css">

    <style>
        .img-responsive
        {
            width: 200px;
            height: 230px;
            display: block;
            margin: 0 auto;
        }
        .plan-img
        {
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div style="z-index: 10" id='cssmenu'>
        <ul>
            <li class="active"><a href='index.php'><span>Home</span></a></li>

            <?php
            if($who == "Sign In")
                echo '<li style="float: right;"><a href="login.php"><span>Sign In</span></a></li>';
            else if($who == "Profile")
                echo '<li style="float: right;"><a href="profile.php"><span>Profile</span></a></li>';
            ?>
            <li style="float: right"><a href='#plan'><span>Subscription Plans</span></a></li>
        </ul>
    </div>

    <div style="text-align: center">
        <!-- JQuery Slider [responsiveslides.com] -->
        <div id="slider">
            <ul class="rslides">
                <li>
                    <div style="width: 45%; margin: 0 auto;">
                        <div style="float: left;">
                            <img src="images/endersgame.jpg">
                        </div>
                        <div style="float: left">
                            <h3>Ender's Game</h3>
                            <p>
                                Ender's Game is a 1985 military science fiction novel <br> by American author Orson Scott Card.
                                Set in Earth's future, <br> the novel presents an imperiled mankind after two conflicts <br> with the
                                "buggers", an insectoid alien species.
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div style="width: 45%; margin: 0 auto;">
                        <div style="float: left;">
                            <img src="images/The_Maze_Runner_cover.png">
                        </div>
                        <div style="float: left">
                            <p>2</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div style="width: 45%; margin: 0 auto;">
                        <div style="float: left;">
                            <img src="images/lesson_before_dying.jpg">
                        </div>
                        <div style="float: left">
                            <p>3</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <br/><br/>

    <div id="plan">
        <h1 style="text-align: center; color: #00b7bb; margin-top: 4%">Let's Get Started</h1>
        <hr/>

        <div class="container" style="text-align: center">
            <div class="plan-box-wrap mrgn-btm5 col-lg-12 clearfix">
                <div class="box-wrap col-lg-4 col-sm-4 col-md-4">
                    <h3>1 Month Plan</h3>

                    <div class="plan-box">
                        <div class="plan-month"><span>$12.92</span> <br> Per month + $7 S&amp;H</div>
                        <div class="plan-img"><img class="img-responsive" src="images/one_book.png" alt="One Month Plan">
                        </div>
                        <div class="plan-desc">
                            <span class="plan-price">Total Price: $19.92</span>
                            <span class="plan-status"><br> Renews Automatically</span>
                            <span class="plan-choice"><br>Cancel Anytime!</span><br>
                            <a href="" class="btn btn-primary">Select</a>
                        </div>
                    </div>
                </div>
                <div class="box-wrap col-lg-4 col-md-4 col-sm-4 margin-minus">
                    <h3>3 Month plan</h3>

                    <div class="plan-box">
                        <div class="popular-plan">
                            <div class="plan-month"><span>$12.42</span> <br> Per month + $7 S&amp;H</div>
                            <div class="plan-img"><img class="img-responsive" src="images/three_books.png" alt="Three Month Plan">
                            </div>
                            <div class="plan-desc">
                                <span class="plan-price">Total Price: $58.56</span>
                                <span class="plan-status"><br>Renews Automatically</span>
                                <span class="plan-choice"><br> Save $1.20!</span> <br>
                                <a href="" class="btn btn-primary">Select</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-wrap col-lg-4 col-md-4 col-sm-4">
                    <h3>6 Month Plan</h3>

                    <div class="plan-box">
                        <div class="plan-month"><span>$11.92</span> <br> Per month + $7 S&amp;H</div>
                        <div class="plan-img"><img class="img-responsive" src="images/six_books.png" alt="Six Month Plan">
                        </div>
                        <div class="plan-desc">
                            <span class="plan-price">Total Price: $113.52</span>
                            <span class="plan-status"><br>Renews Automatically</span>
                            <span class="plan-choice"><br>Save $6!</span><br>
                            <a href="" class="btn btn-primary">Select</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <br><br><br><br>
        <div class="secondDiv"><img src="images/Books.jpg" style="width: 100%; height: 350px;"></div>
        <div class="information" style="width: 100%; height: 350px;">
            <h1 style="text-align: center; color: white"><b>What Readers Say</b></h1>

            <div id="slider">
                <ul class="rslides">
                    <li>
                        <h1 style="color: white; text-align: center"><i>"This is amazing! Now I can read all of the books I've been meaning to read!" <br><br> -Manny</i></h1>
                    </li>

                    <li>
                        <h1 style="color: white; text-align: center"><i>"You guys make my month, I love having a book to read!" <br><br> -Carlos</i></h1>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        $(function()
        {
            $(".rslides").responsiveSlides({
                auto: true,             // Boolean: Animate automatically, true or false
                speed: 800,            // Integer: Speed of the transition, in milliseconds
                timeout: 6500,          // Integer: Time between slide transitions, in milliseconds
                pager: false,           // Boolean: Show pager, true or false
                nav: false,             // Boolean: Show navigation, true or false
                random: false,          // Boolean: Randomize the order of the slides, true or false
                pause: false,           // Boolean: Pause on hover, true or false
                pauseControls: false,    // Boolean: Pause when hovering controls, true or false
                prevText: "Previous    ",   // String: Text for the "previous" button
                nextText: "    Next",       // String: Text for the "next" button
                maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
                navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
                manualControls: "",     // Selector: Declare custom pager navigation
                namespace: "rslides",   // String: Change the default namespace used
                before: function () {
                },   // Function: Before callback
                after: function () {
                }
            }); // Starts slider
        });
    </script>
</body>
</html>