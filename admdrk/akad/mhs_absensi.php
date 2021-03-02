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
require("../../inc/cek/admdrk.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "mhs_absensi.php";
$judul = "Data Absensi Mahasiswa";
$judulku = "[$drk_session : $nip1_session. $nm1_session] ==> $judul";
$judulx = $judul;
$progdi = nosql($_REQUEST['progdi']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$kelkd = nosql($_REQUEST['kelkd']);
$rukd = nosql($_REQUEST['rukd']);
$mkkd = nosql($_REQUEST['mkkd']);
$kd = nosql($_REQUEST['kd']);
$kulkd = nosql($_REQUEST['kulkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$pertemuan = nosql($_REQUEST['pertemuan']);
$utgl = nosql($_REQUEST['utgl']);
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
else if (empty($rukd))
	{
	$diload = "document.formx.ruang.focus();";
	}










//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admdrk.php");
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

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$stkd.'">'.$struang.'</option>';
	}
while ($rowst = mysqli_fetch_assoc($qst));

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

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&smtkd='.$stkd.'">'.$stsmt.'</option>';
	}
while ($rowst = mysqli_fetch_assoc($qst));

echo '</select>

</td>
</tr>
</table>

<table bgcolor="'.$warna02.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>';

//terpilih
$qtp2x = mysqli_query($koneksi, "SELECT m_makul.*, m_makul.kd AS mmkd, m_makul_smt.* ".
			"FROM m_makul, m_makul_smt ".
			"WHERE m_makul_smt.kd_makul = m_makul.kd ".
			"AND m_makul.kd_progdi = '$progdi' ".
			"AND m_makul.kd = '$mkkd' ".
			"AND m_makul_smt.kd_tapel = '$tapelkd' ".
			"AND m_makul_smt.kd_smt = '$smtkd' ".
			"ORDER BY m_makul.kode ASC");
$rowtp2x = mysqli_fetch_assoc($qtp2x);
$tp2x_kode = nosql($rowtp2x['kode']);
$tp2x_nama = balikin($rowtp2x['nama']);


//dosennya
$qjux2 = mysqli_query($koneksi, "SELECT dosen.*, dosen.kd AS dkd, ".
			"m_makul.*, m_pegawai.*, m_pegawai.kd AS mpkd, ".
			"m_pegawai.nama AS pnama ".
			"FROM dosen, m_makul, m_pegawai ".
			"WHERE dosen.kd_pegawai = m_pegawai.kd ".
			"AND dosen.kd_makul = m_makul.kd ".
			"AND dosen.kd_makul = '$mkkd' ".
			"AND dosen.kd_progdi = '$progdi' ".
			"AND dosen.kd_kelas = '$kelkd'");
$rjux2 = mysqli_fetch_assoc($qjux2);
$tjux2 = mysqli_num_rows($qjux2);
$jux2_dkd = nosql($rjux2['dkd']);
$jux2_mpkd = nosql($rjux2['mpkd']);
$jux2_pnama = balikin($rjux2['pnama']);


echo "<select name=\"makul\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="" selected>['.$tp2x_kode.']. '.$tp2x_nama.' [Dosen : '.$jux2_pnama.'].</option>';

$qtp2 = mysqli_query($koneksi, "SELECT m_makul.*, m_makul.kd AS mmkd, m_makul_smt.* ".
			"FROM m_makul, m_makul_smt ".
			"WHERE m_makul_smt.kd_makul = m_makul.kd ".
			"AND m_makul.kd_progdi = '$progdi' ".
			"AND m_makul_smt.kd_tapel = '$tapelkd' ".
			"AND m_makul_smt.kd_smt = '$smtkd' ".
			"ORDER BY m_makul.kode ASC");
$rowtp2 = mysqli_fetch_assoc($qtp2);

do
	{
	$tp2_kd = nosql($rowtp2['mmkd']);
	$tp2_kode = nosql($rowtp2['kode']);
	$tp2_nama = balikin($rowtp2['nama']);


	//dosennya
	$qjux = mysqli_query($koneksi, "SELECT dosen.*, dosen.kd AS dkd, ".
				"m_makul.*, m_pegawai.*, m_pegawai.kd AS mpkd, ".
				"m_pegawai.nama AS pnama ".
				"FROM dosen, m_makul, m_pegawai ".
				"WHERE dosen.kd_pegawai = m_pegawai.kd ".
				"AND dosen.kd_makul = m_makul.kd ".
				"AND dosen.kd_makul = '$tp2_kd' ".
				"AND dosen.kd_progdi = '$progdi' ".
				"AND dosen.kd_kelas = '$kelkd'");
	$rjux = mysqli_fetch_assoc($qjux);
	$tjux = mysqli_num_rows($qjux);
	$jux_dkd = nosql($rjux['dkd']);
	$jux_mpkd = nosql($rjux['mpkd']);
	$jux_pnama = balikin($rjux['pnama']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'&mkkd='.$tp2_kd.'">['.$tp2_kode.']. '.$tp2_nama.' [Dosen : '.$jux_pnama.'].</option>';
	}
while ($rowtp2 = mysqli_fetch_assoc($qtp2));

echo '</select>
</td>
</tr>
</table>';


//nek blm dipilih
if (empty($progdi))
	{
	echo '<font color="#FF0000"><strong>PROGRAM PENDIDIKAN Belum Dipilih...!</strong></font>';
	}

else if (empty($kelkd))
	{
	echo '<font color="#FF0000"><strong>JENIS Belum Dipilih...!</strong></font>';
	}

else if (empty($tapelkd))
	{
	echo '<font color="#FF0000"><strong>TAHUN AKADEMIK Belum Dipilih...!</strong></font>';
	}

else if (empty($rukd))
	{
	echo '<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>';
	}

else if (empty($smtkd))
	{
	echo '<font color="#FF0000"><strong>SEMESTER Belum Dipilih...!</strong></font>';
	}

else if (empty($mkkd))
	{
	echo '<font color="#FF0000"><strong>MATA KULIAH Belum Dipilih...!</strong></font>';
	}
else
	{
	//jika daftar
	if (empty($s))
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
		$target = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&rukd=$rukd&mkkd=$mkkd&smtkd=$smtkd";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);


		echo '<p>
		<table width="500" border="1" cellpadding="3" cellspacing="0">
		<tr bgcolor="'.$warnaheader.'">
		<td width="50"><strong>NIM</strong></td>
		<td><strong>Nama</strong></td>';

		//daftar absensi
		$qabs = mysqli_query($koneksi, "SELECT * FROM m_absen ".
					"ORDER BY absen ASC");
		$rabs = mysqli_fetch_assoc($qabs);

		do
			{
			//nilai
			$abs_kd = nosql($rabs['kd']);
			$abs_absensi2 = nosql($rabs['absen']);

			echo '<td width="50"><strong>Jml. '.$abs_absensi2.'</strong></td>';
			}
		while ($rabs = mysqli_fetch_assoc($qabs));

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
				$i_nim = nosql($data['nim']);

				//detail
				$qdt = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
							"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
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
				$i_kd = $dt_kd;
				$i_mkkd = $dt_mkkd;
				$i_nama = $dt_nama;



				//nilai ne...
				$qxnil = mysqli_query($koneksi, "SELECT m_absen.*, m_absen.kd AS makd, ".
							"mahasiswa_absen.* ".
							"FROM m_absen, mahasiswa_absen ".
							"WHERE mahasiswa_absen.kd_absen = m_absen.kd ".
							"AND mahasiswa_absen.kd_mahasiswa_kelas = '$i_mkkd' ".
							"AND mahasiswa_absen.kd_tapel = '$tapelkd' ".
							"AND mahasiswa_absen.kd_smt = '$smtkd' ".
							"AND mahasiswa_absen.kd_makul = '$mkkd' ".
							"AND mahasiswa_absen.pertemuan = '$pertemuan'");
				$rxnil = mysqli_fetch_assoc($qxnil);
				$txnil = mysqli_num_rows($qxnil);
				$xnil_makd = nosql($rxnil['makd']);
				$xnil_absen = nosql($rxnil['absen']);


				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td valign="top">'.$i_nim.'</td>
				<td valign="top">'.$i_nama.'</td>';

				//daftar absensi
				$qabs = mysqli_query($koneksi, "SELECT * FROM m_absen ".
							"ORDER BY absen ASC");
				$rabs = mysqli_fetch_assoc($qabs);

				do
					{
					//nilai
					$abs_kd = nosql($rabs['kd']);

					//total...
					$qsubx = mysqli_query($koneksi, "SELECT * FROM mahasiswa_absen ".
								"WHERE kd_mahasiswa_kelas = '$i_mkkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_makul = '$mkkd' ".
								"AND kd_absen = '$abs_kd'");
					$rsubx = mysqli_fetch_assoc($qsubx);
					$tsubx = mysqli_num_rows($qsubx);

					echo '<td width="50">'.$tsubx.'</td>';
					}
				while ($rabs = mysqli_fetch_assoc($qabs));

				//total absen
				$qsubx2 = mysqli_query($koneksi, "SELECT mahasiswa_absen.*, m_absen.* ".
							"FROM mahasiswa_absen, m_absen ".
							"WHERE mahasiswa_absen.kd_absen = m_absen.kd ".
							"AND mahasiswa_absen.kd_mahasiswa_kelas = '$i_mkkd' ".
							"AND mahasiswa_absen.kd_tapel = '$tapelkd' ".
							"AND mahasiswa_absen.kd_smt = '$smtkd' ".
							"AND mahasiswa_absen.kd_makul = '$mkkd'");
				$rsubx2 = mysqli_fetch_assoc($qsubx2);
				$tsubx2 = mysqli_num_rows($qsubx2);


				//selisih kehadiran
				$sel_hadir = round(14 - $tsubx2);

				echo '<td><strong>'.$sel_hadir.' </strong>kali</td>
				</tr>';
				}
			while ($data = mysqli_fetch_assoc($result));
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
		<input name="pertemuan" type="hidden" value="'.$pertemuan.'">
		<input name="utgl" type="hidden" value="'.$utgl.'">
		<input name="ubln" type="hidden" value="'.$ubln.'">
		<input name="uthn" type="hidden" value="'.$uthn.'">
		</td>
		<td align="right">
		'.$pagelist.'
		</td>
		</tr>
		</table>
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