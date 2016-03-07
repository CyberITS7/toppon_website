<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Welcome to Toppon</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/animate.min.css" rel="stylesheet">

    <!-- Custome CSS -->
    <link href="<?php echo base_url(); ?>css/toppon.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

</head>

<body>
<section id="home">
    <div id="logo">
        <a href="#">
            <img src="<?=base_url()?>img/toppon.png"/>
        </a>
     <div class="menu-right">
        <a href="#">
            <button type="button" class="btn btn-lg btn-default">Sign Up</button>
        </a>
        
        <a href="#">
            <button type="button" class="btn btn-lg btn-primary">Login</button>
        </a>
    </div>   
    </div>

<!-- Fixed navbar -->
    <div class="menu-navbar">
            <ul class="nav1">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#howtouse">How To Use</a></li>
                <li><a href="#conv-table">Toppon Coin</a></li>
                <!--
                <li>
                    <div id="help-button">
                    <a href="#">
                        <img src="<?php echo base_url();?>/img/help.png" class="img-responsive"/>
                    </a>
                    </div>
                </li>
                -->
            </ul>
    </div>
<!--End Fixed Navbar-->

<!-- Full Page Image Background Carousel Header -->
    
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('../img/img1.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 1</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('../img/img2.png');"></div>
                <div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('../img/img3.png');"></div>
                <div class="carousel-caption">
                    <h2>Caption 3</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>
    
</section>

<!--About Us-->
<div id="about" name="about">
    <div class="container">
        <div class="content-text">
            <h1>We Provides All Voucher Games</h1>
            <h2>Simple and Get Reward</h2>
            <p>Toppon will help gamers simplify to get voucher games anytime and everywhere with no limits</p>
        </div>
        <div class="col-lg-4 desktop">
            <img src="<?php echo base_url();?>/img/desktop.png" class="img-responsive"/>
        </div>
        
        <div class="col-lg-4 connect-dot">
            <img src="<?php echo base_url();?>/img/connect_dot.png" class="img-responsive"/>    
        </div>
        
        <div class="col-lg-4 mobile">
            <img src="<?php echo base_url();?>/img/mobile.png" class="img-responsive"/>
        </div>

        <button type="button" class="btn btn-lg btn-info">Sign Up Now!</button>
    </div>
</div>
<!--END About Us-->

<!--Why Us?-->
<section>
<div id="whyus" name="whyus">
    <div class="container">
        <div class="content-text-w">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
                <h1>Now get Voucher games</h1>
                <h1>Very Easy</h1>
            </div>
            <div class="whyus-content">
                <p>easy and secure for payment voucher games is our priority!</p>
            </div>
        </div>

        <div class="get-voucher">
            <a href="#">
                <h1>Get Your Voucher Games Now!</h1>
            </a>
        </div>
    </div>
</div>
</section>
<!--END Why Us?-->

<!--How to Use-->
<div id="howtouse" name="howtouse">
    <div class="container">
        <div class="content-text">
            <h1>HOW TO USE</h1>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse01.png" class ="img-responsive"/>
                <p>1. Register Your Account</p>
            </div>
            
            <div class="col-lg-4 col-md-4 col-xs-12">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse02.png" class ="img-responsive"/>
                <p>2. Fill Your Profile Correctly</p>
            </div>
            
            <div class="col-lg-4 col-md-4 col-xs-12">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse03.png" class ="img-responsive"/>
                <p>3. Top up Your Toppon Coin to purchase voucher game</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse04.png" class ="img-responsive"/>
                <p>4. Confirm Your Payment</p>
            </div>
            
            <div class="col-lg-4 col-md-4">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse05.png" class ="img-responsive"/>
                <p>5. Choose Your Games and nominal</p>
            </div>
            
            <div class="col-lg-4 col-md-4">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse06.png" class ="img-responsive"/>
                <p>6. Transaction sucess, and Enjoy Your Game</p>
            </div>
        </div>

    </div>    
</div>
<!--END How to Use-->


<!--Layer 5 -->
<section>
<div id="access-games" name="access-game">
    <div class="container">
        <div class="content-text-w">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-9">
                <h1>Access Your</h1>
                <h2>voucher games everywhere and everytime you need</h2>

            </div>
            <div class="access-2">
                <p>Games Payment Solution!</p>
            </div>
        </div>    
    </div>
</div>
</section>
<!--END Layer 5-->


<div id="contact-us" name="contact-us">
    <div class="container">
        <div class="content-text-w">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
                <h1>Now get Voucher games</h1>
                <h1>Very Easy</h1>
            </div>
            <div class="whyus-content">
                <p>easy and secure for payment voucher games is our priority!</p>
            </div>
        </div>    
    </div>
</div>


<div id="footer" name="footer">
    <div class="container">
        <div class="content-text-w">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
                <h1>Now get Voucher games</h1>
                <h1>Very Easy</h1>
            </div>
            <div class="whyus-content">
                <p>easy and secure for payment voucher games is our priority!</p>
            </div>
        </div>    
    </div>
</div>
    <!-- Script to Activate the Carousel -->
    <script>
        // Script for menu
        $( "span.menu" ).click(function() {
            $( "ul.nav1" ).slideToggle( 300, function() {
                // Animation complete.
            });
        });
        $('.carousel').carousel({
            interval: 3500 //changes the speed
        })
    </script>

<!--
    <script>
        function fixDiv() {
            var topmenu = $('.menu-navbar');
            if ($(window).scrollTop() > 120)
                topmenu.addClass("fix-top-menu");
            else
                topmenu.removeClass("fix-top-menu");
        }
        $(window).scroll(fixDiv);
            fixDiv();
    </script>
-->
    <script>
    //scroll
    $(function() {
       $('.menu-navbar ul li a').click(function () {
            var url = $(this).attr('href');
            $('html,body').animate({
                scrollTop: $(url).offset().top
            }, 1500, 'linear');
            return false;
        });
   });
    </script>
</body>

</html>