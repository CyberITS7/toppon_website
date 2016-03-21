<div class='movableContent'>
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
        <tr>
            <td width="50">&nbsp;</td>
            <td width="500" align="center">
                <div class="contentEditableContainer contentTextEditable">
                    <div class="contentEditable" align='left' >
                        <p >Kepada Yth <?php echo $detail_user->name; ?>,
                            <br/>
                            Pembayaran Anda telah kami terima. Berikut detail transaksi Anda :</p>
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
                        <td>: <?php echo $detail_topUp->lastUpdated ;?></td>
                    </tr>
                    <tr>
                        <td><b>Nomor Rekening</b></td>
                        <td>: <?php echo $detail_topUp->noRekening ;?></td>
                    </tr>
                    <tr>
                        <td><b>Nama Rekening</b></td>
                        <td>: <?php echo $detail_topUp->nameRekening ;?></td>
                    </tr>
                    <tr>
                        <td><b>Nama Bank</b></td>
                        <td>: <?php echo $detail_topUp->bankName ;?></td>
                    </tr>
                    <tr>
                        <td><b>Toppon Coin</b></td>
                        <td>: <?php echo $detail_topUp->coin ;?></td>
                    </tr>
                    <tr>
                        <td><b>Nominal</b></td>
                        <td>: <?php echo $detail_topUp->coinConversion ;?></td>
                    </tr>
                    <tr>
                        <td><b>Poin Reward</b></td>
                        <td>: <?php echo $detail_topUp->poin ;?></td>
                    </tr>
                     <tr>
                        <td><b>Status</b></td>
                        <td>: <?php echo $detail_topUp->status ;?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="500" height="50">
                <tr>
                    <td width="500">
                        <p>Login untuk melihat Toppon Coin dan Toppon Poin Anda :</p>
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