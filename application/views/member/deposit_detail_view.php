<div class="page-title">
    <div class="title_left">
        <h3>Top Up <a href="<?php echo site_url('Deposit');?>"><button type="button" class="btn btn-dark"><i class="fa fa-chevron-left"></i>&nbsp Kembali</button></a></h3>
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

                <!-- Content-->
                   <div id="step-2">
                        <h3 class="StepTitle">Konfirmasi Top Up</h3></br> 
                            <h4 align="center">Nama : <?php echo $deposit_detail->nameRekening;?></h4>
                            <h4 align="center">Nomor Rekening : <strong><?php echo $deposit_detail->noRekening;?></strong></h4>
                            <h4 align="center">Nama Bank : <?php echo $deposit_detail->bankName;?></h4>
                            <h4 align="center">T.C. : <?php echo $deposit_detail->coin;?></h4>
                            <h4 align="center">Nominal : Rp <?php echo $deposit_detail->coinConversion;?></h4></br >
                        </div>

                         <div class="row">
                                            <!-- accepted payments column -->
                                                <p class="lead">Payment Methods:</p>
                                                <div class="col-xs-6">
                                                <p>Silahkan transfer sejumlah nominal ke salah satu rekening di bawah ini : </p>
                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                    <img src="<?php echo base_url(); ?>img/bca-card.png" alt="BCA"> 527 113 7835 a.n. PT. Toppon Indonesia
                                                    </p>
                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                    <img src="<?php echo base_url(); ?>img/mandiri-card.png" alt="MANDIRI"> 029 712 9537 a.n. PT. Toppon Indonesia
                                                    </p>
                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                    <img src="<?php echo base_url(); ?>img/bni-card.png" alt="BNI"> 029 712 9537 a.n. PT. Toppon Indonesia
                                                    </p>

                                                
                                                
                                            </div>
                                            <!-- /.col -->

                                            <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-xs-12">
                                                <button class="btn btn-success pull-right btn-paymentConfirmation"><i class="fa fa-credit-card"></i> Konfirmasi</button>
                                                <button class="btn btn-default pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                            </div>
                                        </div>
                        </div>

                <script src="<?php echo base_url(); ?>js/validate_master.js"></script>
<script>
    $(document).ready( function($) {
                $(".btn-paymentConfirmation").click(function(){
                    var formData = new FormData();
                    formData.append("id", <?php echo $deposit_detail->tDepositID;?>);


                    $(this).saveData({
                        url          : "<?php echo site_url('Deposit/updateStatusPendingDeposit')?>",
                        data         : formData,
                        locationHref : "<?php echo site_url('Deposit/depositList')?>"
                    });
                });

            });

</script>
                                       