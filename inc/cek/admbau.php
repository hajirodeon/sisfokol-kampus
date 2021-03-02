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
$kd3_session = nosql($_SESSION['kd3_session']);
$nip3_session = nosql($_SESSION['nip3_session']);
$nm3_session = balikin2($_SESSION['nm3_session']);
$username3_session = nosql($_SESSION['username3_session']);
$bau_session = nosql($_SESSION['bau_session']);
$pass3_session = nosql($_SESSION['pass3_session']);
$hajirobe3_session = nosql($_SESSION['hajirobe3_session']);

$qbw = mysqli_query($koneksi, "SELECT adm_bau.*, m_pegawai.* ".
			"FROM adm_bau, m_pegawai ".
			"WHERE adm_bau.kd_pegawai = m_pegawai.kd ".
			"AND m_pegawai.kd = '$kd3_session' ".
			"AND m_pegawai.usernamex = '$username3_session' ".
			"AND m_pegawai.passwordx = '$pass3_session'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($kd3_session))
	OR (empty($username3_session))
	OR (empty($pass3_session))
	OR (empty($bau_session))
	OR (empty($hajirobe3_session)))
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