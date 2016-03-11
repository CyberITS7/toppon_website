<style>
    .custom-input-group{
        padding-right: 10px !IMPORTANT;
        padding-left: 10px !IMPORTANT;
    }

    .password-group{
        display: none;
    }
</style>
<div class="page-title">
    <div class="title_left">
        <h3>User Profile</h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>User Profile Form<small>Form Edit Profile</small></h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" id="form-transfer" method="post" novalidate>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span><span class="label label-danger" id="err-username"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="username" class="form-control col-md-7 col-xs-12" name="username" required="required" type="text" value="<?php echo $data_detail->userName;?>" data-label="#err-username">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span><span class="label label-danger" id="err-name"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12" name="name" required="required" type="text" value="<?php echo $data_detail->name;?>" data-label="#err-name">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span><span class="label label-danger" id="err-email"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="email" class="form-control col-md-7 col-xs-12" name="email" required="required" type="email" value="<?php echo $data_detail->email;?>" data-label="#err-email">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">No. Telp <span class="required">*</span><span class="label label-danger" id="err-phone"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="phone" class="form-control col-md-7 col-xs-12" name="phone" required="required" type="text" value="<?php echo $data_detail->phoneNumber;?>" data-label="#err-phone">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="old-pass">Change Password
                        <span class="label label-danger" id="err-old-pass"></span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12 input-group custom-input-group">
                            <input id="old-pass" class="form-control col-md-7 col-xs-12" name="old-pass" type="password" disabled="disabled" data-label="#err-old-pass">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-change">Change Password</button> 
                            </span>
                        </div>
                    </div>
                    <div class="item form-group password-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="new-pass">New Password
                        <span class="label label-danger" id="err-new-pass"></span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="new-pass" class="form-control col-md-7 col-xs-12" name="new-pass" type="password" data-label="#err-new-pass">
                        </div>
                    </div>
                    <div class="item form-group password-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="conf-pass">Confirm Password 
                        <span class="label label-danger" id="err-conf-pass"></span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="conf-pass" class="form-control col-md-7 col-xs-12" name="conf-pass" type="password" data-label="#err-conf-pass">
                        </div>
                    </div>
                    <div class="item form-group password-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="new-pass">&nbsp;
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <button class="btn btn-danger custom-input-group btn-cancel">Cancel Change Password</button>
                        </div>
                    </div>
                    </button>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="reset" class="btn btn-primary">Clear</button>
                            <button type="submit" class="btn btn-success btn-save">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>js/validate_master.js"></script>
    <script>
    $(document).ready(function(){
        var is_update_pass = false;

        function validate(){
            var err=0;

            if(!$('#username').validateRequired()){
                err++;
            }else if(!$('#username').validateLengthRange({minLength : 4, maxLength:50})){
                err++;
            }

            if(!$('#name').validateRequired()){
                err++;
            }else if(!$('#name').validateLengthRange({minLength : 4, maxLength:50})){
                err++;
            }

            if(!$('#email').validateRequired()){
                err++;
            }else if(!$('#email').validateLengthRange({minLength : 4, maxLength:50})){
                err++;
            }else if(!$('#email').validateEmailForm()){
                err++;
            }

            if(!$('#phone').validateRequired()){
                err++;
            }else if(!$('#phone').validateLengthRange({minLength : 4, maxLength:50})){
                err++;
            }else if(!$('#phone').validatePhoneForm()){
                err++;
            }

            if(is_update_pass){
                if(!$('#old-pass').validateRequired()){
                    err++;
                }

                if(!$('#new-pass').validateRequired()){
                    err++;
                }else if(!$('#new-pass').validateLengthRange({minLength : 4, maxLength:50})){
                    err++;
                }
                if(!$('#conf-pass').validateRequired()){
                    err++;
                }else if(!$('#conf-pass').validateConfirmPassword({compareValue : $('#new-pass').val()})){
                    err++;
                }
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }
        }

        $(".btn-change").on("click", function(){
            $(this).hide();
            $(this).parents(".input-group-btn").siblings("#old-pass").removeAttr("disabled");
            $(this).parents("span").parents("div").siblings("label").html("Old Password <span class=\"label label-danger\" id=\"err-old-pass\"></span>");
            $("#old-pass").val("");
            $("#new-pass").val("");
            $("#conf-pass").val("");
            $(".password-group").show();
            is_update_pass = true;
        });

        $(".btn-cancel").on("click", function(){
            $(".btn-change").show();
            $(".btn-change").parents(".input-group-btn").siblings("#old-pass").attr("disabled","disabled");
            $(this).parents("span").parents("div").siblings("label").html("Change Password <span class=\"label label-danger\" id=\"err-old-pass\"></span>");
            $("#old-pass").val("");
            $(".password-group").hide();
            is_update_pass = false;
            return false;
        });

        $('.btn-save').click(function(){
            if(validate()){
                var formData = new FormData();

                formData.append("username", $("#username").val());
                formData.append("name", $("#name").val());
                formData.append("email", $("#email").val());
                formData.append("phone", $("#phone").val());
                if(is_update_pass){
                    formData.append("is_update_pass", "TRUE");
                }
                else{
                    formData.append("is_update_pass", "FALSE");
                }

                if(is_update_pass){
                    formData.append("old_pass", $("#old-pass").val());
                    formData.append("new_pass", $("#conf-pass").val());
                }

                $(this).saveData({
                    url          : "<?php echo site_url('User/doUpdateUserProfile')?>",
                    data         : formData,
                    locationHref : "<?php echo site_url('User/doLogoutMember')?>"
                });
            }
            return false;
        });

    });
    </script>    