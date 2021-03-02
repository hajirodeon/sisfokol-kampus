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
$filenya = "mhs_kartu_ujian.php";
$judul = "Kartu Ujian";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$jnskd = nosql($_REQUEST['jnskd']);
$smtkd = nosql($_REQUEST['smtkd']);
$rukd = nosql($_REQUEST['rukd']);

$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&jnskd=$jnskd&smtkd=$smtkd&page=$page";







//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//re-direct print...
$ke = "mhs_kartu_ujian.php?s=tempat&progdi=$progdi&kelkd=$kelkd&jnskd=$jnskd&smtkd=$smtkd&tapelkd=$tapelkd";
$diload = "window.print();location.href='$ke'";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();






//data mahasiswa
$qku = mysqli_query($koneksi, "SELECT ku_mahasiswa.*, m_mahasiswa.*, m_mahasiswa.kd AS mskd ".
			"FROM ku_mahasiswa, m_mahasiswa ".
			"WHERE ku_mahasiswa.kd_mahasiswa = m_mahasiswa.kd ".
			"AND ku_mahasiswa.kd_progdi = '$progdi' ".
			"AND ku_mahasiswa.kd_kelas = '$kelkd' ".
			"AND ku_mahasiswa.kd_tapel = '$tapelkd' ".
			"AND ku_mahasiswa.jenis = '$jnskd' ".
			"AND ku_mahasiswa.kd_smt = '$smtkd' ".
			"AND ku_mahasiswa.kd_ruang = '$rukd'");
$rku = mysqli_fetch_assoc($qku);


do
	{
	//nilainya
	$ku_mskd = nosql($rku['mskd']);


	//detail mahasiswa
	$qdt = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
				"WHERE kd = '$ku_mskd'");
	$rdt = mysqli_fetch_assoc($qdt);
	$dt_nama = balikin($rdt['nama']);


	//progdi
	$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
				"WHERE kd = '$progdi'");
	$rowtpx = mysqli_fetch_assoc($qtpx);
	$tpx_nama = balikin($rowtpx['nama']);



	//ruang e
	$qjumx = mysqli_query($koneksi, "SELECT ku_mahasiswa.*, m_ruang.* ".
				"FROM ku_mahasiswa, m_ruang ".
				"WHERE ku_mahasiswa.kd_ruang = m_ruang.kd ".
				"AND ku_mahasiswa.kd_progdi = '$progdi' ".
				"AND ku_mahasiswa.kd_kelas = '$kelkd' ".
				"AND ku_mahasiswa.kd_tapel = '$tapelkd' ".
				"AND ku_mahasiswa.jenis = '$jnskd' ".
				"AND ku_mahasiswa.kd_smt = '$smtkd' ".
				"AND ku_mahasiswa.kd_mahasiswa = '$ku_mskd'");
	$rjumx = mysqli_fetch_assoc($qjumx);
	$tjumx = mysqli_num_rows($qjumx);
	$jumx_ruang = balikin($rjumx['ruang']);
	$jumx_noujian = balikin($rjumx['no_ujian']);





	//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
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

	<table width="100%" border="1" cellspacing="0" cellpadding="3">
	<tr>
	<td width="100">
	NAMA
	<td width="150">
	: '.$dt_nama.'
	</td>
	<td width="150">
	PROGRAM STUDI
	</td>
	<td>
	: '.$tpx_nama.'
	</td>
	</tr>
	<tr>
	<td width="100">
	NO.UJIAN
	<td width="150">
	: '.$jumx_noujian.'
	</td>
	<td width="150">
	RUANG
	</td>
	<td>
	: '.$jumx_ruang.'
	</td>
	</tr>
	</table>


	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td align="center">
	<p>
	<big>
	<strong>KARTU UJIAN</strong>
	</big>
	</p>
	</td>
	</tr>
	</table>';



	//daftar makul-nya
	$qkulo = mysqli_query($koneksi, "SELECT m_makul_smt.*, m_makul_smt.kd AS mskd, ".
				"m_makul.*, m_makul.kd AS mkkd ".
				"FROM m_makul_smt, m_makul ".
				"WHERE m_makul_smt.kd_makul = m_makul.kd ".
				"AND m_makul.kd_progdi = '$progdi' ".
				"AND m_makul_smt.kd_tapel = '$tapelkd' ".
				"AND m_makul_smt.kd_smt = '$smtkd'");
	$rkulo = mysqli_fetch_assoc($qkulo);
	$tkulo = mysqli_num_rows($qkulo);

	echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="100"><strong><font color="'.$warnatext.'">Hari/Tanggal</font></strong></td>
	<td width="100"><strong><font color="'.$warnatext.'">Waktu</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Mata Ujian</font></strong></td>
	<td width="100"><strong><font color="'.$warnatext.'">Paraf</font></strong></td>
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
		$kulo_mskd = nosql($rkulo['mskd']);
		$kulo_mkkd = nosql($rkulo['mkkd']);
		$kulo_nama = balikin($rkulo['nama']);



		//detail tanggal dan waktu ujian
		$qdt = mysqli_query($koneksi, "SELECT ku.*, DATE_FORMAT(tgl_uji, '%d') AS tgl, ".
					"DATE_FORMAT(tgl_uji, '%m') AS bln, ".
					"DATE_FORMAT(tgl_uji, '%Y') AS thn, ".
					"DATE_FORMAT(jam1, '%H') AS jam1, ".
					"DATE_FORMAT(jam1, '%i') AS mnt1, ".
					"DATE_FORMAT(jam2, '%H') AS jam2, ".
					"DATE_FORMAT(jam2, '%i') AS mnt2 ".
					"FROM ku ".
					"WHERE kd_progdi = '$progdi' ".
					"AND kd_kelas = '$kelkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd' ".
					"AND kd_makul = '$kulo_mkkd'");
		$rdt = mysqli_fetch_assoc($qdt);
		$tdt = mysqli_num_rows($qdt);
		$dt_kd = nosql($rdt['kd']);
		$dt_uji_tgl = nosql($rdt['tgl']);
		$dt_uji_bln = nosql($rdt['bln']);
		$dt_uji_thn = nosql($rdt['thn']);
		$dt_tgl_uji = "$dt_uji_tgl-$dt_uji_bln-$dt_uji_thn";
		$dt_jam1 = nosql($rdt['jam1']);
		$dt_mnt1 = nosql($rdt['mnt1']);
		$dt_jam2 = nosql($rdt['jam2']);
		$dt_mnt2 = nosql($rdt['mnt2']);




		//ketahui harinya /////////////////////////////////////////////////////////////
		//jika gak null
		if ((!empty($dt_uji_tgl)) AND (!empty($dt_uji_bln)) AND (!empty($dt_uji_thn)))
			{
			$day = $dt_uji_tgl;
			$month = $dt_uji_bln;
			$year = $dt_uji_thn;


			//mencari hari
			$a = substr($year, 2);
				//mengambil dua digit terakhir tahun

			$b = (int)($a/4);
				//membagi tahun dengan 4 tanpa memperhitungkan sisa

			$c = $month;
				//mengambil angka bulan

			$d = $day;
				//mengambil tanggal

			$tot1 = $a + $b + $c + $d;
				//jumlah sementara, sebelum dikurangani dengan angka kunci bulan

			//kunci bulanan
			if ($c == 1)
				{
				$kunci = "2";
				}

			else if ($c == 2)
				{
				$kunci = "7";
				}

			else if ($c == 3)
				{
				$kunci = "1";
				}

			else if ($c == 4)
				{
				$kunci = "6";
				}

			else if ($c == 5)
				{
				$kunci = "5";
				}

			else if ($c == 6)
				{
				$kunci = "3";
				}

			else if ($c == 7)
				{
				$kunci = "2";
				}

			else if ($c == 8)
				{
				$kunci = "7";
				}

			else if ($c == 9)
				{
				$kunci = "5";
				}

			else if ($c == 10)
				{
				$kunci = "4";
				}

			else if ($c == 11)
				{
				$kunci = "2";
				}

			else if ($c == 12)
				{
				$kunci = "1";
				}

			$total = $tot1 - $kunci;

			//angka hari
			$hari = $total%7;

			//jika angka hari == 0, sebenarnya adalah 7.
			if ($hari == 0)
				{
				$hari = ($hari +7);
				}

			//kabisat, tahun habis dibagi empat alias tanpa sisa
			$kabisat = (int)$year % 4;

			if ($kabisat ==0)
				{
				$hri = $hri-1;
				}



			//hari ke-n
			if ($hari == 3)
				{
				$hri = 4;
				$dino = "Rabu";
				}

			else if ($hari == 4)
				{
				$hri = 5;
				$dino = "Kamis";
				}

			else if ($hari == 5)
				{
				$hri = 6;
				$dino = "Jum'at";
				}

			else if ($hari == 6)
				{
				$hri = 7;
				$dino = "Sabtu";
				}

			else if ($hari == 7)
				{
				$hri = 1;
				$dino = "Minggu";
				}

			else if ($hari == 1)
				{
				$hri = 2;
				$dino = "Senin";
				}

			else if ($hari == 2)
				{
				$hri = 3;
				$dino = "Selasa";
				}
			}
		else
			{
			$dino = "";
			}



		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		'.$dino.'
		<br>
		'.$dt_tgl_uji.'
		</td>
		<td>'.$dt_jam1.':'.$dt_mnt1.' - '.$dt_jam2.':'.$dt_mnt2.'</td>
		<td>'.$kulo_nama.'</td>
		<td>&nbsp;</td>
		</tr>';
		}
	while ($rkulo = mysqli_fetch_assoc($qkulo));


	echo '</table>
	<em>Selama Ujian Berlangsung, Kartu Ujian Harus Dibawa</em>.


	<p>
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td align="center" width="400">
	</td>
	<td align="center">
	<strong>PANITIA UJIAN</strong>
	</td>
	</tr>
	</table>
	</p>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>';
	}
while ($rku = mysqli_fetch_assoc($qku));
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