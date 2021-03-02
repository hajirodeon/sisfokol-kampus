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


session_start();

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admmhs.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "biodata.php";
$judul = "Biodata";
$judulku = "[$mhs_session : $nim6_session. $nm6_session] ==> $judul";
$juduli = $judul;


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();

//js
require("../../inc/menu/admmhs.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td width="80%">';


//data query
$qnil = mysqli_query($koneksi, "SELECT m_mahasiswa.*, DATE_FORMAT(m_mahasiswa.tgl_lahir, '%d') AS lahir_tgl, ".
			"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%m') AS lahir_bln, ".
			"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%Y') AS lahir_thn ".
			"FROM m_mahasiswa ".
			"WHERE kd = '$kd6_session'");
$rnil = mysqli_fetch_assoc($qnil);
$y_nim = nosql($rnil['nim']);
$y_nama = balikin($rnil['nama']);

$tmp_lahir = balikin($rnil['tmp_lahir']);

$lahir_tgl = nosql($rnil['lahir_tgl']);
$lahir_bln = nosql($rnil['lahir_bln']);
$lahir_thn = nosql($rnil['lahir_thn']);

$jkelkd = nosql($rnil['kelamin']);
$a_status_sipil = balikin($rnil['status_sipil']);
$a_warga = balikin($rnil['warga_negara']);
$jagmkd = nosql($rnil['kd_agama']);

$a_alamat_skrg = balikin($rnil['alamat_skrg']);
$a_alamat_asal = balikin($rnil['alamat_asal']);
$y_filex = $rnil['filex'];



//asal pddkn
$qku1 = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa_pddkn ".
			"WHERE kd_mahasiswa = '$kd6_session'");
$rku1 = mysqli_fetch_assoc($qku1);
$ku1_asal_sekolah = balikin($rku1['asal_sekolah']);
$ku1_thn_lulus = balikin($rku1['thn_lulus']);
$ku1_jurusan = balikin($rku1['jurusan']);
$ku1_status_asal_sekolah = balikin($rku1['status_asal_sekolah']);



//status mahasiswa
$qku2 = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa_status ".
			"WHERE kd_mahasiswa = '$kd6_session'");
$rku2 = mysqli_fetch_assoc($qku2);
$ku2_tapelkd = nosql($rku2['kd_tapel']);
$ku2_status = balikin($rku2['status']);
$ku2_sebagai_mhs = balikin($rku2['sebagai_mhs']);
$ku2_kd_progdi = balikin($rku2['kd_progdi']);
$ku2_kd_jenjang = balikin($rku2['kd_jenjang']);
$ku2_pindahan_pt = balikin($rku2['pindahan_pt']);
$ku2_pindahan_progdi = balikin($rku2['pindahan_progdi']);
$ku2_pindahan_jurusan = balikin($rku2['pindahan_jurusan']);
$ku2_pindahan_jenjang = balikin($rku2['pindahan_jenjang']);
$ku2_smtkd = nosql($rku2['kd_smt']);

//jika null, anggap saja masuk sejak semester awal / satu
if (empty($ku2_smtkd))
	{
	$ku2_smtkd = "c4ca4238a0b923820dcc509a6f75849b";
	}



//sehat
$qku3 = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa_sehat ".
			"WHERE kd_mahasiswa = '$kd6_session'");
$rku3 = mysqli_fetch_assoc($qku3);
$ku3_tb = balikin($rku3['tb']);
$ku3_bb = balikin($rku3['bb']);
$ku3_mata = balikin($rku3['mata']);
$ku3_gol_darah = balikin($rku3['gol_darah']);
$ku3_pendengaran = balikin($rku3['pendengaran']);
$ku3_penyakit_pernah = balikin($rku3['penyakit_pernah']);
$ku3_penyakit_sekarang = balikin($rku3['penyakit_sekarang']);


//organisasi
$qku4 = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa_org ".
			"WHERE kd_mahasiswa = '$kd6_session'");
$rku4 = mysqli_fetch_assoc($qku4);
$ku4_org_a = balikin($rku4['org_a']);
$ku4_org_b = balikin($rku4['org_b']);
$ku4_org_c = balikin($rku4['org_c']);



//hobi
$qku5 = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa_hobi ".
			"WHERE kd_mahasiswa = '$kd6_session'");
$rku5 = mysqli_fetch_assoc($qku5);
$ku5_hobi_a = balikin($rku5['hobi_a']);
$ku5_hobi_b = balikin($rku5['hobi_b']);
$ku5_hobi_c = balikin($rku5['hobi_c']);



//hobi
$qku6 = mysqli_query($koneksi, "SELECT * FROM m_mahasiswa_ortu ".
			"WHERE kd_mahasiswa = '$kd6_session'");
$rku6 = mysqli_fetch_assoc($qku6);
$ku6_ayah_nama = balikin($rku6['ayah_nama']);
$ku6_ayah_pddkn = balikin($rku6['ayah_pddkn']);
$ku6_ayah_pekerjaan = balikin($rku6['ayah_pekerjaan']);
$ku6_ayah_alamat = balikin($rku6['ayah_alamat']);
$ku6_ayah_hidup = balikin($rku6['ayah_hidup']);
$ku6_ibu_nama = balikin($rku6['ibu_nama']);
$ku6_ibu_pddkn = balikin($rku6['ibu_pddkn']);
$ku6_ibu_pekerjaan = balikin($rku6['ibu_pekerjaan']);
$ku6_ibu_alamat = balikin($rku6['ibu_alamat']);
$ku6_ibu_hidup = balikin($rku6['ibu_hidup']);
$ku6_nama_pj = balikin($rku6['nama_pj']);
$ku6_hubungan = balikin($rku6['hubungan']);
$ku6_hasil_per_bulan = balikin($rku6['hasil_per_bulan']);
$ku6_hasil_per_tahun = balikin($rku6['hasil_per_tahun']);





//jika ayah hidup
if ($ku6_ayah_hidup == "true")
	{
	$ku6_ayah_hidup_ket = "Ya";
	}
else
	{
	$ku6_ayah_hidup_ket = "Tidak";
	}

//jika ibu hidup
if ($ku6_ibu_hidup == "true")
	{
	$ku6_ibu_hidup_ket = "Ya";
	}
else
	{
	$ku6_ibu_hidup_ket = "Tidak";
	}







echo '<big><strong>A. IDENTITAS PRIBADI</strong></big>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td width="150">
1.NIM
</td>
<td>: </td>
<td>
<input name="a_nim" type="text" value="'.$y_nim.'" size="20" class="input" readonly>
</td>
</tr>

<tr valign="top">
<td width="150">
2.Nama
</td>
<td>: </td>
<td>
<input name="a_nama1" type="text" value="'.$y_nama.'" size="30" class="input" readonly>
</td>
</tr>

<tr valign="top">
<td width="150">
3.Jenis Kelamin
</td>
<td>: </td>
<td>
<select name="a_kelamin" class="input" readonly>
<option value="'.$jkelkd.'">'.$jkelkd.'</option>
</select>
</td>
</tr>

<tr valign="top">
<td width="150">
4.TTL
</td>
<td>: </td>
<td>
<input name="a_tmp_lahir" type="text" value="'.$tmp_lahir.'" size="30" class="input" readonly>,
<select name="a_lahir_tgl" class="input" readonly>
<option value="'.$lahir_tgl.'" selected>'.$lahir_tgl.'</option>
</select>
<select name="a_lahir_bln" class="input" readonly>
<option value="'.$lahir_bln.'" selected>'.$arrbln1[$lahir_bln].'</option>
</select>
<select name="a_lahir_thn" class="input" readonly>
<option value="'.$lahir_thn.'" selected>'.$lahir_thn.'</option>
</select>
</td>
</tr>

<tr valign="top">
<td width="150">
5.Status Sipil
</td>
<td>: </td>
<td>
<select name="a_status_sipil" class="input" readonly>
<option value="'.$a_status_sipil.'">'.$a_status_sipil.'</option>
</select>
</td>
</tr>


<tr valign="top">
<td width="150">
6.Kewarganegaraan
</td>
<td>: </td>
<td>
<select name="a_warga" class="input" readonly>
<option value="'.$a_warga.'">'.$a_warga.'</option>
</select>
</td>
</tr>


<tr valign="top">
<td width="150">
7.Agama
</td>
<td>: </td>
<td>
<select name="a_agama" class="input" readonly>';

//terpilih
$qagmx = mysqli_query($koneksi, "SELECT * FROM m_agama ".
			"WHERE kd = '$jagmkd'");
$ragmx = mysqli_fetch_assoc($qagmx);
$agmx_kd = nosql($ragmx['kd']);
$agmx_agama = balikin($ragmx['agama']);

echo '<option value="'.$agmx_kd.'">'.$agmx_agama.'</option>
</select>
</td>
</tr>

<tr valign="top">
<td width="150">
8.Alamat Sekarang
</td>
<td>: </td>
<td>
<input name="a_alamat_skrg" type="text" value="'.$a_alamat_skrg.'" size="50" class="input" readonly>
</td>
</tr>


<tr valign="top">
<td width="150">
9.Alamat Asal
</td>
<td>: </td>
<td>
<input name="a_alamat_asal" type="text" value="'.$a_alamat_asal.'" size="50" class="input" readonly>
</td>
</tr>
<table>


<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td width="250">
10.Latar Belakang & Status Pendidikan
</td>
<td></td>
<td></td>
</tr>

<tr>
<td width="250">
<dd>*Asal SMTA</dd>
</td>
<td>:</td>
<td>
<input name="a_asal_smta" type="text" value="'.$ku1_asal_sekolah.'" size="30" class="input" readonly>
</td>
</tr>

<tr>
<td width="250">
<dd>*Status SMTA</dd>
</td>
<td>:</td>
<td>
<select name="a_status_smta" class="input" readonly>
<option value="'.$ku1_status_asal_sekolah.'">'.$ku1_status_asal_sekolah.'</option>
</select>
</td>
</tr>

<tr>
<td width="250">
<dd>*Jurusan SMTA</dd>
</td>
<td>:</td>
<td>
<input name="a_jurusan_smta" type="text" value="'.$ku1_jurusan.'" size="10" class="input" readonly>
</td>
</tr>

<tr>
<td width="250">
<dd>*Tahun Lulus</dd>
</td>
<td>:</td>
<td>
<input name="a_thn_lulus" type="text" value="'.$ku1_thn_lulus.'" size="4" class="input" readonly>
</td>
</tr>


<tr>
<td width="250">
11.Status Mahasiswa
</td>
<td></td>
<td></td>
</tr>



<tr>
<td width="250">
<dd>*Tahun Masuk Akademik</dd>
</td>
<td>:</td>
<td>
<select name="a_thn_masuk" class="input" readonly>';

//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd = '$ku2_tapelkd'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<option value="'.$tpx_kd.'">'.$tpx_thn1.'/'.$tpx_thn2.'</option>
</select>
</td>
</tr>

<tr>
<td width="250">
<dd>*Status Mahasiswa</dd>
</td>
<td>:</td>
<td>
<select name="a_status_mhs" class="input" readonly>
<option value="'.$ku2_status.'">'.$ku2_status.'</option>
</select>
</td>
</tr>

<tr>
<td width="250">
<dd>*Terdaftar Sebagai Mahasiswa</dd>
</td>
<td>:</td>
<td>
<select name="a_sebagai_mhs" class="input" readonly>
<option value="'.$ku2_sebagai_mhs.'">'.$ku2_sebagai_mhs.'</option>
</select>
</td>
</tr>

<tr>
<td width="250">
<dd>*Program Studi/Jenjang</dd>
</td>
<td>:</td>
<td>
<select name="a_progdi" class="input" readonly>';

//terpilih
$qpro1 = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$ku2_kd_progdi'");
$rpro1 = mysqli_fetch_assoc($qpro1);
$pro1_kd = nosql($rpro1['kd']);
$pro1_nama = balikin($rpro1['nama']);

echo '<option value="'.$pro1_kd.'" selected>'.$pro1_nama.'</option>
</select> /

<select name="a_jenjang" class="input" readonly>';

//terpilih
$qjnej1 = mysqli_query($koneksi, "SELECT * FROM m_jenjang ".
			"WHERE kd = '$ku2_kd_jenjang'");
$rjenj1 = mysqli_fetch_assoc($qjnej1);
$jenj1_kd = nosql($rjenj1['kd']);
$jenj1_nama = balikin($rjenj1['jenjang']);

echo '<option value="'.$jenj1_kd.'" selected>'.$jenj1_nama.'</option>
</select>
</td>
</tr>

<tr>
<td width="250">
<dd>*Semester Masuk</dd>
</td>
<td>:</td>
<td>
<select name="a_smt" class="input" readonly>';

//terpilih
$qpro13 = mysqli_query($koneksi, "SELECT * FROM m_smt ".
			"WHERE kd = '$ku2_smtkd'");
$rpro13 = mysqli_fetch_assoc($qpro13);
$pro13_kd = nosql($rpro13['kd']);
$pro13_smt = balikin($rpro13['smt']);

echo '<option value="'.$pro13_kd.'" selected>'.$pro13_smt.'</option>
</select>
</td>
</tr>

<tr>
<td width="250"></td>
<td></td>
<td></td>
</tr>

<tr>
<td width="250">
<dd>(Untuk Mahasiswa Pindahan)</dd>
</td>
<td></td>
<td></td>
</tr>

<tr>
<td width="250">
<dd>*Perguruan Tinggi Asal</dd>
</td>
<td>:</td>
<td>
<input name="a_pindahan_pt_asal" type="text" value="'.$ku2_pindahan_pt.'" size="30" class="input" readonly>
</td>
</tr>

<tr>
<td width="250">
<dd>*Jurusan / Program Studi</dd>
</td>
<td>:</td>
<td>
<input name="a_pindahan_jurusan" type="text" value="'.$ku2_pindahan_jurusan.'" size="20" class="input" readonly> /
<input name="a_pindahan_progdi" type="text" value="'.$ku2_pindahan_progdi.'" size="20" class="input" readonly>
</td>
</tr>

<tr>
<td width="250">
<dd>*Jenjang</dd>
</td>
<td>:</td>
<td>
<select name="a_pindahan_jenjang" class="input" readonly>
<option value="'.$ku2_pindahan_jenjang.'">'.$ku2_pindahan_jenjang.'</option>
</select>
</td>
</tr>

<tr>
<td width="250">
12. Status Kesehatan
</td>
<td></td>
<td></td>
</tr>

<tr>
<td width="250">
<dd>*Tinggi Badan</dd>
</td>
<td>:</td>
<td>
<input name="a_tb" type="text" value="'.$ku3_tb.'" size="3" class="input" readonly>
</td>
</tr>


<tr>
<td width="250">
<dd>*Berat Badan</dd>
</td>
<td>:</td>
<td>
<input name="a_bb" type="text" value="'.$ku3_bb.'" size="3" class="input" readonly>
</td>
</tr>


<tr>
<td width="250">
<dd>*Mata</dd>
</td>
<td>:</td>
<td>
<select name="a_mata" class="input" readonly>
<option value="'.$ku3_mata.'">'.$ku3_mata.'</option>
</select>
</td>
</tr>


<tr>
<td width="250">
<dd>*Golongan Darah</dd>
</td>
<td>:</td>
<td>
<select name="a_goldarah" class="input" readonly>
<option value="'.$ku3_gol_darah.'">'.$ku3_gol_darah.'</option>
</select>
</td>
</tr>

<tr>
<td width="250">
<dd>*Pendengaran</dd>
</td>
<td>:</td>
<td>
<select name="a_dengar" class="input" readonly>
<option value="'.$ku3_pendengaran.'">'.$ku3_pendengaran.'</option>
</select>
</td>
</tr>

<tr>
<td width="250">
<dd>*Penyakit yang pernah diderita</dd>
</td>
<td>:</td>
<td>
<select name="a_penyakit" class="input" readonly>
<option value="'.$ku3_penyakit_pernah.'">'.$ku3_penyakit_pernah.'</option>
</select>
</td>
</tr>


<tr>
<td width="250">
<dd>*Penyakit yang diderita sekarang</dd>
</td>
<td>:</td>
<td>
<select name="a_penyakit_skrg" class="input" readonly>
<option value="'.$ku3_penyakit_sekarang.'">'.$ku3_penyakit_sekarang.'</option>
</select>
</td>
</tr>
</table>



<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<tr>
<td>
13. Pengalaman Organisasi
</td>
<td></td>
<td></td>
</tr>

<tr valign="top">
<tr>
<td>
<dd>a. <input name="a_org_a" type="text" value="'.$ku4_org_a.'" size="50" class="input" readonly></dd>
</td>
<td></td>
<td></td>
</tr>

<tr valign="top">
<tr>
<td>
<dd>b. <input name="a_org_b" type="text" value="'.$ku4_org_b.'" size="50" class="input" readonly></dd>
</td>
<td></td>
<td></td>
</tr>

<tr valign="top">
<tr>
<td>
<dd>c. <input name="a_org_c" type="text" value="'.$ku4_org_c.'" size="50" class="input" readonly></dd>
</td>
<td></td>
<td></td>
</tr>


<tr valign="top">
<tr>
<td>
14. Hobi
</td>
<td></td>
<td></td>
</tr>

<tr valign="top">
<tr>
<td>
<dd>a. <input name="a_hobi_a" type="text" value="'.$ku5_hobi_a.'" size="50" class="input" readonly></dd>
</td>
<td></td>
<td></td>
</tr>

<tr valign="top">
<tr>
<td>
<dd>b. <input name="a_hobi_b" type="text" value="'.$ku5_hobi_b.'" size="50" class="input" readonly></dd>
</td>
<td></td>
<td></td>
</tr>

<tr valign="top">
<tr>
<td>
<dd>c. <input name="a_hobi_c" type="text" value="'.$ku5_hobi_c.'" size="50" class="input" readonly></dd>
</td>
<td></td>
<td></td>
</tr>

</table>


<big><strong>B. IDENTITAS ORANG TUA</strong></big>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="250">
1.Ayah
</td>
<td></td>
<td></td>
</tr>

<tr>
<td width="250">
<dd>a. Nama</dd>
</td>
<td>:</td>
<td>
<input name="b_ayah_nama" type="text" value="'.$ku6_ayah_nama.'" size="30" class="input" readonly>
</td>
</tr>

<tr>
<td width="250">
<dd>b. Pendidikan</dd>
</td>
<td>:</td>
<td>
<select name="b_ayah_pddkn" class="input" readonly>
<option value="'.$ku6_ayah_pddkn.'">'.$ku6_ayah_pddkn.'</option>
</select>
</td>
</tr>

<tr>
<td width="250">
<dd>c. Pekerjaan</dd>
</td>
<td>:</td>
<td>
<select name="b_ayah_kerja" class="input" readonly>
<option value="'.$ku6_ayah_pekerjaan.'">'.$ku6_ayah_pekerjaan.'</option>
</select>
</td>
</tr>


<tr>
<td width="250">
<dd>d. Alamat</dd>
</td>
<td>:</td>
<td>
<input name="b_ayah_alamat" type="text" value="'.$ku6_ayah_alamat.'" size="50" class="input" readonly>
</td>
</tr>

<tr>
<td width="250">
<dd>e. Masih Hidup...?</dd>
</td>
<td>:</td>
<td>
<select name="b_ayah_hidup" class="input" readonly>
<option value="'.$ku6_ayah_hidup.'">'.$ku6_ayah_hidup_ket.'</option>
</select>
</td>
</tr>






<tr>
<td width="250">
2.Ibu
</td>
<td></td>
<td></td>
</tr>

<tr>
<td width="250">
<dd>a. Nama</dd>
</td>
<td>:</td>
<td>
<input name="b_ibu_nama" type="text" value="'.$ku6_ibu_nama.'" size="30" class="input" readonly>
</td>
</tr>

<tr>
<td width="250">
<dd>b. Pendidikan</dd>
</td>
<td>:</td>
<td>
<select name="b_ibu_pddkn" class="input" readonly>
<option value="'.$ku6_ibu_pddkn.'">'.$ku6_ibu_pddkn.'</option>
</select>
</td>
</tr>

<tr>
<td width="250">
<dd>c. Pekerjaan</dd>
</td>
<td>:</td>
<td>
<select name="b_ibu_kerja" class="input" readonly>
<option value="'.$ku6_ibu_pekerjaan.'">'.$ku6_ibu_pekerjaan.'</option>
</select>
</td>
</tr>


<tr>
<td width="250">
<dd>d. Alamat</dd>
</td>
<td>:</td>
<td>
<input name="b_ibu_alamat" type="text" value="'.$ku6_ibu_alamat.'" size="50" class="input" readonly>
</td>
</tr>

<tr>
<td width="250">
<dd>e. Masih Hidup...?</dd>
</td>
<td>:</td>
<td>
<select name="b_ibu_hidup" class="input" readonly>
<option value="'.$ku6_ibu_hidup.'">'.$ku6_ibu_hidup_ket.'</option>
</select>
</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="300">
3.Nama Penanggung Jawab Biaya Pendidikan
</td>
<td>:</td>
<td>
<input name="b_nama_pj" type="text" value="'.$ku6_nama_pj.'" size="30" class="input" readonly>
</td>
</tr>

<tr>
<td width="300">
4.Hubungan dengan Mahasiswa
</td>
<td>:</td>
<td>
<select name="b_hubungan" class="input" readonly>
<option value="'.$ku6_hubungan.'">'.$ku6_hubungan.'</option>
</select>
</td>
</tr>

<tr>
<td width="300">
5.Jumlah Penghasilan rata - rata
</td>
<td></td>
<td></td>
</tr>

<tr>
<td width="300">
<dd>a.Rata-rata per Bulan</dd>
</td>
<td>:</td>
<td>
Rp.<input name="b_hasil_bulan" type="text" value="'.$ku6_hasil_per_bulan.'" size="10" class="input" readonly>,00
</td>
</tr>

<tr>
<td width="300">
<dd>b.Rata-rata per Tahun</dd>
</td>
<td>:</td>
<td>
Rp.<input name="b_hasil_tahun" type="text" value="'.$ku6_hasil_per_tahun.'" size="10" class="input" readonly>,00
</td>
</tr>


</table>


</td>
<td width="1%">
</td>
<td>';

//nek null foto
if (empty($y_filex))
	{
	$nil_foto = "$sumber/img/foto_blank.jpg";
	}
else
	{
	$nil_foto = "$sumber/filebox/mahasiswa/$kd/$y_filex";
	}

echo '<img src="'.$nil_foto.'" alt="'.$y_nama.'" width="150" height="200" border="5">
</td>
</tr>
</table>
</p>

</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>