<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
nocache;


$filenya = "makul_tmp.php";
$filenyax = "i_makul_tmp.php";







//jika update
if(isset($_GET['aksi']) && $_GET['aksi'] == 'update')
	{
	sleep(1);
	$e_progdi = nosql($_POST['e_progdi']);
	$e_tapelkd = nosql($_POST['e_tapelkd']);
	


	//looping semua dahulu...
	//daftar makul-nya
	$qkulo = mysqli_query($koneksi, "SELECT m_makul_smt.sks AS ssks, ".
							"m_makul_smt.kd AS mskd, ".
							"m_makul.*, m_makul.kd AS mkkd ".
							"FROM m_makul_smt, m_makul ".
							"WHERE m_makul_smt.kd_makul = m_makul.kd ".
							"AND m_makul.kd_progdi = '$e_progdi' ".
							"AND m_makul_smt.kd_tapel = '$e_tapelkd'");
	$rkulo = mysqli_fetch_assoc($qkulo);
	$tkulo = mysqli_num_rows($qkulo);


	do
		{
		$i_nomer = $i_nomer + 1;
		$kulo_mskd = nosql($rkulo['mskd']);

		//ambil nilai
		$yuk = "sks";
		$yuhu = "$yuk$kulo_mskd";
		$nil_kd = nosql($_POST["$yuhu"]);


		
		//update
		mysqli_query($koneksi, "UPDATE m_makul_smt SET sks = '$nil_kd' ".
						"WHERE kd = '$kulo_mskd'");
						
		}
	while ($rkulo = mysqli_fetch_assoc($qkulo));


		
	echo '<p>
	<font color="red">
	<h3>
	update Berhasil...   
	</h3>
	</font>
	</p>';
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>