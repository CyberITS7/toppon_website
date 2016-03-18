<div class='movableContent'>
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
        <tr>
            <td width="50">&nbsp;</td>
            <td width="500" align="center">
                <div class="contentEditableContainer contentTextEditable">
                    <div class="contentEditable" align='left' >
                        <p >Kepada Yth <?php echo $detail_user->name; ?>,
                            <br/>
                            Berikut link yang dapat digunakan untuk me reset password anda :</p>
                    </div>
                </div>
            </td>
            <td width="50">&nbsp;</td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
        <tr>
            <td width="100">&nbsp;</td>
            <td width="350" align="center" style="padding-top:25px;">
                <a href="<?php echo site_url("User/resetPassword")."?k=".$hashkey; ?>">Link menuju form reset password</a>
            </td>
            <td width="100">&nbsp;</td>
        </tr>
    </table>
</div>