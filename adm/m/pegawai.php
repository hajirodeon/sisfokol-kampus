<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "pegawai.php";
$judul = "Pegawai";
$judulku = "$judul  [$adm_session]";
$diload = "document.formx.nip.focus();";
$judulx = $judul;

$s = nosql($_REQUEST['s']);
$m = nosql($_REQUEST['m']);
$crkd = nosql($_REQUEST['crkd']);
$crtipe = balikin($_REQUEST['crtipe']);
$kunci = cegah($_REQUEST['kunci']);
$kd = nosql($_REQUEST['kd']);
$dkkd = nosql($_REQUEST['dkkd']);
$pddkkd = nosql($_REQUEST['pddkkd']);
$pktkd = nosql($_REQUEST['pktkd']);
$gjkd = nosql($_REQUEST['gjkd']);
$mutkd = nosql($_REQUEST['mutkd']);
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






//jika simpan
if ($_POST['btnSMP1'])
	{
	//nilai
	$s = nosql($_POST['s']);
	$m = nosql($_POST['m']);
	$kd = nosql($_POST['kd']);




	//jika baru ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($s == "add")
		{
		//nilai
		$nip = nosql($_POST['nip']);
		$nama1 = cegah($_POST['nama1']);

		//nek null
		if ((empty($nip)) OR (empty($nama1)))
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Input Tidak Lengkap. Harap Diulangi...!";
			$ke = "$filenya?s=add&m=datadiri&kd=$x";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//cek
			$qcc = mysql_query("SELECT * FROM m_pegawai ".
									"WHERE nip = '$nip'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//nek ada
			if ($tcc != 0)
				{
				//re-direct
				$pesan = "NIP Tersebut Sudah Ada. Silahkan Ganti Yang Lain...!!";
				$ke = "$filenya?s=add&m=datadiri&kd=$x";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//set akses
				$x_userx = $nip;
				$x_passx = md5($nip);

				//insert
				mysql_query("INSERT INTO m_pegawai(kd, usernamex, passwordx, nip, nama) VALUES ".
								"('$kd', '$x_userx', '$x_passx', '$nip', '$nama1')");

				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$ke = "$filenya?s=edit&m=datadiri&kd=$kd";
				xloc($ke);
				exit();
				}
			}
		}


	//jika edit ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	else if ($s == "edit")
		{
		//jika data diri ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
		if ($m == "datadiri")
			{
			//nilai
			$nip = nosql($_POST['nip']);
			$nama1 = cegah($_POST['nama1']);


			//cek
			$qcc = mysql_query("SELECT * FROM m_pegawai ".
									"WHERE nip = '$nip'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//nek lebih dari 1
			if ($tcc > 1)
				{
				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$pesan = "Ditemukan Duplikasi NIP : $nip. Silahkan Diganti...!";
				$ke = "$filenya?s=edit&m=datadiri&kd=$kd";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//set akses
				$x_userx = $nip;
				$x_passx = md5($nip);

				//update
				mysql_query("UPDATE m_pegawai SET usernamex = '$x_userx', ".
								"passwordx = '$x_passx', ".
								"nip = '$nip', ".
								"nama = '$nama1' ".
								"WHERE kd = '$kd'");

				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$ke = "$filenya?s=edit&m=datadiri&kd=$kd";
				xloc($ke);
				exit();
				}
			}
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








//isi *START
ob_start();




//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/number.js");
require("../../inc/js/swap.js");
require("../../inc/menu/adm.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="500">';
xheadline($judul);
echo ' [<a href="'.$filenya.'?s=add&m=datadiri&kd='.$x.'" title="Entry Data Baru">Entry Data Baru</a>]
</td>
<td align="right">';
echo "<select name=\"katcari\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$filenya.'?crkd='.$crkd.'&crtipe='.$crtipe.'&kunci='.$kunci.'" selected>'.$crtipe.'</option>
<option value="'.$filenya.'?crkd=cr01&crtipe=NIP&kunci='.$kunci.'">NIP</option>
<option value="'.$filenya.'?crkd=cr05&crtipe=Nama&kunci='.$kunci.'">Nama</option>
</select>
<input name="kunci" type="text" value="'.$kunci.'" size="20">
<input name="crkd" type="hidden" value="'.$crkd.'">
<input name="crtipe" type="hidden" value="'.$crtipe.'">
<input name="btnCARI" type="submit" value="CARI >>">
<input name="btnRST" type="submit" value="RESET">
</td>
</tr>
</table>';


//jika view /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (empty($s))
	{
	//nip
	if ($crkd == "cr01")
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT * FROM m_pegawai ".
						"WHERE nip LIKE '%$kunci%' ".
						"ORDER BY round(nip) ASC";
		$sqlresult = $sqlcount;

		$count = mysql_num_rows(mysql_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?crkd=$crkd&crtipe=$crtipe&kunci=$kunci";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysql_fetch_array($result);
		}


	//nama
	else if ($crkd == "cr05")
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT * FROM m_pegawai ".
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

	else
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT * FROM m_pegawai ".
						"ORDER BY round(nip) ASC";
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
		echo '<table width="500" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="200"><strong><font color="'.$warnatext.'">NIP</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
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
			$nomer = $nomer + 1;
			$kd = nosql($data['kd']);
			$usernamex = nosql($data['usernamex']);
			$passwordx = nosql($data['passwordx']);
			$nip = balikin2($data['nip']);
			$nama = balikin($data['nama']);


			//set akses
			if ((empty($usernamex)) OR (empty($passwordx)))
				{
				$x_userx = $nip;
				$x_passx = md5($nip);

				mysql_query("UPDATE m_pegawai SET usernamex = '$x_userx', ".
						"passwordx = '$x_passx' ".
						"WHERE kd = '$kd'");
				}


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<a href="'.$filenya.'?s=edit&m=datadiri&kd='.$kd.'" title="EDIT..."><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$nip.'</td>
			<td>'.$nama.'</td>
	    		</tr>';
			}
		while ($data = mysql_fetch_assoc($result));

		echo '</table>
		<table width="500" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		<input name="jml" type="hidden" value="'.$limit.'">
		<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
		<input name="m" type="hidden" value="'.nosql($_REQUEST['m']).'">
		<input name="kd" type="hidden" value="'.nosql($_REQUEST['kd']).'">
		<strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
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
else
	{
	//nilai
	$kd = nosql($_REQUEST['kd']);


	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr valign="top">
	<td width="80%">';


	//data query -> datadiri
	$qnil = mysql_query("SELECT m_pegawai.*, DATE_FORMAT(m_pegawai.tgl_lahir, '%d') AS lahir_tgl, ".
							"DATE_FORMAT(m_pegawai.tgl_lahir, '%m') AS lahir_bln, ".
							"DATE_FORMAT(m_pegawai.tgl_lahir, '%Y') AS lahir_thn ".
							"FROM m_pegawai ".
							"WHERE kd = '$kd'");
	$rnil = mysql_fetch_assoc($qnil);
	$y_nip = nosql($rnil['nip']);
	$y_nama = balikin($rnil['nama']);


	//jika data diri
	if ($m == "datadiri")
		{
		echo '***<big><strong>DATA DIRI</strong></big>
		<hr>

		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td width="150">
		NIP
		</td>
		<td>: </td>
		<td>
		<input name="nip" type="text" value="'.$y_nip.'" size="30">
		</td>
		</tr>


		<tr valign="top">
		<td width="150">
		Nama
		</td>
		<td>: </td>
		<td>
		<input name="nama1" type="text" value="'.$y_nama.'" size="30">
		</td>
		</tr>

		</table>

		<input name="btnSMP1" type="submit" value="SIMPAN">
		<input name="btnRST" type="submit" value="DAFTAR PEGAWAI >>">';
		}



	echo '<br>
	<br>
	<br>

	<hr>
	<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
	<input name="m" type="hidden" value="'.nosql($_REQUEST['m']).'">
	<input name="kd" type="hidden" value="'.nosql($_REQUEST['kd']).'">

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
