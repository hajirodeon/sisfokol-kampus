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
$kd5_session = nosql($_SESSION['kd5_session']);
$nip5_session = nosql($_SESSION['nip5_session']);
$nm5_session = balikin2($_SESSION['nm5_session']);
$username5_session = nosql($_SESSION['username5_session']);
$dosen_session = nosql($_SESSION['dosen_session']);
$pass5_session = nosql($_SESSION['pass5_session']);
$hajirobe5_session = nosql($_SESSION['hajirobe5_session']);


$qbw = mysqli_query($koneksi, "SELECT dosen.*, m_pegawai.* ".
			"FROM dosen, m_pegawai ".
			"WHERE dosen.kd_pegawai = m_pegawai.kd ".
			"AND m_pegawai.kd = '$kd5_session' ".
			"AND m_pegawai.usernamex = '$username5_session' ".
			"AND m_pegawai.passwordx = '$pass5_session'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($kd5_session))
	OR (empty($username5_session))
	OR (empty($pass5_session))
	OR (empty($dosen_session))
	OR (empty($hajirobe5_session)))
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