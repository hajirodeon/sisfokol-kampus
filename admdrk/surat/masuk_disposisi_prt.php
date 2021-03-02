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

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
$tpl = LoadTpl("../../template/window.html");

nocache;

//nilai
$filenya = "masuk_disposisi_prt.php";
$judul = "Lembar Disposisi";
$judulku = $judul;
$judulx = $judul;
$sukd = nosql($_REQUEST['sukd']);


//print
$ke = "masuk_disposisi.php?sukd=$sukd";
$diload = "window.print();location.href='$ke';";



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//query
$qx = mysqli_query($koneksi, "SELECT surat_masuk.*, ".
							"DATE_FORMAT(tgl_surat, '%d') AS surat_tgl, ".
							"DATE_FORMAT(tgl_surat, '%m') AS surat_bln, ".
							"DATE_FORMAT(tgl_surat, '%Y') AS surat_thn, ".
							"DATE_FORMAT(tgl_terima, '%d') AS terima_tgl, ".
							"DATE_FORMAT(tgl_terima, '%m') AS terima_bln, ".
							"DATE_FORMAT(tgl_terima, '%Y') AS terima_thn ".
							"FROM surat_masuk ".
							"WHERE kd = '$sukd'");
$rowx = mysqli_fetch_assoc($qx);
$x_no_urut = nosql($rowx['no_urut']);
$x_no_surat = balikin2($rowx['no_surat']);
$x_asal = balikin2($rowx['asal']);
$x_tujuan = balikin2($rowx['tujuan']);
$x_kd_klasifikasi = nosql($rowx['kd_klasifikasi']);
$x_surat_tgl = nosql($rowx['surat_tgl']);
$x_surat_bln = nosql($rowx['surat_bln']);
$x_surat_thn = nosql($rowx['surat_thn']);
$x_perihal = balikin2($rowx['perihal']);
$x_terima_tgl = nosql($rowx['terima_tgl']);
$x_terima_bln = nosql($rowx['terima_bln']);
$x_terima_thn = nosql($rowx['terima_thn']);


//detail disposisi
$qx2 = mysqli_query($koneksi, "SELECT surat_masuk_disposisi.*, ".
							"DATE_FORMAT(tgl_selesai, '%d') AS selesai_tgl, ".
							"DATE_FORMAT(tgl_selesai, '%m') AS selesai_bln, ".
							"DATE_FORMAT(tgl_selesai, '%Y') AS selesai_thn, ".
							"DATE_FORMAT(tgl_kembali, '%d') AS kembali_tgl, ".
							"DATE_FORMAT(tgl_kembali, '%m') AS kembali_bln, ".
							"DATE_FORMAT(tgl_kembali, '%Y') AS kembali_thn ".
							"FROM surat_masuk_disposisi ".
							"WHERE kd_surat = '$sukd'");
$rowx2 = mysqli_fetch_assoc($qx2);
$x2_selesai_tgl = nosql($rowx2['selesai_tgl']);
$x2_selesai_bln = nosql($rowx2['selesai_bln']);
$x2_selesai_thn = nosql($rowx2['selesai_thn']);
$x2_kembali_tgl = nosql($rowx2['kembali_tgl']);
$x2_kembali_bln = nosql($rowx2['kembali_bln']);
$x2_kembali_thn = nosql($rowx2['kembali_thn']);
$x2_isi = balikin($rowx2['isi']);
$x2_diteruskan = balikin($rowx2['diteruskan']);
$x2_kepada = balikin($rowx2['kepada']);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table width="600" border="0" cellspacing="0" cellpadding="3">
<tr align="center">
<td>
<big><b>'.$sek_nama.'</b></big>
<br>
'.$sek_alamat.'
<br>
'.$sek_kontak.'
</td>
</tr>
</table>
<br>
<br>

<table width="600" border="0" cellspacing="0" cellpadding="3">
<tr align="center">
<td><u>';
xheadline($judul);
echo '</u></td>
</tr>
</table>

<table width="600" border="1" cellspacing="0" cellpadding="0">
<tr>
<td>

<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td>
<b>Index Berkas :</b> '.$x_no_urut.'
</td>
<td width="100">
</td>
<td>
<b>Kode :</b> ';
$qdtx = mysqli_query($koneksi, "SELECT * FROM surat_m_klasifikasi ".
								"WHERE kd = '$x_kd_klasifikasi'");
$rdtx = mysqli_fetch_assoc($qdtx);
$dtx_klasifikasi = balikin($rdtx['klasifikasi']);

echo ''.$dtx_klasifikasi.'
</td>
</tr>
</table>


</td>
</tr>
<tr>
<td>


<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="200">
<b>Tanggal Surat</b>
</td>
<td>:
'.$x_surat_tgl.' '.$arrbln1[$x_surat_bln].' '.$x_surat_thn.'
</td>
</tr>
<tr>
<td width="200">
<b>Nomor Surat</b>
</td>
<td>:
'.$x_no_surat.'
</td>
</tr>
<tr>
<td width="200">
<b>Asal</b>
</td>
<td>:
'.$x_asal.'
</td>
</tr>
<tr>
<td width="200">
<b>Perihal Isi Ringkas</b>
</td>
<td>:
'.$x_perihal.'
</td>
</tr>
<tr>
<td width="200">
<b>Tanggal Terima</b>
</td>
<td>:
'.$x_terima_tgl.' '.$arrbln1[$x_terima_bln].' '.$x_terima_thn.'
</td>
</tr>
</table>


</td>
</tr>
<tr>
<td>


<table width="100%" border="0" cellspacing="1" cellpadding="-">
<tr>
<td width="200">
<b>Tanggal Penyelesaian</b>
</td>
<td>:
'.$x2_selesai_tgl.' '.$arrbln1[$x2_selesai_bln].' '.$x2_selesai_thn.'
</td>
</tr>
</tr>
</table>


</td>
</tr>
<tr>
<td>


<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr valign="top">
<td width="50%" height="200">
<b>Isi Disposisi : </b>
<br>
'.$x2_isi.'
</td>
<td width="50%" height="200">
<b>Diteruskan kepada :</b>
<br>
'.$x2_diteruskan.'
</td>
</tr>
</table>


</td>
</tr>
<tr>
<td>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td align="center">
Sesudah digunakan, harap segera dikembalikan
</td>
</tr>
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td width="100">
<b>Kepada</b>
</td>
<td>:
'.$x2_kepada.'
</td>
</tr>
<tr>
<td width="100">
<b>Tanggal</b>
</td>
<td>:
'.$x2_kembali_tgl.' '.$arrbln1[$x2_kembali_bln].' '.$x2_kembali_thn.'
</td>
</tr>
</table>
</tr>
</table>


</td>
</tr>
</table>
<br>
<br>
<br>
</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>