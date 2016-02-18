<div class="page-title">
    <div class="title_left">
        <h3>Deposit <a href="<?php echo site_url('Deposit/depositInsertForm')?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus-square"></i>&nbsp Baru</button></a></h3>
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
                                    <h2>Deposit List <small>List of deposits</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                <th>No. Rekening </th>
                                                <th>Nama Rekening </th>
                                                <th>Nama Bank </th>
                                                <th>T.C. </th>
                                                <th>Status </th>
                                                <th>Nominal </th>
                                                <th class=" no-link last"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="even pointer">
                                                <td class="a-center ">
                                                    <input type="checkbox" class="tableflat">
                                                </td>
                                                <td class=" ">121000040</td>
                                                <td class=" ">SATRIA W SANDI </td>
                                                <td class=" ">BCA </td>
                                                <td class=" ">100</td>
                                                <td class=" ">Paid</td>
                                                <td class="a-right a-right ">Rp 100.000</td>
                                                <td class=" last">
                                                    <a href="<?php echo site_url('Deposit/depositDetail');?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button></a>
                                                    <a href="#"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                                                    <a href="#"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-check"></i></button></a>
                                                </td>
                                            </tr>   
                                            <tr class="odd pointer">
                                                <td class="a-center ">
                                                    <input type="checkbox" class="tableflat">
                                                </td>
                                                <td class=" ">121000039</td>
                                                <td class=" ">STEFANUS H HONTONG</td>
                                                <td class=" ">BNI</td>
                                                <td class=" ">50</td>
                                                <td class=" ">Unpaid</td>
                                                <td class="a-right a-right ">Rp 50.000</td>
                                                <td class=" last">
                                                    <a href="#"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button></a>
                                                    <a href="#"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                                                    <a href="#"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-check"></i></button></a>
                                                </td>
                                            </tr>
                                            <tr class="even pointer selected">
                                                <td class="a-center ">
                                                    <input type="checkbox" checked class="tableflat">
                                                </td>
                                                <td class=" ">121000038</td>
                                                <td class=" ">VICKY</td>
                                                <td class=" ">MANDIRI</td>
                                                <td class=" ">300</td>
                                                <td class=" ">Paid</td>
                                                <td class="a-right a-right ">Rp 300.000</td>
                                                <td class=" last">
                                                    <a href="#"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button></a>
                                                    <a href="#"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                                                    <a href="#"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-check"></i></button></a>
                                                </td>
                                            </tr>
                                            
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>