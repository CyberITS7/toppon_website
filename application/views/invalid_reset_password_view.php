<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Toppon | Reset Password Page </title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/animate.min.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/icheck/flat/green.css" rel="stylesheet">
    <style>
    /*biar naik dikit karena nambah formnya dari default*/
    #reset-password{
        margin-top: -50px;
    }
    .reset-password{
        float:left;
    }
    .kelompok-input{
        width:570px;
    }
    /*biar pesan errornya turun sedikit, terlalu nempel*/
    .alert-pesan-error{
        margin-top:20px;
    }
    .clear{
        clear:both;
    }
    
    </style>

    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    
</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        

        <div id="wrapper">
            <!-- Reset Password -->
            <div id="reset-password" class="animate form">
                        <div class="alert alert-danger alert-dismissible fade in alert-pesan-error" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <span id="alert-error-reset-password">Your request is invalid</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div class="clearfix"></div>
                            <div>
                                <a href="<?php echo site_url("Home");?>"><img src="<?php echo base_url(); ?>img/toppon.png" class="home-logo" width="250px" height="125x"></a>

                                <p>©2016 All Rights Reserved.</p>
                            </div>
                        </div>
                                  
            </div>            
        </div>
    </div>
</body>

</html>