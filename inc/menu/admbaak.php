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
$maine = "$sumber/admbaak/index.php";


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
<a href="'.$sumber.'/admbaak/s/pass.php" title="Ganti Password">Ganti Password</a>
</LI>
<LI>
<a href="'.$sumber.'/admbaak/s/krs.php" title="Waktu Pengisian KRS">Waktu Pengisian KRS</a>
</LI>
<LI>
<a href="'.$sumber.'/admbaak/s/rumus.php" title="Rumus Nilai">Rumus Nilai</a>
</LI>
</UL>';
//setting ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//AKADEMIK ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="#" data-flexmenu="flexmenu3"><strong>AKADEMIK</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu3" class="flexdropdownmenu">
<LI>
<a href="'.$sumber.'/admbaak/akad/tapel.php" title="Data Tahun Akademik">Data Tahun Akademik</a>
</LI>

<LI>
<a href="'.$sumber.'/admbaak/akad/kelas.php" title="Data Kelas">Data Kelas</a>
</LI>

<LI>
<a href="'.$sumber.'/admbaak/akad/prodi.php" title="Data Program Studi">Data Program Studi</a>
</LI>

<LI>
<a href="#" title="Mata Kuliah">Mata Kuliah</a>
	<UL>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/makul.php" title="Data Mata Kuliah">Data Mata Kuliah</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/makul_tmp.php" title="Penempatan Mata Kuliah">Penempatan Mata Kuliah</a>
	</LI>
	</UL>
</LI>

<LI>
<a href="#" title="Dosen">Dosen</a>
	<UL>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/dosen.php" title="Data Dosen">Data Dosen</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/dosen_tmp.php" title="Penempatan per Dosen">Penempatan per Dosen</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/dosen_makul.php" title="Penempatan per Mata Kuliah">Penempatan per Mata Kuliah</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/dosen_pbb.php" title="Dosen Pembimbing">Dosen Pembimbing</a>
	</LI>
	</UL>
</LI>
<LI>
<a href="#" title="Mahasiswa">Mahasiswa</a>
	<UL>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/mhs.php" title="Data Mahasiswa">Data Mahasiswa</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/mhs_tmp.php" title="Penempatan Kelas Mahasiswa">Penempatan Kelas Mahasiswa</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/mhs_jenis.php" title="Penempatan Mahasiswa Reguler ke Extensi">Penempatan Mahasiswa Reguler ke Extensi</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/mhs_absensi.php" title="Data Absensi">Data Absensi</a>
	</LI>
	
	<LI>
	<a href="#" title="KRS">KRS</a>
		<UL>		
		<LI>
		<a href="'.$sumber.'/admbaak/akad/mhs_krs.php" title="Data KRS">Data KRS</a>
		</LI>
		
		<LI>
		<a href="'.$sumber.'/admbaak/akad/mhs_krs_sah.php" title="Daftar KRS Sah">Daftar KRS Sah</a>
		</LI>
		</UL>
	</LI>
	
	<LI>
	<a href="#" title="NILAI">NILAI</a>
		<UL>		
		<LI>
		<a href="'.$sumber.'/admbaak/akad/mhs_khs.php" title="Data KHS">Data KHS</a>
		</LI>
		
		<LI>
		<a href="'.$sumber.'/admbaak/akad/mhs_transkrip.php" title="Data Transkrip Nilai">Data Transkrip Nilai</a>
		</LI>
		
		<LI>
		<a href="'.$sumber.'/admbaak/akad/mhs_tugas_akhir.php" title="Data Tugas Akhir">Data Tugas Akhir</a>
		</LI>
		</UL>
	</LI>
	<LI>
	<a href="'.$sumber.'/admbaak/akad/mhs_ijazah.php" title="Data Ijazah">Data Ijazah</a>
	</LI>
	</UL>
</LI>

</UL>';
//AKADEMIK ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//alumni /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="#" data-flexmenu="flexmenu7"><strong>ALUMNI</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu7" class="flexdropdownmenu">
<LI>
<a href="'.$sumber.'/admbaak/alumni/per_tgl_terima_ijazah.php" title="Data Alumni per Tanggal Terima Ijazah">Data Alumni per Tanggal Terima Ijazah</a>
</LI>
<LI>
<a href="'.$sumber.'/admbaak/alumni/per_tgl_ijazah.php" title="Data Alumni per Tanggal Ijazah">Data Alumni per Tanggal Ijazah</a>
</LI>
<LI>
<a href="'.$sumber.'/admbaak/alumni/per_tgl_tulis.php" title="Data Alumni per Edit/Entri">Data Alumni per Edit/Entri</a>
</LI>
</UL>';
//alumni /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//logout ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="'.$sumber.'/admbaak/logout.php" title="Logout / KELUAR" class="menuku"><strong>LogOut</strong></A>
</td>
</tr>
</table>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>