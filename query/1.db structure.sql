-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2018 at 04:48 PM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alshamil_alshamillive`
--

-- --------------------------------------------------------

--
-- Table structure for table `alshamilbank`
--

CREATE TABLE `alshamilbank` (
  `alshamilBankID` int(20) NOT NULL,
  `bankName` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankAccountNo` bigint(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alshamillocation`
--

CREATE TABLE `alshamillocation` (
  `locationID` int(20) NOT NULL,
  `locationName` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `locationAddress` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `locationContactNo` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coordinates` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookeditems`
--

CREATE TABLE `bookeditems` (
  `bookedID` int(20) NOT NULL,
  `postID` int(20) NOT NULL,
  `traderID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `bookedUserID` int(20) NOT NULL,
  `bookedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bookedUserName` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookedUserType` tinyint(1) NOT NULL,
  `bookedUserLocation` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookedUserImage` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cartlist`
--

CREATE TABLE `cartlist` (
  `cartlistID` int(11) NOT NULL,
  `postID` int(20) NOT NULL,
  `traderID` int(11) NOT NULL,
  `productCategoryID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `cartlistCount` int(11) NOT NULL,
  `productAvailability` tinyint(4) NOT NULL,
  `userID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `productCategoryID` int(20) NOT NULL,
  `category_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentCategory` int(20) NOT NULL,
  `categoryProductCount` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_subtypes`
--

CREATE TABLE `category_subtypes` (
  `cat_id` int(11) NOT NULL,
  `productCategoryID` int(11) NOT NULL,
  `brandID` int(11) NOT NULL,
  `brandName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelID` int(11) NOT NULL,
  `modelName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_news`
--

CREATE TABLE `ci_news` (
  `ne_id` int(10) NOT NULL,
  `ne_created` datetime NOT NULL,
  `ne_lang` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ne_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ne_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ne_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(20) NOT NULL,
  `customerEmail` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customerPasswd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flaggeditems`
--

CREATE TABLE `flaggeditems` (
  `flaggedID` int(20) NOT NULL,
  `readStatus` int(11) NOT NULL,
  `flagStatus` tinyint(1) NOT NULL,
  `postID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `ProductcategoryID` int(20) NOT NULL,
  `traderID` int(20) NOT NULL,
  `flagUserID` int(20) NOT NULL,
  `flagDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flagDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageID` int(20) NOT NULL,
  `traderID` int(20) NOT NULL,
  `messageContent` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `messageSender` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `messageRecipient` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `messageStatus` tinyint(1) NOT NULL,
  `messageStatus_failure` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderID` int(20) NOT NULL,
  `ecoTax` float NOT NULL,
  `vatTax` float NOT NULL,
  `orderAmount` float NOT NULL,
  `orderUserID` int(20) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `paymentType` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentProof` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `planID` int(20) NOT NULL,
  `planName` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `planSubscriptionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `planValidity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `planStatus_active` tinyint(1) NOT NULL,
  `planStatus_expired` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postID` int(20) NOT NULL,
  `traderID` int(20) NOT NULL,
  `productID` int(11) NOT NULL,
  `productCategoryID` int(11) NOT NULL,
  `postDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `postSubmissionOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `postValidTill` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `postStatus` tinyint(1) NOT NULL,
  `postStatusDetail` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rejectMsg` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productViewCount` int(11) NOT NULL DEFAULT '0',
  `productLastViewed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(20) NOT NULL,
  `traderID` int(20) NOT NULL,
  `productName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productDescr` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPrice` float NOT NULL,
  `productOwnerID` int(20) NOT NULL,
  `productImage` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productVideo` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `productSubmitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productUpdateDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productStock` float NOT NULL,
  `productLive` tinyint(1) NOT NULL,
  `productOperator` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productMNPrefix` int(11) NOT NULL,
  `productLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productValidity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productiPBrand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productiPModel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCBrand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCModel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productReleaseYear` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productNPCode` int(11) NOT NULL,
  `productNPDigits` int(11) NOT NULL,
  `productNPNmbr` int(20) NOT NULL,
  `productPropSC` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPropType` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productViewCount` int(20) NOT NULL,
  `productStatus_Available` tinyint(1) NOT NULL,
  `productStatus_in_cart` tinyint(1) NOT NULL,
  `productStatus_in_wish` tinyint(1) NOT NULL,
  `productStatus_sold_out` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productbike`
--

CREATE TABLE `productbike` (
  `traderID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `productLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `productCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productBBrand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productBModel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productBReleaseYear` int(10) UNSIGNED DEFAULT NULL,
  `productBPrice` float NOT NULL,
  `productBCallPrice` tinyint(1) NOT NULL DEFAULT '0',
  `productBDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productBSubmitDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productBValidity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productBWatchCount` int(20) NOT NULL,
  `productBCartCount` int(20) NOT NULL,
  `productBStatus` tinyint(1) NOT NULL,
  `cartBType` tinyint(1) NOT NULL,
  `productBLive` tinyint(1) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Bpost_main_img` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `test1` int(11) NOT NULL,
  `test2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productboat`
--

CREATE TABLE `productboat` (
  `traderID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `productLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `productCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productBtBrand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productBtModel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productBReleaseYear` int(10) UNSIGNED DEFAULT NULL,
  `productBTPrice` float NOT NULL,
  `productBtCallPrice` tinyint(1) NOT NULL DEFAULT '0',
  `productBDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productBTSubmitDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productBValidity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productBWatchCount` int(20) NOT NULL,
  `productBCartCount` int(20) NOT NULL,
  `productBTStatus` tinyint(1) NOT NULL,
  `cartBTType` tinyint(1) NOT NULL,
  `productBtLive` tinyint(1) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `BTpost_main_img` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `test1` int(11) NOT NULL,
  `test2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productcar`
--

CREATE TABLE `productcar` (
  `productCategoryID` int(11) NOT NULL,
  `traderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCBrand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCModel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCReleaseYear` int(20) NOT NULL,
  `productCPrice` float NOT NULL,
  `productCCallPrice` tinyint(1) NOT NULL DEFAULT '0',
  `productCDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCSubmitDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productCValidity` int(11) NOT NULL,
  `productCWatchCount` int(11) NOT NULL,
  `productCCartCount` int(11) NOT NULL,
  `productCStatus` tinyint(11) NOT NULL,
  `cartCType` tinyint(4) NOT NULL,
  `productCLive` tinyint(4) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Cpost_main_img` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `test1` int(11) NOT NULL,
  `test2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productiv`
--

CREATE TABLE `productiv` (
  `productIV_ID` int(11) NOT NULL,
  `productID` int(20) NOT NULL,
  `postID` int(20) NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `traderID` int(20) NOT NULL,
  `productImage` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbImage` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productVideo` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbVideo` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cartType` tinyint(1) NOT NULL,
  `productLive` tinyint(1) NOT NULL,
  `productVideoCount` int(20) NOT NULL,
  `productViewCount` int(20) NOT NULL,
  `productLastAccess` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productSubmitDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productmn`
--

CREATE TABLE `productmn` (
  `traderID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `productLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `productCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productOperator` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productMNPrefix` int(11) NOT NULL,
  `productMNDigits` int(11) NOT NULL,
  `productMNNmbr` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productMNPrice` float NOT NULL,
  `productMNCallPrice` tinyint(1) NOT NULL DEFAULT '0',
  `productMNDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productMNSubmitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productMNValidity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productMNView` int(20) NOT NULL,
  `productMNWatchCount` int(20) NOT NULL,
  `productMNCartCount` int(20) NOT NULL,
  `productMNStatus` tinyint(1) NOT NULL,
  `cartMNType` tinyint(1) NOT NULL,
  `productMNLive` tinyint(1) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MNpost_main_img` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productnp`
--

CREATE TABLE `productnp` (
  `traderID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `productLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `productCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productNPEmrites` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productNPTemplate` tinyint(1) NOT NULL,
  `productNPCode` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productNPDigits` int(11) NOT NULL,
  `productNPNmbr` int(20) NOT NULL,
  `productNPPrice` float NOT NULL,
  `productNPCallPrice` tinyint(1) NOT NULL DEFAULT '0',
  `productNPDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productNPSubmitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productNPValidity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productNPWatchCount` int(20) NOT NULL,
  `productNPCartCount` int(20) NOT NULL,
  `productNPStatus` tinyint(1) NOT NULL,
  `cartNPType` tinyint(1) NOT NULL,
  `productNPLive` tinyint(1) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `NPpost_main_img` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productphone`
--

CREATE TABLE `productphone` (
  `traderID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `productLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `productCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPBrand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPModel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPHPrice` float NOT NULL,
  `productPhCallPrice` tinyint(1) NOT NULL DEFAULT '0',
  `productPDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPSubmitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productPValidity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productPWatchCount` int(20) NOT NULL,
  `productPCartCount` int(20) NOT NULL,
  `productPHStatus` tinyint(1) NOT NULL,
  `cartPHType` tinyint(1) NOT NULL,
  `productPhLive` tinyint(1) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PHpost_main_img` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `test1` int(11) NOT NULL,
  `test2` int(11) NOT NULL,
  `test_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productproperty`
--

CREATE TABLE `productproperty` (
  `traderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `productCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPropSC` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPropType` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productViewCount` int(20) NOT NULL,
  `productPRSubmitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productValidity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productPRPrice` float NOT NULL,
  `productPropCallPrice` tinyint(1) NOT NULL DEFAULT '0',
  `productDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productView` int(20) NOT NULL,
  `productWatchCount` int(20) NOT NULL,
  `productCartCount` int(20) NOT NULL,
  `productPRStatus` tinyint(1) NOT NULL,
  `cartPRType` tinyint(1) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PRpost_main_img` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPrLive` tinyint(1) NOT NULL,
  `test1` int(11) NOT NULL,
  `test2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productstatus`
--

CREATE TABLE `productstatus` (
  `productID` int(20) NOT NULL,
  `traderID` int(20) NOT NULL,
  `productAvailability` tinyint(1) NOT NULL,
  `cartType` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productvertu`
--

CREATE TABLE `productvertu` (
  `traderID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `productLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `productCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productVBrand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productVModel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productVPrice` float NOT NULL,
  `productVCallPrice` tinyint(1) NOT NULL DEFAULT '0',
  `productVDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productVSubmitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productVValidity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productVView` int(20) NOT NULL,
  `productVWatchCount` int(20) NOT NULL,
  `productVCartCount` int(20) NOT NULL,
  `productVStatus` tinyint(1) NOT NULL,
  `cartVType` tinyint(1) NOT NULL,
  `productVLive` tinyint(1) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Vpost_main_img` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `test1` int(11) NOT NULL,
  `test2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productwatch`
--

CREATE TABLE `productwatch` (
  `traderID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `productLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `productCategoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productWBrand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productWModel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productWPrice` float NOT NULL,
  `productWCallPrice` tinyint(1) NOT NULL DEFAULT '0',
  `productWDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `productWSubmitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productWValidity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productWView` int(20) NOT NULL,
  `productWWatchCount` int(20) NOT NULL,
  `productWCartCount` int(20) NOT NULL,
  `productWStatus` tinyint(1) NOT NULL,
  `cartWType` tinyint(1) NOT NULL,
  `productWLive` tinyint(1) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Wpost_main_img` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `test1` int(11) NOT NULL,
  `test2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `socialWeb` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `socialFb` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `socialInsta` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `socialSnap` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionplan`
--

CREATE TABLE `subscriptionplan` (
  `subscriptionID` int(20) NOT NULL,
  `planID` int(20) NOT NULL,
  `planName` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `planAmount` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `planPostCount` int(20) NOT NULL,
  `planValidity` int(20) NOT NULL,
  `planDesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trader`
--

CREATE TABLE `trader` (
  `traderID` int(20) NOT NULL,
  `traderFullName` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `traderUserName` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traderPasswd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traderContactNum` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traderEmailID` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traderImage` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `traderIDProof` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `traderIDProofsecond` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `socialWeb` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `socialFb` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `socialInsta` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `socialSnap` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `socialtwitter` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `planID` int(20) NOT NULL,
  `traderPostCount` int(20) NOT NULL,
  `traderBookedCount` int(20) NOT NULL,
  `traderSoldCount` int(20) NOT NULL,
  `traderWatchCount` int(20) NOT NULL,
  `traderCartCount` int(20) NOT NULL,
  `traderLocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traderPaymentHistory` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traderRegistrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usertype` tinyint(1) NOT NULL,
  `traderInfo` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deviceId` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traderValidTill` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `auth_token` mediumtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tradernotifications`
--

CREATE TABLE `tradernotifications` (
  `notificationID` int(20) NOT NULL,
  `traderID` int(20) NOT NULL,
  `postID` int(20) NOT NULL,
  `productCategoryID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `notificationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notificationBy` int(20) NOT NULL,
  `notificationMessage` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `readStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tradersubscriptionpaln_bkp`
--

-- CREATE TABLE `tradersubscriptionpaln_bkp` (
--   `tradersubscriptionID` int(20) NOT NULL DEFAULT '0',
--   `planID` int(20) NOT NULL,
--   `planName` varchar(60) NOT NULL,
--   `planAmount` varchar(60) NOT NULL,
--   `planPostCount` int(20) NOT NULL,
--   `planValidity` int(20) NOT NULL,
--   `planStatus` tinyint(1) NOT NULL,
--   `paymentProof` text NOT NULL,
--   `traderID` int(20) NOT NULL,
--   `paymentTypeChosen` tinyint(4) NOT NULL
-- ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tradersubscriptionplan`
--

CREATE TABLE `tradersubscriptionplan` (
  `tradersubscriptionID` int(20) NOT NULL,
  `planID` int(20) NOT NULL,
  `planName` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `planAmount` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `planPostCount` int(20) NOT NULL,
  `planValidity` date NOT NULL,
  `planStatus` tinyint(1) NOT NULL,
  `paymentProof` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `traderID` int(20) NOT NULL,
  `paymentTypeChosen` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trader_add_post`
--

CREATE TABLE `trader_add_post` (
  `id` int(11) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `post_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trader_register`
--

CREATE TABLE `trader_register` (
  `trader_id` int(11) NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobileno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_subscribe_time` date NOT NULL,
  `dob` date NOT NULL,
  `emirate_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `em_exp_date` date NOT NULL,
  `passport_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_exp_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwNotifications`
-- (See below for the actual view)
--
-- CREATE TABLE `vwNotifications` (
-- `isTypeFlagged` bigint(20)
-- ,`traderID` int(20)
-- ,`notificationBy` int(20)
-- ,`date` timestamp
-- ,`postID` int(20)
-- ,`description` mediumtext
-- ,`brand` varchar(100)
-- ,`model` varchar(100)
-- ,`price` float
-- ,`callprice` tinyint(4)
-- ,`image` mediumtext
-- );

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwNotificationsByUser`
-- (See below for the actual view)
--
-- CREATE TABLE `vwNotificationsByUser` (
-- `isTypeFlagged` bigint(20)
-- ,`traderID` int(20)
-- ,`notificationBy` int(20)
-- ,`date` timestamp
-- ,`postID` int(20)
-- ,`description` mediumtext
-- ,`brand` varchar(100)
-- ,`model` varchar(100)
-- ,`price` float
-- ,`callprice` tinyint(4)
-- ,`image` mediumtext
-- ,`notificationByFullName` varchar(200)
-- );

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwNotificationsByUserNw`
-- (See below for the actual view)
--
-- CREATE TABLE `vwNotificationsByUserNw` (
-- `isTypeFlagged` bigint(20)
-- ,`traderID` int(20)
-- ,`notificationBy` int(20)
-- ,`date` varchar(40)
-- ,`postID` int(20)
-- ,`description` mediumtext
-- ,`brand` varchar(100)
-- ,`model` varchar(100)
-- ,`price` float
-- ,`callprice` tinyint(4)
-- ,`image` mediumtext
-- ,`notificationByFullName` varchar(200)
-- );

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwProduct`
-- (See below for the actual view)
--
-- CREATE TABLE `vwProduct` (
-- `ID` varchar(36)
-- ,`CategoryID` int(20)
-- ,`ProductID` int(20)
-- ,`TraderID` int(20)
-- ,`Location` varchar(100)
-- ,`Brand` varchar(100)
-- ,`Model` varchar(100)
-- ,`CallPrice` tinyint(4)
-- ,`Price` float
-- ,`AvailablitiyStatus` tinyint(4)
-- ,`IsAlshamilProduct` tinyint(4)
-- ,`Description` mediumtext
-- ,`SubmitDate` timestamp
-- ,`Image` mediumtext
-- ,`ReleaseYear` int(11) unsigned
-- ,`Digits` int(11)
-- ,`Number` varchar(20)
-- );

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwProductPost`
-- (See below for the actual view)
--
-- CREATE TABLE `vwProductPost` (
-- `ID` varchar(36)
-- ,`CategoryID` int(20)
-- ,`ProductID` int(20)
-- ,`TraderID` int(20)
-- ,`Location` varchar(100)
-- ,`Brand` varchar(100)
-- ,`Model` varchar(100)
-- ,`CallPrice` tinyint(4)
-- ,`Price` float
-- ,`AvailablitiyStatus` tinyint(4)
-- ,`IsAlshamilProduct` tinyint(4)
-- ,`Description` mediumtext
-- ,`SubmitDate` timestamp
-- ,`Image` mediumtext
-- ,`ReleaseYear` int(11) unsigned
-- ,`Digits` int(11)
-- ,`Number` varchar(20)
-- ,`postID` int(20)
-- ,`PostAdminStatus` tinyint(1)
-- ,`rejectMsg` mediumtext
-- ,`productViewCount` int(11)
-- ,`productLastViewed` datetime
-- );

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwProductPostNw`
-- (See below for the actual view)
--
-- CREATE TABLE `vwProductPostNw` (
-- `ID` varchar(36)
-- ,`CategoryID` int(20)
-- ,`ProductID` int(20)
-- ,`TraderID` int(20)
-- ,`Location` varchar(100)
-- ,`Brand` varchar(100)
-- ,`Model` varchar(100)
-- ,`CallPrice` tinyint(4)
-- ,`Price` float
-- ,`AvailablitiyStatus` tinyint(4)
-- ,`IsAlshamilProduct` tinyint(4)
-- ,`Description` mediumtext
-- ,`SubmitDate` varchar(40)
-- ,`Image` mediumtext
-- ,`ReleaseYear` int(11) unsigned
-- ,`Digits` int(11)
-- ,`Number` varchar(20)
-- ,`postID` int(20)
-- ,`PostAdminStatus` tinyint(1)
-- );

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwTrader`
-- (See below for the actual view)
--
-- CREATE TABLE `vwTrader` (
-- `traderID` int(20)
-- ,`traderFullName` varchar(200)
-- ,`traderUserName` varchar(60)
-- ,`traderPasswd` varchar(255)
-- ,`traderContactNum` varchar(25)
-- ,`traderEmailID` varchar(60)
-- ,`traderImage` mediumtext
-- ,`traderIDProof` mediumtext
-- ,`traderIDProofsecond` mediumtext
-- ,`socialWeb` varchar(60)
-- ,`socialFb` varchar(60)
-- ,`socialInsta` varchar(60)
-- ,`socialSnap` varchar(60)
-- ,`socialtwitter` varchar(60)
-- ,`isActive` tinyint(1)
-- ,`planID` int(20)
-- ,`traderPostCount` int(20)
-- ,`traderBookedCount` int(20)
-- ,`traderSoldCount` int(20)
-- ,`traderWatchCount` int(20)
-- ,`traderCartCount` int(20)
-- ,`traderLocation` varchar(100)
-- ,`traderPaymentHistory` varchar(500)
-- ,`traderRegistrationDate` timestamp
-- ,`usertype` tinyint(1)
-- ,`traderInfo` mediumtext
-- ,`deviceId` varchar(500)
-- ,`traderValidTill` timestamp
-- ,`auth_token` mediumtext
-- ,`planName` varchar(60)
-- ,`planAmount` varchar(60)
-- ,`planPostCount` int(20)
-- ,`planValidity` date
-- ,`planStatus` tinyint(1)
-- ,`paymentProof` mediumtext
-- ,`paymentTypeChosen` tinyint(4)
-- ,`tplanID` int(20)
-- );

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `watchlistID` int(11) NOT NULL,
  `postID` int(20) NOT NULL,
  `traderID` int(11) NOT NULL,
  `productCategoryID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `watchlistCount` int(11) NOT NULL,
  `productAvailability` tinyint(4) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `vwNotifications`
--
-- DROP TABLE IF EXISTS `vwNotifications`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`alshamilbluecast`@`localhost` SQL SECURITY DEFINER VIEW `vwNotifications`  AS  select 1 AS `isTypeFlagged`,`f`.`traderID` AS `traderID`,`f`.`flagUserID` AS `notificationBy`,`f`.`flagDate` AS `date`,`f`.`postID` AS `postID`,`f`.`flagDesc` AS `description`,`v`.`Brand` AS `brand`,`v`.`Model` AS `model`,`v`.`Price` AS `price`,`v`.`CallPrice` AS `callprice`,`v`.`Image` AS `image` from (`flaggeditems` `f` join `vwProductPost` `v` on((`f`.`postID` = `v`.`postID`))) union select 0 AS `isTypeFlagged`,`tradernotifications`.`traderID` AS `traderID`,`tradernotifications`.`notificationBy` AS `notificationBy`,`tradernotifications`.`notificationDate` AS `date`,`tradernotifications`.`postID` AS `postID`,`tradernotifications`.`notificationMessage` AS `description`,NULL AS `brand`,NULL AS `model`,NULL AS `price`,NULL AS `callprice`,NULL AS `image` from `tradernotifications` ;

-- -- --------------------------------------------------------

-- --
-- -- Structure for view `vwNotificationsByUser`
-- --
-- DROP TABLE IF EXISTS `vwNotificationsByUser`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`alshamilbluecast`@`localhost` SQL SECURITY DEFINER VIEW `vwNotificationsByUser`  AS  select `n`.`isTypeFlagged` AS `isTypeFlagged`,`n`.`traderID` AS `traderID`,`n`.`notificationBy` AS `notificationBy`,`n`.`date` AS `date`,`n`.`postID` AS `postID`,`n`.`description` AS `description`,`n`.`brand` AS `brand`,`n`.`model` AS `model`,`n`.`price` AS `price`,`n`.`callprice` AS `callprice`,`n`.`image` AS `image`,`t`.`traderFullName` AS `notificationByFullName` from (`vwNotifications` `n` join `trader` `t` on((`t`.`traderID` = `n`.`notificationBy`))) order by `n`.`date` desc ;

-- --------------------------------------------------------

--
-- Structure for view `vwNotificationsByUserNw`
--
-- DROP TABLE IF EXISTS `vwNotificationsByUserNw`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`alshamilbluecast`@`localhost` SQL SECURITY DEFINER VIEW `vwNotificationsByUserNw`  AS  select `n`.`isTypeFlagged` AS `isTypeFlagged`,`n`.`traderID` AS `traderID`,`n`.`notificationBy` AS `notificationBy`,date_format(`n`.`date`,'%d %b %Y') AS `date`,`n`.`postID` AS `postID`,`n`.`description` AS `description`,`n`.`brand` AS `brand`,`n`.`model` AS `model`,`n`.`price` AS `price`,`n`.`callprice` AS `callprice`,`n`.`image` AS `image`,`t`.`traderFullName` AS `notificationByFullName` from (`vwNotifications` `n` join `trader` `t` on((`t`.`traderID` = `n`.`notificationBy`))) order by `n`.`date` desc ;

-- --------------------------------------------------------

--
-- Structure for view `vwProduct`
--
-- DROP TABLE IF EXISTS `vwProduct`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`alshamilbluecast`@`localhost` SQL SECURITY DEFINER VIEW `vwProduct`  AS  select uuid() AS `ID`,`p`.`productCategoryID` AS `CategoryID`,`p`.`productID` AS `ProductID`,`p`.`traderID` AS `TraderID`,`p`.`productLocation` AS `Location`,`p`.`productBBrand` AS `Brand`,`p`.`productBModel` AS `Model`,`p`.`productBCallPrice` AS `CallPrice`,`p`.`productBPrice` AS `Price`,`p`.`productBStatus` AS `AvailablitiyStatus`,`p`.`cartBType` AS `IsAlshamilProduct`,`p`.`productBDesc` AS `Description`,`p`.`productBSubmitDate` AS `SubmitDate`,`p`.`Bpost_main_img` AS `Image`,`p`.`productBReleaseYear` AS `ReleaseYear`,NULL AS `Digits`,NULL AS `Number` from `productbike` `p` union select uuid() AS `ID`,`p`.`productCategoryID` AS `CategoryID`,`p`.`productID` AS `ProductID`,`p`.`traderID` AS `TraderID`,`p`.`productLocation` AS `Location`,`p`.`productBtBrand` AS `Brand`,`p`.`productBtModel` AS `Model`,`p`.`productBtCallPrice` AS `CallPrice`,`p`.`productBTPrice` AS `Price`,`p`.`productBTStatus` AS `AvailablitiyStatus`,`p`.`cartBTType` AS `IsAlshamilProduct`,`p`.`productBDesc` AS `Description`,`p`.`productBTSubmitDate` AS `SubmitDate`,`p`.`BTpost_main_img` AS `Image`,`p`.`productBReleaseYear` AS `ReleaseYear`,NULL AS `Digits`,NULL AS `Number` from `productboat` `p` union select uuid() AS `ID`,`p`.`productCategoryID` AS `CategoryID`,`p`.`productID` AS `ProductID`,`p`.`traderID` AS `TraderID`,`p`.`productLocation` AS `Location`,`p`.`productCBrand` AS `Brand`,`p`.`productCModel` AS `Model`,`p`.`productCCallPrice` AS `CallPrice`,`p`.`productCPrice` AS `Price`,`p`.`productCStatus` AS `AvailablitiyStatus`,`p`.`cartCType` AS `IsAlshamilProduct`,`p`.`productCDesc` AS `Description`,`p`.`productCSubmitDate` AS `SubmitDate`,`p`.`Cpost_main_img` AS `Image`,`p`.`productCReleaseYear` AS `ReleaseYear`,NULL AS `Digits`,NULL AS `Number` from `productcar` `p` union select uuid() AS `ID`,`p`.`productCategoryID` AS `CategoryID`,`p`.`productID` AS `ProductID`,`p`.`traderID` AS `TraderID`,`p`.`productLocation` AS `Location`,`p`.`productNPEmrites` AS `Brand`,`p`.`productNPCode` AS `Model`,`p`.`productNPCallPrice` AS `CallPrice`,`p`.`productNPPrice` AS `Price`,`p`.`productNPStatus` AS `AvailablitiyStatus`,`p`.`cartNPType` AS `IsAlshamilProduct`,`p`.`productNPDesc` AS `Description`,`p`.`productNPSubmitDate` AS `SubmitDate`,`p`.`NPpost_main_img` AS `Image`,NULL AS `ReleaseYear`,`p`.`productNPDigits` AS `Digits`,`p`.`productNPNmbr` AS `Number` from `productnp` `p` union select uuid() AS `ID`,`p`.`productCategoryID` AS `CategoryID`,`p`.`productID` AS `ProductID`,`p`.`traderID` AS `TraderID`,`p`.`productLocation` AS `Location`,`p`.`productVBrand` AS `Brand`,`p`.`productVModel` AS `Model`,`p`.`productVCallPrice` AS `CallPrice`,`p`.`productVPrice` AS `Price`,`p`.`productVStatus` AS `AvailablitiyStatus`,`p`.`cartVType` AS `IsAlshamilProduct`,`p`.`productVDesc` AS `Description`,`p`.`productVSubmitDate` AS `SubmitDate`,`p`.`Vpost_main_img` AS `Image`,NULL AS `ReleaseYear`,NULL AS `Digits`,NULL AS `Number` from `productvertu` `p` union select uuid() AS `ID`,`p`.`productCategoryID` AS `CategoryID`,`p`.`productID` AS `ProductID`,`p`.`traderID` AS `TraderID`,`p`.`productLocation` AS `Location`,`p`.`productWBrand` AS `Brand`,`p`.`productWModel` AS `Model`,`p`.`productWCallPrice` AS `CallPrice`,`p`.`productWPrice` AS `Price`,`p`.`productWStatus` AS `AvailablitiyStatus`,`p`.`cartWType` AS `IsAlshamilProduct`,`p`.`productWDesc` AS `Description`,`p`.`productWSubmitDate` AS `SubmitDate`,`p`.`Wpost_main_img` AS `Image`,NULL AS `ReleaseYear`,NULL AS `Digits`,NULL AS `Number` from `productwatch` `p` union select uuid() AS `ID`,`p`.`productCategoryID` AS `CategoryID`,`p`.`productID` AS `ProductID`,`p`.`traderID` AS `TraderID`,`p`.`productLocation` AS `Location`,`p`.`productOperator` AS `Brand`,`p`.`productMNPrefix` AS `Model`,`p`.`productMNCallPrice` AS `CallPrice`,`p`.`productMNPrice` AS `Price`,`p`.`productMNStatus` AS `AvailablitiyStatus`,`p`.`cartMNType` AS `IsAlshamilProduct`,`p`.`productMNDesc` AS `Description`,`p`.`productMNSubmitDate` AS `SubmitDate`,`p`.`MNpost_main_img` AS `Image`,NULL AS `ReleaseYear`,`p`.`productMNDigits` AS `Digits`,`p`.`productMNNmbr` AS `Number` from `productmn` `p` union select uuid() AS `ID`,`p`.`productCategoryID` AS `CategoryID`,`p`.`productID` AS `ProductID`,`p`.`traderID` AS `TraderID`,`p`.`productLocation` AS `Location`,`p`.`productPBrand` AS `Brand`,`p`.`productPModel` AS `Model`,`p`.`productPhCallPrice` AS `CallPrice`,`p`.`productPHPrice` AS `Price`,`p`.`productPHStatus` AS `AvailablitiyStatus`,`p`.`cartPHType` AS `IsAlshamilProduct`,`p`.`productPDesc` AS `Description`,`p`.`productPSubmitDate` AS `SubmitDate`,`p`.`PHpost_main_img` AS `Image`,NULL AS `ReleaseYear`,NULL AS `Digits`,NULL AS `Number` from `productphone` `p` union select uuid() AS `ID`,`p`.`productCategoryID` AS `CategoryID`,`p`.`productID` AS `ProductID`,`p`.`traderID` AS `TraderID`,`p`.`productLocation` AS `Location`,`p`.`productPropSC` AS `Brand`,`p`.`productPropType` AS `Model`,`p`.`productPropCallPrice` AS `CallPrice`,`p`.`productPRPrice` AS `Price`,`p`.`productPRStatus` AS `AvailablitiyStatus`,`p`.`cartPRType` AS `IsAlshamilProduct`,`p`.`productDesc` AS `Description`,`p`.`productPRSubmitDate` AS `SubmitDate`,`p`.`PRpost_main_img` AS `Image`,NULL AS `ReleaseYear`,NULL AS `Digits`,NULL AS `Number` from `productproperty` `p` ;

-- --------------------------------------------------------

--
-- Structure for view `vwProductPost`
--
-- DROP TABLE IF EXISTS `vwProductPost`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`alshamilbluecast`@`localhost` SQL SECURITY DEFINER VIEW `vwProductPost`  AS  select `product`.`ID` AS `ID`,`product`.`CategoryID` AS `CategoryID`,`product`.`ProductID` AS `ProductID`,`product`.`TraderID` AS `TraderID`,`product`.`Location` AS `Location`,`product`.`Brand` AS `Brand`,`product`.`Model` AS `Model`,`product`.`CallPrice` AS `CallPrice`,`product`.`Price` AS `Price`,`product`.`AvailablitiyStatus` AS `AvailablitiyStatus`,`product`.`IsAlshamilProduct` AS `IsAlshamilProduct`,`product`.`Description` AS `Description`,`product`.`SubmitDate` AS `SubmitDate`,`product`.`Image` AS `Image`,`product`.`ReleaseYear` AS `ReleaseYear`,`product`.`Digits` AS `Digits`,`product`.`Number` AS `Number`,`post`.`postID` AS `postID`,`post`.`postStatus` AS `PostAdminStatus`,`post`.`rejectMsg` AS `rejectMsg`,`post`.`productViewCount` AS `productViewCount`,`post`.`productLastViewed` AS `productLastViewed` from (`vwProduct` `product` join `post` on(((`product`.`CategoryID` = `post`.`productCategoryID`) and (`product`.`ProductID` = `post`.`productID`) and (`product`.`TraderID` = `post`.`traderID`)))) ;

-- -- --------------------------------------------------------

-- --
-- -- Structure for view `vwProductPostNw`
-- --
-- DROP TABLE IF EXISTS `vwProductPostNw`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`alshamilbluecast`@`localhost` SQL SECURITY DEFINER VIEW `vwProductPostNw`  AS  select `product`.`ID` AS `ID`,`product`.`CategoryID` AS `CategoryID`,`product`.`ProductID` AS `ProductID`,`product`.`TraderID` AS `TraderID`,`product`.`Location` AS `Location`,`product`.`Brand` AS `Brand`,`product`.`Model` AS `Model`,`product`.`CallPrice` AS `CallPrice`,`product`.`Price` AS `Price`,`product`.`AvailablitiyStatus` AS `AvailablitiyStatus`,`product`.`IsAlshamilProduct` AS `IsAlshamilProduct`,`product`.`Description` AS `Description`,date_format(`product`.`SubmitDate`,'%d %b %Y') AS `SubmitDate`,`product`.`Image` AS `Image`,`product`.`ReleaseYear` AS `ReleaseYear`,`product`.`Digits` AS `Digits`,`product`.`Number` AS `Number`,`post`.`postID` AS `postID`,`post`.`postStatus` AS `PostAdminStatus` from (`vwProduct` `product` join `post` on(((`product`.`CategoryID` = `post`.`productCategoryID`) and (`product`.`ProductID` = `post`.`productID`) and (`product`.`TraderID` = `post`.`traderID`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `vwTrader`
--
-- DROP TABLE IF EXISTS `vwTrader`;

-- CREATE ALGORITHM=UNDEFINED DEFINER=`alshamilbluecast`@`localhost` SQL SECURITY DEFINER VIEW `vwTrader`  AS  select `t`.`traderID` AS `traderID`,`t`.`traderFullName` AS `traderFullName`,`t`.`traderUserName` AS `traderUserName`,`t`.`traderPasswd` AS `traderPasswd`,`t`.`traderContactNum` AS `traderContactNum`,`t`.`traderEmailID` AS `traderEmailID`,`t`.`traderImage` AS `traderImage`,`t`.`traderIDProof` AS `traderIDProof`,`t`.`traderIDProofsecond` AS `traderIDProofsecond`,`t`.`socialWeb` AS `socialWeb`,`t`.`socialFb` AS `socialFb`,`t`.`socialInsta` AS `socialInsta`,`t`.`socialSnap` AS `socialSnap`,`t`.`socialtwitter` AS `socialtwitter`,`t`.`isActive` AS `isActive`,`t`.`planID` AS `planID`,`t`.`traderPostCount` AS `traderPostCount`,`t`.`traderBookedCount` AS `traderBookedCount`,`t`.`traderSoldCount` AS `traderSoldCount`,`t`.`traderWatchCount` AS `traderWatchCount`,`t`.`traderCartCount` AS `traderCartCount`,`t`.`traderLocation` AS `traderLocation`,`t`.`traderPaymentHistory` AS `traderPaymentHistory`,`t`.`traderRegistrationDate` AS `traderRegistrationDate`,`t`.`usertype` AS `usertype`,`t`.`traderInfo` AS `traderInfo`,`t`.`deviceId` AS `deviceId`,`t`.`traderValidTill` AS `traderValidTill`,`t`.`auth_token` AS `auth_token`,`ts`.`planName` AS `planName`,`ts`.`planAmount` AS `planAmount`,`ts`.`planPostCount` AS `planPostCount`,`ts`.`planValidity` AS `planValidity`,`ts`.`planStatus` AS `planStatus`,`ts`.`paymentProof` AS `paymentProof`,`ts`.`paymentTypeChosen` AS `paymentTypeChosen`,`ts`.`planID` AS `tplanID` from (`trader` `t` left join `tradersubscriptionplan` `ts` on((`t`.`traderID` = `ts`.`traderID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alshamilbank`
--
ALTER TABLE `alshamilbank`
  ADD PRIMARY KEY (`alshamilBankID`);

--
-- Indexes for table `alshamillocation`
--
ALTER TABLE `alshamillocation`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `bookeditems`
--
ALTER TABLE `bookeditems`
  ADD PRIMARY KEY (`bookedID`);

--
-- Indexes for table `cartlist`
--
ALTER TABLE `cartlist`
  ADD PRIMARY KEY (`cartlistID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`productCategoryID`);

--
-- Indexes for table `category_subtypes`
--
ALTER TABLE `category_subtypes`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `ci_news`
--
ALTER TABLE `ci_news`
  ADD PRIMARY KEY (`ne_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `flaggeditems`
--
ALTER TABLE `flaggeditems`
  ADD PRIMARY KEY (`flaggedID`);

--
-- Indexes for table `noplate_template`
--
ALTER TABLE `noplate_template`
  ADD PRIMARY KEY (`noplateTempID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`planID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productbike`
--
ALTER TABLE `productbike`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productboat`
--
ALTER TABLE `productboat`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productcar`
--
ALTER TABLE `productcar`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productiv`
--
ALTER TABLE `productiv`
  ADD PRIMARY KEY (`productIV_ID`);

--
-- Indexes for table `productmn`
--
ALTER TABLE `productmn`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productnp`
--
ALTER TABLE `productnp`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productphone`
--
ALTER TABLE `productphone`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productproperty`
--
ALTER TABLE `productproperty`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productstatus`
--
ALTER TABLE `productstatus`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productvertu`
--
ALTER TABLE `productvertu`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productwatch`
--
ALTER TABLE `productwatch`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `subscriptionplan`
--
ALTER TABLE `subscriptionplan`
  ADD PRIMARY KEY (`subscriptionID`);

--
-- Indexes for table `trader`
--
ALTER TABLE `trader`
  ADD PRIMARY KEY (`traderID`);

--
-- Indexes for table `tradernotifications`
--
ALTER TABLE `tradernotifications`
  ADD PRIMARY KEY (`notificationID`);

--
-- Indexes for table `tradersubscriptionplan`
--
ALTER TABLE `tradersubscriptionplan`
  ADD PRIMARY KEY (`tradersubscriptionID`);

--
-- Indexes for table `trader_add_post`
--
ALTER TABLE `trader_add_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_register`
--
ALTER TABLE `trader_register`
  ADD PRIMARY KEY (`trader_id`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`watchlistID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alshamilbank`
--
ALTER TABLE `alshamilbank`
  MODIFY `alshamilBankID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `alshamillocation`
--
ALTER TABLE `alshamillocation`
  MODIFY `locationID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookeditems`
--
ALTER TABLE `bookeditems`
  MODIFY `bookedID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cartlist`
--
ALTER TABLE `cartlist`
  MODIFY `cartlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `productCategoryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_subtypes`
--
ALTER TABLE `category_subtypes`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9017;

--
-- AUTO_INCREMENT for table `ci_news`
--
ALTER TABLE `ci_news`
  MODIFY `ne_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `flaggeditems`
--
ALTER TABLE `flaggeditems`
  MODIFY `flaggedID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `noplate_template`
--
ALTER TABLE `noplate_template`
  MODIFY `noplateTempID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `orderID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `planID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=862;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `productbike`
--
ALTER TABLE `productbike`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `productboat`
--
ALTER TABLE `productboat`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `productcar`
--
ALTER TABLE `productcar`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT for table `productiv`
--
ALTER TABLE `productiv`
  MODIFY `productIV_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=498;

--
-- AUTO_INCREMENT for table `productmn`
--
ALTER TABLE `productmn`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `productnp`
--
ALTER TABLE `productnp`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `productphone`
--
ALTER TABLE `productphone`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `productproperty`
--
ALTER TABLE `productproperty`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `productstatus`
--
ALTER TABLE `productstatus`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `productvertu`
--
ALTER TABLE `productvertu`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `productwatch`
--
ALTER TABLE `productwatch`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subscriptionplan`
--
ALTER TABLE `subscriptionplan`
  MODIFY `subscriptionID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trader`
--
ALTER TABLE `trader`
  MODIFY `traderID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;

--
-- AUTO_INCREMENT for table `tradernotifications`
--
ALTER TABLE `tradernotifications`
  MODIFY `notificationID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tradersubscriptionplan`
--
ALTER TABLE `tradersubscriptionplan`
  MODIFY `tradersubscriptionID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `trader_add_post`
--
ALTER TABLE `trader_add_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trader_register`
--
ALTER TABLE `trader_register`
  MODIFY `trader_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `watchlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
