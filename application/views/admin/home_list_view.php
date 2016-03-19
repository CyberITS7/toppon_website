<div class="page-title">
    <div class="title_left">
        <h3>
            <button type="button" class="btn btn-primary" id="btn-add" data-toggle="modal" data-target=".home-modal">
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
                <h2>Home List<small>List of home details</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Name </th>
                        <th>Image</th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="td-home-name">slider1</td>
                            <td class="td-home-name"><?php echo $home->slider1;?></td> <!-- tampilkan data jika tidak pakai foreach -->
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                            </td>
                        </tr>
                         <tr>
                            <td class="td-home-name">slider2</td>
                            <td class="td-home-name"><?php echo $home->slider2;?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-home-name">slider3</td>
                            <td class="td-home-name"><?php echo $home->slider3;?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-home-name">slider4</td>
                            <td class="td-home-name"><?php echo $home->slider4;?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-home-name">slider5</td>
                            <td class="td-home-name"><?php echo $home->slider5;?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-home-name">parallax1</td>
                            <td class="td-home-name"><?php echo $home->parallax1?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-home-name">parallax2</td>
                            <td class="td-home-name"><?php echo $home->parallax2?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade home-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="home-form">
                    <input type="hidden" class="form-control" id="home-id">
                    <div class="form-group">
                        <label for="home-name" class="control-label">Mata Uang : <span class="label label-danger" id="err-home"></span></label>
                        <select class="form-control" id="home-name" name="home-name" data-label="#err-home">
                            <option value="Rp">Rp</option>
                            <option value="$">$</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="home-name" class="control-label">Nilai Home : <span class="label label-danger" id="err-name"></span></label>
                        <input type="text" class="form-control" id="home-name" name="home-name" data-label="#err-name">
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

            if(!$('#home-name').validateRequired()){
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

            if(!$('#home-name').validateRequired()){
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
            $('.modal-title').html('Add Home');
            // Show hide button
            $('#btn-update').hide();
            $('#btn-save').show();
            //reset form
            $('#home-form')[0].reset();
        });

        $('.btn-edit').click(function(){
            $('.label-danger').html('');
            // Set Title modal
            $('.modal-title').html('Edit Home');
            // Show hide button
            $('#btn-save').hide();
            $('#btn-update').show();
            //reset form
            $('#home-form')[0].reset();

            var row = $(this).closest("tr");
            var col_title =  row.find(".td-home-name").text();
            var col_id =  row.find("input.item-id").val();
            var col_home =  row.find(".td-home-name").text();

            //set data to Modal
            $("#home-id").val(col_id);
            $("#home-name").val(col_title);
            $("#home-name").val(col_home);
        });

        $('#btn-save').click(function(){
            if(validate()){
                var formData = new FormData();
                formData.append("name", $("#home-name").val());
                formData.append("home", $("#home-name").val());

                $(this).saveData({
                    url          : "<?php echo site_url('Home/createHome')?>",
                    data         : formData,
                    locationHref : "<?php echo site_url('Home')?>"
                });
            }
        });

        $('#btn-update').click(function(){
            if(validateEdit()){
                var formData = new FormData();
                formData.append("id", $("#home-id").val());
                formData.append("name", $("#home-name").val());
                formData.append("home", $("#home-name").val());

                $(this).saveData({
                    url          : "<?php echo site_url('Home/updateHome')?>",
                    data         : formData,
                    locationHref : "<?php echo site_url('Home')?>"
                });
            }
        });

        $('.btn-delete').click(function(){
            var row = $(this).closest("tr");
            var col_title =  row.find(".td-home-name").text();
            var col_id =  row.find("input.item-id").val();
            var col_home =  row.find(".td-home-name").text();

            var formData = new FormData();
            formData.append("id", col_id);

            $(this).deleteData({
                alertMsg     : "Do you want to delete this <i><b>"+col_home+" "+col_title+"</b></i> home ?",
                alertTitle   : "Delete Confirmation",
                url          : "<?php echo site_url('Home/deleteHome')?>",
                data         : formData,
                locationHref : "<?php echo site_url('Home')?>"
            });
        });
    });

</script>