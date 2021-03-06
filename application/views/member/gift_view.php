<style>
.ribbon-container {
    position: relative;
    display: inline-block;
    line-height: 1;
}

.ribbon-container img {
    vertical-align: middle;
    width:100%;
}

.ribbon {
    position: absolute;
    top: 1em;
    left: 0;
    margin-right: 1em;
    padding: .75em 1.25em .75em .75em;
    border-radius: 0 .5em .5em 0;
    background-color: #f33;
    background-image: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,.1) 100%);
    box-shadow: inset 0 .062em 0 rgba(255,255,255,.6), 0 .125em .25em rgba(0,0,0,.2);
    color: #fff;
    text-shadow: 0 -.062em 0 rgba(0,0,0,.2);
    white-space: nowrap;
    transition: background-color .2s ease-in-out;
}

.ribbon:before,
.ribbon:after {
    position: absolute;
    background-color: inherit;
    content: "";
}

.ribbon:before {
    bottom: 0;
    left: -.5em;
    width: .5em;
    height: 3em;
    border-radius: 0 0 0 .5em;
    background-image: linear-gradient(to right, rgba(0,0,0,.2) 0%, rgba(0,0,0,0) 100%);
}

.ribbon:after {
    top: -1em;
    left: -.5em;
    width: .5em;
    height: 1em;
    border-radius: .5em 0 0 .5em;
    background-image: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,.2) 100%);
    box-shadow: 0 .062em 0 rgba(255,255,255,.6);
}

.ribbon-container:hover .ribbon {
    background-color: #7acc29;
}

.gift-items{
    float:left;
    border:1px dashed black;
}
.gift-title{
    font-size: 30px;
    color:#39f;
}

.btn-claim{
    float:right;
}

.clear{
    clear: both;
}
</style>
<div class="page-title">
    <div class="title_left">
        <h3>Gift</h3>
    </div>
</div>
<div class="clearfix"></div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Gift List<small>List of available gift</small></h2>                
                <div class="clearfix"></div>
            </div>
            <?php echo $pages;?>
            <div class="x_content">
                
                <?php foreach ($gifts as $row) {
                ?>
                <div class="col-md-6 col-sm-6 col-xs-6 gift-items" id="<?php echo $row['giftID'];?>">
                    <div class="col-md-4 col-sm-4 col-xs-4 ribbon-container">
                        <img src="<?php echo base_url();?>img/gifts/<?php echo $row['image'];?>" />
                        <span class="ribbon"><span><?php echo $row['poin'];?></span> poin</span>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8 gift-detail">
                        <span class="gift-title"><?php echo $row['giftName'];?></span>
                        <p class="gift-description"><?php echo $row['giftDescription'];?></p>
                        <a class="btn btn-app btn-claim">
                            <i class="fa fa-gift"></i> Claim
                        </a>
                        <div class="clear"></div>
                    </div>
                </div>                
                <?php 
                } ?> 
                <div class="clear"></div>
                <?php echo $pages;?>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        $(".btn-claim").click(function (){
            var giftID = $(this).parent(".gift-detail").parent(".gift-items").attr("id");
            var giftName = $(this).siblings(".gift-title").html();
            var poin = $(this).parents(".gift-detail").siblings(".ribbon-container").children(".ribbon").children("span").html();

            if(poin <= $("#toppon-poin-content").html()*1){
                alertify.confirm("Are you sure, you want to claim "+giftName+" ?",
                    function(){
                        var data_post = {
                            giftID : giftID
                        };
                        $("#load_screen").show();
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "index.php/Gift/doClaimGift",
                            data: data_post,
                            type: "POST",
                            dataType: 'json',
                            success:function(data){
                                if(data.status != 'error') {
                                    $('.success-modal').modal({
                                        backdrop: 'static',
                                        keyboard: false,
                                        show : true
                                    });
                                    $("#success-modal-title").html("Congratulation your gift claim is success");
                                    $("#success-modal-check-email").html("Your gift claim will be processed");
                                    $('.success-modal').modal("show");
                                    $("#load_screen").hide();
                                    window.setTimeout( function(){
                                        location.href = "<?php echo site_url("User/dashboard")?>";
                                    }, 3000 );
                                    
                                }else{
                                    alertify.set('notifier','position', 'top-right');
                                    alertify.error(data.msg);
                                    $("#load_screen").hide();
                                }
                            },
                            error: function(xhr, status, error) {
                                //var err = eval("(" + xhr.responseText + ")");
                                alertify.set('notifier','position', 'top-right');
                                alertify.error('Cannot response server !');
                                $("#load_screen").hide();
                            }
                        });
                    }
                ).setHeader('Confirm Gift Claim');
            }
            else{
                alertify.set('notifier','position', 'top-right');
                alertify.error("Gift Claim fail, insufficient poin !");
            }
        });        
    });    
    </script>    