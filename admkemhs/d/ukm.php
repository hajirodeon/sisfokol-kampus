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
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "ukm.php";
$diload = "document.formx.nama.focus();";
$judul = "UKM";
$judulku = "[$kemhs_session : $nip4_session. $nm4_session] ==> $judul";
$judulx = $judul;
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
	$kdx = nosql($_REQUEST['kd']);

	//query
	$qx = mysql_query("SELECT * FROM m_ukm ".
							"WHERE kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$e_nama = balikin2($rowx['nama']);
	$e_pengurus = balikin2($rowx['pengurus']);
	$e_pembina = balikin2($rowx['pembina']);
	$e_pegkd = balikin2($rowx['kd_pegawai']);
	
	
	//detail
	$qku = mysql_query("SELECT * FROM m_pegawai ".
							"WHERE kd = '$e_pegkd'");
	$rku = mysql_fetch_assoc($qku);
	$ku_nip = balikin($rku['nip']);
	$ku_nama = balikin($rku['nama']);
	}



//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$nama = cegah2($_POST['nama']);
	$pengurus = cegah2($_POST['pengurus']);
	$pembina = cegah2($_POST['pembina']);
	$pegawai = cegah2($_POST['pegawai']);

	//nek null
	if ((empty($nama)) OR (empty($pengurus)) OR (empty($pegawai)))
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//jika baru
		if (empty($s))
			{
			///cek
			$qcc = mysql_query("SELECT * FROM m_ukm ".
									"WHERE nama = '$nama'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//nek ada
			if ($tcc != 0)
				{
				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$pesan = "Nama UKM : $nama, Sudah Ada. Silahkan Ganti Yang Lain...!!";
				pekem($pesan,$filenya);
				exit();
				}
			else
				{
				//query
				mysql_query("INSERT INTO m_ukm(kd, nama, pengurus, pembina, kd_pegawai, postdate) VALUES ".
								"('$x', '$nama', '$pengurus', '$pembina', '$pegawai', '$today')");



				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				xloc($filenya);
				exit();
				}
			}


		//jika update
		else if ($s == "edit")
			{
			//query
			mysql_query("UPDATE m_ukm SET nama = '$nama', ".
							"pengurus = '$pengurus', ".
							"kd_pegawai = '$pegawai', ".
							"pembina = '$pembina' ".
							"WHERE kd = '$kd'");

			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			xloc($filenya);
			exit();
			}
		}
	}


//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysql_query("DELETE FROM m_ukm ".
						"WHERE kd = '$kd'");
		}

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();

//query
$q = mysql_query("SELECT * FROM m_ukm ".
			"ORDER BY nama ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

//js
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admkemhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
Nama UKM :
<br>
<input name="nama" type="text" value="'.$e_nama.'" size="30">
</p>

<p>
Pengurus UKM :
<br>
<input name="pengurus" type="text" value="'.$e_pengurus.'" size="30">
</p>

<p>
Pembina UKM :
<br>
<select name="pegawai">
<option value="'.$e_pegkd.'">'.$ku_nip.'. '.$ku_nama.'</option>';

$qbt = mysql_query("SELECT * FROM m_pegawai ".
						"ORDER BY nama ASC");
$rowbt = mysql_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btnip = balikin($rowbt['nip']);
	$btnama = balikin($rowbt['nama']);

	echo '<option value="'.$btkd.'">'.$btnip.'. '.$btnama.'</option>';
	}
while ($rowbt = mysql_fetch_assoc($qbt));

echo '</select>,


</p>

<p>
<input name="s" type="hidden" value="'.$s.'">
<input name="kd" type="hidden" value="'.$kdx.'">
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnBTL" type="submit" value="BATAL">
</p>';

if ($total != 0)
	{
	echo '<table width="500" border="1" cellspacing="0" cellpadding="3">
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="1">&nbsp;</td>
	<td><strong><font color="'.$warnatext.'">Nama UKM</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">Pengurus</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">Pembina</font></strong></td>
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
		$i_nama = balikin2($row['nama']);
		$i_pengurus = balikin2($row['pengurus']);
		$i_pegkd = nosql($row['kd_pegawai']);

	
		//detail
		$qku = mysql_query("SELECT * FROM m_pegawai ".
								"WHERE kd = '$i_pegkd'");
		$rku = mysql_fetch_assoc($qku);
		$ku_nip = balikin($rku['nip']);
		$ku_nama = balikin($rku['nama']);
		
		
		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="checkbox" name="item'.$i_nomer.'" value="'.$i_kd.'">
        	</td>
		<td>
		<a href="'.$filenya.'?s=edit&kd='.$i_kd.'">
		<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0">
		</a>
		</td>
		<td>'.$i_nama.'</td>
		<td>'.$i_pengurus.'</td>
		<td>'.$ku_nip.'. '.$ku_nama.'</td>
    	</tr>';
		}
	while ($row = mysql_fetch_assoc($q));

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td width="263">
	<input name="jml" type="hidden" value="'.$total.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
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