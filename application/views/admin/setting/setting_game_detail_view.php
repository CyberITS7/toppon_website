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
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".setting-modal">
                            <i class="fa fa-plus-square"></i>&nbsp Add Detail
                        </button>
                    </a>
                </h3>
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Nominal</th>
                        <th>Product Code</th>
                        <th>Coin Value</th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody id="nominal-tbody">
                    <?php if($nominal_list_edit != null) {
                        foreach($nominal_list_edit as $row){ ?>
                            <tr data-status="OLD" data-id="<?php echo $row['nominalID'];?>"
                                data-setting = "<?php echo $row['sGameID'];?>">
                                <td class="nominal-td">
                                    <?php echo $row['currency']." ".number_format($row['nominalName'],0,",","."); ?>
                                </td>
                                <td class="product-code-td">
                                    <?php echo $row['productCode']; ?>
                                </td>
                                <td class="coin-value-td">
                                    <?php echo number_format($row['paymentValue'],0,",","."); ?>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-edit-detail">
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
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-add-detail">Add Detail</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>js/validate_master.js"></script>
<script>
    $(document).ready( function($) {
        // Initialize Publisher List Select
        $('select').select2();
        var publisher_detail = new Array();
        var publisher_delete = new Array();

        // Adding from modal to Detail
        $('#btn-add-detail').click(function(){
            if(validateAddDetail()){
                var publisher = $("#nominal-select").val();
                var publisher_name = $("#nominal-select option:selected").text();

                //Adding to #nominal-tbody
                var tr = $("<tr>",{"data-status":"NEW","data-id":publisher});
                var td1 = $("<td>").text(publisher_name);
                var td2 = $("<td>");
                var btn_del = $("<button>",{class:"btn btn-danger btn-sm btn-del-detail"}).html('<i class="fa fa-remove"></i>');
                td1.appendTo(tr);
                td2.append(btn_del);
                td2.appendTo(tr);
                tr.appendTo("#nominal-tbody");
                //Push to Array publisher_detail
                var detailData = {
                    id : publisher
                };
                publisher_detail.push(detailData);

                $('#nominal-select').val('').change();
                $('.setting-modal').modal('hide');
            }
        });

        // Edit Detail
        $("#nominal-tbody" ).on( "click", ".btn-edit-detail", function() {
            var row = $(this).closest("tr");
            var status = row.attr("data-status");
            var id = row.attr("data-id");
            if(status == "NEW"){
                row.remove();
                publisher_detail.splice( $.inArray(id,publisher_detail) ,1 );
            }else if(status == "OLD"){
                row.addClass('tr-del');
                row.attr("data-status","DEL");
                var detailData = {
                    id : id
                };
                publisher_delete.push(detailData);
            }else if(status == "DEL"){
                row.removeClass('tr-del');
                row.attr("data-status","OLD");
                publisher_delete.splice( $.inArray(id,publisher_delete) ,1 );
            }
        });

        // Delete Detail
        $("#nominal-tbody" ).on( "click", ".btn-del-detail", function() {
            var row = $(this).closest("tr");
            var status = row.attr("data-status");
            var id = row.attr("data-id");
            if(status == "NEW"){
                row.remove();
                publisher_detail.splice( $.inArray(id,publisher_detail) ,1 );
            }else if(status == "OLD"){
                row.addClass('tr-del');
                row.attr("data-status","DEL");
                var detailData = {
                    id : id
                };
                publisher_delete.push(detailData);
            }else if(status == "DEL"){
                row.removeClass('tr-del');
                row.attr("data-status","OLD");
                publisher_delete.splice( $.inArray(id,publisher_delete) ,1 );
            }
        });

        $('#btn-save').click(function(){
            if(validateSave()){
                var id = $('#setting-id').val();
                var update_category = $('#game-select').val();
                var formData = new FormData();
                formData.append("publisher_list", JSON.stringify(publisher_detail));
                if(id == '00') {
                    // ADD NEW SETTING
                    formData.append("game_category", update_category);
                    $(this).saveData({
                        url: "<?php echo site_url('SGame/createSGame')?>",
                        data: formData,
                        locationHref: "<?php echo site_url('SGame')?>"
                    });
                }else{
                    // UPDATE SETTING
                    if(id != update_category) {
                        //Update header if Setting Header is edited
                        formData.append("update_header", "1");
                        formData.append("update_category", update_category);
                    }else{
                        //Header is not edited
                        formData.append("update_header", "0");
                        formData.append("update_category", id);
                    }
                    formData.append("game_category",id);
                    formData.append("publisher_delete", JSON.stringify(publisher_delete));
                    $(this).saveData({
                        url: "<?php echo site_url('SGame/updateSGame')?>",
                        data: formData,
                        locationHref: "<?php echo site_url('SGame')?>"
                    });
                }
            }
        });

        function validateAddDetail(){
            var err=0;

            if(!$("#nominal-select").validateRequired()){
                err++;
            }else{
                var publisher = $("#nominal-select").val();
                //var check = jQuery.inArray(publisher, publisher_detail);
                var filtered = $(publisher_detail).filter(function(){
                    return this.id == publisher;
                });
                if(filtered.length > 0){
                    err++;
                    alertify.error("This publisher is allready on detail");
                }
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }
        }
        function validateSave(){
            var err=0;
            var array_size = publisher_detail.length;
            var setting_id = $("#setting-id").val();

            if(!$('#game-select').validateRequired()){
                err++;
            }

            if(setting_id == '00'){
                if(array_size == 0){
                    err++;
                    alertify.error("Detail Publisher can't be empty !");
                }
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }
        }
        //fix modal force focus
    });

</script>