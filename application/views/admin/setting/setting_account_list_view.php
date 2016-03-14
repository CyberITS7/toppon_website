<!-- page content -->
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Setting Account List <small>List of active setting accounts</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
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
                            <td class="td-poin"><?php echo $row['poin'];?></td>
                            <td class="td-coin"><?php echo $row['coin'];?></td>                            
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" data-toggle="modal" data-target=".member-modal"><i class="fa fa-pencil"></i> Edit </a>
                                <a href="#" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash-o"></i> Delete </a>
                            </td>
                            <input type="hidden" value="<?php echo $row['sAccountID'];?>" class="item-id"/>
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
                        <input type="text" class="form-control" id="username" name="username" data-label="#err-username">
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Name: <span class="label label-danger" id="err-name"></span></label>
                        <input type="text" class="form-control" id="name" name="name" data-label="#err-name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email: <span class="label label-danger" id="err-email"></span></label>
                        <input type="text" class="form-control" id="email" name="email" data-label="#err-email">
                    </div>
                    <div class="form-group">
                        <label for="phone-number" class="control-label">Phone Number: <span class="label label-danger" id="err-phone-number"></span></label>
                        <input type="text" class="form-control" id="phone-number" name="phone-number" data-label="#err-phone-number">
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
    $(document).ready( function($) {
        function validate(){
            var err=0;

            if(!$('#username').validateRequired()){
                err++;
            }else if(!$('#username').validateLengthRange({minLength : 4, maxLength:50})){
                err++;
            }

            if(!$('#name').validateRequired()){
                err++;
            }else if(!$('#name').validateLengthRange({minLength : 4, maxLength:50})){
                err++;
            }

            if(!$('#email').validateRequired()){
                err++;
            }else if(!$('#email').validateLengthRange({minLength : 4, maxLength:50})){
                err++;
            }else if(!$('#email').validateEmailForm()){
                err++;
            }

            if(!$('#phone-number').validateRequired()){
                err++;
            }else if(!$('#phone-number').validateLengthRange({minLength : 4, maxLength:50})){
                err++;
            }else if(!$('#phone-number').validatePhoneForm()){
                err++;
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }
        }        

        $('.btn-edit').click(function(){
            // Set Title modal
            $('.modal-title').html('Edit Member Info');            
            //reset form
            $('#member-form')[0].reset();

            var row = $(this).closest("tr");
            var col_username =  row.find(".td-username").text();
            var col_name =  row.find(".td-name").text();
            var col_email =  row.find(".td-email").text();
            var col_phone_number =  row.find(".td-phone-number").text();
            var col_id =  row.find("input.item-id").val();

            //set data to Modal
            $("#member-id").val(col_id);
            $("#username").val(col_username);
            $("#name").val(col_name);
            $("#email").val(col_email);
            $("#phone-number").val(col_phone_number);
        });

        $('#btn-update').click(function(){
            if(validate()){
                var formData = new FormData();
                formData.append("id", $("#member-id").val());
                formData.append("username", $("#username").val());
                formData.append("name", $("#name").val());
                formData.append("email", $("#email").val());
                formData.append("phone_number", $("#phone-number").val());

                $(this).saveData({
                    url		     : "<?php echo site_url('User/doUpdateMember')?>",
                    data		 : formData,
                    locationHref : "<?php echo site_url('User/memberList')?>"
                });
            }
        });

        $('.btn-delete').click(function(){
            var row = $(this).closest("tr");
            var col_username =  row.find(".td-username").text();
            var col_id =  row.find("input.item-id").val();

            var formData = new FormData();
            formData.append("id", col_id);

            $(this).deleteData({
                alertMsg     : "Do you want to delete this <i><b>"+col_username+"</b></i> member ?",
                alertTitle   : "Delete Confirmation",
                url		     : "<?php echo site_url('User/doDeleteMember')?>",
                data		 : formData,
                locationHref : "<?php echo site_url('User/memberList')?>"
            });
        });
    });

</script>