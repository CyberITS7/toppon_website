<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Welcome to Toppon</title>

    <!-- Reset CSS -->
    <link href="<?php echo base_url(); ?>css/resetcss.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>css/toppon.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    
    <!-- CUSTOM FONTS -->
    <link href="<?php echo base_url();?>fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

</head>

<body >

<section id="home">
    <div id="logo">
        <a href="#">
            <img src="<?=base_url()?>img/toppon.png"/>
        </a>

        <div class="menu-right">
             <a href="<?php echo site_url('User');?>#toregister">
                 <button type="button" class="btn btn-lg btn-default">Sign Up</button>
             </a>

             <a href="<?php echo site_url('User');?>#tologin">
                 <button type="button" class="btn btn-lg btn-primary">Login</button>
             </a>
        </div>
    </div>

<!-- Fixed navbar -->

    <div class="menu-navbar navbar-default navbar-fixed-top">
            <ul class="nav1">
                <li><a href="#home" class="page-scroll active">Home</a></li>
                <li><a href="#about" class="page-scroll">About Us</a></li>
                <li><a href="#howtouse" class="page-scroll">How To Use</a></li>
                <li><a href="#conv-table" class="page-scroll">Toppon Credit</a></li>
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
    
    <header id="myCarousel" class="carousel slide slide-img">
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
                <div class="fill" style="background-image:url('../img/slider/slide01.jpg');"></div>
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('../img/slider/slide02.jpg');"></div>
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('../img/slider/slide03.jpg');"></div>
                <div class="carousel-caption">
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
        
        <div class="row">
            <div class="about-row-wrapper">
                <div class="about-items wow bounceInLeft" data-wow-duration="1s">
                    <img src="<?php echo base_url();?>/img/desktop.png" class="img-responsive"/>
                </div>
                
                <div class="connect-dot wow bounceInLeft" data-wow-delay="1.2s" data-wow-duration="1s">
                    <img src="<?php echo base_url();?>/img/connect_dot.png" class="img-responsive"/>    
                </div>
                
                <div class="about-items wow bounceInLeft" data-wow-delay="2s" data-wow-duration="1s">
                    <img src="<?php echo base_url();?>/img/mobile.png" class="img-responsive"/>
                </div>
            </div>
        </div>
        <a href="<?php echo site_url('User');?>#toregister">
            <button type="button" class="btn btn-lg btn-info">Sign Up Now!</button>
        </a>
    </div>
</div>
<!--END About Us-->

<!--Why Us?-->
<section >
<div id="whyus" class="parallax" name="whyus">
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
            <a href="<?php echo site_url('User');?>#toregister">
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

        <div class="use-wrapper">

        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12 wow bounceInDown" data-wow-duration="1.0s">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse01.png" class ="img-responsive"/>
                <p>1. Register Your Account</p>
            </div>
            
            <div class="col-lg-4 col-md-4 col-xs-12 wow bounceInDown" data-wow-duration="1.0s">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse02.png" class ="img-responsive"/>
                <p>2. Fill Your Profile Correctly</p>
            </div>
            
            <div class="col-lg-4 col-md-4 col-xs-12 wow bounceInDown" data-wow-duration="1.0s">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse03.png" class ="img-responsive"/>
                <p>3. Top up Your Toppon Coin to purchase voucher game</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 wow bounceInUp" data-wow-duration="1.0s">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse04.png" class ="img-responsive"/>
                <p>4. Confirm Your Payment</p>
            </div>
            
            <div class="col-lg-4 col-md-4 wow bounceInUp" data-wow-duration="1.0s">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse05.png" class ="img-responsive"/>
                <p>5. Choose Your Games and nominal</p>
            </div>
            
            <div class="col-lg-4 col-md-4 wow bounceInUp" data-wow-duration="1.0s">
                <img src="<?php echo base_url();?>/img/howtouse/howtouse06.png" class ="img-responsive"/>
                <p>6. Transaction sucess, and Enjoy Your Game</p>
            </div>
        </div>

        </div>

    </div>    
</div>
<!--END How to Use-->


<!--Layer 5 -->
<section >
<div id="access-games" class="parallax" name="access-game">
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

<!--How To Redeem-->
<section>
<div id="how-redeem">
    <div class="container">
       <div class="content-text">
            <h1>HOW TO REDEEM</h1>
        </div>
        <div class="redeem-content">
            <div class="titik-redeem">
               <img src="<?php echo base_url();?>/img/howtoredeem/line.png" class="img-responsive"/>
            </div>

            <div class="redeem-item wow rollIn" data-wow-duration="1.0s" id="redeem-pusat">
                <img src="<?php echo base_url();?>/img/howtoredeem/pusat.png" class="img-responsive"/>
            </div>
            <div class="redeem-item wow rollIn" data-wow-duration="1.0s" data-wow-delay="1.2s" id="redeem-item-1">
                <img src="<?php echo base_url();?>/img/howtoredeem/redeem1.png" class="img-responsive"/>
            </div>
            <div class="redeem-item wow bounceInUp" data-wow-duration="1.0s" data-wow-delay="1.5s" id="redeem-item-2">
                <img src="<?php echo base_url();?>/img/howtoredeem/redeem2.png" data-wow-delay="1s" class="img-responsive"/>
            </div>
            <div class="redeem-item wow lightSpeedIn" data-wow-duration="1.0s" data-wow-delay="1.8s" id="redeem-item-3">
                <img src="<?php echo base_url();?>/img/howtoredeem/redeem3.png" class="img-responsive"/>
            </div>
            <div class="redeem-item wow bounceInRight" data-wow-duration="1.0s" data-wow-delay="2s" id="redeem-item-4">
                <img src="<?php echo base_url();?>/img/howtoredeem/redeem4.png" class="img-responsive"/>
            </div>
            <div class="redeem-item wow rollIn" data-wow-duration="1.0s" data-wow-delay="2.2s" id="redeem-item-5">
                <img src="<?php echo base_url();?>/img/howtoredeem/redeem5.png" class="img-responsive"/>
            </div>
        </div>
    </div>
</div>
</section>
<!--End How To Redeem-->


<!-- Toppon Quote -->
<section>
    <div id="quote" name="quote">
        <div class="container">
            <div class="quote-text">
                <div class="quote-left">
                    <p>" The More You Play</p>
                </div>
                <div class="quote-right">
                    <p>The More You Get Reward"</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Quote -->


<!-- Conversion Table -->
<div id="conv-table" name="conv-table">
    <div class="content-text">
        <h1>Toppon Credit</h1>
    </div>
    <div class="container">
        <div class="toppon-credit">
            <img src="<?php echo base_url();?>/img/topponcredit/credit.png" class="img-responsive"/>
            <div class="content-text"> 
                    <p>Toppon Credits adalah mata uang online dimana para gamer bisa melakukan</p>
                    <p>TOP UP untuk setiap pembelian voucher games</p>
                    <p>Nilai Tukar Toppon Credits untuk setiap 1TC = Rp.100</p>
                    <p>dan berlaku untuk kelipatannya</p>
            </div>

            <div class="row">
                <div class="about-row-wrapper">
                    <div class="credit-items wow bounceInRight" data-wow-duration="1.5s">
                        <img src="<?php echo base_url();?>/img/topponcredit/credit01.png" class="img-responsive"/>
                    </div>
                    
                    <div class="credit-items wow bounceInRight" data-wow-delay="1.2s" data-wow-duration="1.5s">
                        <img src="<?php echo base_url();?>/img/topponcredit/credit02.png" class="img-responsive"/>    
                    </div>
                    
                    <div class="credit-items wow bounceInRight" data-wow-delay="1.8s" data-wow-duration="1.5s">
                        <img src="<?php echo base_url();?>/img/topponcredit/credit03.png" class="img-responsive"/>
                    </div>
                </div>
            </div>

        </div>
        
        <a href="#">
            <button type="button" class="btn-topup btn btn-lg btn-info">Register Now!</button>
        </a>
    </div>

</div>





<!--Contact US-->
<div id="contact-us" name="contact-us">
    <div class="content-text">
        <h1>CONTACT US</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="contact-form-container">
            <!--ContactForm-->
            <h3>Have any question for us?</h3>
                <form id="contactForm" name="sentMessage" class="form" novalidate="">
                <div class="row">
                    <div id="success_ajax" class="text-center"> </div>
                </div>
                <div class="row">
                    <div id="contactName-group" class="col-xs-12 col-sm-6 col-md-6 form-group">
                        <input type="text" id="contactName" class="form-control form-custom" placeholder="Name" required="required">
                        <div id = "show_error_name" class="help-block"></div>
                    </div>
                    <div id="contactEmail-group" class="col-xs-12 col-sm-6 col-md-6 form-group">
                        <input type="email" id="contactEmail" class="form-control form-custom" placeholder="Email" required="required">
                        <div id = "show_error_email_address" class="help-block"></div>
                    </div>
                    <div id="contactSubject-group" class="col-xs-12 col-md-12 form-group">
                        <input type="text" id="contactSubject" class="form-control form-custom" placeholder="Subject" required="required">
                        <div id = "show_error_subject" class="help-block"></div>
                    </div>
                    <div id="contactMessage-group" class="col-xs-12 col-md-12 form-group">
                        <textarea name="contactMessage" id="contactMessage" class="form-control form-custom" rows="5" placeholder="Message" required=""></textarea>
                        <div id = "show_error_contact_message" class="help-block"></div>
                    </div>
                </div>

                <div id="success"></div>
                    <button class="btn btn-lg btn-default" type="submit">Send</button>
            </form>
            <!-- form -->
            </div>
        </div>
        <div class="col-lg-6">
            <div class="contact-detailed">
                <div class="telepon">
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="<?php echo base_url();?>/img/phone.png" class="img-responsive">
                        </div>
                        <div class="col-lg-9 no-tlp wow lightSpeedIn" data-wow-duration="1.5s">
                            <p>+62-812-9025-5465</p>
                        </div>
                    </div>
                </div>
                <div class="mail">
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="<?php echo base_url();?>/img/mail.png" class="img-responsive">
                        </div>
                        <div class="col-lg-9 dest-mail wow lightSpeedIn" data-wow-duration="1.5s">
                            <p>cs@toppon.co.id</p>
                        </div>
                        </div>
                </div>
                <div class="alamat wow lightSpeedIn" data-wow-duration="1.5s">
                    <p>Jl. Kebon Jeruk No.27 Kemanggisan, Jakarta Barat</p>
                </div>
            </div>
        </div>
    </div>    
</div>

<!-- Footer -->
<div id="footer" name="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="social-media">
                    <h3>Find Us On</h3>
                    <div class="row social-wrapper">
                        <div class ="social-item wow pulse" data-wow-iteration="7" data-wow-duration="0.25s">
                            <a href ="www.facebook.com">
                                <img src="<?php echo base_url();?>/img/sosmed/fb.png" class="img-responsive"/>
                            </a>
                        </div>

                        <div class ="social-item wow pulse" data-wow-iteration="7" data-wow-duration="0.25s">
                            <a href ="www.twitter.com">
                                <img src="<?php echo base_url();?>/img/sosmed/twitter.png" class="img-responsive"/>
                            </a>
                        </div>
                        <div class ="social-item wow pulse" data-wow-iteration="7" data-wow-duration="0.25s">
                            <a href ="www.instagram.com">
                                <img src="<?php echo base_url();?>/img/sosmed/ig.png" class="img-responsive"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/battle.png" class="img-responsive"/>
                    </div>

                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/wavegame.png" class="img-responsive"/>
                    </div>

                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/gplay.png" class="img-responsive"/>
                    </div>
                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/itunes.png" class="img-responsive"/>
                    </div>                   
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/playstation.png" class="img-responsive"/>
                    </div>

                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/mogplay.png" class="img-responsive"/>
                    </div>

                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/gemscool.png" class="img-responsive"/>
                    </div>
                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/garena.png" class="img-responsive"/>
                    </div>                   
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/fbgamecard.png" class="img-responsive"/>
                    </div>

                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/lyto.png" class="img-responsive"/>
                    </div>

                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/steam.png" class="img-responsive"/>
                    </div>
                    <div class="col-lg-3">
                        <img src="<?php echo base_url();?>/img/voucher/ps_psn_cards.png" class="img-responsive"/>
                    </div>                   
                </div>
            </div>

            <div class="col-lg-3">
                <div class="bank-transfer">
                <h4>Bank Transfer</h4>
                <img src="<?php echo base_url();?>/img/bca.png" class="img-responsive"/>
                </div>
            </div> 
        </div>

        <div class="footer-text">
            ©Toppon 2015 | Partnership   Terms & Condition   Mobile Apps   Blog
        </div>  
    </div>
</div>

<!--End footer -->

<!-- BUTTON BACK TO TOP HOME -->
<div style = "visibility:show;" id="back_to_top">
    <a href="#home"> 
        <img class="img img-circle" src="<?php echo base_url();?>/img/back-to-top.png" height="50px" width="50px" alt="back-to-top">
    </a>
</div>
<!-- END BUTTON BACK TO TOP HOME -->
 

    <!-- JS MENU -->
    <script src="<?php echo base_url()?>js/classie.js"></script>
    <script src="<?php echo base_url()?>js/cbpAnimatedHeader.js"></script>
    <script src="<?php echo base_url()?>js/agency.js"></script>

<script>
  $(function() {
      var div_loading = $("<div>", {id: "fountainG"});
      var div_loading_item1 = $("<div>", {id: "fountainG_1", class: "fountainG"});
      var div_loading_item2 = $("<div>", {id: "fountainG_2", class: "fountainG"});
      var div_loading_item3 = $("<div>", {id: "fountainG_3", class: "fountainG"});
      var div_loading_item4 = $("<div>", {id: "fountainG_4", class: "fountainG"});
      var div_loading_item5 = $("<div>", {id: "fountainG_5", class: "fountainG"});
      var div_loading_item6 = $("<div>", {id: "fountainG_6", class: "fountainG"});
      var div_loading_item7 = $("<div>", {id: "fountainG_7", class: "fountainG"});
      var div_loading_item8 = $("<div>", {id: "fountainG_8", class: "fountainG"});
      div_loading.append(div_loading_item1,div_loading_item2,div_loading_item3,div_loading_item4,div_loading_item5,div_loading_item6,div_loading_item7,div_loading_item8);

    // Get the form.
    var form = $('#contactForm');
    // Set up an event listener for the appointment form.
    $(form).submit(function(e) {
      // Stop the browser from submitting the form.
      e.preventDefault();
      // user data
      var contactName     = $("#contactName").val().trim();
      var contactEmail    = $("#contactEmail").val().trim();
      var contactSubject    = $("#contactSubject").val().trim();
      var contactMessage  = $("#contactMessage").val().trim();


      if (validateContactForm()) {
        $.ajax({
          type : "POST",
          url : "<?php echo site_url('Home/Send_email_contactus'); ?>",
          dataType : "json",
          data : {    contactName : contactName,
                      contactEmail : contactEmail,
                      contactSubject : contactSubject,
                      contactMessage : contactMessage
                  },
           beforeSend: function() {
               $("#success_ajax").addClass("alert alert-info");
               $("#success_ajax").append(div_loading);
           },
          success : function(result, status, xhr){
            $("#success_ajax").html("");
            $("#success_ajax").removeClass("alert alert-info");
            $("#success_ajax").removeClass("alert alert-danger");
            $("#success_ajax").addClass("alert alert-success");
            $("#success_ajax").html(result.msg);
            $('#success_ajax').fadeIn().delay(4000).fadeOut();

            $('#contactForm')[0].reset();
           

          },
          error : function(result, status, xhr){
            console.log('error mau keserver');
            //console.log(result.msg);
            $("#success_ajax").html("");
            $("#success_ajax").removeClass("alert alert-info");
            $("#success_ajax").removeClass("alert alert-success");
            $("#success_ajax").addClass("alert alert-danger");
            $("#success_ajax").html('Thank you for your message, but we are sorry your message wont reach us any time soon. We will fix it as soon as posible');
            $('#success_ajax').fadeIn().delay(8000).fadeOut();

            $('#contactForm')[0].reset();
           
          }
        });// End Ajax
      } 
       // End if else statement
    }); // End Form Submit

    function validateContactForm(){
        var err = 0;
        var contactName     = $("#contactName").val().trim();
        var contactEmail    = $("#contactEmail").val().trim();
        var contactSubject    = $("#contactSubject").val().trim();
        var contactMessage  = $("#contactMessage").val().trim();

        $('#show_error_name').html(''); // remove the error text first
        $('#show_error_email_address').html(''); // remove the error text first
        $('#show_error_subject').html(''); // remove the error text first
        $('#show_error_contact_message').html(''); // remove the error text first

        $('#contactName-group').removeClass('has-error');
        $('#contactEmail-group').removeClass('has-error');
        $('#contactSubject-group').removeClass('has-error');
        $('#contactMessage-group').removeClass('has-error');
        // show error if submit button is press
        if (contactName == '' && contactName.length <= 3) {
          $('#contactName-group').addClass('has-error');
          $('#show_error_name').html('Please Input Your Name');
          err++;
        }
        else if (contactName.length <= 3) {
          $('#contactName-group').addClass('has-error');
          $('#show_error_name').html('Your Name is too short, atleast min. 4 letters');
          err++;
        }
        if (contactEmail == '') {
          $('#contactEmail-group').addClass('has-error');
          $('#show_error_email_address').html('Please Input Your Email Address' );
          err++;
        }else if(!validateEmail(contactEmail)){
            $('#contactEmail-group').addClass('has-error');
            $('#show_error_email_address').html('Invalid Format Email' );
            err++;

        }
        if (contactSubject == '') {
          $('#contactSubject-group').addClass('has-error');
          $('#show_error_subject').html('Please Input Your Subject');
          err++;
        }
        if (contactMessage == '') {
          $('#contactMessage-group').addClass('has-error');
          $('#show_error_contact_message').html('Please Input Your Message');
          err++;
        }

        if(err==0){
            return true;
        }
        else{
            return false;
        }
            
    }
    function validateEmail(email)
    {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

  }); // End Function
</script>



<!-- WowJS -->
 <script src="<?php echo base_url()?>js/wow.min.js"></script>

 <script>
        new WOW().init();
</script>   

 <!-- SCRIPT BACK TO TOP -->
    <script src="<?php echo base_url();?>js/jquery.easing.js"></script>

    <script>
        $(document).ready(function() {
            var offset = 200;
            var duration = 600;
            $(window).scroll(function() {
                if ($(this).scrollTop() > offset) {
                    $("#back_to_top").fadeIn(duration);
                }
                else {
                    $("#back_to_top").fadeOut(duration);
                }
            });
            $("#back_to_top").click(function(event) {
                event.preventDefault();
                $("html,body").animate({scrollTop: 0}, 1000, 'easeInOutExpo');
                $('.menu-navbar ul li a').removeClass("active");
                $('.menu-navbar ul li a[href="#home"]').addClass("active");
                return false;
            });
        });
    </script>
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
            $('.menu-navbar ul li a').removeClass("active");
            $(this).addClass("active");
            $('html,body').animate({
                scrollTop: $(url).position().top
            }, 1500, 'linear');
            return false;
        });

   });
    </script>
</body>

</html>