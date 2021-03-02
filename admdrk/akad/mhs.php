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
$filenya = "mhs.php";
$judul = "Data Mahasiswa";
$judulku = "[$drk_session : $nip1_session. $nm1_session] ==> $judul";
$judulx = $judul;
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$s = nosql($_REQUEST['s']);






//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/admdrk.php");
xheadline($judul);



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaover.'">
<td width="600">
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

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysqli_fetch_assoc($qbt));

echo '</select>
</td>
</tr>
</table>';




//jika view /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (empty($s))
	{
	//jika null
	if (!empty($progdi))
		{
		$ku_progdi = "AND mahasiswa_kelas.kd_progdi = '$progdi'";
		}


	if (!empty($kelkd))
		{
		$ku_kelkd = "AND mahasiswa_kelas.kd_kelas = '$kelkd'";
		}



	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	$sqlcount = "SELECT DISTINCT(m_mahasiswa.kd) AS mmkd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"$ku_progdi ".
						"$ku_kelkd ".
						"ORDER BY round(m_mahasiswa.nim) ASC";
	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?progdi=$progdi&kelkd=$kelkd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);


	if ($count != 0)
		{
		//view data
		echo '<br>
		<table width="700" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="100"><strong><font color="'.$warnatext.'">NIM</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td width="200"><strong><font color="'.$warnatext.'">TTL</font></strong></td>
		<td width="200"><strong><font color="'.$warnatext.'">Alamat</font></strong></td>
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
			$i_kd = nosql($data['mmkd']);
			
			
			//detail
			$qku = mysqli_query($koneksi, "SELECT DATE_FORMAT(m_mahasiswa.tgl_lahir, '%d') AS xtgl, ".
									"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%m') AS xbln, ".
									"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%Y') AS xthn, ".
									"m_mahasiswa.*, m_mahasiswa.kd AS mmkd, mahasiswa_kelas.* ".
									"FROM m_mahasiswa, mahasiswa_kelas ".
									"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
									"AND m_mahasiswa.kd = '$i_kd'");
			$rku = mysqli_fetch_assoc($qku);
			$i_usernamex = nosql($rku['usernamex']);
			$i_passwordx = nosql($rku['passwordx']);
			$i_nim = balikin2($rku['nim']);
			$i_nama = balikin($rku['nama']);
			$i_alamat = balikin($rku['alamat_skrg']);
			$i_tmp_lahir = balikin($rku['tmp_lahir']);
			$i_xtgl = nosql($rku['xtgl']);
			$i_xbln = nosql($rku['xbln']);
			$i_xthn = nosql($rku['xthn']);
			$i_tgl_lahir = "$i_xtgl/$i_xbln/$i_xthn";



			//set akses
			if ((empty($i_usernamex)) OR (empty($i_passwordx)))
				{
				$x_userx = $i_nim;
				$x_passx = md5($i_nim);

				mysqli_query($koneksi, "UPDATE m_mahasiswa SET usernamex = '$x_userx', ".
						"passwordx = '$x_passx' ".
						"WHERE kd = '$i_kd'");
				}


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$i_nim.'</td>
			<td>'.$i_nama.'</td>
			<td>'.$i_tmp_lahir.', '.$i_tgl_lahir.'</td>
			<td>'.$i_alamat.'</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		echo '</table>
		<table width="700" border="0" cellspacing="0" cellpadding="3">
		<tr>
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