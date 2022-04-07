-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2022 at 11:40 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibility` int(11) NOT NULL DEFAULT 0,
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Ordering`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(13, 'Hand Made', 'Hand Made Items', 1, 1, 1, 1),
(14, 'Computers', 'Computers Items', 2, 0, 0, 0),
(15, 'Cell Phones', 'Cell Phones', 3, 0, 0, 0),
(16, 'Clothing', 'Clothing And Fashions', 4, 0, 0, 0),
(17, 'Tools', 'Home Tools', 5, 0, 0, 0),
(18, 'PC Games', 'War Game Stratgy ', 0, 0, 0, 0),
(19, 'Car', 'Car Stronger And Have A Speed & Quality', 0, 0, 1, 0),
(20, 'perfume', 'Shop perfume at Sephora. Find your favorite perfume or accentuate your style with a new scent from a top fragrance brand.', 0, 1, 1, 1),
(21, 'Appliances', ' electronics Major kitchen appliances · Refrigerators · Freezers and ice makers · Ranges, cooktops and ovens · Range hoods · Dishwashers · Microwaves · Kitchen appliance packages ', 102, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(16, 'Wonderfull Man', 1, '2021-08-02', 24, 49),
(17, 'Amazing Bro *__*', 1, '2021-08-02', 25, 2),
(18, 'Good Product \r\nAmazing  *__*					\r\n				\r\n					', 1, '2021-08-28', 23, 2),
(19, 'Good Product \r\nAmazing  *__*					\r\n				\r\n					', 0, '2021-08-28', 23, 2),
(20, 'Good Product \r\nAmazing  *__*					\r\n				\r\n					', 0, '2021-08-28', 23, 2),
(21, 'Good Product \r\nAmazing  *__*					\r\n				\r\n					', 0, '2021-08-28', 23, 2),
(23, 'Good Product \r\nAmazing  *__*					\r\n									\r\n					', 1, '2021-08-28', 23, 2),
(25, 'good					\r\n					', 0, '2021-08-28', 29, 50),
(26, 'good					\r\n					', 0, '2021-08-28', 29, 50),
(27, '	good				\r\n					', 0, '2021-08-28', 29, 50),
(28, 'good					\r\n					', 1, '2021-08-28', 26, 1),
(30, 'nicebro					\r\n					', 1, '2021-08-28', 23, 2),
(31, 'Nive Stayle Designe					\r\n					', 1, '2021-08-28', 26, 1),
(32, 'Nive Stayle Designe					\r\n					', 1, '2021-08-28', 26, 1),
(33, '				Amazing\r\n					', 1, '2021-08-28', 26, 1),
(35, '					\r\n					', 1, '2021-08-29', 25, 52),
(37, '			bad		\r\n					', 1, '2021-09-01', 45, 66),
(38, 'Not Action Games					\r\n					', 1, '2021-09-01', 45, 66),
(39, 'bad					\r\n					', 1, '2021-09-01', 45, 66),
(41, '					\r\n		bad			', 1, '2021-09-01', 45, 49),
(42, '					\r\n					bad', 1, '2021-09-01', 45, 49),
(43, 'Nice Game					\r\n					', 1, '2021-09-01', 45, 49),
(44, 'Nice					\r\n					', 1, '2021-12-14', 66, 1),
(45, 'Good Car 					\r\n					', 1, '2022-01-02', 74, 90);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT 0,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `avatar`, `Status`, `Rating`, `Approve`, `Cat_ID`, `Member_ID`) VALUES
(23, 'Mous USB Gaming', 'This Is Praivet Catogry', '10', '2021-08-22', 'Jordan', '261755_Pro-Gamer-Gaming-Mouse-8D-3200DPI-Adjustable-Wired-Optical-LED-Computer-Mice-USB-Cable-Silent-Mouse.jpg_Q90.jpg_.webp', '1', 0, 0, 14, 2),
(24, 'Yell Blue  Mic', 'Micrephone', '20', '2021-08-22', 'China', '150553_blue-yeti-x_chbt.jpg', '1', 0, 0, 14, 2),
(25, 'Iphone 6s ', 'Apple Iphone Black', '210', '2021-08-22', 'USA', '269884_iPhone-6s-Gold-web2_0.png', '2', 0, 1, 15, 52),
(26, 'Laptop Dell Inspairon', '4 Ram 1TR HDD One Proccess 126GB', '500', '2021-08-22', 'China', '80685_43540_04.jpg', '3', 0, 1, 14, 1),
(28, 'Car Banze 2019', 'Car Stronger And Have A Speed & Quality', '50000', '2021-08-27', 'Germany', '878988_2014_Mercedes-Benz_S550_(US)_lwb.jpg', '3', 0, 1, 19, 52),
(29, 'sculpture', 'Stone face carving', '35', '2021-08-27', 'Jordan', '748538_download (5).jpg', '1', 0, 1, 13, 50),
(30, 'Keyboard 2021 KBM', 'AMKETTE Wi-Key Plus Wireless Laptop Keyboard', '15', '2021-08-27', 'taiwan', '414543_ZtftSWBRu5GiPu2F9LetZQ-1200-80.jpg', '1', 0, 1, 14, 52),
(31, 'Galexy Note 7', 'This Is Praivet Catogry', '445', '2021-08-27', 'Jordan', '111639_download (2).jpg', '2', 0, 1, 15, 52),
(32, 'Gun Sniper', 'War Game Stratgy ', '10', '2021-08-27', 'Jordan', '286275_unnamed (1).jpg', '2', 0, 1, 18, 52),
(33, 'hiwatch 6', 'الجديدة نسخة مطورة T500 + Hiwatch 6 الذكية ووتش, 1.75 بوصة شاشة كبيرة كبيرة المغناطيسي تهمة الدم pressue ساعة ذكية PK T500 ', '100', '2021-08-28', 'Jordan', '858346_download (3).jpg', '1', 0, 1, 15, 2),
(34, 'tecno spark 6', 'مواصفات هاتف Tecno Spark 6 :- · يدعم الراديو الـ Fm . · يأتي الهاتف بأبعاد 170.8×77.3×9.2 ملم . · يدعم الهاتف شريحتين إتصال من نوع Nano Sim . · يدعم شبكات', '150', '2021-08-28', 'China', '478161_download (4).jpg', '1', 0, 1, 15, 2),
(35, 'huawei mobile nova 7i', 'Huawei nova 7i · Released 2020, February 14 · 183g, 8.7mm thickness · Android 10, EMUI 10, no Google Play Services · 128GB storage, NM ...', '310', '2021-08-28', 'Jordan', '936800_Huawei-Nova-7i.jpg', '1', 0, 1, 15, 2),
(36, 'سامسونج جالاكسي S10 بلس', 'Mobile price and specifications the network second generation	GSM 850 / 900 / 1800 / 1900 - SIM 1 and SIM 2 - Dual SIM version only third generation	', '740', '2021-08-28', 'Canada', '933469_samsung-s10-plus.jpg', '2', 0, 1, 15, 2),
(43, 'tecno note 10', 'Compare Infinix Note 10 Pro vs Tecno Camon 16 Premier', '399', '2021-08-29', 'China', '292248_Infinix-Note-10-Pro-4.jpg', '1', 0, 1, 15, 52),
(44, 'metal box', 'Find here Metal Boxes, Metal Storage Box manufacturers, suppliers & exporters in India. Get contact details & address of companies manufacturing', '10', '2021-08-30', 'Jordan', '28578_HLB12iAERAzoK1RjSZFlq6yi4VXae.jpg', '1', 0, 1, 13, 1),
(45, 'RedAlert 4', 'The Stalin-led invasion of Europe serves as the backdrop for the first Command & Conquer: Red Alert game. Two expansion packs for Red Alert', '10', '2021-08-30', 'Jordan', '993556_لوجو-53.jpg', '1', 0, 1, 18, 1),
(48, 'Jeep® Jordan,Advanced', 'Jeep® Jordan,Advanced Automotive Trading - explore the iconic 4x4 range. Learn more about the latest Jeep® cars and offers, model specifications', '25,300', '2021-08-30', 'UK', '299730_1200px-2018_Jeep_Wrangler_Sahara_Unlimited_Multijet_2.1_Front.jpg', '2', 0, 1, 19, 50),
(49, 'شاكوش خلع يد ', 'شاكوش خلع يد حديد ستانلي انتقال din 8.990 JOD*· متوفر·العلامة التجارية: Deraneyeh‏ اسم المنتج : شاكوش خلع يد حديد 570 غرام ستانلي, STANLEY STEEL HANDLE CLAW HAMMER STHT51082, بلد المنشأ : الاتحاد الاوروبي, الشركة الصانعة : ستانلي ...', '10', '2021-08-30', 'Jordan', '210698_STHT51082-8_72RGB_800x340.png', '3', 0, 1, 17, 56),
(51, 'Jeep® Gladiator', 'Car Stronger And Have A Speed & Quality', '25,000', '2021-08-30', 'USA', '769542_Gladiator_800x640.jpg', '3', 0, 1, 19, 56),
(52, 'splash', 'This Is Praivet Catogry ', '10', '2021-08-30', 'india', '73893_250-1-3379x3379.jpg', '1', 0, 1, 20, 2),
(53, 'G-CLASS', 'Car Stronger And Have A Speed & Quality', '100000', '2021-08-30', 'Jordan', '133302_download (1).jpg', '1', 0, 1, 19, 57),
(54, 'سيارات دودج رام 2005 للبيع في الأردن ', 'المدينة : عمان الحي: طبربورالنوع: دودجالفئة: رامسنة الصنع: 2005الحالة: مستعملالكيلومترات: ٠نوع ناقل الحركة: اوتوماتيكنوع الوقود: بنزينالجمرك: مجمركةالترخيص: مرخصةالتأمين: تأمين إلزامياللون: أبيضطريقة الدفع: كاش فقطالسعر: 5,400دينار', '15,000', '2021-09-01', 'USA', '663503_7615176c-41ea-41b3-bf41-2882567b4742.jpg', '3', 0, 1, 19, 1),
(55, ' Black Opium ', 'The original Black Opium Eau de Parfum. A captivating floral gourmand scent, twisted with an overdose of black coffee, for a shot of adrenaline. Energy and sensuality married with the unique YSL edge.', '50', '2021-09-01', 'French', '653903_375x500.68506.jpg', '2', 0, 1, 20, 1),
(56, 'opus fragrance', 'Oh, Black Opium. The addictive love of my life. For me this is a true magnum opus fragrance; the price point can be utterly, utterly ridiculous--such is the ...', '45', '2021-09-01', 'French', '583266_3614272443686.jpg', '1', 0, 1, 20, 1),
(57, 'قميص الصينية المتطورة في الأنماط الأنيقة', 'الصين مصنع الملابس OEM 100% القطن قمصان ب... عرض المزيد >. نتاج/خدمة: تي شيرت ، هوديس ، البلوز ، بنطال رياضي ، قميص بولو. البلد/المنطقة: الصين. نوع العمل:', '10', '2021-09-01', 'China', '237934_ws.jpg', '1', 0, 1, 16, 83),
(58, '️وصل حديثاً .. أحدث البدلات التركية...', 'أحدث تصميم للعمل مصنوع في تركيا للبيع بالجملة ، بدلة رجالية تركية ، بدل رسمية ، بناطيل معطف مصممة خصيصًا ، طقم رجالي من 3 قطع. ٢٠٫٠٠ US$-٥٠٫٠٠ US$/ قطعة.', '35', '2021-09-01', 'Jordan', '919261_4468-22.jpg', '2', 0, 1, 16, 83),
(59, 'GTA ', 'Grand Theft Auto IV - Rockstar Games', '$10', '2021-09-01', 'USA', '331923_download (2).jpg', '1', 0, 1, 18, 70),
(60, 'Counter-Strike: Global Offensive', 'War Game Stratgy ', '$10', '2021-09-01', 'USA', '762827_download.jpg', '1', 0, 1, 18, 57),
(61, '(CS: GO) - Steam', 'Play the world\'s number 1 online action game. Engage in an incredibly realistic brand of terrorist warfare in this wildly popular team-based game. ٩٫٩٩ US$', '10', '2021-09-01', 'UK', '815955_download (1).jpg', '2', 0, 1, 18, 68),
(62, 'خزف', 'فخار#خزف#لبيب_ابواحمد# ', '10', '2021-09-01', 'Jordan', '831832_download (3).jpg', '1', 0, 1, 13, 49),
(64, 'BMW Abu Khader', 'Car Stronger And Have A Speed & Quality', '25,000', '2021-09-01', 'Garmany', '67854_السيارة-بى-ام-دبليو-BMW-520i-2016-1.jpg', '2', 0, 1, 19, 57),
(65, 'فساتين سهرة - Modanisa', 'موديلات فساتين مسائية للمحجبات للموسم الجديد في modanisa.com . اختاري اللباس المفضل لديك وسوف تكوني نجمة الليلة.', '75', '2021-09-01', 'Jordan', '410122_download.png', '1', 0, 1, 16, 53),
(66, 'Painting', 'Younes expressive painting', '100', '2021-10-22', 'Jordan', '300118_4d4491efc3f139495b929bdf6974365d.jpg', '2', 0, 1, 13, 57),
(67, 'COCO MADEMOISELLE Eau de Parfum', 'For Men OCO MADEMOISELLE Eau de Parfum - CHANEL | Sephora', '150', '2021-12-14', 'UK', '65810_A.jpg', '3', 0, 1, 20, 1),
(69, 'Washing Machine', 'Samsung 6.5 Kg Fully Automatic Top Load Washing Machine (WA65A4002VS)', '299', '2021-12-16', 'Japan', '129648_Blomberg_WashingMachine_LWF28442B_Black_AngledClosed.jpg', '1', 0, 0, 21, 70),
(70, 'washing machine ', 'FB 6 Kg Fully Automatic Front Load Washing Machine (Diva Aqua SX)', '250', '2021-12-16', 'UK', '339615_download.jpg', '3', 0, 1, 21, 83),
(71, 'Houseware', ' Interior Houseware Services‏ Kitchen Kit Housewares - Interior Houseware Services‏', '99', '2021-12-16', 'Jordan', '365702_Kitchen-Kit-Housewares-and-Pots-and-Pans-620.jpg', '2', 0, 1, 21, 80),
(72, 'ثلاجات', 'افضل العروض على انواع الثلاجات - LG', '335', '2021-12-16', 'Garmany', '167095_6901018070440.jpg', '1', 0, 1, 21, 66),
(73, 'كهربائيات اقساط', 'كهربائيات اقساط على الهوية ', '400', '2021-12-16', 'China', '533575_1.jpg', '2', 0, 1, 21, 49),
(74, ' نيسان روغ 2017', ' الجزيرة نت نيسان روغ 2017.. سيارة دفع رباعي بتصميم رياضي رشيق | الجزيرة نت', '25,000', '2021-12-16', 'KOREA', '679012_nissan_x-trail_17_02.jpg', '4', 0, 1, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'To Identify User',
  `Username` varchar(255) NOT NULL COMMENT 'Username To Login ',
  `Password` varchar(255) NOT NULL COMMENT 'Password To Login ',
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0 COMMENT 'Identify User Group',
  `TrustStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'Seller Rank',
  `RegStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'User Approvel',
  `Date` date DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `phonenumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`, `avatar`, `phonenumber`) VALUES
(1, 'omar', '601f1889667efaebb33b8c12572835da3f027f78', 'omaralmawajdeh65@gmail.com', 'Omar Subhi AL-Mawajdeh', 1, 0, 1, '2021-08-24', '614609_571582.jpg', 798349499),
(2, 'mohanad', '601f1889667efaebb33b8c12572835da3f027f78', 'mohanad@gmail.com', 'Mohannad Shawabkah\r\n', 1, 0, 1, '2021-08-21', '455868_984033_computer-hacker-wallpapers_1920x1080_h.jpg', 64457781),
(49, 'Ahmad', '601f1889667efaebb33b8c12572835da3f027f78', 'ahmmadsameh245@hotmail.com', 'Ahmad Sameh', 0, 0, 1, '2021-08-21', '223603_571582.jpg', 789545241),
(50, 'Nada', '3acd0be86de7dcccdbf91b20f94a68cea535922d', 'Najmaldin22@gmail.com', 'Nada', 0, 0, 1, '2021-08-21', '287610_anonymous-wallpapers-30620-3601346.jpg', 65007700),
(52, 'Mais', '601f1889667efaebb33b8c12572835da3f027f78', 'maissoso221@yahoo.com', 'Mahmmod Ahmad ALmajed', 0, 0, 1, '2021-08-21', '396124_268232_wallpaper-anonymous-hd.jpg', 65005554),
(53, 'Eman', '601f1889667efaebb33b8c12572835da3f027f78', 'Eman_Mahmmod212@gmail.com', 'Eman Mahmmod ALOthman', 0, 0, 1, '2021-08-23', '185814_Anonymous Wallpaper.jpg', 64457781),
(56, 'momen', '601f1889667efaebb33b8c12572835da3f027f78', 'ADSADAS@aSDASD', 'momen Subhi', 0, 0, 1, '2021-08-25', '880645_shop5.jpg', 777954524),
(57, 'wesam', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'wesamomarww22@gmail.com', 'wesam omar', 0, 0, 0, '2021-08-25', '197055_315965966761.jpg', 789775245),
(66, 'YAZEN', '601f1889667efaebb33b8c12572835da3f027f78', 'ahmmadsameh245@hotmail.com', 'YAZENOMAR', 0, 0, 1, '2021-08-25', '916167_1563669-hackers-wallpaper.jpg', 777745247),
(67, 'Najm', '601f1889667efaebb33b8c12572835da3f027f78', 'omarusigi@yahoo.com', 'NajmAldin Al-mawajdeh', 0, 0, 1, '2021-08-29', '705172_984033_computer-hacker-wallpapers_1920x1080_h.jpg', 789545247),
(68, 'Muhammad ', '601f1889667efaebb33b8c12572835da3f027f78', 'MuhammadYusuf33@gmail.com', 'Muhammad  Yusuf Al-Tarifi', 1, 0, 1, '2021-08-29', '207912_315966019116.jpg', 789775245),
(70, 'mohammadWE', 'dbed2598f35489916e285158e8f1f113e58ddf3a', 'Mahmmodalmajed2@gmail.com', 'mohammadWEs', 0, 0, 1, '2021-08-31', '771792_FB_IMG_1570685597197.jpg', 789545245),
(80, 'sefa', '601f1889667efaebb33b8c12572835da3f027f78', 'Bahaasafa@gmail.com', 'Sara ahmad', 0, 0, 1, '2021-09-01', '205859_1472820570888.jpg', 789775245),
(83, 'maha', '601f1889667efaebb33b8c12572835da3f027f78', 'MahaSami432@Yahoo.com', 'Maha Sami NoorAldin', 0, 0, 1, '2021-09-01', '350303_1472820569281.jpg', 65005554),
(89, 'Hasan', 'f48acdd5bb86b71b811037de658e4db81c3e3b21', 'Jonaman@YAHOO.COM', 'HasanSandAlnofal', 0, 0, 0, '2021-12-29', '358741_shop1.jpg', 789987456),
(90, 'ooooo', '601f1889667efaebb33b8c12572835da3f027f78', 'omarfq@gmail.com', 'oooo oooo oooo', 0, 0, 1, '2022-01-02', '178322_Kitchen-Kit-Housewares-and-Pots-and-Pans-620.jpg', 6687246);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `user_comment` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `cat_1` (`Cat_ID`),
  ADD KEY `member_1` (`Member_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To Identify User', AUTO_INCREMENT=91;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
