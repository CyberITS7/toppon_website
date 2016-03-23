<style>
    .gift-category-id{
        display: none;
    }
</style>
<div class="page-title">
    <div class="title_left">
        <h3>
            <button type="button" class="btn btn-primary" id="btn-add" data-toggle="modal" data-target=".gift-setting-modal">
                <i class="fa fa-plus-square"></i>&nbsp Add
            </button>
        </h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        </div>
    </div>
</div>
<div class="clearfix"></div>

<!-- page content -->

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Setting Gift List<small>List of Setting gifts</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="setting-gift-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Gift Name</th>
                        <th>Gift Category</th>
                        <th>Gift Description</th>
                        <th>Poin</th>
                        <th>Image</th>
                        <th>Reward</th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php foreach($gifts as $row){?>
                            <tr>
                                <td class="td-gift-name"><?php echo $row['giftName'];?></td>
                                <td class="td-gift-category-name"><?php echo $row['giftCategory'];?><span class="gift-category-id"><?php echo $row['giftCategoryID'];?></span></td>
                                <td class="td-gift-description"><?php echo $row['giftDescription'];?></td>
                                <td class="td-gift-poin"><?php echo $row['poin'];?></td>
                                <td class="td-gift-img"><img src="<?php echo base_url();?>img/gifts/<?php echo $row['image'];?>" width="50" height="50"/></td>
                                <td class="td-gift-reward"><?php echo $row['reward'];?></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".gift-setting-modal"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="#" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash-o"></i> Delete </a>
                                </td>
                                <input type="hidden" value="<?php echo $row['giftID'];?>" class="item-id"/>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade gift-setting-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="gift-setting-form">
                    <input type="hidden" class="form-control" id="gift-setting-id">
                    <div class="form-group">
                        <label for="gift-name" class="control-label">Nama Gift : <span class="label label-danger" id="err-gift-name"></span></label>
                        <input type="text" class="form-control" id="gift-name" name="gift-name" data-label="#err-gift-name">
                    </div>
                    <div class="form-group">
                        <label for="gift-category" class="control-label">Gift Kategori : <span class="label label-danger" id="err-gift-category"></span></label>
                        <select class="form-control" id="gift-category" name="gift-category" data-label="#err-gift-category">
                            <option value="">-=Choose=-</option>
                            <?php foreach ($gift_categories as $row) {
                                ?>
                                <option value="<?php echo $row['giftCategoryID']; ?>"><?php echo $row['giftCategory']; ?></option>
                                <?php
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gift-desc" class="control-label">Deskripsi Gift : <span class="label label-danger" id="err-gift-desc"></span></label>
                        <textarea class="form-control" id="gift-desc" name="gift-desc" data-label="#err-gift-desc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gift-poin" class="control-label">Poin : <span class="label label-danger" id="err-gift-poin"></span></label>
                        <input type="text" class="form-control" id="gift-poin" name="gift-poin" data-label="#err-gift-poin">
                    </div>
                    <div class="form-group">
                        <label for="gift-img">Gambar : <span class="label label-danger" id="err-img"></span></label>
                        <input type="file" id="gift-img" name="gift-img" data-label="#err-img">
                        <p class="help-block">Max size img 2 Mb</p>
                        <img src="" width="100" height="100" id="preview-img"/>
                    </div>
                    <div class="form-group">
                        <label for="gift-reward" class="control-label">Reward : <span class="label label-danger" id="err-gift-reward"></span></label>
                        <input type="text" class="form-control" id="gift-reward" name="gift-reward" data-label="#err-gift-reward">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
                <button type="button" class="btn btn-primary" id="btn-update">Update changes</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>js/validate_master.js"></script>
<script>
    var asInitVals = new Array();
    $(document).ready( function($) {
        var oTable = $('#setting-gift-table').dataTable({
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

            if(!$('#gift-name').validateRequired()){
                err++;
            }

            if(!$('#gift-category').validateRequired()){
                err++;
            }

            if(!$('#gift-desc').validateRequired()){
                err++;
            }

            if(!$('#gift-poin').validateRequired()){
                err++;
            }else if(!$('#gift-poin').validateNumberForm()){
                err++;
            }

            if(!$('#gift-reward').validateRequired()){
                err++;
            }else if(!$('#gift-reward').validateNumberForm()){
                err++;
            }

            if(!$('#gift-img').validateRequired()){
                err++;
            }else if(!$('#gift-img').validateImgType()){
                err++;
            }else if(!$('#gift-img').validateMaxSize()){
                err++;
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }
        }

        function validateEdit(){
            var err=0;

            if(!$('#gift-name').validateRequired()){
                err++;
            }

            if(!$('#gift-category').validateRequired()){
                err++;
            }

            if(!$('#gift-desc').validateRequired()){
                err++;
            }

            if(!$('#gift-poin').validateRequired()){
                err++;
            }else if(!$('#gift-poin').validateNumberForm()){
                err++;
            }

            if(!$('#gift-reward').validateRequired()){
                err++;
            }else if(!$('#gift-reward').validateNumberForm()){
                err++;
            }

            if($('#gift-img').val()!= ""){
                if(!$('#gift-img').validateImgType()){
                    err++;
                }else if(!$('#gift-img').validateMaxSize()){
                    err++;
                }
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }

        }

        //Image Preview
        $('body').on('change', '#gift-img', function(e){
            var article_img_file = this;
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(this.files[0]);
            reader.onload = function (e) {
                $("#preview-img").attr('src', e.target.result);
            }
        });

        $('#btn-add').click(function(){
            $('.label-danger').html('');
            // Set Title modal
            $('.modal-title').html('Add Gift Setting');
            // Show hide button
            $('#btn-update').hide();
            $('#btn-save').show();
            //reset form
            $('#gift-setting-form')[0].reset();
        });

        $('.btn-edit').click(function(){
            $('.label-danger').html('');
            // Set Title modal
            $('.modal-title').html('Edit Gift Setting');
            // Show hide button
            $('#btn-save').hide();
            $('#btn-update').show();
            //reset form
            $('#gift-setting-form')[0].reset();

            var row = $(this).closest("tr");
            var col_title =  row.find(".td-gift-name").text();
            var col_category =  row.find(".td-gift-category-name").children("span").html();
            var col_desc =  row.find(".td-gift-description").text();
            var col_poin =  row.find(".td-gift-poin").text();            
            var col_img =  row.find(".td-gift-img").children("img").prop('src');
            var col_reward =  row.find(".td-gift-reward").text();
            var col_id =  row.find("input.item-id").val();

            //set data to Modal
            $("#gift-setting-id").val(col_id);
            $("#gift-name").val(col_title);
            $("#gift-category").val(col_category);
            $("#gift-desc").val(col_desc);
            $("#gift-poin").val(col_poin);            
            $('#preview-img').attr('src', col_img);
            $("#gift-reward").val(col_reward);
        });

        $('#btn-save').click(function(){
            if(validate()){
                var formData = new FormData();
                
                formData.append("gift_name", $("#gift-name").val());
                formData.append("gift_category", $("#gift-category").val());
                formData.append("gift_desc", $("#gift-desc").val());
                formData.append("gift_poin", $("#gift-poin").val());            
                formData.append("img", $("#gift-img")[0].files[0]);
                formData.append("gift_reward", $("#gift-reward").val());

                $(this).saveData({
                    url		     : "<?php echo site_url('Gift/createGift')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('Gift/settingGiftList')?>"
                });
            }
        });

        $('#btn-update').click(function(){
            if(validateEdit()){

                var formData = new FormData();

                formData.append("id", $("#gift-setting-id").val());
                formData.append("gift_name", $("#gift-name").val());
                formData.append("gift_category", $("#gift-category").val());
                formData.append("gift_desc", $("#gift-desc").val());
                formData.append("gift_poin", $("#gift-poin").val()); 
                if($('#gift-img').val()!= ""){
                    formData.append("img", $("#gift-img")[0].files[0]);
                    formData.append("isUpdateImg", 1);
                }else{
                    formData.append("isUpdateImg", 0);
                }
                formData.append("gift_reward", $("#gift-reward").val());

                $(this).saveData({
                    url		     : "<?php echo site_url('Gift/updateGift')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('Gift/settingGiftList')?>"
                });
            }
        });

        $('.btn-delete').click(function(){
            var row = $(this).closest("tr");
            var col_title =  row.find(".td-gift-name").text();
            var col_id =  row.find("input.item-id").val();

            var formData = new FormData();
            formData.append("id", col_id);

            $(this).deleteData({
                alertMsg     : "Do you want to delete this <i><b>"+col_title+"</b></i> Gift ?",
                alertTitle   : "Delete Confirmation",
                url		     : "<?php echo site_url('Gift/deleteGift')?>",
                data		 : formData,
                locationHref : "<?php echo site_url('Gift/settingGiftList')?>"
            });
        });
    });

</script>