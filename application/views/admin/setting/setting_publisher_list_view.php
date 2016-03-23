<div class="page-title">
    <div class="title_left">
        <h3>
            <a href="<?php echo site_url('SPublisher/goToAddDetailSPublisher')?>">
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-plus-square"></i>&nbsp Add
                </button>
            </a>
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

<!-- page content -->

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Setting Publisher <small>List of publisher setting</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="setting-publisher-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Publisher </th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach($setting_publisher as $row){?>
                        <tr>
                            <td class="td-publisher-name"><?php echo $row['publisherName'];?></td>
                            <td>
                                <a href="<?php echo site_url('SPublisher/goToEditDetailSPublisher/'.$row['publisherID']);?>"
                                   class="btn btn-info btn-xs"><i class="fa fa-gears"></i> Setting </a>
                                <a href="#" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash-o"></i> Delete </a>
                            </td>
                            <input type="hidden" value="<?php echo $row['publisherID'];?>" class="item-id"/>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>js/validate_master.js"></script>
<script>
    var asInitVals = new Array();
    $(document).ready( function($) {
        var oTable = $('#setting-publisher-table').dataTable({
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

        $(document).on( "click", ".btn-delete", function() {
            var row = $(this).closest("tr");
            var col_title =  row.find(".td-publisher-name").text();
            var col_id =  row.find("input.item-id").val();

            var formData = new FormData();
            formData.append("id", col_id);

            $(this).deleteData({
                alertMsg     : "Do you want to delete this <i><b>"+col_title+"</b></i> game ?",
                alertTitle   : "Delete Confirmation",
                url		     : "<?php echo site_url('SPublisher/deleteSPublisher')?>",
                data		 : formData,
                locationHref : "<?php echo site_url('SPublisher')?>"
            });
        });
    });

</script>