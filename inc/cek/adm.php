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
$kd9_session = nosql($_SESSION['kd9_session']);
$username9_session = nosql($_SESSION['username9_session']);
$adm_session = nosql($_SESSION['adm_session']);
$pass9_session = nosql($_SESSION['pass9_session']);
$hajirobe9_session = nosql($_SESSION['hajirobe9_session']);

$qbw = mysql_query("SELECT * FROM adminx ".
			"WHERE kd = '$kd9_session' ".
			"AND usernamex = '$username9_session' ".
			"AND passwordx = '$pass9_session'");
$rbw = mysql_fetch_assoc($qbw);
$tbw = mysql_num_rows($qbw);

if (($tbw == 0) OR (empty($kd9_session))
	OR (empty($username9_session))
	OR (empty($pass9_session))
	OR (empty($adm_session))
	OR (empty($hajirobe9_session)))
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