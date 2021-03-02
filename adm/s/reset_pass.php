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
require("../../inc/class/paging.php");
require("../../inc/cek/adm.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "reset_pass.php";
$diload = "document.formx.akses.focus();";
$judul = "Reset Password";
$judulku = "[$adm_session] ==> $judul";
$juduli = $judul;
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$rukd = nosql($_REQUEST['rukd']);
$tpkd = nosql($_REQUEST['tpkd']);
$tipe = cegah($_REQUEST['tipe']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnRST'])
	{
	$tpkd = nosql($_POST['tpkd']);
	$tipe = cegah($_POST['tipe']);
	$page = nosql($_POST['page']);
	if ((empty($page)) OR ($page == "0"))
		{
		$page = "1";
		}


	//nek pegawai ................................................................................................................
	else if ($tpkd == "tp01")
		{
		$item = nosql($_POST['item']);
		$passbarux = md5($passbaru);
		$ke = "$filenya?tpkd=$tpkd&tipe=$tipe&page=$page";

		//cek
		//nek null
		if (empty($item))
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Reset Password Gagal. Belum Dipilih.";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//query
			$qsuk = mysqli_query($koneksi, "SELECT * FROM m_pegawai ".
						"WHERE kd = '$item'");
			$rsuk = mysqli_fetch_assoc($qsuk);
			$suk_nip = nosql($rsuk['nip']);
			$suk_nm = balikin($rsuk['nama']);
			$pesan = "NIP : $suk_nip, Nama : $suk_nm. Password Baru : $passbaru";

			//reset password
			mysqli_query($koneksi, "UPDATE m_pegawai SET passwordx = '$passbarux', ".
					"postdate = '$today' ".
					"WHERE kd = '$item'");

			//re-direct
			pekem($pesan,$ke);
			exit();
			}
		}





	//nek mahasiswa .........................................................................................................................
	if ($tpkd == "tp02")
		{
		$progdi = nosql($_POST['progdi']);
		$kelkd = nosql($_POST['kelkd']);
		$item = nosql($_POST['item']);
		$passbarux = md5($passbaru);
		$ke = "$filenya?tpkd=$tpkd&tipe=$tipe&progdi=$progdi&kelkd=$kelkd&page=$page";

		//cek
		//nek blm dipilih
		if (empty($item))
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Reset Password Gagal. Belum Dipilih.";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//query
			$qsuk = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
									"WHERE kd = '$item'");
			$rsuk = mysqli_fetch_assoc($qsuk);
			$suk_nim = nosql($rsuk['nim']);
			$suk_nm = balikin($rsuk['nama']);
			$pesan = "NIM : $suk_nim, Nama : $suk_nm. Password Baru : $passbaru";

			//reset password
			mysqli_query($koneksi, "UPDATE m_mahasiswa SET passwordx = '$passbarux', ".
								"postdate = '$today' ".
								"WHERE kd = '$item'");


			//re-direct
			pekem($pesan,$ke);
			exit();
			}
		}





	//nek direktur ................................................................................................................
	else if ($tpkd == "tp04")
		{
		$pegawai = nosql($_POST['pegawai']);
		$ke = "$filenya?tpkd=$tpkd&tipe=$tipe";

		//cek
		//nek null
		if (empty($pegawai))
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Silahkan tentukan dahulu...";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//query
			$qsuk = mysqli_query($koneksi, "SELECT * FROM adm_direktur ".
						"WHERE kd_pegawai = '$pegawai'");
			$rsuk = mysqli_fetch_assoc($qsuk);
			$tsuk = mysqli_num_rows($qsuk);

			//jika ada
			if ($tsuk != 0)
				{
				//re-direct
				$pesan = "Pegawai Yang Ditunjuk, Sudah Memegang Tugas ini. Harap Diperhatikan.";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//insert
				mysqli_query($koneksi, "INSERT INTO adm_direktur (kd, kd_pegawai) VALUES ".
						"('$x', '$pegawai')");

				//re-direct
				xloc($ke);
				exit();
				}
			}
		}





	//nek BAAK ................................................................................................................
	else if ($tpkd == "tp06")
		{
		$pegawai = nosql($_POST['pegawai']);
		$ke = "$filenya?tpkd=$tpkd&tipe=$tipe";

		//cek
		//nek null
		if (empty($pegawai))
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Silahkan tentukan dahulu...";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//query
			$qsuk = mysqli_query($koneksi, "SELECT * FROM adm_baak ".
						"WHERE kd_pegawai = '$pegawai'");
			$rsuk = mysqli_fetch_assoc($qsuk);
			$tsuk = mysqli_num_rows($qsuk);

			//jika ada
			if ($tsuk != 0)
				{
				//re-direct
				$pesan = "Pegawai Yang Ditunjuk, Sudah Memegang Tugas ini. Harap Diperhatikan.";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//insert
				mysqli_query($koneksi, "INSERT INTO adm_baak (kd, kd_pegawai) VALUES ".
						"('$x', '$pegawai')");

				//re-direct
				xloc($ke);
				exit();
				}
			}
		}





	//nek BAU ................................................................................................................
	else if ($tpkd == "tp07")
		{
		$pegawai = nosql($_POST['pegawai']);
		$ke = "$filenya?tpkd=$tpkd&tipe=$tipe";

		//cek
		//nek null
		if (empty($pegawai))
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Silahkan tentukan dahulu...";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//query
			$qsuk = mysqli_query($koneksi, "SELECT * FROM adm_bau ".
						"WHERE kd_pegawai = '$pegawai'");
			$rsuk = mysqli_fetch_assoc($qsuk);
			$tsuk = mysqli_num_rows($qsuk);

			//jika ada
			if ($tsuk != 0)
				{
				//re-direct
				$pesan = "Pegawai Yang Ditunjuk, Sudah Memegang Tugas ini. Harap Diperhatikan.";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//insert
				mysqli_query($koneksi, "INSERT INTO adm_bau (kd, kd_pegawai) VALUES ".
						"('$x', '$pegawai')");

				//re-direct
				xloc($ke);
				exit();
				}
			}
		}






	//nek Kemahasiswaan ................................................................................................................
	else if ($tpkd == "tp08")
		{
		$pegawai = nosql($_POST['pegawai']);
		$ke = "$filenya?tpkd=$tpkd&tipe=$tipe";

		//cek
		//nek null
		if (empty($pegawai))
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Silahkan tentukan dahulu...";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//query
			$qsuk = mysqli_query($koneksi, "SELECT * FROM adm_kemhs ".
						"WHERE kd_pegawai = '$pegawai'");
			$rsuk = mysqli_fetch_assoc($qsuk);
			$tsuk = mysqli_num_rows($qsuk);

			//jika ada
			if ($tsuk != 0)
				{
				//re-direct
				$pesan = "Pegawai Yang Ditunjuk, Sudah Memegang Tugas ini. Harap Diperhatikan.";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//insert
				mysqli_query($koneksi, "INSERT INTO adm_kemhs (kd, kd_pegawai) VALUES ".
						"('$x', '$pegawai')");

				//re-direct
				xloc($ke);
				exit();
				}
			}
		}






	//nek BAK ................................................................................................................
	else if ($tpkd == "tp09")
		{
		$pegawai = nosql($_POST['pegawai']);
		$ke = "$filenya?tpkd=$tpkd&tipe=$tipe";

		//cek
		//nek null
		if (empty($pegawai))
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Silahkan tentukan dahulu...";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//query
			$qsuk = mysqli_query($koneksi, "SELECT * FROM adm_bak ".
						"WHERE kd_pegawai = '$pegawai'");
			$rsuk = mysqli_fetch_assoc($qsuk);
			$tsuk = mysqli_num_rows($qsuk);

			//jika ada
			if ($tsuk != 0)
				{
				//re-direct
				$pesan = "Pegawai Yang Ditunjuk, Sudah Memegang Tugas ini. Harap Diperhatikan.";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//insert
				mysqli_query($koneksi, "INSERT INTO adm_bak (kd, kd_pegawai) VALUES ".
								"('$x', '$pegawai')");

				//re-direct
				xloc($ke);
				exit();
				}
			}
		}
		
	}
	//...................................................................................................................................






//hapus
if ($_POST['btnHPS'])
	{
	$pegawai = nosql($_POST['pegawai']);
	$tpkd = nosql($_POST['tpkd']);
	$tipe = cegah($_POST['tipe']);
	$jml = nosql($_POST['jml']);
	$ke = "$filenya?tpkd=$tpkd&tipe=$tipe&page=$page";


	//nek direktur ................................................................................................................
	if ($tpkd == "tp04")
		{
		for ($k=1;$k<=$jml;$k++)
			{
			$item1 = "item";
			$item11 = "$item1$k";
			$pegawai = nosql($_POST[$item11]);

			//hapus
			mysqli_query($koneksi, "DELETE FROM adm_direktur ".
					"WHERE kd_pegawai = '$pegawai'");
			}
		}






	//nek BAAK ................................................................................................................
	else if ($tpkd == "tp06")
		{
		for ($k=1;$k<=$jml;$k++)
			{
			$item1 = "item";
			$item11 = "$item1$k";
			$pegawai = nosql($_POST[$item11]);

			//hapus
			mysqli_query($koneksi, "DELETE FROM adm_baak ".
					"WHERE kd_pegawai = '$pegawai'");
			}
		}





	//nek BAU ................................................................................................................
	else if ($tpkd == "tp07")
		{
		for ($k=1;$k<=$jml;$k++)
			{
			$item1 = "item";
			$item11 = "$item1$k";
			$pegawai = nosql($_POST[$item11]);

			//hapus
			mysqli_query($koneksi, "DELETE FROM adm_bau ".
					"WHERE kd_pegawai = '$pegawai'");
			}
		}






	//nek Kemahasiswaan ................................................................................................................
	else if ($tpkd == "tp08")
		{
		for ($k=1;$k<=$jml;$k++)
			{
			$item1 = "item";
			$item11 = "$item1$k";
			$pegawai = nosql($_POST[$item11]);

			//hapus
			mysqli_query($koneksi, "DELETE FROM adm_kemhs ".
					"WHERE kd_pegawai = '$pegawai'");
			}
		}






	//nek BAK ................................................................................................................
	else if ($tpkd == "tp09")
		{
		for ($k=1;$k<=$jml;$k++)
			{
			$item1 = "item";
			$item11 = "$item1$k";
			$pegawai = nosql($_POST[$item11]);

			//hapus
			mysqli_query($koneksi, "DELETE FROM adm_bak ".
					"WHERE kd_pegawai = '$pegawai'");
			}
		}





	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/menu/adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Akses : ';
echo "<select name=\"akses\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$filenya.'?tpkd='.$tpkd.'" selected>'.$tipe.'</option>
<option value="'.$filenya.'?tpkd=tp01&tipe=Pegawai">-Pegawai/Dosen-</option>
<option value="'.$filenya.'?tpkd=tp02&tipe=Mahasiswa">-Mahasiswa-</option>
<option value="'.$filenya.'?tpkd=tp04&tipe=Ketua">-Ketua-</option>

<option value="'.$filenya.'?tpkd=tp06&tipe=BAAK">-BAAK-</option>
<option value="'.$filenya.'?tpkd=tp07&tipe=BAU">-BAU-</option>
<option value="'.$filenya.'?tpkd=tp09&tipe=BAK">-BAK-</option>
<option value="'.$filenya.'?tpkd=tp08&tipe=Kemahasiswaan">-Kemahasiswaan-</option>

</select>
</td>
</tr>
</table>';




//nek pegawai ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($tpkd == "tp01")
	{
	//nilai
	$page = nosql($_REQUEST['page']);
	if ((empty($page)) OR ($page == "0"))
		{
		$page = "1";
		}

	$ke = "$filenya?tpkd=$tpkd&tipe=$tipe&page=$page";


	//data ne....
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT *  FROM m_pegawai ".
			"ORDER BY round(nip) ASC";
	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = $ke;
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);

	echo '<br>
	<table width="500" border="1" cellpadding="3" cellspacing="0">
    	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="100" valign="top"><strong>NIP</strong></td>
	<td valign="top"><strong>Nama</strong></td>
	<td width="150" valign="top"><strong>Postdate</strong></td>
    	</tr>';

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

			//nilai
			$dt_kd = nosql($data['kd']);
			$dt_nip = nosql($data['nip']);
			$dt_nama = balikin($data['nama']);
			$dt_postdate = $data['postdate'];

			//nek null
			if ($dt_postdate == "0000-00-00 00:00:00")
				{
				$dt_postdate = "-";
				}


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td><input name="kd'.$nomer.'" type="hidden" value="'.$dt_kd.'">
			<input type="radio" name="item" value="'.$dt_kd.'">
			</td>
			<td valign="top">
			'.$dt_nip.'
			</td>
			<td valign="top">
			'.$dt_nama.'
			</td>
			<td valign="top">
			'.$dt_postdate.'
			</td>
			</tr>';
	  		}
		while ($data = mysqli_fetch_assoc($result));
		}

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
    	<tr>
	<td width="100">
	<input name="btnRST" type="submit" value="RESET">
	<input name="jml" type="hidden" value="'.$limit.'">
	<input name="kd" type="hidden" value="'.$dt_kd.'">
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="page" type="hidden" value="'.$page.'">
	<input name="total" type="hidden" value="'.$count.'">
	</td>
	<td align="right"><font color="#FF0000"><strong>'.$count.'</strong></font> Data '.$pagelist.'</td>
    	</tr>
	</table>
	<br>
	<br>';
	}




//nek MAHASISWA ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if ($tpkd == "tp02")
	{
	//nilai
	$progdi = nosql($_REQUEST['progdi']);
	$kelkd = nosql($_REQUEST['kelkd']);
	$rukd = nosql($_REQUEST['rukd']);
	$page = nosql($_REQUEST['page']);
	if ((empty($page)) OR ($page == "0"))
		{
		$page = "1";
		}

	$ke = "$filenya?tpkd=$tpkd&tipe=$tipe&progdi=$progdi&kelkd=$kelkd&rukd=$rukd&page=$page";



	//focus...
	if (empty($tapelkd))
		{
		$diload = "document.formx.progdi.focus();";
		}
	else if (empty($kelkd))
		{
		$diload = "document.formx.kelas.focus();";
		}



	//view
	echo '<table bgcolor="'.$warna02.'" width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	Program Pendidikan : ';
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
		$i_tpkd = nosql($rowtp['kd']);
		$i_tpnama = balikin($rowtp['nama']);

		echo '<option value="'.$filenya.'?tpkd='.$tpkd.'&tipe='.$tipe.'&progdi='.$i_tpkd.'">'.$i_tpnama.'</option>';
		}
	while ($rowtp = mysqli_fetch_assoc($qtp));

	echo '</select>,


	Kelas : ';
	echo "<select name=\"kelas\" onChange=\"MM_jumpMenu('self',this,0)\">";

	//terpilih
	$qbtx = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
				"WHERE kd = '$kelkd'");
	$rowbtx = mysqli_fetch_assoc($qbtx);
	$btx_kd = nosql($rowbtx['kd']);
	$btx_kelas = nosql($rowbtx['kelas']);


	echo '<option value="'.$btx_kd.'">'.$btx_kelas.'</option>';

	$qbt = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
				"WHERE kd <> '$kelkd' ".
				"ORDER BY kelas ASC");
	$rowbt = mysqli_fetch_assoc($qbt);

	do
		{
		$bt_kd = nosql($rowbt['kd']);
		$bt_kelas = nosql($rowbt['kelas']);

		echo '<option value="'.$filenya.'?tpkd='.$tpkd.'&tipe='.$tipe.'&progdi='.$progdi.'&kelkd='.$bt_kd.'">'.$bt_kelas.'</option>';
		}
	while ($rowbt = mysqli_fetch_assoc($qbt));

	echo '</select>
	</td>
	</tr>
	</table>
	<br>';


	//nek blm dipilih
	if (empty($progdi))
		{
		echo '<font color="#FF0000"><strong>PROGRAM PENDIDIKAN Belum Dipilih...!</strong></font>';
		}
	else if (empty($kelkd))
		{
		echo '<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>';
		}
	else
		{
		//data ne....
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT DISTINCT(m_mahasiswa.kd) AS mskd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"ORDER BY round(m_mahasiswa.nim) ASC";
		$sqlresult = $sqlcount;

		$count = mysqli_num_rows(mysqli_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$target = $ke;
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);

		echo '<table width="500" border="1" cellpadding="3" cellspacing="0">
	    	<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="50" valign="top"><strong>NIM</strong></td>
		<td valign="top"><strong>Nama</strong></td>
		<td width="150" valign="top"><strong>Postdate</strong></td>
	    	</tr>';

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

				$i_nomer = $i_nomer + 1;
				$i_kd = nosql($data['mskd']);
				
				
				//detail
				$qku = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
										"WHERE kd = '$i_kd'");
				$rku = mysqli_fetch_assoc($qku);
				
				$i_nim = nosql($rku['nim']);
				$i_nama = balikin($rku['nama']);
				$i_postdate = $rku['postdate'];

				//nek null
				if ($postdate == "0000-00-00 00:00:00")
					{
					$postdate = "-";
					}

				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td><input name="kd'.$i_nomer.'" type="hidden" value="'.$i_kd.'">
				<input type="radio" name="item" value="'.$i_kd.'">
				</td>
				<td valign="top">
				'.$i_nim.'
				</td>
				<td valign="top">
				'.$i_nama.'
				</td>
				<td valign="top">
				'.$i_postdate.'
				</td>
				</tr>';
		  		}
			while ($data = mysqli_fetch_assoc($result));
			}

		echo '</table>
		<table width="500" border="0" cellspacing="0" cellpadding="3">
	    	<tr>
		<td width="100">
		<input name="btnRST" type="submit" value="RESET">
		<input name="jml" type="hidden" value="'.$limit.'">
		<input name="progdi" type="hidden" value="'.$progdi.'">
		<input name="kelkd" type="hidden" value="'.$kelkd.'">
		<input name="tpkd" type="hidden" value="'.$tpkd.'">
		<input name="tipe" type="hidden" value="'.$tipe.'">
		<input name="page" type="hidden" value="'.$page.'">
		<input name="total" type="hidden" value="'.$count.'">
		</td>
		<td align="right"><font color="#FF0000"><strong>'.$count.'</strong></font> Data '.$pagelist.'</td>
	    	</tr>
		</table>
		<br>
		<br>';
		}
	}





//nek DIREKTUR ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if ($tpkd == "tp04")
	{
	//view
	echo '<p>
	Pegawai :
	<br>
	<select name="pegawai">
	<option value="" selected></option>';

	$qpgd = mysqli_query($koneksi, "SELECT * FROM m_pegawai ".
				"ORDER BY nama ASC");
	$rpgd = mysqli_fetch_assoc($qpgd);

	do
		{
		$pgd_kd = nosql($rpgd['kd']);
		$pgd_nip = nosql($rpgd['nip']);
		$pgd_nama = balikin2($rpgd['nama']);

		echo '<option value="'.$pgd_kd.'">'.$pgd_nip.'. '.$pgd_nama.'</option>';
		}
	while ($rpgd = mysqli_fetch_assoc($qpgd));

	echo '</select>
	<br>
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="btnRST" type="submit" value="TAMBAH >>">
	</p>

	<p>
	<table width="500" border="1" cellpadding="3" cellspacing="0">
    	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="100" valign="top"><strong>NIP</strong></td>
	<td valign="top"><strong>Nama</strong></td>
    	</tr>';

	//terpilih
	$qpgdx = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, adm_direktur.* ".
				"FROM m_pegawai, adm_direktur ".
				"WHERE adm_direktur.kd_pegawai = m_pegawai.kd ".
				"ORDER BY m_pegawai.nama ASC");
	$rpgdx = mysqli_fetch_assoc($qpgdx);
	$tpgdx = mysqli_num_rows($qpgdx);

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
		$pgdx_kd = nosql($rpgdx['mpkd']);
		$pgdx_nip = nosql($rpgdx['nip']);
		$pgdx_nama = balikin2($rpgdx['nama']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input name="kd'.$nomer.'" type="hidden" value="'.$pgdx_kd.'">
		<input type="checkbox" name="item'.$nomer.'" value="'.$pgdx_kd.'">
		</td>
		<td valign="top">
		'.$pgdx_nip.'
		</td>
		<td valign="top">
		'.$pgdx_nama.'
		</td>
		</tr>';
		}
	while ($rpgdx = mysqli_fetch_assoc($qpgdx));

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
    	<tr>
	<td width="100">
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="page" type="hidden" value="'.$page.'">
	<input name="jml" type="hidden" value="'.$tpgdx.'">
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$tpgdx.')">
	<input name="btnBTL" type="reset" value="BATAL">
	<input name="btnHPS" type="submit" value="HAPUS">
	</td>
    	</tr>
	</table>
	</p>';
	}





//nek BAAK ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if ($tpkd == "tp06")
	{
	//view
	echo '<p>
	Pegawai :
	<br>
	<select name="pegawai">
	<option value="" selected></option>';

	$qpgd = mysqli_query($koneksi, "SELECT * FROM m_pegawai ".
				"ORDER BY nama ASC");
	$rpgd = mysqli_fetch_assoc($qpgd);

	do
		{
		$pgd_kd = nosql($rpgd['kd']);
		$pgd_nip = nosql($rpgd['nip']);
		$pgd_nama = balikin2($rpgd['nama']);

		echo '<option value="'.$pgd_kd.'">'.$pgd_nip.'. '.$pgd_nama.'</option>';
		}
	while ($rpgd = mysqli_fetch_assoc($qpgd));

	echo '</select>
	<br>
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="btnRST" type="submit" value="TAMBAH >>">
	</p>

	<p>
	<table width="500" border="1" cellpadding="3" cellspacing="0">
    	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="100" valign="top"><strong>NIP</strong></td>
	<td valign="top"><strong>Nama</strong></td>
    	</tr>';

	//terpilih
	$qpgdx = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, adm_baak.* ".
				"FROM m_pegawai, adm_baak ".
				"WHERE adm_baak.kd_pegawai = m_pegawai.kd ".
				"ORDER BY m_pegawai.nama ASC");
	$rpgdx = mysqli_fetch_assoc($qpgdx);
	$tpgdx = mysqli_num_rows($qpgdx);

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
		$pgdx_kd = nosql($rpgdx['mpkd']);
		$pgdx_nip = nosql($rpgdx['nip']);
		$pgdx_nama = balikin2($rpgdx['nama']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input name="kd'.$nomer.'" type="hidden" value="'.$pgdx_kd.'">
		<input type="checkbox" name="item'.$nomer.'" value="'.$pgdx_kd.'">
		</td>
		<td valign="top">
		'.$pgdx_nip.'
		</td>
		<td valign="top">
		'.$pgdx_nama.'
		</td>
		</tr>';
		}
	while ($rpgdx = mysqli_fetch_assoc($qpgdx));

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
    	<tr>
	<td width="100">
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="page" type="hidden" value="'.$page.'">
	<input name="jml" type="hidden" value="'.$tpgdx.'">
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$tpgdx.')">
	<input name="btnBTL" type="reset" value="BATAL">
	<input name="btnHPS" type="submit" value="HAPUS">
	</td>
    	</tr>
	</table>
	</p>';
	}






//nek BAU ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if ($tpkd == "tp07")
	{
	//view
	echo '<p>
	Pegawai :
	<br>
	<select name="pegawai">
	<option value="" selected></option>';

	$qpgd = mysqli_query($koneksi, "SELECT * FROM m_pegawai ".
				"ORDER BY nama ASC");
	$rpgd = mysqli_fetch_assoc($qpgd);

	do
		{
		$pgd_kd = nosql($rpgd['kd']);
		$pgd_nip = nosql($rpgd['nip']);
		$pgd_nama = balikin2($rpgd['nama']);

		echo '<option value="'.$pgd_kd.'">'.$pgd_nip.'. '.$pgd_nama.'</option>';
		}
	while ($rpgd = mysqli_fetch_assoc($qpgd));

	echo '</select>
	<br>
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="btnRST" type="submit" value="TAMBAH >>">
	</p>

	<p>
	<table width="500" border="1" cellpadding="3" cellspacing="0">
    	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="100" valign="top"><strong>NIP</strong></td>
	<td valign="top"><strong>Nama</strong></td>
    	</tr>';

	//terpilih
	$qpgdx = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, adm_bau.* ".
				"FROM m_pegawai, adm_bau ".
				"WHERE adm_bau.kd_pegawai = m_pegawai.kd ".
				"ORDER BY m_pegawai.nama ASC");
	$rpgdx = mysqli_fetch_assoc($qpgdx);
	$tpgdx = mysqli_num_rows($qpgdx);

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
		$pgdx_kd = nosql($rpgdx['mpkd']);
		$pgdx_nip = nosql($rpgdx['nip']);
		$pgdx_nama = balikin2($rpgdx['nama']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input name="kd'.$nomer.'" type="hidden" value="'.$pgdx_kd.'">
		<input type="checkbox" name="item'.$nomer.'" value="'.$pgdx_kd.'">
		</td>
		<td valign="top">
		'.$pgdx_nip.'
		</td>
		<td valign="top">
		'.$pgdx_nama.'
		</td>
		</tr>';
		}
	while ($rpgdx = mysqli_fetch_assoc($qpgdx));

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
    	<tr>
	<td width="100">
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="page" type="hidden" value="'.$page.'">
	<input name="jml" type="hidden" value="'.$tpgdx.'">
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$tpgdx.')">
	<input name="btnBTL" type="reset" value="BATAL">
	<input name="btnHPS" type="submit" value="HAPUS">
	</td>
    	</tr>
	</table>
	</p>';
	}





//nek Kemahasiswaan ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if ($tpkd == "tp08")
	{
	//view
	echo '<p>
	Pegawai :
	<br>
	<select name="pegawai">
	<option value="" selected></option>';

	$qpgd = mysqli_query($koneksi, "SELECT * FROM m_pegawai ".
				"ORDER BY nama ASC");
	$rpgd = mysqli_fetch_assoc($qpgd);

	do
		{
		$pgd_kd = nosql($rpgd['kd']);
		$pgd_nip = nosql($rpgd['nip']);
		$pgd_nama = balikin2($rpgd['nama']);

		echo '<option value="'.$pgd_kd.'">'.$pgd_nip.'. '.$pgd_nama.'</option>';
		}
	while ($rpgd = mysqli_fetch_assoc($qpgd));

	echo '</select>
	<br>
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="btnRST" type="submit" value="TAMBAH >>">
	</p>

	<p>
	<table width="500" border="1" cellpadding="3" cellspacing="0">
    	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="100" valign="top"><strong>NIP</strong></td>
	<td valign="top"><strong>Nama</strong></td>
    	</tr>';

	//terpilih
	$qpgdx = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, adm_kemhs.* ".
				"FROM m_pegawai, adm_kemhs ".
				"WHERE adm_kemhs.kd_pegawai = m_pegawai.kd ".
				"ORDER BY m_pegawai.nama ASC");
	$rpgdx = mysqli_fetch_assoc($qpgdx);
	$tpgdx = mysqli_num_rows($qpgdx);

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
		$pgdx_kd = nosql($rpgdx['mpkd']);
		$pgdx_nip = nosql($rpgdx['nip']);
		$pgdx_nama = balikin2($rpgdx['nama']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input name="kd'.$nomer.'" type="hidden" value="'.$pgdx_kd.'">
		<input type="checkbox" name="item'.$nomer.'" value="'.$pgdx_kd.'">
		</td>
		<td valign="top">
		'.$pgdx_nip.'
		</td>
		<td valign="top">
		'.$pgdx_nama.'
		</td>
		</tr>';
		}
	while ($rpgdx = mysqli_fetch_assoc($qpgdx));

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
    	<tr>
	<td width="100">
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="page" type="hidden" value="'.$page.'">
	<input name="jml" type="hidden" value="'.$tpgdx.'">
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$tpgdx.')">
	<input name="btnBTL" type="reset" value="BATAL">
	<input name="btnHPS" type="submit" value="HAPUS">
	</td>
    	</tr>
	</table>
	</p>';
	}






//nek BAK ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if ($tpkd == "tp09")
	{
	//view
	echo '<p>
	Pegawai :
	<br>
	<select name="pegawai">
	<option value="" selected></option>';

	$qpgd = mysqli_query($koneksi, "SELECT * FROM m_pegawai ".
				"ORDER BY nama ASC");
	$rpgd = mysqli_fetch_assoc($qpgd);

	do
		{
		$pgd_kd = nosql($rpgd['kd']);
		$pgd_nip = nosql($rpgd['nip']);
		$pgd_nama = balikin2($rpgd['nama']);

		echo '<option value="'.$pgd_kd.'">'.$pgd_nip.'. '.$pgd_nama.'</option>';
		}
	while ($rpgd = mysqli_fetch_assoc($qpgd));

	echo '</select>
	<br>
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="btnRST" type="submit" value="TAMBAH >>">
	</p>

	<p>
	<table width="500" border="1" cellpadding="3" cellspacing="0">
    	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="100" valign="top"><strong>NIP</strong></td>
	<td valign="top"><strong>Nama</strong></td>
    	</tr>';

	//terpilih
	$qpgdx = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, adm_bak.* ".
				"FROM m_pegawai, adm_bak ".
				"WHERE adm_bak.kd_pegawai = m_pegawai.kd ".
				"ORDER BY m_pegawai.nama ASC");
	$rpgdx = mysqli_fetch_assoc($qpgdx);
	$tpgdx = mysqli_num_rows($qpgdx);

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
		$pgdx_kd = nosql($rpgdx['mpkd']);
		$pgdx_nip = nosql($rpgdx['nip']);
		$pgdx_nama = balikin2($rpgdx['nama']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input name="kd'.$nomer.'" type="hidden" value="'.$pgdx_kd.'">
		<input type="checkbox" name="item'.$nomer.'" value="'.$pgdx_kd.'">
		</td>
		<td valign="top">
		'.$pgdx_nip.'
		</td>
		<td valign="top">
		'.$pgdx_nama.'
		</td>
		</tr>';
		}
	while ($rpgdx = mysqli_fetch_assoc($qpgdx));

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
    	<tr>
	<td width="100">
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="page" type="hidden" value="'.$page.'">
	<input name="jml" type="hidden" value="'.$tpgdx.'">
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$tpgdx.')">
	<input name="btnBTL" type="reset" value="BATAL">
	<input name="btnHPS" type="submit" value="HAPUS">
	</td>
    	</tr>
	</table>
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