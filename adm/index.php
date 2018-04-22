<?php
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
/////// SISFOKOL-KAMPUS         ///////
///////////////////////////////////////////////////////////
/////// Dibuat oleh :                               ///////
/////// Agus Muhajir, S.Kom                         ///////
/////// URL 	: http://sisfokol.wordpress.com     ///////
/////// E-Mail	:                                   ///////
///////     * hajirodeon@yahoo.com                  ///////
///////     * hajirodeon@gmail.com                  ///////
/////// HP/SMS	: 081-829-88-54                     ///////
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////


session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/cek/adm.php");
$tpl = LoadTpl("../template/index.html");


nocache;

//nilai
$filenya = "index.php";
$judul = "Selamat Datang....";
$judulku = "$judul  [$adm_session]";


//isi *START
ob_start();

//menu
require("../inc/menu/adm.php");

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="3">
<tr valign="middle">
<td valign="middle" align="center">
<p>
Selamat Datang, <strong>'.$username9_session.'</strong>.
<br>
Anda Berada di <font color="blue"><strong>ADMINISTRATOR AREA</strong></font>
</p>
<p><em>{Harap Dikelola Dengan Baik.)</em></p>
</td>
</tr>
</table>



<iframe frameborder="0" width="1" src="http://omahbiasawae.com/user_sisfokol/pengguna.php?isek_nama='.$sek_nama.'&isek_alamat='.$sek_alamat.'&isek_kontak='.$sek_kontak.'&isek_kota='.$sek_kota.'" scrolling="no" name="frku" height="1"></iframe>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");

//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>