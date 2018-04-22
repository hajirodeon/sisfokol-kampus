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
$filenya = "mhs_khs.php";
$judul = "KHS Mahasiswa";
$judulku = "[$drk_session : $nip1_session.$nm1_session]. $judul";
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

$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd&page=$page";




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
else if (empty($rukd))
	{
	$diload = "document.formx.ruang.focus();";
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

Kelas : ';
echo "<select name=\"ruang\" onChange=\"MM_jumpMenu('self',this,0)\">";

//ruang
$qstx = mysql_query("SELECT * FROM m_ruang ".
				"WHERE kd = '$rukd'");
$rowstx = mysql_fetch_assoc($qstx);
$ruang = nosql($rowstx['ruang']);

echo '<option value="'.$rukd.'" selected>'.$ruang.'</option>';

$qst = mysql_query("SELECT * FROM m_ruang ".
			"WHERE kd <> '$rukd'");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$stkd = nosql($rowst['kd']);
	$struang = balikin($rowst['ruang']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$stkd.'">'.$struang.'</option>';
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
	echo '<font color="#FF0000"><strong>JENIS Belum Dipilih...!</strong></font>';
	}

else if (empty($rukd))
	{
	echo '<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>';
	}
else
	{
	//jika daftar
	if (empty($s))
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
				"ORDER BY round(m_mahasiswa.nim) ASC";
		$sqlresult = $sqlcount;


		$count = mysql_num_rows(mysql_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?progdi=$progdi&tapelkd=$tapelkd&kelkd=$kelkd&rukd=$rukd";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysql_fetch_array($result);


		echo '<table width="400" border="1" cellpadding="3" cellspacing="0">
		<tr bgcolor="'.$warnaheader.'">
		<td width="50"><strong>NIM</strong></td>
		<td><strong>Nama</strong></td>
		<td width="1">&nbsp;</td>
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
				$qdt = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
							"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
							"FROM m_mahasiswa, mahasiswa_kelas ".
							"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
							"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
							"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
							"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
							"AND m_mahasiswa.nim = '$i_nim'");
				$rdt = mysql_fetch_assoc($qdt);
				$dt_kd = nosql($rdt['mskd']);
				$dt_mkkd = nosql($rdt['mkkd']);
				$dt_nama = balikin($rdt['nama']);
				$i_kd = $dt_kd;
				$i_mkkd = $dt_mkkd;
				$i_nama = $dt_nama;


				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td valign="top">'.$i_nim.'</td>
				<td valign="top">'.$i_nama.'</td>
				<td valign="top">
				<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&s=smt&mkkd='.$i_mkkd.'&kd='.$i_kd.'" title="Lihat KHS"><img src="'.$sumber.'/img/preview.gif" width="16" height="16" border="0"></a>
				</td>
				</tr>';
				}
			while ($data = mysql_fetch_assoc($result));
			}

		echo '</table>

		<table width="400" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td align="right">Total : <font color="#FF0000"><strong>'.$count.'</strong></font> Data. '.$pagelist.'</td>
		</tr>
		</table>';
		}

	//jika semester
	else if ($s == "smt")
		{
		//detail mahasiswa
		$qku = mysql_query("SELECT * FROM m_mahasiswa ".
					"WHERE kd = '$kd'");
		$rku = mysql_fetch_assoc($qku);
		$ku_nim = nosql($rku['nim']);
		$ku_nama = balikin($rku['nama']);

		echo '[<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'">DAFTAR MAHASISWA</a>]
		<p>
		Mahasiswa : <strong>'.$ku_nim.'. '.$ku_nama.'</strong>,

		Semester : ';
		echo "<select name=\"smt\" onChange=\"MM_jumpMenu('self',this,0)\">";

		//smt
		$qstxy = mysql_query("SELECT * FROM m_smt ".
					"WHERE kd = '$smtkd'");
		$rowstxy = mysql_fetch_assoc($qstxy);
		$smt = nosql($rowstxy['smt']);



		//detail tapel
		$qdtx = mysql_query("SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
					"FROM mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd' ".
					"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
					"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
					"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
					"AND mahasiswa_kelas.kd_smt = '$smtkd'");
		$rdtx = mysql_fetch_assoc($qdtx);
		$tdtx = mysql_num_rows($qdtx);

		//jika ada, lihat tapel-nya
		if ($tdtx != 0)
			{
			//nilai
			$dtx_tapelkd = nosql($rdtx['kd_tapel']);

			//tapel-nya
			$qtpel = mysql_query("SELECT * FROM m_tapel ".
						"WHERE kd = '$dtx_tapelkd'");
			$rtpel = mysql_fetch_assoc($qtpel);
			$ttpel = mysql_num_rows($qtpel);
			$tpel_thn1 = nosql($rtpel['tahun1']);
			$tpel_thn2 = nosql($rtpel['tahun2']);

			}
		else
			{
			$tpel_thn1 = "-";
			$tpel_thn2 = "-";
			}

		echo '<option value="'.$smtkd.'" selected>'.$smt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.'].</option>';

		$qst = mysql_query("SELECT * FROM m_smt ".
					"WHERE kd <> '$smtkd'");
		$rowst = mysql_fetch_assoc($qst);

		do
			{
			$stkd = nosql($rowst['kd']);
			$stsmt = nosql($rowst['smt']);


			//detail tapel
			$qdtx = mysql_query("SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
						"FROM mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd' ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
						"AND mahasiswa_kelas.kd_smt = '$stkd' ".
						"");
			$rdtx = mysql_fetch_assoc($qdtx);
			$tdtx = mysql_num_rows($qdtx);

			//jika ada, lihat tapel-nya
			if ($tdtx != 0)
				{
				//nilai
				$dtx_tapelkd = nosql($rdtx['kd_tapel']);

				//tapel-nya
				$qtpel = mysql_query("SELECT * FROM m_tapel ".
							"WHERE kd = '$dtx_tapelkd'");
				$rtpel = mysql_fetch_assoc($qtpel);
				$ttpel = mysql_num_rows($qtpel);
				$tpel_thn1 = nosql($rtpel['tahun1']);
				$tpel_thn2 = nosql($rtpel['tahun2']);

				}
			else
				{
				$dtx_tapelkd = "";
				$tpel_thn1 = "-";
				$tpel_thn2 = "-";
				}


			echo '<option value="'.$filenya.'?s=smt&mkkd='.$mkkd.'&kd='.$kd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'&smtkd='.$stkd.'&tapelkd='.$dtx_tapelkd.'">'.$stsmt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.']</option>';
			}
		while ($rowst = mysql_fetch_assoc($qst));

		echo '</select>
		</p>';


		//jika belum dipilih
		if (empty($smtkd))
			{
			echo '<p>
			<font color="red">
			<strong>SEMESTER Belum Dipilih</strong>
			</font>.
			</p>';
			}

		else
			{
			//cek keberadaan mahasiswa
			$qcc2 = mysql_query("SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
						"AND m_mahasiswa.kd = '$kd'");
			$rcc2 = mysql_fetch_assoc($qcc2);
			$tcc2 = mysql_num_rows($qcc2);


			//jika sesuai
			if ($tcc2 != 0)
				{
				//daftar makul-nya
				$qkulo = mysql_query("SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, ".
							"m_makul.*, m_makul.kd AS makul ".
							"FROM mahasiswa_makul, m_makul ".
							"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
							"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ".
							"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
							"AND mahasiswa_makul.kd_smt = '$smtkd'");
				$rkulo = mysql_fetch_assoc($qkulo);
				$tkulo = mysql_num_rows($qkulo);

				//jika ada
				if ($tkulo != 0)
					{
					echo '<table width="800" border="1" cellspacing="0" cellpadding="3">
					<tr bgcolor="'.$warnaheader.'">
					<td width="1">&nbsp;</td>
					<td width="100"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
					<td><strong><font color="'.$warnatext.'">Nama Mata Kuliah</font></strong></td>
					<td width="50"><strong><font color="'.$warnatext.'">SKS</font></strong></td>
					<td width="50"><strong><font color="'.$warnatext.'">Nilai Huruf</font></strong></td>
					<td width="50"><strong><font color="'.$warnatext.'">Nilai Angka</font></strong></td>
					<td width="50"><strong><font color="'.$warnatext.'">Nilai Mutu</font></strong></td>
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
						$kulo_makul = nosql($rkulo['makul']);
						$kulo_kode = nosql($rkulo['kode']);
						$kulo_nama = balikin($rkulo['nama']);
						$kulo_sks = nosql($rkulo['sks']);

						//nilai
						$qnil = mysql_query("SELECT * FROM mahasiswa_nilai ".
									"WHERE kd_mahasiswa_kelas = '$mkkd' ".
									"AND kd_tapel = '$tapelkd' ".
									"AND kd_smt = '$smtkd' ".
									"AND kd_makul = '$kulo_makul'");
						$rnil = mysql_fetch_assoc($qnil);
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

						mysql_query("UPDATE mahasiswa_nilai SET subtotal_mutu = '$nil_mutu' ".
								"WHERE kd_mahasiswa_kelas = '$mkkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_makul = '$kulo_makul'");



						echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
						echo '<td>'.$i_nomer.'.</td>
						<td>'.$kulo_kode.'</td>
						<td>'.$kulo_nama.'</td>
						<td>'.$kulo_sks.'</td>
						<td>'.$nil_huruf.'</td>
						<td>'.$nil_angka.'</td>
						<td>'.$nil_mutu.'</td>
						</tr>';
						}
					while ($rkulo = mysql_fetch_assoc($qkulo));


					//total sks
					$qtoku = mysql_query("SELECT SUM(m_makul.sks) AS total ".
								"FROM mahasiswa_makul, m_makul ".
								"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
								"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ".
								"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
								"AND mahasiswa_makul.kd_smt = '$smtkd'");
					$rtoku = mysql_fetch_assoc($qtoku);
					$toku_total = round(nosql($rtoku['total']));


					//total nil_mutu
					$qtoku2 = mysql_query("SELECT SUM(subtotal_mutu) AS total ".
								"FROM mahasiswa_nilai, mahasiswa_kelas ".
								"WHERE mahasiswa_nilai.kd_mahasiswa_kelas = mahasiswa_kelas.kd ".
								"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
								"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
								"AND mahasiswa_kelas.kd = '$mkkd'");
					$rtoku2 = mysql_fetch_assoc($qtoku2);
					$toku2_total = round(nosql($rtoku2['total']));


					//total IP
					$nil_ip = round($toku2_total/$toku_total,2);


					//ipk : total sks /////////////////////////////////////////////////////
					$qtoku3 = mysql_query("SELECT SUM(m_makul.sks) AS total ".
								"FROM mahasiswa_makul, m_makul, mahasiswa_kelas ".
								"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
								"AND mahasiswa_makul.kd_mahasiswa_kelas = mahasiswa_kelas.kd ".
								"AND mahasiswa_kelas.kd_mahasiswa = '$kd' ".
								"AND mahasiswa_kelas.kd_tapel = mahasiswa_makul.kd_tapel ".
								"AND mahasiswa_kelas.kd_smt = mahasiswa_makul.kd_smt");
					$rtoku3 = mysql_fetch_assoc($qtoku3);
					$toku3_total = nosql($rtoku3['total']);


					//ipk : total nil_mutu ////////////////////////////////////////////////
					$qtoku23 = mysql_query("SELECT SUM(subtotal_mutu) AS total ".
								"FROM mahasiswa_nilai, mahasiswa_kelas, m_mahasiswa ".
								"WHERE mahasiswa_nilai.kd_mahasiswa_kelas = mahasiswa_kelas.kd ".
								"AND mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
								"AND m_mahasiswa.kd = '$kd'");
					$rtoku23 = mysql_fetch_assoc($qtoku23);
					$toku23_total = round(nosql($rtoku23['total']));


					//total IPK
					$nil_ipk = round($toku23_total/$toku3_total,2);



					//tapel-nya
					$qtpel = mysql_query("SELECT * FROM m_tapel ".
								"WHERE kd = '$tapelkd'");
					$rtpel = mysql_fetch_assoc($qtpel);
					$ttpel = mysql_num_rows($qtpel);
					$tpel_thn1 = nosql($rtpel['tahun1']);
					$tpel_thn2 = nosql($rtpel['tahun2']);



					//tgl.pengesahan
					$qsahi = mysql_query("SELECT DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%d') AS atgl, ".
								"DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%m') AS abln, ".
								"DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%Y') AS athn, ".
								"mahasiswa_nilai.* ".
								"FROM mahasiswa_nilai ".
								"WHERE kd_mahasiswa_kelas = '$mkkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd'");
					$rsahi = mysql_fetch_assoc($qsahi);
					$atgl = nosql($rsahi['atgl']);
					$abln = nosql($rsahi['abln']);
					$athn = nosql($rsahi['athn']);



					echo '<tr valign="top" bgcolor="'.$warnaheader.'">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><strong>Jumlah</strong></td>
					<td><strong>'.$toku_total.'</strong></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><strong>'.$toku2_total.'</strong></td>
					</tr>

					<tr valign="top" bgcolor="'.$warnaheader.'">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><strong>Indek Prestasi (IP) Semester ini</strong></td>
					<td><strong>'.$nil_ip.'</strong></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>

					<tr valign="top" bgcolor="'.$warnaheader.'">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><strong>Indek Prestasi Komulatif (IPK)</strong></td>
					<td><strong>'.$nil_ipk.'</strong></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					</table>

					<p>
					Tgl.Pengesahan :
					<br>
					<strong>'.$atgl.' '.$arrbln1[$abln].' '.$athn.'</strong>
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
			else
				{
				echo '<p>
				<font color="red">
				<strong>MAHASISWA ini Tidak Berada pada Tahun Akademik : '.$tpth1.'/'.$tpth2.', Semester : '.$smt.'</strong>.
				</font>
				</p>';
				}
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