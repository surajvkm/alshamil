-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2018 at 08:59 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alshamil`
--

-- --------------------------------------------------------

--
-- Table structure for table `alshamilbank`
--

CREATE TABLE `alshamilbank` (
  `bankId` int(11) NOT NULL,
  `name` text NOT NULL,
  `accountNo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `alshamillocation`
--

CREATE TABLE `alshamillocation` (
  `locationId` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `contactNo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookeditem`
--

CREATE TABLE `bookeditem` (
  `bookedId` int(11) NOT NULL,
  `traderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productCategoryId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userName` int(11) NOT NULL,
  `userType` int(11) NOT NULL,
  `userLocation` text NOT NULL,
  `userImage` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cartlist`
--

CREATE TABLE `cartlist` (
  `cartListId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `cartlistCount` int(11) NOT NULL,
  `productAvailability` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cartlist`
--

INSERT INTO `cartlist` (`cartListId`, `productId`, `userId`, `orderId`, `cartlistCount`, `productAvailability`) VALUES
(10, 1, 3, 1, 1, 0),
(11, 4, 3, 1, 1, 0),
(12, 2, 3, 1, 1, 0),
(13, 3, 2, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `NameAr` text NOT NULL,
  `parentCategory` int(11) NOT NULL,
  `ProductCount` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `level` varchar(11) NOT NULL,
  `link` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryId`, `Name`, `NameAr`, `parentCategory`, `ProductCount`, `type`, `level`, `link`) VALUES
(17, 'number plate', 'أرقام السيارات', 0, 6, 2, '', ''),
(16, 'bike', 'الداجات', 0, 3, 3, '', ''),
(15, 'car', 'السيارات', 0, 7, 3, '', ''),
(18, 'vertu', 'فيرتو', 0, 0, 3, '', ''),
(19, 'watch', 'الساعات', 0, 0, 3, '', ''),
(20, 'mobile number', 'أرقام الموبايلات', 0, 2, 1, '', ''),
(21, 'boat', 'القوارب', 0, 0, 3, '', ''),
(22, 'phone', 'الهواتف', 0, 0, 3, '', ''),
(23, 'properties', 'العقارات', 0, 0, 3, '', ''),
(165, 'benz', 'benz', 163, 0, 0, '', ''),
(163, 'brand', 'brand', 15, 0, 0, '1', ''),
(164, 'model', 'model', 15, 0, 0, '2', ''),
(166, 'audi', 'audi', 163, 0, 0, '', ''),
(167, 'benz1', 'benz1', 164, 0, 0, '', '165'),
(168, 'benz2', 'benz2', 164, 0, 0, '', '165'),
(169, 'type', 'type', 16, 0, 0, '1', ''),
(170, 'brand', 'brand', 16, 0, 0, '2', ''),
(171, 'model', 'model', 16, 0, 0, '3', ''),
(172, '2 wheel', '2 wheel', 169, 0, 0, '', ''),
(173, '4 wheel', '4 wheel', 169, 0, 0, '', ''),
(174, 'ducati', 'ducati', 170, 0, 0, '', '172'),
(175, 'bajaj', 'bajaj', 170, 0, 0, '', '172'),
(176, 'Diavel', 'Diavel', 171, 0, 0, '', '174'),
(177, 'Scrambler', 'Scrambler', 171, 0, 0, '', '174'),
(178, 'Pulsar 150', 'Pulsar 150', 171, 0, 0, '', '175'),
(179, 'Pulsar 220', 'Pulsar 220', 171, 0, 0, '', '175'),
(180, 'Razor', 'Razor', 170, 0, 0, '', '173'),
(181, 'Razor 500 DLX', 'Razor 500 DLX', 171, 0, 0, '', '180');

-- --------------------------------------------------------

--
-- Table structure for table `categorydetail`
--

CREATE TABLE `categorydetail` (
  `categoryDetailId` int(11) NOT NULL,
  `productCategoryId` int(11) NOT NULL,
  `name` text CHARACTER SET latin1 NOT NULL,
  `nameAr` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorydetail`
--

INSERT INTO `categorydetail` (`categoryDetailId`, `productCategoryId`, `name`, `nameAr`) VALUES
(1, 1, 'Km', 'speed'),
(2, 1, 'mileage', 'mileage');

-- --------------------------------------------------------

--
-- Table structure for table `flaggeditem`
--

CREATE TABLE `flaggeditem` (
  `flaggedId` int(11) NOT NULL,
  `readStatus` int(11) NOT NULL,
  `flagStatus` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productCategoryId` int(11) NOT NULL,
  `traderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flaggeditem`
--

INSERT INTO `flaggeditem` (`flaggedId`, `readStatus`, `flagStatus`, `productId`, `productCategoryId`, `traderId`, `userId`, `date`, `description`) VALUES
(7, 0, 1, 1, 1, 1, 3, '2018-05-06 01:44:39', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageId` int(11) NOT NULL,
  `traderId` int(11) NOT NULL,
  `content` text NOT NULL,
  `sender` text NOT NULL,
  `recipient` text NOT NULL,
  `status` int(11) NOT NULL,
  `statusFailure` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `noplate_template`
--

CREATE TABLE `noplate_template` (
  `noplateTempID` int(11) NOT NULL,
  `emirates` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `templates` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT 'Car - 0 , Bike - 1',
  `long_template` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `noplate_template`
--

INSERT INTO `noplate_template` (`noplateTempID`, `emirates`, `templates`, `code`, `type`, `long_template`) VALUES
(1, 'Dubai', 'http://alshamil.bluecast.ae/img/noplate/base_images/Dubai-new-temp.png', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AC', 0, 'http://alshamil.bluecast.ae/img/noplate/base_images/all/Numberplate-Long/dubai-2.png'),
(2, 'Umm Al Quwain', 'http://alshamil.bluecast.ae/img/noplate/base_images/umm_al_quwain-temp.png', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AC', 0, 'http://alshamil.bluecast.ae/img/noplate/base_images/all/Numberplate-Long/ummalquwain-2.png'),
(3, 'Ajman', 'http://alshamil.bluecast.ae/img/noplate/base_images/Ajman-new-temp.png', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AC', 0, 'http://alshamil.bluecast.ae/img/noplate/base_images/all/Numberplate-Long/ajman-2.png'),
(4, 'Ras al Khaima', 'http://alshamil.bluecast.ae/img/noplate/base_images/ras_al_khaimah-temp.png', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AC', 0, 'http://alshamil.bluecast.ae/img/noplate/base_images/all/Numberplate-Long/rasalkhaimah-2.png'),
(5, 'Fujairah', 'http://alshamil.bluecast.ae/img/noplate/base_images/all/Number%20plates-St/fujairah-temp.png', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AC', 0, 'http://alshamil.bluecast.ae/img/noplate/base_images/all/Numberplate-Long/fujairah-2.png'),
(6, 'Abu Dhabi', 'http://alshamil.bluecast.ae/img/noplate/base_images/Adu_Dhabi-new-temp.png', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42', 0, 'http://alshamil.bluecast.ae/img/noplate/base_images/all/Numberplate-Long/abudhabi-2.png'),
(7, 'Sharjah', 'http://alshamil.bluecast.ae/img/noplate/base_images/Sharjah-temp.png', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42', 0, 'http://alshamil.bluecast.ae/img/noplate/base_images/all/Numberplate-Long/sharjah-2.png'),
(8, 'Dubai', 'http://alshamil.bluecast.ae/img/noplate/base_images/all/bike/6.png', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AC', 1, ''),
(9, 'Umm Al Quwain', 'http://alshamil.bluecast.ae/img/noplate/base_images/all/bike/2.png', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AC', 1, ''),
(10, 'Ajman', 'http://alshamil.bluecast.ae/img/noplate/base_images/all/bike/1.png', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AC', 1, ''),
(11, 'Ras al Khaima', 'http://alshamil.bluecast.ae/img/noplate/base_images/all/bike/4.png', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AC', 1, ''),
(12, 'Fujairah', 'http://alshamil.bluecast.ae/img/noplate/base_images/all/bike/5.png', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AC', 1, ''),
(13, 'Abu Dhabi', 'http://alshamil.bluecast.ae/img/noplate/base_images/all/bike/7.png', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42', 1, ''),
(14, 'Sharjah', 'http://alshamil.bluecast.ae/img/noplate/base_images/all/bike/3.png', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `orderId` int(11) NOT NULL,
  `cartlistId` int(11) NOT NULL,
  `productCategoryId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productPrice` text NOT NULL,
  `ecoTax` text NOT NULL,
  `vatTax` text NOT NULL,
  `orderAmount` text NOT NULL,
  `orderUserId` int(11) NOT NULL,
  `orderUserName` text NOT NULL,
  `orderUserType` int(11) NOT NULL,
  `orderUserLocation` text NOT NULL,
  `orderUserImage` text NOT NULL,
  `customerId` int(11) NOT NULL,
  `traderId` int(11) NOT NULL,
  `orderDate` datetime NOT NULL,
  `orderTime` datetime NOT NULL,
  `shippingMethod` text NOT NULL,
  `cartType` text NOT NULL,
  `paymentType` text NOT NULL,
  `productStatus` int(11) NOT NULL,
  `paymentProof` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`orderId`, `cartlistId`, `productCategoryId`, `productId`, `productPrice`, `ecoTax`, `vatTax`, `orderAmount`, `orderUserId`, `orderUserName`, `orderUserType`, `orderUserLocation`, `orderUserImage`, `customerId`, `traderId`, `orderDate`, `orderTime`, `shippingMethod`, `cartType`, `paymentType`, `productStatus`, `paymentProof`, `status`) VALUES
(1, 0, 0, 0, '', '2000.00', '601.00', '8611.00', 3, '', 0, '', '', 0, 0, '2018-05-14 12:54:58', '0000-00-00 00:00:00', '', '', '0', 0, '0', 0),
(2, 0, 0, 0, '', '2000.00', '555.50', '8110.00', 2, '', 0, '', '', 0, 0, '2018-05-14 10:10:53', '0000-00-00 00:00:00', '', '', '0', 0, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productTitle` text NOT NULL,
  `productTitleAr` text NOT NULL,
  `productCategoryId` int(11) NOT NULL,
  `subCategory1Id` int(11) NOT NULL,
  `subCategory2Id` int(11) NOT NULL,
  `subCategory3Id` int(11) NOT NULL,
  `brand` text NOT NULL,
  `model` text NOT NULL,
  `price` text NOT NULL,
  `description` text NOT NULL,
  `descriptionAr` text NOT NULL,
  `location` text NOT NULL,
  `traderId` int(11) NOT NULL,
  `callForPrice` int(11) NOT NULL DEFAULT '0',
  `submittedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mainImage` text NOT NULL,
  `releaseYear` text NOT NULL,
  `viewCount` int(11) NOT NULL,
  `postValidTill` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `postStatusDetail` text NOT NULL,
  `rejectMessage` text NOT NULL,
  `lastViewed` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productTitle`, `productTitleAr`, `productCategoryId`, `subCategory1Id`, `subCategory2Id`, `subCategory3Id`, `brand`, `model`, `price`, `description`, `descriptionAr`, `location`, `traderId`, `callForPrice`, `submittedOn`, `status`, `type`, `postDate`, `mainImage`, `releaseYear`, `viewCount`, `postValidTill`, `postStatusDetail`, `rejectMessage`, `lastViewed`) VALUES
(1, 'benz benz1 ', 'Benz Benz1 ', 15, 165, 167, 0, '', '', '', 'test using new dynamic category', 'Test Using New Dynamic Category', '', 1, 1, '2018-05-15 04:59:26', 0, 1, '0000-00-00 00:00:00', 'http://localhost/alshamil/uploads/product_images/2450_Mopar-Underground-Dodge-Challenger-Blacktop-concept-illustration.jpg', '', 0, '0000-00-00 00:00:00', '1', '', '0000-00-00 00:00:00'),
(2, '2 wheel ducati Diavel ', '2 Wheel Ducati Diavel ', 16, 172, 174, 176, '', '', '', 'using 3 categories dynamic', 'Using 3 Categories Dynamic', '', 1, 1, '2018-05-15 05:09:12', 0, 1, '0000-00-00 00:00:00', 'http://localhost/alshamil/uploads/product_images/1_578_872_0_70_http___cdni.autocarindia.com_ExtraImages_20171011065046_DIAVEL-DIESEL-LAT-SX.jpg', '', 1, '0000-00-00 00:00:00', '1', '', '2018-05-15 10:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `productdetail`
--

CREATE TABLE `productdetail` (
  `productDetailId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryDetaiId` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productmedia`
--

CREATE TABLE `productmedia` (
  `productMediaId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productCategoryId` int(11) NOT NULL,
  `traderId` int(11) NOT NULL,
  `productImage` text NOT NULL,
  `thumbImage` text NOT NULL,
  `productVideo` text NOT NULL,
  `thumbVideo` text NOT NULL,
  `videoViewCount` int(11) NOT NULL,
  `productLastAccess` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productSubmitDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionplan`
--

CREATE TABLE `subscriptionplan` (
  `planId` int(11) NOT NULL,
  `name` text NOT NULL,
  `amount` text NOT NULL,
  `postCount` int(11) NOT NULL,
  `validity` text NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriptionplan`
--

INSERT INTO `subscriptionplan` (`planId`, `name`, `amount`, `postCount`, `validity`, `description`) VALUES
(1, 'Yearly Limited', '1000', 30, '365', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'),
(2, 'Yearly', '6000', -1, '365', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'),
(3, 'Monthly', '1000', -1, '30', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'),
(4, 'Single', '100', 1, '-1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'),
(7, 'test plan', '700', -1, '60', 'test info'),
(8, 'test2', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trader`
--

CREATE TABLE `trader` (
  `traderId` int(11) NOT NULL,
  `fullName` text NOT NULL,
  `userName` text NOT NULL,
  `password` text NOT NULL,
  `contactNumber` text NOT NULL,
  `email` text NOT NULL,
  `image` text NOT NULL,
  `idProof` text NOT NULL,
  `idProof2` text NOT NULL,
  `socialWeb` text NOT NULL,
  `socialFb` text NOT NULL,
  `socialInsta` text NOT NULL,
  `socialSnap` text NOT NULL,
  `socialTwitter` text NOT NULL,
  `isActive` int(11) NOT NULL,
  `planId` int(11) NOT NULL,
  `postCount` int(11) NOT NULL,
  `bookedCount` int(11) NOT NULL,
  `soldCount` int(11) NOT NULL,
  `watchCount` int(11) NOT NULL,
  `cartCount` int(11) NOT NULL,
  `location` text NOT NULL,
  `paymentHistory` text NOT NULL,
  `registeredOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userType` int(11) NOT NULL,
  `traderInfo` text NOT NULL,
  `deviceId` text NOT NULL,
  `expiresOn` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trader`
--

INSERT INTO `trader` (`traderId`, `fullName`, `userName`, `password`, `contactNumber`, `email`, `image`, `idProof`, `idProof2`, `socialWeb`, `socialFb`, `socialInsta`, `socialSnap`, `socialTwitter`, `isActive`, `planId`, `postCount`, `bookedCount`, `soldCount`, `watchCount`, `cartCount`, `location`, `paymentHistory`, `registeredOn`, `userType`, `traderInfo`, `deviceId`, `expiresOn`) VALUES
(1, 'Admin', '111', '698d51a19d8a121ce581499d7b701668', '+91-1234567890', 'a@g.com', 'http://localhost/alshamil/uploads/trader_images/cat_03.png', 'http://localhost/alshamil/uploads/trader_emirates_images/cat_01.png', 'http://localhost/alshamil/uploads/trader_emirates_images/cat_021.png', '', '', '', '', '', 1, 0, 16, 0, 0, 0, 0, 'Dubai', '', '2018-05-15 06:39:12', 3, '1111', '', '0000-00-00 00:00:00'),
(2, 'test', 'test@test.com', '698d51a19d8a121ce581499d7b701668', '+91-1234567890', 'test@test.com', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '2018-05-04 14:07:23', 0, '', '', '0000-00-00 00:00:00'),
(3, 'test', 'ttt', '698d51a19d8a121ce581499d7b701668', '', '', 'http://localhost/alshamil/uploads/trader_images/1-Add_Category1.png', 'http://localhost/alshamil/uploads/trader_emirates_images/3-Add_Category_-.png', 'http://localhost/alshamil/uploads/trader_emirates_images/4-Add_Category.png', '', '', '', '', '', 1, 7, 0, 0, 0, 0, 0, 'Dubai', '', '2018-05-14 18:52:45', 1, 'test  checker    ', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tradernotification`
--

CREATE TABLE `tradernotification` (
  `notificationId` int(11) NOT NULL,
  `traderId` int(11) NOT NULL,
  `productCategoryId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notifiedFrom` text NOT NULL,
  `message` text NOT NULL,
  `readStatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tradersubscription`
--

CREATE TABLE `tradersubscription` (
  `traderSubscriptionId` int(11) NOT NULL,
  `planId` int(11) NOT NULL,
  `planPostCount` int(11) NOT NULL,
  `planValidity` text NOT NULL,
  `planStatus` int(11) NOT NULL,
  `paymentProof` text NOT NULL,
  `traderId` int(11) NOT NULL,
  `paymentTypeChosen` int(11) NOT NULL,
  `subscribedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tradersubscription`
--

INSERT INTO `tradersubscription` (`traderSubscriptionId`, `planId`, `planPostCount`, `planValidity`, `planStatus`, `paymentProof`, `traderId`, `paymentTypeChosen`, `subscribedOn`) VALUES
(1, 4, -1, '-1', 1, '', 1, 0, '2018-05-05 08:11:17'),
(2, 8, 60, '', 0, '', 3, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `watchlistId` int(11) NOT NULL,
  `traderId` int(11) NOT NULL,
  `productCategoryId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `watchlistCount` int(11) NOT NULL,
  `productAvailability` tinyint(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alshamilbank`
--
ALTER TABLE `alshamilbank`
  ADD PRIMARY KEY (`bankId`);

--
-- Indexes for table `alshamillocation`
--
ALTER TABLE `alshamillocation`
  ADD PRIMARY KEY (`locationId`);

--
-- Indexes for table `bookeditem`
--
ALTER TABLE `bookeditem`
  ADD PRIMARY KEY (`bookedId`);

--
-- Indexes for table `cartlist`
--
ALTER TABLE `cartlist`
  ADD PRIMARY KEY (`cartListId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `categorydetail`
--
ALTER TABLE `categorydetail`
  ADD PRIMARY KEY (`categoryDetailId`);

--
-- Indexes for table `flaggeditem`
--
ALTER TABLE `flaggeditem`
  ADD PRIMARY KEY (`flaggedId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `noplate_template`
--
ALTER TABLE `noplate_template`
  ADD PRIMARY KEY (`noplateTempID`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `productdetail`
--
ALTER TABLE `productdetail`
  ADD PRIMARY KEY (`productDetailId`);

--
-- Indexes for table `productmedia`
--
ALTER TABLE `productmedia`
  ADD PRIMARY KEY (`productMediaId`);

--
-- Indexes for table `subscriptionplan`
--
ALTER TABLE `subscriptionplan`
  ADD PRIMARY KEY (`planId`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader`
--
ALTER TABLE `trader`
  ADD PRIMARY KEY (`traderId`);

--
-- Indexes for table `tradernotification`
--
ALTER TABLE `tradernotification`
  ADD PRIMARY KEY (`notificationId`);

--
-- Indexes for table `tradersubscription`
--
ALTER TABLE `tradersubscription`
  ADD PRIMARY KEY (`traderSubscriptionId`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`watchlistId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alshamilbank`
--
ALTER TABLE `alshamilbank`
  MODIFY `bankId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `alshamillocation`
--
ALTER TABLE `alshamillocation`
  MODIFY `locationId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bookeditem`
--
ALTER TABLE `bookeditem`
  MODIFY `bookedId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cartlist`
--
ALTER TABLE `cartlist`
  MODIFY `cartListId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT for table `categorydetail`
--
ALTER TABLE `categorydetail`
  MODIFY `categoryDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `flaggeditem`
--
ALTER TABLE `flaggeditem`
  MODIFY `flaggedId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `noplate_template`
--
ALTER TABLE `noplate_template`
  MODIFY `noplateTempID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `productdetail`
--
ALTER TABLE `productdetail`
  MODIFY `productDetailId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `productmedia`
--
ALTER TABLE `productmedia`
  MODIFY `productMediaId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscriptionplan`
--
ALTER TABLE `subscriptionplan`
  MODIFY `planId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trader`
--
ALTER TABLE `trader`
  MODIFY `traderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tradernotification`
--
ALTER TABLE `tradernotification`
  MODIFY `notificationId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tradersubscription`
--
ALTER TABLE `tradersubscription`
  MODIFY `traderSubscriptionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `watchlistId` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
