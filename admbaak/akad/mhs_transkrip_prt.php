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
$tpl = LoadTpl("../../template/print.html");

nocache;

//nilai
$filenya = "mhs_transkrip.php";
$judul = "Transkrip Nilai Mahasiswa";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$rukd = nosql($_REQUEST['rukd']);
$mkkd = nosql($_REQUEST['mkkd']);
$kd = nosql($_REQUEST['kd']);
$kulkd = nosql($_REQUEST['kulkd']);
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//re-direct print...
$ke = "mhs_transkrip.php?s=lihat&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd";
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
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
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


<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td align="center">
<big>
<strong>DAFTAR NILAI SEMENTARA</strong>
</big>
</td>
</tr>
</table>


<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="15%">
Nama
</td>
<td width="35%">
: <strong>'.$ku_nama.'</strong>
</td>
<td width="15%">
Program Studi
</td>
<td width="35%">
: <strong>'.$tpx_nama.'</strong>
</td>
</tr>

<tr>
<td>
NIM
</td>
<td>
: <strong>'.$ku_nim.'</strong>
</td>
<td>
&nbsp;
</td>
<td>
&nbsp;
</td>
</tr>
</table>

<p>
<table width="800" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="1"><strong><font color="'.$warnatext.'">SMT</font></strong></td>
<td width="1"><strong><font color="'.$warnatext.'">No.</font></strong></td>
<td width="100"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
<td><strong><font color="'.$warnatext.'">Nama Mata Kuliah</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">SKS</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Nilai Huruf</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Nilai Angka</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Nilai Mutu</font></strong></td>
</tr>';

$qst = mysqli_query($koneksi, "SELECT * FROM m_smt ".
					"ORDER BY round(no) ASC");
$rowst = mysqli_fetch_assoc($qst);

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


$stkd = nosql($rowst['kd']);
$stno = nosql($rowst['no']);
$stsmt = nosql($rowst['smt']);


//detail tapel
$qdtx = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
						"FROM mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd' ".
						"AND mahasiswa_kelas.kd_smt = '$stkd'");
$rdtx = mysqli_fetch_assoc($qdtx);
$tdtx = mysqli_num_rows($qdtx);

//nilai
$dtx_tapelkd = nosql($rdtx['kd_tapel']);
$dtx_mkkd = nosql($rdtx['mkkd']);


//tapel-nya
$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
						"WHERE kd = '$dtx_tapelkd'");
$rtpel = mysqli_fetch_assoc($qtpel);
$ttpel = mysqli_num_rows($qtpel);
$tpel_thn1 = nosql($rtpel['tahun1']);
$tpel_thn2 = nosql($rtpel['tahun2']);





//jika null, berikan tapel secara manual
if (empty($ttpel))
	{
	//ambil yg terakhir
	$qdtx2 = mysqli_query($koneksi, "SELECT m_tapel.* ".
							"FROM mahasiswa_kelas, m_tapel ".
							"WHERE mahasiswa_kelas.kd_tapel = m_tapel.kd ".
							"AND mahasiswa_kelas.kd_mahasiswa = '$kd' ".
							"AND mahasiswa_kelas.kd_smt = '$stkd' ".
							"ORDER BY m_tapel.tahun1 DESC");
	$rdtx2 = mysqli_fetch_assoc($qdtx2);
	$tdtx2 = mysqli_num_rows($qdtx2);
	$dtx_tapelkd = nosql($rdtx2['kd']);
	$tpel_thn1 = nosql($rdtx2['tahun1']);
	$tpel_thn2 = nosql($rdtx2['tahun2']);
	}




/*
			//daftar makul-nya
			$qkulo = mysqli_query($koneksi, "SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, ".
									"m_makul.*, m_makul.kd AS makul, m_makul_smt.sks AS ssks ".
									"FROM mahasiswa_makul, m_makul, m_makul_smt ".
									"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
									"AND m_makul_smt.kd_makul = m_makul.kd ".
									"AND m_makul_smt.kd_tapel = '$dtx_tapelkd' ".
									"AND mahasiswa_makul.kd_mahasiswa_kelas = '$dtx_mkkd' ".
									"AND mahasiswa_makul.kd_tapel = '$dtx_tapelkd' ".
									"AND mahasiswa_makul.kd_smt = '$stkd' ".
									"ORDER BY m_makul.kode ASC");
			$rkulo = mysqli_fetch_assoc($qkulo);
			$tkulo = mysqli_num_rows($qkulo);
*/



//daftar makul-nya
$qkulo = mysqli_query($koneksi, "SELECT m_makul_smt.sks AS ssks, ".
						"m_makul_smt.kd AS mskd, ".
						"m_makul.*, m_makul.kd AS mkkd ".
						"FROM m_makul_smt, m_makul ".
						"WHERE m_makul_smt.kd_makul = m_makul.kd ".
						"AND m_makul.kd_progdi = '$progdi' ".
						"AND m_makul_smt.kd_tapel = '$dtx_tapelkd' ".
						"AND m_makul_smt.kd_smt = '$stkd' ".
						"ORDER BY m_makul.kode ASC");
$rkulo = mysqli_fetch_assoc($qkulo);
$tkulo = mysqli_num_rows($qkulo);




//jika null, berikan satu
if (empty($tkulo))
	{
	$tkulo = "1";
	}

$tkulox = $tkulo + 1;


echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
echo '<td ROWSPAN='.$tkulox.'>'.$stsmt.'</td>
</tr>';


do
	{
	//nilai
	if ($warna_set2 ==0)
		{
		$warna2 = $warna01;
		$warna_set2 = 1;
		}
	else
		{
		$warna2 = $warna02;
		$warna_set2 = 0;
		}

	$i_nomer = $i_nomer + 1;
	$kulo_kulkd = nosql($rkulo['mkkd']);
	$kulo_makul = nosql($rkulo['mkkd']);
	$kulo_kode = nosql($rkulo['kode']);
	$kulo_nama = balikin($rkulo['nama']);
	$kulo_sks = nosql($rkulo['ssks']);



	//cek table transkrip
	$qkuu = mysqli_query($koneksi, "SELECT * FROM mahasiswa_transkrip ".
							"WHERE kd_mahasiswa = '$kd' ".
							"AND kd_tapel = '$dtx_tapelkd' ".
							"AND kd_smt = '$stkd' ".
							"AND kd_makul = '$kulo_makul'");
	$rkuu = mysqli_fetch_assoc($qkuu);				
	$kulo_sks = nosql($rkuu['sks']);				
	$nil_huruf = nosql($rkuu['nil_huruf']);		
	$nil_angka = nosql($rkuu['nil_angka']);		
	$nil_mutu = nosql($rkuu['nil_mutu']);
		
		

	echo "<tr valign=\"top\" bgcolor=\"$warna2\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna2';\">";
	echo '<td>'.$i_nomer.'.</td>
	<td>'.$kulo_kode.'</td>
	<td>'.$kulo_nama.'</td>
	<td>'.$kulo_sks.'</td>
	<td>'.$nil_huruf.'</td>
	<td>'.$nil_angka.'</td>
	<td>'.$nil_mutu.'</td>
	</tr>';
		}
	while ($rkulo = mysqli_fetch_assoc($qkulo));




	}
while ($rowst = mysqli_fetch_assoc($qst));



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





//tgl.pengesahan
$qsahi = mysqli_query($koneksi, "SELECT DATE_FORMAT(mahasiswa_nilai.tgl_sah_transkrip, '%d') AS atgl, ".
						"DATE_FORMAT(mahasiswa_nilai.tgl_sah_transkrip, '%m') AS abln, ".
						"DATE_FORMAT(mahasiswa_nilai.tgl_sah_transkrip, '%Y') AS athn, ".
						"mahasiswa_nilai.* ".
						"FROM mahasiswa_nilai ".
						"WHERE kd_mahasiswa_kelas = '$mkkd'");
$rsahi = mysqli_fetch_assoc($qsahi);
$atgl = nosql($rsahi['atgl']);
$abln = nosql($rsahi['abln']);
$athn = nosql($rsahi['athn']);

echo '<tr bgcolor="'.$warnaheader.'">
<td width="1">&nbsp;</td>
<td width="1">&nbsp;</td>
<td width="100">&nbsp;</td>
<td align="right"><strong>JUMLAH</strong></td>
<td width="50"><strong>'.$toku3_total.'</strong></td>
<td width="50">-</td>
<td width="50">-</td>
<td width="50"><strong>'.$toku23_total.'</strong></td>
</tr>
<tr bgcolor="'.$warnaheader.'">
<td width="1">&nbsp;</td>
<td width="1">&nbsp;</td>
<td width="100">&nbsp;</td>
<td align="right"><strong>IPK</strong></td>
<td width="50"><strong>'.$nil_ipk.'</strong></td>
<td width="50">-</td>
<td width="50">-</td>
<td width="50">-</td>
</tr>
</table>
</p>

<p>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="33%" align="left">
<u><strong>Keterangan Nilai :</strong></u>
<br>
A = Sangat Baik.
<br>
B = Baik.
<br>
C = Cukup.
<br>
D = Kurang.
<br>
E = Gagal.
</td>
<td align="center">
&nbsp;
</td>
<td width="33%" align="left">
'.$sek_kota.', '.$atgl.' '.$arrbln1[$abln].' '.$athn.'
<br>
Penanggung Jawab '.$tpx_nama.'
<br><br><br><br>
<u><strong>'.$tp2x_pegawai.'</strong></u>
<br>
<strong>'.$tp2x_nip.'</strong>
</td>
</tr>
</table>
</p>


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
xfree($qbw);
xclose($koneksi);
exit();
?>