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
$filenya = "dosen.php";
$judul = "Data Dosen";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$progdi = nosql($_REQUEST['progdi']);
$s = nosql($_REQUEST['s']);




//focus
if (empty($progdi))
	{
	$diload = "document.formx.progdi.focus();";
	}





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika hapus
if ($s == "hapus")
	{
	//nilai
	$progdi = nosql($_REQUEST['progdi']);
	$dkd = nosql($_REQUEST['dkd']);

	//query
	mysql_query("DELETE FROM m_dosen ".
					"WHERE kd = '$dkd'");

					
	//re-direct
	$ke = "$filenya?progdi=$progdi";
	xloc($ke);
	exit();
	}






//jika simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$pegawai = nosql($_POST['pegawai']);

	//cek
	if (empty($pegawai))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!.";
		$ke = "$filenya?progdi=$progdi";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//cek
		$qcc = mysql_query("SELECT * FROM m_dosen ".
								"WHERE kd_pegawai = '$pegawai' ".
								"AND kd_progdi = '$progdi'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//jika iya, ada
		if ($tcc != 0)
			{
			//re-direct
			$pesan = "Sudah Ada Data. Harap Diperhatikan...!!.";
			$ke = "$filenya?progdi=$progdi";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//insert
			mysql_query("INSERT INTO m_dosen (kd, kd_progdi, kd_pegawai, postdate) VALUES ".
							"('$x', '$progdi', '$pegawai', '$today')");

			//re-direct
			$ke = "$filenya?progdi=$progdi";
			xloc($ke);
			exit();
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//js
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
$qtpx = mysql_query("SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);

echo '<option value="'.$tpx_kd.'" selected>'.$tpx_nama.'</option>';

$qtp = mysql_query("SELECT * FROM m_progdi ".
			"WHERE kd <> '$progdi' ".
			"ORDER BY nama ASC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpnama = balikin($rowtp['nama']);

	echo '<option value="'.$filenya.'?progdi='.$tpkd.'">'.$tpnama.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

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
	<select name="pegawai">
	<option value="" selected>-Pegawai-</option>';

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
	<INPUT type="hidden" name="progdi" value="'.$progdi.'">
	<INPUT type="submit" name="btnSMP" value="TAMBAH >>">
	</p>';



	//daftar dosen
	$qkulo = mysql_query("SELECT DISTINCT(m_dosen.kd_pegawai) AS mpkd ".
							"FROM m_dosen, m_pegawai ".
							"WHERE m_dosen.kd_pegawai = m_pegawai.kd ".
							"AND m_dosen.kd_progdi = '$progdi' ".
							"ORDER BY m_pegawai.nama ASC");
	$rkulo = mysql_fetch_assoc($qkulo);
	$tkulo = mysql_num_rows($qkulo);

	//jika ada
	if ($tkulo != 0)
		{
		echo '<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="100"><strong><font color="'.$warnatext.'">NIP</font></strong></td>
		<td width="200"><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		</tr>';


		do
			{
			//nilai
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
			$kulo_mpkd = nosql($rkulo['mpkd']);



			//detail
			$qkix = mysql_query("SELECT * FROM m_pegawai ".
						"WHERE kd = '$kulo_mpkd'");
			$rkix = mysql_fetch_assoc($qkix);
			$kix_nip = nosql($rkix['nip']);
			$kix_nama = balikin($rkix['nama']);




			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$kix_nip.'</td>
			<td>'.$kix_nama.'</td>
			</tr>';
			}
		while ($rkulo = mysql_fetch_assoc($qkulo));


		echo '</table>';
		}

	else
		{
		echo '<p>
		<font color="red">
		<strong>BELUM ADA DATA DOSEN.</strong>
		</font>
		</p>';
		}

	echo '</p>
	<br>';
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