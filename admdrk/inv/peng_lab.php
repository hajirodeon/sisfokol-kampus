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
require("../../inc/cek/admdrk.php");
require("../../inc/class/paging2.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "peng_lab.php";
$judul = "Penggunaan Lab.";
$judulku = "$judul  [$drk_session : $nip1_session. $nm1_session]";
$judulx = $judul;
$labkd = nosql($_REQUEST['labkd']);
$pbln = nosql($_REQUEST['pbln']);
$pthn = nosql($_REQUEST['pthn']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}



//focus
//nek nuul
if (empty($labkd))
	{
	$diload = "document.formx.lab.focus();";
	}
else if (empty($pbln))
	{
	$diload = "document.formx.p_bln.focus();";
	}
else if (empty($pthn))
	{
	$diload = "document.formx.p_thn.focus();";
	}




//PROSES ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$pbln = nosql($_POST['pbln']);
	$pthn = nosql($_POST['pthn']);
	$labkd = nosql($_POST['labkd']);
	$page = nosql($_POST['page']);

	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT * FROM inv_peng_lab ".
					"WHERE kd_lab = '$labkd' ".
					"AND round(DATE_FORMAT(tgl, '%m')) = '$pbln' ".
					"AND round(DATE_FORMAT(tgl, '%Y')) = '$pthn' ".
					"ORDER BY tgl DESC";
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
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM inv_peng_lab ".
						"WHERE kd = '$kd'");
		}
	while ($data = mysqli_fetch_assoc($result));

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$ke = "$filenya?labkd=$labkd&pbln=$pbln&pthn=$pthn";
	xloc($ke);
	exit();
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();



//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admdrk.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';
xheadline($judul);
echo ' [<a href="peng_lab_entry.php" title="Entry Penggunaan Lab.">Data Baru</a>]

<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Lab. : ';

//terpilih
$qlabx = mysqli_query($koneksi, "SELECT * FROM inv_lab ".
						"WHERE kd = '$labkd'");
$rlabx = mysqli_fetch_assoc($qlabx);
$labx_kd = nosql($rlabx['kd']);
$labx_nm = balikin($rlabx['lab']);

echo "<select name=\"lab\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$labx_kd.'" selected>'.$labx_nm.'</option>';

//lab
$qlab = mysqli_query($koneksi, "SELECT * FROM inv_lab ".
						"WHERE kd <> '$labkd' ".
						"ORDER BY lab ASC");
$rlab = mysqli_fetch_assoc($qlab);

do
	{
	$lab_kd = nosql($rlab['kd']);
	$lab_nm = balikin($rlab['lab']);

	echo '<option value="'.$filenya.'?labkd='.$lab_kd.'">'.$lab_nm.'</option>';
	}
while ($rlab = mysqli_fetch_assoc($qlab));

echo '</select>,
Bulan : ';
echo "<select name=\"p_bln\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$pbln.'" selected>'.$arrbln[$pbln].'</option>';
for ($j=1;$j<=12;$j++)
	{
	echo '<option value="'.$filenya.'?labkd='.$labkd.'&pbln='.$j.'">'.$arrbln[$j].'</option>';
	}

echo '</select>,
Tahun : ';
echo "<select name=\"p_thn\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$pthn.'" selected>'.$pthn.'</option>';
for ($k=$pinjam01;$k<=$pinjam02;$k++)
	{
	echo '<option value="'.$filenya.'?labkd='.$labkd.'&pbln='.$pbln.'&pthn='.$k.'">'.$k.'</option>';
	}
echo '</select>
</td>
</tr>
</table>
<br>';


if (empty($labkd))
	{
	echo '<strong><font color="#FF0000">LAB. Belum Dipilih...!</font></strong>';
	}
else if (empty($pbln))
	{
	echo '<strong><font color="#FF0000">BULAN Penggunaan Lab Belum Dipilih...!</font></strong>';
	}
else if (empty($pthn))
	{
	echo '<strong><font color="#FF0000">TAHUN Penggunaan Lab Belum Dipilih...!</font></strong>';
	}
else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT inv_peng_lab.*, inv_peng_lab.kd AS plkd, ".
			"m_progdi.*, m_ruang.* ".
			"FROM inv_peng_lab, m_progdi, m_ruang ".
			"WHERE round(date_format(inv_peng_lab.tgl, '%m')) = '$pbln' ".
			"AND round(date_format(inv_peng_lab.tgl, '%Y')) = '$pthn' ".
			"AND inv_peng_lab.kd_progdi = m_progdi.kd ".
			"AND inv_peng_lab.kd_ruang = m_ruang.kd ".
			"AND inv_peng_lab.kd_lab = '$labkd' ".
			"ORDER BY inv_peng_lab.tgl DESC";
	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?labkd=$labkd&pbln=$pbln&pthn=$pthn";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);


	//nek gak ada
	if ($count == 0)
		{
		echo '<strong><font color="#FF0000">TIDAK ADA DATA PENGGUNAAN LAB.</font></strong>';
		}

	//nek ada
	else
		{
		echo '<table width="600" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="100"><strong><font color="'.$warnatext.'">Tgl. Penggunaan</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Jam</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Program Studi</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Kelas</font></strong></td>
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

			$nomer = $nomer + 1;
			$e_kd = nosql($data['plkd']);
			$e_tgl = $data['tgl'];
			$e_jam = balikin($data['jam']);
			$e_progdi = balikin($data['nama']);
			$e_ruang = balikin($data['ruang']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$e_kd.'">
	        	</td>
			<td>'.$e_tgl.'</td>
			<td>'.$e_jam.'</td>
			<td>'.$e_progdi.'</td>
			<td>'.$e_ruang.'</td>
	        	</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		echo '</table>
		<table width="600" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="260">
		<input name="page" type="hidden" value="'.$page.'">
		<input name="labkd" type="hidden" value="'.$labkd.'">
		<input name="pbln" type="hidden" value="'.$pbln.'">
		<input name="pthn" type="hidden" value="'.$pthn.'">
		<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$limit.')">
		<input name="btnBTL" type="reset" value="BATAL">
		<input name="btnHPS" type="submit" value="HAPUS">
		</td>
		<td align="right">Total : <strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
		</tr>
		</table>';
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