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
$filenya = "mhs_krs.php";
$judul = "KRS Mahasiswa";
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
$ke = "mhs_krs.php?s=smt&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&smtkd=$smtkd&tapelkd=$tapelkd";
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





//ketahui dosen pembimbing-nya
$qtp2xx = mysqli_query($koneksi, "SELECT dosen_pembimbing.*, m_ruang.*, ".
			"m_pegawai.*, m_pegawai.nama AS mpnama ".
			"FROM dosen_pembimbing, m_ruang, m_pegawai ".
			"WHERE dosen_pembimbing.kd_ruang = m_ruang.kd ".
			"AND dosen_pembimbing.kd_pegawai = m_pegawai.kd ".
			"AND dosen_pembimbing.kd_progdi = '$progdi' ".
			"AND dosen_pembimbing.kd_tapel = '$tapelkd' ".
			"AND dosen_pembimbing.kd_smt = '$smtkd' ".
			"AND dosen_pembimbing.kd_kelas = '$kelkd' ".
			"AND dosen_pembimbing.kd_ruang = '$rukd'");
$rowtp2xx = mysqli_fetch_assoc($qtp2xx);
$tp2xx_nip = nosql($rowtp2xx['nip']);
$tp2xx_nama = balikin($rowtp2xx['mpnama']);



echo '<form name="formx" method="post" action="'.$filenya.'">
<table width="550" border="0" cellspacing="0" cellpadding="3">
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


<table width="550" border="0" cellspacing="0" cellpadding="3">
<tr>
<td align="center">
<big>
<strong>KARTU RENCANA STUDI / KRS</strong>
</big>
</td>
</tr>
</table>



<table width="550" border="1" cellspacing="0" cellpadding="3">
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


<table width="550" border="1" cellspacing="0" cellpadding="3">
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

//cek keberadaan mahasiswa
$qcc2 = mysqli_query($koneksi, "SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
			"FROM m_mahasiswa, mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
			"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
			"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
			"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
			"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
			"AND m_mahasiswa.kd = '$kd'");
$rcc2 = mysqli_fetch_assoc($qcc2);
$tcc2 = mysqli_num_rows($qcc2);


//jika sesuai
if ($tcc2 != 0)
	{
	//daftar makul-nya
	$qkulo = mysqli_query($koneksi, "SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, ".
										"m_makul.*, m_makul.kd AS makul, m_makul_smt.sks AS ssks ".
										"FROM mahasiswa_makul, m_makul, m_makul_smt ".
										"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
										"AND m_makul_smt.kd_makul = m_makul.kd ".
										"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ".
										"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
										"AND mahasiswa_makul.kd_smt = '$smtkd' ". 
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND m_makul_smt.kd_tapel = '$tapelkd' ".
										"AND m_makul_smt.kd_smt = '$smtkd' ".
										"ORDER BY m_makul.kode ASC");
	$rkulo = mysqli_fetch_assoc($qkulo);
	$tkulo = mysqli_num_rows($qkulo);

	//jika ada
	if ($tkulo != 0)
		{
		echo '<table width="550" border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="1"><strong><font color="'.$warnatext.'">No.</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td width="10"><strong><font color="'.$warnatext.'">SKS</font></strong></td>
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
			$kulo_kulkd = nosql($rkulo['kulkd']);
			$kulo_kode = nosql($rkulo['kode']);
			$kulo_nama = balikin($rkulo['nama']);
			$kulo_sks = nosql($rkulo['ssks']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td align="center">
			<font size="1px">
			'.$i_nomer.'.
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
			</tr>';
			}
		while ($rkulo = mysqli_fetch_assoc($qkulo));


		//total sks
		$qtoku = mysqli_query($koneksi, "SELECT SUM(m_makul_smt.sks) AS total ".
										"FROM mahasiswa_makul, m_makul, m_makul_smt ".
										"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
										"AND m_makul_smt.kd_makul = m_makul.kd ".
										"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ".
										"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
										"AND mahasiswa_makul.kd_smt = '$smtkd' ". 
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND m_makul_smt.kd_tapel = '$tapelkd' ".
										"AND m_makul_smt.kd_smt = '$smtkd'");
		$rtoku = mysqli_fetch_assoc($qtoku);
		$toku_total = nosql($rtoku['total']);



		//tgl.pengesahan
		$qsahi = mysqli_query($koneksi, "SELECT DATE_FORMAT(mahasiswa_makul.tgl_sah, '%d') AS atgl, ".
								"DATE_FORMAT(mahasiswa_makul.tgl_sah, '%m') AS abln, ".
								"DATE_FORMAT(mahasiswa_makul.tgl_sah, '%Y') AS athn, ".
								"mahasiswa_makul.* ".
								"FROM mahasiswa_makul ".
								"WHERE kd_mahasiswa_kelas = '$mkkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd'");
		$rsahi = mysqli_fetch_assoc($qsahi);
		$atgl = nosql($rsahi['atgl']);
		$abln = nosql($rsahi['abln']);
		$athn = nosql($rsahi['athn']);




		echo '<tr valign="top" bgcolor="'.$warnaheader.'">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"><strong>Jumlah</strong></td>
		<td><strong>'.$toku_total.'</strong></td>
		</tr>
		</table>


		<p>
		<table width="550" border="1" cellspacing="0" cellpadding="3">
		<tr>
		<td align="center">
		Tgl.Pengesahan : <strong>'.$atgl.' '.$arrbln1[$abln].' '.$athn.'</strong>
		</td>
		</tr>
		</table>

		<table width="550" border="1" cellspacing="0" cellpadding="3">
		<tr>
		<td width="33%" align="center">
		Akademik,
		<br><br><br><br>
		<strong>'.$tp2x_pegawai.'</strong>
		</td>
		<td align="center">
		Pembimbing Kelas,
		<br><br><br><br>
		<strong>'.$tp2xx_nama.'</strong>
		</td>
		<td width="33%" align="center">
		Mahasiswa,
		<br><br><br><br>
		<strong>'.$ku_nama.'</strong>
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