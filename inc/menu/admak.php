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
$maine = "$sumber/admbak/index.php";


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
<a href="'.$sumber.'/admbak/s/pass.php" title="Ganti Password">Ganti Password</a>
</LI>
</UL>';
//setting ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//set keuangan ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="#" data-flexmenu="flexmenu5" class="menuku"><strong>Set Keuangan</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu5" class="flexdropdownmenu">
<LI>
<a href="'.$sumber.'/admbak/keu/set_jns.php" title="Jenis Keuangan">Jenis Keuangan</a>
</LI>
<LI>
<a href="'.$sumber.'/admbak/keu/set_keu.php" title="Nilai Keuangan">Nilai Keuangan</a>
</LI>
<LI>
<a href="'.$sumber.'/admbak/keu/set_mhs.php" title="Uang Per Mahasiswa">Uang Per Mahasiswa</a>
</LI>
</UL>';
//set keuangan ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//keuangan ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//keuangan semua
echo '<A href="#" data-flexmenu="flexmenu7" class="menuku"><strong>Bayar SEMUA</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu7" class="flexdropdownmenu">
<LI>
<a href="'.$sumber.'/admbak/keu/semua_bayar.php?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'" title="Pembayaran">Pembayaran</a>
</LI>
<LI>
<a href="'.$sumber.'/admbak/keu/semua_lap_hr.php" title="Laporan Harian">Laporan Harian</a>
</LI>
<LI>
<a href="'.$sumber.'/admbak/keu/semua_lap_bln.php" title="Laporan Bulanan">Laporan Bulanan</a>
</LI>
</UL>
</LI>

</UL>';
//keuangan ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//keuangan ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//keuangan detail
echo '<A href="#" data-flexmenu="flexmenu12" class="menuku"><strong>Bayar Detail</strong>&nbsp;&nbsp;</A> |
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
		<a href="'.$sumber.'/admbak/keu/bayar.php?jnskd='.$dt_kd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'" title="Pembayaran">Pembayaran</a>
		</LI>
		<LI>
		<a href="'.$sumber.'/admbak/keu/lap_hr.php?jnskd='.$dt_kd.'" title="Laporan Harian">Laporan Harian</a>
		</LI>
		<LI>
		<a href="'.$sumber.'/admbak/keu/lap_bln.php?jnskd='.$dt_kd.'" title="Laporan Bulanan">Laporan Bulanan</a>
		</LI>
		<LI>
		<a href="'.$sumber.'/admbak/keu/lap_mhs.php?jnskd='.$dt_kd.'" title="Laporan Data Mahasiswa">Laporan Data Mahasiswa</a>
		</LI>
		</UL>';
		}

	else
		{
		echo '<UL>
		<LI>
		<a href="'.$sumber.'/admbak/keu/bayar.php?jnskd='.$dt_kd.'&progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tapelkd.'" title="Pembayaran">Pembayaran</a>
		</LI>
		<LI>
		<a href="'.$sumber.'/admbak/keu/lap_hr.php?jnskd='.$dt_kd.'" title="Laporan Harian">Laporan Harian</a>
		</LI>
		<LI>
		<a href="'.$sumber.'/admbak/keu/lap_bln.php?jnskd='.$dt_kd.'" title="Laporan Bulanan">Laporan Bulanan</a>
		</LI>
		</UL>';
		}

	echo '</LI>';
	}
while ($rdt = mysql_fetch_assoc($qdt));

echo '</UL>';
//keuangan ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








//status bayar ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="'.$sumber.'/admbak/keu/st_bayar.php" class="menuku"><strong>STATUS BAYAR</strong>&nbsp;&nbsp;</A> | ';
//status bayar ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









//laporan ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="#" data-flexmenu="flexmenu17" class="menuku"><strong>LAPORAN</strong>&nbsp;&nbsp;</A> |
<UL id="flexmenu17" class="flexdropdownmenu">
<LI>
<a href="'.$sumber.'/admbak/lap/piutang_mhs.php" title="Lap.Piutang Mahasiswa">Lap.Piutang Mahasiswa</a>
</LI>
<LI>
<a href="'.$sumber.'/admbak/lap/piutang_biaya.php" title="Lap.Piutang Biaya">Lap.Piutang Biaya</a>
</LI>
</UL>';
//laporan ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//logout ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<A href="'.$sumber.'/admbak/logout.php" title="Logout / KELUAR" class="menuku"><strong>LogOut</strong></A>
</td>
</tr>
</table>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>