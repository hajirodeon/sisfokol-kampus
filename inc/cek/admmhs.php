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
$kd6_session = nosql($_SESSION['kd6_session']);
$nim6_session = nosql($_SESSION['nim6_session']);
$nm6_session = balikin2($_SESSION['nm6_session']);
$username6_session = nosql($_SESSION['username6_session']);
$mhs_session = nosql($_SESSION['mhs_session']);
$pass6_session = nosql($_SESSION['pass6_session']);
$hajirobe6_session = nosql($_SESSION['hajirobe6_session']);


$qbw = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
			"WHERE usernamex = '$username6_session' ".
			"AND passwordx = '$pass6_session'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($kd6_session))
	OR (empty($username6_session))
	OR (empty($pass6_session))
	OR (empty($mhs_session))
	OR (empty($hajirobe6_session)))
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