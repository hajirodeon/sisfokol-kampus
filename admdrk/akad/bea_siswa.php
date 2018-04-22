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
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "bea_siswa.php";
$judul = "Data Penerima BeaSiswa";
$judulku = "[$drk_session : $nip1_session. $nm1_session] ==> $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$beakd = nosql($_REQUEST['beakd']);
$s = nosql($_REQUEST['s']);









//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/js/checkall.js");
require("../../inc/menu/admdrk.php");
xheadline($judul);



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaover.'">
<td width="600">
Program BeaSiswa : ';
echo "<select name=\"program\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qbtx2 = mysql_query("SELECT * FROM m_bea_siswa ".
			"WHERE kd = '$beakd'");
$rowbtx2 = mysql_fetch_assoc($qbtx2);
$btx2kd = nosql($rowbtx2['kd']);
$btx2nama = nosql($rowbtx2['nama']);

echo '<option value="'.$btx2kd.'">'.$btx2nama.'</option>';

$qbt = mysql_query("SELECT * FROM m_bea_siswa ".
			"WHERE kd <> '$beakd' ".
			"ORDER BY nama ASC");
$rowbt = mysql_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btnama = nosql($rowbt['nama']);

	echo '<option value="'.$filenya.'?beakd='.$btkd.'">'.$btnama.'</option>';
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

	echo '<option value="'.$filenya.'?beakd='.$beakd.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>
</td>
</tr>
</table>';




//jika view /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (empty($beakd))
	{
	echo '<p>
	<font color="red">
	<strong>PROGRAM BEASISWA Belum Dipilih...!!</strong>
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

else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	$sqlcount = "SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
			"FROM m_mahasiswa, mahasiswa_kelas, mahasiswa_beasiswa, m_bea_siswa ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND mahasiswa_beasiswa.kd_beasiswa = m_bea_siswa.kd ".
			"AND mahasiswa_beasiswa.kd_mhs = m_mahasiswa.kd ".
			"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
			"AND m_bea_siswa.kd = '$beakd' ".
			"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;

	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?tapelkd=$tapelkd&beakd=$beakd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);


	if ($count != 0)
		{
		//view data
		echo '<br>
		<table width="500" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="10"><strong><font color="'.$warnatext.'">No.</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">NIM</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">Prodi</font></strong></td>
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

			//nilai
			$i_nomer = $i_nomer + 1;
			$i_nim = balikin2($data['nim']);


			//detail
			$qdtx = mysql_query("SELECT * FROM m_mahasiswa ".
						"WHERE nim = '$i_nim'");
			$rdtx = mysql_fetch_assoc($qdtx);
			$i_kd = nosql($rdtx['kd']);
			$i_nama = balikin($rdtx['nama']);



			//ketahui prodi-nya
			$qku = mysql_query("SELECT mahasiswa_kelas.*, m_progdi.* ".
						"FROM mahasiswa_kelas, m_progdi ".
						"WHERE mahasiswa_kelas.kd_progdi = m_progdi.kd ".
						"AND mahasiswa_kelas.kd_mahasiswa = '$i_kd' ".
						"AND mahasiswa_kelas.kd_tapel = '$tapelkd'");
			$rku = mysql_fetch_assoc($qku);
			$ku_prodi = balikin($rku['nama']);



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$i_nomer.'</td>
			<td>'.$i_nim.'</td>
			<td>'.$i_nama.'</td>
			<td>'.$ku_prodi.'</td>
			</tr>';
			}
		while ($data = mysql_fetch_assoc($result));

		echo '</table>
		<table width="500" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
		</tr>
		</table>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>TIDAK ADA DATA.</strong>
		</font>
		</p>';
		}
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