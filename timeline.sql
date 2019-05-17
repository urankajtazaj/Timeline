-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 09:35 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timeline`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `bio` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `image`, `bio`) VALUES
(8, 'urankajtazaj', '$2y$10$zXa/f0DKThQ2z44lYFLj4.hXdenuC3U63tT1CiOhoyHYuT.BbeXIW', 'Uran Kajtazaj', 'uploads/Uran Kajtazaj/2019/05/15/4f044c65644d79089b015a13c88c158a-education-eyeglasses-facial-expression-1987343.jpg', 'Fullstack Developer'),
(9, 'jenna', '$2y$10$sxTN6SYQJN67ouOpeCXkE.W.md/zY6l2Ms5FH1x5YFpVHuefYu3Xq', 'Jenna Smith', 'uploads/root/2019/05/13/4a47444cd9814017712187e0414763b6-attractive-beautiful-beauty-2238300.jpg', 'Software Developer'),
(12, 'james', '$2y$10$xV.tZpwW.1KdeOyLhNdo3unYt5E3gpdkX8y0VAm1ij2TqSIRsL51G', 'James Doe', 'uploads/James Doe/2019/05/13/1e703ea8f19de2bdbb346feb9735825a-fashion-fashionable-man-2191051.jpg', ''),
(13, 'pewdiepie', '$2y$10$nqKMpT6MDYCuTJvh0L//b.yzcYmLJGbUwHEnHrhAw6O/cowwzSbXm', 'Pewdiepie', 'uploads/Pewdiepie/2019/05/13/6eb77adc4c5d624980436fe3a0adb215-t-Agpngx_400x400.jpg', 'Youtuber'),
(14, 'goal', '$2y$10$Bk7YHyCvaydfTKrInj.hDuua65jAmPUAVJuQrKgZK9.283lo4jpfi', 'Goal.com', 'uploads/Goal.com/2019/05/13/8c07d5998f2c80c28fd1eae83da75fcf-A5hcSxhA_400x400.jpg', 'One sport. One destination. One obsession.'),
(15, 'nasa', '$2y$10$ysczJ8I625TB/bqiSeedtuQRbJCwaRBaGSnCsep1ebYPO1.cyOUtW', 'Nasa', 'uploads/Nasa/2019/05/14/ff7f9ca1892d53f098a2e062e32cd495-TI2qItoi_400x400.jpg', 'Explore the universe and discover our home planet'),
(16, '9gag', '$2y$10$uf2eG9ho9yhuJXySqI9UJ.xqvEYt9vzp9jGiSIZqF7vPuVZLkWuF.', '9GAG', 'uploads/9GAG/2019/05/14/a0c64f490f6d185f0929c2a94b8a8694-UsIvWpWX_200x200.jpg', 'Go Fun The World'),
(17, 'mkbhd', '$2y$10$e/HwP5jzwaHyAclYxqhAz.nJ2AnDpfWdxPtgqaEolXhjf3INb3vXK', 'Marques Brownlee', 'uploads/Marques Brownlee/2019/05/14/deacd76de49d40f39d8bcc34500a6a28-BvJ8T3jO_200x200.jpg', 'Web Video Producer'),
(18, 'ltt', '$2y$10$FPgQv7p/bxuKg3eQp6d2J.K47czBw8gVp0aubK4C.D.a69UMO50vu', 'Linus Tech Tips', 'uploads/Linus Tech Tips/2019/05/14/2e2b641c3d3d68eae7e381046940cd79-cDlQGimm_200x200.jpg', 'The official Timeline of the Linus Tech Tips.'),
(19, 'unboxtherapy', '$2y$10$Ab9csuZQodWIhkB5QhY52e/pivmxF4AdKSNcgcr63MVMLNgZYHeY2', 'Unbox Therapy', 'uploads/Unbox Therapy/2019/05/15/764fd6bba0c7a689f2d89adee96a700f-E3cZ6GmU_200x200.png', 'Where products get naked'),
(20, 'css-tricks', '$2y$10$BPGjpri6lYO4r/InONjCkesMdA4Fyz6im38r/jGjWX3b056uocA7m', 'CSS Tricks', 'uploads/CSS Tricks/2019/05/15/3dea7c56e40938187c1608fb57c525fd-akqRGyta_200x200.jpg', 'A web design community curated by a crack team'),
(21, 'spacex', '$2y$10$O7LP/347o/GyEKyjpU37yue0aPrtyOGLSz4sEg9evfnHIt2lrMIZ.', 'SpaceX', 'uploads/SpaceX/2019/05/16/73d116929e6e414882b13784c3b4861e-rH_k3PtQ_200x200.jpg', 'The worldâ€™s most advanced rockets and spacecraft'),
(22, 'lenovo', '$2y$10$FDFj2bLs.SqtKcsN76mcxOBg5eJzdxUruclNxAAT5swZI1NcmljrW', 'Lenovo', 'uploads/Lenovo/2019/05/16/5345c25a16d2753d7e70576a7dcf4e77-NWhHpRiE_200x200.png', 'Create, tweak, improve, defy.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
