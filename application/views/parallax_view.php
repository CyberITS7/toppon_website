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
    </div>
<!-- Fixed navbar -->
    <div class="menu-navbar">
            <ul class="nav1">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#howtouse">How To Use</a></li>
                <li><a href="#conv-table">Conversion Table</a></li>
                <li>
                    <div id="help-button">
                    <a href="#">
                        <img src="<?php echo base_url();?>/img/help.png" class="img-responsive"/>
                    </a>
                    </div>
                </li>
            </ul>

        <!-- Segitiga kanan dan Help -->
    <div class="triangle-r ">
        <div class="demo-topright"></div>
    </div>
    
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
        <div class="content-text-b">
        
            <div class="col-lg-3 col-md-3 col-right">
                <img src="<?php echo base_url();?>/img/how_use.png" class ="img-responsive"/>
            </div>
            <div class="col-lg-6 col-md-6">
                <h1>HOW TO USE</h1>
            </div>
            <div class="col-lg-3 col-md-3">
                <img src="<?php echo base_url();?>/img/how_use.png" class ="img-responsive"/>
            </div>
        </div>
    </div>    


    <!-- Langkah 1-->
    <div class="row bg-blue-white">
        <div class="col-lg-3 custom-row-1">
            <img src="<?php echo base_url();?>/img/howtouse/how_01.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtouse/how_to_01.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5 content-text how-text">
            <p>Anda mendaftarkan user id kepada Toppon dengan mengisi formulir pada website maupun mobile pada tombol sign up</p>
        </div>
        <div class="col-lg-1">
            <div class="triangle-r ">
                <div class="demo-topright"></div>
            </div>
        </div>
    </div>


<!-- Langkah 2 -->
    <div class="row bg-blue2-white">
        <div class="col-lg-1">
            <div class="triangle-l">
                <div class="demo-topleft"></div>
            </div>
        </div>
        <div class="col-lg-5 content-text how-text">
            <p>Anda mendaftarkan user id kepada Toppon dengan mengisi formulir pada website maupun mobile pada tombol sign up</p>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtouse/how_to_02.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-3 custom-row-2">
            <img src="<?php echo base_url();?>/img/howtouse/how_02.png" class ="img-responsive"/>
        </div>
    </div>


<!-- Langkah 3 -->    
    <div class="row bg-white-blue">
        <div class="col-lg-3 custom-row-1">
            <img src="<?php echo base_url();?>/img/howtouse/how_03.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtouse/how_to_03.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5 content-text-b how-text">
            <p>Melakukan Top Up Toppon Coin untuk pembelian voucher games pada kolom Top Up mobile maupun website Toppon</p>
        </div>
        <div class="col-lg-1">
            <div class="triangle-r ">
                <div class="demo-topright"></div>
            </div>
        </div>
    </div>
    

<!-- Langkah 4 -->    
    <div class="row bg-blue2-white">
        <div class="col-lg-1">
            <div class="triangle-l">
                <div class="demo-topleft"></div>
            </div>
        </div>
        <div class="col-lg-5 content-text how-text">
            <p>Melakukan konfirmasi Top Up kepada pihak Toppon dengan mengisi beberapa data pada kolom konfirmasi pembayaran
                di website maupun mobile Toppon</p>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtouse/how_to_04.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-3 custom-row-2">
            <img src="<?php echo base_url();?>/img/howtouse/how_04.png" class ="img-responsive"/>
        </div>
    </div>
    

<!-- Langkah 5 -->    
    <div class="row bg-blue-white">
        <div class="col-lg-3 custom-row-1">
            <img src="<?php echo base_url();?>/img/howtouse/how_05.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtouse/how_to_05.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5 content-text how-text">
            <p>Pilih voucher dan nominal yang Anda inginkan</p>
        </div>
        <div class="col-lg-1">
            <div class="triangle-r ">
                <div class="demo-topright"></div>
            </div>
        </div>
    </div>
    

<!-- Langkah 6 -->        
    <div class="row bg-white-blue">
        <div class="col-lg-1">
            <div class="triangle-l">
                <div class="demo-topleft"></div>
            </div>
        </div>
        <div class="col-lg-5 content-text-b how-text">
            <p>Transaksi akan selesai dan kode voucher games online akan dikirimkan ke e-mail Anda dan tercatat pada history transaksi Anda</p>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtouse/how_to_06.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-3 custom-row-2">
            <img src="<?php echo base_url();?>/img/howtouse/how_06.png" class ="img-responsive"/>
        </div>
    </div>    
</div>
<!--END How to Use-->


<!-- How To Redeem -->
<section>
<div id ="how-redeem" name="how-redeem">
    <div class="container">
        <div class="content-text">
            <h1>HOW TO REDEEM REWARD</h1>
        </div>
    </div>
    

<!-- Langkah 1-->
    <div class="row bg-white-blue">
        <div class="col-lg-3 custom-row-1">
            <img src="<?php echo base_url();?>/img/howtoredeem/redeem_01.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtoredeem/howredeem_01.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5 content-text-b how-text">
            <p>Pastikan point yang Anda miliki cukup untuk memenuhi persyaratan point barang yang Anda pilih</p>
        </div>
        <div class="col-lg-1">
            <div class="triangle-r ">
                <div class="demo-topright"></div>
            </div>
        </div>
    </div>

<!-- Langkah 2 -->
    <div class="row bg-blue2-white">
        <div class="col-lg-1">
            <div class="triangle-l">
                <div class="demo-topleft"></div>
            </div>
        </div>
        <div class="col-lg-5 content-text how-text">
            <p>Pilih menu Gift</p>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtoredeem/redeem_02.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-3 custom-row-2">
            <img src="<?php echo base_url();?>/img/howtoredeem/howredeem_02.png" class ="img-responsive"/>
        </div>
    </div>

<!-- Langkah 3 -->    
    <div class="row bg-blue-white">
        <div class="col-lg-3 custom-row-1">
            <img src="<?php echo base_url();?>/img/howtoredeem/redeem_03.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtoredeem/howredeem_03.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5 content-text how-text">
            <p>Pilih Reward yang Anda inginkan sesuai dengan point yang Anda miliki</p>
        </div>
        <div class="col-lg-1">
            <div class="triangle-r ">
                <div class="demo-topright"></div>
            </div>
        </div>
    </div>

<!-- Langkah 4 -->        
    <div class="row bg-white-blue">
        <div class="col-lg-1">
            <div class="triangle-l">
                <div class="demo-topleft"></div>
            </div>
        </div>
        <div class="col-lg-5 content-text-b how-text">
            <p>Reward yang Anda pilih akan tersimpan dan jika ingin melakukan pengambilan hadiah maka
                pilihlah Claim pada menu Gift</p>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtoredeem/redeem_04.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-3 custom-row-2">
            <img src="<?php echo base_url();?>/img/howtoredeem/howredeem_04.png" class ="img-responsive"/>
        </div>
    </div> 

<!-- Langkah 5 -->    
    <div class="row bg-blue-white">
        <div class="col-lg-3 custom-row-1">
            <img src="<?php echo base_url();?>/img/howtoredeem/redeem_05.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-2">
            <img src="<?php echo base_url();?>/img/howtoredeem/howredeem_05.png" class ="img-responsive"/>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5 content-text how-text">
            <p>Tim Toppon akan menghubungi Anda dan mengirimkan Reward kepada alamat yang didaftarkan kepada Toppon
                saat melakukan registrasi</p>
        </div>
        <div class="col-lg-1">
            <div class="triangle-r ">
                <div class="demo-topright"></div>
            </div>
        </div>
    </div>

</div>
</section>



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