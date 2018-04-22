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
$kd1_session = nosql($_SESSION['kd1_session']);
$nip1_session = nosql($_SESSION['nip1_session']);
$nm1_session = balikin2($_SESSION['nm1_session']);
$username1_session = nosql($_SESSION['username1_session']);
$drk_session = balikin($_SESSION['drk_session']);
$pass1_session = nosql($_SESSION['pass1_session']);
$hajirobe1_session = nosql($_SESSION['hajirobe1_session']);

$qbw = mysql_query("SELECT adm_direktur.*, m_pegawai.* ".
						"FROM adm_direktur, m_pegawai ".
						"WHERE adm_direktur.kd_pegawai = m_pegawai.kd ".
						"AND m_pegawai.kd = '$kd1_session' ".
						"AND m_pegawai.usernamex = '$username1_session' ".
						"AND m_pegawai.passwordx = '$pass1_session'");
$rbw = mysql_fetch_assoc($qbw);
$tbw = mysql_num_rows($qbw);

if (($tbw == 0) OR (empty($kd1_session))
	OR (empty($username1_session))
	OR (empty($pass1_session))
	OR (empty($drk_session))
	OR (empty($hajirobe1_session)))
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