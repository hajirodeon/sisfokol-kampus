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
$filenya = "mhs_krs.php";
$judul = "KRS Mahasiswa";
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





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika hapus
if ($s == "hapus")
	{
	//nilai
	$progdi = nosql($_REQUEST['progdi']);
	$tapelkd = nosql($_REQUEST['tapelkd']);
	$kelkd = nosql($_REQUEST['kelkd']);
	$mkkd = nosql($_REQUEST['mkkd']);
	$kd = nosql($_REQUEST['kd']);
	$rukd = nosql($_REQUEST['rukd']);
	$smt = nosql($_REQUEST['smt']);
	$kulkd = nosql($_REQUEST['kulkd']);

	//query
	mysqli_query($koneksi, "DELETE FROM mahasiswa_makul ".
			"WHERE kd = '$kulkd'");

	//re-direct
	$ke = "$filenya?s=smt&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd&smtkd=$smtkd";
	xloc($ke);
	exit();
	}






//jika simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$tapelkd = nosql($_POST['tapelkd']);
	$kelkd = nosql($_POST['kelkd']);
	$mkkd = nosql($_POST['mkkd']);
	$kd = nosql($_POST['kd']);
	$rukd = nosql($_POST['rukd']);
	$smt = nosql($_POST['smt']);
	$makul = nosql($_POST['makul']);

	//cek
	if ((empty($makul)) OR (empty($smt)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!.";
		$ke = "$filenya?s=smt&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd&smtkd=$smtkd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM mahasiswa_makul ".
					"WHERE kd_mahasiswa_kelas = '$mkkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smt' ".
					"AND kd_makul = '$makul'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);

		//jika iya, ada
		if ($tcc != 0)
			{
			//re-direct
			$pesan = "Mata Kuliah Tersebut Telah Anda Set. Harap Diperhatikan...!!.";
			$ke = "$filenya?s=smt&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd&smtkd=$smtkd";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO mahasiswa_makul (kd, kd_mahasiswa_kelas, kd_tapel, ".
					"kd_smt, kd_makul) VALUES ".
					"('$x', '$mkkd', '$tapelkd', ".
					"'$smt', '$makul')");

			//re-direct
			$ke = "$filenya?s=smt&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd&smtkd=$smtkd";
			xloc($ke);
			exit();
			}
		}
	}





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
	$makul = nosql($_POST['makul']);
	$atgl = nosql($_POST['a_tgl']);
	$abln = nosql($_POST['a_bln']);
	$athn = nosql($_POST['a_thn']);
	$tgl_sah = "$athn:$abln:$atgl";


	//update
	mysqli_query($koneksi, "UPDATE mahasiswa_makul SET tgl_sah = '$tgl_sah' ".
			"WHERE kd_mahasiswa_kelas = '$mkkd' ".
			"AND kd_tapel = '$tapelkd' ".
			"AND kd_smt = '$smt'");

	//re-direct
	$ke = "$filenya?s=smt&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd&smtkd=$smtkd";
	xloc($ke);
	exit();
	}





//jika ok, KRS baru
if ($_POST['btnOK'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$mkkd = nosql($_POST['mkkd']);
	$kd = nosql($_POST['kd']);
	$rukd = nosql($_POST['rukd']);
	$smtkd = nosql($_POST['smtkd']);



	//ketahui smt sebelumnya...
	$qcc1 = mysqli_query($koneksi, "SELECT * FROM m_smt ".
				"WHERE kd = '$smtkd'");
	$rcc1 = mysqli_fetch_assoc($qcc1);
	$tcc1 = mysqli_num_rows($qcc1);
	$cc1_no = nosql($rcc1['no']);
	$cc1x_no = round($cc1_no - 1);

	//smt sebelumnya
	$qcc2 = mysqli_query($koneksi, "SELECT * FROM m_smt ".
				"WHERE no = '$cc1x_no'");
	$rcc2 = mysqli_fetch_assoc($qcc2);
	$tcc2 = mysqli_num_rows($qcc2);
	$cc2_kd = nosql($rcc2['kd']);


	//tapelnya
	$qcc3 = mysqli_query($koneksi, "SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_smt = '$cc2_kd' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
				"AND m_mahasiswa.kd = '$kd'");
	$rcc3 = mysqli_fetch_assoc($qcc3);
	$tcc3 = mysqli_num_rows($qcc3);
	$cc3_tapelkd = nosql($rcc3['kd_tapel']);

	//tapel sekarang
	$qtpel3x = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
				"WHERE kd = '$cc3_tapelkd'");
	$rtpel3x = mysqli_fetch_assoc($qtpel3x);
	$tpel3x_tahun1 = nosql($rtpel3x['tahun1']);
	$tpel3x_tahun2 = nosql($rtpel3x['tahun2']);


	//jika sebelumnya, semester genap, maka selanjutnya tapel baru
	if (($cc1x_no == "2") OR ($cc1x_no == "4"))
		{
		//ketahui tapel berikutnya
		$qtpel2 = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
					"WHERE tahun1 > '$tpel3x_tahun1' ".
					"ORDER BY tahun1 ASC");
		$rtpel2 = mysqli_fetch_assoc($qtpel2);
		$ttpel2 = mysqli_num_rows($qtpel2);
		}

	//jika sebelumnya, adalah semester ganjil, maka tapel tetap.
	else
		{
		//ketahui tapel berikutnya
		$qtpel2 = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
					"WHERE tahun1 = '$tpel3x_tahun1'");
		$rtpel2 = mysqli_fetch_assoc($qtpel2);
		$ttpel2 = mysqli_num_rows($qtpel2);
		}


	//jika ada
	if ($ttpel2 != 0)
		{
		$tpel2_kd = nosql($rtpel2['kd']);


		//cek
		$qcc4 = mysqli_query($koneksi, "SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
					"FROM m_mahasiswa, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
					"AND mahasiswa_kelas.kd_tapel = '$tpel2_kd' ".
					"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
					"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
					"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
					"AND mahasiswa_kelas.kd = '$mkkd'");
		$rcc4 = mysqli_fetch_assoc($qcc4);
		$tcc4 = mysqli_num_rows($qcc4);


		//jika belum ada, insert
		if (empty($tcc4))
			{
			mysqli_query($koneksi, "INSERT INTO mahasiswa_kelas (kd, kd_progdi, kd_tapel, kd_smt, ".
					"kd_kelas, kd_ruang, kd_mahasiswa) VALUES ".
					"('$x', '$progdi', '$tpel2_kd', '$smtkd', ".
					"'$kelkd', '$rukd', '$kd')");
			}
		}


	//re-direct
	$ke = "$filenya?s=smt&mkkd=$mkkd&kd=$kd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tpel2_kd&rukd=$rukd&smtkd=$smtkd";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");
require("../../inc/js/number.js");
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

<INPUT type="hidden" name="s" value="'.$s.'">
<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
<INPUT type="hidden" name="mkkd" value="'.$mkkd.'">
<INPUT type="hidden" name="kd" value="'.$kd.'">
<INPUT type="hidden" name="progdi" value="'.$progdi.'">
<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
<INPUT type="hidden" name="rukd" value="'.$rukd.'">
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
		$target = "$filenya?progdi=$progdi&kelkd=$kelkd&rukd=$rukd";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);


		echo '<table width="400" border="1" cellpadding="3" cellspacing="0">
		<tr bgcolor="'.$warnaheader.'">
		<td width="50"><strong>NIM</strong></td>
		<td><strong>Nama</strong></td>
		<td width="10">&nbsp</td>
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
				<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'&s=smt&mkkd='.$i_mkkd.'&kd='.$i_kd.'" title="Edit KRS"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
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

		echo '[<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'">DAFTAR MAHASISWA</a>]
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


			echo '<option value="'.$filenya.'?s=smt&mkkd='.$mkkd.'&kd='.$kd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'&smtkd='.$stkd.'&tapelkd='.$dtx_tapelkd.'">'.$stsmt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.']</option>';
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
				/*
			//cek keberadaan mahasiswa
			$qcc2 = mysqli_query($koneksi, "SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
									"FROM m_mahasiswa, mahasiswa_kelas ".
									"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
									"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
//									"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
//									"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
//									"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
//									"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
									"AND m_mahasiswa.kd = '$kd'");
			$rcc2 = mysqli_fetch_assoc($qcc2);
			$tcc2 = mysqli_num_rows($qcc2);
*/

			//cek keberadaan mahasiswa
			$qcc2 = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
									"WHERE kd = '$kd'");
			$rcc2 = mysqli_fetch_assoc($qcc2);
			$tcc2 = mysqli_num_rows($qcc2);


			//jika sesuai
			if ($tcc2 != 0)
				{

/*
 				//jika semester masih kosong
				//masukkan semesternya ///////////////////////////////////////////////////////////////////
				//ketahui smt...
				$qcc1 = mysqli_query($koneksi, "SELECT * FROM m_smt ".
										"ORDER BY no ASC");
				$rcc1 = mysqli_fetch_assoc($qcc1);
				$tcc1 = mysqli_num_rows($qcc1);
				
				//kasi tempatkan ke semua semester, dan ketahui tapelnya
				do
					{
					$cc1_no = nosql($rcc1['no']);
					$cc1_kd = nosql($rcc1['kd']);

					//ketahui tapel yang ada, terakhir
					$qcc4 = mysqli_query($koneksi, "SELECT m_tapel.* ".
												"FROM m_mahasiswa, mahasiswa_kelas, m_tapel ".
												"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
												"AND mahasiswa_kelas.kd_tapel = m_tapel.kd ".
												"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
												"AND mahasiswa_kelas.kd_smt = '$cc1_kd' ".
												"AND mahasiswa_kelas.kd_mahasiswa = '$kd' ".
												"ORDER BY m_tapel.tahun1 DESC");
					$rcc4 = mysqli_fetch_assoc($qcc4);
					$tcc4 = mysqli_num_rows($qcc4);
					$cc4_tahun1 = nosql($rcc4['tahun1']);
					
					//tapel-nya
					$qtpel3x = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
												"WHERE tahun1 = '$cc4_tahun1'");
					$rtpel3x = mysqli_fetch_assoc($qtpel3x);
					$tpel3x_kd = nosql($rtpel3x['kd']);

					
										
					//semester genap, maka selanjutnya tapel baru
					if (($cc1_no == "2") OR ($cc1x_no == "4") OR ($cc1x_no == "6") OR ($cc1x_no == "8"))
						{
						$cc4_tahunx = $cc4_tahun1 + 1;
						
						//tapel-nya
						$qtpel3x = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
													"WHERE tahun1 = '$cc4_tahunx'");
						$rtpel3x = mysqli_fetch_assoc($qtpel3x);
						$tpel3x_kd = nosql($rtpel3x['kd']);							
						}
					else
						{
						$cc4_tahunx = $cc4_tahun1;
						
						//tapel-nya
						$qtpel3x = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
													"WHERE tahun1 = '$cc4_tahunx'");
						$rtpel3x = mysqli_fetch_assoc($qtpel3x);
						$tpel3x_kd = nosql($rtpel3x['kd']);	
						}

													
					//cek
					$qcc4 = mysqli_query($koneksi, "SELECT mahasiswa_kelas.* ".
												"FROM m_mahasiswa, mahasiswa_kelas ".
												"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
												"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
												"AND mahasiswa_kelas.kd_tapel = '$tpel3x_kd' ".
												"AND mahasiswa_kelas.kd_smt = '$cc1_kd' ".
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
											"('$nilkd', '$progdi', '$tpel3x_kd', '$cc1_kd', ".
											"'$kelkd', '$rukd', '$kd')");
											

							
						//masukkan
						//daftar makul-nya
						$qkulox = mysqli_query($koneksi, "SELECT m_makul_smt.sks AS ssks, ".
												"m_makul_smt.kd AS mskd, ".
												"m_makul.*, m_makul.kd AS mkkd ".
												"FROM m_makul_smt, m_makul ".
												"WHERE m_makul_smt.kd_makul = m_makul.kd ".
												"AND m_makul.kd_progdi = '$progdi' ".
												"AND m_makul_smt.kd_tapel = '$tapelkd' ".
												"AND m_makul_smt.kd_smt = '$smtkd'");
						$rkulox = mysqli_fetch_assoc($qkulox);
						$tkulox = mysqli_num_rows($qkulox);
						
						
						do
							{
							//nilai
							$nomex = $nomex + 1;
							$xyz = md5("$x$nomex");
							$kulox_mskd = nosql($rkulox['mskd']);
							$kulox_mkkd = nosql($rkulox['mkkd']);
							$kulox_ssks = nosql($rkulox['ssks']);
							$kulox_kode = nosql($rkulox['kode']);
							$kulox_nama = balikin($rkulox['nama']);
							$kulox_jenis = nosql($rkulox['jenis']);
							$kulox_status = nosql($rkulox['status']);
							
							//cek
							$qcc = mysqli_query($koneksi, "SELECT * FROM mahasiswa_makul ".
													"WHERE kd_mahasiswa_kelas = '$nilkd' ".
													"AND kd_tapel = '$tapelkd' ".
													"AND kd_smt = '$smtkd' ".
													"AND kd_makul = '$kulox_mkkd'");
							$rcc = mysqli_fetch_assoc($qcc);
							$tcc = mysqli_num_rows($qcc);
												
							
							//jika null
							if (empty($tcc))
								{
								//insert
								mysqli_query($koneksi, "INSERT INTO mahasiswa_makul (kd, kd_mahasiswa_kelas, kd_tapel, ".
												"kd_smt, kd_makul) VALUES ".
												"('$xyz', '$nilkd', '$tapelkd', ".
												"'$smtkd', '$kulox_mkkd')");
								}
							}
						while ($rkulox = mysqli_fetch_assoc($qkulox));											
						}
					else
						{
												
						$nilkd = $cc4_mkkd;
							
											
					}
				while ($rcc1 = mysqli_fetch_assoc($qcc1));
									
*/				


								
				
				//masukkan
				//daftar makul-nya
				$qkulox = mysqli_query($koneksi, "SELECT m_makul.*, m_makul.kd AS mkkd, m_makul_smt.sks AS ssks ".
											"FROM m_makul, m_makul_smt ".
											"WHERE m_makul_smt.kd_makul = m_makul.kd ".
											"AND m_makul.kd_progdi = '$progdi' ".
											"AND m_makul_smt.kd_tapel = '$tapelkd' ".
											"AND m_makul_smt.kd_smt = '$smtkd' ".
											"ORDER BY m_makul.kode ASC");
				$rkulox = mysqli_fetch_assoc($qkulox);
				$tkulox = mysqli_num_rows($qkulox);
				
				
				do
					{
					//nilai
					$nomex = $nomex + 1;
					$xyz = md5("$x$nomex");
					$kulox_mskd = nosql($rkulox['mskd']);
					$kulox_mkkd = nosql($rkulox['mkkd']);
					$kulox_ssks = nosql($rkulox['ssks']);
					$kulox_kode = nosql($rkulox['kode']);
					$kulox_nama = balikin($rkulox['nama']);
					$kulox_jenis = nosql($rkulox['jenis']);
					$kulox_status = nosql($rkulox['status']);
					

					//cek
					$qcc = mysqli_query($koneksi, "SELECT * FROM mahasiswa_makul ".
											"WHERE kd_mahasiswa_kelas = '$mkkd' ".
											"AND kd_tapel = '$tapelkd' ".
											"AND kd_smt = '$smtkd' ".
											"AND kd_makul = '$kulox_mkkd'");
					$rcc = mysqli_fetch_assoc($qcc);
					$tcc = mysqli_num_rows($qcc);
										
					
					//jika null
					if (empty($tcc))
						{
						//insert
						mysqli_query($koneksi, "INSERT INTO mahasiswa_makul (kd, kd_mahasiswa_kelas, kd_tapel, ".
										"kd_smt, kd_makul) VALUES ".
										"('$xyz', '$mkkd', '$tapelkd', ".
										"'$smtkd', '$kulox_mkkd')");
						}
					}
				while ($rkulox = mysqli_fetch_assoc($qkulox));	

							

							/*
				//daftar makul-nya
				$qkulo2 = mysqli_query($koneksi, "SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, ".
										"m_makul.*, m_makul.kd AS makul, m_makul_smt.sks AS ssks ".
										"FROM mahasiswa_makul, m_makul, m_makul_smt ".
										"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
										"AND m_makul_smt.kd_makul = m_makul.kd ".
										"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ".
										"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
										"AND mahasiswa_makul.kd_smt = '$smtkd' ". 
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND m_makul_smt.kd_tapel = '$tapelkd' ".
										"AND m_makul_smt.kd_smt = '$smtkd' ".
										"ORDER BY m_makul.kode ASC");
				$rkulo2 = mysqli_fetch_assoc($qkulo2);
				$tkulo2 = mysqli_num_rows($qkulo2);
*/

				//daftar makul-nya
				$qkulo2 = mysqli_query($koneksi, "SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, ".
										"m_makul.*, m_makul.kd AS makul, m_makul_smt.sks AS ssks ".
										"FROM mahasiswa_makul, m_makul, m_makul_smt ".
										"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
										"AND m_makul_smt.kd_makul = m_makul.kd ".
										"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ".
										"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
										"AND mahasiswa_makul.kd_smt = '$smtkd' ". 
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND m_makul_smt.kd_tapel = '$tapelkd' ".
										"AND m_makul_smt.kd_smt = '$smtkd' ".
										"ORDER BY m_makul.kode ASC");
				$rkulo2 = mysqli_fetch_assoc($qkulo2);
				$tkulo2 = mysqli_num_rows($qkulo2);
													
				
				
				echo '<table width="500" border="1" cellspacing="0" cellpadding="3">
				<tr valign="top" bgcolor="'.$warnaheader.'">
				<td width="100"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
				<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
				<td width="50"><strong><font color="'.$warnatext.'">SKS</font></strong></td>
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
					$kulo_kulkd = nosql($rkulo2['kulkd']);
					$kulo_kode = nosql($rkulo2['kode']);
					$kulo_nama = balikin($rkulo2['nama']);
					$kulo_sks = nosql($rkulo2['ssks']);


					echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
					echo '<td>'.$kulo_kode.'</td>
					<td>'.$kulo_nama.'</td>
					<td>'.$kulo_sks.'</td>
					</tr>';
					}
				while ($rkulo2 = mysqli_fetch_assoc($qkulo2));


				//total sks
				$qtoku = mysqli_query($koneksi, "SELECT SUM(m_makul_smt.sks) AS total ".
										"FROM mahasiswa_makul, m_makul, m_makul_smt ".
										"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
										"AND m_makul_smt.kd_makul = m_makul.kd ".
										"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ".
										"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
										"AND mahasiswa_makul.kd_smt = '$smtkd' ". 
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND m_makul_smt.kd_tapel = '$tapelkd' ".
										"AND m_makul_smt.kd_smt = '$smtkd'");
				$rtoku = mysqli_fetch_assoc($qtoku);
				$toku_total = nosql($rtoku['total']);



				//tgl.pengesahan
				$qsahi = mysqli_query($koneksi, "SELECT DATE_FORMAT(mahasiswa_makul.tgl_sah, '%d') AS atgl, ".
							"DATE_FORMAT(mahasiswa_makul.tgl_sah, '%m') AS abln, ".
							"DATE_FORMAT(mahasiswa_makul.tgl_sah, '%Y') AS athn, ".
							"mahasiswa_makul.* ".
							"FROM mahasiswa_makul ".
							"WHERE kd_mahasiswa_kelas = '$mkkd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd'");
				$rsahi = mysqli_fetch_assoc($qsahi);
				$atgl = nosql($rsahi['atgl']);
				$abln = nosql($rsahi['abln']);
				$athn = nosql($rsahi['athn']);


				//tapel-nya
				$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
							"WHERE kd = '$tapelkd'");
				$rtpel = mysqli_fetch_assoc($qtpel);
				$ttpel = mysqli_num_rows($qtpel);
				$tpel_thn1 = nosql($rtpel['tahun1']);
				$tpel_thn2 = nosql($rtpel['tahun2']);


				echo '<tr valign="top" bgcolor="'.$warnaheader.'">
				<td>&nbsp;</td>
				<td align="right"><strong>Jumlah</strong></td>
				<td><strong>'.$toku_total.'</strong></td>
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

				<p>
				<INPUT type="hidden" name="s" value="'.$s.'">
				<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
				<INPUT type="hidden" name="mkkd" value="'.$mkkd.'">
				<INPUT type="hidden" name="kd" value="'.$kd.'">
				<INPUT type="hidden" name="progdi" value="'.$progdi.'">
				<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
				<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
				<INPUT type="hidden" name="rukd" value="'.$rukd.'">
				<INPUT type="submit" name="btnSMPx" value="SIMPAN">
				[<a href="mhs_krs_pdf.php?s=smt&mkkd='.$mkkd.'&kd='.$kd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'" target="_blank" title="Print KRS"><img src="'.$sumber.'/img/pdf.gif" border="0" width="16" height="16"></a>].
				</p>

				
				</p>
				<br>';
				}
			else
				{
				echo '<p>
				<font color="red">
				<strong>MAHASISWA tersebut Tidak Berada pada Semester ini.</strong>.
				</font>
				</p>
				<p>
				Silahkan Isi KRS Baru.
				<br>
				<INPUT type="hidden" name="s" value="'.$s.'">
				<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
				<INPUT type="hidden" name="mkkd" value="'.$mkkd.'">
				<INPUT type="hidden" name="kd" value="'.$kd.'">
				<INPUT type="hidden" name="progdi" value="'.$progdi.'">
				<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
				<INPUT type="hidden" name="rukd" value="'.$rukd.'">
				<INPUT type="submit" name="btnOK" value="OK >>">
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