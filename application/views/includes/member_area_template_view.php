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
                        <a href="index.html" class="site_title"><i class="fa fa-money"></i><span>Toppon</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">   
                        <div class="profile_pic">
                            <img src="<?php echo base_url(); ?>img/icon_toppon.jpg" alt="..." class="img-circle profile_img">
                        </div>                     
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $this->session->userdata('username');?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->
                   
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
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

                                <li><a href="<?php echo site_url('GamePurchase')?>"><i class="fa fa-home"></i> Game Purchase</a>
                                <li><a href="<?php echo site_url('Deposit')?>"><i class="fa fa-home"></i> Deposit</a>
                                <li><a href="<?php echo site_url('Transfer')?>"><i class="fa fa-send-o"></i> Transfer</a>
                                </li>

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
                                    <li><a href="javascript:;">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">                                            
                                            <span>Settings</span>
                                        </a>
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
        $(document).ready(function () {

        });
    </script>    
    <!-- /footer content -->
</body>

</html>
