-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2020 at 08:21 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unisa`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `place` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `pageid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `subject`, `date`, `place`, `likes`, `pageid`) VALUES
(1, 'Bahaa', 'qdasdasda', '2020-09-12 07:38:07', 0, 0, '0301101 '),
(2, 'Bahaa', 'asdasd', '2020-09-12 07:38:09', 0, 2, '0301101 '),
(6, 'Bahaa', 'asdas', '2020-09-12 07:38:36', 0, 1, '0301101 '),
(7, 'Bahaa', 'asda', '2020-09-12 07:38:43', 6, 0, '0301101 '),
(8, 'Bahaa', 'asdasd', '2020-09-12 07:39:00', 6, 0, '0301101 '),
(9, 'Bahaa', 'شسيش', '2020-09-12 07:40:42', 6, 0, '0301101 ');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` varchar(10) NOT NULL,
  `name` tinytext NOT NULL,
  `university` tinytext NOT NULL,
  `hours` int(11) NOT NULL,
  `rate` text NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `university`, `hours`, `rate`) VALUES
('0300102', 'الثقافة البيئية', 'Jordan University', 3, '0'),
('0301101', 'تفاضل وتكامل 1', 'Jordan University', 3, '0'),
('0301102', 'تفاضل وتكامل 2', 'Jordan University', 3, '0'),
('0301131', 'مبادئ الاحصاء', 'Jordan University', 3, '0'),
('0301201', 'تفاضل وتكامل 3', 'Jordan University', 3, '0'),
('0301241', 'الجبر الخطي 1', 'Jordan University', 3, '0'),
('0302101', 'الفيزياء العامة 1', 'Jordan University', 3, '0'),
('0302102', 'الفيزياء العامة 2', 'Jordan University', 3, '0'),
('0302111', 'الفيزياء العملية 1', 'Jordan University', 1, '0'),
('0302112', 'الفيزياء العملية 2', 'Jordan University', 1, '0'),
('0303101', 'الكيمياء العامة', 'Jordan University', 3, '0'),
('0400101', 'الاسلام وقضايا العصر', 'Jordan University', 3, '0'),
('0400102', 'الثقافة الاسلامية', 'Jordan University', 3, '0'),
('0720100', 'الثقافة الصحية', 'Jordan University', 3, '0'),
('0901420', 'الاقتصاد الهندسي', 'Jordan University', 3, '0'),
('0903261', 'الكترونيات 1', 'Jordan University', 3, '0'),
('0904131', 'الرسم الهندسي والهندسة الوصفية', 'Jordan University', 3, '0'),
('0906111', 'المشاغل الهندسية', 'Jordan University', 1, '0'),
('0907101', 'المهارات الحاسوبية للمهندسين', 'Jordan University', 3, '0'),
('0907231', 'المنطق الرقمي', 'Jordan University', 3, '0'),
('0907234', 'مختبر المنطق الرقمي', 'Jordan University', 1, '0'),
('0907311', 'مختبر تطبيقات الحاسوب', 'Jordan University', 1, '0'),
('0907312', 'الكتابة الفنية والاخلاقيات', 'Jordan University', 1, '0'),
('0907313', 'التحليل العددي العملي', 'Jordan University', 1, '0'),
('0907321', 'امظمة اتصالات البيانات', 'Jordan University', 3, '0'),
('0907333', 'الانظمة المضمنة', 'Jordan University', 3, '0'),
('0907334', 'مختبر الانظمة المضمنة', 'Jordan University', 1, '0'),
('0907342', 'حل المشاكل بالبرمجة الشيئية', 'Jordan University', 3, '0'),
('0907346', 'تراكيب البيانات والخوارزميات', 'Jordan University', 3, '0'),
('0907422', 'شبكات الحاسوب', 'Jordan University', 3, '0'),
('0907439', 'مختبر تنظيم الحاسوب', 'Jordan University', 1, '0'),
('0907443', 'نظام التشغيل الحديث', 'Jordan University', 3, '0'),
('0907445', 'نظم قواعد بيانات', 'Jordan University', 3, '0'),
('0907451', 'الذكاء الاصطناعي وتعلم الالة', 'Jordan University', 3, '0'),
('0907462', 'مختبر الالكترونيات ودوائر التكامل الكبير جدا', 'Jordan University', 1, '0'),
('0907500', 'التدريب العملي', 'Jordan University', 3, '0'),
('0907520', 'امن المعلومات والشبكات', 'Jordan University', 3, '0'),
('0907523', 'الحوسية السحابية', 'Jordan University', 3, '0'),
('0907524', 'الشبكات اللاسلكية', 'Jordan University', 3, '0'),
('0907526', 'الأدلة الرقمية', 'Jordan University', 3, '0'),
('0907528', 'مختبر شبكات الحاسوب', 'Jordan University', 1, '0'),
('0907529', 'مختبر الشبكات المتقدم', 'Jordan University', 1, '0'),
('0907531', 'مواضيع مختارة في هندسة الحاسوب', 'Jordan University', 3, '0'),
('0907536', 'المعالجات المتوازية', 'Jordan University', 3, '0'),
('0907537', 'مختبر المعالجات المتوازية', 'Jordan University', 1, '0'),
('0907543', 'المترجمات محسنة الكفاءة', 'Jordan University', 3, '0'),
('0907544', 'تحليل ومعالجة الصور الرقمية', 'Jordan University', 3, '0'),
('0907546', 'تحليل البيانات الكبيرة', 'Jordan University', 3, '0'),
('0907547', 'برمجة الهواتف الخلوية', 'Jordan University', 3, '0'),
('0907548', 'البرمجة التنافسية', 'Jordan University', 3, '0'),
('0907549', 'رؤية الالة', 'Jordan University', 3, '0'),
('0907552', 'مواضيع متقدمة في تعلم الالة', 'Jordan University', 3, '0'),
('0908321', 'الالات الكهربائية', 'Jordan University', 3, '0'),
('0913213', 'دارات كهربائية', 'Jordan University', 3, '0'),
('0913214', 'مختبر دارات كهربائية', 'Jordan University', 1, '0'),
('0917335', 'معمارية وتنظيم الحاسوب 1', 'Jordan University', 3, '0'),
('0917432', 'معمارية وتنظيم الحاسوب 2', 'Jordan University', 3, '0'),
('0917433', 'انظمة التحكم باستخدام الحاسوب', 'Jordan University', 3, '0'),
('0917434', 'التصميم الرقمي المتقدم', 'Jordan University', 3, '0'),
('0917441', 'هندسة البرمجيات', 'Jordan University', 3, '0'),
('0917461', 'الالتترونيات الرقمية ودوائر التكامل الكبير جدا', 'Jordan University', 3, '0'),
('0917521', 'انترنت الاشياء', 'Jordan University', 3, '0'),
('0917522', 'برمجة بروتوكلات الشبكات', 'Jordan University', 3, '0'),
('0918562', 'الروبوتات والانظمة الالية', 'Jordan University', 3, '0'),
('0953221', 'تحليل اشارات وانظمة', 'Jordan University', 3, '0'),
('0953321', 'احتمالات ومتغيرات عشوائية', 'Jordan University', 3, '0'),
('0977598', 'مشروع 1', 'Jordan University', 1, '0'),
('0977599', 'مشروع 2', 'Jordan University', 2, '0'),
('1000102', 'الثقافة القانونية', 'Jordan University', 3, '0'),
('1100100', 'الثافة البدنية', 'Jordan University', 3, '0'),
('1600100', 'التجارة الالكترونية', 'Jordan University', 3, '0'),
('1601105', 'مهارات ادارية', 'Jordan University', 3, '0'),
('1900101', 'وسائل التواصل الاجتماعي', 'Jordan University', 3, '0'),
('1901101', 'رياضيات منفصلة', 'Jordan University', 3, '0'),
('1932099', 'اساسيات الحاسوب', 'Jordan University', 0, '0'),
('2000100', 'تذوق الفنون', 'Jordan University', 3, '0'),
('2200103', 'لغة اجنبية', 'Jordan University', 3, '0'),
('2220100', 'العلوم العسكرية', 'Jordan University', 3, '0'),
('2300101', 'الحضارة العربية الاسلامية', 'Jordan University', 3, '0'),
('2300102', 'الاردن تاريخ وحضارة', 'Jordan University', 3, '0'),
('3201099', 'اساسيات اللغة العربية', 'Jordan University', 0, '0'),
('3201100', 'مهارات اللغة العربية', 'Jordan University', 0, '0'),
('3202099', 'اساسيات اللغة الانجليزية', 'Jordan University', 0, '0'),
('3202100', 'مهارات اللغة الانجليزية', 'Jordan University', 0, '0'),
('3400100', 'الثقافة الوطنية', 'Jordan University', 3, '0'),
('3400101', 'مهارات التعلم والبحث العلمي', 'Jordan University', 3, '0'),
('3400102', 'مهارات التواصل', 'Jordan University', 3, '0'),
('3400103', 'مقدمة في الفلسفة والتفكير الناقد', 'Jordan University', 3, '0'),
('3400104', 'الحضارة الانسانية', 'Jordan University', 3, '0'),
('3400105', 'الحياة الجامعية واخلاقياتها', 'Jordan University', 0, '0'),
('3400106', 'موضوع خاص', 'Jordan University', 3, '0'),
('3400107', 'امهات الكتب', 'Jordan University', 3, '0'),
('3400108', 'القدس', 'Jordan University', 3, '0'),
('3400109', 'الريادة والابداع', 'Jordan University', 3, '0');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `commentid`, `userid`) VALUES
(2, 2, 'Bahaa'),
(5, 11, 'meandmealone'),
(6, 10, 'meandmealone'),
(7, 6, 'meandmealone'),
(8, 2, 'meandmealone');

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

DROP TABLE IF EXISTS `major`;
CREATE TABLE `major` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `university` tinytext NOT NULL,
  `hours` int(11) NOT NULL,
  `fac` tinytext NOT NULL,
  `course` longtext NOT NULL,
  `ocourse` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`id`, `name`, `university`, `hours`, `fac`, `course`, `ocourse`) VALUES
(1, 'ce', 'Jordan University', 166, 'Arts', '12312|123,123|123123|123,123,123', ''),
(2, 'Computer Scince', 'Jordan University', 161, 'Engineering', '0301101|0301102,0301101|0301201,0301102', ''),
(3, 'CEE', 'Jordan University', 161, 'Engineering', '0301101|0301102,0301101|0301201,0301102|0302101|0302111,0302101|0302102,0302101|0302112,0302102|0901420,90H|0904131|0906111|0907101,1932099|0301131|1901101|0303101|0301241,0301101|0913213,0302102|0913214,0913213|0953221,0913213|0903261,0913213|0953321,0943221|0907231,1932099|0907234,0907231|0907311,0907101|0907312,3202100|0907313,0301241|0907321,0953321|0908321,0913213|0907333,0903261,0907231|0907334,0907333|0917335,0907231,0907101|0907342,0907101|0907346,0907342|0907422,0907231|0917432,0917335|0917433,0907334|0907439,0917432|0907443,0907346|0907445,0907346|0907445,0907346|0907451,0301241,0907311|0917461,0903261|0907462,0917461|0907520,0907422|0917522,0907342,0907422|0907528,0907422|0907529,0907528|0907536,0907346,0917432|0907537,0907536|0907500,115H|0977598,0907500|0977599,0977598', '15|0917434,0917335|0917441,0907342|0917521,0907422,0907333|0907523,0907422|0907524,0907422|0907526,0907520|0907531,0917432,0907422|0907543,0917432,0907342|0907544,0953221,0907311|0907546,0907445|0907547,0907445|0907548,0907346|0907549,0907451|0907552,0907451|0918562,0917433'),
(4, 'Computer Engineering', 'Jordan University', 161, 'Engineering', '0301101|0301102,0301101|0301201,0301102|0302101|0302111,0302101|0302102,0302101|0302112,0302102|0901420,90H|0904131|0906111|0907101,1932099|0301131|1901101|0303101|0301241,0301101|0913213,0302102|0913214,0913213|0953221,0913213|0903261,0913213|0953321,0943221|0907231,1932099|0907234,0907231|0907311,0907101|0907312,3202100|0907313,0301241|0907321,0953321|0908321,0913213|0907333,0903261,0907231|0907334,0907333|0917335,0907231,0907101|0907342,0907101|0907346,0907342|0907422,0907231|0917432,0917335|0917433,0907334|0907439,0917432|0907443,0907346|0907445,0907346|0907445,0907346|0907451,0301241,0907311|0917461,0903261|0907462,0917461|0907520,0907422|0917522,0907342,0907422|0907528,0907422|0907529,0907528|0907536,0907346,0917432|0907537,0907536|0907500,115H|0977598,0907500|0977599,0977598', '15|0917434,0917335|0917441,0907342|0917521,0907422,0907333|0907523,0907422|0907524,0907422|0907526,0907520|0907531,0917432,0907422|0907543,0917432,0907342|0907544,0953221,0907311|0907546,0907445|0907547,0907445|0907548,0907346|0907549,0907451|0907552,0907451|0918562,0917433');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
CREATE TABLE `university` (
  `id` int(11) NOT NULL,
  `university` tinytext NOT NULL,
  `mcourses` longtext NOT NULL,
  `ocourses` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `university`, `mcourses`, `ocourses`) VALUES
(1, 'Jordan University', '3201099|3201100,3201099|3202099|3202100,3202099|1932099|2220100|3400100|3400101,3202099,3201099,1932099|3400102,3400101|3400103,3400101|3400104|3400105', '3400107,0400101,2300101,2300102,3400108|1000102,0300102,1100100,0400102,0720100|3400109,2200103,1600100,1900101,2000100,3400106,1601105');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `uname` tinytext NOT NULL,
  `uemail` longtext NOT NULL,
  `pwd` longtext NOT NULL,
  `uuniversity` tinytext NOT NULL,
  `umajor` tinytext NOT NULL,
  `courses` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `uname`, `uemail`, `pwd`, `uuniversity`, `umajor`, `courses`) VALUES
(3, '1234567890', '1@1.1', '$2y$10$EyeC3z.ge6k7GEUfjn71bukSSQfW4fbpBsbED2tCi7M9qJkTTsR.e', 'Jordan University', 'Computer Scince', '0300102|0301101|0301102|0301201|3400109|3202099|3201099|3400100|3400104|2220100|3400103|3400102|3202100|0917433|3400105|1932099|2300102|3400101|3201100'),
(4, 'test123', 'test@test.com', '$2y$10$uTzyx1tX8kPgbW3hzXzlL.RPXTBeayicu/5EP6y0XCdW5SpnguBFG', 'Jordan University', 'IT', ''),
(5, 'testing', '123@123.com', '$2y$10$Q6sXbO3oHTo28LIvhwvcCu43Sj1r1dio8DXh0xuZJLp2R2M12dTF.', 'Jordan University', 'IT', ''),
(6, 'meandmealone', 'a@a.a', '$2y$10$ffxHNXPhaDcg.FssLK6pmeujuaVxMAUecDIVRyhsDsT6Vg816lOEq', 'Jordan University', 'CEE', '1932099|3202099|3201099|3400100|3400104|0302101|0302102|0303101|0301101|0301102|0301131|3400101|3202100|3201100|0907231|0913213|1900101|0907101|s$search=s|ss$search=ss|a$search=a|a$search=a|ad$search=ad|ada$search=ada|adas$search=adas|adasd$search=adasd|adasda$search=adasda|adasdas$search=adasdas|adasdasd$search=adasdasd|ا$search=ا|اس$search=اس|ا$search=ا|s$search=s|س$search=س|سا$search=سا|سال$search=سال|سالم$search=سالم|s$search=s|ا$search=ا|اس$search=اس|اسا$search=اسا|2300102|1100100|3400105|0904131'),
(7, 'echoabd', '1@2.1', '$2y$10$dEsogCmEBUnUAatd9uboeOF.DcA/ss/ywAZcZeM6hx61EQkxjyGBO', 'Jordan University', 'Computer Eng', ''),
(8, 'whythisishard', '1@1.111', '$2y$10$5BilbpJoXHX8n3TQ3vv1Leb0SZnb1M9W.wHIlJQ3hDXtNTOCbDqE2', 'Jordan University', 'Computer Scince', ''),
(9, 'hello123', 'a@a.aa', '$2y$10$FHJpw1mKHZzWRNkCVSDtVeZMaOboI3YYadKdL52.RqaUXm..w3dU.', 'Jordan University', 'Computer Scince', ''),
(10, 'ZSLYER2000', 'kinglordabsrmen@hotmail.com', '$2y$10$M4IN2bCdoNxTcad8uShKvOMoWt2ZovXI8hKVi3u0X1ejTx/oVLfwy', 'Jordan University', 'CEE', '3202099|3201099|0400102|3400100|3400104|0302101|0302102|0302111|0302112|0303101|0301101|0301102|1901101|0301131|3400101|3400103|3400102|3202100|3201100|0907101|0301201|0301241|1900101|0907231|0913213|0907234|0917335|0907422|0907342|1932099'),
(11, '123456789', 'asd@asd.asd', '$2y$10$VRSVtd16DugPHEHHdR7AdeY3Ifwli/fCzczoNe0.EQRL41N8vgh7S', 'Jordan University', 'Computer Scince', ''),
(12, 'Hellothere', 'asd@aasda.sda', '$2y$10$5Q2y.St1uBfQ72t2.viOFOZEkf5ccWB5wxDWRZaFQet.LiTZklViW', 'Jordan University', 'Computer Scince', ''),
(13, 'qweqweqwe', 'asdemail@hello.coasdm', '$2y$10$8Fu4/jIDMv3M/CisC1q00.s5vWVtUd2Diwq4aD1tzscBk5mJVsQAq', 'Jordan University', 'Computer Scince', ''),
(14, 'muhannad', 'muhannad@hotmal.com', '$2y$10$d7XITSarwbOSbgk.Qc8zs.7qLSe10YSNklv9/ofUYp32YwX1VDhmm', 'Jordan University', 'Computer Scince', '1932099|3202099|3201099|2300102|1600100|1100100|3400100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
