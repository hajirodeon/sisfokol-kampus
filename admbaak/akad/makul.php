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
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "makul.php";
$diload = "document.formx.kode.focus();";
$judul = "Mata Kuliah";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$progdi = nosql($_REQUEST['progdi']);
$s = nosql($_REQUEST['s']);





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





//jika edit
if ($s == "edit")
	{
	//nilai
	$progdi = nosql($_REQUEST['progdi']);
	$kdx = nosql($_REQUEST['kd']);

	//query
	$qx = mysqli_query($koneksi, "SELECT * FROM m_makul ".
				"WHERE kd_progdi = '$progdi' ".
				"AND kd = '$kdx'");
	$rowx = mysqli_fetch_assoc($qx);
	$kode = nosql($rowx['kode']);
	$nama = balikin2($rowx['nama']);
	$sks = nosql($rowx['sks']);
	$jenis = nosql($rowx['jenis']);
	$status = nosql($rowx['status']);


	//jika true
	if ($jenis == "true")
		{
		$jenis_nil = "Wajib";
		}
	else if ($jenis == "false")
		{
		$jenis_nil = "Pilihan";
		}
	else 
		{
		$jenis_nil = "Prasyarat";
		}


	//jika true
	if ($status == "true")
		{
		$status_nil = "Aktif";
		}
	else
		{
		$status_nil = "Tidak Aktif";
		}
	}





//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$progdi = nosql($_POST['progdi']);
	$kode = cegah2($_POST['kode']);
	$nama = cegah2($_POST['nama']);
	$sks = nosql($_POST['sks']);
	$jenis = nosql($_POST['jenis']);
	$status = nosql($_POST['status']);


	//nek null
	if ((empty($kode)) OR (empty($nama)) OR (empty($status)))
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?progdi=$progdi&s=add";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//jika baru
		if ($s == "add")
			{
			///cek
			$qcc = mysqli_query($koneksi, "SELECT * FROM m_makul ".
						"WHERE kd_progdi = '$progdi' ".
						"AND kode = '$kode'");
			$rcc = mysqli_fetch_assoc($qcc);
			$tcc = mysqli_num_rows($qcc);

			//nek ada
			if ($tcc != 0)
				{
				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$pesan = "Kode Mata Kuliah : $kode, Sudah Ada. Silahkan Ganti Yang Lain...!!";
				$ke = "$filenya?progdi=$progdi&s=add";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//query
				mysqli_query($koneksi, "INSERT INTO m_makul(kd, kd_progdi, kode, nama, sks, jenis, status) VALUES ".
						"('$x', '$progdi', '$kode', '$nama', '$sks', '$jenis', '$status')");

				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$ke = "$filenya?progdi=$progdi";
				xloc($ke);
				exit();
				}
			}


		//jika update
		else if ($s == "edit")
			{
			//query
			mysqli_query($koneksi, "UPDATE m_makul SET kode = '$kode', ".
					"nama = '$nama', ".
					"sks = '$sks', ".
					"jenis = '$jenis', ".
					"status = '$status' ".
					"WHERE kd_progdi = '$progdi' ".
					"AND kd = '$kd'");

			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$ke = "$filenya?progdi=$progdi";
			xloc($ke);
			exit();
			}
		}
	}





//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$progdi = nosql($_POST['progdi']);
	$jml = nosql($_POST['jml']);


	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM m_makul ".
				"WHERE kd_progdi = '$progdi' ".
				"AND kd = '$kd'");
		}

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$ke = "$filenya?progdi=$progdi";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//js
require("../../inc/js/checkall.js");
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admbaak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
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

echo '<option value="'.$tpx_kd.'">'.$tpx_nama.'</option>';

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

echo '</select>
</td>
</tr>
</table>';



//jika null
if (empty($progdi))
	{
	echo '<p>
	<font color="red"><strong>PROGRAM STUDI Belum Dipilih.</strong></font>
	</p>';
	}
else
	{
	echo '<p>
	[<a href="'.$filenya.'?progdi='.$progdi.'&s=add">Entry Data</a>]
	</p>';


	//jika baru/edit
	if (($s == "add") OR ($s == "edit"))
		{
		echo '<p>
		Kode :
		<br>
		<input name="kode" type="text" value="'.$kode.'" size="10">
		</p>

		<p>
		Nama :
		<br>
		<input name="nama" type="text" value="'.$nama.'" size="30">
		</p>


		<p>
		Jenis :
		<br>
		<select name="jenis">
		<option value="'.$jenis.'" selected>'.$jenis_nil.'</option>
		<option value="true">Wajib</option>
		<option value="false">Pilihan</option>
		<option value="">Prasyarat</option>
		</select>
		</p>

		<p>
		Status :
		<br>
		<select name="status">
		<option value="'.$status.'" selected>'.$status_nil.'</option>
		<option value="true">Aktif</option>
		<option value="false">Tidak Aktif</option>
		</select>
		</p>

		<p>
		<input name="s" type="hidden" value="'.$s.'">
		<input name="kd" type="hidden" value="'.$kdx.'">
		<input name="progdi" type="hidden" value="'.$progdi.'">
		<input name="btnSMP" type="submit" value="SIMPAN">
		<input name="btnBTL" type="submit" value="BATAL">
		</p>';
		}

	//daftar
	else
		{
		//query
		$q = mysqli_query($koneksi, "SELECT * FROM m_makul ".
					"WHERE kd_progdi = '$progdi' ".
					"ORDER BY round(kode) ASC");
		$row = mysqli_fetch_assoc($q);
		$total = mysqli_num_rows($q);


		if ($total != 0)
			{
			echo '<table width="700" border="1" cellspacing="0" cellpadding="3">
			<tr valign="top" bgcolor="'.$warnaheader.'">
			<td width="1">&nbsp;</td>
			<td width="1">&nbsp;</td>
			<td width="100"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
			<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
			<td width="100"><strong><font color="'.$warnatext.'">Jenis</font></strong></td>
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

				$i_nomer = $i_nomer + 1;
				$i_kd = nosql($row['kd']);
				$i_kode = nosql($row['kode']);
				$i_nama = balikin2($row['nama']);
				$i_sks = nosql($row['sks']);
				$i_jenis = nosql($row['jenis']);
				$i_status = nosql($row['status']);



				//jika true
				if ($i_jenis == "true")
					{
					$i_jenis_nil = "<font color=\"red\"><strong>Wajib</strong></font>";
					}
				else if ($i_jenis == "false")
					{
					$i_jenis_nil = "Pilihan";
					}
				else 
					{
					$i_jenis_nil = "Prasyarat";
					}


				//jika true
				if ($i_status == "true")
					{
					$i_status_nil = "<font color=\"red\"><strong>Aktif</strong></font>";
					}
				else
					{
					$i_status_nil = "Tidak Aktif";
					}



				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>
				<input type="checkbox" name="item'.$i_nomer.'" value="'.$i_kd.'">
				</td>
				<td>
				<a href="'.$filenya.'?s=edit&progdi='.$progdi.'&kd='.$i_kd.'">
				<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0">
				</a>
				</td>
				<td>'.$i_kode.'</td>
				<td>'.$i_nama.'</td>
				<td>'.$i_jenis_nil.'</td>
				<td>'.$i_status_nil.'</td>
				</tr>';
				}
			while ($row = mysqli_fetch_assoc($q));

			echo '</table>
			<table width="700" border="0" cellspacing="0" cellpadding="3">
			<tr>
			<td width="263">
			<input name="jml" type="hidden" value="'.$total.'">
			<input name="s" type="hidden" value="'.$s.'">
			<input name="kd" type="hidden" value="'.$kdx.'">
			<input name="progdi" type="hidden" value="'.$progdi.'">
			<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$total.')">
			<input name="btnBTL" type="submit" value="BATAL">
			<input name="btnHPS" type="submit" value="HAPUS">
			</td>
			<td align="right">Total : <strong><font color="#FF0000">'.$total.'</font></strong> Data.</td>
			</tr>
			</table>';
			}
		else
			{
			echo '<p>
			<font color="red">
			<strong>TIDAK ADA DATA. Silahkan Entry Dahulu...!!</strong>
			</font>
			</p>';
			}
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