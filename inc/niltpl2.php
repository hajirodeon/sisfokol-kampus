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
									"sek_nama" => $sek_nama,
									"sek_alamat" => $sek_alamat,
									"sek_kontak" => $sek_kontak,
									"description" => $description));

//tampilkan
echo $konten;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>