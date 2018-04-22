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



///cek session //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$kd21_session = nosql($_SESSION['kd21_session']);
$nip21_session = nosql($_SESSION['nip21_session']);
$nm21_session = balikin2($_SESSION['nm21_session']);
$username21_session = nosql($_SESSION['username21_session']);
$ukm_session = nosql($_SESSION['ukm_session']);
$pass21_session = nosql($_SESSION['pass21_session']);
$hajirobe21_session = nosql($_SESSION['hajirobe21_session']);

$qbw = mysql_query("SELECT m_ukm.*, m_pegawai.* ".
			"FROM m_ukm, m_pegawai ".
			"WHERE m_ukm.kd_pegawai = m_pegawai.kd ".
			"AND m_pegawai.kd = '$kd21_session' ".
			"AND m_pegawai.usernamex = '$username21_session' ".
			"AND m_pegawai.passwordx = '$pass21_session'");
$rbw = mysql_fetch_assoc($qbw);
$tbw = mysql_num_rows($qbw);

if (($tbw == 0) OR (empty($kd21_session))
	OR (empty($username21_session))
	OR (empty($pass21_session))
	OR (empty($ukm_session))
	OR (empty($hajirobe21_session)))
	{
	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$pesan = "ANDA BELUM LOGIN. SILAHKAN LOGIN DAHULU...!!!";
	pekem($pesan, $sumber);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>