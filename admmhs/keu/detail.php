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
require("../../inc/cek/admmhs.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "detail.php";
$jnskd = nosql($_REQUEST['jnskd']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$smtkd = nosql($_REQUEST['smtkd']);


//ketahui jenis keuangan
$qdt = mysql_query("SELECT * FROM m_keu_jenis ".
			"WHERE kd = '$jnskd'");
$rdt = mysql_fetch_assoc($qdt);
$dt_kd = nosql($rdt['kd']);
$dt_jenis = balikin($rdt['nama']);


$judul = "Keuangan : $dt_jenis";
$judulku = "[$mhs_session : $nim6_session. $nm6_session] ==> $judul";
$juduli = $judul;


//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/menu/admmhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
Semester : ';
echo "<select name=\"smt\" onChange=\"MM_jumpMenu('self',this,0)\">";

//smt
$qstxy = mysql_query("SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysql_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);



//detail tapel
$qdtx = mysql_query("SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
			"FROM mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd6_session' ".
			"AND mahasiswa_kelas.kd_smt = '$smtkd'");
$rdtx = mysql_fetch_assoc($qdtx);
$tdtx = mysql_num_rows($qdtx);

//jika ada, lihat tapel-nya
if ($tdtx != 0)
	{
	//nilai
	$dtx_tapelkd = nosql($rdtx['kd_tapel']);

	//tapel-nya
	$qtpel = mysql_query("SELECT * FROM m_tapel ".
				"WHERE kd = '$dtx_tapelkd'");
	$rtpel = mysql_fetch_assoc($qtpel);
	$ttpel = mysql_num_rows($qtpel);
	$tpel_thn1 = nosql($rtpel['tahun1']);
	$tpel_thn2 = nosql($rtpel['tahun2']);

	}
else
	{
	$tpel_thn1 = "-";
	$tpel_thn2 = "-";
	}

echo '<option value="'.$smtkd.'" selected>'.$smt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.'].</option>';

$qst = mysql_query("SELECT * FROM m_smt ".
			"WHERE kd <> '$smtkd'");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$stkd = nosql($rowst['kd']);
	$stsmt = nosql($rowst['smt']);


	//detail tapel
	$qdtx = mysql_query("SELECT mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
				"FROM mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = '$kd6_session' ".
				"AND mahasiswa_kelas.kd_smt = '$stkd' ".
				"");
	$rdtx = mysql_fetch_assoc($qdtx);
	$tdtx = mysql_num_rows($qdtx);

	//jika ada, lihat tapel-nya
	if ($tdtx != 0)
		{
		//nilai
		$dtx_tapelkd = nosql($rdtx['kd_tapel']);

		//tapel-nya
		$qtpel = mysql_query("SELECT * FROM m_tapel ".
					"WHERE kd = '$dtx_tapelkd'");
		$rtpel = mysql_fetch_assoc($qtpel);
		$ttpel = mysql_num_rows($qtpel);
		$tpel_thn1 = nosql($rtpel['tahun1']);
		$tpel_thn2 = nosql($rtpel['tahun2']);

		}
	else
		{
		$dtx_tapelkd = "";
		$tpel_thn1 = "-";
		$tpel_thn2 = "-";
		}


	echo '<option value="'.$filenya.'?jnskd='.$jnskd.'&smtkd='.$stkd.'&tapelkd='.$dtx_tapelkd.'">'.$stsmt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.']</option>';
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>';


//jika belum dipilih
if (empty($smtkd))
	{
	echo '<p>
	<font color="red">
	<strong>SEMESTER Belum Dipilih</strong>
	</font>.
	</p>';
	}

else
	{
	//jika SKS. dibayarkan pada tiap semester. ///////////////////////////////////////////////////
	if ($jnskd == "b7456a463a7b0c1c9a3ece4b30c6db4a")
		{
		//ketahui jumlah SKS yang dimiliki, agar tahu total pembayarannya.
		//detail
		$qdtku = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
					"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
					"FROM m_mahasiswa, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND m_mahasiswa.kd = '$kd6_session'");
		$rdtku = mysql_fetch_assoc($qdtku);
		$dtku_mkkd = nosql($rdtku['mkkd']);
		$dtku_progdi = nosql($rdtku['kd_progdi']);
		$dtku_kelkd = nosql($rdtku['kd_kelas']);


		//total sks
		$qtoku = mysql_query("SELECT SUM(m_makul.sks) AS total ".
					"FROM mahasiswa_makul, m_makul ".
					"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
					"AND mahasiswa_makul.kd_mahasiswa_kelas = '$dtku_mkkd' ".
					"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
					"AND mahasiswa_makul.kd_smt = '$smtkd'");
		$rtoku = mysql_fetch_assoc($qtoku);
		$toku_total = nosql($rtoku['total']);


		//total uang
		$qpkl = mysql_query("SELECT * FROM m_keu ".
					"WHERE kd_jenis = '$jnskd' ".
					"AND kd_progdi = '$dtku_progdi' ".
					"AND kd_kelas = '$dtku_kelkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd'");
		$rpkl = mysql_fetch_assoc($qpkl);
		$pkl_nilai = nosql($rpkl['biaya']);


		//total uang sks
		$pklx_nilai = round($pkl_nilai*$toku_total);

		echo '<p>
		<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td valign="top">
		<strong>HISTORY PEMBAYARAN</strong>
		<br>
		('.xduit2($pklx_nilai).')
		<p>';

		//total bayar
		$qdftx2 = mysql_query("SELECT SUM(nilai) AS total ".
					"FROM mahasiswa_keu ".
					"WHERE kd_jenis = '$jnskd' ".
					"AND kd_mahasiswa = '$kd6_session' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd'");
		$rdftx2 = mysql_fetch_assoc($qdftx2);
		$dftx2_total = nosql($rdftx2['total']);


		//keterangan
		if ($dftx2_total == $pklx_nilai)
			{
			$nil_ket = "<font color=\"red\"><strong>LUNAS</strong></font>";
			}
		else
			{
			$nil_ket = "<font color=\"blue\"><strong>Belum Lunas</strong></font>";
			}



		//daftar
		$qdftx = mysql_query("SELECT mahasiswa_keu.*, ".
					"DATE_FORMAT(tgl_bayar, '%d') AS xtgl, ".
					"DATE_FORMAT(tgl_bayar, '%m') AS xbln, ".
					"DATE_FORMAT(tgl_bayar, '%Y') AS xthn ".
					"FROM mahasiswa_keu ".
					"WHERE kd_jenis = '$jnskd' ".
					"AND kd_mahasiswa = '$kd6_session' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd' ".
					"ORDER BY tgl_bayar DESC");
		$rdftx = mysql_fetch_assoc($qdftx);
		$tdftx = mysql_num_rows($qdftx);

		echo '<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="100" align="center"><strong><font color="'.$warnatext.'">Tgl.Bayar</font></strong></td>
		<td width="150" align="center"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
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
			$dft_kd = nosql($rdftx['kd']);
			$dft_bln = nosql($rdftx['bln']);
			$dft_thn = nosql($rdftx['thn']);
			$dft_nilai = nosql($rdftx['nilai']);
			$dft_xtgl = nosql($rdftx['xtgl']);
			$dft_xbln = nosql($rdftx['xbln']);
			$dft_xthn = nosql($rdftx['xthn']);
			$dft_tgl_bayar = "$dft_xtgl/$dft_xbln/$dft_xthn";

			//jika null
			if ($dft_tgl_bayar == "00/00/0000")
				{
				$dft_tgl_bayar = "-";
				}

			$dft_hapus = "[<a href=\"$filenya?s=hapus&jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&nim=$nim&swkd=$cc_kd&kd=$dft_kd\">HAPUS</a>]";



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$dft_tgl_bayar.'
			</td>
			<td align="right">
			'.xduit2($dft_nilai).'
			</td>
			</tr>';
			}
		while ($rdftx = mysql_fetch_assoc($qdftx));

		echo '</table>
		<p>
		Total Bayar :
		<br>
		Rp.	<input name="nil_total" type="text" size="10" value="'.$dftx2_total.'" style="text-align:right" class="input" readonly>,00
		</p>

		<p>
		Keterangan :
		<br>
		'.$nil_ket.'
		</p>
		</p>';


		echo '</td>
		</tr>
		</table>
		</p>';
		}



	//jika SPI, tanpa ada batasan minimal /////////////////////////////////////////////////////////////////
	else if ($jnskd == "70b97c951b5dc2c3b26d50eefeea19cc")
		{
		//detail
		$qdtku = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
					"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
					"FROM m_mahasiswa, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND m_mahasiswa.kd = '$kd6_session'");
		$rdtku = mysql_fetch_assoc($qdtku);
		$dtku_mkkd = nosql($rdtku['mkkd']);
		$dtku_progdi = nosql($rdtku['kd_progdi']);
		$dtku_kelkd = nosql($rdtku['kd_kelas']);



		echo '<p>
		<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td valign="top">
		<strong>HISTORY PEMBAYARAN</strong>
		<p>';

		//total bayar
		$qdftx2 = mysql_query("SELECT SUM(nilai) AS total ".
					"FROM mahasiswa_keu ".
					"WHERE kd_jenis = '$jnskd' ".
					"AND kd_mahasiswa = '$kd6_session' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd'");
		$rdftx2 = mysql_fetch_assoc($qdftx2);
		$dftx2_total = nosql($rdftx2['total']);

		//daftar
		$qdftx = mysql_query("SELECT mahasiswa_keu.*, ".
					"DATE_FORMAT(tgl_bayar, '%d') AS xtgl, ".
					"DATE_FORMAT(tgl_bayar, '%m') AS xbln, ".
					"DATE_FORMAT(tgl_bayar, '%Y') AS xthn ".
					"FROM mahasiswa_keu ".
					"WHERE kd_jenis = '$jnskd' ".
					"AND kd_mahasiswa = '$kd6_session' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd' ".
					"ORDER BY tgl_bayar DESC");
		$rdftx = mysql_fetch_assoc($qdftx);
		$tdftx = mysql_num_rows($qdftx);

		echo '<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="100" align="center"><strong><font color="'.$warnatext.'">Tgl.Bayar</font></strong></td>
		<td width="150" align="center"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
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
			$dft_kd = nosql($rdftx['kd']);
			$dft_bln = nosql($rdftx['bln']);
			$dft_thn = nosql($rdftx['thn']);
			$dft_nilai = nosql($rdftx['nilai']);
			$dft_xtgl = nosql($rdftx['xtgl']);
			$dft_xbln = nosql($rdftx['xbln']);
			$dft_xthn = nosql($rdftx['xthn']);
			$dft_tgl_bayar = "$dft_xtgl/$dft_xbln/$dft_xthn";

			//jika null
			if ($dft_tgl_bayar == "00/00/0000")
				{
				$dft_tgl_bayar = "-";
				}

			$dft_hapus = "[<a href=\"$filenya?s=hapus&jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&nim=$nim&swkd=$cc_kd&kd=$dft_kd\">HAPUS</a>]";



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$dft_tgl_bayar.'
			</td>
			<td align="right">
			'.xduit2($dft_nilai).'
			</td>
			</tr>';
			}
		while ($rdftx = mysql_fetch_assoc($qdftx));

		echo '</table>
		<p>
		Total Bayar :
		<br>
		Rp.	<input name="nil_total" type="text" size="10" value="'.$dftx2_total.'" style="text-align:right" class="input" readonly>,00
		</p>
		</p>
		</td>
		</tr>
		</table>
		</p>';
		}






	//jika SS, tanpa ada batasan minimal /////////////////////////////////////////////////////////////////
	else if ($jnskd == "f3b22b92155c4bc1ecb1b6db7dd56b91")
		{
		//detail
		$qdtku = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
					"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
					"FROM m_mahasiswa, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND m_mahasiswa.kd = '$kd6_session'");
		$rdtku = mysql_fetch_assoc($qdtku);
		$dtku_mkkd = nosql($rdtku['mkkd']);
		$dtku_progdi = nosql($rdtku['kd_progdi']);
		$dtku_kelkd = nosql($rdtku['kd_kelas']);



		echo '<p>
		<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td valign="top">
		<strong>HISTORY PEMBAYARAN</strong>
		<p>';

		//total bayar
		$qdftx2 = mysql_query("SELECT SUM(nilai) AS total ".
					"FROM mahasiswa_keu ".
					"WHERE kd_jenis = '$jnskd' ".
					"AND kd_mahasiswa = '$kd6_session' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd'");
		$rdftx2 = mysql_fetch_assoc($qdftx2);
		$dftx2_total = nosql($rdftx2['total']);

		//daftar
		$qdftx = mysql_query("SELECT mahasiswa_keu.*, ".
					"DATE_FORMAT(tgl_bayar, '%d') AS xtgl, ".
					"DATE_FORMAT(tgl_bayar, '%m') AS xbln, ".
					"DATE_FORMAT(tgl_bayar, '%Y') AS xthn ".
					"FROM mahasiswa_keu ".
					"WHERE kd_jenis = '$jnskd' ".
					"AND kd_mahasiswa = '$kd6_session' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd' ".
					"ORDER BY tgl_bayar DESC");
		$rdftx = mysql_fetch_assoc($qdftx);
		$tdftx = mysql_num_rows($qdftx);

		echo '<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="100" align="center"><strong><font color="'.$warnatext.'">Tgl.Bayar</font></strong></td>
		<td width="150" align="center"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
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
			$dft_kd = nosql($rdftx['kd']);
			$dft_bln = nosql($rdftx['bln']);
			$dft_thn = nosql($rdftx['thn']);
			$dft_nilai = nosql($rdftx['nilai']);
			$dft_xtgl = nosql($rdftx['xtgl']);
			$dft_xbln = nosql($rdftx['xbln']);
			$dft_xthn = nosql($rdftx['xthn']);
			$dft_tgl_bayar = "$dft_xtgl/$dft_xbln/$dft_xthn";

			//jika null
			if ($dft_tgl_bayar == "00/00/0000")
				{
				$dft_tgl_bayar = "-";
				}

			$dft_hapus = "[<a href=\"$filenya?s=hapus&jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&nim=$nim&swkd=$cc_kd&kd=$dft_kd\">HAPUS</a>]";



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$dft_tgl_bayar.'
			</td>
			<td align="right">
			'.xduit2($dft_nilai).'
			</td>
			</tr>';
			}
		while ($rdftx = mysql_fetch_assoc($qdftx));

		echo '</table>
		<p>
		Total Bayar :
		<br>
		Rp.	<input name="nil_total" type="text" size="10" value="'.$dftx2_total.'" style="text-align:right" class="input" readonly>,00
		</p>
		</p>
		</td>
		</tr>
		</table>
		</p>';
		}



	//jika lainnya ... ////////////////////////////////////////////////////////////////////////////////////
	else
		{
		//detail
		$qdtku = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
					"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
					"FROM m_mahasiswa, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND m_mahasiswa.kd = '$kd6_session'");
		$rdtku = mysql_fetch_assoc($qdtku);
		$dtku_mkkd = nosql($rdtku['mkkd']);
		$dtku_progdi = nosql($rdtku['kd_progdi']);
		$dtku_kelkd = nosql($rdtku['kd_kelas']);


		//total uang
		$qpkl = mysql_query("SELECT * FROM m_keu ".
					"WHERE kd_jenis = '$jnskd' ".
					"AND kd_progdi = '$dtku_progdi' ".
					"AND kd_kelas = '$dtku_kelkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd'");
		$rpkl = mysql_fetch_assoc($qpkl);
		$pkl_nilai = nosql($rpkl['biaya']);


		echo '<p>
		<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td valign="top">
		<strong>HISTORY PEMBAYARAN</strong>
		<br>
		('.xduit2($pkl_nilai).')
		<p>';

		//total bayar
		$qdftx2 = mysql_query("SELECT SUM(nilai) AS total ".
					"FROM mahasiswa_keu ".
					"WHERE kd_jenis = '$jnskd' ".
					"AND kd_mahasiswa = '$kd6_session' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd'");
		$rdftx2 = mysql_fetch_assoc($qdftx2);
		$dftx2_total = nosql($rdftx2['total']);


		//keterangan
		if ($dftx2_total == $pkl_nilai)
			{
			$nil_ket = "<font color=\"red\"><strong>LUNAS</strong></font>";
			}
		else
			{
			$nil_ket = "<font color=\"blue\"><strong>Belum Lunas</strong></font>";
			}



		//daftar
		$qdftx = mysql_query("SELECT mahasiswa_keu.*, ".
					"DATE_FORMAT(tgl_bayar, '%d') AS xtgl, ".
					"DATE_FORMAT(tgl_bayar, '%m') AS xbln, ".
					"DATE_FORMAT(tgl_bayar, '%Y') AS xthn ".
					"FROM mahasiswa_keu ".
					"WHERE kd_jenis = '$jnskd' ".
					"AND kd_mahasiswa = '$kd6_session' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd' ".
					"ORDER BY tgl_bayar DESC");
		$rdftx = mysql_fetch_assoc($qdftx);
		$tdftx = mysql_num_rows($qdftx);

		echo '<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="100" align="center"><strong><font color="'.$warnatext.'">Tgl.Bayar</font></strong></td>
		<td width="150" align="center"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
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
			$dft_kd = nosql($rdftx['kd']);
			$dft_bln = nosql($rdftx['bln']);
			$dft_thn = nosql($rdftx['thn']);
			$dft_nilai = nosql($rdftx['nilai']);
			$dft_xtgl = nosql($rdftx['xtgl']);
			$dft_xbln = nosql($rdftx['xbln']);
			$dft_xthn = nosql($rdftx['xthn']);
			$dft_tgl_bayar = "$dft_xtgl/$dft_xbln/$dft_xthn";

			//jika null
			if ($dft_tgl_bayar == "00/00/0000")
				{
				$dft_tgl_bayar = "-";
				}

			$dft_hapus = "[<a href=\"$filenya?s=hapus&jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&nim=$nim&swkd=$cc_kd&kd=$dft_kd\">HAPUS</a>]";



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$dft_tgl_bayar.'
			</td>
			<td align="right">
			'.xduit2($dft_nilai).'
			</td>
			</tr>';
			}
		while ($rdftx = mysql_fetch_assoc($qdftx));

		echo '</table>
		<p>
		Total Bayar :
		<br>
		Rp.	<input name="nil_total" type="text" size="10" value="'.$dftx2_total.'" style="text-align:right" class="input" readonly>,00
		</p>

		<p>
		Keterangan :
		<br>
		'.$nil_ket.'
		</p>
		</p>';


		echo '</td>
		</tr>
		</table>
		</p>';
		}
	}


echo '</p>
</form>';
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