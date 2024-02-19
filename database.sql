-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 19 Şub 2024, 17:48:44
-- Sunucu sürümü: 8.2.0
-- PHP Sürümü: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `final`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mail` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ImageUrl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Present` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=500 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `books`
--

INSERT INTO `books` (`Id`, `Title`, `ImageUrl`, `Present`) VALUES
(498, 'Sıfır Risk Paragraf', 'https://telegra.ph/file/8c020fe87de661c7e0491.png', 'Üç Dört Beş Yayınları'),
(499, 'TYT Tarih Soru Bankası', 'https://telegra.ph/file/d7ccd281f604940c87185.png', 'Aydın Yayınları'),
(495, 'Barış Hoca TYT Dr.Biyoloji', 'https://telegra.ph/file/70bc569a6c973103e0677.png', 'KR Akademi Yayınları'),
(496, 'TYT Coğrafya Soru Bankası', 'https://telegra.ph/file/bc02c96b882ab3829f437.png', 'Bayram Meral'),
(497, 'TYT Deneme', 'https://telegra.ph/file/65b5b6243ab8dd811893c.png', 'Üç Dört Beş Yayınları');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `event`
--

INSERT INTO `event` (`Id`, `Description`, `Date`) VALUES
(2, 'Bugün 50 soru çözenlere cips', '2024-01-10');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` datetime NOT NULL,
  `Subject` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mail` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `message`
--

INSERT INTO `message` (`Id`, `Message`, `Date`, `Subject`, `Name`, `Mail`) VALUES
(2, 'deneme test lorem ipsum sit amet', '2024-01-10 19:04:29', 'konu denemesi', 'Test Hesabı', 'aslanimellereller@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sptests`
--

DROP TABLE IF EXISTS `sptests`;
CREATE TABLE IF NOT EXISTS `sptests` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `test_id` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Correct` int NOT NULL DEFAULT '0',
  `Wrong` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `sptests`
--

INSERT INTO `sptests` (`Id`, `user_id`, `test_id`, `Title`, `Correct`, `Wrong`) VALUES
(12, 6, '10,8,9', 'TYT Türkçe Testi', 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `book_id` int NOT NULL,
  `Title` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `A` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `B` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `C` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `D` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `E` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Correct` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `tests`
--

INSERT INTO `tests` (`Id`, `book_id`, `Title`, `A`, `B`, `C`, `D`, `E`, `Correct`) VALUES
(10, 498, '(I) Hoşgörüye giden ilk adım, kişinin kendisinde eksikliklerin olabileceğini düşünmesiyle başlar. (II) Bu da \r\nkişilerin eleştiriye açık olmalarını gerektirir. (III) Eğer \r\nbirileri bizim eksiklerimizi ve yanlışlarımızı söylediğin de savunmaya geçiyorsak ya da saldırganlaşıyorsak \r\nkendimizi sorgulamalıyız. (IV) Ama eğer yanlışlarımızın \r\nolabileceğini düşünüyor, hatta bazen bunlarla dalga \r\ngeçip gülebiliyorsak o zaman doğru şekilde ilerliyoruz \r\ndemektir. (V) Kendinde eksikler olabileceğini düşünen \r\ninsan daha dikkatli davranır. (VI) Çünkü kendisinin de \r\nhata yapma potansiyeli olduğunu bilir. (VII) Ama hata \r\nyapabileceği için tedirgin değildir; kendine güvenir ve \r\nişine devam eder.&lt;br&gt;\r\n&lt;b&gt;Bu parça iki paragrafa bölünmek istense ikinci paragraf hangi cümleyle başlar&lt;/b&gt;', 'II.', 'III.', 'IV.', 'V.', 'VI.', 'C'),
(8, 498, '“(I) İçinizdeki zili ilk çalan odur; yaşadığınız ya da tanık olduğunuz bir olay, tanımadığınız bir insanın yüzü, \r\ngördüğünüz bir film, okuduğunuz bir haber, bir kuş sürüsünün hızla geçişi. (II) Evet, içinizdeki zili ilk çalan \r\nesindir. (III) Kapıyı açarsınız, ondan sonra zorlu uğraş \r\nbaşlar. (IV) Esin yetmez çünkü. (V) Esine inanıyorum, \r\nama çalışmaya daha çok inanıyorum.”&lt;br&gt;\r\n&lt;b&gt;Yukarıdaki parça için en uygun başlık aşağıdakilerden hangisidir?&lt;/b&gt;', 'Esin ve Çalışma', 'Şairin Tanıklığı', 'Zil ve Kapı', 'Şiirin Zorluğu', 'İnanmak ve Yapmak', 'B'),
(9, 498, '“Bu sevginin arkasında yatan sır, benim ilk başta sade \r\nbir vatandaş olmamdan kaynaklanıyor. Halkın arasından gelmemden kaynaklanıyor, sırtımı halka dayamamdan kaynaklanıyor. Ben bir balon değilim.”&lt;br&gt;\r\n&lt;b&gt;Bu parça aşağıdaki sorulardan hangisine karşılık \r\nsöylenmiş olabilir ?&lt;/b&gt;', 'Size olan sevginin arkasında yatan sır nedir?', 'Sizi basında televizyonda neden özel hayatınızla  görmüyoruz?', 'Çok sevilmenizin sırrı hep komik adamı oynamanız  mı?', 'Günlük yaşamınızda da komik biri misiniz?', 'Sizi diğer popüler oyunculardan ayıran şey nedir?', 'C');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Username` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`Id`, `Name`, `Username`, `Mail`, `Password`) VALUES
(6, 'Kadir Bayar', 'kadirbayar', 'kadirbayar@gmail.com', '$2y$10$88yICqvAlpZ4YrB9.fY/KuSInvCp71bkShlCRGnUoyOzO4DuS1U1.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
