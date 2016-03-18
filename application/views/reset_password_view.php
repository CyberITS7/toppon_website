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
    .login_content form input[type="text"], .login_content form input[type="email"], .login_content form input[type="password"]{
        width:350px;
    }
    /*biar pesan errornya turun sedikit, terlalu nempel*/
    .alert-pesan-error{
        margin-top:20px;
        display: none;
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
                <section class="login_content">
                    <form id="reset-password-form" action="<?php echo site_url("user/doResetPassword");?>" method="POST">
                        <h1>Reset Password</h1>
                        <div class="item form-group kelompok-input">
                            <input type="password" name="password-reset-password" id="password-reset-password" class="form-control reset-password" placeholder="Password" required="required" data-validate-length-range="4,50"/>
                        </div>
                        <div class="item form-group kelompok-input">
                            <input type="password" name="conf-password-reset-password" id="conf-password-reset-password" class="form-control reset-password" placeholder="Confirm Password" required="required" data-validate-length-range="4,50" data-validate-linked="password-reset-password" />
                        </div>
                        <input type="hidden" name="userID" id="userID" value="<?php echo $data_userID; ?>"/>
                        <div class="item form-group">
                            <a class="btn btn-default submit btn-reset-password" href="#">Submit</a>
                        </div>
                        <div class="clear"></div>
                        <div class="alert alert-danger alert-dismissible fade in alert-pesan-error" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <span id="alert-error-reset-password">Insert error message here</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div class="clearfix"></div>
                            <div>
                                <a href="<?php echo site_url("Home");?>"><img src="<?php echo base_url(); ?>img/toppon.png" class="home-logo" width="250px" height="125x"></a>

                                <p>©2016 All Rights Reserved.</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>                
            </div>            
        </div>
    </div>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/validator.js"></script>
    <script>
        $(document).ready(function(){
            //hide alert buat pesan error
            $(".alert-pesan-error").hide();

            validator.message['empty'] = 'Harap isi kolom ini';
            validator.message['min'] = 'Harap isi min. 4 karakter';

            // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
            $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

            //buat bikin button melakukan submit pada form register
            $(".btn-reset-password").click(function(){
                $("#reset-password-form").submit();                
                return false;
            });


            $('form').submit(function (e) {                
                e.preventDefault();
                var submit = true;
                // evaluate the form using generic validaing
                if (!validator.checkAll($(this))) {
                    submit = false;
                }

                if (submit)
                    this.submit();
                
                return false;
            });

            $('#alerts').change(function () {
                validator.defaults.alerts = (this.checked) ? false : true;
                if (this.checked)
                    $('form .alert').remove();
            }).prop('checked', false);
        });
        
        
    </script>
</body>

</html>