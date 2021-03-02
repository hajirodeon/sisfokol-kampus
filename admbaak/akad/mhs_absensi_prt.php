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
$tpl = LoadTpl("../../template/window.html");

nocache;

//nilai
$filenya = "mhs_absensi_prt.php";
$judul = "Absensi Mahasiswa";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$rukd = nosql($_REQUEST['rukd']);
$smtkd = nosql($_REQUEST['smtkd']);
$mkkd = nosql($_REQUEST['mkkd']);




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//re-direct print...
$ke = "mhs_absensi.php?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd&smtkd=$smtkd&mkkd=$mkkd";
$diload = "window.print();location.href='$ke'";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//isi *START
ob_start();



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//PRODI
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);




//KELAS
$qstx = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
				"WHERE kd = '$rukd'");
$rowstx = mysqli_fetch_assoc($qstx);
$ruang = nosql($rowstx['ruang']);



//smt
$qstxy = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysqli_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);




//mata kuliah
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



echo '<form name="formx" method="post" action="'.$filenya.'">
<table width="600" border="0" cellspacing="0" cellpadding="3">
<tr>
<td align="center">
<big>
<strong>ABSENSI</strong>
<BR>
<strong>'.$tpx_nama.'</strong>
<BR>
<strong>'.$sek_nama.'</strong>
</big>
</td>
</tr>
</table>
<br>

<table width="600" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="100">
Mata Kuliah
</td>
<td width"5">:</td>
<td width="300">
'.$tp2x_nama.'
</td>
<td width="100">
Kelas
</td>
<td width"5">:</td>
<td width="100">
'.$ruang.'
</td>
</tr>

<tr>
<td width="100">
Nama Dosen
</td>
<td width"5">:</td>
<td width="300">
'.$jux2_pnama.'
</td>
<td width="100">
Semester
</td>
<td width"5">:</td>
<td width="100">
'.$smt.'
</td>
</tr>
</table>';


//query
$qdata = mysqli_query($koneksi, "SELECT DISTINCT(m_mahasiswa.kd) AS mskd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
						"ORDER BY round(m_mahasiswa.nim) ASC");
$rdata = mysqli_fetch_assoc($qdata);
$tdata = mysqli_num_rows($qdata);


echo '<table width="600" border="1" cellpadding="3" cellspacing="0">
<tr bgcolor="'.$warnaheader.'">
<td width="5"><strong>No.</strong></td>
<td><strong>Nama</strong></td>';

for ($i=1;$i<=12;$i++)
	{
	echo '<td width="20" align="center"><strong>'.$i.'</strong></td>';
	}

echo '</tr>';

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

	$i_kd = nosql($rdata['mskd']);
	
	//detail ku	
	$qku = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
						"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
						"AND mahasiswa_kelas.kd_mahasiswa = '$i_kd'");
	$rku = mysqli_fetch_assoc($qku);
	$i_mkkd = nosql($rku['mkkd']);
	$i_nim = nosql($rku['nim']);
	$i_nama = balikin2($rku['nama']);


	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
	echo '<td valign="top">'.$nomer.'.</td>
	<td valign="top">'.$i_nama.'</td>';

	for ($i=1;$i<=12;$i++)
		{
		//nilai ne...
		$qxnil = mysqli_query($koneksi, "SELECT m_absen.*, m_absen.kd AS makd, ".
					"mahasiswa_absen.* ".
					"FROM m_absen, mahasiswa_absen ".
					"WHERE mahasiswa_absen.kd_absen = m_absen.kd ".
					"AND mahasiswa_absen.kd_mahasiswa_kelas = '$i_mkkd' ".
					"AND mahasiswa_absen.kd_tapel = '$tapelkd' ".
					"AND mahasiswa_absen.kd_smt = '$smtkd' ".
					"AND mahasiswa_absen.kd_makul = '$mkkd' ".
					"AND mahasiswa_absen.pertemuan = '$i'");
		$rxnil = mysqli_fetch_assoc($qxnil);
		$txnil = mysqli_num_rows($qxnil);
		$xnil_makd = nosql($rxnil['makd']);
		$xnil_absen = nosql($rxnil['absen']);


		echo '<td width="20" align="center"><strong>'.$xnil_absen.'</strong></td>';
		}

	echo '</tr>';
	}
while ($rdata = mysqli_fetch_assoc($qdata));


echo '</table>
<br>
<br>
<br>
'.$sek_kota.',


<br>
<br>
<br>
<br>
<br>
[ '.$jux2_pnama.' ].
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
xclose($koneksi);
exit();
?>