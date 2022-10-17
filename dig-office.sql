-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2022 at 05:42 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dig-office`
--

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) UNSIGNED NOT NULL,
  `division_id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `bn_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `d_code` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `website`, `d_code`) VALUES
(1, 3, 'Dhaka', 'ঢাকা', 23.7115253, 90.4111451, 'www.dhaka.gov.bd', '26'),
(2, 3, 'Faridpur', 'ফরিদপুর', 23.6070822, 89.8429406, 'www.faridpur.gov.bd', '29'),
(3, 3, 'Gazipur', 'গাজীপুর', 24.0022858, 90.4264283, 'www.gazipur.gov.bd', '33'),
(4, 3, 'Gopalganj', 'গোপালগঞ্জ', 23.0050857, 89.8266059, 'www.gopalganj.gov.bd', '35'),
(5, 8, 'Jamalpur', 'জামালপুর', 24.937533, 89.937775, 'www.jamalpur.gov.bd', '39'),
(6, 3, 'Kishoreganj', 'কিশোরগঞ্জ', 24.444937, 90.776575, 'www.kishoreganj.gov.bd', '48'),
(7, 3, 'Madaripur', 'মাদারীপুর', 23.164102, 90.1896805, 'www.madaripur.gov.bd', '54'),
(8, 3, 'Manikganj', 'মানিকগঞ্জ', 0, 0, 'www.manikganj.gov.bd', '56'),
(9, 3, 'Munshiganj', 'মুন্সিগঞ্জ', 0, 0, 'www.munshiganj.gov.bd', '59'),
(10, 8, 'Mymensingh', 'ময়মনসিংহ', 0, 0, 'www.mymensingh.gov.bd', '61'),
(11, 3, 'Narayanganj', 'নারায়াণগঞ্জ', 23.63366, 90.496482, 'www.narayanganj.gov.bd', '67'),
(12, 3, 'Narsingdi', 'নরসিংদী', 23.932233, 90.71541, 'www.narsingdi.gov.bd', '68'),
(13, 8, 'Netrokona', 'নেত্রকোণা', 24.870955, 90.727887, 'www.netrokona.gov.bd', '72'),
(14, 3, 'Rajbari', 'রাজবাড়ি', 23.7574305, 89.6444665, 'www.rajbari.gov.bd', '82'),
(15, 3, 'Shariatpur', 'শরীয়তপুর', 0, 0, 'www.shariatpur.gov.bd', '86'),
(16, 8, 'Sherpur', 'শেরপুর', 25.0204933, 90.0152966, 'www.sherpur.gov.bd', '89'),
(17, 3, 'Tangail', 'টাঙ্গাইল', 0, 0, 'www.tangail.gov.bd', '93'),
(18, 5, 'Bogura', 'বগুড়া', 24.8465228, 89.377755, 'www.bogra.gov.bd', '10'),
(19, 5, 'Joypurhat', 'জয়পুরহাট', 0, 0, 'www.joypurhat.gov.bd', '38'),
(20, 5, 'Naogaon', 'নওগাঁ', 0, 0, 'www.naogaon.gov.bd', '64'),
(21, 5, 'Natore', 'নাটোর', 24.420556, 89.000282, 'www.natore.gov.bd', '69'),
(22, 5, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', 24.5965034, 88.2775122, 'www.chapainawabganj.gov.bd', '70'),
(23, 5, 'Pabna', 'পাবনা', 23.998524, 89.233645, 'www.pabna.gov.bd', '76'),
(24, 5, 'Rajshahi', 'রাজশাহী', 0, 0, 'www.rajshahi.gov.bd', '81'),
(25, 5, 'Sirajgonj', 'সিরাজগঞ্জ', 24.4533978, 89.7006815, 'www.sirajganj.gov.bd', '88'),
(26, 6, 'Dinajpur', 'দিনাজপুর', 25.6217061, 88.6354504, 'www.dinajpur.gov.bd', '27'),
(27, 6, 'Gaibandha', 'গাইবান্ধা', 25.328751, 89.528088, 'www.gaibandha.gov.bd', '32'),
(28, 6, 'Kurigram', 'কুড়িগ্রাম', 25.805445, 89.636174, 'www.kurigram.gov.bd', '49'),
(29, 6, 'Lalmonirhat', 'লালমনিরহাট', 0, 0, 'www.lalmonirhat.gov.bd', '52'),
(30, 6, 'Nilphamari', 'নীলফামারী', 25.931794, 88.856006, 'www.nilphamari.gov.bd', '73'),
(31, 6, 'Panchagarh', 'পঞ্চগড়', 26.3411, 88.5541606, 'www.panchagarh.gov.bd', '77'),
(32, 6, 'Rangpur', 'রংপুর', 25.7558096, 89.244462, 'www.rangpur.gov.bd', '85'),
(33, 6, 'Thakurgaon', 'ঠাকুরগাঁও', 26.0336945, 88.4616834, 'www.thakurgaon.gov.bd', '94'),
(34, 1, 'Barguna', 'বরগুনা', 0, 0, 'www.barguna.gov.bd', '04'),
(35, 1, 'Barishal', 'বরিশাল', 0, 0, 'www.barisal.gov.bd', '06'),
(36, 1, 'Bhola', 'ভোলা', 22.685923, 90.648179, 'www.bhola.gov.bd', '09'),
(37, 1, 'Jhalokati', 'ঝালকাঠি', 0, 0, 'www.jhalakathi.gov.bd', '42'),
(38, 1, 'Patuakhali', 'পটুয়াখালী', 22.3596316, 90.3298712, 'www.patuakhali.gov.bd', '78'),
(39, 1, 'Pirojpur', 'পিরোজপুর', 0, 0, 'www.pirojpur.gov.bd', '79'),
(40, 2, 'Bandarban', 'বান্দরবান', 22.1953275, 92.2183773, 'www.bandarban.gov.bd', '03'),
(41, 2, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 23.9570904, 91.1119286, 'www.brahmanbaria.gov.bd', '12'),
(42, 2, 'Chandpur', 'চাঁদপুর', 23.2332585, 90.6712912, 'www.chandpur.gov.bd', '13'),
(43, 2, 'Chattogram', 'চট্টগ্রাম', 22.335109, 91.834073, 'www.chittagong.gov.bd', '15'),
(44, 2, 'Cumilla', 'কুমিল্লা', 23.4682747, 91.1788135, 'www.comilla.gov.bd', '19'),
(45, 2, 'Cox\'s Bazar', 'কক্স বাজার', 0, 0, 'www.coxsbazar.gov.bd', '22'),
(46, 2, 'Feni', 'ফেনী', 23.023231, 91.3840844, 'www.feni.gov.bd', '30'),
(47, 2, 'Khagrachhari', 'খাগড়াছড়ি', 23.119285, 91.984663, 'www.khagrachhari.gov.bd', '46'),
(48, 2, 'Lakshmipur', 'লক্ষ্মীপুর', 22.942477, 90.841184, 'www.lakshmipur.gov.bd', '51'),
(49, 2, 'Noakhali', 'নোয়াখালী', 22.869563, 91.099398, 'www.noakhali.gov.bd', '75'),
(50, 2, 'Rangamati', 'রাঙ্গামাটি', 0, 0, 'www.rangamati.gov.bd', '84'),
(51, 7, 'Habiganj', 'হবিগঞ্জ', 24.374945, 91.41553, 'www.habiganj.gov.bd', '36'),
(52, 7, 'Moulvibazar', 'মৌলভীবাজার', 24.482934, 91.777417, 'www.moulvibazar.gov.bd', '58'),
(53, 7, 'Sunamganj', 'সুনামগঞ্জ', 25.0658042, 91.3950115, 'www.sunamganj.gov.bd', '90'),
(54, 7, 'Sylhet', 'সিলেট', 24.8897956, 91.8697894, 'www.sylhet.gov.bd', '91'),
(55, 4, 'Bagerhat', 'বাগেরহাট', 22.651568, 89.785938, 'www.bagerhat.gov.bd', '01'),
(56, 4, 'Chuadanga', 'চুয়াডাঙ্গা', 23.6401961, 88.841841, 'www.chuadanga.gov.bd', '18'),
(57, 4, 'Jashore', 'যশোর', 23.16643, 89.2081126, 'www.jessore.gov.bd', '41'),
(58, 4, 'Jhenaidah', 'ঝিনাইদহ', 23.5448176, 89.1539213, 'www.jhenaidah.gov.bd', '44'),
(59, 4, 'Khulna', 'খুলনা', 22.815774, 89.568679, 'www.khulna.gov.bd', '47'),
(60, 4, 'Kushtia', 'কুষ্টিয়া', 23.901258, 89.120482, 'www.kushtia.gov.bd', '50'),
(61, 4, 'Magura', 'মাগুরা', 23.487337, 89.419956, 'www.magura.gov.bd', '55'),
(62, 4, 'Meherpur', 'মেহেরপুর', 23.762213, 88.631821, 'www.meherpur.gov.bd', '57'),
(63, 4, 'Narail', 'নড়াইল', 23.172534, 89.512672, 'www.narail.gov.bd', '65'),
(64, 4, 'Satkhira', 'সাতক্ষীরা', 0, 0, 'www.satkhira.gov.bd', '87');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `bn_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`) VALUES
(1, 'Barishal', 'বরিশাল'),
(2, 'Chattogram', 'চট্টগ্রাম'),
(3, 'Dhaka', 'ঢাকা'),
(4, 'Khulna', 'খুলনা'),
(5, 'Rajshahi', 'রাজশাহী'),
(6, 'Rangpur', 'রংপুর'),
(7, 'Sylhet', 'সিলেট'),
(8, 'Mymensingh', 'ময়মনসিংহ');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2021_08_05_141848_create_sessions_table', 1),
(13, '2021_08_05_150659_add_address_to_users_table', 2),
(15, '2021_08_06_115238_create_vehicles_table', 4),
(16, '2021_08_07_061943_create_offices_table', 5),
(17, '2021_08_07_114038_create_employees_table', 6),
(18, '2021_08_07_115507_create_positions_table', 7),
(20, '2021_08_14_165245_create_transfers_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qrrs`
--

CREATE TABLE `qrrs` (
  `id` int(255) NOT NULL,
  `divisionID` int(2) DEFAULT NULL,
  `districtID` int(3) DEFAULT NULL,
  `upazillaID` int(5) DEFAULT NULL,
  `police_station_ID` int(5) DEFAULT NULL,
  `village_word` varchar(255) NOT NULL,
  `source_of_info` varchar(255) NOT NULL,
  `date_time_of_incident` datetime DEFAULT NULL,
  `date_time_of_police_news` datetime DEFAULT NULL,
  `date_time_response` datetime DEFAULT NULL,
  `delay_in_response` varchar(30) DEFAULT NULL,
  `time_to_report` datetime DEFAULT NULL,
  `delay_in_reporting` varchar(30) DEFAULT NULL,
  `main_event` varchar(255) DEFAULT NULL,
  `begening_of_event` varchar(255) DEFAULT NULL,
  `gd_no` int(50) DEFAULT NULL,
  `gd_date` datetime DEFAULT NULL,
  `case_no` int(50) DEFAULT NULL,
  `case_date` datetime DEFAULT NULL,
  `clause` varchar(255) DEFAULT NULL,
  `nopc` varchar(255) DEFAULT NULL,
  `plaintiff_mobile` varchar(15) DEFAULT NULL,
  `number_of_victims` int(5) DEFAULT NULL,
  `number_of_accused` int(5) DEFAULT NULL,
  `name_of_investigator` varchar(150) DEFAULT NULL,
  `bp_no` int(50) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `image` varchar(10) DEFAULT NULL,
  `image_quality` varchar(50) DEFAULT NULL,
  `video` varchar(10) DEFAULT NULL,
  `video_quality` varchar(50) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `delete_status` varchar(10) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `data_id` varchar(255) DEFAULT NULL,
  `data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `data_id`, `data`) VALUES
(1, 'header_phone', '+8801737963893'),
(2, 'header_email', 'testemail@gmail.com'),
(3, 'header_logo', '/CE6FciBiyfunP1wlU3691Y85XH7RJcBJI5vt4oJG.png'),
(6, 'footer_phone', '+8801737963893'),
(7, 'footer_email', 'info@j7sit.com'),
(8, 'footer_address', 'সিলেট জেলা পরিষদ, বন্দরবাজার, সিলেট, ৩২৫১ ।'),
(9, 'footer_logo', '/1hp1J41xPm0Sv8swT4sutRdLcOZDmgg7YM9bJ9yw.png'),
(10, 'contact_phone', '01737963893'),
(11, 'contact_email', 'test@gmail.com'),
(12, 'contact_short_text', '24/7 Service'),
(13, 'contact_map', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14476.828955350633!2d91.8519857807165!3d24.890911744631264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3751aad51bc2341f%3A0x927cc509fdb882c5!2sSylhet%20Zilla%20Parishad%20Bhaban!5e0!3m2!1sen!2sbd!4v1659928024499!5m2!1sen!2sbd\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>'),
(14, 'about_title', 'জেলা পরিষদ, সিলেট'),
(15, 'about_description', 'আমাদের সিলেটে জেলার সকল সরকারী ডাকবাংলো অনলাইনে বুকিং দেওা যাবে।'),
(16, 'about_image', '/XzTRYFW0PnPJWYKTqmk6UOwCfSr6TTjwAfPmZf9K.jpg'),
(17, 'saturday_open', '9.00 am - 9.00 pm'),
(18, 'sunday_open', '9.00 am - 9.00 pm'),
(19, 'monday_open', '9.00 am - 9.00 pm'),
(20, 'tudesday_open', '9.00 am - 9.00 pm'),
(21, 'wednesday_open', '9.00 am - 9.00 pm'),
(22, 'thursday_open', '9.00 am - 9.00 pm'),
(23, 'friday_open', '9.00 am - 9.00 pm'),
(24, 'footer_copyright', 'সিলেট জেলা পরিষদ দ্বারা সকল তথ্য সংশোধিত');

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` int(2) UNSIGNED NOT NULL,
  `district_id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `bn_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `deletable` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `upazilas`
--

INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `deletable`) VALUES
(1, 34, 'Amtali Upazila', 'আমতলী', 0),
(2, 34, 'Bamna Upazila', 'বামনা', 0),
(3, 34, 'Barguna Sadar Upazila', 'বরগুনা সদর', 0),
(4, 34, 'Betagi Upazila', 'বেতাগি', 0),
(5, 34, 'Patharghata Upazila', 'পাথরঘাটা', 0),
(6, 34, 'Taltali Upazila', 'তালতলী', 0),
(7, 35, 'Muladi Upazila', 'মুলাদি', 0),
(8, 35, 'Babuganj Upazila', 'বাবুগঞ্জ', 0),
(9, 35, 'Agailjhara Upazila', 'আগাইলঝরা', 0),
(10, 35, 'Barisal Sadar Upazila', 'বরিশাল সদর', 0),
(11, 35, 'Bakerganj Upazila', 'বাকেরগঞ্জ', 0),
(12, 35, 'Banaripara Upazila', 'বানাড়িপারা', 0),
(13, 35, 'Gaurnadi Upazila', 'গৌরনদী', 0),
(14, 35, 'Hizla Upazila', 'হিজলা', 0),
(15, 35, 'Mehendiganj Upazila', 'মেহেদিগঞ্জ ', 0),
(16, 35, 'Wazirpur Upazila', 'ওয়াজিরপুর', 0),
(17, 36, 'Bhola Sadar Upazila', 'ভোলা সদর', 0),
(18, 36, 'Burhanuddin Upazila', 'বুরহানউদ্দিন', 0),
(19, 36, 'Char Fasson Upazila', 'চর ফ্যাশন', 0),
(20, 36, 'Daulatkhan Upazila', 'দৌলতখান', 0),
(21, 36, 'Lalmohan Upazila', 'লালমোহন', 0),
(22, 36, 'Manpura Upazila', 'মনপুরা', 0),
(23, 36, 'Tazumuddin Upazila', 'তাজুমুদ্দিন', 0),
(24, 37, 'Jhalokati Sadar Upazila', 'ঝালকাঠি সদর', 0),
(25, 37, 'Kathalia Upazila', 'কাঁঠালিয়া', 0),
(26, 37, 'Nalchity Upazila', 'নালচিতি', 0),
(27, 37, 'Rajapur Upazila', 'রাজাপুর', 0),
(28, 38, 'Bauphal Upazila', 'বাউফল', 0),
(29, 38, 'Dashmina Upazila', 'দশমিনা', 0),
(30, 38, 'Galachipa Upazila', 'গলাচিপা', 0),
(31, 38, 'Kalapara Upazila', 'কালাপারা', 0),
(32, 38, 'Mirzaganj Upazila', 'মির্জাগঞ্জ ', 0),
(33, 38, 'Patuakhali Sadar Upazila', 'পটুয়াখালী সদর', 0),
(34, 38, 'Dumki Upazila', 'ডুমকি', 0),
(35, 38, 'Rangabali Upazila', 'রাঙ্গাবালি', 0),
(36, 39, 'Bhandaria', 'ভ্যান্ডারিয়া', 0),
(37, 39, 'Kaukhali', 'কাউখালি', 0),
(38, 39, 'Mathbaria', 'মাঠবাড়িয়া', 0),
(39, 39, 'Nazirpur', 'নাজিরপুর', 0),
(40, 39, 'Nesarabad', 'নেসারাবাদ', 0),
(41, 39, 'Pirojpur Sadar', 'পিরোজপুর সদর', 0),
(42, 39, 'Zianagar', 'জিয়ানগর', 0),
(43, 40, 'Bandarban Sadar', 'বান্দরবন সদর', 0),
(44, 40, 'Thanchi', 'থানচি', 0),
(45, 40, 'Lama', 'লামা', 0),
(46, 40, 'Naikhongchhari', 'নাইখংছড়ি ', 0),
(47, 40, 'Ali kadam', 'আলী কদম', 0),
(48, 40, 'Rowangchhari', 'রউয়াংছড়ি ', 0),
(49, 40, 'Ruma', 'রুমা', 0),
(50, 41, 'Brahmanbaria Sadar Upazila', 'ব্রাহ্মণবাড়িয়া সদর', 0),
(51, 41, 'Ashuganj Upazila', 'আশুগঞ্জ', 0),
(52, 41, 'Nasirnagar Upazila', 'নাসির নগর', 0),
(53, 41, 'Nabinagar Upazila', 'নবীনগর', 0),
(54, 41, 'Sarail Upazila', 'সরাইল', 0),
(55, 41, 'Shahbazpur Town', 'শাহবাজপুর টাউন', 0),
(56, 41, 'Kasba Upazila', 'কসবা', 0),
(57, 41, 'Akhaura Upazila', 'আখাউরা', 0),
(58, 41, 'Bancharampur Upazila', 'বাঞ্ছারামপুর', 0),
(59, 41, 'Bijoynagar Upazila', 'বিজয় নগর', 0),
(60, 42, 'Chandpur Sadar', 'চাঁদপুর সদর', 0),
(61, 42, 'Faridganj', 'ফরিদগঞ্জ', 0),
(62, 42, 'Haimchar', 'হাইমচর', 0),
(63, 42, 'Haziganj', 'হাজীগঞ্জ', 0),
(64, 42, 'Kachua', 'কচুয়া', 0),
(65, 42, 'Matlab Uttar', 'মতলব উত্তর', 0),
(66, 42, 'Matlab Dakkhin', 'মতলব দক্ষিণ', 0),
(67, 42, 'Shahrasti', 'শাহরাস্তি', 0),
(68, 43, 'Anwara Upazila', 'আনোয়ারা', 0),
(69, 43, 'Banshkhali Upazila', 'বাশখালি', 0),
(70, 43, 'Boalkhali Upazila', 'বোয়ালখালি', 0),
(71, 43, 'Chandanaish Upazila', 'চন্দনাইশ', 0),
(72, 43, 'Fatikchhari Upazila', 'ফটিকছড়ি', 0),
(73, 43, 'Hathazari Upazila', 'হাঠহাজারী', 0),
(74, 43, 'Lohagara Upazila', 'লোহাগারা', 0),
(75, 43, 'Mirsharai Upazila', 'মিরসরাই', 0),
(76, 43, 'Patiya Upazila', 'পটিয়া', 0),
(77, 43, 'Rangunia Upazila', 'রাঙ্গুনিয়া', 0),
(78, 43, 'Raozan Upazila', 'রাউজান', 0),
(79, 43, 'Sandwip Upazila', 'সন্দ্বীপ', 0),
(80, 43, 'Satkania Upazila', 'সাতকানিয়া', 0),
(81, 43, 'Sitakunda Upazila', 'সীতাকুণ্ড', 0),
(82, 44, 'Barura Upazila', 'বড়ুরা', 0),
(83, 44, 'Brahmanpara Upazila', 'ব্রাহ্মণপাড়া', 0),
(84, 44, 'Burichong Upazila', 'বুড়িচং', 0),
(85, 44, 'Chandina Upazila', 'চান্দিনা', 0),
(86, 44, 'Chauddagram Upazila', 'চৌদ্দগ্রাম', 0),
(87, 44, 'Daudkandi Upazila', 'দাউদকান্দি', 0),
(88, 44, 'Debidwar Upazila', 'দেবীদ্বার', 0),
(89, 44, 'Homna Upazila', 'হোমনা', 0),
(90, 44, 'Comilla Sadar Upazila', 'কুমিল্লা সদর', 0),
(91, 44, 'Laksam Upazila', 'লাকসাম', 0),
(92, 44, 'Monohorgonj Upazila', 'মনোহরগঞ্জ', 0),
(93, 44, 'Meghna Upazila', 'মেঘনা', 0),
(94, 44, 'Muradnagar Upazila', 'মুরাদনগর', 0),
(95, 44, 'Nangalkot Upazila', 'নাঙ্গালকোট', 0),
(96, 44, 'Comilla Sadar South Upazila', 'কুমিল্লা সদর দক্ষিণ', 0),
(97, 44, 'Titas Upazila', 'তিতাস', 0),
(98, 45, 'Chakaria Upazila', 'চকরিয়া', 0),
(100, 45, 'Cox\'s Bazar Sadar Upazila', 'কক্স বাজার সদর', 0),
(101, 45, 'Kutubdia Upazila', 'কুতুবদিয়া', 0),
(102, 45, 'Maheshkhali Upazila', 'মহেশখালী', 0),
(103, 45, 'Ramu Upazila', 'রামু', 0),
(104, 45, 'Teknaf Upazila', 'টেকনাফ', 0),
(105, 45, 'Ukhia Upazila', 'উখিয়া', 0),
(106, 45, 'Pekua Upazila', 'পেকুয়া', 0),
(107, 46, 'Feni Sadar', 'ফেনী সদর', 0),
(108, 46, 'Chagalnaiya', 'ছাগল নাইয়া', 0),
(109, 46, 'Daganbhyan', 'দাগানভিয়া', 0),
(110, 46, 'Parshuram', 'পরশুরাম', 0),
(111, 46, 'Fhulgazi', 'ফুলগাজি', 0),
(112, 46, 'Sonagazi', 'সোনাগাজি', 0),
(113, 47, 'Dighinala Upazila', 'দিঘিনালা ', 0),
(114, 47, 'Khagrachhari Upazila', 'খাগড়াছড়ি', 0),
(115, 47, 'Lakshmichhari Upazila', 'লক্ষ্মীছড়ি', 0),
(116, 47, 'Mahalchhari Upazila', 'মহলছড়ি', 0),
(117, 47, 'Manikchhari Upazila', 'মানিকছড়ি', 0),
(118, 47, 'Matiranga Upazila', 'মাটিরাঙ্গা', 0),
(119, 47, 'Panchhari Upazila', 'পানছড়ি', 0),
(120, 47, 'Ramgarh Upazila', 'রামগড়', 0),
(121, 48, 'Lakshmipur Sadar Upazila', 'লক্ষ্মীপুর সদর', 0),
(122, 48, 'Raipur Upazila', 'রায়পুর', 0),
(123, 48, 'Ramganj Upazila', 'রামগঞ্জ', 0),
(124, 48, 'Ramgati Upazila', 'রামগতি', 0),
(125, 48, 'Komol Nagar Upazila', 'কমল নগর', 0),
(126, 49, 'Noakhali Sadar Upazila', 'নোয়াখালী সদর', 0),
(127, 49, 'Begumganj Upazila', 'বেগমগঞ্জ', 0),
(128, 49, 'Chatkhil Upazila', 'চাটখিল', 0),
(129, 49, 'Companyganj Upazila', 'কোম্পানীগঞ্জ', 0),
(130, 49, 'Shenbag Upazila', 'শেনবাগ', 0),
(131, 49, 'Hatia Upazila', 'হাতিয়া', 0),
(132, 49, 'Kobirhat Upazila', 'কবিরহাট ', 0),
(133, 49, 'Sonaimuri Upazila', 'সোনাইমুরি', 0),
(134, 49, 'Suborno Char Upazila', 'সুবর্ণ চর ', 0),
(135, 50, 'Rangamati Sadar Upazila', 'রাঙ্গামাটি সদর', 0),
(136, 50, 'Belaichhari Upazila', 'বেলাইছড়ি', 0),
(137, 50, 'Bagaichhari Upazila', 'বাঘাইছড়ি', 0),
(138, 50, 'Barkal Upazila', 'বরকল', 0),
(139, 50, 'Juraichhari Upazila', 'জুরাইছড়ি', 0),
(140, 50, 'Rajasthali Upazila', 'রাজাস্থলি', 0),
(141, 50, 'Kaptai Upazila', 'কাপ্তাই', 0),
(142, 50, 'Langadu Upazila', 'লাঙ্গাডু', 0),
(143, 50, 'Nannerchar Upazila', 'নান্নেরচর ', 0),
(144, 50, 'Kaukhali Upazila', 'কাউখালি', 0),
(145, 1, 'Dhamrai Upazila', 'ধামরাই', 0),
(146, 1, 'Dohar Upazila', 'দোহার', 0),
(147, 1, 'Keraniganj Upazila', 'কেরানীগঞ্জ', 0),
(148, 1, 'Nawabganj Upazila', 'নবাবগঞ্জ', 0),
(149, 1, 'Savar Upazila', 'সাভার', 0),
(150, 2, 'Faridpur Sadar Upazila', 'ফরিদপুর সদর', 0),
(151, 2, 'Boalmari Upazila', 'বোয়ালমারী', 0),
(152, 2, 'Alfadanga Upazila', 'আলফাডাঙ্গা', 0),
(153, 2, 'Madhukhali Upazila', 'মধুখালি', 0),
(154, 2, 'Bhanga Upazila', 'ভাঙ্গা', 0),
(155, 2, 'Nagarkanda Upazila', 'নগরকান্ড', 0),
(156, 2, 'Charbhadrasan Upazila', 'চরভদ্রাসন ', 0),
(157, 2, 'Sadarpur Upazila', 'সদরপুর', 0),
(158, 2, 'Shaltha Upazila', 'শালথা', 0),
(159, 3, 'Gazipur Sadar-Joydebpur', 'গাজীপুর সদর', 0),
(160, 3, 'Kaliakior', 'কালিয়াকৈর', 0),
(161, 3, 'Kapasia', 'কাপাসিয়া', 0),
(162, 3, 'Sripur', 'শ্রীপুর', 0),
(163, 3, 'Kaliganj', 'কালীগঞ্জ', 0),
(164, 3, 'Tongi', 'টঙ্গি', 0),
(165, 4, 'Gopalganj Sadar Upazila', 'গোপালগঞ্জ সদর', 0),
(166, 4, 'Kashiani Upazila', 'কাশিয়ানি', 0),
(167, 4, 'Kotalipara Upazila', 'কোটালিপাড়া', 0),
(168, 4, 'Muksudpur Upazila', 'মুকসুদপুর', 0),
(169, 4, 'Tungipara Upazila', 'টুঙ্গিপাড়া', 0),
(170, 5, 'Dewanganj Upazila', 'দেওয়ানগঞ্জ', 0),
(171, 5, 'Baksiganj Upazila', 'বকসিগঞ্জ', 0),
(172, 5, 'Islampur Upazila', 'ইসলামপুর', 0),
(173, 5, 'Jamalpur Sadar Upazila', 'জামালপুর সদর', 0),
(174, 5, 'Madarganj Upazila', 'মাদারগঞ্জ', 0),
(175, 5, 'Melandaha Upazila', 'মেলানদাহা', 0),
(176, 5, 'Sarishabari Upazila', 'সরিষাবাড়ি ', 0),
(177, 5, 'Narundi Police I.C', 'নারুন্দি', 0),
(178, 6, 'Astagram Upazila', 'অষ্টগ্রাম', 0),
(179, 6, 'Bajitpur Upazila', 'বাজিতপুর', 0),
(180, 6, 'Bhairab Upazila', 'ভৈরব', 0),
(181, 6, 'Hossainpur Upazila', 'হোসেনপুর ', 0),
(182, 6, 'Itna Upazila', 'ইটনা', 0),
(183, 6, 'Karimganj Upazila', 'করিমগঞ্জ', 0),
(184, 6, 'Katiadi Upazila', 'কতিয়াদি', 0),
(185, 6, 'Kishoreganj Sadar Upazila', 'কিশোরগঞ্জ সদর', 0),
(186, 6, 'Kuliarchar Upazila', 'কুলিয়ারচর', 0),
(187, 6, 'Mithamain Upazila', 'মিঠামাইন', 0),
(188, 6, 'Nikli Upazila', 'নিকলি', 0),
(189, 6, 'Pakundia Upazila', 'পাকুন্ডা', 0),
(190, 6, 'Tarail Upazila', 'তাড়াইল', 0),
(191, 7, 'Madaripur Sadar', 'মাদারীপুর সদর', 0),
(192, 7, 'Kalkini', 'কালকিনি', 0),
(193, 7, 'Rajoir', 'রাজইর', 0),
(194, 7, 'Shibchar', 'শিবচর', 0),
(195, 8, 'Manikganj Sadar Upazila', 'মানিকগঞ্জ সদর', 0),
(196, 8, 'Singair Upazila', 'সিঙ্গাইর', 0),
(197, 8, 'Shibalaya Upazila', 'শিবালয়', 0),
(198, 8, 'Saturia Upazila', 'সাঠুরিয়া', 0),
(199, 8, 'Harirampur Upazila', 'হরিরামপুর', 0),
(200, 8, 'Ghior Upazila', 'ঘিওর', 0),
(201, 8, 'Daulatpur Upazila', 'দৌলতপুর', 0),
(202, 9, 'Lohajang Upazila', 'লোহাজং', 0),
(203, 9, 'Sreenagar Upazila', 'শ্রীনগর', 0),
(204, 9, 'Munshiganj Sadar Upazila', 'মুন্সিগঞ্জ সদর', 0),
(205, 9, 'Sirajdikhan Upazila', 'সিরাজদিখান', 0),
(206, 9, 'Tongibari Upazila', 'টঙ্গিবাড়ি', 0),
(207, 9, 'Gazaria Upazila', 'গজারিয়া', 0),
(208, 10, 'Bhaluka', 'ভালুকা', 0),
(209, 10, 'Trishal', 'ত্রিশাল', 0),
(210, 10, 'Haluaghat', 'হালুয়াঘাট', 0),
(211, 10, 'Muktagachha', 'মুক্তাগাছা', 0),
(212, 10, 'Dhobaura', 'ধবারুয়া', 0),
(213, 10, 'Fulbaria', 'ফুলবাড়িয়া', 0),
(214, 10, 'Gaffargaon', 'গফরগাঁও', 0),
(215, 10, 'Gauripur', 'গৌরিপুর', 0),
(216, 10, 'Ishwarganj', 'ঈশ্বরগঞ্জ', 0),
(217, 10, 'Mymensingh Sadar', 'ময়মনসিং সদর', 0),
(218, 10, 'Nandail', 'নন্দাইল', 0),
(219, 10, 'Phulpur', 'ফুলপুর', 0),
(220, 11, 'Araihazar Upazila', 'আড়াইহাজার', 0),
(221, 11, 'Sonargaon Upazila', 'সোনারগাঁও', 0),
(222, 11, 'Bandar', 'বান্দার', 0),
(223, 11, 'Naryanganj Sadar Upazila', 'নারায়ানগঞ্জ সদর', 0),
(224, 11, 'Rupganj Upazila', 'রূপগঞ্জ', 0),
(225, 11, 'Siddirgonj Upazila', 'সিদ্ধিরগঞ্জ', 0),
(226, 12, 'Belabo Upazila', 'বেলাবো', 0),
(227, 12, 'Monohardi Upazila', 'মনোহরদি', 0),
(228, 12, 'Narsingdi Sadar Upazila', 'নরসিংদী সদর', 0),
(229, 12, 'Palash Upazila', 'পলাশ', 0),
(230, 12, 'Raipura Upazila, Narsingdi', 'রায়পুর', 0),
(231, 12, 'Shibpur Upazila', 'শিবপুর', 0),
(232, 13, 'Kendua Upazilla', 'কেন্দুয়া', 0),
(233, 13, 'Atpara Upazilla', 'আটপাড়া', 0),
(234, 13, 'Barhatta Upazilla', 'বরহাট্টা', 0),
(235, 13, 'Durgapur Upazilla', 'দুর্গাপুর', 0),
(236, 13, 'Kalmakanda Upazilla', 'কলমাকান্দা', 0),
(237, 13, 'Madan Upazilla', 'মদন', 0),
(238, 13, 'Mohanganj Upazilla', 'মোহনগঞ্জ', 0),
(239, 13, 'Netrakona-S Upazilla', 'নেত্রকোনা সদর', 0),
(240, 13, 'Purbadhala Upazilla', 'পূর্বধলা', 0),
(241, 13, 'Khaliajuri Upazilla', 'খালিয়াজুরি', 0),
(242, 14, 'Baliakandi Upazila', 'বালিয়াকান্দি', 0),
(243, 14, 'Goalandaghat Upazila', 'গোয়ালন্দ ঘাট', 0),
(244, 14, 'Pangsha Upazila', 'পাংশা', 0),
(245, 14, 'Kalukhali Upazila', 'কালুখালি', 0),
(246, 14, 'Rajbari Sadar Upazila', 'রাজবাড়ি সদর', 0),
(247, 15, 'Shariatpur Sadar -Palong', 'শরীয়তপুর সদর ', 0),
(248, 15, 'Damudya Upazila', 'দামুদিয়া', 0),
(249, 15, 'Naria Upazila', 'নড়িয়া', 0),
(250, 15, 'Jajira Upazila', 'জাজিরা', 0),
(251, 15, 'Bhedarganj Upazila', 'ভেদারগঞ্জ', 0),
(252, 15, 'Gosairhat Upazila', 'গোসাইর হাট ', 0),
(253, 16, 'Jhenaigati Upazila', 'ঝিনাইগাতি', 0),
(254, 16, 'Nakla Upazila', 'নাকলা', 0),
(255, 16, 'Nalitabari Upazila', 'নালিতাবাড়ি', 0),
(256, 16, 'Sherpur Sadar Upazila', 'শেরপুর সদর', 0),
(257, 16, 'Sreebardi Upazila', 'শ্রীবরদি', 0),
(258, 17, 'Tangail Sadar Upazila', 'টাঙ্গাইল সদর', 0),
(259, 17, 'Sakhipur Upazila', 'সখিপুর', 0),
(260, 17, 'Basail Upazila', 'বসাইল', 0),
(261, 17, 'Madhupur Upazila', 'মধুপুর', 0),
(262, 17, 'Ghatail Upazila', 'ঘাটাইল', 0),
(263, 17, 'Kalihati Upazila', 'কালিহাতি', 0),
(264, 17, 'Nagarpur Upazila', 'নগরপুর', 0),
(265, 17, 'Mirzapur Upazila', 'মির্জাপুর', 0),
(266, 17, 'Gopalpur Upazila', 'গোপালপুর', 0),
(267, 17, 'Delduar Upazila', 'দেলদুয়ার', 0),
(268, 17, 'Bhuapur Upazila', 'ভুয়াপুর', 0),
(269, 17, 'Dhanbari Upazila', 'ধানবাড়ি', 0),
(270, 55, 'Bagerhat Sadar Upazila', 'বাগেরহাট সদর', 0),
(271, 55, 'Chitalmari Upazila', 'চিতলমাড়ি', 0),
(272, 55, 'Fakirhat Upazila', 'ফকিরহাট', 0),
(273, 55, 'Kachua Upazila', 'কচুয়া', 0),
(274, 55, 'Mollahat Upazila', 'মোল্লাহাট ', 0),
(275, 55, 'Mongla Upazila', 'মংলা', 0),
(276, 55, 'Morrelganj Upazila', 'মরেলগঞ্জ', 0),
(277, 55, 'Rampal Upazila', 'রামপাল', 0),
(278, 55, 'Sarankhola Upazila', 'স্মরণখোলা', 0),
(279, 56, 'Damurhuda Upazila', 'দামুরহুদা', 0),
(280, 56, 'Chuadanga-S Upazila', 'চুয়াডাঙ্গা সদর', 0),
(281, 56, 'Jibannagar Upazila', 'জীবন নগর ', 0),
(282, 56, 'Alamdanga Upazila', 'আলমডাঙ্গা', 0),
(283, 57, 'Abhaynagar Upazila', 'অভয়নগর', 0),
(284, 57, 'Keshabpur Upazila', 'কেশবপুর', 0),
(285, 57, 'Bagherpara Upazila', 'বাঘের পাড়া ', 0),
(286, 57, 'Jessore Sadar Upazila', 'যশোর সদর', 0),
(287, 57, 'Chaugachha Upazila', 'চৌগাছা', 0),
(288, 57, 'Manirampur Upazila', 'মনিরামপুর ', 0),
(289, 57, 'Jhikargachha Upazila', 'ঝিকরগাছা', 0),
(290, 57, 'Sharsha Upazila', 'সারশা', 0),
(291, 58, 'Jhenaidah Sadar Upazila', 'ঝিনাইদহ সদর', 0),
(292, 58, 'Maheshpur Upazila', 'মহেশপুর', 0),
(293, 58, 'Kaliganj Upazila', 'কালীগঞ্জ', 0),
(294, 58, 'Kotchandpur Upazila', 'কোট চাঁদপুর ', 0),
(295, 58, 'Shailkupa Upazila', 'শৈলকুপা', 0),
(296, 58, 'Harinakunda Upazila', 'হাড়িনাকুন্দা', 0),
(297, 59, 'Terokhada Upazila', 'তেরোখাদা', 0),
(298, 59, 'Batiaghata Upazila', 'বাটিয়াঘাটা ', 0),
(299, 59, 'Dacope Upazila', 'ডাকপে', 0),
(300, 59, 'Dumuria Upazila', 'ডুমুরিয়া', 0),
(301, 59, 'Dighalia Upazila', 'দিঘলিয়া', 0),
(302, 59, 'Koyra Upazila', 'কয়ড়া', 0),
(303, 59, 'Paikgachha Upazila', 'পাইকগাছা', 0),
(304, 59, 'Phultala Upazila', 'ফুলতলা', 0),
(305, 59, 'Rupsa Upazila', 'রূপসা', 0),
(306, 60, 'Kushtia Sadar', 'কুষ্টিয়া সদর', 0),
(307, 60, 'Kumarkhali', 'কুমারখালি', 0),
(308, 60, 'Daulatpur', 'দৌলতপুর', 0),
(309, 60, 'Mirpur', 'মিরপুর', 0),
(310, 60, 'Bheramara', 'ভেরামারা', 0),
(311, 60, 'Khoksa', 'খোকসা', 0),
(312, 61, 'Magura Sadar Upazila', 'মাগুরা সদর', 0),
(313, 61, 'Mohammadpur Upazila', 'মোহাম্মাদপুর', 0),
(314, 61, 'Shalikha Upazila', 'শালিখা', 0),
(315, 61, 'Sreepur Upazila', 'শ্রীপুর', 0),
(316, 62, 'angni Upazila', 'আংনি', 0),
(317, 62, 'Mujib Nagar Upazila', 'মুজিব নগর', 0),
(318, 62, 'Meherpur-S Upazila', 'মেহেরপুর সদর', 0),
(319, 63, 'Narail-S Upazilla', 'নড়াইল সদর', 0),
(320, 63, 'Lohagara Upazilla', 'লোহাগাড়া', 0),
(321, 63, 'Kalia Upazilla', 'কালিয়া', 0),
(322, 64, 'Satkhira Sadar Upazila', 'সাতক্ষীরা সদর', 0),
(323, 64, 'Assasuni Upazila', 'আসসাশুনি ', 0),
(324, 64, 'Debhata Upazila', 'দেভাটা', 0),
(325, 64, 'Tala Upazila', 'তালা', 0),
(326, 64, 'Kalaroa Upazila', 'কলরোয়া', 0),
(327, 64, 'Kaliganj Upazila', 'কালীগঞ্জ', 0),
(328, 64, 'Shyamnagar Upazila', 'শ্যামনগর', 0),
(329, 18, 'Adamdighi', 'আদমদিঘী', 0),
(330, 18, 'Bogra Sadar', 'বগুড়া সদর', 0),
(331, 18, 'Sherpur', 'শেরপুর', 0),
(332, 18, 'Dhunat', 'ধুনট', 0),
(333, 18, 'Dhupchanchia', 'দুপচাচিয়া', 0),
(334, 18, 'Gabtali', 'গাবতলি', 0),
(335, 18, 'Kahaloo', 'কাহালু', 0),
(336, 18, 'Nandigram', 'নন্দিগ্রাম', 0),
(337, 18, 'Sahajanpur', 'শাহজাহানপুর', 0),
(338, 18, 'Sariakandi', 'সারিয়াকান্দি', 0),
(339, 18, 'Shibganj', 'শিবগঞ্জ', 0),
(340, 18, 'Sonatala', 'সোনাতলা', 0),
(341, 19, 'Joypurhat S', 'জয়পুরহাট সদর', 0),
(342, 19, 'Akkelpur', 'আক্কেলপুর', 0),
(343, 19, 'Kalai', 'কালাই', 0),
(344, 19, 'Khetlal', 'খেতলাল', 0),
(345, 19, 'Panchbibi', 'পাঁচবিবি', 0),
(346, 20, 'Naogaon Sadar Upazila', 'নওগাঁ সদর', 0),
(347, 20, 'Mohadevpur Upazila', 'মহাদেবপুর', 0),
(348, 20, 'Manda Upazila', 'মান্দা', 0),
(349, 20, 'Niamatpur Upazila', 'নিয়ামতপুর', 0),
(350, 20, 'Atrai Upazila', 'আত্রাই', 0),
(351, 20, 'Raninagar Upazila', 'রাণীনগর', 0),
(352, 20, 'Patnitala Upazila', 'পত্নীতলা', 0),
(353, 20, 'Dhamoirhat Upazila', 'ধামইরহাট ', 0),
(354, 20, 'Sapahar Upazila', 'সাপাহার', 0),
(355, 20, 'Porsha Upazila', 'পোরশা', 0),
(356, 20, 'Badalgachhi Upazila', 'বদলগাছি', 0),
(357, 21, 'Natore Sadar Upazila', 'নাটোর সদর', 0),
(358, 21, 'Baraigram Upazila', 'বড়াইগ্রাম', 0),
(359, 21, 'Bagatipara Upazila', 'বাগাতিপাড়া', 0),
(360, 21, 'Lalpur Upazila', 'লালপুর', 0),
(361, 21, 'Natore Sadar Upazila', 'নাটোর সদর', 0),
(362, 21, 'Baraigram Upazila', 'বড়াই গ্রাম', 0),
(363, 22, 'Bholahat Upazila', 'ভোলাহাট', 0),
(364, 22, 'Gomastapur Upazila', 'গোমস্তাপুর', 0),
(365, 22, 'Nachole Upazila', 'নাচোল', 0),
(366, 22, 'Nawabganj Sadar Upazila', 'নবাবগঞ্জ সদর', 0),
(367, 22, 'Shibganj Upazila', 'শিবগঞ্জ', 0),
(368, 23, 'Atgharia Upazila', 'আটঘরিয়া', 0),
(369, 23, 'Bera Upazila', 'বেড়া', 0),
(370, 23, 'Bhangura Upazila', 'ভাঙ্গুরা', 0),
(371, 23, 'Chatmohar Upazila', 'চাটমোহর', 0),
(372, 23, 'Faridpur Upazila', 'ফরিদপুর', 0),
(373, 23, 'Ishwardi Upazila', 'ঈশ্বরদী', 0),
(374, 23, 'Pabna Sadar Upazila', 'পাবনা সদর', 0),
(375, 23, 'Santhia Upazila', 'সাথিয়া', 0),
(376, 23, 'Sujanagar Upazila', 'সুজানগর', 0),
(377, 24, 'Bagha', 'বাঘা', 0),
(378, 24, 'Bagmara', 'বাগমারা', 0),
(379, 24, 'Charghat', 'চারঘাট', 0),
(380, 24, 'Durgapur', 'দুর্গাপুর', 0),
(381, 24, 'Godagari', 'গোদাগারি', 0),
(382, 24, 'Mohanpur', 'মোহনপুর', 0),
(383, 24, 'Paba', 'পবা', 0),
(384, 24, 'Puthia', 'পুঠিয়া', 0),
(385, 24, 'Tanore', 'তানোর', 0),
(386, 25, 'Sirajganj Sadar Upazila', 'সিরাজগঞ্জ সদর', 0),
(387, 25, 'Belkuchi Upazila', 'বেলকুচি', 0),
(388, 25, 'Chauhali Upazila', 'চৌহালি', 0),
(389, 25, 'Kamarkhanda Upazila', 'কামারখান্দা', 0),
(390, 25, 'Kazipur Upazila', 'কাজীপুর', 0),
(391, 25, 'Raiganj Upazila', 'রায়গঞ্জ', 0),
(392, 25, 'Shahjadpur Upazila', 'শাহজাদপুর', 0),
(393, 25, 'Tarash Upazila', 'তারাশ', 0),
(394, 25, 'Ullahpara Upazila', 'উল্লাপাড়া', 0),
(395, 26, 'Birampur Upazila', 'বিরামপুর', 0),
(396, 26, 'Birganj', 'বীরগঞ্জ', 0),
(397, 26, 'Biral Upazila', 'বিড়াল', 0),
(398, 26, 'Bochaganj Upazila', 'বোচাগঞ্জ', 0),
(399, 26, 'Chirirbandar Upazila', 'চিরিরবন্দর', 0),
(400, 26, 'Phulbari Upazila', 'ফুলবাড়ি', 0),
(401, 26, 'Ghoraghat Upazila', 'ঘোড়াঘাট', 0),
(402, 26, 'Hakimpur Upazila', 'হাকিমপুর', 0),
(403, 26, 'Kaharole Upazila', 'কাহারোল', 0),
(404, 26, 'Khansama Upazila', 'খানসামা', 0),
(405, 26, 'Dinajpur Sadar Upazila', 'দিনাজপুর সদর', 0),
(406, 26, 'Nawabganj', 'নবাবগঞ্জ', 0),
(407, 26, 'Parbatipur Upazila', 'পার্বতীপুর', 0),
(408, 27, 'Fulchhari', 'ফুলছড়ি', 0),
(409, 27, 'Gaibandha sadar', 'গাইবান্ধা সদর', 0),
(410, 27, 'Gobindaganj', 'গোবিন্দগঞ্জ', 0),
(411, 27, 'Palashbari', 'পলাশবাড়ী', 0),
(412, 27, 'Sadullapur', 'সাদুল্যাপুর', 0),
(413, 27, 'Saghata', 'সাঘাটা', 0),
(414, 27, 'Sundarganj', 'সুন্দরগঞ্জ', 0),
(415, 28, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 0),
(416, 28, 'Nageshwari', 'নাগেশ্বরী', 0),
(417, 28, 'Bhurungamari', 'ভুরুঙ্গামারি', 0),
(418, 28, 'Phulbari', 'ফুলবাড়ি', 0),
(419, 28, 'Rajarhat', 'রাজারহাট', 0),
(420, 28, 'Ulipur', 'উলিপুর', 0),
(421, 28, 'Chilmari', 'চিলমারি', 0),
(422, 28, 'Rowmari', 'রউমারি', 0),
(423, 28, 'Char Rajibpur', 'চর রাজিবপুর', 0),
(424, 29, 'Lalmanirhat Sadar', 'লালমনিরহাট সদর', 0),
(425, 29, 'Aditmari', 'আদিতমারি', 0),
(426, 29, 'Kaliganj', 'কালীগঞ্জ', 0),
(427, 29, 'Hatibandha', 'হাতিবান্ধা', 0),
(428, 29, 'Patgram', 'পাটগ্রাম', 0),
(429, 30, 'Nilphamari Sadar', 'নীলফামারী সদর', 0),
(430, 30, 'Saidpur', 'সৈয়দপুর', 0),
(431, 30, 'Jaldhaka', 'জলঢাকা', 0),
(432, 30, 'Kishoreganj', 'কিশোরগঞ্জ', 0),
(433, 30, 'Domar', 'ডোমার', 0),
(434, 30, 'Dimla', 'ডিমলা', 0),
(435, 31, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 0),
(436, 31, 'Debiganj', 'দেবীগঞ্জ', 0),
(437, 31, 'Boda', 'বোদা', 0),
(438, 31, 'Atwari', 'আটোয়ারি', 0),
(439, 31, 'Tetulia', 'তেতুলিয়া', 0),
(440, 32, 'Badarganj', 'বদরগঞ্জ', 0),
(441, 32, 'Mithapukur', 'মিঠাপুকুর', 0),
(442, 32, 'Gangachara', 'গঙ্গাচরা', 0),
(443, 32, 'Kaunia', 'কাউনিয়া', 0),
(444, 32, 'Rangpur Sadar', 'রংপুর সদর', 0),
(445, 32, 'Pirgachha', 'পীরগাছা', 0),
(446, 32, 'Pirganj', 'পীরগঞ্জ', 0),
(447, 32, 'Taraganj', 'তারাগঞ্জ', 0),
(448, 33, 'Thakurgaon Sadar Upazila', 'ঠাকুরগাঁও সদর', 0),
(449, 33, 'Pirganj Upazila', 'পীরগঞ্জ', 0),
(450, 33, 'Baliadangi Upazila', 'বালিয়াডাঙ্গি', 0),
(451, 33, 'Haripur Upazila', 'হরিপুর', 0),
(452, 33, 'Ranisankail Upazila', 'রাণীসংকইল', 0),
(453, 51, 'Ajmiriganj', 'আজমিরিগঞ্জ', 0),
(454, 51, 'Baniachang', 'বানিয়াচং', 0),
(455, 51, 'Bahubal', 'বাহুবল', 0),
(456, 51, 'Chunarughat', 'চুনারুঘাট', 0),
(457, 51, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 0),
(458, 51, 'Lakhai', 'লাক্ষাই', 0),
(459, 51, 'Madhabpur', 'মাধবপুর', 0),
(460, 51, 'Nabiganj', 'নবীগঞ্জ', 0),
(461, 51, 'Shaistagonj Upazila', 'শায়েস্তাগঞ্জ', 0),
(462, 52, 'Moulvibazar Sadar', 'মৌলভীবাজার', 0),
(463, 52, 'Barlekha', 'বড়লেখা', 0),
(464, 52, 'Juri', 'জুড়ি', 0),
(465, 52, 'Kamalganj', 'কামালগঞ্জ', 0),
(466, 52, 'Kulaura', 'কুলাউরা', 0),
(467, 52, 'Rajnagar', 'রাজনগর', 0),
(468, 52, 'Sreemangal', 'শ্রীমঙ্গল', 0),
(469, 53, 'Bishwamvarpur', 'বিসশম্ভারপুর', 0),
(470, 53, 'Chhatak', 'ছাতক', 0),
(471, 53, 'Derai', 'দেড়াই', 0),
(472, 53, 'Dharampasha', 'ধরমপাশা', 0),
(473, 53, 'Dowarabazar', 'দোয়ারাবাজার', 0),
(474, 53, 'Jagannathpur', 'জগন্নাথপুর', 0),
(475, 53, 'Jamalganj', 'জামালগঞ্জ', 0),
(476, 53, 'Sulla', 'সুল্লা', 0),
(477, 53, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 0),
(478, 53, 'Shanthiganj', 'শান্তিগঞ্জ', 0),
(479, 53, 'Tahirpur', 'তাহিরপুর', 0),
(480, 54, 'Sylhet Sadar', 'সিলেট সদর', 0),
(481, 54, 'Beanibazar', 'বেয়ানিবাজার', 0),
(482, 54, 'Bishwanath', 'বিশ্বনাথ', 0),
(483, 54, 'Dakshin Surma Upazila', 'দক্ষিণ সুরমা', 0),
(484, 54, 'Balaganj', 'বালাগঞ্জ', 0),
(485, 54, 'Companiganj', 'কোম্পানিগঞ্জ', 0),
(486, 54, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 0),
(487, 54, 'Golapganj', 'গোলাপগঞ্জ', 0),
(488, 54, 'Gowainghat', 'গোয়াইনঘাট', 0),
(489, 54, 'Jaintiapur', 'জয়ন্তপুর', 0),
(490, 54, 'Kanaighat', 'কানাইঘাট', 0),
(491, 54, 'Zakiganj', 'জাকিগঞ্জ', 0),
(492, 54, 'Nobigonj', 'নবীগঞ্জ', 0),
(493, 1, 'Adabor', 'আদাবর', 1),
(494, 1, 'Badda', 'বাড্ডা', 1),
(495, 1, 'Bangshal', 'বংশাল', 1),
(496, 1, 'Biman bandar', 'বিমান বন্দর', 1),
(497, 1, 'Banani', 'বনানী', 1),
(498, 1, 'Cantonment ', 'সেনানিবাস', 1),
(499, 1, 'Chackbazar', 'চকবাজার', 1),
(500, 1, 'Dakhinkhan', 'দাখিখন', 1),
(501, 1, 'Darus salam', 'দারুস সালাম', 1),
(502, 1, 'Demra', 'ডেমরা', 1),
(503, 1, 'Dhanmondi', 'ধানমন্ডি', 1),
(504, 1, 'Bhasan tek', 'ভাসান টেক', 1),
(505, 1, 'Bhatara', 'ভাটারা', 1),
(506, 1, 'Gendaria', 'গেন্ডারিয়া', 1),
(507, 1, 'Gulshan', 'গুলশান', 1),
(508, 1, 'Hazaribagh', 'হাজারীবাগ', 1),
(509, 1, 'Jatrabari', 'যাত্রাবাড়ী', 1),
(510, 1, 'Kafrul', 'কাফরুল', 1),
(511, 1, 'Kadamtali', 'কদমতলী', 1),
(512, 1, 'Kalabagan', 'কলাবাগান', 1),
(513, 1, 'Kamrangir char', 'কামরঙ্গীর চর', 1),
(514, 1, 'Khilgaon', 'খিলগাঁও', 1),
(515, 1, 'Khil khet', 'খিল খেত', 1),
(516, 1, 'Kotwali', 'কোতোয়ালি', 1),
(517, 1, 'Lalbagh', 'লালবাগ', 1),
(518, 1, 'Mirpur', 'মিরপুর', 1),
(519, 1, 'Mohammadpur', 'মোহাম্মদপুর', 1),
(520, 1, 'Motijheel', 'মতিঝিল', 1),
(521, 1, 'Mugdha para', 'মুগ্ধ পাড়া', 1),
(522, 1, 'New market', 'নিউমার্কেট', 1),
(523, 1, 'Pallabi', 'পল্লবী', 1),
(524, 1, 'Paltan', 'পল্টন', 1),
(525, 1, 'Ramna', 'রমনা', 1),
(526, 1, 'Rampura', 'রামপুরা', 1),
(527, 1, 'Sabujbagh', 'সবুজবাগ', 1),
(528, 1, 'Rupnagar', 'রূপনগর', 1),
(529, 1, 'Shahjahanpur', 'শাহজাহানপুর', 1),
(530, 1, 'Shah ali', 'শাহ আলী', 1),
(531, 1, 'Shahbag', 'শাহবাগ', 1),
(532, 1, 'Shaympur', 'শ্যামপুর', 1),
(533, 1, 'Sher e Banglanagar', 'শের -এ  বাংলানগর', 1),
(534, 1, 'Sutrapur', 'সূত্রাপুর', 1),
(535, 1, 'Tejgaon', 'তেজগাঁও', 1),
(536, 1, 'Tejgaon ind. Area', 'তেজগাঁও ইন্ড এরিয়া', 1),
(537, 1, 'Turag', 'তুরাগ', 1),
(538, 1, 'Wari', 'ওয়ারী', 1),
(539, 1, 'Uttara Paschim', 'উত্তরা পশ্চিম', 1),
(540, 1, 'Uttara Purba', 'উত্তরা পূর্ব', 1),
(541, 1, 'Uttara Khan', 'উত্তরা খান', 1),
(542, 43, 'Bayejid Bostami', 'বায়েজিদ বোস্তামি', 1),
(543, 43, 'Bakhalia', 'বাখালিয়া', 1),
(544, 43, 'Chandgaon', 'চাঁদগাঁও', 1),
(545, 43, 'Chittagong port', 'চট্টগ্রাম বন্দর', 1),
(546, 43, 'Double Morning ', 'ডাবল মর্নিং', 1),
(547, 43, 'Halishahar', 'হালিশহর', 1),
(548, 43, 'Kotwali', 'কোতোয়ালি', 1),
(549, 43, 'Khulshi', 'খুলশী', 1),
(550, 43, 'Pahartali', 'পাহাড়তলী', 1),
(551, 43, 'Patenga', 'পতেঙ্গা', 1),
(552, 43, 'Panchlaish', 'পাঁচলাইশ', 1),
(553, 59, 'Daulatpur', 'দৌলতপুর', 1),
(554, 59, 'Khalishpur', 'খালিশপুর', 1),
(555, 59, 'Khan Jahanali', 'খান জাহানালী', 1),
(556, 59, 'Khulna Sadar', 'খুলনা সদর', 1),
(557, 59, 'Sonadanga', 'সোনাডাঙ্গা', 1),
(558, 24, 'Boalia', 'বোয়ালিয়া', 1),
(559, 24, 'Matihar', 'মতিহার', 1),
(560, 24, 'Rajpara', 'রাজপাড়া', 1),
(561, 24, 'Shah makdum', 'শাহ মাকদুম', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` int(255) DEFAULT NULL,
  `identity` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `type`, `designation`, `picture`, `remember_token`, `created_at`, `updated_at`, `address`, `last_login`, `identity`) VALUES
(26, 'Ashraful Islam', 'programmerashraful@gmail.com', '01737963893', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'Customer', 'Customer', '/6Dm08ff0K7488s04jBkoyXXjs8ouqd26KWuT9x0R.png', NULL, NULL, NULL, 'Address goes here', NULL, NULL),
(29, 'Kamruil', 'accountant@demo.com', '0737963893', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'Accountant', 'Test', '/XXBYAywEd4XUi1Iwelc3mtpiFj9JG0KtOZ2gdMv0.png', NULL, NULL, '2022-08-14 20:11:56', 'asdf', 1648206145, NULL),
(102, 'DARMS ADMIN', 'admin@darms.com', '01737963893', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Administrator', '/PrmkKzgD8GYi70RKxbx52ZVrrbmltJ3RIShIyRq2.png', NULL, NULL, '2022-10-07 20:56:48', 'Barisal Bangladesh', 1665197838, NULL),
(108, 'Kamrul Hasan', 'kamrul@gmail.com', '01737963853', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'Customer', NULL, NULL, NULL, NULL, NULL, 'Address Goes Here', NULL, 'BY-58744156');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `qrrs`
--
ALTER TABLE `qrrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `qrrs`
--
ALTER TABLE `qrrs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD CONSTRAINT `upazilas_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
