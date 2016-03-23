<style>
    .dashboard-content{
        padding: 0 5px 6px;
        position: relative;
        float: left;
        clear: both;
        width: 100%;
        margin: auto;
        margin-top: 5px;
    }
    .dashboard-content .row{
        margin: auto;
        max-width: 900px;
    }
    .dashboard-content a{
        display: block;
        color: #fff;
        width: 100%;
        height: 100%;
    }
    .dashboard-item{
        position: relative;
        height: 90px;
        color: #fff;
        background-color: #1D6FB7;
        padding: 10px;
        padding-left: 20px;
        border:4px solid #fff;
        margin-bottom: 10px;

    }
    .dashboard-item h1{
        float: left;
        margin-left: 10px;
        margin-top: 18px;
        font-size: 20px;
    }
    .dashboard-item-img{
        float: left;
        padding: 1px;
        background-color: #fff;
        border-radius: 50%;
    }
    .dashboard-item-img img{
        width: 60px;
        height:60px;
    }
    .dashboard-item:hover{
        cursor: pointer;
        background-color: #1FA7DF;
    }
    #game-category{
        border-bottom: none;
    }
    #game-category-ul{
        width: 95%;
        list-style: none;
        position: absolute;
        top: 86px ;
        right: 0;
        padding: 0;
        border : 2px solid #73879C;
        border-top: none;
        background: #fff;
        z-index: 2;
        display: none;
    }
    #game-category-ul li{
        font-size: 16px;
        padding: 10px;
        padding-left: 80px;
        margin-top: 5px;
        margin-bottom: 10px;
    }
    #game-category-ul li a{
        width: 100%;
        height: auto;
        color: #73879C;
        font-weight: bold;
        text-decoration: none;
    }
    #game-category-ul li:hover, #game-category-ul li a:hover{
        text-decoration: none;
        color: #fff;
        background: #1FA7DF;
    }

    @media (max-width: 414px) {
        .dashboard-item{
            height: 70px;
            padding: 10px;
            padding-left: 10px;
            margin-bottom: 7px;

        }
        .dashboard-item h1{
            margin-top: 14px;
            font-size: 16px;
        }
        .dashboard-item{
            padding: 10px;
            padding-left: 20px;
            border:4px solid #fff;
            margin-bottom: 5px;
        }
        .dashboard-item-img img{
            width: 40px;
            height:40px;
        }
        #game-category-ul{
            top: 66px ;
        }
        #game-category-ul li{
            font-size: 14px;
            padding: 5px;
            padding-left: 60px;
            margin-top: 4px;
            margin-bottom: 10px;
        }
    }
</style>
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Home<small>dashboard</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="dashboard-item col-md-6 col-sm-6 col-xs-12" id="game-category" data-href="">
                        <span class="dashboard-item-img"><img src="<?php echo base_url();?>img/icon/buy.png"/></span>
                        <h1>Game Purchase</h1>
                        <div class="clear"></div>
                        <ul id="game-category-ul">
                            <?php foreach($game_category as $row){?>
                                <li>
                                    <a href="<?php echo site_url('GamePurchase/index/'.$row['gameCategoryID'])?>">
                                        <?php echo $row['gameCategoryName']?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>


                    <div class="dashboard-item col-md-6 col-sm-6 col-xs-12">
                        <a href="<?php echo site_url('Deposit/depositInsertForm');?>">
                            <span class="dashboard-item-img"><img src="<?php echo base_url();?>img/icon/topup.png"/></span>
                            <h1>Top Up</h1>
                        </a>
                    </div>


                    <div class="dashboard-item col-md-6 col-sm-6 col-xs-12">
                        <a href="<?php echo site_url('Transfer');?>">
                            <span class="dashboard-item-img"><img src="<?php echo base_url();?>img/icon/transfer.png"/></span>
                            <h1>Transfer</h1>
                        </a>
                    </div>


                    <div class="dashboard-item col-md-6  col-sm-6 col-xs-12">
                        <a href="<?php echo site_url('Gift');?>">
                            <span class="dashboard-item-img"><img src="<?php echo base_url();?>img/icon/gift.png"/></span>
                            <h1>Gift</h1>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function($) {
        $("#game-category").click(function(){
            $("#game-category-ul").slideToggle();
        });
    });
</script>