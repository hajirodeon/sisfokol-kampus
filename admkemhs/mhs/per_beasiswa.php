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
$filenya = "per_beasiswa.php";
$judul = "Data Mahasiswa Penerima BeaSiswa per Program BeaSiswa";
$judulku = "[$kemhs_session : $nip4_session. $nm4_session] ==> $judul";
$judulx = $judul;
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$beakd = nosql($_REQUEST['beakd']);
$swkd = nosql($_REQUEST['swkd']);
$s = nosql($_REQUEST['s']);








//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnTBH'])
	{
	$s = nosql($_POST['s']);
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
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
		$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=edit";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		///cek
		$qcc = mysql_query("SELECT * FROM mahasiswa_beasiswa ".
					"WHERE kd_mhs = '$swkd' ".
					"AND kd_beasiswa = '$beasiswa' ".
					"AND kd_tapel = '$tapelkd'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//nek ada
		if ($tcc != 0)
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Bea Siswa Tersebut, Telah diambil. Silahkan Ganti Yang Lain...!!";
			$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&swkd=$swkd&s=edit";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//query
			mysql_query("INSERT INTO mahasiswa_beasiswa(kd, kd_mhs, kd_beasiswa, kd_tapel) VALUES ".
					"('$x', '$swkd', '$beasiswa', '$tapelkd')");

			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&swkd=$swkd&s=edit";
			xloc($ke);
			exit();
			}
		}
	}


//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysql_query("DELETE FROM mahasiswa_beasiswa ".
				"WHERE kd_mhs = '$swkd' ".
				"AND kd = '$kd'");
		}

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&swkd=$swkd&s=edit";
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

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&beakd='.$btkd.'">'.$btnama.'</option>';
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

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&beakd='.$beakd.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>
</td>
</tr>
</table>';




//jika view /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (empty($s))
	{
	//cek
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

	else if (empty($beakd))
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
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
				"AND m_bea_siswa.kd = '$beakd' ".
				"ORDER BY round(m_mahasiswa.nim) ASC";
		$sqlresult = $sqlcount;

		$count = mysql_num_rows(mysql_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&beakd=$beakd";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysql_fetch_array($result);


		if ($count != 0)
			{
			//view data
			echo '<br>
			<table width="400" border="1" cellspacing="0" cellpadding="3">
			<tr bgcolor="'.$warnaheader.'">
			<td width="10">&nbsp;</td>
			<td width="100"><strong><font color="'.$warnatext.'">NIM</font></strong></td>
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

				//nilai
				$i_nomer = $i_nomer + 1;
				$i_nim = balikin2($data['nim']);


				//detail
				$qdtx = mysql_query("SELECT * FROM m_mahasiswa ".
							"WHERE nim = '$i_nim'");
				$rdtx = mysql_fetch_assoc($qdtx);
				$i_kd = nosql($rdtx['kd']);
				$i_nama = balikin($rdtx['nama']);



				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>
				<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&s=edit&swkd='.$i_kd.'" title="EDIT..."><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
				</td>
				<td>'.$i_nim.'</td>
				<td>'.$i_nama.'</td>
				</tr>';
				}
			while ($data = mysql_fetch_assoc($result));

			echo '</table>
			<table width="400" border="0" cellspacing="0" cellpadding="3">
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
	}



//jika edit
else if ($s == "edit")
	{
	//detail
	$qdt = mysql_query("SELECT * FROM m_mahasiswa ".
				"WHERE kd = '$swkd'");
	$rdt = mysql_fetch_assoc($qdt);
	$tdt = mysql_num_rows($qdt);
	$dt_nim = nosql($rdt['nim']);
	$dt_nama = balikin($rdt['nama']);


	echo '<p>
	Nama Mahasiswa : <strong>'.$dt_nim.'. '.$dt_nama.'</strong>
	[<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'">DAFTAR MAHASISWA</a>].
	</p>

	<p>
	<select name="beasiswa">
	<option value="" selected>-Daftar Bea Siswa-</option>';

	$qtp = mysql_query("SELECT * FROM m_bea_siswa ".
				"ORDER BY nama ASC");
	$rowtp = mysql_fetch_assoc($qtp);

	do
		{
		$tpkd = nosql($rowtp['kd']);
		$tpnama = balikin($rowtp['nama']);

		echo '<option value="'.$tpkd.'">'.$tpnama.'</option>';
		}
	while ($rowtp = mysql_fetch_assoc($qtp));

	echo '</select>
	<INPUT type="hidden" name="progdi" value="'.$progdi.'">
	<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
	<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
	<INPUT type="hidden" name="swkd" value="'.$swkd.'">
	<INPUT type="submit" name="btnTBH" value="TAMBAH >>">
	<br>';


	//query
	$q = mysql_query("SELECT mahasiswa_beasiswa.*, mahasiswa_beasiswa.kd AS mbkd, m_bea_siswa.* ".
				"FROM mahasiswa_beasiswa, m_bea_siswa ".
				"WHERE mahasiswa_beasiswa.kd_beasiswa = m_bea_siswa.kd ".
				"AND mahasiswa_beasiswa.kd_mhs = '$swkd'");
	$row = mysql_fetch_assoc($q);
	$total = mysql_num_rows($q);

	if ($total != 0)
		{
		echo '<table width="400" border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
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
		while ($row = mysql_fetch_assoc($q));

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