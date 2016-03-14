<style>
    .title_left h3{
        float: left;
    }
    .select2-container{
        width: 100%!important;
    }
    .tr-del{
        border : 3px solid #d9534f;
    }
</style>
<link href="<?php echo base_url();?>css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url();?>js/select2.min.js"></script>
<div class="page-title">
    <div class="title_left">
        <h3>
            <button type="button" class="btn btn-primary" id="btn-save">
                <i class="fa fa-save"></i>&nbsp Save
            </button>
        </h3>
        <h3>
            <a href="<?php echo site_url('SGame')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-arrow-circle-o-left"></i>&nbsp Back
                </button>
            </a>
        </h3>
        <?php if($setting_id != null){?>
            <!--EDIT-->
            <input type="hidden" id="setting-id" value="<?php echo $setting_id;?>"/>
        <?php }else{ ?>
            <!--ADD-->
            <input type="hidden" id="setting-id" value="00"/>
        <?php }?>
    </div>
</div>
<div class="clearfix"></div>

<!-- page content -->

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Setting Game<small>List of game setting detail</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <p class="col-md-6 col-sm-10 col-xs-12">
                        <label for="heard">Game : <span class="label label-danger" id="err-game"></span></label>
                        <select id="game-select" class="form-control" data-label="#err-game">
                            <option value="">Choose..</option>
                            <?php if($game_edit != null){?>
                                <option value="<?php echo $game_edit->gameID;?>" selected="selected">
                                    <?php echo $game_edit->gameName;?>
                                </option>
                            <?php }?>
                            <?php foreach($game as $row){?>
                                <option value="<?php echo $row['gameID'];?>"><?php echo $row['gameName'];?></option>
                            <?php }?>
                        </select>
                    </p>
                </div>
                <h3>
                    <a href="#">
                        <button type="button" class="btn btn-default" id="add-detail-btn" data-toggle="modal" data-target=".setting-modal">
                            <i class="fa fa-plus-square"></i>&nbsp Add Detail
                        </button>
                    </a>
                </h3>
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Nominal</th>
                        <th>Coin Value</th>
                        <th>Product Code</th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody id="nominal-tbody">
                    <?php if($nominal_list_edit != "" && $nominal_list_edit != null) {
                        foreach($nominal_list_edit as $row){ ?>
                            <tr data-status="OLD" class="setting-detail" id="old-<?php echo $row['sGameID'];?>"
                                data-id="<?php echo $row['nominalID'];?>" data-setting = "<?php echo $row['sGameID'];?>">
                                <td class="nominal-td">
                                    <?php echo $row['currency']." ".number_format($row['nominalName'],0,",","."); ?>
                                </td>
                                <td class="coin-value-td" data-value="<?php echo $row['paymentValue']; ?> ">
                                    <?php echo number_format($row['paymentValue'],0,",","."); ?>
                                </td>
                                <td class="product-code-td"><?php echo $row['productCode']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-edit-detail">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-del-detail">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php }/*for*/ }//if?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade setting-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-title">Add Nominal</h4>
            </div>
            <div class="modal-body">
                <form id="setting-form">
                    <p>
                        <label for="nominal-select">Nominal : <span class="label label-danger" id="err-nominal"></span></label>
                        <select id="nominal-select" data-label="#err-nominal">
                            <option value="">Choose..</option>
                            <?php foreach($nominal as $row){?>
                                <option value="<?php echo $row['nominalID']?>">
                                    <?php echo $row['currency']." ".number_format($row['nominalName'],0,",","."); ?>
                                </option>
                            <?php }?>
                        </select>
                    </p>
                    <div class="form-group">
                        <label for="product-code" class="control-label">Product Code : <span class="label label-danger" id="err-product-code"></span></label>
                        <input type="text" class="form-control" id="product-code" name="product-code" data-label="#err-product-code">
                    </div>
                    <div class="form-group">
                        <label for="coin-value" class="control-label">Coin Value : <span class="label label-danger" id="err-coin-value"></span></label>
                        <input type="text" class="form-control" id="coin-value" name="coin-value" data-label="#err-coin-value">
                    </div>
                    <input type="hidden" id="old-nominal" data-status="" value=""/>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-add-detail" data-status = "" data-row="">Add Detail</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>js/validate_master.js"></script>
<script>
    $(document).ready( function($) {
        // Initialize Publisher List Select
        $('select').select2();
        var nominal_detail = <?php echo json_encode($nominal_list_edit);?>;
        var nominal_detail_add = new Array();
        var nominal_detail_edit = new Array();
        var nominal_delete = new Array();
        var id_detail = 0;

        // ACTION Button ADD
        $('#add-detail-btn').click(function(){
            // SET status modal to ADD mode
            $('#btn-add-detail').attr("data-status","ADD");
            // RESET modal form
            $('#old-nominal').val('');
            $('#old-nominal').attr("data-status","NEW");
            $('#nominal-select').val('').change();
            $('#setting-form')[0].reset();
        });

        //ACTION when MODAL is CLOSED
        $('.setting-modal').on('hidden.bs.modal', function () {
            // Set selected row to empty
            $('#btn-add-detail').attr("data-row","");
        })

        // ADD or EDIT from modal to Detail
        $('#btn-add-detail').click(function(){

            // ROW is id for selected tr for update, empty for NEW Detail
            var row = $(this).attr("data-row");
            var status = $(this).attr("data-status"); // Status for ADD OR EDIT
            var status_data =  $('#old-nominal').attr("data-status"); // Status for OLD OR NEW data
            var old_nominal =  $('#old-nominal').val();

            if(validateAddDetail(status)){
                var nominal_id = $("#nominal-select").val();
                var nominal_name = $("#nominal-select option:selected").text();
                var product_code = $("#product-code").val();
                var coin_val = $("#coin-value").val();

                if(status == "ADD") {
                    //ADD
                    //Adding to #nominal-tbody
                    addNewDetail(nominal_id, nominal_name, product_code, coin_val);
                }else if(status == "EDIT"){
                    //EDIT
                    var setting_id = $(row).attr("data-setting");
                    $(row).attr("data-id",nominal_id);
                    $(row).find(".nominal-td").text(nominal_name);
                    $(row).find(".coin-value-td").text(coin_val);
                    $(row).find(".coin-value-td").attr("data-value",coin_val);
                    $(row).find(".product-code-td").text(product_code);

                    var detail_data = {
                        settingID : setting_id,
                        nominalID : nominal_id,
                        coinVal : coin_val,
                        productCode : product_code
                    }

                    if(status_data == "OLD"){
                        nominal_detail = deleteObject(nominal_detail, old_nominal);
                        nominal_detail_edit = deleteObject(nominal_detail_edit, old_nominal);
                        nominal_detail_edit.push(detail_data);
                    }else if(status_data == "NEW"){
                        nominal_detail_add = deleteObject(nominal_detail_add, old_nominal);
                        nominal_detail_add.push(detail_data);
                    }
                }

                $('#nominal-select').val('').change();
                $('#setting-form')[0].reset();
                $('.setting-modal').modal('hide');
            }
        });

        // Edit Detail
        $("#nominal-tbody" ).on( "click", ".btn-edit-detail", function() {
            var row = $(this).closest("tr");
            var id = row.attr("id");
            var nominal_id = row.attr("data-id");
            var coin_val = row.find(".coin-value-td").attr("data-value");
            var product_code = row.find(".product-code-td").html();
            var status = row.attr("data-status");
            var setting_id  = row.attr("data-setting");

            //SET DATA TO MODAL
            $('#nominal-select').val(nominal_id).change();
            $("#product-code").val(product_code);
            $("#coin-value").val(parseInt(coin_val));

            // SET ID for selected row
            $('#btn-add-detail').attr("data-row","#"+id);
            // SET STATUS MODAL to Editing mode
            $('#btn-add-detail').attr("data-status","EDIT");
            $('#old-nominal').val(nominal_id);
            $('#old-nominal').attr("data-status",status);
            // SHOW Modal
            $('.setting-modal').modal('show');
        });

        // Delete Detail
        $("#nominal-tbody" ).on( "click", ".btn-del-detail", function() {
            var row = $(this).closest("tr");
            var status = row.attr("data-status");
            var nominal = row.attr("data-id");
            var setting = row.attr("data-setting");
            var btn_edit = row.find(".btn-edit-detail");

            if(status == "NEW"){
                row.remove();
                nominal_detail_add = deleteObject(nominal_detail_add, nominal);
            }else if(status == "OLD"){
                btn_edit.attr("disabled","disabled");
                row.addClass('tr-del');
                row.attr("data-status","DEL");
                var detailData = {
                    nominalID : nominal,
                    settingID : setting
                };
                nominal_delete.push(detailData);
            }else if(status == "DEL"){
                btn_edit.removeAttr("disabled");
                row.removeClass('tr-del');
                row.attr("data-status","OLD");
                nominal_delete = deleteObject(nominal_delete, nominal);
            }
        });

        $('#btn-save').click(function(){
            if(validateSave()){
                var game_id = $('#setting-id').val();
                var update_game = $('#game-select').val();
                var formData = new FormData();
                formData.append("nominal_add", JSON.stringify(nominal_detail_add));
                if(game_id == '00') {
                    // ADD NEW SETTING
                    formData.append("game_id", update_game);
                    $(this).saveData({
                        url: "<?php echo site_url('SGame/createSGame')?>",
                        data: formData,
                        locationHref: "<?php echo site_url('SGame')?>"
                    });
                }else{
                    // UPDATE SETTING
                    if(game_id != update_game) {
                        //Update header if Setting Header is edited
                        formData.append("update_header", "1");
                        formData.append("update_game", update_game);
                    }else{
                        //Header is not edited
                        formData.append("update_header", "0");
                        formData.append("update_game", game_id);
                    }
                    formData.append("game_id",game_id);
                    formData.append("nominal_add", JSON.stringify(nominal_detail_add));
                    formData.append("nominal_edit", JSON.stringify(nominal_detail_edit));
                    formData.append("nominal_delete", JSON.stringify(nominal_delete));

                    $(this).saveData({
                        url: "<?php echo site_url('SGame/updateSGame')?>",
                        data: formData,
                        locationHref: "<?php echo site_url('SGame')?>"
                    });

                }
            }
        });

        function addNewDetail(nominal_id, nominal_name, product_code, coin_val){
            var tr = $("<tr>", {id: "new-" + id_detail, "data-status": "NEW", "data-id": nominal_id,"data-setting" : ""});
            var td1 = $("<td>",{class:"nominal-td"}).text(nominal_name);
            var td2 = $("<td>",{class:"coin-value-td","data-value":coin_val}).text(coin_val);
            var td3 = $("<td>",{class:"product-code-td"}).text(product_code);
            var td4 = $("<td>");
            var btn_edit = $("<button>", {class: "btn btn-primary btn-sm btn-edit-detail"}).html('<i class="fa fa-pencil"></i>');
            var btn_del = $("<button>", {class: "btn btn-danger btn-sm btn-del-detail"}).html('<i class="fa fa-remove"></i>');
            td1.appendTo(tr);
            td2.appendTo(tr);
            td3.appendTo(tr);
            td4.append(btn_edit);
            td4.append(btn_del);
            td4.appendTo(tr);
            tr.appendTo("#nominal-tbody");
            //Push to Array publisher_detail
            var detail_data = {
                nominalID: nominal_id,
                coinVal : coin_val,
                productCode : product_code
            };
            nominal_detail_add.push(detail_data);
            id_detail++;
        }

        function validateAddDetail(status){
            var err=0;

            if(!$("#nominal-select").validateRequired()){
                err++;
            }else{
                // if row is not empty , means UPDATE else is ADD NEW
                var nominal = parseInt($("#nominal-select").val());
                if(status == "ADD") {
                    //var check = jQuery.inArray(publisher, publisher_detail);
                    var filtered = $(nominal_detail).filter(function () {
                        return this.nominalID == nominal;
                    });
                    var filtered_add = $(nominal_detail_add).filter(function () {
                        return this.nominalID == nominal;
                    });
                    var filtered_edit = $(nominal_detail_edit).filter(function () {
                        return this.nominalID == nominal;
                    });

                    if (filtered.length > 0) {
                        err++;
                        alertify.error("This nominal is allready on detail");
                    }else if(filtered_add.length > 0){
                        err++;
                        alertify.error("This nominal is allready on detail");
                    }else if(filtered_edit.length > 0){
                        err++;
                        alertify.error("This nominal is allready on detail");
                    }
                }else if(status == "EDIT"){
                    //var check = jQuery.inArray(publisher, publisher_detail);
                    var old_nominal = $('#old-nominal').val();

                    var filtered = $(nominal_detail).filter(function () {
                        if(old_nominal != this.nominalID)
                        return this.nominalID == nominal;
                    });
                    var filtered_add = $(nominal_detail_add).filter(function () {
                        if(old_nominal != this.nominalID)
                        return this.nominalID == nominal;
                    });
                    var filtered_edit = $(nominal_detail_edit).filter(function () {
                        if(old_nominal != this.nominalID)
                        return this.nominalID == nominal;
                    });

                    if (filtered.length > 0) {
                        err++;
                        alertify.error("This nominal is allready on detail");
                    }else if(filtered_add.length > 0){
                        err++;
                        alertify.error("This nominal is allready on detail");
                    }else if(filtered_edit.length > 0){
                        err++;
                        alertify.error("This nominal is allready on detail");
                    }
                }
            }

            if(!$("#product-code").validateRequired()){
                err++;
            }
            if(!$("#coin-value").validateRequired()){
                err++;
            }else if(!$("#coin-value").validateNumberForm()){
                err++;
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }
        }

        function validateSave(){
            var err=0;
            var array_size = nominal_detail_add.length;
            var setting_id = $("#setting-id").val();

            if(!$('#game-select').validateRequired()){
                err++;
            }

            if(setting_id == '00'){
                if(array_size == 0){
                    err++;
                    alertify.error("Detail Nominal can't be empty !");
                }
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }
        }

        function deleteObject(some_array, del_param){
            remove_arr = some_array
                .filter(function (el) {
                    return el.nominalID != del_param;
                }
            );

            return remove_arr;
        }
    });

</script>