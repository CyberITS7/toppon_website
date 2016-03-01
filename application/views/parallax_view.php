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
<div class="menu-navbar">
    <div class="container">
        <ul class="nav1">
            <li><a href="#home">Home</a></li>
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
        <h1>ABOUT US</h1>
        <p>Toppon adalah platform untuk pembelian voucher games online yang memberikan kemudahan dan kelebihan bagi para Customer
            kami dengan kelengkapan dan kemudahan dalam memperoleh voucher games online. Kami memberikan berbagai pilihan reward 
            kepada Customer sebagai penghargaan kami terhadap Customer dengan memberikan point yang dapat ditukarkan di setiap 
            pengisian top up koin Toppon</p>
        <p>Kami memberikan perhatian kepada kemudahan dan kenyamanan dalam bertransaksi bagi para Customer kami dengan terus 
            mengembangkan teknologi serta pelayanan bagi kemudahan dan kenyamanan Customer. Tim kami selalu memberikan pelayanan
            terbaik dan professional demi kepuasan Customer dalam kemudahan untuk membeli voucher games online.</p>
    </div>
  </div>
</div>
<!--END About Us-->

<!--Why Us?-->
<section>
<div id="whyus" name="whyus">
  <div class="container">
    <div class="content-text">
        <h1>WHY US?</h1>
        <p>Untuk setiap top up Toppon Koin dalam pembelian voucher games online, kami akan memberikan poin kepada Customer yang
            dapat ditukarkan berbagai macam reward secara langsung yang akan dikirimkan oleh tim Toppon. Anda dapat dengan mudah
            membeli voucher games online dengan menggunakan mobile dan web serta mendapatkan reward, reward yang kami tawarkan dan
            berikan memiliki banyak macam yang dapat mendukung Anda dalam memenuhi keinginan terhadap suatu barang. Beli voucher games
            online mudah dan untung hanya di Toppon.id</p> 
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <img src="<?php echo base_url();?>/img/whyus/why_us_1.png" class ="img-responsive"/>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
            <img src="<?php echo base_url();?>/img/whyus/why_us_2.png" class ="img-responsive"/>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-clear">
            <img src="<?php echo base_url();?>/img/whyus/why_us_3.png" class ="img-responsive"/>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <img src="<?php echo base_url();?>/img/whyus/why_us_4.png" class ="img-responsive"/>
        </div>
    </div>
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
            interval: 3500 //changes the speed
        })
    </script>

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