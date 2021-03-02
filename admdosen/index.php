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
require("../inc/cek/admdosen.php");
$tpl = LoadTpl("../template/index.html");

nocache;

//nilai
$tapelkd = nosql($_REQUEST['tapelkd']);
$smtkd = nosql($_REQUEST['smtkd']);


$filenya = "index.php";
$judul = "Selamat Datang....";
$judulku = "$judul  [$dosen_session : $nip5_session. $nm5_session]";


//isi *START
ob_start();

//menu
require("../inc/js/jumpmenu.js");
require("../inc/menu/admdosen.php");

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td valign="top">

<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Tahun Akademik : ';

echo "<select name=\"tapel\" onChange=\"MM_jumpMenu('self',this,0)\">";
//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
						"WHERE kd = '$tapelkd'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<option value="'.$tpx_kd.'">'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
						"WHERE kd <> '$tapelkd' ".
						"ORDER BY tahun1 ASC");
$rowtp = mysqli_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysqli_fetch_assoc($qtp));

echo '</select>, 



Semester : ';
echo "<select name=\"smt\" onChange=\"MM_jumpMenu('self',this,0)\">";

//smt
$qstxy = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysqli_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);

echo '<option value="'.$smtkd.'" selected>'.$smt.'</option>';

$qst = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd <> '$smtkd'");
$rowst = mysqli_fetch_assoc($qst);

do
	{
	$stkd = nosql($rowst['kd']);
	$stsmt = nosql($rowst['smt']);

	echo '<option value="'.$filenya.'?tapelkd='.$tapelkd.'&smtkd='.$stkd.'">'.$stsmt.'</option>';
	}
while ($rowst = mysqli_fetch_assoc($qst));

echo '</select>


</td>
</tr>
</table>';


//nek blm dipilih
if (empty($tapelkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>TAHUN AKADEMIK Belum Dipilih...!</strong></font>
	</p>';
	}

else if (empty($smtkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>SEMESTER Belum Dipilih...!</strong></font>
	</p>';
	}
else
	{
/*
	//data ne
	$qdty = mysqli_query($koneksi, "SELECT m_pegawai.*, dosen.*, dosen.kd AS dokd, ".
							"m_makul.*, m_makul.nama AS mnam, m_makul_smt.*, ".
							"m_smt.*, m_smt.kd AS mskd, m_ruang.*, ".
							"m_ruang.kd AS rukd ".
							"FROM m_pegawai, dosen, m_makul, m_makul_smt, ".
							"m_smt, m_ruang ".
							"WHERE dosen.kd_makul = m_makul.kd ".
							"AND m_makul_smt.kd_makul = m_makul.kd ".
							"AND m_makul_smt.kd_smt = m_smt.kd ".
							"AND dosen.kd_pegawai = m_pegawai.kd ".
							"AND m_makul_smt.kd_tapel = '$tapelkd' ".
							"AND m_makul_smt.kd_smt = '$smtkd' ".
							"AND m_pegawai.kd = '$kd5_session' ".
							"ORDER BY m_smt.no ASC, m_ruang.ruang ASC");
	$rdty = mysqli_fetch_assoc($qdty);
	$tdty = mysqli_num_rows($qdty);
*/

	//data ne
	$qdty = mysqli_query($koneksi, "SELECT m_pegawai.*, dosen.*, dosen.kd AS dokd, dosen.kd_ruang AS rukd, ".
							"m_makul.*, m_makul.nama AS mnam, m_makul_smt.*, ".
							"m_smt.*, m_smt.kd AS mskd ".
							"FROM m_pegawai, dosen, m_makul, m_makul_smt, m_smt ".
							"WHERE dosen.kd_makul = m_makul.kd ".
							"AND m_makul_smt.kd_makul = m_makul.kd ".
							"AND m_makul_smt.kd_smt = m_smt.kd ".
							"AND dosen.kd_pegawai = m_pegawai.kd ".
							"AND m_makul_smt.kd_tapel = '$tapelkd' ".
							"AND m_makul_smt.kd_smt = '$smtkd' ".
							"AND dosen.kd_tapel = '$tapelkd' ".
							"AND dosen.kd_smt = '$smtkd' ".
							"AND m_pegawai.kd = '$kd5_session' ".
							"ORDER BY m_smt.no ASC");
	$rdty = mysqli_fetch_assoc($qdty);
	$tdty = mysqli_num_rows($qdty);
	
		
	echo '<table width="700" border="1" cellspacing="0" cellpadding="3">
	<tr bgcolor="'.$warnaheader.'">
	<td width="50"><strong>Semester</strong></td>
	<td width="10"><strong>Jenis</strong></td>
	<td width="100"><strong>Program Studi</strong></td>
	<td><strong>Mata Kuliah</strong></td>
	<td width="50"><strong>Kelas</strong></td>
	<td width="10"><strong>Nilai</strong></td>
	</tr>';
	
	//nek gak null
	if ($tdty != 0)
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
	
	
			//nilai
			$dty_dokd = nosql($rdty['dokd']);
			$dty_kelkd = nosql($rdty['kd_kelas']);
			$dty_tapelkd = nosql($rdty['kd_tapel']);
			$dty_progdi = nosql($rdty['kd_progdi']);
			$dty_rukd = nosql($rdty['rukd']);
			$dty_mkkd = nosql($rdty['kd_makul']);
			$dty_smtkd = nosql($rdty['mskd']);
			$dty_smt = balikin($rdty['smt']);
			$dty_makul = balikin($rdty['mnam']);
			$dty_ruang = balikin($rdty['ruang']);
			$dty_rukd = nosql($rdty['rukd']);
	

	
	
			//kelas
			$qykel = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
						"WHERE kd = '$dty_kelkd'");
			$rykel = mysqli_fetch_assoc($qykel);
			$ykel_kelas = balikin($rykel['kelas']);
	
			//progdi
			$qyprog = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
							"WHERE kd = '$dty_progdi'");
			$ryprog = mysqli_fetch_assoc($qyprog);
			$yprog_nama = balikin($ryprog['nama']);
	
	
			//ruang
			$qykell = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
									"WHERE kd = '$dty_rukd'");
			$rykell = mysqli_fetch_assoc($qykell);
			$ykel_ruang = balikin($rykell['ruang']);
	
	
	
	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$dty_smt.'</td>
			<td>'.$ykel_kelas.'</td>
			<td>'.$yprog_nama.'</td>
			<td>'.$dty_makul.'</td>
			<td>'.$ykel_ruang.'</td>
			<td>
			<a href="ajar/nilai.php?tapelkd='.$dty_tapelkd.'&smtkd='.$dty_smtkd.'&kelkd='.$dty_kelkd.'&progdi='.$dty_progdi.'&mkkd='.$dty_mkkd.'&rukd='.$dty_rukd.'">
			<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			</tr>';
			}
		while ($rdty = mysqli_fetch_assoc($qdty));
		}
	
	echo '</table>';
	}	
	
echo '</td>

<td valign="middle" align="center">
<p>
Selamat Datang, <strong>'.$nm5_session.'</strong>.
</p>
<p>
Anda Berada di <font color="blue"><strong>DOSEN AREA</strong></font>
</p>
<p><em>{Harap Dikelola Dengan Baik.)</em></p>
<p>&nbsp;</p>
</td>

</tr>
</table>';
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