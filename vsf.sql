-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 11:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vsf`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` varchar(20) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `CONTACT_NO` varchar(15) DEFAULT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `USERNAME`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `CONTACT_NO`, `ADDRESS`, `STATUS`) VALUES
('ADMIN_817236', 'admin123', '$2a$12$HxxZTdIgfAk9XmvgEeOvCunXlBGsTOma.i3TJtTZepPh6BqjpqXpa', 'Admin', 'Admin', 'admin@gmail.com', '09123456789', 'Marilao, Bulacan', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ROW` int(11) NOT NULL,
  `SPOT_ID` varchar(20) NOT NULL,
  `USER_ID` varchar(20) NOT NULL,
  `REVIEW` text NOT NULL,
  `PICTURE` varchar(2048) DEFAULT NULL,
  `RATE` int(5) NOT NULL,
  `DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ROW`, `SPOT_ID`, `USER_ID`, `REVIEW`, `PICTURE`, `RATE`, `DATE`) VALUES
(26, 'SPOT485418', 'USER_393156', 'good', NULL, 4, '2023-12-20 03:54:52'),
(27, 'SPOT881901', 'USER_393156', 'Nice View', NULL, 5, '2023-12-20 04:02:12'),
(28, 'SPOT207487', 'USER_393156', 'Nice mall', NULL, 5, '2023-12-20 04:02:32'),
(29, 'SPOT207487', 'USER_393156', 'crowded', NULL, 4, '2023-12-20 04:02:56'),
(30, 'SPOT756866', 'USER_393156', 'Great spot', NULL, 5, '2023-12-26 00:51:34'),
(31, 'SPOT725599', 'USER_393156', 'Great variety of food', NULL, 4, '2023-12-26 00:51:59'),
(32, 'SPOT570750', 'USER_712394', 'asdcasda', NULL, 3, '2024-01-25 02:26:02'),
(33, 'SPOT570750', 'USER_712394', 'sadcasd', NULL, 4, '2024-01-25 02:57:00'),
(34, 'SPOT534601', 'USER_712394', 'ascdasdc', 'review_1706151692.png', 4, '2024-01-25 03:01:32'),
(35, 'SPOT570750', 'USER_712394', 'yeyey', 'review_1706151814.png', 5, '2024-01-25 03:03:34'),
(36, 'SPOT570750', 'USER_393156', 'good', 'review_1706085843.jpg', 4, '2024-01-24 09:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `spot_image`
--

CREATE TABLE `spot_image` (
  `ID` int(255) NOT NULL,
  `SPOT_ID` varchar(20) NOT NULL,
  `IMG` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spot_image`
--

INSERT INTO `spot_image` (`ID`, `SPOT_ID`, `IMG`) VALUES
(9, 'SPOT599614', '272003683.png'),
(10, 'SPOT599614', '619654833.jpg'),
(11, 'SPOT292716', '648270255.JPG'),
(12, 'SPOT292716', '888231266.jpeg'),
(13, 'SPOT662190', '664810461.png'),
(14, 'SPOT714022', '585744791.jpg'),
(15, 'SPOT714022', '681369027.jpg'),
(16, 'SPOT859220', '405450856.jpg'),
(17, 'SPOT296328', '544630052.png'),
(18, 'SPOT859220', '756335499.jpg'),
(19, 'SPOT296328', '404160756.jpg'),
(20, 'SPOT485418', '103176789.jpg'),
(21, 'SPOT881901', '965233013.jpg'),
(22, 'SPOT812773', '621832834.jpg'),
(23, 'SPOT207487', '592513829.jpg'),
(24, 'SPOT207487', '658867370.jpg'),
(25, 'SPOT812773', '205512313.png'),
(26, 'SPOT881901', '495021670.jpg'),
(27, 'SPOT992784', '553630015.png'),
(28, 'SPOT725599', '957202158.jpg'),
(29, 'SPOT534601', '307314788.jpg'),
(30, 'SPOT756866', '128934107.jpg'),
(31, 'SPOT398622', '997520590.png'),
(32, 'SPOT570750', '514941908.jpg'),
(33, 'SPOT570750', '319980986.jpg'),
(34, 'SPOT379659', '532676194.jpg'),
(35, 'SPOT703298', '865116134.jpg'),
(36, 'SPOT149756', '598507438.jpg'),
(37, 'SPOT711002', '504392039.jpg'),
(38, 'SPOT733593', '226918282.png'),
(39, 'SPOT223071', '563236328.jpg'),
(40, 'SPOT483821', '217069729.jpg'),
(41, 'SPOT541040', '121258889.jpg'),
(42, 'SPOT224347', '772492907.jpg'),
(43, 'SPOT721796', '795673756.jpg'),
(44, 'SPOT490964', '609620502.jpg'),
(45, 'SPOT124766', '784465982.jpg'),
(46, 'SPOT495555', '826164723.png'),
(47, 'SPOT962656', '419462448.png'),
(48, 'SPOT460284', '111498780.jpg'),
(49, 'SPOT167702', '236329307.png'),
(50, 'SPOT406195', '783775984.png'),
(51, 'SPOT932554', '673271433.png'),
(52, 'SPOT745355', '380764999.jpg'),
(53, 'SPOT561404', '581954935.jpg'),
(54, 'SPOT743106', '298384228.jpg'),
(55, 'SPOT898754', '392253354.jpg'),
(56, 'SPOT549607', '372374575.jpg'),
(57, 'SPOT356894', '954966659.jpg'),
(58, 'SPOT421986', '770446241.png'),
(59, 'SPOT832783', '466726999.jpg'),
(60, 'SPOT335295', '649415682.jpg'),
(61, 'SPOT941898', '297287835.png'),
(62, 'SPOT227236', '210637932.png'),
(63, 'SPOT415783', '535524690.jpg'),
(64, 'SPOT502148', '181359594.jpg'),
(65, 'SPOT552578', '794373665.png'),
(66, 'SPOT456475', '367610973.jpg'),
(67, 'SPOT587202', '243329984.jpg'),
(68, 'SPOT778555', '369014551.png'),
(69, 'SPOT737860', '283111952.jpg'),
(70, 'SPOT423258', '956923625.jpg'),
(71, 'SPOT851780', '701685485.jpg'),
(72, 'SPOT521114', '239666231.jpg'),
(73, 'SPOT581910', '341331498.jpg'),
(74, 'SPOT187586', '151291052.jpg'),
(75, 'SPOT156929', '910709250.png'),
(76, 'SPOT621356', '927138248.png');

-- --------------------------------------------------------

--
-- Table structure for table `tourist_spot`
--

CREATE TABLE `tourist_spot` (
  `SPOT_ID` varchar(20) NOT NULL,
  `SPOT_NAME` varchar(255) NOT NULL,
  `LOCATION` varchar(255) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `BUDGET` int(11) NOT NULL,
  `ENTRANCE_FEE` int(11) NOT NULL DEFAULT 0,
  `AMENITIES` varchar(255) NOT NULL,
  `PHOTO` varchar(255) NOT NULL,
  `BUSINESS_PERMIT` varchar(255) NOT NULL,
  `SPOT_TYPE` varchar(60) NOT NULL,
  `CATEGORY` varchar(60) NOT NULL,
  `TOA` varchar(60) NOT NULL,
  `VISITS` int(255) NOT NULL,
  `MAP` text NOT NULL,
  `STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourist_spot`
--

INSERT INTO `tourist_spot` (`SPOT_ID`, `SPOT_NAME`, `LOCATION`, `DESCRIPTION`, `BUDGET`, `ENTRANCE_FEE`, `AMENITIES`, `PHOTO`, `BUSINESS_PERMIT`, `SPOT_TYPE`, `CATEGORY`, `TOA`, `VISITS`, `MAP`, `STATUS`) VALUES
('SPOT156929', 'Pandin Lake', 'Brgy. San Lorenzo San Pablo City', 'Pandin and Yambo are twin crater lakes separated by a narrow strip of land. They are part of the Seven Lakes system in San Pablo, and are situated at Brgy. San Lorenzo in San Pablo City of Laguna province in the Philippines. Lake Pandin is said to be \"the most pristine\" of the seven lakes of San Pablo.', 100, 0, ' ', '', 'SPOT156929.pdf', 'Lake', '', '', 1, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.3675365887807!2d121.36540932586902!3d14.114470138792019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5b91a283d981%3A0x601f168e6da1412d!2sPandin%20Lake!5e0!3m2!1sen!2sph!4v1706206802264!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT187586', 'Shopping Mall', 'A. Regidor St, corner A. Flores, San Pablo City, Laguna', 'Philippines-based chain known for its burgers, fried chicken, spaghetti & Filipino dishes.', 200, 0, 'In-store shopping\r\nAccessibility\r\nWheelchair accessible entrance\r\nWheelchair accessible parking lot\r\nOfferings\r\nArcade games', '', 'SPOT187586.pdf', 'Mall', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.616647106699!2d121.3241295!3d14.0680724!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5cccf5f90ebd%3A0xb2c403223d46487d!2sSan%20Pablo%20City%20Shopping%20Mall!5e0!3m2!1sen!2sph!4v1706207367368!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT227236', 'Calibato Lake', ' Brgy. Sto. Angel in San Pablo City', 'Calibato Lake is the deepest of all the seven lakes with an average depth of 156 meters. It has the greatest volume of water in storage which is approximately 29,600 cubic meters. Calibato Lake supplies the city and nearby towns with abundant fish.', 300, 0, ' ', '', 'SPOT227236.pdf', 'Lake', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15478.226342988693!2d121.3775!3d14.103333049999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5ba1fef52193%3A0xfde3613255f398c2!2sLake%20Calibato!5e0!3m2!1sen!2sph!4v1706206407686!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT335295', 'Palmeras Garden Restaurant', 'MAHARLIKA HIGHWAY, BRGY. SAN RAFAEL, SAN PABLO CITY, LAGUNA', 'Palmeras Garden Restaurant, San Pablo City, Laguna is one of the popular place listed under Residence in San Pablo City , Asian Restaurant in San Pablo City , Lodging in San Pablo City ,', 1000, 0, 'Reservations, Outdoor Seating, Seating, Parking Available, Takeout, Table Service, Live Music', '', 'SPOT335295.pdf', 'Restaurant', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.42786325163!2d121.3051343!3d14.0708604!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5d2b754dbb4f%3A0x63bde1a78b3a6ace!2sPalmeras%20Garden%20Restaurant!5e0!3m2!1sen!2sph!4v1706186839700!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT356894', 'Auravel Grande Hotel ', 'MAHARLIKA HIGHWAY, BRGY. SAN FRANCISCO, SAN PABLO CITY, LAGUNA', ' The name AURAVEL was derived from the family\'s Inay Aurea and Tatay Avelino. Located in the City of Seven Lakes approximately 10 minutes\' drive from the city proper. Auravel is designed to induce and raise the unique senses by its ambiance. The hotel takes the guest to an exclusive level of service to pamper their body and to rejuvenate their minds. It has an exceptional interior design for all ages that reflects the touching service within.\r\n\r\nContact number: (049) 5030579\r\nEmail Address: auravelresort@gmail.com', 500, 0, 'Bar onsite \r\nRestroom\r\n', '', 'SPOT356894.pdf', 'Hotel', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15481.14163634227!2d121.3272419!3d14.0603164!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd43373108fed7%3A0x75e878ad551322ab!2sAura%20Vel%20Fusion%20Cuisine!5e0!3m2!1sen!2sph!4v1706184525217!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT415783', 'Tahan ni Aling Meding', 'DAGATAN BLVD., SAMPALOC LAKE, SAN PABLO CITY, LAGUNA', 'Tahanan ni Aling Meding puts the best of San Pablo City at your fingertips, making your stay both relaxing and enjoyable.\r\n\r\nContact number: 09399387362\r\nEmail Address: admin@tahanan.info ', 2800, 0, 'Free Wi-Fi \r\nFree breakfast \r\nFree parking \r\nPool \r\nAir-conditioned \r\nLaundry service\r\nKid-friendly Restaurant', '', 'SPOT415783.pdf', 'Hotel', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15479.970479298216!2d121.3243755!3d14.0776129!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5cc6493478e7%3A0xc41082c9a061fb2!2sAng%20Tahanan%20ni%20Aling%20Meding%20Hotel%20and%20Restaurant!5e0!3m2!1sen!2sph!4v1706186125083!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT421986', 'Mohicap Lake', 'San Pablo City', 'Mohicap Lake is also a major source of tilapia for Metro Manila and suburbs', 0, 0, ' ', '', 'SPOT421986.pdf', 'Lake', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5471.980671609929!2d121.33475930402774!3d14.119939657347132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5c4300000001%3A0x4fa93a90f8273dbb!2sLake%20Mohicap!5e0!3m2!1sen!2sph!4v1706206573871!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT423258', 'Sulyap Gallery Cafe, Boutique Hotels and Restaurant', 'COCOLAND COMPOUND, BRGY. DEL REMEDIO, SAN PABLO CITY, LAGUNA ', 'To travel to new destinations is to absorb the beauty and history of a place, but some places truly take us back in time and allow us to get a glimpse of another world in a different era—Sulyap Gallery Cafe, Boutique Hotels and Restaurant is one proof.\r\n\r\nContact number: 09171821483\r\nEmail Address: sulyap.net@gmail.com\r\n', 750, 0, ' Free Wi-Fi\r\n Free breakfast\r\n Free parking\r\n Pool\r\n Laundry service\r\n Kid-friendly\r\n Restaurant\r\n', '', 'SPOT423258.pdf', 'Restaurant', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.038431599796!2d121.3126512!3d14.0766099!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5cd76c0e1793%3A0xceaf32c794c3c4f4!2sSulyap%20Gallery%20Caf%C3%A9%2C%20Boutique%20Hotels%20and%20Restaurant!5e0!3m2!1sen!2sph!4v1706187061233!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT456475', 'Villa Evanzueda', 'SITIO BALOC, SAN PABLO CITY, LAGUNA', 'Villa Evanzueda is a Wedding reception venue located in Sitio Baloc, Brgy. San Ignacio, San Pablo City, Laguna.\r\n\r\nContact number: (049) 8004341 09175973343\r\nEmail Address: villaevanzueda@yahoo.Com\r\n', 2000, 0, 'Wheelchair accessible entrance \r\nWheelchair accessible parking lot\r\n', '', 'SPOT456475.pdf', 'Hotel', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15481.459179334666!2d121.3480619!3d14.0556231!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd435134048679%3A0x98a71e63a386360e!2sVilla%20Evanzueda!5e0!3m2!1sen!2sph!4v1706186367792!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT502148', 'SI CHRISTINA GATEAU SANS RIVAL', '6 JP RIZAL BRGY IV -C, SAN PABLO CITY, LAGUNA ', 'Found at the heart of San Pablo City is the Si Christina Gateau Sans Rival restaurant. Si Christina Gateau Sans Rival is a cozy restaurant found by Proprietress Maria Christina Capino De Roma last October 16, 2010. She decided to share her talent to the public and to give San Pableños a different twist on new breeds of mouth watering Pastries and Cakes.\r\n\r\nContact number: (049) 503 3161\r\nEmail Address: sichristina@yahoo.com\r\n', 2255, 0, 'Breakfast\r\nBrunch\r\nLunch\r\nDinner\r\nDessert\r\n', '', 'SPOT502148.pdf', 'Restaurant', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.46751902769!2d121.3255915!3d14.0702748!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5ccbf84278cd%3A0x71354001ef730ab9!2sSi%20Christina%20Gateau%20Sans%20Rival!5e0!3m2!1sen!2sph!4v1706187300896!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT521114', 'SM CITY SAN PABLO', 'National Hwy, San Pablo City, 4000 Laguna', 'SM City San Pablo is the 38th shopping mall owned by SM Prime Holdings. It is the 2nd SM Supermall in the province of Laguna. It is located at the entrance of Riverina Residential and Commercial Estates in Maharlika Highway, Barangay San Rafael, San Pablo, Laguna and has a gross floor area of 59,776 square meters', 0, 0, 'In-store shopping\r\nAccessibility\r\nWheelchair accessible entrance\r\nWheelchair accessible parking lot\r\nOfferings\r\nArcade games\r\nAmenities\r\nRestroom', '', 'SPOT521114.pdf', 'Mall', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.393027677044!2d121.3014763!3d14.0713748!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5d2cd946c37d%3A0xd168f8100c3ed3af!2sSM%20City%20San%20Pablo!5e0!3m2!1sen!2sph!4v1706207253758!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT549607', 'SAMUEL’S GASTROPUB', 'BRGY. SAN ROQUE, SAN PABLO CITY, LAGUNA', '  \r\nThis place is well known for its great service and friendly staff, that is always ready to help you. In accordance with the visitors\' opinions, prices are average. As people find it, the ambiance is nice here. Google users assigned the score of 4.1 to this spot.\r\n\r\nContact number: 09171539966 / 300 8020\r\nEmail Address: customerservice@samuelsgastropub.com', 800, 0, 'Reservations, Seating, Takeout, Serves Alcohol, Table Service', '', 'SPOT549607.pdf', 'Restaurant', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.363669745548!2d121.3103536!3d14.0718083!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd428500000001%3A0x6b01895f1775c71e!2sSamuel&#39;s%20Plate%20Gastropub!5e0!3m2!1sen!2sph!4v1706187527945!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT552578', 'Cusina de Sabang', '602 SABANG ROAD, BRGY. CONCEPCION, SAN PABLO CITY, LAGUNA', 'The place is perfect for family or group gatherings and also for those who are looking for a quiet place to dine with lake view as well. Cusina de Sabang is located at Brgy. Concepcion, San Pablo City. The lake that you will get to see is the Bunot Lake, one of the Seven Lakes in San Pablo City.\r\n\r\nContact number: 09213436728\r\n', 800, 0, 'CUISINES\r\nFilipino, Asian\r\nMEALS\r\nLunch, Dinner, Breakfast\r\nFEATURES\r\nReservations, Seating\r\n', '', 'SPOT552578.pdf', 'Restaurant', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.026203245507!2d121.3442516!3d14.0767904!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5cbb4e0d85bd%3A0xcff323e1dc05f41f!2sCusina%20de%20Sabang%20602!5e0!3m2!1sen!2sph!4v1706187739483!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT581910', 'Yambo Lake', 'Brgy. San Lorenzo in San Pablo City of Laguna ', 'Yambo Lake and Pandin Lake are known as “The Twin Lakes”. Both lakes are considered oligotropic because of their deep clear lakes with low nutrient supplies, high dissolved oxygen level and containing little organic matter. Pandin Lake is San Pablo’s best kept lake.', 0, 0, ' ', '', 'SPOT581910.pdf', 'Lake', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15477.366241685728!2d121.367!3d14.11599975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5b91f529bda1%3A0x425e6fc8eac10585!2sLakes%20Pandin%20and%20Yambo!5e0!3m2!1sen!2sph!4v1706206977162!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT587202', 'Sampaloc Lake', 'San Pablo City', 'Sampaloc Lake is the largest among San Pablo’s Seven Crater Lakes. It is considered one of the prime tourist spots in the city. It abounds with tilapia, big head carp and several species of freshwater fish like ayungin, dalag and hito including shrimps.', 0, 0, '  ', '', 'SPOT587202.pdf', 'Lake', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7739.96400927889!2d121.3300445!3d14.078239600000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5cc76dc9956d%3A0x48ec8284f765e568!2sSampaloc%20Lake!5e0!3m2!1sen!2sph!4v1706207122951!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT621356', 'Bunot Lake', 'San Pablo City, Laguna', 'Lake Bunot is a volcanic crater lake and is one of the Seven Lakes of San Pablo, Laguna in the Philippines. It is located in Brgy. Concepcion, San Pablo City. Only 4.5 kilometres from the city proper, Bunot is known for its cultured tilapia and fishpens for Nilotica fingerlings.', 0, 0, ' ', '', 'SPOT621356.pdf', 'Lake', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.9349006287616!2d121.3437836!3d14.0810202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5ca325b3703f%3A0x4ea3603ff7a68d8c!2sBunot%20Lake!5e0!3m2!1sen!2sph!4v1706206135014!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT737860', 'Pearl Platinum Hotel', 'JASMIN ST. DONA MARIA VILLAGE, BRGY BAGONG BAYAN, SAN PABLO CITY, LAGUNA', ' \r\nPearl Platinum Hotel, located in Laguna city center, is a popular choice for travelers. With its convenient location, the hotel offers easy access to the city\'s must-see destinations.\r\nEvery effort is made to make guests feel comfortable by providing the best in services and amenities. Keep up with all your communications easily with the hotel\'s free Wi-Fi. Guests can enjoy free parking right at the hotel. Feeling lazy? In-room conveniences like 24-hour room service and room service let you get the most out of your room time.\r\nFor the comfort and health of all guests, smoking is not permitted anywhere within the hotel.\r\n\r\nContact number: (049) 5466735\r\n09171305542\r\n09338100444\r\n', 4000, 0, 'Internet access\r\nFree Wi-Fi in all rooms!\r\nInternet\r\nDining, drinking, and snacking\r\nCoffee shop\r\nRoom service [24-hour]\r\nServices and conveniences\r\nElevator\r\nSmoke-free property\r\nSmoking area\r\nFor the kids\r\nFamily room\r\nAccess\r\nCheck-in [24-hour]\r\nFront ', '', 'SPOT737860.pdf', 'Hotel', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.730773136358!2d121.3165308!3d14.0663867!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd432cd7458551%3A0xb83b46a71d720769!2sPearl%20Platinum%20Hotel!5e0!3m2!1sen!2sph!4v1706184949085!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT778555', 'Casa San Pablo', 'COLAGO AVENUE, SANPABLO CITY, LAGUNA', 'Casa San Pablo is a bed & breakfast at the heart of San Pablo City, Laguna. It is run by innkeepers devoted to making you experience the hospitality, warmth, and creativity of their hometown.\r\n\r\nContact number: 09178126687\r\nEmail Address: info@casasanpablo.co m.ph\r\n', 3500, 0, 'Free High Speed Internet (WiFi)\r\nPool\r\nRestaurant\r\nPets Allowed ( Dog / Pet Friendly )\r\nMeeting rooms\r\nMassage\r\nBaggage storage\r\nNon-smoking hotel\r\nWifi\r\nOutdoor pool\r\n', '', 'SPOT778555.pdf', 'Hotel', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.35456081851!2d121.3148561!3d14.0719428!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5cd15ac9b459%3A0x5d9336e260edbe5d!2sCasa%20San%20Pablo%20Bed%20%26%20Breakfast!5e0!3m2!1sen!2sph!4v1706184157237!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT832783', 'El COCO Grande', 'BRGY. SAN ANTONIO II, SAN PABLO CITY, LAGUNA', 'El Coco Grande Hotel and Resort is one of the best hotels in San Pablo City, Province of Laguna. That can guarantee guests first-class standard services with luxury amenities and traditional hospitality to assure pleasure and comfort during their stay. Owned and operated by Mr. Leopoldo Estrellado, one of San Pablo City’s successful businessmen, it is the “Best Place to stay, unwind and relax...”\r\nContact number: (049) 5470103\r\nEmail Address: infoelcocograndehotel. com ', 2000, 0, 'Free Wi-Fi \r\nFree parking \r\nPool \r\nKid-friendly Restaurant', '', 'SPOT832783.pdf', 'Hotel', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15485.677115161558!2d121.3328869!3d13.9931355!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd43fb19b9df47%3A0x84f5fe2b1b0ff01a!2sEl%20Coco%20Grande%20Hotel%20and%20Resort!5e0!3m2!1sen!2sph!4v1706185958923!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT851780', 'Casa Palmeras Hotel', 'BRGY. SAN ANTONIO II, SAN PABLO CITY,LAGUNA', ' Casa Palmeras Hotel is a great choice for a stay in San Pablo. Guests can grab a bite to eat at the restaurant and visit the fitness center for a workout. Other features include an outdoor pool, a children\'s pool, and a garden.\r\n\r\nContact number: (049) 5470103\r\nEmail Address: infoelcocograndehotel.com ', 2000, 0, 'Free Wi-Fi \r\nFree parking \r\nPool Kid-friendly Restaurant', '', 'SPOT851780.pdf', 'Hotel', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.421782014553!2d121.2861881!3d14.0709502!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd42caade56439%3A0x36d70d59196b4803!2sCASA%20PALMERA%20HOTEL!5e0!3m2!1sen!2sph!4v1706185669673!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active'),
('SPOT941898', 'Palaklapakin Lake', 'San Pablo City', 'Lake Palaklapakin is the shallowest among the seven lakes, is utilized as communal fishing ground. An increasing construction of fishcages resulted to limited open fishing ground for the fisherfolks.', 0, 0, ' ', '', 'SPOT941898.pdf', 'Lake', '', '', 0, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.443285893668!2d121.3398845!3d14.1100087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5c647d0e56a3%3A0x67f841abbb5a0544!2sPalakpakin%20Lake!5e0!3m2!1sen!2sph!4v1706206714266!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_ID` varchar(20) NOT NULL,
  `PROFILE_IMG` varchar(2048) DEFAULT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CONTACT_NO` varchar(15) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `FAVORITE_NUMBER` int(60) NOT NULL,
  `FAVORITE_LETTER` varchar(10) NOT NULL,
  `FAVORITE_PERSON` varchar(60) NOT NULL,
  `DATE_CREATED` date DEFAULT NULL,
  `STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `PROFILE_IMG`, `USERNAME`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `CONTACT_NO`, `ADDRESS`, `FAVORITE_NUMBER`, `FAVORITE_LETTER`, `FAVORITE_PERSON`, `DATE_CREATED`, `STATUS`) VALUES
('USER_362342', NULL, 'phen', '$2y$10$3COIUMbObOsfaBTJTIay5O1H3VPVRGXs9vYF8dFBCd.Q3oDKVnwgu', 'phen', 'Deriquito', 'deriquitorhowell@gmail.com', '12323452', 'Rizal, Laguna', 8, 'r', 'me', '2024-01-24', 'active'),
('USER_393156', NULL, 'Rhowell', '$2a$12$HxxZTdIgfAk9XmvgEeOvCunXlBGsTOma.i3TJtTZepPh6BqjpqXpa', 'Rhowell', 'Deriquito', 'deriquitorhowell@gmail.com', '09477119131', 'Rizal, Laguna', 8, 'R', 'Trisha', '2023-12-15', 'active'),
('USER_712394', 'https://lh3.googleusercontent.com/a/ACg8ocL5P5X9l31v6-efdVQ5ubaTHfB380JZSSZ-BTR3K61PrDGU=s96-c', 'maverickfabroa@gmail.com', '$2y$10$2HDAVGk5pzz/UYeqk9xk0./nCyni9egSYqyW7M8XZoPb0.XiUC0Rm', 'Maverick', 'Fabroa', 'maverickfabroa@gmail.com', '', '', -1, '', '', '2024-01-25', 'active'),
('USER_737598', NULL, 'Rhowell', '$2y$10$YEgm130z/XQa8ukXJthR8.b1N03i3VGDvQwIVl99Idq0yI9hlr./K', 'Rhowell', 'Deriquito', 'bsit.deriquito.rhowell@gmail.com', '099485673521', 'Rizal, Laguna', 8, 'r', 'me', '2024-01-24', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ROW`);

--
-- Indexes for table `spot_image`
--
ALTER TABLE `spot_image`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tourist_spot`
--
ALTER TABLE `tourist_spot`
  ADD PRIMARY KEY (`SPOT_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ROW` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `spot_image`
--
ALTER TABLE `spot_image`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
