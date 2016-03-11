<div class="page-title">
    <div class="title_left">
        <h3>
            <a href="<?php echo site_url('SGame/goToAddDetailSGame')?>">
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-plus-square"></i>&nbsp Add
                </button>
            </a>
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
                <h2>Setting Game <small>List of game setting</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Game </th>
                        <th class=" no-link last"><span class="nobr">Action</span></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach($setting_game as $row){?>
                        <tr>
                            <td class="td-game-name"><?php echo $row['gameName'];?></td>
                            <td>
                                <a href="<?php echo site_url('SGame/goToEditDetailSGame/'.$row['gameID']);?>"
                                   class="btn btn-info btn-xs"><i class="fa fa-gears"></i> Setting </a>
                                <a href="#" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash-o"></i> Delete </a>
                            </td>
                            <input type="hidden" value="<?php echo $row['gameID'];?>" class="item-id"/>
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

<script src="<?php echo base_url(); ?>js/validate_master.js"></script>
<script>
    $(document).ready( function($) {

        $('.btn-delete').click(function(){
            var row = $(this).closest("tr");
            var col_title =  row.find(".td-game-name").text();
            var col_id =  row.find("input.item-id").val();

            var formData = new FormData();
            formData.append("id", col_id);

            $(this).deleteData({
                alertMsg     : "Do you want to delete this <i><b>"+col_title+"</b></i> game ?",
                alertTitle   : "Delete Confirmation",
                url		     : "<?php echo site_url('SGame/deleteSGame')?>",
                data		 : formData,
                locationHref : "<?php echo site_url('SGame')?>"
            });
        });
    });

</script>