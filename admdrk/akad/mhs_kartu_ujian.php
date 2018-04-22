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
$filenya = "mhs_kartu_ujian.php";
$judul = "Kartu Ujian";
$judulku = "[$drk_session : $nip1_session.$nm1_session]. $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$jnskd = nosql($_REQUEST['jnskd']);
$smtkd = nosql($_REQUEST['smtkd']);
$mskd = nosql($_REQUEST['mskd']);
$mkkd = nosql($_REQUEST['mkkd']);
$utgl = nosql($_REQUEST['utgl']);
$ubln = nosql($_REQUEST['ubln']);
$uthn = nosql($_REQUEST['uthn']);
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&jnskd=$jnskd&smtkd=$smtkd&page=$page";





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
else if (empty($jnskd))
	{
	$diload = "document.formx.jenis.focus();";
	}
else if (empty($smtkd))
	{
	$diload = "document.formx.smt.focus();";
	}





//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
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

	echo '<option value="'.$filenya.'?progdi='.$tpkd.'">'.$tpnama.'</option>';
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

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysql_fetch_assoc($qbt));

echo '</select>,


Tahun Akademik : ';
echo "<select name=\"tapel\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtpx = mysql_query("SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<option value="'.$tpx_kd.'" selected>'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysql_query("SELECT * FROM m_tapel ".
			"WHERE kd <> '$tapelkd' ".
			"ORDER BY tahun1 DESC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tp_kd = nosql($rowtp['kd']);
	$tp_thn1 = nosql($rowtp['tahun1']);
	$tp_thn2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tp_kd.'">'.$tp_thn1.'/'.$tp_thn2.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>,


Ujian : ';
echo "<select name=\"jenis\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$jnskd.'" selected>'.$jnskd.'</option>
<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&jnskd=UTS">UTS</option>
<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&jnskd=UAS">UAS</option>
</select>,


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

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&jnskd='.$jnskd.'&smtkd='.$stkd.'&tapelkd='.$tapelkd.'">'.$stsmt.'</option>';
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>
</td>
</tr>
</table>
<br>';


//nek blm dipilih
if (empty($progdi))
	{
	echo '<font color="#FF0000"><strong>PROGRAM STUDI Belum Dipilih...!</strong></font>';
	}
else if (empty($kelkd))
	{
	echo '<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>';
	}
else if (empty($tapelkd))
	{
	echo '<font color="#FF0000"><strong>TAHUN AKADEMIK Belum Dipilih...!</strong></font>';
	}
else if (empty($jnskd))
	{
	echo '<font color="#FF0000"><strong>JENIS UJIAN Belum Dipilih...!</strong></font>';
	}
else if (empty($smtkd))
	{
	echo '<font color="#FF0000"><strong>SEMESTER Belum Dipilih...!</strong></font>';
	}
else
	{
	//jika penempatan mahasiswa
	if ($s == "tempat")
		{
		echo '<p>
		<strong>Penempatan Ruang Ujian Mahasiswa</strong>.
		[<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&jnskd='.$jnskd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'">Daftar Mata Ujian</a>].
		</p>';


		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
				"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
				"ORDER BY round(m_mahasiswa.nim) ASC";
		$sqlresult = $sqlcount;


		$count = mysql_num_rows(mysql_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?s=tempat&jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&smtkd=$smtkd&tapelkd=$tapelkd";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysql_fetch_array($result);



		echo '<table width="500" border="1" cellpadding="3" cellspacing="0">
		<tr bgcolor="'.$warnaheader.'">
		<td width="50"><strong>NIM</strong></td>
		<td><strong>Nama</strong></td>
		<td width="50"><strong>Kelas</strong></td>
		<td width="100"><strong>No.Ujian</strong></td>
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
				$qdt = mysql_query("SELECT * FROM m_mahasiswa ".
							"WHERE nim = '$i_nim'");
				$rdt = mysql_fetch_assoc($qdt);
				$dt_kd = nosql($rdt['kd']);
				$dt_nama = balikin($rdt['nama']);
				$i_kd = $dt_kd;
				$i_nama = $dt_nama;


				//ruang e
				$qjumx = mysql_query("SELECT ku_mahasiswa.*, m_ruang.* ".
							"FROM ku_mahasiswa, m_ruang ".
							"WHERE ku_mahasiswa.kd_ruang = m_ruang.kd ".
							"AND ku_mahasiswa.kd_progdi = '$progdi' ".
							"AND ku_mahasiswa.kd_kelas = '$kelkd' ".
							"AND ku_mahasiswa.kd_tapel = '$tapelkd' ".
							"AND ku_mahasiswa.jenis = '$jnskd' ".
							"AND ku_mahasiswa.kd_smt = '$smtkd' ".
							"AND ku_mahasiswa.kd_mahasiswa = '$i_kd'");
				$rjumx = mysql_fetch_assoc($qjumx);
				$tjumx = mysql_num_rows($qjumx);
				$jumx_ruang = balikin($rjumx['ruang']);
				$jumx_noujian = balikin($rjumx['no_ujian']);


				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>'.$i_nim.'</td>
				<td>'.$i_nama.'</td>
				<td>'.$jumx_ruang.'</td>
				<td>'.$jumx_noujian.'</td>
				</tr>';
				}
			while ($data = mysql_fetch_assoc($result));
			}

		echo '</table>

		<table width="500" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td align="right">Total : <font color="#FF0000"><strong>'.$count.'</strong></font> Data. '.$pagelist.'</td>
		</tr>
		</tr>
		</table>';
		}

	//jika daftar makul
	else
		{
		//daftar makul-nya
		$qkulo = mysql_query("SELECT m_makul_smt.*, m_makul_smt.kd AS mskd, ".
					"m_makul.*, m_makul.kd AS mkkd ".
					"FROM m_makul_smt, m_makul ".
					"WHERE m_makul_smt.kd_makul = m_makul.kd ".
					"AND m_makul.kd_progdi = '$progdi' ".
					"AND m_makul_smt.kd_tapel = '$tapelkd' ".
					"AND m_makul_smt.kd_smt = '$smtkd'");
		$rkulo = mysql_fetch_assoc($qkulo);
		$tkulo = mysql_num_rows($qkulo);

		//jika ada
		if ($tkulo != 0)
			{
			echo '[<a href="'.$filenya.'?s=tempat&jnskd='.$jnskd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'" title="Penempatan Ruang Ujian Mahasiswa">Penempatan Ruang Ujian Mahasiswa</a>].
			<table width="700" border="1" cellspacing="0" cellpadding="3">
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
				$qdt = mysql_query("SELECT ku.*, DATE_FORMAT(tgl_uji, '%d') AS tgl, ".
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
				$rdt = mysql_fetch_assoc($qdt);
				$tdt = mysql_num_rows($qdt);
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
			while ($rkulo = mysql_fetch_assoc($qkulo));


			echo '</table>';
			}

		else
			{
			echo '<p>
			<font color="red">
			<strong>Tidak Ada Data Mata Kuliah</strong>.
			</font>
			</p>';
			}
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