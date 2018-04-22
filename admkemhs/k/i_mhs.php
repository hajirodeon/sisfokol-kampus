<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/class/paging.php");
nocache;


//nilai
$limit = "15";
$return_arr = array();
$term = cegah($_GET['term']);
$tapelkd = cegah($_GET['tapelkd']);
$kelkd = cegah($_GET['kelkd']);


//query
$p = new Pager();
$start = $p->findStart($limit);
				
$sqlcount = "SELECT DISTINCT(m_mahasiswa.nim) AS msnim ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND (m_mahasiswa.nim LIKE '%$term%' ". 
				"OR m_mahasiswa.nama LIKE '%$term%') ".
				"ORDER BY round(m_mahasiswa.nim) ASC";
$sqlresult = $sqlcount;
$target = $filenya;
$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);


do
	{
	$i_nim = nosql($data["msnim"]);
	
	
	//detail e
	$qku = mysql_query("SELECT * FROM m_mahasiswa ".
							"WHERE nim = '$i_nim'");
	$rku = mysql_fetch_assoc($qku);

	$row_array["p_kd"] = nosql($rku["kd"]);
	$row_array["p_nim"] = balikin($rku["nim"]);
	$row_array["p_nama"] = balikin($rku["nama"]);

	$i_nim = balikin($rku["nim"]);
	$i_nama = balikin($rku["nama"]);

	$row_array["value"] = $i_nim;
	$row_array["label"] = "$i_nim. $i_nama";
	$row_array["description"] = "$i_nim. $i_nama";

	array_push($return_arr, $row_array);
	}
while ($data = mysql_fetch_assoc($result));



header("Content-Type: text/json");
echo json_encode($return_arr);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>