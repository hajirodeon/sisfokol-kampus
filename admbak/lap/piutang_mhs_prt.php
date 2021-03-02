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
require("../../inc/cek/admak.php");
$tpl = LoadTpl("../../template/window.html");

nocache;

//nilai
$filenya = "piutang_mhs.php";
$judul = "Lap. Piutang Mahasiswa";
$judulku = "[$bak_session : $nip11_session. $nm11_session] ==> $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&smtkd=$smtkd&page=$page";






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//re-direct print...
$ke = "piutang_mhs.php?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&smtkd=$smtkd&page=$page";
$diload = "window.print();location.href='$ke'";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//isi *START
ob_start();


//js
require("../../inc/js/swap.js");

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td valign="top" align="center">
<P>
<big>
<strong>LAPORAN PIUTANG MAHASISWA</strong>
</big>
</P>
<P>
<big>
<strong>'.$sek_nama.'</strong>
</big>
</P>

<hr height="1">
</td>
</tr>
</table>

<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="100"">
Tahun Akademik ';
//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '</td>
<td width="1">:</td>
<td width="100">
<strong>'.$tpx_thn1.'/'.$tpx_thn2.'</strong>
</td>
<td width="100"></td>
<td width="100">
Jenis';
//terpilih
$qbtx = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd = '$kelkd'");
$rowbtx = mysqli_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<td width="1">:</td>
<td width="100">
<strong>'.$btxkelas.'</strong>
</td>
</tr>

<tr>
<td width="100">
Program Studi';
//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);

echo '<td width="1">:</td>
<td width="100">
<strong>'.$tpx_nama.'</strong>
</td>
<td width="100"></td>
<td>
Semester';
//smt
$qstxy = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysqli_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);


echo '<td width="1">:</td>
<td width="100">
<strong>'.$smt.'</strong>
</td>
</tr>
</table>
<br>';


//query
$qdata = mysqli_query($koneksi, "SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
			"FROM m_mahasiswa, mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
			"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
			"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
			"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
			"ORDER BY round(m_mahasiswa.nim) ASC");
$rdata = mysqli_fetch_assoc($qdata);
$tdata = mysqli_num_rows($qdata);

//total sks ///////////////////////////////////////////////////////////////////////////////////
$qtokuy = mysqli_query($koneksi, "SELECT SUM(m_makul.sks) AS total ".
			"FROM mahasiswa_makul, m_makul, mahasiswa_kelas ".
			"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
			"AND mahasiswa_makul.kd_mahasiswa_kelas = mahasiswa_kelas.kd ".
			"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
			"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
			"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
			"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
			"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
			"AND mahasiswa_makul.kd_smt = '$smtkd'");
$rtokuy = mysqli_fetch_assoc($qtokuy);
$tokuy_total = nosql($rtokuy['total']);

//harga sks
$qktiy = mysqli_query($koneksi, "SELECT m_keu.*, m_keu_jenis.*, m_keu_jenis.kd AS jkd ".
			"FROM m_keu, m_keu_jenis ".
			"WHERE m_keu.kd_jenis = m_keu_jenis.kd ".
			"AND m_keu_jenis.kd = 'b7456a463a7b0c1c9a3ece4b30c6db4a' ".
			"AND m_keu.kd_progdi = '$progdi' ".
			"AND m_keu.kd_kelas = '$kelkd' ".
			"AND m_keu.kd_tapel = '$tapelkd' ".
			"AND m_keu.kd_smt = '$smtkd'");
$rktiy = mysqli_fetch_assoc($qktiy);
$ktiy_harga = nosql($rktiy['biaya']);


//total telah dibayar /////////////////////////////////////////////////////////////////////////
$qccy = mysqli_query($koneksi, "SELECT SUM(nilai) AS total FROM mahasiswa_keu ".
			"WHERE kd_progdi = '$progdi' ".
			"AND kd_kelas = '$kelkd' ".
			"AND kd_tapel = '$tapelkd' ".
			"AND kd_smt = '$smtkd'");
$rccy = mysqli_fetch_assoc($qccy);
$ccy_total = nosql($rccy['total']);


//biaya lain //////////////////////////////////////////////////////////////////////////////////
$qktiy2 = mysqli_query($koneksi, "SELECT SUM(biaya) AS total ".
			"FROM m_keu, m_keu_jenis ".
			"WHERE m_keu.kd_jenis = m_keu_jenis.kd ".
			"AND m_keu_jenis.kd <> 'b7456a463a7b0c1c9a3ece4b30c6db4a' ".
			"AND m_keu.kd_progdi = '$progdi' ".
			"AND m_keu.kd_kelas = '$kelkd' ".
			"AND m_keu.kd_tapel = '$tapelkd' ".
			"AND m_keu.kd_smt = '$smtkd'");
$rktiy2 = mysqli_fetch_assoc($qktiy2);
$ktiy2_total = nosql($rktiy2['total']);

$tobiaya = round(($tokuy_total*$ktiy_harga)+($ktiy2_total*$tdata));
$toterbayar = $ccy_total;
$topiutang = round($tobiaya - $toterbayar);

echo '<p>
Total Biaya : <strong>'.xduit2($tobiaya).'</strong>,
Total Terbayar : <strong>'.xduit2($ccy_total).'</strong>,
Total Piutang : <strong>'.xduit2($topiutang).'</strong>

</p>
<p>';

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
	$i_nim = nosql($rdata['nim']);


	//detail
	$qdt = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
				"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
				"AND m_mahasiswa.nim = '$i_nim'");
	$rdt = mysqli_fetch_assoc($qdt);
	$dt_kd = nosql($rdt['mskd']);
	$dt_mkkd = nosql($rdt['mkkd']);
	$dt_nama = balikin($rdt['nama']);
	$i_kd = $dt_kd;
	$i_mkkd = $dt_mkkd;
	$i_nama = $dt_nama;



	echo '<p>
	<strong>'.$i_nim.'. '.$i_nama.'</strong>
	<br>
	<table width="800" border="1" cellpadding="3" cellspacing="0">
	<tr bgcolor="'.$warnaheader.'">
	<td align="center"><strong>Jenis Keuangan</strong></td>
	<td width="150" align="center"><strong>Jml.Biaya</strong></td>
	<td width="150" align="center"><strong>Terbayar</strong></td>
	<td width="100" align="center"><strong>Tgl.Bayar</strong></td>
	<td width="150" align="center"><strong>Piutang</strong></td>
	</tr>';

	//daftar jenis uang
	$qkti = mysqli_query($koneksi, "SELECT m_keu.*, m_keu_jenis.*, m_keu_jenis.kd AS jkd ".
				"FROM m_keu, m_keu_jenis ".
				"WHERE m_keu.kd_jenis = m_keu_jenis.kd ".
				"AND m_keu.kd_progdi = '$progdi' ".
				"AND m_keu.kd_kelas = '$kelkd' ".
				"AND m_keu.kd_tapel = '$tapelkd' ".
				"AND m_keu.kd_smt = '$smtkd'");
	$rkti = mysqli_fetch_assoc($qkti);

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

		$kti_kd = nosql($rkti['jkd']);
		$kti_nama = balikin($rkti['nama']);
		$kti_biaya = nosql($rkti['biaya']);



		//jika SKS, dikalikan dengan jumlah SKS yang diambil //////////////////////////
		if ($kti_kd == "b7456a463a7b0c1c9a3ece4b30c6db4a")
			{
			//ketahui jumlah SKS yang dimiliki, agar tahu total pembayarannya.
			//detail
			$qdtku = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
						"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND m_mahasiswa.kd = '$dt_kd'");
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


			//yang telah dibayar
			$qccx = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai FROM mahasiswa_keu ".
						"WHERE kd_jenis = '$kti_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_mahasiswa = '$dt_kd'");
			$rccx = mysqli_fetch_assoc($qccx);
			$ccxx_nilai = nosql($rccx['nilai']);

			//total biaya
			$ktix_biaya = round($toku_total*$kti_biaya);

			//yang telah dibayar
			$ccx_nilai = $ccxx_nilai;


			//tgl.bayar
			$qccx2 = mysqli_query($koneksi, "SELECT * FROM mahasiswa_keu ".
						"WHERE kd_jenis = '$kti_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_mahasiswa = '$dt_kd'");
			$rccx2 = mysqli_fetch_assoc($qccx2);
			$ccx2_tgl_bayar = $rccx2['tgl_bayar'];


			//jika null
			if (empty($ccx2_tgl_bayar))
				{
				$ccx2_tgl_bayar = "-";
				}


			//sisa piutang
			$ccx_piutang = round(($toku_total*$kti_biaya) - $ccx_nilai);
			}
		else
			{
			//total biaya
			$ktix_biaya = $kti_biaya;

			//yang telah dibayar
			$qccx = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai FROM mahasiswa_keu ".
						"WHERE kd_jenis = '$kti_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_mahasiswa = '$dt_kd'");
			$rccx = mysqli_fetch_assoc($qccx);
			$ccx_nilai = nosql($rccx['nilai']);

			//tgl.bayar
			$qccx2 = mysqli_query($koneksi, "SELECT * FROM mahasiswa_keu ".
						"WHERE kd_jenis = '$kti_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_mahasiswa = '$dt_kd'");
			$rccx2 = mysqli_fetch_assoc($qccx2);
			$ccx2_tgl_bayar = $rccx2['tgl_bayar'];


			//jika null
			if (empty($ccx2_tgl_bayar))
				{
				$ccx2_tgl_bayar = "-";
				}


			//sisa piutang
			$ccx_piutang = round($kti_biaya - $ccx_nilai);
			}





		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$kti_nama.'</td>
		<td align="right">';

		//jika null
		if (empty($ktix_biaya))
			{
			echo "-";
			}
		else
			{
			echo xduit2($ktix_biaya);
			}

		echo '</td>
		<td align="right">';

		//jika null
		if (empty($ccx_nilai))
			{
			echo "-";
			}
		else
			{
			echo xduit2($ccx_nilai);
			}

		echo '</td>
		<td align="right">'.$ccx2_tgl_bayar.'</td>
		<td align="right">';

		//jika null
		if (empty($ccx_piutang))
			{
			echo "-";
			}
		else
			{
			echo xduit2($ccx_piutang);
			}

		echo '</td>
		</tr>';
		}
	while ($rkti = mysqli_fetch_assoc($qkti));


	//jumlah SKS yang diambil //////////////////////////
	//ketahui jumlah SKS yang dimiliki, agar tahu total pembayarannya.
	//detail
	$qdtku = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
				"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND m_mahasiswa.kd = '$dt_kd'");
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


	//yang telah dibayar
	$qccx2 = mysqli_query($koneksi, "SELECT SUM(nilai) AS total FROM mahasiswa_keu ".
				"WHERE kd_jenis = 'b7456a463a7b0c1c9a3ece4b30c6db4a' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$dt_kd'");
	$rccx2 = mysqli_fetch_assoc($qccx2);
	$ccxx2_nilai = nosql($rccx2['total']);

	//total biaya
	$ktix_biaya = round(($toku_total-1)*$kti_biaya);



	//jumlah semuanya
	$qccx4 = mysqli_query($koneksi, "SELECT SUM(biaya) AS total ".
				"FROM m_keu, m_keu_jenis ".
				"WHERE m_keu.kd_jenis = m_keu_jenis.kd ".
				"AND m_keu.kd_progdi = '$progdi' ".
				"AND m_keu.kd_kelas = '$kelkd' ".
				"AND m_keu.kd_tapel = '$tapelkd' ".
				"AND m_keu.kd_smt = '$smtkd'");
	$rccx4 = mysqli_fetch_assoc($qccx4);
	$ccx4_total = nosql($rccx4['total']);


	//jumlah terbayar
	$qccx41 = mysqli_query($koneksi, "SELECT SUM(mahasiswa_keu.nilai) AS total ".
				"FROM mahasiswa_keu, m_keu_jenis ".
				"WHERE mahasiswa_keu.kd_jenis = m_keu_jenis.kd ".
				"AND mahasiswa_keu.kd_progdi = '$progdi' ".
				"AND mahasiswa_keu.kd_kelas = '$kelkd' ".
				"AND mahasiswa_keu.kd_tapel = '$tapelkd' ".
				"AND mahasiswa_keu.kd_smt = '$smtkd' ".
				"AND mahasiswa_keu.kd_mahasiswa = '$dt_kd'");
	$rccx41 = mysqli_fetch_assoc($qccx41);
	$ccx41_total = nosql($rccx41['total']);


	//sisa piutang
	$sisa_piutang = round(($ccx4_total+$ktix_biaya) - ($ccx41_total));

	echo '<tr bgcolor="'.$warnaheader.'">
	<td>&nbsp;</td>
	<td align="right"><strong>'.xduit2($ccx4_total+$ktix_biaya).'</strong></td>
	<td align="right"><strong>'.xduit2($ccx41_total).'</strong></td>
	<td>-</td>
	<td align="right"><strong>'.xduit2($sisa_piutang).'</strong></td>
	</tr>
	</table>
	</p>';
	}
while ($rdata = mysqli_fetch_assoc($qdata));

echo '</p>';
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