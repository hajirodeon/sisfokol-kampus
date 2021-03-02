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

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admak.php");
$tpl = LoadTpl("../../template/window.html");


nocache;


//nilai
$filenya = "bayar.php";
$jnskd = nosql($_REQUEST['jnskd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$nim = nosql($_REQUEST['nim']);



//ketahui jenis keuangan
$qdt = mysqli_query($koneksi, "SELECT * FROM m_keu_jenis ".
			"WHERE kd = '$jnskd'");
$rdt = mysqli_fetch_assoc($qdt);
$dt_kd = nosql($rdt['kd']);
$dt_jenis = balikin($rdt['nama']);




//judul halaman
$judul = "Pembayaran Uang : $dt_jenis";
$judulku = "[$bak_session : $nip11_session. $nm11_session] ==> $judul";
$juduli = $judul;
$ke = "$filenya?jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&smtkd=$smtkd&nim=$nim";






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//re-direct print...
$ke = "bayar.php?jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&smtkd=$smtkd&nim=$nim";
$diload = "window.print();location.href='$ke'";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//isi *START
ob_start();

//js
require("../../inc/js/swap.js");

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">
<table width="500" border="1" cellspacing="0" cellpadding="3">
<tr valign="top">
<td valign="top" align="center">


<table width="500" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td valign="top" align="center">
<P>
<big>
<strong><u>BUKTI PEMBAYARAN UANG '.strtoupper($dt_jenis).'</u></strong>
</big>
</P>
<P>
<big>
<strong><u>'.$sek_nama.'</u></strong>
</big>
</P>

<hr height="1">
</td>
</tr>
</table>
<table width="500" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td valign="top" width="200">
Hari, Tanggal
</td>
<td width="1">:</td>
<td>
<strong>'.$arrhari[$hari].', '.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'</strong>
</td>
</tr>

<tr valign="top">
<td valign="top" width="200">
Nomor Induk
</td>
<td width="1">:</td>
<td>
<strong>'.$nim.'</strong>
</td>
</tr>';

//cek
$qcc = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
			"WHERE nim = '$nim'");
$rcc = mysqli_fetch_assoc($qcc);
$tcc = mysqli_num_rows($qcc);
$cc_kd = nosql($rcc['kd']);
$cc_nama = balikin($rcc['nama']);



//jika sks
if ($jnskd == "b7456a463a7b0c1c9a3ece4b30c6db4a")
	{
	//ketahui jumlah SKS yang dimiliki, agar tahu total pembayarannya.
	//detail
	$qdtku = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
				"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND m_mahasiswa.kd = '$cc_kd'");
	$rdtku = mysqli_fetch_assoc($qdtku);
	$dtku_mkkd = nosql($rdtku['mkkd']);

	//total sks
	$qtoku = mysqli_query($koneksi, "SELECT SUM(m_makul.sks) AS total ".
				"FROM mahasiswa_makul, m_makul ".
				"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
				"AND mahasiswa_makul.kd_mahasiswa_kelas = '$dtku_mkkd' ".
				"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
				"AND mahasiswa_makul.kd_smt = '$smtkd'");
	$rtoku = mysqli_fetch_assoc($qtoku);
	$toku_total = nosql($rtoku['total']);


	//total uang
	$qpkl = mysqli_query($koneksi, "SELECT * FROM m_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd'");
	$rpkl = mysqli_fetch_assoc($qpkl);
	$pkl_nilai = nosql($rpkl['biaya']);


	//yang sedang dibayar
	$qccx1 = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai ".
				"FROM mahasiswa_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$cc_kd' ".
				"AND DATE_FORMAT(tgl_bayar, '%d') = '$tanggal' ".
				"AND DATE_FORMAT(tgl_bayar, '%m') = '$bulan' ".
				"AND DATE_FORMAT(tgl_bayar, '%Y') = '$tahun'");
	$rccx1 = mysqli_fetch_assoc($qccx1);
	$ccx1_nilai = nosql($rccx1['nilai']);


	//yang telah dibayar
	$qccx2 = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai ".
				"FROM mahasiswa_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$cc_kd'");
	$rccx2 = mysqli_fetch_assoc($qccx2);
	$ccx2_nilai = nosql($rccx2['nilai']);


	//sisa
	$nil_sisa = round(($toku_total*$pkl_nilai) - $ccx2_nilai);



	//ketahui kode mahasiswa, dari suatu mahasiswa_kelas
	$qske = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, m_tapel.* ".
				"FROM mahasiswa_kelas, m_tapel ".
				"WHERE mahasiswa_kelas.kd_tapel = m_tapel.kd ".
				"AND mahasiswa_kelas.kd_mahasiswa = '$cc_kd' ".
				"AND m_tapel.kd = '$tapelkd'");
	$rske = mysqli_fetch_assoc($qske);
	$tske = mysqli_num_rows($qske);


	//semester terakhir
	$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_kelas ".
				"WHERE kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_mahasiswa = '$cc_kd'");
	$rnil = mysqli_fetch_assoc($qnil);
	$tnil = mysqli_num_rows($qnil);
	$nil_smtkd = nosql($rnil['kd_smt']);

	//smt
	$qkelx = mysqli_query($koneksi, "SELECT * FROM m_smt ".
				"WHERE kd = '$nil_smtkd'");
	$rkelx = mysqli_fetch_assoc($qkelx);
	$kelx_smt = balikin($rkelx['smt']);
	}



//jika SPI, punya minimal /////////////////////////////////////////////////////////////////////////////
else if ($jnskd == "70b97c951b5dc2c3b26d50eefeea19cc")
	{
	//yang sedang dibayar
	$qccx1 = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai ".
				"FROM mahasiswa_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$cc_kd' ".
				"AND DATE_FORMAT(tgl_bayar, '%d') = '$tanggal' ".
				"AND DATE_FORMAT(tgl_bayar, '%m') = '$bulan' ".
				"AND DATE_FORMAT(tgl_bayar, '%Y') = '$tahun'");
	$rccx1 = mysqli_fetch_assoc($qccx1);
	$ccx1_nilai = nosql($rccx1['nilai']);


	//yang telah dibayar
	$qccx2 = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai ".
				"FROM mahasiswa_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$cc_kd'");
	$rccx2 = mysqli_fetch_assoc($qccx2);
	$ccx2_nilai = nosql($rccx2['nilai']);


	//sisa
	$nil_sisa = $ccx2_nilai;



	//ketahui kode mahasiswa, dari suatu mahasiswa_kelas
	$qske = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, m_tapel.* ".
				"FROM mahasiswa_kelas, m_tapel ".
				"WHERE mahasiswa_kelas.kd_tapel = m_tapel.kd ".
				"AND mahasiswa_kelas.kd_mahasiswa = '$cc_kd' ".
				"AND m_tapel.kd = '$tapelkd'");
	$rske = mysqli_fetch_assoc($qske);
	$tske = mysqli_num_rows($qske);


	//semester terakhir
	$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_kelas ".
				"WHERE kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_mahasiswa = '$cc_kd'");
	$rnil = mysqli_fetch_assoc($qnil);
	$tnil = mysqli_num_rows($qnil);
	$nil_smtkd = nosql($rnil['kd_smt']);

	//smt
	$qkelx = mysqli_query($koneksi, "SELECT * FROM m_smt ".
				"WHERE kd = '$nil_smtkd'");
	$rkelx = mysqli_fetch_assoc($qkelx);
	$kelx_smt = balikin($rkelx['smt']);
	}




//jika SS, punya batasan maksimal /////////////////////////////////////////////////////////////////////////////
else if ($jnskd == "f3b22b92155c4bc1ecb1b6db7dd56b91")
	{
	//yang sedang dibayar
	$qccx1 = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai ".
				"FROM mahasiswa_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$cc_kd' ".
				"AND DATE_FORMAT(tgl_bayar, '%d') = '$tanggal' ".
				"AND DATE_FORMAT(tgl_bayar, '%m') = '$bulan' ".
				"AND DATE_FORMAT(tgl_bayar, '%Y') = '$tahun'");
	$rccx1 = mysqli_fetch_assoc($qccx1);
	$ccx1_nilai = nosql($rccx1['nilai']);


	//yang telah dibayar
	$qccx2 = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai ".
				"FROM mahasiswa_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$cc_kd'");
	$rccx2 = mysqli_fetch_assoc($qccx2);
	$ccx2_nilai = nosql($rccx2['nilai']);


	//sisa
	$nil_sisa = $ccx2_nilai;



	//ketahui kode mahasiswa, dari suatu mahasiswa_kelas
	$qske = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, m_tapel.* ".
				"FROM mahasiswa_kelas, m_tapel ".
				"WHERE mahasiswa_kelas.kd_tapel = m_tapel.kd ".
				"AND mahasiswa_kelas.kd_mahasiswa = '$cc_kd' ".
				"AND m_tapel.kd = '$tapelkd'");
	$rske = mysqli_fetch_assoc($qske);
	$tske = mysqli_num_rows($qske);


	//semester terakhir
	$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_kelas ".
				"WHERE kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_mahasiswa = '$cc_kd'");
	$rnil = mysqli_fetch_assoc($qnil);
	$tnil = mysqli_num_rows($qnil);
	$nil_smtkd = nosql($rnil['kd_smt']);

	//smt
	$qkelx = mysqli_query($koneksi, "SELECT * FROM m_smt ".
				"WHERE kd = '$nil_smtkd'");
	$rkelx = mysqli_fetch_assoc($qkelx);
	$kelx_smt = balikin($rkelx['smt']);
	}



else
	{
	//total uang
	$qpkl = mysqli_query($koneksi, "SELECT * FROM m_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd'");
	$rpkl = mysqli_fetch_assoc($qpkl);
	$pkl_nilai = nosql($rpkl['biaya']);


	//yang sedang dibayar
	$qccx1 = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai ".
				"FROM mahasiswa_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$cc_kd' ".
				"AND DATE_FORMAT(tgl_bayar, '%d') = '$tanggal' ".
				"AND DATE_FORMAT(tgl_bayar, '%m') = '$bulan' ".
				"AND DATE_FORMAT(tgl_bayar, '%Y') = '$tahun'");
	$rccx1 = mysqli_fetch_assoc($qccx1);
	$ccx1_nilai = nosql($rccx1['nilai']);


	//yang telah dibayar
	$qccx2 = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai ".
				"FROM mahasiswa_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$cc_kd'");
	$rccx2 = mysqli_fetch_assoc($qccx2);
	$ccx2_nilai = nosql($rccx2['nilai']);


	//sisa
	$nil_sisa = $pkl_nilai - $ccx2_nilai;



	//ketahui kode mahasiswa, dari suatu mahasiswa_kelas
	$qske = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, m_tapel.* ".
				"FROM mahasiswa_kelas, m_tapel ".
				"WHERE mahasiswa_kelas.kd_tapel = m_tapel.kd ".
				"AND mahasiswa_kelas.kd_mahasiswa = '$cc_kd' ".
				"AND m_tapel.kd = '$tapelkd'");
	$rske = mysqli_fetch_assoc($qske);
	$tske = mysqli_num_rows($qske);


	//semester terakhir
	$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_kelas ".
				"WHERE kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_mahasiswa = '$cc_kd'");
	$rnil = mysqli_fetch_assoc($qnil);
	$tnil = mysqli_num_rows($qnil);
	$nil_smtkd = nosql($rnil['kd_smt']);

	//smt
	$qkelx = mysqli_query($koneksi, "SELECT * FROM m_smt ".
				"WHERE kd = '$nil_smtkd'");
	$rkelx = mysqli_fetch_assoc($qkelx);
	$kelx_smt = balikin($rkelx['smt']);
	}

echo '<tr valign="top">
<td valign="top" width="200">
Nama Mahasiswa
</td>
<td width="1">:</td>
<td>
<strong>'.$cc_nama.'</strong>
</td>
</tr>

<tr valign="top">
<td valign="top" width="200">
Semester
</td>
<td width="1">:</td>
<td>
<strong>'.$kelx_smt.'</strong>
</td>
</tr>

<tr valign="top">
<td valign="top" width="200">
Jumlah Uang Yang Dibayar
</td>
<td width="1">:</td>
<td>
<strong>'.xduit2($ccx1_nilai).'</strong>
</td>
</tr>';

//jika SPI, punya minimal /////////////////////////////////////////////////////////////////////////////
if ($jnskd == "70b97c951b5dc2c3b26d50eefeea19cc")
	{
	//tanpa ada keterangan sisa
	}

//jika SS, punya batasan maksimal /////////////////////////////////////////////////////////////////////////////
else if ($jnskd == "f3b22b92155c4bc1ecb1b6db7dd56b91")
	{
	//tanpa ada keterangan sisa
	}
else
	{
	echo '<tr valign="top">
	<td valign="top" width="200">
	Sisa
	</td>
	<td width="1">:</td>
	<td>
	<strong>'.xduit2($nil_sisa).'</strong>
	</td>
	</tr>';
	}


echo '</table>
<br>
<br>
<br>

<table width="500" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td valign="top" width="200" align="center">
</td>
<td valign="top" align="center">
<p>
<strong>'.$sek_kota.', '.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'</strong>
</p>
<p>
<strong>AK</strong>
<br>
<br>
<br>
<br>
<br>
(<strong>'.$nm11_session.'</strong>)
</p>
</td>
</tr>
<table>

<input name="jnskd" type="hidden" value="'.$jnskd.'">
<input name="progdi" type="hidden" value="'.$progdi.'">
<input name="kelkd" type="hidden" value="'.$kelkd.'">
<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
<input name="smtkd" type="hidden" value="'.$smtkd.'">
<input name="swkd" type="hidden" value="'.$cc_kd.'">
<input name="nim" type="hidden" value="'.$nim.'">
</td>
</tr>
</table>

<br>
<br>

</td>
</tr>
</table>
<i>Code : '.$today3.'</i>
</form>';
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