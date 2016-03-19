<div class='movableContent'>
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
        <tr>
            <td width="50">&nbsp;</td>
            <td width="500" align="center">
                <div class="contentEditableContainer contentTextEditable">
                    <div class="contentEditable" align='left' >
                        <p >Kepada Yth <?php echo $detail_user->name; ?>,
                            <br/>
                            Transaksi Transfer Anda berhasil. Berikut detail transaksi Anda</p>
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
                        <td>: <?php echo $detail_transfer->created ;?></td>
                    </tr>
                    <tr>
                        <td><b>Pengirim</b></td>
                        <td>: <?php echo $detail_transfer->pengirim ;?></td>
                    </tr>
                    <tr>
                        <td><b>Penerima</b></td>
                        <td>: <?php echo $detail_transfer->penerima ;?></td>
                    </tr>
                    <tr>
                        <td><b>Coin</b></td>
                        <td>: <?php echo $detail_transfer->coin ;?></td>
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
                                <a target='_blank' href="http://toppon.co.id/index.php/user/doLoginMember" class='link2' style="color:#FFF;text-decoration: none;">LOGIN</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </tr>
    </table>
</div>