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
$kd4_session = nosql($_SESSION['kd4_session']);
$nip4_session = nosql($_SESSION['nip4_session']);
$nm4_session = balikin2($_SESSION['nm4_session']);
$username4_session = nosql($_SESSION['username4_session']);
$kemhs_session = nosql($_SESSION['kemhs_session']);
$pass4_session = nosql($_SESSION['pass4_session']);
$hajirobe4_session = nosql($_SESSION['hajirobe4_session']);


$qbw = mysql_query("SELECT adm_kemhs.*, m_pegawai.* ".
			"FROM adm_kemhs, m_pegawai ".
			"WHERE adm_kemhs.kd_pegawai = m_pegawai.kd ".
			"AND m_pegawai.kd = '$kd4_session' ".
			"AND m_pegawai.usernamex = '$username4_session' ".
			"AND m_pegawai.passwordx = '$pass4_session'");
$rbw = mysql_fetch_assoc($qbw);
$tbw = mysql_num_rows($qbw);

if (($tbw == 0) OR (empty($kd4_session))
	OR (empty($username4_session))
	OR (empty($pass4_session))
	OR (empty($kemhs_session))
	OR (empty($hajirobe4_session)))
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