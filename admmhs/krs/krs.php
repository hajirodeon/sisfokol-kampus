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
$filenya = "krs.php";
$judul = "KRS Mahasiswa";
$judulku = "[$mhs_session : $nim6_session. $nm6_session] ==> $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$kelkd = nosql($_REQUEST['kelkd']);
$progdi = nosql($_REQUEST['progdi']);
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

$ke = "$filenya?tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&page=$page";








//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika hapus
if ($s == "hapus")
	{
	//nilai
	$tapelkd = nosql($_REQUEST['tapelkd']);
	$progdi = nosql($_REQUEST['progdi']);
	$kelkd = nosql($_REQUEST['kelkd']);
	$rukd = nosql($_REQUEST['rukd']);
	$mkkd = nosql($_REQUEST['mkkd']);
	$kd = nosql($_REQUEST['kd']);
	$smt = nosql($_REQUEST['smt']);
	$kulkd = nosql($_REQUEST['kulkd']);

	//query
	mysqli_query($koneksi, "DELETE FROM mahasiswa_makul ".
					"WHERE kd = '$kulkd'");

	//re-direct
	$ke = "$filenya?s=smt&mkkd=$mkkd&tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&smtkd=$smtkd";
	xloc($ke);
	exit();
	}






//jika simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$progdi = nosql($_REQUEST['progdi']);
	$kelkd = nosql($_REQUEST['kelkd']);
	$rukd = nosql($_REQUEST['rukd']);
	$mkkd = nosql($_POST['mkkd']);
	$smt = nosql($_POST['smt']);
	$makul = nosql($_POST['makul']);

	//cek
	if ((empty($makul)) OR (empty($smt)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!.";
		$ke = "$filenya?s=smt&mkkd=$mkkd&tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&smtkd=$smtkd";
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
			$ke = "$filenya?s=smt&mkkd=$mkkd&tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&smtkd=$smtkd";
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
			$ke = "$filenya?s=smt&mkkd=$mkkd&tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&smtkd=$smtkd";
			xloc($ke);
			exit();
			}
		}
	}





//jika simpan pengesahan
if ($_POST['btnSMPx'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$progdi = nosql($_REQUEST['progdi']);
	$kelkd = nosql($_REQUEST['kelkd']);
	$rukd = nosql($_REQUEST['rukd']);
	$mkkd = nosql($_POST['mkkd']);
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
	$ke = "$filenya?s=smt&mkkd=$mkkd&tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&smtkd=$smtkd";
	xloc($ke);
	exit();
	}




//jika ok, KRS baru
if ($_POST['btnOK'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$progdi = nosql($_REQUEST['progdi']);
	$kelkd = nosql($_REQUEST['kelkd']);
	$rukd = nosql($_REQUEST['rukd']);
	$mkkd = nosql($_POST['mkkd']);
	$smtkd = nosql($_POST['smtkd']);


	//ketahui jenis semester saat ini
	$qsju = mysqli_query($koneksi, "SELECT * FROM m_smt ".
				"WHERE kd = '$smtkd'");
	$rsju = mysqli_fetch_assoc($qsju);
	$tsju = mysqli_num_rows($qsju);
	$sju_jnskd = nosql($rsju['jenis']);

	//jika jenis semester aktif, maka diijinkan
	if ($tsu_jnskd == $sju_jnskd)
		{
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
					"AND mahasiswa_kelas.kd_smt = '$cc2_kd' ".
					"AND m_mahasiswa.kd = '$kd6_session'");
		$rcc3 = mysqli_fetch_assoc($qcc3);
		$tcc3 = mysqli_num_rows($qcc3);
		$cc3_progdi = nosql($rcc3['kd_progdi']);
		$cc3_kelkd = nosql($rcc3['kd_kelas']);
		$cc3_rukd = nosql($rcc3['kd_ruang']);
		$cc3_tapelkd = nosql($rcc3['kd_tapel']);

		//tapel sekarang
		$qtpel3x = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
					"WHERE kd = '$cc3_tapelkd'");
		$rtpel3x = mysqli_fetch_assoc($qtpel3x);
		$tpel3x_tahun1 = nosql($rtpel3x['tahun1']);
		$tpel3x_tahun2 = nosql($rtpel3x['tahun2']);



		//jika sebelumnya, semester genap, maka selanjutnya tapel baru ////////////////////////////////////////
		if (($cc1x_no == "2") OR ($cc1x_no == "4"))
			{
			//ketahui tapel berikutnya
			$qtpel2 = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
						"WHERE tahun1 > '$tpel3x_tahun1' ".
						"ORDER BY tahun1 ASC");
			$rtpel2 = mysqli_fetch_assoc($qtpel2);
			$ttpel2 = mysqli_num_rows($qtpel2);

			//jika ada
			if ($ttpel2 != 0)
				{
				$tpel2_kd = nosql($rtpel2['kd']);

				//cek, apakah sesuai setting waktu pengisian KRS
				if ($tsu_tapelkd == $tpel2_kd)
					{
					//cek
					$qcc4 = mysqli_query($koneksi, "SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
								"FROM m_mahasiswa, mahasiswa_kelas ".
								"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
								"AND mahasiswa_kelas.kd_tapel = '$tpel2_kd' ".
								"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
								"AND mahasiswa_kelas.kd = '$mkkd'");
					$rcc4 = mysqli_fetch_assoc($qcc4);
					$tcc4 = mysqli_num_rows($qcc4);


					//jika belum ada, insert
					if (empty($tcc4))
						{
						mysqli_query($koneksi, "INSERT INTO mahasiswa_kelas (kd, kd_progdi, kd_tapel, kd_smt, ".
								"kd_kelas, kd_ruang, kd_mahasiswa) VALUES ".
								"('$x', '$cc3_progdi', '$tpel2_kd', '$smtkd', ".
								"'$cc3_kelkd', '$cc3_rukd', '$kd6_session')");
						}


					//re-direct
					$ke = "$filenya?mkkd=$mkkd&tapelkd=$tpel2_kd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&smtkd=$smtkd";
					xloc($ke);
					exit();
					}

				//jika tidak sesuai setting
				else
					{
					//re-direct
					$pesan = "Anda Hanya Diijinkan untuk Mengisi KRS pada Semester dan Tahun Akademik, yang sedang aktif saja.,,!!";
					pekem($pesan,$filenya);
					exit();
					}
				}
			}

		//jika sebelumnya, adalah semester ganjil, maka tapel tetap. //////////////////////////////////////////
		else if (($cc1x_no == "1") OR ($cc1x_no == "3") OR ($cc1x_no == "5"))
			{
			//ketahui tapel berikutnya
			$qtpel2 = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
						"WHERE tahun1 = '$tpel3x_tahun1'");
			$rtpel2 = mysqli_fetch_assoc($qtpel2);
			$ttpel2 = mysqli_num_rows($qtpel2);


			//jika ada
			if ($ttpel2 != 0)
				{
				$tpel2_kd = nosql($rtpel2['kd']);

				//cek, apakah sesuai setting waktu pengisian KRS
				if ($tsu_tapelkd == $tpel2_kd)
					{
					//cek
					$qcc4 = mysqli_query($koneksi, "SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
								"FROM m_mahasiswa, mahasiswa_kelas ".
								"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
								"AND mahasiswa_kelas.kd_tapel = '$tpel2_kd' ".
								"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
								"AND mahasiswa_kelas.kd = '$mkkd'");
					$rcc4 = mysqli_fetch_assoc($qcc4);
					$tcc4 = mysqli_num_rows($qcc4);


					//jika belum ada, insert
					if (empty($tcc4))
						{
						mysqli_query($koneksi, "INSERT INTO mahasiswa_kelas (kd, kd_progdi, kd_tapel, kd_smt, ".
								"kd_kelas, kd_ruang, kd_mahasiswa) VALUES ".
								"('$x', '$cc3_progdi', '$tpel2_kd', '$smtkd', ".
								"'$cc3_kelkd', '$cc3_rukd', '$kd6_session')");
						}


					//re-direct
					$ke = "$filenya?mkkd=$mkkd&tapelkd=$tpel2_kd&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&smtkd=$smtkd";
					xloc($ke);
					exit();
					}

				//jika tidak sesuai setting
				else
					{
					//re-direct
					$pesan = "Anda Hanya Diijinkan untuk Mengisi KRS pada Semester dan Tahun Akademik ini saja.,,!!";
					pekem($pesan,$filenya);
					exit();
					}
				}
			}
		}
	else
		{
		//re-direct
		$pesan = "Pengisian KRS untuk Semester yang Anda pilih, Belum Aktif. Harap Diperhatikan...!!";
		pekem($pesan,$filenya);
		exit();
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");
require("../../inc/js/number.js");
require("../../inc/menu/admmhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">';
echo 'Semester : ';
echo "<select name=\"smt\" onChange=\"MM_jumpMenu('self',this,0)\">";

//smt
$qstxy = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysqli_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);

//detail tapel
$qdtx = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
			"FROM mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd6_session' ".
			"AND mahasiswa_kelas.kd_smt = '$smtkd'");
$rdtx = mysqli_fetch_assoc($qdtx);
$tdtx = mysqli_num_rows($qdtx);

//nilai
$dtx_tapelkd = nosql($rdtx['kd_tapel']);
$dtx_progdi = nosql($rdtx['kd_progdi']);
$dtx_kelkd = nosql($rdtx['kd_kelas']);
$dtx_rukd = nosql($rdtx['kd_ruang']);

//tapel-nya
$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd = '$dtx_tapelkd'");
$rtpel = mysqli_fetch_assoc($qtpel);
$ttpel = mysqli_num_rows($qtpel);
$tpel_thn1 = nosql($rtpel['tahun1']);
$tpel_thn2 = nosql($rtpel['tahun2']);


echo '<option value="'.$smtkd.'" selected>'.$smt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.'].</option>';

$qst = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd <> '$smtkd'");
$rowst = mysqli_fetch_assoc($qst);

do
	{
	$stkd = nosql($rowst['kd']);
	$stsmt = nosql($rowst['smt']);


	//detail tapel
	$qdtx = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
							"FROM mahasiswa_kelas ".
							"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd6_session' ".
							"AND mahasiswa_kelas.kd_smt = '$stkd'");
	$rdtx = mysqli_fetch_assoc($qdtx);
	$tdtx = mysqli_num_rows($qdtx);

	//nilai
	$dtx_tapelkd = nosql($rdtx['kd_tapel']);
	$dtx_mkkd = nosql($rdtx['mkkd']);
	$dtx_progdi = nosql($rdtx['kd_progdi']);
	$dtx_kelkd = nosql($rdtx['kd_kelas']);
	$dtx_rukd = nosql($rdtx['kd_ruang']);



	//tapel-nya
	$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
							"WHERE kd = '$dtx_tapelkd'");
	$rtpel = mysqli_fetch_assoc($qtpel);
	$ttpel = mysqli_num_rows($qtpel);
	$tpel_thn1 = nosql($rtpel['tahun1']);
	$tpel_thn2 = nosql($rtpel['tahun2']);


	echo '<option value="'.$filenya.'?s=smt&smtkd='.$stkd.'&tapelkd='.$dtx_tapelkd.'&progdi='.$dtx_progdi.'&kelkd='.$dtx_kelkd.'&rukd='.$dtx_rukd.'&mkkd='.$dtx_mkkd.'">'.$stsmt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.']</option>';
	}
while ($rowst = mysqli_fetch_assoc($qst));

echo '</select>
<INPUT type="hidden" name="s" value="'.$s.'">
<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
<INPUT type="hidden" name="mkkd" value="'.$mkkd.'">
<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
<INPUT type="hidden" name="progdi" value="'.$progdi.'">
<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
<INPUT type="hidden" name="rukd" value="'.$rukd.'">
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
	//status
	$qtsu = mysqli_query($koneksi, "SELECT * FROM set_krs ".
							"WHERE kd_tapel = '$tapelkd' ".
							"AND kd_kelas = '$kelkd' ".
							"AND kd_progdi = '$progdi' ".
							"AND kd_ruang = '$rukd'");
	$rtsu = mysqli_fetch_assoc($qtsu);
*/

	//status
	$qtsu = mysqli_query($koneksi, "SELECT * FROM set_krs ".
							"WHERE kd_tapel = '$tapelkd' ".
//							"AND kd_kelas = '$kelkd' ".
							"AND kd_progdi = '$progdi'");
	$rtsu = mysqli_fetch_assoc($qtsu);


/*
	$qtsu = mysqli_query($koneksi, "SELECT * FROM set_krs ".
				"WHERE kd_tapel = '$dtx_tapelkd' ".
				"AND kd_kelas = '$dtx_kelkd' ".
				"AND kd_progdi = '$dtx_progdi' ".
				"AND kd_ruang = '$dtx_rukd'");
	$rtsu = mysqli_fetch_assoc($qtsu);
*/
	$ttsu = mysqli_num_rows($qtsu);
	$tsu_jnskd = nosql($rtsu['kd_smt_jns']);
	$tsu_status = nosql($rtsu['status']);
	$tsu_postdate = $rtsu['postdate'];

	//true false
	if ($tsu_status == "true")
		{
		$tsu_status2 = "AKTIF";
		}
	else
		{
		$tsu_status2 = "TIDAK Aktif";
		}

	//null postdate
	if (empty($tsu_postdate))
		{
		$tsu_postdate = "-";
		}


	//cek status aktif pengisian KRS
	if ($ttsu != 0)
		{
		//cek keberadaan mahasiswa
		$qcc2 = mysqli_query($koneksi, "SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
								"FROM m_mahasiswa, mahasiswa_kelas ".
								"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
								"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
								"AND m_mahasiswa.kd = '$kd6_session'");
		$rcc2 = mysqli_fetch_assoc($qcc2);
		$tcc2 = mysqli_num_rows($qcc2);
		$cc2_progdi = nosql($rcc2['kd_progdi']);


		//jika sesuai
		if ($tcc2 != 0)
			{
				/*
			//total sks
			$qtoku = mysqli_query($koneksi, "SELECT SUM(mahasiswa_makul.sks) AS total ".
									"FROM mahasiswa_makul, m_makul ".
									"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
									"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ". 
									"AND m_makul.kd_progdi = '$progdi' ".
									"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
									"AND mahasiswa_makul.kd_smt = '$smtkd'");
			$rtoku = mysqli_fetch_assoc($qtoku);
			$toku_total = nosql($rtoku['total']);
*/

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
			$tsahi = mysqli_num_rows($qsahi);
			$tgl_sah = $rsahi['tgl_sah'];
			$atgl = nosql($rsahi['atgl']);
			$abln = nosql($rsahi['abln']);
			$athn = nosql($rsahi['athn']);



			//jika telah disahkan, tidak bisa di-edit lagi.
			if (($tgl_sah <> "0000-00-00") AND (!empty($tsahi)))
				{
					/*
				//daftar makul-nya
				$qkulo = mysqli_query($koneksi, "SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, m_makul.* ".
										"FROM mahasiswa_makul, m_makul ".
										"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
										"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ". 
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
										"AND mahasiswa_makul.kd_smt = '$smtkd'");
				$rkulo = mysqli_fetch_assoc($qkulo);
				$tkulo = mysqli_num_rows($qkulo);
*/


				//daftar makul-nya
				$qkulo = mysqli_query($koneksi, "SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, ".
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
				$rkulo = mysqli_fetch_assoc($qkulo);
				$tkulo = mysqli_num_rows($qkulo);

				

				//jika ada
				if ($tkulo != 0)
					{
					echo '[<a href="krs_pdf.php?smtkd='.$smtkd.'&skkd='.$mkkd.'&mkkd='.$mkkd.'&kd='.$kd6_session.'&progdi='.$cc2_progdi.'&kelkd='.$kelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'" target="_blank" title="Print KRS"><img src="'.$sumber.'/img/pdf.gif" border="0" width="16" height="16"></a>].
					<table width="500" border="1" cellspacing="0" cellpadding="3">
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
						$kulo_kulkd = nosql($rkulo['kulkd']);
						$kulo_kode = nosql($rkulo['kode']);
						$kulo_nama = balikin($rkulo['nama']);
						$kulo_sks = nosql($rkulo['ssks']);


						echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
						echo '<td>'.$kulo_kode.'</td>
						<td>'.$kulo_nama.'</td>
						<td>'.$kulo_sks.'</td>
						</tr>';
						}
					while ($rkulo = mysqli_fetch_assoc($qkulo));


					echo '<tr valign="top" bgcolor="'.$warnaheader.'">
					<td>&nbsp;</td>
					<td align="right"><strong>Jumlah</strong></td>
					<td><strong>'.$toku_total.'</strong></td>
					</tr>
					</table>


					<p>
					Tgl.Pengesahan :
					<br>
					<strong>'.$atgl.' '.$arrbln1[$abln].' '.$athn.'</strong>
					</p>

					<p>
					<INPUT type="hidden" name="s" value="'.$s.'">
					<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
					<INPUT type="hidden" name="mkkd" value="'.$mkkd.'">
					<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
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

			//jika belum sah, atau tidak ada
			else
				{
				echo '<p>
				<select name="makul">
				<option value="" selected>-Mata Kuliah-</option>';

				$qtp2 = mysqli_query($koneksi, "SELECT DISTINCT(m_makul.kd) AS mmkd ".
										"FROM mahasiswa_makul, m_makul, m_makul_smt ".
										"WHERE mahasiswa_makul.kd_makul <> m_makul.kd ".
										"AND m_makul_smt.kd_makul = m_makul.kd ". 
//										"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ".
//										"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
//										"AND mahasiswa_makul.kd_smt = '$smtkd' ". 
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND m_makul_smt.kd_tapel = '$tapelkd' ".
										"AND m_makul_smt.kd_smt = '$smtkd' ".
										"ORDER BY m_makul.kode ASC");
				$rowtp2 = mysqli_fetch_assoc($qtp2);

				
				
				do
					{
					$tp2_kd = nosql($rowtp2['mmkd']);
					

					//detail e	
					$qtp2x = mysqli_query($koneksi, "SELECT m_makul.*, m_makul.kd AS mmkd, m_makul_smt.*, m_makul_smt.sks AS ssks ".
											"FROM m_makul, m_makul_smt ".
											"WHERE m_makul_smt.kd_makul = m_makul.kd ".
											"AND m_makul.kd = '$tp2_kd' ".
											"AND m_makul.kd_progdi = '$progdi' ".
											"AND m_makul_smt.kd_tapel = '$tapelkd' ".
											"AND m_makul_smt.kd_smt = '$smtkd'");
					$rowtp2x = mysqli_fetch_assoc($qtp2x);

					$tp2_kode = nosql($rowtp2x['kode']);
					$tp2_nama = balikin($rowtp2x['nama']);
					$tp2_sks = nosql($rowtp2x['ssks']);


					echo '<option value="'.$tp2_kd.'">['.$tp2_kode.']. '.$tp2_nama.' ['.$tp2_sks.' SKS].</option>';
					}
				while ($rowtp2 = mysqli_fetch_assoc($qtp2));

				echo '</select>
				<INPUT type="submit" name="btnSMP" value="TAMBAH >>">
				</p>';

/*
				//daftar makul-nya
				$qkulo = mysqli_query($koneksi, "SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, m_makul.* ".
										"FROM mahasiswa_makul, m_makul ".
										"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
										"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ". 
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
										"AND mahasiswa_makul.kd_smt = '$smtkd'");
				$rkulo = mysqli_fetch_assoc($qkulo);
				$tkulo = mysqli_num_rows($qkulo);
*/
	
	

	
				
				//daftar makul-nya
				$qkulo = mysqli_query($koneksi, "SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, ".
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
				$rkulo = mysqli_fetch_assoc($qkulo);
				$tkulo = mysqli_num_rows($qkulo);
				
				
				//jika null, kasi makul
				if (empty($tkulo))
					{
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
						
					}				
				
				
				
				
				//jika ada
				if ($tkulo != 0)
					{
					echo '<table width="500" border="1" cellspacing="0" cellpadding="3">
					<tr valign="top" bgcolor="'.$warnaheader.'">
					<td width="1">&nbsp;</td>
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
						$kulo_kulkd = nosql($rkulo['kulkd']);
						$kulo_kode = nosql($rkulo['kode']);
						$kulo_nama = balikin($rkulo['nama']);
						$kulo_sks = nosql($rkulo['ssks']);


						echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
						echo '<td>
						<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&smtkd='.$smtkd.'&kulkd='.$kulo_kulkd.'&s=hapus&mkkd='.$mkkd.'&kd='.$kulo_kulkd.'">
						<img src="'.$sumber.'/img/delete.gif" width="16" height="16" border="0">
						</a>
						</td>
						<td>'.$kulo_kode.'</td>
						<td>'.$kulo_nama.'</td>
						<td>'.$kulo_sks.'</td>
						</tr>';
						}
					while ($rkulo = mysqli_fetch_assoc($qkulo));


					echo '<tr valign="top" bgcolor="'.$warnaheader.'">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><strong>Jumlah</strong></td>
					<td><strong>'.$toku_total.'</strong></td>
					</tr>
					</table>


					<p>
					Tgl.Pengesahan :
					<br>
					[<strong>BELUM DISAHKAN...</strong>].
					</p>

					<p>
					<INPUT type="hidden" name="s" value="'.$s.'">
					<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
					<INPUT type="hidden" name="mkkd" value="'.$mkkd.'">
					<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
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
			}

		else
			{
			echo '<p>
			<font color="red">
			<strong>Anda Belum Berada pada Semester ini.</strong>.
			</font>
			</p>
			<p>
			Silahkan Isi KRS Baru.
			<br>
			<INPUT type="hidden" name="s" value="'.$s.'">
			<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
			<INPUT type="hidden" name="mkkd" value="'.$mkkd.'">
			<INPUT type="submit" name="btnOK" value="OK >>">
			</p>';
			}
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>Waktu Pengisian KRS, Tidak Aktif.</strong>
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