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
$filenya = "dosen_tmp.php";
$judul = "Penempatan per Dosen";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$progdi = nosql($_REQUEST['progdi']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$s = nosql($_REQUEST['s']);




//focus
if (empty($progdi))
	{
	$diload = "document.formx.progdi.focus();";
	}
else if (empty($tapel))
	{
	$diload = "document.formx.tapel.focus();";
	}





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika hapus
if ($s == "hapus")
	{
	//nilai
	$progdi = nosql($_REQUEST['progdi']);
	$tapelkd = nosql($_REQUEST['tapelkd']);
	$dkd = nosql($_REQUEST['dkd']);
	$mkkd = nosql($_REQUEST['mkkd']);
	$kelas = nosql($_REQUEST['kelas']);
	$mpkd = nosql($_REQUEST['mpkd']);

/*
	//query
	mysqli_query($koneksi, "DELETE FROM dosen ".
					"WHERE kd_progdi = '$progdi' ".
					"AND kd_kelas = '$kelkd' ".
					"AND kd_pegawai = '$mpkd' ".
					"AND kd_makul = '$mkkd' ".
					"AND kd = '$dkd'");
*/
	//query
	mysqli_query($koneksi, "DELETE FROM dosen ".
					"WHERE kd = '$dkd'");

					
	//re-direct
	$ke = "$filenya?progdi=$progdi&tapelkd=$tapelkd";
	xloc($ke);
	exit();
	}






//jika simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$progdi = nosql($_POST['progdi']);
	$kelas = nosql($_POST['kelas']);
	$ruang = nosql($_POST['ruang']);
	$smt = nosql($_POST['smt']);
	$pegawai = nosql($_POST['pegawai']);
	$makul = nosql($_POST['makul']);

	//cek
	if ((empty($pegawai)) OR (empty($tapelkd)) OR (empty($makul)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!.";
		$ke = "$filenya?progdi=$progdi&tapelkd=$tapelkd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM dosen ".
								"WHERE kd_pegawai = '$pegawai' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_kelas = '$kelas' ".
								"AND kd_ruang = '$ruang' ".
								"AND kd_makul = '$makul'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);

		//jika iya, ada
		if ($tcc != 0)
			{
			//re-direct
			$pesan = "Dosen Tersebut Telah Mempunyai Mata Kuliah Tersebut. Harap Diperhatikan...!!.";
			$ke = "$filenya?progdi=$progdi&tapelkd=$tapelkd";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO dosen (kd, kd_progdi, kd_tapel, kd_kelas, kd_pegawai, kd_makul, kd_ruang, kd_smt, postdate) VALUES ".
							"('$x', '$progdi', '$tapelkd', '$kelas', '$pegawai', '$makul', '$ruang', '$smt', '$today')");

			//re-direct
			$ke = "$filenya?progdi=$progdi&tapelkd=$tapelkd";
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
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);

echo '<option value="'.$tpx_kd.'" selected>'.$tpx_nama.'</option>';

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

echo '</select>, 

Tahun Akademik : ';
echo "<select name=\"tapel\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<option value="'.$tpx_kd.'">'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
					"WHERE kd <> '$tapelkd' ".
					"ORDER BY tahun1 ASC");
$rowtp = mysqli_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
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
else if (empty($tapelkd))
	{
	echo '<p>
	<font color="red"><strong>TAHUN AKADEMIK Belum Dipilih.</strong></font>
	</p>';
	}
else
	{
	echo '<p>
	<select name="pegawai">
	<option value="" selected>-Dosen-</option>';

	$qtp2 = mysqli_query($koneksi, "SELECT m_pegawai.* ".
							"FROM m_pegawai, m_dosen ".
							"WHERE m_dosen.kd_pegawai = m_pegawai.kd ".
							"AND m_dosen.kd_progdi = '$progdi' ".
							"ORDER BY m_pegawai.nama ASC");
	$rowtp2 = mysqli_fetch_assoc($qtp2);

	do
		{
		$tp2_kd = nosql($rowtp2['kd']);
		$tp2_nip = nosql($rowtp2['nip']);
		$tp2_nama = balikin($rowtp2['nama']);

		echo '<option value="'.$tp2_kd.'">['.$tp2_nip.']. '.$tp2_nama.'</option>';
		}
	while ($rowtp2 = mysqli_fetch_assoc($qtp2));

	echo '</select>,

	<select name="kelas">
	<option value="" selected>-Jenis-</option>';

	$qtp2x = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
				"ORDER BY round(no) ASC");
	$rowtp2x = mysqli_fetch_assoc($qtp2x);

	do
		{
		$tp2x_kd = nosql($rowtp2x['kd']);
		$tp2x_no = nosql($rowtp2x['no']);
		$tp2x_kelas = balikin($rowtp2x['kelas']);

		echo '<option value="'.$tp2x_kd.'">'.$tp2x_kelas.'</option>';
		}
	while ($rowtp2x = mysqli_fetch_assoc($qtp2x));

	echo '</select>,



	<select name="makul">
	<option value="" selected>-Mata Kuliah-</option>';

	$qtp2 = mysqli_query($koneksi, "SELECT * FROM m_makul ".
				"WHERE kd_progdi = '$progdi' ".
				"ORDER BY kode ASC");
	$rowtp2 = mysqli_fetch_assoc($qtp2);

	do
		{
		$tp2_kd = nosql($rowtp2['kd']);
		$tp2_kode = nosql($rowtp2['kode']);
		$tp2_nama = balikin($rowtp2['nama']);

		echo '<option value="'.$tp2_kd.'">['.$tp2_kode.']. '.$tp2_nama.'</option>';
		}
	while ($rowtp2 = mysqli_fetch_assoc($qtp2));

	echo '</select>
	<br>

	<select name="smt">
	<option value="" selected>-Semester-</option>';

	$qtp2x = mysqli_query($koneksi, "SELECT * FROM m_smt ".
							"ORDER BY no ASC");
	$rowtp2x = mysqli_fetch_assoc($qtp2x);

	do
		{
		$tp2x_kd = nosql($rowtp2x['kd']);
		$tp2x_no = nosql($rowtp2x['no']);

		echo '<option value="'.$tp2x_kd.'">'.$arrbln3[$tp2x_no].'</option>';
		}
	while ($rowtp2x = mysqli_fetch_assoc($qtp2x));

	echo '</select>,
	
	
	
	<select name="ruang">
	<option value="" selected>-Kelas-</option>';

	$qtp2x = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
							"ORDER BY ruang ASC");
	$rowtp2x = mysqli_fetch_assoc($qtp2x);

	do
		{
		$tp2x_kd = nosql($rowtp2x['kd']);
		$tp2x_kelas = balikin($rowtp2x['ruang']);

		echo '<option value="'.$tp2x_kd.'">'.$tp2x_kelas.'</option>';
		}
	while ($rowtp2x = mysqli_fetch_assoc($qtp2x));

	echo '</select>
	<br>


	<INPUT type="hidden" name="progdi" value="'.$progdi.'">
	<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
	<INPUT type="submit" name="btnSMP" value="TAMBAH >>">
	</p>';



	//daftar dosen
	$qkulo = mysqli_query($koneksi, "SELECT DISTINCT(dosen.kd_pegawai) AS mpkd ".
							"FROM dosen, m_pegawai ".
							"WHERE dosen.kd_pegawai = m_pegawai.kd ".
							"AND dosen.kd_progdi = '$progdi' ".
							"AND dosen.kd_tapel = '$tapelkd' ".
							"ORDER BY round(m_pegawai.nip) ASC");
	$rkulo = mysqli_fetch_assoc($qkulo);
	$tkulo = mysqli_num_rows($qkulo);

	//jika ada
	if ($tkulo != 0)
		{
		echo '<table width="700" border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="100"><strong><font color="'.$warnatext.'">NIP</font></strong></td>
		<td width="200"><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Mata Kuliah Yang Diampu</font></strong></td>
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
			$qkix = mysqli_query($koneksi, "SELECT * FROM m_pegawai ".
						"WHERE kd = '$kulo_mpkd'");
			$rkix = mysqli_fetch_assoc($qkix);
			$kix_nip = nosql($rkix['nip']);
			$kix_nama = balikin($rkix['nama']);




			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$kix_nip.'</td>
			<td>'.$kix_nama.'</td>
			<td>';

			//yang diampu
			$qjux = mysqli_query($koneksi, "SELECT dosen.*, dosen.kd AS dkd, m_makul.*, m_makul.kd AS mkkd ".
									"FROM dosen, m_makul ".
									"WHERE dosen.kd_makul = m_makul.kd ".
									"AND dosen.kd_tapel = '$tapelkd' ".
									"AND dosen.kd_pegawai = '$kulo_mpkd' ".
									"AND dosen.kd_progdi = '$progdi'");
			$rjux = mysqli_fetch_assoc($qjux);
			$tjux = mysqli_num_rows($qjux);

			//jika ada
			if ($tjux != 0)
				{
				do
					{
					//nilai
					$jux_dkd = nosql($rjux['dkd']);
					$jux_mkkd = nosql($rjux['mkkd']);
					$jux_kelkd = nosql($rjux['kd_kelas']);
					$jux_rukd = nosql($rjux['kd_ruang']);
					$jux_smtkd = nosql($rjux['kd_smt']);
					$jux_nama = balikin($rjux['nama']);


					//kelas
					$qkix2 = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
								"WHERE kd = '$jux_kelkd'");
					$rkix2 = mysqli_fetch_assoc($qkix2);
					$kix2_kelas = balikin($rkix2['kelas']);


					//ruang
					$qkix2 = mysqli_query($koneksi, "SELECT * FROM m_ruang ".
											"WHERE kd = '$jux_rukd'");
					$rkix2 = mysqli_fetch_assoc($qkix2);
					$kix2_ruang = balikin($rkix2['ruang']);


					//smt
					$qkix2 = mysqli_query($koneksi, "SELECT * FROM m_smt ".
											"WHERE kd = '$jux_smtkd'");
					$rkix2 = mysqli_fetch_assoc($qkix2);
					$kix2_no = balikin($rkix2['no']);


					echo '*[<strong>Jenis:'.$kix2_kelas.'</strong>]. 
					[<strong>Semester:'.$arrbln3[$kix2_no].'</strong>].
					[<strong>Kelas:'.$kix2_ruang.'</strong>].
					<br> 
					'.$jux_nama.'
					<br>
					[<a href="'.$filenya.'?progdi='.$progdi.'&tapelkd='.$tapelkd.'&dkd='.$jux_dkd.'&mpkd='.$kulo_mpkd.'&mkkd='.$jux_mkkd.'&s=hapus"><img src="'.$sumber.'/img/delete.gif" width="16" height="16" border="0"></a>].
					<br>
					<br>';
					}
				while ($rjux = mysqli_fetch_assoc($qjux));
				}
			else
				{
				echo '-';
				}

			echo '</td>
			</tr>';
			}
		while ($rkulo = mysqli_fetch_assoc($qkulo));


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