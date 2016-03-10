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
            <a href="<?php echo site_url('SPublisher')?>">
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
                <h2>Setting Publisher</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <p class="col-md-6 col-sm-10 col-xs-12">
                        <label for="heard">Publisher : <span class="label label-danger" id="err-publisher"></span></label>
                        <select id="publisher-select" class="form-control" data-label="#err-publisher">
                            <option value="">Choose..</option>
                            <?php if($publisher_edit != null){?>
                                <option value="<?php echo $publisher_edit->publisherID;?>" selected="selected">
                                    <?php echo $publisher_edit->publisherName;?>
                                </option>
                            <?php }?>
                            <?php foreach($publisher as $row){?>
                                <option value="<?php echo $row['publisherID'];?>"><?php echo $row['publisherName'];?></option>
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
                        <th>Game</th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody id="game-tbody">
                    <?php if($game_list_edit != null) {
                        foreach($game_list_edit as $row){ ?>
                            <tr data-status="OLD" data-id="<?php echo $row['gameID'];?>"
                                data-setting = "<?php echo $row['sPublisherID'];?>">
                                <td><?php echo $row['gameName']; ?></td>
                                <td>
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
                <h4 class="modal-title" id="modal-title">Add Publisher</h4>
            </div>
            <div class="modal-body">
                <form id="setting-form">
                    <p>
                        <label for="game-select">Game : <span class="label label-danger" id="err-game"></span></label>
                        <select id="game-select" data-label="#err-game">
                            <option value="">Choose..</option>
                            <?php foreach($game as $row){?>
                                <option value="<?php echo $row['gameID']?>"><?php echo $row['gameName']?></option>
                            <?php }?>
                        </select>
                    </p>
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
        var game_detail = new Array();
        var game_delete = new Array();

        // Adding from modal to Detail
        $('#btn-add-detail').click(function(){
            if(validateAddDetail()){
                var game = $("#game-select").val();
                var game_name = $("#game-select option:selected").text();

                //Adding to #game-tbody
                var tr = $("<tr>",{"data-status":"NEW","data-id":game});
                var td1 = $("<td>").text(game_name);
                var td2 = $("<td>");
                var btn_del = $("<button>",{class:"btn btn-danger btn-sm btn-del-detail"}).html('<i class="fa fa-remove"></i>');
                td1.appendTo(tr);
                td2.append(btn_del);
                td2.appendTo(tr);
                tr.appendTo("#game-tbody");
                //Push to Array game_detail
                var detailData = {
                    id : game
                };
                game_detail.push(detailData);

                $('#game-select').val('').change();
                $('.setting-modal').modal('hide');
            }
        });

        // Delete Detail
        $("#game-tbody" ).on( "click", ".btn-del-detail", function() {
            var row = $(this).closest("tr");
            var status = row.attr("data-status");
            var id = row.attr("data-id");
            if(status == "NEW"){
                row.remove();
                game_detail.splice( $.inArray(id,game_detail) ,1 );
            }else if(status == "OLD"){
                row.addClass('tr-del');
                row.attr("data-status","DEL");
                var detailData = {
                    id : id
                };
                game_delete.push(detailData);
            }else if(status == "DEL"){
                row.removeClass('tr-del');
                row.attr("data-status","OLD");
                game_delete.splice( $.inArray(id,game_delete) ,1 );
            }
        });

        $('#btn-save').click(function(){
            if(validateSave()){
                var id = $('#setting-id').val();
                var update_publisher = $('#publisher-select').val();
                var formData = new FormData();
                formData.append("game_list", JSON.stringify(game_detail));
                if(id == '00') {
                    // ADD NEW SETTING
                    formData.append("publisher", update_publisher);
                    $(this).saveData({
                        url: "<?php echo site_url('SPublisher/createSPublisher')?>",
                        data: formData,
                        locationHref: "<?php echo site_url('SPublisher')?>"
                    });
                }else{
                    // UPDATE SETTING
                    if(id != update_publisher) {
                        //Update header if Setting Header is edited
                        formData.append("update_header", "1");
                        formData.append("update_publisher", update_publisher);
                    }else{
                        //Header is not edited
                        formData.append("update_header", "0");
                        formData.append("update_publisher", id);
                    }
                    formData.append("publisher",id);
                    formData.append("game_delete", JSON.stringify(game_delete));
                    $(this).saveData({
                        url: "<?php echo site_url('SPublisher/updateSPublisher')?>",
                        data: formData,
                        locationHref: "<?php echo site_url('SPublisher')?>"
                    });
                }
            }
        });

        function validateAddDetail(){
            var err=0;

            if(!$("#game-select").validateRequired()){
                err++;
            }else{
                var publisher = $("#game-select").val();
                //var check = jQuery.inArray(publisher, game_detail);
                var filtered = $(game_detail).filter(function(){
                    return this.id == publisher;
                });
                if(filtered.length > 0){
                    err++;
                    alertify.error("This game is allready on detail");
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
            var array_size = game_detail.length;
            var setting_id = $("#setting-id").val();

            if(!$('#publisher-select').validateRequired()){
                err++;
            }

            if(setting_id == '00'){
                if(array_size == 0){
                    err++;
                    alertify.error("Detail Game can't be empty !");
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