-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 06:36 PM
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
-- Database: `pcd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(5, 'u', 'u@u.com', '$2y$10$Jfu4m.1QyXOLxkmL19WS6OsrwdLD.exwo6IRUjqXULGkhXp8m4f8i'),
(7, 'admin', 'admin@admin.com', '$2y$10$ovMTMZYDvyTt15kmHYr2A.n9G8czh4VBj/XVUevRLlfdqFZih.uqu');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `post_id` int(255) NOT NULL,
  `author_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author_name`, `comment`, `date`, `post_id`, `author_id`) VALUES
(0, 'user', 'A safe county thanks to sheriff Ken Mascra', '2024-05-16', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `author_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `author_id`) VALUES
(3, 'y', 'y@y.com', 'y', 6),
(4, 'user', 'user@user.com', 'Will be using this for drug verifying', 7);

-- --------------------------------------------------------

--
-- Table structure for table `drugdelivery`
--

CREATE TABLE `drugdelivery` (
  `id` int(255) NOT NULL,
  `delivery` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugdelivery`
--

INSERT INTO `drugdelivery` (`id`, `delivery`) VALUES
(1, 'By absorption through the skin'),
(2, 'By inhalation'),
(3, 'By injection'),
(4, 'By swallowing');

-- --------------------------------------------------------

--
-- Table structure for table `drugmanufacturer`
--

CREATE TABLE `drugmanufacturer` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kraPin` varchar(255) NOT NULL,
  `createdAt` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugmanufacturer`
--

INSERT INTO `drugmanufacturer` (`id`, `name`, `address`, `phone`, `email`, `kraPin`, `createdAt`, `password`) VALUES
(3, 'q', 'Nairobi', 712345689, 'q@q.com', 'AI42154', '2019-01-01', '$2y$10$tfK9rw05AulUsIZ2YQm43Of5eFUIXoFQzHKNkHuKPG/VJm4U87i46');

-- --------------------------------------------------------

--
-- Table structure for table `drugreport`
--

CREATE TABLE `drugreport` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `drugName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugreport`
--

INSERT INTO `drugreport` (`id`, `email`, `drugName`, `description`, `image`, `author_name`, `author_id`) VALUES
(1, 'user@user.com', 'Arsumax', 'taking to nearest pharmacy near me', 'fake_drugs1_f1.jpg', 'user', 7);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `activeAgent` varchar(255) NOT NULL,
  `drugBatch` varchar(255) NOT NULL,
  `manufacturerName` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `drugDelivery` varchar(255) NOT NULL,
  `manufacturingDate` date NOT NULL,
  `expiryDate` date NOT NULL,
  `manufacturer_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `activeAgent`, `drugBatch`, `manufacturerName`, `image`, `drugDelivery`, `manufacturingDate`, `expiryDate`, `manufacturer_id`) VALUES
(4, 'Aspirin', 'Acetylsalicylic acid', 'NDC-36486', 'Q', 'aspirin.png', 'By swallowing', '2024-05-15', '2025-05-15', 3),
(5, ' Acetaminophen', 'Paracetamol', 'NDC-89765', 'q', 'acetaminophen-suppositories.jpg', 'By swallowing', '2024-05-16', '2025-05-16', 3);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturercontact`
--

CREATE TABLE `manufacturercontact` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `author_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturercontact`
--

INSERT INTO `manufacturercontact` (`id`, `name`, `email`, `message`, `author_id`) VALUES
(1, 'q', 'q@q.com', 'hello world', 3);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `author_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author_name`, `created_at`, `image`, `role`, `author_id`) VALUES
(1, 'New post', 'A trial post from Admin', 'u', '2024-04-19', 'blogUploadsvinicius-amnx-amano-hzANWpEL_xA-unsplash.jpg', 'admin', 5),
(4, 'Paracetamol', 'Before taking this medicine&#13;&#10;You should not take acetaminophen if you are allergic to it, or if you take other medications that contain acetaminophen.&#13;&#10;&#13;&#10;Ask a doctor or pharmacist if this medicine is safe to use if you&#39;ve ever had cirrhosis of the liver, or if you drink alcohol daily.&#13;&#10;&#13;&#10;Ask a doctor before using this medicine if you are pregnant or breastfeeding.', 'q', '2024-05-16', 'acetaminophen-suppositories.jpg', 'manufacturer', 3),
(5, 'Over 4K Grams of Drugs, $245K Seized During Bust at St. Lucie County Home', 'Sheriff Ken Mascara said in a news release posted on Facebook. &#34;Some people will say that dealing drugs is a victimless crime; however, when you put drugs, weapons and cash together, this is the perfect combination for violence in our community.&#34;', 'admin', '2024-05-16', 'drug-bust-st.-lucie-county.jpg', 'admin', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, 'w', 'w@w.com', '$2y$10$/0CsFLY6XOGqKHNX0nBVJearqecbXrYK3tmmrhy31kgu0vUPQe2LO'),
(3, 'e', 'e@e.com', '$2y$10$ErcckTe7akye04UbMsROHu673HR2MpB1Dpc4amtrQ/Zq0BR0XqIpG'),
(4, 'r', 'r@r.com', '$2y$10$49c/ojLEJZMukzWKJZ21.OinYFR6vS1mpWGBZsUDlF8DvEntLqh0i'),
(5, 't', 't@t.com', '$2y$10$/WdUMgjj.CNcYva9Wws00.hcZ6LywW.p1bHuxF22xI.wFOKjHsNdG'),
(6, 'y', 'y@y.com', '$2y$10$1e/9eqjbt2MfkF9N3lAp3uXrheOEZN6SXMXBxdCMxcryZpqBXk65K'),
(7, 'user', 'user@user.com', '$2y$10$9La5G1QDVHaDp7cCCNPmjuQjq3Lg9WlWfNgaoD6yQyWbSMFPXkOfa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `drugdelivery`
--
ALTER TABLE `drugdelivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugmanufacturer`
--
ALTER TABLE `drugmanufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugreport`
--
ALTER TABLE `drugreport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`author_id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`);

--
-- Indexes for table `manufacturercontact`
--
ALTER TABLE `manufacturercontact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auther_id` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drugdelivery`
--
ALTER TABLE `drugdelivery`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drugmanufacturer`
--
ALTER TABLE `drugmanufacturer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drugreport`
--
ALTER TABLE `drugreport`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `manufacturercontact`
--
ALTER TABLE `manufacturercontact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drugs`
--
ALTER TABLE `drugs`
  ADD CONSTRAINT `drugs_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `drugmanufacturer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manufacturercontact`
--
ALTER TABLE `manufacturercontact`
  ADD CONSTRAINT `manufacturercontact_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `drugmanufacturer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
