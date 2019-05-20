-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2019 at 10:55 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

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
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `post_id`, `user_id`, `comment`, `date`) VALUES
(9, 32, 9, 'Would be handy to be a bit more popular right about now.', '2019-05-13 16:13:20'),
(10, 32, 8, 'How about open this up to people that havenâ€™t dedicated their youth to posting things on the internet?  Iâ€™ve had other shit to do other than â€˜build a followingâ€™. I focus on influencing those around me (my children) - not those that have never', '2019-05-13 16:13:57'),
(11, 32, 12, 'OMG science teacher nerding out right now...', '2019-05-13 16:16:15'),
(12, 32, 12, 'I would like to apply but getting a visa is one big Hassel for me.', '2019-05-13 16:28:27'),
(13, 34, 13, 'End of the day I think Tati is trying to skew business deals with private relationships. If she wanted him to only promote her goods then she should if gotten an exclusive contract with him. I think the video Tati Released was Indeed done so to ruin ', '2019-05-13 17:08:36'),
(14, 34, 8, 'I got a feeling youâ€™re baiting and on about the apology, I may be wrong', '2019-05-13 17:08:59'),
(15, 34, 12, 'I think he means the one james uploaded cause he titled it tati and not what tati uploaded.', '2019-05-13 17:09:29'),
(16, 34, 9, 'You for one know that when you watch youtubers long term, you get more of a feel for them than just seeing one video and making judgements.  I did not care for Tati but this video makes a hella lot of sense to me as a viewer of â€œbeautubeâ€', '2019-05-13 17:09:56'),
(17, 34, 13, 'Uh ohh someone did an oopsie', '2019-05-13 17:12:13'),
(18, 39, 12, 'As a neutral, this is kinda ironic coming from a city fan.', '2019-05-13 17:48:57'),
(19, 44, 8, 'That\\\'s not nearly enough  @NASA  and you know it. If you are serious about a 2024 return to the lunar surface you need to show leadership and make the case to Congress and the Administration that you need considerably more. That\\\'s if you are seriou', '2019-05-14 15:28:26'),
(20, 44, 9, 'The universe is vast, we are not alone', '2019-05-14 17:55:49'),
(21, 54, 8, 'This phone is silly fast and the screen is one of the best on any smartphone', '2019-05-16 09:15:31'),
(22, 57, 16, 'Space is awesome', '2019-05-16 09:51:02'),
(23, 58, 8, 'Lenovo is one of the best hardware manufacturer.', '2019-05-16 09:56:41'),
(24, 57, 21, 'Yes it is', '2019-05-16 11:08:35'),
(25, 47, 8, 'Hello mkbhd, this is a post from the mobile phone', '2019-05-20 22:06:15'),
(26, 64, 8, 'Go hard or go harder!', '2019-05-20 22:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `followerId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `userId`, `followerId`) VALUES
(30, 12, 15),
(54, 12, 16),
(55, 9, 15),
(61, 8, 19),
(68, 8, 17),
(73, 8, 13),
(74, 12, 14),
(75, 9, 17),
(76, 9, 13),
(77, 8, 20),
(78, 12, 21),
(79, 9, 21),
(80, 9, 16),
(81, 9, 16),
(82, 16, 21),
(84, 8, 18),
(86, 8, 22),
(105, 8, 14),
(106, 8, 21),
(107, 8, 16),
(108, 8, 15),
(109, 8, 24),
(110, 12, 25),
(111, 8, 25),
(112, 9, 25),
(113, 9, 24),
(114, 12, 24),
(115, 15, 21),
(116, 21, 15),
(117, 21, 25),
(118, 21, 24);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(10) NOT NULL,
  `content` varchar(1500) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `userId` int(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `content`, `image`, `userId`, `date`) VALUES
(43, 'ARTEMIS: Twin sister of Apollo and goddess of the Moon. Now, the name for our #Moon2024 mission to return NASA_Astronauts to the surface of the Moon by 2024, including the first woman and next man.', 'uploads/Nasa/2019/05/14/638c96c996b13cdf5c28dd4a0235d7e2-D6fEtUhXkAMRSPU.jfif', 15, '2019-05-14 15:25:27'),
(44, 'Today, the @WhiteHouse announces a new budget amendment for the fiscal year 2020 proposal that supports our plan to land @NASA_Astronauts on the Moon by 2024. Listen in to learn more about it at 7pm ET during a media call \\n#Moon2024', 'uploads/Nasa/2019/05/14/d97bfe248bc91a09902a491cf320ba33-D6eq0CZWwAEmZL_.jfif', 15, '2019-05-14 15:26:50'),
(45, 'Evra: \"Name me one or two players who can play for Real Madrid, Juventus or Bayern Munich? It\'s a few. I would say Paul Pogba and David de Gea.\"\\n\\nWould any other Man Utd players get into the Real, Juve or Bayern XI? ðŸ¤”', 'uploads/Goal.com/2019/05/14/5435a4c779631c2196324d824a013a0f-D6hTDJdWwAAerO9.jfif', 14, '2019-05-14 15:47:19'),
(46, 'Me waking up to zero notifications and messages because no one gives a damn about me', 'uploads/9GAG/2019/05/14/26b0ecbcb8d48b49078380d356ff4044-D6f9tYMWwAAPkbR.jfif', 16, '2019-05-14 16:42:04'),
(47, 'Purple-ish Pixel\\\'s price and performance will predict if people pick it proudly past..... other phones', 'uploads/Marques Brownlee/2019/05/14/8bd9518661aa093fad703247773e402f-D6IP5w7W4AAakDp.jfif', 17, '2019-05-14 17:22:13'),
(48, 'My setup this weekðŸ‘Œ (try to name them all)', 'uploads/Linus Tech Tips/2019/05/14/a8779f8d83cf4d518298d89e286df564-D6FE2O_UIAEv9VB.jfif', 18, '2019-05-14 17:25:09'),
(49, 'Jon Snow can play the mad queen', 'uploads/Uran Kajtazaj/2019/05/14/5945e529a2dedecd42005a3f175d9c33-Mrl2FqWt.jfif', 8, '2019-05-14 17:27:58'),
(50, 'Hello world, i made a sample post', '', 9, '2019-05-14 17:55:08'),
(52, 'Exploration is in our DNA & our closest celestial friend, the Moon, is a treasure chest of science! As we look forward to #Moon2024 mission, we\\\'re sharing these highlights of our favorite neighbor taken from the @Space_Station & Earth: go.nasa.gov/2vYqcBv', 'uploads/Nasa/2019/05/15/7b7c8af17afc505d1f591d1dcfa8e613-D6kjXNsX4AEJee3.jfif', 15, '2019-05-15 13:01:26'),
(53, 'Unboxing some Google Pixel 3a\\\'s... \\nhttps://youtu.be/3mlMq3pQyt8', 'uploads/Unbox Therapy/2019/05/15/6ae9203a0fe9bfc923603c88d23dfe70-D5_klYYWAAAjrCi.jfif', 19, '2019-05-15 13:29:09'),
(54, 'NEW VIDEO - OnePlus 7 Pro Review: Silly Fast! \\nyoutu.be/PVWLD3064Ng - RT!', 'uploads/Marques Brownlee/2019/05/15/43d4a248331e75a6b1c2f444aae47bed-D6ihcvLX4AAv1jg.jfif', 17, '2019-05-15 14:32:43'),
(55, 'We want to know your ultimate Jose Mourinho XI...\\n\\nPick your team using any player to have played under Jose Mourinho ðŸ‘€\\n\\nGO ðŸ‘‡', 'uploads/Goal.com/2019/05/15/9599bcc283c18239a922c0d73d100a15-D6nLqzJWkAERtU4.jfif', 14, '2019-05-15 16:20:02'),
(56, 'A browser specially designed to show the same size at different viewport sizes and keep them in sync. \\n\\npolypane.rocks', 'uploads/CSS Tricks/2019/05/15/d695a65b800b5db10c83639997d7dc32-D6kftAKXsAEoGRY.jfif', 20, '2019-05-15 16:22:44'),
(57, 'Weather is 80% favorable for tomorrowâ€™s Falcon 9 launch of Starlink. Launch window opens at 10:30 p.m. EDT \\nhttp://spacex.com/webcast', 'uploads/SpaceX/2019/05/16/9843e5441adf66c41f4bb96510fd6d0f-D6lSGNXUUAAPvTU.jfif', 21, '2019-05-16 09:49:02'),
(58, 'Meet the Worldâ€™s First Foldable PC. #LenovoAccelerate', 'uploads/Lenovo/2019/05/16/b1f1b60be0000a325698eb195978f4e1-D6e0z3FWsAAz9Y1.jfif', 22, '2019-05-16 09:54:30'),
(61, 'Don\\\'t forget to vote for your favorite VR game!  Winners will be revealed in February 2019.\\n\\nðŸ† Steam Awards 2018: \\nhttps://store.steampowered.com/SteamAwards/2018/) \\n\\n#SteamAwards2018', 'uploads/SteamVR/2019/05/20/96bc1c24d516b31e17d82329a9de096e-Du9RWl8VsAADFor.jpg', 24, '2019-05-20 22:10:32'),
(62, 'New grads are rad. Help them get ready for the next phase of their life when you save up to $350 on select #Windows10', 'uploads/Windows/2019/05/20/05932a9fc15a9beb2831bab2f9018f02-D6OB3bDWsAAFkOr.jpg', 25, '2019-05-20 22:28:02'),
(63, 'SteamVR Home has a new snowy environment!\\nâ„â„Winter Peakâ„â„\\n\\nLearn more about it here: \\nhttps://steamcommunity.com/games/250820/announcements/detail/1705074470255000955', 'uploads/SteamVR/2019/05/20/18936d258057fe04fd9a65644c5a4ec1-Du9QPRZV4AAzHAQ.jpg', 24, '2019-05-20 22:45:25'),
(64, 'Great stream today peeps! 50% more till 30 and the WW quest. Excited to finish up and got more plans. Vegas this week so we go hard next few days.', '', 26, '2019-05-20 22:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `id` int(15) NOT NULL,
  `userId` int(10) NOT NULL,
  `postId` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`id`, `userId`, `postId`, `status`) VALUES
(5, 8, 32, 1),
(6, 8, 31, 1),
(7, 12, 32, 1),
(8, 9, 32, 1),
(9, 8, 34, 1),
(10, 8, 33, 1),
(11, 13, 33, 1),
(12, 8, 36, 1),
(13, 8, 35, 1),
(14, 12, 39, 1),
(15, 8, 39, 1),
(16, 8, 44, 1),
(17, 12, 44, 1),
(18, 8, 48, 1),
(19, 9, 44, 1),
(20, 8, 47, 1),
(21, 8, 45, 1),
(22, 15, 44, 1),
(23, 8, 49, 0),
(24, 8, 52, 1),
(25, 12, 57, 1),
(26, 9, 57, 1),
(27, 16, 57, 1),
(28, 8, 57, 1),
(29, 8, 56, 1),
(30, 8, 58, 1),
(31, 25, 62, 1),
(32, 26, 64, 1),
(33, 8, 64, 1);

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
(9, 'jenna', '$2y$10$sxTN6SYQJN67ouOpeCXkE.W.md/zY6l2Ms5FH1x5YFpVHuefYu3Xq', 'Jenna Smith', 'uploads/root/2019/05/13/4a47444cd9814017712187e0414763b6-attractive-beautiful-beauty-2238300.jpg', ''),
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
(22, 'lenovo', '$2y$10$FDFj2bLs.SqtKcsN76mcxOBg5eJzdxUruclNxAAT5swZI1NcmljrW', 'Lenovo', 'uploads/Lenovo/2019/05/16/5345c25a16d2753d7e70576a7dcf4e77-NWhHpRiE_200x200.png', 'Create, tweak, improve, defy.'),
(24, 'steamvr', '$2y$10$nJ.i8etujcntA6m2AHHQzeYfNU6vco8w.T8Gri78aetRUJFmMpU/K', 'SteamVR', 'uploads/SteamVR/2019/05/20/ac94fddc7da26c8d24b9100575954d54-vCmZ4uXI_200x200.jpg', ''),
(25, 'windows', '$2y$10$Fls4LyyrPm0P97TqQCpaMuCqPL.tYnfimdpzwhJfrucjD7EnQ0E7K', 'Windows', 'uploads/Windows/2019/05/20/353502ba447b01d5cc7cf13d0a3f394d-U54M_YbJ_200x200.jpg', 'Windows news, product info & global stories'),
(26, 'towelliee', '$2y$10$NWXxafvffxR2U/qA5BkI5.qN1VqYwPr.sgWDJbszVHYPDX9LuY9fK', 'Towelliee', 'uploads/Towelliee/2019/05/20/c008577151a069d567b7ecad9c4316e5-cNixOJsl_200x200.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
