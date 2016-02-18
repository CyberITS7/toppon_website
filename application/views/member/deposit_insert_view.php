<div class="page-title">
    <div class="title_left">
        <h3>Deposit <a href="<?php echo site_url('Deposit');?>"><button type="button" class="btn btn-dark"><i class="fa fa-chevron-left"></i>&nbsp Kembali</button></a></h3>
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
                                    <h2>Deposit Form <small>Form input deposit</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                             
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Deposit/topUpDeposit');?>" method="POST">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nomor-Rekening">Nomor Rekening <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="Nomor-Rekening" name="Nomor-Rekening" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nama-Rekening">Nama Rekening <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="Nama-Rekening" name="Nama-Rekening" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        
                                                      <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nama-Bank">Nama Bank <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="select2_single form-control" tabindex="-1" id="Nama-Bank" name="Nama-Bank" required="required" class="form-control col-md-7 col-xs-12">
                                                                <?php //Untuk tampilkan data dr db ke cmbBox
                                                                 foreach ($bank_list as $row) {
                                                                 ?>
                                                                        <option value="<?php echo $row['bankID']; ?>"><?php echo $row['bankName']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                      
                                                   
                                      
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Toppon-Coin">Toppon Coin <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="select2_single form-control" tabindex="-1" id="Toppon-Coin" name="Toppon-Coin" required="required" class="form-control col-md-7 col-xs-12">
                                                    <?php //Untuk tampilkan data dr db ke cmbBox
                                                                 foreach ($coin_list as $row) {
                                                                 ?>
                                                                        <option value="<?php echo $row['coinID']; ?>"><?php echo $row['coin']; ?>&nbsp (Rp&nbsp<?php echo $row['coinConversion']; ?>)</option>
                                                                <?php
                                                                }
                                                                ?>
                                                </select>
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button type="submit" class="btn btn-warning">Top Up</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




        </div>
    </div>
</div>