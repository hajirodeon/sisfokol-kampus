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
require("../../inc/cek/admdrk.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "keluar.php";
$judul = "Data Surat Keluar";
$judulku = "$judul  [$drk_session : $nip1_session. $nm1_session]";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$sukd = nosql($_REQUEST['sukd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

//focus
$diload = "document.formx.no_surat.focus();";



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
	$sukd = nosql($_REQUEST['sukd']);
	$page = nosql($_REQUEST['page']);

	//query
	$qx = mysql_query("SELECT surat_keluar.*, ".
							"DATE_FORMAT(tgl_surat, '%d') AS surat_tgl, ".
							"DATE_FORMAT(tgl_surat, '%m') AS surat_bln, ".
							"DATE_FORMAT(tgl_surat, '%Y') AS surat_thn, ".
							"DATE_FORMAT(tgl_kirim, '%d') AS kirim_tgl, ".
							"DATE_FORMAT(tgl_kirim, '%m') AS kirim_bln, ".
							"DATE_FORMAT(tgl_kirim, '%Y') AS kirim_thn, ".
							"DATE_FORMAT(tgl_deadline_balas, '%d') AS deadline_tgl, ".
							"DATE_FORMAT(tgl_deadline_balas, '%m') AS deadline_bln, ".
							"DATE_FORMAT(tgl_deadline_balas, '%Y') AS deadline_thn ".
							"FROM surat_keluar ".
							"WHERE kd = '$sukd'");
	$rowx = mysql_fetch_assoc($qx);
	$x_no_urut = nosql($rowx['no_urut']);
	$x_no_surat = balikin2($rowx['no_surat']);
	$x_tujuan = balikin2($rowx['tujuan']);
	$x_kd_lemari = nosql($rowx['kd_lemari']);
	$x_kd_rak = nosql($rowx['kd_rak']);
	$x_kd_ruang = nosql($rowx['kd_ruang']);
	$x_kd_map = nosql($rowx['kd_map']);
	$x_kd_sifat = nosql($rowx['kd_sifat']);
	$x_kd_status = nosql($rowx['kd_status']);
	$x_kd_klasifikasi = nosql($rowx['kd_klasifikasi']);
	$x_lokasi = balikin2($rowx['lokasi']);
	$x_lampiran = balikin2($rowx['lampiran']);
	$x_tembusan = balikin2($rowx['tembusan']);
	$x_ket = balikin2($rowx['ket']);
	$x_balas = nosql($rowx['balas']);
	$x_surat_tgl = nosql($rowx['surat_tgl']);
	$x_surat_bln = nosql($rowx['surat_bln']);
	$x_surat_thn = nosql($rowx['surat_thn']);
	$x_perihal = balikin2($rowx['perihal']);
	$x_kirim_tgl = nosql($rowx['kirim_tgl']);
	$x_kirim_bln = nosql($rowx['kirim_bln']);
	$x_kirim_thn = nosql($rowx['kirim_thn']);
	$x_de_tgl = nosql($rowx['deadline_tgl']);
	$x_de_bln = nosql($rowx['deadline_bln']);
	$x_de_thn = nosql($rowx['deadline_thn']);
	}





//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$sukd = nosql($_POST['sukd']);
	$no_urut = nosql($_POST['no_urut']);
	$klasifikasi = nosql($_POST['klasifikasi']);
	$sifat = nosql($_POST['sifat']);
	$no_surat = cegah($_POST['no_surat']);
	$tujuan = cegah($_POST['tujuan']);
	$perihal = cegah($_POST['perihal']);
	$lampiran = cegah($_POST['lampiran']);
	$tembusan = cegah($_POST['tembusan']);
	$status = nosql($_POST['status']);
	$balas = nosql($_POST['balas']);
	$ket = cegah($_POST['ket']);

	$ruang = nosql($_POST['ruang']);
	$lemari = nosql($_POST['lemari']);
	$rak = nosql($_POST['rak']);
	$map = nosql($_POST['map']);


	$surat_tgl = nosql($_POST['surat_tgl']);
	$surat_bln = nosql($_POST['surat_bln']);
	$surat_thn = nosql($_POST['surat_thn']);
	$tgl_surat = "$surat_thn:$surat_bln:$surat_tgl";

	$kirim_tgl = nosql($_POST['kirim_tgl']);
	$kirim_bln = nosql($_POST['kirim_bln']);
	$kirim_thn = nosql($_POST['kirim_thn']);
	$tgl_kirim = "$kirim_thn:$kirim_bln:$kirim_tgl";

	$deadline_tgl = nosql($_POST['de_tgl']);
	$deadline_bln = nosql($_POST['de_bln']);
	$deadline_thn = nosql($_POST['de_thn']);
	$tgl_deadline_balas = "$deadline_thn:$deadline_bln:$deadline_tgl";

	$page = nosql($_POST['page']);


	//nek null
	if (empty($no_surat))
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?s=baru";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//jika baru
		if ($s == "baru")
			{
			///cek
			$qcc = mysql_query("SELECT * FROM surat_keluar ".
									"WHERE no_surat = '$no_surat'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//nek ada
			if ($tcc != 0)
				{
				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$pesan = "Nomor Surat tersebut, Sudah Ada. Silahkan Ganti Yang Lain...!!";
				$ke = "$filenya?s=baru";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//query
				/*
				mysql_query("INSERT INTO surat_keluar(kd, no_urut, kd_klasifikasi, kd_sifat, ".
									"no_surat, tgl_surat, tgl_kirim, tgl_deadline_balas, ".
									"tujuan, perihal, lampiran, tembusan, ".
									"kd_status, balas, ket, ".
									"kd_ruang, kd_lemari, kd_rak, kd_map) VALUES ".
									"('$x', '$no_urut', '$klasifikasi', '$sifat', ".
									"'$no_surat', '$tgl_surat', '$tgl_kirim', '$tgl_deadline_balas', ".
									"'$tujuan', '$perihal', '$lampiran', '$tembusan', ".
									"'$status', '$balas', '$ket', ".
									"'$ruang', '$lemari', '$rak', '$map')");
				*/

				mysql_query("INSERT INTO surat_keluar(kd, no_urut, kd_klasifikasi, kd_sifat, ".
									"no_surat, tgl_surat, tgl_kirim, tgl_deadline_balas, ".
									"tujuan, perihal, lampiran, tembusan, ".
									"kd_status, balas, ket, ".
									"kd_ruang, kd_lemari, kd_rak, kd_map) VALUES ".
									"('$x', '$no_urut', '$klasifikasi', '$sifat', ".
									"'$no_surat', '$tgl_surat', '$tgl_kirim', '$tgl_deadline_balas', ".
									"'$tujuan', '$perihal', '$lampiran', '$tembusan', ".
									"'$status', '$balas', '$ket', ".
									"'$ruang', '$lemari', '$rak', '$map')");


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
			mysql_query("UPDATE surat_keluar SET kd_klasifikasi = '$klasifikasi', ".
									"kd_sifat = '$sifat', ".
									"no_surat = '$no_surat', ".
									"tgl_surat = '$tgl_surat', ".
									"tgl_kirim = '$tgl_kirim', ".
									"tgl_deadline_balas = 'tgl_deadline_balas', ".
									"tujuan = '$tujuan', ".
									"perihal = '$perihal', ".
									"lampiran = '$lampiran', ".
									"tembusan = '$tembusan', ".
									"kd_status = '$status', ".
									"balas = '$balas', ".
									"ket = '$ket', ".
									"kd_ruang = '$ruang', ".
									"kd_lemari = '$lemari', ".
									"kd_rak = '$rak', ".
									"kd_map = '$map' ".
									"WHERE kd = '$sukd' ".
									"AND no_urut = '$no_urut'");


			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$ke = "$filenya?page=$page";
			xloc($ke);
			exit();
			}
		}
	}








//jika hapus
if ($_POST['btnHPS'])
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT * FROM surat_keluar ".
					"ORDER BY round(no_urut) DESC";
	$sqlresult = $sqlcount;

	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);

	//ambil semua
	do
		{
		//nilai
		$i = $i + 1;
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del brg
		mysql_query("DELETE FROM surat_keluar ".
						"WHERE kd = '$kd'");
		}
	while ($data = mysql_fetch_assoc($result));

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


//js
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/menu/admdrk.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>';
xheadline($judul);
echo ' [<a href="'.$filenya.'?s=baru">Input Baru</a>].
[<a href="cari_keluar.php">Cari</a>].
</td>
</tr>
</table>';


//nek baru ato edit /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (($s == "baru") OR ($s == "edit"))
	{
	//jika baru
	if ($s == "baru")
		{
		//ambil nilai max
		$qcc = mysql_query("SELECT MAX(round(no_urut)) AS akhir ".
								"FROM surat_keluar");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);
		$cc_akhir = nosql($rcc['akhir']);
		$cc_no_urut = round($cc_akhir + 1);
		}

	//jika edit
	else
		{
		$cc_no_urut = $x_no_urut;
		}


	echo '<p>
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td width="150">
	No. Urut
	</td>
	<td>
	<input name="no_urut" type="text" value="'.$cc_no_urut.'" size="10" class="input" readonly>
	</td>
	</tr>

	<tr>
	<td width="150">
	Klasifikasi Surat
	</td>
	<td>
	<select name="klasifikasi">';

	//terpilih
	$qdtx = mysql_query("SELECT * FROM surat_m_klasifikasi ".
									"WHERE kd = '$x_kd_klasifikasi'");
	$rdtx = mysql_fetch_assoc($qdtx);
	$dtx_klasifikasi = balikin($rdtx['klasifikasi']);

	echo '<option value="'.$x_kd_klasifikasi.'" selected>'.$dtx_klasifikasi.'</option>';

	//daftar klasifikasi
	$qdt = mysql_query("SELECT * FROM surat_m_klasifikasi ".
								"WHERE kd <> '$x_kd_klasifikasi' ".
								"ORDER BY klasifikasi ASC");
	$rdt = mysql_fetch_assoc($qdt);

	do
		{
		//nilai
		$dt_kd = nosql($rdt['kd']);
		$dt_klasifikasi = balikin($rdt['klasifikasi']);

		echo '<option value="'.$dt_kd.'">'.$dt_klasifikasi.'</option>';
		}
	while ($rdt = mysql_fetch_assoc($qdt));

	echo '</select>
	</td>
	</tr>

	<tr>
	<td width="150">
	Sifat Surat
	</td>
	<td>
	<select name="sifat">';

	//terpilih
	$qdtx = mysql_query("SELECT * FROM surat_m_sifat ".
									"WHERE kd = '$x_kd_sifat'");
	$rdtx = mysql_fetch_assoc($qdtx);
	$dtx_sifat = balikin($rdtx['sifat']);

	echo '<option value="'.$x_kd_sifat.'" selected>'.$dtx_sifat.'</option>';

	//daftar sifat
	$qdt = mysql_query("SELECT * FROM surat_m_sifat ".
								"WHERE kd <> '$x_kd_sifat' ".
								"ORDER BY sifat ASC");
	$rdt = mysql_fetch_assoc($qdt);

	do
		{
		//nilai
		$dt_kd = nosql($rdt['kd']);
		$dt_sifat = balikin($rdt['sifat']);

		echo '<option value="'.$dt_kd.'">'.$dt_sifat.'</option>';
		}
	while ($rdt = mysql_fetch_assoc($qdt));

	echo '</select>
	</td>
	</tr>

	<tr>
	<td width="150">
	No. Surat
	</td>
	<td>
	<input name="no_surat" type="text" value="'.$x_no_surat.'" size="20">
	</td>
	</tr>

	<tr>
	<td width="150">
	Tgl. Surat
	</td>
	<td>
	<select name="surat_tgl">
	<option value="'.$x_surat_tgl.'" selected>'.$x_surat_tgl.'</option>';
	for ($i=1;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}

	echo '</select>
	<select name="surat_bln">
	<option value="'.$x_surat_bln.'" selected>'.$arrbln1[$x_surat_bln].'</option>';
	for ($j=1;$j<=12;$j++)
		{
		echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
		}

	echo '</select>
	<select name="surat_thn">
	<option value="'.$x_surat_thn.'" selected>'.$x_surat_thn.'</option>';
	for ($k=$surat01;$k<=$surat02;$k++)
		{
		echo '<option value="'.$k.'">'.$k.'</option>';
		}
	echo '</select>
	</td>
	</tr>

	<tr>
	<td width="150">
	Tgl. Dikirim
	</td>
	<td>
	<select name="kirim_tgl">
	<option value="'.$x_kirim_tgl.'" selected>'.$x_kirim_tgl.'</option>';
	for ($i=1;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}

	echo '</select>
	<select name="kirim_bln">
	<option value="'.$x_kirim_bln.'" selected>'.$arrbln1[$x_kirim_bln].'</option>';
	for ($j=1;$j<=12;$j++)
		{
		echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
		}

	echo '</select>
	<select name="kirim_thn">
	<option value="'.$x_kirim_thn.'" selected>'.$x_kirim_thn.'</option>';
	for ($k=$surat01;$k<=$surat02;$k++)
		{
		echo '<option value="'.$k.'">'.$k.'</option>';
		}
	echo '</select>
	</td>
	</tr>

	<tr>
	<td width="150">
	Tgl. Deadline Balasan Surat
	</td>
	<td>
	<select name="de_tgl">
	<option value="'.$x_de_tgl.'" selected>'.$x_de_tgl.'</option>';
	for ($i=1;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}

	echo '</select>
	<select name="de_bln">
	<option value="'.$x_de_bln.'" selected>'.$arrbln1[$x_de_bln].'</option>';
	for ($j=1;$j<=12;$j++)
		{
		echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
		}

	echo '</select>
	<select name="de_thn">
	<option value="'.$x_de_thn.'" selected>'.$x_de_thn.'</option>';
	for ($k=$surat01;$k<=$surat02;$k++)
		{
		echo '<option value="'.$k.'">'.$k.'</option>';
		}
	echo '</select>
	</td>
	</tr>

	<tr>
	<td width="150">
	Tujuan Surat
	</td>
	<td>
	<textarea name="tujuan" rows="5" cols="50">'.$x_tujuan.'</textarea>
	</td>
	</tr>

	<tr>
	<td width="150">
	Perihal Surat
	</td>
	<td>
	<textarea name="perihal" rows="5" cols="50">'.$x_perihal.'</textarea>
	</td>
	</tr>

	<tr>
	<td width="150">
	Lampiran Surat
	</td>
	<td>
	<textarea name="lampiran" rows="5" cols="50">'.$x_lampiran.'</textarea>
	</td>
	</tr>

	<tr>
	<td width="150">
	Tembusan Surat
	</td>
	<td>
	<textarea name="tembusan" rows="5" cols="50">'.$x_tembusan.'</textarea>
	</td>
	</tr>

	<tr>
	<td width="150">
	Status Keberadaan Surat
	</td>
	<td>
	<select name="status">';

	//terpilih
	$qdtx = mysql_query("SELECT * FROM surat_m_status ".
									"WHERE kd = '$x_kd_status'");
	$rdtx = mysql_fetch_assoc($qdtx);
	$dtx_status = balikin($rdtx['status']);

	echo '<option value="'.$x_kd_status.'" selected>'.$dtx_status.'</option>';

	//daftar status
	$qdt = mysql_query("SELECT * FROM surat_m_status ".
								"WHERE kd <> '$x_kd_status' ".
								"ORDER BY status ASC");
	$rdt = mysql_fetch_assoc($qdt);

	do
		{
		//nilai
		$dt_kd = nosql($rdt['kd']);
		$dt_status = balikin($rdt['status']);

		echo '<option value="'.$dt_kd.'">'.$dt_status.'</option>';
		}
	while ($rdt = mysql_fetch_assoc($qdt));

	echo '</select>
	</td>
	</tr>

	<tr>
	<td width="150">
	Apakah Sudah Dibalas...?
	</td>
	<td>
	<select name="balas">';

	//jika telah dibalas
	if ($x_balas == "true")
		{
		$x_balas_ket = "Sudah";
		}
	else
		{
		$x_balas_ket = "Belum";
		}


	echo '<option value="'.$x_balas.'" selected>'.$x_balas_ket.'</option>
	<option value="true">Sudah</option>
	<option value="false">Belum</option>
	</select>
	</td>
	</tr>

	<tr>
	<td width="150">
	Keterangan Lain
	</td>
	<td>
	<textarea name="ket" rows="5" cols="50">'.$x_ket.'</textarea>
	</td>
	</tr>
	</table>
	<br>
	<br>

	<p>
	Lokasi Pengarsipan :
	</p>
	<p>
	Ruang :  ';

	//terpilih
	$qdt1 = mysql_query("SELECT * FROM surat_m_ruang ".
									"WHERE kd = '$x_kd_ruang'");
	$rdt1 = mysql_fetch_assoc($qdt1);
	$dt1_ruang = balikin($rdt1['ruang']);

	echo '<select name="ruang">
	<option value="'.$x_kd_ruang.'" selected>'.$dt1_ruang.'</option>';

	//daftar
	$qru = mysql_query("SELECT * FROM surat_m_ruang ".
								"ORDER BY ruang ASC");
	$rru = mysql_fetch_assoc($qru);

	do
		{
		//nilai
		$ru_kd = nosql($rru['kd']);
		$ru_ruang = balikin($rru['ruang']);

		echo '<option value="'.$ru_kd.'">'.$ru_ruang.'</option>';
		}
	while ($rru = mysql_fetch_assoc($qru));

	echo'</select>,

	Lemari : ';

	//terpilih
	$qdt2 = mysql_query("SELECT * FROM surat_m_lemari ".
									"WHERE kd = '$x_kd_lemari'");
	$rdt2 = mysql_fetch_assoc($qdt2);
	$dt2_lemari = balikin($rdt2['lemari']);

	echo '<select name="lemari">
	<option value="'.$x_kd_lemari.'" selected>'.$dt2_lemari.'</option>';

	//daftar
	$qru = mysql_query("SELECT * FROM surat_m_lemari ".
								"ORDER BY lemari ASC");
	$rru = mysql_fetch_assoc($qru);

	do
		{
		//nilai
		$ru_kd = nosql($rru['kd']);
		$ru_lemari = balikin($rru['lemari']);

		echo '<option value="'.$ru_kd.'">'.$ru_lemari.'</option>';
		}
	while ($rru = mysql_fetch_assoc($qru));

	echo'</select>,

	Rak : ';

	//terpilih
	$qdt3 = mysql_query("SELECT * FROM surat_m_rak ".
									"WHERE kd = '$x_kd_rak'");
	$rdt3 = mysql_fetch_assoc($qdt3);
	$dt3_rak = balikin($rdt3['rak']);

	echo '<select name="rak">
	<option value="'.$x_kd_rak.'" selected>'.$dt3_rak.'</option>';

	//daftar
	$qru = mysql_query("SELECT * FROM surat_m_rak ".
								"ORDER BY rak ASC");
	$rru = mysql_fetch_assoc($qru);

	do
		{
		//nilai
		$ru_kd = nosql($rru['kd']);
		$ru_rak = balikin($rru['rak']);

		echo '<option value="'.$ru_kd.'">'.$ru_rak.'</option>';
		}
	while ($rru = mysql_fetch_assoc($qru));

	echo'</select>,

	MAP : ';

	//terpilih
	$qdt4 = mysql_query("SELECT * FROM surat_m_map ".
											"WHERE kd = '$x_kd_map'");
	$rdt4 = mysql_fetch_assoc($qdt4);
	$dt4_map = balikin($rdt4['map']);

	echo '<select name="map">
	<option value="'.$x_kd_map.'" selected>'.$dt4_map.'</option>';

	//daftar
	$qru = mysql_query("SELECT * FROM surat_m_map ".
								"ORDER BY map ASC");
	$rru = mysql_fetch_assoc($qru);

	do
		{
		//nilai
		$ru_kd = nosql($rru['kd']);
		$ru_map = balikin($rru['map']);

		echo '<option value="'.$ru_kd.'">'.$ru_map.'</option>';
		}
	while ($rru = mysql_fetch_assoc($qru));

	echo'</select>
	</p>
	<br>


	<input name="page" type="hidden" value="'.$page.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="sukd" type="hidden" value="'.$sukd.'">
	<input name="no_urut" type="hidden" value="'.$cc_no_urut.'">
	<input name="btnSMP" type="submit" value="SIMPAN">
	<input name="btnBTL" type="submit" value="BATAL">

	<br>';
	}


//daftar surat //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT * FROM surat_keluar ".
						"ORDER BY round(no_urut) DESC";
	$sqlresult = $sqlcount;

	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);


	if ($count != 0)
		{
		echo '<p>
		<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="1">&nbsp;</td>
		<td width="50"><strong><font color="'.$warnatext.'">No. Urut</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">No. Surat</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Tujuan</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Tgl. Surat</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Perihal</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Tgl. kirim</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Klasifikasi</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Sifat</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Status</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Balasan</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Ruang</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Lemari</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Rak</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">MAP</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Disposisi</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Sah</font></strong></td>
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

			$nomer = $nomer + 1;
			$i_kd = nosql($data['kd']);
			$i_no_urut = nosql($data['no_urut']);
			$i_no_surat = balikin2($data['no_surat']);
			$i_tujuan = balikin2($data['tujuan']);
			$i_tgl_surat = $data['tgl_surat'];
			$i_perihal = balikin2($data['perihal']);
			$i_tgl_kirim = $data['tgl_kirim'];

			$ku_kd_klasifikasi = nosql($data['kd_klasifikasi']);
			$ku_kd_sifat = nosql($data['kd_sifat']);
			$ku_kd_status = nosql($data['kd_status']);
			$ku_balas = nosql($data['balas']);
			$ku_tgl_surat = $data['tgl_surat'];
			$ku_tgl_kirim = $data['tgl_kirim'];
			$ku_kd_ruang = nosql($data['kd_ruang']);
			$ku_kd_lemari = nosql($data['kd_lemari']);
			$ku_kd_rak = nosql($data['kd_rak']);
			$ku_kd_map = nosql($data['kd_map']);


			//balas...?
			if ($ku_balas == "true")
				{
				$ku_balas_ket = "<font color=\"blue\">Sudah Dibalas.</font>";
				}
			else if ($ku_balas == "false")
				{
				$ku_balas_ket = "<font color=\"red\"><b>Belum Dibalas.</b></font>";
				}




			//klasifikasi
			$qdtx = mysql_query("SELECT * FROM surat_m_klasifikasi ".
											"WHERE kd = '$ku_kd_klasifikasi'");
			$rdtx = mysql_fetch_assoc($qdtx);
			$dtx_klasifikasi = balikin($rdtx['klasifikasi']);

			//sifat
			$qdtx2 = mysql_query("SELECT * FROM surat_m_sifat ".
											"WHERE kd = '$ku_kd_sifat'");
			$rdtx2 = mysql_fetch_assoc($qdtx2);
			$dtx2_sifat = balikin($rdtx2['sifat']);

			//status
			$qdtx3 = mysql_query("SELECT * FROM surat_m_status ".
											"WHERE kd = '$ku_kd_status'");
			$rdtx3 = mysql_fetch_assoc($qdtx3);
			$dtx3_status = balikin($rdtx3['status']);


			//ruang
			$qdt1 = mysql_query("SELECT * FROM surat_m_ruang ".
											"WHERE kd = '$ku_kd_ruang'");
			$rdt1 = mysql_fetch_assoc($qdt1);
			$dt1_ruang = balikin($rdt1['ruang']);


			//lemari
			$qdt2 = mysql_query("SELECT * FROM surat_m_lemari ".
											"WHERE kd = '$ku_kd_lemari'");
			$rdt2 = mysql_fetch_assoc($qdt2);
			$dt2_lemari = balikin($rdt2['lemari']);


			//rak
			$qdt3 = mysql_query("SELECT * FROM surat_m_rak ".
											"WHERE kd = '$ku_kd_rak'");
			$rdt3 = mysql_fetch_assoc($qdt3);
			$dt3_rak = balikin($rdt3['rak']);


			//map
			$qdt4 = mysql_query("SELECT * FROM surat_m_map ".
											"WHERE kd = '$ku_kd_map'");
			$rdt4 = mysql_fetch_assoc($qdt4);
			$dt4_map = balikin($rdt4['map']);



			//pengesahan disposisi
			$qdux = mysql_query("SELECT * FROM surat_keluar_disposisi ".
						"WHERE kd_surat = '$i_kd'");
			$rdux = mysql_fetch_assoc($qdux);
			$tdux = mysql_num_rows($qdux);
			$dux_pengesahan = nosql($rdux['pengesahan']);


			//sah...?
			if ($dux_pengesahan == "true")
				{
				$dux_pengesahan_ket = "<font color=\"blue\"><strong>SAH</strong>.</font>";
				}
			else
				{
				$dux_pengesahan_ket = "<font color=\"red\"><b>Belum Sah.</b></font>";
				}




			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
			</td>
			<td>
			<a href="'.$filenya.'?page='.$page.'&s=edit&sukd='.$i_kd.'" title="EDIT">
			<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0">
			</a>
			</td>
			<td>'.$i_no_urut.'</td>
			<td>'.$i_no_surat.'</td>
			<td>'.$i_tujuan.'</td>
			<td>'.$i_tgl_surat.'</td>
			<td>'.$i_perihal.'</td>
			<td>'.$i_tgl_kirim.'</td>
			<td>'.$dtx_klasifikasi.'</td>
			<td>'.$dtx2_sifat.'</td>
			<td>'.$dtx3_status.'</td>
			<td>'.$ku_balas_ket.'</td>
			<td>'.$dt1_ruang.'</td>
			<td>'.$dt2_lemari.'</td>
			<td>'.$dt3_rak.'</td>
			<td>'.$dt4_map.'</td>
			<td>
			<a href="keluar_disposisi.php?sukd='.$i_kd.'">
			<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0">
			</a>
			</td>
			<td>'.$dux_pengesahan_ket.'</td>
			</tr>';
			}
		while ($data = mysql_fetch_assoc($result));

		echo '</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="300">
		<input name="page" type="hidden" value="'.$page.'">
		<input name="s" type="hidden" value="'.$s.'">
		<input name="sukd" type="hidden" value="'.$sukd.'">
		<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$limit.')">
		<input name="btnBTL" type="reset" value="BATAL">
		<input name="btnHPS" type="submit" value="HAPUS">
		</td>
		<td align="right">Total : <strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
		</tr>
		</table>
		</p>';
		}

	//null
	else
		{
		echo '<p>
		<font color="red"><strong>TIDAK ADA DATA SURAT KELUAR</strong></font>
		<p>';
		}
	}

echo '<br>
<br>
<br>
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