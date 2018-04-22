<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);


//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admbaak.php");
$tpl = LoadTpl("../../template/index.html");


nocache;

//nilai
$filenya = "mhs_import.php";
$judul = "Import Data Mahasiswa";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$juduly = $judul;
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);




//PROSES //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//batal
if ($_POST['btnBTL'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);


	//hapus file
	$path1 = "../../filebox/excel/$filex_namex";
	unlink ($path1);

	//re-direct
	$ke = "mhs.php?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd";
	xloc($ke);
	exit();
	}





//import sekarang
if ($_POST['btnIMx'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$filex_namex = $_POST['filex_namex'];

	//nek null
	if (empty($filex_namex))
		{
		//null-kan
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "mhs.php?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&s=import";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//deteksi .xls
		$ext_filex = substr($filex_namex, -4);

		if ($ext_filex == ".xls")
			{
			//nilai
			$path1 = "../../filebox/excel";

			//file-nya...
			$uploadfile = "$path1/$filex_namex";

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
				$i_nim = $data->val($i, 2,$sheet_ke);
				$i_nama = $data->val($i, 3,$sheet_ke);
				

				//kelamin
				$i_kelamin = $data->val($i, 4,$sheet_ke);
				$qkela = mysql_query("SELECT * FROM m_kelamin ".
							"WHERE kelamin = '$i_kelamin'");
				$rkela = mysql_fetch_assoc($qkela);
				$kela_kd = nosql($rkela['kd']);
				$i_kelamin = $kela_kd;


				$i_tmp_lahir = $data->val($i, 5,$sheet_ke);
				$i_tgl_lahir = titikdua($data->val($i, 6,$sheet_ke));
				$i_lahir_tgl = substr($i_tgl_lahir,0,2);
				$i_lahir_bln = substr($i_tgl_lahir,3,2);
				$i_lahir_thn = substr($i_tgl_lahir,-4);
				$i_tgl_lahir = "$i_lahir_thn:$i_lahir_bln:$i_lahir_tgl";

				$i_status_sipil = $data->val($i, 7,$sheet_ke);
				$i_warga_negara = $data->val($i, 8,$sheet_ke);


				//agama
				$i_agama = $data->val($i, 9,$sheet_ke);
				$qagm = mysql_query("SELECT * FROM m_agama ".
							"WHERE agama = '$i_agama'");
				$ragm = mysql_fetch_assoc($qagm);
				$agm_kd = nosql($ragm['kd']);
				$i_agama = $agm_kd;


				$i_alamat_skr = $data->val($i, 10,$sheet_ke);
				$i_alamat_asal = $data->val($i, 11,$sheet_ke);
				$i_pddkn_asal = $data->val($i, 12,$sheet_ke);
				$i_pddkn_status = $data->val($i, 13,$sheet_ke);
				$i_pddkn_jurusan = $data->val($i, 14,$sheet_ke);
				$i_pddkn_lulus = $data->val($i, 15,$sheet_ke);
				$i_status_masuk = $data->val($i, 16,$sheet_ke);
				$i_status_sebagai = $data->val($i, 17,$sheet_ke);
				$i_status_terdaftar = $data->val($i, 18,$sheet_ke);
				$i_status_progdi = $data->val($i, 19,$sheet_ke);
				$i_status_jenjang = $data->val($i, 20,$sheet_ke);
				$i_status_pindah_asal = $data->val($i, 21,$sheet_ke);
				$i_status_pindah_progdi = $data->val($i, 22,$sheet_ke);
				$i_status_pindah_jurusan = $data->val($i, 23,$sheet_ke);
				$i_status_pindah_jenjang = $data->val($i, 24,$sheet_ke);
				$i_sehat_tb = $data->val($i, 25,$sheet_ke);
				$i_sehat_bb = $data->val($i, 26,$sheet_ke);
				$i_sehat_mata = $data->val($i, 27,$sheet_ke);
				$i_sehat_darah = $data->val($i, 28,$sheet_ke);
				$i_sehat_dengar = $data->val($i, 29,$sheet_ke);
				$i_sehat_pernah_derita = $data->val($i, 30,$sheet_ke);
				$i_sehat_sedang_derita = $data->val($i, 31,$sheet_ke);
				$i_org_a = $data->val($i, 32,$sheet_ke);
				$i_org_b = $data->val($i, 33,$sheet_ke);
				$i_org_c = $data->val($i, 34,$sheet_ke);
				$i_hobi_a = $data->val($i, 35,$sheet_ke);
				$i_hobi_b = $data->val($i, 36,$sheet_ke);
				$i_hobi_c = $data->val($i, 37,$sheet_ke);
				$i_ayah_nama = $data->val($i, 38,$sheet_ke);
				$i_ayah_pddkn = $data->val($i, 39,$sheet_ke);
				$i_ayah_kerja = $data->val($i, 40,$sheet_ke);
				$i_ayah_alamat = $data->val($i, 41,$sheet_ke);
				$i_ayah_hidup = $data->val($i, 42,$sheet_ke);
				$i_ibu_nama = $data->val($i, 43,$sheet_ke);
				$i_ibu_pddkn = $data->val($i, 44,$sheet_ke);
				$i_ibu_kerja = $data->val($i, 45,$sheet_ke);
				$i_ibu_alamat = $data->val($i, 46,$sheet_ke);
				$i_ibu_hidup = $data->val($i, 47,$sheet_ke);
				$i_penanggung_nama = $data->val($i, 48,$sheet_ke);
				$i_penanggung_hubungan = $data->val($i, 49,$sheet_ke);
				$i_hasil_bulanan = $data->val($i, 50,$sheet_ke);
				$i_hasil_tahunan = $data->val($i, 51,$sheet_ke);
				$i_ijazah_nomor = $data->val($i, 52,$sheet_ke);
				$i_ijazah_tanggal = $data->val($i, 53,$sheet_ke);
				$i_ijazah_tanggal_terima = $data->val($i, 54,$sheet_ke);




				$i_tgl_ijazah = titikdua($i_ijazah_tanggal);
				$i_ijazah_tgl = substr($i_tgl_ijazah,0,2);
				$i_ijazah_bln = substr($i_tgl_ijazah,3,2);
				$i_ijazah_thn = substr($i_tgl_ijazah,-4);
				$i_ijazah_tanggal = "$i_ijazah_thn:$i_ijazah_bln:$i_ijazah_tgl";


				$i_tgl_diterima = titikdua($i_ijazah_tanggal_terima);
				$i_diterima_tgl = substr($i_tgl_diterima,0,2);
				$i_diterima_bln = substr($i_tgl_diterima,3,2);
				$i_diterima_thn = substr($i_tgl_diterima,-4);
				$i_ijazah_tanggal_terima = "$i_diterima_thn:$i_diterima_bln:$i_diterima_tgl";




				//pekerjaan
				$i_ayah_pekerjaan = $i_ayah_kerja;
				$qpekx = mysql_query("SELECT * FROM m_pekerjaan ".
							"WHERE pekerjaan = '$i_ayah_pekerjaan'");
				$rpekx = mysql_fetch_assoc($qpekx);
				$pekx_kd = nosql($rpekx['kd']);
				$i_ayah_kerja = $pekx_kd;




				//ibu
				//pekerjaan
				$i_ibu_pekerjaan = $i_ibu_kerja;
				$qpekx = mysql_query("SELECT * FROM m_pekerjaan ".
							"WHERE pekerjaan = '$i_ibu_pekerjaan'");
				$rpekx = mysql_fetch_assoc($qpekx);
				$pekx_kd = nosql($rpekx['kd']);
				$i_ibu_kerja = $pekx_kd;




				//dinyatakan jadi alumni, jika telah tertulis tanggal ijazah dan tanggal terima ijazah.
				if (($i_tgl_terima_ijazah != "0000:00:00") AND ($i_tgl_ijazah != "0000:00:00"))
					{
					$st_alumni = "true";
					}
				else
					{
					$st_alumni = "false";
					}





				//password...
				$i_pass = md5($i_nim);

				//ke mysql
				$qcc = mysql_query("SELECT m_mahasiswa.kd AS mskd, mahasiswa_kelas.kd AS skkd ".
							"FROM m_mahasiswa, mahasiswa_kelas ".
							"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
							"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
							"AND m_mahasiswa.nim = '$i_nim'");
				$rcc = mysql_fetch_assoc($qcc);
				$tcc = mysql_num_rows($qcc);
				$cc_mskd = nosql($rcc['mskd']);
				$cc_skkd = nosql($rcc['skkd']);


				//jika ada, update
				if ($tcc != 0)
					{
					//set akses
					$x_userx = $i_nim;
					$x_passx = md5($i_nim);

					//update
					mysql_query("UPDATE m_mahasiswa SET usernamex = '$x_userx', ".
							"passwordx = '$x_passx', ".
							"nim = '$i_nim', ".
							"nama = '$i_nama', ".
							"tmp_lahir = '$i_tmp_lahir', ".
							"tgl_lahir = '$i_tgl_lahir', ".
							"kelamin = '$i_kelamin', ".
							"kd_agama = '$i_agama', ".
							"alamat_asal = '$i_alamat_asal', ".
							"alamat_skrg = '$i_alamat_skr', ".
							"status_sipil = '$i_status_sipil', ".
							"warga_negara = '$i_warga_negara' ".
							"WHERE kd = '$cc_mskd'");

					//asal pendidikan
					mysql_query("UPDATE m_mahasiswa_pddkn SET asal_sekolah = '$i_pddkn_asal', ".
							"thn_lulus = '$i_pddkn_lulus', ".
							"jurusan = '$i_pddkn_jurusan', ".
							"status_asal_sekolah = '$i_pddkn_status' ".
							"WHERE kd_mahasiswa = '$cc_mskd'");

					//status
					mysql_query("UPDATE m_mahasiswa_status SET kd_tapel = '$tapelkd', ".
							"status = '$i_status_terdaftar', ".
							"sebagai_mhs = '$i_status_sebagai', ".
							"kd_progdi = '$progdi', ".
							"kd_jenjang = '$i_status_jenjang', ".
							"pindahan_pt = '$i_status_pindah_asal', ".
							"pindahan_progdi = '$i_status_pindah_progdi', ".
							"pindahan_jurusan = '$i_status_pindah_jurusan', ".
							"pindahan_jenjang = '$i_status_pindah_jenjang', ".
							"kd_smt = '$i_smt' ".
							"WHERE kd_mahasiswa = '$cc_mskd'");

					//sehat
					mysql_query("UPDATE m_mahasiswa_sehat SET tb = '$i_sehat_tb', ".
							"bb = '$i_sehat_bb', ".
							"mata = '$i_sehat_mata', ".
							"gol_darah = '$i_sehat_darah', ".
							"pendengaran = '$i_sehat_dengar', ".
							"penyakit_pernah = '$i_sehat_pernah_derita', ".
							"penyakit_sekarang = '$i_sehat_sedang_derita' ".
							"WHERE kd_mahasiswa = '$cc_mskd'");

					//organisasi
					mysql_query("UPDATE m_mahasiswa_org SET org_a = '$i_org_a', ".
							"org_b = '$i_org_b', ".
							"org_c = '$i_org_c' ".
							"WHERE kd_mahasiswa = '$cc_mskd'");

					//hobi
					mysql_query("UPDATE m_mahasiswa_hobi SET hobi_a = '$i_hobi_a', ".
							"hobi_b = '$i_hobi_b', ".
							"hobi_c = '$i_hobi_c' ".
							"WHERE kd_mahasiswa = '$cc_mskd'");

					//ortu
					mysql_query("UPDATE m_mahasiswa_ortu SET ayah_nama = '$i_ayah_nama', ".
							"ayah_pddkn = '$i_ayah_pddkn', ".
							"ayah_kerja = '$i_ayah_kerja', ".
							"ayah_alamat = '$i_ayah_alamat', ".
							"ayah_hidup = '$i_ayah_hidup', ".
							"ibu_nama = '$i_ibu_nama', ".
							"ibu_pddkn = '$i_ibu_pddkn', ".
							"ibu_kerja = '$i_ibu_kerja', ".
							"ibu_alamat = '$i_ibu_alamat', ".
							"ibu_hidup = '$i_ibu_hidup', ".
							"nama_pj = '$i_penanggung_nama', ".
							"hubungan = '$i_penanggung_hubungan', ".
							"hasil_per_bulan = '$i_hasil_bulanan', ".
							"hasil_per_tahun = '$i_hasil_tahunan' ".
							"WHERE kd_mahasiswa = '$cc_mskd'");


					//alumni
					mysql_query("UPDATE m_mahasiswa_alumni SET tgl_terima_ijazah = '$i_ijazah_tanggal_terima', ".
							"tgl_ijazah = '$i_ijazah_tanggal', ".
							"tgl_tulis = '$today', ".
							"no_ijazah = '$i_ijazah_nomor', ".
							"alumni = '$st_alumni' ".
							"WHERE kd_mahasiswa = '$cc_mskd'");
					}

				//jika blm ada, insert
				else
					{
					//set akses
					$x_userx = $i_nim;
					$x_passx = md5($i_nim);


					//insert
					mysql_query("INSERT INTO m_mahasiswa(kd, usernamex, passwordx, nim, nama, ".
							"tmp_lahir, tgl_lahir, kelamin, kd_agama, ".
							"alamat_asal, alamat_skrg, status_sipil, warga_negara) VALUES ".
							"('$x_passx', '$x_userx', '$x_passx', '$i_nim', '$i_nama', ".
							"'$i_tmp_lahir', '$i_tgl_lahir', '$i_kelamin', '$i_agama', ".
							"'$i_alamat_asal', '$i_alamat_skr', '$i_status_sipil', '$i_warga_negara')");

					//insert kelas-nya
					mysql_query("INSERT INTO mahasiswa_kelas(kd, kd_mahasiswa, kd_progdi, kd_kelas, ".
							"kd_tapel, kd_smt) VALUES ".
							"('$x_passx', '$x_passx', '$progdi', '$kelkd', ".
							"'$tapelkd', '$i_smt')");

					//asal pendidikan
					mysql_query("INSERT INTO m_mahasiswa_pddkn(kd, kd_mahasiswa, asal_sekolah, ".
							"thn_lulus, jurusan, status_asal_sekolah) VALUES ".
							"('$x_passx', '$x_passx', '$i_pddkn_asal', ".
							"'$i_pddkn_lulus', '$i_pddkn_jurusan', '$i_pddkn_status')");

					//status
					mysql_query("INSERT INTO m_mahasiswa_status(kd, kd_mahasiswa, kd_tapel, ".
							"status, sebagai_mhs, kd_progdi, kd_jenjang, ".
							"pindahan_pt, pindahan_progdi, pindahan_jurusan, ".
							"pindahan_jenjang, kd_smt) VALUES ".
							"('$x_passx', '$x_passx', '$tapelkd', ".
							"'$i_status_terdaftar', '$i_status_sebagai', '$progdi', '$i_status_jenjang', ".
							"'$i_status_pindah_asal', '$i_status_pindah_progdi', '$i_status_pindah_jurusan', ".
							"'$i_status_pindah_jenjang', '$i_smt')");

					//sehat
					mysql_query("INSERT INTO m_mahasiswa_sehat(kd, kd_mahasiswa, tb, bb, ".
							"mata, gol_darah, pendengaran, ".
							"penyakit_pernah, penyakit_sekarang) VALUES ".
							"('$x_passx', '$x_passx', '$i_sehat_tb', '$i_sehat_bb', ".
							"'$i_sehat_mata', '$i_sehat_darah', '$i_sehat_dengar', ".
							"'$i_sehat_pernah_derita', '$i_sehat_sedang_derita')");

					//organisasi
					mysql_query("INSERT INTO m_mahasiswa_org(kd, kd_mahasiswa, org_a, org_b, org_c) VALUES ".
							"('$x_passx', '$x_passx', '$i_org_a', '$i_org_b', '$i_org_c')");

					//hobi
					mysql_query("INSERT INTO m_mahasiswa_hobi(kd, kd_mahasiswa, hobi_a, hobi_b, hobi_c) VALUES ".
							"('$x_passx', '$x_passx', '$i_hobi_a', '$i_hobi_b', '$i_hobi_c')");

					//ortu
					mysql_query("INSERT INTO m_mahasiswa_ortu(kd, kd_mahasiswa, ayah_nama, ".
							"ayah_pddkn, ayah_pekerjaan, ayah_alamat, ayah_hidup, ".
							"ibu_nama, ibu_pddkn, ibu_pekerjaan, ibu_alamat, ".
							"ibu_hidup, nama_pj, hubungan, hasil_per_bulan, ".
							"hasil_per_tahun) VALUES ".
							"('$x_passx', '$x_passx', '$i_ayah_nama', ".
							"'$i_ayah_pddkn', '$i_ayah_kerja', '$i_ayah_alamat', '$i_ayah_hidup', ".
							"'$i_ibu_nama', '$i_ibu_pddkn', '$i_ibu_kerja', '$i_ibu_alamat', ".
							"'$i_ibu_hidup', '$i_penanggung_nama', '$i_penanggung_hubungan', '$i_hasil_bulanan', ".
							"'$i_hasil_tahunan')");


					//alumni
					mysql_query("INSERT INTO m_mahasiswa_alumni(kd, kd_mahasiswa, tgl_terima_ijazah, tgl_ijazah, ".
							"tgl_tulis, no_ijazah, alumni) VALUES ".
							"('$x_passx', '$x_passx', '$i_ijazah_tanggal_terima', '$i_ijazah_tanggal', ".
							"'$today', '$i_ijazah_nomor', '$st_alumni')");
					}
				}



			//hapus file, jika telah import
			$path1 = "../../filebox/excel/$filex_namex";
			chmod($path1,0777);
			unlink ($path1);

			//null-kan
			xclose($koneksi);

			//re-direct
			$ke = "mhs.php?tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd";
			xloc($ke);
			exit();
			}
		else
			{
			//null-kan
			xclose($koneksi);

			//salah
			$pesan = "Bukan File .xls . Harap Diperhatikan...!!";
			$ke = "siswa.php?tapelkd=$tapelkd&progdi=$progdi&kelkd=$kelkd&s=import";
			pekem($pesan,$ke);
			exit();
			}
		}
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admbaak.php");
xheadline($judul);


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" enctype="multipart/form-data" action="'.$filenya.'">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Tahun Pelajaran : ';
//terpilih
$qtpx = mysql_query("SELECT * FROM m_tapel ".
						"WHERE kd = '$tapelkd'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<strong>'.$tpx_thn1.'/'.$tpx_thn2.'</strong>,


Kelas : ';
//terpilih
$qbtx = mysql_query("SELECT * FROM m_kelas ".
						"WHERE kd = '$kelkd'");
$rowbtx = mysql_fetch_assoc($qbtx);

$btxkd = nosql($rowbtx['kd']);
$btxno = nosql($rowbtx['no']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<strong>'.$btxkelas.'</strong>
</td>
</tr>
</table>';


$filex_namex = $_REQUEST['filex_namex'];

//nilai
$path1 = "../../filebox/excel/$filex_namex";

//file-nya...
$uploadfile = $path1;


echo '<p>
Nama File Yang di-Import : <strong>'.$filex_namex.'</strong>
<br>
<input name="filex_namex" type="hidden" value="'.$filex_namex.'">
<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
<input name="kelkd" type="hidden" value="'.$kelkd.'">
<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
<input name="progdi" type="hidden" value="'.$progdi.'">
<input name="btnBTL" type="submit" value="<< BATAL">
<input name="btnIMx" type="submit" value="IMPORT Sekarang>>">
</p>
</form>
<br>
<br>
<br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi
$isi = ob_get_contents();
ob_end_clean();


require("../../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>