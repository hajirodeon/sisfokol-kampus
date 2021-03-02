<?php
//fungsi2
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/class/krs.php");


nocache;

//nilai
$filenya = "mhs_khs_pdf.php";
$judul = "KHS Mahasiswa";
$judulku = "[$baak_session : $nip2_session. $nm2_session]. $judul";
$judulx = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$rukd = nosql($_REQUEST['rukd']);
$mkkd = nosql($_REQUEST['mkkd']);
$kd = nosql($_REQUEST['kd']);
$kulkd = nosql($_REQUEST['kulkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$s = nosql($_REQUEST['s']);



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//detail mahasiswa
$qku = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa ".
			"WHERE kd = '$kd'");
$rku = mysqli_fetch_assoc($qku);
$ku_nim = nosql($rku['nim']);
$ku_nama = balikin($rku['nama']);


//smt
$qstxy = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysqli_fetch_assoc($qstxy);
$smt = nosql($rowstxy['smt']);
$smt_no = nosql($rowstxy['no']);


//jenis smt
//jika ganjil
if (($smt_no == "1") OR ($smt_no == "3") OR ($smt_no == "5"))
	{
	$smt_jns = "Ganjil";
	}
else
	{
	$smt_jns = "Genap";
	}




//tapel
$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rtpel = mysqli_fetch_assoc($qtpel);
$ttpel = mysqli_num_rows($qtpel);
$tpel_thn1 = nosql($rtpel['tahun1']);
$tpel_thn2 = nosql($rtpel['tahun2']);



//ketahui ka.prodi
$qtp2x = mysqli_query($koneksi, "SELECT m_pegawai.*, m_pegawai.nama AS mpnama, m_progdi.* ".
			"FROM m_pegawai, m_progdi ".
			"WHERE m_progdi.kd_pegawai = m_pegawai.kd ".
			"AND m_progdi.kd = '$progdi'");
$rowtp2x = mysqli_fetch_assoc($qtp2x);
$tp2x_nip = nosql($rowtp2x['nip']);
$tp2x_pegawai = balikin($rowtp2x['mpnama']);





//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);
$tpx_nama2 = balikin($rowtpx['nama2']);







//start class
$pdf=new PDF('L','mm','A5');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle($judul);
$pdf->SetAuthor($author);
$pdf->SetSubject($description);
$pdf->SetKeywords($keywords);








$pdf->SetFont('Arial','B',7);

//posisi
$pdf->SetFillColor(233,233,233);

//no
$pdf->SetX(10);
$nil_foto = "../../img/logo.jpg";
$pdf->WriteHTML('<img src="'.$nil_foto.'" alt="'.$y_nama.'" width="30" border="5">');

$pdf->SetX(22);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,7,$sek_nama,0,0,'L',0);
$pdf->Ln();

$pdf->SetX(22);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(100,4,''.$sek_alamat.'. '.$sek_kontak.'',0,0,'L',0);
$pdf->Ln();

$pdf->SetX(10);
$pdf->Cell(196,0.5,'',0,0,'L',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->SetX(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(193,5,'KARTU HASIL STUDI / KHS',0,0,'C',0);
$pdf->Ln();


$nil_Y = $pdf->GetY();
$pdf->Cell(196,10,'',1,0,'L',0);

$pdf->SetY($nil_Y);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(12,5,'Nama',0,0,'L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(135,5,': '.$ku_nama.'',0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(24,5,'Semester',0,0,'L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,5,': '.$smt.' ('.$smt_jns.')',0,0,'L',0);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(12,5,'NIM',0,0,'L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(135,5,': '.$ku_nim.'',0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(24,5,'Thn.Akademik',0,0,'L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,5,': '.$tpel_thn1.'/'.$tpel_thn2.'',0,0,'L',0);
$pdf->Ln();



//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);


$pdf->Cell(196,5,'Program Studi : '.$tpx_nama.'',1,0,'L',0);
$pdf->Ln();







//detail
$qxpell = mysqli_query($koneksi, "SELECT mahasiswa_kelas.kd AS skkd ".
						"FROM m_mahasiswa, mahasiswa_kelas ".
						"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
						"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
						"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
						"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
						"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
						"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
						"AND m_mahasiswa.kd = '$kd'");
$rxpell = mysqli_fetch_assoc($qxpell);
$i_skkd = nosql($rxpell['skkd']);
	
	
	

//daftar makul-nya
$qkulo = mysqli_query($koneksi, "SELECT m_makul.*, m_makul.kd AS mkkd, m_makul_smt.*, ".
							"m_makul_smt.sks AS ssks ".
							"FROM m_makul, m_makul_smt ".
							"WHERE m_makul_smt.kd_makul = m_makul.kd ".
							"AND m_makul.kd_progdi = '$progdi' ".
							"AND m_makul_smt.kd_tapel = '$tapelkd' ".
							"AND m_makul_smt.kd_smt = '$smtkd' ".
							"ORDER BY m_makul.kode ASC");
$rkulo = mysqli_fetch_assoc($qkulo);
$tkulo = mysqli_num_rows($qkulo);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(7,5,'No.',1,0,'C',1);
$pdf->Cell(18,5,'Kode',1,0,'C',1);
$pdf->Cell(98,5,'Nama Mata Kuliah',1,0,'C',1);
$pdf->Cell(10,5,'SKS',1,0,'C',1);
$pdf->Cell(21,5,'Nilai Huruf',1,0,'C',1);
$pdf->Cell(21,5,'Nilai Angka',1,0,'C',1);
$pdf->Cell(21,5,'Nilai Mutu',1,0,'C',1);
$pdf->Ln();

	


	do
		{
		//nilai
		if ($warna_set ==0)
			{
			$warna = $warna01;
			$warna_set = 1;
			}
		else
			{
			$warna = $warna02;
			$warna_set = 0;
			}

		$i_nomer = $i_nomer + 1;
		$xyz = md5("$x$i_nomer");
		$kulo_kulkd = nosql($rkulo['mkkd']);
//		$kulo_makul = nosql($rkulo['kd_makul']);
		$kulo_makul = nosql($rkulo['mkkd']);
		$kulo_kode = nosql($rkulo['kode']);
		$kulo_nama = balikin($rkulo['nama']);
		$kulo_sks = nosql($rkulo['ssks']);




		//nilai
		$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_nilai ".
								"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_makul = '$kulo_makul'");
		$rnil = mysqli_fetch_assoc($qnil);
//					$nil_huruf = nosql($rnil['nil_akhir_huruf']);
		$nil_tugas = nosql($rnil['nil_tugas']);
		$nil_uts = nosql($rnil['nil_uts']);
		$nil_uas = nosql($rnil['nil_uas']);
		$nil_akhir = nosql($rnil['nil_akhir']);
		$xpel_akhir = $nil_akhir;



		//nil_huruf
		if (($xpel_akhir <= "100") AND ($xpel_akhir >= "80"))
			{
			$nil_huruf = "A";
			}
		else if (($xpel_akhir < "80") AND ($xpel_akhir >= "65"))
			{
			$nil_huruf = "B";
			}
		else if (($xpel_akhir < "65") AND ($xpel_akhir >= "50"))
			{
			$nil_huruf = "C";
			}
		else if (($xpel_akhir < "50") AND ($xpel_akhir >= "40"))
			{
			$nil_huruf = "D";
			}
		else
			{
			$nil_huruf = "E";
			}



		//update huruf
		mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET nil_akhir_huruf = '$nil_huruf' ".
						"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_makul = '$kulo_makul'");





		//bobot nilai
		if ($nil_huruf == "A")
			{
			$nil_angka = "4";
			}
		else if ($nil_huruf == "B")
			{
			$nil_angka = "3";
			}
		else if ($nil_huruf == "C")
			{
			$nil_angka = "2";
			}
		else if ($nil_huruf == "D")
			{
			$nil_angka = "1";
			}
		else
			{
			$nil_angka = "0";
			}


		//nilai mutu
		$nil_mutu = round($kulo_sks * $nil_angka);

		mysqli_query($koneksi, "UPDATE mahasiswa_nilai SET subtotal_mutu = '$nil_mutu' ".
						"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_smt = '$smtkd' ".
						"AND kd_makul = '$kulo_makul'");


			
		//cek table transkrip
		$qkuu = mysqli_query($koneksi, "SELECT * FROM mahasiswa_transkrip ".
								"WHERE kd_mahasiswa = '$kd' ".
								"AND kd_tapel = '$tapelkd' ".
								"AND kd_smt = '$smtkd' ".
								"AND kd_makul = '$kulo_makul'");
		$rkuu = mysqli_fetch_assoc($qkuu);
		$tkuu = mysqli_num_rows($qkuu);
		
		//jika ada, update
		if (!empty($tkuu))
			{
			mysqli_query($koneksi, "UPDATE mahasiswa_transkrip SET sks = '$kulo_sks', ".
							"nil_huruf = '$nil_huruf', ".
							"nil_angka = '$nil_angka', ".
							"nil_mutu = '$nil_mutu', ".
							"postdate = '$today' ".
							"WHERE kd_mahasiswa = '$kd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd' ".
							"AND kd_makul = '$kulo_makul'");
								
			}
		else 
			{
			mysqli_query($koneksi, "INSERT INTO mahasiswa_transkrip(kd, kd_mahasiswa, kd_tapel, kd_smt, ".
							"kd_makul, sks, nil_huruf, nil_angka, ".
							"nil_mutu, postdate) VALUES ".
							"('$xyz', '$kd', '$tapelkd', '$smtkd', ".
							"'$kulo_makul', '$kulo_sks', '$nil_huruf', '$nil_angka', ".
							"'$nil_mutu', '$today')");
			}



		$pdf->SetFont('Arial','',10);
		$pdf->Cell(7,5,''.$i_nomer.'',1,0,'C');
		$pdf->Cell(18,5,''.$kulo_kode.'',1,0,'L');
		$pdf->Cell(98,5,''.$kulo_nama.'',1,0,'L');
		$pdf->Cell(10,5,''.$kulo_sks.'',1,0,'C');
		$pdf->Cell(21,5,''.$nil_huruf.'',1,0,'C');
		$pdf->Cell(21,5,''.$nil_angka.'',1,0,'C');
		$pdf->Cell(21,5,''.$nil_mutu.'',1,0,'C');
		$pdf->Ln();
		}
	while ($rkulo = mysqli_fetch_assoc($qkulo));


	//total sks
	$qtoku = mysqli_query($koneksi, "SELECT SUM(sks) AS total ".
							"FROM mahasiswa_transkrip ".
							"WHERE kd_mahasiswa = '$kd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd'");
	$rtoku = mysqli_fetch_assoc($qtoku);
	$toku_total = round(nosql($rtoku['total']));


	//total nil_mutu
	$qtoku2 = mysqli_query($koneksi, "SELECT SUM(nil_mutu) AS total ".
							"FROM mahasiswa_transkrip ".
							"WHERE kd_mahasiswa = '$kd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd'");
	$rtoku2 = mysqli_fetch_assoc($qtoku2);
	$toku2_total = round(nosql($rtoku2['total']));


	//total IP
	$nil_ip = round($toku2_total/$toku_total,2);


	//ipk : total sks /////////////////////////////////////////////////////
	$qtoku3 = mysqli_query($koneksi, "SELECT SUM(sks) AS total ".
							"FROM mahasiswa_transkrip ".
							"WHERE kd_mahasiswa = '$kd'");
	$rtoku3 = mysqli_fetch_assoc($qtoku3);
	$toku3_total = nosql($rtoku3['total']);


	//ipk : total nil_mutu ////////////////////////////////////////////////
	$qtoku23 = mysqli_query($koneksi, "SELECT SUM(nil_mutu) AS total ".
							"FROM mahasiswa_transkrip ".
							"WHERE kd_mahasiswa = '$kd'");
	$rtoku23 = mysqli_fetch_assoc($qtoku23);
	$toku23_total = round(nosql($rtoku23['total']));


	//total IPK
	$nil_ipk = round($toku23_total/$toku3_total,2);


	//tapel-nya
	$qtpel = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
				"WHERE kd = '$tapelkd'");
	$rtpel = mysqli_fetch_assoc($qtpel);
	$ttpel = mysqli_num_rows($qtpel);
	$tpel_thn1 = nosql($rtpel['tahun1']);
	$tpel_thn2 = nosql($rtpel['tahun2']);



	//tgl.pengesahan
	$qsahi = mysqli_query($koneksi, "SELECT DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%d') AS atgl, ".
							"DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%m') AS abln, ".
							"DATE_FORMAT(mahasiswa_nilai.tgl_sah, '%Y') AS athn, ".
							"mahasiswa_nilai.* ".
							"FROM mahasiswa_nilai ".
							"WHERE kd_mahasiswa_kelas = '$i_skkd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd'");
	$rsahi = mysqli_fetch_assoc($qsahi);
	$atgl = nosql($rsahi['atgl']);
	$abln = nosql($rsahi['abln']);
	$athn = nosql($rsahi['athn']);


	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(7,5,'',1,0,'L');
	$pdf->Cell(18,5,'',1,0,'L');
	$pdf->Cell(98,5,'Jumlah',1,0,'R');
	$pdf->Cell(10,5,''.$toku_total.'',1,0,'C');
	$pdf->Cell(21,5,'',1,0,'L');
	$pdf->Cell(21,5,''.$toku2_total.'',1,0,'C');
	$pdf->Cell(21,5,''.$nil_mutu.'',1,0,'C');
	$pdf->Ln();




	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(7,5,'',1,0,'L');
	$pdf->Cell(18,5,'',1,0,'L');
	$pdf->Cell(98,5,'Indek Prestasi (IP) Semester ini',1,0,'R');
	$pdf->Cell(10,5,''.$nil_ip.'',1,0,'C');
	$pdf->Cell(21,5,'',1,0,'L');
	$pdf->Cell(21,5,'',1,0,'L');
	$pdf->Cell(21,5,'',1,0,'L');
	$pdf->Ln();






	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(7,5,'',1,0,'L');
	$pdf->Cell(18,5,'',1,0,'L');
	$pdf->Cell(98,5,'Indek Prestasi Komulatif (IPK)',1,0,'R');
	$pdf->Cell(10,5,''.$nil_ipk.'',1,0,'C');
	$pdf->Cell(21,5,'',1,0,'L');
	$pdf->Cell(21,5,'',1,0,'L');
	$pdf->Cell(21,5,'',1,0,'L');
	$pdf->Ln();




	$pdf->SetFont('Arial','',10);
	$pdf->Cell(7,5,''.$sek_kota.', '.$atgl.' '.$arrbln1[$abln].' '.$athn.'',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(7,5,'Akademik, ',0,0,'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(7,5,''.$tp2x_pegawai.'',0,0,'L');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//output-kan ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->Output("khs_$ku_nim.pdf",I);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>