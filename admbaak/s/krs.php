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
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admbaak.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "krs.php";
$judul = "Set Waktu Pengisian KRS";
$judulku = "[$baak_session : $nip2_session. $nm2_session] ==> $judul";
$juduli = $judul;
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$rukd = nosql($_REQUEST['rukd']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$rukd = nosql($_POST['rukd']);
	$jenis = nosql($_POST['jenis']);
	$status = nosql($_POST['status']);


	//gak boleh null
	if ((empty($jenis)) OR (empty($status)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!";
		$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//cek
		$qcc = mysql_query("SELECT * FROM set_krs ".
					"WHERE kd_progdi = '$progdi' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_kelas = '$kelkd' ".
					"AND kd_ruang = '$rukd'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//nek sudah ada, update
		if ($tcc != 0)
			{
			mysql_query("UPDATE set_krs SET kd_smt_jns = '$jenis', ".
					"status = '$status', ".
					"postdate = '$today' ".
					"WHERE kd_progdi = '$progdi' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_kelas = '$kelkd' ".
					"AND kd_ruang = '$rukd'");
			}
		else
			{
			mysql_query("INSERT INTO set_krs(kd, kd_progdi, kd_tapel, kd_kelas, ".
					"kd_ruang, kd_smt_jns, status, postdate) VALUES ".
					"('$x', '$progdi', '$tapelkd', '$kelkd', ".
					"'$rukd', '$jenis', '$status', '$today')");
			}

		//re-direct
		$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd";
		xloc($ke);
		exit();
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/menu/admbaak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Program Studi : ';
echo "<select name=\"progdi\" onChange=\"MM_jumpMenu('self',this,0)\">";
//terpilih
$qtpx = mysql_query("SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);

echo '<option value="'.$tpx_kd.'" selected>'.$tpx_nama.'</option>';

$qtp = mysql_query("SELECT * FROM m_progdi ".
			"WHERE kd <> '$progdi' ".
			"ORDER BY nama ASC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpnama = balikin($rowtp['nama']);

	echo '<option value="'.$filenya.'?progdi='.$tpkd.'">'.$tpnama.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>,

Jenis : ';
echo "<select name=\"kelas\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qbtx = mysql_query("SELECT * FROM m_kelas ".
			"WHERE kd = '$kelkd'");
$rowbtx = mysql_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<option value="'.$btxkd.'">'.$btxkelas.'</option>';

$qbt = mysql_query("SELECT * FROM m_kelas ".
			"WHERE kd <> '$kelkd' ".
			"ORDER BY no ASC");
$rowbt = mysql_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btkelas = nosql($rowbt['kelas']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysql_fetch_assoc($qbt));

echo '</select>,


Tahun Akademik : ';
echo "<select name=\"tapel\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtpx = mysql_query("SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<option value="'.$tpx_kd.'">'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysql_query("SELECT * FROM m_tapel ".
			"WHERE kd <> '$tapelkd' ".
			"ORDER BY tahun1 ASC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>,



Kelas : ';
echo "<select name=\"ruang\" onChange=\"MM_jumpMenu('self',this,0)\">";

//ruang
$qstx = mysql_query("SELECT * FROM m_ruang ".
				"WHERE kd = '$rukd'");
$rowstx = mysql_fetch_assoc($qstx);
$ruang = nosql($rowstx['ruang']);

echo '<option value="'.$rukd.'" selected>'.$ruang.'</option>';

$qst = mysql_query("SELECT * FROM m_ruang ".
			"WHERE kd <> '$rukd'");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$stkd = nosql($rowst['kd']);
	$struang = balikin($rowst['ruang']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$stkd.'">'.$struang.'</option>';
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>
</td>
</tr>
</table>';




//jika null
if (empty($progdi))
	{
	echo '<p>
	<font color="red">
	<strong>PROGRAM STUDI Belum Dipilih...!!</strong>
	</font>
	</p>';
	}
else if (empty($kelkd))
	{
	echo '<p>
	<font color="red">
	<strong>JENIS Belum Dipilih...!!</strong>
	</font>
	</p>';
	}
else if (empty($tapelkd))
	{
	echo '<p>
	<font color="red">
	<strong>TAHUN AKADEMIK Belum Dipilih...!!</strong>
	</font>
	</p>';
	}
else if (empty($rukd))
	{
	echo '<p>
	<font color="red">
	<strong>KELAS Belum Dipilih...!!</strong>
	</font>
	</p>';
	}
else
	{
	//status
	$qtsu = mysql_query("SELECT * FROM set_krs ".
				"WHERE kd_progdi = '$progdi' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_ruang = '$rukd'");
	$rtsu = mysql_fetch_assoc($qtsu);
	$tsu_jnskd = nosql($rtsu['kd_smt_jns']);
	$tsu_status = nosql($rtsu['status']);
	$tsu_postdate = $rtsu['postdate'];

	//true false
	if ($tsu_status == "true")
		{
		$tsu_status2 = "AKTIF";
		}
	else
		{
		$tsu_status2 = "TIDAK Aktif";
		}

	//null postdate
	if (empty($tsu_postdate))
		{
		$tsu_postdate = "-";
		}





	//jenis semester
	if ($tsu_jnskd == "1")
		{
		$tsu_jenis = "Ganjil";
		}
	else if ($tsu_jnskd == "2")
		{
		$tsu_jenis = "Genap";
		}


	echo '<p>
	Jenis Semester :
	<br>
	<select name="jenis">
	<option value="'.$tsu_jnskd.'" selected>-'.$tsu_jenis.'-</option>
	<option value="1">Ganjil</option>
	<option value="2">Genap</option>
	</select>
	</p>

	<p>
	Status :
	<br>
	<select name="status">
	<option value="'.$tsu_status.'" selected>-'.$tsu_status2.'-</option>
	<option value="true">Aktif</option>
	<option value="false">Tidak Aktif</option>
	</select>
	</p>

	<p>Terhitung Sejak : <br>
	<strong>'.$tsu_postdate.'</strong>
	</p>

	<p>
	<em>NB. Jika Status Telah Aktif, Maka Pengisian KRS oleh Mahasiswa bisa dilakukan.</em>
	</p>
	<p>
	<INPUT type="hidden" name="progdi" value="'.$progdi.'">
	<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
	<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
	<INPUT type="hidden" name="rukd" value="'.$rukd.'">
	<input name="btnSMP" type="submit" value="SIMPAN >>">
	</p>';
	}


echo '<br>
<br>
<br>
</form>';
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