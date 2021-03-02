<?php
session_start();

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/class/paging.php");
require("../../inc/cek/admak.php");
$tpl = LoadTpl("../../template/index.html");


nocache;


//nilai
$filenya = "semua_bayar.php";
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$nim = nosql($_REQUEST['nim']);
$s = nosql($_REQUEST['s']);





//judul halaman
$judul = "Pembayaran Semua";
$judulku = "[$bak_session : $nip11_session. $nm11_session] ==> $judul";
$juduli = $judul;
$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&smtkd=$smtkd&nim=$nim";





//focus...
$diload = "document.formx.nim.focus();isodatetime();";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika hapus
if ($s == "hapus")
	{
	//nilai
	$progdi = nosql($_REQUEST['progdi']);
	$kelkd = nosql($_REQUEST['kelkd']);
	$tapelkd = nosql($_REQUEST['tapelkd']);
	$smtkd = nosql($_REQUEST['smtkd']);
	$swkd = nosql($_REQUEST['swkd']);
	$nim = nosql($_REQUEST['nim']);
	$kd = nosql($_REQUEST['kd']);
	$bln = nosql($_REQUEST['bln']);
	$thn = nosql($_REQUEST['thn']);


	//query
	mysqli_query($koneksi, "DELETE FROM mahasiswa_keu ".
					"WHERE kd_keu_mahasiswa = '$kd' ".
					"AND bln = '$bln' ".
					"AND thn = '$thn'");


	//re-direct
	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&smtkd=$smtkd&nim=$nim";
	xloc($ke);
	exit();
	}





//jika bayar
if ($_POST['btnSMP'])
	{
	//nilai
	$jnskd = nosql($_POST['jnskd']);
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);
	$smtkd = nosql($_POST['smtkd']);
	$swkd = nosql($_POST['swkd']);
	$nim = nosql($_POST['nim']);
	$kd = nosql($_POST['kd']);
	
	$ublnku = nosql($_POST['ublnku']);
	$mpecah2 = explode(" ", $ublnku);
	$ku_bln = $mpecah2[0];
	$ku_thn = $mpecah2[1];



	$mtgl = $_POST['datepicker1'];
	$mpecah1 = explode("/", $mtgl);
	$datepicker1_bln = $mpecah1[0];
	$datepicker1_tgl = $mpecah1[1];
	$datepicker1_thn = $mpecah1[2];	
	$tgl_bayar = "$datepicker1_thn:$datepicker1_bln:$datepicker1_tgl";




	//looping bulan
	//query
	$q = mysqli_query($koneksi, "SELECT * FROM m_keu_jenis ".
						"ORDER BY nama ASC");
	$row = mysqli_fetch_assoc($q);

	
	do
		{
		$inomer = $inomer + 1;
		$xyz = md5("$x$inomer");
		$jnskd = nosql($row['kd']);
		
		
	
		//detail uang e
		$qku = mysqli_query($koneksi, "SELECT * FROM m_keu_mahasiswa ".
								"WHERE kd_jenis = '$jnskd' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_mahasiswa = '$swkd'");
		$rku = mysqli_fetch_assoc($qku);
		$tku = mysqli_num_rows($qku);
		$ku_kd = nosql($rku['kd']);
		$ku_nilai = nosql($rku['nilai']);
	
		
		//jika ada
		if (!empty($tku))
			{
			//query
			mysqli_query($koneksi, "INSERT INTO mahasiswa_keu (kd, kd_keu_mahasiswa, bln, thn, tgl_bayar, postdate) VALUES ".
							"('$xyz', '$ku_kd', '$ku_bln', '$ku_thn', '$tgl_bayar', '$today')");
			}
		}
	while ($row = mysqli_fetch_assoc($q));
			



	//re-direct
	$ke = "$filenya?jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&smtkd=$smtkd&nim=$nim";
	xloc($ke);
	exit();
	}







//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/js/jam.js");
require("../../inc/menu/admak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

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
var progdi = $("#progdi").attr('value');
var config = {
	source: "i_mhs.php?tapelkd="+tapelkd+"&kelkd="+kelkd+"&progdi="+progdi,
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
<table bgcolor="'.$warna02.'" width="100%" border="0" cellspacing="0" cellpadding="3">
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

	echo '<option value="'.$filenya.'?jnskd='.$jnskd.'&progdi='.$tpkd.'">'.$tpnama.'</option>';
	}
while ($rowtp = mysqli_fetch_assoc($qtp));

echo '</select>,

Jenis : ';
echo "<select name=\"kelas\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qbtx = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd = '$kelkd'");
$rowbtx = mysqli_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<option value="'.$btxkd.'">'.$btxkelas.'</option>';

$qbt = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd <> '$kelkd' ".
			"ORDER BY no ASC");
$rowbt = mysqli_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btkelas = nosql($rowbt['kelas']);

	echo '<option value="'.$filenya.'?jnskd='.$jnskd.'&progdi='.$progdi.'&kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysqli_fetch_assoc($qbt));

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
						"ORDER BY tahun1 DESC");
$rowtp = mysqli_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?jnskd='.$jnskd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysqli_fetch_assoc($qtp));

echo '</select>

<input name="smtkd" id="smtkd" type="hidden" value="'.$smtkd.'">
<input name="jnskd" id="jnskd" type="hidden" value="'.$jnskd.'">
<input name="progdi" id="progdi" type="hidden" value="'.$progdi.'">
<input name="kelkd" id="kelkd" type="hidden" value="'.$kelkd.'">
<input name="tapelkd" id="tapelkd" type="hidden" value="'.$tapelkd.'">

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

else
	{
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr valign="top">
	<td valign="top" width="350">
	
	<p>
	Hari/Tanggal/Jam :
	<br>
	<input name="display_tgl" type="text" size="25" value="'.$arrhari[$hari].', '.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'" class="input" readonly>
	<input type="text" name="display_jam" size="5" style="text-align:right" class="input" readonly>
	</p>
	
	<p>
	NIM :
	<br>
	<input name="nim" id="nim"
	type="text"
	size="20"
	value="'.$nim.'"
	onKeyDown="var keyCode = event.keyCode;
	if (keyCode == 13)
		{
		document.formx.btnOK.focus();
		document.formx.btnOK.submit();
		}">
	<input name="btnOK" type="submit" value=">>">
	</p>';
	
	if (!empty($nim))
		{
		//siswa
		$qcc = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
								"WHERE nim = '$nim'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_kd = nosql($rcc['kd']);
		$cc_nama = balikin($rcc['nama']);
	
	
		//ketahui kode mahasiswa, dari suatu mahasiswa_kelas
		$qske = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, m_tapel.* ".
								"FROM mahasiswa_kelas, m_tapel ".
								"WHERE mahasiswa_kelas.kd_tapel = m_tapel.kd ".
								"AND mahasiswa_kelas.kd_mahasiswa = '$cc_kd' ".
								"AND m_tapel.kd = '$tapelkd'");
		$rske = mysqli_fetch_assoc($qske);
		$tske = mysqli_num_rows($qske);
	
	
		//semester terakhir
		$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_kelas ".
					"WHERE kd_progdi = '$progdi' ".
					"AND kd_kelas = '$kelkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_mahasiswa = '$cc_kd'");
		$rnil = mysqli_fetch_assoc($qnil);
		$tnil = mysqli_num_rows($qnil);
		$nil_smtkd = nosql($rnil['kd_smt']);
	
		//smt
		$qkelx = mysqli_query($koneksi, "SELECT * FROM m_smt ".
					"WHERE kd = '$nil_smtkd'");
		$rkelx = mysqli_fetch_assoc($qkelx);
		$kelx_smt = balikin($rkelx['smt']);
		$kelx_no = nosql($rkelx['no']);
	
	
		echo '<p>
		Nama Siswa :
		<br>
		<input name="nama" type="text" value="'.$cc_nama.'" size="30" class="input" readonly>
		</p>';
	
	
	

		//besarnya
		$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilku ".
								"FROM m_keu_mahasiswa ".
								"WHERE kd_progdi = '$progdi' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_mahasiswa = '$cc_kd'");
		$rku = mysqli_fetch_assoc($qku);
		$ku_nilai = nosql($rku['nilku']);
	
		
		echo '<p>
		Tanggal Bayar :
		<br>
		<input name="datepicker1" id="datepicker1" type="text" value="'.$ku_5.'" size="10">
		</p>


		<p>
		Total Bayar Bulanan :
		<br>
		Rp. <input name="nil_bayar" type="text" value="'.$ku_nilai.'" size="10" class="input" readonly>,00
		</p>



		
		<p>
		Untuk Bulan :
		<br>
		<select name="ublnku">
		<option value="" selected></option>';

		
		//tapel-nya
		$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
								"WHERE kd = '$tapelkd'");
		$rtpel = mysqli_fetch_assoc($qtpel);
		$ttpel = mysqli_num_rows($qtpel);
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
		
			echo '<option value="'.$ibln.' '.$itpel.'">'.$arrbln[$ibln].' '.$itpel.'</option>';
			}
		
		
		echo '</select>
		</p>
		
		
		<p>
		<input name="kd" id="kd" type="hidden" value="'.$ku_kd.'">
		<input name="swkd" id="swkd" type="hidden" value="'.$cc_kd.'">
		<input name="btnSMP" type="submit" value="SIMPAN >>">
		</p> 
		
		
		
		
		
		</td>
		
		
		<td>
		<p>
		<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td valign="top">
		<strong>HISTORY PEMBAYARAN</strong>
		<p>';



		echo '<table border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="10" align="center"><strong><font color="'.$warnatext.'">Bulan</font></strong></td>
		<td width="10" align="center"><strong><font color="'.$warnatext.'">Tahun</font></strong></td>
		<td width="100" align="center"><strong><font color="'.$warnatext.'">Tanggal Bayar</font></strong></td>
		<td width="150" align="center"><strong><font color="'.$warnatext.'">SubTotal</font></strong></td>
		<td width="50" align="center"><strong><font color="'.$warnatext.'">&nbsp;</font></strong></td>
		</tr>';


		//besarnya
		$qku2 = mysqli_query($koneksi, "SELECT * FROM m_keu_mahasiswa ".
								"WHERE kd_progdi = '$progdi' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_mahasiswa = '$cc_kd'");
		$rku2 = mysqli_fetch_assoc($qku2);
		$ku_kd = nosql($rku2['kd']);

		
		//tapel-nya
		$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
								"WHERE kd = '$tapelkd'");
		$rtpel = mysqli_fetch_assoc($qtpel);
		$ttpel = mysqli_num_rows($qtpel);
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
			
				
			
			/*
			//detail bayar
			$qku2 = mysqli_query($koneksi, "SELECT * FROM mahasiswa_keu ".
									"WHERE kd_keu_mahasiswa = '$ku_kd' ".
									"AND bln = '$ibln' ".
									"AND thn = '$itpel'");
			$rku2 = mysqli_fetch_assoc($qku2);
			$ku2_kd = nosql($rku2['kd']);
			$ku2_tgl_bayar = $rku2['tgl_bayar'];

*/
			//detail bayar
			$qku2 = mysqli_query($koneksi, "SELECT mahasiswa_keu.*, m_keu_mahasiswa.nilai AS nilku ".
									"FROM mahasiswa_keu, m_keu_mahasiswa ".
									"WHERE m_keu_mahasiswa.kd = mahasiswa_keu.kd_keu_mahasiswa ".
									"AND mahasiswa_keu.kd_keu_mahasiswa = '$ku_kd' ".
									"AND mahasiswa_keu.bln = '$ibln' ".
									"AND mahasiswa_keu.thn = '$itpel'");
			$rku2 = mysqli_fetch_assoc($qku2);
			$ku2_kd = nosql($rku2['kd']);
			$ku2_nilai = nosql($rku2['nilku']);
			$ku2_tgl_bayar = $rku2['tgl_bayar'];

	

			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			'.$ibln.'
			</td>
			<td>
			'.$itpel.'
			</td>
			<td>
			'.$ku2_tgl_bayar.'
			</td>
			<td align="right">
			'.xduit2($ku2_nilai).'
			</td>
			<td> 
			[<a href="'.$filenya.'?s=hapus&progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'&smtkd='.$smtkd.'&nim='.$nim.'&swkd='.$cc_kd.'&bln='.$ibln.'&thn='.$itpel.'&kd='.$ku_kd.'">HAPUS</a>].
			</td>
			</tr>';
			}

		echo '</table>';

		
		//total bayar
		$qku2 = mysqli_query($koneksi, "SELECT SUM(m_keu_mahasiswa.nilai) AS total ".
								"FROM mahasiswa_keu, m_keu_mahasiswa ".
								"WHERE m_keu_mahasiswa.kd = mahasiswa_keu.kd_keu_mahasiswa ".
								"AND mahasiswa_keu.kd_keu_mahasiswa = '$ku_kd' ".
								"AND m_keu_mahasiswa.kd_tapel = '$tapelkd'");
		$rku2 = mysqli_fetch_assoc($qku2);
		$ku2_total = nosql($rku2['total']);



		echo '<p>
		Total Terbayar : 
		<br>
		<b>
		'.xduit2($ku2_total).'
		</b>
		</p>		
		</td>
		</tr>
		</table>
		</p>';
		}
	
	echo '</td>
	</tr>
	</table>';
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