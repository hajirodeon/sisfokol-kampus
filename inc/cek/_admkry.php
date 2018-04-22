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
$kd7_session = nosql($_SESSION['kd7_session']);
$nip7_session = nosql($_SESSION['nip7_session']);
$nm7_session = balikin2($_SESSION['nm7_session']);
$username7_session = nosql($_SESSION['username7_session']);
$karyawan_session = nosql($_SESSION['karyawan_session']);
$pass7_session = nosql($_SESSION['pass7_session']);
$hajirobe7_session = nosql($_SESSION['hajirobe7_session']);

$qbw = mysql_query("SELECT * FROM m_pegawai ".
			"WHERE kd = '$kd7_session' ".
			"AND usernamex = '$username7_session' ".
			"AND passwordx = '$pass7_session'");
$rbw = mysql_fetch_assoc($qbw);
$tbw = mysql_num_rows($qbw);

if (($tbw == 0) OR (empty($kd7_session))
	OR (empty($username7_session))
	OR (empty($pass7_session))
	OR (empty($karyawan_session))
	OR (empty($hajirobe7_session)))
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