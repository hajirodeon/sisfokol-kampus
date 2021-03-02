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

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/class/paging.php");
require("../../inc/cek/admdosen.php");
$tpl = LoadTpl("../../template/index.html");


nocache;

//nilai
$filenya = "nilai.php";
$judul = "Nilai Mahasiswa";
$judulku = "$judul  [$dosen_session : $nip5_session. $nm5_session]";
$juduly = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$kelkd = nosql($_REQUEST['kelkd']);
$progdi = nosql($_REQUEST['progdi']);
$rukd = nosql($_REQUEST['rukd']);
$mkkd = nosql($_REQUEST['mkkd']);
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);

//page...
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

$ke = "$filenya?tapelkd=$tapelkd&smtkd=$smtkd&kelkd=$kelkd&".
	"progdi=$progdi&rukd=$rukd&mkkd=$mkkd&page=$page";








//PROSES //////////////////////////////////////////////////////////////////////////////////////////////////////
//entry nilai
if ($_POST['btnSMP'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$smtkd = nosql($_POST['smtkd']);
	$kelkd = nosql($_POST['kelkd']);
	$progdi = nosql($_POST['progdi']);
	$rukd = nosql($_POST['rukd']);
	$mkkd = nosql($_POST['mkkd']);
	$page = nosql($_POST['page']);
	$jml = nosql($_POST['jml']);

	//page...
	if ((empty($page)) OR ($page == "0"))
		{
		$page = "1";
		}



	//rumus
	$qcc = mysqli_query($koneksi, "SELECT * FROM set_rumus ".
							"WHERE kd_tapel = '$tapelkd' ".
							"AND kd_progdi = '$progdi' ".
							"AND kd_kelas = '$kelkd'");
	$rcc = mysqli_fetch_assoc($qcc);
	$tcc = mysqli_num_rows($qcc);
	$cc_p_absensi = nosql($rcc['persen_absensi']);
	$cc_p_tugas = nosql($rcc['persen_tugas']);
	$cc_p_uts = nosql($rcc['persen_uts']);
	$cc_p_uas = nosql($rcc['persen_uas']);		



	for ($k=1;$k<=$limit;$k++)
		{
		//nilai
		$xyz = md5("$x$k");

		//ambil nilai
		$xskkd1 = "skkd";
		$xskkd2 = "$xskkd1$k";
		$xskkdx = nosql($_POST["$xskkd2"]);

		$xnh1 = "hadir";
		$xnh2 = "$xnh1$k";
		$xnhx = nosql($_POST["$xnh2"]);

		$x1nh1 = "tugas";
		$x1nh2 = "$x1nh1$k";
		$x1nhx = nosql($_POST["$x1nh2"]);

		$x2nh1 = "uts";
		$x2nh2 = "$x2nh1$k";
		$x2nhx = nosql($_POST["$x2nh2"]);

		$x3nh1 = "uas";
		$x3nh2 = "$x3nh1$k";
		$x3nhx = nosql($_POST["$x3nh2"]);

		$xsp1 = "sp";
		$xsp2 = "$xsp1$k";
		$xspx = nosql($_POST["$xsp2"]);
		
		$x4nh1 = "huruf";
		$x4nh2 = "$x4nh1$k";
		$x4nhx = nosql($_POST["$x4nh2"]);



		//nilai akhir
		$jml_hadir = $xnhx;
		$nil_hadir = (($xnhx/12) * 100);
		$nil_hadirx = ($nil_hadir * $cc_p_absensi)/100;
		
		$nil_tugas = ($cc_p_tugas*$x1nhx)/100;
		$nil_uts = ($cc_p_uts*$x2nhx)/100;
		$nil_uas = ($cc_p_uas*$x3nhx)/100;
		$nil_akhir = round($nil_hadirx + $nil_tugas + $nil_uts + $nil_uas,2);


		//jika nilai lebih tinggi, nil sp yang diambil
		if ($xspx > $nil_akhir)
			{
			$nil_akhir = $xspx;
			}
		





		//nil mapel
		$qxpel = mysqli_query($koneksi, "SELECT * FROM mahasiswa_nilai ".
								"WHERE kd_mahasiswa_kelas = '$xskkdx' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_makul = '$mkkd'");
		$rxpel = mysqli_fetch_assoc($qxpel);
		$txpel = mysqli_num_rows($qxpel);


		//jika ada, update
		if ($txpel != 0)
			{
			mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET jml_hadir = '$jml_hadir', ".
							"nil_hadir = '$xnhx', ".
							"nil_tugas = '$x1nhx', ".
							"nil_uts = '$x2nhx', ".
							"nil_uas = '$x3nhx', ".
							"nil_akhir = '$nil_akhir', ".
							"nil_sp = '$xspx', ".
							"nil_akhir_huruf = '$x4nhx' ".
							"WHERE kd_mahasiswa_kelas = '$xskkdx' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd' ".
							"AND kd_makul = '$mkkd'");
			}

		//jika blm ada, insert
		else
			{
				/*
			mysqli_query($koneksi, "INSERT INTO mahasiswa_nilai(kd, kd_mahasiswa_kelas, kd_tapel, kd_smt, ".
							"kd_makul, jml_hadir, nil_hadir, nil_tugas, nil_uts, nil_uas, nil_akhir, nil_sp, nil_akhir_huruf) VALUES ".
							"('$xyz', '$xskkdx', '$tapelkd', '$smtkd', ".
							"'$mkkd', '$jml_hadir', '$xnhx', '$x1nhx', '$x2nhx', '$x3nhx', '$nil_akhir', '$xspx', '$x4nhx')");
				 * */
			mysqli_query($koneksi, "INSERT INTO mahasiswa_nilai(kd, kd_mahasiswa_kelas, kd_tapel, kd_smt, ".
							"kd_makul, jml_hadir, nil_hadir, nil_tugas, nil_uts, nil_uas, nil_akhir, nil_sp, nil_akhir_huruf) VALUES ".
							"('$xyz', '$xskkdx', '$tapelkd', '$smtkd', ".
							"'$mkkd', '$jml_hadir', '$xnhx', '$x1nhx', '$x2nhx', '$x3nhx', '$xspx', '$nil_akhir', '$x4nhx')");
			}
		}



	//re-direct
//	$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&progdi=$progdi&rukd=$rukd&smtkd=$smtkd&mkkd=$mkkd";
	$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&progdi=$progdi&rukd=$rukd&smtkd=$smtkd&mkkd=$mkkd&page=$page";
	xloc($ke);
	exit();
	}







//export
if ($_POST['btnEX'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$smtkd = nosql($_POST['smtkd']);
	$kelkd = nosql($_POST['kelkd']);
	$progdi = nosql($_POST['progdi']);
	$rukd = nosql($_POST['rukd']);
	$mkkd = nosql($_POST['mkkd']);
	

	//require
	include("../../inc/class/excel/excelwriter.inc.php");


	//Buat nama file yang di inginkan
	$excelfile = 'nilai_'.date("Y-m-d-H-i-s").'.xls';
	//lokasi hasil konversi
	$lokasi	   = '../../filebox/excel/';
	$excel=new ExcelWriter($lokasi.$excelfile);
	


	//Buat header untuk tabel
	$myArr = array("NIM","NAMA","NIL_TUGAS","NIL_UTS","NIL_UAS","NIL_SP");
	$excel->writeLine($myArr);


	//daftar mahasiswa
	$qku = mysqli_query($koneksi, "SELECT DISTINCT(m_mahasiswa.kd) AS mskd ".
							"FROM m_mahasiswa, mahasiswa_kelas ".
							"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
							"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
							"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
							"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
							"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
							"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
							"ORDER BY round(m_mahasiswa.nim) ASC");
	$rku = mysqli_fetch_assoc($qku);


	do
		{
		//nilainya
		$i_nomer = $i_nomer + 1;
		$i_mskd = nosql($rku['mskd']);
		
		//detail
		$qxpell = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
								"mahasiswa_kelas.*, mahasiswa_kelas.kd AS skkd ".
								"FROM m_mahasiswa, mahasiswa_kelas ".
								"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
								"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
								"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
								"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
								"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
								"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
								"AND m_mahasiswa.kd = '$i_mskd'");
		$rxpell = mysqli_fetch_assoc($qxpell);
		$i_skkd = nosql($rxpell['skkd']);
		$i_nim = nosql($rxpell['nim']);
		$i_nama = balikin($rxpell['nama']);


		//nil mapel
		$qxpel = mysqli_query($koneksi, "SELECT * FROM mahasiswa_nilai ".
								"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_makul = '$mkkd'");
		$rxpel = mysqli_fetch_assoc($qxpel);
		$txpel = mysqli_num_rows($qxpel);
		$xpel_tugas = nosql($rxpel['nil_tugas']);
		$xpel_uts = nosql($rxpel['nil_uts']);
		$xpel_uas = nosql($rxpel['nil_uas']);
		$xpel_akhir = nosql($rxpel['nil_akhir']);
		$xpel_sp = nosql($rxpel['nil_sp']);


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



		//nilai absensi
		$qxnil = mysqli_query($koneksi, "SELECT m_absen.*, m_absen.kd AS makd, ".
								"mahasiswa_absen.* ".
								"FROM m_absen, mahasiswa_absen ".
								"WHERE mahasiswa_absen.kd_absen = m_absen.kd ".
								"AND mahasiswa_absen.kd_mahasiswa_kelas = '$i_skkd' ".
								"AND mahasiswa_absen.kd_tapel = '$tapelkd' ".
								"AND mahasiswa_absen.kd_smt = '$smtkd' ".
								"AND mahasiswa_absen.kd_makul = '$mkkd'");
		$rxnil = mysqli_fetch_assoc($qxnil);
		$txnil = mysqli_num_rows($qxnil);

		//jumlah hadir
		$jml_hadir = round(12 - $txnil);
	

		$arr = array($i_nim,$i_nama,$xpel_tugas,$xpel_uts,$xpel_uas,$xpel_sp);
		$excel->writeLine($arr);

		}
	while ($rku = mysqli_fetch_assoc($qku));
	


	$excel -> close();


	//Buat link untuk download file excel
	$ke = "$lokasi$excelfile";
	xloc($ke);
	exit();
	}





//ke import
if ($_POST['btnIM'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$smtkd = nosql($_POST['smtkd']);
	$kelkd = nosql($_POST['kelkd']);
	$progdi = nosql($_POST['progdi']);
	$rukd = nosql($_POST['rukd']);
	$mkkd = nosql($_POST['mkkd']);
	$page = nosql($_POST['page']);
	$jml = nosql($_POST['jml']);


	//re-direct
	$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&progdi=$progdi&rukd=$rukd&smtkd=$smtkd&mkkd=$mkkd&s=import";
	xloc($ke);
	exit();
	}





//import
if ($_POST['btnIM2'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$smtkd = nosql($_POST['smtkd']);
	$kelkd = nosql($_POST['kelkd']);
	$progdi = nosql($_POST['progdi']);
	$rukd = nosql($_POST['rukd']);
	$mkkd = nosql($_POST['mkkd']);
	$page = nosql($_POST['page']);
	$filex_namex = strip(strtolower($_FILES['filex_xls']['name']));



	//nek null
	if (empty($filex_namex))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&progdi=$progdi&rukd=$rukd&smtkd=$smtkd&mkkd=$mkkd&s=import";
		pekem($pesan,$ke);
		}
	else
		{
		//deteksi .xls
		$ext_filex = substr($filex_namex, -4);

		if ($ext_filex == ".xls")
			{
			//nilai
			$path1 = "../../filebox";
			$path2 = "../../filebox/excel";
			chmod($path1,0777);
			chmod($path2,0777);


			//mengkopi file
			copy($_FILES['filex_xls']['tmp_name'],"../../filebox/excel/$filex_namex");

			//chmod
            $path3 = "../../filebox/excel/$filex_namex";
			chmod($path1,0755);
			chmod($path2,0755);
			chmod($path3,0755);
			



			//rumus
			$qcc = mysqli_query($koneksi, "SELECT * FROM set_rumus ".
									"WHERE kd_tapel = '$tapelkd' ".
									"AND kd_progdi = '$progdi' ".
									"AND kd_kelas = '$kelkd'");
			$rcc = mysqli_fetch_assoc($qcc);
			$tcc = mysqli_num_rows($qcc);
			$cc_p_absensi = nosql($rcc['persen_absensi']);
			$cc_p_tugas = nosql($rcc['persen_tugas']);
			$cc_p_uts = nosql($rcc['persen_uts']);
			$cc_p_uas = nosql($rcc['persen_uas']);		
		


			//file-nya...
			$uploadfile = $path3;

			//require
			require_once '../../inc/class/excel/excel_reader2.php';


			// membaca file excel yang diupload
			$data = new Spreadsheet_Excel_Reader($uploadfile);


			// membaca jumlah baris dari data excel
//			$baris = $data->rowcount($sheet_index=0);
			$baris = $data->rowcount(0);
			$sheet_ke = 0;


			// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
			for ($i=2; $i<=$baris+5; $i++)
				{
				$i_xyz = md5("$x$i");
				$i_nim = $data->val($i, 1,$sheet_ke);
				$i_nama = $data->val($i, 2,$sheet_ke);
				$i_tugas = $data->val($i, 3,$sheet_ke);
				$i_uts = $data->val($i, 4,$sheet_ke);
				$i_uas = $data->val($i, 5,$sheet_ke);
				$i_sp = $data->val($i, 6,$sheet_ke);
				

				
				//detail
				$qku = mysqli_query($koneksi, "SELECT DISTINCT(mahasiswa_kelas.kd) AS skkd ".
										"FROM m_mahasiswa, mahasiswa_kelas ".
										"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
										"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
										"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
										"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
										"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
										"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
										"AND m_mahasiswa.nim = '$i_nim'");
				$rku = mysqli_fetch_assoc($qku);
				$ku_skkd = nosql($rku['skkd']);
									


					
					
				//nil mapel
				$qxpel = mysqli_query($koneksi, "SELECT * FROM mahasiswa_nilai ".
										"WHERE kd_mahasiswa_kelas = '$ku_skkd' ".
										"AND kd_tapel = '$tapelkd' ".
										"AND kd_smt = '$smtkd' ".
										"AND kd_makul = '$mkkd'");
				$rxpel = mysqli_fetch_assoc($qxpel);
				$txpel = mysqli_num_rows($qxpel);
		
		
				//jika ada, update
				if ($txpel != 0)
					{
					mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET nil_tugas = '$i_tugas', ".
									"nil_uts = '$i_uts', ".
									"nil_uas = '$i_uas', ".
									"nil_sp = '$i_sp' ".
									"WHERE kd_mahasiswa_kelas = '$ku_skkd' ".
									"AND kd_tapel = '$tapelkd' ".
									"AND kd_smt = '$smtkd' ".
									"AND kd_makul = '$mkkd'");
					}
		
				//jika blm ada, insert
				else
					{
					mysqli_query($koneksi, "INSERT INTO mahasiswa_nilai(kd, kd_mahasiswa_kelas, kd_tapel, kd_smt, ".
									"kd_makul, nil_tugas, nil_uts, nil_uas, nil_sp) VALUES ".
									"('$i_xyz', '$ku_skkd', '$tapelkd', '$smtkd', ".
									"'$mkkd', '$i_tugas', '$i_uts', '$i_uas', '$i_sp')");
					}

				}


			//hapus file, jika telah import
			$path1 = "../../filebox/excel/$filex_namex";
			chmod($path1,0777);
			unlink ($path1);

			//null-kan
			xclose($koneksi);

			//re-direct
			$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&progdi=$progdi&rukd=$rukd&smtkd=$smtkd&mkkd=$mkkd";
			xloc($ke);
			exit();
			}
		else
			{
			//null-kan
			xclose($koneksi);

			//salah
			$pesan = "Bukan File .xls . Harap Diperhatikan...!!";
			$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&progdi=$progdi&rukd=$rukd&smtkd=$smtkd&mkkd=$mkkd&s=import";
			pekem($pesan,$ke);
			exit();
			}
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////









//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/menu/admdosen.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>';
xheadline($judul);
echo ' [<a href="../index.php" title="Daftar Mata Kuliah">Daftar Mata Kuliah</a>]</td>
</tr>
</table>

<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Tahun Akademik : ';
//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<b>'.$tpx_thn1.'/'.$tpx_thn2.'</b>,


Semester : ';
//terpilih
$qprgx2 = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowprgx2 = mysqli_fetch_assoc($qprgx2);
$prgx2_kd = nosql($rowprgx2['kd']);
$prgx2_smt = balikin($rowprgx2['smt']);

echo '<b>'.$prgx2_smt.'</b>,

Jenis : ';
//terpilih
$qbtx = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd = '$kelkd'");
$rowbtx = mysqli_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxno = nosql($rowbtx['no']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<b>'.$btxkelas.'</b>,

Program Studi : ';
//terpilih
$qprgx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowprgx = mysqli_fetch_assoc($qprgx);
$prgx_kd = nosql($rowprgx['kd']);
$prgx_nama = balikin($rowprgx['nama']);

echo '<b>'.$prgx_nama.'</b>,


Kelas : ';

//ruang
$qstx = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
				"WHERE kd = '$rukd'");
$rowstx = mysqli_fetch_assoc($qstx);
$ruang = nosql($rowstx['ruang']);

echo '<b>'.$ruang.'</b>
</td>
</tr>
</table>

<table bgcolor="'.$warna02.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Mata Kuliah : ';
//terpilih
$qprgx2 = mysqli_query($koneksi, "SELECT * FROM m_makul ".
			"WHERE kd = '$mkkd'");
$rowprgx2 = mysqli_fetch_assoc($qprgx2);
$prgx2_kd = nosql($rowprgx2['kd']);
$prgx2_nama = balikin($rowprgx2['nama']);

echo '<b>'.$prgx2_nama.'</b>


<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
<input name="smtkd" type="hidden" value="'.$smtkd.'">
<input name="kelkd" type="hidden" value="'.$kelkd.'">
<input name="progdi" type="hidden" value="'.$progdi.'">
<input name="rukd" type="hidden" value="'.$rukd.'">
<input name="mkkd" type="hidden" value="'.$mkkd.'">
<input name="page" type="hidden" value="'.$page.'">
<input name="s" type="hidden" value="'.$s.'">
</td>
</tr>
</table>';





//jika import
if ($s == "import")
	{
	echo '<p>
	Silahkan Masukkan File yang akan Di-Import :
	<br>
	<input name="filex_xls" type="file" size="30">
	<br>
	<input name="btnBTL" type="submit" value="BATAL">
	<input name="btnIM2" type="submit" value="IMPORT >>">
	</p>
	
	<p>
	NB. Setelah Berhasil Import, Tekan Tombol SIMPAN.
	</p>';
	}
else 
	{
	//daftar siswa
	$p = new Pager();
	$start = $p->findStart($limit);
	
	/*
		$sqlcount = "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
						"mahasiswa_kelas.*, mahasiswa_kelas.kd AS skkd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
						"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
						"ORDER BY round(m_mahasiswa.nim) ASC";
		$sqlresult = $sqlcount;
	*/
	$sqlcount = "SELECT DISTINCT(m_mahasiswa.kd) AS mskd ".
					"FROM m_mahasiswa, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
					"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
					"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
					"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
					"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
					"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;
	
	
	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?tapelkd=$tapelkd&smtkd=$smtkd&kelkd=$kelkd&progdi=$progdi&rukd=$rukd&mkkd=$mkkd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);
	
	
	//jika ada data
	if ($count != 0)
		{
		//rumus
		$qcc = mysqli_query($koneksi, "SELECT * FROM set_rumus ".
								"WHERE kd_tapel = '$tapelkd' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_kelas = '$kelkd'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_p_absensi = nosql($rcc['persen_absensi']);
		$cc_p_tugas = nosql($rcc['persen_tugas']);
		$cc_p_uts = nosql($rcc['persen_uts']);
		$cc_p_uas = nosql($rcc['persen_uas']);		
	
		
		echo '<p>
		<INPUT type="submit" name="btnIM" value="IMPORT">
		<INPUT type="submit" name="btnEX" value="EXPORT">
		<table width="700" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="100"><strong>NIM</strong></td>
		<td><strong>NAMA</strong></td>
		<td width="50"><strong>HADIR ('.$cc_p_absensi.'%)</strong></td>
		<td width="50"><strong>TUGAS ('.$cc_p_tugas.'%)</strong></td>
		<td width="50"><strong>UTS ('.$cc_p_uts.'%)</strong></td>
		<td width="50"><strong>UAS ('.$cc_p_uas.'%)</strong></td>
		<td width="50"><strong>NILAI AKHIR</strong></td>
		<td width="50"><strong>NILAI HURUF</strong></td>
		</tr>';
	
	
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
	
			//nilainya
			$i_nomer = $i_nomer + 1;
			$i_mskd = nosql($data['mskd']);
			
			//detail
			$qxpell = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
									"mahasiswa_kelas.*, mahasiswa_kelas.kd AS skkd ".
									"FROM m_mahasiswa, mahasiswa_kelas ".
									"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
									"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
									"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
									"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
									"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
									"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
									"AND m_mahasiswa.kd = '$i_mskd'");
			$rxpell = mysqli_fetch_assoc($qxpell);
			$i_skkd = nosql($rxpell['skkd']);
			$i_nim = nosql($rxpell['nim']);
			$i_nama = balikin($rxpell['nama']);
	
	
			//nil mapel
			$qxpel = mysqli_query($koneksi, "SELECT * FROM mahasiswa_nilai ".
									"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
									"AND kd_tapel = '$tapelkd' ".
									"AND kd_smt = '$smtkd' ".
									"AND kd_makul = '$mkkd'");
			$rxpel = mysqli_fetch_assoc($qxpel);
			$txpel = mysqli_num_rows($qxpel);
			$xpel_jml_hadir = nosql($rxpel['jml_hadir']);
			$xpel_tugas = nosql($rxpel['nil_tugas']);
			$xpel_uts = nosql($rxpel['nil_uts']);
			$xpel_uas = nosql($rxpel['nil_uas']);
			$xpel_akhir = nosql($rxpel['nil_akhir']);
			$xpel_sp = nosql($rxpel['nil_sp']);
	

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
	
	

/*	
			//nilai absensi
			$qxnil = mysqli_query($koneksi, "SELECT m_absen.*, m_absen.kd AS makd, ".
						"mahasiswa_absen.* ".
						"FROM m_absen, mahasiswa_absen ".
						"WHERE mahasiswa_absen.kd_absen = m_absen.kd ".
						"AND mahasiswa_absen.kd_mahasiswa_kelas = '$i_skkd' ".
						"AND mahasiswa_absen.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_absen.kd_smt = '$smtkd' ".
						"AND mahasiswa_absen.kd_makul = '$mkkd'");
			$rxnil = mysqli_fetch_assoc($qxnil);
			$txnil = mysqli_num_rows($qxnil);
	
			//jumlah hadir
			$jml_hadir = round(12 - $txnil);
	*/
	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<INPUT type="hidden" name="skkd'.$i_nomer.'" value="'.$i_skkd.'">
			'.$i_nim.'
			</td>
			<td>
			'.$i_nama.'
			</td>
			<td>
			<input name="hadir'.$i_nomer.'" type="text" value="'.$xpel_jml_hadir.'" size="2">
			</td>
			<td>
			<input name="tugas'.$i_nomer.'" type="text" value="'.$xpel_tugas.'" size="2" onKeyPress="return numbersonly(this, event)">
			</td>
			<td>
			<input name="uts'.$i_nomer.'" type="text" value="'.$xpel_uts.'" size="2" onKeyPress="return numbersonly(this, event)">
			</td>
			<td>
			<input name="uas'.$i_nomer.'" type="text" value="'.$xpel_uas.'" size="2" onKeyPress="return numbersonly(this, event)">
			</td>
			<td>
			<input name="akhir'.$i_nomer.'" type="text" value="'.$xpel_akhir.'" size="5" onKeyPress="return numbersonly(this, event)">
			</td>
			<td>
			<input name="huruf'.$i_nomer.'" type="text" value="'.$nil_huruf.'" size="2" class="input" readonly>
			</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
	
	
		echo '</table>
		<table width="700" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="400">
		<input name="jml" type="hidden" value="'.$count.'">
		<input name="btnSMP" type="submit" value="SIMPAN">
		</td>
		<td align="right">'.$pagelist.'</td>
		</tr>
		</table>
		</p>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>Belum Ada Data Mahasiswa.</strong>.
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