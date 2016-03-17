<div class="page-title">
    <div class="title_left">
        <h3>Top Up <a href="<?php echo site_url('Deposit');?>"><button type="button" class="btn btn-dark"><i class="fa fa-chevron-left"></i>&nbsp Back to List</button></a></h3>
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

<!-- page content -->
            
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Top Up Form <small>Form Top Up Coin</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                             
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />

                                    <form id="deposit-form" data-parsley-validate class="form-horizontal form-label-left">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nomor-Rekening">Nomor Rekening <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="Nomor-Rekening" name="Nomor-Rekening" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nama-Rekening">Nama Rekening <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="Nama-Rekening" name="Nama-Rekening" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        
                                                      <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nama-Bank">Nama Bank <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="select2_single form-control" tabindex="-1" id="Nama-Bank" name="Nama-Bank"  class="form-control col-md-7 col-xs-12">
                                                                <?php //Untuk tampilkan data dr db ke cmbBox
                                                                 foreach ($bank_list as $row) {
                                                                 ?>
                                                                        <option value="<?php echo $row['bankID']; ?>"><?php echo $row['bankName']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                      
                                                   
                                      
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Toppon-Coin">Toppon Coin <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="select2_single form-control" tabindex="-1" id="Toppon-Coin" name="Toppon-Coin" required="required" class="form-control col-md-7 col-xs-12">
                                                    <?php //Untuk tampilkan data dr db ke cmbBox
                                                                 foreach ($coin_list as $row) {
                                                                 ?>
                                                                        <option value="<?php echo $row['coinID']; ?>"><?php echo $row['coin']; ?>&nbsp (Rp&nbsp<?php echo $row['coinConversion']; ?>)</option>
                                                                <?php
                                                                }
                                                                ?>
                                                </select>
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button type="button" class="btn btn-warning" id="btn-top-up">Top Up</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>
 <script>
    $(document).ready(function(){
        function validate(){
            var error = 0;        
            var noRekening = $("#Nomor-Rekening").val();
            var namaRekening = $("#Nama-Rekening").val();

            if(noRekening == null || noRekening == ""){
                alertify.error("Top Up fail, Nomor Rekening empty !");
                error++;
            } else if(namaRekening == null || namaRekening == ""){
                alertify.error("Top Up fail, Nama Rekening empty !");
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
            $("#btn-top-up").click(function(){
               if (validate() == true)
               {
                
                    // ajax mulai disini
                    //Loading screen
                    $("#load_screen").show();
                    var base_url = "<?php echo site_url('Deposit/topUpDeposit');?>";

                    var noRekening = $("#Nomor-Rekening").val();
                    var namaRekening = $("#Nama-Rekening").val();
                    var namaBank = $("#Nama-Bank").val();
                    var topponCoin = $("#Toppon-Coin").val();
                    
                    var data_post = {
                        postNoRekening : noRekening,
                        postNamaRekening : namaRekening,
                        postNamaBank : namaBank,
                        postTopponCoin : topponCoin
                    };
                    $.ajax({
                        url: base_url,
                        data: data_post,
                        type: "POST",
                        dataType: 'json',
                        success:function(data){
                            if(data.status != 'error') {
                                //Setting Success MODAL
                                $('.success-modal').modal({
                                    backdrop: 'static',
                                    keyboard: false,
                                    show : true
                                });
                                $('.success-modal').modal("show");
                                $("#load_screen").hide();
                                window.setTimeout( function(){
                                    location.href = "<?php echo site_url('Deposit/index');?>";
                                }, 3000 );
                            }else{
                                alertify.error(data.msg);
                                $("#load_screen").hide();
                            }
                        },
                        error: function(xhr, status, error) {
                            //var err = eval("(" + xhr.responseText + ")");
                            alertify.error('Cannot response server !');
                        }
                    });
                   
               } return false;
        
            });
            
        });  
    </script>    