<?php
//nilai /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$konten = ParseVal($tpl, array ("judul" => $judul,
					"judulku" => $judulku,
					"sumber" => $sumber,
					"isi" => $isi,
					"diload" => $diload,
					"versi" => $versi,
					"author" => $author,
					"keywords" => $keywords,
					"url" => $url,
					"sesidt" => $sesidt,
					"wkdet" => $wkdet,
					"wkurl" => $wkurl,
					"dikeydown" => $dikeydown,
					"sek_nama" => $sek_nama,
					"sek_alamat" => $sek_alamat,
					"sek_kontak" => $sek_kontak,
					"sek_filex" => $sek_filex,
					"nil_foto" => $nil_foto,
					"description" => $description));

//tampilkan
echo $konten;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//kill process //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
set_time_limit(600);  //set maksimal loading : 600 detik atau 10 menit
$result=mysql_query("show processlist");
while ($row=mysql_fetch_array($result))
	{
	$process_id=$row["Id"];

	if (($row["Time"] > 0) OR ($row["Command"]=="Sleep"))
		{
		//print $row["Id"];
		$sql="kill $process_id";
		mysql_query($sql);
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>