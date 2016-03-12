<div class="page-title">
    <div class="title_left">
        <h3>
            <button type="button" class="btn btn-primary" id="btn-add" data-toggle="modal" data-target=".nominal-modal">
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
                <h2>Nominal List<small>List of nominals</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Mata Uang </th>
                        <th>Nilai Nominal </th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach($nominal as $row){?>
                        <tr>
                            <td class="td-currency-name"><?php echo $row['currency'];?></td>
                            <td class="td-nominal-name"><?php echo $row['nominalName'];?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".nominal-modal"><i class="fa fa-pencil"></i> Edit </a>
                                <a href="#" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash-o"></i> Delete </a>
                            </td>
                            <input type="hidden" value="<?php echo $row['nominalID'];?>" class="item-id"/>
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
<div class="modal fade nominal-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="nominal-form">
                    <input type="hidden" class="form-control" id="nominal-id">
                    <div class="form-group">
                        <label for="currency-name" class="control-label">Mata Uang : <span class="label label-danger" id="err-currency"></span></label>
                        <select class="form-control" id="currency-name" name="currency-name" data-label="#err-currency">
                            <option value="Rp">Rp</option>
                            <option value="$">$</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nominal-name" class="control-label">Nilai Nominal : <span class="label label-danger" id="err-name"></span></label>
                        <input type="text" class="form-control" id="nominal-name" name="nominal-name" data-label="#err-name">
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

            if(!$('#nominal-name').validateRequired()){
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

            if(!$('#nominal-name').validateRequired()){
                err++;
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }

        }

        $('#btn-add').click(function(){
            $('.label-danger').html('');
            // Set Title modal
            $('.modal-title').html('Add Nominal');
            // Show hide button
            $('#btn-update').hide();
            $('#btn-save').show();
            //reset form
            $('#nominal-form')[0].reset();
        });

        $('.btn-edit').click(function(){
            $('.label-danger').html('');
            // Set Title modal
            $('.modal-title').html('Edit Nominal');
            // Show hide button
            $('#btn-save').hide();
            $('#btn-update').show();
            //reset form
            $('#nominal-form')[0].reset();

            var row = $(this).closest("tr");
            var col_title =  row.find(".td-nominal-name").text();
            var col_id =  row.find("input.item-id").val();
            var col_currency =  row.find(".td-currency-name").text();

            //set data to Modal
            $("#nominal-id").val(col_id);
            $("#nominal-name").val(col_title);
            $("#currency-name").val(col_currency);
        });

        $('#btn-save').click(function(){
            if(validate()){
                var formData = new FormData();
                formData.append("name", $("#nominal-name").val());
                formData.append("currency", $("#currency-name").val());

                $(this).saveData({
                    url		     : "<?php echo site_url('Nominal/createNominal')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('Nominal')?>"
                });
            }
        });

        $('#btn-update').click(function(){
            if(validateEdit()){
                var formData = new FormData();
                formData.append("id", $("#nominal-id").val());
                formData.append("name", $("#nominal-name").val());
                formData.append("currency", $("#currency-name").val());

                $(this).saveData({
                    url		     : "<?php echo site_url('Nominal/updateNominal')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('Nominal')?>"
                });
            }
        });

        $('.btn-delete').click(function(){
            var row = $(this).closest("tr");
            var col_title =  row.find(".td-nominal-name").text();
            var col_id =  row.find("input.item-id").val();
            var col_currency =  row.find(".td-currency-name").text();

            var formData = new FormData();
            formData.append("id", col_id);

            $(this).deleteData({
                alertMsg     : "Do you want to delete this <i><b>"+col_currency+" "+col_title+"</b></i> nominal ?",
                alertTitle   : "Delete Confirmation",
                url		     : "<?php echo site_url('Nominal/deleteNominal')?>",
                data		 : formData,
                locationHref : "<?php echo site_url('Nominal')?>"
            });
        });
    });

</script>