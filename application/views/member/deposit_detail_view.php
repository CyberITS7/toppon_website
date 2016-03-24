<style>
    #topup-table{
        max-width: 500px;
        width: 100%;
        margin: auto;
        font-size: 16px;
    }
    #td-btn-confirm button{
        width: 100%;
        background: #1D6FB7;
    }
    #td-btn-confirm button:hover{
        background: #1FA7DF;
    }
    @media print {
        a[href]:after {
            content: none !important;
        }
        #btn-back{
            display: none;
        }
    }
</style>
<div class="page-title">
    <div class="title_left">
        <h3>Top Up  <a href="<?php echo site_url('Deposit');?>">
                <button type="button" id="btn-back" class="btn btn-dark">
                    <i class="fa fa-chevron-left"></i>&nbsp Back to List
                </button>
            </a></h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <button class="btn btn-default pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-align-left"></i> Konfirmasi Top Up</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!-- Content-->
            <div id="step-2">
                <h3 class="StepTitle" align="center">Detail Info</h3></br>
                <table class="table" id="topup-table">
                    <tr>
                        <td>Nama</td>
                        <td><strong><?php echo $deposit_detail->nameRekening;?></strong></td>
                    </tr>
                    <tr>
                        <td>Nomor Rekening</td>
                        <td><strong><?php echo $deposit_detail->noRekening;?></strong></td>
                    </tr>
                    <tr>
                        <td>Nama Bank</td>
                        <td><strong><?php echo $deposit_detail->bankName;?></strong></td>
                    </tr>
                    <tr>
                        <td>T.C.</td>
                        <td><strong><?php echo number_format($deposit_detail->coin,0,",",".");?></strong></td>
                    </tr>
                    <tr>
                        <td>Nominal </td>
                        <td><strong>Rp <?php echo number_format($deposit_detail->coinConversion,0,",",".");?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="td-btn-confirm">
                            <button class="btn btn-success btn-lg pull-right btn-paymentConfirmation">
                                <i class="fa fa-credit-card"></i> Konfirmasi
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <!-- accepted payments column -->
            <div class="col-xs-12">
                <p><b><i>Silahkan transfer sejumlah nominal ke salah satu rekening di bawah ini dalam waktu 1x24 jam : </i></b></p>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    <img src="<?php echo base_url(); ?>img/bca-card.png" alt="BCA"> 883 034 7373 a.n. Orawan Phosiri
                </p>
            </div>
            <!-- /.col -->
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
                                       