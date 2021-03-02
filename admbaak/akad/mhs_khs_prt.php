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
$tpl = LoadTpl("../../template/print2.html");

nocache;

//nilai
$filenya = "mhs_khs.php";
$judul = "KHS Mahasiswa";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$rukd = nosql($_REQUEST['rukd']);
$mkkd = nosql($_REQUEST['mkkd']);
$kd = nosql($_REQUEST['kd']);
$kulkd = nosql($_REQUEST['kulkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//re-direct print...
$ke = "mhs_khs.php?s=smt&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&smtkd=$smtkd&tapelkd=$tapelkd";
$diload = "window.print();location.href='$ke'";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//isi *START
ob_start();


//js
require("../../inc/js/swap.js");

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//detail mahasiswa
$qku = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
			"WHERE kd = '$kd'");
$rku = mysqli_fetch_assoc($qku);
$ku_nim = nosql($rku['nim']);
$ku_nama = balikin($rku['nama']);


//smt
$qstxy = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysqli_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);
$smt_no = nosql($rowstxy['no']);


//jenis smt
//jika ganjil
if (($smt_no == "1") OR ($smt_no == "3") OR ($smt_no == "5"))
	{
	$smt_jns = "Ganjil";
	}
else
	{
	$smt_jns = "Genap";
	}




//tapel
$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rtpel = mysqli_fetch_assoc($qtpel);
$ttpel = mysqli_num_rows($qtpel);
$tpel_thn1 = nosql($rtpel['tahun1']);
$tpel_thn2 = nosql($rtpel['tahun2']);



//ketahui ka.prodi
$qtp2x = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.nama AS mpnama, m_progdi.* ".
			"FROM m_pegawai, m_progdi ".
			"WHERE m_progdi.kd_pegawai = m_pegawai.kd ".
			"AND m_progdi.kd = '$progdi'");
$rowtp2x = mysqli_fetch_assoc($qtp2x);
$tp2x_nip = nosql($rowtp2x['nip']);
$tp2x_pegawai = balikin($rowtp2x['mpnama']);





//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);
$tpx_nama2 = balikin($rowtpx['nama2']);


echo '<form name="formx" method="post" action="'.$filenya.'">
<table width="500" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="60">
<img src="'.$sumber.'/img/logo.png" height="60" border="0">
</td>
<td>
<big>
<strong>'.$sek_nama.'</strong>
</big>
<br>
'.$sek_alamat.'
<br>
'.$sek_kontak.'
</td>
</tr>
</table>
<hr>


<table width="500" border="0" cellspacing="0" cellpadding="3">
<tr>
<td align="center">
<big>
<strong>KARTU HASIL STUDI / KHS</strong>
</big>
</td>
</tr>
</table>



<table width="500" border="1" cellspacing="0" cellpadding="3">
<tr>
<td>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="40">
Nama 
</td>
<td width="250">: 
<strong>'.$ku_nama.'</strong>
</td>
<td width="50">
Semester 
</td>
<td>: 
<strong>'.$smt.' ('.$smt_jns.')</strong>
</td>
</tr>

<tr>
<td>
NIM 
</td>
<td>: 
<strong>'.$ku_nim.'</strong>
</td>
<td>
Thn.Akademik 
</td>
<td>:
<strong>'.$tpel_thn1.'/'.$tpel_thn2.'</strong>
</td>
</tr>
</table>

</td>
</tr>
</table>


<table width="500" border="1" cellspacing="0" cellpadding="3">
<tr>
<td>
Program Studi : ';
//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);

echo '<strong>'.$tpx_nama.'</strong>
</td>
</tr>
</table>
<br>';



//detail
$qxpell = mysqli_query($koneksi, "SELECT mahasiswa_kelas.kd AS skkd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
						"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
						"AND m_mahasiswa.kd = '$kd'");
$rxpell = mysqli_fetch_assoc($qxpell);
$i_skkd = nosql($rxpell['skkd']);
	
	
	

//daftar makul-nya
$qkulo = mysqli_query($koneksi, "SELECT m_makul.*, m_makul.kd AS mkkd, m_makul_smt.*, ".
							"m_makul_smt.sks AS ssks ".
							"FROM m_makul, m_makul_smt ".
							"WHERE m_makul_smt.kd_makul = m_makul.kd ".
							"AND m_makul.kd_progdi = '$progdi' ".
							"AND m_makul_smt.kd_tapel = '$tapelkd' ".
							"AND m_makul_smt.kd_smt = '$smtkd' ".
							"ORDER BY m_makul.kode ASC");
$rkulo = mysqli_fetch_assoc($qkulo);
$tkulo = mysqli_num_rows($qkulo);

//jika ada
if ($tkulo != 0)
	{
	echo '<table width="500" border="1" cellspacing="0" cellpadding="3">
	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="40"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Nama Mata Kuliah</font></strong></td>
	<td width="30"><strong><font color="'.$warnatext.'">SKS</font></strong></td>
	<td width="30"><strong><font color="'.$warnatext.'">Nilai Huruf</font></strong></td>
	<td width="30"><strong><font color="'.$warnatext.'">Nilai Angka</font></strong></td>
	<td width="30"><strong><font color="'.$warnatext.'">Nilai Mutu</font></strong></td>
	</tr>';


	do
		{
		//nilai
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
		$xyz = md5("$x$i_nomer");
		$kulo_kulkd = nosql($rkulo['mkkd']);
//		$kulo_makul = nosql($rkulo['kd_makul']);
		$kulo_makul = nosql($rkulo['mkkd']);
		$kulo_kode = nosql($rkulo['kode']);
		$kulo_nama = balikin($rkulo['nama']);
		$kulo_sks = nosql($rkulo['ssks']);




		//nilai
		$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_nilai ".
								"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_makul = '$kulo_makul'");
		$rnil = mysqli_fetch_assoc($qnil);
//					$nil_huruf = nosql($rnil['nil_akhir_huruf']);
		$nil_tugas = nosql($rnil['nil_tugas']);
		$nil_uts = nosql($rnil['nil_uts']);
		$nil_uas = nosql($rnil['nil_uas']);
		$nil_akhir = nosql($rnil['nil_akhir']);
		$xpel_akhir = $nil_akhir;



		//nil_huruf
		if (($xpel_akhir <= "100") AND ($xpel_akhir >= "80"))
			{
			$nil_huruf = "A";
			}
		else if (($xpel_akhir < "80") AND ($xpel_akhir >= "65"))
			{
			$nil_huruf = "B";
			}
		else if (($xpel_akhir < "65") AND ($xpel_akhir >= "50"))
			{
			$nil_huruf = "C";
			}
		else if (($xpel_akhir < "50") AND ($xpel_akhir >= "40"))
			{
			$nil_huruf = "D";
			}
		else
			{
			$nil_huruf = "E";
			}



		//update huruf
		mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET nil_akhir_huruf = '$nil_huruf' ".
						"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_makul = '$kulo_makul'");





		//bobot nilai
		if ($nil_huruf == "A")
			{
			$nil_angka = "4";
			}
		else if ($nil_huruf == "B")
			{
			$nil_angka = "3";
			}
		else if ($nil_huruf == "C")
			{
			$nil_angka = "2";
			}
		else if ($nil_huruf == "D")
			{
			$nil_angka = "1";
			}
		else
			{
			$nil_angka = "0";
			}


		//nilai mutu
		$nil_mutu = round($kulo_sks * $nil_angka);

		mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET subtotal_mutu = '$nil_mutu' ".
						"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_makul = '$kulo_makul'");


			
		//cek table transkrip
		$qkuu = mysqli_query($koneksi, "SELECT * FROM mahasiswa_transkrip ".
								"WHERE kd_mahasiswa = '$kd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_makul = '$kulo_makul'");
		$rkuu = mysqli_fetch_assoc($qkuu);
		$tkuu = mysqli_num_rows($qkuu);
		
		//jika ada, update
		if (!empty($tkuu))
			{
			mysqli_query($koneksi, "UPDATE mahasiswa_transkrip SET sks = '$kulo_sks', ".
							"nil_huruf = '$nil_huruf', ".
							"nil_angka = '$nil_angka', ".
							"nil_mutu = '$nil_mutu', ".
							"postdate = '$today' ".
							"WHERE kd_mahasiswa = '$kd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd' ".
							"AND kd_makul = '$kulo_makul'");
								
			}
		else 
			{
			mysqli_query($koneksi, "INSERT INTO mahasiswa_transkrip(kd, kd_mahasiswa, kd_tapel, kd_smt, ".
							"kd_makul, sks, nil_huruf, nil_angka, ".
							"nil_mutu, postdate) VALUES ".
							"('$xyz', '$kd', '$tapelkd', '$smtkd', ".
							"'$kulo_makul', '$kulo_sks', '$nil_huruf', '$nil_angka', ".
							"'$nil_mutu', '$today')");
			}



		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<font size="1px">
		'.$i_nomer.'
		</font>
		</td>
		<td>
		<font size="1px">
		'.$kulo_kode.'
		</font>
		</td>
		<td>
		<font size="1px">
		'.$kulo_nama.'
		</font>
		</td>
		<td>
		<font size="1px">
		'.$kulo_sks.'
		</font>
		</td>
		<td>
		<font size="1px">
		'.$nil_huruf.'
		</font>
		</td>
		<td>
		<font size="1px">
		'.$nil_angka.'
		</font>
		</td>
		<td>
		<font size="1px">
		'.$nil_mutu.'
		</font>
		</td>
		</tr>';
		}
	while ($rkulo = mysqli_fetch_assoc($qkulo));


	//total sks
	$qtoku = mysqli_query($koneksi, "SELECT SUM(sks) AS total ".
							"FROM mahasiswa_transkrip ".
							"WHERE kd_mahasiswa = '$kd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd'");
	$rtoku = mysqli_fetch_assoc($qtoku);
	$toku_total = round(nosql($rtoku['total']));


	//total nil_mutu
	$qtoku2 = mysqli_query($koneksi, "SELECT SUM(nil_mutu) AS total ".
							"FROM mahasiswa_transkrip ".
							"WHERE kd_mahasiswa = '$kd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd'");
	$rtoku2 = mysqli_fetch_assoc($qtoku2);
	$toku2_total = round(nosql($rtoku2['total']));


	//total IP
	$nil_ip = round($toku2_total/$toku_total,2);


	//ipk : total sks /////////////////////////////////////////////////////
	$qtoku3 = mysqli_query($koneksi, "SELECT SUM(sks) AS total ".
							"FROM mahasiswa_transkrip ".
							"WHERE kd_mahasiswa = '$kd'");
	$rtoku3 = mysqli_fetch_assoc($qtoku3);
	$toku3_total = nosql($rtoku3['total']);


	//ipk : total nil_mutu ////////////////////////////////////////////////
	$qtoku23 = mysqli_query($koneksi, "SELECT SUM(nil_mutu) AS total ".
							"FROM mahasiswa_transkrip ".
							"WHERE kd_mahasiswa = '$kd'");
	$rtoku23 = mysqli_fetch_assoc($qtoku23);
	$toku23_total = round(nosql($rtoku23['total']));


	//total IPK
	$nil_ipk = round($toku23_total/$toku3_total,2);


	//tapel-nya
	$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
				"WHERE kd = '$tapelkd'");
	$rtpel = mysqli_fetch_assoc($qtpel);
	$ttpel = mysqli_num_rows($qtpel);
	$tpel_thn1 = nosql($rtpel['tahun1']);
	$tpel_thn2 = nosql($rtpel['tahun2']);



	//tgl.pengesahan
	$qsahi = mysqli_query($koneksi, "SELECT DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%d') AS atgl, ".
				"DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%m') AS abln, ".
				"DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%Y') AS athn, ".
				"mahasiswa_nilai.* ".
				"FROM mahasiswa_nilai ".
				"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd'");
	$rsahi = mysqli_fetch_assoc($qsahi);
	$atgl = nosql($rsahi['atgl']);
	$abln = nosql($rsahi['abln']);
	$athn = nosql($rsahi['athn']);



	echo '<tr valign="top" bgcolor="'.$warnaheader.'">
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td align="right">
	<font size="1px">
	<strong>Jumlah</strong>
	</font>
	</td>
	<td>
	<font size="1px">
	<strong>'.$toku_total.'</strong>
	</font>
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>
	<font size="1px">
	<strong>'.$toku2_total.'</strong>
	</font>
	</td>
	</tr>

	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td align="right">
	<font size="1px">
	<strong>Indek Prestasi (IP) Semester ini</strong>
	</font>
	</td>
	<td>
	<font size="1px">
	<strong>'.$nil_ip.'</strong>
	</font>
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>

	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td align="right">
	<font size="1px">
	<strong>Indek Prestasi Komulatif (IPK)</strong>
	</font>
	</td>
	<td>
	<font size="1px">
	<strong>'.$nil_ipk.'</strong>
	</font>
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
	</table>


		<p>
		<table width="500" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="33%" align="left">
		'.$sek_kota.', '.$atgl.' '.$arrbln1[$abln].' '.$athn.'
		<br>
		Akademik. 
		<br><br><br><br>
		<u><strong>'.$tp2x_pegawai.'</strong></u>
		<br>
		<strong>'.$tp2x_nip.'</strong>
		</td>
		</tr>
		</table>
		</p>';
		}

	else
		{
		echo '<p>
		<font color="red">
		<strong>BELUM ADA DATA MATA KULIAH.</strong>
		</font>
		</p>';
		}

	echo '</p>
	<br>';


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