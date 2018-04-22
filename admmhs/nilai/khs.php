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
$filenya = "khs.php";
$judul = "KHS Mahasiswa";
$judulku = "[$mhs_session : $nim6_session. $nm6_session] ==> $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
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

$ke = "$filenya?tapelkd=$tapelkd&page=$page";










//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admmhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">';
echo 'Semester : ';
echo "<select name=\"smt\" onChange=\"MM_jumpMenu('self',this,0)\">";

//smt
$qstxy = mysql_query("SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysql_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);

//detail tapel
$qdtx = mysql_query("SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
			"FROM mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd6_session' ".
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
							"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd6_session' ".
							"AND mahasiswa_kelas.kd_smt = '$stkd'");
	$rdtx = mysql_fetch_assoc($qdtx);
	$tdtx = mysql_num_rows($qdtx);

	//jika ada, lihat tapel-nya
	if ($tdtx != 0)
		{
		//nilai
		$dtx_tapelkd = nosql($rdtx['kd_tapel']);
		$dtx_mkkd = nosql($rdtx['mkkd']);


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


	echo '<option value="'.$filenya.'?s=smt&smtkd='.$stkd.'&tapelkd='.$dtx_tapelkd.'&mkkd='.$dtx_mkkd.'">'.$stsmt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.']</option>';
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
	$qcc2 = mysql_query("SELECT m_mahasiswa.*, mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
							"FROM m_mahasiswa, mahasiswa_kelas ".
							"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
							"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
							"AND m_mahasiswa.kd = '$kd6_session'");
	$rcc2 = mysql_fetch_assoc($qcc2);
	$tcc2 = mysql_num_rows($qcc2);
	$cc2_progdi = nosql($rcc2['kd_progdi']);
	$cc2_mkkd = nosql($rcc2['mkkd']);


	//jika sesuai
	if ($tcc2 != 0)
		{
		//daftar makul-nya
		$qkulo = mysql_query("SELECT m_makul.*, m_makul.kd AS mkkd, m_makul_smt.*, ".
									"m_makul_smt.sks AS ssks ".
									"FROM m_makul, m_makul_smt ".
									"WHERE m_makul_smt.kd_makul = m_makul.kd ".
									"AND m_makul.kd_progdi = '$cc2_progdi' ".
									"AND m_makul_smt.kd_tapel = '$tapelkd' ".
									"AND m_makul_smt.kd_smt = '$smtkd' ".
									"ORDER BY m_makul.kode ASC");
		$rkulo = mysql_fetch_assoc($qkulo);
		$tkulo = mysql_num_rows($qkulo);

		//jika ada
		if ($tkulo != 0)
			{
			echo '[<a href="khs_pdf.php?smtkd='.$smtkd.'&skkd='.$mkkd.'&mkkd='.$mkkd.'&kd='.$kd6_session.'&progdi='.$cc2_progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'" target="_blank" title="Print KHS"><img src="'.$sumber.'/img/pdf.gif" border="0" width="16" height="16"></a>].
			<table width="800" border="1" cellspacing="0" cellpadding="3">
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
				$xyz = md5("$x$i_nomer");
				$kulo_kulkd = nosql($rkulo['mkkd']);
//				$kulo_makul = nosql($rkulo['kd_makul']);
				$kulo_makul = nosql($rkulo['mkkd']);
				$kulo_kode = nosql($rkulo['kode']);
				$kulo_nama = balikin($rkulo['nama']);
				$kulo_sks = nosql($rkulo['ssks']);


				
				//nilai
				$qnil = mysql_query("SELECT * FROM mahasiswa_nilai ".
							"WHERE kd_mahasiswa_kelas = '$cc2_mkkd' ".
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
								"WHERE kd_mahasiswa_kelas = '$cc2_mkkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_makul = '$kulo_makul'");



					
				//cek table transkrip
				$qkuu = mysql_query("SELECT * FROM mahasiswa_transkrip ".
										"WHERE kd_mahasiswa = '$kd6_session' ".
										"AND kd_tapel = '$tapelkd' ".
										"AND kd_smt = '$smtkd' ".
										"AND kd_makul = '$kulo_makul'");
				$rkuu = mysql_fetch_assoc($qkuu);
				$tkuu = mysql_num_rows($qkuu);
				
				//jika ada, update
				if (!empty($tkuu))
					{
					mysql_query("UPDATE mahasiswa_transkrip SET sks = '$kulo_sks', ".
									"nil_huruf = '$nil_huruf', ".
									"nil_angka = '$nil_angka', ".
									"nil_mutu = '$nil_mutu', ".
									"postdate = '$today' ".
									"WHERE kd_mahasiswa = '$kd6_session' ".
									"AND kd_tapel = '$tapelkd' ".
									"AND kd_smt = '$smtkd' ".
									"AND kd_makul = '$kulo_makul'");
										
					}
				else 
					{
					mysql_query("INSERT INTO mahasiswa_transkrip(kd, kd_mahasiswa, kd_tapel, kd_smt, ".
									"kd_makul, sks, nil_huruf, nil_angka, ".
									"nil_mutu, postdate) VALUES ".
									"('$xyz', '$kd6_session', '$tapelkd', '$smtkd', ".
									"'$kulo_makul', '$kulo_sks', '$nil_huruf', '$nil_angka', ".
									"'$nil_mutu', '$today')");
					}
	





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



/*
			//total sks
			$qtoku = mysql_query("SELECT SUM(m_makul.sks) AS total ".
						"FROM mahasiswa_makul, m_makul ".
						"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
						"AND mahasiswa_makul.kd_mahasiswa_kelas = '$cc2_mkkd' ".
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
						"AND mahasiswa_kelas.kd = '$cc2_mkkd'");
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
*/



			//total sks
			$qtoku = mysql_query("SELECT SUM(sks) AS total ".
									"FROM mahasiswa_transkrip ".
									"WHERE kd_mahasiswa = '$kd6_session' ".
									"AND kd_tapel = '$tapelkd' ".
									"AND kd_smt = '$smtkd'");
			$rtoku = mysql_fetch_assoc($qtoku);
			$toku_total = round(nosql($rtoku['total']));


			//total nil_mutu
			$qtoku2 = mysql_query("SELECT SUM(nil_mutu) AS total ".
									"FROM mahasiswa_transkrip ".
									"WHERE kd_mahasiswa = '$kd6_session' ".
									"AND kd_tapel = '$tapelkd' ".
									"AND kd_smt = '$smtkd'");
			$rtoku2 = mysql_fetch_assoc($qtoku2);
			$toku2_total = round(nosql($rtoku2['total']));


			//total IP
			$nil_ip = round($toku2_total/$toku_total,2);


			//ipk : total sks /////////////////////////////////////////////////////
			$qtoku3 = mysql_query("SELECT SUM(sks) AS total ".
									"FROM mahasiswa_transkrip ".
									"WHERE kd_mahasiswa = '$kd6_session'");
			$rtoku3 = mysql_fetch_assoc($qtoku3);
			$toku3_total = nosql($rtoku3['total']);


			//ipk : total nil_mutu ////////////////////////////////////////////////
			$qtoku23 = mysql_query("SELECT SUM(nil_mutu) AS total ".
									"FROM mahasiswa_transkrip ".
									"WHERE kd_mahasiswa = '$kd6_session'");
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
						"WHERE kd_mahasiswa_kelas = '$cc2_mkkd' ".
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
		}

	else
		{
		echo '<p>
		<font color="red">
		<strong>Anda Belum Berada pada Semester ini.</strong>.
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