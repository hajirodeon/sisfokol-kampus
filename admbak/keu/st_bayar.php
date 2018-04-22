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

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admak.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");


nocache;

//nilai
$filenya = "st_bayar.php";
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);




//judul halaman
$judul = "Status Bayar";
$judulku = "[$bak_session : $nip11_session. $nm11_session] ==> $judul";
$juduli = $judul;
$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd";



//focus...
if (empty($progdi))
	{
	$diload = "document.formx.progdi.focus();isodatetime();";
	}
else if (empty($kelkd))
	{
	$diload = "document.formx.kelas.focus();isodatetime();";
	}
else if (empty($tapelkd))
	{
	$diload = "document.formx.tapel.focus();isodatetime();";
	}





//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">
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

echo '</select>
</td>
</tr>
</table>';



//nek blm dipilih
if (empty($progdi))
	{
	echo '<p>
	<font color="#FF0000"><strong>PROGRAM PENDIDIKAN Belum Dipilih...!</strong></font>
	</p>';
	}

else if (empty($kelkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>JENIS Belum Dipilih...!</strong></font>
	</p>';
	}

else if (empty($tapelkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>TAHUN PELAJARAN Belum Dipilih...!</strong></font>
	</p>';
	}
	
else 

	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	$sqlcount = "SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
					"FROM m_mahasiswa, mahasiswa_kelas, m_mahasiswa_status ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND m_mahasiswa_status.kd_mahasiswa = m_mahasiswa.kd ".
					"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
					"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
					"AND m_mahasiswa_status.kd_tapel = '$tapelkd' ".
					"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;

	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);


	if ($count != 0)
		{
		//view data
		echo '<br>
		<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="100"><strong><font color="'.$warnatext.'">NIM</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">NIM Pusat</font></strong></td>
		<td width="250"><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Keterangan</font></strong></td>
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
			$i_nomer = $i_nomer + 1;
			$i_nim = balikin2($data['nim']);


			//detail
			$qdt = mysql_query("SELECT m_mahasiswa.*, ".
									"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%d') AS lahir_tgl, ".
									"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%m') AS lahir_bln, ".
									"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%Y') AS lahir_thn, ".
									"m_mahasiswa.kd AS mskd, ".
									"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
									"FROM m_mahasiswa, mahasiswa_kelas ".
									"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
									"AND m_mahasiswa.nim = '$i_nim'");
			$rdt = mysql_fetch_assoc($qdt);
			$dt_kd = nosql($rdt['mskd']);
			$dt_mkkd = nosql($rdt['mkkd']);
			$dt_nama = balikin($rdt['nama']);
			$dt_nim_pusat = nosql($rdt['nim_pusat']);



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$i_nim.'</td>
			<td>'.$dt_nim_pusat.'</td>
			<td>'.$dt_nama.'</td>
			<td>';
			
			//jenis keuangan
			$q = mysql_query("SELECT * FROM m_keu_jenis ".
								"ORDER BY nama ASC");
			$row = mysql_fetch_assoc($q);
						
			do
				{
				$i_jnskd = nosql($row['kd']);
				$i_nama = balikin($row['nama']);
		
				echo ''.$i_nama.' 				
				<br>';
				
				//tapel-nya
				$qtpel = mysql_query("SELECT * FROM m_tapel ".
										"WHERE kd = '$tapelkd'");
				$rtpel = mysql_fetch_assoc($qtpel);
				$ttpel = mysql_num_rows($qtpel);
				$tpel_thn1 = nosql($rtpel['tahun1']);
				$tpel_thn2 = nosql($rtpel['tahun2']);
			
				for ($i=1;$i<=12;$i++)
					{
					//nilainya
					if ($i<=6) //bulan juli sampai desember
						{
						$ibln = $i + 6;
						$itpel = $tpel_thn1;
						}
						
					if ($i>6) //bulan januari sampai juni
						{
						$ibln = $i - 6;
						$itpel = $tpel_thn2;
						}
				
				
					//ketahui yg telah dibayar atau belum
					$qku = mysql_query("SELECT * FROM m_keu_mahasiswa ".
											"WHERE kd_jenis = '$i_jnskd' ".
											"AND kd_progdi = '$progdi' ".
											"AND kd_tapel = '$tapelkd' ".
											"AND kd_kelas = '$kelkd' ".
											"AND kd_mahasiswa = '$dt_kd'");
					$rku = mysql_fetch_assoc($qku);
					$ku_kd = nosql($rku['kd']);
					
					
					//detail bayar
					$qku2 = mysql_query("SELECT * FROM mahasiswa_keu ".
											"WHERE kd_keu_mahasiswa = '$ku_kd' ".
											"AND bln = '$ibln' ".
											"AND thn = '$itpel'");
					$rku2 = mysql_fetch_assoc($qku2);
					$ku2_tgl_bayar = $rku2['tgl_bayar'];
					
					//jika null
					if (empty($ku2_tgl_bayar))
						{
						$nilnya = '<a href="bayar.php?jnskd='.$i_jnskd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&nim='.$i_nim.'">BAYAR</a>';
						}
					else 
						{
						$nilnya = '<b>'.$ku2_tgl_bayar.'</b>';						
						}
		
					
					
					
					echo '[<font color="orange">'.$ibln.'/'.$itpel.'</font>:'.$nilnya.'].';
					}
			
				
				echo "<br><br>";
				}
			while ($row = mysql_fetch_assoc($q));
					
						
			echo '</td>
			</tr>';
			}
		while ($data = mysql_fetch_assoc($result));

		echo '</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="300">
		<input name="jml" type="hidden" value="'.$limit.'">
		<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
		<input name="kd" type="hidden" value="'.nosql($_REQUEST['kd']).'">
		<input name="progdi" type="hidden" value="'.nosql($_REQUEST['progdi']).'">
		<input name="kelkd" type="hidden" value="'.nosql($_REQUEST['kelkd']).'">
		<input name="tapelkd" type="hidden" value="'.nosql($_REQUEST['tapelkd']).'">
		</td>
		<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
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