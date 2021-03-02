<?php
session_start();

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/class/paging.php");
require("../../inc/cek/admkemhs.php");
$tpl = LoadTpl("../../template/index.html");


nocache;

//nilai
$filenya = "rekap_siswa.php";
$judul = "Data Rekap Mahasiswa";
$judulku = "[$kemhs_session : $nip4_session. $nm4_session] ==> $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$a = nosql($_REQUEST['a']);
$crkd = nosql($_REQUEST['crkd']);
$crtipe = balikin($_REQUEST['crtipe']);
$kunci = cegah($_REQUEST['kunci']);
$swkd = nosql($_REQUEST['swkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

$ke = "$filenya?tapelkd=$tapelkd&page=$page";







//focus...
if (empty($tapelkd))
	{
	$diload = "document.formx.tapel.focus();";
	}



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//reset
if ($_POST['btnRST'])
	{
	$tapelkd = nosql($_POST['tapelkd']);


	//re-direct
	$ke = "$filenya?tapelkd=$tapelkd";
	xloc($ke);
	exit();
	}










//cari
if ($_POST['btnCARI'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$crkd = nosql($_POST['crkd']);
	$crtipe = balikin2($_POST['crtipe']);
	$kunci = cegah($_POST['kunci']);


	//cek
	if ((empty($crkd)) OR (empty($kunci)))
		{
		//re-direct
		$pesan = "Input Pencarian Tidak Lengkap. Harap diperhatikan...!!";
		$ke = "$filenya?tapelkd=$tapelkd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//re-direct
		$ke = "$filenya?tapelkd=$tapelkd&crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		xloc($ke);
		exit();
		}
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admkemhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" enctype="multipart/form-data" action="'.$filenya.'">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="500">
Tahun Pelajaran : ';

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

echo '</select>


<input name="s" type="hidden" value="'.$s.'">
<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
</td>
<td align="right">';
echo "<select name=\"katcari\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$filenya.'?crkd='.$crkd.'&crtipe='.$crtipe.'&kunci='.$kunci.'" selected>'.$crtipe.'</option>
<option value="'.$filenya.'?tapelkd='.$tapelkd.'&crkd=cr01&crtipe=NIS&kunci='.$kunci.'">NIS</option>
<option value="'.$filenya.'?tapelkd='.$tapelkd.'&crkd=cr02&crtipe=Nama&kunci='.$kunci.'">Nama</option>
</select>
<input name="kunci" type="text" value="'.$kunci.'" size="20">
<input name="crkd" type="hidden" value="'.$crkd.'">
<input name="crtipe" type="hidden" value="'.$crtipe.'">
<input name="btnCARI" type="submit" value="CARI >>">
<input name="btnRST" type="submit" value="RESET">
</td>
</tr>
</table>
<br>';


//nek blm dipilih
if (empty($tapelkd))
	{
	echo '<font color="#FF0000"><strong>TAHUN PELAJARAN Belum Dipilih...!</strong></font>';
	}
else
	{
	//nis
	if ($crkd == "cr01")
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT DISTINCT(kd_mahasiswa) AS swkd ".
					"FROM mahasiswa_pelanggaran, m_mahasiswa ".
					"WHERE mahasiswa_pelanggaran.kd_mahasiswa = m_mahasiswa.kd ".
					"AND mahasiswa_pelanggaran.kd_tapel = '$tapelkd' ".
					"AND m_mahasiswa.nis LIKE '%$kunci%' ".
					"ORDER BY m_mahasiswa.nis ASC";
		$sqlresult = $sqlcount;

		$count = mysqli_num_rows(mysqli_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?tapelkd=$tapelkd&crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}

	//nama
	else if ($crkd == "cr02")
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT DISTINCT(kd_mahasiswa) AS swkd ".
					"FROM mahasiswa_pelanggaran, m_mahasiswa ".
					"WHERE mahasiswa_pelanggaran.kd_mahasiswa = m_mahasiswa.kd ".
					"AND mahasiswa_pelanggaran.kd_tapel = '$tapelkd' ".
					"AND m_mahasiswa.nama LIKE '%$kunci%' ".
					"ORDER BY m_mahasiswa.nama ASC";
		$sqlresult = $sqlcount;

		$count = mysqli_num_rows(mysqli_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?tapelkd=$tapelkd&crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}

	else
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT DISTINCT(kd_mahasiswa) AS swkd ".
					"FROM mahasiswa_pelanggaran ".
					"WHERE kd_tapel = '$tapelkd' ".
					"ORDER BY tgl DESC";
		$sqlresult = $sqlcount;

		$count = mysqli_num_rows(mysqli_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?tapelkd=$tapelkd&crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}




	//nek ada
	if ($count != 0)
		{
		echo '<table width="800" border="1" cellpadding="3" cellspacing="0">
		<tr bgcolor="'.$warnaheader.'">
		<td width="50"><strong>NIM</strong></td>
		<td width="200"><strong>Nama</strong></td>
		<td width="50"><strong>Total Point</strong></td>
		<td><strong>Tingkat Pembinaan</strong></td>
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

			$i_kd = nosql($data['swkd']);

			//detail siswa
			$qswi = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
						"WHERE kd = '$i_kd'");
			$rswi = mysqli_fetch_assoc($qswi);
			$i_nim = nosql($rswi['nim']);
			$i_nama = balikin($rswi['nama']);



			//jml.skor
			$qkorx = mysqli_query($koneksi, "SELECT SUM(m_bk_point.point) AS pot ".
						"FROM mahasiswa_pelanggaran, m_bk_point ".
						"WHERE mahasiswa_pelanggaran.kd_point = m_bk_point.kd ".
						"AND mahasiswa_pelanggaran.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_pelanggaran.kd_mahasiswa = '$i_kd'");
			$rkorx = mysqli_fetch_assoc($qkorx);
			$rkox_pot = nosql($rkorx['pot']);



			//jika empty
			if (empty($rkox_pot))
				{
				$i_ket = "";
				}

			//jika <= 20
			else if ($rkox_pot <= 20)
				{
				$i_ket = "Dibina oleh Wali Kelas / Konselor Sekolah / orang tua atau wali murid.";
				}

			else if (($rkox_pot >= 21) AND ($rkox_pot <= 30))
				{
				$i_ket = "Dibina oleh Wali Kelas / Konselor Sekolah / orang tua atau wali murid.";
				}

			else if (($rkox_pot >= 31) AND ($rkox_pot <= 50))
				{
				$i_ket = "Dibina oleh Wali Kelas / Konselor Sekolah / Waka Kesiswaan, orang tua atau wali murid.";
				}

			else if (($rkox_pot >= 51) AND ($rkox_pot <= 65))
				{
				$i_ket = "Dibina oleh Wali Kelas / Konselor Sekolah / Kesiswaan dengan peringatan keras I / orang tua atau wali murid.";
				}

			else if (($rkox_pot >= 66) AND ($rkox_pot <= 85))
				{
				$i_ket = "Dibina oleh Wali Kelas / Konselor Sekolah / Kesiswaan dengan peringatan keras II / orang tua atau wali murid.";
				}

			else if (($rkox_pot >= 86) AND ($rkox_pot <= 99))
				{
				$i_ket = "<strong>Dibina oleh Wali Kelas / Konselor Sekolah / Kesiswaan dengan peringatan keras III / orang tua atau wali murid</strong>.";
				}

			else if ($rkox_pot >= 100)
				{
				$i_ket = "<strong>Dikeluarkan / dikembalikan kepada orang tua atau wali murid</strong>.";
				}




			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td valign="top">
			'.$i_nim.'
			</td>
			<td valign="top">
			'.$i_nama.'
			</td>
			<td valign="top" align="right">
			<strong>'.$rkox_pot.'</strong>
			</td>
			<td valign="top">
			'.$i_ket.'
			</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		echo '</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		<font color="#FF0000"><strong>'.$count.'</strong></font> Data '.$pagelist.'</td>
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