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

//fungsi2
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admbaak.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "mhs_kartu_ujian.php";
$judul = "Kartu Ujian";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$jnskd = nosql($_REQUEST['jnskd']);
$smtkd = nosql($_REQUEST['smtkd']);
$mskd = nosql($_REQUEST['mskd']);
$mkkd = nosql($_REQUEST['mkkd']);
$utgl = nosql($_REQUEST['utgl']);
$ubln = nosql($_REQUEST['ubln']);
$uthn = nosql($_REQUEST['uthn']);
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&jnskd=$jnskd&smtkd=$smtkd&page=$page";




//PROSES //////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$jnskd = nosql($_POST['jnskd']);
	$smtkd = nosql($_POST['smtkd']);
	$rukd = nosql($_POST['rukd']);
	$mskd = nosql($_POST['mskd']);
	$mkkd = nosql($_POST['mkkd']);
	$s = nosql($_POST['s']);
	$jml = nosql($_POST['jml']);
	$jam1 = nosql($_POST['jam1']);
	$mnt1 = nosql($_POST['mnt1']);
	$jam_1 = "$jam1:$mnt1";
	$jam2 = nosql($_POST['jam2']);
	$mnt2 = nosql($_POST['mnt2']);
	$jam_2 = "$jam2:$mnt2";
	$utglx = nosql($_POST['utgl']);
	$ublnx = nosql($_POST['ubln']);
	$uthnx = nosql($_POST['uthn']);
	$tgl_uji = "$uthnx:$ublnx:$utglx";


	//jika edit
	if ($s == "edit")
		{
		//cek
		$qcc = mysql_query("SELECT * FROM ku ".
					"WHERE kd_progdi = '$progdi' ".
					"AND kd_kelas = '$kelkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND jenis = '$jnskd' ".
					"AND kd_smt = '$smtkd' ".
					"AND kd_makul = '$mkkd'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);


		//jika ada, edit
		if ($tcc != 0)
			{
			mysql_query("UPDATE ku SET tgl_uji = '$tgl_uji', ".
					"jam1 = '$jam_1', ".
					"jam2 = '$jam_2' ".
					"WHERE kd_progdi = '$progdi' ".
					"AND kd_kelas = '$kelkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND jenis = '$jnskd' ".
					"AND kd_smt = '$smtkd' ".
					"AND kd_makul = '$mkkd'");
			}
		else
			{
			mysql_query("INSERT INTO ku (kd, kd_progdi, kd_kelas, kd_tapel, jenis, kd_smt, kd_makul, ".
					"tgl_uji, jam1, jam2) VALUES ".
					"('$x', '$progdi', '$kelkd', '$tapelkd', '$jnskd', '$smtkd', '$mkkd', ".
					"'$tgl_uji', '$jam_1', '$jam_2')");
			}


		//re-direct
		$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&jnskd=$jnskd&smtkd=$smtkd&tapelkd=$tapelkd";
		xloc($ke);
		exit();
		}






	//jika penempatan
	if ($s == "tempat")
		{
		//data siswa
		$qdata = mysql_query("SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
					"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
					"FROM m_mahasiswa, mahasiswa_kelas ".
					"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
					"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
					"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
					"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
					"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
					"ORDER BY round(m_mahasiswa.nim) ASC");
		$rdata = mysql_fetch_assoc($qdata);
		$tdata = mysql_num_rows($qdata);

		do
			{
			//nilai
			$i = $i + 1;
			$imskd = nosql($rdata['mskd']);
			$imkkd = nosql($rdata['mkkd']);

			$xkd = "item";
			$xkd1 = "$xkd$i";
			$xkdx = nosql($_POST["$xkd1"]);



			//detail tanggal dan waktu ujian
			$qdtx = mysql_query("SELECT ku.*, DATE_FORMAT(tgl_uji, '%m') AS bln, ".
						"DATE_FORMAT(tgl_uji, '%y') AS thn ".
						"FROM ku ".
						"WHERE kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND jenis = '$jnskd'");
			$rdtx = mysql_fetch_assoc($qdtx);
			$tdtx = mysql_num_rows($qdtx);
			$dtx_bln = nosql($rdtx['bln']);
			$dtx_thn = nosql($rdtx['thn']);

			//ciptakan no.ujian
			$no_ujian = "$i/$jnskd/$arrbln3[$dtx_bln]/$dtx_thn";

			//berikan nomor ujian
			mysql_query("UPDATE ku_mahasiswa SET no_ujian = '$no_ujian' ".
					"WHERE kd_mahasiswa = '$imskd' ".
					"AND kd_progdi = '$progdi' ".
					"AND kd_kelas = '$kelkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND jenis = '$jnskd' ".
					"AND kd_smt = '$smtkd'");



			//cek
			$qcc = mysql_query("SELECT * FROM ku_mahasiswa ".
						"WHERE kd_mahasiswa = '$xkdx' ".
						"AND kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND jenis = '$jnskd' ".
						"AND kd_smt = '$smtkd'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);


			//jika ada
			if ($tcc != 0)
				{
				$cc_kd = nosql($rcc['kd']);


				//jika ada,
				if ($tcc != 0)
					{
					mysql_query("UPDATE ku_mahasiswa SET kd_ruang = '$rukd' ".
							"WHERE kd_mahasiswa = '$xkdx' ".
							"AND kd_progdi = '$progdi' ".
							"AND kd_kelas = '$kelkd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND jenis = '$jnskd' ".
							"AND kd_smt = '$smtkd'");
					}
				else
					{
					mysql_query("INSERT INTO ku_mahasiswa (kd, kd_progdi, kd_kelas, ".
							"kd_tapel, kd_smt, jenis, kd_mahasiswa, kd_ruang) VALUES ".
							"('$x', '$progdi', '$kelkd', ".
							"'$tapelkd', '$smtkd', '$jnskd', '$xkdx', '$rukd')");
					}
				}
			}
		while ($rdata = mysql_fetch_assoc($qdata));


		//re-direct
		$ke = "$filenya?s=tempat&jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&smtkd=$smtkd&tapelkd=$tapelkd";
		xloc($ke);
		exit();
		}



	//jika set jumlah max.mahasiswa pada ruang ujian
	if ($s == "jumlah")
		{
		for ($k=1;$k<=$jml;$k++)
			{
			//ambil nilai
			$xyz = md5("$x$k");

			$yuk = "jkd";
			$yuhu = "$k$yuk";
			$i_kd = nosql($_POST["$yuhu"]);

			$yuk2 = "jumlah";
			$yuhu2 = "$k$yuk2";
			$i_jml = nosql($_POST["$yuhu2"]);


			//cek
			$qcc = mysql_query("SELECT ku_ruang.* ".
						"FROM ku_ruang ".
						"WHERE kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND jenis = '$jnskd' ".
						"AND kd_ruang = '$i_kd'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//jika ada, update
			if ($tcc != 0)
				{
				mysql_query("UPDATE ku_ruang SET jumlah = '$i_jml' ".
						"WHERE kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND jenis = '$jnskd' ".
						"AND kd_ruang = '$i_kd'");
				}
			else
				{
				mysql_query("INSERT INTO ku_ruang (kd, kd_progdi, kd_kelas, kd_tapel, kd_smt, jenis, kd_ruang, jumlah) VALUES ".
						"('$xyz', '$progdi', '$kelkd', '$tapelkd', '$smtkd', '$jnskd', '$i_kd', '$i_jml')");
				}

			}


		//re-direct
		$ke = "$filenya?s=jumlah&jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&smtkd=$smtkd&tapelkd=$tapelkd";
		xloc($ke);
		exit();
		}
	}





//jika batal
if ($_POST['btnBTL'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$jnskd = nosql($_POST['jnskd']);
	$smtkd = nosql($_POST['smtkd']);
	$rukd = nosql($_POST['rukd']);
	$mskd = nosql($_POST['mskd']);
	$mkkd = nosql($_POST['mkkd']);
	$s = nosql($_POST['s']);


	//re-direct
	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&jnskd=$jnskd&smtkd=$smtkd&tapelkd=$tapelkd";
	xloc($ke);
	exit();
	}





//jika Cetak suatu ruang kelas.
if ($_POST['btnCTK'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$jnskd = nosql($_POST['jnskd']);
	$smtkd = nosql($_POST['smtkd']);
	$rukd2 = nosql($_POST['rukd2']);
	$mskd = nosql($_POST['mskd']);
	$mkkd = nosql($_POST['mkkd']);
	$s = nosql($_POST['s']);



	if ($s == "tempat")
		{
		//cek
		if (empty($rukd2))
			{
			$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!";
			$ke = "$filenya?s=tempat&jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&smtkd=$smtkd&tapelkd=$tapelkd";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//re-direct
			$ke = "mhs_kartu_ujian_all_prt.php?progdi=$progdi&kelkd=$kelkd&rukd=$rukd2&jnskd=$jnskd&smtkd=$smtkd&tapelkd=$tapelkd";
			xloc($ke);
			exit();
			}
		}
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////






//focus...
if (empty($progdi))
	{
	$diload = "document.formx.progdi.focus();";
	}
else if (empty($kelkd))
	{
	$diload = "document.formx.kelas.focus();";
	}
else if (empty($tapelkd))
	{
	$diload = "document.formx.tapel.focus();";
	}
else if (empty($jnskd))
	{
	$diload = "document.formx.jenis.focus();";
	}
else if (empty($smtkd))
	{
	$diload = "document.formx.smt.focus();";
	}





//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/menu/admbaak.php");
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

echo '<option value="'.$tpx_kd.'" selected>'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysql_query("SELECT * FROM m_tapel ".
			"WHERE kd <> '$tapelkd' ".
			"ORDER BY tahun1 DESC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tp_kd = nosql($rowtp['kd']);
	$tp_thn1 = nosql($rowtp['tahun1']);
	$tp_thn2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tp_kd.'">'.$tp_thn1.'/'.$tp_thn2.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>,


Ujian : ';
echo "<select name=\"jenis\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$jnskd.'" selected>'.$jnskd.'</option>
<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&jnskd=UTS">UTS</option>
<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&jnskd=UAS">UAS</option>
</select>,


Semester : ';
echo "<select name=\"smt\" onChange=\"MM_jumpMenu('self',this,0)\">";

//smt
$qstxy = mysql_query("SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysql_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);


echo '<option value="'.$smtkd.'" selected>'.$smt.'</option>';

$qst = mysql_query("SELECT * FROM m_smt ".
			"WHERE kd <> '$smtkd'");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$stkd = nosql($rowst['kd']);
	$stsmt = nosql($rowst['smt']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&jnskd='.$jnskd.'&smtkd='.$stkd.'&tapelkd='.$tapelkd.'">'.$stsmt.'</option>';
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>
</td>
</tr>
</table>
<br>';


//nek blm dipilih
if (empty($progdi))
	{
	echo '<p>
	<b>
	<font color="#FF0000"><strong>PROGRAM STUDI Belum Dipilih...!</strong></font>
	</b>
	</p>';
	}
else if (empty($kelkd))
	{
	echo '<p>
	<b>
	<font color="#FF0000"><strong>JENIS Belum Dipilih...!</strong></font>
	</b>
	</p>';
	}
else if (empty($tapelkd))
	{
	echo '<p>
	<b>
	<font color="#FF0000"><strong>TAHUN AKADEMIK Belum Dipilih...!</strong></font>
	</b>
	</p>';
	}
else if (empty($jnskd))
	{
	echo '<p>
	<b>
	<font color="#FF0000"><strong>JENIS UJIAN Belum Dipilih...!</strong></font>
	</b>
	</p>';
	}
else if (empty($smtkd))
	{
	echo '<p>
	<b>
	<font color="#FF0000"><strong>SEMESTER Belum Dipilih...!</strong></font>
	</b>
	</p>';
	}
else
	{
	//jika edit
	if ($s == "edit")
		{
		//makul-nya
		$qkulo = mysql_query("SELECT m_makul_smt.*,m_makul.* ".
					"FROM m_makul_smt, m_makul ".
					"WHERE m_makul_smt.kd_makul = m_makul.kd ".
					"AND m_makul.kd_progdi = '$progdi' ".
					"AND m_makul_smt.kd_tapel = '$tapelkd' ".
					"AND m_makul_smt.kd_smt = '$smtkd' ".
					"AND m_makul_smt.kd = '$mskd' ".
					"AND m_makul.kd = '$mkkd'");
		$rkulo = mysql_fetch_assoc($qkulo);
		$tkulo = mysql_num_rows($qkulo);
		$kulo_makul = balikin($rkulo['nama']);


		echo '<p>
		Nama Mata Ujian :
		<br>
		<strong>'.$kulo_makul.'</strong>
		</p>

		<p>
		Tanggal Pelaksanaan :
		<br>';
		echo "<select name=\"utglx\" onChange=\"MM_jumpMenu('self',this,0)\">";
		echo '<option value="'.$utgl.'" selected>'.$utgl.'</option>';
		for ($i=1;$i<=31;$i++)
			{
			echo '<option value="'.$filenya.'?s=edit&jnskd='.$jnskd.'&mkkd='.$mkkd.'&mskd='.$mskd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'&utgl='.$i.'">'.$i.'</option>';
			}

		echo '</select>';
		echo "<select name=\"ublnx\" onChange=\"MM_jumpMenu('self',this,0)\">";
		echo '<option value="'.$ubln.''.$uthn.'" selected>'.$arrbln[$ubln].' '.$uthn.'</option>';
		for ($i=1;$i<=12;$i++)
			{
			//nilainya
			if ($i<=7) //bulan agustus sampai desember
				{
				$ibln = $i + 7;
				
				//jika lebih
				if ($ibln == 13)
					{
					$ibln = 1;
					$tpx_thnx = $tpx_thn2;
					}
				else if ($ibln == 14)
					{
					$ibln = 2;
					$tpx_thnx = $tpx_thn2;
					}
				else 
					{
					$tpx_thnx = $tpx_thn1;
					}

				echo '<option value="'.$filenya.'?s=edit&jnskd='.$jnskd.'&mkkd='.$mkkd.'&mskd='.$mskd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'&utgl='.$utgl.'&ubln='.$ibln.'&uthn='.$tpx_thn1.'">'.$arrbln[$ibln].' '.$tpx_thnx.'</option>';
				}

			else if ($i>7) //bulan pebruari sampai juli
				{
				$ibln = $i - 5;

				echo '<option value="'.$filenya.'?s=edit&jnskd='.$jnskd.'&mkkd='.$mkkd.'&mskd='.$mskd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'&utgl='.$utgl.'&ubln='.$ibln.'&uthn='.$tpx_thn2.'">'.$arrbln[$ibln].' '.$tpx_thn2.'</option>';
				}
			}

		echo '</select>
		</p>

		<p>
		Waktu Pelaksanaan :
		<br>
		<input name="jam1" type="text" value="'.$kulo_jam1.'" size="2" maxlength="2" onKeyPress="return numbersonly(this, event)">.
		<input name="mnt1" type="text" value="'.$kulo_mnt1.'" size="2" maxlength="2" onKeyPress="return numbersonly(this, event)"> -
		<input name="jam2" type="text" value="'.$kulo_jam2.'" size="2" maxlength="2" onKeyPress="return numbersonly(this, event)">.
		<input name="mnt2" type="text" value="'.$kulo_mnt2.'" size="2" maxlength="2" onKeyPress="return numbersonly(this, event)">
		</p>

		<p>
		<INPUT type="hidden" name="mkkd" value="'.$mkkd.'">
		<INPUT type="hidden" name="mskd" value="'.$mskd.'">
		<INPUT type="hidden" name="progdi" value="'.$progdi.'">
		<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
		<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
		<INPUT type="hidden" name="jnskd" value="'.$jnskd.'">
		<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
		<INPUT type="hidden" name="utgl" value="'.$utgl.'">
		<INPUT type="hidden" name="ubln" value="'.$ubln.'">
		<INPUT type="hidden" name="uthn" value="'.$uthn.'">
		<INPUT type="hidden" name="s" value="'.$s.'">
		<INPUT type="submit" name="btnSMP" value="SIMPAN">
		<INPUT type="submit" name="btnBTL" value="BATAL">
		</p>';
		}

	//jika penempatan mahasiswa
	else if ($s == "tempat")
		{
		echo '<p>
		<strong>Penempatan Ruang Kelas Ujian Mahasiswa</strong>.
		[<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&jnskd='.$jnskd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'">Daftar Mata Ujian</a>].
		</p>';


		//query
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
				"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
				"ORDER BY round(m_mahasiswa.nim) ASC";
		$sqlresult = $sqlcount;


		$count = mysql_num_rows(mysql_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?s=tempat&jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&smtkd=$smtkd&tapelkd=$tapelkd";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysql_fetch_array($result);



		//daftar ruang
		echo '<select name="rukd2">
		<option value="" selected>-Kelas-</option>';

		$qbt = mysql_query("SELECT * FROM m_ruang ".
					"ORDER BY ruang ASC");
		$rowbt = mysql_fetch_assoc($qbt);

		do
			{
			$btkd = nosql($rowbt['kd']);
			$btruang = balikin($rowbt['ruang']);


			//jumlah mahasiswanya
			$qjum = mysql_query("SELECT * FROM ku_mahasiswa ".
						"WHERE kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND jenis = '$jnskd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_ruang = '$btkd'");
			$rjum = mysql_fetch_assoc($qjum);
			$tjum = mysql_num_rows($qjum);


			//max.
			$qcc1 = mysql_query("SELECT ku_ruang.* ".
						"FROM ku_ruang ".
						"WHERE kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND jenis = '$jnskd' ".
						"AND kd_ruang = '$btkd'");
			$rcc1 = mysql_fetch_assoc($qcc1);
			$cc1_max = nosql($rcc1['jumlah']);




			echo '<option value="'.$btkd.'">'.$btruang.' [Jumlah : '.$tjum.']. [Max.:'.$cc1_max.'].</option>';
			}
		while ($rowbt = mysql_fetch_assoc($qbt));

		echo '</select>
		<input name="btnCTK" type="submit" value="PRINT>>">


		<table width="500" border="1" cellpadding="3" cellspacing="0">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="50"><strong>NIM</strong></td>
		<td><strong>Nama</strong></td>
		<td width="50"><strong>Kelas</strong></td>
		<td width="100"><strong>No.Ujian</strong></td>
		<td width="1">&nbsp;</td>
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
				$i_nim = nosql($data['nim']);


				//detail
				$qdt = mysql_query("SELECT * FROM m_mahasiswa ".
							"WHERE nim = '$i_nim'");
				$rdt = mysql_fetch_assoc($qdt);
				$dt_kd = nosql($rdt['kd']);
				$dt_nama = balikin($rdt['nama']);
				$i_kd = $dt_kd;
				$i_nama = $dt_nama;


				//ruang e
				$qjumx = mysql_query("SELECT ku_mahasiswa.*, m_ruang.* ".
							"FROM ku_mahasiswa, m_ruang ".
							"WHERE ku_mahasiswa.kd_ruang = m_ruang.kd ".
							"AND ku_mahasiswa.kd_progdi = '$progdi' ".
							"AND ku_mahasiswa.kd_kelas = '$kelkd' ".
							"AND ku_mahasiswa.kd_tapel = '$tapelkd' ".
							"AND ku_mahasiswa.jenis = '$jnskd' ".
							"AND ku_mahasiswa.kd_smt = '$smtkd' ".
							"AND ku_mahasiswa.kd_mahasiswa = '$i_kd'");
				$rjumx = mysql_fetch_assoc($qjumx);
				$tjumx = mysql_num_rows($qjumx);
				$jumx_ruang = balikin($rjumx['ruang']);
				$jumx_noujian = balikin($rjumx['no_ujian']);


				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>
				<input name="kd'.$nomer.'" type="hidden" value="'.$i_kd.'">
				<input name="item'.$nomer.'" type="checkbox" value="'.$i_kd.'">
				</td>
				<td>'.$i_nim.'</td>
				<td>'.$i_nama.'</td>
				<td>'.$jumx_ruang.'</td>
				<td>'.$jumx_noujian.'</td>
				<td>
				<a href="mhs_kartu_ujian_prt.php?s=tempat&jnskd='.$jnskd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'&mskd='.$i_kd.'" title="Print Kartu Ujian"><img src="'.$sumber.'/img/print.gif" border="0" width="16" height="16"></a>
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
		<input name="btnALL" type="button" onClick="checkAll('.$limit.')" value="SEMUA">
		<input name="btnBTL" type="reset" value="BATAL">';

		//daftar ruang
		echo '<select name="rukd">
		<option value="" selected>-Kelas-</option>';

		$qbt = mysql_query("SELECT * FROM m_ruang ".
					"ORDER BY ruang ASC");
		$rowbt = mysql_fetch_assoc($qbt);

		do
			{
			$btkd = nosql($rowbt['kd']);
			$btruang = balikin($rowbt['ruang']);


			//jumlah mahasiswanya
			$qjum = mysql_query("SELECT * FROM ku_mahasiswa ".
						"WHERE kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND jenis = '$jnskd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_ruang = '$btkd'");
			$rjum = mysql_fetch_assoc($qjum);
			$tjum = mysql_num_rows($qjum);


			//max.
			$qcc1 = mysql_query("SELECT ku_ruang.* ".
						"FROM ku_ruang ".
						"WHERE kd_progdi = '$progdi' ".
						"AND kd_kelas = '$kelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND jenis = '$jnskd' ".
						"AND kd_ruang = '$btkd'");
			$rcc1 = mysql_fetch_assoc($qcc1);
			$cc1_max = nosql($rcc1['jumlah']);


			//jika penuh
			if ($cc1_max == $tjum)
				{
				$i_ket = "Penuh.";
				}
			else if ($tjum > $cc1_max)
				{
				$i_ket = "OVER.";
				}
			else
				{
				$i_ket = "Sisa Tempat.";
				}


			echo '<option value="'.$btkd.'">'.$btruang.' [Jumlah : '.$tjum.']. [Max.:'.$cc1_max.']. ['.$i_ket.'].</option>';
			}
		while ($rowbt = mysql_fetch_assoc($qbt));

		echo '</select>
		<input name="btnSMP" type="submit" value="TEMPATKAN >>">
		<input name="jml" type="hidden" value="'.$limit.'">
		<INPUT type="hidden" name="progdi" value="'.$progdi.'">
		<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
		<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
		<INPUT type="hidden" name="jnskd" value="'.$jnskd.'">
		<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
		<INPUT type="hidden" name="s" value="'.$s.'">
		<input name="page" type="hidden" value="'.$page.'">
		</td>
		</tr>
		</table>';
		}





	//jika set jumlah max. dalam suatu ruang
	else if ($s == "jumlah")
		{
		echo '<p>
		<strong>Jumlah Max.Peserta pada Ruang Kelas Ujian</strong>.
		[<a href="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&jnskd='.$jnskd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'">Daftar Mata Ujian</a>].
		</p>
		
		
		<p>
		Nama Ruang Kelas Ujian : 
		<br>
		<input name="ruangku" type="text" value="'.$e_ruangku.'" size="20">
		</p>
		
		<p>
		Daya Tampung : 
		<br>
		<input name="dayatampung" type="text" value="'.$e_dayatampung.'" size="5">
		</p>
		
		<p>
		<input name="s" type="hidden" value="'.$s.'">
		<input name="kd" type="hidden" value="'.$kdx.'">
		<input name="btnSMPBR" type="submit" value="ENTRI BARU">				
		</p>
		<br>';


		//daftar ruang
		$qbt = mysql_query("SELECT * FROM ku_ruang ".
								"WHERE kd_progdi = '$progdi' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND jenis = '$jnskd' ".
								"ORDER BY nama ASC");
		$rowbt = mysql_fetch_assoc($qbt);
		$tbt = mysql_num_rows($qbt);

		echo '<table width="300" border="1" cellpadding="3" cellspacing="0">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td><strong>Nama Ruang Kelas</strong></td>
		<td width="10"><strong>Jumlah</strong></td>
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
			$btkd = nosql($rowbt['kd']);
			$btruang = balikin($rowbt['nama']);
			$btjml = nosql($rowbt['jumlah']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$btkd.'">
       		</td>
       		<td>
			<INPUT type="hidden" name="'.$nomer.'jkd" value="'.$btkd.'">
			'.$btruang.'
			</td>
			<td>
			<input name="'.$nomer.'jumlah" type="text" value="'.$btjml.'" size="4" maxlength="5" onKeyPress="return numbersonly(this, event)">
			</td>
			</tr>';
			}
		while ($rowbt = mysql_fetch_assoc($qbt));

		echo '</table>

		<table width="300" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		<input name="btnHPS" type="submit" value="HAPUS">
		<input name="btnSMP2" type="submit" value="SIMPAN">
		<input name="jml" type="hidden" value="'.$tbt.'">
		<INPUT type="hidden" name="progdi" value="'.$progdi.'">
		<INPUT type="hidden" name="kelkd" value="'.$kelkd.'">
		<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
		<INPUT type="hidden" name="jnskd" value="'.$jnskd.'">
		<INPUT type="hidden" name="smtkd" value="'.$smtkd.'">
		<INPUT type="hidden" name="s" value="'.$s.'">
		<input name="page" type="hidden" value="'.$page.'">
		</td>
		</tr>
		</table>';
		}




	//jika daftar makul
	else
		{
		//daftar makul-nya
		$qkulo = mysql_query("SELECT m_makul_smt.*, m_makul_smt.kd AS mskd, ".
					"m_makul.*, m_makul.kd AS mkkd ".
					"FROM m_makul_smt, m_makul ".
					"WHERE m_makul_smt.kd_makul = m_makul.kd ".
					"AND m_makul.kd_progdi = '$progdi' ".
					"AND m_makul_smt.kd_tapel = '$tapelkd' ".
					"AND m_makul_smt.kd_smt = '$smtkd'");
		$rkulo = mysql_fetch_assoc($qkulo);
		$tkulo = mysql_num_rows($qkulo);

		//jika ada
		if ($tkulo != 0)
			{
			echo '[<a href="'.$filenya.'?s=tempat&jnskd='.$jnskd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'" title="Penempatan Ruang Kelas Ujian Mahasiswa">Penempatan Ruang Kelas Ujian Mahasiswa</a>].
			[<a href="'.$filenya.'?s=jumlah&jnskd='.$jnskd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&smtkd='.$smtkd.'&tapelkd='.$tapelkd.'" title="Jumlah Max. Peserta pada Ruang Kelas Ujian">Jumlah Max. Peserta pada Ruang Kelas Ujian</a>].
			<table width="700" border="1" cellspacing="0" cellpadding="3">
			<tr valign="top" bgcolor="'.$warnaheader.'">
			<td width="1">&nbsp;</td>
			<td width="100"><strong><font color="'.$warnatext.'">Hari/Tanggal</font></strong></td>
			<td width="100"><strong><font color="'.$warnatext.'">Waktu</font></strong></td>
			<td><strong><font color="'.$warnatext.'">Mata Ujian</font></strong></td>
			<td width="100"><strong><font color="'.$warnatext.'">Paraf</font></strong></td>
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
				$kulo_mskd = nosql($rkulo['mskd']);
				$kulo_mkkd = nosql($rkulo['mkkd']);
				$kulo_nama = balikin($rkulo['nama']);



				//detail tanggal dan waktu ujian
				$qdt = mysql_query("SELECT ku.*, DATE_FORMAT(tgl_uji, '%d') AS tgl, ".
							"DATE_FORMAT(tgl_uji, '%m') AS bln, ".
							"DATE_FORMAT(tgl_uji, '%Y') AS thn, ".
							"DATE_FORMAT(jam1, '%H') AS jam1, ".
							"DATE_FORMAT(jam1, '%i') AS mnt1, ".
							"DATE_FORMAT(jam2, '%H') AS jam2, ".
							"DATE_FORMAT(jam2, '%i') AS mnt2 ".
							"FROM ku ".
							"WHERE kd_progdi = '$progdi' ".
							"AND kd_kelas = '$kelkd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd' ".
							"AND kd_makul = '$kulo_mkkd'");
				$rdt = mysql_fetch_assoc($qdt);
				$tdt = mysql_num_rows($qdt);
				$dt_kd = nosql($rdt['kd']);
				$dt_uji_tgl = nosql($rdt['tgl']);
				$dt_uji_bln = nosql($rdt['bln']);
				$dt_uji_thn = nosql($rdt['thn']);
				$dt_tgl_uji = "$dt_uji_tgl-$dt_uji_bln-$dt_uji_thn";
				$dt_jam1 = nosql($rdt['jam1']);
				$dt_mnt1 = nosql($rdt['mnt1']);
				$dt_jam2 = nosql($rdt['jam2']);
				$dt_mnt2 = nosql($rdt['mnt2']);




				//ketahui harinya /////////////////////////////////////////////////////////////
				//jika gak null
				if ((!empty($dt_uji_tgl)) AND (!empty($dt_uji_bln)) AND (!empty($dt_uji_thn)))
					{
					$day = $dt_uji_tgl;
					$month = $dt_uji_bln;
					$year = $dt_uji_thn;


					//mencari hari
					$a = substr($year, 2);
						//mengambil dua digit terakhir tahun

					$b = (int)($a/4);
						//membagi tahun dengan 4 tanpa memperhitungkan sisa

					$c = $month;
						//mengambil angka bulan

					$d = $day;
						//mengambil tanggal

					$tot1 = $a + $b + $c + $d;
						//jumlah sementara, sebelum dikurangani dengan angka kunci bulan

					//kunci bulanan
					if ($c == 1)
						{
						$kunci = "2";
						}

					else if ($c == 2)
						{
						$kunci = "7";
						}

					else if ($c == 3)
						{
						$kunci = "1";
						}

					else if ($c == 4)
						{
						$kunci = "6";
						}

					else if ($c == 5)
						{
						$kunci = "5";
						}

					else if ($c == 6)
						{
						$kunci = "3";
						}

					else if ($c == 7)
						{
						$kunci = "2";
						}

					else if ($c == 8)
						{
						$kunci = "7";
						}

					else if ($c == 9)
						{
						$kunci = "5";
						}

					else if ($c == 10)
						{
						$kunci = "4";
						}

					else if ($c == 11)
						{
						$kunci = "2";
						}

					else if ($c == 12)
						{
						$kunci = "1";
						}

					$total = $tot1 - $kunci;

					//angka hari
					$hari = $total%7;

					//jika angka hari == 0, sebenarnya adalah 7.
					if ($hari == 0)
						{
						$hari = ($hari +7);
						}

					//kabisat, tahun habis dibagi empat alias tanpa sisa
					$kabisat = (int)$year % 4;

					if ($kabisat ==0)
						{
						$hri = $hri-1;
						}



					//hari ke-n
					if ($hari == 3)
						{
						$hri = 4;
						$dino = "Rabu";
						}

					else if ($hari == 4)
						{
						$hri = 5;
						$dino = "Kamis";
						}

					else if ($hari == 5)
						{
						$hri = 6;
						$dino = "Jum'at";
						}

					else if ($hari == 6)
						{
						$hri = 7;
						$dino = "Sabtu";
						}

					else if ($hari == 7)
						{
						$hri = 1;
						$dino = "Minggu";
						}

					else if ($hari == 1)
						{
						$hri = 2;
						$dino = "Senin";
						}

					else if ($hari == 2)
						{
						$hri = 3;
						$dino = "Selasa";
						}
					}
				else
					{
					$dino = "";
					}



				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>
				<a href="'.$filenya.'?progdi='.$progdi.'&tapelkd='.$tapelkd.'&kelkd='.$kelkd.'&jnskd='.$jnskd.'&smtkd='.$smtkd.'&mkkd='.$kulo_mkkd.'&s=edit&mskd='.$kulo_mskd.'">
				<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0">
				</a>
				</td>
				<td>
				'.$dino.'
				<br>
				'.$dt_tgl_uji.'
				</td>
				<td>'.$dt_jam1.':'.$dt_mnt1.' - '.$dt_jam2.':'.$dt_mnt2.'</td>
				<td>'.$kulo_nama.'</td>
				<td>&nbsp;</td>
				</tr>';
				}
			while ($rkulo = mysql_fetch_assoc($qkulo));


			echo '</table>';
			}

		else
			{
			echo '<p>
			<font color="red">
			<strong>Tidak Ada Data Mata Kuliah</strong>.
			</font>
			</p>';
			}
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