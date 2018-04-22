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
$filenya = "piutang_mhs.php";
$judul = "Lap. Piutang Mahasiswa";
$judulku = "$judul  [$drk_session : $nip1_session. $nm1_session]";
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




//focus...
if (empty($tapelkd))
	{
	$diload = "document.formx.tapel.focus();";
	}
else if (empty($progdi))
	{
	$diload = "document.formx.progdi.focus();";
	}
else if (empty($kelkd))
	{
	$diload = "document.formx.kelas.focus();";
	}
else if (empty($smtkd))
	{
	$diload = "document.formx.smt.focus();";
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
						"ORDER BY tahun1 DESC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?jnskd='.$jnskd.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>,


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

	echo '<option value="'.$filenya.'?jnskd='.$jnskd.'&tapelkd='.$tapelkd.'&progdi='.$tpkd.'">'.$tpnama.'</option>';
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

	echo '<option value="'.$filenya.'?jnskd='.$jnskd.'&tapelkd='.$tapelkd.'&progdi='.$progdi.'&kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysql_fetch_assoc($qbt));

echo '</select>,


Semester : ';
echo "<select name=\"smt\" onChange=\"MM_jumpMenu('self',this,0)\">";

//smt
$qstxy = mysql_query("SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysql_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);


echo '<option value="'.$smtkd.'" selected>'.$smt.'</option>';

$qst = mysql_query("SELECT * FROM m_smt ".
			"WHERE kd <> '$smtkd'");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$stkd = nosql($rowst['kd']);
	$stsmt = nosql($rowst['smt']);

	echo '<option value="'.$filenya.'?jnskd='.$jnskd.'&tapelkd='.$tapelkd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&smtkd='.$stkd.'">'.$stsmt.'</option>';
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>
</td>
</tr>
</table>
<br>';


//nek blm dipilih
if (empty($tapelkd))
	{
	echo '<font color="#FF0000"><strong>TAHUN AKADEMIK Belum Dipilih...!</strong></font>';
	}
else if (empty($progdi))
	{
	echo '<font color="#FF0000"><strong>PROGRAM STUDI Belum Dipilih...!</strong></font>';
	}
else if (empty($kelkd))
	{
	echo '<font color="#FF0000"><strong>JENIS Belum Dipilih...!</strong></font>';
	}
else if (empty($smtkd))
	{
	echo '<font color="#FF0000"><strong>SEMESTER Belum Dipilih...!</strong></font>';
	}
else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
			"FROM m_mahasiswa, mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
			"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
			"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
			"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
			"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;


	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?jnskd=$jnskd&progdi=$progdi&tapelkd=$tapelkd&kelkd=$kelkd&smtkd=$smtkd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);


	//nek ada
	if ($count != 0)
		{
		//total sks ///////////////////////////////////////////////////////////////////////////////////
		$qtokuy = mysql_query("SELECT SUM(m_makul.sks) AS total ".
					"FROM mahasiswa_makul, m_makul, mahasiswa_kelas ".
					"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
					"AND mahasiswa_makul.kd_mahasiswa_kelas = mahasiswa_kelas.kd ".
					"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
					"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
					"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
					"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
					"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
					"AND mahasiswa_makul.kd_smt = '$smtkd'");
		$rtokuy = mysql_fetch_assoc($qtokuy);
		$tokuy_total = nosql($rtokuy['total']);

		//harga sks
		$qktiy = mysql_query("SELECT m_keu.*, m_keu_jenis.*, m_keu_jenis.kd AS jkd ".
					"FROM m_keu, m_keu_jenis ".
					"WHERE m_keu.kd_jenis = m_keu_jenis.kd ".
					"AND m_keu_jenis.kd = 'b7456a463a7b0c1c9a3ece4b30c6db4a' ".
					"AND m_keu.kd_progdi = '$progdi' ".
					"AND m_keu.kd_kelas = '$kelkd' ".
					"AND m_keu.kd_tapel = '$tapelkd' ".
					"AND m_keu.kd_smt = '$smtkd'");
		$rktiy = mysql_fetch_assoc($qktiy);
		$ktiy_harga = nosql($rktiy['biaya']);


		//total telah dibayar /////////////////////////////////////////////////////////////////////////
		$qccy = mysql_query("SELECT SUM(nilai) AS total FROM mahasiswa_keu ".
					"WHERE kd_progdi = '$progdi' ".
					"AND kd_kelas = '$kelkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd'");
		$rccy = mysql_fetch_assoc($qccy);
		$ccy_total = nosql($rccy['total']);


		//biaya lain //////////////////////////////////////////////////////////////////////////////////
		$qktiy2 = mysql_query("SELECT SUM(biaya) AS total ".
					"FROM m_keu, m_keu_jenis ".
					"WHERE m_keu.kd_jenis = m_keu_jenis.kd ".
					"AND m_keu_jenis.kd <> 'b7456a463a7b0c1c9a3ece4b30c6db4a' ".
					"AND m_keu.kd_progdi = '$progdi' ".
					"AND m_keu.kd_kelas = '$kelkd' ".
					"AND m_keu.kd_tapel = '$tapelkd' ".
					"AND m_keu.kd_smt = '$smtkd'");
		$rktiy2 = mysql_fetch_assoc($qktiy2);
		$ktiy2_total = nosql($rktiy2['total']);

		$tobiaya = round(($tokuy_total*$ktiy_harga)+($ktiy2_total*$count));
		$toterbayar = $ccy_total;
		$topiutang = round($tobiaya - $toterbayar);

		echo '<p>
		Total Biaya : <strong>'.xduit2($tobiaya).'</strong>,
		Total Terbayar : <strong>'.xduit2($ccy_total).'</strong>,
		Total Piutang : <strong>'.xduit2($topiutang).'</strong>

		</p>
		<p>
		[<a href="piutang_mhs_prt.php?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&smtkd='.$smtkd.'"><img src="'.$sumber.'/img/print.gif" border="0" width="16" height="16"></a>]';

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
			$qdt = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
						"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
						"AND m_mahasiswa.nim = '$i_nim'");
			$rdt = mysql_fetch_assoc($qdt);
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
			$qkti = mysql_query("SELECT m_keu.*, m_keu_jenis.*, m_keu_jenis.kd AS jkd ".
						"FROM m_keu, m_keu_jenis ".
						"WHERE m_keu.kd_jenis = m_keu_jenis.kd ".
						"AND m_keu.kd_progdi = '$progdi' ".
						"AND m_keu.kd_kelas = '$kelkd' ".
						"AND m_keu.kd_tapel = '$tapelkd' ".
						"AND m_keu.kd_smt = '$smtkd'");
			$rkti = mysql_fetch_assoc($qkti);

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
					$qdtku = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
								"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
								"FROM m_mahasiswa, mahasiswa_kelas ".
								"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
								"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
								"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
								"AND m_mahasiswa.kd = '$dt_kd'");
					$rdtku = mysql_fetch_assoc($qdtku);
					$dtku_mkkd = nosql($rdtku['mkkd']);

					//total sks
					$qtoku = mysql_query("SELECT SUM(m_makul.sks) AS total ".
								"FROM mahasiswa_makul, m_makul ".
								"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
								"AND mahasiswa_makul.kd_mahasiswa_kelas = '$dtku_mkkd' ".
								"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
								"AND mahasiswa_makul.kd_smt = '$smtkd'");
					$rtoku = mysql_fetch_assoc($qtoku);
					$toku_total = nosql($rtoku['total']);


					//yang telah dibayar
					$qccx = mysql_query("SELECT SUM(nilai) AS nilai FROM mahasiswa_keu ".
								"WHERE kd_jenis = '$kti_kd' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_mahasiswa = '$dt_kd'");
					$rccx = mysql_fetch_assoc($qccx);
					$ccxx_nilai = nosql($rccx['nilai']);

					//total biaya
					$ktix_biaya = round($toku_total*$kti_biaya);

					//yang telah dibayar
					$ccx_nilai = $ccxx_nilai;


					//tgl.bayar
					$qccx2 = mysql_query("SELECT * FROM mahasiswa_keu ".
								"WHERE kd_jenis = '$kti_kd' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_mahasiswa = '$dt_kd'");
					$rccx2 = mysql_fetch_assoc($qccx2);
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
					$qccx = mysql_query("SELECT SUM(nilai) AS nilai FROM mahasiswa_keu ".
								"WHERE kd_jenis = '$kti_kd' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_mahasiswa = '$dt_kd'");
					$rccx = mysql_fetch_assoc($qccx);
					$ccx_nilai = nosql($rccx['nilai']);

					//tgl.bayar
					$qccx2 = mysql_query("SELECT * FROM mahasiswa_keu ".
								"WHERE kd_jenis = '$kti_kd' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_mahasiswa = '$dt_kd'");
					$rccx2 = mysql_fetch_assoc($qccx2);
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
			while ($rkti = mysql_fetch_assoc($qkti));


			//jumlah SKS yang diambil //////////////////////////
			//ketahui jumlah SKS yang dimiliki, agar tahu total pembayarannya.
			//detail
			$qdtku = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
						"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND m_mahasiswa.kd = '$dt_kd'");
			$rdtku = mysql_fetch_assoc($qdtku);
			$dtku_mkkd = nosql($rdtku['mkkd']);

			//total sks
			$qtoku = mysql_query("SELECT SUM(m_makul.sks) AS total ".
						"FROM mahasiswa_makul, m_makul ".
						"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
						"AND mahasiswa_makul.kd_mahasiswa_kelas = '$dtku_mkkd' ".
						"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_makul.kd_smt = '$smtkd'");
			$rtoku = mysql_fetch_assoc($qtoku);
			$toku_total = nosql($rtoku['total']);


			//yang telah dibayar
			$qccx2 = mysql_query("SELECT SUM(nilai) AS total FROM mahasiswa_keu ".
						"WHERE kd_jenis = 'b7456a463a7b0c1c9a3ece4b30c6db4a' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_mahasiswa = '$dt_kd'");
			$rccx2 = mysql_fetch_assoc($qccx2);
			$ccxx2_nilai = nosql($rccx2['total']);

			//total biaya
			$ktix_biaya = round(($toku_total-1)*$kti_biaya);



			//jumlah semuanya
			$qccx4 = mysql_query("SELECT SUM(biaya) AS total ".
						"FROM m_keu, m_keu_jenis ".
						"WHERE m_keu.kd_jenis = m_keu_jenis.kd ".
						"AND m_keu.kd_progdi = '$progdi' ".
						"AND m_keu.kd_kelas = '$kelkd' ".
						"AND m_keu.kd_tapel = '$tapelkd' ".
						"AND m_keu.kd_smt = '$smtkd'");
			$rccx4 = mysql_fetch_assoc($qccx4);
			$ccx4_total = nosql($rccx4['total']);


			//jumlah terbayar
			$qccx41 = mysql_query("SELECT SUM(mahasiswa_keu.nilai) AS total ".
						"FROM mahasiswa_keu, m_keu_jenis ".
						"WHERE mahasiswa_keu.kd_jenis = m_keu_jenis.kd ".
						"AND mahasiswa_keu.kd_progdi = '$progdi' ".
						"AND mahasiswa_keu.kd_kelas = '$kelkd' ".
						"AND mahasiswa_keu.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_keu.kd_smt = '$smtkd' ".
						"AND mahasiswa_keu.kd_mahasiswa = '$dt_kd'");
			$rccx41 = mysql_fetch_assoc($qccx41);
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
		while ($data = mysql_fetch_assoc($result));

		echo '</p>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>Tidak Ada Data</strong>
		</font>
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