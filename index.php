<?php require_once('connect.php');?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pass the Book</title>

    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Files for menu bar -->
    <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

    <!-- Scripts for slider -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/slider.css">

    <!-- Scripts for timer -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="js/TimeCircles.js"></script>
    <link rel="stylesheet" href="css/TimeCircles.css" />

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
        .intro
        {
            font-size: x-large;
            line-height: 45px;
        }
    </style>
</head>

<body>

<script>
    $(document).ready(function(){
        $("#plan1").click(function()
        {
            localStorage.setItem("plan", 19.92);
        });

        $("#plan2").click(function()
        {
            localStorage.setItem("plan", 58.56);
        });

        $("#plan3").click(function()
        {
            localStorage.setItem("plan", 113.52);
        });
    });
</script>

    <div style="z-index: 10" id='cssmenu'>
        <ul>
            <li class="active"><a href='index.php'><span>Home</span></a></li>

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

    <div style="text-align: center">

        <h1>The Best Books Delivered To You</h1>
        <hr>
        <p class="intro">
             <i style="color: green">Pass the Book</i> is the best monthly subscription box for book lovers everywhere! <br>
            Join thousands of readers today and get the <b>absolute best </b>books delivered to your front door.
        </p>
        <h1 style="text-align: center; color: #00b7bb; margin-top: 43px">Past Books Delivered</h1>
        <!-- JQuery Slider [responsiveslides.com] -->
        <div id="slider">
            <ul class="rslides">
                <li>
                    <div style="width: 45%; margin: 0 auto;">
                        <div style="float: left;">
                            <img src="http://www.hatrack.com/osc/books/endersgame/endersgame.jpg">
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
                    <div style="width: 49%; margin: 0 auto;">
                        <div style="float: left;">
                            <img src="https://upload.wikimedia.org/wikipedia/en/d/db/The_Maze_Runner_cover.png">
                        </div>
                        <div style="float: left">
                            <h3>The Maze Runner</h3>
                            <p>
                                Thomas, a teenager, arrives in a glade at the center of <br> a giant labyrinth. Like the other
                                youths dumped there before him, <br> he has no memory of his previous life. Together with Teresa, <br>
                                Thomas tries to convince his cohorts that he knows a way out.
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div style="width: 51%; margin: 0 auto;">
                        <div style="float: left;">
                            <img src="https://upload.wikimedia.org/wikipedia/en/b/bf/Harry_Potter_and_the_Sorcerer's_Stone.jpg">
                        </div>
                        <div style="float: left">
                            <h3>Harry Potter and the Philosopher's Stone</h3>
                            <p>
                                The plot follows Harry Potter, a young wizard who discovers <br> his magical heritage as he
                                makes close friends and a few enemies in <br> his first year at the Hogwarts School
                                of Witchcraft and Wizardry. With the <br> help of his friends, Harry faces an attempted
                                comeback by the dark <br> wizard Lord Voldemort, who killed Harry's parents, but failed to
                                kill <br> Harry when he was just a year old.
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div style="width: 48%; margin: 0 auto;">
                        <div style="float: left;">
                            <img src="http://ecx.images-amazon.com/images/I/51yBluUtuNL._SX320_BO1,204,203,200_.jpg">
                        </div>
                        <div style="float: left">
                            <h3>A Lesson Before Dying</h3>
                            <p>
                                A Lesson Before Dying tells the story of Jefferson, a <br> twenty-one-year-old uneducated
                                black field worker wrongfully <br> accused and convicted of the robbery and murder of a white <br>
                                man, and sentenced to death by electrocution. Determined that <br> Jefferson will die with
                                dignity, his godmother, Miss Emma, turns to <br> Grant Wiggins, a black teacher at
                                the local plantation school, <br> and asks him to teach Jefferson to be a man.
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div style="width: 45%; margin: 0 auto;">
                        <div style="float: left;">
                            <img src="http://ecx.images-amazon.com/images/I/61JPcCSRAXL.jpg">
                        </div>
                        <div style="float: left">
                            <h3>Lord of the Flies</h3>
                            <p>
                                Lord of the Flies is a 1954 novel by Nobel Prize-winning <br> English author William Golding
                                about a group of <br> British boys stuck on an uninhabited island who try <br> to govern themselves
                                with disastrous results.
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="container">
            <h3 style="text-align: center">Hurry! Spots for the April Box Close In…</h3>
            <div id="DateCountdown" data-date="2016-04-20 00:00:00" style="width: 390px; height: 95px; padding: 0; box-sizing: border-box; margin-left: auto; margin-right: auto"></div>
        </div>
        <script>
            $("#DateCountdown").TimeCircles();
            $("#CountDownTimer").TimeCircles({ time: { Days: { show: false }, Hours: { show: false } }});
            $("#PageOpenTimer").TimeCircles();
        </script>
    </div>

    <br/>

    <div>
        <br>
        <div class="secondDiv"><img src="pictures/Books.jpg" style="width: 100%; height: 290px;"></div>
        <div class="information" style="width: 100%; height: 290px;">
            <h1 style="text-align: center; color: white"><b>What Readers Say</b></h1>

            <div id="slider">
                <ul class="rslides">
                    <li>
                        <h1 style="color: white; text-align: center"><i>"These books are great!" <br><br> -Vuong</i></h1>
                    </li>
                    <li>
                        <h1 style="color: white; text-align: center"><i>"This is amazing! Now I can always have a new book ready for me to read!" <br><br> -Manny</i></h1>
                    </li>

                    <li>
                        <h1 style="color: white; text-align: center"><i>"You guys make my month, I love having a book to read!" <br><br> -Carlos</i></h1>
                    </li>
                    <li>
                        <h1 style="color: white; text-align: center"><i>"I'll be a member forever because there are too many books to read!" <br><br> -Austin</i></h1>
                    </li>
                    <li>
                        <h1 style="color: white; text-align: center"><i>"I've loved every single book I've gotten! Thank you!" <br><br> -Kyle</i></h1>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="plan">
        <h1 style="text-align: center; color: #00b7bb; margin-top: 4%">Let's Get Started</h1>
        <hr/>

        <div class="container" style="text-align: center">
            <div class="plan-box-wrap mrgn-btm5 col-lg-12 clearfix">
                <div class="box-wrap col-lg-4 col-sm-4 col-md-4">
                    <h3>1 Month Plan</h3>

                    <div class="plan-box">
                        <div class="plan-month"><span>$12.92</span> <br> Per month + $7 S&amp;H</div>
                        <div class="plan-img"><img class="img-responsive" src="http://4vector.com/i/free-vector-book_102706_Book.png" alt="One Month Plan">
                        </div>
                        <div class="plan-desc">
                            <span class="plan-price">Total Price: $19.92</span>
                            <span class="plan-status"><br> Renews Automatically</span>
                            <span class="plan-choice"><br>Cancel Anytime!</span><br><br>
                            <a href="<?php
                            if($step == 1)
                                echo "checkout.php";
                            else if($step == 2)
                                echo "profile.php";
                            else
                                echo "signup.php";
                            ?>" class="btn btn-primary" id="plan1">Select</a>
                        </div>
                    </div>
                </div>
                <div class="box-wrap col-lg-4 col-md-4 col-sm-4 margin-minus">
                    <h3>3 Month plan</h3>

                    <div class="plan-box">
                        <div class="popular-plan">
                            <div class="plan-month"><span>$12.42</span> <br> Per month + $7 S&amp;H</div>
                            <div class="plan-img"><img class="img-responsive" src="https://openclipart.org/image/2400px/svg_to_png/169613/3redbooks.png" alt="Three Month Plan">
                            </div>
                            <div class="plan-desc">
                                <span class="plan-price">Total Price: $58.56</span>
                                <span class="plan-status"><br>Renews Automatically</span>
                                <span class="plan-choice"><br> Save $1.20!</span> <br><br>
                                <a href="<?php
                                if($step == 1)
                                    echo "checkout.php";
                                else if($step == 2)
                                    echo "profile.php";
                                else
                                    echo "signup.php";
                                ?>" class="btn btn-primary" id="plan2">Select</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-wrap col-lg-4 col-md-4 col-sm-4">
                    <h3>6 Month Plan</h3>

                    <div class="plan-box">
                        <div class="plan-month"><span>$11.92</span> <br> Per month + $7 S&amp;H</div>
                        <div class="plan-img"><img class="img-responsive" src="http://clipartfreefor.com/cliparts/files/stack-of-books-images-RTdg5rLGc.png" alt="Six Month Plan">
                        </div>
                        <div class="plan-desc">
                            <span class="plan-price">Total Price: $113.52</span>
                            <span class="plan-status"><br>Renews Automatically</span>
                            <span class="plan-choice"><br>Save $6!</span><br><br>
                            <a href="<?php
                            if($step == 1)
                                echo "checkout.php";
                            else if($step == 2)
                                echo "profile.php";
                            else
                                echo "signup.php";
                            ?>" class="btn btn-primary" id="plan3">Select</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

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