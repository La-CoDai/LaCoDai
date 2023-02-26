-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 04:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lacodai`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `bname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `bname`) VALUES
(1, 'Versace'),
(2, 'Gucci'),
(3, 'Chanel'),
(4, 'Dior'),
(5, 'Hermes'),
(6, 'Burberry'),
(7, 'Yves Saint Laurent');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `procart_id` int(11) NOT NULL,
  `usercart_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230211065619', '2023-02-11 07:56:30', 45),
('DoctrineMigrations\\Version20230211065837', '2023-02-11 07:58:43', 31),
('DoctrineMigrations\\Version20230211070242', '2023-02-11 08:02:48', 69),
('DoctrineMigrations\\Version20230218041353', '2023-02-18 05:14:07', 638),
('DoctrineMigrations\\Version20230221012634', '2023-02-21 02:26:42', 38),
('DoctrineMigrations\\Version20230221023102', '2023-02-21 03:31:07', 606),
('DoctrineMigrations\\Version20230221033739', '2023-02-21 04:37:43', 95),
('DoctrineMigrations\\Version20230222013329', '2023-02-22 02:33:35', 47),
('DoctrineMigrations\\Version20230222013512', '2023-02-22 02:35:16', 40),
('DoctrineMigrations\\Version20230222021650', '2023-02-22 03:16:55', 174),
('DoctrineMigrations\\Version20230222031650', '2023-02-22 04:16:53', 48),
('DoctrineMigrations\\Version20230223032058', '2023-02-23 04:21:03', 641),
('DoctrineMigrations\\Version20230223032644', '2023-02-23 04:26:50', 583);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `userorder_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `oid_id` int(11) NOT NULL,
  `pid_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pprice` int(11) NOT NULL,
  `pimg` varchar(255) NOT NULL,
  `pgender` tinyint(1) DEFAULT NULL,
  `pdes` varchar(255) DEFAULT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pname`, `pprice`, `pimg`, `pgender`, `pdes`, `brand_id`) VALUES
(1, 'Versace Eros Flame', 2372000, 'versace_1.png', 0, 'Versace Eros Flame has a very strong and unique taste, has a strong impact on the user\'s sense of smell, but also does not create discomfort or pressure.', 1),
(2, 'Versace Pour Homme Dylan Blue', 2272000, 'versace_2.png', 0, 'The perfume bottle has a timeless design with colors that attract the opposite person at first sight - bright blue and gold. The lines on the bottle body are meticulously sculpted with Versace\'s familiar symbol - the Medusa snake head.', 1),
(3, 'Versace Eros For Men EDT', 3223000, 'versace_3.png', 0, 'Versace Eros combines scents of mint, green apple, tonka bean and geranium to create an unforgettable fragrance. This is truly a fragrance for a strong man, full of passion but hiding a warm, seductive aftertaste.', 1),
(4, 'Versace Bright Crystal Absolu', 2816000, 'versace_4.png', 1, 'Versace Bright Crystal Absolu is known as the perfume of hot love. Following the success of Bright Crystal, the world-renowned fashion house launched a stronger, hotter, more attractive fragrance in 2013 to satisfy the expectations of modern women.', 1),
(5, 'Versace Eros Pour Femme', 3311000, 'versace_5.png', 1, 'With the desire to bring natural sensuality and deposition like wild beauty, full of nature in the wild. Versace brand launched a new sensual and attractive fragrance named Versace Eros Pour Femme in December 2014 with the style and unmistakable Versace.', 1),
(6, 'Gucci Guilty Intense Pour Homme', 2630000, 'gucci_1.png', 0, 'Gucci Guilty Intense for men is a new version of Gucci Guilty Pour Homme perfume with a stronger, more sensual scent. Top notes arouse the senses with a cool yet masculine scent of lemon, lavender and coriander.', 2),
(7, 'Gucci Flora By Gucci 1966', 1995000, 'gucci_2.png', 1, 'Gucci has just launched a special limited edition of the Flora By Gucci fragrance line from 2009. It is named Flora By Gucci 1966, inspired by the design and decoration of the scarf for Grace Kelly. This fragrance was launched in spring 2013.', 2),
(8, 'Gucci Made To Measure Pour Homme', 2715000, 'gucci_3.png', 0, 'Gucci Made To Measure Pour Homme is the new fragrance of Gucci, launched in the fall of 2013. Gucci Made To Measure Pour Homme evokes a \"large and sophisticated space\" with a spicy oriental scent.', 2),
(9, 'Gucci Guilty For Women EDT', 2990000, 'gucci_4.png', 1, 'Gucci Guilty perfume has a strong, seductive and wild scent that is very typical. \"I think everyone, in the past, has had a very romantic and sexy moment, moments that will stay with them for the rest of their lives.\"', 2),
(10, 'Gucci Bloom For Women EDP', 3490000, 'gucci_5.png', 1, 'Gucci Bloom perfume line belongs to the Floral group. White Tuberose and Iris Root are the two scents you can easily feel when using this perfume. A fragrance crafted to embody the signature, vitality and diversity of women.', 2),
(11, 'Chanel Bleu De Chanel EDP', 4700000, 'chanel_1.png', 0, 'Chanel Bleu De Chanel EDP is considered the most favorite perfume bottle among men because of its elegant scent that can be used on many occasions. Spray to go to work, meet customers, partners, go out, party all attract the attention of people around.', 3),
(12, 'Chanel Chance EDT', 3390000, 'chanel_2.png', 1, 'Chanel Chance is a combination of hyacinth, white musk and rose followed by the innocence of white vetiver and iris, ending with amber and patchouli.', 3),
(13, 'Chanel Coco EDP', 4090000, 'chanel_3.png', 1, 'Sensual and unique, strong and fragile, Coco perfume is created with the scent of orange, tangerine, and peach essential oils embellished with rose, mimosa, and jasmine scents.', 3),
(14, 'Chanel Allure Homme Sport', 3980000, 'chanel_4.png', 0, 'You are a sports fanatic, you love the feeling of movement, the desire to conquer the top, overcome all challenges and immerse yourself in the victory drunkenness, Chanel understands that and has launched  Allure Homme Sport.', 3),
(15, 'Chanel Chance Eau Tendre EDP', 4700000, 'chanel_5.png', 0, 'An innovation in the scents gives a fresh touch to Chanel\'s perfume line. Chance Eau Tendre has brought a breakthrough with an elegant style that seems to turn every girl into a muse with pure beauty sparkling with a joyful pose.', 3),
(21, 'Dior Sauvage EDP', 5650000, 'dior_1.png', 0, 'In 2018, Dior presents a new version of Dior Sauvage that debuted in 2015 in a concentration of Eau De Parfum. Ingredients with oriental touches and vanilla. Create a sweet, mysterious and sexy scent.', 4),
(22, 'Dior J’Adore', 4290000, 'dior_2.png', 1, 'Dior J\'Adore honors the feminine, gentle beauty with a modern twist, suitable for girls with strong personality, always confident in their abilities and possessing a burning passion to express. ego but still lacks the necessary catalyst.', 4),
(23, 'Dior Miss Dior EDP 2021', 3890000, 'dior_3.png', 1, 'Miss Dior EDP version 2021 is designed with a modern scent and less spice base than the old versions. In addition to the signature floral scent, this time Miss Dior enhances the feminine sweetness with fruity compositions of peach.', 4),
(24, 'Dior Hypnotic Poison Eau Sensuelle', 3290000, 'dior_4.png', 1, 'Hypnotic Poison Eau Sensuelle - a new member of Dior \'s colorful and fragranced. This scent is a harmonious combination of orchid scent with some accents of sweet vanilla to create a lively scent.', 4),
(25, 'Dior Eau Sauvage Parfum', 3490000, 'dior_5.png', 0, 'The new masculine scent of Dior Eau Sauvage was born in 1966, remixed and launched in the spring of 2011 with a stronger concentration - Dior Eau Sauvage Parfum.', 4),
(26, 'Hermes Terre D’hermes Pure Parfum', 2123000, 'hermes_1.png', 0, 'Terre d\'Hermes Parfum is a liberal, masculine fragrance. It opens fresh with grapefruit and orange notes, continues Flint and finally closes with warm aromas of wood, oak moss and incense for a long-lasting fragrance.', 5),
(27, 'Hermes Eau Des Merveilles Bleue', 3260000, 'hermes_2.png', 1, 'Eau Des Merveilles Bleue by  Hermès is a fragrance for women, this new scent was invented by Christine Nagel and was launched in 2016.', 5),
(28, 'Hermes Terre D’Hermes H Bottle Limited Edition Parfum', 2900000, 'hermes_3.png', 0, 'Hermes Terre d\'Hermes H Bottle Limited Edition 2017 is a symbolic story exploring the raw material and its magical transformation. An intersection between earth and sky. A journey imbued with strength and poetry.', 5),
(29, 'Hermes Terre Parfum H Flacon 2020', 2950000, 'hermes_4.png', 0, 'Hermes Terre Parfum H Flacon 2020 is the latest limited edition perfume line launched in 2020 based on the legendary fragrance of the perfume Terre D\'Hermès (2009).', 5),
(30, 'Hermes Terre D’Hermes EDP', 3900000, 'hermes_5.png', 0, 'Terre d\'Hermes Parfum is a line of fragrances by Hermes for men, launched in 2009 and it is classified as a chypre woody fragrance. The father of this perfume line is Jean-Claude Ellena. Behind this perfume line is a myth of antiquity and nature .', 5),
(31, 'My Burberry EDP', 2890000, 'burberry_1.png', 1, 'Last September, Burberry brand launched a new perfume called  My Burberry , a fragrance of nature with a cool scent of plants and fruits.', 6),
(32, 'Burberry Summer For Women 2013', 1392000, 'burberry_2.png', 1, 'Burberry has just launched a new scent, Burberry Summer For Women 2013, this is considered the latest version of Burberry Summer products since 1995. Burberry Summer For Women 2013 is introduced as a classic and elegant fragrance with a little bit of eleg', 6),
(33, 'Burberry Brit For Men', 2400000, 'burberry_3.png', 0, 'Burberry Brit For Men is the most perfect depiction of a modern spirit blended with British tradition. The original classic fragrance turns to a modern and more trending.', 6),
(34, 'Burberry The Beat For Men', 2790000, 'burberry_4.png', 1, 'The Beat For Men is a passionate, energizing fragrance that embodies a blend of esteemed British heritage and strong style.', 6),
(35, 'Burberry Mr Burberry EDT', 2690000, 'burberry_5.png', 0, 'The scent of grapefruit and mint is probably the most relaxing and fresh scent, this is the first note that touches the skin. Mr. Burberry is seductively seductive with cedar and nutmeg in the second floor.', 6),
(36, 'Yves Saint Laurent Saharienne For Women', 1436000, 'ysl_1.png', 1, 'The refreshed Yves Saint Laurent Saharienne  was launched in 2011.  The fragrance composition blends contrasts of hot desert aromas and fresh summer tones. Top notes are a combination of bergamot, mandarin, lemon.', 7),
(37, 'Yves Saint Laurent Black Opium Glowing', 2300000, 'ysl_2.png', 1, 'Yves Saint Laurent  launches a new fragrance with the 2018 Yves Saint Laurent Black Opium Glowing Eau De Toilette edition that infuses the world with a new addiction.', 7),
(38, 'Yves Saint Laurent L’Homme EDT', 2290000, 'ysl_3.png', 1, 'Yves Saint Laurent L\'Homme EDT launched perfume lovers in 2006, with a unique style that combines a solid, sweet feeling with ultimate charm and elegance.', 7),
(39, 'Yves Saint Laurent YSL Mon Paris', 2990000, 'pro-3-63eeeaae770ab-63faba1656ee8.png', 1, 'Yves Saint Laurent  launches a new fragrance line, Mon Paris , launched mid-2016. Created by Olivier Cresp, Harry Fremont and Dora Baghriche-Arnaud,  Mon Paris  is a vibrant fragrance that expresses the intense emotions of love.', 7),
(40, 'Yves Saint Laurent Y EDP', 3490000, 'ysl_5.png', 1, 'Yves Saint Laurent Y EDP draws inspiration from the elegant, liberal style of fashion, such as simple white T-shirts and black jackets. Yves Saint Laurent Y presents a balance between strong and light notes, passionate and fresh. ', 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `address`, `phone`) VALUES
(40, 'khoivl.net@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$wWtmP8moLxWbXylF3oEIKu2Jsrz8QJyUETuJtEfw8R.57LSHnS8/O', 'Lieu Vinh Khoi', '11/2, Ngo Quoc Tri, Tan An. Ninh Kieu, Can Tho', '814742238'),
(41, 'lyhao792@gmail.com', '[\"ROLE_USER\"]', '$2y$13$geHzf39joVk..rmQgf2vX.AA8teB0LsuaJh0zJ9cIcApjAw3BnfyO', 'Thanh Hao', 'Ca Mau', '814742238');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BA388B745E4A66B` (`procart_id`),
  ADD KEY `IDX_BA388B786B43101` (`usercart_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398A1DA924F` (`userorder_id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_27A0E7F2F1067566` (`oid_id`),
  ADD KEY `IDX_27A0E7F2386C528` (`pid_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B3BA5A5A44F5D008` (`brand_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B745E4A66B` FOREIGN KEY (`procart_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK_BA388B786B43101` FOREIGN KEY (`usercart_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A1DA924F` FOREIGN KEY (`userorder_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `FK_27A0E7F2386C528` FOREIGN KEY (`pid_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK_27A0E7F2F1067566` FOREIGN KEY (`oid_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_B3BA5A5A44F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
