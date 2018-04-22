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
$kd2_session = nosql($_SESSION['kd2_session']);
$nip2_session = nosql($_SESSION['nip2_session']);
$nm2_session = balikin2($_SESSION['nm2_session']);
$username2_session = nosql($_SESSION['username2_session']);
$baak_session = nosql($_SESSION['baak_session']);
$pass2_session = nosql($_SESSION['pass2_session']);
$hajirobe2_session = nosql($_SESSION['hajirobe2_session']);

$qbw = mysql_query("SELECT adm_baak.*, m_pegawai.* ".
			"FROM adm_baak, m_pegawai ".
			"WHERE adm_baak.kd_pegawai = m_pegawai.kd ".
			"AND m_pegawai.kd = '$kd2_session' ".
			"AND m_pegawai.usernamex = '$username2_session' ".
			"AND m_pegawai.passwordx = '$pass2_session'");
$rbw = mysql_fetch_assoc($qbw);
$tbw = mysql_num_rows($qbw);

if (($tbw == 0) OR (empty($kd2_session))
	OR (empty($username2_session))
	OR (empty($pass2_session))
	OR (empty($baak_session))
	OR (empty($hajirobe2_session)))
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