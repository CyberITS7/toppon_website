
<div class="page-title">
    <div class="title_left">
        <h3>Transfer</h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Deposit Form<small>Form input deposits</small></h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" id="form-transfer" method="post" novalidate>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username Tujuan <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="username-tujuan" class="form-control col-md-7 col-xs-12" name="username-tujuan" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Toppon Coin<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="toppon-coin" name="toppon-coin" required="required">
                                <option value="">Choose option</option>
                                <option value="10">10 TC</option>
                                <option value="25">25 TC</option>
                                <option value="30">30 TC</option>
                                <option value="50">50 TC</option>
                                <option value="100">100 TC</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password" class="form-control col-md-7 col-xs-12" name="password" required="required" type="password">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="reset" class="btn btn-primary">Clear</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        function validate(){
            var error = 0;        
            var username_tujuan = $("#username-tujuan").val();
            var toppon_coin = $("#toppon-coin").val();
            var password = $("#password").val();

            if(username_tujuan == null || username_tujuan == ""){
                alertify.error("Transfer fail, username empty !");
                error++;
            } else if(toppon_coin == null || toppon_coin == ""){
                alertify.error("Transfer fail, toppon coin empty !");
                error++;
            } else if(password == null || password == ""){
                alertify.error("Transfer fail, password empty !");
                error++;
            } else if(toppon_coin > 100 || toppon_coin < 10){
                alertify.error("Transfer fail, coin not valid !");
                error++;
            }else if(username_tujuan == "<?php echo $this->session->userdata('username') ;?>"){
                alertify.error("Transfer fail, cannot transfer to your own account !");
                error++;
            }

            if(error > 0){
                return false;
            }
            else{
                return true;
            }
        }

        // fungsi saat form di submit
        $("#form-transfer").submit(function(){
            if(validate()){
                alertify.confirm("Are you sure, you want to transfer "+$("#toppon-coin").val()+" coin to "+ $("#username-tujuan").val() +"?",
                    function(){
                        var data_post = {
                            username_tujuan : $("#username-tujuan").val(),
                            toppon_coin : $("#toppon-coin").val(),
                            password : $("#password").val()
                        };

                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "index.php/Transfer/doTransfer",
                            data: data_post,
                            type: "POST",
                            dataType: 'json',
                            success:function(data){
                                if(data.status != 'error') {
                                    alertify.success(data.msg);
                                    location.href = "<?php echo site_url("Transfer")?>";
                                }else{
                                    alertify.error(data.msg);
                                }
                            },
                            error: function(xhr, status, error) {
                                //var err = eval("(" + xhr.responseText + ")");
                                alertify.error(xhr.responseText);
                            }
                        });
                    }
                ).setHeader('Confirm Transfer Coin');
            }
            return false;
        });
    });    
    </script>    