<style>
    .content-container{
        color: #555;
        font-family: Helvetica, Arial, sans-serif;
        line-height: 160%;
    }
</style>
<div class='movableContent' >
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
        <tr>
            <td width="50">&nbsp;</td>
            <td width="500" align="center">
                <div class="contentEditableContainer contentTextEditable">
                    <div class="contentEditable" align='left' >
                        <p >Kepada Yth <?php echo $name;?>,
                            <br/>
                            Transaksi Game Purchase Anda berhasil. Berikut detail transaksi Anda</p>
                    </div>
                </div>
            </td>
            <td width="50">&nbsp;</td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
        <tr>
            <td width="380" align="center" style="padding-top:25px;">
                <table cellpadding="1" cellspacing="0" border="0" width="350" align="center" class="content-container">
                    <tr>
                        <td width="180"><b>Tanggal</b></td>
                        <td>: <?php echo $data_api['date']?></td>
                    </tr>
                    <tr>
                        <td><b>IP Pembeli</b></td>
                        <td>: <?php echo $data_api['IPD']?></td>
                    </tr>
                    <tr>
                        <td><b>No.Transaksi</b></td>
                        <td>: <?php echo $data_api['QID']?></td>
                    </tr>
                    <tr>
                        <td><b>Nama Barang</b></td>
                        <td>: <?php echo $data_api['ProdID']?></td>
                    </tr>
                    <tr>
                        <td><b>No.Serial</b></td>
                        <td>: <?php echo $data_api['SN']?></td>
                    </tr>
                    <tr>
                        <td><b>Kode Rahasia</b></td>
                        <td>: <?php echo $data_api['SecretCode']?></td>
                    </tr>
                    <tr>
                        <td><b>Harga Toppon Coin</b></td>
                        <td>: <?php echo $data_api['Coin']?> TC</td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="500" height="50">
                <tr>
                    <td width="500">
                        <p>Silahkan login untuk melihat transaksi Anda :</p>
                    </td>
                <tr/>
                <tr>
                    <td bgcolor="#1D6FB7" align="center" style="border-radius:4px;" width="200" height="50">
                        <div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable" align='center' >
                                <a target='_blank' href="http://toppon.co.id/index.php/user/doLoginMember" style="color:#FFF;text-decoration: none;" class='link2'>LOGIN</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </tr>
    </table>
</div>