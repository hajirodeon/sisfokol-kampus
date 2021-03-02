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
$filenya = "dosen_pbb.php";
$judul = "Dosen Pembimbing";
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

		//NULL-kan ruang e....
		mysqli_query($koneksi, "DELETE FROM dosen_pembimbing ".
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
	$ruang = nosql($_POST['ruang']);
	$page = nosql($_POST['page']);
	$pegawai = nosql($_POST['pegawai']);


	//cek, sudah ada ..?
	$qc = mysqli_query($koneksi, "SELECT * FROM dosen_pembimbing ".
				"WHERE kd_progdi = '$progdi' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_ruang = '$ruang'");
	$rc = mysqli_fetch_assoc($qc);
	$tc = mysqli_num_rows($qc);

	//nek iyo
	if ($tc != 0)
		{
		//re-direct
		$pesan = "Ruang Kelas ini, sudah mempunyai Dosen Pembimbing. Harap Diperhatikan...!!.";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//query
		mysqli_query($koneksi, "INSERT INTO dosen_pembimbing(kd, kd_progdi, kd_tapel, kd_smt, ".
				"kd_kelas, kd_ruang, kd_pegawai) VALUES ".
				"('$x', '$progdi', '$tapelkd', '$smtkd', ".
				"'$kelkd', '$ruang', '$pegawai')");

		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		xloc($ke);
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

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&rukd='.$rukd.'&smtkd='.$stkd.'">'.$stsmt.'</option>';
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

	$sqlcount = "SELECT dosen_pembimbing.*, dosen_pembimbing.kd AS dpkd, ".
			"m_ruang.*, m_pegawai.* ".
			"FROM dosen_pembimbing, m_ruang, m_pegawai ".
			"WHERE dosen_pembimbing.kd_ruang = m_ruang.kd ".
			"AND dosen_pembimbing.kd_pegawai = m_pegawai.kd ".
			"AND dosen_pembimbing.kd_progdi = '$progdi' ".
			"AND dosen_pembimbing.kd_tapel = '$tapelkd' ".
			"AND dosen_pembimbing.kd_smt = '$smtkd' ".
			"AND dosen_pembimbing.kd_kelas = '$kelkd' ".
			"ORDER BY m_ruang.ruang ASC";
	$sqlresult = $sqlcount;


	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?progdi=$progdi&tapelkd=$tapelkd&smtkd=$smtkd&kelkd=$kelkd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);

	//tambah
	echo '<select name="pegawai">
	<option value="" selected>-Pegawai-</option>';

	$qtp2 = mysqli_query($koneksi, "SELECT * FROM m_pegawai ".
				"ORDER BY round(nip) ASC");
	$rowtp2 = mysqli_fetch_assoc($qtp2);

	do
		{
		$tp2_kd = nosql($rowtp2['kd']);
		$tp2_nip = nosql($rowtp2['nip']);
		$tp2_nama = balikin($rowtp2['nama']);

		echo '<option value="'.$tp2_kd.'">['.$tp2_nip.']. '.$tp2_nama.'</option>';
		}
	while ($rowtp2 = mysqli_fetch_assoc($qtp2));

	echo '</select>,

	<select name="ruang">
	<option value="" selected>-Kelas-</option>';

	$qtp2x = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
				"ORDER BY ruang ASC");
	$rowtp2x = mysqli_fetch_assoc($qtp2x);

	do
		{
		$tp2x_kd = nosql($rowtp2x['kd']);
		$tp2x_ru = balikin($rowtp2x['ruang']);

		echo '<option value="'.$tp2x_kd.'">'.$tp2x_ru.'</option>';
		}
	while ($rowtp2x = mysqli_fetch_assoc($qtp2x));

	echo '</select>

    	<input name="progdi" type="hidden" value="'.$progdi.'">
    	<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
    	<input name="smtkd" type="hidden" value="'.$smtkd.'">
    	<input name="kelkd" type="hidden" value="'.$kelkd.'">
	<input name="btnSMPx" type="submit" value="&gt;&gt;&gt;">

	<table width="500" border="1" cellpadding="3" cellspacing="0">
 	<tr bgcolor="'.$warnaheader.'">
    	<td width="1" valign="top">&nbsp;</td>
    	<td width="75" valign="top"><strong>Kelas</strong></td>
    	<td valign="top"><strong>Dosen</strong></td>
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

			$i_kd = nosql($data['dpkd']);
			$i_nip = nosql($data['nip']);
			$i_nama = balikin2($data['nama']);
			$i_ruang = balikin2($data['ruang']);

			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td valign="top">
			<input name="kd'.$nomer.'" type="hidden" value="'.$i_kd.'">
			<input name="item'.$nomer.'" type="checkbox" value="'.$i_kd.'">
			</td>
			<td valign="top">'.$i_ruang.'</td>
      			<td valign="top">'.$i_nip.'. '.$i_nama.'</td>
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