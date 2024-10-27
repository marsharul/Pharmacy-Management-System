-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2024 at 05:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ceymedpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Id` int(11) NOT NULL,
  `CategoryName` varchar(100) DEFAULT NULL,
  `StatusId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id`, `CategoryName`, `StatusId`) VALUES
(1, 'Pharmaceuticals', 1),
(2, 'Personal Care', 1),
(3, 'Mother & Baby Care', 1),
(7, 'Devices', 2),
(8, 'Vitamins &amp; Supplements', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `Id` int(11) NOT NULL,
  `CouponNumber` varchar(100) NOT NULL,
  `Discount` varchar(100) NOT NULL,
  `ExpDate` date NOT NULL,
  `StatusId` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`Id`, `CouponNumber`, `Discount`, `ExpDate`, `StatusId`) VALUES
(1, '5050', '0.05', '2024-07-24', 1),
(2, '9090', '0.10', '2024-08-30', 1),
(3, '4040', '0.40', '2024-07-27', 1),
(5, '3030', '0.30', '2024-07-31', 1),
(6, '2020', '0.2', '2024-07-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerId` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `TelNo` varchar(15) NOT NULL,
  `MobileNo` varchar(15) NOT NULL,
  `DistrictId` int(11) NOT NULL,
  `RegNo` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerId`, `Email`, `TelNo`, `MobileNo`, `DistrictId`, `RegNo`, `UserId`) VALUES
(1, 'arularush@gmail.com', '0112356894', '0778956234', 5, 202406023, 3),
(2, 'marsharul1489@gmail.com', '0112356894', '0778956234', 5, 202406044, 4),
(3, 'arularush2@gmail.com', '0112356894', '0704556788', 5, 202406045, 5),
(4, 'arularush3@gmail.com', '0118858252', '0758004887', 11, 202406056, 6),
(5, 'arulsaru@gmail.com', '0113560568', '0758004001', 5, 202406117, 7),
(6, 'arularush3@gmail.com', '0112356897', '0758004001', 12, 202406138, 8),
(7, 'arularush4@gmail.com', '0112356894', '0758004001', 11, 202406139, 9),
(9, 'arularush5@gmail.com', '0112356894', '0778956234', 5, 2024073015, 15),
(10, 'arularush6@gmail.com', '0154578129', '0778956288', 5, 2024073016, 16),
(11, 'arularush7@gmail.com', '0112356894', '0778956234', 5, 2024073017, 17),
(12, 'arularush8@gmail.com', '0112356894', '0778956234', 5, 2024073018, 18),
(13, 'arularush9@gmail.com', '0112356894', '0778956234', 5, 2024073120, 20),
(14, 'arularush10@gmail.com', '0112356894', '0778956234', 5, 2024073121, 21),
(15, 'arularush11@gmail.com', '0112356894', '0778956234', 5, 2024073122, 22),
(16, 'arularush12@gmail.com', '0112360568', '0758004001', 5, 2024073123, 23);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `DesigId` int(11) NOT NULL,
  `Designation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`DesigId`, `Designation`) VALUES
(1, 'pharmacist'),
(2, 'cashier'),
(3, 'store keeper'),
(4, 'admin'),
(5, 'owner'),
(6, 'deliverer');

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `Id` int(11) NOT NULL,
  `DistributorName` varchar(100) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `RegisterDate` date DEFAULT NULL,
  `StatusId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`Id`, `DistributorName`, `Email`, `RegisterDate`, `StatusId`) VALUES
(1, 'abc pharma', 'arularush@gmail.com', '2022-01-01', 1),
(2, 'alaris lanka (pvt) ltd', 'arularush@gmail.com', '2022-01-01', 1),
(3, 'astron ltd', 'arularush@gmail.com', '2022-01-01', 1),
(4, 'baurs & company', 'arularush@gmail.com', '2022-01-01', 1),
(6, 'aventis', 'arularush@gmail.com', '2022-01-02', 2),
(7, 'Hemas', 'arularush@gmail.com', '2024-05-29', 1),
(8, 'Robert Hall', 'arularush@gmail.com', '2024-07-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`Id`, `Name`) VALUES
(1, 'Ampara'),
(2, 'Anuradhapura'),
(3, 'Batticaloa'),
(4, 'Badulla'),
(5, 'Colombo'),
(6, 'Galle'),
(7, 'Gampaha'),
(8, 'Hambantota'),
(9, 'Jaffna'),
(10, 'Kalutara'),
(11, 'Kandy'),
(12, 'Kegalle'),
(13, 'Kilinochchi'),
(14, 'Kurunegala'),
(15, 'Matale'),
(16, 'Mannar'),
(17, 'Matara'),
(18, 'Monaragala'),
(19, 'Mullaitivu'),
(20, 'Nuwara Eliya'),
(21, 'Polonnaruwa'),
(22, 'Puttalam'),
(23, 'Ratnapura'),
(24, 'Trincomalee'),
(25, 'Vavuniya');

-- --------------------------------------------------------

--
-- Table structure for table `dosage_form`
--

CREATE TABLE `dosage_form` (
  `Id` int(11) NOT NULL,
  `Form` varchar(100) NOT NULL,
  `StatusId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosage_form`
--

INSERT INTO `dosage_form` (`Id`, `Form`, `StatusId`) VALUES
(1, 'Tablets', 1),
(2, 'Capsules', 1),
(3, 'Syrup', 1),
(4, 'Gel', 1),
(5, 'Ointment', 2),
(6, 'Drops', 1),
(7, 'Inhaler', 1),
(8, 'Injection', 1),
(9, 'Cream', 1),
(12, 'Gas', 2),
(13, 'Liquid', 1),
(14, 'Devices', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeId` int(11) NOT NULL,
  `NIC` varchar(100) NOT NULL,
  `Contact Number` int(10) NOT NULL,
  `AppointDate` date NOT NULL,
  `ProfileImage` varchar(255) NOT NULL,
  `DesigId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeId`, `NIC`, `Contact Number`, `AppointDate`, `ProfileImage`, `DesigId`, `UserId`) VALUES
(1, '930922594V', 758004001, '2023-06-01', '', 4, 1),
(2, '197456789012', 750404091, '2023-06-01', '669ca963efa2c0.92464404.png', 1, 2),
(3, '198025885212', 708598789, '2010-07-15', '', 5, 11),
(4, '990951298V', 775355391, '2024-07-10', '669ca99c139da9.95056009.png', 2, 12),
(5, '200005978945', 785689234, '2024-07-01', '', 3, 13),
(6, '980922596V', 758004001, '2024-07-10', '', 1, 14),
(8, '200025189612', 754256891, '2024-07-31', '', 6, 24);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Id` int(11) NOT NULL,
  `ItemName` varchar(100) DEFAULT NULL,
  `PackSize` varchar(100) DEFAULT NULL,
  `FormId` int(11) DEFAULT NULL,
  `Strength` int(100) DEFAULT NULL,
  `UnitId` int(11) DEFAULT NULL,
  `ItemIssue` varchar(17) NOT NULL,
  `ReorderLevel` int(11) DEFAULT NULL,
  `StatusId` int(11) DEFAULT NULL,
  `UploadPicture` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `CategoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Id`, `ItemName`, `PackSize`, `FormId`, `Strength`, `UnitId`, `ItemIssue`, `ReorderLevel`, `StatusId`, `UploadPicture`, `Description`, `CategoryId`) VALUES
(30, 'Bone Health Plus Tablets', '30', 1, NULL, 0, 'Prescription', 5, 1, 'item_img_66a8485c3af082.53723180.jpg', '', 5),
(31, 'asthalin', '120md', 7, NULL, 0, '', 5, 2, 'item_img_6633864d9a6cf3.71521150.jpg', '', 1),
(32, 'Refresh Tears', '15ml', 6, NULL, 0, 'Prescription', 5, 1, 'item_img_6634f26051cc59.63854211.jpg', NULL, 1),
(33, 'Foracort', '120md', 7, NULL, 0, 'NonPrescription', 16, 1, 'item_img_668f61a79f9467.60470495.jpg', NULL, 1),
(34, 'Formoflo-transhaler', '200md', 7, NULL, 0, 'NonPrescription', 16, 1, 'item_img_668f61dde80651.36362899.jpg', '', 1),
(36, 'Refresh Liquigel', '15ml', 6, NULL, 0, 'Prescription', 5, 1, 'item_img_66ab0e330e0842.78354762.jpg', NULL, 1),
(43, 'Azopt', '1', 6, 5, 2, 'Prescription', 8, 1, 'item_img_664498e8691a53.81216178.jpg', '', 1),
(50, 'Betatine Cream', '1', 9, 20, 9, 'NonPrescription', 5, 1, 'item_img_66a847e0553457.01124220.jpg', '', 1),
(51, 'Betadine Gargle 100ml', '1', 13, 100, 2, 'Prescription', 10, 1, 'item_img_66ab0dc2a41c03.27178958.jpg', '', 1),
(53, 'Citizen-Thermometer', '1', 14, 0, 0, 'NonPrescription', 5, 1, 'item_img_66a86489c0d6e1.55367882.jpg', '<ul><li>Digital Thermometer</li><li>Citizen Brand</li><li>100% Original</li></ul>', 7),
(54, 'Beloved-Infrared_thermo', '1', 14, 0, 0, 'NonPrescription', 10, 1, 'item_img_66a891e42ce132.66926786.jpg', '<ul><li>Infrared Thermometer</li><li>100% Original&nbsp;</li><li>Warranty Available</li></ul>', 7),
(55, 'Baby Cheramy Cologne', '1', 13, 100, 2, 'NonPrescription', 15, 1, 'item_img_66a8448b437fd3.06451555.jpeg', '', 3),
(56, 'Seven Seas Cod Liver Oil A, D &amp;E', '120', 2, 0, 0, 'NonPrescription', 5, 1, 'item_img_66a845b4a3a384.83345530.jpg', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `Id` int(11) NOT NULL,
  `LocationName` varchar(100) NOT NULL,
  `Area` varchar(100) NOT NULL,
  `Capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`Id`, `LocationName`, `Area`, `Capacity`) VALUES
(1, 'Shelf-A1', 'Front', 55),
(2, 'Shelf-A2', 'Front', 60),
(3, 'Shelf-B1', 'Back', 80),
(4, 'Shelf-A4', 'Front', 100);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Path` varchar(100) NOT NULL,
  `File` varchar(100) NOT NULL,
  `Icon` varchar(100) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`Id`, `Name`, `Path`, `File`, `Icon`, `Status`) VALUES
(1, 'User Management', 'users', 'manage', 'fas fa-user-tie', 1),
(2, 'Location Management', 'locations', 'manage', 'far fa-compass', 1),
(3, 'Distributor Management', 'distributer', 'manage', 'fas fa-truck-loading', 1),
(4, 'Order Management', 'orders', 'manage', 'fas fa-shopping-cart', 1),
(5, 'Inventory Management', 'inventory', 'manage', 'fas fa-warehouse', 1),
(6, 'Items Management', 'items', 'manage', 'fas fa-gift', 1),
(7, 'Dosage Form', 'dosage_form', 'manage', 'fas fa-pills', 1),
(9, 'Category', 'category', 'manage', 'fas fa-sitemap', 1),
(10, 'E PRESCRIPTION', 'e_prescription', 'manage', 'fas fa-prescription', 1),
(11, 'Coupon', 'coupon', 'manage', 'fas fa-percent', 1),
(12, 'Invoice', 'invoice', 'manage', 'fas fa-file-invoice-dollar', 1),
(13, 'Reports', 'report', 'manage', 'far fa-file-pdf', 1),
(14, 'Delivery Management', 'delivery', 'manage', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `OrderDate` date DEFAULT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `BillingName` varchar(255) DEFAULT NULL,
  `BillingAddress` text DEFAULT NULL,
  `BillingEmail` varchar(255) DEFAULT NULL,
  `BillingPhone` varchar(255) DEFAULT NULL,
  `Payments` varchar(4) NOT NULL,
  `DeliveryMethod` varchar(8) NOT NULL,
  `DeliveryName` varchar(255) DEFAULT NULL,
  `DeliveryAddress` text DEFAULT NULL,
  `DeliveryPhone` varchar(255) DEFAULT NULL,
  `OrderNotes` text DEFAULT NULL,
  `OrderNumber` varchar(15) DEFAULT NULL,
  `StatusId` int(11) NOT NULL DEFAULT 1,
  `NewOrderFlag` int(1) DEFAULT 1,
  `CouponDiscount` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `OrderDate`, `CustomerId`, `BillingName`, `BillingAddress`, `BillingEmail`, `BillingPhone`, `Payments`, `DeliveryMethod`, `DeliveryName`, `DeliveryAddress`, `DeliveryPhone`, `OrderNotes`, `OrderNumber`, `StatusId`, `NewOrderFlag`, `CouponDiscount`) VALUES
(2, '2023-06-02', 1, 'Arushan', '59,W.A Silva Mw,Colombo-06', 'arularush@gmail.com', '0112360568', 'COD', 'PickUp', 'Arushan', '59,W.A Silva Mw,Colombo-06', '0112360568', '', '20240602621', 3, 0, '0'),
(3, '2023-07-04', 1, 'Arushan', '59,W.A Silva Mw,Colombo-06', 'arularush@gmail.com', '0112596387', 'Bank', 'Delivery', 'Kevin', '88,Hill Street,Dehiwala', '0112596387', 'Deliver with care', '20240604761', 4, 0, '0'),
(4, '2023-07-06', 3, 'Marsharul', '12B, Hampden Lane', 'marsharul1489@gmail.com', '0758004001', 'Bank', 'Delivery', 'Marsharul', '12B, Hampden Lane', '0758004001', 'pack neatly', '20240606803', 4, 0, '0'),
(5, '2023-08-06', 3, 'Marsharul', '12B, Hampden Lane', 'marsharul1489@gmail.com', '0758004001', 'COD', 'PickUp', 'Anosh', '43,Castle Lane,Colombo-05', '0112460468', '', '20240606123', 3, 0, '0'),
(6, '2023-08-26', 3, 'Marsharul', '12B, Hampden Lane', 'marsharul1489@gmail.com', '0758004001', 'COD', 'PickUp', 'Wijesinghe', '56,Galle Road, Colombo-04', '0724204001', '', '2024060683', 3, 0, '0'),
(7, '2023-08-29', 3, 'Saru', '24,Daya Road,Colombo-06', 'arulsaru@gmail.com', '0758004001', 'COD', 'PickUp', 'Saru', '16,Pamankade,Colombo-06', '0758004001', '', '20240606563', 3, 0, '0'),
(8, '2023-09-01', 3, 'Arushan', 'testing Address', 'marsharul1489@gmail.com', '0758004001', 'COD', 'PickUp', 'testing', 'testing Address', '0758004001', '', '20240606353', 3, 0, '0'),
(9, '2023-10-07', 3, 'testname', 'test2', 'test@gmail.com', '0112360568', 'COD', 'PickUp', 'testname', 'test2', '0112360568', '', '20240607273', 3, 0, '0'),
(10, '2023-10-15', 3, 'testname2', 'test', 'marsharul1489@gmail.com', '0112360568', 'COD', 'Delivery', 'testname2', 'test', '0112360568', '', '20240607823', 4, 0, '0'),
(11, '2023-10-17', 3, 'Arushan A', '59, 3/5', 'arularush@gmail.com', '0112360568', 'COD', 'Delivery', 'Arushan A', '59, 3/5', '0112360568', '', '20240607943', 4, 0, '0'),
(12, '2023-11-03', 3, 'Marsh', '53, Galle Road, Colombo-04', 'marsh@gmail.com', '0758004001', 'COD', 'Delivery', 'Marsh', '53, Galle Road, Colombo-04', '0758004001', 'deliver on time', '20240607203', 4, 0, '0'),
(13, '2023-12-13', 3, 'Philip Gunawarderna', '61, High street, Wellawatte', 'philipguna@gmail.com', '0714604001', 'Bank', 'Delivery', 'Arulanandan Arushan', '61, High street, Wellawatte', '0758004001', '', '20240613463', 4, 0, '0'),
(14, '2023-12-18', 3, 'Philip Gunawarderna', '61, High street, Wellawatte', 'philipguna@gmail.com', '0714604001', 'Bank', 'Delivery', 'Arushan Arulanandan', '59', '0758004001', '', '20240613543', 4, 0, '0'),
(15, '2023-12-26', 1, 'raj mohan', '48, main street, colombo-06', 'rajmohan45@gmail.com', '0758004001', 'COD', 'PickUp', 'raj mohan', '48, main street, colombo-06', '0758004001', 'urgent delivery', '20240709121', 3, 0, '0'),
(16, '2024-01-29', 1, '', '5454', 'marsharul1489@gmail.com', '0112596387', 'COD', 'PickUp', 'marsh56', '5454', '0112596387', '', '20240709971', 2, 0, '0'),
(17, '2024-02-09', 1, 'Saruha Siva', '24,Daya Road, colombo-06', 'saru@gmail.com', '0112596387', 'Bank', 'PickUp', 'marsh65', '65', '0112596387', '', '20240709671', 2, 0, '0'),
(18, '2024-03-15', 1, 'Saruha Siva', '24,Daya Road, colombo-06', 'saru@gmail.com', '0112596387', 'COD', 'Delivery', 'marsh66', '66', '0112596387', '', '20240709731', 4, 0, '0'),
(19, '2024-04-01', 1, 'Saruha Siva', '24,Daya Road, colombo-06', 'arularush@gmail.com', '0112596387', 'COD', 'Delivery', 'Saruha Siva', '24,Daya Road, colombo-06', '0112596387', 'Please Deliver After 6 P.M', '20240713561', 4, 0, '0'),
(20, '2024-04-17', 1, 'marsh', 'hdfjdhfj', 'arularush@gmail.com', '0112596387', 'COD', 'Delivery', 'marsh', 'hdfjdhfj', '0112596387', '', '20240717491', 5, 0, '0'),
(21, '2024-05-12', 1, 'arul', '550,hill street', 'arularush@gmail.com', '0758004001', 'Bank', 'PickUp', 'arul', '550,hill street', '0758004001', '', '20240717721', 5, 0, '0'),
(22, '2024-07-17', 1, 'kamal', '45', 'arularush@gmail.com', '0758004001', 'COD', 'PickUp', 'kamal', '45', '0758004001', '', '20240717491', 5, 0, '0'),
(23, '2024-07-19', 2, 'Saruha Siva', '24, Daya Road, wellawatte', 'arularush@gmail.com', '0112596387', 'Bank', 'Delivery', 'Saruha', '24 8/5, Daya Road, Colombo 06', '0112596387', '', '20240719982', 2, 0, '0'),
(24, '2024-07-20', 2, 'Siva', '24 8/5, Daya Road, Colombo 06', 'u.sivashangar@gmail.com', '0775278988', 'COD', 'Delivery', 'Saruha', '24 8/5, Daya Road, Colombo 06', '0775278988', '', '20240720622', 1, 0, '0'),
(25, '2024-07-27', 1, 'arush', '59, W.A Silva Mw,colombo-06', 'arularush@gmail.com', '0758004001', 'COD', 'Delivery', 'arush', '59, W.A Silva Mw,colombo-06', '0758004001', '', '202407271001', 4, 0, '0'),
(26, '2024-07-27', 1, 'marsh', 'dhfhdh', 'marsharul1489@gmail.com', '0112596387', 'COD', 'PickUp', 'marsh', 'dhfhdh', '0112596387', '', '20240727301', 1, 0, '0'),
(27, '2024-07-27', 1, 'marsh arul', 'nsdsmnsm', 'arularush@gmail.com', '0758004001', 'Bank', 'Delivery', 'marsh arul', 'nsdsmnsm', '0758004001', '', '20240727161', 4, 0, '0'),
(28, '2024-07-27', 1, 'Arushan', 'shdsjhd', 'arularush@gmail.com', '0112596387', 'COD', 'PickUp', 'Arushan', 'shdsjhd', '0112596387', '', '20240727351', 4, 0, '0'),
(29, '2024-07-30', 12, 'Tommy', '59,5/3, W.A Silva Mw, Colombo-06', 'arularush@gmail.com', '0758004001', 'COD', 'Delivery', 'Tommy', '59,5/3, W.A Silva Mw, Colombo-06', '0758004001', 'jdhfjdhjdfh', '202407302912', 4, 0, '0'),
(30, '2024-07-30', 1, 'Arush', '85', 'arularush@gmail.com', '0758004001', 'Bank', 'PickUp', 'Arush', '85', '0758004001', '', '20240730631', 1, 0, '0'),
(31, '2024-08-01', 1, 'Tommy', '85, Down Street, Colombo-06', 'arularush@gmail.com', '0758004001', 'COD', 'Delivery', 'Tommy', '85, Down Street, Colombo-06', '0758004001', '', '20240801441', 1, 0, '0'),
(32, '2024-08-01', 1, 'dummy', '56', 'arularush@gmail.com', '0758004001', 'COD', 'PickUp', 'dummy', '56', '0758004001', '', '20240801491', 1, 0, '0'),
(33, '2024-08-01', 1, 'tom', 'dmfd', 'arularush@gmail.com', '0758004001', 'COD', 'PickUp', 'tom', 'dmfd', '0758004001', '', '20240801951', 3, 0, '0.10'),
(34, '2024-08-02', 1, 'Tommy', '59,3/5,W.A.Silva MW', 'arularush@gmail.com', '0758004001', 'COD', 'Delivery', 'Tommy', '59,3/5,W.A.Silva MW', '0758004001', '', '20240802711', 5, 0, '0.10'),
(35, '2024-08-02', 1, 'Arushan', '59,3/5,W.A.Silva Mw,col-06', 'arularush@gmail.com', '0758004001', 'COD', 'PickUp', 'Arushan', '59,3/5,W.A.Silva Mw,col-06', '0758004001', '', '20240802251', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `Id` int(11) NOT NULL,
  `OrderId` int(11) DEFAULT NULL,
  `StockId` int(11) DEFAULT NULL,
  `ItemId` int(11) DEFAULT NULL,
  `RetailPrice` decimal(10,2) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`Id`, `OrderId`, `StockId`, `ItemId`, `RetailPrice`, `Qty`) VALUES
(2, 2, 1, 30, 1800.00, 1),
(3, 2, 2, 32, 1000.00, 1),
(4, 2, 4, 34, 2000.00, 1),
(5, 3, 1, 30, 1800.00, 2),
(6, 3, 2, 32, 1000.00, 2),
(7, 3, 4, 34, 2000.00, 2),
(8, 4, 4, 34, 2000.00, 1),
(9, 4, 1, 30, 1800.00, 1),
(10, 4, 2, 32, 1000.00, 1),
(11, 5, 4, 34, 2000.00, 1),
(12, 5, 1, 30, 1800.00, 5),
(13, 5, 2, 32, 1000.00, 1),
(14, 6, 4, 34, 2000.00, 1),
(15, 6, 1, 30, 1800.00, 5),
(16, 6, 2, 32, 1000.00, 1),
(17, 7, 4, 34, 2000.00, 1),
(18, 7, 1, 30, 1800.00, 5),
(19, 7, 2, 32, 1000.00, 20),
(20, 8, 4, 34, 2000.00, 1),
(21, 8, 1, 30, 1800.00, 5),
(22, 9, 4, 34, 2000.00, 1),
(23, 9, 1, 30, 1800.00, 5),
(24, 10, 4, 34, 2000.00, 1),
(25, 10, 1, 30, 1800.00, 5),
(26, 11, 1, 30, 1800.00, 1),
(27, 12, 2, 32, 1000.00, 1),
(28, 12, 6, 32, 1800.00, 1),
(29, 13, 1, 30, 1800.00, 1),
(30, 13, 5, 33, 2034.00, 1),
(31, 14, 1, 30, 1800.00, 5),
(32, 15, 2, 32, 1000.00, 1),
(33, 15, 4, 34, 2000.00, 1),
(34, 16, 2, 32, 1000.00, 1),
(35, 16, 4, 34, 2000.00, 1),
(36, 17, 2, 32, 1000.00, 1),
(37, 18, 4, 34, 2000.00, 1),
(38, 19, 4, 34, 2000.00, 1),
(39, 20, 4, 34, 2000.00, 5),
(40, 21, 4, 34, 2000.00, 1),
(41, 22, 4, 34, 2000.00, 2),
(42, 23, 4, 34, 2000.00, 1),
(43, 24, 4, 34, 2000.00, 1),
(44, 25, 4, 34, 2000.00, 1),
(45, 25, 8, 50, 1060.00, 1),
(46, 27, 4, 34, 2000.00, 1),
(47, 28, 8, 50, 1060.00, 1),
(48, 29, 4, 34, 2000.00, 1),
(49, 29, 10, 53, 1800.00, 5),
(50, 30, 4, 34, 2000.00, 1),
(51, 30, 8, 50, 1060.00, 1),
(52, 30, 11, 56, 3862.80, 1),
(53, 31, 8, 50, 1060.00, 1),
(54, 31, 4, 34, 2000.00, 1),
(55, 32, 8, 50, 1060.00, 1),
(56, 33, 8, 50, 1060.00, 1),
(57, 33, 4, 34, 2000.00, 1),
(58, 34, 8, 50, 1060.00, 1),
(59, 35, 8, 50, 1060.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_items_issue`
--

CREATE TABLE `order_items_issue` (
  `Id` int(11) NOT NULL,
  `OrderId` int(11) DEFAULT NULL,
  `ItemId` int(11) DEFAULT NULL,
  `StockId` int(11) DEFAULT NULL,
  `RetailPrice` decimal(10,2) DEFAULT NULL,
  `IssuedQty` int(11) DEFAULT NULL,
  `IssueDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items_issue`
--

INSERT INTO `order_items_issue` (`Id`, `OrderId`, `ItemId`, `StockId`, `RetailPrice`, `IssuedQty`, `IssueDate`) VALUES
(1, 10, 34, 4, 2000.00, 5, '2024-06-07'),
(2, 10, 30, 1, 1800.00, 5, '2024-06-07'),
(3, 14, 30, 1, 1800.00, 2, '2024-06-13'),
(4, 14, 30, 1, 1800.00, 3, '2024-06-13'),
(5, 14, 30, 1, 1800.00, 2, '2024-06-13'),
(6, 14, 30, 1, 1800.00, 2, '2024-06-13'),
(7, 13, 30, 1, 1800.00, 26, '2024-06-14'),
(8, 13, 33, 5, 2034.00, 55, '2024-06-14'),
(9, 19, 34, 4, 2000.00, 1, '2024-07-13'),
(10, 19, 34, 4, 2000.00, 1, '2024-07-15'),
(11, 19, 34, 4, 2000.00, 1, '2024-07-15'),
(12, 19, 34, 4, 2000.00, 1, '2024-07-15'),
(13, 19, 34, 4, 2000.00, 1, '2024-07-15'),
(14, 19, 34, 4, 2000.00, 1, '2024-07-15'),
(15, 19, 34, 4, 2000.00, 1, '2024-07-15'),
(16, 19, 34, 4, 2000.00, 1, '2024-07-15'),
(17, 19, 34, 4, 2000.00, 1, '2024-07-15'),
(18, 19, 34, 4, 2000.00, 1, '2024-07-15'),
(19, 17, 32, 2, 1000.00, 1, '2024-07-15'),
(20, 19, 34, 4, 2000.00, 1, '2024-07-16'),
(21, 16, 32, 2, 1000.00, 1, '2024-07-16'),
(22, 16, 34, 4, 2000.00, 1, '2024-07-16'),
(23, 15, 32, 2, 1000.00, 1, '2024-07-16'),
(24, 15, 34, 4, 2000.00, 1, '2024-07-16'),
(25, 27, 34, 4, 2000.00, 1, '2024-07-27'),
(26, 28, 50, 8, 1060.00, 1, '2024-07-27'),
(27, 29, 34, 4, 2000.00, 1, '2024-07-30'),
(28, 29, 53, 10, 1800.00, 5, '2024-07-30'),
(29, 25, 34, 4, 2000.00, 1, '2024-07-30'),
(30, 25, 50, 8, 1060.00, 1, '2024-07-30'),
(31, 33, 50, 8, 1060.00, 1, '2024-08-02'),
(32, 33, 34, 4, 2000.00, 1, '2024-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `Id` int(11) NOT NULL,
  `StatusName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`Id`, `StatusName`) VALUES
(1, 'Pending'),
(2, 'Issued'),
(3, 'Invoiced'),
(4, 'Delivered'),
(5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `Id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Token` varchar(100) NOT NULL,
  `Expiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`Id`, `Email`, `Token`, `Expiry`) VALUES
(1, 'arularush@gmail.com', '1d43d2e33cccc27cb8c945d37096bddfdaef490ae9331a06a3310cd769efae3a759793278e6a8a24f538a383ea26cd2f814c', '2024-07-30 17:07:43'),
(2, 'arularush@gmail.com', '79fed666082a83d46e81af1eaa66f4a7b1157e0e9a5363ca76549f98a6c086dfaed42f608ad143f1c264c99d5f57ba3a4146', '2024-07-30 17:09:33'),
(3, 'arularush@gmail.com', 'e0bcea001cf23eb92a0afa80e639a05481c0340069446b8e7b7b43a3109823347a3d4b37a85899332f00953ae41033f6bfee', '2024-07-30 17:10:48'),
(4, 'arularush@gmail.com', 'edc11bf86a9586f6d74fa8994ed8bed35e53a37765e748b064a582f678304540db308efc677450e602d339c07fa9a60cf098', '2024-07-31 00:04:27'),
(5, 'arularush@gmail.com', 'bd96de561769b53cc0244bc9953cc28955cb99a695461a3d48cdb480aa4bb0e3541f09d97f716b96e59bb91530062a713973', '2024-07-31 01:20:13'),
(6, 'arularush@gmail.com', '0e3df348688b01d45c503883530901f1f6322b30347d29e97d2faf290168fb916df2c7515f4c7192858836acb5e98dc05fbb', '2024-07-31 02:37:20'),
(7, 'arularush@gmail.com', '04300bf4d173c6a2bca35ffcf1707fb91475c28a789255780edcda2bfd08c5d5c359485184e421fb06d73bd4919a44c3167b', '2024-07-31 03:02:09'),
(8, 'arularush@gmail.com', 'dd9136987cd04cebc2e1840a26d39696c48fe24c9b50aa5e1b21135b1ef0ddf95f336ba9125b9d115cd528f0c0002362ba2d', '2024-07-31 03:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `Id` int(11) NOT NULL,
  `PatientName` varchar(255) NOT NULL,
  `PatientAge` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `ContactNo` varchar(15) NOT NULL,
  `Comments` text NOT NULL,
  `StatusId` int(11) NOT NULL DEFAULT 1,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `CustomerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`Id`, `PatientName`, `PatientAge`, `Email`, `ContactNo`, `Comments`, `StatusId`, `uploaded_at`, `CustomerId`) VALUES
(1, 'Arushan', 25, 'arularush@gmail.com', '0758004001', 'need only the first medicine', 1, '2023-06-09 12:23:53', 3),
(2, 'arush', 20, 'arush@gmail.com', '0758004582', '', 3, '2024-06-09 17:11:26', 1),
(3, 'Arushan', 25, 'arularush@gmail.com', '0758004001', 'Issue medicine as per in prescription', 1, '2024-06-09 17:14:46', 3),
(4, 'Arushan', 25, 'arularush@gmail.com', '0758004001', 'last medicine for a week', 1, '2024-06-10 04:21:03', 3),
(5, 'Kenny', 24, 'kenny@gmail.com', '0768504501', 'first medicine for 5 days,second medicine for   3 weeks', 3, '2024-06-10 04:32:34', 1),
(6, 'saruha', 25, 'saru@gmail.com', '0775355391', '', 5, '2024-06-10 16:26:36', 3),
(7, 'Arulanandan', 62, 'arul@gmail.com', '0755081087', 'only need the first medicine for  1 week', 4, '2024-07-13 13:26:28', 1),
(8, 'Arulanandan', 62, 'arularush@gmail.com', '0755081088', '', 5, '2024-07-23 14:43:47', 1),
(9, 'arush', 11, 'arularush@gmail.com', '0758004001', '', 1, '2024-07-27 09:36:05', 1),
(10, 'Tom David', 34, 'arularush@gmail.com', '0758004001', 'hfdgfdhdhf', 4, '2024-07-29 02:14:58', 1),
(11, 'tom jack', 22, 'arularush@gmail.com', '0758004001', '', 1, '2024-07-29 02:27:57', 1),
(12, 'Huge jackman', 55, 'arularush@gmail.com', '0758004001', '', 1, '2024-07-29 05:02:09', 1),
(13, 'Tim cook', 62, 'arularush@gmail.com', '0758004001', '', 1, '2024-07-29 05:03:55', 1),
(14, 'Tim cook', 62, 'arularush@gmail.com', '0758004001', '', 1, '2024-07-29 05:12:54', 1),
(15, 'Tom David', 45, 'arularush@gmail.com', '0758004001', 'Tom David&#039;s Prescription', 1, '2024-07-30 00:12:21', 9),
(16, 'Tom David', 25, 'arularush@gmail.com', '0758004001', '', 5, '2024-07-30 12:25:01', 12),
(17, 'Tom David', 25, 'arularush@gmail.com', '0758004001', '', 4, '2024-08-02 13:51:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_status`
--

CREATE TABLE `prescription_status` (
  `Id` int(11) NOT NULL,
  `StatusName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_status`
--

INSERT INTO `prescription_status` (`Id`, `StatusName`) VALUES
(1, 'Pending'),
(2, 'Processed'),
(3, 'e-mail sent'),
(4, 'Approved'),
(5, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_upload`
--

CREATE TABLE `prescription_upload` (
  `Id` int(11) NOT NULL,
  `PrescriptionId` int(11) NOT NULL,
  `UploadFile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_upload`
--

INSERT INTO `prescription_upload` (`Id`, `PrescriptionId`, `UploadFile`) VALUES
(1, 1, '66659ed9438cf2.79071817.jpg'),
(2, 2, '6665e23e74a916.50158681.jpg'),
(3, 5, '666681e2ca26e3.60387853.jpg'),
(4, 6, '6667293c2f1d33.81642588.jpg'),
(5, 7, '669280841808f4.64192301.jpg'),
(6, 8, '669fc1a341d560.01493992.jpg'),
(7, 8, '669fc1a342c532.22861929.jpg'),
(8, 9, '66a4bf85bb0778.67619634.jpg'),
(9, 10, '66a6fb224d18c6.27091878.jpg'),
(10, 10, '66a6fb224de381.40730710.jpg'),
(11, 11, '66a6fe2d029bc2.92970958.jpg'),
(12, 12, '66a7225122a001.99449231.jpg'),
(13, 15, '66a82fe5b04028.23264929.jpg'),
(14, 16, '66a8db9d1e3466.96679617.jpg'),
(15, 17, '66ace4458e2f21.20407662.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `price_request`
--

CREATE TABLE `price_request` (
  `Id` int(11) NOT NULL,
  `DistributorId` int(11) NOT NULL,
  `DeliverDate` date NOT NULL,
  `RequestDate` date NOT NULL,
  `FinalUpdateDate` date NOT NULL,
  `Token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price_request`
--

INSERT INTO `price_request` (`Id`, `DistributorId`, `DeliverDate`, `RequestDate`, `FinalUpdateDate`, `Token`) VALUES
(1, 1, '2024-08-26', '2024-08-09', '2024-08-11', '62b6f26a97b7519eef56282f0e188144'),
(2, 7, '2024-08-31', '2024-08-06', '2024-08-08', 'b333a811c80b8eb8bac8f610af2a6dcc'),
(3, 3, '2024-08-10', '2024-08-01', '2024-08-03', '228c0c33e17154bf25497fcd6c668cda'),
(4, 4, '2024-08-31', '2024-08-11', '2024-08-03', '5e84fda64c577f7263b2d68f4da860e0'),
(5, 4, '2024-08-11', '2024-08-04', '2024-08-06', 'be869c63adfe3273d7b7b6fc114b11cc'),
(6, 3, '2024-08-12', '2024-08-03', '2024-08-05', '4bc2bb5eb502ef34a022560964163e99');

-- --------------------------------------------------------

--
-- Table structure for table `price_request_item`
--

CREATE TABLE `price_request_item` (
  `Id` int(11) NOT NULL,
  `PriceRequestId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `UnitPrice` decimal(10,2) DEFAULT NULL,
  `UpdatedDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price_request_item`
--

INSERT INTO `price_request_item` (`Id`, `PriceRequestId`, `ItemId`, `Qty`, `UnitPrice`, `UpdatedDate`) VALUES
(1, 1, 43, 5, NULL, NULL),
(2, 2, 53, 5, 0.00, NULL),
(3, 2, 55, 6, 0.00, NULL),
(4, 3, 51, 5, 250.00, NULL),
(5, 4, 56, 12, 4600.00, '2024-08-01 18:30:00'),
(6, 4, 55, 45, 2500.00, '2024-08-01 18:30:00'),
(7, 5, 32, 18, 2200.00, '2024-08-01 18:30:00'),
(8, 5, 51, 7, 3500.00, '2024-08-01 18:30:00'),
(9, 6, 30, 25, 400.00, '2024-08-01 18:30:00'),
(10, 6, 51, 5, 800.00, '2024-08-01 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `Id` int(11) NOT NULL,
  `PrescriptionId` int(11) NOT NULL,
  `TotalPrice` varchar(100) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`Id`, `PrescriptionId`, `TotalPrice`, `CreatedAt`) VALUES
(1, 1, NULL, '2024-06-09 14:49:29'),
(2, 2, NULL, '2024-06-09 17:11:51'),
(3, 0, NULL, '2024-06-09 17:21:49'),
(4, 5, NULL, '2024-06-10 04:34:47'),
(5, 6, NULL, '2024-06-10 16:28:25'),
(6, 7, NULL, '2024-07-13 13:28:08'),
(7, 8, NULL, '2024-07-28 04:49:44'),
(8, 10, NULL, '2024-07-29 02:22:38'),
(9, 16, NULL, '2024-07-30 12:26:19'),
(10, 17, NULL, '2024-08-02 14:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_items`
--

CREATE TABLE `quotation_items` (
  `Id` int(11) NOT NULL,
  `QuotationId` int(11) NOT NULL,
  `StockId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `RetailPrice` varchar(100) NOT NULL,
  `Qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation_items`
--

INSERT INTO `quotation_items` (`Id`, `QuotationId`, `StockId`, `ItemId`, `RetailPrice`, `Qty`) VALUES
(9, 3, 0, 34, '225', 5),
(10, 2, 0, 32, '300', 5),
(11, 2, 0, 34, '200', 5),
(13, 5, 0, 43, '2500', 25),
(14, 6, 0, 33, '2000', 2),
(15, 6, 0, 36, '1400', 1),
(16, 1, 0, 32, '1200', 2),
(17, 1, 0, 45, '120', 10),
(29, 4, 0, 30, '200', 22),
(30, 7, 0, 30, '20', 5),
(31, 7, 0, 43, '1200', 2),
(32, 8, 0, 50, '1060', 1),
(33, 8, 0, 32, '1000', 1),
(34, 9, 0, 34, '800', 2),
(35, 9, 0, 43, '1200', 1),
(36, 10, 0, 50, '1200', 5),
(37, 10, 0, 51, '1300', 5);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `Id` int(11) NOT NULL,
  `StatusName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`Id`, `StatusName`) VALUES
(1, 'Active'),
(2, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `Id` int(11) NOT NULL,
  `ItemId` int(11) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL,
  `RetailPrice` decimal(10,2) DEFAULT NULL,
  `CostPrice` decimal(10,2) DEFAULT NULL,
  `PurchaseDate` date DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `LocationId` int(11) NOT NULL,
  `DistributorId` int(11) DEFAULT NULL,
  `IssuedQty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`Id`, `ItemId`, `Qty`, `RetailPrice`, `CostPrice`, `PurchaseDate`, `ExpiryDate`, `LocationId`, `DistributorId`, `IssuedQty`) VALUES
(1, 30, 40, 1800.00, 1400.00, '2024-05-01', '2024-11-01', 1, 1, 40),
(2, 32, 14, 1000.00, 620.00, '2024-02-01', '2026-07-19', 2, 1, 3),
(4, 34, 78, 2000.00, 1666.86, '2024-05-29', '2026-09-29', 1, 3, 22),
(5, 33, 55, 2034.00, 1500.00, '2024-06-07', '2025-05-07', 1, 2, 55),
(6, 32, 20, 1800.00, 1650.00, '2024-06-07', '2026-01-07', 2, 4, 0),
(7, 32, 14, 1000.00, 620.00, '2024-03-01', '2024-07-07', 2, 2, 0),
(8, 50, 30, 1060.00, 954.00, '2024-07-01', '2026-11-18', 3, 8, 3),
(9, 51, 25, 1410.00, 1100.00, '2024-07-01', '2025-01-30', 3, 8, 0),
(10, 53, 14, 1800.00, 1300.00, '2024-07-08', '2027-06-30', 4, 4, 5),
(11, 56, 18, 3862.80, 3500.00, '2024-07-12', '2026-07-30', 1, 3, 0),
(12, 55, 25, 540.00, 480.00, '2024-07-01', '2025-05-30', 2, 7, 0),
(13, 54, 8, 8000.00, 7200.00, '2024-01-12', '2030-01-30', 4, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_modules`
--

CREATE TABLE `sub_modules` (
  `Id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Path` varchar(100) NOT NULL,
  `File` varchar(100) NOT NULL,
  `Icon` varchar(100) NOT NULL,
  `Idx` int(11) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `Id` int(11) NOT NULL,
  `TitleName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`Id`, `TitleName`) VALUES
(1, 'Mr'),
(2, 'Mrs'),
(3, 'Miss'),
(4, 'Ms'),
(5, 'Dr');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `Id` int(11) NOT NULL,
  `UnitName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`Id`, `UnitName`) VALUES
(1, 'mg'),
(2, 'ml'),
(3, 'liter'),
(4, 'cubic meter'),
(5, 'mcg'),
(6, 'meter'),
(7, 'meter squre'),
(8, 'grams'),
(9, ''),
(10, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `TitleId` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Gender` varchar(6) NOT NULL,
  `AddressLine1` varchar(255) NOT NULL,
  `AddressLine2` varchar(255) NOT NULL,
  `AddressLine3` varchar(255) NOT NULL,
  `UserType` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `reset_expiration` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Is_VerifyMail` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `UserName`, `Password`, `TitleId`, `FirstName`, `LastName`, `Gender`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `UserType`, `Status`, `Token`, `reset_expiration`, `Is_VerifyMail`) VALUES
(1, 'john', '$2y$10$gi5OV0oaOB0OJkihEx8/4OOsxmLSqDivDgq6NnZ5kNhifhuFOOJui', 1, 'John', 'Doe', 'male', '88', 'Main Street', 'Mt Lavinia', 'employee', 1, 'null', '2024-07-31 07:52:42', 1),
(2, 'Admin', '$2y$10$.G0ISZaEutfOrD8oyojfNeWFKZC.6H0GxeEDvEsCGA28qLUYyb0tm', 1, 'kumara', 'welgama', 'male', '59,3/5', 'W.A Silva Mw', 'Colombo-06', 'employee', 1, 'null', '2024-07-31 07:52:42', 1),
(3, 'Arush', '$2y$10$xuHu49gijk6ujj71rB9Sw.aDDPc7mgMbQGuWOHpgUzw87iNBepUKC', 1, 'Arush', 'Arul', 'male', '71', 'Main Street', 'Colombo-06', 'customer', 1, NULL, NULL, 1),
(4, 'Saru', '$2y$10$wG11mH0ehQUUJchGfNtQROmn4Ek9MoDZJA0AxN1MGL56BOdaG0zJS', 2, 'Saru', 'Arul', 'female', '59', 'W.A. Silva Mw, Wellawatte', 'Colombo-06', 'customer', 1, 'null', '2024-07-31 07:52:42', 1),
(5, 'Arushan', '$2y$10$Ph8EsAU6.tBRANEOQYGKiuZQ9mrxUAfePDkN..JnVzn8ijvDFmUJe', 1, 'Arushan', 'Arulanandan', 'male', '45', 'High Street', 'Colombo-06', 'customer', 1, 'null', '2024-07-31 07:52:42', 1),
(6, 'Marsh', '$2y$10$9klPF2pd5KXXjzHtWDYGU.7wjLfvuku4ZEEU0.cqn9LvgZBcVqlLG', 1, 'Marsh', 'Arul', 'male', '88', 'Jampettah Street', 'Colombo-11', 'customer', 1, 'c3ad9b8aa775798ccab8069fedeeed4d', '2024-07-31 07:52:42', 0),
(7, 'Saruha', '$2y$10$3AMF57mihdUYXkGY.buV2ezRZgyc6wSv3aUCv75bFgWNbAQYjAv9C', 2, 'Saruha', 'Sivashangar', 'female', '24', 'Daya Road,Hampden Lane', 'Colombo-06', 'customer', 1, '68b9efe9eceb0cb5ff044a283fbda002', '2024-07-31 07:52:42', 0),
(8, 'Samaraweera', '$2y$10$cok/J7pMQKFa7Lvfhs1fLOB6XJuI1yXiovUOl4mL3mcqjG3C7HW2i', 1, 'Dinesh', 'Samaraweera', 'male', '60', 'Hampden Lane', 'Colombo-06', 'customer', 1, 'd773c07cf329848dca2851014e7d69bc', '2024-07-31 07:52:42', 0),
(9, 'Kamal', '$2y$10$xLdZ7UZHH7sCG57IoyvkIeY6xjv8/Ukg6hdWzj3IVY4oDK.2rVnW6', 1, 'Kamal', 'Perera', 'male', '59', 'Castle Street', 'Colombo-05', 'customer', 1, 'null', '2024-07-31 07:52:42', 1),
(11, 'Owner', '$2y$10$HWrvesYNT8RzeH5Qu8y0ou35bbh.7FjH3yAPgbrltF2MG2.5CkhRi', 1, 'Thirukumaran', 'Selvakumar', 'male', '78', 'Darmapala Mawatha', 'Dehiwala', 'employee', 1, '', '2024-07-31 07:52:42', 0),
(12, 'Cashier', '$2y$10$DC.0V.qtlcvr96yMloHm9uE8gedOuk8EThS5vHq54Prf52sgk5qF6', 3, 'Irumi', 'Rajamanthiri', 'female', '50,3/8', 'Harmus Avenue', 'Colombo-09', 'employee', 1, NULL, '2024-07-31 08:54:08', 0),
(13, 'StoreKeeper', '$2y$10$QuTJHTiTbsayJuu0fXkI9efp38gS7yRaO.Aynw8SnOi16UzoSxcZK', 1, 'Isuru', 'Kuruppu', 'male', '45', 'Lily Avenue', 'Colombo-06', 'employee', 1, NULL, '2024-07-31 08:54:04', 0),
(14, 'Pharmacist', '$2y$10$14FiJ9SevA9WIQ2AHPr8P..riNS1nMvjLQ20uNCw7RG7kdROFgJXu', 1, 'Arulanandan', 'Arushan', 'male', '59,3/5', 'W.A Silva Mawatha', 'Colombo-06', 'employee', 1, NULL, '2024-07-31 08:54:00', 0),
(15, 'Tom', '$2y$10$ncRXuSWfq2W8JqLQK/HasuIsPl0dGe.mqciW5ROwBEbfYdeyhcsUO', 1, 'tom', 'davis', 'male', '78', 'galle road', 'colombo-06', 'customer', 1, NULL, '2024-07-31 08:53:56', 1),
(16, 'Marsh1', '$2y$10$235dH.gMY1BdF.gtdr/UsuFLhfUrM/vN8nmqcEUwDyW2C0XCXfi9u', 1, 'marsh', 'arul', 'male', '45', 'galle road', 'colombo-06', 'customer', 1, NULL, '2024-07-31 08:53:52', 1),
(17, 'Huge', '$2y$10$IZC./79xRpTu43JVSsClrOOntqT34SDIny1v5dl3aVr7QfdefX25K', 1, 'huge', 'jackman', 'male', '45', 'mainstreet', 'colombo-06', 'customer', 1, '9c876e630333617e29cdb24afc6f156c', '2024-07-31 07:52:42', 0),
(18, 'Tommy', '$2y$10$00z.QiO3WwwJvYqiG6GnxeiTiQI882vJJMZK5ss5VGLIbq5nSDToi', 1, 'tommy', 'davis', 'male', '78', 'galle road', 'colombo-06', 'customer', 1, NULL, '2024-07-31 08:53:43', 1),
(20, 'Jenny', '$2y$10$eP2cfOLCXhdZFt7/zHYTTuHA7xUaheQUGUNNED7G.JiieFtCUjnIO', 3, 'jenny', 'davis', 'male', '78', 'galle road', 'colombo-06', 'customer', 1, NULL, '2024-07-31 08:53:37', 1),
(21, 'David', '$2y$10$Mur4Zh1gr5I21V7Yk.fxzuMAjCES845FFydLJ0uaLY7IH0ipW1rxK', 1, 'David', 'cooray', 'male', '78', 'mainstreet', 'colombo-06', 'customer', 1, NULL, NULL, 1),
(22, 'Kem', '$2y$10$eAYhK.Gys1uULcQVMbebY.7Msh7h.2WXBuFFCiALOw7FWIv9vdUDC', 1, 'Kem', 'davis', 'male', '78', 'galle road', 'colombo-06', 'customer', 1, 'null', '2024-07-31 09:01:55', 1),
(23, 'Jimmy', '$2y$10$zPx6HbYzv2tes57ywUzDLeLOLeEptlwdSh0qlQbTji9l7k0l0nhei', 1, 'Jimmy', 'Kimmel', 'male', '60', 'main road', 'Wellawatte', 'customer', 1, NULL, NULL, 1),
(24, 'Deliverer', '$2y$10$jNRod3z89GQJQYd8HpKxCOseX/pttwjT/.WRAQwaLB2bdEP9p2HsG', 1, 'Nimal', 'Perera', 'male', '58', 'Hill Street', 'Dehiwala', 'employee', 1, NULL, '2024-07-31 12:01:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_modules`
--

CREATE TABLE `user_modules` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `ModuleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_modules`
--

INSERT INTO `user_modules` (`Id`, `UserId`, `ModuleId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 18, 3),
(4, 18, 4),
(5, 1, 5),
(6, 1, 3),
(7, 1, 6),
(8, 1, 7),
(9, 1, 4),
(10, 1, 9),
(11, 1, 10),
(12, 1, 0),
(13, 1, 0),
(14, 1, 13),
(15, 13, 2),
(16, 13, 5),
(17, 12, 11),
(18, 12, 12),
(19, 11, 3),
(20, 11, 13),
(21, 14, 9),
(22, 14, 7),
(23, 14, 6),
(24, 14, 4),
(25, 14, 10),
(26, 24, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`DesigId`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `dosage_form`
--
ALTER TABLE `dosage_form`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `order_items_issue`
--
ALTER TABLE `order_items_issue`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `prescription_status`
--
ALTER TABLE `prescription_status`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `prescription_upload`
--
ALTER TABLE `prescription_upload`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `price_request`
--
ALTER TABLE `price_request`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `price_request_item`
--
ALTER TABLE `price_request_item`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `quotation_items`
--
ALTER TABLE `quotation_items`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sub_modules`
--
ALTER TABLE `sub_modules`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `user_modules`
--
ALTER TABLE `user_modules`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `DesigId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `dosage_form`
--
ALTER TABLE `dosage_form`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `order_items_issue`
--
ALTER TABLE `order_items_issue`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `prescription_status`
--
ALTER TABLE `prescription_status`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prescription_upload`
--
ALTER TABLE `prescription_upload`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `price_request`
--
ALTER TABLE `price_request`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `price_request_item`
--
ALTER TABLE `price_request_item`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quotation_items`
--
ALTER TABLE `quotation_items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_modules`
--
ALTER TABLE `user_modules`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
