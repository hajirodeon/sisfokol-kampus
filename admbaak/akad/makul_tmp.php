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
$filenya = "makul_tmp.php";
$filenyax = "i_makul_tmp.php";
$judul = "Penempatan Mata Kuliah";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$progdi = nosql($_REQUEST['progdi']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$mkkd = nosql($_REQUEST['mkkd']);
$s = nosql($_REQUEST['s']);




//focus
if (empty($progdi))
	{
	$diload = "document.formx.progdi.focus();";
	}
else if (empty($tapelkd))
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
	$smtkd = nosql($_REQUEST['smtkd']);
	$mskd = nosql($_REQUEST['mskd']);
	$mkkd = nosql($_REQUEST['mkkd']);

	//query
	mysqli_query($koneksi, "DELETE FROM m_makul_smt ".
			"WHERE kd_tapel = '$tapelkd' ".
			"AND kd_smt = '$smtkd' ".
			"AND kd_makul = '$mkkd' ".
			"AND kd = '$mskd'");

	//re-direct
	$ke = "$filenya?progdi=$progdi&tapelkd=$tapelkd";
	xloc($ke);
	exit();
	}






//jika simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$progdi = nosql($_POST['progdi']);
	$tapelkd = nosql($_POST['tapelkd']);
	$smt = nosql($_POST['smt']);
	$makul = nosql($_POST['makul']);

	//cek
	if ((empty($makul)) OR (empty($smt)))
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
		$qcc = mysqli_query($koneksi, "SELECT m_makul_smt.*, m_makul.* ".
					"FROM m_makul_smt, m_makul ".
					"WHERE m_makul_smt.kd_makul = m_makul.kd ".
					"AND m_makul.kd_progdi = '$progdi' ".
					"AND m_makul_smt.kd_tapel = '$tapelkd' ".
					"AND m_makul_smt.kd_makul = '$makul' ".
					"AND m_makul_smt.kd_smt = '$smt'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);

		//jika iya, ada
		if ($tcc != 0)
			{
			//re-direct
			$pesan = "Mata Kuliah Tersebut Telah Anda Set. Harap Diperhatikan...!!.";
			$ke = "$filenya?progdi=$progdi&tapelkd=$tapelkd";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO m_makul_smt (kd, kd_tapel, kd_makul, kd_smt) VALUES ".
					"('$x', '$tapelkd', '$makul', '$smt')");

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
?>

<script type="text/javascript">
$(document).ready(function() {


$("#btnSMP2").live('click', function(){

	$("#formx2").submit(function(){
		$.ajax({
			url: "<?php echo $filenyax;?>?aksi=update",
			type: "POST",
			data:$(this).serialize(),
		 	cache: false,
			success:function(data){
				$("#result").html(data);
				setTimeout('$("#result").hide()',5000);
			}
		});
		return false;
	});
});




});
</script>



<?php 



echo '<form action="'.$filenya.'" method="post" name="formx" id="formx">
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

echo '<option value="'.$tpx_kd.'" selected>'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd <> '$tapelkd' ".
			"ORDER BY tahun1 ASC");
$rowtp = mysqli_fetch_assoc($qtp);

do
	{
	$tp_kd = nosql($rowtp['kd']);
	$tp_thn1 = nosql($rowtp['tahun1']);
	$tp_thn2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&tapelkd='.$tp_kd.'">'.$tp_thn1.'/'.$tp_thn2.'</option>';
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

	echo '</select>,


	<select name="smt">
	<option value="" selected>-Semester-</option>';

	$qtp21 = mysqli_query($koneksi, "SELECT * FROM m_smt ".
				"ORDER BY round(no) ASC");
	$rowtp21 = mysqli_fetch_assoc($qtp21);

	do
		{
		$tp21_kd = nosql($rowtp21['kd']);
		$tp21_smt = balikin($rowtp21['smt']);

		echo '<option value="'.$tp21_kd.'">'.$tp21_smt.'</option>';
		}
	while ($rowtp21 = mysqli_fetch_assoc($qtp21));

	echo '</select>


	<INPUT type="hidden" name="progdi" value="'.$progdi.'">
	<INPUT type="hidden" name="tapelkd" value="'.$tapelkd.'">
	<INPUT type="submit" name="btnSMP" value="TAMBAH >>">
	</p>
	</form>
	
	<br>
	
	<form name="formx2" id="formx2">';


	//daftar semester
	$qsmt = mysqli_query($koneksi, "SELECT * FROM m_smt ".
				"ORDER BY round(no) ASC");
	$rsmt = mysqli_fetch_assoc($qsmt);
	$tsmt = mysqli_num_rows($qsmt);

	do
		{
		//nilai
		$smt_kd = nosql($rsmt['kd']);
		$smt_no = nosql($rsmt['no']);
		$smt_smt = nosql($rsmt['smt']);


		echo '<p>
		<strong>Semester : '.$smt_smt.'</strong>';
		
		
		//daftar makul-nya
		$qkulo = mysqli_query($koneksi, "SELECT m_makul_smt.sks AS ssks, ".
								"m_makul_smt.kd AS mskd, ".
								"m_makul.*, m_makul.kd AS mkkd ".
								"FROM m_makul_smt, m_makul ".
								"WHERE m_makul_smt.kd_makul = m_makul.kd ".
								"AND m_makul.kd_progdi = '$progdi' ".
								"AND m_makul_smt.kd_tapel = '$tapelkd' ".
								"AND m_makul_smt.kd_smt = '$smt_kd'");
		$rkulo = mysqli_fetch_assoc($qkulo);
		$tkulo = mysqli_num_rows($qkulo);

		//jika ada
		if ($tkulo != 0)
			{
			echo '<table width="700" border="1" cellspacing="0" cellpadding="3">
			<tr valign="top" bgcolor="'.$warnaheader.'">
			<td width="1%">&nbsp;</td>
			<td width="100"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
			<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
			<td width="50"><strong><font color="'.$warnatext.'">SKS</font></strong></td>
			<td width="100"><strong><font color="'.$warnatext.'">Jenis</font></strong></td>
			<td width="100"><strong><font color="'.$warnatext.'">Status</font></strong></td>
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
				$kulo_ssks = nosql($rkulo['ssks']);
				$kulo_kode = nosql($rkulo['kode']);
				$kulo_nama = balikin($rkulo['nama']);
				$kulo_jenis = nosql($rkulo['jenis']);
				$kulo_status = nosql($rkulo['status']);



				//jika true
				if ($kulo_jenis == "true")
					{
					$kulo_jenis_nil = "<font color=\"red\"><strong>Wajib</strong></font>";
					}
				else
					{
					$kulo_jenis_nil = "Pilihan";
					}


				//jika true
				if ($kulo_status == "true")
					{
					$kulo_status_nil = "<font color=\"red\"><strong>Aktif</strong></font>";
					}
				else
					{
					$kulo_status_nil = "Tidak Aktif";
					}



				//jika null
				if (empty($kulo_ssks))
					{
					mysqli_query($koneksi, "UPDATE m_makul_smt SET sks = '$kulo_sks' ".
									"WHERE kd = '$kulo_mskd'");
					}



				//sks-nya
				$qkulox = mysqli_query($koneksi, "SELECT * FROM m_makul_smt ".
										"WHERE kd = '$kulo_mskd'");
				$rkulox = mysqli_fetch_assoc($qkulox);
				$kulo_sks = nosql($rkulox['sks']);



				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>
				<a href="'.$filenya.'?progdi='.$progdi.'&tapelkd='.$tapelkd.'&smtkd='.$smt_kd.'&mkkd='.$kulo_mkkd.'&s=hapus&mskd='.$kulo_mskd.'">
				<img src="'.$sumber.'/img/delete.gif" width="16" height="16" border="0">
				</a>
				</td>
				<td>'.$kulo_kode.'</td>
				<td>'.$kulo_nama.'</td>
				<td>
				<input name="sks'.$kulo_mskd.'" id="sks'.$kulo_mskd.'" type="text" value="'.$kulo_sks.'" size="1">
				<input name="mskd'.$kulo_mskd.'" id="mskd'.$kulo_mskd.'" type="hidden" value="'.$kulo_mskd.'">
				</td>
				<td>'.$kulo_jenis_nil.'</td>
				<td>'.$kulo_status_nil.'</td>
				</tr>';
				}
			while ($rkulo = mysqli_fetch_assoc($qkulo));


			//total sks
			$qkulo2 = mysqli_query($koneksi, "SELECT SUM(m_makul_smt.sks) AS total ".
									"FROM m_makul_smt, m_makul ".
									"WHERE m_makul_smt.kd_makul = m_makul.kd ".
									"AND m_makul.kd_progdi = '$progdi' ".
									"AND m_makul_smt.kd_tapel = '$tapelkd' ".
									"AND m_makul_smt.kd_smt = '$smt_kd'");
			$rkulo2 = mysqli_fetch_assoc($qkulo2);
			$kulo2_total = nosql($rkulo2['total']);


			echo '<tr valign="top" bgcolor="'.$warnaheader.'">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right"><strong><font color="'.$warnatext.'">Jumlah SKS</font></strong></td>
			<td width="50"><strong><font color="'.$warnatext.'">'.$kulo2_total.'</font></strong></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
			</table>
			
			<INPUT type="hidden" name="e_progdi" id="e_progdi" value="'.$progdi.'">
			<INPUT type="hidden" name="e_tapelkd" id="e_tapelkd" value="'.$tapelkd.'">
			<INPUT type="submit" name="btnSMP2" id="btnSMP2" value="SIMPAN">';
			}

		else
			{
			echo '<p>
			<font color="red">
			<strong>BELUM ADA DATA MATA KULIAH.</strong>
			</font>
			</p>';
			}

		echo '</p>
		<br>';
		}
	while ($rsmt = mysqli_fetch_assoc($qsmt));
	
	
	echo '</form>';
	}
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