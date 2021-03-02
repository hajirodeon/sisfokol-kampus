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
require("../../inc/cek/admmhs.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "transkrip.php";
$judul = "Transkrip Nilai";
$judulku = "[$mhs_session : $nim6_session. $nm6_session] ==> $judul";
$judulx = $judul;
$ke = $filenya;










//isi *START
ob_start();


//js
require("../../inc/js/swap.js");
require("../../inc/menu/admmhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">
<table width="800" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="1">SMT.</td>
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
	$stsmt = nosql($rowst['smt']);


	//detail tapel
	$qdtx = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
				"FROM mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd6_session' ".
				"AND mahasiswa_kelas.kd_smt = '$stkd'");
	$rdtx = mysqli_fetch_assoc($qdtx);
	$tdtx = mysqli_num_rows($qdtx);

	//jika ada, lihat tapel-nya
	if ($tdtx != 0)
		{
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

		}
	else
		{
		$dtx_tapelkd = "";
		$tpel_thn1 = "-";
		$tpel_thn2 = "-";
		}




/*
	//daftar makul-nya
	$qkulo = mysqli_query($koneksi, "SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, ".
				"m_makul.*, m_makul.kd AS makul ".
				"FROM mahasiswa_makul, m_makul ".
				"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
				"AND mahasiswa_makul.kd_mahasiswa_kelas = '$dtx_mkkd' ".
				"AND mahasiswa_makul.kd_tapel = '$dtx_tapelkd' ".
				"AND mahasiswa_makul.kd_smt = '$stkd'");
	$rkulo = mysqli_fetch_assoc($qkulo);
	$tkulo = mysqli_num_rows($qkulo);
*/


	//detail e
	$qdt = mysqli_query($koneksi, "SELECT mahasiswa_kelas.* ".
							"FROM m_mahasiswa, mahasiswa_kelas ".
							"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
							"AND mahasiswa_kelas.kd_mahasiswa = '$kd6_session'");
	$rdt = mysqli_fetch_assoc($qdt);
	$dt_progdi = nosql($rdt['kd_progdi']);


	//daftar makul-nya
	$qkulo = mysqli_query($koneksi, "SELECT m_makul_smt.sks AS ssks, ".
									"m_makul_smt.kd AS mskd, ".
									"m_makul.*, m_makul.kd AS mkkd ".
									"FROM m_makul_smt, m_makul ".
									"WHERE m_makul_smt.kd_makul = m_makul.kd ".
									"AND m_makul.kd_progdi = '$dt_progdi' ".
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
		$kulo_sks = nosql($rkulo['sks']);

		//nilai
		$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_nilai ".
					"WHERE kd_mahasiswa_kelas = '$dtx_mkkd' ".
					"AND kd_tapel = '$dtx_tapelkd' ".
					"AND kd_smt = '$stkd' ".
					"AND kd_makul = '$kulo_makul'");
		$rnil = mysqli_fetch_assoc($qnil);
		$nil_huruf = nosql($rnil['nil_akhir_huruf']);



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
				"WHERE kd_mahasiswa_kelas = '$dtx_mkkd' ".
				"AND kd_tapel = '$dtx_tapelkd' ".
				"AND kd_smt = '$stkd' ".
				"AND kd_makul = '$kulo_makul'");



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
$qtoku3 = mysqli_query($koneksi, "SELECT SUM(m_makul.sks) AS total ".
			"FROM mahasiswa_makul, m_makul, mahasiswa_kelas ".
			"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
			"AND mahasiswa_makul.kd_mahasiswa_kelas = mahasiswa_kelas.kd ".
			"AND mahasiswa_kelas.kd_mahasiswa = '$kd6_session' ".
			"AND mahasiswa_kelas.kd_tapel = mahasiswa_makul.kd_tapel ".
			"AND mahasiswa_kelas.kd_smt = mahasiswa_makul.kd_smt");
$rtoku3 = mysqli_fetch_assoc($qtoku3);
$toku3_total = nosql($rtoku3['total']);


//ipk : total nil_mutu ////////////////////////////////////////////////
$qtoku23 = mysqli_query($koneksi, "SELECT SUM(subtotal_mutu) AS total ".
			"FROM mahasiswa_nilai, mahasiswa_kelas, m_mahasiswa ".
			"WHERE mahasiswa_nilai.kd_mahasiswa_kelas = mahasiswa_kelas.kd ".
			"AND mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND m_mahasiswa.kd = '$kd6_session'");
$rtoku23 = mysqli_fetch_assoc($qtoku23);
$toku23_total = round(nosql($rtoku23['total']));


//total IPK
$nil_ipk = round($toku23_total/$toku3_total,2);


//tgl.pengesahan
$qsahi = mysqli_query($koneksi, "SELECT DATE_FORMAT(mahasiswa_nilai.tgl_sah_transkrip, '%d') AS atgl, ".
			"DATE_FORMAT(mahasiswa_nilai.tgl_sah_transkrip, '%m') AS abln, ".
			"DATE_FORMAT(mahasiswa_nilai.tgl_sah_transkrip, '%Y') AS athn, ".
			"mahasiswa_nilai.*, mahasiswa_kelas.*, m_mahasiswa.* ".
			"FROM mahasiswa_nilai, mahasiswa_kelas, m_mahasiswa ".
			"WHERE mahasiswa_nilai.kd_mahasiswa_kelas = mahasiswa_kelas.kd ".
			"AND mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND m_mahasiswa.kd = '$kd6_session'");
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
Tgl.Pengesahan :
<br>
<strong>'.$atgl.' '.$arrbln1[$abln].' '.$athn.'</strong>
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