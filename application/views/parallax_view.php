<html>
<head>
    <title>Welcome to Toppon</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/animate.min.css" rel="stylesheet">

    <link href="<?=base_url()?>css/toppon.css" rel="stylesheet">

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

    <div class="menu-navbar">
    
        <ul class="nav1">
          <li><a href="#" data-toggle="modal" data-target="#myModal">Home</a></li>
          <li><a href="#" data-toggle="modal" data-target="#myModal2">About Us</a></li>
          <li><a href="#" data-toggle="modal" data-target="#myModal1">How To Use</a></li>
          <li><a href="#" data-toggle="modal" data-target="#myModal3">Conversion Table</a></li>
        </ul>
            <!-- script-for-menu -->
             <script>
               $( "span.menu" ).click(function() {
               $( "ul.nav1" ).slideToggle( 300, function() {
               // Animation complete.
                });
               });
            </script>
            <!-- /script-for-menu -->
    </div>


  </div>
</div>
<!--End Fixed Navbar-->

<!--slider-->
<section>
<div class="slider-1" name="slider">
  <div class="container">
    SLIDER NOT READY
  </div>
</div>

</section>
<!--END slider-->

<!--About Us-->
<div class="about" name="about">
  <div class="container">
    ABOUT US
  </div>
</div>
<!--END About Us-->

<!--Why Us?-->
<section>
<div class="whyus" name="whyus">
  <div class="container">
    WHY US?
  </div>
</div>
</section>
<!--END Why Us?-->

<!--How to Use-->
<div class="howtouse" name="howtouse">
  <div class="container">
    HOW TO USE
  </div>
</div>
<!--END How to Use-->

<!--Conversion Table-->
<section>
<div class="conv-table" name="conv-table">
  <div class="container">
    CONVERSION TABLE
  </div>
</div>
</section>
<!--END Conversion Table-->

</body>

</html>