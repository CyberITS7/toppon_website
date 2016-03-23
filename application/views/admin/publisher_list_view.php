<div class="page-title">
    <div class="title_left">
        <h3>
            <button type="button" class="btn btn-primary" id="btn-add" data-toggle="modal" data-target=".publisher-modal">
                <i class="fa fa-plus-square"></i>&nbsp Add
            </button>
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
                <h2>Publisher List<small>List of Publishers</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="publisher-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Nama Publisher </th>
                        <th>Gambar Publisher </th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php foreach($publisher as $row){?>
                            <tr>
                                <td class="td-publisher-name"><?php echo $row['publisherName'];?></td>
                                <td class="td-publisher-img"><img src="<?php echo base_url();?>img/publisher/<?php echo $row['publisherImage'];?>" width="100" class="img-responsive"/></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".publisher-modal"><i class="fa fa-pencil"></i> Edit </a>
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

<!-- MODAL -->
<div class="modal fade publisher-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="publisher-form">
                    <input type="hidden" class="form-control" id="publisher-id">
                    <div class="form-group">
                        <label for="publisher-name" class="control-label">Nama Publisher : <span class="label label-danger" id="err-name"></span></label>
                        <input type="text" class="form-control" id="publisher-name" name="publisher-name" data-label="#err-name">
                    </div>
                    <div class="form-group">
                        <label for="publisher-img">Gambar : <span class="label label-danger" id="err-img"></span></label>
                        <input type="file" id="publisher-img" name="publisher-img" data-label="#err-img">
                        <p class="help-block">Max size img 2 Mb</p>
                        <img src="" width="100" height="100" id="preview-img"/>
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
        var oTable = $('#publisher-table').dataTable({
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

            if(!$('#publisher-name').validateRequired()){
                err++;
            }

            if(!$('#publisher-img').validateRequired()){
                err++;
            }else if(!$('#publisher-img').validateImgType()){
                err++;
            }else if(!$('#publisher-img').validateMaxSize()){
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

            if(!$('#publisher-name').validateRequired()){
                err++;
            }

            if($('#publisher-img').val()!= ""){
                if(!$('#publisher-img').validateImgType()){
                    err++;
                }else if(!$('#publisher-img').validateMaxSize()){
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
        $('body').on('change', '#publisher-img', function(e){
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
            $('.modal-title').html('Add Publisher');
            // Show hide button
            $('#btn-update').hide();
            $('#btn-save').show();
            //reset form
            $('#publisher-form')[0].reset();
        });

        $('.btn-edit').click(function(){
            $('.label-danger').html('');
            // Set Title modal
            $('.modal-title').html('Edit Publisher');
            // Show hide button
            $('#btn-save').hide();
            $('#btn-update').show();
            //reset form
            $('#publisher-form')[0].reset();

            var row = $(this).closest("tr");
            var col_title =  row.find(".td-publisher-name").text();
            var col_img =  row.find(".td-publisher-img").children("img").prop('src');
            var col_id =  row.find("input.item-id").val();

            //set data to Modal
            $("#publisher-id").val(col_id);
            $("#publisher-name").val(col_title);
            $('#preview-img').attr('src', col_img);
        });

        $('#btn-save').click(function(){
            if(validate()){
                var formData = new FormData();
                formData.append("img", $("#publisher-img")[0].files[0]);
                formData.append("name", $("#publisher-name").val());

                $(this).saveData({
                    url		     : "<?php echo site_url('Publisher/createPublisher')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('Publisher')?>"
                });
            }
        });

        $('#btn-update').click(function(){
            if(validateEdit()){

                var formData = new FormData();
                formData.append("id", $("#publisher-id").val());
                formData.append("name", $("#publisher-name").val());
                if($('#publisher-img').val()!= ""){
                    formData.append("img", $("#publisher-img")[0].files[0]);
                    formData.append("isUpdateImg", 1);
                }else{
                    formData.append("isUpdateImg", 0);
                }

                $(this).saveData({
                    url		     : "<?php echo site_url('Publisher/updatePublisher')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('Publisher')?>"
                });
            }
        });

        $('.btn-delete').click(function(){
            var row = $(this).closest("tr");
            var col_title =  row.find(".td-publisher-name").text();
            var col_id =  row.find("input.item-id").val();

            var formData = new FormData();
            formData.append("id", col_id);

            $(this).deleteData({
                alertMsg     : "Do you want to delete this <i><b>"+col_title+"</b></i> publisher ?",
                alertTitle   : "Delete Confirmation",
                url		     : "<?php echo site_url('Publisher/deletePublisher')?>",
                data		 : formData,
                locationHref : "<?php echo site_url('Publisher')?>"
            });
        });
    });

</script>