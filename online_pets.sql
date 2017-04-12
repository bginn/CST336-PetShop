-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2017 at 06:40 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_pets`
--

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

CREATE TABLE IF NOT EXISTS `breed` (
  `breed_id` varchar(10) NOT NULL,
  `breed` varchar(30) NOT NULL,
  PRIMARY KEY (`breed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`breed_id`, `breed`) VALUES
('1223', 'cornish rex'),
('1230', 'beagle'),
('1590', 'parakeet'),
('2581', 'poodle'),
('3210', 'american'),
('4456', 'labrador'),
('4587', 'dalmatian'),
('5821', 'chihuahua'),
('6540', 'english lop'),
('6541', 'korat'),
('6542', 'siamese'),
('6555', 'bulldog'),
('7458', 'french lop'),
('7878', 'cockatoo'),
('8885', 'cockatiel'),
('9636', 'bombay'),
('9874', 'himalayan');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `invent_id` varchar(10) NOT NULL,
  `pet_id` varchar(10) NOT NULL,
  `supp_id` varchar(10) NOT NULL,
  `price` smallint(10) NOT NULL,
  `availability` varchar(10) NOT NULL,
  `quantity` smallint(10) NOT NULL,
  PRIMARY KEY (`invent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invent_id`, `pet_id`, `supp_id`, `price`, `availability`, `quantity`) VALUES
('147005', '14563', '654', 31, 'Y', 31),
('147078', '85258', '321', 80, 'Y', 5),
('147123', '36987', '987', 19, 'Y', 25),
('147134', '96547', '258', 175, 'N', 0),
('147147', '12397', '147', 300, 'Y', 27),
('147258', '78931', '258', 200, 'Y', 12),
('147321', '74123', '321', 45, 'Y', 15),
('147322', '96317', '321', 145, 'N', 0),
('147369', '14793', '987', 27, 'Y', 30),
('147467', '41562', '654', 120, 'N', 0),
('147550', '45654', '258', 400, 'Y', 12),
('147654', '25879', '654', 29, 'Y', 13),
('147741', '74859', '321', 65, 'Y', 9),
('147807', '96369', '147', 800, 'Y', 3),
('147852', '35789', '258', 200, 'Y', 10),
('147904', '74147', '321', 800, 'Y', 7),
('147963', '78951', '321', 50, 'Y', 9),
('147987', '85231', '147', 150, 'N', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE IF NOT EXISTS `pets` (
  `pet_id` varchar(10) NOT NULL,
  `type` varchar(15) NOT NULL,
  `breed_id` varchar(10) NOT NULL,
  `color` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `weight_pounds` smallint(5) NOT NULL,
  `age_months` varchar(5) NOT NULL,
  PRIMARY KEY (`pet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`pet_id`, `type`, `breed_id`, `color`, `gender`, `weight_pounds`, `age_months`) VALUES
('12397', 'dog', '5821', 'brown', 'F', 11, '4'),
('14563', 'bird', '8885', 'grey and white', 'M', 2, '2'),
('14793', 'rabbit', '6540', 'brown', 'F', 7, '1'),
('25879', 'bird', '1590', 'light blue and white', 'M', 2, '2'),
('35789', 'dog', '4456', 'black', 'F', 50, '10'),
('36987', 'rabbit', '3210', 'grey', 'M', 8, '2'),
('41526', 'bird', '7878', 'white and yellow', 'M', 5, '1'),
('45654', 'dog', '4587', 'white and black', 'M', 58, '8'),
('74123', 'cat', '6541', 'grey', 'M', 8, '7'),
('74147', 'rabbit', '7458', 'black and white', 'F', 10, '2'),
('74859', 'cat', '9636', 'black', 'F', 10, '3'),
('78931', 'dog', '4456', 'yellow', 'M', 40, '6'),
('78951', 'cat', '9874', 'white', 'M', 5, '6'),
('85231', 'dog', '1230', 'tricolor', 'F', 30, '5'),
('85258', 'cat', '1223', 'orange', 'M', 10, '2'),
('96317', 'cat', '6541', 'white', 'F', 9, '3'),
('96369', 'dog', '6555', 'brown and white', 'M', 60, '9'),
('96547', 'dog', '2581', 'grey', 'F', 25, '4');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supp_id` varchar(10) NOT NULL,
  `supp_name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `country` varchar(30) NOT NULL,
  PRIMARY KEY (`supp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supp_id`, `supp_name`, `address`, `phone`, `country`) VALUES
('147', 'Kay Nine', '6547 Sutter Rd, Austin TX 75321', '741-852-0963', 'United States'),
('258', 'Four Paws', '758 Wellington St, Ottawa Ontario, Canada', '444-582-0366', 'Canada'),
('321', 'Critters And Things', '293 Calle Las Rosa, Guadalajara 44530, Mexico', '963-025-8741', 'Mexico'),
('654', 'Avian Heaven', '589 Avenida Julian, Rio De Janeiro 12354 Brazil', '321-065-4789', 'Brazil'),
('987', 'Hoppy Bunnies', '45 Chualar Canyon Rd, Chualar CA 93956', '123-456-7890', 'United States');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
