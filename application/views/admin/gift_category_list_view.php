<div class="page-title">
    <div class="title_left">
        <h3>
            <button type="button" class="btn btn-primary" id="btn-add" data-toggle="modal" data-target=".gift-category-modal">
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
                <h2>Gift List<small>List of Gifts</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="gift-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Nama Kategori Gift </th>                        
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php foreach($giftCategory as $row){?>
                            <tr>
                                <td class="td-gift-category-name"><?php echo $row['giftCategory'];?></td>                                
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".gift-category-modal"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="#" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash-o"></i> Delete </a>
                                </td>
                                <input type="hidden" value="<?php echo $row['giftCategoryID'];?>" class="item-id"/>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade gift-category-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="gift-category-form">
                    <input type="hidden" class="form-control" id="gift-category-id">
                    <div class="form-group">
                        <label for="gift-category-name" class="control-label">Nama Kategori Gift : <span class="label label-danger" id="err-name"></span></label>
                        <input type="text" class="form-control" id="gift-category-name" name="gift-category-name" data-label="#err-name">
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
        var oTable = $('#gift-table').dataTable({
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

            if(!$('#gift-category-name').validateRequired()){
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

            if(!$('#gift-category-name').validateRequired()){
                err++;
            }
            
            if(err!=0){
                return false;
            }else{
                return true;
            }

        }
        

        $('#btn-add').click(function(){
            $(".label-danger").html("");
            // Set Title modal
            $('.modal-title').html('Add Gift Category');
            // Show hide button
            $('#btn-update').hide();
            $('#btn-save').show();
            //reset form
            $('#gift-category-form')[0].reset();
        });

        $('.btn-edit').click(function(){
            $(".label-danger").html("");
            // Set Title modal
            $('.modal-title').html('Edit Gift Category');
            // Show hide button
            $('#btn-save').hide();
            $('#btn-update').show();
            //reset form
            $('#gift-category-form')[0].reset();

            var row = $(this).closest("tr");
            var col_title =  row.find(".td-gift-category-name").text();            
            var col_id =  row.find("input.item-id").val();

            //set data to Modal
            $("#gift-category-id").val(col_id);
            $("#gift-category-name").val(col_title);            
        });

        $('#btn-save').click(function(){
            if(validate()){
                var formData = new FormData();                
                formData.append("name", $("#gift-category-name").val());

                $(this).saveData({
                    url		     : "<?php echo site_url('GiftCategory/createGiftCategory')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('GiftCategory')?>"
                });
            }
        });

        $('#btn-update').click(function(){
            if(validateEdit()){

                var formData = new FormData();
                formData.append("id", $("#gift-category-id").val());
                formData.append("name", $("#gift-category-name").val());                

                $(this).saveData({
                    url		     : "<?php echo site_url('GiftCategory/updateGiftCategory')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('GiftCategory')?>"
                });
            }
        });

        $('.btn-delete').click(function(){
            var row = $(this).closest("tr");
            var col_title =  row.find(".td-gift-category-name").text();
            var col_id =  row.find("input.item-id").val();

            var formData = new FormData();
            formData.append("id", col_id);

            $(this).deleteData({
                alertMsg     : "Do you want to delete this <i><b>"+col_title+"</b></i> gift category ?",
                alertTitle   : "Delete Confirmation",
                url		     : "<?php echo site_url('GiftCategory/deleteGiftCategory')?>",
                data		 : formData,
                locationHref : "<?php echo site_url('GiftCategory')?>"
            });
        });
    });

</script>