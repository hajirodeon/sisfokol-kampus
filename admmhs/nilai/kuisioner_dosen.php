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
require("../../inc/cek/admmhs.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "kuisioner_dosen.php";
$judul = "Kuisioner Dosen";
$judulku = "[$mhs_session : $nim6_session. $nm6_session] ==> $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$dkd = nosql($_REQUEST['dkd']);



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







//jika kirim
if ($_POST['btnKRM'])
	{
	//ambil nilai
	$dkd = nosql($_POST['dkd']);
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		$xyz = md5("$x$i");
		
		//ambil nilai
		$yuk = "kd";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		$yuk2 = "jwb1";
		$yuhu2 = "$yuk2$i";
		$jwbku1 = nosql($_POST["$yuhu2"]);




		//cek
		$qcc = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
								"WHERE kd_kuisioner_dosen = '$kd' ".
								"AND kd_mahasiswa = '$kd6_session' ".
								"AND kd_pegawai = '$dkd'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//nek ada
		if ($tcc != 0)
			{
			//query
			mysql_query("UPDATE mahasiswa_kuisioner_dosen SET jawaban_1 = '$jwbku1', ".
							"postdate = '$today' ".
							"WHERE kd_mahasiswa = '$kd6_session' ".
							"AND kd_kuisioner_dosen = '$kd' ".
							"AND kd_pegawai = '$dkd'");
			}
		else 
			{
			//query
			mysql_query("INSERT INTO mahasiswa_kuisioner_dosen(kd, kd_mahasiswa, kd_kuisioner_dosen, kd_pegawai, ".
							"jawaban_1, postdate) VALUES ".
							"('$xyz', '$kd6_session', '$kd', '$dkd', ".
							"'$jwbku1', '$today')");
			}
		}

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$pesan = "Terima Kasih. Telah Memberikan Kuisioner Dosen.";
	pekem($pesan,$filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//js
require("../../inc/js/swap.js");
require("../../inc/js/jumpmenu.js");
require("../../inc/menu/admmhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Dosen : ';
echo "<select name=\"dosen\" onChange=\"MM_jumpMenu('self',this,0)\">";
//terpilih
$qtpx = mysql_query("SELECT * FROM m_pegawai ".
						"WHERE kd = '$dkd'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nip = balikin($rowtpx['nip']);
$tpx_nama = balikin($rowtpx['nama']);

echo '<option value="'.$tpx_kd.'" selected>'.$tpx_nip.'. '.$tpx_nama.'</option>';

$qtp = mysql_query("SELECT DISTINCT(dosen.kd_pegawai) AS dkd ".
					"FROM dosen, m_pegawai ".
					"WHERE dosen.kd_pegawai = m_pegawai.kd ".
					"ORDER BY nama ASC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['dkd']);
	
	//terpilih
	$qtpx = mysql_query("SELECT * FROM m_pegawai ".
							"WHERE kd = '$tpkd'");
	$rowtpx = mysql_fetch_assoc($qtpx);
	$tpx_nip = balikin($rowtpx['nip']);
	$tpx_nama = balikin($rowtpx['nama']);
	
	echo '<option value="'.$filenya.'?dkd='.$tpkd.'">'.$tpx_nip.'. '.$tpx_nama.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>
</td>
</tr>
</table>';



//jika null
if (empty($dkd))
	{
	echo '<p>
	<font color="red"><strong>DOSEN Belum Dipilih.</strong></font>
	</p>';
	}
else
	{
	//query
	$q = mysql_query("SELECT * FROM m_kuisioner_dosen ".
						"ORDER BY nama ASC");
	$row = mysql_fetch_assoc($q);
	$total = mysql_num_rows($q);
	
	
	
	if ($total != 0)
		{
		echo '<table width="600" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
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
			$i_nama = balikin($row['nama']);
			$i_postdate = $row['postdate'];
	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$i_nama.'</td>
			<td>
			<input name="kd'.$i_nomer.'" type="hidden" value="'.$i_kd.'">
			<select name="jwb1'.$i_nomer.'">
			<option selected></option>
			<option value="Amat Baik">Amat Baik</option>
			<option value="Baik">Baik</option>
			<option value="Cukup">Cukup</option>
			<option value="Ya">Ya</option>
			<option value="Tidak">Tidak</option>
			</select>
			</td>
	       	</tr>';
			}
		while ($row = mysql_fetch_assoc($q));
	
		echo '</table>
		<table width="400" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		<input name="jml" type="hidden" value="'.$total.'">
		<input name="dkd" type="hidden" value="'.$dkd.'">
		<input name="btnKRM" type="submit" value="KIRIM">
		</td>
		</tr>
		</table>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>TIDAK ADA DATA. </strong>
		</font>
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