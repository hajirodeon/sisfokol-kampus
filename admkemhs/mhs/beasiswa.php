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
require("../../inc/cek/admkemhs.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "beasiswa.php";
$judul = "Data Mahasiswa Penerima BeaSiswa";
$judulku = "[$kemhs_session : $nip4_session. $nm4_session] ==> $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$swkd = nosql($_REQUEST['swkd']);
$s = nosql($_REQUEST['s']);








//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnTBH'])
	{
	$s = nosql($_POST['s']);
	$tapelkd = nosql($_POST['tapelkd']);
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$swkd = nosql($_POST['swkd']);
	$beasiswa = nosql($_POST['beasiswa']);

	//nek null
	if (empty($beasiswa))
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&s=edit";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		///cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM mahasiswa_beasiswa ".
					"WHERE kd_tapel = '$tapelkd' ".
					"AND kd_mhs = '$swkd' ".
					"AND kd_beasiswa = '$beasiswa'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);

		//nek ada
		if ($tcc != 0)
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Bea Siswa Tersebut, Telah diambil. Silahkan Ganti Yang Lain...!!";
			$ke = "$filenya?tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd&swkd=$swkd&s=edit";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//query
			mysqli_query($koneksi, "INSERT INTO mahasiswa_beasiswa(kd, kd_tapel, kd_mhs, kd_beasiswa) VALUES ".
					"('$x', '$tapelkd', '$swkd', '$beasiswa')");

			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$ke = "$filenya?tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd&swkd=$swkd&s=edit";
			xloc($ke);
			exit();
			}
		}
	}


//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM mahasiswa_beasiswa ".
				"WHERE kd_mhs = '$swkd' ".
				"AND kd = '$kd'");
		}

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$ke = "$filenya?tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd&swkd=$swkd&s=edit";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/js/checkall.js");
require("../../inc/menu/admkemhs.php");
xheadline($judul);



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaover.'">
<td width="600">
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

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysqli_fetch_assoc($qtp));

echo '</select>
</td>
</tr>
</table>';




//jika view /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (empty($s))
	{
	//jika null
	if (!empty($progdi))
		{
		$ku_progdi = "AND mahasiswa_kelas.kd_progdi = '$progdi'";
		}


	if (!empty($kelkd))
		{
		$ku_kelkd = "AND mahasiswa_kelas.kd_kelas = '$kelkd'";
		}


	if (!empty($tapelkd))
		{
		$ku_tapelkd = "AND mahasiswa_kelas.kd_tapel = '$tapelkd'";
		}

	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	$sqlcount = "SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
			"FROM m_mahasiswa, mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"$ku_progdi ".
			"$ku_kelkd ".
			"$ku_tapelkd ".
			"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);


	if ($count != 0)
		{
		//view data
		echo '<br>
		<table width="700" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="10">&nbsp;</td>
		<td width="100"><strong><font color="'.$warnatext.'">NIM</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td width="300"><strong><font color="'.$warnatext.'">BeaSiswa Yang Diterima</font></strong></td>
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
			$qdtx = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
						"WHERE nim = '$i_nim'");
			$rdtx = mysqli_fetch_assoc($qdtx);
			$i_kd = nosql($rdtx['kd']);
			$i_nama = balikin($rdtx['nama']);



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<a href="'.$filenya.'?tapelkd='.$tapelkd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&s=edit&swkd='.$i_kd.'" title="EDIT..."><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_nim.'</td>
			<td>'.$i_nama.'</td>
			<td>';

			//beasiswa yg diterima
			$qx = mysqli_query($koneksi, "SELECT mahasiswa_beasiswa.*, mahasiswa_beasiswa.kd AS mbkd, m_bea_siswa.* ".
						"FROM mahasiswa_beasiswa, m_bea_siswa ".
						"WHERE mahasiswa_beasiswa.kd_beasiswa = m_bea_siswa.kd ".
						"AND mahasiswa_beasiswa.kd_mhs = '$i_kd'");
			$rowx = mysqli_fetch_assoc($qx);
			$totalx = mysqli_num_rows($qx);

			do
				{
				$x_nama = balikin2($rowx['nama']);

				echo "$x_nama, ";
				}
			while ($rowx = mysqli_fetch_assoc($qx));

			echo '</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		echo '</table>
		<table width="700" border="0" cellspacing="0" cellpadding="3">
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



//jika edit
else if ($s == "edit")
	{
	//detail
	$qdt = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
				"WHERE kd = '$swkd'");
	$rdt = mysqli_fetch_assoc($qdt);
	$tdt = mysqli_num_rows($qdt);
	$dt_nim = nosql($rdt['nim']);
	$dt_nama = balikin($rdt['nama']);


	echo '<p>
	Nama Mahasiswa : <strong>'.$dt_nim.'. '.$dt_nama.'</strong>
	[<a href="'.$filenya.'?tapelkd='.$tapelkd.'&progdi='.$progdi.'&kelkd='.$kelkd.'">DAFTAR MAHASISWA</a>].
	</p>

	<p>
	<select name="beasiswa">
	<option value="" selected>-Daftar Bea Siswa-</option>';

	$qtp = mysqli_query($koneksi, "SELECT * FROM m_bea_siswa ".
				"ORDER BY nama ASC");
	$rowtp = mysqli_fetch_assoc($qtp);

	do
		{
		$tpkd = nosql($rowtp['kd']);
		$tpnama = balikin($rowtp['nama']);

		echo '<option value="'.$tpkd.'">'.$tpnama.'</option>';
		}
	while ($rowtp = mysqli_fetch_assoc($qtp));

	echo '</select>
	<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
	<INPUT type="hidden" name="progdi" value="'.$progdi.'">
	<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
	<INPUT type="hidden" name="swkd" value="'.$swkd.'">
	<INPUT type="submit" name="btnTBH" value="TAMBAH >>">
	<br>';


	//query
	$q = mysqli_query($koneksi, "SELECT mahasiswa_beasiswa.*, mahasiswa_beasiswa.kd AS mbkd, m_bea_siswa.* ".
				"FROM mahasiswa_beasiswa, m_bea_siswa ".
				"WHERE mahasiswa_beasiswa.kd_beasiswa = m_bea_siswa.kd ".
				"AND mahasiswa_beasiswa.kd_mhs = '$swkd'");
	$row = mysqli_fetch_assoc($q);
	$total = mysqli_num_rows($q);

	if ($total != 0)
		{
		echo '<table width="400" border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="1%">&nbsp;</td>
		<td><strong><font color="'.$warnatext.'">Nama BeaSiswa Yang Diterima</font></strong></td>
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

			$i_nomer = $i_nomer + 1;
			$i_kd = nosql($row['mbkd']);
			$i_nama = balikin2($row['nama']);

			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$i_nomer.'" value="'.$i_kd.'">
			</td>
			<td>'.$i_nama.'</td>
			</tr>';
			}
		while ($row = mysqli_fetch_assoc($q));

		echo '</table>
		<table width="400" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="263">
		<input name="jml" type="hidden" value="'.$total.'">
		<input name="s" type="hidden" value="'.$s.'">
		<input name="kd" type="hidden" value="'.$kdx.'">
		<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$total.')">
		<input name="btnBTL" type="submit" value="BATAL">
		<input name="btnHPS" type="submit" value="HAPUS">
		</td>
		<td align="right">Total : <strong><font color="#FF0000">'.$total.'</font></strong> Data.</td>
		</tr>
		</table>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>TIDAK ADA DATA. Silahkan Entry Dahulu...!!</strong>
		</font>
		</p>';
		}

	echo '</p>';
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