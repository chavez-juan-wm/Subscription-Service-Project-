<?php require_once('connect.php')?>
<!DOCTYPE html>
<html lang="en">
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
    <img src="images/endersgame.jpg">
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
                            <p>1</p>
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
                        <div class="plan-month"><span>$12.92</span> Per month + $7 S&amp;H</div>
                        <div class="plan-img"><img class="img-responsive" src="images/one_book.png" alt="One Month Plan">
                        </div>
                        <div class="plan-desc">
                            <span class="plan-price">Total Price: $19.92</span>
                            <span class="plan-status">Renews Automatically</span>
                            <span class="plan-choice"><i class="glyphicon glyphicon-star"></i>Cancel Anytime !</span>
                            <a href="" class="hvr-pulse btn-border mrgn-top2">select</a>
                        </div>
                    </div>
                </div>
                <div class="box-wrap col-lg-4 col-md-4 col-sm-4 margin-minus">
                    <h3>3 Month plan</h3>

                    <div class="plan-box">
                        <div class="popular-plan">
                            <div class="plan-month"><span>$12.42</span> Per month + $7 S&amp;H</div>
                            <div class="plan-img"><img class="img-responsive" src="images/three_books.png" alt="Three Month Plan">
                            </div>
                            <div class="plan-desc">
                                <span class="plan-price">Total Price: $58.56</span>
                                <span class="plan-status">Renews Automatically</span>
                                <span class="plan-choice"><i class="glyphicon glyphicon-star"></i>save $1.20 !</span>
                                <a href="" class=" hvr-pulse btn-border mrgn-top2">select</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-wrap col-lg-4 col-md-4 col-sm-4">
                    <h3>6 Month Plan</h3>

                    <div class="plan-box">
                        <div class="plan-month"><span>$11.92</span> Per month + $7 S&amp;H</div>
                        <div class="plan-img"><img class="img-responsive" src="images/six_books.png" alt="Six Month Plan">
                        </div>
                        <div class="plan-desc">
                            <span class="plan-price">Total Price: $113.52</span>
                            <span class="plan-status">Renews Automatically</span>
                            <span class="plan-choice"><i class="glyphicon glyphicon-star"></i>save $6 !</span>
                            <a href="" class=" btn-border mrgn-top2 hvr-pulse">select</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $(".rslides").responsiveSlides(); // Starts slider
        });
    </script>
</body>
</html>