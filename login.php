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


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
$tpl = LoadTpl("template/login.html");


nocache;

//nilai
$filenya = "login.php";
$judul = $versi;
$diload = "document.formx.tipe.focus();";
$pesan = "PASSWORD SALAH. HARAP DIULANGI...!!!";
$s = nosql($_REQUEST['s']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnOK'])
	{
	//ambil nilai
	$tipe = nosql($_POST["tipe"]);
	$username = nosql($_POST["usernamex"]);
	$password = md5(nosql($_POST["passwordx"]));

	//cek null
	if ((empty($tipe)) OR (empty($username)) OR (empty($password)))
		{
		//diskonek
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//jika tp01 --> DIREKTUR ................................................................................
		if ($tipe == "tp01")
			{
			//query
			$q = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, adm_direktur.* ".
						"FROM m_pegawai, adm_direktur ".
						"WHERE adm_direktur.kd_pegawai = m_pegawai.kd ".
						"AND m_pegawai.usernamex = '$username' ".
						"AND m_pegawai.passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//bikin session
				$_SESSION['kd1_session'] = nosql($row['mpkd']);
				$_SESSION['nip1_session'] = nosql($row['nip']);
				$_SESSION['nm1_session'] = balikin($row['nama']);
				$_SESSION['username1_session'] = $username;
				$_SESSION['pass1_session'] = $password;
				$_SESSION['drk_session'] = "KETUA/DIREKTUR/REKTOR";
				$_SESSION['hajirobe1_session'] = $hajirobe;


				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				$ke = "admdrk/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................





		//jika tp02 --> BAAK ................................................................................
		if ($tipe == "tp02")
			{
			//query
			$q = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, adm_baak.* ".
						"FROM m_pegawai, adm_baak ".
						"WHERE adm_baak.kd_pegawai = m_pegawai.kd ".
						"AND m_pegawai.usernamex = '$username' ".
						"AND m_pegawai.passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//bikin session
				$_SESSION['kd2_session'] = nosql($row['mpkd']);
				$_SESSION['nip2_session'] = nosql($row['nip']);
				$_SESSION['nm2_session'] = balikin($row['nama']);
				$_SESSION['username2_session'] = $username;
				$_SESSION['pass2_session'] = $password;
				$_SESSION['baak_session'] = "BAAK";
				$_SESSION['hajirobe2_session'] = $hajirobe;


				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				$ke = "admbaak/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................





		//jika tp03 --> BAU ................................................................................
		if ($tipe == "tp03")
			{
			//query
			$q = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, adm_bau.* ".
								"FROM m_pegawai, adm_bau ".
								"WHERE adm_bau.kd_pegawai = m_pegawai.kd ".
								"AND m_pegawai.usernamex = '$username' ".
								"AND m_pegawai.passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//bikin session
				$_SESSION['kd3_session'] = nosql($row['mpkd']);
				$_SESSION['nip3_session'] = nosql($row['nip']);
				$_SESSION['nm3_session'] = balikin($row['nama']);
				$_SESSION['username3_session'] = $username;
				$_SESSION['pass3_session'] = $password;
				$_SESSION['bau_session'] = "BAU";
				$_SESSION['hajirobe3_session'] = $hajirobe;


				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				$ke = "admbau/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................






		//jika tp04 --> KEMAHASISWAAN ................................................................................
		if ($tipe == "tp04")
			{
			//query
			$q = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, adm_kemhs.* ".
						"FROM m_pegawai, adm_kemhs ".
						"WHERE adm_kemhs.kd_pegawai = m_pegawai.kd ".
						"AND m_pegawai.usernamex = '$username' ".
						"AND m_pegawai.passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//bikin session
				$_SESSION['kd4_session'] = nosql($row['mpkd']);
				$_SESSION['nip4_session'] = nosql($row['nip']);
				$_SESSION['nm4_session'] = balikin($row['nama']);
				$_SESSION['username4_session'] = $username;
				$_SESSION['pass4_session'] = $password;
				$_SESSION['kemhs_session'] = "KEMAHASISWAAN";
				$_SESSION['hajirobe4_session'] = $hajirobe;


				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				$ke = "admkemhs/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................





		//jika tp05 --> DOSEN ................................................................................
		if ($tipe == "tp05")
			{
			//query
			$q = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, dosen.* ".
						"FROM m_pegawai, dosen ".
						"WHERE dosen.kd_pegawai = m_pegawai.kd ".
						"AND m_pegawai.usernamex = '$username' ".
						"AND m_pegawai.passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//bikin session
				$_SESSION['kd5_session'] = nosql($row['mpkd']);
				$_SESSION['nip5_session'] = nosql($row['nip']);
				$_SESSION['nm5_session'] = balikin($row['nama']);
				$_SESSION['username5_session'] = $username;
				$_SESSION['pass5_session'] = $password;
				$_SESSION['dosen_session'] = "DOSEN";
				$_SESSION['hajirobe5_session'] = $hajirobe;


				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				$ke = "admdosen/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................






		//jika tp06 --> MAHASISWA ................................................................................
		if ($tipe == "tp06")
			{
			//query
			$q = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
						"WHERE usernamex = '$username' ".
						"AND passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//bikin session
				$_SESSION['kd6_session'] = nosql($row['kd']);
				$_SESSION['nim6_session'] = nosql($row['nim']);
				$_SESSION['nm6_session'] = balikin($row['nama']);
				$_SESSION['username6_session'] = $username;
				$_SESSION['pass6_session'] = $password;
				$_SESSION['mhs_session'] = "MAHASISWA";
				$_SESSION['hajirobe6_session'] = $hajirobe;


				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				$ke = "admmhs/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................






		//jika tp09 --> Administrator .......................................................................
		if ($tipe == "tp09")
			{
			//query
			$q = mysqli_query($koneksi, "SELECT * FROM adminx ".
						"WHERE usernamex = '$username' ".
						"AND passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//bikin session
				$_SESSION['kd9_session'] = nosql($row['kd']);
				$_SESSION['username9_session'] = $username;
				$_SESSION['pass9_session'] = $password;
				$_SESSION['adm_session'] = "Administrator";
				$_SESSION['hajirobe9_session'] = $hajirobe;


				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				$ke = "adm/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................









		//jika tp11 --> AK ................................................................................
		if ($tipe == "tp011")
			{
			//query
			$q = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.kd AS mpkd, adm_bak.* ".
								"FROM m_pegawai, adm_bak ".
								"WHERE adm_bak.kd_pegawai = m_pegawai.kd ".
								"AND m_pegawai.usernamex = '$username' ".
								"AND m_pegawai.passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//bikin session
				$_SESSION['kd11_session'] = nosql($row['mpkd']);
				$_SESSION['nip11_session'] = nosql($row['nip']);
				$_SESSION['nm11_session'] = balikin($row['nama']);
				$_SESSION['username11_session'] = $username;
				$_SESSION['pass11_session'] = $password;
				$_SESSION['bak_session'] = "BAK";
				$_SESSION['hajirobe11_session'] = $hajirobe;


				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				$ke = "admbak/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);

				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................

		
		


										
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();




?>



<script src="<?php echo $sumber;?>/inc/js/jquery-1.10.2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('#loading').ajaxStart(function(){
			$(this).show();
		}).ajaxStop(function(){
			$(this).hide();
		});



jQuery.noConflict();
	
});
</script>





<?php


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">


<br>
<br>
<table width="795" border="0" cellspacing="10" cellpadding=10" background="'.$sumber.'/img/login.png">
<tr valign="top" height="270">
<td>

<table width="100%" border="0" cellspacing="5" cellpadding="0">
<tr>
<td>
<img src="'.$sumber.'/img/logo.png" height="150" border="0">
</td>
<td>
<h1>
SISFO
<br>
'.$sek_nama.'
</h1>
</td>

<td align="right">

<font color="white">
<img src="'.$sumber.'/img/support.png" width="24" height="24" border="0">
<strong>Akses : </strong>
<select name="tipe">
<option value="" selected></option>
<option value="tp06">Mahasiswa</option>
<option value="tp05">Dosen</option>
<option value="tp02">BAAK</option>
<option value="tp03">BAU</option>
<option value="tp011">BAK</option>
<option value="tp04">Kemahasiswaan</option>
<option value="tp01">Ketua/Direktur/Rektor</option>
<option value="tp09">Administrator</option>
</select>
<br>
Username :
<input name="usernamex" type="text" size="15"><br>
Password :
<input name="passwordx" type="password" size="15">
<br>

<input name="btnOK" type="submit" value="OK &gt;&gt;&gt;">


</font>
</td>
</tr>
</table>
<br>
<br>
<br>
<br>



</td>
</tr>
</table>








  


</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>
