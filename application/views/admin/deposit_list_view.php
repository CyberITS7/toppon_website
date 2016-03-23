<style>
    .td-status{
        padding: 0!important;
    }
</style>
<div class="page-title">
    <div class="title_left">
        <h3>Top Up </h3>
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
                                    <h2>Top Up List <small>List of top up transactions</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="deposit-table" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>Tanggal Transaksi </th>
                                                <th>No. Rekening </th>
                                                <th>Nama Rekening </th>
                                                <th>Nama Bank </th>
                                                <th>T.C. </th>
                                                <th>Status </th>
                                                <th>Nominal </th>
                                                <th class=" no-link last"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php //Untuk tampilkan data dari db
                                            $i = 0;
                                                foreach ($deposit_list as $row) {
                                                     if($i %2 ==0)
                                                     {
                                                        ?>
                                                        <tr class="even pointer">
                                                        <?php
                                                     }
                                                     else 
                                                     {
                                                        ?>
                                                        <tr class="odd pointer">
                                                        <?php
                                                     }
                                                        $i++;
                                                    ?>
                                                        <td class="td-tanggal-transaksi"><?php echo $row['created']; ?></td>
                                                        <td class="td-nomor-rekening"><?php echo $row['noRekening']; ?></td>
                                                        <td class="td-nama-rekening"><?php echo $row['nameRekening']; ?></td>
                                                        <td class="td-nama-bank"><?php echo $row['bankName']; ?></td>
                                                        <td class="td-coin"><?php echo number_format($row['coin'],0,",","."); ?></td>
                                                        <td class="a-right a-right ">Rp <?php echo number_format($row['coinConversion'],0,",","."); ?></td>
                                                        <td class="td-status">
                                                            <?php if($row['status'] == 'unpaid'){ ?>
                                                                <!--UNPAID-->
                                                                <h4><span class="label label-warning"><?php echo $row['status']; ?></span></h4>
                                                            <?php }else if($row['status'] == 'pending'){ ?>
                                                                <!--PENDING-->
                                                                <h4><span class="label label-info"><?php echo $row['status']; ?></span></h4>
                                                            <?php }else if($row['status'] == 'paid'){ ?>
                                                                <!--PAID-->
                                                                <h4><span class="label label-success"><?php echo $row['status']; ?></span></h4>
                                                            <?php }else if($row['status'] == 'expired'){ ?>
                                                                <!--EXPIRE-->
                                                                <h4><span class="label label-danger"><?php echo $row['status']; ?></span></h4>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="last">
                                                            <?php if($row['status']== "pending"){ ?>
                                                            <button type="button" class="btn btn-warning btn-sm btn-update"><i class="fa fa-check"></i></button>
                                                            <?php } ?>
                                                            <a href="#"><button type="button" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button></a>
                                                        </td> 
                                                        <input type="hidden" value="<?php echo $row['tDepositID'];?>" class="item-id"/>  
                                                    </tr> 
                                                    <?php
                                                }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

<script src="<?php echo base_url(); ?>js/validate_master.js"></script>
<script>
    var asInitVals = new Array();
    $(document).ready( function($) {

        var oTable = $('#deposit-table').dataTable({
            "oLanguage": {
                "sSearch": "Search all columns:"
            },
            'iDisplayLength': 12,
            "sPaginationType": "full_numbers"
        });
        $("tfoot input").keyup(function () {
            /* Filter on the column based on the index of this element's parent <th> */
            oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
        });
        $("tfoot input").each(function (i) {
            asInitVals[i] = this.value;
        });
        $("tfoot input").focus(function () {
            if (this.className == "search_init") {
                this.className = "";
                this.value = "";
            }
        });
        $("tfoot input").blur(function (i) {
            if (this.value == "") {
                this.className = "search_init";
                this.value = asInitVals[$("tfoot input").index(this)];
            }
        });

        $('.btn-delete').click(function(){
            var row = $(this).closest("tr");
            var col_title =  row.find(".td-tanggal-transaksi").text();
            var col_id =  row.find("input.item-id").val();

            var formData = new FormData();
            formData.append("id", col_id);

            $(this).deleteData({
                alertMsg     : "Do you want to delete this transaction on <i><b>"+col_title+"</b></i>  ?",
                alertTitle   : "Delete Confirmation",
                url          : "<?php echo site_url('Deposit/deleteDeposit')?>",
                data         : formData,
                locationHref : "<?php echo site_url('Deposit/depositList')?>"
            });
        });

        $('.btn-update').click(function(){
            var row = $(this).closest("tr");
            var col_id =  row.find("input.item-id").val();
            
                var formData = new FormData();
                formData.append("id", col_id);
                $(this).deleteData({ //fungsi ini sengaja dipakai untuk munculkan alert saja abaikan namanya
                alertMsg     : "Do you want to confirm this payment ?",
                alertTitle   : "Confirmation",
                url          : "<?php echo site_url('Deposit/depositConfirm')?>",
                data         : formData,
                locationHref : "<?php echo site_url('Deposit/depositConfirmList')?>"
            });
                
        });

    });

</script>