<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Toppon | Dashboard Page</title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">    
    <link href="<?php echo base_url(); ?>css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/floatexamples.css" rel="stylesheet" type="text/css" />

    <!-- Alertify -->
    <link href="<?php echo base_url(); ?>css/alertify.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/themes/default.min.css" rel="stylesheet">

    <style>
    .home-logo{
        width: 44px;
        border-radius: 100%;
    }
    .toppon-coins{
        width: 22px;        
    }
    </style>
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/alertify.min.js"></script>
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo site_url("User");?>" class="site_title"><img src="<?php echo base_url(); ?>img/icon_toppon.jpg" class="home-logo"><span>&nbsp;Toppon</span></a>
                    </div>
                    <div class="clearfix"></div>                    
                   
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Member Coins</h3>
                            <ul class="nav side-menu">
                                <!--<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="index.html">Dashboard</a>
                                            </li>
                                            <li><a href="index2.html">Dashboard2</a>
                                            </li>
                                            <li><a href="index3.html">Dashboard3</a>
                                            </li>
                                        </ul>
                                    </li>-->                                
                                <li><a href="#"><img src="<?php echo base_url(); ?>img/TC.png" class="toppon-coins" > <span id="toppon-coin-content">0</span></a></li>
                                <li><a href="#"><img src="<?php echo base_url(); ?>img/TP.png" class="toppon-coins" > <span id="toppon-poin-content">0</span></a></li>
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3>Navigation</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-gamepad"></i> Game Purchase <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" id="category-game" style="display: none">

                                    </ul>
                                </li>
                                <li><a href="<?php echo site_url('Deposit')?>"><i class="fa fa-credit-card"></i> TopUp</a></li>
                                <li><a href="<?php echo site_url('Transfer')?>"><i class="fa fa-send-o"></i> Transfer</a></li>
                                <li><a href="<?php echo site_url('Gift')?>"><i class="fa fa-gift"></i> Gift</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->                    
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <?php echo $this->session->userdata('username');?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?php echo site_url('user/editProfile'); ?>"><i class="fa fa-user pull-right"></i>  Profile</a>
                                    </li>
                                    <li><a href="<?php echo site_url('user/doLogoutMember');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>                            

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                <?php $this->load->view($data_content);?>
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>js/custom.js"></script>
   
    <script type="text/javascript">
        $(window).load(function () {
            //GET Coin and Poin
            $.ajax({
                url: "<?php echo site_url('user/getUserCoins'); ?>",                
                type: "GET",
                dataType: 'json',
                success:function(data){
                    //alertify.success("coin = "+data.toppon_coin);
                    //alertify.success("poin = "+data.toppon_poin);
                    $("#toppon-coin-content").html(data.toppon_coin);
                    $("#toppon-poin-content").html(data.toppon_poin);
                },
                error: function(xhr, status, error) {
                    //var err = eval("(" + xhr.responseText + ")");
                    //alertify.error(xhr.responseText);
                }
            });

            //Get Category Game
            $.ajax({
                url: "<?php echo site_url('GameCategory/getGameCategory'); ?>",
                type: "GET",
                dataType: 'json',
                success:function(data){
                    $.each( data, function( i, val ) {
                        var li = $("<li>");
                        var a = $("<a>", {"href":"<?php echo site_url('GamePurchase/index')?>/"+val.gameCategoryID}).text(val.gameCategoryName);
                        a.appendTo(li);
                        li.appendTo("#category-game");
                        //alert('a');
                    });

                },
                error: function(xhr, status, error) {
                    //var err = eval("(" + xhr.responseText + ")");
                    //alertify.error(xhr.responseText);
                }
            });

        });

        $(document).ready(function(){
            $(".toppon-coins").parent(a).css("cursor","default");
        });
    </script>    
    <!-- /footer content -->
</body>

</html>
