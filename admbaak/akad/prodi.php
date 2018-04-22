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
$filenya = "prodi.php";
$diload = "document.formx.kode.focus();";
$judul = "Program Studi";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
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
	$qx = mysql_query("SELECT * FROM m_progdi ".
				"WHERE kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$kode = nosql($rowx['kode']);
	$nama = balikin2($rowx['nama']);
	$kd_pegawai = nosql($rowx['kd_pegawai']);

	//terpilih
	$qtp2x = mysql_query("SELECT * FROM m_pegawai ".
				"WHERE kd = '$kd_pegawai'");
	$rowtp2x = mysql_fetch_assoc($qtp2x);
	$tp2x_nip = nosql($rowtp2x['nip']);
	$tp2x_pegawai = balikin($rowtp2x['nama']);
	}



//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$kode = nosql($_POST['kode']);
	$nama = cegah2($_POST['nama']);
	$pegawai = nosql($_POST['pegawai']);

	//nek null
	if ((empty($kode)) OR (empty($nama)) OR (empty($pegawai)))
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
			///cek nama progdi
			$qcc = mysql_query("SELECT * FROM m_progdi ".
						"WHERE nama = '$nama'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);


			///cek pegawai
			$qcc2 = mysql_query("SELECT * FROM m_progdi ".
						"WHERE kd_pegawai = '$pegawai'");
			$rcc2 = mysql_fetch_assoc($qcc2);
			$tcc2 = mysql_num_rows($qcc2);


			//nek ada
			if ($tcc != 0)
				{
				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$pesan = "Program Pendidikan Tersebut, Sudah Ada. Silahkan Ganti Yang Lain...!!";
				pekem($pesan,$filenya);
				exit();
				}


			//nek ada
			else if ($tcc2 != 0)
				{
				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$pesan = "Pegawai ini, telah menjadi Ka.Prodi Program Studi lain. Harap Diperhatikan...!!";
				pekem($pesan,$filenya);
				exit();
				}

			else
				{
				//query
				mysql_query("INSERT INTO m_progdi(kd, kode, nama, kd_pegawai) VALUES ".
						"('$x', '$kode', '$nama', '$pegawai')");

				//admin ne
				mysql_query("INSERT INTO adm_kaprodi(kd, kd_pegawai) VALUES ".
						"('$x', '$pegawai')");


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
			mysql_query("UPDATE m_progdi SET kode = '$kode', ".
					"nama = '$nama', ".
					"kd_pegawai = '$pegawai' ".
					"WHERE kd = '$kd'");


			///cek nama progdi
			$qcc = mysql_query("SELECT * FROM adm_kaprodi ".
						"WHERE kd_pegawai = '$pegawai'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);


			//jika ada
			if ($tcc != 0)
				{				
				//query
				mysql_query("UPDATE adm_kaprodi SET kd_pegawai = '$pegawai' ".
						"WHERE kd = '$kd'");
				}
			else
				{
				mysql_query("INSERT INTO adm_kaprodi(kd, kd_pegawai) VALUES ".
						"('$x', '$pegawai')");
				}

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
		mysql_query("DELETE FROM m_progdi ".
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
$q = mysql_query("SELECT * FROM m_progdi ".
			"ORDER BY kode ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

//js
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admbaak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
Kode :
<br>
<input name="kode" type="text" value="'.$kode.'" size="2">
</p>

<p>
Nama Program Pendidikan :
<br>
<input name="nama" type="text" value="'.$nama.'" size="30">
</p>

<p>
Ka.Prodi :
<br>
<select name="pegawai">
<option value="'.$kd_pegawai.'" selected>['.$tp2x_nip.'].'.$tp2x_pegawai.'</option>';

$qtp2 = mysql_query("SELECT * FROM m_pegawai ".
			"ORDER BY round(nip) ASC");
$rowtp2 = mysql_fetch_assoc($qtp2);

do
	{
	$tp2_kd = nosql($rowtp2['kd']);
	$tp2_nip = nosql($rowtp2['nip']);
	$tp2_nama = balikin($rowtp2['nama']);

	echo '<option value="'.$tp2_kd.'">['.$tp2_nip.']. '.$tp2_nama.'</option>';
	}
while ($rowtp2 = mysql_fetch_assoc($qtp2));

echo '</select>
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
	<td width="10"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
	<td width="250"><strong><font color="'.$warnatext.'">Ka.Prodi</font></strong></td>
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
		$i_pegkd = nosql($row['kd_pegawai']);

		//kaprodi.
		$qtp2x = mysql_query("SELECT * FROM m_pegawai ".
					"WHERE kd = '$i_pegkd'");
		$rowtp2x = mysql_fetch_assoc($qtp2x);
		$tp2x_nip = nosql($rowtp2x['nip']);
		$tp2x_pegawai = balikin($rowtp2x['nama']);


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="checkbox" name="item'.$i_nomer.'" value="'.$i_kd.'">
        	</td>
		<td>
		<a href="'.$filenya.'?s=edit&kd='.$i_kd.'">
		<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0">
		</a>
		</td>
		<td>'.$i_kode.'</td>
		<td>'.$i_nama.'</td>
		<td>'.$tp2x_nip.'. '.$tp2x_pegawai.'</td>
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