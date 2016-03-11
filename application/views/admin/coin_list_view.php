<div class="page-title">
    <div class="title_left">
        <h3>
            <button type="button" class="btn btn-primary" id="btn-add" data-toggle="modal" data-target=".coin-modal">
                <i class="fa fa-plus-square"></i>&nbsp Add
            </button>
        </h3>
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
                <h2>Coin List</h2>
                <h2><small>List of Coin Details</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">   
                        <th>Coin </th>
                        <th>Conversion Value </th>
                        <th>Poin </th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach($coin as $row){?>
                        <tr>
                            <td class="td-coin-name"><?php echo $row['coin'];?></td>
                            <td class="td-coin-conversion"><?php echo $row['coinConversion'];?></td>
                            <td class="td-coin-poin"><?php echo $row['poin'];?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".coin-modal"><i class="fa fa-pencil"></i> Edit </a>
                                <a href="#" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash-o"></i> Delete </a>
                            </td>
                            <input type="hidden" value="<?php echo $row['coinID'];?>" class="item-id"/>
                        </tr>
                    <?php }?>
                    </tbody>
                    <?php echo $pages;?>
                </table>
                <?php echo $pages;?>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade coin-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="coin-form">
                    <input type="hidden" class="form-control" id="coin-id">
                    <div class="form-group">
                        <label for="coin-name" class="control-label">Coin : <span class="label label-danger" id="err-name"></span></label>
                        <input type="text" class="form-control" id="coin-name" name="coin-name" data-label="#err-name">
                    </div>
                    <div class="form-group">
                        <label for="coin-coinConversion" class="control-label">Conversion Value : <span class="label label-danger" id="err-coinConversion"></span></label>
                        <input type="text" class="form-control" id="coin-coinConversion" name="coin-coinConversion" data-label="#err-coinConversion">
                    </div>
                    <div class="form-group">
                        <label for="coin-poin" class="control-label">Poin : <span class="label label-danger" id="err-poin"></span></label>
                        <input type="text" class="form-control" id="coin-poin" name="coin-poin" data-label="#err-poin">
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
    $(document).ready( function($) {

        function validate(){
            var err=0;

            if(!$('#coin-name').validateRequired()){
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

            if(!$('#coin-name').validateRequired()){
                err++;
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }

        }

        $('#btn-add').click(function(){
            // Set Title modal
            $('.modal-title').html('Add Coin');
            // Show hide button
            $('#btn-update').hide();
            $('#btn-save').show();
            //reset form
            $('#coin-form')[0].reset();
        });

        $('.btn-edit').click(function(){
            // Set Title modal
            $('.modal-title').html('Edit Coin');
            // Show hide button
            $('#btn-save').hide();
            $('#btn-update').show();
            //reset form
            $('#coin-form')[0].reset();

            var row = $(this).closest("tr");
            var col_title =  row.find(".td-coin-name").text();
            var col_coinConversion =  row.find(".td-coin-conversion").text();
            var col_poin =  row.find(".td-coin-poin").text();
            var col_id =  row.find("input.item-id").val();

            //set data to Modal
            $("#coin-id").val(col_id);
            $("#coin-name").val(col_title);
            $("#coin-coinConversion").val(col_coinConversion);
            $("#coin-poin").val(col_poin);
        });

        $('#btn-save').click(function(){
            if(validate()){
                var formData = new FormData();
                formData.append("name", $("#coin-name").val());
                formData.append("coinConversion", $("#coin-coinConversion").val());
                formData.append("poin", $("#coin-poin").val());


                $(this).saveData({
                    url		     : "<?php echo site_url('Coin/createCoin')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('Coin')?>"
                });
            }
        });

        $('#btn-update').click(function(){
            if(validateEdit()){

                var formData = new FormData();
                formData.append("id", $("#coin-id").val());
                formData.append("name", $("#coin-name").val());
                formData.append("coinConversion", $("#coin-coinConversion").val());
                formData.append("poin", $("#coin-poin").val());

                $(this).saveData({
                    url		     : "<?php echo site_url('Coin/updateCoin')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('Coin')?>"
                });
            }
        });

        $('.btn-delete').click(function(){
            var row = $(this).closest("tr");
            var col_title =  row.find(".td-coin-name").text();
            var col_id =  row.find("input.item-id").val();

            var formData = new FormData();
            formData.append("id", col_id);

            $(this).deleteData({
                alertMsg     : "Do you want to delete this <i><b>"+col_title+"</b></i> coin ?",
                alertTitle   : "Delete Confirmation",
                url		     : "<?php echo site_url('Coin/deleteCoin')?>",
                data		 : formData,
                locationHref : "<?php echo site_url('Coin')?>"
            });
        });
    });

</script>