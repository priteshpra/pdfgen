-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 08:46 AM
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
-- Database: `pdfgen`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`` PROCEDURE `GetCASDetails` (IN `emp_id` INT)   BEGIN
    SELECT * FROM users WHERE id = emp_id AND user_type='4';
END$$

CREATE DEFINER=`` PROCEDURE `GetCategoryDetails` (IN `p_category_id` INT)   BEGIN
    SELECT * FROM businesscategory WHERE BusinessCategoryID = p_category_id;
END$$

CREATE DEFINER=`` PROCEDURE `GetCityDetails` (IN `city_id` INT)   BEGIN
    SELECT * FROM cities WHERE CityID = city_id;
END$$

CREATE DEFINER=`` PROCEDURE `GetclientsDetails` (IN `emp_id` INT)   BEGIN
    SELECT * FROM users WHERE id = emp_id AND user_type='3';
END$$

CREATE DEFINER=`` PROCEDURE `GetCMSDetails` (IN `cms_id` INT)   BEGIN
    SELECT * FROM cms WHERE CMSID = cms_id;
END$$

CREATE DEFINER=`` PROCEDURE `GetEmployeeDetails` (IN `emp_id` INT)   BEGIN
    SELECT * FROM users WHERE id = emp_id AND user_type='3';
END$$

CREATE DEFINER=`` PROCEDURE `GetStateDetails` (IN `state_id` INT)   BEGIN
    SELECT * FROM states WHERE StateID = state_id;
END$$

CREATE DEFINER=`` PROCEDURE `InsertCAS` (IN `p_first_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `firm_name` VARCHAR(100), IN `p_phone_number` VARCHAR(15), IN `p_hire_date` VARCHAR(15))   BEGIN
    INSERT INTO users (first_name, last_name, firm_name, mobile_no, address)
    VALUES (p_first_name, p_last_name, firm_name, p_phone_number, p_hire_date);
END$$

CREATE DEFINER=`` PROCEDURE `InsertCategory` (IN `p_category_name` VARCHAR(100), IN `p_title_name` VARCHAR(100), IN `p_keyword_name` VARCHAR(100), IN `p_description` TEXT)   BEGIN
    INSERT INTO businesscategory (CategoryName, MetaTitle, MetaKeywords, MetaDescription)
    VALUES (p_category_name, p_title_name, p_keyword_name, p_description);
END$$

CREATE DEFINER=`` PROCEDURE `InsertCity` (IN `p_city_name` VARCHAR(100), IN `p_state_code` VARCHAR(10), IN `p_country_code` VARCHAR(10))   BEGIN
    INSERT INTO states (City, StateID, CountryID)
    VALUES (p_city_name, p_state_code, p_country_code);
END$$

CREATE DEFINER=`` PROCEDURE `InsertClients` (IN `p_first_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `firm_name` VARCHAR(100), IN `p_phone_number` VARCHAR(15), IN `p_hire_date` VARCHAR(15))   BEGIN
    INSERT INTO users (first_name, last_name, firm_name, mobile_no, address)
    VALUES (p_first_name, p_last_name, firm_name, p_phone_number, p_hire_date);
END$$

CREATE DEFINER=`` PROCEDURE `InsertCMS` (IN `p_page` VARCHAR(255), IN `p_content` TEXT)   BEGIN
    INSERT INTO cms (PageID, content)
    VALUES (p_page, p_content);
END$$

CREATE DEFINER=`` PROCEDURE `InsertEmployee` (IN `p_first_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `firm_name` VARCHAR(100), IN `p_phone_number` VARCHAR(15), IN `p_hire_date` VARCHAR(15))   BEGIN
    INSERT INTO users (first_name, last_name, firm_name, mobile_no, address)
    VALUES (p_first_name, p_last_name, firm_name, p_phone_number, p_hire_date);
END$$

CREATE DEFINER=`` PROCEDURE `InsertState` (IN `p_state_name` VARCHAR(100), IN `p_country_code` VARCHAR(10))   BEGIN
    INSERT INTO states (State, CountryID)
    VALUES (p_state_name, p_country_code);
END$$

CREATE DEFINER=`` PROCEDURE `UpdateCAS` (IN `emp_id` INT, IN `p_first_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `p_email` VARCHAR(100), IN `p_phone_number` VARCHAR(15), IN `p_hire_date` DATE, IN `p_salary` DECIMAL(10,2))   BEGIN
    UPDATE users
    SET 
        first_name = p_first_name,
        last_name = p_last_name,
        email = p_email,
        phone_number = p_phone_number,
        hire_date = p_hire_date,
        salary = p_salary
    WHERE id = emp_id;
END$$

CREATE DEFINER=`` PROCEDURE `UpdateCategory` (IN `p_category_id` INT, IN `p_category_name` VARCHAR(100), IN `p_title_name` VARCHAR(100), IN `p_keyword_name` VARCHAR(100), IN `p_description` TEXT)   BEGIN
    UPDATE businesscategory
    SET 
        CategoryName = p_category_name,
        MetaTitle = p_title_name,
        MetaKeywords = p_keyword_name,
        MetaDescription = p_description
    WHERE BusinessCategoryID = p_category_id;
END$$

CREATE DEFINER=`` PROCEDURE `UpdateCity` (IN `p_state_id` INT, IN `p_city_name` VARCHAR(100), IN `p_country_code` VARCHAR(10), IN `p_state_code` VARCHAR(10))   BEGIN
    UPDATE cities
    SET 
        City = p_city_name,
        CountryID = p_country_code,
        StateID = p_state_code
    WHERE StateID = p_state_id;
END$$

CREATE DEFINER=`` PROCEDURE `UpdateClient` (IN `emp_id` INT, IN `p_first_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `p_email` VARCHAR(100), IN `p_phone_number` VARCHAR(15), IN `p_hire_date` DATE, IN `p_salary` DECIMAL(10,2))   BEGIN
    UPDATE users
    SET 
        first_name = p_first_name,
        last_name = p_last_name,
        email = p_email,
        phone_number = p_phone_number,
        hire_date = p_hire_date,
        salary = p_salary
    WHERE id = emp_id;
END$$

CREATE DEFINER=`` PROCEDURE `UpdateCMS` (IN `p_cms_id` INT, IN `p_page` VARCHAR(255), IN `p_content` TEXT)   BEGIN
    UPDATE cms
    SET 
        PageID = p_page,
        Content = p_content
    WHERE CMSID = p_cms_id;
END$$

CREATE DEFINER=`` PROCEDURE `UpdateEmployee` (IN `emp_id` INT, IN `p_first_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `p_email` VARCHAR(100), IN `p_phone_number` VARCHAR(15), IN `p_hire_date` DATE, IN `p_salary` DECIMAL(10,2))   BEGIN
    UPDATE users
    SET 
        first_name = p_first_name,
        last_name = p_last_name,
        email = p_email,
        phone_number = p_phone_number,
        hire_date = p_hire_date,
        salary = p_salary
    WHERE id = emp_id;
END$$

CREATE DEFINER=`` PROCEDURE `UpdateState` (IN `p_state_id` INT, IN `p_state_name` VARCHAR(100), IN `p_country_code` VARCHAR(10))   BEGIN
    UPDATE states
    SET 
        StateName = p_state_name,
        CountryID = p_country_code
    WHERE StateID = p_state_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `businesscategory`
--

CREATE TABLE `businesscategory` (
  `BusinessCategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `MetaTitle` varchar(60) NOT NULL,
  `MetaKeywords` varchar(200) NOT NULL,
  `MetaDescription` varchar(1000) NOT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `businesscategory`
--

INSERT INTO `businesscategory` (`BusinessCategoryID`, `CategoryName`, `MetaTitle`, `MetaKeywords`, `MetaDescription`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'test', 'tetst', 'tsts', 'tsts', NULL, '2024-10-07 23:33:16', NULL, NULL, 1, '2024-10-07 18:03:16', '2024-10-22 06:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `CityID` bigint(20) NOT NULL,
  `CountryID` bigint(20) NOT NULL DEFAULT 0,
  `StateID` int(11) NOT NULL,
  `City` varchar(250) DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`CityID`, `CountryID`, `StateID`, `City`, `Status`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Agra', 1, '2024-10-22 10:35:26', '2024-10-22 06:40:15'),
(2, 1, 0, 'Ahmedabad', 1, '2024-10-22 10:35:26', NULL),
(3, 1, 0, 'Allahabad', 1, '2024-10-22 10:35:26', NULL),
(4, 1, 0, 'B.R Hills', 1, '2024-10-22 10:35:26', NULL),
(5, 1, 0, 'Bangalore', 1, '2024-10-22 10:35:26', NULL),
(6, 1, 0, 'Baroda', 1, '2024-10-22 10:35:26', NULL),
(7, 1, 0, 'Bhopal', 1, '2024-10-22 10:35:26', NULL),
(8, 1, 0, 'Bhubaneswar', 1, '2024-10-22 10:35:26', NULL),
(9, 1, 0, 'Bodhgaya', 1, '2024-10-22 10:35:26', NULL),
(10, 1, 0, 'Calicut', 1, '2024-10-22 10:35:26', NULL),
(11, 1, 0, 'Chennai', 1, '2024-10-22 10:35:26', NULL),
(12, 1, 0, 'Chotanagpur', 1, '2024-10-22 10:35:26', NULL),
(13, 1, 0, 'Coimbatore', 1, '2024-10-22 10:35:26', NULL),
(14, 1, 0, 'Dispur', 1, '2024-10-22 10:35:26', NULL),
(15, 1, 0, 'Ernakulam', 1, '2024-10-22 10:35:26', NULL),
(16, 1, 0, 'Gandhi Nagar', 1, '2024-10-22 10:35:26', NULL),
(17, 1, 0, 'Gwalior', 1, '2024-10-22 10:35:26', NULL),
(18, 1, 0, 'Hyderabad', 1, '2024-10-22 10:35:26', NULL),
(19, 1, 0, 'Imphal', 1, '2024-10-22 10:35:26', NULL),
(20, 1, 0, 'Indore', 1, '2024-10-22 10:35:26', NULL),
(21, 1, 0, 'Itanagar', 1, '2024-10-22 10:35:26', NULL),
(22, 1, 0, 'Jaipur', 1, '2024-10-22 10:35:26', NULL),
(23, 1, 0, 'Jhansi', 1, '2024-10-22 10:35:26', NULL),
(24, 1, 0, 'Kanpur', 1, '2024-10-22 10:35:26', NULL),
(25, 1, 0, 'Kanya Kumari', 1, '2024-10-22 10:35:26', NULL),
(26, 1, 0, 'Karur', 1, '2024-10-22 10:35:26', NULL),
(27, 1, 0, 'Kochi', 1, '2024-10-22 10:35:26', NULL),
(28, 1, 0, 'Kolkata', 1, '2024-10-22 10:35:26', NULL),
(29, 1, 0, 'Lucknow', 1, '2024-10-22 10:35:26', NULL),
(30, 1, 0, 'Ludhiana', 1, '2024-10-22 10:35:26', NULL),
(31, 1, 0, 'Mandi', 1, '2024-10-22 10:35:26', NULL),
(32, 1, 0, 'Mangalore', 1, '2024-10-22 10:35:26', NULL),
(33, 1, 0, 'Meerut', 1, '2024-10-22 10:35:26', NULL),
(34, 1, 0, 'Mumbai', 1, '2024-10-22 10:35:26', NULL),
(35, 1, 0, 'Mysore', 1, '2024-10-22 10:35:26', NULL),
(36, 1, 0, 'Nagpur', 1, '2024-10-22 10:35:26', NULL),
(37, 1, 0, 'Nashik', 1, '2024-10-22 10:35:26', NULL),
(38, 1, 0, 'New Delhi', 1, '2024-10-22 10:35:26', NULL),
(39, 1, 0, 'Panaji', 1, '2024-10-22 10:35:26', NULL),
(40, 1, 0, 'Patna', 1, '2024-10-22 10:35:26', NULL),
(41, 1, 0, 'Pune', 1, '2024-10-22 10:35:26', NULL),
(42, 1, 0, 'Ranchi', 1, '2024-10-22 10:35:26', NULL),
(43, 1, 0, 'Shillong', 1, '2024-10-22 10:35:26', NULL),
(44, 1, 0, 'Shimla', 1, '2024-10-22 10:35:26', NULL),
(45, 1, 0, 'Srinagar', 1, '2024-10-22 10:35:26', NULL),
(46, 1, 0, 'Thane', 1, '2024-10-22 10:35:26', NULL),
(47, 1, 0, 'Thiruvananthapuram', 1, '2024-10-22 10:35:26', NULL),
(48, 1, 0, 'Tiruchirapalli', 1, '2024-10-22 10:35:26', NULL),
(49, 1, 0, 'Udaipur', 1, '2024-10-22 10:35:26', NULL),
(50, 1, 0, 'Vidisha', 1, '2024-10-22 10:35:26', NULL),
(51, 1, 0, 'Vishakapatnam', 1, '2024-10-22 10:35:26', NULL),
(52, 2, 0, 'Akron', 1, '2024-10-22 10:35:26', NULL),
(53, 2, 0, 'Albuquerque', 1, '2024-10-22 10:35:26', NULL),
(54, 2, 0, 'Anaheim', 1, '2024-10-22 10:35:26', NULL),
(55, 2, 0, 'Anchorage', 1, '2024-10-22 10:35:26', NULL),
(56, 2, 0, 'Arlington', 1, '2024-10-22 10:35:26', NULL),
(57, 2, 0, 'Arlington', 1, '2024-10-22 10:35:26', NULL),
(58, 2, 0, 'Atlanta', 1, '2024-10-22 10:35:26', NULL),
(59, 2, 0, 'Augusta-Richmond', 1, '2024-10-22 10:35:26', NULL),
(60, 2, 0, 'Aurora', 1, '2024-10-22 10:35:26', NULL),
(61, 2, 0, 'Austin', 1, '2024-10-22 10:35:26', NULL),
(62, 2, 0, 'Bakersfield', 1, '2024-10-22 10:35:26', NULL),
(63, 2, 0, 'Baltimore', 1, '2024-10-22 10:35:26', NULL),
(64, 2, 0, 'Baton Rouge', 1, '2024-10-22 10:35:26', NULL),
(65, 2, 0, 'Birmingham', 1, '2024-10-22 10:35:26', NULL),
(66, 2, 0, 'Boise', 1, '2024-10-22 10:35:26', NULL),
(67, 2, 0, 'Boston', 1, '2024-10-22 10:35:26', NULL),
(68, 2, 0, 'Buffalo', 1, '2024-10-22 10:35:26', NULL),
(69, 2, 0, 'Charlotte', 1, '2024-10-22 10:35:26', NULL),
(70, 2, 0, 'Chesapeake', 1, '2024-10-22 10:35:26', NULL),
(71, 2, 0, 'Chicago', 1, '2024-10-22 10:35:26', NULL),
(72, 2, 0, 'Cincinnati', 1, '2024-10-22 10:35:26', NULL),
(73, 2, 0, 'Cleveland', 1, '2024-10-22 10:35:26', NULL),
(74, 2, 0, 'Colorado Springs', 1, '2024-10-22 10:35:26', NULL),
(75, 2, 0, 'Columbus', 1, '2024-10-22 10:35:26', NULL),
(76, 2, 0, 'Corpus Christi', 1, '2024-10-22 10:35:26', NULL),
(77, 2, 0, 'Dallas', 1, '2024-10-22 10:35:26', NULL),
(78, 2, 0, 'Denver', 1, '2024-10-22 10:35:26', NULL),
(79, 2, 0, 'Des Moines', 1, '2024-10-22 10:35:26', NULL),
(80, 2, 0, 'Detroit', 1, '2024-10-22 10:35:26', NULL),
(81, 2, 0, 'Durham', 1, '2024-10-22 10:35:26', NULL),
(82, 2, 0, 'El Paso', 1, '2024-10-22 10:35:26', NULL),
(83, 2, 0, 'Fort Wayne', 1, '2024-10-22 10:35:26', NULL),
(84, 2, 0, 'Fort Worth', 1, '2024-10-22 10:35:26', NULL),
(85, 2, 0, 'Fremont', 1, '2024-10-22 10:35:26', NULL),
(86, 2, 0, 'Fresno', 1, '2024-10-22 10:35:26', NULL),
(87, 2, 0, 'Garland', 1, '2024-10-22 10:35:26', NULL),
(88, 2, 0, 'Glendale', 1, '2024-10-22 10:35:26', NULL),
(89, 2, 0, 'Glendale', 1, '2024-10-22 10:35:26', NULL),
(90, 2, 0, 'Grand Rapids', 1, '2024-10-22 10:35:26', NULL),
(91, 2, 0, 'Greensboro', 1, '2024-10-22 10:35:26', NULL),
(92, 2, 0, 'Hialeah', 1, '2024-10-22 10:35:26', NULL),
(93, 2, 0, 'Honolulu', 1, '2024-10-22 10:35:26', NULL),
(94, 2, 0, 'Houston', 1, '2024-10-22 10:35:26', NULL),
(95, 2, 0, 'Huntington Beach', 1, '2024-10-22 10:35:26', NULL),
(96, 2, 0, 'Indianapolis', 1, '2024-10-22 10:35:26', NULL),
(97, 2, 0, 'Irving', 1, '2024-10-22 10:35:26', NULL),
(98, 2, 0, 'Jersey City', 1, '2024-10-22 10:35:26', NULL),
(99, 2, 0, 'Kansas City', 1, '2024-10-22 10:35:26', NULL),
(100, 2, 0, 'Las Vegas', 1, '2024-10-22 10:35:26', NULL),
(101, 2, 0, 'Lexington-Fayette', 1, '2024-10-22 10:35:26', NULL),
(102, 2, 0, 'Lincoln', 1, '2024-10-22 10:35:26', NULL),
(103, 2, 0, 'Long Beach', 1, '2024-10-22 10:35:26', NULL),
(104, 2, 0, 'Los Angeles', 1, '2024-10-22 10:35:26', NULL),
(105, 2, 0, 'Louisville', 1, '2024-10-22 10:35:26', NULL),
(106, 2, 0, 'Lubbock', 1, '2024-10-22 10:35:26', NULL),
(107, 2, 0, 'Madison', 1, '2024-10-22 10:35:26', NULL),
(108, 2, 0, 'Mesa', 1, '2024-10-22 10:35:26', NULL),
(109, 2, 0, 'Milwaukee', 1, '2024-10-22 10:35:26', NULL),
(110, 2, 0, 'Minneapolis', 1, '2024-10-22 10:35:26', NULL),
(111, 2, 0, 'Mobile', 1, '2024-10-22 10:35:26', NULL),
(112, 2, 0, 'Modesto', 1, '2024-10-22 10:35:26', NULL),
(113, 2, 0, 'Montgomery', 1, '2024-10-22 10:35:26', NULL),
(114, 2, 0, 'New Orleans', 1, '2024-10-22 10:35:26', NULL),
(115, 2, 0, 'New York', 1, '2024-10-22 10:35:26', NULL),
(116, 2, 0, 'Newark', 1, '2024-10-22 10:35:26', NULL),
(117, 2, 0, 'Norfolk', 1, '2024-10-22 10:35:26', NULL),
(118, 2, 0, 'Oakland', 1, '2024-10-22 10:35:26', NULL),
(119, 2, 0, 'Oklahoma City', 1, '2024-10-22 10:35:26', NULL),
(120, 2, 0, 'Omaha', 1, '2024-10-22 10:35:26', NULL),
(121, 2, 0, 'Other cities in USA', 1, '2024-10-22 10:35:26', NULL),
(122, 2, 0, 'Philadelphia', 1, '2024-10-22 10:35:26', NULL),
(123, 2, 0, 'Phoenix', 1, '2024-10-22 10:35:26', NULL),
(124, 2, 0, 'Pittsburgh', 1, '2024-10-22 10:35:26', NULL),
(125, 2, 0, 'Plano', 1, '2024-10-22 10:35:26', NULL),
(126, 2, 0, 'Portland', 1, '2024-10-22 10:35:26', NULL),
(127, 2, 0, 'Raleigh', 1, '2024-10-22 10:35:26', NULL),
(128, 2, 0, 'Richmond)', 1, '2024-10-22 10:35:26', NULL),
(129, 2, 0, 'Riverside', 1, '2024-10-22 10:35:26', NULL),
(130, 2, 0, 'Rochester', 1, '2024-10-22 10:35:26', NULL),
(131, 2, 0, 'Sacramento', 1, '2024-10-22 10:35:26', NULL),
(132, 2, 0, 'San Antonio', 1, '2024-10-22 10:35:26', NULL),
(133, 2, 0, 'San Diego', 1, '2024-10-22 10:35:26', NULL),
(134, 2, 0, 'San Francisco', 1, '2024-10-22 10:35:26', NULL),
(135, 2, 0, 'San Jose', 1, '2024-10-22 10:35:26', NULL),
(136, 2, 0, 'Santa Ana)', 1, '2024-10-22 10:35:26', NULL),
(137, 2, 0, 'Scottsdale', 1, '2024-10-22 10:35:26', NULL),
(138, 2, 0, 'Seattle', 1, '2024-10-22 10:35:26', NULL),
(139, 2, 0, 'Shreveport', 1, '2024-10-22 10:35:26', NULL),
(140, 2, 0, 'Spokane', 1, '2024-10-22 10:35:26', NULL),
(141, 2, 0, 'St.Louis', 1, '2024-10-22 10:35:26', NULL),
(142, 2, 0, 'St.Paul', 1, '2024-10-22 10:35:26', NULL),
(143, 2, 0, 'Stockton', 1, '2024-10-22 10:35:26', NULL),
(144, 2, 0, 'Tacoma', 1, '2024-10-22 10:35:26', NULL),
(145, 2, 0, 'Toledo', 1, '2024-10-22 10:35:26', NULL),
(146, 2, 0, 'Tucson', 1, '2024-10-22 10:35:26', NULL),
(147, 2, 0, 'Tulsa', 1, '2024-10-22 10:35:26', NULL),
(148, 2, 0, 'Virginia Beach', 1, '2024-10-22 10:35:26', NULL),
(149, 2, 0, 'Washington', 1, '2024-10-22 10:35:26', NULL),
(150, 2, 0, 'Wichita', 1, '2024-10-22 10:35:26', NULL),
(151, 2, 0, 'Winston-Salem', 1, '2024-10-22 10:35:26', NULL),
(152, 2, 0, 'Yonkers', 1, '2024-10-22 10:35:26', NULL),
(153, 3, 0, 'Birmingham', 1, '2024-10-22 10:35:26', NULL),
(154, 3, 0, 'Bristol', 1, '2024-10-22 10:35:26', NULL),
(155, 3, 0, 'Glasgow', 1, '2024-10-22 10:35:26', NULL),
(156, 3, 0, 'Leeds', 1, '2024-10-22 10:35:26', NULL),
(157, 3, 0, 'Liverpool', 1, '2024-10-22 10:35:26', NULL),
(158, 3, 0, 'London', 1, '2024-10-22 10:35:26', NULL),
(159, 3, 0, 'Manchester', 1, '2024-10-22 10:35:26', NULL),
(160, 3, 0, 'Newcastle', 1, '2024-10-22 10:35:26', NULL),
(161, 3, 0, 'Nottingham', 1, '2024-10-22 10:35:26', NULL),
(162, 3, 0, 'Sheffield', 1, '2024-10-22 10:35:26', NULL),
(163, 4, 0, 'Calgary', 1, '2024-10-22 10:35:26', NULL),
(164, 4, 0, 'Edmonton', 1, '2024-10-22 10:35:26', NULL),
(165, 4, 0, 'Hamilton', 1, '2024-10-22 10:35:26', NULL),
(166, 4, 0, 'Kitchener', 1, '2024-10-22 10:35:26', NULL),
(167, 4, 0, 'London', 1, '2024-10-22 10:35:26', NULL),
(168, 4, 0, 'Montréal', 1, '2024-10-22 10:35:26', NULL),
(169, 4, 0, 'Ottawa', 1, '2024-10-22 10:35:26', NULL),
(170, 4, 0, 'Québec', 1, '2024-10-22 10:35:26', NULL),
(171, 4, 0, 'St.Catharines', 1, '2024-10-22 10:35:26', NULL),
(172, 4, 0, 'Toronto', 1, '2024-10-22 10:35:26', NULL),
(173, 4, 0, 'Vancouver', 1, '2024-10-22 10:35:26', NULL),
(174, 4, 0, 'Victoria', 1, '2024-10-22 10:35:26', NULL),
(175, 4, 0, 'Winnipeg', 1, '2024-10-22 10:35:26', NULL),
(176, 5, 0, 'Adelaide', 1, '2024-10-22 10:35:26', NULL),
(177, 5, 0, 'Brisbane', 1, '2024-10-22 10:35:26', NULL),
(178, 5, 0, 'Canberra', 1, '2024-10-22 10:35:26', NULL),
(179, 5, 0, 'Geelong', 1, '2024-10-22 10:35:26', NULL),
(180, 5, 0, 'Gold Coast', 1, '2024-10-22 10:35:26', NULL),
(181, 5, 0, 'Gosford', 1, '2024-10-22 10:35:26', NULL),
(182, 5, 0, 'Hobart', 1, '2024-10-22 10:35:26', NULL),
(183, 5, 0, 'Melbourne', 1, '2024-10-22 10:35:26', NULL),
(184, 5, 0, 'Newcastle', 1, '2024-10-22 10:35:26', NULL),
(185, 5, 0, 'Perth', 1, '2024-10-22 10:35:26', NULL),
(186, 5, 0, 'Sunshine Coast', 1, '2024-10-22 10:35:26', NULL),
(187, 5, 0, 'Sydney', 1, '2024-10-22 10:35:26', NULL),
(188, 5, 0, 'Townsville', 1, '2024-10-22 10:35:26', NULL),
(189, 5, 0, 'Wollongong', 1, '2024-10-22 10:35:26', NULL),
(190, 6, 0, 'Amsterdam', 1, '2024-10-22 10:35:26', NULL),
(191, 6, 0, 'Athinai (Athens)', 1, '2024-10-22 10:35:26', NULL),
(192, 6, 0, 'Barcelona', 1, '2024-10-22 10:35:26', NULL),
(193, 6, 0, 'Barnaul', 1, '2024-10-22 10:35:26', NULL),
(194, 6, 0, 'Beograd (Belgrade)', 1, '2024-10-22 10:35:26', NULL),
(195, 6, 0, 'Berlin', 1, '2024-10-22 10:35:26', NULL),
(196, 6, 0, 'Bremen', 1, '2024-10-22 10:35:26', NULL),
(197, 6, 0, 'Bucuresti (Bucharest)', 1, '2024-10-22 10:35:26', NULL),
(198, 6, 0, 'Budapest', 1, '2024-10-22 10:35:26', NULL),
(199, 6, 0, 'Chelyabinsk', 1, '2024-10-22 10:35:26', NULL),
(200, 6, 0, 'Dnepropetrovsk', 1, '2024-10-22 10:35:26', NULL),
(201, 6, 0, 'Donetsk', 1, '2024-10-22 10:35:26', NULL),
(202, 6, 0, 'Dortmund', 1, '2024-10-22 10:35:26', NULL),
(203, 6, 0, 'Duisburg', 1, '2024-10-22 10:35:26', NULL),
(204, 6, 0, 'Düsseldorf', 1, '2024-10-22 10:35:26', NULL),
(205, 6, 0, 'Ekaterinoburg', 1, '2024-10-22 10:35:26', NULL),
(206, 6, 0, 'Essen', 1, '2024-10-22 10:35:26', NULL),
(207, 6, 0, 'Frankfurt', 1, '2024-10-22 10:35:26', NULL),
(208, 6, 0, 'Genova', 1, '2024-10-22 10:35:26', NULL),
(209, 6, 0, 'Hamburg', 1, '2024-10-22 10:35:26', NULL),
(210, 6, 0, 'Hannover', 1, '2024-10-22 10:35:26', NULL),
(211, 6, 0, 'Helsinki', 1, '2024-10-22 10:35:26', NULL),
(212, 6, 0, 'Irkutsk', 1, '2024-10-22 10:35:26', NULL),
(213, 6, 0, 'Izhevsk', 1, '2024-10-22 10:35:26', NULL),
(214, 6, 0, 'Kazan', 1, '2024-10-22 10:35:26', NULL),
(215, 6, 0, 'Kemerovo', 1, '2024-10-22 10:35:26', NULL),
(216, 6, 0, 'Khabarovsk', 1, '2024-10-22 10:35:26', NULL),
(217, 6, 0, 'Kharkov', 1, '2024-10-22 10:35:26', NULL),
(218, 6, 0, 'Kiev', 1, '2024-10-22 10:35:26', NULL),
(219, 6, 0, 'Kishinev', 1, '2024-10-22 10:35:26', NULL),
(220, 6, 0, 'Kobenhavn (Copenhagen)', 1, '2024-10-22 10:35:26', NULL),
(221, 6, 0, 'Köln (Cologne)', 1, '2024-10-22 10:35:26', NULL),
(222, 6, 0, 'Kraków', 1, '2024-10-22 10:35:26', NULL),
(223, 6, 0, 'Krasnodar', 1, '2024-10-22 10:35:26', NULL),
(224, 6, 0, 'Krasnoyarsk', 1, '2024-10-22 10:35:26', NULL),
(225, 6, 0, 'Kryvy Rig', 1, '2024-10-22 10:35:26', NULL),
(226, 6, 0, 'Lipetsk', 1, '2024-10-22 10:35:26', NULL),
(227, 6, 0, 'Lisboa (Lisbon)', 1, '2024-10-22 10:35:26', NULL),
(228, 6, 0, 'Lódz', 1, '2024-10-22 10:35:26', NULL),
(229, 6, 0, 'Lvov', 1, '2024-10-22 10:35:26', NULL),
(230, 6, 0, 'Madrid', 1, '2024-10-22 10:35:26', NULL),
(231, 6, 0, 'Málaga', 1, '2024-10-22 10:35:26', NULL),
(232, 6, 0, 'Marseille', 1, '2024-10-22 10:35:26', NULL),
(233, 6, 0, 'Milano (Milan)', 1, '2024-10-22 10:35:26', NULL),
(234, 6, 0, 'Minsk', 1, '2024-10-22 10:35:26', NULL),
(235, 6, 0, 'Moskva (Moscow)', 1, '2024-10-22 10:35:26', NULL),
(236, 6, 0, 'München (Munich)', 1, '2024-10-22 10:35:26', NULL),
(237, 6, 0, 'Mykolaiv', 1, '2024-10-22 10:35:26', NULL),
(238, 6, 0, 'Naberezhnye Tchelny', 1, '2024-10-22 10:35:26', NULL),
(239, 6, 0, 'Napoli (Naples)', 1, '2024-10-22 10:35:26', NULL),
(240, 6, 0, 'Nizhny Novgorod', 1, '2024-10-22 10:35:26', NULL),
(241, 6, 0, 'Novokuznetsk', 1, '2024-10-22 10:35:26', NULL),
(242, 6, 0, 'Novosibirsk', 1, '2024-10-22 10:35:26', NULL),
(243, 6, 0, 'Odessa', 1, '2024-10-22 10:35:26', NULL),
(244, 6, 0, 'Omsk', 1, '2024-10-22 10:35:26', NULL),
(245, 6, 0, 'Orenburg', 1, '2024-10-22 10:35:26', NULL),
(246, 6, 0, 'Oslo', 1, '2024-10-22 10:35:26', NULL),
(247, 6, 0, 'Palermo', 1, '2024-10-22 10:35:26', NULL),
(248, 6, 0, 'Paris', 1, '2024-10-22 10:35:26', NULL),
(249, 6, 0, 'Penza', 1, '2024-10-22 10:35:26', NULL),
(250, 6, 0, 'Perm', 1, '2024-10-22 10:35:26', NULL),
(251, 6, 0, 'Poznan', 1, '2024-10-22 10:35:26', NULL),
(252, 6, 0, 'Praha (Prague)', 1, '2024-10-22 10:35:26', NULL),
(253, 6, 0, 'Riga', 1, '2024-10-22 10:35:26', NULL),
(254, 6, 0, 'Roma', 1, '2024-10-22 10:35:26', NULL),
(255, 6, 0, 'Rostov-na-Donu', 1, '2024-10-22 10:35:26', NULL),
(256, 6, 0, 'Rotterdam', 1, '2024-10-22 10:35:26', NULL),
(257, 6, 0, 'Ryazan', 1, '2024-10-22 10:35:26', NULL),
(258, 6, 0, 'Salonika', 1, '2024-10-22 10:35:26', NULL),
(259, 6, 0, 'Samara', 1, '2024-10-22 10:35:26', NULL),
(260, 6, 0, 'Sarajevo', 1, '2024-10-22 10:35:26', NULL),
(261, 6, 0, 'Saratov', 1, '2024-10-22 10:35:26', NULL),
(262, 6, 0, 'Sevilla', 1, '2024-10-22 10:35:26', NULL),
(263, 6, 0, 'Sofia', 1, '2024-10-22 10:35:26', NULL),
(264, 6, 0, 'St Petersburg', 1, '2024-10-22 10:35:26', NULL),
(265, 6, 0, 'Stockholm', 1, '2024-10-22 10:35:26', NULL),
(266, 6, 0, 'Stuttgart', 1, '2024-10-22 10:35:26', NULL),
(267, 6, 0, 'Tolyatti', 1, '2024-10-22 10:35:26', NULL),
(268, 6, 0, 'Torino (Turin)', 1, '2024-10-22 10:35:26', NULL),
(269, 6, 0, 'Tula', 1, '2024-10-22 10:35:26', NULL),
(270, 6, 0, 'Tyumen', 1, '2024-10-22 10:35:26', NULL),
(271, 6, 0, 'Ufa', 1, '2024-10-22 10:35:26', NULL),
(272, 6, 0, 'Ulyanovsk', 1, '2024-10-22 10:35:26', NULL),
(273, 6, 0, 'Valencia', 1, '2024-10-22 10:35:26', NULL),
(274, 6, 0, 'VILNIUS', 1, '2024-10-22 10:35:26', NULL),
(275, 6, 0, 'Vladivostok', 1, '2024-10-22 10:35:26', NULL),
(276, 6, 0, 'Volgograd', 1, '2024-10-22 10:35:26', NULL),
(277, 6, 0, 'Voronezh', 1, '2024-10-22 10:35:26', NULL),
(278, 6, 0, 'Warszawa (Warsaw)', 1, '2024-10-22 10:35:26', NULL),
(279, 6, 0, 'Wien (Vienna)', 1, '2024-10-22 10:35:26', NULL),
(280, 6, 0, 'Wroclaw (Breslau)', 1, '2024-10-22 10:35:26', NULL),
(281, 6, 0, 'Yaroslave', 1, '2024-10-22 10:35:26', NULL),
(282, 6, 0, 'Zagreb', 1, '2024-10-22 10:35:26', NULL),
(283, 6, 0, 'Zaporozhye', 1, '2024-10-22 10:35:26', NULL),
(284, 6, 0, 'Zaragoza', 1, '2024-10-22 10:35:26', NULL),
(285, 7, 0, 'Aden', 1, '2024-10-22 10:35:26', NULL),
(286, 7, 0, 'Agra', 1, '2024-10-22 10:35:26', NULL),
(287, 7, 0, 'Ahmadãbãd', 1, '2024-10-22 10:35:26', NULL),
(288, 7, 0, 'Almaty', 1, '2024-10-22 10:35:26', NULL),
(289, 7, 0, 'Ambon', 1, '2024-10-22 10:35:26', NULL),
(290, 7, 0, 'Anadyr', 1, '2024-10-22 10:35:26', NULL),
(291, 7, 0, 'Ankara', 1, '2024-10-22 10:35:26', NULL),
(292, 7, 0, 'Anshan', 1, '2024-10-22 10:35:26', NULL),
(293, 7, 0, 'Aqtau', 1, '2024-10-22 10:35:26', NULL),
(294, 7, 0, 'Aqtobe', 1, '2024-10-22 10:35:26', NULL),
(295, 7, 0, 'Ashgabat', 1, '2024-10-22 10:35:26', NULL),
(296, 7, 0, 'Astana', 1, '2024-10-22 10:35:26', NULL),
(297, 7, 0, 'Baku', 1, '2024-10-22 10:35:26', NULL),
(298, 7, 0, 'Balikpapan', 1, '2024-10-22 10:35:26', NULL),
(299, 7, 0, 'Bandar Seri Begawan', 1, '2024-10-22 10:35:26', NULL),
(300, 7, 0, 'Bandung', 1, '2024-10-22 10:35:26', NULL),
(301, 7, 0, 'Bangalore', 1, '2024-10-22 10:35:26', NULL),
(302, 7, 0, 'Bangkok', 1, '2024-10-22 10:35:26', NULL),
(303, 7, 0, 'Banjarmasin', 1, '2024-10-22 10:35:26', NULL),
(304, 7, 0, 'Baotou', 1, '2024-10-22 10:35:26', NULL),
(305, 7, 0, 'Barisal', 1, '2024-10-22 10:35:26', NULL),
(306, 7, 0, 'Basra', 1, '2024-10-22 10:35:26', NULL),
(307, 7, 0, 'Beijing', 1, '2024-10-22 10:35:26', NULL),
(308, 7, 0, 'Bethlehem', 1, '2024-10-22 10:35:26', NULL),
(309, 7, 0, 'Bhopal', 1, '2024-10-22 10:35:26', NULL),
(310, 7, 0, 'Bhubaneshwar', 1, '2024-10-22 10:35:26', NULL),
(311, 7, 0, 'Bishkek', 1, '2024-10-22 10:35:26', NULL),
(312, 7, 0, 'Bogor', 1, '2024-10-22 10:35:26', NULL),
(313, 7, 0, 'Canton', 1, '2024-10-22 10:35:26', NULL),
(314, 7, 0, 'Cebu City', 1, '2024-10-22 10:35:26', NULL),
(315, 7, 0, 'Changchun', 1, '2024-10-22 10:35:26', NULL),
(316, 7, 0, 'Changsha', 1, '2024-10-22 10:35:26', NULL),
(317, 7, 0, 'Chelyabinsk', 1, '2024-10-22 10:35:26', NULL),
(318, 7, 0, 'Chengdu', 1, '2024-10-22 10:35:26', NULL),
(319, 7, 0, 'Chennai', 1, '2024-10-22 10:35:26', NULL),
(320, 7, 0, 'Chittagong', 1, '2024-10-22 10:35:26', NULL),
(321, 7, 0, 'Choibalsan', 1, '2024-10-22 10:35:26', NULL),
(322, 7, 0, 'Chongqing', 1, '2024-10-22 10:35:26', NULL),
(323, 7, 0, 'Cirebon', 1, '2024-10-22 10:35:26', NULL),
(324, 7, 0, 'Colombo', 1, '2024-10-22 10:35:26', NULL),
(325, 7, 0, 'Comilla', 1, '2024-10-22 10:35:26', NULL),
(326, 7, 0, 'Delhi', 1, '2024-10-22 10:35:26', NULL),
(327, 7, 0, 'Denpasar', 1, '2024-10-22 10:35:26', NULL),
(328, 7, 0, 'Dhaka', 1, '2024-10-22 10:35:26', NULL),
(329, 7, 0, 'Dili', 1, '2024-10-22 10:35:26', NULL),
(330, 7, 0, 'Doha', 1, '2024-10-22 10:35:26', NULL),
(331, 7, 0, 'Dushanbe', 1, '2024-10-22 10:35:26', NULL),
(332, 7, 0, 'Endeh', 1, '2024-10-22 10:35:26', NULL),
(333, 7, 0, 'Esfahãn', 1, '2024-10-22 10:35:26', NULL),
(334, 7, 0, 'Faisalabad', 1, '2024-10-22 10:35:26', NULL),
(335, 7, 0, 'Foochow', 1, '2024-10-22 10:35:26', NULL),
(336, 7, 0, 'Fukuoka', 1, '2024-10-22 10:35:26', NULL),
(337, 7, 0, 'Fushun', 1, '2024-10-22 10:35:26', NULL),
(338, 7, 0, 'George Town', 1, '2024-10-22 10:35:26', NULL),
(339, 7, 0, 'Guiyang', 1, '2024-10-22 10:35:26', NULL),
(340, 7, 0, 'Hangzhou', 1, '2024-10-22 10:35:26', NULL),
(341, 7, 0, 'Hanoi', 1, '2024-10-22 10:35:26', NULL),
(342, 7, 0, 'Harbin', 1, '2024-10-22 10:35:26', NULL),
(343, 7, 0, 'Hilla', 1, '2024-10-22 10:35:26', NULL),
(344, 7, 0, 'Hiroshima', 1, '2024-10-22 10:35:26', NULL),
(345, 7, 0, 'Ho Chi Minh', 1, '2024-10-22 10:35:26', NULL),
(346, 7, 0, 'Hong Kong', 1, '2024-10-22 10:35:26', NULL),
(347, 7, 0, 'Hovd', 1, '2024-10-22 10:35:26', NULL),
(348, 7, 0, 'Hyderãbãd', 1, '2024-10-22 10:35:26', NULL),
(349, 7, 0, 'Incheon', 1, '2024-10-22 10:35:26', NULL),
(350, 7, 0, 'Indore', 1, '2024-10-22 10:35:26', NULL),
(351, 7, 0, 'Irbil', 1, '2024-10-22 10:35:26', NULL),
(352, 7, 0, 'Islamabad', 1, '2024-10-22 10:35:26', NULL),
(353, 7, 0, 'Jaipur', 1, '2024-10-22 10:35:26', NULL),
(354, 7, 0, 'Jakarta', 1, '2024-10-22 10:35:26', NULL),
(355, 7, 0, 'Jambi', 1, '2024-10-22 10:35:26', NULL),
(356, 7, 0, 'Jayapura', 1, '2024-10-22 10:35:26', NULL),
(357, 7, 0, 'Jeddah', 1, '2024-10-22 10:35:26', NULL),
(358, 7, 0, 'Jessore', 1, '2024-10-22 10:35:26', NULL),
(359, 7, 0, 'Jilin', 1, '2024-10-22 10:35:26', NULL),
(360, 7, 0, 'Jinan', 1, '2024-10-22 10:35:26', NULL),
(361, 7, 0, 'Jinzhou', 1, '2024-10-22 10:35:26', NULL),
(362, 7, 0, 'Kabul', 1, '2024-10-22 10:35:26', NULL),
(363, 7, 0, 'Kamchatka', 1, '2024-10-22 10:35:26', NULL),
(364, 7, 0, 'Kãnpur', 1, '2024-10-22 10:35:26', NULL),
(365, 7, 0, 'Kaohsiung', 1, '2024-10-22 10:35:26', NULL),
(366, 7, 0, 'Karachi', 1, '2024-10-22 10:35:26', NULL),
(367, 7, 0, 'Karbala', 1, '2024-10-22 10:35:26', NULL),
(368, 7, 0, 'Kathmandu', 1, '2024-10-22 10:35:26', NULL),
(369, 7, 0, 'Kawasaki', 1, '2024-10-22 10:35:26', NULL),
(370, 7, 0, 'Kediri', 1, '2024-10-22 10:35:26', NULL),
(371, 7, 0, 'Khon Kaen', 1, '2024-10-22 10:35:26', NULL),
(372, 7, 0, 'Khulna', 1, '2024-10-22 10:35:26', NULL),
(373, 7, 0, 'Kirkuk', 1, '2024-10-22 10:35:26', NULL),
(374, 7, 0, 'Kitakyushu', 1, '2024-10-22 10:35:26', NULL),
(375, 7, 0, 'Kobe', 1, '2024-10-22 10:35:26', NULL),
(376, 7, 0, 'Kolkata', 1, '2024-10-22 10:35:26', NULL),
(377, 7, 0, 'Kowloon', 1, '2024-10-22 10:35:26', NULL),
(378, 7, 0, 'Krasnoyarsk', 1, '2024-10-22 10:35:26', NULL),
(379, 7, 0, 'Kuala Lumpur', 1, '2024-10-22 10:35:26', NULL),
(380, 7, 0, 'Kudus', 1, '2024-10-22 10:35:26', NULL),
(381, 7, 0, 'Kunming', 1, '2024-10-22 10:35:26', NULL),
(382, 7, 0, 'Kupang', 1, '2024-10-22 10:35:26', NULL),
(383, 7, 0, 'Kyoto', 1, '2024-10-22 10:35:26', NULL),
(384, 7, 0, 'Lahore', 1, '2024-10-22 10:35:26', NULL),
(385, 7, 0, 'Lanchow', 1, '2024-10-22 10:35:26', NULL),
(386, 7, 0, 'Lhasa', 1, '2024-10-22 10:35:26', NULL),
(387, 7, 0, 'Lucknow', 1, '2024-10-22 10:35:26', NULL),
(388, 7, 0, 'Lüda', 1, '2024-10-22 10:35:26', NULL),
(389, 7, 0, 'Ludhiana', 1, '2024-10-22 10:35:26', NULL),
(390, 7, 0, 'Luoyang', 1, '2024-10-22 10:35:26', NULL),
(391, 7, 0, 'Macau', 1, '2024-10-22 10:35:26', NULL),
(392, 7, 0, 'Madiun', 1, '2024-10-22 10:35:26', NULL),
(393, 7, 0, 'Madurai', 1, '2024-10-22 10:35:26', NULL),
(394, 7, 0, 'Makassar', 1, '2024-10-22 10:35:26', NULL),
(395, 7, 0, 'Makkah', 1, '2024-10-22 10:35:26', NULL),
(396, 7, 0, 'Malang', 1, '2024-10-22 10:35:26', NULL),
(397, 7, 0, 'Manado', 1, '2024-10-22 10:35:26', NULL),
(398, 7, 0, 'Manama', 1, '2024-10-22 10:35:26', NULL),
(399, 7, 0, 'Manila', 1, '2024-10-22 10:35:26', NULL),
(400, 7, 0, 'Mashhad', 1, '2024-10-22 10:35:26', NULL),
(401, 7, 0, 'Mataram', 1, '2024-10-22 10:35:26', NULL),
(402, 7, 0, 'Medan', 1, '2024-10-22 10:35:26', NULL),
(403, 7, 0, 'Mosul', 1, '2024-10-22 10:35:26', NULL),
(404, 7, 0, 'Mumbai', 1, '2024-10-22 10:35:26', NULL),
(405, 7, 0, 'Muscat', 1, '2024-10-22 10:35:26', NULL),
(406, 7, 0, 'Mymensingh', 1, '2024-10-22 10:35:26', NULL),
(407, 7, 0, 'Nagoya', 1, '2024-10-22 10:35:26', NULL),
(408, 7, 0, 'Nãgpur', 1, '2024-10-22 10:35:26', NULL),
(409, 7, 0, 'Naha', 1, '2024-10-22 10:35:26', NULL),
(410, 7, 0, 'Najaf', 1, '2024-10-22 10:35:26', NULL),
(411, 7, 0, 'Nanchang', 1, '2024-10-22 10:35:26', NULL),
(412, 7, 0, 'Nasiriya', 1, '2024-10-22 10:35:26', NULL),
(413, 7, 0, 'New Delhi', 1, '2024-10-22 10:35:26', NULL),
(414, 7, 0, 'Nicosia', 1, '2024-10-22 10:35:26', NULL),
(415, 7, 0, 'Novosibirsk', 1, '2024-10-22 10:35:26', NULL),
(416, 7, 0, 'Okayama', 1, '2024-10-22 10:35:26', NULL),
(417, 7, 0, 'Omsk', 1, '2024-10-22 10:35:26', NULL),
(418, 7, 0, 'Osaka', 1, '2024-10-22 10:35:26', NULL),
(419, 7, 0, 'Pabna', 1, '2024-10-22 10:35:26', NULL),
(420, 7, 0, 'Padang', 1, '2024-10-22 10:35:26', NULL),
(421, 7, 0, 'Palembang', 1, '2024-10-22 10:35:26', NULL),
(422, 7, 0, 'Patna', 1, '2024-10-22 10:35:26', NULL),
(423, 7, 0, 'Pattaya', 1, '2024-10-22 10:35:26', NULL),
(424, 7, 0, 'Pekalongan', 1, '2024-10-22 10:35:26', NULL),
(425, 7, 0, 'Pekanbaru', 1, '2024-10-22 10:35:26', NULL),
(426, 7, 0, 'Pematangsiantar', 1, '2024-10-22 10:35:26', NULL),
(427, 7, 0, 'Perm', 1, '2024-10-22 10:35:26', NULL),
(428, 7, 0, 'Peshawar', 1, '2024-10-22 10:35:26', NULL),
(429, 7, 0, 'Phnom Penh', 1, '2024-10-22 10:35:26', NULL),
(430, 7, 0, 'Phuket', 1, '2024-10-22 10:35:26', NULL),
(431, 7, 0, 'Port Blair', 1, '2024-10-22 10:35:26', NULL),
(432, 7, 0, 'Port-aux-Francais', 1, '2024-10-22 10:35:26', NULL),
(433, 7, 0, 'Pune', 1, '2024-10-22 10:35:26', NULL),
(434, 7, 0, 'Pusan', 1, '2024-10-22 10:35:26', NULL),
(435, 7, 0, 'Pyongyang', 1, '2024-10-22 10:35:26', NULL),
(436, 7, 0, 'Qiqihar', 1, '2024-10-22 10:35:26', NULL),
(437, 7, 0, 'Raba', 1, '2024-10-22 10:35:26', NULL),
(438, 7, 0, 'Saidpur', 1, '2024-10-22 10:35:26', NULL),
(439, 7, 0, 'Samarinda', 1, '2024-10-22 10:35:26', NULL),
(440, 7, 0, 'Sana', 1, '2024-10-22 10:35:26', NULL),
(441, 7, 0, 'Sapporo', 1, '2024-10-22 10:35:26', NULL),
(442, 7, 0, 'Semarang', 1, '2024-10-22 10:35:26', NULL),
(443, 7, 0, 'Sendai', 1, '2024-10-22 10:35:26', NULL),
(444, 7, 0, 'Seoul', 1, '2024-10-22 10:35:26', NULL),
(445, 7, 0, 'Seremban', 1, '2024-10-22 10:35:26', NULL),
(446, 7, 0, 'Shanghai', 1, '2024-10-22 10:35:26', NULL),
(447, 7, 0, 'Shenzhen', 1, '2024-10-22 10:35:26', NULL),
(448, 7, 0, 'Shijiazhuang', 1, '2024-10-22 10:35:26', NULL),
(449, 7, 0, 'Shillong', 1, '2024-10-22 10:35:26', NULL),
(450, 7, 0, 'Sialkot', 1, '2024-10-22 10:35:26', NULL),
(451, 7, 0, 'Sian', 1, '2024-10-22 10:35:26', NULL),
(452, 7, 0, 'Singapore', 1, '2024-10-22 10:35:26', NULL),
(453, 7, 0, 'Singaraja', 1, '2024-10-22 10:35:26', NULL),
(454, 7, 0, 'Sulaimaniya', 1, '2024-10-22 10:35:26', NULL),
(455, 7, 0, 'Surabaya', 1, '2024-10-22 10:35:26', NULL),
(456, 7, 0, 'Surakarta', 1, '2024-10-22 10:35:26', NULL),
(457, 7, 0, 'Surat', 1, '2024-10-22 10:35:26', NULL),
(458, 7, 0, 'Sylhet', 1, '2024-10-22 10:35:26', NULL),
(459, 7, 0, 'Tabriz', 1, '2024-10-22 10:35:26', NULL),
(460, 7, 0, 'Taegu', 1, '2024-10-22 10:35:26', NULL),
(461, 7, 0, 'Taichung', 1, '2024-10-22 10:35:26', NULL),
(462, 7, 0, 'Taipei', 1, '2024-10-22 10:35:26', NULL),
(463, 7, 0, 'Taiyuan', 1, '2024-10-22 10:35:26', NULL),
(464, 7, 0, 'Tangshan', 1, '2024-10-22 10:35:26', NULL),
(465, 7, 0, 'Tanjungkarang', 1, '2024-10-22 10:35:26', NULL),
(466, 7, 0, 'Tashkent', 1, '2024-10-22 10:35:26', NULL),
(467, 7, 0, 'Tasikmalaya', 1, '2024-10-22 10:35:26', NULL),
(468, 7, 0, 'Tbilisi', 1, '2024-10-22 10:35:26', NULL),
(469, 7, 0, 'Tegal', 1, '2024-10-22 10:35:26', NULL),
(470, 7, 0, 'Ternate', 1, '2024-10-22 10:35:26', NULL),
(471, 7, 0, 'The Settlement', 1, '2024-10-22 10:35:26', NULL),
(472, 7, 0, 'Thimphu', 1, '2024-10-22 10:35:26', NULL),
(473, 7, 0, 'Tianjin', 1, '2024-10-22 10:35:26', NULL),
(474, 7, 0, 'Tokyo', 1, '2024-10-22 10:35:26', NULL),
(475, 7, 0, 'Tsingtao', 1, '2024-10-22 10:35:26', NULL),
(476, 7, 0, 'Ufa', 1, '2024-10-22 10:35:26', NULL),
(477, 7, 0, 'Ulaanbaatar', 1, '2024-10-22 10:35:26', NULL),
(478, 7, 0, 'Urümqi', 1, '2024-10-22 10:35:26', NULL),
(479, 7, 0, 'Vadodara', 1, '2024-10-22 10:35:26', NULL),
(480, 7, 0, 'Varanasi', 1, '2024-10-22 10:35:26', NULL),
(481, 7, 0, 'Vientiane', 1, '2024-10-22 10:35:26', NULL),
(482, 7, 0, 'Vishakhapatnam', 1, '2024-10-22 10:35:26', NULL),
(483, 7, 0, 'Vladivostok', 1, '2024-10-22 10:35:26', NULL),
(484, 7, 0, 'Wuhan', 1, '2024-10-22 10:35:26', NULL),
(485, 7, 0, 'Yangon', 1, '2024-10-22 10:35:26', NULL),
(486, 7, 0, 'Yekaterinburg', 1, '2024-10-22 10:35:26', NULL),
(487, 7, 0, 'Yerevan', 1, '2024-10-22 10:35:26', NULL),
(488, 7, 0, 'Yogyakarta', 1, '2024-10-22 10:35:26', NULL),
(489, 7, 0, 'Yokohama', 1, '2024-10-22 10:35:26', NULL),
(490, 7, 0, 'Yuzhno-Sakhalinsk', 1, '2024-10-22 10:35:26', NULL),
(491, 7, 0, 'Zhengzhou', 1, '2024-10-22 10:35:26', NULL),
(492, 7, 0, 'Zibo', 1, '2024-10-22 10:35:26', NULL),
(493, 8, 0, 'Abu Dhabi', 1, '2024-10-22 10:35:26', NULL),
(494, 8, 0, 'Aleppo', 1, '2024-10-22 10:35:26', NULL),
(495, 8, 0, 'Amman', 1, '2024-10-22 10:35:26', NULL),
(496, 8, 0, 'Baghdad', 1, '2024-10-22 10:35:26', NULL),
(497, 8, 0, 'Beirut', 1, '2024-10-22 10:35:26', NULL),
(498, 8, 0, 'Cairo', 1, '2024-10-22 10:35:26', NULL),
(499, 8, 0, 'Dahab', 1, '2024-10-22 10:35:26', NULL),
(500, 8, 0, 'Damascus', 1, '2024-10-22 10:35:26', NULL),
(501, 8, 0, 'Dhahran', 1, '2024-10-22 10:35:26', NULL),
(502, 8, 0, 'Dubai', 1, '2024-10-22 10:35:26', NULL),
(503, 8, 0, 'Gaza', 1, '2024-10-22 10:35:26', NULL),
(504, 8, 0, 'Haifa', 1, '2024-10-22 10:35:26', NULL),
(505, 8, 0, 'Istanbul', 1, '2024-10-22 10:35:26', NULL),
(506, 8, 0, 'Jerusalem', 1, '2024-10-22 10:35:26', NULL),
(507, 8, 0, 'Kuwait', 1, '2024-10-22 10:35:26', NULL),
(508, 8, 0, 'Mecca', 1, '2024-10-22 10:35:26', NULL),
(509, 8, 0, 'Nukus', 1, '2024-10-22 10:35:26', NULL),
(510, 8, 0, 'Riyadh', 1, '2024-10-22 10:35:26', NULL),
(511, 8, 0, 'Tehran', 1, '2024-10-22 10:35:26', NULL),
(512, 8, 0, 'Tel Aviv', 1, '2024-10-22 10:35:26', NULL),
(513, 9, 0, 'Abidjan', 1, '2024-10-22 10:35:26', NULL),
(514, 9, 0, 'Abuja', 1, '2024-10-22 10:35:26', NULL),
(515, 9, 0, 'Accra', 1, '2024-10-22 10:35:26', NULL),
(516, 9, 0, 'Addis Ababa', 1, '2024-10-22 10:35:26', NULL),
(517, 9, 0, 'Al Jizah', 1, '2024-10-22 10:35:26', NULL),
(518, 9, 0, 'Alexandria', 1, '2024-10-22 10:35:26', NULL),
(519, 9, 0, 'Algiers', 1, '2024-10-22 10:35:26', NULL),
(520, 9, 0, 'Antananarivo', 1, '2024-10-22 10:35:26', NULL),
(521, 9, 0, 'Asmara', 1, '2024-10-22 10:35:26', NULL),
(522, 9, 0, 'Bamako', 1, '2024-10-22 10:35:26', NULL),
(523, 9, 0, 'Bangui', 1, '2024-10-22 10:35:26', NULL),
(524, 9, 0, 'Banjul', 1, '2024-10-22 10:35:26', NULL),
(525, 9, 0, 'Bissau', 1, '2024-10-22 10:35:26', NULL),
(526, 9, 0, 'Brazzaville', 1, '2024-10-22 10:35:26', NULL),
(527, 9, 0, 'Bujumbura', 1, '2024-10-22 10:35:26', NULL),
(528, 9, 0, 'Cairo', 1, '2024-10-22 10:35:26', NULL),
(529, 9, 0, 'Cape Town', 1, '2024-10-22 10:35:26', NULL),
(530, 9, 0, 'Casablanca', 1, '2024-10-22 10:35:26', NULL),
(531, 9, 0, 'Conakry', 1, '2024-10-22 10:35:26', NULL),
(532, 9, 0, 'Dakar', 1, '2024-10-22 10:35:26', NULL),
(533, 9, 0, 'Dar es Salaam', 1, '2024-10-22 10:35:26', NULL),
(534, 9, 0, 'Djibouti', 1, '2024-10-22 10:35:26', NULL),
(535, 9, 0, 'Dodoma', 1, '2024-10-22 10:35:26', NULL),
(536, 9, 0, 'El Aaiún', 1, '2024-10-22 10:35:26', NULL),
(537, 9, 0, 'Freetown', 1, '2024-10-22 10:35:26', NULL),
(538, 9, 0, 'Gaborone', 1, '2024-10-22 10:35:26', NULL),
(539, 9, 0, 'Harare', 1, '2024-10-22 10:35:26', NULL),
(540, 9, 0, 'Jamestown', 1, '2024-10-22 10:35:26', NULL),
(541, 9, 0, 'Johannesburg', 1, '2024-10-22 10:35:26', NULL),
(542, 9, 0, 'Kampala', 1, '2024-10-22 10:35:26', NULL),
(543, 9, 0, 'Kano Nigeria', 1, '2024-10-22 10:35:26', NULL),
(544, 9, 0, 'Khartoum', 1, '2024-10-22 10:35:26', NULL),
(545, 9, 0, 'Kigali', 1, '2024-10-22 10:35:26', NULL),
(546, 9, 0, 'Kinshasa', 1, '2024-10-22 10:35:26', NULL),
(547, 9, 0, 'Lagos', 1, '2024-10-22 10:35:26', NULL),
(548, 9, 0, 'Libreville', 1, '2024-10-22 10:35:26', NULL),
(549, 9, 0, 'Lilongwe', 1, '2024-10-22 10:35:26', NULL),
(550, 9, 0, 'Lome', 1, '2024-10-22 10:35:26', NULL),
(551, 9, 0, 'Luanda', 1, '2024-10-22 10:35:26', NULL),
(552, 9, 0, 'Lubumbashi', 1, '2024-10-22 10:35:26', NULL),
(553, 9, 0, 'Lusaka', 1, '2024-10-22 10:35:26', NULL),
(554, 9, 0, 'Malabo', 1, '2024-10-22 10:35:26', NULL),
(555, 9, 0, 'Mamoutzou', 1, '2024-10-22 10:35:26', NULL),
(556, 9, 0, 'Maputo', 1, '2024-10-22 10:35:26', NULL),
(557, 9, 0, 'Maseru', 1, '2024-10-22 10:35:26', NULL),
(558, 9, 0, 'Mbabane', 1, '2024-10-22 10:35:26', NULL),
(559, 9, 0, 'Mogadishu', 1, '2024-10-22 10:35:26', NULL),
(560, 9, 0, 'Monrovia', 1, '2024-10-22 10:35:26', NULL),
(561, 9, 0, 'Moroni', 1, '2024-10-22 10:35:26', NULL),
(562, 9, 0, 'Nairobi', 1, '2024-10-22 10:35:26', NULL),
(563, 9, 0, 'Ndjamena', 1, '2024-10-22 10:35:26', NULL),
(564, 9, 0, 'Niamey', 1, '2024-10-22 10:35:26', NULL),
(565, 9, 0, 'Nouakchott', 1, '2024-10-22 10:35:26', NULL),
(566, 9, 0, 'Ouagadougou', 1, '2024-10-22 10:35:26', NULL),
(567, 9, 0, 'Port Louis', 1, '2024-10-22 10:35:26', NULL),
(568, 9, 0, 'Porto Novo', 1, '2024-10-22 10:35:26', NULL),
(569, 9, 0, 'Praia', 1, '2024-10-22 10:35:26', NULL),
(570, 9, 0, 'Pretoria', 1, '2024-10-22 10:35:26', NULL),
(571, 9, 0, 'Rabat', 1, '2024-10-22 10:35:26', NULL),
(572, 9, 0, 'Saint-Denis', 1, '2024-10-22 10:35:26', NULL),
(573, 9, 0, 'São Tomé', 1, '2024-10-22 10:35:26', NULL),
(574, 9, 0, 'Tanger', 1, '2024-10-22 10:35:26', NULL),
(575, 9, 0, 'Tripoli', 1, '2024-10-22 10:35:26', NULL),
(576, 9, 0, 'Tunis', 1, '2024-10-22 10:35:26', NULL),
(577, 9, 0, 'Victoria', 1, '2024-10-22 10:35:26', NULL),
(578, 9, 0, 'Windhoek', 1, '2024-10-22 10:35:26', NULL),
(579, 9, 0, 'Yamoussoukro', 1, '2024-10-22 10:35:26', NULL),
(580, 9, 0, 'Yaoundé', 1, '2024-10-22 10:35:26', NULL),
(581, 10, 0, 'Abaco', 1, '2024-10-22 10:35:26', NULL),
(582, 10, 0, 'Antigua', 1, '2024-10-22 10:35:26', NULL),
(583, 10, 0, 'Aruba', 1, '2024-10-22 10:35:26', NULL),
(584, 10, 0, 'Barbados', 1, '2024-10-22 10:35:26', NULL),
(585, 10, 0, 'Bermuda', 1, '2024-10-22 10:35:26', NULL),
(586, 10, 0, 'Bridgetown', 1, '2024-10-22 10:35:26', NULL),
(587, 10, 0, 'Fort de France', 1, '2024-10-22 10:35:26', NULL),
(588, 10, 0, 'Freeport', 1, '2024-10-22 10:35:26', NULL),
(589, 10, 0, 'George Town', 1, '2024-10-22 10:35:26', NULL),
(590, 10, 0, 'Grenada', 1, '2024-10-22 10:35:26', NULL),
(591, 10, 0, 'Hamilton', 1, '2024-10-22 10:35:26', NULL),
(592, 10, 0, 'Havana', 1, '2024-10-22 10:35:26', NULL),
(593, 10, 0, 'Kingston', 1, '2024-10-22 10:35:26', NULL),
(594, 10, 0, 'Montego Bay', 1, '2024-10-22 10:35:26', NULL),
(595, 10, 0, 'Nassau', 1, '2024-10-22 10:35:26', NULL),
(596, 10, 0, 'Nassau', 1, '2024-10-22 10:35:26', NULL),
(597, 10, 0, 'Negril', 1, '2024-10-22 10:35:26', NULL),
(598, 10, 0, 'Ocho Rios', 1, '2024-10-22 10:35:26', NULL),
(599, 10, 0, 'Paradise Island', 1, '2024-10-22 10:35:26', NULL),
(600, 10, 0, 'Pointe Pitre', 1, '2024-10-22 10:35:26', NULL),
(601, 10, 0, 'Ponce', 1, '2024-10-22 10:35:26', NULL),
(602, 10, 0, 'Port of Spain', 1, '2024-10-22 10:35:26', NULL),
(603, 10, 0, 'Port-au-Prince', 1, '2024-10-22 10:35:26', NULL),
(604, 10, 0, 'San Juan', 1, '2024-10-22 10:35:26', NULL),
(605, 10, 0, 'Santo Domingo', 1, '2024-10-22 10:35:26', NULL),
(606, 10, 0, 'St.Croix', 1, '2024-10-22 10:35:26', NULL),
(607, 10, 0, 'St.George', 1, '2024-10-22 10:35:26', NULL),
(608, 10, 0, 'St.Kitts', 1, '2024-10-22 10:35:26', NULL),
(609, 10, 0, 'St.Lucia', 1, '2024-10-22 10:35:26', NULL),
(610, 10, 0, 'St.Thomas', 1, '2024-10-22 10:35:26', NULL),
(611, 10, 0, 'Tortola', 1, '2024-10-22 10:35:26', NULL),
(612, 10, 0, 'Trinidad and Tobago', 1, '2024-10-22 10:35:26', NULL),
(613, 10, 0, 'Varadero', 1, '2024-10-22 10:35:26', NULL),
(614, 11, 0, 'Adamstown', 1, '2024-10-22 10:35:26', NULL),
(615, 11, 0, 'Alofi', 1, '2024-10-22 10:35:26', NULL),
(616, 11, 0, 'Apia', 1, '2024-10-22 10:35:26', NULL),
(617, 11, 0, 'Auckland', 1, '2024-10-22 10:35:26', NULL),
(618, 11, 0, 'Chatham Island', 1, '2024-10-22 10:35:26', NULL),
(619, 11, 0, 'Christchurch', 1, '2024-10-22 10:35:26', NULL),
(620, 11, 0, 'Funafuti', 1, '2024-10-22 10:35:26', NULL),
(621, 11, 0, 'Gambier Islands', 1, '2024-10-22 10:35:26', NULL),
(622, 11, 0, 'Honiara', 1, '2024-10-22 10:35:26', NULL),
(623, 11, 0, 'Kingston (Au)', 1, '2024-10-22 10:35:26', NULL),
(624, 11, 0, 'Kiritimati', 1, '2024-10-22 10:35:26', NULL),
(625, 11, 0, 'Kolonia', 1, '2024-10-22 10:35:26', NULL),
(626, 11, 0, 'Koror', 1, '2024-10-22 10:35:26', NULL),
(627, 11, 0, 'Lord Howe Island', 1, '2024-10-22 10:35:26', NULL),
(628, 11, 0, 'Majuro', 1, '2024-10-22 10:35:26', NULL),
(629, 11, 0, 'Makwa', 1, '2024-10-22 10:35:26', NULL),
(630, 11, 0, 'Mata-Utu', 1, '2024-10-22 10:35:26', NULL),
(631, 11, 0, 'Noumea', 1, '2024-10-22 10:35:26', NULL),
(632, 11, 0, 'Nukualofa', 1, '2024-10-22 10:35:26', NULL),
(633, 11, 0, 'Pago Pago', 1, '2024-10-22 10:35:26', NULL),
(634, 11, 0, 'Palikir', 1, '2024-10-22 10:35:26', NULL),
(635, 11, 0, 'Papeete', 1, '2024-10-22 10:35:26', NULL),
(636, 11, 0, 'Port Moresby', 1, '2024-10-22 10:35:26', NULL),
(637, 11, 0, 'Port Vila', 1, '2024-10-22 10:35:26', NULL),
(638, 11, 0, 'Rarotonga', 1, '2024-10-22 10:35:26', NULL),
(639, 11, 0, 'Rawaki', 1, '2024-10-22 10:35:26', NULL),
(640, 11, 0, 'Suva', 1, '2024-10-22 10:35:26', NULL),
(641, 11, 0, 'Taiohae', 1, '2024-10-22 10:35:26', NULL),
(642, 11, 0, 'Tarawa', 1, '2024-10-22 10:35:26', NULL),
(643, 11, 0, 'Wellington', 1, '2024-10-22 10:35:26', NULL),
(644, 12, 0, 'Arequipa', 1, '2024-10-22 10:35:26', NULL),
(645, 12, 0, 'Asuncion', 1, '2024-10-22 10:35:26', NULL),
(646, 12, 0, 'Barquisimeto', 1, '2024-10-22 10:35:26', NULL),
(647, 12, 0, 'Barranquilla', 1, '2024-10-22 10:35:26', NULL),
(648, 12, 0, 'Belém', 1, '2024-10-22 10:35:26', NULL),
(649, 12, 0, 'Belo Horizonte', 1, '2024-10-22 10:35:26', NULL),
(650, 12, 0, 'Boa Vista', 1, '2024-10-22 10:35:26', NULL),
(651, 12, 0, 'Bogota', 1, '2024-10-22 10:35:26', NULL),
(652, 12, 0, 'Brasilia', 1, '2024-10-22 10:35:26', NULL),
(653, 12, 0, 'Bucaramanga', 1, '2024-10-22 10:35:26', NULL),
(654, 12, 0, 'Buenos Aires', 1, '2024-10-22 10:35:26', NULL),
(655, 12, 0, 'Cali', 1, '2024-10-22 10:35:26', NULL),
(656, 12, 0, 'Campinas', 1, '2024-10-22 10:35:26', NULL),
(657, 12, 0, 'Caracas', 1, '2024-10-22 10:35:26', NULL),
(658, 12, 0, 'Cartagena', 1, '2024-10-22 10:35:26', NULL),
(659, 12, 0, 'Cayenne', 1, '2024-10-22 10:35:26', NULL),
(660, 12, 0, 'Córdoba', 1, '2024-10-22 10:35:26', NULL),
(661, 12, 0, 'Cúcuta', 1, '2024-10-22 10:35:26', NULL),
(662, 12, 0, 'Curitiba', 1, '2024-10-22 10:35:26', NULL),
(663, 12, 0, 'Easter Island', 1, '2024-10-22 10:35:26', NULL),
(664, 12, 0, 'Fernando de Noronha', 1, '2024-10-22 10:35:26', NULL),
(665, 12, 0, 'Fortaleza', 1, '2024-10-22 10:35:26', NULL),
(666, 12, 0, 'Galapagos Islands', 1, '2024-10-22 10:35:26', NULL),
(667, 12, 0, 'Georgetown', 1, '2024-10-22 10:35:26', NULL),
(668, 12, 0, 'Goiânia', 1, '2024-10-22 10:35:26', NULL),
(669, 12, 0, 'Guayaquil', 1, '2024-10-22 10:35:26', NULL),
(670, 12, 0, 'La Paz', 1, '2024-10-22 10:35:26', NULL),
(671, 12, 0, 'La Plata', 1, '2024-10-22 10:35:26', NULL),
(672, 12, 0, 'Lima', 1, '2024-10-22 10:35:26', NULL),
(673, 12, 0, 'Maceió', 1, '2024-10-22 10:35:26', NULL),
(674, 12, 0, 'Manaus', 1, '2024-10-22 10:35:26', NULL),
(675, 12, 0, 'Manizales', 1, '2024-10-22 10:35:26', NULL),
(676, 12, 0, 'Mar del Plata', 1, '2024-10-22 10:35:26', NULL),
(677, 12, 0, 'Maracaibo', 1, '2024-10-22 10:35:26', NULL),
(678, 12, 0, 'Maracay', 1, '2024-10-22 10:35:26', NULL),
(679, 12, 0, 'Medellin', 1, '2024-10-22 10:35:26', NULL),
(680, 12, 0, 'Mendoza', 1, '2024-10-22 10:35:26', NULL),
(681, 12, 0, 'Montevideo', 1, '2024-10-22 10:35:26', NULL),
(682, 12, 0, 'Natal', 1, '2024-10-22 10:35:26', NULL),
(683, 12, 0, 'Niterói', 1, '2024-10-22 10:35:26', NULL),
(684, 12, 0, 'Oranjestad', 1, '2024-10-22 10:35:26', NULL),
(685, 12, 0, 'Paramaribo', 1, '2024-10-22 10:35:26', NULL),
(686, 12, 0, 'Port of Spain', 1, '2024-10-22 10:35:26', NULL),
(687, 12, 0, 'Porto Alegre', 1, '2024-10-22 10:35:26', NULL),
(688, 12, 0, 'Pôrto Velho', 1, '2024-10-22 10:35:26', NULL),
(689, 12, 0, 'Quito', 1, '2024-10-22 10:35:26', NULL),
(690, 12, 0, 'Recife', 1, '2024-10-22 10:35:26', NULL),
(691, 12, 0, 'Rio Branco', 1, '2024-10-22 10:35:26', NULL),
(692, 12, 0, 'Rio de Janeiro', 1, '2024-10-22 10:35:26', NULL),
(693, 12, 0, 'Rosario', 1, '2024-10-22 10:35:26', NULL),
(694, 12, 0, 'Salta', 1, '2024-10-22 10:35:26', NULL),
(695, 12, 0, 'Salvador', 1, '2024-10-22 10:35:26', NULL),
(696, 12, 0, 'Santa Cruz', 1, '2024-10-22 10:35:26', NULL),
(697, 12, 0, 'Santa Fe', 1, '2024-10-22 10:35:26', NULL),
(698, 12, 0, 'Santiago', 1, '2024-10-22 10:35:26', NULL),
(699, 12, 0, 'Santos', 1, '2024-10-22 10:35:26', NULL),
(700, 12, 0, 'Sao Paulo', 1, '2024-10-22 10:35:26', NULL),
(701, 12, 0, 'Stanley', 1, '2024-10-22 10:35:26', NULL),
(702, 12, 0, 'Tucumán', 1, '2024-10-22 10:35:26', NULL),
(703, 12, 0, 'Valencia', 1, '2024-10-22 10:35:26', NULL),
(704, 12, 0, 'Valparaíso', 1, '2024-10-22 10:35:26', NULL),
(705, 12, 0, 'Vitória', 1, '2024-10-22 10:35:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `CMSID` int(11) NOT NULL,
  `PageID` int(11) NOT NULL,
  `Content` text NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`CMSID`, `PageID`, `Content`, `Status`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `created_at`, `updated_at`) VALUES
(1, 2, '<p><span style=\"font-family: \'comic sans ms\', sans-serif;\">Hello Testing</span></p>', 1, 1, '2017-09-14 12:13:17', 1, '2018-01-31 17:39:01', '2024-10-07 23:42:53', NULL),
(2, 1, '<div class=\"contain\" style=\"font-family: \'Open Sans\', sans-serif; margin:0px;padding: 20px;font-size: 14px;text-align: justify;\">\r\n<h2 style=\"margin:0 0 20px 0;font-size: 24px\">FAQ</h2>\r\n<strong>In no particular order:</strong>\r\n<h4 style=\"margin-bottom: 0\">1.What is an OTP code?</h4>\r\n<p>It is a One-Time Password used by the app to help you sign in for the first time during the sign up process. The OTP code is sent to the email address you have provided. You must enter this code as part of the sign up validation process. You should check junk mail or spam in case your OTP code is delivered there.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">2.Why can’t I download Cajigo?</h4>\r\n<p>Please check that your operating system is compatible with running the Cajigo App. You will need a minimum memory of 50MB. Also, be sure to check that your device is not set to private browsing mode. Please also check your Internet connection.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">3.Why should I register as a ‘Candidate’ or a ‘Company’?</h4>\r\n<p>Sign up as a ‘Candidate’ if you are looking to develop your career (through mentoring) OR if you are a jobseeker OR if you are looking to create your CV. ‘Company’ sign up is for employers and recruiters only. You cannot register for both.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">4.What if I can’t see any jobs?</h4>\r\n<p>If your mentioned skills do not match the posted job criteria, then the Job search section will be blank. Go to the filter icon on the top right of the Jobs screen to specify different search options.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">5.How do I contact Structur3dpeople? (The app developer)</h4>\r\n<p>You can get in touch with us by sending an email to team@cajigo.com</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">6.How do I make contact, if I require any support using the app?</h4>\r\n<p>Most of the information is mentioned in this FAQ. There are ? icons throughout the app to help you. However, if any further support is required, you can contact us at support@cajigo.com</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">7.How do I upload my profile picture?</h4>\r\n<p>There is an edit icon on the Profile screen, around the image frame. Click on this and follow the instructions.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">8.How do I amend/change my Basic details?</h4>\r\n<p>There is an edit icon on the Profile screen next to your name. Click this and it will take you to the Basic details screen. Amend as required and click save.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">9.Why should I select a status for my Profile?</h4>\r\n<p>If a company wants to contact you, we thought this would be a good way of letting them know your status, they can contact you at a time that is convenient for you. </p>\r\n\r\n<h4 style=\"margin-bottom: 0\">10.What is the Mentors section?</h4>\r\n<p>This section contains mentor videos that can be viewed. Each mentor provides different advice, guidance and support to help develop your skills. </p>\r\n\r\n<h4 style=\"margin-bottom: 0\">11.Are the videos free?</h4>\r\n<p>Some of the videos are free and some of them must be paid for before viewing. Each video will state if a payment will need to be made to view it.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">12.Why should I pay for the videos?</h4>\r\n<p>The videos provide valuable learning experiences and are presented by senior industry leaders who become your Mentors. By sharing their own experiences, the Mentors provide invaluable industry knowledge that will guide and support you with actionable results. </p>\r\n\r\n<h4 style=\"margin-bottom: 0\">13.I purchased a video but cannot watch it?</h4>\r\n<p>Check your internet connection and device settings. If you are trying to watch the video using mobile data, check your data usage is okay.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">14.Does this app help me create a CV?</h4>\r\n<p>Yes, once you have completed the details in the Profile screen, there is a section at the very end saying “CV Builder”. </p>\r\n\r\n<h4 style=\"margin-bottom: 0\">15.How do I build my CV?</h4>\r\n<p>Click on the edit icon on the CV Builder section. On the new page, you will see three templates, select the template you wish to use. Your details will then be populated into this template. Once you have selected the template and paid the one off charge, your CV will be ready to download or email with the selected template, in a pdf format. You can change the style of template at any time. </p>\r\n\r\n<h4 style=\"margin-bottom: 0\">16.How do I view my CV?</h4>\r\n<p>Click on the .pdf file below Build my CV heading. This will open the CV you have created earlier. </p>\r\n\r\n<h4 style=\"margin-bottom: 0\">17.Why is there a charge for building my CV?</h4>\r\n<p>We have made it easier for you to create a CV by auto populating a template. \r\nThe features in the templates are nicely aligned where your Profile captures key details required by employers when applying for jobs.\r\nOnce the CV is built, it can be readily emailed to your own personal email address and shared. The off charge allows you to use all three templates, so you can change the style of your CV at any time. </p>\r\n\r\n<h4 style=\"margin-bottom: 0\">18.Can I short list or save jobs posted by Companies?</h4>\r\n<p>Yes. Once you have found a job of interest, the blank star icon on the right of the job posting can be clicked. This will turn the star icon to blue and the job will be saved on your home screen under ‘My Saved Jobs’.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">19.Do I get Job Recommendations through the app?</h4>\r\n<p>Yes. Once you have populated your Profile screen sections, all matching criteria jobs will be sent as push notifications and will appear on your Home screen under the RECOMMENDED JOBS (NEW) section.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">20.Can I follow any particular Company?</h4>\r\n<p>Yes. You can follow and unfollow any company who has posted jobs through the app. To do this, go to the job posted by the company you want to follow, within this screen, there will be a FOLLOW or UNFOLLOW button.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">21.How do I find out if my Profile has been viewed by a company?</h4>\r\n<p>On your Home screen, in the top section, there is a live field “Profile Viewed By Companies”. Click on this text and it will show you all the companies that have viewed your profile.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">22.Is there a way to see company details for the job posted/searched?</h4>\r\n<p>Yes. If you click on the job post / search, this will open the detailed section of job specifications and other details mentioned by the company who posted the job. Now click on the company name and this will show you the company profile with contact details.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">23.How does the interview process work after I have applied for a job?</h4>\r\n<p>Once you have applied for a job, the relevant company will receive a notification for this. They will contact you, if your profile is of interest for the vacancy listed. If they would like to interview you, they will then send you an interview notification with a time and date. This will appear on the Home screen under the ‘My Interviews’ section. You will be given the option to accept or reject the interview here. Once the interview process is completed, the company will inform you of the outcome directly, or as agreed by either of the parties in the interview, not through the app. The App will ask the hiring Company to confirm the status of the interview for record purposes only.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">24.What are notifications?</h4>\r\n<p>By turning the push notifications “ON”, you will get notifications for new jobs, interview invites and much more information on the go, without having to launch the app every time. This is particularly helpful if you are actively looking for updates from the app.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">25.What if I forget my password?</h4>\r\n<p>When you launch the app, if you forget your password, input your registered email address and click forgot password. This will send instructions to reset your password to the email address you have given.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">26.Can I change my password?</h4>\r\n<p>Go to Settings > Change Password. You will be redirected to another screen, follow the instructions to create a new password.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">27.How will my personal details be used / shared?</h4>\r\n<p>We have a comprehensive Terms & Conditions and Privacy Policy. You can find this under the settings page.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">28.How do I delete my account?</h4>\r\n<p>You can go to Settings > Delete Account. Follow the instructions to delete your account. Please read the Privacy Policy for what happens after you have deleted your account.</p>\r\n\r\n<h4 style=\"margin-bottom: 0\">29.How do I refer this app to my friend/s?</h4>\r\n<p>If you go to Settings > Refer Friends, you will be asked how you would like to share this app. Choose a method and the app will do the rest for you. </p>\r\n</div>', 1, 1, '2017-09-14 12:30:13', 1, '2017-09-16 10:39:06', '2024-10-07 23:42:53', NULL),
(3, 3, '<div class=\"contain\" style=\"font-family: \'Open Sans\', sans-serif; margin:0px;padding: 20px;font-size: 14px;text-align: justify;\">\n	<h2 style=\"margin:0 0 20px 0;font-size: 24px\">About Us</h2>\n	<p><b>Cajigo stands for Careers and Jobs on the Go.</b></p>\n	<p style=\"margin:10px 0 0 0\">It has been developed by Structur3dpeople, a tech recruiter and diversity specialist to help close the gender gap in the tech industry.</p>\n	<p style=\"margin:10px 0 0 0\">Structur3dpeople is committed to helping more women gain the skills they need right now through training and mentoring programmes. By helping candidates realise their full potential, Cajigo aims to make women more visible to employers connecting them to careers in the tech industry where they can excel.</p><br>\n	<p><b>For Women</b></p>\n	<p style=\"margin:10px 0 0 0\">We believe that women everywhere should have access to a mentor to gain knowledge and skills for personal and professional development. Cajigo aims to help women</p>\n	<ul style=\"\">\n		<li>interested in a tech career</li>\n		<li>on a career break, looking to build up skills and confidence to return back into work</li>\n		<li>looking to progress into leadership</li>\n		<li>in need of guidance and support to help reach their aspirations and goals</li>\n	</ul>\n	<p><b>For Employers</b></p>\n	<p style=\"margin:10px 0 0 0\">We aim to assist companies who would like to grow and develop their female workforce. Cajigo provides actionable, measurable progress, providing senior level executives with transparency on diversity efforts</p>\n</div>', 1, 1, '2017-09-14 12:30:42', 1, '2017-11-29 16:31:13', '2024-10-07 23:42:53', NULL),
(5, 5, '<div class=\"contain\" style=\"font-family: \'Open Sans\', sans-serif; margin:0px;padding: 20px;font-size: 14px;text-align: justify;\">\n	<h2 style=\"margin:0 0 20px 0;font-size: 24px\">Privacy Policy</h2>\n	<u>1.Who we Are</u>\n	<p style=\"margin:10px 0 0 0\">Cajigo ‘the App’ is owned by Indigo RM Limited trading as Structur3dpeople and Cajigo. Indigo RM Limited is registered in the UK under company registration no. 9115722, whose registered office address is Redwood House, 65 Bristol Rd, Keynsham BS31 2WB. Any references to ‘Cajigo’, ‘the App’ ‘we’ ‘our’ or ‘us’ in this Privacy Policy also includes reference to Structur3dpeople and Indigo RM Limited and its sites. Reference to ‘Sites ‘Site’ ’sites’ or ‘site’ in this Privacy Policy and our Terms and Conditions means other applications, websites or materials belonging to Indigo RM Limited.</p><br>\n\n	<u>1.1 How we refer to users of the App</u>\n	<p style=\"margin:10px 0 0 0\">&quot;you&quot; or “You” means the person firm company or organisation using the App, and &quot;your&quot; or “Your” shall be construed accordingly.</p>\n	<p style=\"margin:5px 0 0 0\">“Candidate” “Mentee” or “Job Candidate” means an individual person using the App for their own personal career development and/or exploring or applying for job opportunities.</p>\n	<p style=\"margin:5px 0 0 0\">“Employer Customer” or “employer customer” means a commercial client searching for a job candidate or posting a job for job candidates to contact them through the App.</p>\n	<p style=\"margin:5px 0 0 0\">“CV” means Curriculum Vitae and includes your personal profile or CV Builder on the App.</p><br>\n\n	<u>2.Your Privacy Rights and Deletion of App</u>\n	<p style=\"margin:10px 0 0 0\">2.1 Cajigo takes the privacy of its users seriously. This Privacy Policy explains how we collect and use online data.</p>\n	<p style=\"margin:5px 0 0 0\">2.2 By using the App and any of its sites, you agree to the collection, use and transfer of your personal data as set out in this Privacy Policy.</p>\n	<p style=\"margin:5px 0 0 0\">2.3 You are under no obligation to use the App. If you do not want to have your information to be collected, used and transferred, you may revoke your consent to our Privacy Policy whenever you wish to do so, or simply not register to use the App. To revoke your consent go to Settings &gt; Delete Account. Once the account is deleted, the personal data will be kept for 7 days on the current database. However, from a backed-up database, the details will be removed within 28 days from the account being deleted.</p>\n	<p style=\"margin:5px 0 0 0\">2.4 If you revoke your consent or delete the App, your account and profile information and any in App purchases you have made will be removed from our systems. Users will have to create a new account from the sign-up page to start again. If you delete the App in error it is your responsibility to inform us as soon as possible but we cannot guarantee your information will be retrieved.</p>\n	<p style=\"margin:5px 0 0 0\">2.5 Your information and data from the App is stored and backed up in the UK by our third-party software provider.</p><br>\n\n	<u>3. Scope of this Privacy Policy</u>\n	<p style=\"margin:10px 0 0 0\">3.1 This privacy policy is intended for users of the App including job candidates and employer customers.</p>\n	<p style=\"margin:5px 0 0 0\">3.2 This policy applies to information that we collect or use on the App and where relevant to sites owned or controlled by Indigo RM Limited and any of its affiliated businesses. Affiliated companies are those that control or are controlled by or under the common control of Indigo RM Limited.</p>\n	<p style=\"margin:5px 0 0 0\">3.3 Where we link you to other websites over which we have no control, we strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit. We are not responsible for the privacy policies terms and conditions or practices of other websites. </p><br>\n\n	<u>4. How we use your information</u>\n	<p style=\"margin:10px 0 0 0\">4.1 We use information that is necessary to provide our services, to respond to you, improve our services for the App and our sites and to try and provide you with a meaningful and useful user experience.</p>\n	<p style=\"margin:5px 0 0 0\">4.2 By accepting our Terms and Conditions and Privacy Policy and by registering your information on the App and managing your profile and settings and opting to provide information when given a choice to do so or not you have consented for us to use your information as follows:</p>\n	<p style=\"margin:5px 0 0 0\">i) to create your personal profile based on the information which you have provided and entered, has been collected or has been imported from other sites or applications such as Facebook, Twitter or other social media sites</p>\n	<p style=\"margin:5px 0 0 0\">ii) to provide you personalised, location-based content, services and advertising from us and third parties</p>\n	<p style=\"margin:5px 0 0 0\">iii) to allow you to contact other users as permitted by us</p>\n	<p style=\"margin:5px 0 0 0\">iv) to allow you to create your Curriculum Vitae (CV) and other information about yourself</p>\n	<p style=\"margin:5px 0 0 0\">v) to make in App purchases</p>\n	<p style=\"margin:5px 0 0 0\">vi) to make purchases through PayPal, invoicing or billing as a one off or as part of an ongoing payment cycle</p>\n	<p style=\"margin:5px 0 0 0\">vii) to get in touch with you about new updates, features and other information </p>\n	<p style=\"margin:5px 0 0 0\">viii) to provide you with information and communications such as emails, video content and careers information</p>\n	<p style=\"margin:5px 0 0 0\">ix) to provide you with information about any of our other services</p>\n	<p style=\"margin:5px 0 0 0\">x) to allow you to contact us and for us to respond to you</p>\n	<p style=\"margin:5px 0 0 0\">xi) to provide information about you to registered users</p>\n	<p style=\"margin:5px 0 0 0\">xii) to provide information about you as an employer customer to potential candidates </p>\n	<p style=\"margin:5px 0 0 0\">xiii) to provide you with advertisements from third parties</p>\n	<p style=\"margin:5px 0 0 0\">xiv) to allow us to upload and share video content </p>\n	<p style=\"margin:5px 0 0 0\">xv) to enable employer customers using the App to find your profile and contact you</p>\n	<p style=\"margin:5px 0 0 0\">xvi) to provide information about you and your potential availability or interest in job board postings to employer customers using the App</p>\n	<p style=\"margin:5px 0 0 0\">xvii) to provide notifications or push notifications about new job postings</p>\n	<p style=\"margin:5px 0 0 0\">xviii) to enable us to provide support and products to employer customers to aide them in their recruitment process</p>\n	<p style=\"margin:5px 0 0 0\">xix) to enable employer customers using the App to view and compare candidate profiles, post information and to network with jobseekers </p>\n	<p style=\"margin:5px 0 0 0\">xx) to allow generation of internal reports for employer customers using the App</p>\n	<p style=\"margin:5px 0 0 0\">xxi) to enable us to generate materials and reports about trends from the App use </p>\n	<p style=\"margin:5px 0 0 0\">xxii) to allow you to share information about the App and about jobs with your connections to make them aware of the App and promote its use</p>\n	<p style=\"margin:5px 0 0 0\">xxiii) to allow you to share profile information with employer customers using the App</p>\n	<p style=\"margin:5px 0 0 0\">xxiv) to give access to public information via search engines</p>\n	<p style=\"margin:5px 0 0 0\">xxv) to detect, investigate and prevent activities that are illegal or not in line with our usage policies</p>\n	<p style=\"margin:5px 0 0 0\">4.3 Our services, such as our candidate personal profile builder, and CV builder, job applications and job adverts will enable third parties to see your personal information and to contact you if they are authorised to do so in the App.</p>\n	<p style=\"margin:5px 0 0 0\">4.4 Information that you provide whether directly or indirectly to us or third parties could be accessed, used, and stored outside of the European Economic Area. This may include storage of information in countries that might not have the same level of legislation and protection of personal information as in the UK. While we take steps to safeguard your information from unauthorized access or inappropriate use, we do not have any control over third parties and we are not responsible for their use or the protection of your information once you give it to them or they gain access to it. </p>\n	<p style=\"margin:5px 0 0 0\">4.5 If you are not completely happy to do so, you should not post sensitive information, personal or personality profiles, or any other information you would not want made public, onto the App or to a public website. </p>\n	<p style=\"margin:5px 0 0 0\">4.6 Our services include informing you of products, content, and advertising that we believe you may be interested in. We use the data we have about you to determine whether you might be interested in the opportunities, products or services of a third party. We show you advertisements online which may be targeted based on information we collect from you.</p><br>\n\n	<u>5 What Information do we collect?</u>\n	<p style=\"margin:5px 0 0 0\">5.1 We collect information that is necessary for the App to be used effectively</p>\n	<p style=\"margin:5px 0 0 0\">5.2 We need to collect information directly from you such as your contact details including email and phone number, CV and user profile and personal profile builder. We receive and store this information when you enter it on the App or our sites or provide it to us in any other way. Examples of what information we may collect depending on whether you are a candidate or employer customer includes:</p>\n	<p style=\"margin:5px 0 0 0\">i) Your age group, gender, ethnicity, but only if you decide to provide it. The App may not allow you to progress to all screens or get the most out of its benefits and features if you decide not to provide some of the information but you are free to decide whether you wish to do so or not; </p>\n	<p style=\"margin:5px 0 0 0\">ii) Payment information for subscription or invoiced services, this may include billing information, credit card etc. for in App purchases;</p>\n	<p style=\"margin:5px 0 0 0\">iii) Information imported or created by you such as your CV on the profile builder, video content and connections from third party applications.</p>\n	<p style=\"margin:5px 0 0 0\">5.3 We may also collect information about you automatically about how you use the App or our sites, the areas of the App or site that you visit and information about your mobile device or computer which includes your IP address, location, browser, operating system and URLs. We use this information to provide you with more personalised and location specific content as well as for analysing information, trying to fix problems, preventing fraud, improving and supporting our services to you. We may combine this information with information in your App profile to help prevent fraud.</p>\n	<p style=\"margin:5px 0 0 0\">5.4 We may receive confirmations when you open the App or emails from us or you if your mobile device permits.</p>\n	<p style=\"margin:5px 0 0 0\">5.5 If you choose to sign in with Facebook, Twitter, LinkedIn or similar sites, we import the requested mandatory information only, from your account and make it part of your profile.  The App is intended to allow you to share your information and to allow others to contact you subject to your own chosen privacy settings. If you post or provide information on another user’s site or other site’s post, public availability of your information will be subject to the other user’s privacy settings which we have no control over. </p><br>\n\n	<u>6 How We Share Information</u>\n	<p style=\"margin:5px 0 0 0\">6.1 The App provides you with the opportunities to offer information about yourself to help develop careers through mentoring as a mentee, applying for jobs and advertising job opportunities.</p>\n	<p style=\"margin:5px 0 0 0\">6.2 We must share your information with third parties to deliver our products and services to you. This includes third party hosting on web servers, including CV database and personal profile storage, analysis of data, providing us with necessary information, processing credit card or other types of payments, and providing customer service and technical support. These companies will have access to your personal information as necessary to perform their functions, but they may not use that data for any other purpose.</p>\n	<p style=\"margin:5px 0 0 0\">6.3 We may disclose information to third parties if you consent. For example, by leaving push notifications ‘on’ in your App Settings, personal data can be shared with potential employers.</p>\n	<p style=\"margin:5px 0 0 0\">6.4 If you make your CV and personal profile searchable or if we collect information you have made available on a public website then all parties with access to your CV or personal profiling will have access to your information; we have no control over your information made available by you on a public website.</p>\n	<p style=\"margin:5px 0 0 0\">6.5 For you to receive information about job opportunities, products, or services of third parties, we supply your contact information to those third parties, so they may contact you.</p>\n	<p style=\"margin:5px 0 0 0\">6.6 By applying for a posted job from an employer customer, providing your contact information to show your interest in a job, or by replying to a message from an employer customer, you consent to the disclosure of your information to that employer customer.</p>\n	<p style=\"margin:5px 0 0 0\">6.7 One of the services of the App is to provide new product offerings that could benefit you. We share aggregated information (including location data) about App users with third parties to show these offerings to you on the App. If you do not wish to receive these offerings in this way you should not use the App.  </p>\n	<p style=\"margin:5px 0 0 0\">6.8 We may also aggregate candidate data such as qualifications, age group, experience level or other information you have provided. This aggregated data does not identify you individually and may be made available to prospective employer customers. </p>\n	<p style=\"margin:5px 0 0 0\">6.9 We must disclose information if legally required to do so or such action is necessary to meet legal requirements or comply with legal process; protect our rights or property or our affiliated companies; prevent a crime or protect national security; protect the personal safety of users or the public.</p>\n	<p style=\"margin:5px 0 0 0\">6.10. We may disclose and transfer information to a third party who acquires any or all of Indigo RM’s business whether such acquisition is by way of merger, consolidation or purchase of all or a substantial portion of the business. In addition, in the event Indigo RM becomes the subject of an insolvency proceeding, such information will be disposed of in a transaction approved by the court. You will be notified of the sale of all or a substantial portion of our business to a third party by email or through a prominent notice posted on one of our sites or the App.</p><br>\n\n	<u>7. Information contained in Your CV, Personal Profile or other formats   </u>\n	<p style=\"margin:5px 0 0 0\">7.1 You are responsible to ensure that the information you upload or provide is correct, accurate and not false. We are not responsible for ensuring the accuracy or correctness of any CV, your personal and personal profile information to you or to a prospective employer.   </p>\n	<p style=\"margin:5px 0 0 0\">7.2 When you build your CV from our provided templates or profile summary, we store it in our database in the United Kingdom. We cannot control the retention, use or privacy of CVs that have been viewed or downloaded by others through the App or otherwise. If you decide NOT to give access to your CV or other details to employer customers or save it to the database, you will still have access to the mentoring videos.</p>\n	<p style=\"margin:5px 0 0 0\">7.3 We attempt to limit access to our CV and profile database to employer customers but cannot guarantee that other parties will not gain access to this database. We cannot control the use of CVs by third parties who access the database. Once your CV has been disclosed, we cannot retrieve it from the third parties who accessed it.</p>\n	<p style=\"margin:5px 0 0 0\">7.4 You may remove your CV and profile from our database at any time. Anyone who viewed your CV or profile may have kept a copy of it in their own files or databases. Accordingly, you should not put sensitive information, personality profiles, or other information you would not want made public, in your CV or profile unless you are happy to provide such information.</p>\n	<p style=\"margin:5px 0 0 0\">7.5 If you provide details of a Referee into the App, it is your responsibility to ensure that the person is aware that you have forwarded his/her details and has consented in writing for you to do so.</p>\n	<p style=\"margin:5px 0 0 0\">7.6 CVs or profiles that you may give to us by uploaded forms emails or other methods should not contain sensitive data relating to your (a) racial or ethnic origin (b) political beliefs (c) philosophical or religious beliefs (d) membership of a trade union or political party (e) physical or mental health or biometric details or genetic makeup (f) addictions, sexual life (g) the commission of criminal offences or proceedings and associated penalties or fines, (h) the commission of any unlawful or objectionable conduct and associated penalties, (i) any Social Security Number or other national identification number (j) bank account or other financial details. If your CV or a profile given to us does contain this information, then you agree that it is at your own risk. We cannot control third parties’ access to such information from our database.</p><br>\n\n	<u>8. How We Store Information </u>\n	<p style=\"margin:5px 0 0 0\">8.1 Your information and data from the App and our sites is stored and backed up in the UK by our third-party software provider.</p>\n	<p style=\"margin:5px 0 0 0\">8.2 We retain your personal information until you change or remove it. You may access, review, correct, update, change or delete your profile at any time by signing in to your account and make the desired changes.</p>\n	<p style=\"margin:5px 0 0 0\">8.3 Access to, correction, update, or deletion of your personal information may be denied or limited by us if it infringes another person’s rights and/or as otherwise permitted by applicable law. </p>\n	<p style=\"margin:5px 0 0 0\">8.4 If you wish to delete your account information altogether, please delete the App. We may retain and archive a record of this purely for regulatory or audit purposes.</p>\n	<p style=\"margin:5px 0 0 0\">8.5 We will respond to information access requests made in writing to us within 30 days of receipt. We may ask you to pay a reasonable administrative fee where permitted in accordance with guidance available from the UK Information Commissioners Office.  We may also ask you to pay a reasonable fee if providing further copies of the same information. If we require additional time to provide access to your information, we will acknowledge receipt of your request within 30 days explaining why an extension is necessary and make best efforts to provide you with the information within a time-period which would be accepted by the UK Information Commissioner.</p>\n	<p style=\"margin:5px 0 0 0\">8.6 If you do not sign in to your account or interact with our services for a significant period as a candidate, then, based on guidance with the UK Information Commissioner, your account will be removed from our database. We will attempt to inform you before removing your details but if we are not able to contact you we will still remove your account.</p><br>\n\n	<u>9. Security</u>\n	<p style=\"margin:5px 0 0 0\">9.1 You are solely responsible for keeping your username and password secret. You should not share this information. We will not contact you by email or telephone asking you for your password, credit card, banking or other similar private information. </p>\n	<p style=\"margin:5px 0 0 0\">9.2 We take measures to try to secure your personal information from accidental loss and from unauthorised access, use, alteration or disclosure. We cannot guarantee that unauthorised third parties will never be able to bypass these measures or use your personal information. </p>\n	<p style=\"margin:5px 0 0 0\">9.3 Your CVs and profiles will be viewed by employer customers and you should be aware that this could include your current employer. We cannot be held responsible for any action against you by current employers.</p>\n	<p style=\"margin:5px 0 0 0\">9.4 The App is not intended for use by children under the age of 16.</p><br>\n\n	<u>10. Changes to Privacy Policy</u>\n	<p style=\"margin:5px 0 0 0\">From time to time we may be required to make material changes to this Privacy Policy or any part of the App which will require you to update the App. It will be user’s responsibility to update the App and we will take NO responsibility, if the App is not updated.</p><br>\n\n	<u>Contact Information</u>\n	<p style=\"margin:5px 0 0 0\">Your data is submitted to Herriot Design Studio Ltd., a company registered in England and who are based in the UK and is hosted and stored in a database on servers situated in the United Kingdom.</p>\n	<p style=\"margin:5px 0 0 0\">If, at any time, you have questions or concerns about this Privacy Policy, please contact us through the App, or by post to:</p>\n	<p style=\"margin:5px 0 0 0\">The Data Protection Officer</p>\n	<p style=\"margin:5px 0 0 0\">Indigo RM Limited</p>\n	<p style=\"margin:5px 0 0 0\">Redwood House, 65 Bristol Rd, Keynsham BS31 2WB</p>\n	<p style=\"margin:5px 0 0 0\">January 2018</p><br>\n\n	<h2 style=\"margin:0 0 20px 0;font-size: 24px\">Cookie Policy</h2>\n	<p style=\"margin:5px 0 0 0\">We use \"cookies\" to help personalize improve and maximize your Cajigo App experience, including for storing user preferences, improving search results and advertisement selection, and tracking user trends. A cookie is a text file stored on your computer or mobile device. Cookies store bits of information that we use to help make our site work. </p>\n	<p style=\"margin:5px 0 0 0\">We use the following types of cookies:</p>\n	<p style=\"margin:5px 0 0 0\">Security: These cookies allow us to secure access to your account.</p>\n	<p style=\"margin:5px 0 0 0\">Analytics: We track traffic patterns, so we can identify popular content and potential problems.</p>\n	<p style=\"margin:5px 0 0 0\">Features: We track which jobs you search for, view, and apply to, so we can show you more similar jobs. We might also use cookies to split some users into test groups to test new features.</p>\n	<p style=\"margin:5px 0 0 0\">Advertising: We don’t use any of your personal information to show you advertising.</p>\n	<p style=\"margin:5px 0 0 0\">Some cookies will remain on your device after you have left our site. Users can adjust these settings from their mobile devices. </p>\n	<p style=\"margin:5px 0 0 0\">We also allow other companies to display advertisements to you while you are using our sites and applications. We have no control over, and are not responsible for, the practices of those third-party advertisers. The data stored in these cookies is anonymous and the information is not linked to your personally identifiable information without your permission. </p>\n	<p style=\"margin:5px 0 0 0\">Please note if you delete your browser cookies, your opt-out cookie will also be deleted. Additionally, if you change your mobile device, you will need to opt out again.</p><br>\n\n	<p style=\"margin:5px 0 0 0\"><b>Social Media and Content Sharing</b></p>\n	<p style=\"margin:5px 0 0 0\">Social Media Widgets: Our site includes social media features, such as the Facebook Like button and widgets such as the Refer this App. This feature may collect your device details and the page on our site you are visiting and may set a cookie to enable the feature to function properly. Social media features are either hosted by a third party or hosted directly on our Site. </p>\n	<p style=\"margin:5px 0 0 0\">Referrals: If you choose to use our service to share site content with a friend, we may capture some information of your friend. We will automatically send your friend a one-time invitation to visit and install the App. We temporarily store this information for the sole purpose of sending this one-time communication.</p>\n</div>', 1, 1, '2017-11-01 14:59:13', 1, '2017-11-01 14:59:25', '2024-10-07 23:42:53', NULL);
INSERT INTO `cms` (`CMSID`, `PageID`, `Content`, `Status`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `created_at`, `updated_at`) VALUES
(7, 4, '<div class=\"contain\" style=\"font-family: \'Open Sans\', sans-serif; margin:0px;padding: 20px;font-size: 14px;text-align: justify;\">\n	<h2 style=\"margin:0 0 20px 0;font-size: 24px\">Terms and Conditions of Use</h2>\n	<u>1. Who we Are</u>\n	<p style=\"margin:10px 0 0 0\">1.1 Cajigo “the App” is owned by Indigo RM Limited trading as Structur3dpeople and Cajigo. Indigo RM Limited is registered in the UK under company registration no. 9115722, whose registered office address is Redwood House, 65 Bristol Rd, Keynsham BS31 2WB. Any references to ‘Cajigo’, ‘the App’ ‘we’ ‘our’ or ‘us’ in this Terms and Conditions (‘Terms’ or ‘terms’) also includes reference to Structur3dpeople and Indigo RM Limited and its sites. Reference to ‘Sites’ ‘Site’ ’sites’ or ‘site’ in this Terms and Conditions and our Privacy Policy means other applications, websites or materials belonging to Indigo RM Limited.</p>\n	<p style=\"margin:10px 0 0 0\">1.2 Each time you access or use the App and our sites, you are accepting these terms. If you do not accept the Terms and Conditions stated here or our Privacy Policy, do not use the App and our sites and services.</p>\n	<p style=\"margin:10px 0 0 0\">1.3 \"you\" or “You” means the person firm company or organisation using the App, and \"your\" or “Your” shall be construed accordingly. </p>\n	<p style=\"margin:10px 0 0 0\">1.4 “Candidate” “Mentee” or “Job Candidate” means an individual person using the App for their own personal career development and/or exploring or applying for job opportunities.  </p>\n	<p style=\"margin:10px 0 0 0\">1.5 “Employer Customer” or “employer customer” means a commercial client searching for a job candidate or posting a job for job candidates to contact them through the App. </p>\n	<p style=\"margin:10px 0 0 0\">1.6 “CV” means Curriculum Vitae and includes your personal profile or CV Builder on the App.</p>\n	<p style=\"margin:10px 0 0 0\">1.7 We may revise these Terms and Conditions at any time and you will be notified accordingly.</p>\n	<p style=\"margin:10px 0 0 0\">1.8 Users who do not comply with these Terms may have their access and use of the App and our sites suspended or terminated at our discretion without notice. </p>\n	<p style=\"margin:10px 0 0 0\">1.9 The App is intended for use only by those aged 16 years of age or older.</p>\n	<p style=\"margin:10px 0 0 0\">1.10 You may not use or rely on the App to check a consumer\'s eligibility for: (a) credit or insurance for personal, family, or household purposes; (b) employment eligibility; or (c) state benefits or government entitlements or permissions or eligibility for such things.</p>\n	<p style=\"margin:10px 0 0 0\">1.11 These terms relate to the App and Indigo RM Limited trading as Structur3dpeople These terms apply to all companies connected with us. A company is connected with us if it is: (i) a subsidiary or holding company of us; (ii) controlled by the same person(s) who control us or our holding company; (iii) a subsidiary or holding company of any company in (i) or (ii) above; or (iv) in the same group as any company under (i), (ii) or (iii) above. \"subsidiary\" and \"holding company\" shall be as defined in the Companies Act 2006. The term \"control\" shall have the same meaning as defined in Section 416 of the Income and Corporation Taxes Act 1988. Two companies are in the same group if they share the same ultimate holding company.</p><br>\n\n	<u>2. Interruptions and Omissions in Service</u>\n	<p style=\"margin:10px 0 0 0\">2.1 We try to ensure that the standard of the App always remains high and to maintain the continuity of it through our third-party support company. You will understand the internet is not a stable medium, and errors, omissions, interruptions of service and delays may occur at any time. We do not accept any liability arising from any such errors, omissions, interruptions or delays or any ongoing obligation or responsibility to operate the App (or any particular part of it) or to provide the service offered on the App. We may vary the specification of the App from time to time without notice. </p>\n	<p style=\"margin:10px 0 0 0\">2.2 If you delete your account in the App or your account is terminated, all of your account information in the App, including CVs, contacts, and any in App purchases will be deleted. </p><br>\n\n	<u>3. Links to other Sites</u>\n	<p style=\"margin:10px 0 0 0\">3.1 The App will offer automatic links to other sites which we hope will be of interest to you. We do not accept any responsibility for or liability in respect of the content of those sites, the owners of which do not have any connection, commercial or otherwise, with us. Using automatic links to gain access to such sites is done entirely at your own risk. It is up to you to check their terms of use and their privacy policy.</p><br>\n\n	<u>4. Information on the App</u>\n	<p style=\"margin:10px 0 0 0\">4.1 We make every effort to ensure that the information on the App is accurate and complete. Where the  information is provided by you and or third parties we do not accept any liability arising from an inaccuracy or omission of that information. We do not accept any liability arising from any inaccuracy or omission in any of the information on our App or other sites or any liability in respect of information on a website supplied by you, any other website user or any other person.</p><br>\n\n	<u>5. Your Use of the App this Site and Intellectual Property Rights</u>\n	<p style=\"margin:10px 0 0 0\">5.1 The rights to the App are protected by our intellectual property rights, copyright, software and by trademark legislation and you agree to use the App in a way which does not infringe these rights. You must only use the App for lawful purposes when seeking employment or help with your career, or when using the App services as an employer customer or agent for an employer customer for your recruitment purposes. You must not under any circumstances undermine or seek to undermine the stability and security of the App or any of our sites by information submitted to or available through it. Without limitation, you must not seek to access, alter or delete any information to which you do not have authorised access, seek to overload the system via spamming or flooding, take any action or use any device, routine or software to crash, delay, damage or otherwise interfere with the operation of the App or attempt to decipher, disassemble or modify any of the software, coding or information comprised in the App or on any of our sites.</p>\n	<p style=\"margin:10px 0 0 0\">5.2 We are not responsible for any information submitted by you. You have full responsibility for any information submitted by you to the App. You are responsible for ensuring all information supplied by you is accurate, true, up-to-date and not misleading or likely to mislead or deceive. You are responsible to ensure any information submitted by you is not offensive, obscene, discriminatory, defamatory or otherwise illegal, unlawful or in breach of any applicable legislation, regulations, guidelines or codes of practice or the copyright, trade mark or other intellectual property rights of any person in any jurisdiction. You are also responsible for ensuring that all information, data and files are free of viruses or other routines or engines that may damage or interfere with any system or data prior to being submitted to the App. We reserve the right to remove any information supplied by you from the App at our sole discretion, at any time and for any reason without explanation. We reserve the right to take appropriate legal action against you.</p>\n	<p style=\"margin:10px 0 0 0\">5.3 We authorise you, subject to these Terms, to access and use the App and to download and print the content available on or from the App solely for your personal, non-commercial use only, other than for those commercial recruitment requirements which have been agreed and permitted by us in writing separately to these terms. The contents of the App, such as designs, text, graphics, images, video, information, logos, button icons, software, audio files and other content (collectively, \"Cajigo Content\"), are protected under copyright, trademark and other laws. All Cajigo Content is the property of Indigo RM Limited or its licensors. Compilation (meaning the collection, arrangement and assembly) of all content on the App is the exclusive property of Indigo RM Limited and is protected by copyright, trademark, and other laws. Unauthorised use that may violate laws is strictly prohibited. You must preserve all copyright, trademark, service mark and other proprietary notices contained in the Cajigo Content on any authorised copy you make of the Cajigo Content.</p>\n	<p style=\"margin:10px 0 0 0\">5.4 Any code created by us to generate or display any Cajigo Content or the pages making up the App is also protected by Cajigo copyright and you must not copy or adapt such code subject to applicable laws.</p>\n	<p style=\"margin:10px 0 0 0\">5.5 You agree not to sell or modify the Cajigo Content or reproduce, display, publicly perform, distribute, or otherwise use the Cajigo Content in any way for any public or commercial purpose, in connection with products or services that are not those of the Cajigo Sites, in any other manner that is likely to cause confusion among consumers, that disparages or discredits Cajigo or its licensors, that reduces or dilutes the strength of Cajigo\'s or its licensor’s property, or that otherwise infringes Cajigo\'s or its licensor’s intellectual property rights. You further agree to in no other way misuse Cajigo Content. The use of the Cajigo Content on any other application, web site or in a networked computer environment for any purpose is prohibited unless you have express written agreement and consent from us which is agreed separately to these terms. Any code that Cajigo creates to generate or display any Cajigo Content or the pages making up the App or any of its services is also protected by Cajigo\'s copyright and you must not copy or adapt such code.</p><br>\n\n	<u>6. Information that You Submit to Us</u>\n	<p style=\"margin:10px 0 0 0\">6.1 We will use information supplied by you (including, without limitation, sensitive personal data that you have chosen to provide) to aide your user experience and the career building and job search process and associated App functions, features and administrative tasks as well as to enable in App purchases. This involves us processing and storing information (including, without limitation, sensitive personal data) and passing or making available such information to employer customers (or third parties assisting them in their recruitment process). We use third parties to help us process your information. We may collect and aggregate data from the information supplied by you to help us to understand our users as a group so that we can provide a better service. We may also share aggregate information with selected third parties, without disclosing individual names or identifying information. You consent to us using information provided by you (including, without limitation, sensitive personal data) in each of these ways.</p>\n	<p style=\"margin:10px 0 0 0\">6.2 We will process any data which you provide in completing the online registration and sign up procedure, personal profile, CV builder templates or application forms and any further forms, assessments or personal details which you complete or provide to us when using the App or our sites in accordance with UK data protection requirements. You must also read and agree our Privacy Policy which should be read in conjunction with and forms part of the App before you can use the App and our sites. </p><br>\n\n	<u>7. Additional Terms of Business for Employer Customers and other Commercial Users  </u>\n	<p style=\"margin:10px 0 0 0\">7.1 All employer customers wishing to use the App must sign a copy of Terms of Business applicable to them before they can use the App. The requirement on when these additional terms of business must be signed and returned to us is at our sole discretion. The level of App services, access to CV’s and candidate profiles and other Cajigo Content will be limited or blocked until we receive a signed copy of Terms of Business and the agreed fee payment. In the case of any conflict between these Terms and Conditions and any additional contractual Terms of Business you have with us, the contractual Terms of Business to use the App will prevail. </p>\n	<p style=\"margin:10px 0 0 0\">7.2 Employer customers are solely responsible for their job postings and promotions on the App. We are not an employer for you and are not to be held responsible for your employment decisions and reference checks for whatever reason, made by anyone including third party agents for an employer customer posting jobs on the App.</p>\n	<p style=\"margin:10px 0 0 0\">7.3 If you delete your account in the App or your account is terminated, all of your account information in the App, including CVs, contacts, and any in App purchases will be deleted. If you delete the App in error it is your responsibility to inform us as soon as possible but we cannot guarantee your information will be retrieved. Refer to the Privacy Policy in the App for more details about process and timescales taken for account information deletion. </p>\n	<p style=\"margin:10px 0 0 0\">7.4 Job descriptions MUST not contain: inaccurate, false, irrelevant or misleading information; material or links to material which does or could exploit people in a sexual, violent or other manner, or solicits personal information from anyone under 16.</p>\n	<p style=\"margin:10px 0 0 0\">7.5 Job descriptions MUST not:</p>\n	<p style=\"margin:10px 0 0 0\">7.5.1 fail to meet with applicable local, national and international law; require an upfront or periodic payment; advertise sexual services or seek employees for jobs of a sexual nature; endorse a particular political party, political agenda, political position or issue; promote a particular religion; post jobs which compels, requires or forces the applicant to provide information relating to racial or ethnic origin, political beliefs, philosophical or religious beliefs; request the use of human body parts or the donation of human parts, including, without limitation, reproductive services such as egg donation and surrogacy; request details of membership of a trade union, physical or mental health, sexual life, the commission of criminal offences or proceedings or age unless allowed by applicable law.</p>\n	<p style=\"margin:10px 0 0 0\">7.6 We reserve the right to remove any job description, posting or content from the App, which we believe, does not comply with laws and regulations, or if any content is considered to be detrimental in any way.</p><br>\n\n	<u>8. Mentees and Candidates – Your information </u>\n	<p style=\"margin:10px 0 0 0\">8.1 You acknowledge and agree that you are solely responsible for the form, content and accuracy of any CV, personal profile or material contained therein placed by you or created by you on the App.</p>\n	<p style=\"margin:10px 0 0 0\">8.2 We reserve the right to offer third party services and products to you based on the preferences that you identify in your registration and at any time thereafter, or where you have agreed to receive such offers these may be made by us or by third parties. </p>\n	<p style=\"margin:10px 0 0 0\">8.3 You understand and acknowledge that you have no ownership rights in the App account that you sign up to and that if you delete the App or your account is terminated, all your account information from the App, including but not limited to CVs, profiles, saved jobs and in App purchases will be deleted from our database. We have no control or responsibility over third parties you may have contacted or passed information to, who may retain saved copies of your information. </p>\n	<p style=\"margin:10px 0 0 0\">8.4 Refer to the Privacy Policy in the App for more details about process and timescales taken for account information deletion. If you delete the App in error it is your responsibility to inform us as soon as possible but we can not guarantee your information will be retrieved.</p><br>\n	<u>9. Termination </u>\n	<p style=\"margin:10px 0 0 0\">9.1 We may terminate your registration and or deny you access to the App or any part of it (including any services, goods or information available on or through the App) at any time in our absolute discretion and without any explanation or notification. </p>\n	<p style=\"margin:10px 0 0 0\">9.2 If at any time during your use of the App, you made or make misrepresentations of fact to us or otherwise regarding the nature of your business or employment activities, we will have grounds to terminate your use of the App and services.</p>\n	<p style=\"margin:10px 0 0 0\">9.3 We reserve the right to delete your account and all of your information after a period of inactivity in accordance with data protection guidance.</p>\n	<p style=\"margin:10px 0 0 0\">9.4 Refer to the Privacy Policy in the App for more details about process and timescales taken for account information deletion.</p><br>\n\n	<u>10. Liability</u>\n	<p style=\"margin:10px 0 0 0\">10.1 We accept no liability for any loss (whether direct or indirect, for loss of business, revenue or profits, wasted expenditure, corruption or destruction of data or for any other indirect or consequential loss whatsoever) arising from your use of the App or any of our sites and we hereby without reservation exclude any such liability, whether in contract, tort (including for negligence) or otherwise. We hereby exclude all representations, warranties and conditions relating to the App and our sites and your use of it to the maximum extent permitted by law.</p>\n	<p style=\"margin:10px 0 0 0\">10.2 You agree to indemnify us and keep us indemnified against all costs, expenses, claims, losses, liabilities or proceedings arising from use or misuse by you of the App and sites.</p>\n	<p style=\"margin:10px 0 0 0\">10.3 You must notify us immediately if anyone makes or threatens to make any claim against you relating to your use of the App or sites.</p><br>\n\n	<u>11. You agree not to:</u>\n	<p style=\"margin:10px 0 0 0\">11.1 use any data gathering or extraction methods not permitted to you as a user of the App; violate or attempt to violate the security of the App including probing, scanning or testing the vulnerability of the App, system or a network or to breach security or authentication measures without proper authorisation; reverse engineer or decompile any parts of the App or attempt to do so; aggregate, copy or duplicate in any manner any of the App content or information available from the App, including expired job postings, other than as permitted by us or law; link to any App content or information available from the App, unless permitted by us; post any false or misleading information or illegal activities, or post or endorse or provide instructions images or information about illegal activities or other activities prohibited by these Terms, violate a user’s or anyone else’s privacy; provide, post or create computer viruses or pirating media; post or build any CV or profile, or apply for any job posing for, as or on behalf of another party; share any login details to any other site or person; access data not intended for you or log into a server or account which you are not permitted to access; post or submit to the App any, false or inaccurate information or information which belongs to somebody else; attempt to or solicit passwords or personally identifiable information from anyone else; delete or alter any material posted by any other person or entity; harass, or promote harassment of any group, company, or individual; send unsolicited mail or email, make unsolicited phone calls promoting and/or advertising products or services to any user, or contact any users that have specifically requested not to be contacted by you; use the App for any unlawful purpose or any illegal activity, or post or submit any content, CV, or job posting that is defamatory, libellous, deemed by us to be offensive, vulgar, obscene, threatening, abusive, hateful, racist, discriminatory, of a menacing character or likely to cause annoyance, inconvenience, embarrassment, anxiety or could cause harassment to any person or include any links to pornographic, indecent or sexually explicit material of any kind, as determined by our discretion; or post any CV which is not genuine and which attempts to advertise or promote products or services.</p>\n	<p style=\"margin:10px 0 0 0\">11.2 Violations or threats of violation of system or network security may result in civil and/or criminal liability. We will investigate events that involve such violations which may include involvement and co-operation with law enforcement agencies.</p>\n	<p style=\"margin:10px 0 0 0\">11.3 You must not share your password or other App account and access information with any other party. You agree to notify us immediately if you become aware of any unauthorised use of your account, your profile, or your passwords.   </p><br>\n\n	<u>12. Indemnity</u>\n	<p style=\"margin:10px 0 0 0\">You agree to defend, indemnify, and hold harmless Cajigo, Indigo RM, Structur3dpeople, its affiliates, and their respective officers, directors, employees and agents, from and against any claims, actions or demands, including without limitation reasonable legal and accounting fees, alleging or resulting from (a) any User Content or other material you provide to the App or our sites, (b) your use of the App, or (c) your breach of these Terms. We shall provide notice to you promptly of any such claim.</p><br>\n\n	<u>13. Information on the App, User Content, Uploaded Content and Use</u>\n	<p style=\"margin:10px 0 0 0\">13.1 You agree and understand that all information and user content including, data, text, photographs, graphics, video, advertisements, messages or other materials submitted, posted or displayed on the App is the sole responsibility of the person from which such user content originated.</p>\n	<p style=\"margin:10px 0 0 0\">13.2 We do not represent or guarantee the accuracy, or reliability of User Content, or any other communications posted by users. All opinions expressed in videos relied upon by you are done so at your own discretion.</p>\n	<p style=\"margin:10px 0 0 0\">13.3 Mentoring videos are meant for guidance purposes only, we and mentors providing user content on the App accept no responsibility for any reliance placed by you on us or them that such user content will assist you in any way. We make no representations about the accuracy, reliability, completeness, or timeliness of any content. We cannot guarantee or promise any specific results from use of the user content. </p>\n	<p style=\"margin:10px 0 0 0\">13.4 Purchase of any digital content once you have started downloading or streaming to your account or device as an in-app purchase is non-refundable.</p>\n	<p style=\"margin:10px 0 0 0\">13.5 The following are examples of user content prohibited on the App. The list is not exhaustive and includes content that: </p>\n	<p style=\"margin:10px 0 0 0\">promotes or endorses false or misleading information or illegal activities or conduct that is abusive, threatening, obscene, libellous or defamatory; incites harassment of any group or individual; displays or links to pornographic, indecent or sexually explicit material of any kind; is offensive, or promotes/endorses racism, bigotry, discrimination, hatred or physical harm of any kind against any group or individual; includes “junk mail”, “chain letters,” or unsolicited mass mailing, “spamming” or “phishing”; promotes or endorses an illegal or unauthorised copy of another person\'s copyrighted work, such as providing or making available pirated computer programs or links to the same; contains restricted or password only access pages, or hidden pages or images or directs to unauthorised or illegal web sites; solicits passwords or personal identifying information from other users; profiles that don’t represent you such as a fictional character, or another real individual that is not you.</p>\n	<p style=\"margin:10px 0 0 0\">13.6 If any employer customer makes what we consider is or is an attempt to make a direct approach, advertisement or advertisement to a recruitment event to an available candidate for a position found on the App directed to candidates seeking employment on any employment basis using the App, we will reserve the right to charge employer customers fees based on the salary offered to such available candidates approached in such a way. Fees will be based on 15% of gross salary plus VAT offered to that available candidate plus interest at current HSBC Bank rates plus 8% from the date of placement by the employer customer (or any agents) plus any other reasonable costs incurred in receiving such payment from the employer customer. </p>\n	<p style=\"margin:10px 0 0 0\">13.7 The App MUST not be used to pass on ANY candidate details to any other recruiters, agencies or other employers in helping to fill their employment vacancies or build a database of available candidates.   We do not permit recruiters, agencies or employers who we have not contractually permitted to use the App to use candidate data for their own direct marketing and recruitment activities or for those of a third party.</p><br>\n\n	<u>14. Law and Jurisdiction</u>\n	<p style=\"margin:10px 0 0 0\">The use of the App and our sites and any agreements entered into with us are governed by and construed in accordance with English law. You irrevocably agree that the courts of England and Wales shall have exclusive jurisdiction to settle any dispute or claim arising out of or in connection with the use of the App and our sites and services or any agreement made through the App and our sites and services (including non-contractual disputes or claims). </p><br>\n\n	<u>15. Exclusion of Liability.</u>\n	<p style=\"margin:10px 0 0 0\">15.1. We are not involved in, and do not control the actual transaction between employer customers and candidates. We are not responsible for the quality, safety or legality of the jobs, profiles or CVs posted, the truth or accuracy of the listings, the ability of employer customers to offer job opportunities to candidates or the ability of candidates to fill job openings. </p>\n	<p style=\"margin:10px 0 0 0\">15.2 You assume all risks associated with dealing with other users with whom you come into contact with through the App. We cannot guarantee that each user is who they claim to be. You release us (and our agents and employees) from claims, demands and damages (actual and consequential and direct and indirect) of every kind and nature, known and unknown, suspected and unsuspected, disclosed and undisclosed, arising out of or in any way connected with such disputes to the fullest extent permitted by law.</p>\n	<p style=\"margin:10px 0 0 0\">15.3 We make no representations about the accuracy, reliability, completeness, or timeliness of any content. We cannot guarantee or promise any specific results from use of the App. </p>\n	<p style=\"margin:10px 0 0 0\">15.4 We do not provide or make any representation as to the quality or nature of any of the third-party products or services through in App purchases, or any other representation, warranty or guarantee. Any such undertaking, representation, warranty or guarantee would be furnished solely by the provider of such third-party products or services, under the terms agreed to by the provider.</p>\n	<p style=\"margin:10px 0 0 0\">15.5 We may send you offers or advertisements from third parties. If you contact, follow a link to or are re-directed to a third- party website order, we do not accept any liability for any losses suffered by you by doing so</p><br>\n\n	<u>16. Disclaimer of Warranty.</u>\n	<p style=\"margin:10px 0 0 0\">TO THE FULLEST EXTENT POSSIBLE BY LAW, CAJIGO DOES NOT WARRANT THAT THE APP OR ANY SERVICES WILL OPERATE ERROR-FREE OR THAT ANY RELATED SITE AND ITS SERVERS ARE FREE OF COMPUTER VIRUSES OR OTHER HARMFUL MECHANISMS. IF YOUR USE OF THE APP RESULTS IN THE NEED FOR SERVICING OR REPLACING EQUIPMENT OR DATA OR ANY OTHER COSTS, WE ARE NOT RESPONSIBLE FOR THOSE COSTS. THE APP IS PROVIDED ON AN \"AS IS\" BASIS WITHOUT ANY WARRANTIES OF ANY KIND AND WE TO THE FULLEST EXTENT PERMITTED BY LAW, DISCLAIM ALL WARRANTIES, WHETHER EXPRESS OR IMPLIED, INCLUDING THE WARRANTY OF MERCHANTABILITY, FITNESS FOR PARTICULAR PURPOSE AND NON-INFRINGEMENT. WE MAKE NO WARRANTIES ABOUT THE ACCURACY, RELIABILITY, COMPLETENESS, OR TIMELINESS OF THE APP CONTENT, SERVICES, SOFTWARE, TEXT, GRAPHICS, AND LINKS.</p><br>\n\n	<u>17. Disclaimer of Consequential Damages.</u>\n	<p style=\"margin:10px 0 0 0\">TO THE FULLEST EXTENT POSSIBLE BY LAW, IN NO EVENT SHALL WE, OUR SUPPLIERS, OR ANY THIRD PARTIES MENTIONED ON THE APP BE LIABLE FOR ANY DAMAGES WHATSOEVER (INCLUDING, WITHOUT LIMITATION, INCIDENTAL AND CONSEQUENTIAL DAMAGES, LOST PROFITS, OR DAMAGES RESULTING FROM LOST DATA, LOST EMPLOYMENT OPPORTUNITY OR BUSINESS INTERRUPTION) RESULTING FROM THE USE OR INABILITY TO USE THE APP, WHETHER BASED ON WARRANTY, CONTRACT, TORT, OR ANY OTHER LEGAL THEORY, AND WHETHER OR NOT WE ARE ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.</p><br>\n\n	<u>18. Limitation of Liability.</u>\n	<p style=\"margin:10px 0 0 0\">TO THE FULLEST EXTENT POSSIBLE BY LAW, OUR MAXIMUM LIABILITY ARISING OUT OF OR IN CONNECTION WITH THE APP REGARDLESS OF THE CAUSE OF ACTION (WHETHER IN CONTRACT, TORT, BREACH OF WARRANTY OR OTHERWISE), WILL NOT EXCEED £50.00 GBP (FIFTY).</p>\n	<p style=\"margin:10px 0 0 0\">If you access the App you do so at your own risk and are responsible for ongoing compliance with the laws of your jurisdiction. </p><br>\n\n	<u>19. Changes to Terms and Conditions and Invalidity</u>\n	<p style=\"margin:10px 0 0 0\">19.1 These terms and conditions may be changed by us at any time and you will be notified when the App must be updated. You will be deemed to accept the terms and conditions (as amended) by continuing to use the App following any changes and updates.</p>\n	<p style=\"margin:10px 0 0 0\">19.2 If any provision of these terms and conditions is held to be invalid by a recognised court of law, such invalidity shall not affect the validity of the remaining provisions, which shall remain in full force and effect.</p><br>\n\n	<u>Registered Office</u>\n	<p style=\"margin:10px 0 0 0\">Indigo RM Limited</p>\n	<p style=\"margin:10px 0 0 0\">Redwood House, 65 Bristol Rd, Keynsham BS31 2WB</p>\n	<p style=\"margin:10px 0 0 0\">Company Number 9115722. Registered in the UK.</p>\n	<p style=\"margin:10px 0 0 0\">January 2018</p>\n</div>', 1, 1, '2017-11-06 11:35:56', 1, '2017-11-29 16:31:14', '2024-10-07 23:42:53', NULL),
(8, 5, 'Tetsts', 0, NULL, '2024-10-07 23:43:12', NULL, NULL, '2024-10-07 18:13:12', '2024-10-07 18:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `CompanyID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL DEFAULT 0,
  `FirmName` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `EmailID` varchar(250) NOT NULL,
  `MobileNo` varchar(15) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `CountryID` int(11) NOT NULL DEFAULT 0,
  `StateID` int(11) NOT NULL DEFAULT 0,
  `CityID` int(11) NOT NULL DEFAULT 0,
  `PinCode` varchar(6) DEFAULT NULL,
  `AadharNumber` varchar(16) DEFAULT NULL,
  `GSTNumber` varchar(16) DEFAULT NULL,
  `PANNumber` varchar(10) DEFAULT NULL,
  `FirmType` enum('Proprietary','Private Limited','LLP') NOT NULL DEFAULT 'Proprietary',
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `CountryID` bigint(20) NOT NULL,
  `Country` varchar(250) DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`CountryID`, `Country`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'India', 1, '2024-10-22 10:36:04', NULL),
(2, 'USA', 1, '2024-10-22 10:36:04', NULL),
(3, 'UK', 1, '2024-10-22 10:36:04', NULL),
(4, 'Canada', 1, '2024-10-22 10:36:04', NULL),
(5, 'Australia', 1, '2024-10-22 10:36:04', NULL),
(6, 'Europe', 1, '2024-10-22 10:36:04', NULL),
(7, 'Asia', 1, '2024-10-22 10:36:04', NULL),
(8, 'Middle East', 1, '2024-10-22 10:36:04', NULL),
(9, 'Africa', 1, '2024-10-22 10:36:04', NULL),
(10, 'Caribbean', 1, '2024-10-22 10:36:04', NULL),
(11, 'Oceania', 1, '2024-10-22 10:36:04', NULL),
(12, 'South America', 1, '2024-10-22 10:36:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_12_17_055226_create_roles_table', 1),
(4, '2020_12_17_055308_create_permissions_table', 1),
(5, '2020_12_17_060416_create_role_permissions_pivot_table', 1),
(6, '2020_12_17_061340_add_relationship_fields_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pagemaster`
--

CREATE TABLE `pagemaster` (
  `PageID` int(11) NOT NULL,
  `PageName` varchar(250) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pagemaster`
--

INSERT INTO `pagemaster` (`PageID`, `PageName`, `Status`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `created_at`, `updated_at`) VALUES
(1, 'FAQ', 1, 1, '2017-09-14 15:09:54', 1, '2017-11-23 09:47:05', '2024-10-07 23:51:01', NULL),
(2, 'Login', 1, 1, '2017-09-14 15:10:42', 1, '2017-11-23 09:47:02', '2024-10-07 23:51:01', NULL),
(3, 'About', 1, 1, '2018-04-05 17:57:35', NULL, NULL, '2024-10-07 23:51:01', NULL),
(4, 'Terms', 1, 1, '2017-10-26 14:22:54', 1, '2017-11-23 09:47:04', '2024-10-07 23:51:01', NULL),
(5, 'Privacy', 1, 1, '2017-10-26 17:43:34', 1, '2017-11-23 09:47:03', '2024-10-07 23:51:01', NULL),
(6, 'Test', 1, NULL, '2024-10-07 23:51:15', NULL, NULL, '2024-10-07 18:21:15', '2024-10-07 18:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin_panel_access', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(2, 'users_access', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(3, 'user_edit', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(4, 'user_delete', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(5, 'user_create', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(6, 'user_show', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(7, 'roles_access', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(8, 'role_edit', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(9, 'role_delete', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(10, 'role_create', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(11, 'role_show', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(12, 'permissions_access', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(13, 'permission_edit', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(14, 'permission_delete', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(15, 'permission_create', '2024-04-19 12:26:40', '2024-04-19 12:26:40'),
(16, 'role_view', '2024-04-20 04:18:20', '2024-04-20 04:18:20'),
(17, 'permission_view', '2024-04-20 04:18:28', '2024-04-20 04:18:28'),
(18, 'state_access', '2024-09-06 19:12:48', '2024-09-06 19:12:48'),
(19, 'country_access', '2024-09-06 19:12:54', '2024-09-06 19:12:54'),
(20, 'city_access', '2024-09-06 19:13:01', '2024-09-06 19:13:01'),
(21, 'country_create', '2024-09-06 20:13:06', '2024-09-06 20:13:06'),
(22, 'state_create', '2024-09-06 20:13:14', '2024-09-06 20:13:14'),
(23, 'city_create', '2024-09-06 20:13:22', '2024-09-06 20:13:22'),
(24, 'country_show', '2024-09-06 20:13:34', '2024-09-06 20:13:34'),
(25, 'state_show', '2024-09-06 20:13:41', '2024-09-06 20:13:41'),
(26, 'city_show', '2024-09-06 20:13:47', '2024-09-06 20:13:47'),
(27, 'country_edit', '2024-09-06 20:13:54', '2024-09-06 20:13:54'),
(28, 'state_edit', '2024-09-06 20:14:02', '2024-09-06 20:14:02'),
(29, 'city_edit', '2024-09-06 20:14:09', '2024-09-06 20:14:09'),
(30, 'country_delete', '2024-09-06 20:14:19', '2024-09-06 20:14:19'),
(31, 'state_delete', '2024-09-06 20:14:26', '2024-09-06 20:14:26'),
(32, 'city_delete', '2024-09-06 20:14:34', '2024-09-06 20:14:34'),
(33, 'cms_access', '2024-10-02 13:13:20', '2024-10-02 13:13:20'),
(34, 'cms_create', '2024-10-02 13:13:27', '2024-10-02 13:13:27'),
(35, 'cms_show', '2024-10-02 13:13:36', '2024-10-02 13:13:36'),
(36, 'cms_edit', '2024-10-02 13:13:43', '2024-10-02 13:13:43'),
(37, 'cms_delete', '2024-10-02 13:14:00', '2024-10-02 13:14:00'),
(38, 'page_access', '2024-10-02 13:14:20', '2024-10-02 13:14:20'),
(39, 'page_create', '2024-10-02 13:14:27', '2024-10-02 13:14:27'),
(40, 'page_show', '2024-10-02 13:14:34', '2024-10-02 13:14:34'),
(41, 'page_delete', '2024-10-02 13:14:42', '2024-10-02 13:14:42'),
(42, 'page_edit', '2024-10-02 13:18:17', '2024-10-02 13:18:17'),
(44, 'cas_access', '2024-10-06 06:10:59', NULL),
(45, 'cas_edit', '2024-10-06 06:10:59', NULL),
(46, 'cas_delete', '2024-10-06 06:10:59', NULL),
(47, 'cas_create', '2024-10-06 06:10:59', NULL),
(48, 'cas_show', '2024-10-06 06:10:59', NULL),
(49, 'client_access', '2024-10-06 06:10:59', NULL),
(50, 'client_edit', '2024-10-06 06:10:59', NULL),
(51, 'client_delete', '2024-10-06 06:10:59', NULL),
(52, 'client_create', '2024-10-06 06:10:59', NULL),
(53, 'client_show', '2024-10-06 06:10:59', NULL),
(54, 'bussiness_access', '2024-10-06 06:10:59', NULL),
(55, 'bussiness_edit', '2024-10-06 06:10:59', NULL),
(56, 'bussiness_delete', '2024-10-06 06:10:59', NULL),
(57, 'bussiness_create', '2024-10-06 06:10:59', NULL),
(58, 'bussiness_show', '2024-10-06 06:10:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `short_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `Status`, `short_code`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 1, 'Admin', '2024-04-19 12:26:24', '2024-04-19 12:26:24'),
(2, 'Accountant', 1, 'Accountant', '2024-04-19 12:26:24', '2024-09-04 10:33:58'),
(3, 'Jr CA', 1, 'Jr CA', '2024-04-19 12:26:24', '2024-09-04 10:33:58'),
(4, 'Data Entry', 1, 'Data Entry', '2024-04-19 12:26:24', '2024-09-04 10:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(2, 1),
(2, 2),
(1, 16),
(1, 17),
(2, 6),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58);

-- --------------------------------------------------------

--
-- Table structure for table `scanneddocuments`
--

CREATE TABLE `scanneddocuments` (
  `ScanneddocumentsID` int(11) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `BatchNo` varchar(200) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PageCount` varchar(3) DEFAULT NULL,
  `Remarks` varchar(1000) DEFAULT NULL,
  `DocumentURL` varchar(250) DEFAULT NULL,
  `DocumentStatus` enum('Yes','No') NOT NULL DEFAULT 'No',
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `StateID` bigint(20) NOT NULL,
  `CountryID` bigint(20) NOT NULL DEFAULT 0,
  `State` varchar(250) DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`StateID`, `CountryID`, `State`, `Status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Andaman and Nicobar', 1, '2024-10-22 10:37:18', NULL),
(2, 1, 'Andhra Pradesh', 1, '2024-10-22 10:37:18', NULL),
(3, 1, 'Arunachal Pradesh', 1, '2024-10-22 10:37:18', NULL),
(4, 1, 'Assam', 1, '2024-10-22 10:37:18', NULL),
(5, 1, 'Bihar', 1, '2024-10-22 10:37:18', NULL),
(6, 1, 'Chandigarh', 1, '2024-10-22 10:37:18', NULL),
(7, 1, 'Chhattisgarh', 1, '2024-10-22 10:37:18', NULL),
(8, 1, 'Dadra and Nagar Haveli', 1, '2024-10-22 10:37:18', NULL),
(9, 1, 'Daman and Diu', 1, '2024-10-22 10:37:18', NULL),
(10, 1, 'Delhi', 1, '2024-10-22 10:37:18', NULL),
(11, 1, 'Goa', 1, '2024-10-22 10:37:18', NULL),
(12, 1, 'Gujarat', 1, '2024-10-22 10:37:18', NULL),
(13, 1, 'Haryana', 1, '2024-10-22 10:37:18', NULL),
(14, 1, 'Himachal Pradesh', 1, '2024-10-22 10:37:18', NULL),
(15, 1, 'Jammu and Kashmir', 1, '2024-10-22 10:37:18', NULL),
(16, 1, 'Jharkhand', 1, '2024-10-22 10:37:18', NULL),
(17, 1, 'Karnataka', 1, '2024-10-22 10:37:18', NULL),
(18, 1, 'Kerala', 1, '2024-10-22 10:37:18', NULL),
(19, 1, 'Lakshadweep', 1, '2024-10-22 10:37:18', NULL),
(20, 1, 'Madhya Pradesh', 1, '2024-10-22 10:37:18', NULL),
(21, 1, 'Maharashtra', 1, '2024-10-22 10:37:18', NULL),
(22, 1, 'Manipur', 1, '2024-10-22 10:37:18', NULL),
(23, 1, 'Meghalaya', 1, '2024-10-22 10:37:18', NULL),
(24, 1, 'Mizoram', 1, '2024-10-22 10:37:18', NULL),
(25, 1, 'Nagaland', 1, '2024-10-22 10:37:18', NULL),
(26, 1, 'Orissa', 1, '2024-10-22 10:37:18', NULL),
(27, 1, 'Puducherry', 1, '2024-10-22 10:37:18', NULL),
(28, 1, 'Punjab', 1, '2024-10-22 10:37:18', NULL),
(29, 1, 'Rajasthan', 1, '2024-10-22 10:37:18', NULL),
(30, 1, 'Sikkim', 1, '2024-10-22 10:37:18', NULL),
(31, 1, 'Tamil Nadu', 1, '2024-10-22 10:37:18', NULL),
(32, 1, 'Tripura', 1, '2024-10-22 10:37:18', NULL),
(33, 1, 'Uttar Pradesh', 1, '2024-10-22 10:37:18', NULL),
(34, 1, 'Uttarakhand', 1, '2024-10-22 10:37:18', NULL),
(35, 1, 'West Benga', 1, '2024-10-22 10:37:18', NULL),
(36, 2, 'Alabama', 1, '2024-10-22 10:37:18', NULL),
(37, 2, 'Alaska', 1, '2024-10-22 10:37:18', NULL),
(38, 2, 'Arizona', 1, '2024-10-22 10:37:18', NULL),
(39, 2, 'Arkansas', 1, '2024-10-22 10:37:18', NULL),
(40, 2, 'California', 1, '2024-10-22 10:37:18', NULL),
(41, 2, 'Colorado', 1, '2024-10-22 10:37:18', NULL),
(42, 2, 'Connecticut', 1, '2024-10-22 10:37:18', NULL),
(43, 2, 'Delaware', 1, '2024-10-22 10:37:18', NULL),
(44, 2, 'District of Columbia', 1, '2024-10-22 10:37:18', NULL),
(45, 2, 'Florida', 1, '2024-10-22 10:37:18', NULL),
(46, 2, 'Georgia', 1, '2024-10-22 10:37:18', NULL),
(47, 2, 'Hawaii', 1, '2024-10-22 10:37:18', NULL),
(48, 2, 'Idaho', 1, '2024-10-22 10:37:18', NULL),
(49, 2, 'Illinois', 1, '2024-10-22 10:37:18', NULL),
(50, 2, 'Indiana', 1, '2024-10-22 10:37:18', NULL),
(51, 2, 'Iowa', 1, '2024-10-22 10:37:18', NULL),
(52, 2, 'Kansas', 1, '2024-10-22 10:37:18', NULL),
(53, 2, 'Kentucky', 1, '2024-10-22 10:37:18', NULL),
(54, 2, 'Louisiana', 1, '2024-10-22 10:37:18', NULL),
(55, 2, 'Maine', 1, '2024-10-22 10:37:18', NULL),
(56, 2, 'Maryland', 1, '2024-10-22 10:37:18', NULL),
(57, 2, 'Massachusetts', 1, '2024-10-22 10:37:18', NULL),
(58, 2, 'Michigan', 1, '2024-10-22 10:37:18', NULL),
(59, 2, 'Minnesota', 1, '2024-10-22 10:37:18', NULL),
(60, 2, 'Mississippi', 1, '2024-10-22 10:37:18', NULL),
(61, 2, 'Missouri', 1, '2024-10-22 10:37:18', NULL),
(62, 2, 'Montana', 1, '2024-10-22 10:37:18', NULL),
(63, 2, 'Nebraska', 1, '2024-10-22 10:37:18', NULL),
(64, 2, 'Nevada', 1, '2024-10-22 10:37:18', NULL),
(65, 2, 'New Hampshire', 1, '2024-10-22 10:37:18', NULL),
(66, 2, 'New Jersey', 1, '2024-10-22 10:37:18', NULL),
(67, 2, 'New Mexico', 1, '2024-10-22 10:37:18', NULL),
(68, 2, 'New York', 1, '2024-10-22 10:37:18', NULL),
(69, 2, 'North Carolina', 1, '2024-10-22 10:37:18', NULL),
(70, 2, 'North Dakota', 1, '2024-10-22 10:37:18', NULL),
(71, 2, 'Ohio', 1, '2024-10-22 10:37:18', NULL),
(72, 2, 'Oklahoma', 1, '2024-10-22 10:37:18', NULL),
(73, 2, 'Oregon', 1, '2024-10-22 10:37:18', NULL),
(74, 2, 'Pennsylvania', 1, '2024-10-22 10:37:18', NULL),
(75, 2, 'Rhode Island', 1, '2024-10-22 10:37:18', NULL),
(76, 2, '', 1, '2024-10-22 10:37:18', NULL),
(77, 2, 'South Carolina', 1, '2024-10-22 10:37:18', NULL),
(78, 2, 'South Carolina', 1, '2024-10-22 10:37:18', NULL),
(79, 2, 'South Dakota', 1, '2024-10-22 10:37:18', NULL),
(80, 2, 'Tennessee', 1, '2024-10-22 10:37:18', NULL),
(81, 2, 'Texas', 1, '2024-10-22 10:37:18', NULL),
(82, 2, 'Utah', 1, '2024-10-22 10:37:18', NULL),
(83, 2, 'Vermont', 1, '2024-10-22 10:37:18', NULL),
(84, 2, 'Virginia', 1, '2024-10-22 10:37:18', NULL),
(85, 2, 'Washington', 1, '2024-10-22 10:37:18', NULL),
(86, 2, 'West Virginia', 1, '2024-10-22 10:37:18', NULL),
(87, 2, 'Wisconsin', 1, '2024-10-22 10:37:18', NULL),
(88, 2, 'Wyoming', 1, '2024-10-22 10:37:18', NULL),
(89, 3, 'England', 1, '2024-10-22 10:37:18', NULL),
(90, 3, 'Northern Ireland', 1, '2024-10-22 10:37:18', NULL),
(91, 3, 'Scotland', 1, '2024-10-22 10:37:18', NULL),
(92, 3, 'Wales', 1, '2024-10-22 10:37:18', NULL),
(93, 4, 'Alberta', 1, '2024-10-22 10:37:18', NULL),
(94, 4, 'British Columbia', 1, '2024-10-22 10:37:18', NULL),
(95, 4, 'Labrado', 1, '2024-10-22 10:37:18', NULL),
(96, 4, 'Manitoba', 1, '2024-10-22 10:37:18', NULL),
(97, 4, 'New Brunswick', 1, '2024-10-22 10:37:18', NULL),
(98, 4, 'Newfoundland', 1, '2024-10-22 10:37:18', NULL),
(99, 4, 'Nova Scotia', 1, '2024-10-22 10:37:18', NULL),
(100, 4, 'Ontario', 1, '2024-10-22 10:37:18', NULL),
(101, 4, 'Prince Edward Island', 1, '2024-10-22 10:37:18', NULL),
(102, 4, 'Quebec', 1, '2024-10-22 10:37:18', NULL),
(103, 4, 'Saskatchewan', 1, '2024-10-22 10:37:18', NULL),
(104, 4, 'ACT', 1, '2024-10-22 10:37:18', NULL),
(105, 5, 'ACT', 1, '2024-10-22 10:37:18', NULL),
(106, 5, 'New South Wales', 1, '2024-10-22 10:37:18', NULL),
(107, 5, 'Northern Territory', 1, '2024-10-22 10:37:18', NULL),
(108, 5, 'Queensland', 1, '2024-10-22 10:37:18', NULL),
(109, 5, 'South Australia', 1, '2024-10-22 10:37:18', NULL),
(110, 5, 'Tasmania', 1, '2024-10-22 10:37:18', NULL),
(111, 5, 'Victoria', 1, '2024-10-22 10:37:18', NULL),
(112, 5, 'Western Australia', 1, '2024-10-22 10:37:18', NULL),
(113, 6, 'Albania', 1, '2024-10-22 10:37:18', NULL),
(114, 6, 'Andorra', 1, '2024-10-22 10:37:18', NULL),
(115, 6, 'Armenia', 1, '2024-10-22 10:37:18', NULL),
(116, 6, 'Austria', 1, '2024-10-22 10:37:18', NULL),
(117, 6, 'Belarus', 1, '2024-10-22 10:37:18', NULL),
(118, 6, 'Belgium', 1, '2024-10-22 10:37:18', NULL),
(119, 6, 'Bosnia', 1, '2024-10-22 10:37:18', NULL),
(120, 6, 'Bulgaria', 1, '2024-10-22 10:37:18', NULL),
(121, 6, 'Croatia', 1, '2024-10-22 10:37:18', NULL),
(122, 6, 'Cyprus', 1, '2024-10-22 10:37:18', NULL),
(123, 6, 'Czech Republic', 1, '2024-10-22 10:37:18', NULL),
(124, 6, 'Denmark', 1, '2024-10-22 10:37:18', NULL),
(125, 6, 'Estonia', 1, '2024-10-22 10:37:18', NULL),
(126, 6, 'Faroe Islands', 1, '2024-10-22 10:37:18', NULL),
(127, 6, 'Finland', 1, '2024-10-22 10:37:18', NULL),
(128, 6, 'France', 1, '2024-10-22 10:37:18', NULL),
(129, 6, 'Georgia', 1, '2024-10-22 10:37:18', NULL),
(130, 6, 'Germany', 1, '2024-10-22 10:37:18', NULL),
(131, 6, 'Gibraltar', 1, '2024-10-22 10:37:18', NULL),
(132, 6, 'Greece', 1, '2024-10-22 10:37:18', NULL),
(133, 6, 'Greenland', 1, '2024-10-22 10:37:18', NULL),
(134, 6, 'Holland', 1, '2024-10-22 10:37:18', NULL),
(135, 6, 'Hungary', 1, '2024-10-22 10:37:18', NULL),
(136, 6, 'Iceland', 1, '2024-10-22 10:37:18', NULL),
(137, 6, 'Ireland', 1, '2024-10-22 10:37:18', NULL),
(138, 6, 'Italy', 1, '2024-10-22 10:37:18', NULL),
(139, 6, 'Latvia', 1, '2024-10-22 10:37:18', NULL),
(140, 6, 'Liechtenstein', 1, '2024-10-22 10:37:18', NULL),
(141, 6, 'Lithuania', 1, '2024-10-22 10:37:18', NULL),
(142, 6, 'Luxembourg', 1, '2024-10-22 10:37:18', NULL),
(143, 6, 'Macedonia', 1, '2024-10-22 10:37:18', NULL),
(144, 6, 'Malta', 1, '2024-10-22 10:37:18', NULL),
(145, 6, 'Moldova', 1, '2024-10-22 10:37:18', NULL),
(146, 6, 'Monaco', 1, '2024-10-22 10:37:18', NULL),
(147, 6, 'Montenegro', 1, '2024-10-22 10:37:18', NULL),
(148, 6, 'Norway', 1, '2024-10-22 10:37:18', NULL),
(149, 6, 'Poland', 1, '2024-10-22 10:37:18', NULL),
(150, 6, 'Portugal', 1, '2024-10-22 10:37:18', NULL),
(151, 6, 'Romania', 1, '2024-10-22 10:37:18', NULL),
(152, 6, 'Russia', 1, '2024-10-22 10:37:18', NULL),
(153, 6, 'San Marino', 1, '2024-10-22 10:37:18', NULL),
(154, 6, 'Serbia', 1, '2024-10-22 10:37:18', NULL),
(155, 6, 'Slovakia', 1, '2024-10-22 10:37:18', NULL),
(156, 6, 'Slovenia', 1, '2024-10-22 10:37:18', NULL),
(157, 6, 'Spain', 1, '2024-10-22 10:37:18', NULL),
(158, 6, 'Svalbard', 1, '2024-10-22 10:37:18', NULL),
(159, 6, 'Sweden', 1, '2024-10-22 10:37:18', NULL),
(160, 6, 'Switzerland', 1, '2024-10-22 10:37:18', NULL),
(161, 6, 'Turkey', 1, '2024-10-22 10:37:18', NULL),
(162, 6, 'Ukraine', 1, '2024-10-22 10:37:18', NULL),
(163, 6, 'Vatican City', 1, '2024-10-22 10:37:18', NULL),
(164, 7, 'Afghanistan', 1, '2024-10-22 10:37:18', NULL),
(165, 7, 'Azerbaijan', 1, '2024-10-22 10:37:18', NULL),
(166, 7, 'Bangladesh', 1, '2024-10-22 10:37:18', NULL),
(167, 7, 'Bhutan', 1, '2024-10-22 10:37:18', NULL),
(168, 7, 'Brunei', 1, '2024-10-22 10:37:18', NULL),
(169, 7, 'Cambodia', 1, '2024-10-22 10:37:18', NULL),
(170, 7, 'China', 1, '2024-10-22 10:37:18', NULL),
(171, 7, 'Hong Kong', 1, '2024-10-22 10:37:18', NULL),
(172, 7, 'Indonesia', 1, '2024-10-22 10:37:18', NULL),
(173, 7, 'Japan', 1, '2024-10-22 10:37:18', NULL),
(174, 7, 'Kazakhstan', 1, '2024-10-22 10:37:18', NULL),
(175, 7, 'Kyrgyzstan', 1, '2024-10-22 10:37:18', NULL),
(176, 7, 'Laos', 1, '2024-10-22 10:37:18', NULL),
(177, 7, 'Macau', 1, '2024-10-22 10:37:18', NULL),
(178, 7, 'Malaysia', 1, '2024-10-22 10:37:18', NULL),
(179, 7, 'Maldives', 1, '2024-10-22 10:37:18', NULL),
(180, 7, 'Mongolia', 1, '2024-10-22 10:37:18', NULL),
(181, 7, 'Myanmar', 1, '2024-10-22 10:37:18', NULL),
(182, 7, 'Nepal', 1, '2024-10-22 10:37:18', NULL),
(183, 7, 'North Korea', 1, '2024-10-22 10:37:18', NULL),
(184, 7, 'Pakistan', 1, '2024-10-22 10:37:18', NULL),
(185, 7, 'Paracel Islands', 1, '2024-10-22 10:37:18', NULL),
(186, 7, 'Philippines', 1, '2024-10-22 10:37:18', NULL),
(187, 7, 'Singapore', 1, '2024-10-22 10:37:18', NULL),
(188, 7, 'South Korea', 1, '2024-10-22 10:37:18', NULL),
(189, 7, 'Spratly Islands', 1, '2024-10-22 10:37:18', NULL),
(190, 7, 'Sri Lanka', 1, '2024-10-22 10:37:18', NULL),
(191, 7, 'Taiwan', 1, '2024-10-22 10:37:18', NULL),
(192, 7, 'Tajikistan', 1, '2024-10-22 10:37:18', NULL),
(193, 7, 'Thailand', 1, '2024-10-22 10:37:18', NULL),
(194, 7, 'Turkey', 1, '2024-10-22 10:37:18', NULL),
(195, 7, 'Turkmenistan', 1, '2024-10-22 10:37:18', NULL),
(196, 7, 'Uzbekistan', 1, '2024-10-22 10:37:18', NULL),
(197, 7, 'Vietnam', 1, '2024-10-22 10:37:18', NULL),
(198, 8, 'Bahrain', 1, '2024-10-22 10:37:18', NULL),
(199, 8, 'Iran', 1, '2024-10-22 10:37:18', NULL),
(200, 8, 'Iraq', 1, '2024-10-22 10:37:18', NULL),
(201, 8, 'Israel', 1, '2024-10-22 10:37:18', NULL),
(202, 8, 'Jordan', 1, '2024-10-22 10:37:18', NULL),
(203, 8, 'Kuwait', 1, '2024-10-22 10:37:18', NULL),
(204, 8, 'Lebanon', 1, '2024-10-22 10:37:18', NULL),
(205, 8, 'Oman', 1, '2024-10-22 10:37:18', NULL),
(206, 8, 'Qatar', 1, '2024-10-22 10:37:18', NULL),
(207, 8, 'Saudi Arabia', 1, '2024-10-22 10:37:18', NULL),
(208, 8, 'Syria', 1, '2024-10-22 10:37:18', NULL),
(209, 8, 'UAE', 1, '2024-10-22 10:37:18', NULL),
(210, 8, 'West Bank', 1, '2024-10-22 10:37:18', NULL),
(211, 8, 'Yemen', 1, '2024-10-22 10:37:18', NULL),
(212, 9, 'Algeria', 1, '2024-10-22 10:37:18', NULL),
(213, 9, 'Angola', 1, '2024-10-22 10:37:18', NULL),
(214, 9, 'Benin', 1, '2024-10-22 10:37:18', NULL),
(215, 9, 'Botswana', 1, '2024-10-22 10:37:18', NULL),
(216, 9, 'Burkina Faso', 1, '2024-10-22 10:37:18', NULL),
(217, 9, 'Burundi', 1, '2024-10-22 10:37:18', NULL),
(218, 9, 'Cameroon', 1, '2024-10-22 10:37:18', NULL),
(219, 9, 'Cape Verde', 1, '2024-10-22 10:37:18', NULL),
(220, 9, 'Cen. Afr. Rep.', 1, '2024-10-22 10:37:18', NULL),
(221, 9, 'Chad', 1, '2024-10-22 10:37:18', NULL),
(222, 9, 'Comoros', 1, '2024-10-22 10:37:18', NULL),
(223, 9, 'Congo', 1, '2024-10-22 10:37:18', NULL),
(224, 9, 'Djibouti', 1, '2024-10-22 10:37:18', NULL),
(225, 9, 'Egypt', 1, '2024-10-22 10:37:18', NULL),
(226, 9, 'Eq. Guinea', 1, '2024-10-22 10:37:18', NULL),
(227, 9, 'Eritrea', 1, '2024-10-22 10:37:18', NULL),
(228, 9, 'Ethiopia', 1, '2024-10-22 10:37:18', NULL),
(229, 9, 'Gabon', 1, '2024-10-22 10:37:18', NULL),
(230, 9, 'Ghana', 1, '2024-10-22 10:37:18', NULL),
(231, 9, 'Guinea', 1, '2024-10-22 10:37:18', NULL),
(232, 9, 'Guinea Bissau', 1, '2024-10-22 10:37:18', NULL),
(233, 9, 'Ivory Coast', 1, '2024-10-22 10:37:18', NULL),
(234, 9, 'Kenya', 1, '2024-10-22 10:37:18', NULL),
(235, 9, 'Lesotho', 1, '2024-10-22 10:37:18', NULL),
(236, 9, 'Liberia', 1, '2024-10-22 10:37:18', NULL),
(237, 9, 'Libya', 1, '2024-10-22 10:37:18', NULL),
(238, 9, 'Madagascar', 1, '2024-10-22 10:37:18', NULL),
(239, 9, 'Malawi', 1, '2024-10-22 10:37:18', NULL),
(240, 9, 'Mali', 1, '2024-10-22 10:37:18', NULL),
(241, 9, 'Mauritania', 1, '2024-10-22 10:37:18', NULL),
(242, 9, 'Mauritius', 1, '2024-10-22 10:37:18', NULL),
(243, 9, 'Morocco', 1, '2024-10-22 10:37:18', NULL),
(244, 9, 'Mozambique', 1, '2024-10-22 10:37:18', NULL),
(245, 9, 'Namibia', 1, '2024-10-22 10:37:18', NULL),
(246, 9, 'Niger', 1, '2024-10-22 10:37:18', NULL),
(247, 9, 'Nigeria', 1, '2024-10-22 10:37:18', NULL),
(248, 9, 'Reunion', 1, '2024-10-22 10:37:18', NULL),
(249, 9, 'Rwanda', 1, '2024-10-22 10:37:18', NULL),
(250, 9, 'Saint Helena', 1, '2024-10-22 10:37:18', NULL),
(251, 9, 'Sao Tome', 1, '2024-10-22 10:37:18', NULL),
(252, 9, 'Senegal', 1, '2024-10-22 10:37:18', NULL),
(253, 9, 'Seychelles', 1, '2024-10-22 10:37:18', NULL),
(254, 9, 'Sierra Leone', 1, '2024-10-22 10:37:18', NULL),
(255, 9, 'Somalia', 1, '2024-10-22 10:37:18', NULL),
(256, 9, 'South Africa', 1, '2024-10-22 10:37:18', NULL),
(257, 9, 'Sudan', 1, '2024-10-22 10:37:18', NULL),
(258, 9, 'Swaziland', 1, '2024-10-22 10:37:18', NULL),
(259, 9, 'Tanzania', 1, '2024-10-22 10:37:18', NULL),
(260, 9, 'The Gambia', 1, '2024-10-22 10:37:18', NULL),
(261, 9, 'Togo', 1, '2024-10-22 10:37:18', NULL),
(262, 9, 'Tunisia', 1, '2024-10-22 10:37:18', NULL),
(263, 9, '', 1, '2024-10-22 10:37:18', NULL),
(264, 9, 'Uganda', 1, '2024-10-22 10:37:18', NULL),
(265, 9, 'W. Sahara', 1, '2024-10-22 10:37:18', NULL),
(266, 9, 'Zaire', 1, '2024-10-22 10:37:18', NULL),
(267, 9, 'Zambia', 1, '2024-10-22 10:37:18', NULL),
(268, 9, 'Zimbabwe', 1, '2024-10-22 10:37:18', NULL),
(269, 10, 'Anguilla', 1, '2024-10-22 10:37:18', NULL),
(270, 10, 'Antigua', 1, '2024-10-22 10:37:18', NULL),
(271, 10, 'Aruba', 1, '2024-10-22 10:37:18', NULL),
(272, 10, 'Bahamas', 1, '2024-10-22 10:37:18', NULL),
(273, 10, 'Barbados', 1, '2024-10-22 10:37:18', NULL),
(274, 10, 'Belize', 1, '2024-10-22 10:37:18', NULL),
(275, 10, 'Bermuda', 1, '2024-10-22 10:37:18', NULL),
(276, 10, 'British V.I.', 1, '2024-10-22 10:37:18', NULL),
(277, 10, 'Cayman Islands', 1, '2024-10-22 10:37:18', NULL),
(278, 10, 'Colombia', 1, '2024-10-22 10:37:18', NULL),
(279, 10, 'Costa Rica', 1, '2024-10-22 10:37:18', NULL),
(280, 10, 'Cuba', 1, '2024-10-22 10:37:18', NULL),
(281, 10, 'Dom. Republic', 1, '2024-10-22 10:37:18', NULL),
(282, 10, 'Dominica', 1, '2024-10-22 10:37:18', NULL),
(283, 10, 'Dutch Antilles', 1, '2024-10-22 10:37:18', NULL),
(284, 10, 'El Salvador', 1, '2024-10-22 10:37:18', NULL),
(285, 10, 'Grenada', 1, '2024-10-22 10:37:18', NULL),
(286, 10, 'Grenadines', 1, '2024-10-22 10:37:18', NULL),
(287, 10, 'Guadeloupe', 1, '2024-10-22 10:37:18', NULL),
(288, 10, 'Haiti', 1, '2024-10-22 10:37:18', NULL),
(289, 10, 'Jamaica', 1, '2024-10-22 10:37:18', NULL),
(290, 10, 'Martinique', 1, '2024-10-22 10:37:18', NULL),
(291, 10, 'Mexico', 1, '2024-10-22 10:37:18', NULL),
(292, 10, 'Panama', 1, '2024-10-22 10:37:18', NULL),
(293, 10, 'Puerto Rico', 1, '2024-10-22 10:37:18', NULL),
(294, 10, 'St. Barths', 1, '2024-10-22 10:37:18', NULL),
(295, 10, 'St. Kitts', 1, '2024-10-22 10:37:18', NULL),
(296, 10, 'St. Lucia', 1, '2024-10-22 10:37:18', NULL),
(297, 10, 'St. Martin', 1, '2024-10-22 10:37:18', NULL),
(298, 10, 'St. Vincent', 1, '2024-10-22 10:37:18', NULL),
(299, 10, 'Trinidad and Tobago', 1, '2024-10-22 10:37:18', NULL),
(300, 10, 'Turks and Caicos', 1, '2024-10-22 10:37:18', NULL),
(301, 10, 'US Virgin Islands', 1, '2024-10-22 10:37:18', NULL),
(302, 10, 'Venezuela', 1, '2024-10-22 10:37:18', NULL),
(303, 11, 'American Samoa', 1, '2024-10-22 10:37:18', NULL),
(304, 11, 'Cook Islands', 1, '2024-10-22 10:37:18', NULL),
(305, 11, 'East Timor', 1, '2024-10-22 10:37:18', NULL),
(306, 11, 'Fiji', 1, '2024-10-22 10:37:18', NULL),
(307, 11, 'French Polynesia', 1, '2024-10-22 10:37:18', NULL),
(308, 11, 'Guam', 1, '2024-10-22 10:37:18', NULL),
(309, 11, 'Kiribati', 1, '2024-10-22 10:37:18', NULL),
(310, 11, 'Mariana Islands', 1, '2024-10-22 10:37:18', NULL),
(311, 11, 'Marshall Islands', 1, '2024-10-22 10:37:18', NULL),
(312, 11, 'Micronesia', 1, '2024-10-22 10:37:18', NULL),
(313, 11, 'Nauru', 1, '2024-10-22 10:37:18', NULL),
(314, 11, 'New Caledonia', 1, '2024-10-22 10:37:18', NULL),
(315, 11, 'New Zealand', 1, '2024-10-22 10:37:18', NULL),
(316, 11, 'Palau', 1, '2024-10-22 10:37:18', NULL),
(317, 11, 'Pap. New Guinea', 1, '2024-10-22 10:37:18', NULL),
(318, 11, 'Pitcairn Islands', 1, '2024-10-22 10:37:18', NULL),
(319, 11, 'Samoa (Western)', 1, '2024-10-22 10:37:18', NULL),
(320, 11, 'Solomon Isles', 1, '2024-10-22 10:37:18', NULL),
(321, 11, 'Tokelau', 1, '2024-10-22 10:37:18', NULL),
(322, 11, 'Tonga', 1, '2024-10-22 10:37:18', NULL),
(323, 11, 'Tuvalu', 1, '2024-10-22 10:37:18', NULL),
(324, 11, 'Vanuatu', 1, '2024-10-22 10:37:18', NULL),
(325, 11, 'Wallis And Futuna', 1, '2024-10-22 10:37:18', NULL),
(326, 11, 'Argentina', 1, '2024-10-22 10:37:18', NULL),
(327, 11, 'Belize', 1, '2024-10-22 10:37:18', NULL),
(328, 12, 'Belize', 1, '2024-10-22 10:37:18', NULL),
(329, 12, 'Bolivia', 1, '2024-10-22 10:37:18', NULL),
(330, 12, 'Brazil', 1, '2024-10-22 10:37:18', NULL),
(331, 12, 'Chile', 1, '2024-10-22 10:37:18', NULL),
(332, 12, 'Colombia', 1, '2024-10-22 10:37:18', NULL),
(333, 12, 'Costa Rica', 1, '2024-10-22 10:37:18', NULL),
(334, 12, 'Ecuador', 1, '2024-10-22 10:37:18', NULL),
(335, 12, 'El Salvador', 1, '2024-10-22 10:37:18', NULL),
(336, 12, 'Falklands', 1, '2024-10-22 10:37:18', NULL),
(337, 12, 'Fr. Guiana', 1, '2024-10-22 10:37:18', NULL),
(338, 12, 'Guatemala', 1, '2024-10-22 10:37:18', NULL),
(339, 12, 'Guyana', 1, '2024-10-22 10:37:18', NULL),
(340, 12, 'Honduras', 1, '2024-10-22 10:37:18', NULL),
(341, 12, 'Mexico', 1, '2024-10-22 10:37:18', NULL),
(342, 12, 'Nicaragua', 1, '2024-10-22 10:37:18', NULL),
(343, 12, 'Panama', 1, '2024-10-22 10:37:18', NULL),
(344, 12, 'Paraguay', 1, '2024-10-22 10:37:18', NULL),
(345, 12, 'Peru', 1, '2024-10-22 10:37:18', NULL),
(346, 12, 'Sth. Georgia', 1, '2024-10-22 10:37:18', NULL),
(347, 12, 'Suriname', 1, '2024-10-22 10:37:18', NULL),
(348, 12, 'Uruguay', 1, '2024-10-22 10:37:18', NULL),
(349, 12, 'Venezuela', 1, '2024-10-22 10:37:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `firm_name` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `registration_type` set('Regular') NOT NULL DEFAULT 'Regular',
  `client_id` tinyint(4) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `CountryID` int(11) DEFAULT NULL,
  `StateID` int(11) DEFAULT NULL,
  `firm_type` varchar(150) DEFAULT NULL,
  `pan` varchar(50) DEFAULT NULL,
  `gst` varchar(50) DEFAULT NULL,
  `aadhar` varchar(100) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `CityID` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_type` enum('1','2','3','4') NOT NULL DEFAULT '2' COMMENT '1 admin,2 users,3 clients,4 cas',
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lname`, `firm_name`, `mobile_no`, `address`, `registration_type`, `client_id`, `email`, `CountryID`, `StateID`, `firm_type`, `pan`, `gst`, `aadhar`, `pincode`, `CityID`, `email_verified_at`, `password`, `role_id`, `user_type`, `Status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', NULL, NULL, NULL, NULL, 'Regular', 0, 'admin@admin.com', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$KlehmQ1mSGk/IKTvbTuOuuRjFJ8al.YlWBjvPQeAQVJ/65sxOYEam', 1, '1', 1, '3HFzp0etKjTnON0gKBhD3aHXvKHzXZpJ8o7ttMfdkiLA49LI8s6dv6eUqQSZ', '2024-04-19 12:26:28', '2024-04-19 12:26:28'),
(3, 'User', NULL, NULL, NULL, NULL, 'Regular', 0, 'user@user.com', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Na7tF4hvd007lfAOJlIjneEc1wWX8CGWmMY7GAV1aWpSn/2cq9WBO', 2, '2', 1, NULL, '2024-04-19 12:26:28', '2024-04-19 12:26:28'),
(4, 'Test', 'Cleint', 'Firm One', '9865321245', 'Test User B1', 'Regular', 0, 'cl@gmail.com', 1, 12, 'Proprietary', '9865BD85DH', '151515151515', '258652545778', '380021', 2, NULL, '$2y$10$FpKYEgyKi0n3UKrdKLFIUeIvZqm2KlJmEP7haDtdyvMBLKWE7eB3y', 2, '3', 1, NULL, '2024-10-12 00:16:54', '2024-10-22 01:14:01'),
(6, 'cl 2', 'cl 2', NULL, '9865254525', 'Test Address', 'Regular', 0, 'cl2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$B0H/wGZfaTBuS87xLdeDdOwLgr6E4n2geVy8S.okCH59lRDZ4NlDu', 2, '2', 1, NULL, '2024-10-12 00:26:06', '2024-10-12 00:26:06'),
(7, 'CA', 'User', 'Firm CA', '9898652585', 'test', 'Regular', 0, 'ca@gmail.com', 1, 12, 'Private Limited', '9865BD85DH', '151515151515', '258652545778', '380021', 2, NULL, '$2y$10$KlehmQ1mSGk/IKTvbTuOuuRjFJ8al.YlWBjvPQeAQVJ/65sxOYEam', 3, '4', 1, NULL, '2024-10-12 03:58:09', '2024-10-12 03:58:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesscategory`
--
ALTER TABLE `businesscategory`
  ADD PRIMARY KEY (`BusinessCategoryID`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`CityID`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`CMSID`),
  ADD KEY `PageId` (`PageID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`CompanyID`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`CountryID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagemaster`
--
ALTER TABLE `pagemaster`
  ADD PRIMARY KEY (`PageID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD KEY `role_permissions_role_id_foreign` (`role_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `scanneddocuments`
--
ALTER TABLE `scanneddocuments`
  ADD PRIMARY KEY (`ScanneddocumentsID`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`StateID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesscategory`
--
ALTER TABLE `businesscategory`
  MODIFY `BusinessCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `CityID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=706;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `CMSID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `CompanyID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `CountryID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pagemaster`
--
ALTER TABLE `pagemaster`
  MODIFY `PageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scanneddocuments`
--
ALTER TABLE `scanneddocuments`
  MODIFY `ScanneddocumentsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `StateID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
