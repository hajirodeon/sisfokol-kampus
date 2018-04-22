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
require("../../inc/cek/admkemhs.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "mahasiswa.php";
$judul = "Data Mahasiswa";
$judulku = "[$kemhs_session : $nip4_session. $nm4_session] ==> $judul";
$judulx = $judul;

$s = nosql($_REQUEST['s']);
$crkd = nosql($_REQUEST['crkd']);
$crtipe = balikin($_REQUEST['crtipe']);
$kunci = cegah($_REQUEST['kunci']);
$kd = nosql($_REQUEST['kd']);
$ke = $filenya;
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


//PROSES ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//reset
if ($_POST['btnRST'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}






//ke import
if ($_POST['btnIM'])
	{
	//re-direct
	$ke = "$filenya?s=import";
	xloc($ke);
	exit();
	}




//import
if ($_POST['btnIM2'])
	{
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
		
	
	//nilai
	$filex_namex = strip(strtolower($_FILES['filex_xls']['name']));

	//nek null
	if (empty($filex_namex))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?s=import";
		pekem($pesan,$ke);
		}
	else
		{
		//deteksi .xls
		$ext_filex = substr($filex_namex, -4);

		if ($ext_filex == ".xls")
			{
			//nilai
			$path1 = "../../filebox/excel";
			chmod($path1,0777);

			//mengkopi file
			copy($_FILES['filex_xls']['tmp_name'],"../../filebox/excel/$filex_namex");


			//file-nya...
			$uploadfile = "$path1/$filex_namex";



			//require
			require_once '../../inc/class/excel/excel_reader2.php';




			// membaca file excel yang diupload
			$data = new Spreadsheet_Excel_Reader($uploadfile);

			// membaca jumlah baris dari data excel
//			$baris = $data->rowcount($sheet_index=0);
			$baris = $data->rowcount(0);
//			$jml_kolom = $data->colcount($sheet=0);
			$sheet_ke = 0;



			// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
			for ($i=2; $i<=$baris; $i++)
				{
				$i_xyz = md5("$x$i");
				$i_no_daftar = balikin($data->val($i, 1,$sheet_ke));
				$i_nama = balikin($data->val($i, 2,$sheet_ke));
				$i_kelas = balikin($data->val($i, 3,$sheet_ke));
				$i_angkatan = balikin($data->val($i, 4,$sheet_ke));
				$i_jalur_daftar = balikin($data->val($i, 5,$sheet_ke));
				$i_kelamin = balikin($data->val($i, 6,$sheet_ke));
				$i_tmp_lahir = balikin($data->val($i, 7,$sheet_ke));
				
				$i_tgl_lahir = titikdua($data->val($i, 8,$sheet_ke));
				$i_lahir_tgl = substr($i_tgl_lahir,0,2);
				$i_lahir_bln = substr($i_tgl_lahir,3,2);
				$i_lahir_thn = substr($i_tgl_lahir,-4);
				$i_tgl_lahir = "$i_lahir_thn:$i_lahir_bln:$i_lahir_tgl";
				
				$i_alamat = balikin($data->val($i, 9,$sheet_ke));
				$i_asal_sekolah = balikin($data->val($i, 10,$sheet_ke));
				$i_jurusan = balikin($data->val($i, 11,$sheet_ke));
				$i_lulusan = balikin($data->val($i, 12,$sheet_ke));
				$i_tb = balikin($data->val($i, 13,$sheet_ke));
				$i_bb = balikin($data->val($i, 14,$sheet_ke));
				$i_status = balikin($data->val($i, 15,$sheet_ke));





				//cek /////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$qcc = mysql_query("SELECT * FROM cnp_mahasiswa ".
										"WHERE angkatan_mhs = '$i_angkatan' ".
										"AND no_daftar = '$i_no_daftar'");
				$rcc = mysql_fetch_assoc($qcc);
				$tcc = mysql_num_rows($qcc);
				$cc_kd = nosql($rcc['kd']);


				//jika ada, update
				if ($tcc != 0)
					{
					//update
					mysql_query("UPDATE cnp_mahasiswa SET nama = '$i_nama', ".
									"no_daftar = '$i_no_daftar', ".
									"kelas = '$i_kelas', ".
									"angkatan_mhs = '$i_angkatan', ".
									"jalur_pendaftaran = '$i_jalur_daftar', ".
									"kelamin = '$i_kelamin', ".
									"tmp_lahir = '$i_tmp_lahir', ".
									"tgl_lahir = '$i_tgl_lahir', ".
									"asal_sekolah = '$i_asal_sekolah', ".
									"alamat = '$i_alamat', ".
									"jurusan = '$i_jurusan', ".
									"lulusan = '$i_lulusanlul', ".
									"tb = '$i_tb', ".
									"bb = '$i_bb', ".
									"status = '$i_status' ".
									"WHERE kd = '$cc_kd'");
					}

				//jika blm ada, insert
				else
					{
					mysql_query("INSERT INTO cnp_mahasiswa(kd, nama, no_daftar, kelas, ".
									"angkatan_mhs, jalur_pendaftaran, kelamin, tmp_lahir, ".
									"tgl_lahir, alamat, jurusan, lulusan, tb, bb, status, ".
									"asal_sekolah, postdate) VALUES ".
									"('$i_xyz', '$i_nama', '$i_no_daftar', '$i_kelas', ".
									"'$i_angkatan', '$i_jalur_daftar', '$i_kelamin', '$i_tmp_lahir', ".
									"'$i_tgl_lahir', '$i_alamat', '$i_jurusan', '$i_lulusan', '$i_tb', '$i_bb', '$i_status', ".
									"'$i_asal_sekolah', '$today')");

					}




				}


			//hapus file, jika telah import
			$path1 = "../../filebox/excel/$filex_namex";
			chmod($path1,0777);
			unlink ($path1);


			//re-direct
			xloc($filenya);
			exit();
			}
		else
			{
			//re-direct
			$pesan = "Bukan File .xls . Harap Diperhatikan...!!";
			$ke = "$filenya?s=import";
			pekem($pesan,$ke);
			exit();
			}
		}
	}




//cari
if ($_POST['btnCARI'])
	{
	//nilai
	$crkd = nosql($_POST['crkd']);
	$crtipe = balikin2($_POST['crtipe']);
	$kunci = cegah($_POST['kunci']);


	//cek
	if ((empty($crkd)) OR (empty($kunci)))
		{
		//re-direct
		$pesan = "Input Pencarian Tidak Lengkap. Harap diperhatikan...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//re-direct
		$ke = "$filenya?crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		xloc($ke);
		exit();
		}
	}



//batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}






//ke daftar 
if ($_POST['btnDF'])
	{
	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	xloc($filenya);
	exit();
	}




//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);
	$page = nosql($_REQUEST['page']);
	if ((empty($page)) OR ($page == "0"))
		{
		$page = "1";
		}


	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT * FROM cnp_mahasiswa ".
					"ORDER BY nama ASC";
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


		//del
		mysql_query("DELETE FROM cnp_mahasiswa ".
						"WHERE kd = '$i_kd'");

		}
	while ($data = mysql_fetch_assoc($result));


	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$ke = "$filenya?page=$page";
	xloc($ke);
	exit();
	}




//jika simpan
if ($_POST['btnSMP1'])
	{
	//nilai
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$e_nodaftar = cegah($_POST['e_nodaftar']);
	$e_nama = cegah($_POST['e_nama']);
	$e_kelas = cegah($_POST['e_kelas']);
	$e_angkatan = cegah($_POST['e_angkatan']);
	$e_jalur = cegah($_POST['e_jalur']);
	$e_kelamin = cegah($_POST['e_kelamin']);
	$e_alamat = cegah($_POST['e_alamat']);
	$e_tmp_lahir = cegah($_POST['e_tmp_lahir']);
	
	$mtgl = $_POST['datepicker1'];
	$mpecah1 = explode("/", $mtgl);
	$lahir_bln = $mpecah1[0];
	$lahir_tgl = $mpecah1[1];
	$lahir_thn = $mpecah1[2];
	$e_tgl_lahir = "$lahir_thn:$lahir_bln:$lahir_tgl";
	
	
	$e_asal_sekolah = cegah($_POST['e_asal_sekolah']);
	$e_jurusan = cegah($_POST['e_jurusan']);
	$e_lulusan = cegah($_POST['e_lulusan']);
	$e_tb = cegah($_POST['e_tb']);
	$e_bb = cegah($_POST['e_bb']);
	$e_status = cegah($_POST['e_status']);

	

	//jika baru ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($s == "add")
		{
		//nek null
		if ((empty($e_nama)) OR (empty($e_alamat)))
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Input Tidak Lengkap. Harap Diulangi...!";
			$ke = "$filenya?s=add&kd=$x";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//insert
			mysql_query("INSERT INTO cnp_mahasiswa(kd, nama, no_daftar, kelas, ".
							"angkatan_mhs, jalur_pendaftaran, kelamin, tmp_lahir, ".
							"tgl_lahir, alamat, jurusan, lulusan, tb, bb, status, ".
							"asal_sekolah, postdate) VALUES ".
							"('$kd', '$e_nama', '$e_nodaftar', '$e_kelas', ".
							"'$e_angkatan', '$e_jalur', '$e_kelamin', '$e_tmp_lahir', ".
							"'$e_tgl_lahir', '$e_alamat', '$e_jurusan', '$e_lulusan', '$e_tb', '$e_bb', '$e_status', ".
							"'$e_asal_sekolah', '$today')");



			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			xloc($filenya);
			exit();
			}
		}


	//jika edit ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	else if ($s == "edit")
		{
		//update
		mysql_query("UPDATE cnp_mahasiswa SET nama = '$e_nama', ".
						"no_daftar = '$e_nodaftar', ".
						"kelas = '$e_kelas', ".
						"angkatan_mhs = '$e_angkatan', ".
						"jalur_pendaftaran = '$e_jalur', ".
						"kelamin = '$e_kelamin', ".
						"tmp_lahir = '$e_tmp_lahir', ".
						"tgl_lahir = '$e_tgl_lahir', ".
						"asal_sekolah = '$e_asal_sekolah', ".
						"alamat = '$e_alamat', ".
						"jurusan = '$e_jurusan', ".
						"lulusan = '$e_lulusan', ".
						"tb = '$e_tb', ".
						"bb = '$e_bb', ".
						"status = '$e_status' ".
						"WHERE kd = '$kd'");



		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		xloc($filenya);
		exit();
		}
	}








//export
if ($_POST['btnEX'])
	{
	//require
	include("../../inc/class/excel/excelwriter.inc.php");


	//Buat nama file yang di inginkan
	$excelfile = 'data_mahasiswa.xls';
	//lokasi hasil konversi
	$lokasi	   = '../../filebox/excel/';
	$excel=new ExcelWriter($lokasi.$excelfile);
	
	//Buat header untuk tabel
	$myArr = array("NO_DAFTAR","NAMA","KELAS","ANGKATAN","JALUR_DAFTAR","KELAMIN","TMP_LAHIR","TGL_LAHIR", 
						"ALAMAT","ASAL_SEKOLAH","JURUSAN","LULUSAN","TB","BB","STATUS");
	$excel->writeLine($myArr);
		



	//data
	$qdt = mysql_query("SELECT * FROM cnp_mahasiswa ".
							"ORDER BY nama ASC");
	$rdt = mysql_fetch_assoc($qdt);

	do
	  	{
		//nilai
		$dt_nox = $dt_nox + 1;
		$dt_pkd = nosql($rdt['kd']);

		$i_nama = balikin($rdt['nama']);
		$i_no_daftar = balikin($rdt['no_daftar']);
		$i_kelas = balikin($rdt['kelas']);
		$i_angkatan = balikin($rdt['angkatan_mhs']);
		$i_jalur_daftar = balikin($rdt['jalur_pendaftaran']);
		$i_kelamin = balikin($rdt['kelamin']);
		$i_tmp_lahir = balikin($rdt['tmp_lahir']);
		$i_tgl_lahir = $rdt['tgl_lahir'];
		$i_alamat = balikin($rdt['alamat']);
		$i_asal_sekolah = balikin($rdt['asal_sekolah']);
		$i_jurusan = balikin($rdt['jurusan']);
		$i_lulusan = balikin($rdt['lulusan']);
		$i_tb = balikin($rdt['tb']);
		$i_bb = balikin($rdt['bb']);
		$i_status = balikin($rdt['status']);




		$arr2 = array($i_no_daftar,$i_nama,$i_kelas,$i_angkatan,$i_jalur_daftar,$i_kelamin,$i_tmp_lahir,$i_tgl_lahir, 
						$i_alamat, $i_asal_sekolah, $i_jurusan, $i_lulusan, $i_tb, $i_bb, $i_status);
						


		$excel->writeLine($arr2);
		}
	while ($rdt = mysql_fetch_assoc($qdt));


	//close
	$excel -> close();
	

	$ke = "$lokasi$excelfile";
	xloc($ke);
	exit();
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi *START
ob_start();




//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/number.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admkemhs.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<script type="text/javascript">
$(document).ready(function() {
$(function() {
	$('#datepicker1').datepicker({
		changeMonth: true,
		yearRange: "-100:+10",
		changeYear: true
		});

	});



});
</script>




<?php 

echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="500">';
xheadline($judul);
echo ' [<a href="'.$filenya.'?s=add&kd='.$x.'" title="Entry Data Baru">Entry Data Baru</a>]
</td>
<td align="right">';
echo "<select name=\"katcari\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$filenya.'?crkd='.$crkd.'&crtipe='.$crtipe.'&kunci='.$kunci.'" selected>'.$crtipe.'</option>
<option value="'.$filenya.'?crkd=cr01&crtipe=Nama&kunci='.$kunci.'">Nama</option>
<option value="'.$filenya.'?crkd=cr02&crtipe=Alamat&kunci='.$kunci.'">Alamat</option>
</select>
<input name="kunci" type="text" value="'.$kunci.'" size="20">
<input name="crkd" type="hidden" value="'.$crkd.'">
<input name="crtipe" type="hidden" value="'.$crtipe.'">
<input name="btnCARI" type="submit" value="CARI >>">
<input name="btnRST" type="submit" value="RESET">
</td>
</tr>
</table>


<INPUT type="submit" name="btnIM" value="IMPORT">
<INPUT type="submit" name="btnEX" value="EXPORT">';


//jika view /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (empty($s))
	{
	//nama
	if ($crkd == "cr01")
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT * FROM cnp_mahasiswa ".
							"WHERE nama LIKE '%$kunci%' ".
							"ORDER BY nama ASC";
		$sqlresult = $sqlcount;

		$count = mysql_num_rows(mysql_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysql_fetch_array($result);
		}


	//alamat
	else if ($crkd == "cr02")
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT * FROM cnp_mahasiswa ".
							"WHERE alamat LIKE '%$kunci%' ".
							"ORDER BY alamat ASC";
		$sqlresult = $sqlcount;

		$count = mysql_num_rows(mysql_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysql_fetch_array($result);
		}
		
	else
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT * FROM cnp_mahasiswa ".
						"ORDER BY nama ASC";
		$sqlresult = $sqlcount;

		$count = mysql_num_rows(mysql_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysql_fetch_array($result);
		}

	if ($count != 0)
		{
		//view data
		echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="1">&nbsp;</td>
		<td width="100"><strong><font color="'.$warnatext.'">No.Daftar</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Kelas</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Angkatan</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Jalur Daftar</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Kelamin</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Jurusan</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Lulusan</font></strong></td>
		<td width="10"><strong><font color="'.$warnatext.'">TB</font></strong></td>
		<td width="10"><strong><font color="'.$warnatext.'">BB</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Status</font></strong></td>

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
			$i_kd = nosql($data['kd']);
			$i_nodaftar = balikin($data['no_daftar']);
			$i_nama = balikin($data['nama']);
			$i_kelas = balikin($data['kelas']);
			$i_angkatan = balikin($data['angkatan_mhs']);
			$i_jalur_daftar = balikin($data['jalur_pendaftaran']);
			$i_kelamin = balikin($data['kelamin']);
			$i_jurusan = balikin($data['jurusan']);
			$i_lulusan = balikin($data['lulusan']);
			$i_tb = balikin($data['tb']);
			$i_bb = balikin($data['bb']);
			$i_status = balikin($data['status']);





			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td><input name="kd'.$i_nomer.'" type="hidden" value="'.$i_kd.'">
			<input type="checkbox" name="item'.$i_nomer.'" value="'.$i_kd.'">
	    	</td>
			<td>
			<a href="'.$filenya.'?s=edit&kd='.$i_kd.'" title="EDIT..."><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_nodaftar.'</td>
			<td>'.$i_nama.'</td>
			<td>'.$i_kelas.'</td>
			<td>'.$i_angkatan.'</td>
			<td>'.$i_jalur_daftar.'</td>
			<td>'.$i_kelamin.'</td>
			<td>'.$i_jurusan.'</td>
			<td>'.$i_lulusan.'</td>
			<td>'.$i_tb.'</td>
			<td>'.$i_bb.'</td>
			<td>'.$i_status.'</td>
    		</tr>';
			}
		while ($data = mysql_fetch_assoc($result));

		echo '</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="300">
		<input name="jml" type="hidden" value="'.$limit.'">
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






//jika add / edit ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if (($s == "add") OR ($s == "edit"))
	{
	//nilai
	$kd = nosql($_REQUEST['kd']);


	//data query
	$qnil = mysql_query("SELECT DATE_FORMAT(tgl_lahir, '%d') AS lahir_tgl, ".
							"DATE_FORMAT(tgl_lahir, '%m') AS lahir_bln, ".
							"DATE_FORMAT(tgl_lahir, '%Y') AS lahir_thn, ".
							"cnp_mahasiswa.* ".
							"FROM cnp_mahasiswa ".
							"WHERE kd = '$kd'");
	$rnil = mysql_fetch_assoc($qnil);
	$y_nodaftar = balikin($rnil['no_daftar']);
	$y_nama = balikin($rnil['nama']);
	$y_kelas = balikin($rnil['kelas']);
	$y_angkatan = balikin($rnil['angkatan_mhs']);
	$y_jalur = balikin($rnil['jalur_pendaftaran']);
	$y_kelamin = balikin($rnil['kelamin']);
	$y_asal_sekolah = balikin($rnil['asal_sekolah']);
	$y_tmp_lahir = balikin($rnil['tmp_lahir']);

	$lahir_tgl = nosql($rnil['lahir_tgl']);
	$lahir_bln = nosql($rnil['lahir_bln']);
	$lahir_thn = nosql($rnil['lahir_thn']);
	$y_tgl_lahir = "$lahir_bln/$lahir_tgl/$lahir_thn";

	$y_alamat = balikin($rnil['alamat']);
	$y_jurusan = balikin($rnil['jurusan']);
	$y_lulusan = balikin($rnil['lulusan']);
	$y_tb = balikin($rnil['tb']);
	$y_bb = balikin($rnil['bb']);
	$y_status = balikin($rnil['status']);


	echo '<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td width="150">
	No.Daftar
	</td>
	<td>: 
	<input name="e_nodaftar" type="text" value="'.$y_nodaftar.'" size="10">
	</td>
	</tr>
	
	<tr>
	<td>
	Nama
	</td>
	<td>: 
	<input name="e_nama" type="text" value="'.$y_nama.'" size="30">
	</td>
	</tr>
		
	<tr>
	<td>
	Kelas
	</td>
	<td>: 
	<input name="e_kelas" type="text" value="'.$y_kelas.'" size="10">
	</td>
	</tr>
		
	<tr>
	<td>
	Angkatan
	</td>
	<td>: 
	<input name="e_angkatan" type="text" value="'.$y_angkatan.'" size="10">
	</td>
	</tr>
		
	<tr>
	<td>
	Jalur Pendaftaran
	</td>
	<td>: 
	<input name="e_jalur" type="text" value="'.$y_jalur.'" size="30">
	</td>
	</tr>
		
	<tr>
	<td>
	Jenis Kelamin
	</td>
	<td>: 
	<select name="e_kelamin">
	<option value="'.$y_kelamin.'" selected>'.$y_kelamin.'</option>
	<option value="L">L</option>
	<option value="P">P</option>
	</select>
	</td>
	</tr>
		
	<tr>
	<td>
	Tempat, Tanggal Lahir
	</td>
	<td>: 
	<input name="e_tmp_lahir" type="text" value="'.$y_tmp_lahir.'" size="20">, 
	<input name="datepicker1" id="datepicker1" type="text" value="'.$y_tgl_lahir.'" size="10">
	</td>
	</tr>
	
	<tr>
	<td>
	Alamat
	</td>
	<td>: 
	<input name="e_alamat" type="text" value="'.$y_alamat.'" size="50">
	</td>
	</tr>
		
	<tr>
	<td>
	Asal Sekolah
	</td>
	<td>: 
	<input name="e_asal_sekolah" type="text" value="'.$y_asal_sekolah.'" size="30">
	</td>
	</tr>
	
	<tr>
	<td>
	Jurusan
	</td>
	<td>: 
	<input name="e_jurusan" type="text" value="'.$y_jurusan.'" size="20">
	</td>
	</tr>
		
	<tr>
	<td>
	Lulusan
	</td>
	<td>: 
	<input name="e_lulusan" type="text" value="'.$y_lulusan.'" size="30">
	</td>
	</tr>
		
	<tr>
	<td>
	Tinggi Badan
	</td>
	<td>: 
	<input name="e_tb" type="text" value="'.$y_tb.'" size="5">Cm.
	</td>
	</tr>
		
	<tr>
	<td>
	Berat Badan
	</td>
	<td>: 
	<input name="e_bb" type="text" value="'.$y_bb.'" size="5">Kg
	</td>
	</tr>
		
	<tr>
	<td>
	Status
	</td>
	<td>: 
	<select name="e_status">
	<option value="'.$y_status.'" selected>'.$y_status.'</option>
	<option value="Bekerja">Bekerja</option>
	<option value="Belum Bekerja">Belum Bekerja</option>
	</select>
	</td>
	</tr>
	
	

	
	</table>

	<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
	<input name="kd" type="hidden" value="'.nosql($_REQUEST['kd']).'">
	<input name="btnBTL" type="submit" value="BATAL">
	<input name="btnSMP1" type="submit" value="SIMPAN">';
	}

	
	
//jika import ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
	</p>';
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