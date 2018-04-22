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

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admak.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "set_mhs.php";
$jnskd = nosql($_REQUEST['jnskd']);
$kelkd = nosql($_REQUEST['kelkd']);
$progdi = nosql($_REQUEST['progdi']);
$tapelkd = nosql($_REQUEST['tapelkd']);





//judul halaman
$judul = "Set Keuangan Mahasiswa";
$judulku = "[$bak_session : $nip11_session. $nm11_session] ==> $judul";
$juduli = $judul;


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnSMP2'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$jnskd = nosql($_POST['jnskd']);


	for ($k=1;$k<=$limit;$k++)
		{
		//nilai
		$xyz = md5("$x$k");

		$xnnilkd = "kd";
		$xnnilkd1 = "$k$xnnilkd";
		$xnnilkdxx = nosql($_POST["$xnnilkd1"]);
		
		$xnnilku = "nilku";
		$xnnilku1 = "$k$xnnilku";
		$xnnilkuxx = nosql($_POST["$xnnilku1"]);



		//cek
		$qcc = mysql_query("SELECT * FROM m_keu_mahasiswa ".
								"WHERE kd_jenis = '$jnskd' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_mahasiswa = '$xnnilkdxx'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//jika ada, update aja
		if ($tcc != 0)
			{
			mysql_query("UPDATE m_keu_mahasiswa SET nilai = '$xnnilkuxx' ".
							"WHERE kd_jenis = '$jnskd' ".
							"AND kd_kelas = '$kelkd' ".
							"AND kd_progdi = '$progdi' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_mahasiswa = '$xnnilkdxx'");
			}
		else
			{
			mysql_query("INSERT INTO m_keu_mahasiswa (kd, kd_jenis, kd_progdi, ".
							"kd_tapel, kd_kelas, kd_mahasiswa, nilai, postdate) VALUES ".
							"('$xyz', '$jnskd', '$progdi', ".
							"'$tapelkd', '$kelkd', '$xnnilkdxx', '$xnnilkuxx', '$today')");
			}
		}
	while ($rowst = mysql_fetch_assoc($qst));


	//re-direct
	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&jnskd=$jnskd";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/number.js");
require("../../inc/menu/admak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table bgcolor="'.$warna02.'" width="100%" border="0" cellspacing="0" cellpadding="3">
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

echo '</select>,

Jenis : ';
echo "<select name=\"kelas\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qbtx = mysql_query("SELECT * FROM m_kelas ".
			"WHERE kd = '$kelkd'");
$rowbtx = mysql_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<option value="'.$btxkd.'">'.$btxkelas.'</option>';

$qbt = mysql_query("SELECT * FROM m_kelas ".
			"WHERE kd <> '$kelkd' ".
			"ORDER BY no ASC");
$rowbt = mysql_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btkelas = nosql($rowbt['kelas']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysql_fetch_assoc($qbt));

echo '</select>,

Tahun Akademik : ';
echo "<select name=\"tapel\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtpx = mysql_query("SELECT * FROM m_tapel ".
						"WHERE kd = '$tapelkd'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<option value="'.$tpx_kd.'">'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysql_query("SELECT * FROM m_tapel ".
						"WHERE kd <> '$tapelkd' ".
						"ORDER BY tahun1 DESC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>, 



Jenis Keuangan : ';
echo "<select name=\"jenis\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtpx = mysql_query("SELECT * FROM m_keu_jenis ".
						"WHERE kd = '$jnskd'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['nama']);

echo '<option value="'.$tpx_kd.'">'.$tpx_thn1.'</option>';

$qtp = mysql_query("SELECT * FROM m_keu_jenis ".
						"WHERE kd <> '$jnskd' ".
						"ORDER BY nama ASC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['nama']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&jnskd='.$tpkd.'">'.$tpth1.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>
</td>
</tr>
</table>';


if (empty($progdi))
	{
	echo '<p>
	<font color="#FF0000"><strong>PROGRAM PENDIDIKAN Belum Dipilih...!</strong></font>
	</p>';
	}

	else if (empty($kelkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>
	</p>';
	}

else if (empty($tapelkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>TAHUN AKADEMIK Belum Dipilih...!</strong></font>
	</p>';
	}

else if (empty($jnskd))
	{
	echo '<p>
	<font color="#FF0000"><strong>JENIS KEUANGAN Belum Dipilih...!</strong></font>
	</p>';
	}

else
	{
	//nilai uangnya...
	$qku2 = mysql_query("SELECT * FROM m_keu ".
							"WHERE kd_progdi = '$progdi' ".
							"AND kd_jenis = '$jnskd' ".
							"AND kd_kelas = '$kelkd' ".
							"AND kd_tapel = '$tapelkd'");
	$rku2 = mysql_fetch_assoc($qku2);
	$tku2 = mysql_num_rows($qku2);
	$ku2_nilai = nosql($rku2['biaya']);

	echo '<p>
	Setting Default Nominal : '.xduit2($ku2_nilai).' / Bulan.
	</p>';
	
	
	
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT DISTINCT(m_mahasiswa.kd) AS mskd ".
					"FROM m_mahasiswa, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
					"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
					"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
					"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;


	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?progdi=$progdi&tapelkd=$tapelkd&kelkd=$kelkd&jnskd=$jnskd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);

	echo '<table width="500" border="1" cellpadding="3" cellspacing="0">
 	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="50"><strong>NIM</strong></td>
	<td><strong>Nama</strong></td>
	<td width="150"><strong>Nilai Nominal</strong></td>
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

			$i_kd = nosql($data['mskd']);
			
			
			//detail
			$qku = mysql_query("SELECT * FROM m_mahasiswa ".
									"WHERE kd = '$i_kd'");
			$rku = mysql_fetch_assoc($qku);			
			$i_nim = nosql($rku['nim']);
			$i_nama = balikin2($rku['nama']);



			//detail uang e
			$qku = mysql_query("SELECT * FROM m_keu_mahasiswa ".
									"WHERE kd_jenis = '$jnskd' ".
									"AND kd_progdi = '$progdi' ".
									"AND kd_tapel = '$tapelkd' ".
									"AND kd_kelas = '$kelkd' ".
									"AND kd_mahasiswa = '$i_kd'");
			$rku = mysql_fetch_assoc($qku);
			$ku_kd = nosql($rku['kd']);
			$ku_nilai = nosql($rku['nilai']);
			
			
			//jika null, kasi nilai
			if (empty($ku_nilai))
				{
				mysql_query("UPDATE m_keu_mahasiswa SET nilai = '$ku2_nilai' ".
								"WHERE kd_jenis = '$jnskd' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_mahasiswa = '$i_kd'");
				}



			//detail uang e
			$qku = mysql_query("SELECT * FROM m_keu_mahasiswa ".
									"WHERE kd_jenis = '$jnskd' ".
									"AND kd_progdi = '$progdi' ".
									"AND kd_tapel = '$tapelkd' ".
									"AND kd_kelas = '$kelkd' ".
									"AND kd_mahasiswa = '$i_kd'");
			$rku = mysql_fetch_assoc($qku);
			$ku_kd = nosql($rku['kd']);
			$ku_nilai = nosql($rku['nilai']);



			//jika gak sama
			if ($ku2_nilai != $ku_nilai)
				{
				$warna = "orange";
				}


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$i_nim.'</td>
      		<td>'.$i_nama.'</td>
      		<td>
      		<input name="'.$nomer.'kd" type="hidden" value="'.$i_kd.'">
      		Rp.	<input name="'.$nomer.'nilku" type="text" size="10" value="'.$ku_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)">,00
      		</td>
    		</tr>';
			}
		while ($data = mysql_fetch_assoc($result));
		}

	echo '</table>

	<table width="500" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td align="right">Total : <font color="#FF0000"><strong>'.$count.'</strong></font> Data. '.$pagelist.'</td>
	</tr>
	<tr>
	<td align="right">
	<input name="btnSMP2" type="submit" value="SIMPAN">
	<input name="page" type="hidden" value="'.$page.'">
	<input name="jnskd" type="hidden" value="'.$jnskd.'">
	<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
	<input name="progdi" type="hidden" value="'.$progdi.'">
	<input name="kelkd" type="hidden" value="'.$kelkd.'">
	<input name="total" type="hidden" value="'.$count.'">
	</td>
	</tr>
	</table>';
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