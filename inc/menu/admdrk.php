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
$maine = "$sumber/admdrk/index.php";


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
<a href="'.$sumber.'/admdrk/s/pass.php" title="Ganti Password">Ganti Password</a>
</LI>
</UL>';
//setting ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//data ukm //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<a href="'.$sumber.'/admdrk/d/ukm.php" title="Data UKM" class="menuku"><strong>Data UKM</strong>&nbsp;&nbsp;</a> | ';
//data ukm //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//mahasiswa ///////////////////////////////////////////////////////////////////////////////////////////////////
echo '<a href="#" data-flexmenu="flexmenu2" class="menuku" title="Mahasiswa"><strong>Mahasiswa</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu2" class="flexdropdownmenu">
	<LI>
	<a href="'.$sumber.'/admdrk/akad/ukm.php" title="Data UKM">Data UKM</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/akad/bea_siswa.php" title="Data Bea Siswa">Data Bea Siswa</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/akad/mhs.php" title="Data Mahasiswa">Data Mahasiswa</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/akad/mhs_tmp.php" title="Penempatan Kelas Mahasiswa">Penempatan Kelas Mahasiswa</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/akad/mhs_per_jenis.php" title="Data Mahasiswa per Jenis">Data Mahasiswa per Jenis</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/akad/mhs_absensi.php" title="Data Absensi">Data Absensi</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/akad/mhs_krs.php" title="Data KRS">Data KRS</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/akad/mhs_khs.php" title="Data KHS">Data KHS</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/akad/mhs_transkrip.php" title="Data Transkrip Nilai">Data Transkrip Nilai</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/akad/mhs_ijazah.php" title="Data Ijazah">Data Ijazah</a>
	</LI>
</UL>';
///////////////////////////////////////////////////////////////////////////////////////////////////////////////






//inventaris ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="#" data-flexmenu="flexmenu7"><strong>INVENTARIS</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu7" class="flexdropdownmenu">
<LI>
<a href="'.$sumber.'/admdrk/inv/brg.php" title="Daftar Barang">Daftar Barang</a>
</LI>
<LI>
<a href="'.$sumber.'/admdrk/inv/tmp_brg.php" title="Penempatan per Barang">Penempatan per Barang</a>
</LI>
<LI>
<a href="'.$sumber.'/admdrk/inv/tmp_progdi.php" title="Penempatan per Program Studi">Penempatan per Program Studi</a>
</LI>
<LI>
<a href="'.$sumber.'/admdrk/inv/lab.php" title="Laboratorium">Laboratorium</a>
</LI>
<LI>
<a href="'.$sumber.'/admdrk/inv/peng_lab.php" title="Penggunaan Lab.">Penggunaan Lab.</a>
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
	<a href="'.$sumber.'/admdrk/surat/m_klasifikasi.php" title="Klasifikasi Surat">Klasifikasi Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/surat/m_lemari.php" title="Lemari Surat">Lemari Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/surat/m_rak.php" title="Rak Surat">Rak Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/surat/m_ruang.php" title="Ruang Surat">Ruang Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/surat/m_map.php" title="Map Surat">Map Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/surat/m_sifat.php" title="Sifat Surat">Sifat Surat</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admdrk/surat/m_status.php" title="Status Surat">Status Surat</a>
	</LI>
	</UL>
</LI>

<LI>
<a href="#" title="Surat Masuk">Surat Masuk</a>
	<UL>
	<LI>
	<a href="'.$sumber.'/admdrk/surat/masuk.php" title="Data Surat Masuk">Data Surat Masuk</a>
	</LI>

	<LI>
	<a href="'.$sumber.'/admdrk/surat/penempatan_masuk.php" title="Penempatan Surat Masuk">Penempatan Surat Masuk</a>
	</LI>

	<LI>
	<a href="'.$sumber.'/admdrk/surat/cari_masuk.php" title="Cari Surat Masuk">Cari Surat Masuk</a>
	</LI>
	</UL>
</LI>



<LI>
<a href="#" title="Surat Keluar">Surat Keluar</a>
	<UL>
	<LI>
	<a href="'.$sumber.'/admdrk/surat/keluar.php" title="Data Surat Keluar">Data Surat Keluar</a>
	</LI>

	<LI>
	<a href="'.$sumber.'/admdrk/surat/penempatan_keluar.php" title="Penempatan Surat Masuk">Penempatan Surat Keluar</a>
	</LI>

	<LI>
	<a href="'.$sumber.'/admdrk/surat/cari_keluar.php" title="Cari Surat Keluar">Cari Surat Keluar</a>
	</LI>
	</UL>
</LI>

</UL>';
//surat /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//rekap ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="#" data-flexmenu="flexmenu12" class="menuku"><strong>KEUANGAN</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu12" class="flexdropdownmenu">';

//daftar jenis keuangan
$qdt = mysql_query("SELECT * FROM m_keu_jenis ".
			"ORDER BY nama ASC");
$rdt = mysql_fetch_assoc($qdt);

do
	{
	//nilai
	$dt_kd = nosql($rdt['kd']);
	$dt_jenis = balikin($rdt['nama']);

	echo '<LI>
	<a href="#" title="'.$dt_jenis.'">'.$dt_jenis.'</a>';

	//jika SS (Sumbangan Sukarela)
	if ($dt_kd == "f3b22b92155c4bc1ecb1b6db7dd56b91")
		{
		echo '<UL>
		<LI>
		<a href="'.$sumber.'/admdrk/keu/lap_hr.php?jnskd='.$dt_kd.'" title="Laporan Harian">Laporan Harian</a>
		</LI>
		<LI>
		<a href="'.$sumber.'/admdrk/keu/lap_bln.php?jnskd='.$dt_kd.'" title="Laporan Bulanan">Laporan Bulanan</a>
		</LI>
		<LI>
		<a href="'.$sumber.'/admdrk/keu/lap_mhs.php?jnskd='.$dt_kd.'" title="Laporan Data Mahasiswa">Laporan Data Mahasiswa</a>
		</LI>
		</UL>';
		}

	else
		{
		echo '<UL>
		<LI>
		<a href="'.$sumber.'/admdrk/keu/lap_hr.php?jnskd='.$dt_kd.'" title="Laporan Harian">Laporan Harian</a>
		</LI>
		<LI>
		<a href="'.$sumber.'/admdrk/keu/lap_bln.php?jnskd='.$dt_kd.'" title="Laporan Bulanan">Laporan Bulanan</a>
		</LI>
		</UL>';
		}

	echo '</LI>';
	}
while ($rdt = mysql_fetch_assoc($qdt));

echo '</UL>';
//rekap ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//laporan ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="#" data-flexmenu="flexmenu17" class="menuku"><strong>LAPORAN</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu17" class="flexdropdownmenu">
<LI>
<a href="'.$sumber.'/admdrk/lap/piutang_mhs.php" title="Lap.Piutang Mahasiswa">Lap.Piutang Mahasiswa</a>
</LI>
<LI>
<a href="'.$sumber.'/admdrk/lap/piutang_biaya.php" title="Lap.Piutang Biaya">Lap.Piutang Biaya</a>
</LI>
</UL>';
//laporan ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//logout ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="'.$sumber.'/admdrk/logout.php" title="Logout / KELUAR" class="menuku"><strong>LogOut</strong></A>
</td>
</tr>
</table>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>