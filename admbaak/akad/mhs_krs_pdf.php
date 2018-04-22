<?php
//fungsi2
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/class/krs.php");


nocache;

//nilai
$filenya = "mhs_krs_pdf.php";
$judul = "KRS Mahasiswa";
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





//start class
$pdf=new PDF('P','mm','A5');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle($judul);
$pdf->SetAuthor($author);
$pdf->SetSubject($description);
$pdf->SetKeywords($keywords);








//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//detail mahasiswa
$qku = mysql_query("SELECT * FROM m_mahasiswa ".
			"WHERE kd = '$kd'");
$rku = mysql_fetch_assoc($qku);
$ku_nim = nosql($rku['nim']);
$ku_nama = balikin($rku['nama']);


//smt
$qstxy = mysql_query("SELECT * FROM m_smt ".
			"WHERE kd = '$smtkd'");
$rowstxy = mysql_fetch_assoc($qstxy);
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
$qtpel = mysql_query("SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rtpel = mysql_fetch_assoc($qtpel);
$ttpel = mysql_num_rows($qtpel);
$tpel_thn1 = nosql($rtpel['tahun1']);
$tpel_thn2 = nosql($rtpel['tahun2']);



//ketahui ka.prodi
$qtp2x = mysql_query("SELECT m_pegawai.*, m_pegawai.nama AS mpnama, m_progdi.* ".
			"FROM m_pegawai, m_progdi ".
			"WHERE m_progdi.kd_pegawai = m_pegawai.kd ".
			"AND m_progdi.kd = '$progdi'");
$rowtp2x = mysql_fetch_assoc($qtp2x);
$tp2x_nip = nosql($rowtp2x['nip']);
$tp2x_pegawai = balikin($rowtp2x['mpnama']);





//ketahui dosen pembimbing-nya
$qtp2xx = mysql_query("SELECT dosen_pembimbing.*, m_ruang.*, ".
			"m_pegawai.*, m_pegawai.nama AS mpnama ".
			"FROM dosen_pembimbing, m_ruang, m_pegawai ".
			"WHERE dosen_pembimbing.kd_ruang = m_ruang.kd ".
			"AND dosen_pembimbing.kd_pegawai = m_pegawai.kd ".
			"AND dosen_pembimbing.kd_progdi = '$progdi' ".
			"AND dosen_pembimbing.kd_tapel = '$tapelkd' ".
			"AND dosen_pembimbing.kd_smt = '$smtkd' ".
			"AND dosen_pembimbing.kd_kelas = '$kelkd' ".
			"AND dosen_pembimbing.kd_ruang = '$rukd'");
$rowtp2xx = mysql_fetch_assoc($qtp2xx);
$tp2xx_nip = nosql($rowtp2xx['nip']);
$tp2xx_nama = balikin($rowtp2xx['mpnama']);






$pdf->SetFont('Arial','B',7);

//posisi
$pdf->SetFillColor(233,233,233);

//no
$pdf->SetX(10);
$nil_foto = "../../img/logo.jpg";
$pdf->WriteHTML('<img src="'.$nil_foto.'" alt="'.$y_nama.'" width="40" border="5">');

$pdf->SetX(25);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,7,$sek_nama,0,0,'L',0);
$pdf->Ln();

$pdf->SetX(25);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(100,4,$sek_alamat,0,0,'L',0);
$pdf->Ln();

$pdf->SetX(25);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(100,4,$sek_kontak,0,0,'L',0);
$pdf->Ln();

$pdf->SetX(10);
$pdf->Cell(130,0.5,'',0,0,'L',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->SetX(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(130,5,'KARTU RENCANA STUDI / KRS',0,0,'C',0);
$pdf->Ln();


$nil_Y = $pdf->GetY();
$pdf->Cell(130,10,'',1,0,'L',0);

$pdf->SetY($nil_Y);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(12,5,'Nama',0,0,'L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(74,5,': '.$ku_nama.'',0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(24,5,'Semester',0,0,'L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,5,': '.$smt.' ('.$smt_jns.')',0,0,'L',0);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(12,5,'NIM',0,0,'L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(74,5,': '.$ku_nim.'',0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(24,5,'Thn.Akademik',0,0,'L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,5,': '.$tpel_thn1.'/'.$tpel_thn2.'',0,0,'L',0);
$pdf->Ln();



//terpilih
$qtpx = mysql_query("SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);


$pdf->Cell(130,5,'Program Studi : '.$tpx_nama.'',1,0,'L',0);
$pdf->Ln();
$pdf->Ln();





//cek keberadaan mahasiswa
$qcc2 = mysql_query("SELECT m_mahasiswa.*, mahasiswa_kelas.* ".
			"FROM m_mahasiswa, mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
			"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
			"AND mahasiswa_kelas.kd_smt = '$smtkd' ".
			"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
			"AND mahasiswa_kelas.kd_ruang = '$rukd' ".
			"AND m_mahasiswa.kd = '$kd'");
$rcc2 = mysql_fetch_assoc($qcc2);
$tcc2 = mysql_num_rows($qcc2);


//jika sesuai
if ($tcc2 != 0)
	{
	//daftar makul-nya
	$qkulo = mysql_query("SELECT mahasiswa_makul.*, mahasiswa_makul.kd AS kulkd, ".
										"m_makul.*, m_makul.kd AS makul, m_makul_smt.sks AS ssks ".
										"FROM mahasiswa_makul, m_makul, m_makul_smt ".
										"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
										"AND m_makul_smt.kd_makul = m_makul.kd ".
										"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ".
										"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
										"AND mahasiswa_makul.kd_smt = '$smtkd' ". 
										"AND m_makul.kd_progdi = '$progdi' ".
										"AND m_makul_smt.kd_tapel = '$tapelkd' ".
										"AND m_makul_smt.kd_smt = '$smtkd' ".
										"ORDER BY m_makul.kode ASC");
	$rkulo = mysql_fetch_assoc($qkulo);
	$tkulo = mysql_num_rows($qkulo);


	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(7,5,'No.',1,0,'C',1);
	$pdf->Cell(15,5,'Kode',1,0,'C',1);
	$pdf->Cell(98,5,'Nama Mata Kuliah',1,0,'C',1);
	$pdf->Cell(10,5,'SKS',1,0,'C',1);
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
		$kulo_kulkd = nosql($rkulo['kulkd']);
		$kulo_kode = nosql($rkulo['kode']);
		$kulo_nama = balikin($rkulo['nama']);
		$kulo_sks = nosql($rkulo['ssks']);



		$pdf->SetFont('Arial','',10);
		$pdf->Cell(7,5,''.$i_nomer.'',1,0,'C');			
		$pdf->Cell(15,5,''.$kulo_kode.'',1,0,'C');
		$pdf->Cell(98,5,''.$kulo_nama.'',1,0,'L');
		$pdf->Cell(10,5,''.$kulo_sks.'',1,0,'C');
		$pdf->Ln();
		}
	while ($rkulo = mysql_fetch_assoc($qkulo));




	//total sks
	$qtoku = mysql_query("SELECT SUM(m_makul_smt.sks) AS total ".
									"FROM mahasiswa_makul, m_makul, m_makul_smt ".
									"WHERE mahasiswa_makul.kd_makul = m_makul.kd ".
									"AND m_makul_smt.kd_makul = m_makul.kd ".
									"AND mahasiswa_makul.kd_mahasiswa_kelas = '$mkkd' ".
									"AND mahasiswa_makul.kd_tapel = '$tapelkd' ".
									"AND mahasiswa_makul.kd_smt = '$smtkd' ". 
									"AND m_makul.kd_progdi = '$progdi' ".
									"AND m_makul_smt.kd_tapel = '$tapelkd' ".
									"AND m_makul_smt.kd_smt = '$smtkd'");
	$rtoku = mysql_fetch_assoc($qtoku);
	$toku_total = nosql($rtoku['total']);



	//tgl.pengesahan
	$qsahi = mysql_query("SELECT DATE_FORMAT(mahasiswa_makul.tgl_sah, '%d') AS atgl, ".
							"DATE_FORMAT(mahasiswa_makul.tgl_sah, '%m') AS abln, ".
							"DATE_FORMAT(mahasiswa_makul.tgl_sah, '%Y') AS athn, ".
							"mahasiswa_makul.* ".
							"FROM mahasiswa_makul ".
							"WHERE kd_mahasiswa_kelas = '$mkkd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_smt = '$smtkd'");
	$rsahi = mysql_fetch_assoc($qsahi);
	$atgl = nosql($rsahi['atgl']);
	$abln = nosql($rsahi['abln']);
	$athn = nosql($rsahi['athn']);




	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(7,5,'',1,0,'L',1);			
	$pdf->Cell(15,5,'',1,0,'L',1);
	$pdf->Cell(98,5,'Jumlah ',1,0,'R',1);
	$pdf->Cell(10,5,''.$toku_total.'',1,0,'C',1);
	$pdf->Ln();
	$pdf->Ln();
	
	
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(130,5,'Tgl.Pengesahan : '.$atgl.' '.$arrbln1[$abln].' '.$athn.'',1,0,'L');
	$pdf->Ln();
	$pdf->Ln();
	

	
	$nil_Y1 = $pdf->GetY();	
	$pdf->Cell(40,25,'',1,0,'L');
	$pdf->Cell(50,25,'',1,0,'L');
	$pdf->Cell(40,25,'',1,0,'L');
	
	
	$pdf->SetY($nil_Y1);
	$pdf->Cell(40,5,'Akademik, ',0,0,'L');
	$pdf->Cell(50,5,'Pembimbing Kelas, ',0,0,'L');
	$pdf->Cell(40,5,'Mahasiswa, ',0,0,'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(40,5,''.$tp2x_pegawai.'',0,0,'L');
	$pdf->Cell(50,5,''.$tp2xx_nama.'',0,0,'L');
	$pdf->Cell(40,5,''.$ku_nama.'',0,0,'L');

	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//output-kan ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->Output("krs_$ku_nim.pdf",I);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>