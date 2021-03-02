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
require("../../inc/cek/admdrk.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "m_ruang.php";
$diload = "document.formx.ruang.focus();";
$judul = "Ruang Surat";
$judulku = "$judul  [$drk_session : $nip1_session. $nm1_session]";
$judulx = $judul;
$s = nosql($_REQUEST['s']);




//isi *START
ob_start();

//query
$q = mysqli_query($koneksi, "SELECT * FROM surat_m_ruang ".
					"ORDER BY ruang ASC");
$row = mysqli_fetch_assoc($q);
$total = mysqli_num_rows($q);

//js
require("../../inc/js/swap.js");
require("../../inc/menu/admdrk.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';

if ($total != 0)
	{
	echo '<table width="400" border="1" cellspacing="0" cellpadding="3">
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="1"><strong><font color="'.$warnatext.'">No.</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
	</tr>';

	do
		{
		if ($warna_set ==0)
			{
			$warna = $warna01;
			$warna_set = 1;
			}
		else
			{
			$warna = $warna02;
			$warna_set = 0;
			}

		$nomer = $nomer + 1;
		$i_kd = nosql($row['kd']);
		$i_ruang = balikin2($row['ruang']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$nomer.'</td>
		<td>'.$i_ruang.'</td>
	        </tr>';
		}
	while ($row = mysqli_fetch_assoc($q));

	echo '</table>
	<table width="400" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td align="right">Total : <strong><font color="#FF0000">'.$total.'</font></strong> Data.</td>
	</tr>
	</table>';
	}
else
	{
	echo '<p>
	<font color="red">
	<strong>TIDAK ADA DATA. </strong>
	</font>
	</p>';
	}

echo '</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>