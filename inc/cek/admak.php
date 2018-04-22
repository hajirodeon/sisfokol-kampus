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
$kd11_session = nosql($_SESSION['kd11_session']);
$nip11_session = nosql($_SESSION['nip11_session']);
$nm11_session = balikin2($_SESSION['nm11_session']);
$username11_session = nosql($_SESSION['username11_session']);
$bak_session = balikin($_SESSION['bak_session']);
$pass11_session = nosql($_SESSION['pass11_session']);
$hajirobe11_session = nosql($_SESSION['hajirobe11_session']);

$qbw = mysql_query("SELECT adm_bak.*, m_pegawai.* ".
						"FROM adm_bak, m_pegawai ".
						"WHERE adm_bak.kd_pegawai = m_pegawai.kd ".
						"AND m_pegawai.kd = '$kd11_session' ".
						"AND m_pegawai.usernamex = '$username11_session' ".
						"AND m_pegawai.passwordx = '$pass11_session'");
$rbw = mysql_fetch_assoc($qbw);
$tbw = mysql_num_rows($qbw);

if (($tbw == 0) OR (empty($kd11_session))
	OR (empty($username11_session))
	OR (empty($pass11_session))
	OR (empty($bak_session))
	OR (empty($hajirobe11_session)))
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