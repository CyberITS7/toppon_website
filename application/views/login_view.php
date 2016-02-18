<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Toppon | Login&Register Page </title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/animate.min.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/icheck/flat/green.css" rel="stylesheet">
    <style>
    /*biar naik dikit karena nambah formnya dari default*/
    #register{
        margin-top: -50px;
    }
    .regis, .login, .forgot{
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
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <a class="hiddenanchor" id="toforgot"></a>

        <div id="wrapper">
            <!-- login -->
            <div id="login" class="animate form">
                <section class="login_content">
                    <form id="login-form" action="<?php echo site_url("user/doLoginMember");?>" method="POST">
                        <h1>Login Form</h1>
                        <div class="item form-group kelompok-input">
                            <input type="text" id="username-login" name="username-login" class="form-control login" placeholder="Username" required="required" data-validate-length-range="4,50" />
                        </div>
                        <div class="item form-group kelompok-input">
                            <input type="password" id="password-login" name="password-login" class="form-control login" placeholder="Password" required="required" data-validate-length-range="4,50"/>
                        </div>
                        <div>
                            <a class="btn btn-default submit btn-login" href="#">Log in</a>
                            <a class="reset_pass to_forgot" href="#toforgot">Lost your password?</a>
                        </div>
                        <div class="clear"></div>
                        <div class="alert alert-danger alert-dismissible fade in alert-pesan-error" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <span id="alert-error-login">Insert error message here</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">New to site?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1>Toppon</h1>

                                <p>©2016 All Rights Reserved.</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <!-- Register -->
            <div id="register" class="animate form">
                <section class="login_content">
                    <form id="register-form" action="<?php echo site_url("user/doRegisMember");?>" method="POST">
                        <h1>Create Account</h1>
                        <div class="item form-group kelompok-input">
                            <input type="text" name="username-regis" id="username-regis" class="form-control regis" placeholder="Username" required="required" data-validate-length-range="4,50" />
                        </div>
                        <div class="item form-group kelompok-input">
                            <input type="text" name="name-regis" id="name-regis" class="form-control regis" placeholder="Name" required="required" data-validate-length-range="4,50" />
                        </div>
                        <div class="item form-group kelompok-input">
                            <input type="email" name="email-regis" id="email-regis" class="form-control regis" placeholder="Email" required="required" data-validate-length-range="4,50"/>
                        </div>
                        <div class="item form-group kelompok-input">
                            <input type="text" name="phone-regis" id="phone-regis" class="form-control regis" placeholder="No. Telp" required="required" data-validate-length-range="4,15" />
                        </div>
                        <div class="item form-group kelompok-input">
                            <input type="password" name="password-regis" id="password-regis" class="form-control regis" placeholder="Password" required="required" data-validate-length-range="4,50"/>
                        </div>
                        <div class="item form-group kelompok-input">
                            <input type="password" name="conf-password-regis" id="conf-password-regis" class="form-control regis" placeholder="Confirm Password" required="required" data-validate-length-range="4,50" data-validate-linked="password-regis" />
                        </div>                        
                        <div class="item form-group">
                            <a class="btn btn-default submit btn-register" href="#">Submit</a>
                        </div>                        
                        <!--<div class="alert alert-danger alert-dismissible fade in alert-pesan-error" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <span id="err-register">Taruh pesan error disini</span>
                        </div>-->
                        <div class="clear"></div>
                        <div class="alert alert-danger alert-dismissible fade in alert-pesan-error" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <span id="alert-error-regis">Insert error message here</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1>Toppon</h1>

                                <p>©2016 All Rights Reserved.</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <!-- Forgot Password -->
            <div id="forgot" class="animate form">
                <section class="login_content">
                    <form id="forgot-form" action="<?php echo site_url("user/doForgotPassword");?>" method="POST">
                        <h1>Forgot Password Form</h1>
                        <div class="item form-group kelompok-input">
                            <input type="text" id="username-forgot" name="username-forgot" class="form-control forgot" placeholder="Username" required="required" data-validate-length-range="4,50" />
                        </div>
                        <div>
                            <a class="btn btn-default submit btn-forgot" href="#">Forgot</a>
                            <a href="#tologin" class="to_register"> Log in </a>
                        </div>
                        <div class="clear"></div>
                        <div class="alert alert-danger alert-dismissible fade in alert-pesan-error" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <span id="alert-error-forgot">Insert error message here</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">New to site?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1>Toppon</h1>
                                <p>©2016 All Rights Reserved.</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/validator.js"></script>
    <script>
        $(document).ready(function(){
            //hide alert buat pesan error
            $(".alert-pesan-error").hide();

            var error_server = "<?php echo $error_param;?>";
            var error_where = "<?php echo $where_at;?>";
            if(error_server != null && error_server != ""){
                if(error_where == "login"){
                    $("#alert-error-login").html(error_server);
                    $("#alert-error-login").parent(".alert-pesan-error").show();                    
                }
                else if(error_where == "register"){
                    $("#alert-error-regis").html(error_server);
                    $("#alert-error-regis").parent(".alert-pesan-error").show();
                    location.hash = "toregister";
                }
                else if(error_where == "forgot"){
                    if(error_server == "Username doesn't exists"){
                        $("#alert-error-forgot").html(error_server);
                        $("#alert-error-forgot").parent(".alert-pesan-error").show();
                        location.hash = "toforgot";
                    }
                    else if(error_server == "Please Check Your Email"){
                        $("#alert-error-forgot").html(error_server);
                        $("#alert-error-forgot").parent(".alert-pesan-error").removeClass("alert-danger").addClass("alert-success").show();
                        location.hash = "toforgot";
                    }
                }
            }
            
            validator.message['empty'] = 'Harap isi kolom ini';
            validator.message['min'] = 'Harap isi min. 4 karakter';

            // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
            $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);            

            //buat bikin button melakukan submit pada form login
            $(".btn-login").click(function(){
                $("#login-form").submit();
                return false;
            });

            //buat bikin button melakukan submit pada form register
            $(".btn-register").click(function(){
                $("#register-form").submit();                
                return false;
            });

            //buat bikin button melakukan submit pada form forgot password
            $(".btn-forgot").click(function(){
                $("#forgot-form").submit();                
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
            //buat nentuin apa yang terjadi saat melakukan submit pada form register
            /*$("#register-form").on('submit',function(){
                bersihinForm();
                //mulai validasi form regis
                if($("#username-regis").val() == "" || $("#username-regis").val() == null){
                    $("#username-regis").css("border","1px solid #cc4444");
                    $("#err-register").html("Tolong isi kolom username dengan username yang anda inginkan!");
                    $(".alert-pesan-error").show();
                }
                else if($("#name-regis").val() == "" || $("#name-regis").val() == null){
                    $("#name-regis").css("border","1px solid #cc4444");
                    $("#err-register").html("Tolong isi kolom nama dengan nama anda !");
                    $(".alert-pesan-error").show();
                }
                return false;
            });*/
        });
        
        /*function bersihinForm(){
            $("#username-regis").css("border","");
            $("#name-regis").css("border","");
            $(".alert-pesan-error").hide();
        }*/
    </script>
</body>

</html>