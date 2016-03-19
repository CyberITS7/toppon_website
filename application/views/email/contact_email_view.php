<div class='movableContent'>
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
        <tr>
            <td width="50">&nbsp;</td>
            <td width="500" align="center">
                <div class="contentEditableContainer contentTextEditable">
                    <div class="contentEditable" align='left' >
                        <p >Kepada Yth admin,
                            <br/>
                            Terdapat Feedback dari pengunjung website. Berikut detail feedbacknya :</p>
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
                        <td width="180"><b>Nama</b></td>
                        <td>: <?php echo $contact_detail['name'] ;?></td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td>: <?php echo $contact_detail['email'] ;?></td>
                    </tr>
                    <tr>
                        <td><b>Subjek</b></td>
                        <td>: <?php echo $contact_detail['subject'] ;?></td>
                    </tr>
                    <tr>
                        <td><b>Pesan</b></td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $contact_detail['message'] ;?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>