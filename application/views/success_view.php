<style>
    .success-modal{
        text-align: center;
    }
    .success-modal .modal-body h1{
        font-size: 25px;
    }
    .success-modal .header-box-logo{
        width: 250px;
        margin: auto;
    }
    .success-modal .modal-footer{
        text-align: left;
    }
    .success-modal .footer-item-container{
        position: relative;
        text-align: left;
        bottom: 0;
    }
    .success-modal .footer-item{
        width: 40px;
        height: 40px;
        float: left;
    }
</style>
<!-- Success Message Modal -->
<div class="modal fade success-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <div class="header-box-logo">
                    <img src="<?php echo base_url(); ?>img/toppon.png" class="img-responsive"/>
                </div>
            </div>
            <div class="modal-body">
                <h1 id="success-modal-title">Congratulation your transaction is successed</h1>
                <p>Thank you for using Toppon for your games payment solution</p>
                <p>Your order will be processed, please check your email</p>
            </div>
            <div class="modal-footer">
                <h4>Follow Us</h4>
                <div class="footer-item-container">
                    <div class="footer-item">
                        <a href="#"><img src="<?php echo base_url();?>/img/sosmed/fb.png" class="img-responsive"/></a>
                    </div>
                    <div class="footer-item">
                        <a href="#"><img src="<?php echo base_url();?>/img/sosmed/twitter.png" class="img-responsive"/></a>
                    </div>
                    <div class="footer-item">
                        <a href="#"><img src="<?php echo base_url();?>/img/sosmed/ig.png" class="img-responsive"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>