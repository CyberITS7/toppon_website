<!-- page content -->
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Setting Account List <small>List of active setting accounts</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="account-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Username</th>
                        <th>Poin</th>
                        <th>Coin</th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach($accounts as $row){?>
                        <tr>
                            <td class="td-username"><?php echo $row['userName'];?></td>
                            <td class="td-poin"><?php echo number_format($row['poin'],0,",","."); ?></td>
                            <td class="td-coin"><?php echo number_format($row['coin'],0,",","."); ?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".member-modal"><i class="fa fa-pencil"></i> Edit </a>
                            </td>
                            <input type="hidden" value="<?php echo $row['sAccountID'];?>" class="item-id"/>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade member-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="member-form">
                    <input type="hidden" class="form-control" id="member-id">
                    <div class="form-group">
                        <label for="username" class="control-label">Username: <span class="label label-danger" id="err-username"></span></label>
                        <input type="text" class="form-control" id="username" name="username" data-label="#err-username" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="poin" class="control-label">Poin: <span class="label label-danger" id="err-poin"></span></label>
                        <input type="text" class="form-control" id="poin" name="poin" data-label="#err-poin">
                    </div>
                    <div class="form-group">
                        <label for="coin" class="control-label">Coin: <span class="label label-danger" id="err-coin"></span></label>
                        <input type="text" class="form-control" id="coin" name="coin" data-label="#err-coin">
                    </div>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-update">Update changes</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>js/validate_master.js"></script>
<script>
    var asInitVals = new Array();
    $(document).ready( function($) {

        var oTable = $('#account-table').dataTable({
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

        function validate(){
            var err=0;

            if(!$('#poin').validateRequired()){
                err++;
            }else if(!$('#poin').validateNumberForm()){
                err++;
            }

            if(!$('#coin').validateRequired()){
                err++;
            }else if(!$('#coin').validateNumberForm()){
                err++;
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }
        }        

        $(document).on( "click", ".btn-edit", function() {
            $(".label-danger").html("");
            // Set Title modal
            $('.modal-title').html('Edit Member Info');            
            //reset form
            $('#member-form')[0].reset();

            var row = $(this).closest("tr");
            var col_username =  row.find(".td-username").text();
            var col_poin =  row.find(".td-poin").text();
            var col_coin =  row.find(".td-coin").text();
            var col_id =  row.find("input.item-id").val();

            //set data to Modal
            $("#member-id").val(col_id);
            $("#username").val(col_username);
            $("#poin").val(col_poin);
            $("#coin").val(col_coin);
        });

        $('#btn-update').click(function(){
            if(validate()){
                var formData = new FormData();
                formData.append("id", $("#member-id").val());
                formData.append("username", $("#username").val());
                formData.append("poin", $("#poin").val());
                formData.append("coin", $("#coin").val());

                $(this).saveData({
                    url		     : "<?php echo site_url('User/doUpdateSAccount')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('User/sAccountList')?>"
                });
            }
        });        
    });

</script>