<div class="page-title">
    <div class="title_left">
        <h3> Home 
        </h3>
    </div>

    
</div>
<div class="clearfix"></div>

<!-- page content -->

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Home List<small>List of Homepage Contents Details</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Content Name </th>
                        <th>Content Image </th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                            <tr>
                                <td class="td-home-name">Slider1</td>
                                <td class="td-home-img"><img src="<?php echo base_url();?>img/home/<?php echo $home->slider1;?>" width="100" class="img-responsive"/></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit" data-column="slider1" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-home-name">Slider2</td>
                                 <td class="td-home-img"><img src="<?php echo base_url();?>img/home/<?php echo $home->slider2;?>" width="100" class="img-responsive"/></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit" data-column="slider2" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-home-name">Slider3</td>
                                 <td class="td-home-img"><img src="<?php echo base_url();?>img/home/<?php echo $home->slider3;?>" width="100" class="img-responsive"/></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit" data-column="slider3" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-home-name">Slider4</td>
                                 <td class="td-home-img"><img src="<?php echo base_url();?>img/home/<?php echo $home->slider4;?>" width="100" class="img-responsive"/></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit" data-column="slider4" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-home-name">Slider5</td>
                                 <td class="td-home-img"><img src="<?php echo base_url();?>img/home/<?php echo $home->slider5;?>" width="100" class="img-responsive"/></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit" data-column="slider5" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-home-name">Parallax1</td>
                                 <td class="td-home-img"><img src="<?php echo base_url();?>img/home/<?php echo $home->parallax1;?>" width="100" class="img-responsive"/></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit" data-column="parallax1" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-home-name">Parallax2</td>
                                 <td class="td-home-img"><img src="<?php echo base_url();?>img/home/<?php echo $home->parallax2;?>" width="100" class="img-responsive"/></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit" data-column="parallax2" data-toggle="modal" data-target=".home-modal"><i class="fa fa-pencil"></i> Edit </a>
                                </td>
                            </tr>
                    </tbody>
                </table>

                <!--tabel about us-->

                <br><br>
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Content Name </th>
                        <th>Description </th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                            <tr>
                                <td class="td-home-name">About Us</td>
                                <td class="td-home-description"><?php echo $home->aboutUsContent;?></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs btn-edit-about" data-toggle="modal" data-target=".about-modal"><i class="fa fa-pencil"></i> Edit </a>
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
                    <input type="hidden" class="form-control" id="home-column">
                    <div class="form-group">
                        <label for="home-name" class="control-label">Content Name : <span class="label label-danger" id="err-name"></span></label>
                        <input type="text" class="form-control" id="home-name" name="home-name" data-label="#err-name" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="home-img">Content Image : <span class="label label-danger" id="err-img"></span></label>
                        <input type="file" id="home-img" name="home-img" data-label="#err-img">
                        <p class="help-block">Max size img 2 Mb</p>
                        <img src="" width="100" height="100" id="preview-img"/>
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

<!-- MODAL -->
<div class="modal fade about-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="about-form">
                    <input type="hidden" class="form-control" id="about-column">
                    <div class="form-group">
                        <label for="about-us-desc" class="control-label">About Us : <span class="label label-danger" id="err-about"></span></label>
                        <textarea name="about-us-desc" id="about-us-desc" class="form-control" data-label="#err-about"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-update-about">Update changes</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>js/validate_master.js"></script>
<script>
    $(document).ready( function($) {

        function validateEdit(){
            var err=0;

            if(!$('#home-name').validateRequired()){
                err++;
            }

            if($('#home-img').val()!= ""){
                if(!$('#home-img').validateImgType()){
                    err++;
                }else if(!$('#home-img').validateMaxSize()){
                    err++;
                }
            }
            if(err!=0){
                return false;
            }else{
                return true;
            }

        }

        function validateEditAbout(){
            var err=0;

            if(!$('#about-us-desc').validateRequired()){
                err++;
            }

            if(err!=0){
                return false;
            }else{
                return true;
            }

        }

        //Image Preview
        $('body').on('change', '#home-img', function(e){
            var article_img_file = this;
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(this.files[0]);
            reader.onload = function (e) {
                $("#preview-img").attr('src', e.target.result);
            }
        });


        $('.btn-edit').click(function(){
            $('.label-danger').html('');
            // Set Title modal
            $('.modal-title').html('Edit Home');
            // Show hide button
            $('#btn-update').show();
            //reset form
            $('#home-form')[0].reset();

            var row = $(this).closest("tr");
            var col_title =  row.find(".td-home-name").text();
            var col_img =  row.find(".td-home-img").children("img").prop('src');
            var col_id =  $(this).attr("data-column");

            //set data to Modal
            $("#home-column").val(col_id);
            $("#home-name").val(col_title);
            $('#preview-img').attr('src', col_img);
        });

        $('.btn-edit-about').click(function(){
            $('.label-danger').html('');
            // Set Title modal
            $('.modal-title').html('Edit About');
            // Show hide button
            $('#btn-update-about').show();
            //reset form
            $('#about-form')[0].reset();

            var row = $(this).closest("tr");
            var col_title =  row.find(".td-home-description").text();

            //set data to Modal
            $("#about-us-desc").val(col_title);
        });

        $('#btn-update').click(function(){
            if(validateEdit()){

                var formData = new FormData();
                formData.append("data_column", $("#home-column").val());
                formData.append("img", $("#home-img")[0].files[0]);

                $(this).saveData({
                    url          : "<?php echo site_url('Home/updateHomeImg')?>",
                    data         : formData,
                    locationHref : "<?php echo site_url('home/homeContentList')?>"
                });
            }
        });

        $('#btn-update-about').click(function(){
            if(validateEditAbout()){

                var formData = new FormData();
                formData.append("data_column", $("#about-us-desc").val());

                $(this).saveData({
                    url          : "<?php echo site_url('Home/updateHomeAbout')?>",
                    data         : formData,
                    locationHref : "<?php echo site_url('home/homeContentList')?>"
                });
            }
        });

    });

</script>