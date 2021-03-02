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
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "mhs_transkrip.php";
$judul = "Transkrip Nilai Mahasiswa";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
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

$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd&page=$page";






//PROSES //////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan pengesahan
if ($_POST['btnSMPx'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$mkkd = nosql($_POST['mkkd']);
	$kd = nosql($_POST['kd']);
	$rukd = nosql($_POST['rukd']);
	$atgl = nosql($_POST['a_tgl']);
	$abln = nosql($_POST['a_bln']);
	$athn = nosql($_POST['a_thn']);
	$tgl_sah = "$athn:$abln:$atgl";


	//update
	mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET tgl_sah_transkrip = '$tgl_sah' ".
			"WHERE kd_mahasiswa_kelas = '$mkkd'");

	//re-direct
	$ke = "$filenya?s=lihat&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd";
	xloc($ke);
	exit();
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////



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
require("../../inc/menu/admbaak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Program Studi : ';
echo "<select name=\"progdi\" onChange=\"MM_jumpMenu('self',this,0)\">";
//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);

echo '<option value="'.$tpx_kd.'" selected>'.$tpx_nama.'</option>';

$qtp = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd <> '$progdi' ".
			"ORDER BY nama ASC");
$rowtp = mysqli_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpnama = balikin($rowtp['nama']);

	echo '<option value="'.$filenya.'?progdi='.$tpkd.'">'.$tpnama.'</option>';
	}
while ($rowtp = mysqli_fetch_assoc($qtp));

echo '</select>,

Jenis : ';
echo "<select name=\"kelas\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qbtx = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd = '$kelkd'");
$rowbtx = mysqli_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<option value="'.$btxkd.'">'.$btxkelas.'</option>';

$qbt = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd <> '$kelkd' ".
			"ORDER BY no ASC");
$rowbt = mysqli_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btkelas = nosql($rowbt['kelas']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysqli_fetch_assoc($qbt));

echo '</select>,

Kelas : ';
echo "<select name=\"ruang\" onChange=\"MM_jumpMenu('self',this,0)\">";

//ruang
$qstx = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
				"WHERE kd = '$rukd'");
$rowstx = mysqli_fetch_assoc($qstx);
$ruang = nosql($rowstx['ruang']);

echo '<option value="'.$rukd.'" selected>'.$ruang.'</option>';

$qst = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
			"WHERE kd <> '$rukd'");
$rowst = mysqli_fetch_assoc($qst);

do
	{
	$stkd = nosql($rowst['kd']);
	$struang = balikin($rowst['ruang']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$stkd.'">'.$struang.'</option>';
	}
while ($rowst = mysqli_fetch_assoc($qst));

echo '</select>
</td>
</tr>
</table>
<br>';


//nek blm dipilih
if (empty($progdi))
	{
	echo '<p>
	<b>
	<font color="#FF0000"><strong>PROGRAM STUDI Belum Dipilih...!</strong></font>
	</b>
	</p>';
	}
else if (empty($kelkd))
	{
	echo '<p>
	<b>
	<font color="#FF0000"><strong>JENIS Belum Dipilih...!</strong></font>
	</b>
	</p>';
	}

else if (empty($rukd))
	{
	echo '<p>
	<b>
	<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>
	</b>
	</p>';
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


		$count = mysqli_num_rows(mysqli_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?progdi=$progdi&tapelkd=$tapelkd&kelkd=$kelkd&rukd=$rukd";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);


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
				$qdt = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
										"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
										"FROM m_mahasiswa, mahasiswa_kelas ".
										"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
										"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
										"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
										"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
										"AND m_mahasiswa.nim = '$i_nim'");
				$rdt = mysqli_fetch_assoc($qdt);
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
				<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&s=lihat&mkkd='.$i_mkkd.'&kd='.$i_kd.'" title="Lihat Transkrip Nilai"><img src="'.$sumber.'/img/preview.gif" width="16" height="16" border="0"></a>
				</td>
				</tr>';
				}
			while ($data = mysqli_fetch_assoc($result));
			}

		echo '</table>

		<table width="400" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td align="right">Total : <font color="#FF0000"><strong>'.$count.'</strong></font> Data. '.$pagelist.'</td>
		</tr>
		</table>';
		}

	//jika transkrip
	else if ($s == "lihat")
		{
		//detail mahasiswa
		$qku = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
								"WHERE kd = '$kd'");
		$rku = mysqli_fetch_assoc($qku);
		$ku_nim = nosql($rku['nim']);
		$ku_nama = balikin($rku['nama']);

		echo '[<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'">DAFTAR MAHASISWA</a>]
		<p>
		Mahasiswa : <strong>'.$ku_nim.'. '.$ku_nama.'</strong>
		</p>

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
			echo '<td ROWSPAN='.$tkulox.'>'.$stsmt.' ['.$tpel_thn1.'/'.$tpel_thn2.']</td>
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



		//jika null
		if ((empty($toku23_total)) OR (empty($toku3_total))) 
			{
			$nil_ipk = 0;
			}
		else 
			{
			//total IPK
			$nil_ipk = round($toku23_total/$toku3_total,2);
			}






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
		Tgl.Pengesahan :
		<br>
		<select name="a_tgl">
		<option value="'.$atgl.'" selected>'.$atgl.'</option>';
		for ($i=1;$i<=31;$i++)
			{
			echo '<option value="'.$i.'">'.$i.'</option>';
			}

		echo '</select>
		<select name="a_bln">
		<option value="'.$abln.'" selected>'.$arrbln1[$abln].'</option>';
		for ($j=1;$j<=12;$j++)
			{
			echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
			}

		echo '</select>
		<select name="a_thn">
		<option value="'.$athn.'" selected>'.$athn.'</option>';
		for ($k=$jsah01;$k<=$jsah02;$k++)
			{
			echo '<option value="'.$k.'">'.$k.'</option>';
			}
		echo '</select>
		</p>


		<INPUT type="hidden" name="s" value="'.$s.'">
		<INPUT type="hidden" name="mkkd" value="'.$mkkd.'">
		<INPUT type="hidden" name="kd" value="'.$kd.'">
		<INPUT type="hidden" name="progdi" value="'.$progdi.'">
		<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
		<INPUT type="hidden" name="rukd" value="'.$rukd.'">
		<INPUT type="submit" name="btnSMPx" value="SIMPAN">
		[<a href="mhs_transkrip_prt.php?mkkd='.$mkkd.'&kd='.$kd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'" title="Print Transkrip Nilai"><img src="'.$sumber.'/img/print.gif" border="0" width="16" height="16"></a>].
		
		[<a href="mhs_transkrip_pdf.php?mkkd='.$mkkd.'&kd='.$kd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'" title="Print Transkrip Nilai" target="_blank"><img src="'.$sumber.'/img/pdf.gif" border="0" width="16" height="16"></a>].
		';
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