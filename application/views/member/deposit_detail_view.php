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


                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Invoice<small>Selected invoice</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <section class="content invoice">
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="col-xs-12 invoice-header">
                                                <h1>
                                        <i class="fa fa-globe"></i> Invoice #120170216
                                        <small class="pull-right">Date: 16/08/2016</small>
                                    </h1>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                From :
                                                <address>
                                        <strong>Toppon Indonesia</strong>
                                        <br>Jl. Kebon Jeruk Raya No. 27, 4th floor R431
                                        <br>Jakarta, Indonesia 11530
                                        <br>Phone: 1 (804) 123-9876
                                        <br>Email: info@toppon.co.id
                                    </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                To :
                                                <address>
                                        <strong>Cyber IT Solutions, Inc.</strong>
                                        <br>Jl. Kebon Jeruk Raya No. 27, 4th floor R431
                                        <br>Jakarta, Indonesia 11530
                                        <br>Phone: 1 (804) 123-9876
                                        <br>Email: info@cyberits.co.id
                                    </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                <b>Invoice #120170216</b>
                                                <br>
                                                <br>
                                                <b>Order ID:</b> 4F3S8J
                                                <br>
                                                <b>Payment Due:</b> 2/22/2016
                                                <br>
                                                <b>User ID:</b> valend69
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-xs-12 table">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>T.C.</th>
                                                            <th>Product</th>
                                                            <th>Nominal</th>
                                                            <th style="width: 59%">Description</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php //Untuk tampilkan data dari db
                                                            $i = 0;
                                                            foreach ($deposit_list as $row) {
                                                                 if($i %2 ==0)
                                                                 {
                                                                    ?>
                                                                    <tr class="even pointer">
                                                                    <?php
                                                                 }
                                                                 else 
                                                                 {
                                                                    ?>
                                                                    <tr class="odd pointer">
                                                                    <?php
                                                                 }
                                                                    $i++;
                                                                ?>
                                                                
                                                                    <td class="a-center ">
                                                                        <input type="checkbox" class="tableflat">
                                                                    </td>
                                                                    <td class=" "><?php echo $row['noRekening']; ?></td>
                                                                    <td class=" "><?php echo $row['nameRekening']; ?></td>
                                                                    <td class=" "><?php echo $row['bankName']; ?></td>
                                                                    <td class=" "><?php echo $row['coin']; ?></td>
                                                                    <td class=" "><?php echo $row['status']; ?></td>
                                                                    <td class="a-right a-right "><?php echo $row['coinConversion']; ?></td>
                                                                    <td class=" last">
                                                                        <a href="<?php echo site_url('Deposit/depositDetail');?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button></a>
                                                                        <a href="#"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                                                                        <a href="#"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-check"></i></button></a>
                                                                    </td>   
                                                                </tr> 
                                                                <?php
                                                            }
                                                        ?>

                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- accepted payments column -->
                                            <div class="col-xs-6">
                                                <p class="lead">Payment Methods:</p>
                                                <img src="<?php echo base_url(); ?>img/visa.png" alt="Visa">
                                                <img src="<?php echo base_url(); ?>img/mastercard.png" alt="Mastercard">
                                                <img src="<?php echo base_url(); ?>img/american-express.png" alt="American Express">
                                                <img src="<?php echo base_url(); ?>img/paypal2.png" alt="Paypal"> </br></br>
                                                <p>Silahkan transfer sejumlah nominal yang tertera ke rekening dibawah ini : </p>
                                                    
                                                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">BCA 527 113 7835 a.n. STEFANUS H HONTONG</p>
                                                    <p class="text-muted well well-sm no-shadow" style="margin-top: 5px;">BNI 029 712 9537 a.n. STEFANUS H HONTONG</p>
                                                    <p class="text-muted well well-sm no-shadow" style="margin-top: 5px;">MANDIRI 9000031786479 a.n. STEFANUS H HONTONG</p>
                                                
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-6">
                                                <p class="lead">Jatuh Tempo : 2/22/2014</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:50%">Subtotal:</th>
                                                                <td>Rp 250.000</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tax (10%)</th>
                                                                <td>Rp 25.000</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total:</th>
                                                                <td>Rp 275.123</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-xs-12">
                                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                                <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                                                <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>