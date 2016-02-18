<style>
    .panel-collapse:hover{
        background: #FFF;
    }
    .panel-body:hover{
        background: #F2F5F7;
        cursor: pointer;
    }
    .panel-collapse .panel-body{
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .panel-body h4{
        width: 50%;
        padding-left: 20px;
    }

    .panel-title-container h4{
        float: left;
    }
    .panel-title-container >ul>li> a.collapse-link{
        padding: 0px;
        color : #5A738E;
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
            <h2><i class="fa fa-align-left"></i> Pilih Voucher Game </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">

            </div>
            <!-- end of accordion -->
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <p class="lead" id="detail-publisher">VOUCHER</p>
    <div class="table-responsive">
        <table class="table">
            <tbody>
            <tr>
                <th style="width:50%">Nominal :</th>
                <td id="detail-nominal">0</td>
            </tr>
            <tr>
                <th>Topon Coin : </th>
                <td id="detail-coin" data-value="">0 TC</td>
            </tr>
            <tr>
                <th>My Coin:</th>
                <td id="my-coin" data-value="<?php echo $account->coin; ?>"><?php echo $account->coin; ?> TC</td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="button" class="btn btn-info btn-lg" id="buy-game-btn"
                            data-id="" data-publisher="" data-nominal="" data-coin="" >BUY GAME</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        // Data Game List
        var data = <?=json_encode($game_list);?>;
        var temp = "";
        var id = "";
        jQuery.each( data, function( i, val ) {
            // Publisher
            if(temp != val.publisherName){

                var divH = $("<div>", {class:"panel"});
                var panel_heading = $("<a>", {"role":"tab", class:"panel-heading",
                    "data-toggle":"collapse", "data-parent":"#accordion", "href":"#collapse"+val.publisherID,
                    "aria-expanded":"true", "aria-controls":"collapse"+val.publisherID
                });

                // Title Container (Publisher Name -------- down arrow)
                var title_container = $("<div>", {class:"panel-title-container"});
                var panel_title=$("<h4>", {class:"panel-title"}).html('<i class="fa fa-ticket"></i> '+val.publisherName);
                var down_arrow =$("<ul>", {class:"nav navbar-right panel_toolbox"});
                var li_arrow = $("<li>").html('<a class="collapse-link"><i class="fa fa-chevron-down"></i></a>');
                var clear_arrow =  $("<div>", {class:"clearfix"});
                panel_title.appendTo(title_container);
                li_arrow.appendTo(down_arrow);
                down_arrow.appendTo(title_container);
                clear_arrow.appendTo(title_container);

                // Detail Nominal Container
                var divD = $("<div>", {class:"panel-collapse collapse", id:"collapse"+val.publisherID,
                    "role":"tabpanel"
                });

                title_container.appendTo(panel_heading);
                panel_heading.appendTo(divH);
                divD.appendTo(divH);
                divH.appendTo('#accordion');

                // Publisher to temp
                temp = val.publisherName;
                id = val.publisherID;

                // Collapsible Data (Nominal each publisher)
                var panel_body = $("<div>", {class:"panel-body", "data-coin":val.paymentValue,
                    "data-publisher-name":val.publisherName, "data-nominal-name":numberWithCommas(val.nominalName),
                    "data-publisher":val.publisherID, "data-nominal":val.nominalID,
                    "data-id":val.sGamesID
                });
                var h4 = $("<h4>",{class:"col-lg-6"});
                var value = $("<strong>").text(numberWithCommas(val.nominalName));
                var h4Coin = $("<h4>",{class:"coin-value col-lg-6"});
                var valueCoin = $("<strong>").text(numberWithCommas(val.paymentValue)+" TC");

                value.appendTo(h4);
                valueCoin.appendTo(h4Coin);
                h4.appendTo(panel_body);
                h4Coin.appendTo(panel_body);
                panel_body.appendTo(divD);

            }else{
                // Collapsible Data (Nominal each publisher)
                var panel_body = $("<div>", {class:"panel-body", "data-coin":val.paymentValue,
                    "data-publisher-name":val.publisherName, "data-nominal-name":numberWithCommas(val.nominalName),
                    "data-publisher":val.publisherID, "data-nominal":val.nominalID,
                    "data-id":val.sGamesID
                });
                var h4 = $("<h4>",{class:"col-lg-6"});
                var value = $("<strong>").text(numberWithCommas(val.nominalName));
                var h4Coin = $("<h4>",{class:"coin-value col-lg-6"});
                var valueCoin = $("<strong>").text(numberWithCommas(val.paymentValue)+" TC");

                value.appendTo(h4);
                valueCoin.appendTo(h4Coin);
                h4.appendTo(panel_body);
                h4Coin.appendTo(panel_body);
                panel_body.appendTo("#collapse"+val.publisherID);
            }

        });

        // Format Number to Currency
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('.panel-body').click(function(){
            var id = $(this).attr("data-id");
            var publisher = $(this).attr("data-publisher");
            var publisher_name = $(this).attr("data-publisher-name");
            var nominal = $(this).attr("data-nominal");
            var nominal_name = $(this).attr("data-nominal-name");
            var coin = $(this).attr("data-coin");

            $("#buy-game-btn").attr("data-id",id);
            $("#buy-game-btn").attr("data-publisher",publisher);
            $("#buy-game-btn").attr("data-nominal",nominal);
            $("#buy-game-btn").attr("data-coin",coin);

            $("#detail-publisher").text(publisher_name);
            $("#detail-nominal").text(nominal_name);
            $("#detail-coin").text(coin);
        });

        $('#buy-game-btn').click(function(){
            var id = $(this).attr("data-id");
            var coin = $("#detail-coin").attr("data-value");
            var myCoin = $("#my-coin").attr("data-value");

            if(id==0 || id==""){
                alertify.error('No voucher games selected !');
            }else{
                if(coin > myCoin){
                    alertify.error('Notenough TC Coin!');
                }else{
                    alertify.confirm("Do you want to buy this voucher ?",
                        function(){
                            // Confirm Action
                            // ajax mulai disini
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
                                        alertify.success(data.msg);
                                        location.href = "<?php echo site_url("GamePurchase")?>";
                                    }else{
                                        alertify.error(data.msg);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    //var err = eval("(" + xhr.responseText + ")");
                                    alertify.error(xhr.responseText);
                                }
                            });
                        }
                    );
                }

            }
        });


    });
</script>