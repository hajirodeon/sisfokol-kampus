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
$filenya = "kuisioner_dosen.php";
$judul = "Kuisioner Dosen";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kdi = nosql($_REQUEST['kdi']);
$dkd = nosql($_REQUEST['dkd']);




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
	$kdx = nosql($_REQUEST['kd']);

	//query
	$qx = mysql_query("SELECT * FROM m_kuisioner_dosen ".
				"WHERE kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$e_nama = balikin($rowx['nama']);
	}



//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$e_nama = cegah2($_POST['e_nama']);

	//nek null
	if (empty($e_nama))
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{ ///cek
		$qcc = mysql_query("SELECT * FROM m_kuisioner_dosen ".
								"WHERE e_nama = '$e_nama'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//nek ada
		if ($tcc != 0)
			{
			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Sudah Ada. Silahkan Ganti Yang Lain...!!";
			pekem($pesan,$filenya);
			exit();
			}
		else
			{
			//jika baru
			if (empty($s))
				{
				//query
				mysql_query("INSERT INTO m_kuisioner_dosen(kd, nama, postdate) VALUES ".
								"('$x', '$e_nama', '$today')");

				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				xloc($filenya);
				exit();
				}
			//jika update
			else if ($s == "edit")
				{
				//query
				mysql_query("UPDATE m_kuisioner_dosen SET nama = '$e_nama', ".
								"postdate = '$today' ".
								"WHERE kd = '$kd'");

				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				xloc($filenya);
				exit();
				}
			}
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
		mysql_query("DELETE FROM m_kuisioner_dosen ".
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

//js
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/js/jumpmenu.js");
require("../../inc/menu/admbaak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';



//query
$q = mysql_query("SELECT * FROM m_kuisioner_dosen ".
					"ORDER BY nama ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

//jika null
if (empty($s))
	{
	echo '<p>
	<input name="e_nama" type="text" value="'.$e_nama.'" size="50">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="btnSMP" type="submit" value="SIMPAN">
	<input name="btnBTL" type="submit" value="BATAL">
	</p>';
	
	if ($total != 0)
		{
		echo 'Dosen : ';
		echo "<select name=\"dosen\" onChange=\"MM_jumpMenu('self',this,0)\">";
		//terpilih
		$qtpx = mysql_query("SELECT * FROM m_pegawai ".
								"WHERE kd = '$dkd'");
		$rowtpx = mysql_fetch_assoc($qtpx);
		$tpx_kd = nosql($rowtpx['kd']);
		$tpx_nip = balikin($rowtpx['nip']);
		$tpx_nama = balikin($rowtpx['nama']);
		
		echo '<option value="'.$tpx_kd.'" selected>'.$tpx_nip.'. '.$tpx_nama.'</option>';
		
		$qtp = mysql_query("SELECT DISTINCT(dosen.kd_pegawai) AS dkd ".
							"FROM dosen, m_pegawai ".
							"WHERE dosen.kd_pegawai = m_pegawai.kd ".
							"ORDER BY nama ASC");
		$rowtp = mysql_fetch_assoc($qtp);
		
		do
			{
			$tpkd = nosql($rowtp['dkd']);
			
			//terpilih
			$qtpx = mysql_query("SELECT * FROM m_pegawai ".
									"WHERE kd = '$tpkd'");
			$rowtpx = mysql_fetch_assoc($qtpx);
			$tpx_nip = balikin($rowtpx['nip']);
			$tpx_nama = balikin($rowtpx['nama']);
			
			echo '<option value="'.$filenya.'?dkd='.$tpkd.'">'.$tpx_nip.'. '.$tpx_nama.'</option>';
			}
		while ($rowtp = mysql_fetch_assoc($qtp));
		
		echo '</select>
				
		<table width="1100" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Jml. Amat Baik</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Jml. Baik</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Jml. Cukup</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Jml. Kurang</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Jml. Ya</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Jml. Tidak</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Postdate</font></strong></td>
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
			$i_nama = balikin($row['nama']);
			$i_postdate = $row['postdate'];
	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$i_nomer.'" value="'.$i_kd.'">
	        </td>
			<td>
			'.$i_nama.'</td>
			<td>';

			
			//jika ada dosen
			if (!empty($dkd))
				{
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Amat Baik' ".
											"AND kd_pegawai = '$dkd'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$arrbln3[$k].' = '.$tku.'
				</td>
				<td>';
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Baik' ".
											"AND kd_pegawai = '$dkd'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$tku.'
				</td>
				<td>';
	
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Cukup' ".
											"AND kd_pegawai = '$dkd'");
				$tku = mysql_num_rows($qku);

				echo ''.$tku.'
				</td>
				<td>';
	
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Kurang' ".
											"AND kd_pegawai = '$dkd'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$tku.'
				</td>
				<td>';
	
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Ya' ".
											"AND kd_pegawai = '$dkd'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$tku.'
				</td>
				<td>';
	
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Tidak' ".
											"AND kd_pegawai = '$dkd'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$tku.'
				</td>';
					
				}
			else 
				{
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Amat Baik'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$tku.'
				</td>
				<td>';
	
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Baik'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$tku.'
				</td>
				<td>';
	
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Cukup'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$tku.'
				</td>
				<td>';
	
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Kurang'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$tku.'
				</td>
				<td>';
	
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Ya'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$tku.'
				</td>
				<td>';
	
				//nilai
				$nil_kolom = "jawaban_1";
				$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
											"WHERE kd_kuisioner_dosen = '$i_kd' ".
											"AND $nil_kolom = 'Tidak'");
				$tku = mysql_num_rows($qku);
				
				echo ''.$tku.'
				</td>';
				}

			echo '<td>'.$i_postdate.'</td>
	       	</tr>';
			}
		while ($row = mysql_fetch_assoc($q));
	
		echo '</table>
		<table width="400" border="0" cellspacing="0" cellpadding="3">
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
	}


else 
	{
	//query
	$q = mysql_query("SELECT * FROM m_kuisioner_dosen ".
						"WHERE kd = '$kdi'");
	$row = mysql_fetch_assoc($q);
	$nil_kuis = balikin($row['nama']);
	
	echo '<a href="'.$filenya.'">Kembali ke Daftar Kuisioner</a>
	<h2>'.$nil_kuis.'</h2>';	
	
	
	
	//query
	$q = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
						"WHERE kd_kuisioner_dosen = '$kdi' ".
						"ORDER BY postdate DESC");
	$row = mysql_fetch_assoc($q);
	$total = mysql_num_rows($q);

	if ($total != 0)
		{
		echo '<table width="1100" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="5"><strong><font color="'.$warnatext.'">No.</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama Mahasiswa</font></strong></td>
		<td width="50">
		<strong><font color="'.$warnatext.'">Amat Baik</font></strong>';
	
		//nilai
		$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
									"WHERE kd_kuisioner_dosen = '$kdi' ".
									"AND jawaban_1 = 'Amat Baik'");
		$tku = mysql_num_rows($qku);
		
		echo '<br>
		(Jml:'.$tku.')
		</td>
		<td width="50">
		<strong><font color="'.$warnatext.'">Baik</font></strong>';
	
		//nilai
		$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
									"WHERE kd_kuisioner_dosen = '$kdi' ".
									"AND jawaban_1 = 'Baik'");
		$tku = mysql_num_rows($qku);
		
		echo '<br>
		(Jml:'.$tku.')
		</td>
		<td width="50">
		<strong><font color="'.$warnatext.'">Cukup</font></strong>';
	
		//nilai
		$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
									"WHERE kd_kuisioner_dosen = '$kdi' ".
									"AND jawaban_1 = 'Cukup'");
		$tku = mysql_num_rows($qku);
		
		echo '<br>
		(Jml:'.$tku.')
		</td>
		<td width="50">
		<strong><font color="'.$warnatext.'">Kurang</font></strong>';
	
		//nilai
		$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
									"WHERE kd_kuisioner_dosen = '$kdi' ".
									"AND jawaban_1 = 'Kurang'");
		$tku = mysql_num_rows($qku);
		
		echo '<br>
		(Jml:'.$tku.')
		</td>
		<td width="50">
		<strong><font color="'.$warnatext.'">Ya</font></strong>';
	
		//nilai
		$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
									"WHERE kd_kuisioner_dosen = '$kdi' ".
									"AND jawaban_1 = 'Ya'");
		$tku = mysql_num_rows($qku);
		
		echo '<br>
		(Jml:'.$tku.')
		</td>
		<td width="50">
		<strong><font color="'.$warnatext.'">Tidak</font></strong>';
	
		//nilai
		$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
									"WHERE kd_kuisioner_dosen = '$kdi' ".
									"AND jawaban_1 = 'Tidak'");
		$tku = mysql_num_rows($qku);
		
		echo '<br>
		(Jml:'.$tku.')
		</td>
		<td width="50"><strong><font color="'.$warnatext.'">Postdate</font></strong></td>
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
			$i_kd_mahasiswa = nosql($row['kd_mahasiswa']);				
			$i_jawaban = balikin($row['jawaban']);
			$i_postdate = $row['postdate'];
			
			
			//mahasiswa
			$qku = mysql_query("SELECT * FROM m_mahasiswa ".
									"WHERE kd = '$i_kd_mahasiswa'");
			$rku = mysql_fetch_assoc($qku);
			$ku_nim = balikin($rku['nim']);
			$ku_nama = balikin($rku['nama']);
	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$i_nomer.'.</td>
			<td>'.$ku_nim.'. '.$ku_nama.'</td>
			<td>';
	
			//nilai
			$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
										"WHERE kd_kuisioner_dosen = '$kdi' ".
										"AND jawaban_1 = 'Amat Baik'");
			$tku = mysql_num_rows($qku);
			
			echo ''.$tku.'</td>
			<td>';
	
			//nilai
			$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
										"WHERE kd_kuisioner_dosen = '$kdi' ".
										"AND jawaban_1 = 'Baik'");
			$tku = mysql_num_rows($qku);
			
			echo ''.$tku.'</td>
			<td>';
	
			//nilai
			$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
										"WHERE kd_kuisioner_dosen = '$kdi' ".
										"AND jawaban_1 = 'Cukup'");
			$tku = mysql_num_rows($qku);
			
			echo ''.$tku.'</td>
			<td>';
	
			//nilai
			$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
										"WHERE kd_kuisioner_dosen = '$kdi' ".
										"AND jawaban_1 = 'Kurang'");
			$tku = mysql_num_rows($qku);
			
			echo ''.$tku.'</td>
			<td>';
	
			//nilai
			$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
										"WHERE kd_kuisioner_dosen = '$kdi' ".
										"AND jawaban_1 = 'Ya'");
			$tku = mysql_num_rows($qku);
			
			echo ''.$tku.'</td>
			<td>';
	
			//nilai
			$qku = mysql_query("SELECT * FROM mahasiswa_kuisioner_dosen ".
										"WHERE kd_kuisioner_dosen = '$kdi' ".
										"AND jawaban_1 = 'Tidak'");
			$tku = mysql_num_rows($qku);
			
			echo ''.$tku.'</td>
			<td>'.$i_postdate.'</td>
	       	</tr>';
			}
		while ($row = mysql_fetch_assoc($q));
	
		echo '</table>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>TIDAK ADA DATA. </strong>
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