<link href="<?php echo base_url(); ?>css/dataTables.tableTools.css" rel="stylesheet">
<style>
    .show-calendar{
        z-index: 99999;
    }
    .input-prepend input{
        width: 300px!important;
    }

    .daterangepicker select.monthselect,
    .daterangepicker select.yearselect{
        color : #34495E;
    }

</style>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Game Purchased
                <small>
                    List of Game Purchased History
                </small>
            </h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Game Purchase Report <small>Report Data</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="well well-sm">
                        <a href="<?php echo site_url('Report/gamePurchaseReport')?>">
                            <button type="submit" class="btn btn-default btn-sm">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>All
                            </button>
                        </a>
                        <button type="submit" class="btn btn-default btn-sm" id="btn-search-date">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i> Date
                        </button>
                        <button type="submit" class="btn btn-default btn-sm" id="btn-search-periode">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar">
                            </i> Period</button>
                    </div>
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th>TransactionID</th>
                                <th>Publisher </th>
                                <th>Game </th>
                                <th>Voucher </th>
                                <th>Coin </th>
                                <th>User </th>
                                <th>Date </th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php $x=1; foreach($game_purchase_list as $row) { ?>
                            <?php if($x%2==1) {?>
                                <tr class="even pointer">
                            <?php }else{ ?>
                                <tr class="odd pointer">
                            <?php }//end else?>
                                    <td class=" "><?php echo $row['prefixCode'].$row['tGamePurchaseID']; ?></td>
                                    <td class=" "><?php echo $row['publisherName']; ?></td>
                                    <td class=" "><?php echo $row['gameName'] ?></td>
                                    <td class="a-right a-right "><?php echo $row['currency']." ".number_format($row['nominalName'],0,",","."); ?></td>
                                    <td class="a-right a-right "><?php echo number_format($row['paymentValue'],0,",","."); ?></td>
                                    <td class="a-right a-right ">
                                        <?php if($this->session->userdata("level")=="super_admin") {
                                            echo $row['userName']." -";
                                        }?>
                                        <?php echo $row['userLevel']; ?>
                                    </td>
                                    <td class=" ">
                                        <?php $date = date_create($row['created']);
                                        echo date_format($date, 'F d, Y \a\t g:ia' ); ?>
                                    </td>
                                </tr>
                            <?php  $x++; } //end for?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade search-date-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="modal-title">Search by Date</h4>
                </div>
                <div class="modal-body">
                    <form id="search-form">
                        <div class="form-group" id="by-periode">
                            <label for="search-periode" class="control-label">Search between Period : </label>
                            <fieldset>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                            <input type="text" style="width: 200px" name="search-periode" id="search-periode" class="form-control" value="" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-group" id="by-date">
                            <label for="search-date" class="control-label">Search by Date : <span class="label label-danger" id="err-name"></span></label>
                            <fieldset>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="search-date" placeholder="Date"
                                                   aria-describedby="inputSuccess2Status4">
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-search" data-search="">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo base_url();?>js/moment.min2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/daterangepicker.js"></script>

<!-- data table -->
<script>
    var asInitVals = new Array();
    $(document).ready(function () {
        var oTable = $('#example').dataTable({
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
    });
</script>
<!-- datepicker -->
<script type="text/javascript">
    $(document).ready(function () {

        // Initialize Datepicker
        $('#search-periode').daterangepicker(null, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#search-periode').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
        });

        $('#search-date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            calender_style: "picker_4"
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

        $('#btn-search-periode').click(function(){
            $('#by-periode').show();
            $('#by-date').hide();
			$('#modal-title').text("Search by Period");
            $('.search-date-modal').modal('show');
            $('#btn-search').attr("data-search","periode");
        });
        $('#btn-search-date').click(function(){
            $('#by-date').show();
            $('#by-periode').hide();
			$('#modal-title').text("Search by Date");
            $('.search-date-modal').modal('show');
            $('#btn-search').attr("data-search","date");
        });

        //Search
        $('#btn-search').click(function(){
            var search = $(this).attr("data-search");

            if(search == "periode"){
                var start_date = $('#search-periode').data('daterangepicker').startDate;
                var end_date = $('#search-periode').data('daterangepicker').endDate;
                location.href = "<?php echo site_url('Report/gamePurchaseReportSearchByPeriode')?>/"
                +start_date.format('YYYY-MM-DD')+"/"+end_date.format('YYYY-MM-DD');
            }else if(search == "date"){
                var date = $('#search-date').data('daterangepicker').endDate;
                location.href = "<?php echo site_url('Report/gamePurchaseReportSearchByDate')?>/"+date.format('YYYY-MM-DD');
            }
        });

    });
</script>
<!-- /datepicker -->