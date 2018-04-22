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

//fungsi2
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admkemhs.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "mhs_kehadiran.php";
$judul = "Kehadiran Mahasiswa";
$judulku = "[$kemhs_session : $nip4_session. $nm4_session] ==> $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$rukd = nosql($_REQUEST['rukd']);
$mkkd = nosql($_REQUEST['mkkd']);
$kd = nosql($_REQUEST['kd']);
$kulkd = nosql($_REQUEST['kulkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$ubln = nosql($_REQUEST['ubln']);
$uthn = nosql($_REQUEST['uthn']);
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd&page=$page";




//focus...
if (empty($progdi))
	{
	$diload = "document.formx.progdi.focus();";
	}
else if (empty($kelkd))
	{
	$diload = "document.formx.kelas.focus();";
	}
else if (empty($tapelkd))
	{
	$diload = "document.formx.tapel.focus();";
	}






//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admkemhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">
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
</table>



<table bgcolor="'.$warna02.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Bulan : ';
echo "<select name=\"ublnx\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$ubln.''.$uthn.'" selected>'.$arrbln[$ubln].' '.$uthn.'</option>';
for ($i=1;$i<=12;$i++)
	{
	//nilainya
	if ($i<=6) //bulan juli sampai desember
		{
		$ibln = $i + 6;

		echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'&mkkd='.$mkkd.'&pertemuan='.$pertemuan.'&utgl='.$utgl.'&ubln='.$ibln.'&uthn='.$tpx_thn1.'">'.$arrbln[$ibln].' '.$tpx_thn1.'</option>';
		}

	else if ($i>6) //bulan januari sampai juni
		{
		$ibln = $i - 6;

		echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'&mkkd='.$mkkd.'&pertemuan='.$pertemuan.'&utgl='.$utgl.'&ubln='.$ibln.'&uthn='.$tpx_thn2.'">'.$arrbln[$ibln].' '.$tpx_thn2.'</option>';
		}
	}

echo '</select>
</td>
</tr>
</table>';


//nek blm dipilih
if (empty($progdi))
	{
	echo '<p>
	<font color="#FF0000"><strong>PROGRAM STUDI Belum Dipilih...!</strong></font>
	</p>';
	}
else if (empty($kelkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>JENIS Belum Dipilih...!</strong></font>
	</p>';
	}

else if (empty($tapelkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>TAHUN AKADEMIK Belum Dipilih...!</strong></font>
	</p>';
	}

else if (empty($rukd))
	{
	echo '<p>
	<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>
	</p>';
	}

else if (empty($ubln))
	{
	echo '<p>
	<font color="#FF0000"><strong>BULAN Belum Dipilih...!</strong></font>
	</p>';
	}


else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT DISTINCT(m_mahasiswa.kd) AS mskd ".
					"FROM m_mahasiswa, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
					"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
					"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
					"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
					"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;


	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?progdi=$progdi&tapelkd=$tapelkd&kelkd=$kelkd&rukd=$rukd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);


	echo '<table width="500" border="1" cellpadding="3" cellspacing="0">
	<tr bgcolor="'.$warnaheader.'">
	<td width="50"><strong>NIM</strong></td>
	<td><strong>Nama</strong></td>';

	//daftar absensi
	$qabs = mysql_query("SELECT * FROM m_absen ".
				"ORDER BY absen ASC");
	$rabs = mysql_fetch_assoc($qabs);

	do
		{
		//nilai
		$abs_kd = nosql($rabs['kd']);
		$abs_absensi2 = nosql($rabs['absen']);

		echo '<td width="50"><strong>Jml. '.$abs_absensi2.'</strong></td>';
		}
	while ($rabs = mysql_fetch_assoc($qabs));

	echo '<td width="50"><strong>Jml.Hadir</strong></td>
	</tr>';

	//nek ada
	if ($count != 0)
		{
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

			$i_kd = nosql($data['mskd']);
			
			

			//detail
			$qku = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
									"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
									"FROM m_mahasiswa, mahasiswa_kelas ".
									"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
									"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
									"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
									"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
									"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
									"AND mahasiswa_kelas.kd_mahasiswa = '$i_kd' ".
									"ORDER BY round(m_mahasiswa.nim) ASC");
			$rku = mysql_fetch_assoc($qku);			
			$i_mkkd = nosql($rku['mkkd']);
			$i_nim = nosql($rku['nim']);
			$i_nama = balikin2($rku['nama']);



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td valign="top">'.$i_nim.'</td>
			<td valign="top">'.$i_nama.'</td>';

			//daftar absensi
			$qabs = mysql_query("SELECT * FROM m_absen ".
									"ORDER BY absen ASC");
			$rabs = mysql_fetch_assoc($qabs);

			do
				{
				//nilai
				$abs_kd = nosql($rabs['kd']);



				//total...
				$qsubx = mysql_query("SELECT * FROM mahasiswa_absen ".
										"WHERE kd_mahasiswa_kelas = '$i_mkkd' ".
										"AND kd_tapel = '$tapelkd' ".
										"AND round(DATE_FORMAT(tgl, '%m')) = '$ubln' ".
										"AND round(DATE_FORMAT(tgl, '%Y')) = '$uthn' ".
										"AND kd_absen = '$abs_kd'");
				$rsubx = mysql_fetch_assoc($qsubx);
				$tsubx = mysql_num_rows($qsubx);

				echo '<td width="50">'.$tsubx.'</td>';
				}
			while ($rabs = mysql_fetch_assoc($qabs));

			//total absen
			$qsubx2 = mysql_query("SELECT mahasiswa_absen.*, m_absen.* ".
									"FROM mahasiswa_absen, m_absen ".
									"WHERE mahasiswa_absen.kd_absen = m_absen.kd ".
									"AND mahasiswa_absen.kd_mahasiswa_kelas = '$i_mkkd' ".
									"AND round(DATE_FORMAT(mahasiswa_absen.tgl, '%m')) = '$ubln' ".
									"AND round(DATE_FORMAT(mahasiswa_absen.tgl, '%Y')) = '$uthn' ".
									"AND mahasiswa_absen.kd_tapel = '$tapelkd'");
			$rsubx2 = mysql_fetch_assoc($qsubx2);
			$tsubx2 = mysql_num_rows($qsubx2);



			echo '<td><strong>'.$tsubx2.' </strong>kali</td>
			</tr>';
			}
		while ($data = mysql_fetch_assoc($result));
		}

	echo '</table>

	<table width="500" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td width="200">
	<input name="page" type="hidden" value="'.$page.'">
	<input name="progdi" type="hidden" value="'.$progdi.'">
	<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
	<input name="kelkd" type="hidden" value="'.$kelkd.'">
	<input name="rukd" type="hidden" value="'.$rukd.'">
	<input name="smtkd" type="hidden" value="'.$smtkd.'">
	<input name="mkkd" type="hidden" value="'.$mkkd.'">
	<input name="ubln" type="hidden" value="'.$ubln.'">
	<input name="uthn" type="hidden" value="'.$uthn.'">
	</td>
	<td align="right">
	'.$pagelist.'
	</td>
	</tr>
	</table>';
	}

echo '</form>
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