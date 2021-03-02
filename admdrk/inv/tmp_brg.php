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
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "tmp_brg.php";
$judul = "Penempatan per Barang";
$judulku = "$judul  [$drk_session : $nip1_session. $nm1_session]";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$brgkd = nosql($_REQUEST['brgkd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

//focus
$diload = "document.formx.jmlx1.focus();";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	xloc($filenya);
	exit();
	}




//nek df
if ($_POST['btnDF'])
	{
	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	xloc($filenya);
	exit();
	}





//nek simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$brgkd = nosql($_POST['brgkd']);


	//progdi
	$qkea = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
				"ORDER BY round(no) ASC");
	$rkea = mysqli_fetch_assoc($qkea);
	$tkea = mysqli_num_rows($qkea);


	//ambil semua
	do
		{
		//nilai
		$i = $i + 1;

		$kea = "kea";
		$kea1 = "$kea$i";
		$kea2x = nosql($_POST["$kea1"]);

		$yuk = "jmlx";
		$yuhu = "$yuk$i";
		$yuhux = nosql($_POST["$yuhu"]);


		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM inv_brg_progdi ".
					"WHERE kd_brg = '$brgkd' ".
					"AND kd_progdi = '$kea2x'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);

		//nek ada, update
		if ($tcc != 0)
			{
			//update
			mysqli_query($koneksi, "UPDATE inv_brg_progdi SET jml = '$yuhux' ".
					"WHERE kd_brg = '$brgkd' ".
					"AND kd_progdi = '$kea2x'");
			}

		else
			{
			//insert
			$xyz = md5("$x$i");
			mysqli_query($koneksi, "INSERT INTO inv_brg_progdi(kd, kd_brg, kd_progdi, jml) VALUES ".
					"('$xyz', '$brgkd', '$kea2x', '$yuhux')");
			}
		}
	while ($rkea = mysqli_fetch_assoc($qkea));





	//jml. yang telah dipakai
	$qtok = mysqli_query($koneksi, "SELECT SUM(jml) AS pake FROM inv_brg_progdi ".
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


	//jika jumlah sisa gak sesuai
	if ($t_sisa < 0)
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//auto-kembali
		$pesan = "Jumlah Barang Tidak Sesuai. Harap Diperhatikan...!!";
		$ke = "$filenya?page=$page&s=edit&brgkd=$brgkd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//auto-kembali
		xloc($filenya);
		exit();
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//js
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/menu/admdrk.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';

//jika edit /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($s == "edit")
	{
	//nilai
	$brgkd = nosql($_REQUEST['brgkd']);

	//detail
	$qdt = mysqli_query($koneksi, "SELECT * FROM inv_brg ".
							"WHERE kd = '$brgkd'");
	$rdt = mysqli_fetch_assoc($qdt);
	$tdt = mysqli_num_rows($qdt);
	$dt_kode = nosql($rdt['kode']);
	$dt_nama = balikin2($rdt['nama']);

	//progdi
	$qkea = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
							"ORDER BY round(no) ASC");
	$rkea = mysqli_fetch_assoc($qkea);
	$tkea = mysqli_num_rows($qkea);

	//nilai dari pengadaan
	$qdaa = mysqli_query($koneksi, "SELECT SUM(jml) AS total FROM inv_brg_pengadaan ".
							"WHERE kd_brg = '$brgkd'");
	$rdaa = mysqli_fetch_assoc($qdaa);
	$tdaa = mysqli_num_rows($qdaa);
	$daa_jml = nosql($rdaa['total']);


	echo 'Barang : <strong>['.$dt_kode.']. '.$dt_nama.'</strong>
	<p>
	Total Stock : <strong>'.$daa_jml.'</strong>
	</p>
	<UL>';

	do
		{
		//nilai
		$nomer = $nomer + 1;
		$kea_kd = nosql($rkea['kd']);
		$kea_kel = balikin2($rkea['nama']);



		//jml-nya...
		$qkeb = mysqli_query($koneksi, "SELECT * FROM inv_brg_progdi ".
								"WHERE kd_brg = '$brgkd' ".
								"AND kd_progdi = '$kea_kd'");
		$rkeb = mysqli_fetch_assoc($qkeb);
		$tkeb = mysqli_num_rows($qkeb);
		$keb_jml = nosql($rkeb['jml']);



		echo '<p>
		<LI>
		<input name="kea'.$nomer.'" type="hidden" value="'.$kea_kd.'">
		<strong>'.$kea_kel.'</strong>
		<br>
		Jumlah :
		<input name="jmlx'.$nomer.'" type="text" value="'.$keb_jml.'" size="10" onKeyPress="return numbersonly(this, event)">
		</LI>
		</p>';
		}
	while ($rkea = mysqli_fetch_assoc($qkea));

	echo '</UL>
	<input name="s" type="hidden" value="edit">
	<input name="brgkd" type="hidden" value="'.$brgkd.'">
	<input name="btnSMP" type="submit" value="SIMPAN">
	<input name="btnBTL" type="reset" value="BATAL">
	<input name="btnDF" type="submit" value="DAFTAR BARANG LAIN >>">
	</p>
	<br>';
	}

else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT * FROM inv_brg ".
					"ORDER BY kode ASC";
	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);


	if ($count != 0)
		{
		echo '<p>
		<table width="500" border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="1%">&nbsp;</td>
		<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Stock</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Sisa</font></strong></td>
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
			$i_kd = nosql($data['kd']);
			$i_kode = nosql($data['kode']);
			$i_nama = balikin2($data['nama']);

			//nilai dari pengadaan
			$qdaa = mysqli_query($koneksi, "SELECT SUM(jml) AS total FROM inv_brg_pengadaan ".
									"WHERE kd_brg = '$i_kd'");
			$rdaa = mysqli_fetch_assoc($qdaa);
			$tdaa = mysqli_num_rows($qdaa);
			$i_jml = nosql($rdaa['total']);

			//nek null
			if (empty($i_jml))
				{
				$i_jml = "0";
				}


			//jml. yang telah dipakai
			$qtok = mysqli_query($koneksi, "SELECT SUM(jml) AS pake FROM inv_brg_progdi ".
									"WHERE kd_brg = '$i_kd'");
			$rtok = mysqli_fetch_assoc($qtok);
			$ttok = mysqli_num_rows($qtok);
			$tok_jml = nosql($rtok['pake']);


			//jml. total
			$qsto = mysqli_query($koneksi, "SELECT * FROM inv_stock ".
									"WHERE kd_brg = '$i_kd'");
			$rsto = mysqli_fetch_assoc($qsto);
			$tsto = mysqli_num_rows($qsto);
			$sto_jml = nosql($rsto['jml']);


			//jml. sisa
			$t_sisa = round($sto_jml - $tok_jml);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>';

			//jika tidak null, bisa ditempatkan...
			if (!empty($i_jml))
				{
				echo '<a href="'.$filenya.'?page='.$page.'&s=edit&brgkd='.$i_kd.'">
				<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0">
				</a>';
				}
			else
				{
				echo '-';
				}

			echo '</td>
			<td>'.$i_kode.'</td>
			<td>'.$i_nama.'</td>
			<td>'.$i_jml.'</td>
			<td>'.$t_sisa.'</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		echo '</table>
		<table width="500" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td align="right">Total : <strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
		</tr>
		</table>
		</p>';
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