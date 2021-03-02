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
require("../../inc/cek/admbaak.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "mhs_tugas_akhir.php";
$judul = "Data Tugas Akhir Mahasiswa";
$judulku = "[$baak_session : $nip2_session.$nm2_session]. $judul";
$judulx = $judul;
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$rukd = nosql($_REQUEST['rukd']);
$kd = nosql($_REQUEST['kd']);
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
else if (empty($rukd))
	{
	$diload = "document.formx.ruang.focus();";
	}





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$rukd = nosql($_POST['rukd']);
	$jml = nosql($_POST['jml']);
	$page = nosql($_POST['page']);


	//looping
	for ($j=1;$j<=$jml;$j++)
		{
		$jyuk2 = "mskd";
		$jyuhu2 = "$jyuk2$j";
		$jkd2 = nosql($_POST["$jyuhu2"]);

		$jta = "ta";
		$jta = "$jta$j";
		$jtax = nosql($_POST["$jta"]);

		$jutgl = "uji_tgl";
		$jutgl2 = "$jutgl$j";
		$jutglx = nosql($_POST["$jutgl2"]);

		$jubln = "uji_bln";
		$jubln2 = "$jubln$j";
		$jublnx = nosql($_POST["$jubln2"]);

		$juthn = "uji_thn";
		$juthn2 = "$juthn$j";
		$juthnx = nosql($_POST["$juthn2"]);

		$tgl_ujian = "$juthnx:$jublnx:$jutglx";

		$jnil = "nil";
		$jnil2 = "$jnil$j";
		$jnilx = nosql($_POST["$jnil2"]);


		//update
		mysqli_query($koneksi, "UPDATE m_mahasiswa SET judul_ta = '$jtax', ".
				"tgl_ujian = '$tgl_ujian', ".
				"nilai_ujian = '$jnilx' ".
				"WHERE kd = '$jkd2'");
		}



	//re-direct
	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&rukd=$rukd&page=$page";
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admbaak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Program Studi : ';
echo "<select name=\"progdi\" onChange=\"MM_jumpMenu('self',this,0)\">";
//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);

echo '<option value="'.$tpx_kd.'" selected>'.$tpx_nama.'</option>';

$qtp = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd <> '$progdi' ".
			"ORDER BY nama ASC");
$rowtp = mysqli_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpnama = balikin($rowtp['nama']);

	echo '<option value="'.$filenya.'?progdi='.$tpkd.'">'.$tpnama.'</option>';
	}
while ($rowtp = mysqli_fetch_assoc($qtp));

echo '</select>,

Jenis : ';
echo "<select name=\"kelas\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qbtx = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd = '$kelkd'");
$rowbtx = mysqli_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<option value="'.$btxkd.'">'.$btxkelas.'</option>';

$qbt = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd <> '$kelkd' ".
			"ORDER BY no ASC");
$rowbt = mysqli_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btkelas = nosql($rowbt['kelas']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysqli_fetch_assoc($qbt));

echo '</select>,

Kelas : ';
echo "<select name=\"ruang\" onChange=\"MM_jumpMenu('self',this,0)\">";

//ruang
$qstx = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
				"WHERE kd = '$rukd'");
$rowstx = mysqli_fetch_assoc($qstx);
$ruang = nosql($rowstx['ruang']);

echo '<option value="'.$rukd.'" selected>'.$ruang.'</option>';

$qst = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
			"WHERE kd <> '$rukd'");
$rowst = mysqli_fetch_assoc($qst);

do
	{
	$stkd = nosql($rowst['kd']);
	$struang = balikin($rowst['ruang']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$stkd.'">'.$struang.'</option>';
	}
while ($rowst = mysqli_fetch_assoc($qst));

echo '</select>
</td>
</tr>
</table>
<br>';


//nek blm dipilih
if (empty($progdi))
	{
	echo '<font color="#FF0000"><strong>PROGRAM STUDI Belum Dipilih...!</strong></font>';
	}
else if (empty($kelkd))
	{
	echo '<font color="#FF0000"><strong>JENIS Belum Dipilih...!</strong></font>';
	}

else if (empty($rukd))
	{
	echo '<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>';
	}
else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
			"FROM m_mahasiswa, mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
			"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
			"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
			"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;


	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?progdi=$progdi&kelkd=$kelkd&rukd=$rukd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);


	echo '<table width="950" border="1" cellpadding="3" cellspacing="0">
	<tr bgcolor="'.$warnaheader.'">
	<td width="50"><strong>NIM</strong></td>
	<td><strong>Nama</strong></td>
	<td width="200"><strong>Judul TA</strong></td>
	<td width="250"><strong>Tgl.Ujian</strong></td>
	<td width="50"><strong>Nilai Ujian</strong></td>
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
			$i_nim = nosql($data['nim']);


			//detail
			$qdt = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
						"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd, ".
						"DATE_FORMAT(m_mahasiswa.tgl_ujian, '%d') AS xtgl, ".
						"DATE_FORMAT(m_mahasiswa.tgl_ujian, '%m') AS xbln, ".
						"DATE_FORMAT(m_mahasiswa.tgl_ujian, '%Y') AS xthn ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
						"AND m_mahasiswa.nim = '$i_nim'");
			$rdt = mysqli_fetch_assoc($qdt);
			$dt_kd = nosql($rdt['mskd']);
			$dt_mkkd = nosql($rdt['mkkd']);
			$dt_nama = balikin($rdt['nama']);
			$dt_jta = balikin($rdt['judul_ta']);
			$dt_nilai = nosql($rdt['nilai_ujian']);
			$dt_xtgl = nosql($rdt['xtgl']);
			$dt_xbln = nosql($rdt['xbln']);
			$dt_xthn = nosql($rdt['xthn']);
			$i_kd = $dt_kd;
			$i_mkkd = $dt_mkkd;
			$i_nama = $dt_nama;


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td valign="top">'.$i_nim.'</td>
			<td valign="top">'.$i_nama.'</td>
			<td valign="top">
			<INPUT type="hidden" name="mskd'.$nomer.'" value="'.$dt_kd.'">
			<INPUT type="text" name="ta'.$nomer.'" value="'.$dt_jta.'" size="30">
			</td>
			<td valign="top">
			<select name="uji_tgl'.$nomer.'">
			<option value="'.$dt_xtgl.'" selected>'.$dt_xtgl.'</option>';
			for ($i=1;$i<=31;$i++)
				{
				echo '<option value="'.$i.'">'.$i.'</option>';
				}

			echo '</select>
			<select name="uji_bln'.$nomer.'">
			<option value="'.$dt_xbln.'" selected>'.$arrbln1[$dt_xbln].'</option>';
			for ($j=1;$j<=12;$j++)
				{
				echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
				}

			echo '</select>
			<select name="uji_thn'.$nomer.'">
			<option value="'.$dt_xthn.'" selected>'.$dt_xthn.'</option>';

			//daftar tapel
			$qtp = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
						"ORDER BY tahun1 ASC");
			$rowtp = mysqli_fetch_assoc($qtp);

			do
				{
				$tpkd = nosql($rowtp['kd']);
				$tpth1 = nosql($rowtp['tahun1']);

				echo '<option value="'.$tpth1.'">'.$tpth1.'</option>';
				}
			while ($rowtp = mysqli_fetch_assoc($qtp));

			echo '</select>
			</td>
			<td valign="top">
			<INPUT type="text" name="nil'.$nomer.'" value="'.$dt_nilai.'" size="5">
			</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
		}

	echo '</table>

	<table width="950" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<INPUT type="hidden" name="progdi" value="'.$progdi.'">
	<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
	<INPUT type="hidden" name="rukd" value="'.$rukd.'">
	<INPUT type="hidden" name="jml" value="'.$count.'">
	<INPUT type="hidden" name="page" value="'.$page.'">
	<INPUT type="submit" name="btnSMP" value="SIMPAN">
	</td>
	<td align="right">Total : <font color="#FF0000"><strong>'.$count.'</strong></font> Data. '.$pagelist.'</td>
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