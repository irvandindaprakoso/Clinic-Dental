-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08 Feb 2019 pada 08.19
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vozz`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL,
  `foto_nama` varchar(255) NOT NULL,
  `foto_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto_desc` varchar(255) NOT NULL,
  `pasien_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `invoice_subtotal` int(11) NOT NULL,
  `invoice_discount` int(11) NOT NULL,
  `invoice_total` int(11) NOT NULL,
  `invoice_grandtotal` int(11) NOT NULL,
  `invoice_change` int(11) NOT NULL,
  `invoice_payment` int(11) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `pasien_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_date`, `invoice_subtotal`, `invoice_discount`, `invoice_total`, `invoice_grandtotal`, `invoice_change`, `invoice_payment`, `invoice_number`, `pasien_id`) VALUES
(1, '2019-02-05 22:51:59', 3200000, 0, 3200000, 3200000, 800000, 4000000, '0001', 'A004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoicedetail`
--

CREATE TABLE `invoicedetail` (
  `invoicedetail_id` int(11) NOT NULL,
  `invoicedetail_itemID` int(11) NOT NULL,
  `invoicedetail_quantity` int(11) NOT NULL,
  `invoicedetail_price` int(11) NOT NULL,
  `invoice_number` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoicedetail`
--

INSERT INTO `invoicedetail` (`invoicedetail_id`, `invoicedetail_itemID`, `invoicedetail_quantity`, `invoicedetail_price`, `invoice_number`) VALUES
(1, 24, 1, 800000, '0001'),
(2, 28, 1, 1500000, '0001'),
(3, 26, 1, 900000, '0001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `pasien_id` varchar(11) NOT NULL,
  `pasien_nama` varchar(50) NOT NULL,
  `pasien_tglLahir` varchar(30) DEFAULT NULL,
  `pasien_umur` tinyint(2) DEFAULT NULL,
  `pasien_alamat` text,
  `pasien_jk` enum('P','L') NOT NULL,
  `pasien_telp` varchar(14) DEFAULT NULL,
  `pasien_ortu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`pasien_id`, `pasien_nama`, `pasien_tglLahir`, `pasien_umur`, `pasien_alamat`, `pasien_jk`, `pasien_telp`, `pasien_ortu`) VALUES
('A002', 'Ni Nyoman Ardiani', '24628', 48, 'Celuk Sukawati', 'P', '294690', ''),
('A003', 'Kadek Agus Budayasa', '31609', 31, 'Jl.Raya Celuk', 'L', '81805409697', ''),
('A004', 'Ketut Ardiasa', '27545', 42, 'Celuk', 'P', '81339887686', ''),
('A005', 'Arta', '28312', 0, 'Br. Blangsinga', 'L', '83114807848', ''),
('A006', 'Gusti Ayu Manda Wati', '36457', 18, '', 'P', '82144242030', ''),
('A007', 'Ayu Chyntia Dewi', '33696', 25, 'Br. Kebalian Sukawati', 'P', '89652156627', ''),
('A009', 'Arya.', '40262', 7, '', 'L', '', ''),
('A010', 'Ahmad Saifulah', '35194', 20, 'Lantang Idung', 'L', '', ''),
('A011', 'I Nyoman Angga Darmadi', '35918', 19, 'Br.Tegal Jaya Batubulan', 'L', '85857856046', ''),
('A012', 'Komang Alit Sulistiawati', '31481', 31, 'Banjar Tangsub', 'P', '85339299639', ''),
('A013', 'I Ketut Arta Pande', '', 47, '', 'L', '', ''),
('A014', 'Ni Wayan Anik Meryanti', '', 30, '', 'P', '81936202141', ''),
('A015', 'Agus K', '', 0, 'Jln. Ida Bagus Mantra', 'L', '82339189346', ''),
('A016', 'I Wayan Agus Darmayuda', '33576', 25, 'Br. Telabah Sukawati', 'L', '85739750036', ''),
('A017', 'I GD Arya Suwirtawan', '33922', 25, 'Br. Luglug Ketewel', 'L', '291287', ''),
('A018', 'Made Andre Sastrawan', '40793', 55, 'Jl. Raya Bendul', 'L', '85739948272', ''),
('A019', 'Ni Ketut Anik', '26664', 45, 'Jl. Pengembak gang 1 No 3 Sanur', 'P', '82146325604', ''),
('A020', 'I Komang Ayu Septiari', '34969', 22, 'jl. Raya Batubulan ', 'L', '81236281062', ''),
('A021', 'Aris Saputra ', '35994', 19, 'Celuk', 'L', '81999554353', ''),
('A022', 'Ajik Amo', '', 44, 'Gianyar', 'L', '', ''),
('A023', 'Komang Apriani', '', 31, 'Batubulan', 'P', '87861827242', ''),
('A024', 'Agus Wisnu', '29234', 38, 'Jalan Raya Celuk', 'L', '81933109739', ''),
('A025', 'Artha', '35839', 19, 'Jl.Raya Celuk', 'L', '81246749275', ''),
('A026', 'Putu Adi ', '40079', 8, 'Jl. Raya Celuk', 'L', '', ''),
('A027', 'Ayu Widiani', '28822', 38, 'Jl. Raya Celuk', 'P', '85337003425', ''),
('A029', 'Ida Bagus Adinata', '', 0, '', 'L', '81338110811', ''),
('A030', 'Andre (I Gede Darta Punia)', '29527', 38, 'Jalan Raya Batubulan', 'L', '81236363283', ''),
('A031', 'Adi Putra', '34993', 22, 'jl. Raya Sukawati', 'L', '87861712486', ''),
('A032', 'Ayu Raka', '34953', 22, 'Jl. Raya Sukawati', 'P', '83117969669', ''),
('A033', 'Agus Supartama', '30203', 35, '', 'L', '87833081585', ''),
('A034', 'Komang Artini', '25910', 47, 'Jl. Raya Celuk', 'P', '81999943874', ''),
('A035', 'I Made Ardiana', '', 53, 'Jalan Raya Celuk', 'L', '85935303061', ''),
('A036', 'Agustini', '30590', 35, 'Jl. Raya Celuk', 'P', '81353341940', ''),
('A037', 'Anisetiawati Ni Ketut', '34747', 23, 'Batuyang', 'P', '', ''),
('A039', 'Putu Andika Putra', '35002', 23, 'Jl. Raya Celuk', 'L', '89669974967', ''),
('A040', 'Astiti', '29190', 40, 'Jl. Raya celuk', 'P', '87860963892', ''),
('A042', 'Anisa Fitria', '35113', 22, 'Jl.SMKI', 'P', '81246390406', ''),
('A043', 'Putu Arya Kurniata', '27943', 42, '', 'L', '81916113445', ''),
('A044', 'Arya Purnama Dewi', '36044', 0, '', 'P', '83114961376', ''),
('A045', 'Made Gede Artika Putra Arjaya', '38882', 11, 'Jl. Raya celuk', 'L', '81910642888', ''),
('A047', 'Putu Adi Wartini', '26021', 46, 'Jl. Raya Celuk', 'P', '81338774929', ''),
('A048', 'Ana Farlonah', '', 0, '', 'L', '', ''),
('A049', 'Agung Yuda', '32868', 29, 'Jl. Raya Celuk', 'L', '', ''),
('A052', 'Adelia', '', 7, 'Tegal Tamu', 'P', '', ''),
('A053', 'Luh Ari Trisna Putri', '33660', 26, 'Jl. Raya Guwang', 'P', '81916150833', ''),
('A054', 'Ketut Ariani', '25486', 48, 'Jl. Raya Cemenggaon', 'P', '81338128155', ''),
('A055', 'Afdul Alif', '28125', 42, '', 'L', '', ''),
('A056', 'Ayu Wane', '32776', 29, 'Jl. Raya Singapadu', 'P', '82146436143', ''),
('A057', 'Nyoman Ariani', '', 0, 'Jl. Batuyang', 'P', '', ''),
('A058', 'Aira', '40618', 7, '', 'P', '', ''),
('A059', 'I Gede Arya Danu Palguna', '', 27, '', 'L', '85737288834', ''),
('A060', 'Agus', '', 0, '', 'L', '', ''),
('A061', 'Made Ayu Dwipayanti', '39046', 12, 'Jalan Raya Celuk', 'P', '', ''),
('A062', 'Ni Kadek Ariska Yanti', '34364', 24, 'Sukawati', 'P', '81237780378', ''),
('A063', 'Pak Andi', '25677', 48, 'Jalan Raya By Pass', 'L', '', ''),
('A065', 'Gusti Ngurah Aditya M Putra', '38958', 12, '', 'L', '', ''),
('A066', 'Nyoman Ariani', '', 45, 'Jalan Raya Celuk', 'L', '', ''),
('A068', 'Ayu Darningsih', '', 0, '', 'P', '', ''),
('A069', 'Nyoman Ariana', '', 53, '', 'L', '', ''),
('A070', 'Adi Sundara', '34939', 23, 'Jalan raya Tewel', 'L', '85738424519', ''),
('A071', 'Andika', '', 22, 'Jalan raya Celuk', 'L', '87861394666', ''),
('A072', 'Komang Amelia', '41190', 6, 'Jalan Raya Batubulan', 'P', '', ''),
('A073', 'Kadek Ana', '', 24, 'Jalan Raya Batubulan', 'P', '', ''),
('A074', 'Asih', '', 19, 'Jalan Raya Celuk', 'P', '87860228026', ''),
('A076', 'Komang Astiti ', '', 33, 'Celuk', 'P', '', ''),
('A077', 'Ida Bagus Anggara', '29383', 38, 'Jalan Semangka Griya Purnama', 'L', '', ''),
('A078', 'Komang Arya Sudiartha', '35653', 21, 'Sukawati', 'L', '87861415115', ''),
('A079', 'Nyoman Astika', '28894', 38, 'Jalan Raya Penatih', 'L', '85237111876', ''),
('A080', 'Ariana', '28855', 40, 'Jalan Raya Batubulan', 'L', '81353370887', ''),
('A081', 'Ni Putu Aprilia Dewi', '38830', 12, 'Banjar Tegaljaya Batubulan', 'P', '', ''),
('A083', 'I Wayan Ananto', '', 0, 'Sukawati', 'L', '89626435563', ''),
('A085', 'Kadek Andika', '38756', 12, '', 'L', '', ''),
('A086', 'Anak Agung Putra', '34981', 23, 'Batuan', 'L', '81585539833', ''),
('A087', 'I Kadek Angga Wirasatya', '36865', 18, 'Guwang', 'L', '82109145214', ''),
('B001', 'Budiarta', '', 47, 'Sukawati', 'L', '81916621649', ''),
('B004', 'I Made Bagus Ramteja', '39731', 0, 'Tangsub', 'L', '81236900859', ''),
('B006', 'Bhagawan Sukawati', '26902', 43, 'Sukawati', 'L', '85197030703', ''),
('B007', 'I A Made Budiasih', '28586', 39, 'Jl.Batur no 2 Sanur', 'P', '8918555537', ''),
('B008', 'I Wayan budiasa', '30223', 35, 'Br.Kebalian Sukawati', 'L', '', ''),
('B010', 'Made Bite', '', 0, 'Tampaksiring', 'L', '', ''),
('B011', 'Bintang', '38387', 11, 'Jl. Subak Mungkul', 'P', '', ''),
('B012', 'Bram', '34538', 23, 'Jl. Raya Gianyar', 'L', '85212606039', ''),
('B013', 'Bli Sugi', '', 0, '', 'L', '', ''),
('B014', 'Made Bawa', '27283', 43, 'Jalan raya Singapadu', 'L', '81337976713', ''),
('B015', 'I Putu Bayu Pramana', '39129', 10, '', 'L', '', ''),
('B016', 'I Made Budi Mastika', '33037', 27, 'jl. Raya Batubulan ', 'L', '89678123961', ''),
('B017', 'Ketut Bella ', '40843', 7, '', 'P', '', ''),
('B018', 'I Ketut Balik', '', 0, 'Ketewel', 'L', '', ''),
('B019', 'I Wayan Badra', '', 65, 'Jalan Raya Guang', 'L', '', ''),
('B020', 'Nyoman Gede Badra Sukaya', '', 65, 'Jalan Raya Celuk', 'L', '', ''),
('B021', 'Bu Gung', '', 0, 'Tohpati', 'P', '', ''),
('B023', 'Bu Arik', '', 0, '', 'P', '', ''),
('B024', 'Bu Guru Ray Muna', '', 0, '', 'P', '', ''),
('B025', 'Bli Yedi', '', 52, 'Jalan Raya Tohpati', 'L', '', ''),
('B026', 'Bu Dewa Swidia', '', 0, 'Jalan Raya Tewel', 'P', '', ''),
('B027', 'Made Bagus Rama Teja ', '39792', 10, 'Celuk', 'L', '', ''),
('B028', 'Budiawan', '', 23, 'Jalan raya Ubud', 'L', '', ''),
('B029', 'Ni Putu Bella Fridayanthi', '37960', 15, 'Banjar Kapal Batubulan', 'P', '81999745050', ''),
('B030', 'Komang Bagus Sinar Widiasal', '38284', 14, 'Jl. Raya Celuk', 'L', '', ''),
('B048', 'I Gede Dananjaya Putra', '39993', 7, '', 'L', '', ''),
('C001', 'Cok Istri Agung Sapta Dewi', '30773', 33, 'Nyalian Klungkung', 'P', '85792212219', ''),
('C002', 'Citra Tanayasi Putu', '', 7, '', 'P', '', ''),
('C003', 'Corry', '', 0, '', 'P', '', ''),
('C004', 'Candriasih Made', '', 49, 'Celuk', 'P', '87860471797', ''),
('C005', 'Chyntia Nur Fitriana', '34605', 24, 'Celuk', 'P', '85737377727', ''),
('C006', 'Ni Kadek Cahyani', '', 0, 'Batuyang', 'P', '', ''),
('C007', 'Catur Ichwan', '23283', 54, 'Celuk', 'L', '85737377737', ''),
('C008', 'Clara', '38160', 13, '', 'P', '89690359321', ''),
('C009', 'Cahyani Ni Putu Pande', '33487', 25, 'Sukawati', 'P', '8124628065', ''),
('C010', 'Cintia Dewi Gst Ayu', '', 6, '', 'P', '', ''),
('C011', 'Cabi', '', 0, '', 'P', '', ''),
('C012', 'Cristina Novianti', '37189', 16, 'Celuk', 'P', '89670234184', ''),
('C013', 'Cipta Wahyu Ningsih Kadek', '37923', 14, 'Jln. Raya Mas Ubud', 'P', '83846632945', ''),
('D001', 'Dwi Indah Purwani', '31673', 0, 'Br. Delod Tangluk', 'P', '82237448558', ''),
('D002', 'Dian', '', 0, '', 'P', '81999580630', ''),
('D003', 'Ni Wayan Darsini', '18523', 67, 'Celuk', 'P', '8174735404', ''),
('D005', 'Dwaniari Ida Ayu Made', '29036', 37, 'Keramas', 'P', '81337507619', ''),
('D007', 'Made Dura', '', 39, 'Batuyang', 'P', '87762893853', ''),
('D009', 'Dadong Mangku', '', 75, 'Celuk', 'P', '', ''),
('D010', 'Dewa Guna', '', 0, '', 'L', '', ''),
('D011', 'I Wayan Darendra', '38784', 11, 'Celuk', 'L', '', ''),
('D012', 'Dewa   ', '', 0, '', 'L', '', ''),
('D013', 'Danan ', '40263', 7, '', 'L', '', ''),
('D014', 'Desak Putu Soniawati', '', 24, '', 'P', '87761361212', ''),
('D015', 'Dika Apriana wayan', '41749', 12, 'Batuan', 'L', '', ''),
('D016', 'Davin Putra Wirawan I Putu', '40531', 7, '', 'L', '', ''),
('D017', 'Diasmini', '', 48, '', 'P', '8123633205', ''),
('D018', 'Diah', '33735', 25, 'Celuk', 'P', '82231449819', ''),
('D019', 'Dimas Swamandara Taksu', '38761', 11, 'Celuk', 'L', '', ''),
('D020', 'Dwi Adnyana', '33672', 25, 'Batuyang', 'L', '85792898886', ''),
('D021', 'Dania Putri', '40113', 9, '', 'P', '', ''),
('D022', 'Diah Utami', '36782', 16, 'Batuan', 'P', '8987407127', ''),
('D023', 'Gusti Ayu Daeni', '29025', 35, 'Br. Dukuh Pejeng', 'P', '85238102939', ''),
('D025', 'Desak Nyoman Suarti', '19139', 65, 'Celuk', 'P', '8113866636', ''),
('D026', 'Dwi ', '34404', 23, 'Batuan', 'P', '82340396131', ''),
('D027', 'Darma Susila I Made', '24495', 50, 'Sukawati', 'L', '81236770176', ''),
('D028', 'Nyoman Darsa', '', 0, 'Mas Ubud', 'L', '', ''),
('D029', 'Dwi Antari', '', 6, '', 'P', '81999812234', ''),
('D030', 'Desak Putu Arista Dewi', '36225', 18, 'Batuan', 'P', '83114884630', ''),
('D031', 'Danu Prawira ', '41086', 6, 'Singapadu', 'L', '', ''),
('D032', 'Diva Widia Noviana Agung', '37947', 14, 'Batuyang', 'L', '82146426244', ''),
('D033', 'Dedik Upradnyana Putra ', '', 0, '', 'L', '', ''),
('D034', 'Diah Paramita Hari', '30280', 36, 'Celuk', 'P', '811399924', ''),
('D035', 'Dewa Ayu K Dewi', '', 34, '', 'P', '', ''),
('D036', 'Dinda Pradnya Dita', '37257', 16, 'Celuk', 'P', '81339479911', ''),
('D037', 'Diah Arini Kadek', '', 55, 'Celuk', 'P', '', ''),
('D038', 'Kadek Diartawan', '', 34, '', 'L', '', ''),
('D039', 'Dani', '', 30, 'Saba', 'L', '81933091807', ''),
('D040', 'Dea Juniari Putu', '41081', 7, '', 'P', '', ''),
('D041', 'Dika Kadek', '', 12, 'Celuk', 'L', '', ''),
('D042', 'Desak made Arita', '', 27, '', 'P', '', ''),
('D043', 'Devi Mahardani', '33620', 26, '', 'P', '81246367910', ''),
('D044', 'Desak Gede Sri Wahyuni', '28770', 38, 'Celuk Sukawati', 'P', '81239293905', ''),
('D045', 'Dimas Satria', '36227', 20, 'Sukawati', 'L', '87730663507', ''),
('D046', 'Dio Angga Kusuma', '38069', 14, 'Buleleng Busungbiu', 'L', '81762033886', ''),
('D047', 'Desak Putu Indah Yani', '26374', 44, 'Buleleng ', 'P', '', ''),
('D048', 'Dananjaya Gede', '29/07/1009', 9, 'Jln. Raya Sukawati', 'L', '', ''),
('D049', 'Darti Ketut', '27582', 43, 'ketewel', 'P', '', ''),
('D051', 'Darma Santana Komang', '29372', 38, 'Celuk', 'L', '87862022600', ''),
('D052', 'Diah Arsita Dewi Arta Kadek', '38980', 12, 'Celuk', 'P', '85237182112', ''),
('E002', 'Edi', '', 0, 'Tohpati', 'L', '8123643426', ''),
('E003', 'Egi Giri Semadi', '34936', 22, 'Batuan', 'L', '81936233100', ''),
('E004', 'Eka Juliartawan', '33080', 27, 'Celuk', 'L', '81999608977', ''),
('E006', 'Eka Amanda', '33584', 25, 'Batuyang', 'P', '8179873383', ''),
('E008', 'Ema', '31706', 32, '', 'P', '81338193769', ''),
('E009', 'Komang Era Kusumadewi', '32315', 29, 'Batubulan', 'P', '81916113445', ''),
('E010', 'Eka Shadyarini', '', 31, '', 'P', '', ''),
('E011', 'Ernawati', '29131', 39, 'Celuk', 'P', '', ''),
('E012', 'I Komang Edi Suhendra P.', '33856', 25, 'Br. Bendul Batubulan', 'L', '83114528571', ''),
('E014', 'Kadek Eri', '', 32, 'Sukawati', 'P', '', ''),
('E015', 'Gede Eka', '', 32, '', 'L', '', ''),
('E017', 'Edi', '', 28, 'Sukawati', 'L', '', ''),
('E018', 'Wayan Eka Suseni', '', 41, 'Batuyang', 'P', '', ''),
('E019', 'Kadek Evirasanti', '30385', 35, 'Batuan', 'P', '', ''),
('E020', 'Eka Sudiari', '', 31, '', 'P', '', ''),
('E021', 'I Gede Ekayana', '', 19, 'Singapadu', 'L', '87765301528', ''),
('E022', 'Kadek Eka Putra', '', 40, 'Celuk', 'L', '', ''),
('E023', 'Edo Aria Kumara', '35094', 22, 'Celuk', 'L', '81999521304', ''),
('E025', 'Erlina', '32791', 27, 'Celuk', 'P', '85222853888', ''),
('E026', 'Elice Mimba', '32259', 28, 'Legian Kuta', 'P', '8970219608', ''),
('E028', 'Elik', '29477', 38, 'Sukawati', 'P', '82110871290', ''),
('E029', 'Eliana Komang', '31837', 31, 'Singapadu', 'L', '81760111902', ''),
('F001', 'Fathur', '34539', 23, 'Banjar Blumpang Sukawati', 'P', '83119333628', ''),
('F002', 'Floren Yuliana', '', 53, 'Celuk', 'P', '', ''),
('F003', 'Famela', '41395', 5, 'Singapadu', 'P', '85606160059', ''),
('F004', 'Farel', '40831', 6, '', 'L', '85235480283', ''),
('F006', 'Febry ', '30738', 33, 'Gatot Subroto', 'P', '87860779090', ''),
('G001', 'Gst. Ayu Km. Indrawati', '40721', 5, '', 'P', '81936531285', ''),
('G002', 'Gede Eka Lantana', '35899', 18, 'Br. Kemenuh Kangin', 'L', '87862198107', ''),
('G003', 'I Gusti Ketut Tantera', '19359', 54, 'Jl. Bypass Ngr. Rai No. 343', 'L', '81337293006', ''),
('G004', 'Gst. Pt. Wati', '', 0, 'Cemenggaon', 'P', '', ''),
('G005', 'Gusti Ayu Putu Restiari', '35094', 22, 'Tangsub', 'P', '85792482713', ''),
('G007', 'Komang Guna', '39872', 8, '', 'L', '', ''),
('G008', 'Gek Intan', '37827', 13, 'Br. Tangsub Celuk Sukawati', 'P', '83119956001', ''),
('G009', 'A.A. Istri Gunawati ', '33992', 24, 'Singapadu', 'P', '87760387495', ''),
('G010', 'Gst. Ngr. Jelantik Yuda', '34621', 22, 'Saba Blahbatuh', 'L', '89689977011', ''),
('G011', 'Gede Eka Januarta', '40915', 5, 'Celuk', 'L', '85953898740', ''),
('G012', 'Gung Sri Wahyuni', '25342', 49, '', 'P', '81338587952', ''),
('G013', 'Gita Diantari', '34123', 24, 'Celuk', 'P', '87862981169', ''),
('G016', 'Ni Putu Ayu Galih Ananti Prani Dewi ', '40909', 6, 'Celuk Sukawati', 'P', '', ''),
('G017', 'Garini Cempaka Sari', '38768', 12, 'Celuk', 'P', '', ''),
('G018', 'Gst. Pt. Bengkel Juniana', '31611', 31, 'Celuk', 'L', '81916428208', ''),
('G019', 'G.A. Krisna Dewi ', '32103', 31, 'Celuk', 'P', '81916428208', ''),
('G020', 'Gaura Krisna', '', 0, 'Celuk', 'L', '', ''),
('G021', 'Gusti Ayu Werdi Astiti', '36817', 18, 'Singapadu', 'P', '87861119263', ''),
('G022', 'Wayan Griya', '', 54, 'Blahbatuh', 'L', '', ''),
('G023', 'I Wayan Gustina Anggara', '34555', 24, 'Batuan', 'L', '81246516418', ''),
('G024', 'A.A. Gria', '', 58, 'Batuyang', 'L', '', ''),
('G025', 'Galang Putra', '39613', 10, 'Celuk', 'L', '', ''),
('G026', 'Gusti Ayu Santika ', '31843', 31, 'Celuk', 'P', '', ''),
('G027', 'I Putu Gunawan ', '37103', 17, 'Batubulan', 'L', '89527775314', ''),
('G028', 'Gusti Ngurah Putu Miartha ', '34473', 24, 'Kemenuh', 'L', '', ''),
('G030', 'Gusti Ngurah Arta Wiguna', '40737', 7, 'Br. Telabah Sukawati', 'L', '82247649222', ''),
('G031', 'Gung Aji Griya', '', 0, '', 'L', '', ''),
('G032', 'Anak Agung Gede Winda', '', 38, 'Pejeng', 'L', '', ''),
('G033', 'Gede Gio', '', 6, 'Cemenggaon', 'L', '', ''),
('G034', 'Gusde Yoga', '', 0, '', 'L', '', ''),
('G035', 'Pak Gede', '22696', 55, 'Celuk', 'L', '', ''),
('G037', 'Gusti Bagus Samir', '36270', 19, 'Kemenuh', 'L', '', ''),
('H003', 'Putu Hadi Pradnyana', '35008', 21, 'Celuk', 'L', '85100918937', ''),
('H004', 'Hardia Pt', '40404', 7, 'Br. Gelumpang Sukawati', 'L', '8123641618', ''),
('H005', 'Heelda Chesni', '30233', 36, 'Perum. Griya Kencana', 'P', '81325072888', ''),
('H006', 'Kadek Hariasih', '20454', 65, 'Celuk', 'P', '', ''),
('H007', 'Gst. Ayu Hendrawati', '33312', 26, 'Celuk', 'P', '81237775881', ''),
('H008', 'Ni Made Hita Husmarika ', '35628', 21, 'Mas Ubud', 'P', '895342580767', ''),
('H009', 'Herman', '25185', 49, 'Ketewel', 'L', '81238440356', ''),
('H010', 'Hari Laksmi Santi', '', 26, 'Sukawati', 'P', '811381246', ''),
('H011', 'Hadiriansyah', '26936', 45, 'Singapadu', 'L', '85253728651', ''),
('H012', 'Harianto', '', 31, 'Celuk', 'L', '', ''),
('I002', 'Ilmiati', '35247', 22, '', 'P', '81547602292', ''),
('I003', 'Indriani Wayan', '35262', 22, 'Mas Ubud', 'P', '85737190540', ''),
('I004', 'Indah Saraswati', '39018', 10, '', 'P', '', ''),
('I005', 'Indah Kumala', '35517', 21, 'Celuk', 'P', '82146483316', ''),
('I006', 'Intan Suyudani Ni Putu', '35962', 19, 'Batubulan', 'P', '81338069165', ''),
('I007', 'Ita Ida Ayu', '39576', 0, 'Sakah', 'P', '', ''),
('I008', 'Indah Sridewi', '35442', 21, 'Jl. Raya Bypass Ngurah Rai', 'P', '82236901120', ''),
('I009', 'Dek Ita ', '36627', 18, 'Celuk', 'P', '82147877480', ''),
('I010', 'Izar', '41036', 6, '', 'L', '', ''),
('I011', 'Made Isvara Radin Wijaya', '40675', 7, 'Singapadu', 'L', '85239094151', ''),
('I012', 'Ida Bagus Mahardika Wijaya', '', 13, '', 'L', '82144046198', ''),
('I013', 'Ida Ayu Sundarayani', '', 16, '', 'P', '', ''),
('I014', 'Ida Ayu Sudaniwihadi', '', 11, '', 'P', '', ''),
('I015', 'Ibu Anik', '', 40, 'Celuk', 'P', '', ''),
('I016', 'Ida Ayu Wika Putri', '', 28, 'celuk', 'P', '', ''),
('I017', 'Ida Bagus Adi Gunawan ', '34271', 24, 'Celuk Sukawati', 'L', '85239898135', ''),
('I018', 'Ida Bagus Ketut Suardika', '', 48, 'Celuk', 'P', '', ''),
('I019', 'Jaya Mahotama IB Gede', '37291', 18, '', 'L', '81936131298', ''),
('I020', 'Ibu Yani', '21703', 59, 'Celuk', 'P', '361298512', ''),
('J001', 'Jro Mangku Tampiak', '', 55, '', 'L', '', ''),
('J002', 'Juliani Made', '25770', 0, 'Sukawati', 'P', '81338025972', ''),
('J003', 'Jro Ratna', '25418', 0, 'Batuyang', 'P', '81337418912', ''),
('J004', 'Bagus Juliartawan', '32695', 27, 'Jl. Raya Celuk', 'L', '85737176456', ''),
('J005', 'Julia Pertiwi', '33085', 27, 'Jl. Sandat Biaung', 'P', '87860080860', ''),
('J006', 'Jendra', '30526', 0, 'Celuk', 'L', '82315909090', ''),
('J007', 'Juliana Komang', '28324', 40, 'Batubulan', 'L', '81338417694', ''),
('J008', 'Juliarta Wayan', '', 33, 'Sukawati', 'L', '', ''),
('J009', 'Ketut Janu', '40989', 6, 'Celuk', 'L', '', ''),
('J010', 'Wayan Juniartha', '', 41, 'Celuk', 'L', '', ''),
('J011', 'Pak Jare', '', 53, 'Celuk', 'L', '', ''),
('J012', 'Jonathan', '41253', 6, 'Celuk', 'L', '', ''),
('J013', 'Juniari', '35224', 22, 'Ketewel', 'P', '85792049010', ''),
('K001', 'Kita Made', '', 77, 'Celuk', 'L', '', ''),
('K002', 'Kertayasa Wayan', '37100', 16, 'Sukawati', 'L', '85339475934', ''),
('K003', 'Karmini Kadek', '', 52, 'Batuyang', 'P', '811386262', ''),
('K004', 'Kendra', '40871', 6, '', 'L', '', ''),
('K005', 'Kompiang Warti Ida Ayu', '22160', 57, 'Batubulan', 'P', '81917968318', ''),
('K006', 'Krisna', '40334', 8, '', 'P', '', ''),
('K007', 'Komang Susila', '33106', 27, 'Batuyang', 'L', '81936094263', ''),
('K008', 'Keisya Riana Putu', '40122', 8, 'Batubulan', 'P', '', ''),
('K009', 'Kadek Erawati', '26074', 47, 'Sukawati', 'P', '87760405219', ''),
('K010', 'Kanis Nyoman', '', 52, 'Batuyang', 'P', '', ''),
('K011', 'Kadek Arpon', '35003', 23, 'Blahbatuh', 'L', '81999829801', ''),
('K012', 'Karniati', '', 51, '', 'P', '8123853570', ''),
('K013', 'Krisna', '', 8, '', 'P', '', ''),
('K014', 'Ketut Kembar', '', 40, 'Celuk', 'P', '', ''),
('k015', 'Krisna Wati Wayan', '', 46, 'Tohpati', 'P', '', ''),
('K016', 'Kori Artha Gede', '37127', 17, '', 'L', '85738339677', ''),
('K017', 'Kariana Kadek', '', 19, 'Celuk', 'P', '', ''),
('K018', 'Kadek KrIsna Adi Pradana ', '', 10, '', 'L', '', ''),
('K019', 'Kenzo', '37874', 5, 'Sukawati', 'L', '', ''),
('K020', 'Krisnata Adi Putra Kadek', '33222', 27, 'Celuk', 'L', '81933059332', ''),
('K021', 'Karang Gede', '37471', 16, 'Celuk', 'L', '', ''),
('K023', 'Komang Ardana', '30160', 34, 'Br. Palak Sukawati', 'L', '87785533666', ''),
('K024', 'Kumala', '', 40, '', 'P', '82317388673', ''),
('K025', 'Ketut Natih Adi Astawa', '34830', 21, 'Celuk', 'L', '89698496176', ''),
('K027', 'Kadek Ayu Agustini', '30922', 27, 'Celuk', 'P', '81999904456', ''),
('K029', 'Kartika', '35179', 22, 'Sukawati', 'P', '82144976257', ''),
('K032', 'Komang Sariani', '32995', 28, 'Celuk', 'P', '87761222047', ''),
('K033', 'Kumala', '', 42, '', 'P', '', ''),
('K034', 'Kumala', '', 0, '', 'P', '82317388673', ''),
('K035', 'Konten Ibu', '', 61, 'Celuk', 'P', '', ''),
('K036', 'Kasmariani', '24232', 50, '', 'P', '', ''),
('L002', 'Lestari Made', '29051', 39, 'Celuk', 'P', '81558960687', ''),
('L003', 'Lisa', '32739', 28, 'Batubulan', 'P', '', ''),
('L004', 'Lisbelt', '23645', 53, '', 'P', '81338275275', ''),
('L005', 'Lastri', '30469', 34, 'Celuk', 'P', '81999085524', ''),
('L006', 'Lanus', '', 55, 'Tohpati', 'L', '', ''),
('L007', 'Lisna', '29954', 36, 'Celuk', 'P', '8131555241', ''),
('L008', 'Luh Ayu Purnama Setiasari', '40444', 8, 'Celuk', 'P', '', ''),
('L010', 'Londen Wayan', '', 57, '', 'L', '', ''),
('L011', 'Putu Lanang', '', 6, '', 'L', '', ''),
('M001', 'Martining Ni Luh', '27833', 40, 'Celuk', 'P', '81238906990', ''),
('M002', 'Murdiana Wayan', '26495', 45, 'Ketewel', 'L', '811392343', ''),
('M003', 'Mastra Bapak', '1963', 54, 'Celuk', 'L', '', ''),
('M004', 'Mangku Karang', '', 0, '', 'L', '', ''),
('M005', 'Muliartini', '24621', 50, 'Celuk', 'L', '81999048508', ''),
('M006', 'Iin Mbok', '', 35, '', 'P', '', ''),
('M008', 'Mulyawati', '', 50, 'Celuk', 'P', '', ''),
('M009', 'Mustika Wayan', '', 39, 'Batuan', 'L', '81805455983', ''),
('M010', 'Mahesa Putra', '39174', 10, '', 'L', '', ''),
('M011', 'Made Miastri', '20608', 52, 'Bendul', 'P', '', ''),
('M012', 'Muktahir', '34144', 24, 'Singapadu', 'L', '81999478383', ''),
('M013', 'Made Mulyawan', '29371', 37, 'Celuk', 'L', '81337151555', ''),
('M014', 'Meli Anggreni I Dewa Ayu', '39961', 8, 'Celuk', 'P', '85954183138', ''),
('M015', 'Mas Soon', '', 46, 'Sukawati', 'L', '', ''),
('M016', 'Mahendra Ida Bagus', '1953', 63, 'Sukawati', 'L', '', ''),
('M017', 'Matra Wayan', '23858', 52, '', 'L', '81338790331', ''),
('M018', 'Murtini Komang', '33821', 25, 'Batuyang', 'P', '87761081533', ''),
('M019', 'Nasya Ketut', '41765', 4, 'Celuk', 'L', '81239181285', ''),
('M020', 'Mahendra Dewi Gusti Ayu', '33755', 26, 'Buruan', 'P', '82144179851', ''),
('M021', 'Marsya', '40609', 7, 'Sukawati', 'P', '', ''),
('M023', 'Mastika', '25378', 49, 'Celuk', 'L', '811386322', ''),
('M024', 'Maning Made', '', 48, '', 'P', '', ''),
('M025', 'Mbah Ning', '', 38, '', 'P', '', ''),
('M026', 'Mulyawati Nyoman', '27196', 44, 'Tohpati', 'P', '', ''),
('M027', 'Murniati Kadek', '27108', 44, 'Sukawati', 'P', '89651047786', ''),
('M028', 'Wayang Mas Rini', '', 46, 'Celuk', 'P', '', ''),
('M029', 'Melandry', '40671', 7, '', 'P', '', ''),
('M030', 'Merta Wati Kadek', '', 43, 'Celuk', 'P', '', ''),
('M031', 'Mulya Febrianti', '36557', 18, 'Cemenggon', 'P', '89667791019', ''),
('M032', 'Mega Kadek', '', 50, '', 'L', '', ''),
('M033', 'Mahendra Putu Gede', '', 36, 'Celuk', 'L', '', ''),
('M034', 'Mena', '', 22, 'Tohpati', 'P', '', ''),
('M035', 'Kadek Malia', '37159', 16, 'Celuk', 'P', '', ''),
('M036', 'Maya Ningsih', '', 51, 'Batuan', 'P', '81936665321', ''),
('M038', 'Maryono', '', 44, '', 'L', '', ''),
('M039 ', 'Mustika Nyoman ', '', 47, 'Celuk', 'L', '', ''),
('M040', 'Pak Mangku (Wayan Angker)', '', 65, 'Batuyang', 'L', '', ''),
('M041', 'Mutiari Nyoman', '', 32, 'Batuyang', 'P', '', ''),
('M043', 'Luh Murni', '', 56, 'Singapadu', 'P', '', ''),
('M044', 'Mataram Ketut', '', 57, 'Celuk', 'L', '', ''),
('M046', 'Mount Drist Kawan ', '28926', 39, 'Batuan', 'L', '81337033707', ''),
('M047', 'Putu Mudana', '30506', 34, '', 'L', '', ''),
('M048', 'Kadek Mahawira Wisesa', '38073', 14, 'Batuan', 'L', '', ''),
('N001', 'Novi Primentari', '33551', 25, 'Br. Cemenggaon', 'P', '8970219484', ''),
('N002', 'Narji Ketut ', '', 0, '', 'L', '87760396336', ''),
('N003', 'Merry Wayan', '', 35, 'Celuk', 'P', '87860830005', ''),
('N004', 'Nadi Astrini Ketut', '26641', 0, 'Celuk', 'P', '', ''),
('N006', 'Nadia Saras Devi ', '41076', 5, 'Celuk', 'P', '', ''),
('N007', 'Narayanti Ni Wayan', '34667', 0, 'Sukawati', 'P', '81936260911', ''),
('N008', 'Nengah Diah', '', 32, 'Singapadu', 'P', '85238684164', ''),
('N009', 'Nerti Nengah', '32143', 29, '', 'P', '', ''),
('N010', 'Nabila', '41203', 5, '', 'P', '', ''),
('N011', 'Natha', '', 7, '', 'P', '', ''),
('N012', 'Nyeneng Komang', '34097', 24, 'Celuk', 'P', '', ''),
('N013', 'Nisa', '', 27, 'Sukawati', 'P', '81999117334', ''),
('N014', 'Nyoman Putra', '', 49, 'Celuk', 'L', '', ''),
('N015', 'Novilastari Ni Wayan', '35032', 22, 'Guwang', 'P', '83114550386', ''),
('N016', 'Nengah Nurani', '', 49, '', 'P', '', ''),
('N017', 'Bu Nita', '', 33, 'Celuk', 'P', '', ''),
('N020', 'Nengah Widiani', '', 35, 'Bendul', 'P', '', ''),
('N021', 'Natalisa Putri ', '35356', 22, 'Celuk', 'P', '82144046104', ''),
('N022', 'Nardiani Gede', '', 36, 'Batuyang', 'L', '', ''),
('N023', 'Made Nganti', '00/00/1970', 48, '', 'P', '', ''),
('N024', 'Nesti Wayan', '', 38, '', 'P', '818558823', ''),
('N025', 'Nurul', '34093', 25, 'Guwang', 'P', '', ''),
('N026', 'Nyoman Nisa', '', 0, '', 'P', '', ''),
('N027', 'Nopa Riza', '39032', 12, 'Celuk', 'P', '', ''),
('N028', 'Nanda', '41527', 6, 'Celuk', 'P', '89692775996', ''),
('N029', 'Narsya Yunda Pratama Ni Made', '39508', 10, 'Kemenuh', 'P', '81338933581', ''),
('N037', 'Mangku Bawa', '', 52, '', 'L', '', ''),
('O001', 'Oka Putu', '30792', 34, 'Guwang', 'L', '81238391212', ''),
('O002', 'Ostar', '40369', 8, '', 'L', '', ''),
('O003', 'Oktriana', '33880', 26, 'Celuk', 'L', '81916527694', ''),
('P001', 'Putu Aditya Nata', '40658', 6, 'Br. Delod Tangluk', 'L', '81805572571', ''),
('P002', 'Peres Jonedin Tosario', '39948', 0, '', 'L', '', ''),
('P003', 'Prema Nanda Kadek', '39053', 0, 'Pejeng', 'L', '85238109239', ''),
('P004', 'Pudak Ningsih Komang', '26426', 38, 'Celuk', 'P', '87860007164', ''),
('P005', 'Parwati Ni Wayan', '', 0, 'Celuk', 'P', '81337048112', ''),
('P006', 'Ni Nyoman Parini', '28490', 0, 'Celuk', 'P', '', ''),
('P007', 'Wayan Polog', '', 0, '', 'L', '', ''),
('P008', 'Putri Utami Ni Wayan', '', 0, '', 'P', '', ''),
('P009', 'Pani Zaristian Vaspintra', '32309', 28, 'Denpasar', 'L', '817275264', ''),
('P010', 'Pande Putu Pranama', '31190', 32, 'Ubud', 'L', '81916395707', ''),
('P011', 'Pak Nyoman Parweta', '', 0, 'Penatih', 'L', '', ''),
('P012', 'Putu Gede Wisuda Karisma', '', 25, 'Celuk', 'L', '', ''),
('P013', 'Patra', '', 53, 'Batuyang Batubulan', 'L', '811386262', ''),
('P014', 'Putu Purnayasa Ida Bagus', '35099', 21, 'Batubulan', 'L', '85792174438', ''),
('P015', 'Ni Ketut Puriasih', '27759', 42, 'Singapadu', 'P', '87861567350', ''),
('P016', 'Ida Ayu Pramesti', '40823', 6, 'Penatih', 'P', '81236343989', ''),
('P017', 'Putu Arma Rosita Yanti', '34465', 23, 'Celuk', 'P', '87862414012', ''),
('P018', 'Putri Mahandari Ni Kadek', '37537', 0, 'Cemenggaon', 'P', '81936220223', ''),
('P019', 'Puji Arini', '29629', 36, 'Kemenuh', 'P', '81805582181', ''),
('P020', 'Punia Sari Kadek', '34564', 23, 'Celuk', 'P', '87757335694', ''),
('P021', 'Pak Patra', '22824', 56, 'Batuyang', 'L', '81337559777', ''),
('P022', 'Peni Made', '34489', 24, 'Blahbatuh', 'P', '81237367273', ''),
('P023', 'Made Purni', '', 6, 'Celuk', 'P', '81239603999', ''),
('P024', 'Putra Arisana', '', 0, '', 'L', '', ''),
('P025', 'Kadek Putri', '', 31, 'Celuk', 'P', '', ''),
('P026', 'Kadek Perwira Negara', '39667', 10, '', 'L', '', ''),
('P027', 'Putu Agus Surya Antara Putra', '29706', 37, 'Blahbatuh', 'L', '8124652622', ''),
('P028', 'Putri Nindia Daniswara', '40101', 9, 'Trijata', 'P', '', ''),
('P029', 'Purnawati Kadek', '31447', 33, 'sukawati', 'P', '87862955888', ''),
('P031', 'Komang Pande Wirahasdui', '', 10, 'Ketewel', 'L', '87861033414', ''),
('R00', 'Renita', '40285', 8, 'ketewel', 'P', '', ''),
('R001', 'Rezha Pahlevi', '', 0, '', 'L', '', ''),
('R002', 'Reni', '', 0, '', '', '', ''),
('R003', 'Reize Jonedin Rosario Komang', '39956', 8, 'Celuk', 'P', '', ''),
('R004', 'Made Radiana', '1975', 42, 'Celuk', 'L', '81237959575', ''),
('R005', 'Ratna Wati Desak Nyoman', '28854', 39, 'Batubulan', 'P', '81239958674', ''),
('R006', 'Mas Ragil', '29402', 37, 'Singapadu', 'L', '8199922137', ''),
('R007', 'Rianti Komang', '33866', 26, 'Celuk', 'P', '82336956479', ''),
('R008', 'Raden Ibu Ketut', '', 0, 'Guwang', '', '', ''),
('R009', 'Riskia', '32495', 30, 'Br. Gumicik', 'L', '85237785131', ''),
('R010', 'Resin Ketut', '', 50, '', 'P', '', ''),
('R011', 'Putu Riski Aditya Purnama', '39882', 9, 'Tangsub', 'L', '81916655719', ''),
('R012', 'Retno Pituphon', '32228', 30, 'Batubulan ', 'L', '81228255925', ''),
('R014', 'Ni Wayan Ratna', '', 30, '', 'P', '', ''),
('R015', 'Ratih Pradnyandari Ni Wayan', '38673', 13, 'ketewel', 'P', '', ''),
('R016', 'Riyanti Wayan', '35207', 22, 'Celuk', 'P', '81339871950', ''),
('R017', 'Risma Yuwanita', '', 0, '', 'P', '', ''),
('R018', 'Raisa Nareswari Sancaya', '41096', 0, 'Celuk', 'P', '', ''),
('R019', 'Rian Adi Prayoga Prawira', '41088', 6, 'Blahbatuh', 'L', '', ''),
('R020', 'Restika Wayan', '', 56, 'Celuk', 'L', '', ''),
('R021', 'Rai Arnadi', '24058', 62, 'Celuk', 'P', '', ''),
('R022', 'Rika Yasa Wayan', '34374', 24, 'Ketewel', 'L', '81558008825', ''),
('R023', 'Rudiarta Putu', '', 36, 'Sukawati', 'L', '', ''),
('R024', 'Riska ', '36065', 20, '', 'P', '81556581895', ''),
('S001', 'Subandi purnomo', '26882', 43, 'br. Tameny sukawati', 'L', '8125977294', ''),
('S002', 'Suarsana Kadek', '33852', 24, 'Blahkiuh', 'L', '85792504433', ''),
('S003', 'Sulabayasa', '30759', 34, 'br. Glumpang', 'L', '87860124664', ''),
('S005', 'Suteja  I Made ', '26526', 0, 'Titiapi Pejeng', 'L', '81338540099', ''),
('S006', 'Sudarta Nyoman', '23750', 53, 'batubulan ', 'L', '', ''),
('S008', 'Sukarmitha I Made', '23902', 51, 'Sanur', 'L', '81338528536', ''),
('S009', 'Sri Artari Ni Wayan', '34456', 0, 'Celuk', 'P', '87861370036', ''),
('S010', 'Kadek Siwam Sayesa', '36355', 17, 'Ketewel', 'L', '81246316686', ''),
('S011', 'Sriani Ni Md', '', 0, 'Celuk', 'P', '', ''),
('S012', 'Supadi Nyoman', '', 49, 'Jagaraga', 'L', '', ''),
('S013', 'Satria Wiradarma', '35806', 19, 'Celuk', 'L', '81237679160', ''),
('S014', 'Suarniti Ni Md', '35050', 21, 'Batubulan', 'P', '85739694238', ''),
('S015', 'Satyam Isa Komang', '39764', 9, 'Sukawati', 'L', '', ''),
('S016', 'Sumertha Wayan', '29318', 36, 'Sukawati', 'L', '8123781122', ''),
('S018', 'Sudadana Wayan ', '', 42, 'Singapadu', 'L', '81999758899', ''),
('S019', 'Sang Ayu Juniari', '28292', 0, 'Gianyar', 'P', '81237878933', ''),
('S041', 'Siring Ni Ketut', '', 53, 'batuyang ', 'P', '8179873383', ''),
('S043', 'Suwithi Ida Ayu Made', '22070', 58, 'sukawati', 'P', '87861415150', ''),
('S044', 'Suka Made', '', 52, 'batuyang ', 'L', '', ''),
('S048', 'Sugiarti Ni Komang', '34214', 24, 'ketewel', 'P', '81999662799', ''),
('S055', 'Suryati Ni Komang', '36992', 16, 'sukawati', 'P', '81236182678', ''),
('S085', 'Surya I Gede Putu', '38493', 13, '', 'L', '85238793389', ''),
('S110', 'Suciasih Ni Luh', '33058', 28, 'jl. Celuk ', 'P', '87862980482', ''),
('S111', 'Suardiana I wayan ', '23011', 56, 'jl. Celuk', 'L', '0361 298094', ''),
('S112', 'Satria I Gede', '40799', 7, 'Singapadu', 'L', '', ''),
('W002', 'Widya Komang', '34157', 0, 'Tangsub', 'L', '81339216980', ''),
('W038', 'Made Gede Widnyana', '35069', 21, 'Celuk', 'L', '81999380680', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tindakan`
--

CREATE TABLE `tindakan` (
  `tindakan_id` int(11) NOT NULL,
  `tindakan_kode` varchar(30) NOT NULL,
  `tindakan_nama` varchar(255) NOT NULL,
  `tindakan_tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tindakan`
--

INSERT INTO `tindakan` (`tindakan_id`, `tindakan_kode`, `tindakan_nama`, `tindakan_tarif`) VALUES
(23, 'Pr01', 'Cetak Alginat 2 Rahang', 150000),
(24, 'Pr02', 'GTS Resin Akrilik + 1 Gigi Pertama', 800000),
(25, 'Pr03', 'GTS Resin Akrilik Tambahan Gigi berikutnya', 200000),
(26, 'Pr04', 'GTS Valplast + 1 Gigi Pertama', 900000),
(27, 'Pr05', 'GTS Valplast Tambahan Gigi Berikutnya', 200000),
(28, 'Pr06', 'GTS Lucitone FRS + 1 Gigi Pertama', 1500000),
(29, 'Pr07', 'GTS Lucitone FRS Tambahan Gigi Berikutnya', 250000),
(30, 'Pr08', 'GTS Akrilik Free End Tanpa Oklusi + 1 Gigi Pertama', 1000000),
(31, 'Pr09', 'GTS Akrilik Free End Tambahan Gigi Berikutnya', 200000),
(32, 'Pr10', 'GTC PFM per 1 Unit', 3000000),
(33, 'Pr11', 'GTC All Porcelain (E-Max) per Unit', 4500000),
(34, 'Pr12', 'GTC All Porcelain (Zirconia) per Unit', 6500000),
(35, 'Pr13', 'GTL Resin Akrilik', 5000000),
(36, 'Pr14', 'GTL Valplast', 5000000),
(37, 'Pr15', 'GTL Lucitone FRS', 8000000),
(38, 'Pr16', 'Reparasi Plat GTL Akrilik per Rahang', 500000),
(39, 'Pr17', 'Reparasi Plat GTS Akrilik per Rahang', 250000),
(40, 'Pr18', 'Relining Direct per Rahang', 500000),
(41, 'Pr19', 'Rebasing Indirect per Rahang', 500000),
(42, 'Pr20', 'Sementasi Mahkota Sementara', 100000),
(43, 'Pr21', 'Bongkar GT Cekat (Bikinan Tukang Gigi)', 400000),
(44, 'Pr22', 'Bongkar GTC per Unit', 200000),
(45, 'Pe01', 'Scalling Ultra Sonic Karang Gigi Sedikit Rahang Atas dan Bawah', 150000),
(46, 'Pe02', 'Scalling Ultra Sonic Karang Gigi Sedikit Rahang Atas dan Bawah Sedang', 250000),
(47, 'Pe03', 'Scalling Ultra Sonic Karang Gigi Sedikit Rahang Atas dan Bawah Banyak', 350000),
(48, 'Pe04', 'Occlusal Adjusment', 100000),
(49, 'Pe05', 'Gingivektomi per Regio', 350000),
(50, 'Pe06', 'ENAP per Regio', 350000),
(51, 'Pe07', 'Kuretase per Gigi', 150000),
(52, 'Pe08', 'Frenektomi', 1000000),
(53, 'Pe09', 'Splinting dengan Risin Komposit per Gigi', 250000),
(54, 'Pe10', 'Splinting Dengan Kawat per Gigi', 100000),
(55, 'Pe11', 'Hiperpigmentasi (Memerahkan gusi yang hitam)', 100000),
(56, 'O01', 'Konsultasi', 100000),
(57, 'O02', 'Cetak Alginat 2 Rahang', 150000),
(58, 'O03', 'Ortho Fix Behel Rahang Atas', 2000000),
(59, 'O04', 'Ortho Fix Behel Rahang Bawah', 2000000),
(60, 'O05', 'Ortho Fix Rahang Bawah dan Atas bahan Metal', 4000000),
(61, 'O06', 'Ortho Fix Rahang Bawah dan Atas bahan Keramik putih', 6000000),
(62, 'O07', 'Ortho Removeable Rahang Atas dan Bawah', 2500000),
(63, 'O08', 'Kontrol Ganti Karet', 100000),
(64, 'O09', 'Ganti Kawat per Rahang', 100000),
(65, 'O10', 'Lem Bracket per Gigi', 100000),
(66, 'O11', 'Retainer 1 Rahang', 1000000),
(67, 'O12', 'Retainer 2 Rahang', 1500000),
(68, 'O13', 'Lepas Bracket 1 Rahang', 500000),
(69, 'O14', 'Lepas Bracket 1 Rahang', 750000),
(70, 'O15', 'Pindah Perawatan Breket', 500000),
(71, 'K01', 'Konsultasi / Pemeriksaan / Premidikasi', 100000),
(72, 'K02', 'Tumpatan klas I SIK / GI Kecil', 50000),
(73, 'K03', 'Tumpatan klas I SIK / GI Sedang', 75000),
(74, 'K04', 'Tumpatan klas I SIK / GI Besar', 100000),
(75, 'K05', 'Tumpatan klas II SIK / GI Sedang', 100000),
(76, 'K06', 'Tumpatan klas II SIK / GI Besar', 150000),
(77, 'K07', 'Sementasi SIK Luting', 100000),
(78, 'K08', 'Fissure Sealant', 150000),
(79, 'K09', 'Tumpatan klas I Resin Komposit Kecil', 100000),
(80, 'K10', 'Tumpatan klas I Resin Komposit Sedang', 150000),
(81, 'K11', 'Tumpatan klas I Resin Komposit Besar', 250000),
(82, 'K12', 'Tumpatan klas II Resin Komposit Sedang', 150000),
(83, 'K13', 'Tumpatan klas II Resin Komposit Besar', 250000),
(84, 'K14', 'Tumpatan Resin Komposit klas III', 150000),
(85, 'K15', 'Tumpatan klas IV Resin Komposit Kecil', 150000),
(86, 'K16', 'Tumpatan klas IV Resin Komposit Luas', 300000),
(87, 'K17', 'Tumpatan Resin Komposit klas V', 150000),
(88, 'K18', 'Tumpatan Resin Komposit MOD', 300000),
(89, 'K19', 'Tumpatan Sandwich (SIK+RK) klas I', 200000),
(90, 'K20', 'Tumpatan Sandwich (SIK+RK) klas II', 300000),
(91, 'K21', 'Mahkota Jaket/Crown Akrilik', 1200000),
(92, 'K22', 'Mahkota Jaket/Crown Resin Komposit', 650000),
(93, 'K23', 'Mahkota Jaket/Crown Full Porcelain', 2000000),
(94, 'K24', 'Mahkota Jaket/Crown PFM', 1500000),
(95, 'K25', 'Mahkota Jaket/Crown Zirconia', 3000000),
(96, 'K26', 'Inti Pasak Logam Dowel Core', 450000),
(97, 'K27', 'Inti Pasak Fiber', 450000),
(98, 'K28', 'Inti Pasak Sekrup', 150000),
(99, 'K29', 'Inti Pasak Fiber dengan Core Build Up', 850000),
(100, 'K30', 'Proteksi Pulpa/Caping Pulpa', 200000),
(101, 'K31', 'Semi Mumifikasi', 200000),
(102, 'K32', 'Veneer Direct Resin Komposit', 700000),
(103, 'K33', 'Vener Indirect Resin Komposit', 800000),
(104, 'K34', 'Veneer Indirect Zirconia', 2500000),
(105, 'K35', 'Veneer Indirect Porcelain', 2500000),
(106, 'K36', 'Bleaching Non Vital 1 Gigi', 500000),
(107, 'K37', 'Bleacing Vital 1 Rahang (6 Gigi)', 3000000),
(108, 'K38', 'Devitalisasi Pulpa', 100000),
(109, 'K39', 'Trepanasi', 150000),
(110, 'B01', 'Konsultasi / Premedikasi', 150000),
(111, 'B02', 'Cabut Gigi depan + Obat', 150000),
(112, 'B03', 'Cabut Gigi belakang + Obat', 200000),
(113, 'B04', 'Cabut Gigi Sisa Akar + Obat', 150000),
(114, 'B05', 'Cabut 1 Gigi Dengan Infiltrasi (Anak-anak) + Obat', 50000),
(115, 'B06', 'Cabut 1 Gigi dengan Topikal/CE', 50000),
(116, 'B07', 'Perawatan Dry Socket + Obat', 150000),
(117, 'B08', 'Odontektomi Akar Gigi (M3 Miring) + Obat', 800000),
(118, 'B09', 'Odontektomi + Obat', 1700000),
(119, 'B10', 'Jahit per SImpul', 100000),
(120, 'B11', 'Buka Jahitan', 100000),
(121, 'B12', 'Alveolektomi per Tonjolan Alveolus', 150000),
(122, 'B13', 'Operkulektomi', 250000),
(123, 'B14', 'Frenektomi', 850000),
(124, 'B15', 'Apikoektomi Tanpa PSA', 600000),
(125, 'B16', 'Fiksasi Fraktur RA/RB dengan Kawat', 800000),
(126, 'B17', 'Fiksasi Fraktur RA/RB dengan Arch Bar', 2000000),
(127, 'B18', 'Enukleasi Kista Kecil', 1500000),
(128, 'B19', 'Enukleasi Kista Sedang', 2000000),
(129, 'B20', 'Marsupialisasi Kista', 2000000),
(130, 'B21', 'Insisi Abses Intraoral', 300000),
(131, 'B22', 'Insisi Abses Ekstraoral', 700000),
(132, 'B23', 'Aspirasi', 150000),
(133, 'B24', 'Spuling', 50000),
(134, 'B25', 'Implant Gigi', 10000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksipasien`
--

CREATE TABLE `transaksipasien` (
  `transaksipasien_id` int(11) NOT NULL,
  `pasien_id` varchar(11) NOT NULL,
  `tindakan_id` int(11) NOT NULL,
  `invoice_number` varchar(11) NOT NULL,
  `transaksipasien_diskon` int(11) NOT NULL,
  `transaksipasien_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksipasien`
--

INSERT INTO `transaksipasien` (`transaksipasien_id`, `pasien_id`, `tindakan_id`, `invoice_number`, `transaksipasien_diskon`, `transaksipasien_date`) VALUES
(1, 'A004', 24, '0001', 0, '2019-02-05 22:52:04'),
(2, 'A004', 28, '0001', 0, '2019-02-05 22:52:05'),
(3, 'A004', 26, '0001', 0, '2019-02-05 22:52:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(60) NOT NULL,
  `user_password` text NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_foto` varchar(100) NOT NULL,
  `user_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_nama`, `user_password`, `user_email`, `user_foto`, `user_status`) VALUES
(1, 'admin', 'Crypt#edSb7zZcpsjBQBRjJKqup+ZCu/wRLwRM#ZkaVNe8=#8e93dbc85a9d0a19e72dc6f1d99ae726074ba9c7', 'admin@gmail.com', '../assets/images/no-pic.png', 'admin'),
(2, 'irvan', 'Crypt#qToNZ3vjWohIRlhnWMoNK3RZAnzjWD6E#9kiFrIU=#fb530928fa0235c9e8c1b1e926f3d42be2fdbe8b', 'irvanvavan16@gmail.com', '../assets/images/no-pic.png', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `invoicedetail`
--
ALTER TABLE `invoicedetail`
  ADD PRIMARY KEY (`invoicedetail_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`pasien_id`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`tindakan_id`);

--
-- Indexes for table `transaksipasien`
--
ALTER TABLE `transaksipasien`
  ADD PRIMARY KEY (`transaksipasien_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invoicedetail`
--
ALTER TABLE `invoicedetail`
  MODIFY `invoicedetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `tindakan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `transaksipasien`
--
ALTER TABLE `transaksipasien`
  MODIFY `transaksipasien_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
