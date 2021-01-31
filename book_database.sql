-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 12:19 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(10) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `author_email` varchar(50) NOT NULL,
  `cover_picture` varchar(50) DEFAULT NULL,
  `dt_publish` date NOT NULL,
  `review` text NOT NULL,
  `isbn_number` text NOT NULL,
  `price` float NOT NULL,
  `type` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `is_paperback` tinyint(1) NOT NULL,
  `is_hardback` tinyint(1) NOT NULL,
  `is_ebook` tinyint(1) NOT NULL,
  `is_stock` tinyint(1) NOT NULL,
  `dt_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `author_email`, `cover_picture`, `dt_publish`, `review`, `isbn_number`, `price`, `type`, `rating`, `is_paperback`, `is_hardback`, `is_ebook`, `is_stock`, `dt_modified`) VALUES
(1, 'The Art of War', 'suntzu@gmail.com', '', '2020-10-08', 'Great Book', 'ISBN123456', 300, 2, 5, 0, 1, 0, 0, '2021-01-31 11:01:28'),
(2, 'Inferno', 'Dan Brown', NULL, '2020-04-29', 'Amazing Book', 'ISBN654321', 500, 2, 9, 1, 0, 0, 1, '2021-01-29 12:43:44'),
(3, 'Him', 'him@gmail.com', '', '2021-01-01', 'not bad', 'ISBN987654', 100, 2, 5, 0, 1, 0, 1, '2021-01-29 17:33:13'),
(4, 'Her', 'her@gmail.com', '', '2021-01-02', 'not bad either', 'ISBN132546', 250, 3, 6, 0, 0, 1, 0, '2021-01-29 17:50:53'),
(5, 'It is', 'it@gmail.com', '', '2021-01-14', 'cool pictures', 'ISBN645312', 444, 1, 6, 1, 0, 0, 0, '2021-01-30 20:32:20'),
(7, 'It', 'it@gmail.com', '', '2021-01-14', 'cool pictures', 'ISBN645312', 333, 3, 7, 0, 0, 1, 0, '2021-01-30 19:25:36'),
(10, 'It', 'it@gmail.com', '6016916e13b809.62031100.png', '2020-12-31', 'not bad either', 'ISBN132546', 250, 2, 5, 0, 1, 0, 0, '2021-01-31 11:15:58'),
(19, 'Picture test', 'test@gmail.com', '601658d69c9573.23147171.jpg', '2021-01-30', 'cool picture', 'iSBN912834', 111, 2, 8, 0, 1, 0, 1, '2021-01-31 07:14:30'),
(20, 'sfdfgdsf', 'vdrfgvdrf@asdas.com', '6016687963e941.98095513.png', '2021-01-15', 'not bad either', 'ISBN132546', 333, 3, 8, 1, 0, 0, 0, '2021-01-31 08:21:13'),
(22, 'sfdfgdsf', 'gfhbfttgh@gmail.com', '60168fcd7cc239.69114950.png', '2021-01-14', 'not bad either', 'ISBN645312', 333, 3, 5, 0, 1, 0, 0, '2021-01-31 11:09:01'),
(23, 'hgjghj', 'hjkb@gmail.com', '60168fb76a7b07.45228540.png', '2021-01-16', 'not bad either', 'ISBN123456', 250, 2, 5, 0, 1, 0, 0, '2021-01-31 11:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `bkcat_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`bkcat_id`, `book_id`, `cat_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 2),
(4, 4, 3),
(5, 5, 1),
(7, 7, 3),
(10, 10, 2),
(19, 19, 2),
(20, 20, 3),
(22, 22, 3),
(23, 23, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL,
  `categories` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `categories`) VALUES
(1, 'Megazine'),
(2, 'Novel'),
(3, 'TextBook');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`bkcat_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `bkcat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD CONSTRAINT `fkBCtoB` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkBCtoC` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
