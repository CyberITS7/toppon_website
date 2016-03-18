<style>
    .panel-collapse:hover{
        background: #1FA7DF;;
    }
    .panel-body:hover{
        background: #1FA7DF;
        color : #FFF;
        cursor: pointer;
    }
    .panel-collapse .panel-body{
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .panel-body h4{
        width: 100%;
        padding-left: 20px;
    }
    .icon-pub{
        float: left;
        width: 100px;
        margin-right: 10px;
        height: auto;
    }
    .icon-pub img{
        margin: auto;
    }
    .panel-title-container h4{
        float: left;
    }
    .panel_toolbox{
        margin-top:8px;
    }
    .panel-title-container >ul>li> a.collapse-link{
        padding: 0px;
        color : #5A738E;
    }
    #nominal-tbody tr:hover{
        background: #1FA7DF;
        color:#FFF;
        cursor: pointer;
    }

</style>

<div class="page-title">
    <div class="title_left">
        <h3>Voucher Games</h3>
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

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-align-left"></i> Pilih Game </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <?php foreach($publisher_list as $row) { ?>
                    <div class="panel" data-status="false">
                        <a role="tab" class="panel-heading" data-toggle="collapse" data-publisher="<?php echo $row['publisherID'];?>"
                           data-parent="#accordion" href="#collapse<?php echo $row['publisherID'];?>"
                           aria-expanded="true" aria-controls="collapse<?php echo $row['publisherID'];?>">
                            <div class="panel-title-container">
                                <div class="panel-title">
                                    <div class="icon-pub"><img src="<?php echo base_url()?>img/publisher/<?php echo $row['publisherImage']; ?>" class="img-responsive"></div>
                                    <h4><?php echo $row['publisherName'];?></h4>
                                </div>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><i class="fa fa-chevron-down"></i></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <div id="collapse<?php echo $row['publisherID'];?>"
                             class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading<?php echo $row['publisherID'];?>">
                            <div class="panel-body" data-publisher="<?php echo $row['publisherName'];?>"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- end of accordion -->
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <p class="lead" id="choose-voucher-title"></p>
    <div class="table-responsive">
        <table class="table">
            <tbody id="nominal-tbody">

            </tbody>
        </table>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade purchase-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-title">Buy Voucher</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Publisher :</th>
                            <td id="detail-publisher"></td>
                        </tr>
                        <tr>
                            <th>Game : </th>
                            <td id="detail-game"></td>
                        </tr>
                        <tr>
                            <th>Voucher : </th>
                            <td id="detail-nominal"></td>
                        </tr>
                        <tr>
                            <th>Coin : </th>
                            <td id="detail-coin" data-value=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-buy" data-id="">Buy Voucher</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#load_screen").hide();
        // Get Game Data
        $('.panel').click(function(){
            var status = $(this).attr("data-status");
            if(status == "false") {
                var panel = $(this).children('a').attr("href");
                var id = $(this).children('a').attr("data-publisher");
                var panel_body = $(panel).children('.panel-body');
                $(this).attr("data-status","true");

                var data_post = {
                    id : id
                };
                // Get Game List
                var base_url = "<?php echo base_url();?>";
                $.ajax({
                    url: base_url+"index.php/Game/getGameList",
                    data: data_post,
                    type: "POST",
                    dataType: 'json',
                    success:function(data){
                        $.each( data, function( i, val ) {
                            var h4 = $("<h4>",
                                {class: "col-lg-12 game-dt", "data-id":val.gameID,"data-game":val.gameName}).text(val.gameName);
                            h4.appendTo(panel_body);
                            //alert('a');
                        });
                    },
                    error: function(xhr, status, error) {
                        //var err = eval("(" + xhr.responseText + ")");
                    }
                });
            }
        });

        // Get Nominal Data
        $( ".panel-body" ).on( "click", "h4.game-dt", function() {
            var id = $( this ).attr("data-id");
            var data_publisher =  $( this ).closest(".panel-body").attr("data-publisher");
            var data_game =  $( this ).attr("data-game");
            $("#choose-voucher-title").html("Pilih Voucher Game");
            $("#nominal-tbody").html("");
            var data_post = {
                id : id
            };
            // Get Game List
            var base_url = "<?php echo base_url();?>";
            $.ajax({
                url: base_url+"index.php/Game/getNominalGameList",
                data: data_post,
                type: "POST",
                dataType: 'json',
                success:function(data){
                    $.each( data, function( i, val ) {
                        var tr = $("<tr>",{"data-id":val.sGameID,"data-publisher":data_publisher,
                            "data-game":data_game,"data-nominal":val.nominalName,"data-payment":val.paymentValue});
                        var td1 = $("<td>").text(val.currency+" "+numberWithCommas(val.nominalName));
                        var td2 = $("<td>").text(numberWithCommas(val.paymentValue)+" TC");
                        td1.appendTo(tr);
                        td2.appendTo(tr);
                        tr.appendTo("#nominal-tbody");
                        //alert('a');
                    });
                },
                error: function(xhr, status, error) {
                    //var err = eval("(" + xhr.responseText + ")");
                }
            });
        });

        //Show Payment Modal
        $( "#nominal-tbody" ).on( "click", "tr", function() {
            var id =  $( this ).attr("data-id");
            var publisher =  $( this ).attr("data-publisher");
            var game =  $( this ).attr("data-game");
            var nominal =  $( this ).attr("data-nominal");
            var payment =  $( this ).attr("data-payment");

            // Set Detail Purchasing
            $("#detail-publisher").text(publisher);
            $("#detail-game").text(game);
            $("#detail-nominal").text(numberWithCommas(nominal));
            $("#detail-coin").text(numberWithCommas(payment)+" TC");
            $("#detail-coin").attr("data-value",payment);
            $("#btn-buy").attr("data-id",id);

            $('.purchase-modal').modal('show');
        });

        // Format Number to Currency
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('#btn-buy').click(function(){
            var id = $(this).attr("data-id");
            var coin = $("#detail-coin").attr("data-value");
            var myCoin = <?php echo $account->coin;?>;

            if(id==0 || id==""){
                alertify.error('No voucher games selected !');
            }else{
                if(coin > myCoin){
                    alertify.error('Not Enough TC Coin!');
                }else{
                    alertify.confirm("Do you want to buy this voucher ?",
                        function(){
                            // Confirm Action
                            // ajax mulai disini
                            //Loading screen
                            $("#load_screen").show();
                            var base_url = "<?php echo base_url();?>";
                            var data_post = {
                                id : id
                            };
                            $.ajax({
                                url: base_url+"index.php/GamePurchase/buyGames",
                                data: data_post,
                                type: "POST",
                                dataType: 'json',
                                success:function(data){
                                    if(data.status != 'error') {
                                        //Setting Success MODAL
                                        $('.success-modal').modal({
                                            backdrop: 'static',
                                            keyboard: false,
                                            show : true
                                        });
                                        $('.success-modal').modal("show");
                                        $("#load_screen").hide();
                                        window.setTimeout( function(){
                                            location.href = "<?php echo site_url("GamePurchase/index/".$categoryId)?>";
                                        }, 3000 );
                                    }else{
                                        alertify.error(data.msg);
                                        $("#load_screen").hide();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    //var err = eval("(" + xhr.responseText + ")");
                                    $("#load_screen").hide();
                                    alertify.error('Cannot response server !');
                                }
                            });
                        }
                    ).setHeader('Confirm Purchase Game');
                }

            }
        });


    });
</script>