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


//nilai
$maine = "$sumber/admbau/index.php";


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table bgcolor="#E4D6CC" width="100%" border="0" cellspacing="0" cellpadding="5">
<tr>
<td>';
//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//home //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<a href="'.$maine.'" title="Home" class="menuku"><strong>HOME</strong>&nbsp;&nbsp;</a> | ';
//home //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//setting ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="#" data-flexmenu="flexmenu1" class="menuku"><strong>SETTING</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu1" class="flexdropdownmenu">
<LI>
<a href="'.$sumber.'/admbau/s/pass.php" title="Ganti Password">Ganti Password</a>
</LI>
</UL>';
//setting ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








//inventaris ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="#" data-flexmenu="flexmenu7"><strong>INVENTARIS</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu7" class="flexdropdownmenu">
<LI>
<a href="'.$sumber.'/admbau/inv/ruang.php" title="Daftar Ruang Gedung">Daftar Ruang Gedung</a>
</LI>

<LI>
<a href="'.$sumber.'/admbau/inv/brg.php" title="Daftar Barang">Daftar Barang</a>
</LI>
<LI>
<a href="'.$sumber.'/admbau/inv/tmp_brg.php" title="Penempatan per Barang">Penempatan per Barang</a>
</LI>
<LI>
<a href="'.$sumber.'/admbau/inv/tmp_progdi.php" title="Penempatan per Program Studi">Penempatan per Program Studi</a>
</LI>
<LI>
<a href="'.$sumber.'/admbau/inv/lab.php" title="Laboratorium">Laboratorium</a>
</LI>
<LI>
<a href="'.$sumber.'/admbau/inv/tmp_lab.php" title="Penempatan Barang per Lab.">Penempatan Barang per Lab.</a>
</LI>
</UL>';
//inventaris ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//surat /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="#" data-flexmenu="flexmenu8"><strong>SURAT</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu8" class="flexdropdownmenu">
<LI>
<a href="#" title="Master">Master</a>
	<UL>
	<LI>
	<a href="'.$sumber.'/admbau/surat/m_klasifikasi.php" title="Klasifikasi Surat">Klasifikasi Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbau/surat/m_lemari.php" title="Lemari Surat">Lemari Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbau/surat/m_rak.php" title="Rak Surat">Rak Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbau/surat/m_ruang.php" title="Ruang Surat">Ruang Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbau/surat/m_map.php" title="Map Surat">Map Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbau/surat/m_sifat.php" title="Sifat Surat">Sifat Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbau/surat/m_status.php" title="Status Surat">Status Surat</a>
	</LI>
	</UL>
</LI>

<LI>
<a href="#" title="Surat Masuk">Surat Masuk</a>
	<UL>
	<LI>
	<a href="'.$sumber.'/admbau/surat/masuk.php" title="Data Surat Masuk">Data Surat Masuk</a>
	</LI>

	<LI>
	<a href="'.$sumber.'/admbau/surat/penempatan_masuk.php" title="Penempatan Surat Masuk">Penempatan Surat Masuk</a>
	</LI>

	<LI>
	<a href="'.$sumber.'/admbau/surat/cari_masuk.php" title="Cari Surat Masuk">Cari Surat Masuk</a>
	</LI>
	</UL>
</LI>



<LI>
<a href="#" title="Surat Keluar">Surat Keluar</a>
	<UL>
	<LI>
	<a href="'.$sumber.'/admbau/surat/keluar.php" title="Data Surat Keluar">Data Surat Keluar</a>
	</LI>

	<LI>
	<a href="'.$sumber.'/admbau/surat/penempatan_keluar.php" title="Penempatan Surat Masuk">Penempatan Surat Keluar</a>
	</LI>

	<LI>
	<a href="'.$sumber.'/admbau/surat/cari_keluar.php" title="Cari Surat Keluar">Cari Surat Keluar</a>
	</LI>
	</UL>
</LI>

</UL>';
//surat /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//logout ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="'.$sumber.'/admbau/logout.php" title="Logout / KELUAR" class="menuku"><strong>LogOut</strong></A>
</td>
</tr>
</table>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>