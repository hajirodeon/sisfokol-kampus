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
require("../../inc/cek/admkemhs.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "mess_kampus.php";
$judul = "Mess Kampus";
$judulku = "[$kemhs_session : $nip4_session. $nm4_session] ==> $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);




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




//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$e_kode = cegah($_POST['e_kode']);
	$e_nama = cegah($_POST['e_nama']);
	$e_asal = cegah($_POST['e_asal']);
	$e_telp = cegah($_POST['e_telp']);
	$e_kelamin = cegah($_POST['e_kelamin']);
	
	$mtgl = $_POST['datepicker1'];
	$mpecah1 = explode("/", $mtgl);
	$datepicker1_bln = $mpecah1[0];
	$datepicker1_tgl = $mpecah1[1];
	$datepicker1_thn = $mpecah1[2];	
	$e_tgl_mulai = "$datepicker1_thn:$datepicker1_bln:$datepicker1_tgl";

	$mtgl = $_POST['datepicker2'];
	$mpecah1 = explode("/", $mtgl);
	$datepicker1_bln = $mpecah1[0];
	$datepicker1_tgl = $mpecah1[1];
	$datepicker1_thn = $mpecah1[2];	
	$e_tgl_akhir = "$datepicker1_thn:$datepicker1_bln:$datepicker1_tgl";
	
	


	//nek null
	if ((empty($e_kode)) OR (empty($e_nama)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//query
		mysql_query("INSERT INTO m_mess_kampus(kd, kode_kamar, nama, asal, telp, ".
						"kelamin, tgl1, tgl2, postdate) VALUES ".
						"('$x', '$e_kode', '$e_nama', '$e_asal', '$e_telp', ".
						"'$e_kelamin', '$e_tgl_mulai', '$e_tgl_akhir', '$today')");

		//re-direct
		xloc($filenya);
		exit();
		}
	}


//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysql_query("DELETE FROM m_mess_kampus ".
						"WHERE kd = '$kd'");
		}

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

//query
$q = mysql_query("SELECT * FROM m_mess_kampus ".
					"ORDER BY kode_kamar ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

//js
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admkemhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<script type="text/javascript">
$(document).ready(function() {
$(function() {
	$('#datepicker1').datepicker({
		changeMonth: true,
		yearRange: "-100:+10",
		changeYear: true
		});

	$('#datepicker2').datepicker({
		changeMonth: true,
		yearRange: "-100:+10",
		changeYear: true
		});
	});

	
});
</script>




<?php
echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
Kode Kamar :
<br>
<input name="e_kode" type="text" value="'.$e_kode.'" size="10">
</p>


<p>
Nama Penghuni :
<br>
<input name="e_nama" type="text" value="'.$e_nama.'" size="30">
</p>

<p>
Asal :
<br>
<input name="e_asal" type="text" value="'.$e_asal.'" size="20">
</p>

<p>
Kelamin :
<br>
<select name="e_kelamin">
<option value="'.$e_kelamin.'" selected>'.$e_kelamin.'</option>
<option value="L">L</option>
<option value="P">P</option>
</select>
</p>


<p>
Telo :
<br>
<input name="e_telp" type="text" value="'.$e_telp.'" size="20">
</p>



<p>
Tanggal Mulai  :
<br> 
<input name="datepicker1" id="datepicker1" type="text" value="'.$e_tgl_mulai.'" size="10">	
</p>

<p>
Tanggal Akhir :
<br>
<input name="datepicker2" id="datepicker2" type="text" value="'.$e_tgl_akhir.'" size="10">
</p>

<p>
<input name="s" type="hidden" value="'.$s.'">
<input name="kd" type="hidden" value="'.$kdx.'">
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnBTL" type="submit" value="BATAL">
</p>';

if ($total != 0)
	{
	echo '<table width="900" border="1" cellspacing="0" cellpadding="3">
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td><strong><font color="'.$warnatext.'">Kode Kamar</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
	<td width="10"><strong><font color="'.$warnatext.'">Kelamin</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Asal</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Telp</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">Tgl. Mulai</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">Tgl. Akhir</font></strong></td>
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
		$i_kd = nosql($row['kd']);
		$i_kode = balikin($row['kode_kamar']);
		$i_nama = balikin($row['nama']);
		$i_kelamin = balikin($row['kelamin']);
		$i_asal = balikin($row['asal']);
		$i_telp = balikin($row['telp']);
		$i_tgl1 = $row['tgl1'];
		$i_tgl2 = $row['tgl2'];

		
		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="checkbox" name="item'.$i_nomer.'" value="'.$i_kd.'">
        </td>
		<td>'.$i_kode.'</td>
		<td>'.$i_nama.'</td>
		<td>'.$i_kelamin.'</td>
		<td>'.$i_asal.'</td>
		<td>'.$i_telp.'</td>
		<td>'.$i_tgl1.'</td>
		<td>'.$i_tgl2.'</td>
    	</tr>';
		}
	while ($row = mysql_fetch_assoc($q));

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td width="263">
	<input name="jml" type="hidden" value="'.$total.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$total.')">
	<input name="btnBTL" type="submit" value="BATAL">
	<input name="btnHPS" type="submit" value="HAPUS">
	</td>
	<td align="right">Total : <strong><font color="#FF0000">'.$total.'</font></strong> Data.</td>
	</tr>
	</table>';
	}
else
	{
	echo '<p>
	<font color="red">
	<strong>TIDAK ADA DATA. Silahkan Entry Dahulu...!!</strong>
	</font>
	</p>';
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