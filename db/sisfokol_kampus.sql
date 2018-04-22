-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2015 at 12:12 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sisfokol_kampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminx`
--

CREATE TABLE IF NOT EXISTS `adminx` (
  `kd` varchar(50) NOT NULL,
  `usernamex` varchar(10) NOT NULL,
  `passwordx` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminx`
--

INSERT INTO `adminx` (`kd`, `usernamex`, `passwordx`) VALUES
('e807f1fcf82d132f9bb018ca6738a19f', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `adm_baak`
--

CREATE TABLE IF NOT EXISTS `adm_baak` (
  `kd` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adm_baak`
--

INSERT INTO `adm_baak` (`kd`, `kd_pegawai`) VALUES
('08aed1920b4a167a7221905525b6ad35', '586bf5e5ac8ef75e831247d3bf27f31f'),
('895a28f241b57a96a8034dfb67ec98a9', '656ed78e69a85b531258c4e19f0ab059'),
('697d454d525da87866329c6e0c825a36', '38afd8bc71cb7bfec99627b34ab471bd'),
('98680209f702f2866282fc5c63b7a22d', 'f855c67fc8044a8184d158de4e85b0af'),
('19d5707f273f87caec87f752814598dc', '2d322896b315d5af5aa4536f4e2347a9'),
('18dce07a748a1ab230a13483600bc2a7', 'f5ce7a2836f2188290c0f3726e75fe7a'),
('7ca9bb1c38583e9ada3b2e1e5f6cdab1', '1c512b887f7a3388927702279185d17b'),
('3f4d15a4265ca06fcaf24a97c35af394', 'c78b863c1fe7094595bec20626d3945f');

-- --------------------------------------------------------

--
-- Table structure for table `adm_bak`
--

CREATE TABLE IF NOT EXISTS `adm_bak` (
  `kd` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adm_bak`
--

INSERT INTO `adm_bak` (`kd`, `kd_pegawai`) VALUES
('0c0e15841efc085fe915f484d17197cf', 'a967d9f322b39a159bf8b85f41dc913e'),
('0a3bddeb5e551528e43247b75b3ed6f6', '32576312ac9b2c2182e9c08137cb89ae'),
('c853b1b3fe3c82d7cd30230c054977a9', '81ce80129daf6b3cdc7854bfcac53c64'),
('97834ad62b79839321b967e98adc04a8', '6d2735a27d236dcbd706b2ecf46ba2ad'),
('90b82669815b61bbbab8d72580fa0220', '8f127b02c152a579d49921d42b0d2c45'),
('c8dc3694e30f52b65071f1fa8b217068', 'a6247eb1c1727d744dddb9328243879a'),
('858f92270409bcdd9de320adf18d8a5e', 'c78b863c1fe7094595bec20626d3945f');

-- --------------------------------------------------------

--
-- Table structure for table `adm_bau`
--

CREATE TABLE IF NOT EXISTS `adm_bau` (
  `kd` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adm_bau`
--

INSERT INTO `adm_bau` (`kd`, `kd_pegawai`) VALUES
('a957cd0355fafe6f5f469fb5d00612e2', '8f127b02c152a579d49921d42b0d2c45'),
('4aa81a9700b29b5c9160bc751b17e68c', 'acbdb430bb542ae1ad768d14bf78d2f4'),
('84ae5239f21bfa152cc003237251cefa', 'c78b863c1fe7094595bec20626d3945f');

-- --------------------------------------------------------

--
-- Table structure for table `adm_direktur`
--

CREATE TABLE IF NOT EXISTS `adm_direktur` (
  `kd` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adm_direktur`
--

INSERT INTO `adm_direktur` (`kd`, `kd_pegawai`) VALUES
('c3ba6a215e0e103dd69144c9b4baed0b', '32576312ac9b2c2182e9c08137cb89ae'),
('4995efb4e3dba987cd618724d164f1e1', '0f6eb4c2d3ca996f1e3dd8472fac4c56'),
('457a399343db5a0c5546574fbee31157', 'c78b863c1fe7094595bec20626d3945f');

-- --------------------------------------------------------

--
-- Table structure for table `adm_kemhs`
--

CREATE TABLE IF NOT EXISTS `adm_kemhs` (
  `kd` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adm_kemhs`
--

INSERT INTO `adm_kemhs` (`kd`, `kd_pegawai`) VALUES
('af7f3746b9df65f1b174415970536ebb', '49e96828700e091d2535a8507eef678d'),
('311c1cf2209786766ae6b12db9ea3ed7', '43fe330f2d8a2f4709955ad6edfbcd12'),
('2a84a79b6db3a3f36efb32cfdc033de9', '32576312ac9b2c2182e9c08137cb89ae'),
('b2557457c3827fbbef7bde747e2ba9d5', 'c45cf0ad7b10e12793e2ed6a6c31e2d0'),
('a7f8c4ca392077021f4f8c2bb4b52f5a', '6ae33edabfe010cc169310160cc376e3'),
('940a7910dcd3472a5475b6dc27eb186a', 'e3d87a35d3ae84036d07545c878c3619'),
('98054129e378cf9eedc0bcf462c82c37', 'c78b863c1fe7094595bec20626d3945f');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE IF NOT EXISTS `alumni` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `kd` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL,
  `kd_makul` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_ruang` varchar(50) NOT NULL,
  `postdate` datetime NOT NULL,
  `kd_tapel` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`kd`, `kd_progdi`, `kd_kelas`, `kd_pegawai`, `kd_makul`, `kd_smt`, `kd_ruang`, `postdate`, `kd_tapel`) VALUES
('241aaee97e51a87680df7f1ab793a415', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'c78b863c1fe7094595bec20626d3945f', 'eaaf7959eba51755bae350720546a8b4', 'c4ca4238a0b923820dcc509a6f75849b', 'cc3e2f0c461d76425055deef36955645', '2015-09-17 10:19:29', '1aafa578cf4790a11ecac346fc6d5aa4'),
('f09261d2d25d7f6a01f80ea8357b96c4', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'c78b863c1fe7094595bec20626d3945f', 'db8644a7b69b0174a7d7b2016380f505', 'c4ca4238a0b923820dcc509a6f75849b', 'cc3e2f0c461d76425055deef36955645', '2015-09-17 10:19:39', '1aafa578cf4790a11ecac346fc6d5aa4'),
('5a027a4bb3cbda67488e88c7160af3ac', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'c78b863c1fe7094595bec20626d3945f', '8666ed9021eb8164210dc3113787500e', 'c4ca4238a0b923820dcc509a6f75849b', 'cc3e2f0c461d76425055deef36955645', '2015-09-17 10:19:51', '1aafa578cf4790a11ecac346fc6d5aa4'),
('6370d9ce54bc4aa690dd17e537c24e7a', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'c95d3fa445297532b33e55fe55c65686', 'f71cda53f8da059d091065b0d39dbd12', 'c4ca4238a0b923820dcc509a6f75849b', 'cc3e2f0c461d76425055deef36955645', '2015-09-17 10:20:04', '1aafa578cf4790a11ecac346fc6d5aa4');

-- --------------------------------------------------------

--
-- Table structure for table `dosen_pembimbing`
--

CREATE TABLE IF NOT EXISTS `dosen_pembimbing` (
  `kd` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_ruang` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen_pembimbing`
--

INSERT INTO `dosen_pembimbing` (`kd`, `kd_progdi`, `kd_kelas`, `kd_tapel`, `kd_smt`, `kd_ruang`, `kd_pegawai`) VALUES
('b9ddc8267c1e66b38a3b4168cf9cb10e', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'cc3e2f0c461d76425055deef36955645', 'c78b863c1fe7094595bec20626d3945f'),
('29e5afec887bac288c954bc4a999519c', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', '96660ceb9b5863b9f5955052a51d3312', 'd7534b51e3a7ffb82661bb5e5c642339');

-- --------------------------------------------------------

--
-- Table structure for table `inv_brg`
--

CREATE TABLE IF NOT EXISTS `inv_brg` (
  `kd` varchar(50) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_brg`
--

INSERT INTO `inv_brg` (`kd`, `kode`, `nama`) VALUES
('89a604cca445fdaf05f223d48d1e2d8c', 'BR0001', 'Gunting'),
('020919fb5a2e6034b8cabbe08ac1ba0d', 'BR0002', 'Penggaris Kayu Besar'),
('c544d4968d73bea79164c352651734a5', 'BR0003', 'Papan Tulis'),
('812f13b24e536dd9f7f184882e826401', 'BR0004', 'Meja Lipat'),
('8f8f089be50be74bbef64102f2144eed', 'BR0005', 'Kursi Lipat'),
('40b414426795f13813766d784a407e79', 'BR0006', 'Jam Dinding'),
('97dc48d7cf464acc572ed0ddb14f2361', 'BR0007', 'Komputer'),
('e9fb099ebd083a4a82bbf5960b147dc9', 'BR0008', 'Laptop'),
('c91549091d64087d115b6b9f8dde778c', 'BR0009', 'Motor'),
('9f3935038778fdba6217da0b9ef2f848', 'BR0010', 'Mobil'),
('39299f329dfb0526bfa69356cd78c88b', 'BR0011', 'Finggerprint'),
('528d583e67eff4ef6779388e5c66cbcc', 'BR0012', 'WiFi Router'),
('df01a0800cb6e3ffd32b7b79be1b01fd', 'BR0013', 'Modem'),
('f54e871fc6f33d6dcc739af3edf000fe', 'BR0014', 'Cuter'),
('065b720d613eadc07f1552726cada610', 'BR0015', 'Dispenser');

-- --------------------------------------------------------

--
-- Table structure for table `inv_brg_lab`
--

CREATE TABLE IF NOT EXISTS `inv_brg_lab` (
  `kd` varchar(50) NOT NULL,
  `kd_brg` varchar(50) NOT NULL,
  `kd_lab` varchar(50) NOT NULL,
  `jml` varchar(5) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_brg_lab`
--

INSERT INTO `inv_brg_lab` (`kd`, `kd_brg`, `kd_lab`, `jml`, `postdate`) VALUES
('4d532c94b27b7445754a93055ef8fef2', '40b414426795f13813766d784a407e79', '76fe41ffbdc7d350d79933d29b964237', '1', '0000-00-00 00:00:00'),
('0850a1a5e80d95c507680c406d35ebb6', '020919fb5a2e6034b8cabbe08ac1ba0d', '76fe41ffbdc7d350d79933d29b964237', '1', '0000-00-00 00:00:00'),
('8b0e83a9f728bc539491d7d23d0a7656', '89a604cca445fdaf05f223d48d1e2d8c', 'c9d80946867450cc7b91a09061b4bb7b', '1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inv_brg_pengadaan`
--

CREATE TABLE IF NOT EXISTS `inv_brg_pengadaan` (
  `kd` varchar(50) NOT NULL,
  `kd_brg` varchar(50) NOT NULL,
  `no_seri` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `jenis_bahan` varchar(50) NOT NULL,
  `tahun_buat` varchar(4) NOT NULL,
  `tahun_beli` varchar(4) NOT NULL,
  `sumber_dana` varchar(50) NOT NULL,
  `jml` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_brg_pengadaan`
--

INSERT INTO `inv_brg_pengadaan` (`kd`, `kd_brg`, `no_seri`, `merk`, `model`, `jenis_bahan`, `tahun_buat`, `tahun_beli`, `sumber_dana`, `jml`) VALUES
('6ecfd685ad714907e603b565984e8631', '020919fb5a2e6034b8cabbe08ac1ba0d', '7', '6', '5', '4', '22', '3', '4', '6'),
('3f101e05791f81a7ca68bda957a265bd', '020919fb5a2e6034b8cabbe08ac1ba0d', '1', '2', '3', '4', '5', '6', '7', '8'),
('027badf17e6111abdbc49f04cd6ea491', '020919fb5a2e6034b8cabbe08ac1ba0d', '8', '5', '6', '3', '4', '6', '8', '2'),
('3a9b3acc803490fc7aef1b3eef0b19f4', '89a604cca445fdaf05f223d48d1e2d8c', '1234567', '1', '1', '1', '1', '1', '1', '10'),
('3a19d84ca1b823dd625e29690a42a6e5', '40b414426795f13813766d784a407e79', '1', '2', '3', '4', '5', '6', '78', '8'),
('13959997db93651ddf2060d3f7fbe887', '40b414426795f13813766d784a407e79', '8', '7', '6', '5', '4', '3', '2', '4'),
('e1b2e3d847e9ebb60c09c316ada831d1', '40b414426795f13813766d784a407e79', '8', '7', '6', '5', '4', '3', '4', '5'),
('79faa0bbf37f1acfbf160cc686227bed', '89a604cca445fdaf05f223d48d1e2d8c', '1234', 'A', 'S', 'D', '2012', '2013', 'Petty Cash', '5');

-- --------------------------------------------------------

--
-- Table structure for table `inv_brg_progdi`
--

CREATE TABLE IF NOT EXISTS `inv_brg_progdi` (
  `kd` varchar(50) NOT NULL,
  `kd_brg` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `jml` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_brg_progdi`
--

INSERT INTO `inv_brg_progdi` (`kd`, `kd_brg`, `kd_progdi`, `jml`) VALUES
('b5412d564e548c0f9a42e57cee8b3592', '40b414426795f13813766d784a407e79', '451b0c8b0e27e066606115541c25af08', '2'),
('236344374e5ec029f62e49d6ec54850a', '40b414426795f13813766d784a407e79', '012a7ebf3d38c316a406fd423e692ca5', '1'),
('d864e1ec9b95a106ea51819cffe90afd', '40b414426795f13813766d784a407e79', 'fe4dc25837042c1e954c07565e11d69d', '1'),
('5317c96125aad7248a132cedc6b099cb', '40b414426795f13813766d784a407e79', '7619ed9df8e6e190c2c758ab3cf71211', ''),
('11953a95b3d6845d4246e8ae891f2f95', '40b414426795f13813766d784a407e79', 'c8621d9f457352abd822d33e072763a2', ''),
('b1d48fdc911baf738fa2ff0e8945157d', '40b414426795f13813766d784a407e79', 'a313b78f7be3efd5f3f9e0d627703ee6', '');

-- --------------------------------------------------------

--
-- Table structure for table `inv_lab`
--

CREATE TABLE IF NOT EXISTS `inv_lab` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `lab` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_lab`
--

INSERT INTO `inv_lab` (`kd`, `lab`) VALUES
('c9d80946867450cc7b91a09061b4bb7b', 'Komputer');

-- --------------------------------------------------------

--
-- Table structure for table `inv_peng_lab`
--

CREATE TABLE IF NOT EXISTS `inv_peng_lab` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `kd_lab` varchar(50) NOT NULL DEFAULT '',
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `jam` varchar(5) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_ruang` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_peng_lab`
--

INSERT INTO `inv_peng_lab` (`kd`, `kd_lab`, `tgl`, `jam`, `kd_progdi`, `kd_ruang`) VALUES
('7b17761a7c4c3908609b10890c1edf22', '76fe41ffbdc7d350d79933d29b964237', '2007-01-01', '10:22', '7619ed9df8e6e190c2c758ab3cf71211', 'e8bdaca39d6b99fa04d51687eb8b2f25'),
('39fb9f26a79bf30bb0d8daf110b812ee', '76fe41ffbdc7d350d79933d29b964237', '2007-01-01', '11:13', '7619ed9df8e6e190c2c758ab3cf71211', 'e8bdaca39d6b99fa04d51687eb8b2f25');

-- --------------------------------------------------------

--
-- Table structure for table `inv_stock`
--

CREATE TABLE IF NOT EXISTS `inv_stock` (
  `kd` varchar(50) NOT NULL,
  `kd_brg` varchar(50) NOT NULL,
  `jml` varchar(10) NOT NULL DEFAULT '0',
  `jml_bagus` varchar(10) NOT NULL DEFAULT '0',
  `jml_sedang` varchar(10) NOT NULL DEFAULT '0',
  `jml_rusak` varchar(10) NOT NULL DEFAULT '0',
  `jml_hilang` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_stock`
--

INSERT INTO `inv_stock` (`kd`, `kd_brg`, `jml`, `jml_bagus`, `jml_sedang`, `jml_rusak`, `jml_hilang`) VALUES
('0b9b6096ed4b97bd8c1960850849ab27', '020919fb5a2e6034b8cabbe08ac1ba0d', '16', '7', '4', '3', '5'),
('09110d343e3ed748fb1df60d996917c8', '89a604cca445fdaf05f223d48d1e2d8c', '10', '10', '0', '0', '0'),
('a397e5bfe1822490268c5e8e7f659d4e', '40b414426795f13813766d784a407e79', '17', '17', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kalender`
--

CREATE TABLE IF NOT EXISTS `kalender` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl1` date NOT NULL,
  `tgl2` date NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kalender`
--

INSERT INTO `kalender` (`kd`, `nama`, `tgl1`, `tgl2`, `postdate`) VALUES
('701c58e403304fa2a3673cc454ca6669', 'Global Mulia Expo', '2015-05-31', '2015-05-31', '2015-04-30 02:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `ku`
--

CREATE TABLE IF NOT EXISTS `ku` (
  `kd` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `jenis` varchar(3) NOT NULL,
  `tgl_uji` date NOT NULL,
  `jam1` time NOT NULL,
  `jam2` time NOT NULL,
  `kd_makul` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ku`
--

INSERT INTO `ku` (`kd`, `kd_progdi`, `kd_kelas`, `kd_tapel`, `kd_smt`, `jenis`, `tgl_uji`, `jam1`, `jam2`, `kd_makul`) VALUES
('f6d4892a527ec91fa9e442ce0cd8f320', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'UTS', '2010-10-03', '14:33:00', '21:11:00', '854e511440e6ee7e3ef2f0d7bc646559'),
('2511122909954a177a4f287b8f3c3f92', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'UTS', '2010-08-02', '11:12:00', '13:14:00', '90e373ab2811aed494b31d828f57b12f'),
('55615ba974b0b5898b6da6675c7d8aea', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'UTS', '2014-06-23', '08:30:00', '11:45:00', '1447f9e2ade05d843602f22a0bbe775a'),
('8bd9fa18f41a0cb5f92aee88a1eaffd3', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'UAS', '2014-06-24', '08:30:00', '11:45:00', '9a599d05ac242518268d676167f52aea'),
('cebd0233a9c44bb96eb5bf427ef64385', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'UAS', '2014-06-25', '08:30:00', '11:45:00', '737772e0f99a0d02cb8c6752c55e6416'),
('3e230aaea12573f0a7c41b70e94a07d1', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'UAS', '2014-06-26', '08:30:00', '11:45:00', '110a06aadad60d978ce31672df0e47e4'),
('1c0d55b6406a0ef1f57588b6d8c1ab91', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'UAS', '2014-06-27', '08:30:00', '10:00:00', '0c33068ce76f6234d2877efb10e8a3ac'),
('431dce7c2c2fe4c2dda076fda29f22a7', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'UAS', '2014-06-27', '10:15:00', '11:45:00', 'ff2a64de2a82766f6b906b00aa289542'),
('dbf170d6fa010f6b959f0476e7301233', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'c4ca4238a0b923820dcc509a6f75849b', 'UTS', '2014-10-27', '08:30:00', '10:00:00', 'edc40a4314b938e7a735a5923136d980'),
('c0219c5b89a5c4b190cd4da735376256', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'c4ca4238a0b923820dcc509a6f75849b', 'UTS', '2014-08-01', '08:30:00', '11:30:00', '737772e0f99a0d02cb8c6752c55e6416');

-- --------------------------------------------------------

--
-- Table structure for table `ku_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `ku_mahasiswa` (
  `kd` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `jenis` varchar(3) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `kd_ruang` varchar(50) NOT NULL,
  `no_ujian` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ku_mahasiswa`
--

INSERT INTO `ku_mahasiswa` (`kd`, `kd_progdi`, `kd_kelas`, `kd_tapel`, `kd_smt`, `jenis`, `kd_mahasiswa`, `kd_ruang`, `no_ujian`) VALUES
('fedf2ae960226862f5d97274cce6061d', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'UTS', 'f2ad38e73146871cee50050fbf7474a7', 'e8bdaca39d6b99fa04d51687eb8b2f25', '1/UTS/X/10'),
('fedf2ae960226862f5d97274cce6061d', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'UTS', 'cbb9ebd1adf31bacd22f25e0933a29ff', 'e8bdaca39d6b99fa04d51687eb8b2f25', '2/UTS/X/10'),
('fedf2ae960226862f5d97274cce6061d', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'UTS', 'f81ba9bdf3d29c9cb7554bcc71c6c56c', 'e8bdaca39d6b99fa04d51687eb8b2f25', '3/UTS/X/10');

-- --------------------------------------------------------

--
-- Table structure for table `ku_ruang`
--

CREATE TABLE IF NOT EXISTS `ku_ruang` (
  `kd` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_ruang` varchar(50) NOT NULL,
  `jenis` varchar(3) NOT NULL,
  `jumlah` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ku_ruang`
--

INSERT INTO `ku_ruang` (`kd`, `kd_progdi`, `kd_kelas`, `kd_tapel`, `kd_smt`, `kd_ruang`, `jenis`, `jumlah`) VALUES
('42756b63108c4a615697649b47b5b0fd', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'e8bdaca39d6b99fa04d51687eb8b2f25', 'UTS', '1'),
('5be74fc3a56d3d82aab38251076243da', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'fac29fcf7c9029bc39f07c06ed65cc89', 'UTS', '2'),
('246afe22dd1276c4b41f1cce350ec8f9', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'b7e31e733b1c278fe4888757c768488b', 'UTS', '3'),
('83d1505833dfff802c304deb09c66ba4', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'b7e31e733b1c278fe4888757c768488b', 'UTS', '10'),
('e83711b0e375631a13376c6413677324', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'f376a33118bcbebf20f708bb3366da61', 'UTS', ''),
('ff334e4cbccf256c2314c1f128527c90', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'ee79bf595f58f6c1d1ef14fbc35d8424', 'UTS', ''),
('b2fc7b273ad34ade7189f1fc5e2999f9', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '9b961a1be2d7f5e02030537ad4f02ee3', 'UTS', ''),
('e95a91295ec257943cb02d5ed63ce3d2', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'd9ca53883cbf5367b31f35860108152d', 'UTS', ''),
('14ea7a3ff4eaf20ac8c8b27486cd66b7', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'f144be0f0597a452f74fa6362665fd9a', 'UTS', ''),
('bd49ab4dbca061ccd2a1b1654efff23e', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'fa4ec6c6f7c28cddc98a26b73b82a1e0', 'UTS', ''),
('e15ff803d5d7ac4e60ff2fd827fcddaf', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '49362f0c41486efe2eeac6a0f6a85f8c', 'UTS', ''),
('60b61e5a8ec96e2601a73fcf97b72586', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'b550f96e06fd0792c91ddc7e8679262e', 'UTS', ''),
('a0131485f2ac31987cb900e9ea45cda9', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'e8bdaca39d6b99fa04d51687eb8b2f25', 'UTS', ''),
('b5dd256b28c38c296459943bb529a6ba', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'fac29fcf7c9029bc39f07c06ed65cc89', 'UTS', ''),
('1eb89be270d0764761bf244493aa2e3e', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'cfc88cef30aa7951ab7735b863029a54', 'UTS', ''),
('3fcc3347b40bdf8418e51941bc0db4d2', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'cfc14d4692a02141116ceafd07a6c66d', 'UTS', ''),
('529b17aad73e45586624a9bee44285c1', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'acd105d0d91894155e00b67b333aa81d', 'UTS', ''),
('ed5090fb1dd0fb15fa584a6bc3db9c91', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '7363c198f5fb92b376dc5df903d1fa77', 'UTS', ''),
('234bfd3d7491df99c206b27bfa0b652c', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '40d844f45a857a8bf376f3bad4387606', 'UTS', ''),
('c6ac98f6ce7d3236cc2e2e144dbfd505', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '2bbff6289cd9859791bd201e93d9c37e', 'UTS', ''),
('1cb43395b29bcad8434e1b4cf920d648', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'b690f2a0ff679104ffce5e66275df18b', 'UTS', ''),
('69c6aad5e303a7832ea441c7d17af305', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'ca4572bc2eaf6efbb445875b4a82ddf9', 'UTS', ''),
('acf6f8d3f326462d52b2b2172749f394', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'b0f9a03f5e739b196ab02667bda3eb95', 'UTS', ''),
('fb4938bb92aa1115422285baab983c19', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '98a9470b0e6fb8ea5b5b819927dd8b16', 'UTS', ''),
('30c40e94bbd290f8b713e878a2a890f5', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '0ea59e0025e840429cb61f65c20bdc86', 'UTS', ''),
('7eefaa4e0725bb6f37d76ffee27767fa', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '086bb2bb780bbae2951dcf4916b8ea41', 'UTS', ''),
('0387ec4da309875b20e0342948eb9a28', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '85503ea42bf780acc206b9c880b8f709', 'UTS', ''),
('bac538e01ee3ddc147a9a6e3f9d512c0', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '7122a910ed805cf652ec78b01915ae34', 'UTS', ''),
('4cc9da22ea5be1a991f3242eaed309dd', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '8091062ec16642cdf9fb7919c3fcaa53', 'UTS', ''),
('7efd04a233d7aa2d1015c4b0339ee099', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '140fa391368c5caf506ad32805dd12b2', 'UTS', ''),
('c24ac8053f461811f4133035377b01fc', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '4e20642fa8c43c2232a6d92fae16571d', 'UTS', ''),
('dda5fcf2ae5fbf1d78a20dec92ec9f10', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'b7e31e733b1c278fe4888757c768488b', 'UAS', ''),
('852691969d6972593175aef9dd808808', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'f376a33118bcbebf20f708bb3366da61', 'UAS', ''),
('b2c9c93455d8b02ddd6890fa7997574f', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'ee79bf595f58f6c1d1ef14fbc35d8424', 'UAS', ''),
('124a5b4f609544048746e846d8cd3f45', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '9b961a1be2d7f5e02030537ad4f02ee3', 'UAS', ''),
('f21b7c5ff8b89402b707e69c78c831cd', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'd9ca53883cbf5367b31f35860108152d', 'UAS', ''),
('ed2eeb4ec3feb6841347dd1cd4b242f4', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'f144be0f0597a452f74fa6362665fd9a', 'UAS', ''),
('c587bfee6d91cbc0330260ed0bb4da2d', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'fa4ec6c6f7c28cddc98a26b73b82a1e0', 'UAS', ''),
('0f2ec1d8683d83d7ee3af1939f6eb870', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '49362f0c41486efe2eeac6a0f6a85f8c', 'UAS', ''),
('9b55dfe5938e0a96adc39ffc34a13559', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'b550f96e06fd0792c91ddc7e8679262e', 'UAS', ''),
('866ccf96d3b1e1780026f45f4e6e5c75', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'e8bdaca39d6b99fa04d51687eb8b2f25', 'UAS', ''),
('2461f743b38aed6456b01ca3952b1b97', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'fac29fcf7c9029bc39f07c06ed65cc89', 'UAS', ''),
('34f97db113d4b383cf480b81d7710948', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'cfc88cef30aa7951ab7735b863029a54', 'UAS', ''),
('f15472fd68538e8de49562366d44f94f', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'cfc14d4692a02141116ceafd07a6c66d', 'UAS', ''),
('618660e4c899ab96b5a13af3656b106d', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'acd105d0d91894155e00b67b333aa81d', 'UAS', ''),
('a9bd664750e1327ff625fd68c13984e5', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '7363c198f5fb92b376dc5df903d1fa77', 'UAS', ''),
('b55596440103f9344ad445d9b53db1e9', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '40d844f45a857a8bf376f3bad4387606', 'UAS', '40'),
('e64ddab4c08c50d6f99d1e4ff3e1b07c', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '2bbff6289cd9859791bd201e93d9c37e', 'UAS', ''),
('c5c8c0b094b44ae7bf18cde68423ff55', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'b690f2a0ff679104ffce5e66275df18b', 'UAS', ''),
('c83fc11f316f8ee583b1488b17b8133e', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'ca4572bc2eaf6efbb445875b4a82ddf9', 'UAS', ''),
('5fe15a363fb76cf0a97847233879a839', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', 'b0f9a03f5e739b196ab02667bda3eb95', 'UAS', ''),
('9d412d94814ebdf339d2466a985ed111', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '98a9470b0e6fb8ea5b5b819927dd8b16', 'UAS', ''),
('9a14e3c4b53590113b7ad7d1449d0e53', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '0ea59e0025e840429cb61f65c20bdc86', 'UAS', ''),
('2bfb6f5c380472bd278de096f730c371', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '086bb2bb780bbae2951dcf4916b8ea41', 'UAS', ''),
('8589f0f7e9661bc579b127d6dfb51fce', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '85503ea42bf780acc206b9c880b8f709', 'UAS', ''),
('ca46b9232c2276379fd5e77e4042d438', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '7122a910ed805cf652ec78b01915ae34', 'UAS', ''),
('bdd3a9e135011d75ba6ada7f24430f06', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '8091062ec16642cdf9fb7919c3fcaa53', 'UAS', ''),
('0123d0623ab13ba3a0840627912eba5e', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'c81e728d9d4c2f636f067f89cc14862c', '140fa391368c5caf506ad32805dd12b2', 'UAS', '');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_absen`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_absen` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_makul` varchar(50) NOT NULL,
  `pertemuan` varchar(2) NOT NULL,
  `tgl` datetime NOT NULL,
  `kd_absen` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_absen`
--

INSERT INTO `mahasiswa_absen` (`kd`, `kd_mahasiswa_kelas`, `kd_tapel`, `kd_smt`, `kd_makul`, `pertemuan`, `tgl`, `kd_absen`) VALUES
('42bad3dc5c7072c22d05d499dbc3d48d', '329a742aea6a954459d9b799ba348ca0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'eaaf7959eba51755bae350720546a8b4', '1', '2015-08-01 00:00:00', ''),
('699a492e67123f07f80304d0d11f125b', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'eaaf7959eba51755bae350720546a8b4', '1', '2015-08-01 00:00:00', '6875d2e0feb0205e6bc4dd95f59cbc64'),
('857be5122c4278a09de066d4f01d21b2', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'eaaf7959eba51755bae350720546a8b4', '', '0000-00-00 00:00:00', '6875d2e0feb0205e6bc4dd95f59cbc64'),
('284aba262efae0097b5b20546a8ae6a1', '329a742aea6a954459d9b799ba348ca0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'eaaf7959eba51755bae350720546a8b4', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_beasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_beasiswa` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_mhs` varchar(50) NOT NULL,
  `kd_beasiswa` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_beasiswa`
--

INSERT INTO `mahasiswa_beasiswa` (`kd`, `kd_tapel`, `kd_mhs`, `kd_beasiswa`) VALUES
('4949631432bcf30631fec2a5e5b278d5', 'bddff5ad954302e7bcad29460998d7d2', 'f2ad38e73146871cee50050fbf7474a7', '8577380fad80551ce4e7d6d5023bf11f'),
('b33b404f2b13bd77ab311cba0686d865', 'bddff5ad954302e7bcad29460998d7d2', 'f2ad38e73146871cee50050fbf7474a7', 'd2c9874c0d4a04447114a6945f5c9e8b'),
('5680fb7b7785fada9d86263833bc726c', 'bddff5ad954302e7bcad29460998d7d2', 'a0020b731b45760c9e1308a5a9a6993d', '8577380fad80551ce4e7d6d5023bf11f'),
('9376e929ec179d88a189404b0fd0612b', 'bddff5ad954302e7bcad29460998d7d2', 'cbb9ebd1adf31bacd22f25e0933a29ff', '8577380fad80551ce4e7d6d5023bf11f'),
('4949631432bcf30631fec2a5e5b278d5', 'bddff5ad954302e7bcad29460998d7d2', 'f2ad38e73146871cee50050fbf7474a7', '8577380fad80551ce4e7d6d5023bf11f'),
('b33b404f2b13bd77ab311cba0686d865', 'bddff5ad954302e7bcad29460998d7d2', 'f2ad38e73146871cee50050fbf7474a7', 'd2c9874c0d4a04447114a6945f5c9e8b'),
('5680fb7b7785fada9d86263833bc726c', 'bddff5ad954302e7bcad29460998d7d2', 'a0020b731b45760c9e1308a5a9a6993d', '8577380fad80551ce4e7d6d5023bf11f'),
('9376e929ec179d88a189404b0fd0612b', 'bddff5ad954302e7bcad29460998d7d2', 'cbb9ebd1adf31bacd22f25e0933a29ff', '8577380fad80551ce4e7d6d5023bf11f');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_cuti`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_cuti` (
  `kd` varchar(50) NOT NULL,
  `kd_mhs` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `tgl_ambil` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'false',
  `postdate` datetime NOT NULL,
  `ket` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_cuti`
--

INSERT INTO `mahasiswa_cuti` (`kd`, `kd_mhs`, `kd_smt`, `tgl_ambil`, `tgl_akhir`, `status`, `postdate`, `ket`) VALUES
('3c67bb1bb3b3d7d941e35d16602e76c4', '', 'e4da3b7fbbce2345d7772b0674a318d5', '2014-11-01', '2012-11-01', 'true', '2014-11-06 04:14:52', 'karena sakit'),
('4be5ea2fd6a656257a87a3368fd8b512', '6e6d3b1b639dd4e44d7637db82a34d03', 'c4ca4238a0b923820dcc509a6f75849b', '2015-06-01', '2015-06-30', 'true', '2015-06-24 04:51:43', 'Menikah');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_do`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_do` (
  `kd` varchar(50) NOT NULL,
  `kd_mhs` varchar(50) NOT NULL,
  `tgl_do` date NOT NULL,
  `ket` varchar(255) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_do`
--

INSERT INTO `mahasiswa_do` (`kd`, `kd_mhs`, `tgl_do`, `ket`, `postdate`) VALUES
('56d7b10c01e6ce9b87151e8b5e21bf2f', 'be9623a3dda7b936b7c1304cac3512a2', '2015-06-24', 'Black List', '2015-06-24 05:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_kelas`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_kelas` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `kd_jenjang` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_ruang` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `no_absen` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_kelas`
--

INSERT INTO `mahasiswa_kelas` (`kd`, `kd_mahasiswa`, `kd_jenjang`, `kd_progdi`, `kd_kelas`, `kd_tapel`, `kd_ruang`, `kd_smt`, `no_absen`) VALUES
('a84034f44f52fa4b06f090f150d26be0', '1684554d7acf3d87d55ab4663ae0696f', '', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '1aafa578cf4790a11ecac346fc6d5aa4', 'cc3e2f0c461d76425055deef36955645', 'c4ca4238a0b923820dcc509a6f75849b', '01'),
('4ea3d8f0ac88f5805a1fe56e4e3beef3', '879042992679a3cb2c0552a575ae42ff', '', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c81e728d9d4c2f636f067f89cc14862c', '1aafa578cf4790a11ecac346fc6d5aa4', 'cc3e2f0c461d76425055deef36955645', 'c4ca4238a0b923820dcc509a6f75849b', '02'),
('329a742aea6a954459d9b799ba348ca0', '1684554d7acf3d87d55ab4663ae0696f', '', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '1aafa578cf4790a11ecac346fc6d5aa4', 'cc3e2f0c461d76425055deef36955645', 'c4ca4238a0b923820dcc509a6f75849b', ''),
('329a742aea6a954459d9b799ba348ca0', '1684554d7acf3d87d55ab4663ae0696f', '', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '38953f4829616cfe255addac99446969', 'cc3e2f0c461d76425055deef36955645', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', ''),
('329a742aea6a954459d9b799ba348ca0', '1684554d7acf3d87d55ab4663ae0696f', '', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '38953f4829616cfe255addac99446969', 'cc3e2f0c461d76425055deef36955645', 'a87ff679a2f3e71d9181a67b7542122c', ''),
('329a742aea6a954459d9b799ba348ca0', '1684554d7acf3d87d55ab4663ae0696f', '', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'a8735cca073b46b581b5fd39ff93a544', 'cc3e2f0c461d76425055deef36955645', 'e4da3b7fbbce2345d7772b0674a318d5', ''),
('329a742aea6a954459d9b799ba348ca0', '1684554d7acf3d87d55ab4663ae0696f', '', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'a8735cca073b46b581b5fd39ff93a544', 'cc3e2f0c461d76425055deef36955645', '1679091c5a880faf6fb5e6087eb1b2dc', ''),
('329a742aea6a954459d9b799ba348ca0', '1684554d7acf3d87d55ab4663ae0696f', '', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '539e6fc51b8b0e2d3a5581a3faf54703', 'cc3e2f0c461d76425055deef36955645', '8f14e45fceea167a5a36dedd4bea2543', ''),
('329a742aea6a954459d9b799ba348ca0', '1684554d7acf3d87d55ab4663ae0696f', '', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '539e6fc51b8b0e2d3a5581a3faf54703', 'cc3e2f0c461d76425055deef36955645', 'c9f0f895fb98ab9159f51fd0297e236d', '');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_keu`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_keu` (
  `kd` varchar(50) NOT NULL,
  `no_urut` varchar(2) NOT NULL,
  `kd_jenis` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `tgl_bayar` date NOT NULL DEFAULT '0000-00-00',
  `nilai` varchar(10) NOT NULL,
  `postdate` datetime NOT NULL,
  `kd_keu_mahasiswa` varchar(50) NOT NULL,
  `bln` varchar(2) NOT NULL,
  `thn` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_keu`
--

INSERT INTO `mahasiswa_keu` (`kd`, `no_urut`, `kd_jenis`, `kd_progdi`, `kd_kelas`, `kd_tapel`, `kd_smt`, `kd_mahasiswa`, `tgl_bayar`, `nilai`, `postdate`, `kd_keu_mahasiswa`, `bln`, `thn`) VALUES
('d5f699acfb3428a40cee7ecee752e0b5', '', '', '', '', '', '', '', '2015-09-16', '', '2015-09-18 05:02:24', '77965f1c9b8430eefd35740754dbaac6', '1', '2016'),
('46c47c4d3507166bd826ecb482e6ed21', '', '', '', '', '', '', '', '2015-09-16', '', '2015-09-18 05:02:24', '74f5913892a76f437732f76e17a26cd2', '1', '2016');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_kuisioner_dosen`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_kuisioner_dosen` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `kd_kuisioner_dosen` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL,
  `jawaban_1` varchar(100) NOT NULL,
  `jawaban_2` varchar(100) NOT NULL,
  `jawaban_3` varchar(100) NOT NULL,
  `jawaban_4` varchar(100) NOT NULL,
  `jawaban_5` varchar(100) NOT NULL,
  `jawaban_6` varchar(100) NOT NULL,
  `jawaban_7` varchar(100) NOT NULL,
  `jawaban_8` varchar(100) NOT NULL,
  `jawaban_9` varchar(100) NOT NULL,
  `jawaban_10` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_kuisioner_dosen`
--

INSERT INTO `mahasiswa_kuisioner_dosen` (`kd`, `kd_mahasiswa`, `kd_kuisioner_dosen`, `kd_pegawai`, `jawaban_1`, `jawaban_2`, `jawaban_3`, `jawaban_4`, `jawaban_5`, `jawaban_6`, `jawaban_7`, `jawaban_8`, `jawaban_9`, `jawaban_10`, `postdate`) VALUES
('1de926a8895431f96d2eed0796bc332e', '76920d58a78f0e61475f3c3fe7b12735', '3f4454bd31ed79e800baa6ff75c5906a', '586bf5e5ac8ef75e831247d3bf27f31f', 'Baik', 'Baik', 'Baik', 'Baik', 'Amat Baik', 'Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', '2014-03-19 11:11:04'),
('12f070fc87bd501cbfd8cf58503ea583', '76920d58a78f0e61475f3c3fe7b12735', '42f1e7a2e6517d045e8df974ac7ecbf1', '586bf5e5ac8ef75e831247d3bf27f31f', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Cukup', 'Amat Baik', 'Baik', '2014-03-19 11:11:04'),
('7e3a92c9a879207c99ea0a7cb6829f22', '76920d58a78f0e61475f3c3fe7b12735', '1dc027dfc1bdaa836e298941418a6816', '586bf5e5ac8ef75e831247d3bf27f31f', 'Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Baik', 'Amat Baik', 'Amat Baik', '2014-03-19 11:11:04'),
('a671537731ec5a7395994304bce5a574', '76920d58a78f0e61475f3c3fe7b12735', 'acc65bea6cb0c1ec208e91133c953641', '586bf5e5ac8ef75e831247d3bf27f31f', 'Cukup', '', '', '', '', '', '', '', '', '', '2014-03-19 11:11:04'),
('a85358ec2f381bcd742a4b5ed8ee0c56', '2e71fe2720d549b26d6d1b3ef3afc47c', '3f4454bd31ed79e800baa6ff75c5906a', '656ed78e69a85b531258c4e19f0ab059', 'Baik', 'Amat Baik', 'Amat Baik', 'Cukup', 'Baik', 'Amat Baik', 'Amat Baik', 'Baik', 'Amat Baik', 'Baik', '2014-03-19 08:05:16'),
('c728a6c00cb007f49b8d2f3065d7b02a', '2e71fe2720d549b26d6d1b3ef3afc47c', '42f1e7a2e6517d045e8df974ac7ecbf1', '656ed78e69a85b531258c4e19f0ab059', 'Tidak', 'Tidak', 'Cukup', 'Ya', 'Amat Baik', 'Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', 'Amat Baik', '2014-03-19 08:05:16'),
('48635ee97f74da085ad14d8e18cc14d0', '2e71fe2720d549b26d6d1b3ef3afc47c', '1dc027dfc1bdaa836e298941418a6816', '656ed78e69a85b531258c4e19f0ab059', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ya', 'Cukup', 'Amat Baik', 'Baik', 'Baik', '2014-03-19 08:05:16'),
('7993b4fb0e3efed4efe1f4b178f263f5', '2e71fe2720d549b26d6d1b3ef3afc47c', 'acc65bea6cb0c1ec208e91133c953641', '656ed78e69a85b531258c4e19f0ab059', 'Baik', 'Cukup', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Amat Baik', '2014-03-19 08:05:16'),
('12ab0afe0bfc538f3ba6150c9189156b', '2e71fe2720d549b26d6d1b3ef3afc47c', '306d9d450bdefe38c60ad8660b7aad50', '656ed78e69a85b531258c4e19f0ab059', 'Amat Baik', 'Ya', 'Baik', 'Amat Baik', 'Cukup', 'Baik', 'Cukup', 'Baik', 'Baik', 'Baik', '2014-03-19 08:05:16'),
('00a7fd2b52fb8c2ce254f49e1df7e88c', '11d27da8a8b1d4a391e695eb61649fb4', '3f4454bd31ed79e800baa6ff75c5906a', '656ed78e69a85b531258c4e19f0ab059', 'Amat Baik', '', '', '', '', '', '', '', '', '', '2014-09-01 10:13:00'),
('04039b2af9f345fcf2e826211c93bf41', '11d27da8a8b1d4a391e695eb61649fb4', '42f1e7a2e6517d045e8df974ac7ecbf1', '656ed78e69a85b531258c4e19f0ab059', 'Baik', '', '', '', '', '', '', '', '', '', '2014-09-01 10:13:00'),
('2b27230f7a55b3bea51cc20a186ea4ed', '11d27da8a8b1d4a391e695eb61649fb4', '306d9d450bdefe38c60ad8660b7aad50', '656ed78e69a85b531258c4e19f0ab059', 'Amat Baik', '', '', '', '', '', '', '', '', '', '2014-09-01 10:13:00'),
('626b886cc997239e43dd3e3c14a8b949', '11d27da8a8b1d4a391e695eb61649fb4', '1dc027dfc1bdaa836e298941418a6816', '656ed78e69a85b531258c4e19f0ab059', 'Baik', '', '', '', '', '', '', '', '', '', '2014-09-01 10:13:00'),
('aaa58698afa2f5a5276a21d4357d9c80', '11d27da8a8b1d4a391e695eb61649fb4', 'acc65bea6cb0c1ec208e91133c953641', '656ed78e69a85b531258c4e19f0ab059', 'Baik', '', '', '', '', '', '', '', '', '', '2014-09-01 10:13:00'),
('680a9b4d095ef2aa06614ae0ec9953aa', '239e5d2df9da1595a187b6209a1fb2cb', '3f4454bd31ed79e800baa6ff75c5906a', '656ed78e69a85b531258c4e19f0ab059', 'Amat Baik', '', '', '', '', '', '', '', '', '', '2015-06-22 05:59:47'),
('f71d6b0e52f35436281d18b5f5d29b4a', '239e5d2df9da1595a187b6209a1fb2cb', '42f1e7a2e6517d045e8df974ac7ecbf1', '656ed78e69a85b531258c4e19f0ab059', 'Baik', '', '', '', '', '', '', '', '', '', '2015-06-22 05:59:47'),
('6168538ec2f65b34f9d045f9504ae938', '239e5d2df9da1595a187b6209a1fb2cb', '306d9d450bdefe38c60ad8660b7aad50', '656ed78e69a85b531258c4e19f0ab059', 'Baik', '', '', '', '', '', '', '', '', '', '2015-06-22 05:59:47'),
('e9ac3527f0516cb862083a214998ecfd', '239e5d2df9da1595a187b6209a1fb2cb', '1dc027dfc1bdaa836e298941418a6816', '656ed78e69a85b531258c4e19f0ab059', 'Cukup', '', '', '', '', '', '', '', '', '', '2015-06-22 05:59:47'),
('de988e379714597f8ec39c7c018660b1', '239e5d2df9da1595a187b6209a1fb2cb', 'acc65bea6cb0c1ec208e91133c953641', '656ed78e69a85b531258c4e19f0ab059', 'Ya', '', '', '', '', '', '', '', '', '', '2015-06-22 05:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_makul`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_makul` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_makul` varchar(50) NOT NULL,
  `tgl_sah` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_makul`
--

INSERT INTO `mahasiswa_makul` (`kd`, `kd_mahasiswa_kelas`, `kd_tapel`, `kd_smt`, `kd_makul`, `tgl_sah`) VALUES
('e1becb0b4b54d5512f7e87940ec291b7', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'eaaf7959eba51755bae350720546a8b4', '2015-09-09'),
('0455e615936b785a036bd435c8dc3717', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'db8644a7b69b0174a7d7b2016380f505', '2015-09-09'),
('1d821e9ef7a49f1c501ff410da9592b0', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', '8666ed9021eb8164210dc3113787500e', '2015-09-09'),
('f6c77a3f0ffd104638a54327e6857af2', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'f71cda53f8da059d091065b0d39dbd12', '2015-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_nilai`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_nilai` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_makul` varchar(50) NOT NULL,
  `nil_hadir` varchar(3) NOT NULL,
  `nil_tugas` varchar(3) NOT NULL,
  `nil_uts` varchar(3) NOT NULL,
  `nil_uas` varchar(3) NOT NULL,
  `nil_akhir` varchar(5) NOT NULL,
  `nil_akhir_huruf` varchar(1) NOT NULL,
  `subtotal_mutu` varchar(5) NOT NULL,
  `tgl_sah` date NOT NULL,
  `tgl_sah_transkrip` date NOT NULL,
  `nil_sp` varchar(5) NOT NULL,
  `jml_hadir` varchar(5) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_nilai`
--

INSERT INTO `mahasiswa_nilai` (`kd`, `kd_mahasiswa_kelas`, `kd_tapel`, `kd_smt`, `kd_makul`, `nil_hadir`, `nil_tugas`, `nil_uts`, `nil_uas`, `nil_akhir`, `nil_akhir_huruf`, `subtotal_mutu`, `tgl_sah`, `tgl_sah_transkrip`, `nil_sp`, `jml_hadir`, `kd_mahasiswa`, `postdate`) VALUES
('d235ffc9171ab32a3d90ead2dfd50eaa', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'a84034f44f52fa4b06f090f150d26be0', '', '', '', '', '', '', '', '2015-10-28', '2015-08-17', '', '', '1684554d7acf3d87d55ab4663ae0696f', '0000-00-00 00:00:00'),
('a97ea6d2051c824a7977ea64e2a6688c', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'a84034f44f52fa4b06f090f150d26be0', '', '', '', '', '', '', '', '2015-10-28', '2015-08-17', '', '', '1684554d7acf3d87d55ab4663ae0696f', '0000-00-00 00:00:00'),
('08f5766fec3ab7bd3b0da1a4597b9ef2', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'a84034f44f52fa4b06f090f150d26be0', '', '', '', '', '', '', '', '2015-10-28', '2015-08-17', '', '', '1684554d7acf3d87d55ab4663ae0696f', '0000-00-00 00:00:00'),
('26c29774705a1f715b63d8b3a58f12ba', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'a84034f44f52fa4b06f090f150d26be0', '', '', '', '', '', '', '', '2015-10-28', '2015-08-17', '', '', '1684554d7acf3d87d55ab4663ae0696f', '0000-00-00 00:00:00'),
('7c87a908fa39ebb21bc3d1da5ba34667', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'a84034f44f52fa4b06f090f150d26be0', '', '', '', '', '', '', '', '0000-00-00', '2015-08-17', '', '', '1684554d7acf3d87d55ab4663ae0696f', '0000-00-00 00:00:00'),
('8d769b3b1851acf92ae630e8b7821c7b', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'a84034f44f52fa4b06f090f150d26be0', '', '', '', '', '', '', '', '0000-00-00', '2015-08-17', '', '', '1684554d7acf3d87d55ab4663ae0696f', '0000-00-00 00:00:00'),
('87a0d495dac5e01cb971b8cc75d680bb', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'a84034f44f52fa4b06f090f150d26be0', '', '', '', '', '', '', '', '0000-00-00', '2015-08-17', '', '', '1684554d7acf3d87d55ab4663ae0696f', '0000-00-00 00:00:00'),
('f7b9876d6ae678886625b1635bb2a75d', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'a84034f44f52fa4b06f090f150d26be0', '', '', '', '', '', '', '', '0000-00-00', '2015-08-17', '', '', '1684554d7acf3d87d55ab4663ae0696f', '0000-00-00 00:00:00'),
('cb80b248cd8bfa32a1f5671f6f7ff841', 'a84034f44f52fa4b06f090f150d26be0', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'eaaf7959eba51755bae350720546a8b4', '4', '80', '76', '56', '62.27', 'C', '', '0000-00-00', '0000-00-00', '', '4', '', '0000-00-00 00:00:00'),
('cc145868a1ad4bf579d7a4cc42c691c9', '', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'eaaf7959eba51755bae350720546a8b4', '', '', '', '', '0', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_pelanggaran`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_pelanggaran` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `kd_point` varchar(50) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_pelanggaran`
--

INSERT INTO `mahasiswa_pelanggaran` (`kd`, `kd_tapel`, `kd_kelas`, `kd_mahasiswa`, `tgl`, `kd_point`, `postdate`) VALUES
('ff056966c68372182cf9dc5eb3994955', '2a771e8ba89dd288743d4839d61185bc', '3e476d16a1f9cb481b9aec4006847437', '12f827a1d4f90c5f524e62cccd2fb1e4', '2009-08-01', 'c862d9d69ed2c58055b95c32b54e8461', '2012-03-17 10:51:52'),
('788b05e300bae81cf06eed7230c15e52', '2a771e8ba89dd288743d4839d61185bc', '3e476d16a1f9cb481b9aec4006847437', 'f78e58e3d8d18775f418762e9426b43d', '2009-08-01', '87cf5c8c31eebac966631435d41c5992', '2012-03-17 10:52:10'),
('0deaa2ab13c969fa7f1cf1c8c9a7297d', '2a771e8ba89dd288743d4839d61185bc', '3e476d16a1f9cb481b9aec4006847437', '12f827a1d4f90c5f524e62cccd2fb1e4', '2009-08-04', '14f26c35e11b055b3efe0251d26278dc', '2012-08-30 14:21:15'),
('b1bb4270e69cb3b38953e307aff1ae63', 'b455c00b6c6c435ebe47c7f87c470107', '3f9863103fed2252c3335e737d466008', '983fb4513d478da95c90f0d84f460566', '2014-07-01', 'c862d9d69ed2c58055b95c32b54e8461', '2014-06-28 07:45:54'),
('54d366c4e1fa50ff9283fa21f23cdc8f', 'de8ac090ad37465c6ef869b330fbd8ea', 'c4ca4238a0b923820dcc509a6f75849b', '0cb29449aa487a0fa06e64e8514afdaf', '2008-08-01', 'f58b00ad3597ade7da9e7b59507cf33d', '2014-09-26 22:21:28'),
('981f0ee805fe43cdcaf664ed9c9b99a3', 'eb097da23b4aec62d72d985a63ce2807', 'c81e728d9d4c2f636f067f89cc14862c', '1d70990bd1a8d3685c868fe4fb47f2ff', '2015-04-30', '87cf5c8c31eebac966631435d41c5992', '2015-04-30 03:03:41'),
('7b8c4c2b2878e73a757903343108628d', 'eb097da23b4aec62d72d985a63ce2807', 'c4ca4238a0b923820dcc509a6f75849b', '239e5d2df9da1595a187b6209a1fb2cb', '2015-06-16', '24baa7fb9f0d64b3946e6f9a8f9fde48', '2015-06-24 06:24:03'),
('0fdcd04e46764d42469d5f736ad88423', '1aafa578cf4790a11ecac346fc6d5aa4', 'c81e728d9d4c2f636f067f89cc14862c', '879042992679a3cb2c0552a575ae42ff', '2015-07-01', 'c777f22fb3560aa70fdc73aaf667dd7b', '2015-09-17 11:47:44'),
('d12f8948dc5c34972fe3841f94f51a74', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', '1684554d7acf3d87d55ab4663ae0696f', '2015-07-01', '24baa7fb9f0d64b3946e6f9a8f9fde48', '2015-09-18 04:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_sp`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_sp` (
  `kd` varchar(50) NOT NULL,
  `kd_mhs` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `postdate` datetime NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_sp`
--

INSERT INTO `mahasiswa_sp` (`kd`, `kd_mhs`, `tgl`, `postdate`, `kd_tapel`, `ket`) VALUES
('309566383d9ce1a356bc5e8f264b672d', '74cca28d39dbd831423f1dd7ab161b07', '2014-09-27', '2014-09-25 06:57:30', 'ff0fd61808eb81b81f49c5caa6eaf501', 'HRM'),
('b5285368e1a9e8fa208ec2c543f5ebf6', 'be9623a3dda7b936b7c1304cac3512a2', '2015-06-22', '2015-06-22 06:52:10', 'eb097da23b4aec62d72d985a63ce2807', 'BASIC ACCOUNTING I'),
('200db056220159c3ffcdd96365ec0611', '1684554d7acf3d87d55ab4663ae0696f', '2015-09-16', '2015-09-17 10:47:35', '1aafa578cf4790a11ecac346fc6d5aa4', 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_transkrip`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_transkrip` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_makul` varchar(50) NOT NULL,
  `sks` varchar(5) NOT NULL,
  `nil_huruf` varchar(5) NOT NULL,
  `nil_angka` varchar(5) NOT NULL,
  `nil_mutu` varchar(5) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_transkrip`
--

INSERT INTO `mahasiswa_transkrip` (`kd`, `kd_mahasiswa`, `kd_tapel`, `kd_smt`, `kd_makul`, `sks`, `nil_huruf`, `nil_angka`, `nil_mutu`, `postdate`) VALUES
('f7495d96899034c5aaeb9182457c9580', '1684554d7acf3d87d55ab4663ae0696f', '539e6fc51b8b0e2d3a5581a3faf54703', 'c9f0f895fb98ab9159f51fd0297e236d', '', '', 'E', '0', '0', '2015-09-17 10:43:22'),
('ceb282284a8c6e9992757dd95c8d79a1', '1684554d7acf3d87d55ab4663ae0696f', '539e6fc51b8b0e2d3a5581a3faf54703', '8f14e45fceea167a5a36dedd4bea2543', '', '', 'E', '0', '0', '2015-09-17 10:43:22'),
('fa72ff335d56fffaf88b9e6feb7b7562', '1684554d7acf3d87d55ab4663ae0696f', 'a8735cca073b46b581b5fd39ff93a544', 'e4da3b7fbbce2345d7772b0674a318d5', '', '', 'E', '0', '0', '2015-09-17 10:43:22'),
('3f16403f34faf7fa4f85da9803225bdc', '1684554d7acf3d87d55ab4663ae0696f', 'a8735cca073b46b581b5fd39ff93a544', '1679091c5a880faf6fb5e6087eb1b2dc', '', '', 'E', '0', '0', '2015-09-17 10:43:22'),
('e9aead24b9ca3c3dde31ed7e61cdfd72', '1684554d7acf3d87d55ab4663ae0696f', '38953f4829616cfe255addac99446969', 'a87ff679a2f3e71d9181a67b7542122c', '', '', 'E', '0', '0', '2015-09-17 10:43:22'),
('0965583aa0820a4650a440099c0451ac', '1684554d7acf3d87d55ab4663ae0696f', '38953f4829616cfe255addac99446969', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', '', 'E', '0', '0', '2015-09-17 10:43:22'),
('b6ce33abbe42770e3d638027ba2167a3', '1684554d7acf3d87d55ab4663ae0696f', '1aafa578cf4790a11ecac346fc6d5aa4', 'c81e728d9d4c2f636f067f89cc14862c', '8666ed9021eb8164210dc3113787500e', '3', 'E', '0', '0', '2015-09-17 10:43:22'),
('ee0514e685a5b5732a8027f526b615cc', '1684554d7acf3d87d55ab4663ae0696f', '', '', 'eaaf7959eba51755bae350720546a8b4', '2', 'E', '0', '0', '2015-09-17 10:45:42'),
('5a1140fe55dcf7f5c58809adb1ae96ce', '1684554d7acf3d87d55ab4663ae0696f', '1aafa578cf4790a11ecac346fc6d5aa4', 'c81e728d9d4c2f636f067f89cc14862c', 'eaaf7959eba51755bae350720546a8b4', '2', 'E', '0', '0', '2015-09-17 10:43:22'),
('f7b9876d6ae678886625b1635bb2a75d', '1684554d7acf3d87d55ab4663ae0696f', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'f71cda53f8da059d091065b0d39dbd12', '2', 'E', '0', '0', '2015-09-18 04:22:44'),
('8d769b3b1851acf92ae630e8b7821c7b', '1684554d7acf3d87d55ab4663ae0696f', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'db8644a7b69b0174a7d7b2016380f505', '3', 'E', '0', '0', '2015-09-18 04:22:44'),
('87a0d495dac5e01cb971b8cc75d680bb', '1684554d7acf3d87d55ab4663ae0696f', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', '8666ed9021eb8164210dc3113787500e', '2', 'E', '0', '0', '2015-09-18 04:22:44'),
('7c87a908fa39ebb21bc3d1da5ba34667', '1684554d7acf3d87d55ab4663ae0696f', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'eaaf7959eba51755bae350720546a8b4', '2', 'E', '0', '0', '2015-09-18 04:22:44'),
('b0089336ccae812dfe88824b4b0eb634', '1684554d7acf3d87d55ab4663ae0696f', '', '', 'db8644a7b69b0174a7d7b2016380f505', '3', 'E', '0', '0', '2015-09-17 10:45:42'),
('3f94edff41ba53994efc7961c67401d5', '1684554d7acf3d87d55ab4663ae0696f', '', '', '8666ed9021eb8164210dc3113787500e', '3', 'E', '0', '0', '2015-09-17 10:45:42'),
('61c5f71231d12c74b6df5035c8d10cb2', '1684554d7acf3d87d55ab4663ae0696f', '', '', 'f71cda53f8da059d091065b0d39dbd12', '2', 'E', '0', '0', '2015-09-17 10:45:42'),
('13643e43658c98b76b8265d42b782207', '1684554d7acf3d87d55ab4663ae0696f', '', '', '', '', 'E', '0', '0', '2015-09-17 10:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_ukm`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_ukm` (
  `kd` varchar(50) NOT NULL,
  `kd_mhs` varchar(50) NOT NULL,
  `kd_ukm` varchar(50) NOT NULL,
  `predikat` varchar(100) NOT NULL,
  `ket` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_ukm`
--

INSERT INTO `mahasiswa_ukm` (`kd`, `kd_mhs`, `kd_ukm`, `predikat`, `ket`) VALUES
('66697e0773a2112cdeeb73a9541eeaea', 'f2ad38e73146871cee50050fbf7474a7', 'c7bd7663369a1b0651e72409e8ef3cbc', '', ''),
('9851b0b8a2a694f979885d9eac4d05b5', '6569111b4b5cc4548f5cd47d1e332afc', 'a604626739b54ac24103f08ce00a5c95', '', ''),
('4c33871e9ea40f573eb2382f616b0126', '6569111b4b5cc4548f5cd47d1e332afc', '811a8ac2061a6dbd4c5ada81948ac51b', '', ''),
('f66a3589e4a7e2fbb9bf7f72a94e6342', '239e5d2df9da1595a187b6209a1fb2cb', '2d6c3b87e401db085cc52f946573383b', '', ''),
('02a1fda0a93cda26177c036e80a68835', 'bde8bacc8a57e4fda9804e7e65d7e4a9', '495477244b39cc67f3db39bb8c53e2bf', '', ''),
('3949a261633736c8dd023588f32ad012', '1684554d7acf3d87d55ab4663ae0696f', '2d6c3b87e401db085cc52f946573383b', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_absen`
--

CREATE TABLE IF NOT EXISTS `m_absen` (
  `kd` varchar(50) NOT NULL,
  `absen` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_absen`
--

INSERT INTO `m_absen` (`kd`, `absen`) VALUES
('a8b5212607125f660b1146aff4d21bd3', 'S'),
('c6b7c1807c9a990b96c36b569661abb4', 'I'),
('6875d2e0feb0205e6bc4dd95f59cbc64', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `m_agama`
--

CREATE TABLE IF NOT EXISTS `m_agama` (
  `kd` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_agama`
--

INSERT INTO `m_agama` (`kd`, `agama`) VALUES
('0925bdd232a5e30da573fd1ad7a4562d', 'Islam'),
('3e3f59137302de9a2a24b79e41bec80f', 'Kristen'),
('f398e1509cc6940ad3d93a4f1eb820a7', 'Hindu'),
('da7b08ea433a8e9c3c4246b1adc1acd6', 'Budha'),
('2295b727dcd577d01b1a80a3119d6ca5', 'Katholik');

-- --------------------------------------------------------

--
-- Table structure for table `m_bea_siswa`
--

CREATE TABLE IF NOT EXISTS `m_bea_siswa` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_bea_siswa`
--

INSERT INTO `m_bea_siswa` (`kd`, `nama`) VALUES
('8577380fad80551ce4e7d6d5023bf11f', 'BBM'),
('d2c9874c0d4a04447114a6945f5c9e8b', 'PPA'),
('912caebc350d56b9b22223fb082f870e', 'xxx3');

-- --------------------------------------------------------

--
-- Table structure for table `m_bk_point`
--

CREATE TABLE IF NOT EXISTS `m_bk_point` (
  `kd` varchar(50) NOT NULL,
  `kd_jenis` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `point` varchar(5) NOT NULL,
  `sanksi` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_bk_point`
--

INSERT INTO `m_bk_point` (`kd`, `kd_jenis`, `no`, `nama`, `point`, `sanksi`) VALUES
('e3386d9b1f50eb5f534dcebef8710fcc', 'c703757c2fc871636580c565747f6feb', '1', 'Berpakaian tidak sesuai ketentuan', '1', 'xstrix'),
('24baa7fb9f0d64b3946e6f9a8f9fde48', 'bacc02635ae0eecfd4e628c76223da22', '1', 'Terlambat', '1', 'Teguran'),
('753d7ae4bec371c162a2458d05a1bbea', 'bacc02635ae0eecfd4e628c76223da22', '2', 'Tidak Masuk Tanpa Keterangan', '3', 'Teguran'),
('c777f22fb3560aa70fdc73aaf667dd7b', '3a5453239b62960aa07e0128d545527b', '1', 'Provokator', '1', 'Dikeluarkan');

-- --------------------------------------------------------

--
-- Table structure for table `m_bk_point_jenis`
--

CREATE TABLE IF NOT EXISTS `m_bk_point_jenis` (
  `kd` varchar(50) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `no` varchar(2) NOT NULL,
  FULLTEXT KEY `no` (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_bk_point_jenis`
--

INSERT INTO `m_bk_point_jenis` (`kd`, `jenis`, `no`) VALUES
('3a5453239b62960aa07e0128d545527b', 'KELAKUAN', '1'),
('bacc02635ae0eecfd4e628c76223da22', 'KERAJINAN', '2'),
('c703757c2fc871636580c565747f6feb', 'KERAPIAN', '3');

-- --------------------------------------------------------

--
-- Table structure for table `m_dosen`
--

CREATE TABLE IF NOT EXISTS `m_dosen` (
  `kd` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL,
  `postdate` datetime NOT NULL,
  PRIMARY KEY (`kd`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_dosen`
--

INSERT INTO `m_dosen` (`kd`, `kd_progdi`, `kd_pegawai`, `postdate`) VALUES
('028dcea314adf074ed16ed59441abdcc', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c78b863c1fe7094595bec20626d3945f', '2015-09-17 10:19:05'),
('105c670f1f0423196c001be9c540e78a', 'a313b78f7be3efd5f3f9e0d627703ee6', 'd7534b51e3a7ffb82661bb5e5c642339', '2015-09-17 10:19:07'),
('94d5a546aca8a39850c5e86167ca77be', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c95d3fa445297532b33e55fe55c65686', '2015-09-17 10:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `m_forum_mhs`
--

CREATE TABLE IF NOT EXISTS `m_forum_mhs` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_ijazah`
--

CREATE TABLE IF NOT EXISTS `m_ijazah` (
  `kd` varchar(50) NOT NULL,
  `ijazah` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_ijazah`
--

INSERT INTO `m_ijazah` (`kd`, `ijazah`) VALUES
('d0f075e780044c25b5b160924df26a88', 'S1'),
('7b2781f56d855defd5dd9765b0f046e8', 'S2'),
('e4a99484efb3c5d07acf5b2ad2e83ed4', 'S3'),
('00fe41bb8254b9f570a1931abdad0258', 'D3'),
('1f49134680d7901da36634cdb4941032', 'D4'),
('11f8fd55fc52011de9501a0afb479de9', 'D2'),
('99186cbe4114c85ccfbe7f696b4bd8d2', 'D1'),
('3bda1ec71680b77a519ccd7db5676b6d', 'SD'),
('132e4bf775e0441c1aa520a68fb528af', 'SMP'),
('92860d1640e64de4fbea43ff0ad91519', 'SMA'),
('6fad565c2b6958fd07a7d12d112249df', 'SMK');

-- --------------------------------------------------------

--
-- Table structure for table `m_jabatan`
--

CREATE TABLE IF NOT EXISTS `m_jabatan` (
  `kd` varchar(50) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jabatan`
--

INSERT INTO `m_jabatan` (`kd`, `jabatan`) VALUES
('31cf5e0ce1e79b2f640826d1a3a1e4b6', 'Kepala Direktorat Adm. Umum dan Humas xkkurixYayasanxkkurnanx'),
('99c7b241a21d190fb802c3d4a0fe039c', 'Kepala Direktorat Quality Qontrol xkkurixYayasanxkkurnanx'),
('be3aff6e523025812ba6b22012f5139e', 'Staf Sekretariat xkkurixYayasanxkkurnanx'),
('a90a508afe43f015d7a2685a9da9ba0c', 'Staf Direktorat Finance xkkurixYayasanxkkurnanx'),
('d69b05c2d2f439b1647ab55e2af93b5b', 'Staf Direktorat Adm. Umum dan Humas xkkurixYayasanxkkurnanx'),
('02986bafe0941b6c561cab9454a10b32', 'Staf Direktorat Quality Control xkkurixYayasanxkkurnanx'),
('2f7404f7cd81ab8158518001eedf7ba6', 'Ketua xkkurixRumah Zakat dan BMTxkkurnanx'),
('46915e577476d747b0741001e5752f41', 'Kepala Sekretariat xkkurixYayasanxkkurnanx'),
('26e49cb7c4a1ca064056fb476b3f1096', 'Ketua xkkurixYayasanxkkurnanx'),
('5cbbbd57ce4e4c8a5fb46bff76d9f5c4', 'Kepala Direktorat Finance xkkurixYayasanxkkurnanx'),
('b4b13423973453699ca53adff24257d5', 'Ketua xkkurixSTEBIxkkurnanx'),
('7aa54a5388d56833bbae90ba8177701f', 'Pembantu Ketua I xstrix Akademik xkkurixSTEBIxkkurnanx'),
('16a677cc56cae80cd5f083939dd4eb03', 'Pembantu Ketua II xstrix Adm. Umum dan Humas xkkurixSTEBIxkkurnanx'),
('f8cadc62e38fa8bdbcdd32034404aed2', 'Pembantu Ketua III xstrix Kemahasiswaan, Career Center dan Promosi xkkurixSTEBIxkkurnanx'),
('635e04bef9bbfcb749dd1bc45a8e3d02', 'Ka. Bag. Akademik dan Pusat Komputerisasi xkkurixSTEBIxkkurnanx'),
('bd0a389ac929d3476cafd18947bdc1a5', 'Kepala Perpustakaan xkkurixSTEBIxkkurnanx'),
('0b1362e44d8cbc7ca3619ad73151636f', 'Kaprodi xkkurixSTEBIxkkurnanx'),
('a730998ba8ed9f53bd3eb7befb4ac8ea', 'Ka. Bag. Administrasi Umum dan Keuangan xkkurixSTEBIxkkurnanx'),
('0b03578f86bddb988d9107f64bbbdf55', 'Ka. Bag. Umum xkkurixSTEBIxkkurnanx'),
('1b09a80a68c571ce8a422a4c41df6ced', 'Ka. Bag. Kemahasiswaan, Career Center dan Promosi xkkurixSTEBIxkkurnanx'),
('637269b5a2dcea94f9c639a7bddcbc2d', 'Staf Administrasi Akademik xkkurixSTEBIxkkurnanx'),
('95825181b49fcf4208bd280cb380645f', 'Staf Layanan Akademik xkkurixSTEBIxkkurnanx'),
('174f66d81f1d290165afa59b31e04ed1', 'Staf Pusat Komputerisasi xkkurixSTEBIxkkurnanx'),
('bffe0f75a81dad545f76d5daaa6c2992', 'Staf Administrasi Umum dan Keuangan xkkurixSTEBIxkkurnanx'),
('1bfc3e6da04970b99faf7b19821bb492', 'Staf Umum xkkurixSTEBIxkkurnanx'),
('7899445ffb0b0480038a605569abc453', 'Staf Promosi xkkurixSTEBIxkkurnanx'),
('fdfbb84388304e8e4c0ce2bc33f8d91d', 'Staf Kemahasiswaan dan Career Center xkkurixSTEBIxkkurnanx');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenjang`
--

CREATE TABLE IF NOT EXISTS `m_jenjang` (
  `kd` varchar(50) NOT NULL,
  `jenjang` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jenjang`
--

INSERT INTO `m_jenjang` (`kd`, `jenjang`) VALUES
('a6125a9578990b45bf1df5d24cbf59ac', 'D-3'),
('95c422a2f55f91bfb6ff6f1b68949ee0', 'D-1');

-- --------------------------------------------------------

--
-- Table structure for table `m_kelas`
--

CREATE TABLE IF NOT EXISTS `m_kelas` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(1) NOT NULL,
  `kode` varchar(1) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kelas`
--

INSERT INTO `m_kelas` (`kd`, `no`, `kode`, `kelas`) VALUES
('c4ca4238a0b923820dcc509a6f75849b', '1', '', 'Reguler'),
('c81e728d9d4c2f636f067f89cc14862c', '2', 'E', 'Extensi');

-- --------------------------------------------------------

--
-- Table structure for table `m_keu`
--

CREATE TABLE IF NOT EXISTS `m_keu` (
  `kd` varchar(50) NOT NULL,
  `kd_jenis` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `biaya` varchar(10) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_keu`
--

INSERT INTO `m_keu` (`kd`, `kd_jenis`, `kd_kelas`, `kd_tapel`, `kd_progdi`, `kd_smt`, `biaya`, `ket`) VALUES
('bbf5bad5274ed038e1067fbb56267800', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('59b9266aa027350388bfcd78e3ca2640', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '100000', ''),
('d5f8e861f468895247c978027d30fcc3', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '100000', ''),
('179d4bc1ecbebbbe50f4a5b78b3f6f82', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '100000', ''),
('894cdd33c5ab81876d8ebfa607600d9a', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('de1baab24e8d3c9633c93ef8a7e8146e', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '100000', ''),
('909f3996941bc7ed36f1f1bcf0e03b55', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('d17619718b2011696a2a7d5a0a255428', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('687059ce927da41cdf699e2620a37974', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
('a8a8856e0e46b4751017b47975698eb9', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '', ''),
('6cd323c1054177c24a239a3f3c208d94', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('22770f0e6044c38cb2d721865ceeb85d', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('8449c997f9eb7d08cfdd62b4defa5efb', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '850000', ''),
('086788f9ff2df3cf1e4d0b4f2d2d36aa', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('3213599c67e6221387bef2cf0f7af0f7', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('33a79de0be070515ab548078c99927b7', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('06b4f638e74cfc431892c1d61fa53f04', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
('25f9a05b98e3df1a4bdd3ba30dee2fbe', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '', ''),
('f4195253b05d1c7c7c31ccfc9a34772b', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('aa9b9cb57b11e51b9ce2e7383884918f', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('ca0f1956c4f60abfdec649b054a49ef0', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('4e4ca3e5413708e28d542f3636de25a9', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('692dcf3bf2fec6692a0988094a14a72b', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('70c1289b0ade60ab05046aa7ad60d845', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('d853dc87deb5fa738b7f3f2956f6ea92', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '120000', ''),
('cad89bdd79ab2c2a7d8dd00a9fc80c44', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '120000', ''),
('06eb9678ae6e3910de13bd544e6fe7be', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('89fe801d6bce629a872743c21b055088', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('163d3bb52273805688e41c1fd4435bce', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '', ''),
('cf7de967b6d5d1edfce3b62519d6f85c', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('4346cd240ba3c33971d6985d4dc567d1', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('edcfbedca7b7767126da93be730e486e', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('5066918c9ae99d6be1ed6564ef4d396b', 'c9c6af590fd66c486866cd58866bbc03', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '160000', ''),
('621e6768e2583d4dd40e207408b39ce0', '7da779f9751037552aeb0d4315020642', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('4461ea4e600e238f5b3db63b98f3f5c1', 'ed60cc8508a00dd07e7185b33ee70bf8', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '230000', ''),
('6568a1924d1d16c23e854d0ec04dd915', '2db4cdfd8493df145356ad9c2b4c3e46', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '170000', ''),
('2af07650a309fd6213c5aeeb1d2e3ff4', '2db4cdfd8493df145356ad9c2b4c3e46', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '200000', ''),
('8bbe870ec4b552cfdeb8d09cd8744aed', '2db4cdfd8493df145356ad9c2b4c3e46', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('477d875ad3167a13b30e6bb953500ed9', '2db4cdfd8493df145356ad9c2b4c3e46', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('c8e97ed05999d32332c892da1afeaffa', '2db4cdfd8493df145356ad9c2b4c3e46', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '', ''),
('8b67fc92ee7e0f9388b9afe939a30d8d', '2db4cdfd8493df145356ad9c2b4c3e46', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('25e6afa22e1568326b0d59fa219de27f', '2db4cdfd8493df145356ad9c2b4c3e46', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('1a0e402aba129b6c632f58594d22757d', '2db4cdfd8493df145356ad9c2b4c3e46', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('03044b8efa5d96e46cb2f1fe467f1e50', '6087bfa96f72a81f4e9992a1564c7d53', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '400000', ''),
('378aafcdce54547d9ec891f5817391a7', 'b7456a463a7b0c1c9a3ece4b30c6db4a', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '50000', ''),
('e22245de80ab6c0a0a8f8d7f25867242', 'b7456a463a7b0c1c9a3ece4b30c6db4a', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '50000', ''),
('7bd39685c3198ff9b3a79a5dcbe88b48', 'b7456a463a7b0c1c9a3ece4b30c6db4a', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('c6936fbd27202936a3ab7dd115edbb5f', 'b7456a463a7b0c1c9a3ece4b30c6db4a', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('1e97b1f9f2820de178ca504c9d79d856', 'b7456a463a7b0c1c9a3ece4b30c6db4a', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '', ''),
('0fab1a6e05e30a466787115c678ee40e', 'b7456a463a7b0c1c9a3ece4b30c6db4a', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('12662689793210db75ba10202d325fb4', 'b7456a463a7b0c1c9a3ece4b30c6db4a', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('95c38319ab7db24c95f045336e1b2e5f', 'b7456a463a7b0c1c9a3ece4b30c6db4a', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('e31cbbd46f3a75b5e022190164548a6b', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '1500000', ''),
('606ca1c2ef37e78293bcb18125394b42', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '1500000', ''),
('d576e22adfdd2a42c4809c99433cb7ab', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '1500000', ''),
('cb2fa20cb59efda190069c9f7387ac76', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '1500000', ''),
('d9691579f24fc3fdce9892f95527f54f', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '1500000', ''),
('9e6a311cc3e4ef123abf392ebff1965d', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '1500000', ''),
('3421dc3e9c19d2ecbc8408c18e063c87', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('9ef44ac1ec97881977a797964ca936f6', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('3930b6b04d51420bfa17557c5ca06f60', '188e44a281e3cae553347b6d6402c593', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '600000', ''),
('36d4ba7f70a46df420f2a76a5649dc92', 'ef554032f6512b2be886123df22b93d5', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '130000', ''),
('859776c95d13b3edfa8fe7d3ffe8f393', 'ef554032f6512b2be886123df22b93d5', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '130000', ''),
('a133ecff170fd173f786f90075d6b779', 'ef554032f6512b2be886123df22b93d5', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('5b0bf541845f93456ddff12b708cbf5f', 'ef554032f6512b2be886123df22b93d5', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('ff88ebfa2b4acefbabd33441454e49fe', 'ef554032f6512b2be886123df22b93d5', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '', ''),
('817274bdf758418141ddd7c98b03de3c', 'ef554032f6512b2be886123df22b93d5', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('351763e696eff19e6a37552ee7179e10', 'ef554032f6512b2be886123df22b93d5', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('67fe29428b714c8d2e8f9f766e72c3e1', 'ef554032f6512b2be886123df22b93d5', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('d1b3e1e17cfca0dc768add7504a9a86c', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '170000', ''),
('510155147dac38cab928c63c37607ec7', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '170000', ''),
('8215f4c94b3daeaabd680afa96669ff3', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('5f5089e6284ef10da9331298e7bf244b', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('4eef2d5c027cc92e0c4b0ebdf3f99386', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '', ''),
('683409122a8bb38b96d59dac96d35219', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('09e99b956c173b75538ba2cad4d630b3', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('68a1573d8c32e547d134b88841942748', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('fbc84ac280c59b2f391c35935caf9bf1', 'c81e728d9d4c2f636f067f89cc14862c', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '230000', ''),
('1a0a8660c1ab6c402f30142963dc105b', 'c81e728d9d4c2f636f067f89cc14862c', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '250000', ''),
('f01b00102132e0534955d36340cbba4f', 'c81e728d9d4c2f636f067f89cc14862c', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('ffc5032de606762bda4e2e4bb0f430fc', 'c81e728d9d4c2f636f067f89cc14862c', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('087bb2f90a1d9f51d8c552b9e8577ac8', 'c81e728d9d4c2f636f067f89cc14862c', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '', ''),
('b327ace65219932a565b9c4db603b8c0', 'c81e728d9d4c2f636f067f89cc14862c', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('1068a11a9899da8ef16c1938568d037b', 'c81e728d9d4c2f636f067f89cc14862c', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('e38718c6212f89d30380a36509efc042', 'c81e728d9d4c2f636f067f89cc14862c', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('d675f7e4e903e8c0126160d5d334df33', 'b537f9f36e19e3cd108e53fd646cdcac', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '700000', ''),
('10e83868e2f917fbb32140e91a06ba87', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '200000', ''),
('52383af4212e835782e63768bdced014', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '7619ed9df8e6e190c2c758ab3cf71211', 'c81e728d9d4c2f636f067f89cc14862c', '200000', ''),
('b411e9d06952ff26af4f4b4bd3ba0aaa', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '7619ed9df8e6e190c2c758ab3cf71211', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '200000', ''),
('a73a68364f32cce63a4d823bcc184e28', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '7619ed9df8e6e190c2c758ab3cf71211', 'a87ff679a2f3e71d9181a67b7542122c', '200000', ''),
('e41acd5a21ee042dccb528f9de8fe304', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '7619ed9df8e6e190c2c758ab3cf71211', 'e4da3b7fbbce2345d7772b0674a318d5', '200000', ''),
('d78a736232a8cb775ec9fd5bf34a6fa0', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '7619ed9df8e6e190c2c758ab3cf71211', '1679091c5a880faf6fb5e6087eb1b2dc', '200000', ''),
('8e8a14787296a31eddf987ba8ca59dfe', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '7619ed9df8e6e190c2c758ab3cf71211', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('636f182fbdb9bed632294a9c8b43f941', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', '7619ed9df8e6e190c2c758ab3cf71211', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('a8b78a1c1b5c57e3fad8c1a876ddfe14', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('7e1a33c43fe2d2e5a4c17911683fae5f', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '100000', ''),
('9eb560d042d2a91095f7723bb59a5990', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '100000', ''),
('a6bdd4ca28a26700dfedd2d996d3f05e', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '100000', ''),
('b4e334e91a4d14673ba69d282f081d9a', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('a8d10c29b1a1dd0e8931e1eb6b376044', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '100000', ''),
('8c3032095e36e01312684a6ffa00a200', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('f44c6fc941c7967d8dce90ae2f2c1885', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('5168d26b5f1d425d9254b0b4d379c690', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', 'fe4dc25837042c1e954c07565e11d69d', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('d008143378b8a790e5ad0734c8b189ff', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', 'fe4dc25837042c1e954c07565e11d69d', 'c81e728d9d4c2f636f067f89cc14862c', '100000', ''),
('523d27d15915a9c2192cc7320a492138', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', 'fe4dc25837042c1e954c07565e11d69d', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '100000', ''),
('bcb9291a0adee2354edea02a6b45c773', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', 'fe4dc25837042c1e954c07565e11d69d', 'a87ff679a2f3e71d9181a67b7542122c', '100000', ''),
('d4a33e503b80a7002ef090aa65223db0', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', 'fe4dc25837042c1e954c07565e11d69d', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('ad2d81d4367dcbfc921d8b0f2c824274', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', 'fe4dc25837042c1e954c07565e11d69d', '1679091c5a880faf6fb5e6087eb1b2dc', '100000', ''),
('e12e37f9bad7f81c86fca4262c615bbb', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', 'fe4dc25837042c1e954c07565e11d69d', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('7828e25f683b356c6e8723c19ea00aeb', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', 'fe4dc25837042c1e954c07565e11d69d', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('000b61ef563ef879dd80369f151140b6', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'fe4dc25837042c1e954c07565e11d69d', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('a4108cace500386e6f588d8f2cf52b1a', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'fe4dc25837042c1e954c07565e11d69d', 'c81e728d9d4c2f636f067f89cc14862c', '100000', ''),
('feb73a05f1fd325042475ed7eb9ad72e', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'fe4dc25837042c1e954c07565e11d69d', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '100000', ''),
('ef5b1b5bd5b03e5dc013f34d94a5e012', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'fe4dc25837042c1e954c07565e11d69d', 'a87ff679a2f3e71d9181a67b7542122c', '100000', ''),
('399b916bf6bd9e93abf0e5cc997759a3', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'fe4dc25837042c1e954c07565e11d69d', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('77fa6ccef0384c024f8469ac0e0484d1', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'fe4dc25837042c1e954c07565e11d69d', '1679091c5a880faf6fb5e6087eb1b2dc', '100000', ''),
('11522cf0b279e02a3a8e630d0aaf3671', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'fe4dc25837042c1e954c07565e11d69d', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('879bb84d0ac5d205dfc47fa735196600', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'bddff5ad954302e7bcad29460998d7d2', 'fe4dc25837042c1e954c07565e11d69d', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('da506b5a7887fa72000599975f47e316', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'fe4dc25837042c1e954c07565e11d69d', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('19f46f49b4eeca4077f171cbd631a030', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'fe4dc25837042c1e954c07565e11d69d', 'c81e728d9d4c2f636f067f89cc14862c', '100000', ''),
('b78469cf60ea800db2119a790bbdc0d4', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'fe4dc25837042c1e954c07565e11d69d', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '100000', ''),
('daaef812fb9a2c38b328afe31953225b', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'fe4dc25837042c1e954c07565e11d69d', 'a87ff679a2f3e71d9181a67b7542122c', '100000', ''),
('a6501a5f93f18059e954e2802749f1e2', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'fe4dc25837042c1e954c07565e11d69d', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('a31d954dc3c36d08eedc511d1395a7f3', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'fe4dc25837042c1e954c07565e11d69d', '1679091c5a880faf6fb5e6087eb1b2dc', '100000', ''),
('7b6fd29927f38c6b34b33e8f3c3297f4', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'fe4dc25837042c1e954c07565e11d69d', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('85686a25375d49565f8b4dfd12e4f63c', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'fe4dc25837042c1e954c07565e11d69d', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('c8a1db70c598556244e0e668763a185a', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', 'fe4dc25837042c1e954c07565e11d69d', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('5676146185b86d7c4928b0c7d419ef0a', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', 'fe4dc25837042c1e954c07565e11d69d', 'c81e728d9d4c2f636f067f89cc14862c', '100000', ''),
('02b7a8fa3eddc6a9e1dccbe366620059', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', 'fe4dc25837042c1e954c07565e11d69d', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '100000', ''),
('265c97d44057f4c92a96f4d020eafc5c', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', 'fe4dc25837042c1e954c07565e11d69d', 'a87ff679a2f3e71d9181a67b7542122c', '100000', ''),
('90f693c44366348cc49e58090231704f', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', 'fe4dc25837042c1e954c07565e11d69d', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('74c8608ae38e7b1f40c1f16b1d5bc94e', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', 'fe4dc25837042c1e954c07565e11d69d', '1679091c5a880faf6fb5e6087eb1b2dc', '100000', ''),
('f9942fc73655b0251de74e4cb873dca0', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', 'fe4dc25837042c1e954c07565e11d69d', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('289d7d887bb77aaf356e823d22b8de9b', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', 'fe4dc25837042c1e954c07565e11d69d', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('cb2b3a2006674472d49eaaa7d28450cf', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'fe4dc25837042c1e954c07565e11d69d', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('f11a42457ba6e6e41c2e9a3e1809a3a2', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'fe4dc25837042c1e954c07565e11d69d', 'c81e728d9d4c2f636f067f89cc14862c', '100000', ''),
('e4c4c7645a24a3d88d84a3797b10fdde', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'fe4dc25837042c1e954c07565e11d69d', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '100000', ''),
('db93de67f7bd4b5feb7d147550e6a44d', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'fe4dc25837042c1e954c07565e11d69d', 'a87ff679a2f3e71d9181a67b7542122c', '100000', ''),
('7084c3baab253783476de3463ac0bf22', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'fe4dc25837042c1e954c07565e11d69d', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('517c55c983eea19ed663ca8ec63397a8', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'fe4dc25837042c1e954c07565e11d69d', '1679091c5a880faf6fb5e6087eb1b2dc', '100000', ''),
('2140079feb1516f08b436d2665381001', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'fe4dc25837042c1e954c07565e11d69d', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('1687c48c76a7a0bc2e6b12dd78e727bc', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', 'fe4dc25837042c1e954c07565e11d69d', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('19eb9795c2bdc4ac58d0be87b269b3d1', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('45ba037510721c23b6974add496ef11f', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '100000', ''),
('d36429c10f90086438dfb34447bf5a98', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '100000', ''),
('b75d14252c00ea3255757782ba04c7b6', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '100000', ''),
('4cb4064f5064685486774a75b1c73f8c', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('8c715d6c1d90ff9964e3a556ba960e8d', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '100000', ''),
('4278b39b95f8c7f73c55a58565c3ab76', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('a8bbfcc8c5954067572502ecb711eac9', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('17cb20575c1f61bbc6a272c9e4ffe632', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('550457f08077ff1be46cefcc16da2ac1', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '100000', ''),
('2a7aff1a1a5fa2756bf70a5651e6d6f6', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '100000', ''),
('34fd333c9f1bfb3e5c0fe7c83ddd0d7c', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '100000', ''),
('5ccac82905a42e325a8ab44cc35a7ce5', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('c8968a61f8c32f982decbfad63cd1cb3', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '100000', ''),
('fc3f5212d4d2bc3a740b9d10879bcf93', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('fd9200a3426dea70032f86d3e61dd8e8', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('f840a97565134e4dfe38b56045c3a89d', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('2004f2906da32372b11abfc912476bcf', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '100000', ''),
('e99f027262833a1539fa583ab5a4d09e', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '100000', ''),
('8f27992d406dbbc7adbd21bcd74096fb', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '100000', ''),
('bd45e6ad2cc96c3dbd2ba5e3c7f145e9', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('0b3be0e5e5ebe09249c977e4524a876e', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '100000', ''),
('af1f6b5a2718d51e10c63f645bb3a17a', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('6c4b276d3e9cdb59095c549bb7f8af76', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('c1dc9c9f278f72f72817ff917f80d29c', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
('e3d1eb7acd80d958e8c327477346fb61', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '', ''),
('844375d2331a18ebbd41e492735cc24c', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('83c0c9137046ea35a4684eaf4d4c1e5b', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('da804d0bfc34b935bf0d67c3cdef5d01', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('aaceff34936c6f362f13b1689c7629a5', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('ee821c62162b229f32db75381c7bf799', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('23213f2005aa48335c0f2027d0c61102', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('b21aaef1e2695e456d6d5a514a9e040c', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
('52614597f868c15406086a80e34fc014', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '', ''),
('b6335f0045baa4414d88fd804dc7d746', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('8b5752a6e29321184d3dc32d8c9236f0', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('540422e76059882d222fb4fdb8a5f05b', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('df67b9f93d6b0bfcb2a30c5e85605f94', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('03d7c8ddd5b5a150fc5249c3ba94c448', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('8f121b7f33c740ae45a804f2e9dc26d4', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('50a1f9882ea9bac9d81554a96c4b250e', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
('dd3572c6223c6f8d00d938a9266e0b18', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '', ''),
('f6dc44de6dbee7e7764bd854efa9dabf', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('bee08787c217190beea7b0d7f4862c53', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('9c8aa0d596bca1bbefa1318d30fbbd9a', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('3c8b3f97916dc82bb3147923e241e161', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('c7ba4ec1c66027aea33c11d05b56a96a', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('69e26cecd4aa2241b629054f645bc24b', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('e6bbf2b30245154c9f5218d342bae999', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
('dce357ec366c8a98f7d1d60fff929414', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '', ''),
('da66dfad82a3a9e2e91f9bf717ba76ef', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('f327435a072eabacd8143baf7d1b2041', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('5c2e04968d168877a7ecf5686e4aeda2', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('9be562a2e1165d3454bfb5fc2dff9329', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('52500d603e3c95cb4e0a7a3bb51355f8', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('0d0549ae680840dc775f1e204edc394e', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c4ca4238a0b923820dcc509a6f75849b', 'ff0fd61808eb81b81f49c5caa6eaf501', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('bdb375d8101232376e66838e0300588f', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
('4ef71a3d836243c46fbccc7215143796', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '', ''),
('3b812509db621d4c056a3d32254a0ef3', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('e3c080058170b48f70ddefa0e80efd7c', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('f2bce64115ed293e941f36280c32d6bc', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('dfa0cd160cfb86b28d3ab34344b5d349', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('767e43bf3d94d37fca52fc7e8a8d884d', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('549738308354ab38323b5a7174217e92', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('fcd6bfca58ec880f798c98ef918b3cea', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
('c85f1a8146b3a3e8310aacebf30ebcd6', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '', ''),
('9b3dbe5cdfacab3b20a8670adcc9c514', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('de9af10786d836bc2df563cefc9bc833', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('debe2669ef7adb9f408edb3d6d2634b6', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('0939cbcc73488a200dbbccaf9efd14bf', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('b4508191bf953162e875186a3b918306', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('17e5fc7c198fa71656b21f1290aaa710', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('80047f60b224ca2b1be43a7da1d7b9cb', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
('efb8c0510133a51efd7333891a5dde89', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '', ''),
('9411c1e7a82b11b0f8f98957bafa2817', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('6dd0177f0b101ae25da612b1d317665b', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('67100fb56f546e3f47d525271c58829f', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '100000', ''),
('3921e0bb2fe42c49c246aaf7cfd56f11', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', '');
INSERT INTO `m_keu` (`kd`, `kd_jenis`, `kd_kelas`, `kd_tapel`, `kd_progdi`, `kd_smt`, `biaya`, `ket`) VALUES
('ce0ca5daa854bac5d774ef557b8083a8', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('de7ad4281eca7c9d2f742fcf7594d4d0', 'ec5532c37f0cb97ed3b7f74ff227dae6', 'c81e728d9d4c2f636f067f89cc14862c', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('a597d9542ad00ac12a25e96cfc45ae29', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
('2a038e20840f3a6f01ee18ab9dba1b97', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '', ''),
('35eecf78b241d38ae05dcb8618c5c880', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '', ''),
('fbb52e41a7cab25c19b403d1a16fbb65', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '', ''),
('dafdca8317a1f8746cf0a766d6cadf4b', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '750000', ''),
('c54700b9f94d7827062759318d8e1313', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '', ''),
('a007617214c0b43f67080f88600b7793', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('9017d2ab0a3b13831e011b6e6c7a7ff4', '4d1c2f82a73ce44e92db9c213f647a4b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('5dddca54a8634a7775d677664dde770c', 'c9c6af590fd66c486866cd58866bbc03', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('2a57a68678127c92342a0fb3ec4960e9', 'c9c6af590fd66c486866cd58866bbc03', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('8a975921f76b58b81b18ca2646b5205a', 'c9c6af590fd66c486866cd58866bbc03', 'c4ca4238a0b923820dcc509a6f75849b', '6991e9af2a0ee6ba8b4436f3048af9b0', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '100000', ''),
('4eca97dc4e137c0f5aa81f40f4fe08c8', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '1200000', ''),
('2e72867cced8b31dca753b8ac8fdf63c', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '1200000', ''),
('b34cad24e946b24a94dd811b53428cea', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '1200000', ''),
('bef6856961964607014cd4513ed84468', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '1200000', ''),
('aa75a378bf26b72ae23af474bbc090a2', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '1200000', ''),
('28041f23f9cb97887ff649fc3ea1de7c', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '1200000', ''),
('89a7d2c34ec62c95f989dec12b36a719', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('d21008299027a21a966de3d98ca44f3e', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('1b99a0ae1878dcd1e7a1ac75df59a922', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '1500000', ''),
('3d4419bdc786ca921ab3bc976d16c0e0', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '1500000', ''),
('fec35b681fcb8420108ab8921bc0442b', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '1500000', ''),
('ffe32197634996b863d511fc7057d1a3', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '1500000', ''),
('f785f190722b5991ac8928d2ef5fdc6c', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '1500000', ''),
('95604fdbe1f9ec9570dae1ae15306deb', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '1500000', ''),
('8a09e498a0ace7aa6a4493d3424c2822', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('41acfc23c7df760beeeef492d5caf49e', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('75fa936d1978d1d91772bf6f680a20c7', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '2100000', ''),
('27af2bb030cea28ce37fc8ce799a8243', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '2100000', ''),
('c28af97a3c6c6db484b3326f9ce575e8', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '2100000', ''),
('1682ae782c14ee7096f5ebc4a843a61f', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '2100000', ''),
('601dfa7c4b0ef1052680df203be53d2d', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '2100000', ''),
('ced219cb1b544a03a7ab8866f050a13f', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '2100000', ''),
('fb587279d6ebf454632a7e0adf987aab', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('201561a5d6dea547f61ce74d72056c54', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('f4e9739738c502aac1478304a46b292c', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '2100000', ''),
('ff5a8dbb08f9d6c6e9621002cc7d6174', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '2100000', ''),
('e04f1fffecd66c166957d322131b09e3', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '2100000', ''),
('c8978cfd9173026aec9ce474a50d1716', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '2100000', ''),
('c69e75822535136ee7a059de59c1d735', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '2100000', ''),
('573681c1cdfb034853e8883800cff750', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '2100000', ''),
('ca71279a99e2120236ecf17d03a5ea19', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('661a0dc1b86c299acc1866a360c8b808', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('71c60b1bcc25d4dbe5fe030595501fe4', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '1500000', ''),
('60f0d4aabd921196ace0dfbda07cda56', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '1500000', ''),
('c87dae08f575bc80d9bfd187af133ba2', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '1500000', ''),
('11f5a818766c8028e5b6e4402b1861ec', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '1500000', ''),
('57d0572ee2a5aef3d39014d3b2d57e12', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '1500000', ''),
('d7e55a644d8a0c0661cca52b093802a9', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '1500000', ''),
('31aac32c10f0b695cf8f7670eaff9cc3', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('4dc5a568ad2fff69995bed7dfd7b19c1', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('8836a4b1455251a6bfb3ff57ce63949e', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '2100000', ''),
('b9c7efb0e52fad519e690b83ec2586fb', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c81e728d9d4c2f636f067f89cc14862c', '2100000', ''),
('44976944d8cd7d0feb2a731e5418c707', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '2100000', ''),
('55f747801036540e44142fa455f4ea25', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'a87ff679a2f3e71d9181a67b7542122c', '2100000', ''),
('44f319effee651e2761b7f64dbe88e70', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'e4da3b7fbbce2345d7772b0674a318d5', '2100000', ''),
('309b6d79ced9d76c65995e512a301da2', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', '1679091c5a880faf6fb5e6087eb1b2dc', '2100000', ''),
('110eeee70918f01c16f041f5c0e8500d', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', '8f14e45fceea167a5a36dedd4bea2543', '', ''),
('fa4b753fc84b2b7c91c028493fee0dc2', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '451b0c8b0e27e066606115541c25af08', 'c9f0f895fb98ab9159f51fd0297e236d', '', ''),
('98ffa5451f5eca064ca5d0c27ed16e6b', '6087bfa96f72a81f4e9992a1564c7d53', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '200000', ''),
('be0e51edffe4a1f826b91ffe8e0c1a7f', '6087bfa96f72a81f4e9992a1564c7d53', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '310000', ''),
('e1bf98948a5a8dc9b5611a63f0e3ea5c', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('649e13c02d82e69a6bad512a8d9b3a48', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('e6398653b958a5f08f639e14374f490b', '7410c28e138fa5bd467a624c854ae90b', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('21c4df56907d6855e21283cd229f7cd2', 'c9c6af590fd66c486866cd58866bbc03', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('e6b1d28868cc669827ba4bd5ff890042', 'ab6aa3c5c435d406ab6de96aad89e0c3', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('2b6b1fadcdc51428c3986c767b7e3d30', '6087bfa96f72a81f4e9992a1564c7d53', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('07ad898f71976b5edc27070b418f53f6', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('900093d5dabe2e1cc87a6ab46877ffb2', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '500000', ''),
('fc747b8b06438176e5c466567309f054', '188e44a281e3cae553347b6d6402c593', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('95484fac10427fa003854868dee4eaed', 'b537f9f36e19e3cd108e53fd646cdcac', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '1500000', ''),
('488437a2c20af3f5333e8ec57a729a3c', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '', ''),
('7f9aada31eb955b49062040392b61712', '7410c28e138fa5bd467a624c854ae90b', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '40000', ''),
('c77bed3105e8e1a0d1381eded1163631', 'c9c6af590fd66c486866cd58866bbc03', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '500000', ''),
('e092ccba23a23525a2c7a0087125ede1', 'ab6aa3c5c435d406ab6de96aad89e0c3', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '125000', ''),
('1893767c5d8562f52cc2732d7be45d9b', '6087bfa96f72a81f4e9992a1564c7d53', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '', ''),
('fc35cb6a6fbcdb5f73df11a045d4123f', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '150000', ''),
('edab27381bc9811d29bd9586ca489e1f', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '300000', ''),
('03680b6d24b71a549f694841e420dd5f', '188e44a281e3cae553347b6d6402c593', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '150000', ''),
('7f1af156036474300695ac388a38ce51', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '60000', ''),
('8f0b28a7c27900af97a8050927691635', 'b537f9f36e19e3cd108e53fd646cdcac', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '2000000', ''),
('72c752ac261ff307356624b9610ffec8', '754da442156e1920736d8711d48ca28a', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '50000', ''),
('c8fb8827f79ae6dcc69f5257e7a02a70', 'e164458a8f1e651cbf62858b284c6eb9', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('f9320400bb5c535874a48e27e8e43893', '7410c28e138fa5bd467a624c854ae90b', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('280a3f5d111f3dd5b65f1c1558958ef0', 'c9c6af590fd66c486866cd58866bbc03', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('7a02c3f817cac4eb4d09cb3cd43b6b23', 'ab6aa3c5c435d406ab6de96aad89e0c3', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('d9126dc019f9d6d97f3b1c56cfede5ba', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('2d7b2ec55da9988abb6d177398d4c441', 'c4ca4238a0b923820dcc509a6f75849b', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', '', '300000', ''),
('249749a711bdd9889bf1110d58f9db1b', '188e44a281e3cae553347b6d6402c593', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('aeebf929fdc8f2ec508ff30029ce21e2', '754da442156e1920736d8711d48ca28a', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('0953f173a21d3bd659b13672d844cbec', 'b814b1983879554b8da8ca3881b99f37', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('2f109272c547b8cd81ca6ca3c074b54e', 'b537f9f36e19e3cd108e53fd646cdcac', 'c81e728d9d4c2f636f067f89cc14862c', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('f0b3cafc164412d015fd61709163747f', 'e164458a8f1e651cbf62858b284c6eb9', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '', ''),
('33e7ade3c18ff5f27385cc9614c58ebb', '7410c28e138fa5bd467a624c854ae90b', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '50000', ''),
('566e7cbe65081f6c06ab353026ec1e60', 'c9c6af590fd66c486866cd58866bbc03', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '3500000', ''),
('c5cecad75f0618926357832187db0786', 'ab6aa3c5c435d406ab6de96aad89e0c3', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '1250000', ''),
('1492a1fa44414fe350c38bf56cef7594', '8fb59d1027e024325bdc4aee1fbcd9a3', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '150000', ''),
('538c7cf896bf2a8facd46db94f64fa1d', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '450000', ''),
('30a6c998fd453f8c71b8ec28b5d83aa0', '188e44a281e3cae553347b6d6402c593', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '150000', ''),
('725acdcf606552ccb11a03dbdc641c3f', '754da442156e1920736d8711d48ca28a', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '50000', ''),
('4acf3de5e63d1cae957e6eef80bb85f4', 'b814b1983879554b8da8ca3881b99f37', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '60000', ''),
('a649bce41122bb0bbfd95b040b292881', 'b537f9f36e19e3cd108e53fd646cdcac', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '2000000', ''),
('8e509b577a9fdba0969e4be07ad73b6a', '754da442156e1920736d8711d48ca28a', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '', ''),
('2675d5a95376f80babd1eddc36dc77f7', '5bd8c233aed3cb0a8e5862c4cdc292bc', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', '', '10000', ''),
('f9e48e23c8febbe71bbe16781181872f', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '1aafa578cf4790a11ecac346fc6d5aa4', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '300000', ''),
('9738340142d05da744638eb58d3e2a42', '5bd8c233aed3cb0a8e5862c4cdc292bc', 'c4ca4238a0b923820dcc509a6f75849b', '1aafa578cf4790a11ecac346fc6d5aa4', 'a313b78f7be3efd5f3f9e0d627703ee6', '', '500000', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_keu_jenis`
--

CREATE TABLE IF NOT EXISTS `m_keu_jenis` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `pmb` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_keu_jenis`
--

INSERT INTO `m_keu_jenis` (`kd`, `nama`, `pmb`) VALUES
('c4ca4238a0b923820dcc509a6f75849b', 'SPP', 'false'),
('5bd8c233aed3cb0a8e5862c4cdc292bc', 'UKM', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `m_keu_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `m_keu_mahasiswa` (
  `kd` varchar(50) NOT NULL,
  `kd_jenis` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_keu_mahasiswa`
--

INSERT INTO `m_keu_mahasiswa` (`kd`, `kd_jenis`, `kd_progdi`, `kd_kelas`, `kd_tapel`, `kd_mahasiswa`, `nilai`, `postdate`) VALUES
('648b70fe62087a5d87616125c39f9766', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '9d73916f129ed10659cb1ad552770a90', '300000', '2014-09-21 04:44:38'),
('44319032ec8045ed50103d87a3b52e28', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '0fcf2d9cbc9cf7d957d02c692d7bfef8', '300000', '2014-09-21 04:44:38'),
('de03c7ee67d0c2462eae6835aefa7ef2', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'fc49b75e86b8f302fee30bbe2b7bf779', '450000', '2014-09-21 04:44:38'),
('67b38b2bfbfa6380f4ccfa1c9c155edf', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '848e5ee68a150a9d454fa1902e94052e', '450000', '2014-09-21 04:44:38'),
('71f333178ffa6df12caff83dc985d086', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '879cd598ccc6b4329f4140d89caf1277', '450000', '2014-09-21 04:44:38'),
('8a6d46b438ec8d3aebf8d5b297fc4a78', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '89f2f2e2d73c55c439f78d32850a046e', '450000', '2014-09-21 04:44:38'),
('6b7d275271ef7721cb5f55d424ac79ae', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '8cdee5510e9459c4c71fc2d7426a819d', '450000', '2014-09-21 04:44:38'),
('8cfc8347c2fe4671e64b985c8d78cc81', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '31718df9e8ba1e6f1e7e3c6e6fe144b5', '450000', '2014-09-21 04:44:38'),
('900a6d4b460a97753eebea03beaeb9ca', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '395874c95c2844cbad71a7228a8cbcb9', '450000', '2014-09-21 04:44:38'),
('9696ef43e1d5be49d461a0e5fe63a071', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '2d29f50ad78a2cae95a77816c0211538', '450000', '2014-09-21 04:44:38'),
('4707586f4bb45400ab92d09bc754b35d', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '5d5a466a6ff6389e6b561a686c3adf5d', '450000', '2014-09-21 04:44:38'),
('de59520dfb6b390861f278704576defb', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'c0b0dd7e625ce3616fd9c4beab6dcac5', '450000', '2014-09-21 04:44:38'),
('e40435ac6ca1987cab32c56ff338a286', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'af9820125c0f7aab3b1578a9c8ededc7', '450000', '2014-09-21 04:44:38'),
('3c0e91ca4355942077f7063226f84d8f', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '06c0522c58244607bdf5a80663c6d72e', '450000', '2014-09-21 04:44:38'),
('7cde4eb16da831350061a6eb982d0d81', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'e598d67efe0e00a68a4139ff3eb90814', '450000', '2014-09-21 04:44:38'),
('21589907ca29f242972c5d8703db07cc', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '4966085ce55991f997af32c35bdac0da', '450000', '2014-09-21 04:44:38'),
('67f6965f237fe7caed7ccdfaba70875a', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '35a8c4edd5c7c2bd115dc1bdd268089e', '450000', '2014-09-21 04:44:38'),
('1d02ae175cc34ce2f7aecf61cd455a14', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '36afee382d08eb63c8f511551b0ae37a', '450000', '2014-09-21 04:44:38'),
('71fee060920fe57b5bc84c37235d3764', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '8e6d567120c95ef1e2b3a87dad01f34e', '450000', '2014-09-21 04:44:38'),
('09fd9af3ad1f90be374e04a6788b06d2', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '77439b46023adb39955c7271cb94e232', '450000', '2014-09-21 04:44:38'),
('033e159cc508287b4fbeeca45b2b2c6e', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '6569111b4b5cc4548f5cd47d1e332afc', '300000', '2014-09-26 08:31:54'),
('ffaa5ad9f58a87817f4f26c5a4bcee39', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '4ceb15634fff99180d7a6622ea2de203', '', '2014-09-26 08:31:54'),
('340db7f4fd7fdedc624cc3c15c26c4d5', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '61787e0ad2ad4ded3eece492ca465fbe', '', '2014-09-26 08:31:54'),
('d233f7cc6b4aae97c557cfa160738b8b', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '58ac86ddde01c0c8757c8077a6ba51be', '', '2014-09-26 08:31:54'),
('641fc5cf236e03dd2681d0025222b578', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '7ecf05631232af8124dc473a37d38e60', '', '2014-09-26 08:31:54'),
('8982137d8c0a4b0e147279908be23bba', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '9f4fdfc5ff704f27b02b87d0eb8e67bc', '', '2014-09-26 08:31:54'),
('83477bf516f32dd8362b4a221103e706', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '3181db373ac11b8a9841849e5ca4771a', '', '2014-09-26 08:31:54'),
('215bacbdbce0ab3f5034dbd61dfc28d6', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'd981fd47cadaee25f092b860c46fbf95', '', '2014-09-26 08:31:54'),
('976e541f6682100d47aeca7e63a8d141', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '79ea01c4705671577a7d40f9196e46eb', '', '2014-09-26 08:31:54'),
('c51b7819a57b08087f151aeb7e538e3e', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '06cb57fe1484bd130dd2a504abbc175f', '', '2014-09-26 08:31:54'),
('43dbe0e6fd4ffeab5b0e20ea63bae984', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '7a49aa1bc896be4970996b63f2e99c21', '', '2014-09-26 08:31:54'),
('c0b90e1281d2c916bc36a5f411233820', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '23a9814b55b115fc07dd978d512f5236', '', '2014-09-26 08:31:54'),
('582ce678c5c0da8c3e013dfecf8671d2', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '264c0ff40c8a9f19639ba5cbf7cb22b1', '', '2014-09-26 08:31:54'),
('c113bc14356a1d5bc1c857e04237b828', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '031158f2a3036862c69153a660ca444b', '', '2014-09-26 08:31:54'),
('520dd17041c43f0730bf8623cb220da5', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'f8eb7acc3617715179ebd7c8a7f302ee', '', '2014-09-26 08:31:54'),
('b219d1ccf929a18d0617517dda5486c7', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', 'eefd362681d2d1c14aade02861dba39e', '', '2014-09-26 08:31:54'),
('359663c1a62d8cb5ee8921f77704ad2c', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '7acc8e15ac1464573ebfc6dca66351c3', '', '2014-09-26 08:31:54'),
('5688209711fb3f9b9b4731790182482e', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '7d5f428937fd09d611944581f9674aeb', '', '2014-09-26 08:31:54'),
('10cdd243a1bd96d0f2448f08a12dc940', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '32db12d049284df926f73327eb00c409', '', '2014-09-26 08:31:54'),
('e55c101bf1f80ba6ea707774cd9d6a0e', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '431380af448b936cd22b26edbb0f11a2', '4253a06c2afb5abfe3c9b516d843862a', '', '2014-09-26 08:31:54'),
('d116d63d12879f755d669d016897af5f', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '6569111b4b5cc4548f5cd47d1e332afc', '300000', '2014-09-26 08:33:45'),
('77bff7fc9062206a4eded50668e8e483', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '4ceb15634fff99180d7a6622ea2de203', '300000', '2014-09-26 08:33:45'),
('72835afaaee78f73382d633bba34743a', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '61787e0ad2ad4ded3eece492ca465fbe', '300000', '2014-09-26 08:33:45'),
('c0a9f3e0df0b7f701a6f4341d2bb3b79', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '58ac86ddde01c0c8757c8077a6ba51be', '', '2014-09-26 08:33:45'),
('4c0eb06eb1e1cabc35e15483e8a12fea', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7ecf05631232af8124dc473a37d38e60', '', '2014-09-26 08:33:45'),
('15bdca9dc2e774554bef7764eea161dd', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '9f4fdfc5ff704f27b02b87d0eb8e67bc', '', '2014-09-26 08:33:45'),
('b6af7d469153300432023cebb516059b', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '3181db373ac11b8a9841849e5ca4771a', '', '2014-09-26 08:33:45'),
('8e5a87c081dae8f0686a0569ff35edb8', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'd981fd47cadaee25f092b860c46fbf95', '', '2014-09-26 08:33:45'),
('ff4627c42dcc0a4530b0cd608abf4681', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '79ea01c4705671577a7d40f9196e46eb', '', '2014-09-26 08:33:45'),
('6a0e6237b37a3fc6b2b0713544582c4c', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '06cb57fe1484bd130dd2a504abbc175f', '', '2014-09-26 08:33:45'),
('989dcbce89cf711269d71c02cbda897e', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7a49aa1bc896be4970996b63f2e99c21', '', '2014-09-26 08:33:45'),
('96def55874801840cdd0a201c3723e28', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '23a9814b55b115fc07dd978d512f5236', '', '2014-09-26 08:33:45'),
('09e06b8dd3df091943361e1c703b9193', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '264c0ff40c8a9f19639ba5cbf7cb22b1', '', '2014-09-26 08:33:45'),
('226b9bca9d25e139c317f7d9d8105558', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '031158f2a3036862c69153a660ca444b', '', '2014-09-26 08:33:45'),
('ca3dc33cf98454b51975637cba09dd3f', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'f8eb7acc3617715179ebd7c8a7f302ee', '', '2014-09-26 08:33:45'),
('d3177dbaba4bda3ecbc85f78490a4143', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'eefd362681d2d1c14aade02861dba39e', '', '2014-09-26 08:33:45'),
('7d5e5c2c3dff2a409902515b49b66bd7', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7acc8e15ac1464573ebfc6dca66351c3', '', '2014-09-26 08:33:45'),
('78903a1f5b85672069cbbdb50eaa0984', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7d5f428937fd09d611944581f9674aeb', '', '2014-09-26 08:33:45'),
('f9fa5d165b3d5bc4dc41ae13bc637dfe', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '32db12d049284df926f73327eb00c409', '', '2014-09-26 08:33:45'),
('a484979cfa5be6523b9a7741782a2b30', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '4253a06c2afb5abfe3c9b516d843862a', '', '2014-09-26 08:33:45'),
('22b2116ba875ff1971cc6c3e57e073f3', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '239e5d2df9da1595a187b6209a1fb2cb', '500000', '2015-06-10 09:11:57'),
('78281526adbd006e124269020b72c699', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'bde8bacc8a57e4fda9804e7e65d7e4a9', '500000', '2015-06-10 09:11:57'),
('0c6daae4d3e07362c0161142b268c82c', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '3cf4107c1216adca002deb1563673bcc', '500000', '2015-06-10 09:11:57'),
('dde29d60662ebe06bbacff19d1d0573f', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '34eb4503f2324fab1573fc28436b665b', '500000', '2015-06-10 09:11:57'),
('1996d853ef43d2a9180e9d0fe318e4b3', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '9164a9724f8630843715f71c4e2fd7ca', '500000', '2015-06-10 09:11:57'),
('0bb4d61169842dc3e67cac226b680a58', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '1045e40434659bd07bac439f600718d9', '500000', '2015-06-10 09:11:57'),
('5ed1dc4dbb39a3ba0e99c22faa05d934', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '671a91ed84d3b07fa015bff4b5abc3fc', '500000', '2015-06-10 09:11:57'),
('e43e7614c797c03bbe68931b642424b6', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '8a6a2d5c1893347a67d646fb68eaf992', '500000', '2015-06-10 09:11:57'),
('f62b2c45d8628d6efce208e6d054aff5', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a20d8d19323a3b2af0c1c3fbb05d4695', '500000', '2015-06-10 09:11:57'),
('34d1e77b15144e924a030f5882fde5cc', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'ca1efd3f7f6dcc6a89be7d2007bd1376', '500000', '2015-06-10 09:11:57'),
('ba96802f2973d2e9ff8d97fdb31bf766', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '45a600a3d07be807f4dd21cd8b3c2141', '500000', '2015-06-10 09:11:57'),
('5dd3c12b097f74601a15e1de8c04857d', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'e09e82f44c9f985a748821f08768ff1a', '500000', '2015-06-10 09:11:57'),
('f617d139fc3994f80f72254eaeef549b', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'e790ebf8cb5a271c2d2c70925ed137e9', '500000', '2015-06-10 09:11:57'),
('60ac80e4176f859ddceddfbfb970ac74', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '9a854783b89b882986980d814c7670b6', '500000', '2015-06-10 09:11:57'),
('e6fcfcace4213779ce23063b5de0289c', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'bcef72955f16e70687baec3cd22d0090', '500000', '2015-06-10 09:11:57'),
('b46f90ab5818a60c4b4034debae84389', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '327a47a460513a493575f8a89dd23e17', '500000', '2015-06-10 09:11:57'),
('d9d37513d8636756512f7170acfc9a48', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '93f6f01c3488f4377c770aea31f2cfd9', '500000', '2015-06-10 09:11:57'),
('55ac85e043c2355626adbd691d047d59', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7e2da50f468b1d7fbe45055c58f41a48', '500000', '2015-06-10 09:11:57'),
('996a6330d6f3f9c223eb4dce298f6739', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '30e7d710c1267581240d4ce6a4c31dde', '500000', '2015-06-10 09:11:57'),
('5ca72d711e1bfcb059d6ad80fae7cb87', 'c4ca4238a0b923820dcc509a6f75849b', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '20edafa9fb33a818c7883bda8be5c32c', '500000', '2015-06-10 09:11:57'),
('708a150b0cb3190dc71e1126f9d36f87', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '239e5d2df9da1595a187b6209a1fb2cb', '1500000', '2015-06-23 05:51:53'),
('00795c4cc9f385755d48eb39249dc5a5', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'bde8bacc8a57e4fda9804e7e65d7e4a9', '1500000', '2015-06-23 05:51:53'),
('ec2c7d59a7170f1c2e61fe285124b62f', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '3cf4107c1216adca002deb1563673bcc', '2000000', '2015-06-23 05:51:53'),
('a940973b07f3244ebcaf48ce5b0126cf', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '34eb4503f2324fab1573fc28436b665b', '3000000', '2015-06-23 05:51:53'),
('77abfa1be2352a061d5959c8d35d6ec4', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '9164a9724f8630843715f71c4e2fd7ca', '', '2015-06-23 05:51:53'),
('ae44a61e85458f1344d9290b24db0faf', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '1045e40434659bd07bac439f600718d9', '', '2015-06-23 05:51:53'),
('0392b75d7f18cf8a55d53ebc08315f31', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '671a91ed84d3b07fa015bff4b5abc3fc', '', '2015-06-23 05:51:53'),
('6cc8266de16acf4122731ae40a6a3e14', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '8a6a2d5c1893347a67d646fb68eaf992', '', '2015-06-23 05:51:53'),
('a11d6cf5e32f0f45b91e58f9f17326f4', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'a20d8d19323a3b2af0c1c3fbb05d4695', '', '2015-06-23 05:51:53'),
('9c65238191c091698b001a8a1c2bf92e', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'ca1efd3f7f6dcc6a89be7d2007bd1376', '', '2015-06-23 05:51:53'),
('e6f7a908202fa3aadaa8042b23ddcaf3', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '45a600a3d07be807f4dd21cd8b3c2141', '', '2015-06-23 05:51:53'),
('3ec3fcacfad9bd0b539c1bdc3eca4c5a', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'e09e82f44c9f985a748821f08768ff1a', '', '2015-06-23 05:51:53'),
('303b8ba753e2ce751edd4330745680ae', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'e790ebf8cb5a271c2d2c70925ed137e9', '', '2015-06-23 05:51:53'),
('6b6e696b125d17bd15bc77772a31f4d7', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '9a854783b89b882986980d814c7670b6', '', '2015-06-23 05:51:53'),
('d94a90c068cf45395295f1110c4fed67', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', 'bcef72955f16e70687baec3cd22d0090', '', '2015-06-23 05:51:53'),
('85cfe3bf049f5dbc9568026e2656c4a6', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '327a47a460513a493575f8a89dd23e17', '', '2015-06-23 05:51:53'),
('52c6c7c1082302ea02f70524f23924d5', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '93f6f01c3488f4377c770aea31f2cfd9', '', '2015-06-23 05:51:53'),
('f968efbd3fb1af274607579d92eaf67f', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '7e2da50f468b1d7fbe45055c58f41a48', '', '2015-06-23 05:51:53'),
('0022684c1439580b5c99f5c960a34dda', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '30e7d710c1267581240d4ce6a4c31dde', '', '2015-06-23 05:51:53'),
('6d36c3a99c4b10b07e2ddfe7aa0204f3', 'c9c6af590fd66c486866cd58866bbc03', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'eb097da23b4aec62d72d985a63ce2807', '20edafa9fb33a818c7883bda8be5c32c', '', '2015-06-23 05:51:53'),
('77965f1c9b8430eefd35740754dbaac6', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '1aafa578cf4790a11ecac346fc6d5aa4', '1684554d7acf3d87d55ab4663ae0696f', '300000', '2015-09-18 05:02:03'),
('9806c521e55206231c91813011dc7c7c', 'c4ca4238a0b923820dcc509a6f75849b', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '1aafa578cf4790a11ecac346fc6d5aa4', '', '', '2015-09-18 05:02:03'),
('74f5913892a76f437732f76e17a26cd2', '5bd8c233aed3cb0a8e5862c4cdc292bc', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '1aafa578cf4790a11ecac346fc6d5aa4', '1684554d7acf3d87d55ab4663ae0696f', '500000', '2015-09-18 05:02:10'),
('81d49a1521383ed42264d15b916c690f', '5bd8c233aed3cb0a8e5862c4cdc292bc', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '1aafa578cf4790a11ecac346fc6d5aa4', '', '', '2015-09-18 05:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `m_keu_spi`
--

CREATE TABLE IF NOT EXISTS `m_keu_spi` (
  `kd` varchar(50) NOT NULL,
  `kd_jenis` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `nilai` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_keu_spi`
--

INSERT INTO `m_keu_spi` (`kd`, `kd_jenis`, `kd_tapel`, `kd_progdi`, `kd_kelas`, `nilai`) VALUES
('85cc165150bcfc8e64eb0c7489d55950', '70b97c951b5dc2c3b26d50eefeea19cc', 'bddff5ad954302e7bcad29460998d7d2', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '1100000'),
('af4efd0c6601a00f0973c2636d5f5ad6', '70b97c951b5dc2c3b26d50eefeea19cc', 'bddff5ad954302e7bcad29460998d7d2', 'c8621d9f457352abd822d33e072763a2', 'c4ca4238a0b923820dcc509a6f75849b', '1800000'),
('b658cb67d84b20c8396d75c961be56aa', '70b97c951b5dc2c3b26d50eefeea19cc', 'bddff5ad954302e7bcad29460998d7d2', 'fe4dc25837042c1e954c07565e11d69d', 'c4ca4238a0b923820dcc509a6f75849b', '1200000'),
('874694cda33cfe27a075d3ea3411269f', '70b97c951b5dc2c3b26d50eefeea19cc', 'bddff5ad954302e7bcad29460998d7d2', '012a7ebf3d38c316a406fd423e692ca5', 'c4ca4238a0b923820dcc509a6f75849b', '1400000'),
('296966bac60e6fbe4abd64a45bd5a1d9', '70b97c951b5dc2c3b26d50eefeea19cc', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', '1700000'),
('1652daaf3ed9ea3d17f506aefe566f70', '70b97c951b5dc2c3b26d50eefeea19cc', 'bddff5ad954302e7bcad29460998d7d2', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '2000000'),
('2f2113f8e9d3a0e4317ce7b46b0c531f', '70b97c951b5dc2c3b26d50eefeea19cc', 'bddff5ad954302e7bcad29460998d7d2', '166f9d5d356b022ee6e94ee4fb7fad63', 'c4ca4238a0b923820dcc509a6f75849b', '2300000');

-- --------------------------------------------------------

--
-- Table structure for table `m_keu_ss`
--

CREATE TABLE IF NOT EXISTS `m_keu_ss` (
  `kd` varchar(50) NOT NULL,
  `kd_jenis` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_ruang` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `nilai` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_keu_ss`
--

INSERT INTO `m_keu_ss` (`kd`, `kd_jenis`, `kd_progdi`, `kd_kelas`, `kd_ruang`, `kd_tapel`, `kd_smt`, `kd_mahasiswa`, `nilai`) VALUES
('7dd0f7951e1a5def6431df5f16654bb8', 'f3b22b92155c4bc1ecb1b6db7dd56b91', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'e8bdaca39d6b99fa04d51687eb8b2f25', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'f2ad38e73146871cee50050fbf7474a7', '2900000'),
('4a21be71f5a410fd2e4446ced013340c', 'f3b22b92155c4bc1ecb1b6db7dd56b91', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'e8bdaca39d6b99fa04d51687eb8b2f25', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'cbb9ebd1adf31bacd22f25e0933a29ff', '6600000'),
('5c6a94d3d19797cf26fa6a3aab2b5b9f', 'f3b22b92155c4bc1ecb1b6db7dd56b91', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'e8bdaca39d6b99fa04d51687eb8b2f25', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'f81ba9bdf3d29c9cb7554bcc71c6c56c', '1200000'),
('6a6b93a71bfa2dcb7606cedb366a991e', 'f3b22b92155c4bc1ecb1b6db7dd56b91', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'e8bdaca39d6b99fa04d51687eb8b2f25', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'a0020b731b45760c9e1308a5a9a6993d', '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `m_kuisioner_dosen`
--

CREATE TABLE IF NOT EXISTS `m_kuisioner_dosen` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kuisioner_dosen`
--

INSERT INTO `m_kuisioner_dosen` (`kd`, `nama`, `postdate`) VALUES
('f6a1009c4eba564ddff346647b242c45', 'Bagaimana penyampaian materi pengajarannya?', '2015-06-22 06:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `m_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `m_mahasiswa` (
  `kd` varchar(50) NOT NULL,
  `usernamex` varchar(50) NOT NULL,
  `passwordx` varchar(50) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `tmp_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat_skrg` varchar(255) NOT NULL,
  `alamat_asal` varchar(255) NOT NULL,
  `kd_agama` varchar(50) NOT NULL,
  `status_sipil` varchar(50) NOT NULL,
  `warga_negara` varchar(50) NOT NULL,
  `judul_ta` varchar(255) NOT NULL,
  `tgl_ujian` date NOT NULL,
  `nilai_ujian` varchar(5) NOT NULL,
  `no_ijazah` varchar(100) NOT NULL,
  `filex` varchar(255) NOT NULL,
  `postdate` datetime NOT NULL,
  `nim_pusat` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_mahasiswa`
--

INSERT INTO `m_mahasiswa` (`kd`, `usernamex`, `passwordx`, `nim`, `nama`, `kelamin`, `tmp_lahir`, `tgl_lahir`, `alamat_skrg`, `alamat_asal`, `kd_agama`, `status_sipil`, `warga_negara`, `judul_ta`, `tgl_ujian`, `nilai_ujian`, `no_ijazah`, `filex`, `postdate`, `nim_pusat`) VALUES
('1684554d7acf3d87d55ab4663ae0696f', '15020001', 'e97de71140ffa99ed88a20332964a208', '15020001', 'Onno W. Purbo', 'L', 'xstrix', '1900-01-01', 'xstrix', 'xstrix', '0925bdd232a5e30da573fd1ad7a4562d', 'Belum Kawin', 'WNI', 'xxx', '2015-02-01', '74', 'eexgmringx34xgmringx23', '', '2015-09-18 04:21:25', ''),
('879042992679a3cb2c0552a575ae42ff', '15020002E', '954c6debc34a4cd345fe13ba4df09e99', '15020002E', 'I Putu Agus Pratama', 'L', 'xstrix', '1900-01-01', 'xstrix', 'xstrix', 'f398e1509cc6940ad3d93a4f1eb820a7', 'Belum Kawin', 'WNI', '', '0000-00-00', '', '', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_mahasiswa_alumni`
--

CREATE TABLE IF NOT EXISTS `m_mahasiswa_alumni` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `no_ijazah` varchar(100) NOT NULL,
  `tgl_ijazah` date NOT NULL,
  `tgl_terima_ijazah` date NOT NULL,
  `tgl_tulis` date NOT NULL,
  `alumni` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_mahasiswa_alumni`
--

INSERT INTO `m_mahasiswa_alumni` (`kd`, `kd_mahasiswa`, `no_ijazah`, `tgl_ijazah`, `tgl_terima_ijazah`, `tgl_tulis`, `alumni`) VALUES
('a84034f44f52fa4b06f090f150d26be0', '1684554d7acf3d87d55ab4663ae0696f', '1xgmringx2xgmringx3xgmringx4', '2015-10-14', '2015-07-12', '2015-09-17', 'true'),
('4ea3d8f0ac88f5805a1fe56e4e3beef3', '879042992679a3cb2c0552a575ae42ff', '', '0000-00-00', '0000-00-00', '2015-09-17', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `m_mahasiswa_hobi`
--

CREATE TABLE IF NOT EXISTS `m_mahasiswa_hobi` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `hobi_a` varchar(100) NOT NULL,
  `hobi_b` varchar(100) NOT NULL,
  `hobi_c` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_mahasiswa_hobi`
--

INSERT INTO `m_mahasiswa_hobi` (`kd`, `kd_mahasiswa`, `hobi_a`, `hobi_b`, `hobi_c`) VALUES
('a84034f44f52fa4b06f090f150d26be0', '1684554d7acf3d87d55ab4663ae0696f', '', '', ''),
('4ea3d8f0ac88f5805a1fe56e4e3beef3', '879042992679a3cb2c0552a575ae42ff', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_mahasiswa_org`
--

CREATE TABLE IF NOT EXISTS `m_mahasiswa_org` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `org_a` varchar(100) NOT NULL,
  `org_b` varchar(100) NOT NULL,
  `org_c` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_mahasiswa_org`
--

INSERT INTO `m_mahasiswa_org` (`kd`, `kd_mahasiswa`, `org_a`, `org_b`, `org_c`) VALUES
('a84034f44f52fa4b06f090f150d26be0', '1684554d7acf3d87d55ab4663ae0696f', '', '', ''),
('4ea3d8f0ac88f5805a1fe56e4e3beef3', '879042992679a3cb2c0552a575ae42ff', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_mahasiswa_ortu`
--

CREATE TABLE IF NOT EXISTS `m_mahasiswa_ortu` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `ayah_nama` varchar(30) NOT NULL,
  `ayah_pddkn` varchar(100) NOT NULL,
  `ayah_pekerjaan` varchar(50) NOT NULL,
  `ayah_alamat` varchar(255) NOT NULL,
  `ayah_hidup` enum('true','false') NOT NULL DEFAULT 'true',
  `ibu_nama` varchar(30) NOT NULL,
  `ibu_pddkn` varchar(100) NOT NULL,
  `ibu_pekerjaan` varchar(50) NOT NULL,
  `ibu_alamat` varchar(255) NOT NULL,
  `ibu_hidup` enum('true','false') NOT NULL DEFAULT 'true',
  `nama_pj` varchar(30) NOT NULL,
  `hubungan` varchar(50) NOT NULL,
  `hasil_per_bulan` varchar(10) NOT NULL,
  `hasil_per_tahun` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_mahasiswa_ortu`
--

INSERT INTO `m_mahasiswa_ortu` (`kd`, `kd_mahasiswa`, `ayah_nama`, `ayah_pddkn`, `ayah_pekerjaan`, `ayah_alamat`, `ayah_hidup`, `ibu_nama`, `ibu_pddkn`, `ibu_pekerjaan`, `ibu_alamat`, `ibu_hidup`, `nama_pj`, `hubungan`, `hasil_per_bulan`, `hasil_per_tahun`) VALUES
('a84034f44f52fa4b06f090f150d26be0', '1684554d7acf3d87d55ab4663ae0696f', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('4ea3d8f0ac88f5805a1fe56e4e3beef3', '879042992679a3cb2c0552a575ae42ff', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_mahasiswa_pddkn`
--

CREATE TABLE IF NOT EXISTS `m_mahasiswa_pddkn` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `thn_lulus` varchar(4) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `status_asal_sekolah` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_mahasiswa_pddkn`
--

INSERT INTO `m_mahasiswa_pddkn` (`kd`, `kd_mahasiswa`, `asal_sekolah`, `thn_lulus`, `jurusan`, `status_asal_sekolah`) VALUES
('a84034f44f52fa4b06f090f150d26be0', '1684554d7acf3d87d55ab4663ae0696f', '', '', '', ''),
('4ea3d8f0ac88f5805a1fe56e4e3beef3', '879042992679a3cb2c0552a575ae42ff', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_mahasiswa_sehat`
--

CREATE TABLE IF NOT EXISTS `m_mahasiswa_sehat` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `tb` varchar(3) NOT NULL,
  `bb` varchar(3) NOT NULL,
  `mata` varchar(50) NOT NULL,
  `gol_darah` varchar(10) NOT NULL,
  `pendengaran` varchar(50) NOT NULL,
  `penyakit_pernah` varchar(50) NOT NULL,
  `penyakit_sekarang` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_mahasiswa_sehat`
--

INSERT INTO `m_mahasiswa_sehat` (`kd`, `kd_mahasiswa`, `tb`, `bb`, `mata`, `gol_darah`, `pendengaran`, `penyakit_pernah`, `penyakit_sekarang`) VALUES
('a84034f44f52fa4b06f090f150d26be0', '1684554d7acf3d87d55ab4663ae0696f', '', '', '', '', '', '', ''),
('4ea3d8f0ac88f5805a1fe56e4e3beef3', '879042992679a3cb2c0552a575ae42ff', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_mahasiswa_status`
--

CREATE TABLE IF NOT EXISTS `m_mahasiswa_status` (
  `kd` varchar(50) NOT NULL,
  `kd_mahasiswa` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `sebagai_mhs` varchar(100) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_jenjang` varchar(50) NOT NULL,
  `pindahan_pt` varchar(100) NOT NULL,
  `pindahan_progdi` varchar(100) NOT NULL,
  `pindahan_jurusan` varchar(100) NOT NULL,
  `pindahan_jenjang` varchar(10) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_mahasiswa_status`
--

INSERT INTO `m_mahasiswa_status` (`kd`, `kd_mahasiswa`, `kd_tapel`, `status`, `sebagai_mhs`, `kd_progdi`, `kd_jenjang`, `pindahan_pt`, `pindahan_progdi`, `pindahan_jurusan`, `pindahan_jenjang`, `kd_smt`, `kd_kelas`) VALUES
('a84034f44f52fa4b06f090f150d26be0', '1684554d7acf3d87d55ab4663ae0696f', '1aafa578cf4790a11ecac346fc6d5aa4', 'Murni', '', 'a313b78f7be3efd5f3f9e0d627703ee6', 'a6125a9578990b45bf1df5d24cbf59ac', '', '', '', '', 'c4ca4238a0b923820dcc509a6f75849b', ''),
('4ea3d8f0ac88f5805a1fe56e4e3beef3', '879042992679a3cb2c0552a575ae42ff', '1aafa578cf4790a11ecac346fc6d5aa4', 'Murni', 'Biasa', 'a313b78f7be3efd5f3f9e0d627703ee6', 'a6125a9578990b45bf1df5d24cbf59ac', '', '', '', '', 'c4ca4238a0b923820dcc509a6f75849b', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_makul`
--

CREATE TABLE IF NOT EXISTS `m_makul` (
  `kd` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `sks` varchar(1) NOT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'true',
  `jenis` enum('true','false') NOT NULL DEFAULT 'true'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_makul`
--

INSERT INTO `m_makul` (`kd`, `kd_progdi`, `kode`, `nama`, `sks`, `status`, `jenis`) VALUES
('eaaf7959eba51755bae350720546a8b4', 'a313b78f7be3efd5f3f9e0d627703ee6', 'MK0001', 'Sistem Operasi', '', 'true', 'true'),
('db8644a7b69b0174a7d7b2016380f505', 'a313b78f7be3efd5f3f9e0d627703ee6', 'MK0002', 'Pengantar Database', '', 'true', 'true'),
('8666ed9021eb8164210dc3113787500e', 'a313b78f7be3efd5f3f9e0d627703ee6', 'MK0003', 'Pemrograman Dasar', '', 'true', 'true'),
('f71cda53f8da059d091065b0d39dbd12', 'a313b78f7be3efd5f3f9e0d627703ee6', 'MK0004', 'Ilmu Budaya Dasar', '', 'true', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `m_makul_smt`
--

CREATE TABLE IF NOT EXISTS `m_makul_smt` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_makul` varchar(50) NOT NULL,
  `sks` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_makul_smt`
--

INSERT INTO `m_makul_smt` (`kd`, `kd_tapel`, `kd_smt`, `kd_makul`, `sks`) VALUES
('f29e1f73f85165def421c19a70d28f8f', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'eaaf7959eba51755bae350720546a8b4', '2'),
('1dedffba20f23653e605b653753b2762', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'db8644a7b69b0174a7d7b2016380f505', '3'),
('d577b6e3d2b8a50e6fcc55a008c3f446', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', '8666ed9021eb8164210dc3113787500e', '2'),
('b189b109c2984b008b05a650236d0c62', '1aafa578cf4790a11ecac346fc6d5aa4', 'c4ca4238a0b923820dcc509a6f75849b', 'f71cda53f8da059d091065b0d39dbd12', '2'),
('540e1f10b10a393566240030cde89827', '1aafa578cf4790a11ecac346fc6d5aa4', 'c81e728d9d4c2f636f067f89cc14862c', 'eaaf7959eba51755bae350720546a8b4', '2'),
('3086c70f581298c9ea384f907c97a4cc', '1aafa578cf4790a11ecac346fc6d5aa4', 'c81e728d9d4c2f636f067f89cc14862c', '8666ed9021eb8164210dc3113787500e', '3');

-- --------------------------------------------------------

--
-- Table structure for table `m_pegawai`
--

CREATE TABLE IF NOT EXISTS `m_pegawai` (
  `kd` varchar(50) NOT NULL,
  `usernamex` varchar(50) NOT NULL,
  `passwordx` varchar(50) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `kd_jabatan` varchar(50) NOT NULL,
  `pend_terakhir` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `kd_agama` varchar(50) NOT NULL,
  `filex` varchar(255) NOT NULL,
  `postdate` datetime NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `pasangan_nama` varchar(30) NOT NULL,
  `pasangan_tmp_lahir` varchar(20) NOT NULL,
  `pasangan_tgl_lahir` date NOT NULL,
  `pasangan_kerja` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pegawai`
--

INSERT INTO `m_pegawai` (`kd`, `usernamex`, `passwordx`, `nip`, `kode`, `nama`, `tmp_lahir`, `tgl_lahir`, `kelamin`, `kd_jabatan`, `pend_terakhir`, `alamat`, `telp`, `kd_agama`, `filex`, `postdate`, `tgl_masuk`, `tgl_keluar`, `pasangan_nama`, `pasangan_tmp_lahir`, `pasangan_tgl_lahir`, `pasangan_kerja`) VALUES
('c78b863c1fe7094595bec20626d3945f', '150001', '1ea3d1d3bd51ccbb3da578b97394238d', '150001', '', 'agus', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', '0000-00-00', ''),
('d7534b51e3a7ffb82661bb5e5c642339', '150002', '1854a85e34bc4d880587ef6bb1bc40ae', '150002', '', 'muhajir', '', '0000-00-00', '', '', '', '', '', '', '', '2015-09-18 04:18:20', '0000-00-00', '0000-00-00', '', '', '0000-00-00', ''),
('c95d3fa445297532b33e55fe55c65686', '150003', '19b1367281a8f38e846ab6e0ab21e787', '150003', '', 'agus muhajir', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_pegawai_anak`
--

CREATE TABLE IF NOT EXISTS `m_pegawai_anak` (
  `kd` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL,
  `no` varchar(1) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_pekerjaan`
--

CREATE TABLE IF NOT EXISTS `m_pekerjaan` (
  `kd` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_progdi`
--

CREATE TABLE IF NOT EXISTS `m_progdi` (
  `kd` varchar(50) NOT NULL,
  `kode` varchar(2) NOT NULL,
  `no` varchar(2) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama2` varchar(100) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL,
  `jenjang` varchar(30) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `gelar` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_progdi`
--

INSERT INTO `m_progdi` (`kd`, `kode`, `no`, `nama`, `nama2`, `kd_pegawai`, `jenjang`, `jurusan`, `gelar`) VALUES
('7619ed9df8e6e190c2c758ab3cf71211', '01', '4', 'Sxstrix1 Hukum', 'Akuntansi', 'c78b863c1fe7094595bec20626d3945f', 'Diploma Tiga / D-III', 'Akuntansi', 'Ahli Madya (A.Md) Akuntansi'),
('a313b78f7be3efd5f3f9e0d627703ee6', '02', '6', 'Sxstrix1 Komputer', 'Teknik Mesin', 'd7534b51e3a7ffb82661bb5e5c642339', 'Diploma Tiga / D-III', 'Teknik Mesin', 'Ahli Madya (A.Md) Mesin'),
('87dc9ca9590feba8706c15fbd43d6e12', '03', '', 'Sxstrix1 Ekonomi', '', 'c95d3fa445297532b33e55fe55c65686', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_ruang`
--

CREATE TABLE IF NOT EXISTS `m_ruang` (
  `kd` varchar(50) NOT NULL,
  `ruang` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_ruang`
--

INSERT INTO `m_ruang` (`kd`, `ruang`) VALUES
('96660ceb9b5863b9f5955052a51d3312', 'KOM.15.02'),
('cc3e2f0c461d76425055deef36955645', 'KOM.15.01'),
('e36f0c8f911a54d3b13959b3c52ea576', 'HK.15.02'),
('74a5c5c20632852e46ac00aac129b7a4', 'HK.15.01'),
('2e15240286f9f222ba66e782ac70d410', 'EK.15.01'),
('fc9815e75c58f8a02ef508490caa00e8', 'EK.15.02');

-- --------------------------------------------------------

--
-- Table structure for table `m_ruang2`
--

CREATE TABLE IF NOT EXISTS `m_ruang2` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_ruang2`
--

INSERT INTO `m_ruang2` (`kd`, `nama`) VALUES
('f6132edd2cf3bcb38da5274fccd1df52', 'C12 Lantai 1'),
('69b299752f37e838163bc12b949563be', 'C12 Lantai 2'),
('123bced236d7242e15760d53fc767333', 'C12 Lantai 3'),
('645019570659f7c454196944fb83af0f', 'C15 Lantai 1'),
('52332915119e1c4e4fcc3ff8363c2232', 'C15 Lantai 2'),
('1ac1027d1001feba6ec9f2dfe9f082a8', 'C15 Lantai 3'),
('a3f1b910a7cb1ced4fb81fb8193c8a86', 'C16 Lantai 1'),
('5023514893300b9968482d027533de36', 'C16 Lantai 2'),
('01a9dc3d77415e8074119041dc6b4b44', 'C16 Lantai 3'),
('561162864e97875a8df0418b64c0458a', 'C17 Lantai 1'),
('797e71df03575b5a7d276971eb5ebbe8', 'C17 Lantai 2'),
('5f921ec2b21aa3e7f1fa422f42631626', 'C17 Lantai 3'),
('170b342ce2273fd9bb390f1e235b9161', 'E5 Lantai 1'),
('086692430d3449a7426f28edf8eb68c7', 'E5 Lantai 2'),
('289b3dc00c2ea97426a2fde600f777a0', 'E5 Lantai 3'),
('594f72ace5b1885fec07e5eea18242bc', 'C18 Lantai 1'),
('c84ed8308cb229effc9e8a7120684647', 'C18 Lantai 2'),
('8f1ed604821525723ec958fe2adb0731', 'C18 Lantai 3');

-- --------------------------------------------------------

--
-- Table structure for table `m_smt`
--

CREATE TABLE IF NOT EXISTS `m_smt` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(2) NOT NULL,
  `smt` varchar(10) NOT NULL,
  `jenis` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_smt`
--

INSERT INTO `m_smt` (`kd`, `no`, `smt`, `jenis`) VALUES
('c4ca4238a0b923820dcc509a6f75849b', '1', 'I', '1'),
('c81e728d9d4c2f636f067f89cc14862c', '2', 'II', '2'),
('eccbc87e4b5ce2fe28308fd9f2a7baf3', '3', 'III', '1'),
('a87ff679a2f3e71d9181a67b7542122c', '4', 'IV', '2'),
('e4da3b7fbbce2345d7772b0674a318d5', '5', 'V', '1'),
('1679091c5a880faf6fb5e6087eb1b2dc', '6', 'VI', '2'),
('8f14e45fceea167a5a36dedd4bea2543', '7', 'VII', '1'),
('c9f0f895fb98ab9159f51fd0297e236d', '8', 'VIII', '2');

-- --------------------------------------------------------

--
-- Table structure for table `m_status`
--

CREATE TABLE IF NOT EXISTS `m_status` (
  `kd` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_status`
--

INSERT INTO `m_status` (`kd`, `status`) VALUES
('83042069b01e1cf34e9dd785db91f25f', 'Dosen Honorer PNS'),
('00371290b0945fb5e4220def19ed097f', 'Dosen Honorer Swasta'),
('820659a02627f696f2505bb8bf7faeb0', 'Dosen Tetap'),
('24d1ad52bfd6b13c5e6834b35b9cf3b0', 'Dosen Tidak Tetap'),
('340058b380493a7a31ecc71f7f877242', 'Karyawan Tetap'),
('9c7910102be7ec7c902b07aa4bf21218', 'Karyawan Kontrak'),
('6ac6fe53ef97465d5eba0318e9c9c37c', 'Karyawan Magang');

-- --------------------------------------------------------

--
-- Table structure for table `m_tapel`
--

CREATE TABLE IF NOT EXISTS `m_tapel` (
  `kd` varchar(50) NOT NULL,
  `tahun1` varchar(4) NOT NULL,
  `tahun2` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_tapel`
--

INSERT INTO `m_tapel` (`kd`, `tahun1`, `tahun2`) VALUES
('1aafa578cf4790a11ecac346fc6d5aa4', '2015', '2016'),
('38953f4829616cfe255addac99446969', '2016', '2017'),
('a8735cca073b46b581b5fd39ff93a544', '2017', '2018'),
('539e6fc51b8b0e2d3a5581a3faf54703', '2018', '2019'),
('806dfc7c40ed4d2572f6b2c064ea50be', '2019', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `m_ukm`
--

CREATE TABLE IF NOT EXISTS `m_ukm` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `pengurus` varchar(30) NOT NULL,
  `pembina` varchar(30) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_ukm`
--

INSERT INTO `m_ukm` (`kd`, `nama`, `pengurus`, `pembina`, `kd_pegawai`, `postdate`) VALUES
('495477244b39cc67f3db39bb8c53e2bf', 'Wushu', 'xstrix', '', 'c95d3fa445297532b33e55fe55c65686', '2014-09-21 04:39:14'),
('2d6c3b87e401db085cc52f946573383b', 'Kepanduan', 'agus', '', 'c78b863c1fe7094595bec20626d3945f', '2014-09-30 02:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_absen`
--

CREATE TABLE IF NOT EXISTS `pegawai_absen` (
  `kd` varchar(50) NOT NULL,
  `kd_pegawai` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_smt` varchar(50) NOT NULL,
  `kd_absen` varchar(50) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai_absen`
--

INSERT INTO `pegawai_absen` (`kd`, `kd_pegawai`, `kd_tapel`, `kd_smt`, `kd_absen`, `tgl`) VALUES
('0e99e792fa0889a08f6722e8a0271e9b', 'fb6db4a296c07b215e9a087c55db8ae0', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', 'c6b7c1807c9a990b96c36b569661abb4', '2010-07-01'),
('3ffe8cd14cf989e4e89e8ec79cf46301', '586bf5e5ac8ef75e831247d3bf27f31f', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', '6875d2e0feb0205e6bc4dd95f59cbc64', '2010-07-01'),
('af7b09b86b8346980b78d06fb16aaa8e', '7ebf35131cad1c680df2ed72dbbf8c53', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', '', '2010-07-01'),
('3ad967ff6ba53ca3393df5f2bc7c0780', '32576312ac9b2c2182e9c08137cb89ae', 'bddff5ad954302e7bcad29460998d7d2', 'c4ca4238a0b923820dcc509a6f75849b', '', '2010-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `piutang_biaya`
--

CREATE TABLE IF NOT EXISTS `piutang_biaya` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `jml_biaya` varchar(15) NOT NULL,
  `jml_terbayar` varchar(15) NOT NULL,
  `jml_piutang` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang_biaya`
--

INSERT INTO `piutang_biaya` (`kd`, `kd_tapel`, `kd_progdi`, `kd_kelas`, `jenis`, `jml_biaya`, `jml_terbayar`, `jml_piutang`) VALUES
('1c1a61da18a0c5769a0958bac56f5669', '1aafa578cf4790a11ecac346fc6d5aa4', '87dc9ca9590feba8706c15fbd43d6e12', 'c4ca4238a0b923820dcc509a6f75849b', ' [].', '0', '', '0'),
('1c1a61da18a0c5769a0958bac56f5669', '1aafa578cf4790a11ecac346fc6d5aa4', '87dc9ca9590feba8706c15fbd43d6e12', 'c4ca4238a0b923820dcc509a6f75849b', '', '', '', '0'),
('63d9edad12c4d39a138e5d10a4e58ec7', '1aafa578cf4790a11ecac346fc6d5aa4', '87dc9ca9590feba8706c15fbd43d6e12', 'c81e728d9d4c2f636f067f89cc14862c', ' [].', '0', '', '0'),
('63d9edad12c4d39a138e5d10a4e58ec7', '1aafa578cf4790a11ecac346fc6d5aa4', '87dc9ca9590feba8706c15fbd43d6e12', 'c81e728d9d4c2f636f067f89cc14862c', '', '', '', '0'),
('38970c6369e3833f9e1e95eaa13195d4', '1aafa578cf4790a11ecac346fc6d5aa4', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', ' [].', '0', '', '0'),
('38970c6369e3833f9e1e95eaa13195d4', '1aafa578cf4790a11ecac346fc6d5aa4', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '', '', '', '0'),
('20c1b2531a189bf7a688e6884672bbea', '1aafa578cf4790a11ecac346fc6d5aa4', '7619ed9df8e6e190c2c758ab3cf71211', 'c81e728d9d4c2f636f067f89cc14862c', ' [].', '0', '', '0'),
('20c1b2531a189bf7a688e6884672bbea', '1aafa578cf4790a11ecac346fc6d5aa4', '7619ed9df8e6e190c2c758ab3cf71211', 'c81e728d9d4c2f636f067f89cc14862c', '', '', '', '0'),
('a642168718a4bee79433db5888f19a7e', '1aafa578cf4790a11ecac346fc6d5aa4', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', ' [].', '0', '', '0'),
('a642168718a4bee79433db5888f19a7e', '1aafa578cf4790a11ecac346fc6d5aa4', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '', '', '', '0'),
('e16f31acfb988ce3f983d9e96a7cf1fa', '1aafa578cf4790a11ecac346fc6d5aa4', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c81e728d9d4c2f636f067f89cc14862c', ' [].', '0', '', '0'),
('e16f31acfb988ce3f983d9e96a7cf1fa', '1aafa578cf4790a11ecac346fc6d5aa4', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c81e728d9d4c2f636f067f89cc14862c', '', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `set_krs`
--

CREATE TABLE IF NOT EXISTS `set_krs` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `kd_ruang` varchar(50) NOT NULL,
  `kd_smt_jns` varchar(1) NOT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'false',
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_krs`
--

INSERT INTO `set_krs` (`kd`, `kd_tapel`, `kd_progdi`, `kd_kelas`, `kd_ruang`, `kd_smt_jns`, `status`, `postdate`) VALUES
('56723b761453b39b547f59f19f5cca97', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'e8bdaca39d6b99fa04d51687eb8b2f25', '2', 'false', '2011-05-12 10:53:29'),
('fbf710f73ce943101d046cd7db2e02ef', 'bddff5ad954302e7bcad29460998d7d2', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'fac29fcf7c9029bc39f07c06ed65cc89', '1', 'true', '2011-05-12 10:13:40'),
('a321b80a06efb3e8c9fa3ab20c4bbf8e', '1e5c4a11abd3c9058f0f683c06a4cdd8', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'e8bdaca39d6b99fa04d51687eb8b2f25', '1', 'true', '2012-03-25 15:09:39'),
('cb37c490d4553377947d533789a80cba', 'de8ac090ad37465c6ef869b330fbd8ea', '451b0c8b0e27e066606115541c25af08', 'c4ca4238a0b923820dcc509a6f75849b', 'e8bdaca39d6b99fa04d51687eb8b2f25', '1', 'true', '2012-03-25 15:11:12'),
('f92e1eb2dd522a6b61751fa6ba69e335', 'de8ac090ad37465c6ef869b330fbd8ea', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'e8bdaca39d6b99fa04d51687eb8b2f25', '1', 'true', '2014-02-01 11:45:00'),
('a6e007ace2a41a91d1f721adeadf5bdb', 'ff0fd61808eb81b81f49c5caa6eaf501', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '40d844f45a857a8bf376f3bad4387606', '1', 'true', '2014-04-09 04:32:43'),
('bd0de7296cb2287044825dbb773b38ab', 'ff0fd61808eb81b81f49c5caa6eaf501', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '49362f0c41486efe2eeac6a0f6a85f8c', '1', 'false', '2014-04-14 04:58:29'),
('45096f27e7c65edbaaa03f943e1631b2', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'b7e31e733b1c278fe4888757c768488b', '1', 'true', '2014-05-13 04:36:03'),
('8625f6b070304fe3609c688855bd359c', '6991e9af2a0ee6ba8b4436f3048af9b0', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'b7e31e733b1c278fe4888757c768488b', '1', 'true', '2014-05-18 01:13:53'),
('325b3d506e6765130e7368b5dc1551ac', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '260479e7010fae5028a3defaa4d2b1c1', '2', 'true', '2015-01-07 00:15:55'),
('852a989082fc34cc7030f2885fe86f1b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '853751e35e18db621d7fa50fbfa748a3', '2', 'true', '2015-07-09 01:46:11'),
('d9ee75fc3b289b0db3d20e7f03c11e28', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'da25d56292baf0d547e88eecee670119', '2', 'true', '2015-01-07 00:16:31'),
('2d603d0f6d9a5c8e826e23ade1229f3c', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '250607fec4f6b0a96c0b583d6900214e', '2', 'true', '2015-01-07 00:16:44'),
('401ffd66050959c3ee37eb4b5a2272e8', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '86a5b147360532219e0602772ece9a76', '2', 'true', '2015-04-06 03:56:30'),
('0fade6c510d8eb535a92f7f629a97941', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '35865cd679c1d30759d6ed35e829acc2', '2', 'true', '2015-01-07 00:17:00'),
('e86636f828520c6597fe21f1a119a9eb', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '1b7a3a12be656f5b935f2a6927341a0f', '2', 'true', '2015-01-07 00:17:08'),
('a2d0983d1b1a4e6a291f7c8c24639ba4', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '1f8faf4fe55be9cf15c02b7daf5eb0a6', '2', 'true', '2015-01-07 00:17:15'),
('614544adfb0a3c2e0549d39be100e571', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'e8bdaca39d6b99fa04d51687eb8b2f25', '2', 'true', '2015-01-07 00:17:35'),
('76d4d8a6ee34d80644d695d5c6bed1bd', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'fac29fcf7c9029bc39f07c06ed65cc89', '2', 'true', '2015-01-07 00:17:42'),
('2fac950ef2ef8ff9fb02018565897537', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'b7e31e733b1c278fe4888757c768488b', '2', 'true', '2015-01-07 00:17:48'),
('757300ffd76e02201b2ce53e047a4523', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'f376a33118bcbebf20f708bb3366da61', '2', 'true', '2015-01-07 00:17:54'),
('94eb02b0fd4fe627c2f41cac7a7f85c6', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'cfc88cef30aa7951ab7735b863029a54', '2', 'true', '2015-01-07 00:18:01'),
('28e5a9b74719547885846a42dc5794d8', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'cfc14d4692a02141116ceafd07a6c66d', '2', 'true', '2015-01-07 00:18:08'),
('437411d4213499167ca8f43cf5e1084b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'acd105d0d91894155e00b67b333aa81d', '2', 'true', '2015-01-07 00:18:14'),
('899ea4d4a9edc87ab2e86787490a5f41', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '7363c198f5fb92b376dc5df903d1fa77', '2', 'true', '2015-01-07 00:18:22'),
('7073d8e5110a7a4ceb6fe2c7dc43a076', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ee79bf595f58f6c1d1ef14fbc35d8424', '2', 'true', '2015-01-07 00:18:31'),
('01d03dadccb48bb9406542881eca77a0', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '9b961a1be2d7f5e02030537ad4f02ee3', '2', 'true', '2015-01-07 00:18:38'),
('c9af1099ffe869b4b414de564914d139', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'd9ca53883cbf5367b31f35860108152d', '2', 'true', '2015-01-07 00:18:46'),
('e3cc99ff1c093cd3916dd71f18e951b4', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'f144be0f0597a452f74fa6362665fd9a', '2', 'true', '2015-01-07 00:18:54'),
('b995cece605207e9eff23db23af9844b', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'fa4ec6c6f7c28cddc98a26b73b82a1e0', '2', 'true', '2015-01-07 00:19:00'),
('36a7e4e9dc23bdec9548c9aa1efaaa97', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '49362f0c41486efe2eeac6a0f6a85f8c', '2', 'true', '2015-01-07 00:19:08'),
('d9654236b2ce14789953631cb4b7d08c', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'b550f96e06fd0792c91ddc7e8679262e', '2', 'true', '2015-01-07 00:19:18'),
('268dbe8da45b2bc284083d13f6676dfc', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '40d844f45a857a8bf376f3bad4387606', '2', 'true', '2015-01-07 00:19:25'),
('b36d41c03b4d209113f90477f9d3ae9a', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '2bbff6289cd9859791bd201e93d9c37e', '2', 'true', '2015-01-07 00:19:32'),
('a22a2e6f2760163af3c52d4822a5e015', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'b690f2a0ff679104ffce5e66275df18b', '2', 'true', '2015-01-07 00:19:40'),
('cabc44fdc7a9eecf1eb75e3cd6cfc80a', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'ca4572bc2eaf6efbb445875b4a82ddf9', '2', 'true', '2015-01-07 00:19:48'),
('b0bfb18d541eeef82bfc2c25b5f82fd5', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', 'b0f9a03f5e739b196ab02667bda3eb95', '2', 'true', '2015-01-07 00:19:54'),
('9cb27d16b9a8875e78cbdc6965fa1a41', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '98a9470b0e6fb8ea5b5b819927dd8b16', '2', 'true', '2015-01-07 00:20:01'),
('3c93c4301346fbb8f97469b688451741', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '0ea59e0025e840429cb61f65c20bdc86', '2', 'true', '2015-01-07 00:20:10'),
('733807d203b2855177cdf4f6736d1f5a', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '086bb2bb780bbae2951dcf4916b8ea41', '2', 'true', '2015-01-07 00:20:17'),
('7ac304f4ea2b885a20e321c1fe156007', '1aafa578cf4790a11ecac346fc6d5aa4', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '843e07b5bf91811562b546249e56b862', '1', 'true', '2015-06-11 04:44:47'),
('d73bd1cd3d54b0e11ea71a0162253f20', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '0a2efe3fbea5a0b11f27f4371b3bdbf0', '1', 'true', '2015-07-09 01:49:59'),
('9413f798156790a9d19afcdf2a00a699', '1aafa578cf4790a11ecac346fc6d5aa4', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', 'cc3e2f0c461d76425055deef36955645', '1', 'true', '2015-09-17 10:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `set_rumus`
--

CREATE TABLE IF NOT EXISTS `set_rumus` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_progdi` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL,
  `persen_absensi` varchar(5) NOT NULL,
  `persen_tugas` varchar(5) NOT NULL,
  `persen_uts` varchar(5) NOT NULL,
  `persen_uas` varchar(5) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_rumus`
--

INSERT INTO `set_rumus` (`kd`, `kd_tapel`, `kd_progdi`, `kd_kelas`, `persen_absensi`, `persen_tugas`, `persen_uts`, `persen_uas`, `postdate`) VALUES
('3110404188eaefbdb7621614267913c9', 'ff0fd61808eb81b81f49c5caa6eaf501', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '15', '15', '30', '40', '2014-07-07 08:23:29'),
('f49b9a310aae74ed8284342a4bdd5e8d', 'ff0fd61808eb81b81f49c5caa6eaf501', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '15', '15', '30', '40', '2014-07-07 08:23:29'),
('e5a68c3ee05cb187a4f81d500fd95dda', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '15', '15', '30', '40', '2014-07-08 04:07:05'),
('8ac432c9f198ec7e3e46e065f6c282ca', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '15', '15', '30', '40', '2014-07-08 04:07:05'),
('7f0b5b53b4be341b2d460fe72a66d8fa', '6991e9af2a0ee6ba8b4436f3048af9b0', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '15', '15', '30', '40', '2014-07-08 04:07:18'),
('cf2d1a1d526a0dc613387fe2bbe382c3', '6991e9af2a0ee6ba8b4436f3048af9b0', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '15', '15', '30', '40', '2014-07-08 04:07:18'),
('f26027745c67e0cad9d86552b8762a5c', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '10', '20', '30', '40', '2015-06-22 03:30:54'),
('564049a4cf60ac4fea57539c071143ea', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '10', '20', '30', '40', '2015-06-22 03:30:54'),
('4cbc135862e9b9337d5e06499337d9ed', '431380af448b936cd22b26edbb0f11a2', '7619ed9df8e6e190c2c758ab3cf71211', 'c81e728d9d4c2f636f067f89cc14862c', '15', '15', '30', '40', '2014-07-08 04:07:50'),
('1e0e765db5339c640d6dc3e654c2c8a4', '431380af448b936cd22b26edbb0f11a2', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c81e728d9d4c2f636f067f89cc14862c', '15', '15', '30', '40', '2014-07-08 04:07:50'),
('16904c3bdea9eac8451728c3de7fe733', '6991e9af2a0ee6ba8b4436f3048af9b0', '7619ed9df8e6e190c2c758ab3cf71211', 'c81e728d9d4c2f636f067f89cc14862c', '15', '15', '30', '40', '2014-07-08 04:08:02'),
('31aa445e62958909e3cf058dd89b0ada', '6991e9af2a0ee6ba8b4436f3048af9b0', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c81e728d9d4c2f636f067f89cc14862c', '15', '15', '30', '40', '2014-07-08 04:08:02'),
('326d3276e76070691d00691140e35c1e', 'ff0fd61808eb81b81f49c5caa6eaf501', '7619ed9df8e6e190c2c758ab3cf71211', 'c81e728d9d4c2f636f067f89cc14862c', '15', '15', '30', '40', '2014-07-08 04:08:13'),
('28ab6607c0068a7f91e97f63fd5974eb', 'ff0fd61808eb81b81f49c5caa6eaf501', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c81e728d9d4c2f636f067f89cc14862c', '15', '15', '30', '40', '2014-07-08 04:08:13'),
('4829e237ee04c791a52102c9570023e3', 'eb097da23b4aec62d72d985a63ce2807', '7619ed9df8e6e190c2c758ab3cf71211', 'c81e728d9d4c2f636f067f89cc14862c', '15', '15', '30', '40', '2014-07-10 01:39:13'),
('72b5de3d95e29288bf7b4bd7dac717c7', 'eb097da23b4aec62d72d985a63ce2807', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c81e728d9d4c2f636f067f89cc14862c', '15', '15', '30', '40', '2014-07-10 01:39:13'),
('a4b15fa37addd4041c0da585ddeb244c', 'eb097da23b4aec62d72d985a63ce2807', '97e02eaa554d4b51216498f3ac1f08a2', 'c4ca4238a0b923820dcc509a6f75849b', '15', '15', '30', '40', '2014-07-10 01:38:37'),
('66c71662c8089de3177c7caa4bd6681a', 'eb097da23b4aec62d72d985a63ce2807', 'bd3f128128ec69173cbc455bfa82c168', 'c4ca4238a0b923820dcc509a6f75849b', '15', '15', '30', '40', '2014-07-10 01:38:37'),
('a5d1a42adcd7b560a60579419a880ba3', 'eb097da23b4aec62d72d985a63ce2807', '97e02eaa554d4b51216498f3ac1f08a2', 'c81e728d9d4c2f636f067f89cc14862c', '15', '15', '30', '40', '2014-07-10 01:39:13'),
('8221316c5d6652d1060bf14c0bd50ce9', 'eb097da23b4aec62d72d985a63ce2807', 'bd3f128128ec69173cbc455bfa82c168', 'c81e728d9d4c2f636f067f89cc14862c', '15', '15', '30', '40', '2014-07-10 01:39:13'),
('17ee00b821394383fdc5b94203644d4d', '1aafa578cf4790a11ecac346fc6d5aa4', '87dc9ca9590feba8706c15fbd43d6e12', 'c4ca4238a0b923820dcc509a6f75849b', '', '', '', '', '2015-09-18 05:05:10'),
('b75bfd9abb8c4fad5ad94d1e15c18eff', '1aafa578cf4790a11ecac346fc6d5aa4', '7619ed9df8e6e190c2c758ab3cf71211', 'c4ca4238a0b923820dcc509a6f75849b', '', '', '', '', '2015-09-18 05:05:10'),
('6ab11e635b88609cd9cdd55f3640c32a', '1aafa578cf4790a11ecac346fc6d5aa4', 'a313b78f7be3efd5f3f9e0d627703ee6', 'c4ca4238a0b923820dcc509a6f75849b', '20', '20', '30', '30', '2015-09-18 05:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE IF NOT EXISTS `surat_keluar` (
  `kd` varchar(50) NOT NULL,
  `no_urut` varchar(10) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `tgl_surat` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `kd_lemari` varchar(50) NOT NULL,
  `kd_rak` varchar(50) NOT NULL,
  `kd_ruang` varchar(50) NOT NULL,
  `kd_sifat` varchar(50) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `tembusan` varchar(255) NOT NULL,
  `tgl_deadline_balas` date NOT NULL,
  `balas` enum('true','false') NOT NULL DEFAULT 'false',
  `ket` varchar(255) NOT NULL,
  `kd_status` varchar(50) NOT NULL,
  `kd_klasifikasi` varchar(50) NOT NULL,
  `kd_map` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`kd`, `no_urut`, `no_surat`, `tujuan`, `tgl_surat`, `perihal`, `tgl_kirim`, `kd_lemari`, `kd_rak`, `kd_ruang`, `kd_sifat`, `lampiran`, `tembusan`, `tgl_deadline_balas`, `balas`, `ket`, `kd_status`, `kd_klasifikasi`, `kd_map`) VALUES
('854165bba3ccfd045bc80f00d355944e', '1', '4545xgmringx6363xgmringxreyedfgxgmringxdfgerxgmringxyrt', 't', '2016-02-16', 'y', '2000-02-15', '4b1c8fa9d0227614028982dcb05699ab', '3d03328f7a96cb203dd44163508e4b25', '14f2a6112d389b3ef5be1b070341efcb', 'dcc6fa74749530f5f284efedbfb84d9c', 'u', 'i', '0000-00-00', 'true', 'd sdg sxgmringxdg sdg sxgmringxdgxgmringxsd gsdxgmringxg sdxgmringxgxgmringxsd gxgmringxsdg xgmringxdsg xgmringx', 'b7ebb4e54a10e6d25604960839ab9f07', '6c4653c2c8b20c0602685c0d6bd0d602', '09e6aff8f9c1185cac15f760d5254b2e');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar_disposisi`
--

CREATE TABLE IF NOT EXISTS `surat_keluar_disposisi` (
  `kd` varchar(50) NOT NULL,
  `kd_surat` varchar(50) NOT NULL,
  `tgl_selesai` date NOT NULL,
  `isi_yayasan` varchar(255) NOT NULL,
  `isi_lembaga` varchar(255) NOT NULL,
  `diteruskan` varchar(255) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `kepada` varchar(100) NOT NULL,
  `pengesahan` enum('true','false') NOT NULL DEFAULT 'false',
  `pengirim` varchar(100) NOT NULL,
  `no_agenda` varchar(255) NOT NULL,
  `tgl_dijawab` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar_disposisi`
--

INSERT INTO `surat_keluar_disposisi` (`kd`, `kd_surat`, `tgl_selesai`, `isi_yayasan`, `isi_lembaga`, `diteruskan`, `tgl_kembali`, `kepada`, `pengesahan`, `pengirim`, `no_agenda`, `tgl_dijawab`) VALUES
('c7e13b9d93da3d4f14baa778d435f6ac', '854165bba3ccfd045bc80f00d355944e', '2017-02-15', 'd sdg sdg', 'eeeeeeee', '', '0000-00-00', '', 'false', 'sd sdg', 'sd sggggg', '2016-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE IF NOT EXISTS `surat_masuk` (
  `kd` varchar(50) NOT NULL,
  `no_urut` varchar(10) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `tgl_surat` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tgl_terima` date NOT NULL,
  `kd_lemari` varchar(50) NOT NULL,
  `kd_rak` varchar(50) NOT NULL,
  `kd_map` varchar(50) NOT NULL,
  `kd_ruang` varchar(50) NOT NULL,
  `kd_sifat` varchar(50) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `tembusan` varchar(255) NOT NULL,
  `tgl_deadline_balas` date NOT NULL,
  `balas` enum('true','false') NOT NULL DEFAULT 'false',
  `ket` varchar(255) NOT NULL,
  `kd_status` varchar(50) NOT NULL,
  `kd_klasifikasi` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`kd`, `no_urut`, `no_surat`, `asal`, `tujuan`, `tgl_surat`, `perihal`, `tgl_terima`, `kd_lemari`, `kd_rak`, `kd_map`, `kd_ruang`, `kd_sifat`, `lampiran`, `tembusan`, `tgl_deadline_balas`, `balas`, `ket`, `kd_status`, `kd_klasifikasi`) VALUES
('43561128bea37d5b19c78b60f7f00196', '1', 'dsgdsg', 'nknx', 'knkx', '2010-07-02', 'xxx', '2002-03-03', '58623c594db371f0d9dbdfaa85667da6', '3d03328f7a96cb203dd44163508e4b25', '09e6aff8f9c1185cac15f760d5254b2e', '1de06ee72eb752a15d25656a8120e73c', 'c2dd7ddae9f6f3b7aff7c927c6b43b9f', 'knkn', 'knkn', '0000-00-00', 'true', 'nknk', 'b7ebb4e54a10e6d25604960839ab9f07', '83081441521368fcfba137363dff322f'),
('21fbbd8ecea5ea06632a342189e9e9ba', '2', 'ddd', 'lklk', 'nlknlkn', '2010-07-07', 'lknlknl', '2003-07-04', '1318d102ac26ade74b79e54b27fce813', '6e912d5053c681d28493e1245fb3c861', '09e6aff8f9c1185cac15f760d5254b2e', '1de06ee72eb752a15d25656a8120e73c', 'dcc6fa74749530f5f284efedbfb84d9c', 'nlkkln', 'lknlknlk', '0000-00-00', 'false', 'yvjvjh', '72d00626f18492515ae85a2ef50a7a00', 'ddd2dfdc039faf61514bc84ff149ab2e'),
('c524b7afae137c56fac703d339e022f1', '3', '3', '5', '5', '2000-01-01', '6', '2000-01-01', '4b1c8fa9d0227614028982dcb05699ab', '3d03328f7a96cb203dd44163508e4b25', '09e6aff8f9c1185cac15f760d5254b2e', '19c48645e0864e858e3b720d82026f96', 'dcc6fa74749530f5f284efedbfb84d9c', '7', '5', '0000-00-00', '', 'rrr', '019e1e76f3197e32adeaa051131e93bb', '6c4653c2c8b20c0602685c0d6bd0d602'),
('6aa82c2722fe25e5dbe9bb3f3e94d485', '4', 'fdgf', 'sda', 'asda', '2015-06-09', 'asda', '2015-06-14', '58623c594db371f0d9dbdfaa85667da6', '26aef6699466f68a4b34df29189bc288', 'eaeb698f2aa5eb6f40c752c595a179ed', '19c48645e0864e858e3b720d82026f96', 'b0a5dddab32ab6d780ea5bcc2c1721d1', 'df', 'asd', '2015-06-25', 'true', 'asd', 'b7ebb4e54a10e6d25604960839ab9f07', '83081441521368fcfba137363dff322f');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk_disposisi`
--

CREATE TABLE IF NOT EXISTS `surat_masuk_disposisi` (
  `kd` varchar(50) NOT NULL,
  `kd_surat` varchar(50) NOT NULL,
  `tgl_selesai` date NOT NULL,
  `isi_yayasan` varchar(255) NOT NULL,
  `isi_lembaga` varchar(255) NOT NULL,
  `diteruskan` varchar(255) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `kepada` varchar(100) NOT NULL,
  `pengesahan` enum('true','false') NOT NULL DEFAULT 'false',
  `penerima` varchar(100) NOT NULL,
  `no_agenda` varchar(255) NOT NULL,
  `tgl_dijawab` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk_disposisi`
--

INSERT INTO `surat_masuk_disposisi` (`kd`, `kd_surat`, `tgl_selesai`, `isi_yayasan`, `isi_lembaga`, `diteruskan`, `tgl_kembali`, `kepada`, `pengesahan`, `penerima`, `no_agenda`, `tgl_dijawab`) VALUES
('21d91ac87032b7d0f22710ae65debf0c', '43561128bea37d5b19c78b60f7f00196', '0000-00-00', 'xstrix', '', 'xstrix', '0000-00-00', 'xstrix', 'false', '', '', '0000-00-00'),
('85efb267e2e8697227a7f7fda59497da', '21fbbd8ecea5ea06632a342189e9e9ba', '0000-00-00', '', '', 'nlknlkn', '0000-00-00', '', 'true', '', '', '0000-00-00'),
('7692c1c98d9aa16cdb57cf049fa21479', 'c524b7afae137c56fac703d339e022f1', '2014-05-18', 'saf safas', 'safsaf', '', '0000-00-00', '', 'false', 'gsdg', 'sdf', '2009-06-05'),
('3f93a9814ccdccd41ac7f560ff57ca5d', '6aa82c2722fe25e5dbe9bb3f3e94d485', '0000-00-00', '', '', '', '0000-00-00', '', 'false', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `surat_m_klasifikasi`
--

CREATE TABLE IF NOT EXISTS `surat_m_klasifikasi` (
  `kd` varchar(50) NOT NULL,
  `klasifikasi` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_m_klasifikasi`
--

INSERT INTO `surat_m_klasifikasi` (`kd`, `klasifikasi`) VALUES
('83081441521368fcfba137363dff322f', 'Surat Masuk'),
('6c4653c2c8b20c0602685c0d6bd0d602', 'Surat Keluar'),
('a506702068600200a538a9b7d2a543e5', 'IOM');

-- --------------------------------------------------------

--
-- Table structure for table `surat_m_lemari`
--

CREATE TABLE IF NOT EXISTS `surat_m_lemari` (
  `kd` varchar(50) NOT NULL,
  `lemari` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_m_lemari`
--

INSERT INTO `surat_m_lemari` (`kd`, `lemari`) VALUES
('4b1c8fa9d0227614028982dcb05699ab', 'AA1'),
('58623c594db371f0d9dbdfaa85667da6', 'AA2'),
('1318d102ac26ade74b79e54b27fce813', 'AA3'),
('bf334cb04a6515c94535bf5606f48e74', 'AA4');

-- --------------------------------------------------------

--
-- Table structure for table `surat_m_map`
--

CREATE TABLE IF NOT EXISTS `surat_m_map` (
  `kd` varchar(50) NOT NULL,
  `map` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_m_map`
--

INSERT INTO `surat_m_map` (`kd`, `map`) VALUES
('eaeb698f2aa5eb6f40c752c595a179ed', 'MAP01'),
('09e6aff8f9c1185cac15f760d5254b2e', 'MAP02'),
('0ba6d303f8d08f6ead6ec9343e24846e', 'MAP03');

-- --------------------------------------------------------

--
-- Table structure for table `surat_m_rak`
--

CREATE TABLE IF NOT EXISTS `surat_m_rak` (
  `kd` varchar(50) NOT NULL,
  `rak` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_m_rak`
--

INSERT INTO `surat_m_rak` (`kd`, `rak`) VALUES
('26aef6699466f68a4b34df29189bc288', 'RK01'),
('3d03328f7a96cb203dd44163508e4b25', 'RK02'),
('6e912d5053c681d28493e1245fb3c861', 'RK03');

-- --------------------------------------------------------

--
-- Table structure for table `surat_m_ruang`
--

CREATE TABLE IF NOT EXISTS `surat_m_ruang` (
  `kd` varchar(50) NOT NULL,
  `ruang` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_m_ruang`
--

INSERT INTO `surat_m_ruang` (`kd`, `ruang`) VALUES
('19c48645e0864e858e3b720d82026f96', 'RU01'),
('1de06ee72eb752a15d25656a8120e73c', 'RU02'),
('14f2a6112d389b3ef5be1b070341efcb', 'RU03');

-- --------------------------------------------------------

--
-- Table structure for table `surat_m_sifat`
--

CREATE TABLE IF NOT EXISTS `surat_m_sifat` (
  `kd` varchar(50) NOT NULL,
  `sifat` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_m_sifat`
--

INSERT INTO `surat_m_sifat` (`kd`, `sifat`) VALUES
('dcc6fa74749530f5f284efedbfb84d9c', 'Rahasia'),
('c2dd7ddae9f6f3b7aff7c927c6b43b9f', 'Pribadi'),
('b0a5dddab32ab6d780ea5bcc2c1721d1', 'Umum');

-- --------------------------------------------------------

--
-- Table structure for table `surat_m_status`
--

CREATE TABLE IF NOT EXISTS `surat_m_status` (
  `kd` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_m_status`
--

INSERT INTO `surat_m_status` (`kd`, `status`) VALUES
('72d00626f18492515ae85a2ef50a7a00', 'Hilang'),
('1eba8fc2a9b3be92410d2f5f935c8c76', 'Rusak'),
('b7ebb4e54a10e6d25604960839ab9f07', 'Diarsipkan'),
('019e1e76f3197e32adeaa051131e93bb', 'Belum Diproses'),
('3cbc1512d930c8b66be04c66b9886b9b', 'Sedang Diproses');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
