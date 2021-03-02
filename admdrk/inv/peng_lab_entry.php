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
$filenya = "peng_lab_entry.php";
$judul = "Entry Penggunaan Lab.";
$judulku = "$judul  [$drk_session : $nip1_session. $nm1_session]";
$judulx = $judul;


//focus
$diload = "document.formx.lab.focus();";









//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "peng_lab.php";
	xloc($ke);
	exit();
	}





//nek simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$lab = nosql($_POST['lab']);
	$jam = nosql($_POST['jam']);
	$progdi = nosql($_POST['progdi']);
	$ruang = nosql($_POST['ruang']);


	//tgl. penggunaan
	$p_tgl = nosql($_POST['p_tgl']);
	$p_bln = nosql($_POST['p_bln']);
	$p_thn = nosql($_POST['p_thn']);
	$tgl_p = "$p_thn:$p_bln:$p_tgl";


	//nek null
	if ((empty($lab)) OR (empty($p_tgl)) OR (empty($p_bln)) OR (empty($p_thn)) OR (empty($jam))
	OR (empty($progdi)) OR (empty($ruang)))
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM inv_peng_lab ".
								"WHERE kd_lab = '$lab' ".
								"AND tgl = '$tgl_p' ".
								"AND kd_jam = '$jam' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_ruang = '$ruang'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);

		//nek ada
		if ($tcc != 0)
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "LAB. Telah Digunakan. Harap Diganti Yang Lain...!!";
			pekem($pesan,$filenya);
			exit();
			}
		else
			{
			//insert baru
			mysqli_query($koneksi, "INSERT INTO inv_peng_lab(kd, kd_lab, tgl, jam, kd_progdi, kd_ruang) VALUES ".
							"('$x', '$lab', '$tgl_p', '$jam', '$progdi', '$ruang')");

			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$ke = "peng_lab.php";
			xloc($ke);
			exit();
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/number.js");
require("../../inc/menu/admdrk.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';
xheadline($judul);
echo ' [<a href="peng_lab.php" title="Daftar Penggunaan Lab.">Daftar Penggunaan</a>]';

//nilai - nilai tgl
$qnilp = mysqli_query($koneksi, "SELECT DATE_FORMAT(inv_peng_lab.tgl, '%d') AS p_tgl, ".
						"DATE_FORMAT(inv_peng_lab.tgl, '%m') AS p_bln, ".
						"DATE_FORMAT(inv_peng_lab.tgl, '%Y') AS p_thn, ".
						"inv_peng_lab.* ".
						"FROM inv_peng_lab ".
						"WHERE inv_peng_lab.kd = '$pjkd'");
$rnilp = mysqli_fetch_assoc($qnilp);
$nilp_ptgl = nosql($rnilp['p_tgl']);
$nilp_pbln = nosql($rnilp['p_bln']);
$nilp_pthn = nosql($rnilp['p_thn']);
$nilp_jam = balikin($rnilp['jam']);




//penggunaan lab
echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Lab. :
<br>
<select name="lab">
<option value="" selected></option>';

//lab
$qlab = mysqli_query($koneksi, "SELECT * FROM inv_lab ".
						"ORDER BY lab ASC");
$rlab = mysqli_fetch_assoc($qlab);

do
	{
	$lab_kd = nosql($rlab['kd']);
	$lab_nm = balikin($rlab['lab']);

	echo '<option value="'.$lab_kd.'">'.$lab_nm.'</option>';
	}
while ($rlab = mysqli_fetch_assoc($qlab));

echo '</select>
<br>
<br>
Tgl. Penggunaan :
<br>
<select name="p_tgl">
<option value="'.$nilp_ptgl.'" selected>'.$nilp_ptgl.'</option>';
for ($i=1;$i<=31;$i++)
	{
	echo '<option value="'.$i.'">'.$i.'</option>';
	}

echo '</select>
<select name="p_bln">
<option value="'.$nilp_pbln.'" selected>'.$arrbln1[$nilp_pbln].'</option>';
for ($j=1;$j<=12;$j++)
	{
	echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
	}

echo '</select>
<select name="p_thn">
<option value="'.$nilp_pthn.'" selected>'.$nilp_pthn.'</option>';
for ($k=$pinjam01;$k<=$pinjam02;$k++)
	{
	echo '<option value="'.$k.'">'.$k.'</option>';
	}
echo '</select>,

<br>
<br>
Jam :
<br>
<input name="jam" type="text" value="'.$nilp_jam.'" size="5">,
<br>
<br>
Program Studi :
<br>
<select name="progdi">
<option value="" selected></option>';

//progdi
$qkel = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
						"ORDER BY nama ASC");
$rkel = mysqli_fetch_assoc($qkel);

do
	{
	$kel_kd = nosql($rkel['kd']);
	$kel_nm = balikin($rkel['nama']);

	echo '<option value="'.$kel_kd.'">'.$kel_nm.'</option>';
	}
while ($rkel = mysqli_fetch_assoc($qkel));

echo '</select>



<br>
<br>
Kelas :
<br>
<select name="ruang">
<option value="" selected></option>';

//ruang
$qru = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
						"ORDER BY ruang ASC");
$rru = mysqli_fetch_assoc($qru);

do
	{
	$ru_kd = nosql($rru['kd']);
	$ru_nm = balikin($rru['ruang']);

	echo '<option value="'.$ru_kd.'">'.$ru_nm.'</option>';
	}
while ($rru = mysqli_fetch_assoc($qru));

echo '</select>
<br>
<br>
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnBTL" type="submit" value="BATAL">
</td>
</tr>
</table>
</form>
<br>
<br>
<br>';
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