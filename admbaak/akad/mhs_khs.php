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
$filenya = "mhs_khs.php";
$judul = "KHS Mahasiswa";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
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





//PROSES //////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan pengesahan
if ($_POST['btnSMPx'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$tapelkd = nosql($_POST['tapelkd']);
	$kelkd = nosql($_POST['kelkd']);
	$mkkd = nosql($_POST['mkkd']);
	$kd = nosql($_POST['kd']);
	$rukd = nosql($_POST['rukd']);
	$smt = nosql($_POST['smt']);
	$smt = nosql($_POST['smt']);
	$makul = nosql($_POST['makul']);
	$atgl = nosql($_POST['a_tgl']);
	$abln = nosql($_POST['a_bln']);
	$athn = nosql($_POST['a_thn']);
	$tgl_sah = "$athn:$abln:$atgl";


	//update
	mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET tgl_sah = '$tgl_sah' ".
					"WHERE kd_mahasiswa_kelas = '$mkkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd'");

	//re-direct
	$ke = "$filenya?s=smt&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd&smtkd=$smtkd";
	xloc($ke);
	exit();
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////





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
	echo '<h4>
	<font color="#FF0000"><strong>PROGRAM STUDI Belum Dipilih...!</strong></font>
	</h4>';
	}
else if (empty($kelkd))
	{
	echo '<h4>
	<font color="#FF0000"><strong>JENIS Belum Dipilih...!</strong></font>
	</h4>';
	}

else if (empty($rukd))
	{
	echo '<h4>
	<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>
	</h4>';
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
										"mahasiswa_kelas.kd AS mkkd ".
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
				<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&s=smt&mkkd='.$i_mkkd.'&kd='.$i_kd.'" title="Lihat KHS"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
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

	//jika semester
	else if ($s == "smt")
		{
		//detail mahasiswa
		$qku = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
								"WHERE kd = '$kd'");
		$rku = mysqli_fetch_assoc($qku);
		$ku_nim = nosql($rku['nim']);
		$ku_nama = balikin($rku['nama']);

		
		//detail
		$qxpell = mysqli_query($koneksi, "SELECT mahasiswa_kelas.kd AS skkd ".
								"FROM m_mahasiswa, mahasiswa_kelas ".
								"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
//								"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
								"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
								"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
								"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
								"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
								"AND m_mahasiswa.kd = '$kd'");
		$rxpell = mysqli_fetch_assoc($qxpell);
		$i_skkd = nosql($rxpell['skkd']);
			
				



		//netralkan dulu ya...
		mysqli_query($koneksi, "DELETE FROM mahasiswa_transkrip ".
						"WHERE kd_mahasiswa = '$kd'");
				


		echo '[<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'">DAFTAR MAHASISWA</a>]
		<p>
		Mahasiswa : <strong>'.$ku_nim.'. '.$ku_nama.'</strong>,

		Semester : ';
		echo "<select name=\"smt\" onChange=\"MM_jumpMenu('self',this,0)\">";

		//smt
		$qstxy = mysqli_query($koneksi, "SELECT * FROM m_smt ".
					"WHERE kd = '$smtkd'");
		$rowstxy = mysqli_fetch_assoc($qstxy);
		$smt = nosql($rowstxy['smt']);



		//detail tapel
		$qdtx = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
								"FROM mahasiswa_kelas ".
								"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd' ".
								"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
								"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
								"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
								"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
								"AND mahasiswa_kelas.kd_tapel <> ''");
		$rdtx = mysqli_fetch_assoc($qdtx);
		$tdtx = mysqli_num_rows($qdtx);

		//jika ada, lihat tapel-nya
		if ($tdtx != 0)
			{
			//nilai
			$dtx_tapelkd = nosql($rdtx['kd_tapel']);

			//tapel-nya
			$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
									"WHERE kd = '$dtx_tapelkd'");
			$rtpel = mysqli_fetch_assoc($qtpel);
			$ttpel = mysqli_num_rows($qtpel);
			$tapelkd = $dtx_tapelkd; 
			$tpel_thn1 = nosql($rtpel['tahun1']);
			$tpel_thn2 = nosql($rtpel['tahun2']);

			}
		else
			{
			$tpel_thn1 = "-";
			$tpel_thn2 = "-";
			}

		echo '<option value="'.$smtkd.'" selected>'.$smt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.'].</option>';

		$qst = mysqli_query($koneksi, "SELECT * FROM m_smt ".
							"ORDER BY no ASC");
		$rowst = mysqli_fetch_assoc($qst);

		do
			{
			$stkd = nosql($rowst['kd']);
			$stno = nosql($rowst['no']);
			$stsmt = nosql($rowst['smt']);


			//detail tapel
			$qdtx = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
									"FROM mahasiswa_kelas ".
									"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd' ".
									"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
									"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
									"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
									"AND mahasiswa_kelas.kd_smt = '$stkd'");
			$rdtx = mysqli_fetch_assoc($qdtx);
			$tdtx = mysqli_num_rows($qdtx);


			//nilai
			$dtx_tapelkd = nosql($rdtx['kd_tapel']);
			$dtx_smtkd = nosql($rdtx['kd_smt']);

			//tapel-nya
			$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
									"WHERE kd = '$dtx_tapelkd'");
			$rtpel = mysqli_fetch_assoc($qtpel);
			$ttpel = mysqli_num_rows($qtpel);
			$tpel_thn1 = nosql($rtpel['tahun1']);
			$tpel_thn2 = nosql($rtpel['tahun2']);

			//smt-nya
			$qtpel2 = mysqli_query($koneksi, "SELECT * FROM m_smt ".
									"WHERE kd = '$dtx_smtkd'");
			$rtpel2 = mysqli_fetch_assoc($qtpel2);
			$ttpel2 = mysqli_num_rows($qtpel2);
			$tpel2_no = nosql($rtpel['no']);





			//ambil yang terakhir
			$qdtx = mysqli_query($koneksi, "SELECT mahasiswa_kelas.* ".
									"FROM mahasiswa_kelas, m_tapel ".
									"WHERE mahasiswa_kelas.kd_tapel = m_tapel.kd ".
									"AND mahasiswa_kelas.kd_mahasiswa = '$kd' ".
									"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
									"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
									"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
									"ORDER BY m_tapel.tahun1 ASC");
			$rdtx = mysqli_fetch_assoc($qdtx);
			$tdtx = mysqli_num_rows($qdtx);
			$dtx_tapelkd = nosql($rdtx['kd_tapel']);
			$dtx_smtkd = nosql($rdtx['kd_smt']);

			//tapel-nya
			$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
									"WHERE kd = '$dtx_tapelkd'");
			$rtpel = mysqli_fetch_assoc($qtpel);
			$ttpel = mysqli_num_rows($qtpel);
			$tpel_thn1 = nosql($rtpel['tahun1']);
			$tpel_thn2 = nosql($rtpel['tahun2']);
			
			//jika ganjil
			if (($stno == "3") OR ($stno == "4"))
				{
				$tpelx = $tpel_thn1 + 1;
				}
			else if (($stno == "5") OR ($stno == "6"))
				{
				$tpelx = $tpel_thn1 + 2;
				}
			else if (($stno == "7") OR ($stno == "8"))
				{
				$tpelx = $tpel_thn1 + 3;
				}
			else
				{
				$tpelx = $tpel_thn1;
				}
					
					


			//tapel-nya
			$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
									"WHERE tahun1 = '$tpelx'");
			$rtpel = mysqli_fetch_assoc($qtpel);
			$ttpel = mysqli_num_rows($qtpel);
			$dtx_tapelkd = nosql($rtpel['kd']);
			$tpel_thn1 = nosql($rtpel['tahun1']);
			$tpel_thn2 = nosql($rtpel['tahun2']);
				

											
			//cek
			$qcc4 = mysqli_query($koneksi, "SELECT mahasiswa_kelas.* ".
										"FROM m_mahasiswa, mahasiswa_kelas ".
										"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
										"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
										"AND mahasiswa_kelas.kd_tapel = '$dtx_tapelkd' ".
										"AND mahasiswa_kelas.kd_smt = '$stkd' ".
										"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
										"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
										"AND mahasiswa_kelas.kd_mahasiswa = '$kd'");
			$rcc4 = mysqli_fetch_assoc($qcc4);
			$tcc4 = mysqli_num_rows($qcc4);
			$cc4_mkkd = nosql($rcc4['kd']);
	
	
			//jika belum ada, insert
			if (empty($tcc4))
				{
				$nilkd = $x;
				mysqli_query($koneksi, "INSERT INTO mahasiswa_kelas (kd, kd_progdi, kd_tapel, kd_smt, ".
									"kd_kelas, kd_ruang, kd_mahasiswa) VALUES ".
									"('$nilkd', '$progdi', '$dtx_tapelkd', '$stkd', ".
									"'$kelkd', '$rukd', '$kd')");
		
				}



			//detail
			$qxpell = mysqli_query($koneksi, "SELECT mahasiswa_kelas.kd AS skkd ".
									"FROM m_mahasiswa, mahasiswa_kelas ".
									"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
									"AND mahasiswa_kelas.kd_tapel = '$dtx_tapelkd' ".
									"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
									"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
									"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
									"AND mahasiswa_kelas.kd_smt = '$stkd' ".
									"AND m_mahasiswa.kd = '$kd'");
			$rxpell = mysqli_fetch_assoc($qxpell);
			$i_skkd = nosql($rxpell['skkd']);





			//looping makul, untuk simpan jadi transkrip ////////////////////////////////////////////////////
			//daftar makul-nya
			$qkulo = mysqli_query($koneksi, "SELECT m_makul.*, m_makul.kd AS mkkd, m_makul_smt.*, ".
										"m_makul_smt.sks AS ssks ".
										"FROM m_makul, m_makul_smt ".
										"WHERE m_makul_smt.kd_makul = m_makul.kd ".
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND m_makul_smt.kd_tapel = '$dtx_tapelkd' ".
										"AND m_makul_smt.kd_smt = '$stkd' ".
										"ORDER BY m_makul.kode ASC");
			$rkulo = mysqli_fetch_assoc($qkulo);
			$tkulo = mysqli_num_rows($qkulo);



			do
				{
				$i_nomerx = $i_nomerx + 1;
				$xyz = md5("$x$i_nomerx");
				$kulo_kulkd = nosql($rkulo['mkkd']);
				$kulo_makul = nosql($rkulo['kd_makul']);
				$kulo_kode = nosql($rkulo['kode']);
				$kulo_nama = balikin($rkulo['nama']);
				$kulo_sks = nosql($rkulo['ssks']);




				//nilai
				$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_nilai ".
										"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
										"AND kd_tapel = '$dtx_tapelkd' ".
										"AND kd_smt = '$stkd' ".
										"AND kd_makul = '$kulo_makul'");
				$rnil = mysqli_fetch_assoc($qnil);
				$nil_tugas = nosql($rnil['nil_tugas']);
				$nil_uts = nosql($rnil['nil_uts']);
				$nil_uas = nosql($rnil['nil_uas']);
				$nil_akhir = nosql($rnil['nil_akhir']);
				$xpel_akhir = $nil_akhir;


	
				//nil_huruf
				if (($xpel_akhir <= "100") AND ($xpel_akhir >= "80"))
					{
					$nil_huruf = "A";
					}
				else if (($xpel_akhir < "80") AND ($xpel_akhir >= "65"))
					{
					$nil_huruf = "B";
					}
				else if (($xpel_akhir < "65") AND ($xpel_akhir >= "50"))
					{
					$nil_huruf = "C";
					}
				else if (($xpel_akhir < "50") AND ($xpel_akhir >= "40"))
					{
					$nil_huruf = "D";
					}
				else
					{
					$nil_huruf = "E";
					}



				//update huruf
				mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET nil_akhir_huruf = '$nil_huruf' ".
								"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
								"AND kd_tapel = '$dtx_tapelkd' ".
								"AND kd_smt = '$stkd' ".
								"AND kd_makul = '$kulo_makul'");





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
								"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
								"AND kd_tapel = '$dtx_tapelkd' ".
								"AND kd_smt = '$stkd' ".
								"AND kd_makul = '$kulo_makul'");


					
				//cek table transkrip
				$qkuu = mysqli_query($koneksi, "SELECT * FROM mahasiswa_transkrip ".
										"WHERE kd_mahasiswa = '$kd' ".
										"AND kd_tapel = '$dtx_tapelkd' ".
										"AND kd_smt = '$stkd' ".
										"AND kd_makul = '$kulo_makul'");
				$rkuu = mysqli_fetch_assoc($qkuu);
				$tkuu = mysqli_num_rows($qkuu);
				
				//jika ada, update
				if (!empty($tkuu))
					{
					mysqli_query($koneksi, "UPDATE mahasiswa_transkrip SET sks = '$kulo_sks', ".
									"nil_huruf = '$nil_huruf', ".
									"nil_angka = '$nil_angka', ".
									"nil_mutu = '$nil_mutu', ".
									"postdate = '$today' ".
									"WHERE kd_mahasiswa = '$kd' ".
									"AND kd_tapel = '$dtx_tapelkd' ".
									"AND kd_smt = '$stkd' ".
									"AND kd_makul = '$kulo_makul'");										
					}
				else 
					{
					mysqli_query($koneksi, "INSERT INTO mahasiswa_transkrip(kd, kd_mahasiswa, kd_tapel, kd_smt, ".
									"kd_makul, sks, nil_huruf, nil_angka, ".
									"nil_mutu, postdate) VALUES ".
									"('$xyz', '$kd', '$dtx_tapelkd', '$stkd', ".
									"'$kulo_makul', '$kulo_sks', '$nil_huruf', '$nil_angka', ".
									"'$nil_mutu', '$today')");
					}
	
				}
			while ($rkulo = mysqli_fetch_assoc($qkulo));

			
			
			echo '<option value="'.$filenya.'?s=smt&mkkd='.$cc4_mkkd.'&kd='.$kd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'&smtkd='.$stkd.'&tapelkd='.$dtx_tapelkd.'">'.$stsmt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.']</option>';
			}
		while ($rowst = mysqli_fetch_assoc($qst));

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
			//detail
			$qxpell = mysqli_query($koneksi, "SELECT mahasiswa_kelas.kd AS skkd ".
									"FROM m_mahasiswa, mahasiswa_kelas ".
									"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
									"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
									"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
									"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
									"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
									"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
									"AND m_mahasiswa.kd = '$kd'");
			$rxpell = mysqli_fetch_assoc($qxpell);
			$i_skkd = nosql($rxpell['skkd']);
				
				
				
	
			//daftar makul-nya
			$qkulo = mysqli_query($koneksi, "SELECT m_makul.*, m_makul.kd AS mkkd, m_makul_smt.*, ".
										"m_makul_smt.sks AS ssks ".
										"FROM m_makul, m_makul_smt ".
										"WHERE m_makul_smt.kd_makul = m_makul.kd ".
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND m_makul_smt.kd_tapel = '$tapelkd' ".
										"AND m_makul_smt.kd_smt = '$smtkd' ".
										"ORDER BY m_makul.kode ASC");
			$rkulo = mysqli_fetch_assoc($qkulo);
			$tkulo = mysqli_num_rows($qkulo);
	
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
					$xyz = md5("$x$i_nomer");
					$kulo_kulkd = nosql($rkulo['mkkd']);
					$kulo_makul = nosql($rkulo['kd_makul']);
					$kulo_kode = nosql($rkulo['kode']);
					$kulo_nama = balikin($rkulo['nama']);
					$kulo_sks = nosql($rkulo['ssks']);
	
	
	
	
	
		
					//nil mapel
					$qxpel = mysqli_query($koneksi, "SELECT * FROM mahasiswa_nilai ".
											"WHERE kd_mahasiswa = '$kd' ".
											"AND kd_tapel = '$tapelkd' ".
											"AND kd_smt = '$smtkd' ".
											"AND kd_makul = '$kulo_kulkd'");
					$rxpel = mysqli_fetch_assoc($qxpel);
					$txpel = mysqli_num_rows($qxpel);
					$xpel_skkd = nosql($rxpel['kd_mahasiswa_kelas']);
	
					
					//jika null, dikasi
					if (empty($xpel_skkd))
						{
							/*
						mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET kd_mahasiswa_kelas = '$i_skkd' ".
											"WHERE kd_mahasiswa = '$kd' ".
											"AND kd_tapel = '$tapelkd' ".
											"AND kd_smt = '$smtkd' ".
											"AND kd_makul = '$mkkd'");
							 * */
							 
						
						mysqli_query($koneksi, "INSERT INTO mahasiswa_nilai(kd, kd_mahasiswa_kelas, kd_mahasiswa, kd_tapel, kd_smt, kd_makul) VALUES ".
										"('$xyz', '$i_skkd', '$kd', '$tapelkd', '$smtkd', '$mkkd')");
						}
		
	
	

	
					//nilai
					$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_nilai ".
											"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
											"AND kd_tapel = '$tapelkd' ".
											"AND kd_smt = '$smtkd' ".
											"AND kd_makul = '$kulo_kulkd'");
					$rnil = mysqli_fetch_assoc($qnil);
//					$nil_huruf = nosql($rnil['nil_akhir_huruf']);
					$nil_tugas = nosql($rnil['nil_tugas']);
					$nil_uts = nosql($rnil['nil_uts']);
					$nil_uas = nosql($rnil['nil_uas']);
					$nil_akhir = nosql($rnil['nil_akhir']);
					$xpel_akhir = $nil_akhir;
	
	
	
	
		
					//nil_huruf
					if (($xpel_akhir <= "100") AND ($xpel_akhir >= "80"))
						{
						$nil_huruf = "A";
						}
					else if (($xpel_akhir < "80") AND ($xpel_akhir >= "65"))
						{
						$nil_huruf = "B";
						}
					else if (($xpel_akhir < "65") AND ($xpel_akhir >= "50"))
						{
						$nil_huruf = "C";
						}
					else if (($xpel_akhir < "50") AND ($xpel_akhir >= "40"))
						{
						$nil_huruf = "D";
						}
					else
						{
						$nil_huruf = "E";
						}



					//update huruf
					mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET nil_akhir_huruf = '$nil_huruf' ".
									"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
									"AND kd_tapel = '$tapelkd' ".
									"AND kd_smt = '$smtkd' ".
									"AND kd_makul = '$kulo_kulkd'");



	
	
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
									"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
									"AND kd_tapel = '$tapelkd' ".
									"AND kd_smt = '$smtkd' ".
									"AND kd_makul = '$kulo_kulkd'");
	
	
						
					//cek table transkrip
					$qkuu = mysqli_query($koneksi, "SELECT * FROM mahasiswa_transkrip ".
											"WHERE kd_mahasiswa = '$kd' ".
											"AND kd_tapel = '$tapelkd' ".
											"AND kd_smt = '$smtkd' ".
											"AND kd_makul = '$kulo_kulkd'");
					$rkuu = mysqli_fetch_assoc($qkuu);
					$tkuu = mysqli_num_rows($qkuu);
					
					//jika ada, update
					if (!empty($tkuu))
						{
						mysqli_query($koneksi, "UPDATE mahasiswa_transkrip SET sks = '$kulo_sks', ".
										"nil_huruf = '$nil_huruf', ".
										"nil_angka = '$nil_angka', ".
										"nil_mutu = '$nil_mutu', ".
										"postdate = '$today' ".
										"WHERE kd_mahasiswa = '$kd' ".
										"AND kd_tapel = '$tapelkd' ".
										"AND kd_smt = '$smtkd' ".
										"AND kd_makul = '$kulo_kulkd'");
											
						}
					else 
						{
						mysqli_query($koneksi, "INSERT INTO mahasiswa_transkrip(kd, kd_mahasiswa, kd_tapel, kd_smt, ".
										"kd_makul, sks, nil_huruf, nil_angka, ".
										"nil_mutu, postdate) VALUES ".
										"('$xyz', '$kd', '$tapelkd', '$smtkd', ".
										"'$kulo_kulkd', '$kulo_sks', '$nil_huruf', '$nil_angka', ".
										"'$nil_mutu', '$today')");
						}
		

	
					echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
					echo '<td>'.$i_nomer.'</td>
					<td>'.$kulo_kode.'</td>
					<td>'.$kulo_nama.'</td>
					<td>'.$kulo_sks.'</td>
					<td>'.$nil_huruf.'</td>
					<td>'.$nil_angka.'</td>
					<td>'.$nil_mutu.'</td>
					</tr>';
					}
				while ($rkulo = mysqli_fetch_assoc($qkulo));
	
	
				//total sks
				$qtoku = mysqli_query($koneksi, "SELECT SUM(sks) AS total ".
										"FROM mahasiswa_transkrip ".
										"WHERE kd_mahasiswa = '$kd' ".
										"AND kd_tapel = '$tapelkd' ".
										"AND kd_smt = '$smtkd'");
				$rtoku = mysqli_fetch_assoc($qtoku);
				$toku_total = round(nosql($rtoku['total']));
	
	
				//total nil_mutu
				$qtoku2 = mysqli_query($koneksi, "SELECT SUM(nil_mutu) AS total ".
										"FROM mahasiswa_transkrip ".
										"WHERE kd_mahasiswa = '$kd' ".
										"AND kd_tapel = '$tapelkd' ".
										"AND kd_smt = '$smtkd'");
				$rtoku2 = mysqli_fetch_assoc($qtoku2);
				$toku2_total = round(nosql($rtoku2['total']));
	
	
				//total IP
				$nil_ip = round($toku2_total/$toku_total,2);
	
	
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
	
	
				//tapel-nya
				$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
							"WHERE kd = '$tapelkd'");
				$rtpel = mysqli_fetch_assoc($qtpel);
				$ttpel = mysqli_num_rows($qtpel);
				$tpel_thn1 = nosql($rtpel['tahun1']);
				$tpel_thn2 = nosql($rtpel['tahun2']);
	
	
	
				//tgl.pengesahan
				$qsahi = mysqli_query($koneksi, "SELECT DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%d') AS atgl, ".
										"DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%m') AS abln, ".
										"DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%Y') AS athn, ".
										"mahasiswa_nilai.* ".
										"FROM mahasiswa_nilai ".
										"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
										"AND kd_tapel = '$tapelkd' ".
										"AND kd_smt = '$smtkd'");
				$rsahi = mysqli_fetch_assoc($qsahi);
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
				<option value="'.$athn.'" selected>'.$athn.'</option>
				<option value="'.$tpel_thn1.'">'.$tpel_thn1.'</option>
				<option value="'.$tpel_thn2.'">'.$tpel_thn2.'</option>
				</select>
				</p>
	
	
				<INPUT type="hidden" name="s" value="'.$s.'">
				<INPUT type="hidden" name="skkd" value="'.$i_skkd.'">
				<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
				<INPUT type="hidden" name="mkkd" value="'.$mkkd.'">
				<INPUT type="hidden" name="kd" value="'.$kd.'">
				<INPUT type="hidden" name="progdi" value="'.$progdi.'">
				<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
				<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
				<INPUT type="hidden" name="rukd" value="'.$rukd.'">
				<INPUT type="submit" name="btnSMPx" value="SIMPAN">
				[<a href="mhs_khs_pdf.php?s=smt&skkd='.$i_skkd.'&mkkd='.$mkkd.'&kd='.$kd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'" target="_blank" title="Print KRS"><img src="'.$sumber.'/img/pdf.gif" border="0" width="16" height="16"></a>].';
	
	
				echo '</p>
				<br>';
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