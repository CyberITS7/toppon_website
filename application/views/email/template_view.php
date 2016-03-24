<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $title;?></title>
    <style type="text/css">

        @media screen and (max-width: 600px) {
            table[class="container"] {
                width: 95% !important;
            }
        }

        #outlook a {padding:0;}
        body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
        .ExternalClass {width:100%;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
        #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
        img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
        a img {border:none;}
        .image_fix {display:block;}
        p {margin: 1em 0;}
        h1, h2, h3, h4, h5, h6 {color: black !important;}

        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}

        h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
            color: red !important;
        }

        h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
            color: purple !important;
        }

        table td {border-collapse: collapse;}

        table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }

        a {color: #000;}

        @media only screen and (max-device-width: 480px) {

            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: black; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }

            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: orange !important; /* or whatever your want */
                pointer-events: auto;
                cursor: default;
            }
        }


        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: blue; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }

            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: orange !important;
                pointer-events: auto;
                cursor: default;
            }
        }

        @media only screen and (-webkit-min-device-pixel-ratio: 2) {
            /* Put your iPhone 4g styles in here */
        }

        @media only screen and (-webkit-device-pixel-ratio:.75){
            /* Put CSS for low density (ldpi) Android layouts in here */
        }
        @media only screen and (-webkit-device-pixel-ratio:1){
            /* Put CSS for medium density (mdpi) Android layouts in here */
        }
        @media only screen and (-webkit-device-pixel-ratio:1.5){
            /* Put CSS for high density (hdpi) Android layouts in here */
        }
        /* end Android targeting */
        h2{
            color:#181818;
            font-family:Helvetica, Arial, sans-serif;
            font-size:22px;
            line-height: 22px;
            font-weight: normal;
        }
        a.link1{

        }
        a.link2{
            color:#fff;
            text-decoration:none;
            font-family:Helvetica, Arial, sans-serif;
            font-size:16px;
            color:#fff;border-radius:4px;
        }
        p,.content-container{
            color:#555;
            font-family:Helvetica, Arial, sans-serif;
            font-size:16px;
            line-height:160%;
        }
        .content-container{
            font-size:14px;
        }
    </style>

    <script type="colorScheme" class="swatch active">
  {
    "name":"Default",
    "bgBody":"ffffff",
    "link":"fff",
    "color":"555555",
    "bgItem":"ffffff",
    "title":"181818"
  }
</script>

</head>
<body>
<!-- Wrapper/Container Table: Use a wrapper table to control the width and the background color consistently of your email. Use this approach instead of setting attributes on the body tag. -->
<table cellpadding="0" width="100%" cellspacing="0" border="0" id="backgroundTable" class='bgBody'>
    <tr>
        <td>
            <table cellpadding="0" width="620" class="container" align="center" cellspacing="0" border="0">
                <tr>
                    <td>
                        <!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->


                        <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
                            <tr>
                                <td class='movableContentContainer bgItem'>

                                    <div class='movableContent'>
                                        <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
                                            <tr height="40">
                                                <td width="200">&nbsp;</td>
                                                <td width="200">&nbsp;</td>
                                                <td width="200">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="200" valign="top">&nbsp;</td>
                                                <td width="200" valign="top" align="center">
                                                    <div class="contentEditableContainer contentImageEditable">
                                                        <div class="contentEditable" align='center' >
                                                            <img src="<?php echo base_url()?>img/toppon.png" width="330" height="120"  alt='Logo'  data-default="placeholder" />
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width="200" valign="top">&nbsp;</td>
                                            </tr>

                                        </table>

                                        <hr style="height:1px;border:none;color:#333;background-color:#1D6FB7;" />

                                    </div>

                                    <!--CONTENT EMAIL-->
                                    <?php $this->load->view($content);?>

                                    <div class='movableContent'>
                                        <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
                                            <tr>
                                                <td width="100%" colspan="2" style="padding-top:20px;">
                                                    <hr style="height:1px;border:none;color:#333;background-color:#1D6FB7;" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="60%" height="70" valign="middle" style="padding-bottom:20px;">
                                                    <div class="contentEditableContainer contentTextEditable">
                                                        <div class="contentEditable" align='left' >
                                                            <span style="font-size:13px;color:#181818;font-family:Helvetica, Arial, sans-serif;line-height:200%;">TOPPON CUSTOMER SERVICE</span>
                                                            <br/>
                                                            <span style="font-size:11px;color:#555;font-family:Helvetica, Arial, sans-serif;line-height:200%;">Telp | +62 812 9025 5465</span>
                                                            <br/>
                                                            <span style="font-size:11px;color:#555;font-family:Helvetica, Arial, sans-serif;line-height:200%;">Alamat | Jl. Kebon Jeruk Raya No. 27 DKI Jakarta - 11530</span>
                                                            <br/>
                                                            <span style="font-size:11px;color:#555;font-family:Helvetica, Arial, sans-serif;line-height:200%;">Email | cs@toppon.co.id</span>
                                                            <br/>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width="40%" height="70" align="right" valign="top" align='right' style="padding-bottom:20px;">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align='right'>
                                                        <tr>
                                                            <td width='57%'></td>
                                                            <td valign="top" width='34'>
                                                                <div class="contentEditableContainer contentFacebookEditable" style='display:inline;'>
                                                                    <div class="contentEditable" >
                                                                        <a target='_blank' href="#" data-default="placeholder"  style="text-decoration:none;">
                                                                            <img src="<?php echo base_url()?>img/sosmed/fb.png" data-default="placeholder" data-max-width='40' data-customIcon="true" width='40' height='40' alt='facebook' style='margin-right:40x;'>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td valign="top" width='34'>
                                                                <div class="contentEditableContainer contentTwitterEditable" style='display:inline;'>
                                                                    <div class="contentEditable" >
                                                                        <a target='_blank' href="#" data-default="placeholder"  style="text-decoration:none;">
                                                                            <img src="<?php echo base_url()?>img/sosmed/twitter.png" data-default="placeholder" data-max-width='40' data-customIcon="true" width='40' height='40' alt='twitter' style='margin-right:40x;'>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td valign="top" width='34'>
                                                                <div class="contentEditableContainer contentImageEditable" style='display:inline;'>
                                                                    <div class="contentEditable" >
                                                                        <a target='_blank' href="#" data-default="placeholder"  style="text-decoration:none;">
                                                                            <img src="<?php echo base_url()?>img/sosmed/ig.png" width="40" height="40" data-max-width="40" alt='instagram' style='margin-right:40x;' />
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td></tr></table>

        </td>
    </tr>
</table>
<!-- End of wrapper table -->


</body>
</html>
