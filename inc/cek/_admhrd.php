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
$kd18_session = nosql($_SESSION['kd18_session']);
$nip18_session = nosql($_SESSION['nip18_session']);
$nm18_session = balikin2($_SESSION['nm18_session']);
$username18_session = nosql($_SESSION['username18_session']);
$hrd_session = nosql($_SESSION['hrd_session']);
$pass18_session = nosql($_SESSION['pass18_session']);
$hajirobe18_session = nosql($_SESSION['hajirobe18_session']);

$qbw = mysqli_query($koneksi, "SELECT adm_hrd.*, m_pegawai.* ".
			"FROM adm_hrd, m_pegawai ".
			"WHERE adm_hrd.kd_pegawai = m_pegawai.kd ".
			"AND m_pegawai.kd = '$kd18_session' ".
			"AND m_pegawai.usernamex = '$username18_session' ".
			"AND m_pegawai.passwordx = '$pass18_session'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($kd18_session))
	OR (empty($username18_session))
	OR (empty($pass18_session))
	OR (empty($hrd_session))
	OR (empty($hajirobe18_session)))
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