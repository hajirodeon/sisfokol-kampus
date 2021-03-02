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
require("../../inc/cek/admbau.php");
require("../../inc/class/paging2.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "tmp_lab.php";
$judul = "Penempatan Barang per Lab.";
$judulku = "[$bau_session : $nip3_session. $nm3_session]. $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$brgkd = nosql($_REQUEST['brgkd']);
$labkd = nosql($_REQUEST['labkd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

//focus
$diload = "document.formx.labkd.focus();";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika tambah
if ($_POST['btnTBH'])
	{
	$brgkd = nosql($_POST['brg']);
	$labkd = nosql($_POST['labkd']);
	$jml = nosql($_POST['jml']);
	$page = nosql($_POST['page']);


	//nek null
	if ((empty($brgkd)) OR (empty($jml)))
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?labkd=$labkd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		///cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM inv_brg_lab ".
					"WHERE kd_brg = '$brgkd' ".
					"AND kd_lab = '$labkd'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_jml = nosql($rcc['jml']);


		//jml. yang telah dipakai
		$qtok = mysqli_query($koneksi, "SELECT SUM(jml) AS pake FROM inv_brg_lab ".
					"WHERE kd_brg = '$brgkd'");
		$rtok = mysqli_fetch_assoc($qtok);
		$ttok = mysqli_num_rows($qtok);
		$tok_jml = nosql($rtok['pake']);


		//jml. total
		$qsto = mysqli_query($koneksi, "SELECT * FROM inv_stock ".
					"WHERE kd_brg = '$brgkd'");
		$rsto = mysqli_fetch_assoc($qsto);
		$tsto = mysqli_num_rows($qsto);
		$sto_jml = nosql($rsto['jml']);


		//jml. sisa
		$t_sisa = round($sto_jml - $tok_jml);



		//jika sisa tidak mencukupi. . .
		if ($t_sisa < $jml)
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//auto-kembali
			$pesan = "Jumlah Barang Tidak Mencukupi. Harap Diperhatikan...!!";
			$ke = "$filenya?labkd=$labkd&page=$page";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//nek ada, update aja
			if ($tcc != 0)
				{
				//query
				mysqli_query($koneksi, "UPDATE inv_brg_lab SET jml = jml + '$jml' ".
						"WHERE kd_brg = '$brgkd' ".
						"AND kd_lab = '$labkd'");

				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$ke = "$filenya?labkd=$labkd";
				xloc($ke);
				exit();
				}
			else
				{
				//query
				mysqli_query($koneksi, "INSERT INTO inv_brg_lab(kd, kd_lab, kd_brg, jml) VALUES ".
						"('$x', '$labkd', '$brgkd', '$jml')");

				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$ke = "$filenya?labkd=$labkd";
				xloc($ke);
				exit();
				}
			}
		}
	}





//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$page = nosql($_POST['page']);
	$labkd = nosql($_POST['labkd']);


	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT inv_brg.*, inv_brg_lab.* ".
			"FROM inv_brg, inv_brg_lab ".
			"WHERE inv_brg_lab.kd_brg = inv_brg.kd ".
			"AND inv_brg_lab.kd_lab = '$labkd' ".
			"ORDER BY inv_brg.kode ASC";
	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);

	//ambil semua
	do
		{
		//nilai
		$i = $i + 1;
		$yuk = "item";
		$yuhu = "$yuk$i";
		$xkd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM inv_brg_lab ".
				"WHERE kd_lab = '$labkd' ".
				"AND kd = '$xkd'");
		}
	while ($data = mysqli_fetch_assoc($result));

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$ke = "$filenya?labkd=$labkd&page=$page";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//js
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");
require("../../inc/js/jumpmenu.js");
require("../../inc/menu/admbau.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Lab. : ';
echo "<select name=\"labkd\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qkeax = mysqli_query($koneksi, "SELECT * FROM inv_lab ".
			"WHERE kd = '$labkd'");
$rowkeax = mysqli_fetch_assoc($qkeax);
$keax_kd = nosql($rowkeax['kd']);
$keax_pro = balikin($rowkeax['lab']);

echo '<option value="'.$keax_kd.'">'.$keax_pro.'</option>';

$qkea = mysqli_query($koneksi, "SELECT * FROM inv_lab ".
			"WHERE kd <> '$labkd' ".
			"ORDER BY lab ASC");
$rowkea = mysqli_fetch_assoc($qkea);

do
	{
	$kea_kd = nosql($rowkea['kd']);
	$kea_pro = balikin($rowkea['lab']);

	echo '<option value="'.$filenya.'?labkd='.$kea_kd.'">'.$kea_pro.'</option>';
	}
while ($rowkea = mysqli_fetch_assoc($qkea));

echo '</select>
</td>
</tr>
</table>';

//jika null
if (empty($labkd))
	{
	echo '<p>
	<font color="red"><strong>Lab. Belum Dipilih...!!.</strong></font>
	</p>';
	}
else
	{
	//item barang
	$qtem = mysqli_query($koneksi, "SELECT * FROM inv_brg ".
				"ORDER BY kode ASC");
	$rtem = mysqli_fetch_assoc($qtem);
	$ttem = mysqli_num_rows($qtem);

	echo '<p>
	<select name="brg">
	<option value="" selected>-Item Barang-</option>';

	do
		{
		//nilai
		$tem_kd = nosql($rtem['kd']);
		$tem_kode = nosql($rtem['kode']);
		$tem_nama = balikin2($rtem['nama']);


		//jml. yang telah dipakai
		$qtok = mysqli_query($koneksi, "SELECT SUM(jml) AS pake FROM inv_brg_lab ".
								"WHERE kd_brg = '$tem_kd'");
		$rtok = mysqli_fetch_assoc($qtok);
		$ttok = mysqli_num_rows($qtok);
		$tok_jml = nosql($rtok['pake']);


		//jml. total
		$qsto = mysqli_query($koneksi, "SELECT * FROM inv_stock ".
								"WHERE kd_brg = '$tem_kd'");
		$rsto = mysqli_fetch_assoc($qsto);
		$tsto = mysqli_num_rows($qsto);
		$sto_jml = nosql($rsto['jml']);


		//jml. sisa
		$t_sisa = round($sto_jml - $tok_jml);

		echo '<option value="'.$tem_kd.'">'.$tem_kode.'. '.$tem_nama.' (Sisa : '.$t_sisa.')</option>';
		}
	while ($rtem = mysqli_fetch_assoc($qtem));

	echo '</select>,
	Jumlah :
	<input name="jml" type="text" value="" size="5" maxlength="5">
	<input name="btnTBH" type="submit" value="TAMBAH >>">
	</p>';




	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT inv_brg.*, inv_brg_lab.*, inv_brg_lab.kd AS ikd ".
			"FROM inv_brg, inv_brg_lab ".
			"WHERE inv_brg_lab.kd_brg = inv_brg.kd ".
			"AND inv_brg_lab.kd_lab = '$labkd' ".
			"ORDER BY inv_brg.kode ASC";
	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?labkd=$labkd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);


	if ($count != 0)
		{
		echo '<p>
		<table width="600" border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="1%">&nbsp;</td>
		<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Jumlah</font></strong></td>
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
			$i_kd = nosql($data['ikd']);
			$i_kode = nosql($data['kode']);
			$i_nama = balikin2($data['nama']);
			$i_jml = nosql($data['jml']);

			//nek null
			if (empty($i_jml))
				{
				$i_jml = "0";
				}

			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
	       		</td>
			<td>'.$i_kode.'</td>
			<td>'.$i_nama.'</td>
			<td>'.$i_jml.'</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		echo '</table>
		<table width="600" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="300">
		<input name="page" type="hidden" value="'.$page.'">
		<input name="labkd" type="hidden" value="'.$labkd.'">
		<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$limit.')">
		<input name="btnBTL" type="reset" value="BATAL">
		<input name="btnHPS" type="submit" value="HAPUS">
		</td>
		<td align="right">Total : <strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
		</tr>
		</table>
		</p>';
		}

	else
		{
		echo '<font color="red"><strong>TIDAK ADA DATA.</strong></font>';
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