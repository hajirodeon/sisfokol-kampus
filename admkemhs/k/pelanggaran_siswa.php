<?php
session_start();

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admkemhs.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");


nocache;

//nilai
$filenya = "pelanggaran_siswa.php";
$judul = "Pelanggaran Mahasiswa";
$judulku = "[$kemhs_session : $nip4_session. $nm4_session] ==> $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$kelkd = nosql($_REQUEST['kelkd']);
$kdx = nosql($_REQUEST['kdx']);
$utgl = nosql($_REQUEST['utgl']);
$ubln = nosql($_REQUEST['ubln']);
$uthn = nosql($_REQUEST['uthn']);
$nim = nosql($_REQUEST['nim']);
$jnskd = nosql($_REQUEST['jnskd']);
$pelkd = nosql($_REQUEST['pelkd']);
$s = nosql($_REQUEST['s']);
$a = nosql($_REQUEST['a']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&page=$page";




//focus...
if (empty($tapelkd))
	{
	$diload = "document.formx.tapel.focus();";
	}
else if (empty($kelkd))
	{
	$diload = "document.formx.kelas.focus();";
	}
else
	{
	if (empty($utgl))
		{
		$diload = "document.formx.utglx.focus();";
		}
	else if (empty($ubln))
		{
		$diload = "document.formx.ublnx.focus();";
		}
	else if (empty($nim))
		{
		$diload = "document.formx.nim.focus();";
		}
	}






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika hapus daftar seorang siswa.
if ($s == "hapus")
	{
	//nilai
	$tapelkd = nosql($_REQUEST['tapelkd']);
	$kelkd = nosql($_REQUEST['kelkd']);
	$pkd = nosql($_REQUEST['pkd']);

	mysqli_query($koneksi, "DELETE FROM mahasiswa_pelanggaran ".
			"WHERE kd = '$pkd'");


	//re-direct
	$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd";
	xloc($ke);
	exit();
	}







//jika hapus
if ($_POST['btnHPS'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$ikd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM mahasiswa_pelanggaran ".
				"WHERE kd_mahasiswa = '$ikd'");
		}


	//re-direct
	$ke = "$filenya?tapelkd=$tapelkd";
	xloc($ke);
	exit();
	}





//jika batal
if ($_POST['btnBTL'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);

	//re-direct
	$ke = "$filenya?tapelkd=$tapelkd";
	xloc($ke);
	exit();
	}




//jika simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$kelkd = nosql($_POST['kelkd']);
	$utgl = nosql($_POST['utgl']);
	$ubln = nosql($_POST['ubln']);
	$uthn = nosql($_POST['uthn']);
	$tgl_entry = "$uthn:$ubln:$utgl";
	$nim = nosql($_POST['nim']);
	$s = nosql($_POST['s']);
	$kdx = nosql($_POST['kdx']);



	//cek
	if (empty($nim))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!";
		$ke = "$filenya?s=$s&tapelkd=$tapelkd&kelkd=$kelkd&utgl=$utgl&ubln=$ubln&uthn=$uthn";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//jika baru
		if ($s == "baru")
			{
			//cek
			$qcc = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
						"WHERE nim = '$nim'");
			$rcc = mysqli_fetch_assoc($qcc);
			$tcc = mysqli_num_rows($qcc);
			$cc_kd = nosql($rcc['kd']);

			//nek ada
			if ($tcc != 0)
				{
				mysqli_query($koneksi, "INSERT INTO mahasiswa_pelanggaran (kd, kd_tapel, kd_kelas, kd_mahasiswa, ".
						"tgl, postdate) VALUES ".
						"('$x', '$tapelkd', '$kelkd', '$cc_kd', ".
						"'$tgl_entry', '$today')");

				//re-direct
				$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&utgl=$utgl&ubln=$ubln&uthn=$uthn";
				xloc($ke);
				exit();
				}
			else
				{
				//re-direct
				$pesan = "Tidak Ada Siswa dengan nim : $nim. Harap Diperhatikan...!!";
				$ke = "$filenya?s=$s&tapelkd=$tapelkd&kelkd=$kelkd&utgl=$utgl&ubln=$ubln&uthn=$uthn";
				pekem($pesan,$ke);
				exit();
				}
			}

		else if ($s == "edit")
			{
			//cek
			$qcc = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
						"WHERE nim = '$nim'");
			$rcc = mysqli_fetch_assoc($qcc);
			$tcc = mysqli_num_rows($qcc);
			$cc_kd = nosql($rcc['kd']);

			//update
			mysqli_query($koneksi, "UPDATE mahasiswa_pelanggaran SET kd_point = '$pointkd', ".
					"kd_mahasiswa = '$cc_kd', postdate = '$today' ".
					"WHERE kd = '$kdx'");

			//re-direct
			$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&utgl=$utgl&ubln=$ubln&uthn=$uthn";
			xloc($ke);
			exit();
			}
		}
	}





//ke detail pelanggaran
if ($_POST['btnSMPx'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$kelkd = nosql($_POST['kelkd']);
	$utgl = nosql($_POST['utgl']);
	$ubln = nosql($_POST['ubln']);
	$uthn = nosql($_POST['uthn']);
	$tgl_entry = "$uthn:$ubln:$utgl";
	$nim = nosql($_POST['nim']);
	$s = nosql($_POST['s']);
	$a = nosql($_POST['a']);
	$kdx = nosql($_POST['kdx']);



	//cek
	if ((empty($nim)) OR (empty($utgl)) OR (empty($ubln)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!";
		$ke = "$filenya?s=$s&tapelkd=$tapelkd&kelkd=$kelkd&utgl=$utgl&ubln=$ubln&uthn=$uthn";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
					"WHERE nim = '$nim'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_kd = nosql($rcc['kd']);

		//nek ada
		if ($tcc != 0)
			{
			//re-direct
			$ke = "$filenya?s=$s&a=detail&nim=$nim&&tapelkd=$tapelkd&kelkd=$kelkd&utgl=$utgl&ubln=$ubln&uthn=$uthn";
			xloc($ke);
			exit();
			}
		else
			{
			//re-direct
			$pesan = "Tidak Ada Siswa dengan nim : $nim. Harap Diperhatikan...!!";
			$ke = "$filenya?s=$s&nim=$nim&tapelkd=$tapelkd&kelkd=$kelkd&utgl=$utgl&ubln=$ubln&uthn=$uthn";
			pekem($pesan,$ke);
			exit();
			}
		}
	}






//simpan pelanggaran
if ($_POST['btnSMPx2'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$kelkd = nosql($_POST['kelkd']);
	$utgl = nosql($_POST['utgl']);
	$ubln = nosql($_POST['ubln']);
	$uthn = nosql($_POST['uthn']);
	$tgl_entry = "$uthn:$ubln:$utgl";
	$nim = nosql($_POST['nim']);
	$s = nosql($_POST['s']);
	$a = nosql($_POST['a']);
	$jnskd = nosql($_POST['jnskd']);
	$pelkd = nosql($_POST['pelkd']);
	$kdx = nosql($_POST['kdx']);
	$swkd = nosql($_POST['swkd']);




	//cek
	if ((empty($jnskd)) OR (empty($pelkd)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!";
		$ke = "$filenya?s=$s&nim=$nim&a=detail&jnskd=$jnskd&tapelkd=$tapelkd&kelkd=$kelkd&utgl=$utgl&ubln=$ubln&uthn=$uthn";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//insert
		mysqli_query($koneksi, "INSERT INTO mahasiswa_pelanggaran (kd, kd_tapel, kd_kelas, ".
				"kd_mahasiswa, tgl, kd_point, postdate) VALUES ".
				"('$x', '$tapelkd', '$kelkd', ".
				"'$swkd', '$tgl_entry', '$pelkd', '$today')");


		//re-direct
		$ke = "$filenya?tapelkd=$tapelkd&kelkd=$kelkd&utgl=$utgl&ubln=$ubln&uthn=$uthn";
		xloc($ke);
		exit();
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");
require("../../inc/js/number.js");
require("../../inc/menu/admkemhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>

<script type="text/javascript">
$(document).ready(function() {
$(function() {
	$('#datepicker1').datepicker({
		changeMonth: true,
		yearRange: "-10:+10",
		changeYear: true
		});

	});


var tapelkd = $("#tapelkd").attr('value');
var kelkd = $("#kelkd").attr('value');
var config = {
	source: "i_mhs.php?tapelkd="+tapelkd+"&kelkd="+kelkd,
	select: function(event, ui){
		$("#nim").val(ui.item.p_nama);
	},
	minLength: 1 //cari setelah jumlah karakter
};
$("#nim").autocomplete(config);




	
});
</script>




<?php 




echo '<form name="formx" method="post" action="'.$filenya.'">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Tahun Pelajaran : ';
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

	echo '<option value="'.$filenya.'?s='.$s.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysqli_fetch_assoc($qtp));

echo '</select>,

Kelas : ';

echo "<select name=\"kelas\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qbtx = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
						"WHERE kd = '$kelkd'");
$rowbtx = mysqli_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxno = nosql($rowbtx['no']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<option value="'.$btxkd.'">'.$btxkelas.'</option>';

$qbt = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd <> '$kelkd' ".
			"ORDER BY kelas ASC, no ASC");
$rowbt = mysqli_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btkelas = nosql($rowbt['kelas']);

	echo '<option value="'.$filenya.'?s='.$s.'&tapelkd='.$tapelkd.'&kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysqli_fetch_assoc($qbt));

echo '</select>


[<a href="'.$filenya.'?s=baru&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&utgl='.$utgl.'&ubln='.$ubln.'&uthn='.$uthn.'">Tulis Baru</a>].


<input type="hidden" name="tapelkd" id="tapelkd" value="'.$tapelkd.'">
<input type="hidden" name="kelkd" id="kelkd" value="'.$kelkd.'">
<input type="hidden" name="utgl" value="'.$utgl.'">
<input type="hidden" name="ubln" value="'.$ubln.'">
<input type="hidden" name="uthn" value="'.$uthn.'">
<input type="hidden" name="kdx" value="'.$kdx.'">
<input type="hidden" name="swkd" value="'.$e_swkd.'">
</td>
</tr>
</table>';

//jika entry
if ($s == "baru")
	{
	//nek blm dipilih
	if (empty($tapelkd))
		{
		echo '<p>
		<font color="#FF0000"><strong>TAHUN PELAJARAN Belum Dipilih...!</strong></font>
		</p>';
		}

	else if (empty($kelkd))
		{
		echo '<p>
		<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>
		</p>';
		}

	else
		{
		echo '<table bgcolor="'.$warna02.'" width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		Tanggal : ';
		echo "<select name=\"utglx\" onChange=\"MM_jumpMenu('self',this,0)\">";
		echo '<option value="'.$utgl.'">'.$utgl.'</option>';
		for ($itgl=1;$itgl<=31;$itgl++)
			{
			echo '<option value="'.$filenya.'?s='.$s.'&tapelkd='.$tapelkd.'&kelkd='.$kelkd.'&utgl='.$itgl.'">'.$itgl.'</option>';
			}
		echo '</select>';

		echo "<select name=\"ublnx\" onChange=\"MM_jumpMenu('self',this,0)\">";
		echo '<option value="'.$ubln.''.$uthn.'" selected>'.$arrbln[$ubln].' '.$uthn.'</option>';
		for ($i=1;$i<=12;$i++)
			{
			//nilainya
			if ($i<=6) //bulan juli sampai desember
				{
				$ibln = $i + 6;

				echo '<option value="'.$filenya.'?s='.$s.'&tapelkd='.$tapelkd.'&kelkd='.$kelkd.'&utgl='.$utgl.'&ubln='.$ibln.'&uthn='.$tpx_thn1.'">'.$arrbln[$ibln].' '.$tpx_thn1.'</option>';
				}

			else if ($i>6) //bulan januari sampai juni
				{
				$ibln = $i - 6;

				echo '<option value="'.$filenya.'?s='.$s.'&tapelkd='.$tapelkd.'&kelkd='.$kelkd.'&utgl='.$utgl.'&ubln='.$ibln.'&uthn='.$tpx_thn2.'">'.$arrbln[$ibln].' '.$tpx_thn2.'</option>';
				}
			}

		echo '</select>
		</td>
		</tr>
		</table>';

		//query
		$qccx = mysqli_query($koneksi, "SELECT m_mahasiswa.* ".
					"FROM m_mahasiswa ".
					"WHERE nim = '$nim'");
		$rccx = mysqli_fetch_assoc($qccx);
		$tccx = mysqli_num_rows($qccx);
		$e_swkd = nosql($rccx['kd']);
		$e_nama = balikin($rccx['nama']);






		//entry
		echo '<p>
		nim :
		<br>
		<input type="text" name="nim" value="'.$nim.'" size="10"  id="nim">
		<br>
		<br>

		<input type="submit" name="btnBTL" value="BATAL">
		<input type="submit" name="btnSMPx" value="DETAIL >>">
		<input type="hidden" name="s" value="'.$s.'">
		</p>';



		//jika detail pelanggaran
		if ($a == "detail")
			{
			echo '<p>
			<hr>
			Nama Siswa : <strong>'.$nim.'.'.$e_nama.'</strong>
			<hr>
			</p>

			<p>
			<strong>PELANGGARAN YANG TELAH DILAKUKAN :</strong>
			</p>

			<p>
			jenis Pelanggaran :
			<br>';
			echo "<select name=\"jenis\" onChange=\"MM_jumpMenu('self',this,0)\">";

			//terpilih
			$qtpx = mysqli_query($koneksi, "SELECT * FROM m_bk_point_jenis ".
						"WHERE kd = '$jnskd'");
			$rowtpx = mysqli_fetch_assoc($qtpx);
			$tpx_kd = nosql($rowtpx['kd']);
			$tpx_no = balikin($rowtpx['no']);
			$tpx_jenis = balikin($rowtpx['jenis']);


			echo '<option value="'.$tpx_kd.'">'.$tpx_no.'.'.$tpx_jenis.'</option>';

			$qtp = mysqli_query($koneksi, "SELECT * FROM m_bk_point_jenis ".
						"WHERE kd <> '$jnskd' ".
						"ORDER BY round(no) ASC");
			$rowtp = mysqli_fetch_assoc($qtp);

			do
				{
				$tpkd = nosql($rowtp['kd']);
				$tpno = nosql($rowtp['no']);
				$tpjenis = balikin($rowtp['jenis']);

				echo '<option value="'.$filenya.'?s='.$s.'&a=detail&nim='.$nim.'&&tapelkd='.$tapelkd.'&kelkd='.$kelkd.'&utgl='.$utgl.'&ubln='.$ubln.'&uthn='.$uthn.'&jnskd='.$tpkd.'">'.$tpno.'.'.$tpjenis.'</option>';
				}
			while ($rowtp = mysqli_fetch_assoc($qtp));

			echo '</select>
			</p>

			<p>
			Nama Pelanggaran :
			<br>';
			echo "<select name=\"pelkd\" onChange=\"MM_jumpMenu('self',this,0)\">";

			//terpilih
			$qtpx = mysqli_query($koneksi, "SELECT * FROM m_bk_point ".
						"WHERE kd_jenis = '$jnskd' ".
						"AND kd = '$pelkd'");
			$rowtpx = mysqli_fetch_assoc($qtpx);
			$tpx_kd = nosql($rowtpx['kd']);
			$tpx_no = balikin2($rowtpx['no']);
			$tpx_nama = balikin2($rowtpx['nama']);
			$tpx_point = balikin2($rowtpx['point']);


			echo '<option value="'.$tpx_kd.'">'.$tpx_no.'.'.$tpx_nama.' ['.$tpx_point.']</option>';

			$qtpi = mysqli_query($koneksi, "SELECT * FROM m_bk_point ".
						"WHERE kd_jenis = '$jnskd' ".
						"AND kd <> '$pelkd' ".
						"ORDER BY round(no) ASC");
			$rowtpi = mysqli_fetch_assoc($qtpi);

			do
				{
				$i_kd = nosql($rowtpi['kd']);
				$i_no = balikin2($rowtpi['no']);
				$i_nama = balikin2($rowtpi['nama']);
				$i_point = balikin2($rowtpi['point']);
				$i_sanksi = balikin2($rowtpi['sanksi']);

				echo '<option value="'.$filenya.'?s='.$s.'&a=detail&nim='.$nim.'&&tapelkd='.$tapelkd.'&kelkd='.$kelkd.'&utgl='.$utgl.'&ubln='.$ubln.'&uthn='.$uthn.'&jnskd='.$jnskd.'&pelkd='.$i_kd.'">'.$i_no.'.'.$i_nama.' ['.$i_point.']</option>';
				}
			while ($rowtpi = mysqli_fetch_assoc($qtpi));

			echo '</select>
			</p>

			<p>

			<input type="submit" name="btnSMPx2" value="SIMPAN >>">
			<input type="hidden" name="s" value="'.$s.'">
			<input type="hidden" name="tapelkd" value="'.$tapelkd.'">
			<input type="hidden" name="kelkd" value="'.$kelkd.'">
			<input type="hidden" name="utgl" value="'.$utgl.'">
			<input type="hidden" name="ubln" value="'.$ubln.'">
			<input type="hidden" name="uthn" value="'.$uthn.'">
			<input type="hidden" name="jnskd" value="'.$jnskd.'">
			<input type="hidden" name="kdx" value="'.$kdx.'">
			<input type="hidden" name="nim" value="'.$nim.'">
			<input type="hidden" name="swkd" value="'.$e_swkd.'">
			</p>';
			}
		}
	}

else
	{
	if (empty($kelkd))
		{
		//query
		$qcc = mysqli_query($koneksi, "SELECT DISTINCT(kd_mahasiswa) AS swkd ".
					"FROM mahasiswa_pelanggaran ".
					"WHERE kd_tapel = '$tapelkd' ".
					"ORDER BY tgl DESC");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		}

	else
		{
		//query
		$qcc = mysqli_query($koneksi, "SELECT DISTINCT(kd_mahasiswa) AS swkd ".
					"FROM mahasiswa_pelanggaran ".
					"WHERE kd_tapel = '$tapelkd' ".
					"AND kd_kelas = '$kelkd' ".
					"ORDER BY tgl DESC");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		}


	//jika ada
	if ($tcc != 0)
		{
		echo '<p>
		<table width="980" border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="250"><strong><font color="'.$warnatext.'">Siswa</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Data Pelanggaran</font></strong></td>
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
			$i_kd = nosql($rcc['swkd']);



			//detail siswa
			$qswi = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
						"WHERE kd = '$i_kd'");
			$rswi = mysqli_fetch_assoc($qswi);
			$swi_nim = nosql($rswi['nim']);
			$swi_nama = balikin($rswi['nama']);


			//data pelanggaran
			$qdt = mysqli_query($koneksi, "SELECT m_bk_point.*, mahasiswa_pelanggaran.*, ".
						"mahasiswa_pelanggaran.kd AS pkd, ".
						"DATE_FORMAT(mahasiswa_pelanggaran.tgl, '%d') AS utgl, ".
						"DATE_FORMAT(mahasiswa_pelanggaran.tgl, '%m') AS ubln,  ".
						"DATE_FORMAT(mahasiswa_pelanggaran.tgl, '%Y') AS uthn ".
						"FROM m_bk_point, mahasiswa_pelanggaran ".
						"WHERE mahasiswa_pelanggaran.kd_point = m_bk_point.kd ".
						"AND mahasiswa_pelanggaran.kd_mahasiswa = '$i_kd'");
			$rdt = mysqli_fetch_assoc($qdt);
			$tdt = mysqli_num_rows($qdt);


			//data point pelanggaran
			$qdtx = mysqli_query($koneksi, "SELECT SUM(m_bk_point.point) AS poi ".
						"FROM m_bk_point, mahasiswa_pelanggaran ".
						"WHERE mahasiswa_pelanggaran.kd_point = m_bk_point.kd ".
						"AND mahasiswa_pelanggaran.kd_mahasiswa = '$i_kd'");
			$rdtx = mysqli_fetch_assoc($qdtx);
			$dtx_point = nosql($rdtx['poi']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$i_nomer.'" value="'.$i_kd.'">
        		</td>
			<td>

			<strong>'.$swi_nim.'. '.$swi_nama.'</strong>
			<br>
			[Jumlah Pelanggaran : <strong>'.$tdt.'</strong> kali].
			<br>
			[Total Point : <strong>'.$dtx_point.'</strong>].

			</td>
			<td>';



			do
				{
				//nilai
				$dt_utgl = nosql($rdt['utgl']);
				$dt_ubln = nosql($rdt['ubln']);
				$dt_uthn = nosql($rdt['uthn']);
				$dt_no = nosql($rdt['no']);
				$dt_pkd = nosql($rdt['pkd']);
				$dt_nama = balikin($rdt['nama']);
				$dt_point = nosql($rdt['point']);
				$dt_sanksi = balikin($rdt['sanksi']);
				$dt_postdate = $rdt['postdate'];


				echo "<strong>$dt_utgl/$dt_ubln/$dt_uthn</strong>
				<br>
				$dt_nama. [<strong>Point:$dt_point</strong>].
				[<em>$dt_postdate</em>].
				[<a href=\"$filenya?s=hapus&tapelkd=$tapelkd&kelas=$kelkd&pkd=$dt_pkd\">HAPUS</a>].
				<br>
				<em>$dt_sanksi</em>
				<hr>";
				}
			while ($rdt = mysqli_fetch_assoc($qdt));

			echo '</td>
        		</tr>';
			}
		while ($rcc = mysqli_fetch_assoc($qcc));

		echo '</table>
		<table width="980" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="500">
		<input type="hidden" name="tapelkd" value="'.$tapelkd.'">
		<input type="hidden" name="kelkd" value="'.$kelkd.'">
		<input type="hidden" name="utgl" value="'.$utgl.'">
		<input type="hidden" name="ubln" value="'.$ubln.'">
		<input type="hidden" name="uthn" value="'.$uthn.'">
		<input name="jml" type="hidden" value="'.$tcc.'">
		<input name="s" type="hidden" value="'.$s.'">
		<input name="kd" type="hidden" value="'.$kdx.'">
		<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$tcc.')">
		<input name="btnBTL" type="reset" value="BATAL">
		<input name="btnHPS" type="submit" value="HAPUS">
		</td>
		<td align="right">Total : <strong><font color="#FF0000">'.$tcc.'</font></strong> Data. '.$pagelist.'</td>
		</tr>
		</table>
		</p>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<b>TIDAK ADA DATA PELANGGARAN</b>
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