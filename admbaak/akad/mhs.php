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

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admbaak.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "mhs.php";
$judul = "Data Mahasiswa";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$s = nosql($_REQUEST['s']);








//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ke import
if ($_POST['btnIM'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);


	//cek
	if ((empty($kelkd)) OR (empty($tapelkd)))
		{
		//re-direct
		$pesan = "Tahun Pelajaran atau Kelas, Belum Dipilih. Harap Diperhatikan...!!";
		$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//re-direct
		$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=import";
		xloc($ke);
		exit();
		}
	}




//import
if ($_POST['btnIM2'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$filex_namex = strip(strtolower($_FILES['filex_xls']['name']));



	//nek null
	if (empty($filex_namex))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=import";
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

			//re-direct
			$ke = "mhs_import.php?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&filex_namex=$filex_namex";
			xloc($ke);
			exit();
			}
		else
			{
			//re-direct
			$pesan = "Bukan File .xls . Harap Diperhatikan...!!";
			$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=import";
			pekem($pesan,$ke);
			exit();
			}
		}
	}





//export
if ($_POST['btnEX'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);


	//require
	include("../../inc/class/excel/excelwriter.inc.php");


	//Buat nama file yang di inginkan
	$excelfile = 'mhs_'.date("Y-m-d-H-i-s").'.xls';
	//lokasi hasil konversi
	$lokasi	   = '../../filebox/excel/';
	$excel=new ExcelWriter($lokasi.$excelfile);
	


	//Buat header untuk tabel
	$myArr = array("NO_URUT","NIM","NAMA","KELAMIN","TMP_LAHIR","TGL_LAHIR","STATUS_SIPIL","WARGA_NEGARA", 
						"AGAMA","ALAMAT_SEKARANG","ALAMAT_ASAL","PDDKN_ASAL","PDDKN_STATUS","PDDKN_JURUSAN",
						"PDDKN_LULUS","STATUS_MASUK","STATUS_SEBAGAI","STATUS_TERDAFTAR","STATUS_PROGDI",
						"STATUS_JENJANG","STATUS_PINDAH_ASAL","STATUS_PINDAH_PROGDI","STATUS_PINDAH_JURUSAN", 
						"STATUS_PINDAH_JENJANG","SEHAT_TB","SEHAT_BB","SEHAT_MATA","SEHAT_DARAH",
						"SEHAT_DENGAR","SEHAT_PERNAH_DERITA","SEHAT_SEDANG_DERITA","ORGANISASI_A",
						"ORGANISASI_B","ORGANISASI_C","HOBI_A","HOBI_B","HOBI_C","AYAH_NAMA","AYAH_PDDKN", 
						"AYAH_KERJA","AYAH_ALAMAT","AYAH_HIDUP","IBU_NAMA","IBU_PDDKN","IBU_KERJA", 
						"IBU_ALAMAT","IBU_HIDUP","PENANGGUNG_NAMA","PENANGGUNG_HUBUNGAN","HASIL_BULANAN", 
						"HASIL_TAHUNAN","IJAZAH_NOMOR","IJAZAH_TANGGAL","IJAZAH_TANGGAL_TERIMA", "NIM_PUSAT");
	$excel->writeLine($myArr);



	//jika null
	if (!empty($progdi))
		{
		$ku_progdi = "AND mahasiswa_kelas.kd_progdi = '$progdi'";
		}


	if (!empty($kelkd))
		{
		$ku_kelkd = "AND mahasiswa_kelas.kd_kelas = '$kelkd'";
		}


	if (!empty($tapelkd))
		{
		$ku_tapelkd = "AND m_mahasiswa_status.kd_tapel = '$tapelkd'";
		}



	//looping
	$qdt = mysql_query("SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
							"FROM m_mahasiswa, mahasiswa_kelas, m_mahasiswa_status ".
							"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
							"AND m_mahasiswa_status.kd_mahasiswa = m_mahasiswa.kd ".
							"$ku_progdi ".
							"$ku_kelkd ".
							"$ku_tapelkd ".
							"ORDER BY round(m_mahasiswa.nim) ASC");
	$rdt = mysql_fetch_assoc($qdt);


	do
		{
		$i_nomer = $i_nomer + 1;
		$i_nim = balikin2($rdt['nim']);


		//detail
		$qdti = mysql_query("SELECT m_mahasiswa.*, ".
					"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%d') AS lahir_tgl, ".
					"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%m') AS lahir_bln, ".
					"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%Y') AS lahir_thn, ".
					"m_mahasiswa.kd AS mskd, ".
					"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
					"FROM m_mahasiswa, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND m_mahasiswa.nim = '$i_nim'");
		$rdti = mysql_fetch_assoc($qdti);
		$rnil = $rdti;
		$dt_kd = nosql($rdti['mskd']);
		$dt_mkkd = nosql($rdti['mkkd']);
		$dt_nama = balikin($rdti['nama']);
		$dt_nim_pusat = nosql($rdti['nim_pusat']);
		$kd = $dt_kd;
		$i_nama = $dt_nama;


		$tmp_lahir = balikin($rnil['tmp_lahir']);

		$lahir_tgl = nosql($rnil['lahir_tgl']);
		$lahir_bln = nosql($rnil['lahir_bln']);
		$lahir_thn = nosql($rnil['lahir_thn']);
		$tgl_lahir = "$lahir_tgl/$lahir_bln/$lahir_thn";

		$jkelkd = nosql($rnil['kelamin']);
		$a_status_sipil = balikin($rnil['status_sipil']);
		$a_warga = balikin($rnil['warga_negara']);
		$jagmkd = nosql($rnil['kd_agama']);


		//terpilih
		$qagmx = mysql_query("SELECT * FROM m_agama ".
					"WHERE kd = '$jagmkd'");
		$ragmx = mysql_fetch_assoc($qagmx);
		$agmx_agama = balikin($ragmx['agama']);


		$a_alamat_skrg = balikin($rnil['alamat_skrg']);
		$a_alamat_asal = balikin($rnil['alamat_asal']);
		$y_filex = $rnil['filex'];



		//asal pddkn
		$qku1 = mysql_query("SELECT * FROM m_mahasiswa_pddkn ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku1 = mysql_fetch_assoc($qku1);
		$ku1_asal_sekolah = balikin($rku1['asal_sekolah']);
		$ku1_thn_lulus = balikin($rku1['thn_lulus']);
		$ku1_jurusan = balikin($rku1['jurusan']);
		$ku1_status_asal_sekolah = balikin($rku1['status_asal_sekolah']);



		//jika ayah hidup
		if ($ku6_ayah_hidup == "true")
			{
			$ku6_ayah_hidup_ket = "Ya";
			}
		else
			{
			$ku6_ayah_hidup_ket = "Tidak";
			}

		//jika ibu hidup
		if ($ku6_ibu_hidup == "true")
			{
			$ku6_ibu_hidup_ket = "Ya";
			}
		else
			{
			$ku6_ibu_hidup_ket = "Tidak";
			}




		//ciptakan


		//status mahasiswa
		$qku2 = mysql_query("SELECT * FROM m_mahasiswa_status ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku2 = mysql_fetch_assoc($qku2);
		$ku2_tapelkd = nosql($rku2['kd_tapel']);
		$ku2_status = balikin($rku2['status']);
		$ku2_sebagai_mhs = balikin($rku2['sebagai_mhs']);
		$ku2_kd_progdi = balikin($rku2['kd_progdi']);
		$ku2_kd_jenjang = balikin($rku2['kd_jenjang']);
		$ku2_pindahan_pt = balikin($rku2['pindahan_pt']);
		$ku2_pindahan_progdi = balikin($rku2['pindahan_progdi']);
		$ku2_pindahan_jurusan = balikin($rku2['pindahan_jurusan']);
		$ku2_pindahan_jenjang = balikin($rku2['pindahan_jenjang']);
		$ku2_smtkd = nosql($rku2['kd_smt']);


		//terpilih
		$qpro1 = mysql_query("SELECT * FROM m_progdi ".
					"WHERE kd = '$ku2_kd_progdi'");
		$rpro1 = mysql_fetch_assoc($qpro1);
		$pro1_nama = balikin($rpro1['nama']);



		//terpilih
		$qjnej1 = mysql_query("SELECT * FROM m_jenjang ".
					"WHERE kd = '$ku2_kd_jenjang'");
		$rjenj1 = mysql_fetch_assoc($qjnej1);
		$jenj1_nama = balikin($rjenj1['jenjang']);


		//jika null
		if (empty($ku2_tapelkd))
			{
			$ku2_tapelkd = $tapelkd;
			}


		//jika null, anggap saja masuk sejak semester awal / satu
		if (empty($ku2_smtkd))
			{
			$ku2_smtkd = "c4ca4238a0b923820dcc509a6f75849b";
			}



		//sehat
		$qku3 = mysql_query("SELECT * FROM m_mahasiswa_sehat ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku3 = mysql_fetch_assoc($qku3);
		$ku3_tb = balikin($rku3['tb']);
		$ku3_bb = balikin($rku3['bb']);
		$ku3_mata = balikin($rku3['mata']);
		$ku3_gol_darah = balikin($rku3['gol_darah']);
		$ku3_pendengaran = balikin($rku3['pendengaran']);
		$ku3_penyakit_pernah = balikin($rku3['penyakit_pernah']);
		$ku3_penyakit_sekarang = balikin($rku3['penyakit_sekarang']);

		


		//organisasi
		$qku4 = mysql_query("SELECT * FROM m_mahasiswa_org ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku4 = mysql_fetch_assoc($qku4);
		$ku4_org_a = balikin($rku4['org_a']);
		$ku4_org_b = balikin($rku4['org_b']);
		$ku4_org_c = balikin($rku4['org_c']);
		

		//hobi
		$qku5 = mysql_query("SELECT * FROM m_mahasiswa_hobi ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku5 = mysql_fetch_assoc($qku5);
		$ku5_hobi_a = balikin($rku5['hobi_a']);
		$ku5_hobi_b = balikin($rku5['hobi_b']);
		$ku5_hobi_c = balikin($rku5['hobi_c']);



		//ortu
		$qku6 = mysql_query("SELECT * FROM m_mahasiswa_ortu ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku6 = mysql_fetch_assoc($qku6);
		$ku6_ayah_nama = balikin($rku6['ayah_nama']);
		$ku6_ayah_pddkn = balikin($rku6['ayah_pddkn']);
		$ku6_ayah_pekerjaan = balikin($rku6['ayah_pekerjaan']);
		$ku6_ayah_alamat = balikin($rku6['ayah_alamat']);
		$ku6_ayah_hidup = balikin($rku6['ayah_hidup']);
		$ku6_ibu_nama = balikin($rku6['ibu_nama']);
		$ku6_ibu_pddkn = balikin($rku6['ibu_pddkn']);
		$ku6_ibu_pekerjaan = balikin($rku6['ibu_pekerjaan']);
		$ku6_ibu_alamat = balikin($rku6['ibu_alamat']);
		$ku6_ibu_hidup = balikin($rku6['ibu_hidup']);
		$ku6_nama_pj = balikin($rku6['nama_pj']);
		$ku6_hubungan = balikin($rku6['hubungan']);
		$ku6_hasil_per_bulan = balikin($rku6['hasil_per_bulan']);
		$ku6_hasil_per_tahun = balikin($rku6['hasil_per_tahun']);



		//ijazah
		$qnil2 = mysql_query("SELECT m_mahasiswa_alumni.*, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_terima_ijazah, '%d') AS tgl_terima, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_terima_ijazah, '%m') AS bln_terima, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_terima_ijazah, '%Y') AS thn_terima, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_ijazah, '%d') AS tgl_ijazah, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_ijazah, '%m') AS bln_ijazah, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_ijazah, '%Y') AS thn_ijazah, ".
					"mahasiswa_kelas.* ".
					"FROM m_mahasiswa_alumni, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa_alumni.kd_mahasiswa ".
					"AND mahasiswa_kelas.kd_mahasiswa = '$kd'");
		$rnil2 = mysql_fetch_assoc($qnil2);
		$y_tgl_terima_ijazah = nosql($rnil2['tgl_terima']);
		$y_bln_terima_ijazah = nosql($rnil2['bln_terima']);
		$y_thn_terima_ijazah = nosql($rnil2['thn_terima']);
		$y_terima_ijazah = "$y_tgl_terima_ijazah/$y_bln_terima_ijazah/$y_thn_terima_ijazah";
		$y_tgl_ijazah = nosql($rnil2['tgl_ijazah']);
		$y_bln_ijazah = nosql($rnil2['bln_ijazah']);
		$y_thn_ijazah = nosql($rnil2['thn_ijazah']);
		$y_ijazah = "$y_tgl_ijazah/$y_bln_ijazah/$y_thn_ijazah";
		$y_no_ijazah = balikin2($rnil2['no_ijazah']);
					
		$arr = array($i_nomer,$i_nim,$i_nama,$jkelkd,$tmp_lahir,$tgl_lahir,$a_status_sipil,$a_warga,
						$agmx_agama,$a_alamat_skrg,$a_alamat_asal,$ku1_asal_sekolah,$ku1_status_asal_sekolah,
						$ku1_jurusan,$ku1_thn_lulus,$ku2_status,$ku2_status,$ku2_sebagai_mhs,$pro1_nama,
						$jenj1_nama,$ku2_pindahan_pt,$ku2_pindahan_progdi,$ku2_pindahan_jurusan,
						$ku2_pindahan_jenjang,$ku3_tb,$ku3_bb,$ku3_mata,$ku3_gol_darah,$ku3_pendengaran, 
						$ku3_penyakit_pernah,$ku3_penyakit_sekarang,$ku4_org_a,$ku4_org_b,$ku4_org_c,
						$ku5_hobi_a,$ku5_hobi_b,$ku5_hobi_c,$ku6_ayah_nama,$ku6_ayah_pddkn,
						$ku6_ayah_pekerjaan,$ku6_ayah_alamat,$ku6_ayah_hidup,$ku6_ibu_nama, 
						$ku6_ibu_pddkn,$ku6_ibu_pekerjaan,$ku6_ibu_alamat,$ku6_ibu_hidup,$ku6_nama_pj,
						$ku6_hubungan,$ku6_hasil_per_bulan,$ku6_hasil_per_tahun,$y_no_ijazah,
						$y_ijazah,$y_terima_ijazah, $dt_nim_pusat);
		
	
		$excel->writeLine($arr);
		}
	while ($rdt = mysql_fetch_assoc($qdt));


	$excel -> close();
	
	//diskonek
	xclose($koneksi);


	//re-direct
//	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd";
//	xloc($ke);
//	exit();



	//Buat link untuk download file excel
//	echo 'Download file excel anda <a href="'.$lokasi.$excelfile.'">disini</a>';
	$ke = "$lokasi$excelfile";
	xloc($ke);
	exit();

	}








//batal
if ($_POST['btnBTL'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);

	//re-direct
	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd";
	xloc($ke);
	exit();
	}






//ke daftar mhs
if ($_POST['btnDF'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);

	//re-direct
	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd";
	xloc($ke);
	exit();
	}




//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$jml = nosql($_POST['jml']);
	$page = nosql($_REQUEST['page']);
	if ((empty($page)) OR ($page == "0"))
		{
		$page = "1";
		}



/*
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
			"FROM m_mahasiswa, mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
			"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
			"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
			"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;

	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);

	//ambil semua
	do
		{
		//ambil nilai
		$i = $i + 1;
		$yuk = "item";
		$yuhu = "$yuk$i";
		$i_kd = nosql($_POST["$yuhu"]);


		//nek $kd gak null
		if (!empty($i_kd))
			{
			//hapus file
			$cc_filex = $data['filex'];
			$path1 = "../../filebox/mahasiswa/$i_kd/$cc_filex";
			unlink ($path1);
			}

		//del
		mysql_query("DELETE FROM mahasiswa_kelas ".
				"WHERE kd_mahasiswa = '$i_kd'");

		//del
		mysql_query("DELETE FROM m_mahasiswa ".
				"WHERE kd = '$i_kd'");
		}
	while ($data = mysql_fetch_assoc($result));


*/

	for ($k=1;$k<=$jml;$k++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$k";
		$i_kd = nosql($_POST["$yuhu"]);


		//hapus file
		$path1 = "../../filebox/mahasiswa/$i_kd/";
		unlink ($path1);



		//del
		mysql_query("DELETE FROM mahasiswa_kelas ".
				"WHERE kd_mahasiswa = '$i_kd'");

		//del
		mysql_query("DELETE FROM m_mahasiswa ".
				"WHERE kd = '$i_kd'");
		}



	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&page=$page";
	xloc($ke);
	exit();
	}




//jika simpan
if ($_POST['btnSMP1'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);




	//jika baru ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($s == "add")
		{
		//nilai
		$a_nim = nosql($_POST['a_nim']);
		$a_nim_pusat = nosql($_POST['a_nim_pusat']);
		$a_nama1 = cegah($_POST['a_nama1']);
		$a_tmp_lahir = cegah($_POST['a_tmp_lahir']);

		$a_lahir_tgl = nosql($_POST['a_lahir_tgl']);
		$a_lahir_bln = nosql($_POST['a_lahir_bln']);
		$a_lahir_thn = nosql($_POST['a_lahir_thn']);
		$a_tgl_lahir = "$a_lahir_thn:$a_lahir_bln:$a_lahir_tgl";

		$a_kelamin = nosql($_POST['a_kelamin']);
		$a_agama = nosql($_POST['a_agama']);
		$a_status_sipil = cegah($_POST['a_status_sipil']);
		$a_warga = cegah($_POST['a_warga']);
		$a_alamat_asal = cegah($_POST['a_alamat_asal']);
		$a_alamat_skrg = cegah($_POST['a_alamat_skrg']);
		$a_asal_smta = cegah($_POST['a_asal_smta']);
		$a_status_smta = cegah($_POST['a_status_smta']);
		$a_jurusan_smta = cegah($_POST['a_jurusan_smta']);
		$a_thn_lulus = cegah($_POST['a_thn_lulus']);
		$a_thn_masuk = nosql($_POST['a_thn_masuk']);
		$a_status_mhs = cegah($_POST['a_status_mhs']);
		$a_sebagai_mhs = cegah($_POST['a_sebagai_mhs']);
		$a_progdi = cegah($_POST['a_progdi']);
		$a_jenjang = cegah($_POST['a_jenjang']);
		$a_pindahan_pt_asal = cegah($_POST['a_pindahan_pt_asal']);
		$a_pindahan_jurusan = cegah($_POST['a_pindahan_jurusan']);
		$a_pindahan_progdi = cegah($_POST['a_pindahan_progdi']);
		$a_pindahan_jenjang = cegah($_POST['a_pindahan_jenjang']);
		$a_smt = nosql($_POST['a_smt']);
		$a_tb = cegah($_POST['a_tb']);
		$a_bb = cegah($_POST['a_bb']);
		$a_mata = cegah($_POST['a_mata']);
		$a_goldarah = cegah($_POST['a_goldarah']);
		$a_dengar = cegah($_POST['a_dengar']);
		$a_penyakit = cegah($_POST['a_penyakit']);
		$a_penyakit_skrg = cegah($_POST['a_penyakit_skrg']);

		$a_org_a = cegah($_POST['a_org_a']);
		$a_org_b = cegah($_POST['a_org_b']);
		$a_org_c = cegah($_POST['a_org_c']);

		$a_hobi_a = cegah($_POST['a_hobi_a']);
		$a_hobi_b = cegah($_POST['a_hobi_b']);
		$a_hobi_c = cegah($_POST['a_hobi_c']);

		$b_ayah_nama = cegah($_POST['b_ayah_nama']);
		$b_ayah_pddkn = cegah($_POST['b_ayah_pddkn']);
		$b_ayah_kerja = cegah($_POST['b_ayah_kerja']);
		$b_ayah_alamat = cegah($_POST['b_ayah_alamat']);
		$b_ayah_hidup = cegah($_POST['b_ayah_hidup']);

		$b_ibu_nama = cegah($_POST['b_ibu_nama']);
		$b_ibu_pddkn = cegah($_POST['b_ibu_pddkn']);
		$b_ibu_kerja = cegah($_POST['b_ibu_kerja']);
		$b_ibu_alamat = cegah($_POST['b_ibu_alamat']);
		$b_ibu_hidup = cegah($_POST['b_ibu_hidup']);

		$b_nama_pj = cegah($_POST['b_nama_pj']);
		$b_hubungan = cegah($_POST['b_hubungan']);
		$b_hasil_bulan = cegah($_POST['b_hasil_bulan']);
		$b_hasil_tahun = cegah($_POST['b_hasil_tahun']);


		$ijazah_terima_tgl = nosql($_POST['ijazah_terima_tgl']);
		$ijazah_terima_bln = nosql($_POST['ijazah_terima_bln']);
		$ijazah_terima_thn = nosql($_POST['ijazah_terima_thn']);
		$tgl_terima_ijazah = ("$ijazah_terima_thn:$ijazah_terima_bln:$ijazah_terima_tgl");

		$ijazah_tgl = nosql($_POST['ijazah_tgl']);
		$ijazah_bln = nosql($_POST['ijazah_bln']);
		$ijazah_thn = nosql($_POST['ijazah_thn']);
		$tgl_ijazah = ("$ijazah_thn:$ijazah_bln:$ijazah_tgl");

		$tulis_tgl = nosql($_POST['tulis_tgl']);
		$tulis_bln = nosql($_POST['tulis_bln']);
		$tulis_thn = nosql($_POST['tulis_thn']);
		$tgl_tulis = ("$tulis_thn:$tulis_bln:$tulis_tgl");

		$no_ijazah = cegah($_POST['no_ijazah']);



		//dinyatakan jadi alumni, jika telah tertulis tanggal ijazah dan tanggal terima ijazah.
		if (($tgl_terima_ijazah != "0000:00:00") AND ($tgl_ijazah != "0000:00:00"))
			{
			$st_alumni = "true";
			}
		else
			{
			$st_alumni = "false";
			}




		//nek null
		if ((empty($a_nim)) OR (empty($a_nama1)) OR (empty($a_thn_masuk)) OR (empty($a_smt)))
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Input Tidak Lengkap. Harap Diulangi...!";
			$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=add&kd=$x";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//cek
			$qcc = mysql_query("SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND m_mahasiswa.nim = '$a_nim'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//nek ada
			if ($tcc != 0)
				{
				//re-direct
				$pesan = "NIM Tersebut Sudah Ada. Silahkan Ganti Yang Lain...!!";
				$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=add&kd=$x";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//set akses
				$x_userx = $a_nim;
				$x_passx = md5($a_nim);

				//insert
				mysql_query("INSERT INTO m_mahasiswa(kd, usernamex, passwordx, nim, nama, ".
						"tmp_lahir, tgl_lahir, kelamin, kd_agama, ".
						"alamat_asal, alamat_skrg, status_sipil, warga_negara) VALUES ".
						"('$kd', '$x_userx', '$x_passx', '$a_nim', '$a_nama1', ".
						"'$a_tmp_lahir', '$a_tgl_lahir', '$a_kelamin', '$a_agama', ".
						"'$a_alamat_asal', '$a_alamat_skrg', '$a_status_sipil', '$a_warga')");

				//insert kelas-nya
				mysql_query("INSERT INTO mahasiswa_kelas(kd, kd_mahasiswa, kd_progdi, kd_kelas, ".
						"kd_tapel, kd_smt) VALUES ".
						"('$x', '$kd', '$progdi', '$kelkd', ".
						"'$a_thn_masuk', '$a_smt')");

				//asal pendidikan
				mysql_query("INSERT INTO m_mahasiswa_pddkn(kd, kd_mahasiswa, asal_sekolah, ".
						"thn_lulus, jurusan, status_asal_sekolah) VALUES ".
						"('$x', '$kd', '$a_asal_smta', ".
						"'$a_thn_lulus', '$a_jurusan_smta', '$a_status_smta')");

				//status
				mysql_query("INSERT INTO m_mahasiswa_status(kd, kd_mahasiswa, kd_tapel, ".
						"status, sebagai_mhs, kd_progdi, kd_jenjang, ".
						"pindahan_pt, pindahan_progdi, pindahan_jurusan, ".
						"pindahan_jenjang, kd_smt) VALUES ".
						"('$x', '$kd', '$a_thn_masuk', ".
						"'$a_status_mhs', '$a_sebagai_mhs', '$a_progdi', '$a_jenjang', ".
						"'$a_pindahan_pt_asal', '$a_pindahan_progdi', '$a_pindahan_jurusan', ".
						"'$a_pindahan_jenjang', '$a_smt')");

				//sehat
				mysql_query("INSERT INTO m_mahasiswa_sehat(kd, kd_mahasiswa, tb, bb, ".
						"mata, gol_darah, pendengaran, ".
						"penyakit_pernah, penyakit_sekarang) VALUES ".
						"('$x', '$kd', '$a_tb', '$a_bb', ".
						"'$a_mata', '$a_goldarah', '$a_dengar', ".
						"'$a_penyakit', '$a_penyakit_skrg')");

				//organisasi
				mysql_query("INSERT INTO m_mahasiswa_org(kd, kd_mahasiswa, org_a, org_b, org_c) VALUES ".
						"('$x', '$kd', '$a_org_a', '$a_org_b', '$a_org_c')");

				//hobi
				mysql_query("INSERT INTO m_mahasiswa_hobi(kd, kd_mahasiswa, hobi_a, hobi_b, hobi_c) VALUES ".
						"('$x', '$kd', '$a_hobi_a', '$a_hobi_b', '$a_hobi_c')");

				//ortu
				mysql_query("INSERT INTO m_mahasiswa_ortu(kd, kd_mahasiswa, ayah_nama, ".
						"ayah_pddkn, ayah_pekerjaan, ayah_alamat, ayah_hidup, ".
						"ibu_nama, ibu_pddkn, ibu_pekerjaan, ibu_alamat, ".
						"ibu_hidup, nama_pj, hubungan, hasil_per_bulan, ".
						"hasil_per_tahun) VALUES ".
						"('$x', '$kd', '$b_ayah_nama', ".
						"'$b_ayah_pddkn', '$b_ayah_kerja', '$b_ayah_alamat', '$b_ayah_hidup', ".
						"'$b_ibu_nama', '$b_ibu_pddkn', '$b_ibu_kerja', '$b_ibu_alamat', ".
						"'$b_ibu_hidup', '$b_nama_pj', '$b_hubungan', '$b_hasil_bulan', ".
						"'$b_hasil_tahun')");


				//alumni
				mysql_query("INSERT INTO m_mahasiswa_alumni(kd, kd_mahasiswa, tgl_terima_ijazah, tgl_ijazah, ".
						"tgl_tulis, no_ijazah, alumni) VALUES ".
						"('$x', '$kd', '$tgl_terima_ijazah', '$tgl_ijazah', ".
						"'$today', '$no_ijazah', '$st_alumni')");


				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=edit&kd=$kd";
				xloc($ke);
				exit();
				}
			}
		}


	//jika edit ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	else if ($s == "edit")
		{
		//nilai
		$a_nim = nosql($_POST['a_nim']);
		$a_nim_pusat = nosql($_POST['a_nim_pusat']);
		$a_nama1 = cegah($_POST['a_nama1']);
		$a_tmp_lahir = cegah($_POST['a_tmp_lahir']);

		$a_lahir_tgl = nosql($_POST['a_lahir_tgl']);
		$a_lahir_bln = nosql($_POST['a_lahir_bln']);
		$a_lahir_thn = nosql($_POST['a_lahir_thn']);
		$a_tgl_lahir = "$a_lahir_thn:$a_lahir_bln:$a_lahir_tgl";

		$a_kelamin = nosql($_POST['a_kelamin']);
		$a_agama = nosql($_POST['a_agama']);
		$a_status_sipil = cegah($_POST['a_status_sipil']);
		$a_warga = cegah($_POST['a_warga']);
		$a_alamat_asal = cegah($_POST['a_alamat_asal']);
		$a_alamat_skrg = cegah($_POST['a_alamat_skrg']);
		$a_asal_smta = cegah($_POST['a_asal_smta']);
		$a_status_smta = cegah($_POST['a_status_smta']);
		$a_jurusan_smta = cegah($_POST['a_jurusan_smta']);
		$a_thn_lulus = cegah($_POST['a_thn_lulus']);
		$a_thn_masuk = cegah($_POST['a_thn_masuk']);
		$a_status_mhs = cegah($_POST['a_status_mhs']);
		$a_sebagai_mhs = cegah($_POST['a_sebagai_mhs']);
		$a_progdi = cegah($_POST['a_progdi']);
		$a_jenjang = cegah($_POST['a_jenjang']);
		$a_pindahan_pt_asal = cegah($_POST['a_pindahan_pt_asal']);
		$a_pindahan_jurusan = cegah($_POST['a_pindahan_jurusan']);
		$a_pindahan_progdi = cegah($_POST['a_pindahan_progdi']);
		$a_pindahan_jenjang = cegah($_POST['a_pindahan_jenjang']);
		$a_smt = nosql($_POST['a_smt']);
		$a_tb = cegah($_POST['a_tb']);
		$a_bb = cegah($_POST['a_bb']);
		$a_mata = cegah($_POST['a_mata']);
		$a_goldarah = cegah($_POST['a_goldarah']);
		$a_dengar = cegah($_POST['a_dengar']);
		$a_penyakit = cegah($_POST['a_penyakit']);
		$a_penyakit_skrg = cegah($_POST['a_penyakit_skrg']);

		$a_org_a = cegah($_POST['a_org_a']);
		$a_org_b = cegah($_POST['a_org_b']);
		$a_org_c = cegah($_POST['a_org_c']);

		$a_hobi_a = cegah($_POST['a_hobi_a']);
		$a_hobi_b = cegah($_POST['a_hobi_b']);
		$a_hobi_c = cegah($_POST['a_hobi_c']);

		$b_ayah_nama = cegah($_POST['b_ayah_nama']);
		$b_ayah_pddkn = cegah($_POST['b_ayah_pddkn']);
		$b_ayah_kerja = cegah($_POST['b_ayah_kerja']);
		$b_ayah_alamat = cegah($_POST['b_ayah_alamat']);
		$b_ayah_hidup = cegah($_POST['b_ayah_hidup']);

		$b_ibu_nama = cegah($_POST['b_ibu_nama']);
		$b_ibu_pddkn = cegah($_POST['b_ibu_pddkn']);
		$b_ibu_kerja = cegah($_POST['b_ibu_kerja']);
		$b_ibu_alamat = cegah($_POST['b_ibu_alamat']);
		$b_ibu_hidup = cegah($_POST['b_ibu_hidup']);

		$b_nama_pj = cegah($_POST['b_nama_pj']);
		$b_hubungan = cegah($_POST['b_hubungan']);
		$b_hasil_bulan = cegah($_POST['b_hasil_bulan']);
		$b_hasil_tahun = cegah($_POST['b_hasil_tahun']);

		$ijazah_terima_tgl = nosql($_POST['ijazah_terima_tgl']);
		$ijazah_terima_bln = nosql($_POST['ijazah_terima_bln']);
		$ijazah_terima_thn = nosql($_POST['ijazah_terima_thn']);
		$tgl_terima_ijazah = ("$ijazah_terima_thn:$ijazah_terima_bln:$ijazah_terima_tgl");

		$ijazah_tgl = nosql($_POST['ijazah_tgl']);
		$ijazah_bln = nosql($_POST['ijazah_bln']);
		$ijazah_thn = nosql($_POST['ijazah_thn']);
		$tgl_ijazah = ("$ijazah_thn:$ijazah_bln:$ijazah_tgl");

		$tulis_tgl = nosql($_POST['tulis_tgl']);
		$tulis_bln = nosql($_POST['tulis_bln']);
		$tulis_thn = nosql($_POST['tulis_thn']);
		$tgl_tulis = ("$tulis_thn:$tulis_bln:$tulis_tgl");

		$no_ijazah = cegah($_POST['no_ijazah']);



		//dinyatakan jadi alumni, jika telah tertulis tanggal ijazah dan tanggal terima ijazah.
		if (($tgl_terima_ijazah != "0000:00:00") AND ($tgl_ijazah != "0000:00:00"))
			{
			$st_alumni = "true";
			}
		else
			{
			$st_alumni = "false";
			}





		//set akses
		$x_userx = $nim;
		$x_passx = md5($nim);

		//update
		mysql_query("UPDATE m_mahasiswa SET usernamex = '$x_userx', ".
				"passwordx = '$x_passx', ".
				"nim = '$a_nim', ".
				"nim_pusat = '$a_nim_pusat', ".
				"nama = '$a_nama1', ".
				"tmp_lahir = '$a_tmp_lahir', ".
				"tgl_lahir = '$a_tgl_lahir', ".
				"kelamin = '$a_kelamin', ".
				"kd_agama = '$a_agama', ".
				"alamat_asal = '$a_alamat_asal', ".
				"alamat_skrg = '$a_alamat_skrg', ".
				"status_sipil = '$a_status_sipil', ".
				"warga_negara = '$a_warga' ".
				"WHERE kd = '$kd'");


		//insert kelas-nya
		mysql_query("UPDATE mahasiswa_kelas SET kd_smt = '$a_smt' ".
				"WHERE kd_tapel = '$a_thn_masuk' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_mahasiswa = '$kd'");


		//asal pendidikan
		mysql_query("UPDATE m_mahasiswa_pddkn SET asal_sekolah = '$a_asal_smta', ".
				"thn_lulus = '$a_thn_lulus', ".
				"jurusan = '$a_jurusan_smta', ".
				"status_asal_sekolah = '$a_status_smta' ".
				"WHERE kd_mahasiswa = '$kd'");

		//status
		mysql_query("UPDATE m_mahasiswa_status SET kd_tapel = '$a_thn_masuk', ".
				"status = '$a_status_mhs', ".
				"sebagai_mhs = '$a_sebagai_mhs', ".
				"kd_progdi = '$a_progdi', ".
				"kd_jenjang = '$a_jenjang', ".
				"pindahan_pt = '$a_pindahan_pt_asal', ".
				"pindahan_progdi = '$a_pindahan_progdi', ".
				"pindahan_jurusan = '$a_pindahan_jurusan', ".
				"pindahan_jenjang = '$a_pindahan_jenjang', ".
				"kd_smt = '$a_smt' ".
				"WHERE kd_mahasiswa = '$kd'");

		//sehat
		mysql_query("UPDATE m_mahasiswa_sehat SET tb = '$a_tb', ".
				"bb = '$a_bb', ".
				"mata = '$a_mata', ".
				"gol_darah = '$a_goldarah', ".
				"pendengaran = '$a_dengar', ".
				"penyakit_pernah = '$a_penyakit', ".
				"penyakit_sekarang = '$a_penyakit_skrg' ".
				"WHERE kd_mahasiswa = '$kd'");

		//organisasi
		mysql_query("UPDATE m_mahasiswa_org SET org_a = '$a_org_a', ".
				"org_b = '$a_org_b', ".
				"org_c = '$a_org_c' ".
				"WHERE kd_mahasiswa = '$kd'");

		//hobi
		mysql_query("UPDATE m_mahasiswa_hobi SET hobi_a = '$a_hobi_a', ".
				"hobi_b = '$a_hobi_b', ".
				"hobi_c = '$a_hobi_c' ".
				"WHERE kd_mahasiswa = '$kd'");

		//ortu
		mysql_query("UPDATE m_mahasiswa_ortu SET ayah_nama = '$b_ayah_nama', ".
				"ayah_pddkn = '$b_ayah_pddkn', ".
				"ayah_pekerjaan = '$b_ayah_kerja', ".
				"ayah_alamat = '$b_ayah_alamat', ".
				"ayah_hidup = '$b_ayah_hidup', ".
				"ibu_nama = '$b_ibu_nama', ".
				"ibu_pddkn = '$b_ibu_pddkn', ".
				"ibu_pekerjaan = '$b_ibu_kerja', ".
				"ibu_alamat = '$b_ibu_alamat', ".
				"ibu_hidup = '$b_ibu_hidup', ".
				"nama_pj = '$b_nama_pj', ".
				"hubungan = '$b_hubungan', ".
				"hasil_per_bulan = '$b_hasil_bulan', ".
				"hasil_per_tahun = '$b_hasil_tahun' ".
				"WHERE kd_mahasiswa = '$kd'");


		//alumni
		mysql_query("UPDATE m_mahasiswa_alumni SET tgl_terima_ijazah = '$tgl_terima_ijazah', ".
				"tgl_ijazah = '$tgl_ijazah', ".
				"tgl_tulis = '$today', ".
				"no_ijazah = '$no_ijazah', ".
				"alumni = '$st_alumni' ".
				"WHERE kd_mahasiswa = '$kd'");


		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=edit&kd=$kd";
		xloc($ke);
		exit();
		}
	}



//jika ganti foto profil ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnGNT'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$filex_namex = strip(strtolower($_FILES['filex_foto']['name']));
	$kd = nosql($_POST['kd']);

	//nek null
	if (empty($filex_namex))
		{
		//null-kan
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=edit&kd=$kd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//deteksi .jpg
		$ext_filex = substr($filex_namex, -4);

		if ($ext_filex == ".jpg")
			{
			//nilai
			$path1 = "../../filebox/mahasiswa/$kd";

			//cek, sudah ada belum
			if (!file_exists($path1))
				{
				//bikin folder kd_user
				mkdir("$path1", $chmod);

				//mengkopi file
				copy($_FILES['filex_foto']['tmp_name'],"../../filebox/mahasiswa/$kd/$filex_namex");

				//cek
				$qcc = mysql_query("SELECT * FROM m_mahasiswa ".
							"WHERE kd = '$kd'");
				$rcc = mysql_fetch_assoc($qcc);
				$tcc = mysql_num_rows($qcc);

				//nek ada
				if ($tcc != 0)
					{
					//query
					mysql_query("UPDATE m_mahasiswa SET filex = '$filex_namex' ".
							"WHERE kd = '$kd'");
					}
				else
					{
					mysql_query("INSERT INTO m_mahasiswa(kd, filex) VALUES ".
							"('$kd', '$filex_namex')");
					}


				//null-kan
				xclose($koneksi);

				//re-direct
				$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=edit&kd=$kd";
				xloc($ke);
				exit();
				}
			else
				{
				//hapus file yang ada dulu
				//query
				$qcc = mysql_query("SELECT * FROM m_mahasiswa ".
							"WHERE kd = '$kd'");
				$rcc = mysql_fetch_assoc($qcc);
				$tcc = mysql_num_rows($qcc);

				//hapus file
				$cc_filex = $rcc['filex'];
				$path1 = "../../filebox/mahasiswa/$kd/$cc_filex";
				unlink ($path1);

				//mengkopi file
				copy($_FILES['filex_foto']['tmp_name'],"../../filebox/mahasiswa/$kd/$filex_namex");

				//nek ada
				if ($tcc != 0)
					{
					//query
					mysql_query("UPDATE m_mahasiswa SET filex = '$filex_namex', ".
							"postdate = '$today' ".
							"WHERE kd = '$kd'");
					}
				else
					{
					mysql_query("INSERT INTO m_mahasiswa(kd, filex) VALUES ".
							"('$kd', '$filex_namex')");
					}

				//null-kan
				xclose($koneksi);

				//re-direct
				$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=edit&kd=$kd";
				xloc($ke);
				exit();
				}
			}
		else
			{
			//null-kan
			xclose($koneksi);

			//salah
			$pesan = "Bukan FIle Image .jpg . Harap Diperhatikan...!!";
			$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=edit&kd=$kd";
			pekem($pesan,$ke);
			exit();
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/js/checkall.js");
require("../../inc/menu/admbaak.php");

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">';
xheadline($judul);
echo ' [<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&s=add&kd='.$x.'" title="Entry Data Baru">Entry Data Baru</a>]

<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaover.'">
<td width="600">
Program Studi : ';
echo "<select name=\"progdi\" onChange=\"MM_jumpMenu('self',this,0)\">";
//terpilih
$qtpx = mysql_query("SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);
$prodi_kode = nosql($rowtpx['kode']);

echo '<option value="'.$tpx_kd.'" selected>['.$prodi_kode.'].'.$tpx_nama.'</option>';

$qtp = mysql_query("SELECT * FROM m_progdi ".
			"WHERE kd <> '$progdi' ".
			"ORDER BY nama ASC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpkode = nosql($rowtp['kode']);
	$tpnama = balikin($rowtp['nama']);

	echo '<option value="'.$filenya.'?progdi='.$tpkd.'">['.$tpkode.'].'.$tpnama.'</option>';
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
$jns_kode = nosql($rowbtx['kode']);

echo '<option value="'.$btxkd.'">['.$jns_kode.'].'.$btxkelas.'</option>';

$qbt = mysql_query("SELECT * FROM m_kelas ".
			"WHERE kd <> '$kelkd' ".
			"ORDER BY no ASC");
$rowbt = mysql_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btkode = nosql($rowbt['kode']);
	$btkelas = nosql($rowbt['kelas']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$btkd.'">['.$btkode.'].'.$btkelas.'</option>';
	}
while ($rowbt = mysql_fetch_assoc($qbt));

echo '</select>,


Masuk Tahun Akademik : ';
echo "<select name=\"tapel\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtpx = mysql_query("SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);
$tapel_kode = substr($tpx_thn1,-2);

echo '<option value="'.$tpx_kd.'">['.$tapel_kode.'].'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysql_query("SELECT * FROM m_tapel ".
			"WHERE kd <> '$tapelkd' ".
			"ORDER BY tahun1 ASC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);
	$tpkode = substr($tpth1,-2);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tpkd.'">['.$tpkode.'].'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>
</td>
</tr>
</table>
<input name="progdi" type="hidden" value="'.nosql($_REQUEST['progdi']).'">
<input name="kelkd" type="hidden" value="'.nosql($_REQUEST['kelkd']).'">
<input name="tapelkd" type="hidden" value="'.nosql($_REQUEST['tapelkd']).'">
<INPUT type="submit" name="btnIM" value="IMPORT">
<INPUT type="submit" name="btnEX" value="EXPORT">';




//jika view /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (empty($s))
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	
	//jika null
	if ((!empty($progdi)) AND (empty($kelkd)) AND (empty($tapelkd)))
		{
		$sqlcount = "SELECT DISTINCT(m_mahasiswa.kd) AS mskd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"ORDER BY round(m_mahasiswa.nim) ASC";
		$sqlresult = $sqlcount;
		}


	else if ((!empty($progdi)) AND (!empty($kelkd)) AND (empty($tapelkd)))
		{
		$sqlcount = "SELECT DISTINCT(m_mahasiswa.kd) AS mskd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"ORDER BY round(m_mahasiswa.nim) ASC";
		$sqlresult = $sqlcount;
		}


	else if ((!empty($progdi)) AND (!empty($kelkd)) AND (!empty($tapelkd)))
		{
		$sqlcount = "SELECT DISTINCT(m_mahasiswa.kd) AS mskd ".
						"FROM m_mahasiswa, mahasiswa_kelas, m_mahasiswa_status ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND m_mahasiswa_status.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND m_mahasiswa_status.kd_tapel = '$tapelkd' ".
						"ORDER BY round(m_mahasiswa.nim) ASC";
		$sqlresult = $sqlcount;

			 /*
		$sqlcount = "SELECT DISTINCT(m_mahasiswa_status.kd_mahasiswa) AS mskd ".
						"FROM m_mahasiswa_status ".
						"WHERE kd_tapel = '$tapelkd'";
		$sqlresult = $sqlcount;
			 */
		}
		
	else
		{
		$sqlcount = "SELECT DISTINCT(m_mahasiswa.kd) AS mskd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"ORDER BY round(m_mahasiswa.nim) ASC";
		$sqlresult = $sqlcount;
		}
				
	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);


	if ($count != 0)
		{
		//view data
		echo '<br>
		<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="1">&nbsp;</td>
		<td width="50"><strong><font color="'.$warnatext.'">NIM</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">NIM Kopertais</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td width="200"><strong><font color="'.$warnatext.'">TTL</font></strong></td>
		<td width="200"><strong><font color="'.$warnatext.'">Alamat</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Program Studi</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Jenis</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Tahun Masuk</font></strong></td>
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

			//nilai
			$i_nomer = $i_nomer + 1;
			$i_mskd = balikin2($data['mskd']);


/*
			//detail
			$qdt = mysql_query("SELECT m_mahasiswa.*, ".
								"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%d') AS lahir_tgl, ".
								"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%m') AS lahir_bln, ".
								"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%Y') AS lahir_thn, ".
								"m_mahasiswa.kd AS mskd, ".
								"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
								"FROM m_mahasiswa, mahasiswa_kelas ".
								"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
								"AND m_mahasiswa.kd = '$i_mskd'");
			$rdt = mysql_fetch_assoc($qdt);
 */
 
 			//detail
			$qdt = mysql_query("SELECT m_mahasiswa.*, ".
								"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%d') AS lahir_tgl, ".
								"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%m') AS lahir_bln, ".
								"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%Y') AS lahir_thn, ".
								"m_mahasiswa.kd AS mskd ".
								"FROM m_mahasiswa ".
								"WHERE kd = '$i_mskd'");
			$rdt = mysql_fetch_assoc($qdt);
 
			$i_nim = nosql($rdt['nim']);
			$dt_mkkd = nosql($rdt['mkkd']);
			$dt_nama = balikin($rdt['nama']);
			$dt_nim_pusat = nosql($rdt['nim_pusat']);
			$i_kd = $i_mskd;
//			$i_mkkd = $dt_mkkd;
			$i_nama = $dt_nama;

			$i_usernamex = nosql($rdt['usernamex']);
			$i_passwordx = nosql($rdt['passwordx']);
			$i_alamat = balikin($rdt['alamat_skrg']);
			$i_tmp_lahir = balikin($rdt['tmp_lahir']);
			$i_xtgl = nosql($rdt['lahir_tgl']);
			$i_xbln = nosql($rdt['lahir_bln']);
			$i_xthn = nosql($rdt['lahir_thn']);
			$i_tgl_lahir = "$i_xtgl/$i_xbln/$i_xthn";



			//set akses
			if ((empty($i_usernamex)) OR (empty($i_passwordx)))
				{
				$x_userx = $i_nim;
				$x_passx = md5($i_nim);

				mysql_query("UPDATE m_mahasiswa SET usernamex = '$x_userx', ".
									"passwordx = '$x_passx' ".
									"WHERE kd = '$i_mskd'");
				}

				
				
			//detail lg
			$qkuu = mysql_query("SELECT * FROM mahasiswa_kelas ".
									"WHERE kd_mahasiswa = '$i_mskd'");
			$rkuu = mysql_fetch_assoc($qkuu);
			$kuu_progkd = nosql($rkuu['kd_progdi']);
			$kuu_kelkd = nosql($rkuu['kd_kelas']);
				

			
			$qtpx = mysql_query("SELECT * FROM m_progdi ".
									"WHERE kd = '$kuu_progkd'");
			$rowtpx = mysql_fetch_assoc($qtpx);
			$tpx_nama = balikin($rowtpx['nama']);


			//terpilih
			$qbtx = mysql_query("SELECT * FROM m_kelas ".
									"WHERE kd = '$kuu_kelkd'");
			$rowbtx = mysql_fetch_assoc($qbtx);
			$btxkelas = nosql($rowbtx['kelas']);



		

			//status
			$qku2 = mysql_query("SELECT * FROM m_mahasiswa_status ".
									"WHERE kd_mahasiswa = '$i_mskd'");
			$rku2 = mysql_fetch_assoc($qku2);
			$ku2_tapelkd = nosql($rku2['kd_tapel']);


			//terpilih
			$qtpx2 = mysql_query("SELECT * FROM m_tapel ".
									"WHERE kd = '$ku2_tapelkd'");
			$rowtpx2 = mysql_fetch_assoc($qtpx2);
			$tpx2_thn1 = nosql($rowtpx2['tahun1']);
			$tpx2_thn2 = nosql($rowtpx2['tahun2']);

						
						
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td><input name="kd'.$i_nomer.'" type="hidden" value="'.$i_kd.'">
			<input type="checkbox" name="item'.$i_nomer.'" value="'.$i_kd.'">
			</td>
			<td>
			<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&s=edit&kd='.$i_kd.'" title="EDIT..."><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_nim.'</td>
			<td>'.$dt_nim_pusat.'</td>
			<td>'.$i_nama.'</td>
			<td>'.$i_tmp_lahir.', '.$i_tgl_lahir.'</td>
			<td>'.$i_alamat.'</td>
			<td>'.$tpx_nama.'</td>
			<td>'.$btxkelas.'</td>
			<td>'.$tpx2_thn1.'/'.$tpx2_thn2.'</td>
			</tr>';
			}
		while ($data = mysql_fetch_assoc($result));

		echo '</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="300">
		<input name="jml" type="hidden" value="'.$limit.'">
		<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
		<input name="kd" type="hidden" value="'.nosql($_REQUEST['kd']).'">
		<input name="progdi" type="hidden" value="'.nosql($_REQUEST['progdi']).'">
		<input name="kelkd" type="hidden" value="'.nosql($_REQUEST['kelkd']).'">
		<input name="tapelkd" type="hidden" value="'.nosql($_REQUEST['tapelkd']).'">
		<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$limit.')">
		<input name="btnBTL" type="reset" value="BATAL">
		<input name="btnHPS" type="submit" value="HAPUS">
		</td>
		<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
		</tr>
		</table>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>TIDAK ADA DATA.</strong>
		</font>
		</p>';
		}
	}



//jika import
else if ($s == "import")
	{
	echo '<p>
	Silahkan Masukkan File yang akan Di-Import :
	<br>
	<input name="filex_xls" type="file" size="30">
	<br>
	<input name="s" type="hidden" value="'.$s.'">
	<input name="btnBTL" type="submit" value="BATAL">
	<input name="btnIM2" type="submit" value="IMPORT >>">
	</p>
	<p>
	<strong><em>NB. Pastikan Semua Kolom Data yang akan di-import, Telah Sesuai dengan Data Master.</em></strong>
	</p>';
	}





//jika add / edit ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if (($s == "add") OR ($s == "edit"))
	{
	//cek dahulu
	if (empty($progdi))
		{
		echo '<p>
		<font color="red"><strong>PROGRM STUDI Belum dipilih. Harap Diperhatikan</strong></font>.
		</p>';
		}
	else if (empty($kelkd))
		{
		echo '<p>
		<font color="red"><strong>KELAS Belum dipilih. Harap Diperhatikan</strong></font>.
		</p>';
		}
	else if (empty($tapelkd))
		{
		echo '<p>
		<font color="red"><strong>TAHUN MASUK AKADEMIK Belum dipilih. Harap Diperhatikan</strong></font>.
		</p>';
		}
	else
		{
		//nilai
		$kd = nosql($_REQUEST['kd']);
		$progdi = nosql($_REQUEST['progdi']);
		$kelkd = nosql($_REQUEST['kelkd']);
		$tapelkd = nosql($_REQUEST['tapelkd']);




		echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr valign="top">
		<td width="80%">';


		//data query
		$qnil = mysql_query("SELECT m_mahasiswa.*, DATE_FORMAT(m_mahasiswa.tgl_lahir, '%d') AS lahir_tgl, ".
					"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%m') AS lahir_bln, ".
					"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%Y') AS lahir_thn ".
					"FROM m_mahasiswa ".
					"WHERE kd = '$kd'");
		$rnil = mysql_fetch_assoc($qnil);
		$y_nim = nosql($rnil['nim']);
		$y_nim_pusat = nosql($rnil['nim_pusat']);
		$y_nama = balikin($rnil['nama']);

		$tmp_lahir = balikin($rnil['tmp_lahir']);

		$lahir_tgl = nosql($rnil['lahir_tgl']);
		$lahir_bln = nosql($rnil['lahir_bln']);
		$lahir_thn = nosql($rnil['lahir_thn']);

		$jkelkd = nosql($rnil['kelamin']);
		$a_status_sipil = balikin($rnil['status_sipil']);
		$a_warga = balikin($rnil['warga_negara']);
		$jagmkd = nosql($rnil['kd_agama']);

		$a_alamat_skrg = balikin($rnil['alamat_skrg']);
		$a_alamat_asal = balikin($rnil['alamat_asal']);
		$y_filex = $rnil['filex'];



		//asal pddkn
		$qku1 = mysql_query("SELECT * FROM m_mahasiswa_pddkn ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku1 = mysql_fetch_assoc($qku1);
		$ku1_asal_sekolah = balikin($rku1['asal_sekolah']);
		$ku1_thn_lulus = balikin($rku1['thn_lulus']);
		$ku1_jurusan = balikin($rku1['jurusan']);
		$ku1_status_asal_sekolah = balikin($rku1['status_asal_sekolah']);



		//status mahasiswa
		$qku2 = mysql_query("SELECT * FROM m_mahasiswa_status ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku2 = mysql_fetch_assoc($qku2);
		$ku2_tapelkd = nosql($rku2['kd_tapel']);
		$ku2_status = balikin($rku2['status']);
		$ku2_sebagai_mhs = balikin($rku2['sebagai_mhs']);
		$ku2_kd_progdi = balikin($rku2['kd_progdi']);
		$ku2_kd_jenjang = balikin($rku2['kd_jenjang']);
		$ku2_pindahan_pt = balikin($rku2['pindahan_pt']);
		$ku2_pindahan_progdi = balikin($rku2['pindahan_progdi']);
		$ku2_pindahan_jurusan = balikin($rku2['pindahan_jurusan']);
		$ku2_pindahan_jenjang = balikin($rku2['pindahan_jenjang']);
		$ku2_smtkd = nosql($rku2['kd_smt']);


		//jika null
		if (empty($ku2_tapelkd))
			{
			$ku2_tapelkd = $tapelkd;
			}


		//jika null, anggap saja masuk sejak semester awal / satu
		if (empty($ku2_smtkd))
			{
			$ku2_smtkd = "c4ca4238a0b923820dcc509a6f75849b";
			}



		//sehat
		$qku3 = mysql_query("SELECT * FROM m_mahasiswa_sehat ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku3 = mysql_fetch_assoc($qku3);
		$ku3_tb = balikin($rku3['tb']);
		$ku3_bb = balikin($rku3['bb']);
		$ku3_mata = balikin($rku3['mata']);
		$ku3_gol_darah = balikin($rku3['gol_darah']);
		$ku3_pendengaran = balikin($rku3['pendengaran']);
		$ku3_penyakit_pernah = balikin($rku3['penyakit_pernah']);
		$ku3_penyakit_sekarang = balikin($rku3['penyakit_sekarang']);


		//organisasi
		$qku4 = mysql_query("SELECT * FROM m_mahasiswa_org ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku4 = mysql_fetch_assoc($qku4);
		$ku4_org_a = balikin($rku4['org_a']);
		$ku4_org_b = balikin($rku4['org_b']);
		$ku4_org_c = balikin($rku4['org_c']);



		//hobi
		$qku5 = mysql_query("SELECT * FROM m_mahasiswa_hobi ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku5 = mysql_fetch_assoc($qku5);
		$ku5_hobi_a = balikin($rku5['hobi_a']);
		$ku5_hobi_b = balikin($rku5['hobi_b']);
		$ku5_hobi_c = balikin($rku5['hobi_c']);



		//hobi
		$qku6 = mysql_query("SELECT * FROM m_mahasiswa_ortu ".
					"WHERE kd_mahasiswa = '$kd'");
		$rku6 = mysql_fetch_assoc($qku6);
		$ku6_ayah_nama = balikin($rku6['ayah_nama']);
		$ku6_ayah_pddkn = balikin($rku6['ayah_pddkn']);
		$ku6_ayah_pekerjaan = balikin($rku6['ayah_pekerjaan']);
		$ku6_ayah_alamat = balikin($rku6['ayah_alamat']);
		$ku6_ayah_hidup = balikin($rku6['ayah_hidup']);
		$ku6_ibu_nama = balikin($rku6['ibu_nama']);
		$ku6_ibu_pddkn = balikin($rku6['ibu_pddkn']);
		$ku6_ibu_pekerjaan = balikin($rku6['ibu_pekerjaan']);
		$ku6_ibu_alamat = balikin($rku6['ibu_alamat']);
		$ku6_ibu_hidup = balikin($rku6['ibu_hidup']);
		$ku6_nama_pj = balikin($rku6['nama_pj']);
		$ku6_hubungan = balikin($rku6['hubungan']);
		$ku6_hasil_per_bulan = balikin($rku6['hasil_per_bulan']);
		$ku6_hasil_per_tahun = balikin($rku6['hasil_per_tahun']);





		//jika ayah hidup
		if ($ku6_ayah_hidup == "true")
			{
			$ku6_ayah_hidup_ket = "Ya";
			}
		else
			{
			$ku6_ayah_hidup_ket = "Tidak";
			}

		//jika ibu hidup
		if ($ku6_ibu_hidup == "true")
			{
			$ku6_ibu_hidup_ket = "Ya";
			}
		else
			{
			$ku6_ibu_hidup_ket = "Tidak";
			}







		//jika baru, berikan nim baru.
		if ($s == "add")
			{
			//ketahui jumlah mahasiswa, terakhir pada suatu prodi dan suatu tapel.
			$qdtu = mysql_query("SELECT m_mahasiswa.*, mahasiswa_kelas.*, m_mahasiswa_status.* ".
						"FROM m_mahasiswa, mahasiswa_kelas, m_mahasiswa_status ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND m_mahasiswa_status.kd_mahasiswa = m_mahasiswa.kd ".
						"AND m_mahasiswa_status.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi'");
			$rdtu = mysql_fetch_assoc($qdtu);
			$tdtu = mysql_num_rows($qdtu);
			$dtu_1 = $tdtu + 1;

			//jika satu digit
			if (strlen($dtu_1) == 1)
				{
				$dtu_1x = "000$dtu_1";
				}
			//jika dua digit
			if (strlen($dtu_1) == 2)
				{
				$dtu_1x = "00$dtu_1";
				}
			//jika tiga digit
			if (strlen($dtu_1) == 3)
				{
				$dtu_1x = "0$dtu_1";
				}


			$nim_baru = "$tapel_kode$prodi_kode$dtu_1x$jns_kode";
			}
		else
			{
			$nim_baru = $y_nim;
			}



		echo '<big><strong>A. IDENTITAS PRIBADI</strong></big>

		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td width="150">
		1.NIM
		</td>
		<td>: </td>
		<td>
		<input name="a_nim" type="text" value="'.$nim_baru.'" size="30" onKeyPress="return numbersonly(this, event)">
		</td>
		</tr>
		
		<tr valign="top">
		<td width="150">
		1a.NIM Kopertais
		</td>
		<td>: </td>
		<td>
		<input name="a_nim_pusat" type="text" value="'.$y_nim_pusat.'" size="30" onKeyPress="return numbersonly(this, event)">
		</td>
		</tr>
		
		<tr valign="top">
		<td width="150">
		2.Nama
		</td>
		<td>: </td>
		<td>
		<input name="a_nama1" type="text" value="'.$y_nama.'" size="30">
		</td>
		</tr>

		<tr valign="top">
		<td width="150">
		3.Jenis Kelamin
		</td>
		<td>: </td>
		<td>
		<select name="a_kelamin">
		<option value="'.$jkelkd.'">'.$jkelkd.'</option>
		<option value="L">L</option>
		<option value="P">P</option>
		</select>
		</td>
		</tr>

		<tr valign="top">
		<td width="150">
		4.TTL
		</td>
		<td>: </td>
		<td>
		<input name="a_tmp_lahir" type="text" value="'.$tmp_lahir.'" size="30">,
		<select name="a_lahir_tgl">
		<option value="'.$lahir_tgl.'" selected>'.$lahir_tgl.'</option>';
		for ($i=1;$i<=31;$i++)
			{
			echo '<option value="'.$i.'">'.$i.'</option>';
			}

		echo '</select>
		<select name="a_lahir_bln">
		<option value="'.$lahir_bln.'" selected>'.$arrbln1[$lahir_bln].'</option>';
		for ($j=1;$j<=12;$j++)
			{
			echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
			}

		echo '</select>
		<select name="a_lahir_thn">
		<option value="'.$lahir_thn.'" selected>'.$lahir_thn.'</option>';
		for ($k=$lahir01;$k<=$lahir02;$k++)
			{
			echo '<option value="'.$k.'">'.$k.'</option>';
			}
		echo '</select>
		</td>
		</tr>

		<tr valign="top">
		<td width="150">
		5.Status Sipil
		</td>
		<td>: </td>
		<td>
		<select name="a_status_sipil">
		<option value="'.$a_status_sipil.'">'.$a_status_sipil.'</option>
		<option value="Belum Kawin">Belum Kawin</option>
		<option value="Menikah">Menikah</option>
		<option value="Janda">Janda</option>
		<option value="Duda">Duda</option>
		</select>
		</td>
		</tr>


		<tr valign="top">
		<td width="150">
		6.Kewarganegaraan
		</td>
		<td>: </td>
		<td>
		<select name="a_warga">
		<option value="'.$a_warga.'">'.$a_warga.'</option>
		<option value="WNI">WNI</option>
		<option value="WNA">WNA</option>
		<option value="WNI Keturunan">WNI Keturunan</option>
		</select>
		</td>
		</tr>


		<tr valign="top">
		<td width="150">
		7.Agama
		</td>
		<td>: </td>
		<td>
		<select name="a_agama">';

		//terpilih
		$qagmx = mysql_query("SELECT * FROM m_agama ".
					"WHERE kd = '$jagmkd'");
		$ragmx = mysql_fetch_assoc($qagmx);
		$agmx_kd = nosql($ragmx['kd']);
		$agmx_agama = balikin($ragmx['agama']);

		echo '<option value="'.$agmx_kd.'">'.$agmx_agama.'</option>';

		$qagm = mysql_query("SELECT * FROM m_agama ".
					"WHERE kd <> '$jagmkd' ".
					"ORDER BY agama ASC");
		$ragm = mysql_fetch_assoc($qagm);

		do
			{
			$agm_kd = nosql($ragm['kd']);
			$agm_agama = balikin($ragm['agama']);

			echo '<option value="'.$agm_kd.'">'.$agm_agama.'</option>';
			}
		while ($ragm = mysql_fetch_assoc($qagm));

		echo '</select>
		</td>
		</tr>

		<tr valign="top">
		<td width="150">
		8.Alamat Sekarang
		</td>
		<td>: </td>
		<td>
		<input name="a_alamat_skrg" type="text" value="'.$a_alamat_skrg.'" size="50">
		</td>
		</tr>


		<tr valign="top">
		<td width="150">
		9.Alamat Asal
		</td>
		<td>: </td>
		<td>
		<input name="a_alamat_asal" type="text" value="'.$a_alamat_asal.'" size="50">
		</td>
		</tr>
		<table>


		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td width="250">
		10.Latar Belakang & Status Pendidikan
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Asal SMTA</dd>
		</td>
		<td>:</td>
		<td>
		<input name="a_asal_smta" type="text" value="'.$ku1_asal_sekolah.'" size="30">
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Status SMTA</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_status_smta">
		<option value="'.$ku1_status_asal_sekolah.'">'.$ku1_status_asal_sekolah.'</option>
		<option value="Negeri">Negeri</option>
		<option value="SMTA Diakui">SMTA Diakui</option>
		<option value="SMTA Disamakan">SMTA Disamakan</option>
		<option value="Ikatan Dinas">Ikatan Dinas</option>
		</select>
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Jurusan SMTA</dd>
		</td>
		<td>:</td>
		<td>
		<input name="a_jurusan_smta" type="text" value="'.$ku1_jurusan.'" size="10">
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Tahun Lulus</dd>
		</td>
		<td>:</td>
		<td>
		<input name="a_thn_lulus" type="text" value="'.$ku1_thn_lulus.'" size="4" maxlength="4" onKeyPress="return numbersonly(this, event)">
		</td>
		</tr>


		<tr>
		<td width="250">
		11.Status Mahasiswa
		</td>
		<td></td>
		<td></td>
		</tr>



		<tr>
		<td width="250">
		<dd>*Tahun Masuk Akademik</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_thn_masuk">';

		//terpilih
		$qtpx = mysql_query("SELECT * FROM m_tapel ".
					"WHERE kd = '$ku2_tapelkd'");
		$rowtpx = mysql_fetch_assoc($qtpx);
		$tpx_kd = nosql($rowtpx['kd']);
		$tpx_thn1 = nosql($rowtpx['tahun1']);
		$tpx_thn2 = nosql($rowtpx['tahun2']);

		echo '<option value="'.$tpx_kd.'">'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

		$qtp = mysql_query("SELECT * FROM m_tapel ".
					"WHERE kd <> '$ku2_tapelkd' ".
					"ORDER BY tahun1 ASC");
		$rowtp = mysql_fetch_assoc($qtp);

		do
			{
			$tpkd = nosql($rowtp['kd']);
			$tpth1 = nosql($rowtp['tahun1']);
			$tpth2 = nosql($rowtp['tahun2']);

			echo '<option value="'.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
			}
		while ($rowtp = mysql_fetch_assoc($qtp));

		echo '</select>
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Status Mahasiswa</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_status_mhs">
		<option value="'.$ku2_status.'">'.$ku2_status.'</option>
		<option value="Murni">Murni</option>
		<option value="Pindahan">Pindahan</option>
		</select>
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Terdaftar Sebagai Mahasiswa</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_sebagai_mhs">
		<option value="'.$ku2_sebagai_mhs.'">'.$ku2_sebagai_mhs.'</option>
		<option value="Biasa">Biasa</option>
		<option value="Bea Siswa">Bea Siswa</option>
		<option value="Tugas Belajar">Tugas Belajar</option>
		<option value="Ikatan Dinas">Ikatan Dinas</option>
		</select>
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Program Studi/Jenjang</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_progdi">';

		//terpilih
		$qpro1 = mysql_query("SELECT * FROM m_progdi ".
					"WHERE kd = '$ku2_kd_progdi'");
		$rpro1 = mysql_fetch_assoc($qpro1);
		$pro1_kd = nosql($rpro1['kd']);
		$pro1_nama = balikin($rpro1['nama']);

		echo '<option value="'.$pro1_kd.'" selected>'.$pro1_nama.'</option>';

		$qagm2 = mysql_query("SELECT * FROM m_progdi ".
					"WHERE kd <> '$ku2_kd_progdi' ".
					"ORDER BY nama ASC");
		$ragm2 = mysql_fetch_assoc($qagm2);

		do
			{
			$agm2_kd = nosql($ragm2['kd']);
			$agm2_nama = balikin($ragm2['nama']);

			echo '<option value="'.$agm2_kd.'">'.$agm2_nama.'</option>';
			}
		while ($ragm2 = mysql_fetch_assoc($qagm2));

		echo '</select> /

		<select name="a_jenjang">';

		//terpilih
		$qjnej1 = mysql_query("SELECT * FROM m_jenjang ".
					"WHERE kd = '$ku2_kd_jenjang'");
		$rjenj1 = mysql_fetch_assoc($qjnej1);
		$jenj1_kd = nosql($rjenj1['kd']);
		$jenj1_nama = balikin($rjenj1['jenjang']);

		echo '<option value="'.$jenj1_kd.'" selected>'.$jenj1_nama.'</option>';

		$qagm2 = mysql_query("SELECT * FROM m_jenjang ".
					"WHERE kd <> '$ku2_kd_jenjang' ".
					"ORDER BY jenjang ASC");
		$ragm2 = mysql_fetch_assoc($qagm2);

		do
			{
			$agm2_kd = nosql($ragm2['kd']);
			$agm2_nama = balikin($ragm2['jenjang']);

			echo '<option value="'.$agm2_kd.'">'.$agm2_nama.'</option>';
			}
		while ($ragm2 = mysql_fetch_assoc($qagm2));

		echo '</select>
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Semester Masuk</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_smt">';

		//terpilih
		$qpro13 = mysql_query("SELECT * FROM m_smt ".
					"WHERE kd = '$ku2_smtkd'");
		$rpro13 = mysql_fetch_assoc($qpro13);
		$pro13_kd = nosql($rpro13['kd']);
		$pro13_smt = balikin($rpro13['smt']);

		echo '<option value="'.$pro13_kd.'" selected>'.$pro13_smt.'</option>';

		$qagm2 = mysql_query("SELECT * FROM m_smt ".
					"WHERE kd <> '$ku2_smtkd' ".
					"ORDER BY round(no) ASC");
		$ragm2 = mysql_fetch_assoc($qagm2);

		do
			{
			$agm2_kd = nosql($ragm2['kd']);
			$agm2_smt = balikin($ragm2['smt']);

			echo '<option value="'.$agm2_kd.'">'.$agm2_smt.'</option>';
			}
		while ($ragm2 = mysql_fetch_assoc($qagm2));

		echo '</select>
		</td>
		</tr>

		<tr>
		<td width="250"></td>
		<td></td>
		<td></td>
		</tr>

		<tr>
		<td width="250">
		<dd>(Untuk Mahasiswa Pindahan)</dd>
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Perguruan Tinggi Asal</dd>
		</td>
		<td>:</td>
		<td>
		<input name="a_pindahan_pt_asal" type="text" value="'.$ku2_pindahan_pt.'" size="30">
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Jurusan / Program Studi</dd>
		</td>
		<td>:</td>
		<td>
		<input name="a_pindahan_jurusan" type="text" value="'.$ku2_pindahan_jurusan.'" size="20"> /
		<input name="a_pindahan_progdi" type="text" value="'.$ku2_pindahan_progdi.'" size="20">
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Jenjang</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_pindahan_jenjang">
		<option value="'.$ku2_pindahan_jenjang.'">'.$ku2_pindahan_jenjang.'</option>
		<option value="S1">S1</option>
		<option value="D3">D3</option>
		<option value="D2">D2</option>
		<option value="D1">D1</option>
		</select>
		</td>
		</tr>

		<tr>
		<td width="250">
		12. Status Kesehatan
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Tinggi Badan</dd>
		</td>
		<td>:</td>
		<td>
		<input name="a_tb" type="text" value="'.$ku3_tb.'" size="3" maxlength="3" onKeyPress="return numbersonly(this, event)"> Cm
		</td>
		</tr>


		<tr>
		<td width="250">
		<dd>*Berat Badan</dd>
		</td>
		<td>:</td>
		<td>
		<input name="a_bb" type="text" value="'.$ku3_bb.'" size="3" maxlength="3" onKeyPress="return numbersonly(this, event)"> Cm
		</td>
		</tr>


		<tr>
		<td width="250">
		<dd>*Mata</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_mata">
		<option value="'.$ku3_mata.'">'.$ku3_mata.'</option>
		<option value="Minus">Minus</option>
		<option value="Plus">Plus</option>
		<option value="Trachum">Trachum</option>
		<option value="Buta Warna">Buta Warna</option>
		<option value="Normal">Normal</option>
		</select>
		</td>
		</tr>


		<tr>
		<td width="250">
		<dd>*Golongan Darah</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_goldarah">
		<option value="'.$ku3_gol_darah.'">'.$ku3_gol_darah.'</option>
		<option value="A">A</option>
		<option value="B">B</option>
		<option value="AB">AB</option>
		<option value="O">O</option>
		</select>
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Pendengaran</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_dengar">
		<option value="'.$ku3_pendengaran.'">'.$ku3_pendengaran.'</option>
		<option value="Normal">Normal</option>
		<option value="Tidak Normal">Tidak Normal</option>
		</select>
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>*Penyakit yang pernah diderita</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_penyakit">
		<option value="'.$ku3_penyakit_pernah.'">'.$ku3_penyakit_pernah.'</option>
		<option value="Epilepsi">Epilepsi</option>
		<option value="Jantung">Jantung</option>
		<option value="Asma">Asma</option>
		<option value="Lain-Lain">Lain-Lain</option>
		</select>
		</td>
		</tr>


		<tr>
		<td width="250">
		<dd>*Penyakit yang diderita sekarang</dd>
		</td>
		<td>:</td>
		<td>
		<select name="a_penyakit_skrg">
		<option value="'.$ku3_penyakit_sekarang.'">'.$ku3_penyakit_sekarang.'</option>
		<option value="Epilepsi">Epilepsi</option>
		<option value="Jantung">Jantung</option>
		<option value="Asma">Asma</option>
		<option value="Lain-Lain">Lain-Lain</option>
		</select>
		</td>
		</tr>
		</table>



		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<tr>
		<td>
		13. Pengalaman Organisasi
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr valign="top">
		<tr>
		<td>
		<dd>a. <input name="a_org_a" type="text" value="'.$ku4_org_a.'" size="50"></dd>
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr valign="top">
		<tr>
		<td>
		<dd>b. <input name="a_org_b" type="text" value="'.$ku4_org_b.'" size="50"></dd>
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr valign="top">
		<tr>
		<td>
		<dd>c. <input name="a_org_c" type="text" value="'.$ku4_org_c.'" size="50"></dd>
		</td>
		<td></td>
		<td></td>
		</tr>


		<tr valign="top">
		<tr>
		<td>
		14. Hobi
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr valign="top">
		<tr>
		<td>
		<dd>a. <input name="a_hobi_a" type="text" value="'.$ku5_hobi_a.'" size="50"></dd>
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr valign="top">
		<tr>
		<td>
		<dd>b. <input name="a_hobi_b" type="text" value="'.$ku5_hobi_b.'" size="50"></dd>
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr valign="top">
		<tr>
		<td>
		<dd>c. <input name="a_hobi_c" type="text" value="'.$ku5_hobi_c.'" size="50"></dd>
		</td>
		<td></td>
		<td></td>
		</tr>

		</table>


		<big><strong>B. IDENTITAS ORANG TUA</strong></big>

		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="250">
		1.Ayah
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr>
		<td width="250">
		<dd>a. Nama</dd>
		</td>
		<td>:</td>
		<td>
		<input name="b_ayah_nama" type="text" value="'.$ku6_ayah_nama.'" size="30">
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>b. Pendidikan</dd>
		</td>
		<td>:</td>
		<td>
		<select name="b_ayah_pddkn">
		<option value="'.$ku6_ayah_pddkn.'">'.$ku6_ayah_pddkn.'</option>
		<option value="SD">SD</option>
		<option value="SMTP">SMTP</option>
		<option value="SMTA">SMTA</option>
		<option value="Diploma">Diploma</option>
		<option value="Sarjana">Sarjana</option>
		<option value="Pasca Sarjana">Pasca Sarjana</option>
		<option value="Dokter">Dokter</option>
		<option value="Lain-Lain">Lain-Lain</option>
		</select>
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>c. Pekerjaan</dd>
		</td>
		<td>:</td>
		<td>
		<select name="b_ayah_kerja">
		<option value="'.$ku6_ayah_pekerjaan.'">'.$ku6_ayah_pekerjaan.'</option>
		<option value="TNI/POLRI">TNI/POLRI</option>
		<option value="Pegawai Negeri">Pegawai Negeri</option>
		<option value="Swasta">Swasta</option>
		<option value="Tani">Tani</option>
		<option value="Pensiunan">Pensiunan</option>
		<option value="Lain-Lain">Lain-Lain</option>
		</select>
		</td>
		</tr>


		<tr>
		<td width="250">
		<dd>d. Alamat</dd>
		</td>
		<td>:</td>
		<td>
		<input name="b_ayah_alamat" type="text" value="'.$ku6_ayah_alamat.'" size="50">
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>e. Masih Hidup...?</dd>
		</td>
		<td>:</td>
		<td>
		<select name="b_ayah_hidup">
		<option value="'.$ku6_ayah_hidup.'">'.$ku6_ayah_hidup_ket.'</option>
		<option value="true">Ya</option>
		<option value="false">Tidak</option>
		</select>
		</td>
		</tr>






		<tr>
		<td width="250">
		2.Ibu
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr>
		<td width="250">
		<dd>a. Nama</dd>
		</td>
		<td>:</td>
		<td>
		<input name="b_ibu_nama" type="text" value="'.$ku6_ibu_nama.'" size="30">
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>b. Pendidikan</dd>
		</td>
		<td>:</td>
		<td>
		<select name="b_ibu_pddkn">
		<option value="'.$ku6_ibu_pddkn.'">'.$ku6_ibu_pddkn.'</option>
		<option value="SD">SD</option>
		<option value="SMTP">SMTP</option>
		<option value="SMTA">SMTA</option>
		<option value="Diploma">Diploma</option>
		<option value="Sarjana">Sarjana</option>
		<option value="Pasca Sarjana">Pasca Sarjana</option>
		<option value="Dokter">Dokter</option>
		<option value="Lain-Lain">Lain-Lain</option>
		</select>
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>c. Pekerjaan</dd>
		</td>
		<td>:</td>
		<td>
		<select name="b_ibu_kerja">
		<option value="'.$ku6_ibu_pekerjaan.'">'.$ku6_ibu_pekerjaan.'</option>
		<option value="TNI/POLRI">TNI/POLRI</option>
		<option value="Pegawai Negeri">Pegawai Negeri</option>
		<option value="Swasta">Swasta</option>
		<option value="Tani">Tani</option>
		<option value="Pensiunan">Pensiunan</option>
		<option value="Lain-Lain">Lain-Lain</option>
		</select>
		</td>
		</tr>


		<tr>
		<td width="250">
		<dd>d. Alamat</dd>
		</td>
		<td>:</td>
		<td>
		<input name="b_ibu_alamat" type="text" value="'.$ku6_ibu_alamat.'" size="50">
		</td>
		</tr>

		<tr>
		<td width="250">
		<dd>e. Masih Hidup...?</dd>
		</td>
		<td>:</td>
		<td>
		<select name="b_ibu_hidup">
		<option value="'.$ku6_ibu_hidup.'">'.$ku6_ibu_hidup_ket.'</option>
		<option value="true">Ya</option>
		<option value="false">Tidak</option>
		</select>
		</td>
		</tr>
		</table>

		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="300">
		3.Nama Penanggung Jawab Biaya Pendidikan
		</td>
		<td>:</td>
		<td>
		<input name="b_nama_pj" type="text" value="'.$ku6_nama_pj.'" size="30">
		</td>
		</tr>

		<tr>
		<td width="300">
		4.Hubungan dengan Mahasiswa
		</td>
		<td>:</td>
		<td>
		<select name="b_hubungan">
		<option value="'.$ku6_hubungan.'">'.$ku6_hubungan.'</option>
		<option value="Orang Tua">Orang Tua</option>
		<option value="Wali / Saudara">Wali / Saudara</option>
		<option value="Lain-Lain">Lain-Lain</option>
		</select>
		</td>
		</tr>

		<tr>
		<td width="300">
		5.Jumlah Penghasilan rata - rata
		</td>
		<td></td>
		<td></td>
		</tr>

		<tr>
		<td width="300">
		<dd>a.Rata-rata per Bulan</dd>
		</td>
		<td>:</td>
		<td>
		Rp.<input name="b_hasil_bulan" type="text" value="'.$ku6_hasil_per_bulan.'" size="10" onKeyPress="return numbersonly(this, event)">,00
		</td>
		</tr>

		<tr>
		<td width="300">
		<dd>b.Rata-rata per Tahun</dd>
		</td>
		<td>:</td>
		<td>
		Rp.<input name="b_hasil_tahun" type="text" value="'.$ku6_hasil_per_tahun.'" size="10" onKeyPress="return numbersonly(this, event)">,00
		</td>
		</tr>


		</table>';


		//query
		$qnil = mysql_query("SELECT m_mahasiswa_alumni.*, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_terima_ijazah, '%d') AS tgl_terima, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_terima_ijazah, '%m') AS bln_terima, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_terima_ijazah, '%Y') AS thn_terima, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_ijazah, '%d') AS tgl_ijazah, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_ijazah, '%m') AS bln_ijazah, ".
					"DATE_FORMAT(m_mahasiswa_alumni.tgl_ijazah, '%Y') AS thn_ijazah, ".
					"mahasiswa_kelas.* ".
					"FROM m_mahasiswa_alumni, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa_alumni.kd_mahasiswa ".
					"AND mahasiswa_kelas.kd_mahasiswa = '$kd'");
		$rnil = mysql_fetch_assoc($qnil);
		$y_tgl_terima_ijazah = nosql($rnil['tgl_terima']);
		$y_bln_terima_ijazah = nosql($rnil['bln_terima']);
		$y_thn_terima_ijazah = nosql($rnil['thn_terima']);
		$y_tgl_ijazah = nosql($rnil['tgl_ijazah']);
		$y_bln_ijazah = nosql($rnil['bln_ijazah']);
		$y_thn_ijazah = nosql($rnil['thn_ijazah']);
		$y_no_ijazah = balikin2($rnil['no_ijazah']);



		echo '<big>
		<strong>C.AKHIR PENDIDIKAN</strong>
		</big>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td width="200">
		<dd>
		a. Nomor Ijazah
		</dd>
		</td>
		<td width="10">: </td>
		<td>
		<input name="no_ijazah" type="text" value="'.$y_no_ijazah.'" size="30">
		</td>
		</tr>

		<tr valign="top">
		<td width="200">
		<dd>
		b. Tanggal Ijazah
		</dd>
		</td>
		<td width="10">: </td>
		<td>
		<select name="ijazah_tgl">
		<option value="'.$y_tgl_ijazah.'" selected>'.$y_tgl_ijazah.'</option>';
		for ($i=1;$i<=31;$i++)
			{
			echo '<option value="'.$i.'">'.$i.'</option>';
			}

		echo '</select>
		<select name="ijazah_bln">
		<option value="'.$y_bln_ijazah.'" selected>'.$arrbln1[$y_bln_ijazah].'</option>';
		for ($j=1;$j<=12;$j++)
			{
			echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
			}

		echo '</select>
		<select name="ijazah_thn">
		<option value="'.$y_thn_ijazah.'" selected>'.$y_thn_ijazah.'</option>';
		for ($k=$tinggal01;$k<=$tinggal02;$k++)
			{
			echo '<option value="'.$k.'">'.$k.'</option>';
			}
		echo '</select>
		</td>
		</tr>

		<tr valign="top">
		<td width="200">
		<dd>
		c. Tanggal Terima Ijazah
		</dd>
		</td>
		<td width="10">: </td>
		<td>
		<select name="ijazah_terima_tgl">
		<option value="'.$y_tgl_terima_ijazah.'" selected>'.$y_tgl_terima_ijazah.'</option>';
		for ($i=1;$i<=31;$i++)
			{
			echo '<option value="'.$i.'">'.$i.'</option>';
			}

		echo '</select>
		<select name="ijazah_terima_bln">
		<option value="'.$y_bln_terima_ijazah.'" selected>'.$arrbln1[$y_bln_terima_ijazah].'</option>';
		for ($j=1;$j<=12;$j++)
			{
			echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
			}

		echo '</select>
		<select name="ijazah_terima_thn">
		<option value="'.$y_thn_terima_ijazah.'" selected>'.$y_thn_terima_ijazah.'</option>';
		for ($k=$tinggal01;$k<=$tinggal02;$k++)
			{
			echo '<option value="'.$k.'">'.$k.'</option>';
			}
		echo '</select>
		</td>
		</tr>

		</table>

		<input name="btnSMP1" type="submit" value="SIMPAN">
		<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
		<input name="kd" type="hidden" value="'.nosql($_REQUEST['kd']).'">
		<input name="progdi" type="hidden" value="'.nosql($_REQUEST['progdi']).'">
		<input name="kelkd" type="hidden" value="'.nosql($_REQUEST['kelkd']).'">
		<input name="tapelkd" type="hidden" value="'.nosql($_REQUEST['tapelkd']).'">
		<input name="btnDF" type="submit" value="DAFTAR MAHASISWA >>">
		</td>
		<td width="1%">
		</td>
		<td>';

		//nek null foto
		if (empty($y_filex))
			{
			$nil_foto = "$sumber/img/foto_blank.jpg";
			}
		else
			{
			$nil_foto = "$sumber/filebox/mahasiswa/$kd/$y_filex";
			}

		echo '<img src="'.$nil_foto.'" alt="'.$y_nama.'" width="150" height="200" border="5">
		<br>
		<br>
		<input name="filex_foto" type="file" size="15">
		<br>
		<input name="btnGNT" type="submit" value="GANTI">
		</td>
		</tr>
		</table>';
		}
	}

echo '</form>';
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