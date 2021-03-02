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
$kd10_session = nosql($_SESSION['kd10_session']);
$nip10_session = nosql($_SESSION['nip10_session']);
$nm10_session = balikin2($_SESSION['nm10_session']);
$username10_session = nosql($_SESSION['username10_session']);
$kaprodi_session = nosql($_SESSION['kaprodi_session']);
$pass10_session = nosql($_SESSION['pass10_session']);
$hajirobe10_session = nosql($_SESSION['hajirobe10_session']);


$qbw = mysqli_query($koneksi, "SELECT adm_kaprodi.*, m_pegawai.* ".
			"FROM adm_kaprodi, m_pegawai ".
			"WHERE adm_kaprodi.kd_pegawai = m_pegawai.kd ".
			"AND m_pegawai.kd = '$kd10_session' ".
			"AND m_pegawai.usernamex = '$username10_session' ".
			"AND m_pegawai.passwordx = '$pass10_session'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($kd10_session))
	OR (empty($username10_session))
	OR (empty($pass10_session))
	OR (empty($kaprodi_session))
	OR (empty($hajirobe10_session)))
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