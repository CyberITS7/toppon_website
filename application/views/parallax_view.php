<html>
<head>
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

<!-- Fixed navbar -->
<div class="navbar navbar-custom">
  <div class="container">
    <div class="left-navbar">
        <a href="#">
        <img src="<?=base_url()?>img/toppon.png"/></a>
    </div>
     
    <div class="right-navbar">
          <ul>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Login</a></li>
          </ul>
    </div>
    
    <div class="clearfix"> </div>
  </div>
</div>
<!--End Fixed Navbar-->
<div class="menu-navbar navbar-fixed-top">
    <div class="container">
        <ul class="nav1">
            <li><a href="#myCarousel">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#howtouse">How To Use</a></li>
            <li><a href="#conv-table">Conversion Table</a></li>
        </ul>

    <!-- Segitiga kanan dan Help -->
    <div class="triangle ">
        <a href="#">
            <span class="glyphicon glyphicon-question-sign"></span>
        </a>
        <div class="demo-topright"></div>
    </div>

    </div>
</div>

<!-- Full Page Image Background Carousel Header -->
    <div class = "container">
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
  </div>


<!--About Us-->
<div id="about" name="about">
  <div class="container">
    ABOUT US
  </div>
</div>
<!--END About Us-->

<!--Why Us?-->
<section>
<div id="whyus" name="whyus">
  <div class="container">
    WHY US?
  </div>
</div>
</section>
<!--END Why Us?-->

<!--How to Use-->
<div id="howtouse" name="howtouse">
  <div class="container">
    HOW TO USE
  </div>
</div>
<!--END How to Use-->

<!--Conversion Table-->
<section>
<div id="conv-table" name="conv-table">
  <div class="container">
    CONVERSION TABLE
  </div>
</div>
</section>
<!--END Conversion Table-->

    <!-- Script to Activate the Carousel -->
    <script>
        // Script for menu
        $( "span.menu" ).click(function() {
            $( "ul.nav1" ).slideToggle( 300, function() {
                // Animation complete.
            });
        });
        $('.carousel').carousel({
            interval: 4500 //changes the speed
        })
    </script>

</body>

</html>