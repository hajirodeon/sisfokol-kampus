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
$filenya = "mhs_jenis.php";
$judul = "Penempatan Mahasiswa Reguler ke Extensi, atau Sebaliknya";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&smtkd=$smtkd&page=$page";




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
else if (empty($smtkd))
	{
	$diload = "document.formx.smt.focus();";
	}





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika batal
if ($_POST['btnBTL'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$tapelkd = nosql($_POST['tapelkd']);
	$smtkd = nosql($_POST['smtkd']);
	$kelkd = nosql($_POST['kelkd']);
	$page = nosql($_POST['page']);

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	xloc($ke);
	exit();
	}





//jika hapus
if ($_POST['btnHPS'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$tapelkd = nosql($_POST['tapelkd']);
	$smtkd = nosql($_POST['smtkd']);
	$kelkd = nosql($_POST['kelkd']);
	$page = nosql($_POST['page']);
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kdix = nosql($_POST["$yuhu"]);

		//netralkan kembali
		mysqli_query($koneksi, "UPDATE mahasiswa_kelas SET kd_kelas = '$kelkd' ".
				"WHERE kd_mahasiswa = '$kdix' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_smt = '$smtkd'");


		//ketahui nim e
		$qcc = mysqli_query($koneksi, "SELECT kd, nim FROM m_mahasiswa ".
					"WHERE kd = '$kdix'");
		$rcc = mysqli_fetch_assoc($qcc);
		$cc_nim = nosql($rcc['nim']);

		//netralkan dahulu
		$netral_e = substr($cc_nim,0,8);


		//jika menjadikan ke ekstensi
		if ($kelkd == "c81e728d9d4c2f636f067f89cc14862c")
			{
			//ubah nim
			$tanda_e = "E";
			$nim_baru = "$netral_e$tanda_e";
			$pass_baru = md5($nim_baru);
			}


		//jika menjadikan ke reguler
		else if ($kelkd == "c4ca4238a0b923820dcc509a6f75849b")
			{
			//ubah nim
			$hilang_e = substr($netral_e,0,8);
			$nim_baru = $hilang_e;
			$pass_baru = md5($nim_baru);
			}





		//update m_mahasiswa
		mysqli_query($koneksi, "UPDATE m_mahasiswa SET nim = '$nim_baru', ".
				"usernamex = '$nim_baru', ".
				"passwordx = '$pass_baru' ".
				"WHERE kd = '$kdix'");
		}

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	xloc($ke);
	exit();
	}





//jika tambah
if ($_POST['btnSMPx'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$tapelkd = nosql($_POST['tapelkd']);
	$smtkd = nosql($_POST['smtkd']);
	$kelkd = nosql($_POST['kelkd']);
	$page = nosql($_POST['page']);
	$siswa = nosql($_POST['siswa']);

/*
	//cek, sudah ada ...?
	$qc = mysqli_query($koneksi, "SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
				"AND mahasiswa_kelas.kd_smtkd = '$smtkd' ".
				"AND mahasiswa_kelas.kd_mahasiswa = '$siswa'");
	$rc = mysqli_fetch_assoc($qc);
	$tc = mysqli_num_rows($qc);
	$nim = nosql($rc['nim']);
	$nama = balikin2($rc['nama']);
	$rukdx = nosql($rc['kd_kelas']);
*/

	//jenis e
	$qrx = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
				"WHERE kd <> '$kelkd'");
	$rrx = mysqli_fetch_assoc($qrx);
	$rxkd = nosql($rrx['kd']);


/*

	//nek iyo
	if ($tc != 0)
		{
		//re-direct
		$pesan = "Mahasiswa Dengan NIM : $nim, Nama : $nama, Telah Ditempatkan Pada Jenis : $rx";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
*/
		//query
		mysqli_query($koneksi, "UPDATE mahasiswa_kelas SET kd_kelas = '$rxkd' ".
				"WHERE kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$siswa' ".
				"AND kd_progdi = '$progdi'");


/*
		//jika menjadikan ke ekstensi
		if ($rukdx <> "c81e728d9d4c2f636f067f89cc14862c")
			{
			//ketahui nim e
			$qcc = mysqli_query($koneksi, "SELECT kd, nim FROM m_mahasiswa ".
						"WHERE kd = '$siswa'");
			$rcc = mysqli_fetch_assoc($qcc);
			$cc_nim = nosql($rcc['nim']);

			//ubah nim
			$tanda_e = "E";
			$nim_baru = "$cc_nim$tanda_e";
			}


		//jika menjadikan ke reguler
		else if ($rukdx == "c81e728d9d4c2f636f067f89cc14862c")
			{
			//ketahui nim e
			$qcc = mysqli_query($koneksi, "SELECT kd, nim FROM m_mahasiswa ".
						"WHERE kd = '$siswa'");
			$rcc = mysqli_fetch_assoc($qcc);
			$cc_nim = nosql($rcc['nim']);

			//ubah nim
			$hilang_e = substr($cc_nim,0,8);
			$nim_baru = $hilang_e;
			}
*/




		//ketahui nim e
		$qcc = mysqli_query($koneksi, "SELECT kd, nim FROM m_mahasiswa ".
					"WHERE kd = '$siswa'");
		$rcc = mysqli_fetch_assoc($qcc);
		$cc_nim = nosql($rcc['nim']);

		//netralkan dahulu
		$netral_e = substr($cc_nim,0,8);


		//jika menjadikan ke ekstensi
		if ($rxkd == "c81e728d9d4c2f636f067f89cc14862c")
			{
			//ubah nim
			$tanda_e = "E";
			$nim_baru = "$netral_e$tanda_e";
			$pass_baru = md5($nim_baru);
			}


		//jika menjadikan ke reguler
		else if ($rxkd == "c4ca4238a0b923820dcc509a6f75849b")
			{
			//ubah nim
			$hilang_e = substr($netral_e,0,8);
			$nim_baru = $hilang_e;
			$pass_baru = md5($nim_baru);
			}



		//update m_mahasiswa
		mysqli_query($koneksi, "UPDATE m_mahasiswa SET nim = '$nim_baru', ".
				"usernamex = '$nim_baru', ".
				"passwordx = '$pass_baru' ".
				"WHERE kd = '$siswa'");




	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
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


Tahun Akademik : ';
echo "<select name=\"tapel\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<option value="'.$tpx_kd.'">'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd <> '$tapelkd' ".
			"ORDER BY tahun1 ASC");
$rowtp = mysqli_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysqli_fetch_assoc($qtp));

echo '</select>,



Semester : ';
echo "<select name=\"smt\" onChange=\"MM_jumpMenu('self',this,0)\">";

//smt
$qstxy = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysqli_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);

echo '<option value="'.$smtkd.'" selected>'.$smt.'</option>';

$qst = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd <> '$smtkd'");
$rowst = mysqli_fetch_assoc($qst);

do
	{
	$stkd = nosql($rowst['kd']);
	$stsmt = nosql($rowst['smt']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&smtkd='.$stkd.'">'.$stsmt.'</option>';
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
	echo '<font color="#FF0000"><strong>PROGRAM STUDI Belum Dipilih...!</strong></font>';
	}
else if (empty($kelkd))
	{
	echo '<font color="#FF0000"><strong>JENIS Belum Dipilih...!</strong></font>';
	}

else if (empty($tapelkd))
	{
	echo '<font color="#FF0000"><strong>TAHUN AKADEMIK Belum Dipilih...!</strong></font>';
	}

else if (empty($smtkd))
	{
	echo '<font color="#FF0000"><strong>SEMESTER Belum Dipilih...!</strong></font>';
	}
else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, mahasiswa_kelas.* ".
			"FROM m_mahasiswa, mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
			"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
			"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
			"AND mahasiswa_kelas.kd_kelas <> '$kelkd' ".
			"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;


	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?progdi=$progdi&tapelkd=$tapelkd&smtkd=$smtkd&kelkd=$kelkd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);

	//tambah
	echo '<select name="siswa">
    	<option value="" selected>-TAMBAH MAHASISWA-</option>';

	//query
	$qks = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, mahasiswa_kelas.* ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
				"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
				"ORDER BY round(m_mahasiswa.nim) ASC");
	$rowks = mysqli_fetch_assoc($qks);

	do
		{
		$kdks = nosql($rowks['mskd']);
		$nisks = nosql($rowks['nim']);
		$nmks = balikin2($rowks['nama']);


		echo '<option value="'.$kdks.'">('.$nisks.') '.$nmks.'</option>';
		}
	while ($rowks = mysqli_fetch_assoc($qks));

	echo '</select>
    	<input name="progdi" type="hidden" value="'.$progdi.'">
    	<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
    	<input name="smtkd" type="hidden" value="'.$smtkd.'">
    	<input name="kelkd" type="hidden" value="'.$kelkd.'">
	<input name="btnSMPx" type="submit" value="&gt;&gt;&gt;">

	<table width="500" border="1" cellpadding="3" cellspacing="0">
 	<tr bgcolor="'.$warnaheader.'">
    	<td width="1" valign="top">&nbsp;</td>
    	<td width="50" valign="top"><strong>NIM</strong></td>
    	<td valign="top"><strong>Nama</strong></td>
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

			$i_kd = nosql($data['mskd']);
			$i_nim = nosql($data['nim']);
			$i_nama = balikin2($data['nama']);



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td valign="top">
			<input name="kd'.$nomer.'" type="hidden" value="'.$i_kd.'">
			<input name="item'.$nomer.'" type="checkbox" value="'.$i_kd.'">
			</td>
      			<td valign="top">'.$i_nim.'</td>
      			<td valign="top">'.$i_nama.'</td>
    			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
		}

	echo '</table>

	<table width="500" border="0" cellspacing="0" cellpadding="3">
    	<tr>
    	<td align="right">Total : <font color="#FF0000"><strong>'.$count.'</strong></font> Data. '.$pagelist.'</td>
    	</tr>
    	<tr>
    	<td align="right">
	<input name="btnALL" type="button" onClick="checkAll('.$limit.')" value="SEMUA">
    	<input name="btnBTL" type="submit" value="BATAL">
    	<input name="btnHPS" type="submit" value="HAPUS">
	<input name="jml" type="hidden" value="'.$limit.'">
	<input name="page" type="hidden" value="'.$page.'">
    	<input name="total" type="hidden" value="'.$count.'">
    	</td>
    	</tr>
    	</table>';
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