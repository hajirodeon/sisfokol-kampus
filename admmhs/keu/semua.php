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
$filenya = "semua.php";
$tapelkd = nosql($_REQUEST['tapelkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);



$judul = "Keuangan Semua";
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


//smt
$qkelx = mysql_query("SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rkelx = mysql_fetch_assoc($qkelx);
$kelx_smt = balikin($rkelx['smt']);
$kelx_no = nosql($rkelx['no']);



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
				"AND mahasiswa_kelas.kd_smt = '$stkd'");
	$rdtx = mysql_fetch_assoc($qdtx);
	$tdtx = mysql_num_rows($qdtx);

	//jika ada, lihat tapel-nya
	if ($tdtx != 0)
		{
		//nilai
		$dtx_tapelkd = nosql($rdtx['kd_tapel']);
		$dtx_progdi = nosql($rdtx['kd_progdi']);
		$dtx_kelkd = nosql($rdtx['kd_kelas']);

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


	echo '<option value="'.$filenya.'?smtkd='.$stkd.'&tapelkd='.$dtx_tapelkd.'&progdi='.$dtx_progdi.'&kelkd='.$dtx_kelkd.'">'.$stsmt.' [Tahun Akademik : '.$tpel_thn1.'/'.$tpel_thn2.']</option>';
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
	echo '<table width="500" border="1" cellspacing="0" cellpadding="3">
	<tr bgcolor="'.$warnaover.'">
	<td width="300">
	<strong>Jenis Keuangan</strong>
	</td>
	<td width="200">
	<strong>Jumlah</strong>
	</td>
	</tr>';


	//daftar jenis keu.
	$qjku = mysql_query("SELECT * FROM m_keu_jenis ".
				"ORDER BY nama ASC");
	$rjku = mysql_fetch_assoc($qjku);

	do
		{
		//nilai
		$jku_kd = nosql($rjku['kd']);
		$jku_nama = balikin($rjku['nama']);


		if ($warna_set ==0)
			{
			//$warna = $warna01;
			$warna_set = 1;
			}
		else
			{
			//$warna = $warna02;
			$warna_set = 0;
			}




		//jika KKL. dibayarkan pada semester V.
		if (($jnskd == "4d1c2f82a73ce44e92db9c213f647a4b") AND ($kelx_no == "5"))
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}


		//jika KP. dibayarkan pada semester V.
		if (($jku_kd == "ec5532c37f0cb97ed3b7f74ff227dae6") AND ($kelx_no == "5"))
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);

			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}






		//jika pendaftaran. dibayarkan pada semester satu.
		if (($jku_kd == "c9c6af590fd66c486866cd58866bbc03") AND ($kelx_no == "1"))
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}




		//jika perpustakaan. dibayarkan pada semester satu.
		if (($jku_kd == "7da779f9751037552aeb0d4315020642") AND ($kelx_no == "1"))
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);

			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}



		//jika PPS. dibayarkan pada semester satu.
		if (($jku_kd == "ed60cc8508a00dd07e7185b33ee70bf8") AND ($kelx_no == "1"))
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}





		//jika seragam. dibayarkan pada semester satu.
		if (($jku_kd == "6087bfa96f72a81f4e9992a1564c7d53") AND ($kelx_no == "1"))
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}






		//jika SPI. dibayarkan pada semester satu.
		if (($jku_kd == "70b97c951b5dc2c3b26d50eefeea19cc") AND ($kelx_no == "1"))
			{
			//yang telah dibayar, SPI
			$qccx = mysql_query("SELECT SUM(nilai) AS nilai FROM mahasiswa_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_mahasiswa = '$kd6_session'");
			$rccx = mysql_fetch_assoc($qccx);
			$ccx_nilai = nosql($rccx['nilai']);



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$ccx_nilai.'" style="text-align:right" class="input" readonly>,00
			</td>
			</tr>';
			}



		//jika SS. dibayarkan pada semester satu.
		if (($jku_kd == "f3b22b92155c4bc1ecb1b6db7dd56b91") AND ($kelx_no == "1"))
			{
			//yang telah dibayar, SS
			$qccx2 = mysql_query("SELECT SUM(nilai) AS nilai ".
						"FROM mahasiswa_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_mahasiswa = '$kd6_session'");
			$rccx2 = mysql_fetch_assoc($qccx2);
			$ccx2_nilai = nosql($rccx2['nilai']);



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$ccx2_nilai.'" style="text-align:right" class="input" readonly>,00
			</td>
			</tr>';
			}








		//jika TA. dibayarkan pada semester enam.
		if (($jku_kd == "188e44a281e3cae553347b6d6402c593") AND ($kelx_no == "6"))
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);

			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}





		//jika Wisuda. dibayarkan pada semester enam.
		if (($jku_kd == "b537f9f36e19e3cd108e53fd646cdcac") AND ($kelx_no == "6"))
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}




		//jika lainnya. dibayarkan tiap semester.
		if ($jku_kd == "e164458a8f1e651cbf62858b284c6eb9")
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);

			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}




		//jika Praktikum. dibayarkan tiap semester.
		if ($jku_kd == "2db4cdfd8493df145356ad9c2b4c3e46")
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);

			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}



		//jika SKS. dibayarkan pada tiap semester.
		if ($jku_kd == "b7456a463a7b0c1c9a3ece4b30c6db4a")
			{
			//ketahui jumlah SKS yang dimiliki, agar tahu total pembayarannya.
			//detail
			$qdtku = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
						"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND m_mahasiswa.kd = '$kd6_session'");
			$rdtku = mysql_fetch_assoc($qdtku);
			$dtku_mkkd = nosql($rdtku['mkkd']);

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
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);


			//bayar
			$nil_bayar = $toku_total*$pkl_nilai;



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$nil_bayar.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}



		//jika SPP. dibayarkan pada tiap semester.
		if ($jku_kd == "c4ca4238a0b923820dcc509a6f75849b")
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}


		//jika UAS. dibayarkan pada tiap semester.
		if ($jku_kd == "ef554032f6512b2be886123df22b93d5")
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}



		//jika Ujian. dibayarkan pada tiap semester.
		if ($jku_kd == "8fb59d1027e024325bdc4aee1fbcd9a3")
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}



		//jika UTS. dibayarkan pada tiap semester.
		if ($jku_kd == "c81e728d9d4c2f636f067f89cc14862c")
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}




		//jika kemahasiswaan, bayar tiap semester. ////////////////////////////////////////////
		if ($jku_kd == "b814b1983879554b8da8ca3881b99f37")
			{
			//total uang
			$qpkl = mysql_query("SELECT * FROM m_keu ".
						"WHERE kd_jenis = '$jku_kd' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd'");
			$rpkl = mysql_fetch_assoc($qpkl);
			$pkl_nilai = nosql($rpkl['biaya']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$jku_nama.'
			</td>

			<td>
			Rp.<input name="nil_bayar'.$jku_kd.'" type="text" size="10" value="'.$pkl_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)" class="input" readonly>,00
			</td>
			</tr>';
			}



		}
	while ($rjku = mysql_fetch_assoc($qjku));




	//ketahui total akhir /////////////////////////////////////////////////////////
	//total uang, selain SKS dan SS dan SPI.
	$qpkl = mysql_query("SELECT SUM(biaya) AS total ".
				"FROM m_keu ".
				"WHERE kd_jenis <> 'b7456a463a7b0c1c9a3ece4b30c6db4a' ".
				"AND kd_jenis <> '70b97c951b5dc2c3b26d50eefeea19cc' ".
				"AND kd_jenis <> 'f3b22b92155c4bc1ecb1b6db7dd56b91' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd'");
	$rpkl = mysql_fetch_assoc($qpkl);
	$pkl_total = nosql($rpkl['total']);



	//ketahui jumlah SKS yang dimiliki, agar tahu total pembayarannya.
	//detail
	$qdtku = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
				"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND m_mahasiswa.kd = '$kd6_session'");
	$rdtku = mysql_fetch_assoc($qdtku);
	$dtku_mkkd = nosql($rdtku['mkkd']);

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
				"WHERE kd_jenis = 'b7456a463a7b0c1c9a3ece4b30c6db4a' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd'");
	$rpkl = mysql_fetch_assoc($qpkl);
	$pkl_nilai = nosql($rpkl['biaya']);

	//bayar
	$nil_bayar_sks = $toku_total*$pkl_nilai;





	//yang telah dibayar, SPI
	$qccx = mysql_query("SELECT SUM(nilai) AS nilai FROM mahasiswa_keu ".
				"WHERE kd_jenis = '70b97c951b5dc2c3b26d50eefeea19cc' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$kd6_session'");
	$rccx = mysql_fetch_assoc($qccx);
	$ccx_nilai = nosql($rccx['nilai']);





	//yang telah dibayar, SS
	$qccx2 = mysql_query("SELECT SUM(nilai) AS nilai FROM mahasiswa_keu ".
				"WHERE kd_jenis = 'f3b22b92155c4bc1ecb1b6db7dd56b91' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_smt = '$smtkd' ".
				"AND kd_mahasiswa = '$kd6_session'");
	$rccx2 = mysql_fetch_assoc($qccx2);
	$ccx2_nilai = nosql($rccx2['nilai']);





	//total bayar
	$total_bayar = $pkl_total + $nil_bayar_sks + $ccx_nilai + $ccx2_nilai;



	echo '<tr bgcolor="'.$warnaover.'">
	<td align="right">
	<strong>Total</strong>
	</td>
	<td>
	Rp.<input name="totalnya" type="text" size="10" value="'.$total_bayar.'" style="text-align:right" class="input" readonly>,00
	</td>
	</tr>
	</table>';
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