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
$filenya = "mitra.php";
$judul = "Data Mitra Perusahaan";
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
		//deteksi .jpg
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
				$i_nama = balikin($data->val($i, 1,$sheet_ke));
				$i_alamat = balikin($data->val($i, 2,$sheet_ke));
				$i_pic = balikin($data->val($i, 3,$sheet_ke));
				$i_nohp = balikin($data->val($i, 4,$sheet_ke));
				$i_notelp = balikin($data->val($i, 5,$sheet_ke));
				$i_email = balikin($data->val($i, 6,$sheet_ke));



				//cek /////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$qcc = mysqli_query($koneksi, "SELECT * FROM cnp_mitra ".
										"WHERE nama = '$i_nama'");
				$rcc = mysqli_fetch_assoc($qcc);
				$tcc = mysqli_num_rows($qcc);
				$cc_kd = nosql($rcc['kd']);


				//jika ada, update
				if ($tcc != 0)
					{
					//update
					mysqli_query($koneksi, "UPDATE cnp_mitra SET alamat = '$i_alamat', ".
									"pic = '$i_pic', ".
									"no_hp = '$i_nohp', ".
									"no_telp = '$i_notelp', ".
									"email = '$i_email', ".
									"postdate = '$today' ".
									"WHERE kd = '$cc_kd'");
					}

				//jika blm ada, insert
				else
					{
					//nohp-nya
					mysqli_query($koneksi, "INSERT INTO cnp_mitra(kd, nama, alamat, pic, no_hp, no_telp, email, postdate) VALUES ".
									"('$i_xyz', '$i_nama', '$i_alamat', '$i_pic', '$i_nohp', '$i_notelp', '$i_email', '$today')");
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

	$sqlcount = "SELECT * FROM cnp_mitra ".
					"ORDER BY nama ASC";
	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);


	//ambil semua
	do
		{
		//ambil nilai
		$i = $i + 1;
		$yuk = "item";
		$yuhu = "$yuk$i";
		$i_kd = nosql($_POST["$yuhu"]);


		//del
		mysqli_query($koneksi, "DELETE FROM cnp_mitra ".
						"WHERE kd = '$i_kd'");

		}
	while ($data = mysqli_fetch_assoc($result));


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
	$e_nama = cegah($_POST['e_nama']);
	$e_alamat = cegah($_POST['e_alamat']);
	$e_pic = cegah($_POST['e_pic']);
	$e_nohp = cegah($_POST['e_nohp']);
	$e_notelp = cegah($_POST['e_notelp']);
	$e_email = cegah($_POST['e_email']);




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
			//cek
			$qcc = mysqli_query($koneksi, "SELECT * FROM cnp_mitra ".
								"WHERE nama = '$e_nama'");
			$rcc = mysqli_fetch_assoc($qcc);
			$tcc = mysqli_num_rows($qcc);

			//nek ada
			if ($tcc != 0)
				{
				//re-direct
				$pesan = "Mitra Perusahaan Tersebut Sudah Ada. Silahkan Ganti Yang Lain...!!";
				$ke = "$filenya?s=add&kd=$x";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//insert
				mysqli_query($koneksi, "INSERT INTO cnp_mitra(kd, nama, alamat, pic, no_hp, no_telp, email, postdate) VALUES ".
									"('$kd', '$e_nama', '$e_alamat', '$e_pic', '$e_nohp', '$e_notelp', '$e_email', '$today')");




				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				xloc($filenya);
				exit();
				}
			}
		}


	//jika edit ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	else if ($s == "edit")
		{
		//update
		mysqli_query($koneksi, "UPDATE cnp_mitra SET nama = '$e_nama', ".
						"alamat = '$e_alamat', ".
						"pic = '$e_pic', ".
						"no_hp = '$e_nohp', ".
						"no_telp = '$e_notelp', ".
						"email = '$e_email' ".
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
	$excelfile = 'data_mitra_perusahaan.xls';
	//lokasi hasil konversi
	$lokasi	   = '../../filebox/excel/';
	$excel=new ExcelWriter($lokasi.$excelfile);
	
	//Buat header untuk tabel
	$myArr = array("NAMA","ALAMAT","PIC","NO_HP","NO_TELP","EMAIL");
	$excel->writeLine($myArr);
		



	//data
	$qdt = mysqli_query($koneksi, "SELECT * FROM cnp_mitra ".
							"ORDER BY nama ASC");
	$rdt = mysqli_fetch_assoc($qdt);

	do
	  	{
		//nilai
		$dt_nox = $dt_nox + 1;
		$dt_pkd = nosql($rdt['kd']);

		$i_nama = balikin($rdt['nama']);
		$i_alamat = balikin($rdt['alamat']);
		$i_pic = balikin($rdt['pic']);
		$i_nohp = balikin($rdt['no_hp']);
		$i_notelp = balikin($rdt['no_telp']);
		$i_email = balikin($rdt['email']);




		$arr2 = array($i_nama,$i_alamat,$i_pic,$i_nohp,$i_notelp,$i_email);
						


		$excel->writeLine($arr2);
		}
	while ($rdt = mysqli_fetch_assoc($qdt));


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
<option value="'.$filenya.'?crkd=cr03&crtipe=Telp&kunci='.$kunci.'">Telp</option>
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

		$sqlcount = "SELECT * FROM cnp_mitra ".
							"WHERE nama LIKE '%$kunci%' ".
							"ORDER BY nama ASC";
		$sqlresult = $sqlcount;

		$count = mysqli_num_rows(mysqli_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}


	//alamat
	else if ($crkd == "cr02")
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT * FROM cnp_mitra ".
							"WHERE alamat LIKE '%$kunci%' ".
							"ORDER BY alamat ASC";
		$sqlresult = $sqlcount;

		$count = mysqli_num_rows(mysqli_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}
		
	//telp
	else if ($crkd == "cr03")
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT * FROM cnp_mitra ".
							"WHERE no_hp LIKE '%$kunci%' ".
							"OR no_telp LIKE '%$kunci%' ".
							"ORDER BY no_hp ASC, ".
							"no_telp ASC";
		$sqlresult = $sqlcount;

		$count = mysqli_num_rows(mysqli_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}

	else
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT * FROM cnp_mitra ".
						"ORDER BY nama ASC";
		$sqlresult = $sqlcount;

		$count = mysqli_num_rows(mysqli_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}

	if ($count != 0)
		{
		//view data
		echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="1">&nbsp;</td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td width="200"><strong><font color="'.$warnatext.'">Alamat</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">PIC</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">No.HP</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">No.Telp</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">E-Mail</font></strong></td>
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
			$i_nama = balikin($data['nama']);
			$i_alamat = balikin($data['alamat']);
			$i_pic = balikin($data['pic']);
			$i_no_hp = balikin($data['no_hp']);
			$i_no_telp = balikin($data['no_telp']);
			$i_email = balikin($data['email']);





			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td><input name="kd'.$i_nomer.'" type="hidden" value="'.$i_kd.'">
			<input type="checkbox" name="item'.$i_nomer.'" value="'.$i_kd.'">
	    	</td>
			<td>
			<a href="'.$filenya.'?s=edit&kd='.$i_kd.'" title="EDIT..."><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_nama.'</td>
			<td>'.$i_alamat.'</td>
			<td>'.$i_pic.'</td>
			<td>'.$i_no_hp.'</td>
			<td>'.$i_no_telp.'</td>
			<td>'.$i_email.'</td>
    		</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

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
	$qnil = mysqli_query($koneksi, "SELECT * FROM cnp_mitra ".
							"WHERE kd = '$kd'");
	$rnil = mysqli_fetch_assoc($qnil);
	$y_nama = balikin($rnil['nama']);
	$y_alamat = balikin($rnil['alamat']);
	$y_pic = balikin($rnil['pic']);
	$y_no_hp = balikin($rnil['no_hp']);
	$y_no_telp = balikin($rnil['no_telp']);
	$y_email = balikin($rnil['email']);


	echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
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
	Alamat
	</td>
	<td>: 
	<input name="e_alamat" type="text" value="'.$y_alamat.'" size="50">
	</td>
	</tr>
	
	<tr>
	<td>
	PIC
	</td>
	<td>: 
	<input name="e_pic" type="text" value="'.$y_pic.'" size="30">
	</td>
	</tr>
	
	<tr>
	<td>
	No.HP
	</td>
	<td>: 
	<input name="e_nohp" type="text" value="'.$y_no_hp.'" size="20">
	</td>
	</tr>
	
	<tr>
	<td>
	No.Telp
	</td>
	<td>: 
	<input name="e_notelp" type="text" value="'.$y_no_telp.'" size="20">
	</td>
	</tr>
	
	<tr>
	<td>
	E-Mail
	</td>
	<td>: 
	<input name="e_email" type="text" value="'.$y_email.'" size="30">
	</td>
	</tr>
	
	</table>

	<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
	<input name="kd" type="hidden" value="'.nosql($_REQUEST['kd']).'">
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