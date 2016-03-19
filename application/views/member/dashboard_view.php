<style>
    .dashboard-content{
        padding: 0 5px 6px;
        position: relative;
        float: left;
        clear: both;
        /* width: 100%; */
        width: 100%;
        margin: auto;
        margin-top: 5px;
    }
    .dashboard-content .row{
        max-width: 900px;
        margin: auto;
    }
    .game-category-item{
        position: relative;
        height: 90px;
        color: #fff;
        background-color: #1D6FB7;
        padding: 15px;
        padding-left: 20px;
        min-width:300px ;
        margin-bottom: 30px;
        margin-right: 10px;
    }
    .game-category-item h1{
        float: left;
        margin-left: 10px;
        margin-top: 18px;
        font-size: 20px;
    }
    .game-category-item-img{
        float: left;
        padding: 1px;
        background-color: #fff;
        border-radius: 50%;
    }
    .game-category-item-img img{
        width: 60px;
        height:60px;
    }

    .game-category-item:hover{
        cursor: pointer;
        background-color: #1FA7DF;
    }
</style>
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Select Game Category<small>List of game categories</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="game-category-item " data-href="">
                            <span class="game-category-item-img"><img src="<?php echo base_url();?>img/icon/buy.png"/></span>
                            <h1>Game Purchase</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="game-category-item " data-href="" >
                            <span class="game-category-item-img"><img src="<?php echo base_url();?>img/icon/topup.png"/></span>
                            <h1>Top Up</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="game-category-item " data-href="">
                            <span class="game-category-item-img"><img src="<?php echo base_url();?>img/icon/transfer.png"/></span>
                            <h1>Transfer</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="game-category-item " data-href="">
                            <span class="game-category-item-img"><img src="<?php echo base_url();?>img/icon/gift.png"/></span>
                            <h1>Gift</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function($) {
        $(".game-category-item ").click(function(){

        });
    });
</script>