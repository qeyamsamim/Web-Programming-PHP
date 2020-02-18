-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2020 at 04:45 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportkg`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `booking_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `id`, `user_id`, `start_time`, `end_time`, `booking_date`) VALUES
(1, 15, 1, '14:00:00', '15:00:00', '2019-07-27'),
(2, 14, 1, '12:00:00', '13:00:00', '2019-07-30'),
(3, 14, 1, '14:00:00', '15:00:00', '2019-07-30'),
(4, 2, 2, '18:00:00', '19:00:00', '2019-08-03'),
(5, 2, 2, '20:00:00', '21:00:00', '2019-08-03'),
(6, 2, 2, '14:00:00', '15:00:00', '2019-08-03'),
(7, 2, 2, '15:00:00', '16:00:00', '2019-08-03'),
(8, 2, 2, '16:00:00', '17:00:00', '2019-08-03'),
(9, 1, 5, '20:00:00', '21:00:00', '2019-08-04'),
(10, 1, 7, '15:00:00', '16:00:00', '2019-09-19'),
(11, 1, 2, '09:00:00', '10:00:00', '2019-09-20'),
(12, 9, 3, '13:00:00', '14:00:00', '2019-09-20'),
(13, 1, 3, '12:00:00', '13:00:00', '2019-09-20'),
(14, 9, 4, '16:00:00', '17:00:00', '2019-09-20'),
(15, 1, 4, '11:00:00', '12:00:00', '2019-09-20'),
(16, 1, 5, '19:00:00', '20:00:00', '2019-09-20'),
(20, 1, 11, '15:00:00', '16:00:00', '2019-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `field_id`, `user_id`, `comment`, `date`, `time`) VALUES
(1, 1, 4, 'It is really Nice Football Field.', '2019-07-31', '17:02:23'),
(2, 1, 3, 'Awesome, liked it!', '2019-07-31', '17:03:08'),
(3, 2, 3, 'Most of the time the field is wet which is not good.', '2019-07-31', '17:05:46'),
(4, 3, 3, 'The owner is a really nice guy.', '2019-07-31', '17:12:36'),
(5, 2, 5, 'It is terrible to play during night here.', '2019-07-31', '17:13:39'),
(6, 1, 2, 'It was the good one.', '2019-08-02', '13:06:42'),
(7, 2, 2, 'Do not book this field at night.', '2019-08-03', '18:47:18'),
(8, 4, 3, 'I like this football field.', '2019-08-04', '11:16:52'),
(9, 5, 4, 'The best one!!!!', '2019-08-04', '11:17:42'),
(10, 5, 5, 'Recommended to Everyone', '2019-08-04', '17:53:10'),
(11, 11, 5, 'The weather is awesome', '2019-08-04', '17:53:48'),
(12, 1, 5, 'I recommend this for everyone specially early in the morning.', '2019-08-04', '18:03:44'),
(16, 1, 11, 'Awesome', '2019-09-20', '11:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `fields_like`
--

CREATE TABLE `fields_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fields_like`
--

INSERT INTO `fields_like` (`id`, `user_id`, `field_id`) VALUES
(1, 3, 1),
(2, 2, 3),
(3, 2, 5),
(4, 3, 7),
(5, 3, 4),
(6, 4, 2),
(7, 4, 1),
(8, 4, 11),
(9, 5, 6),
(10, 5, 1),
(11, 5, 5),
(12, 7, 1),
(13, 7, 5),
(14, 7, 6),
(15, 2, 1),
(17, 11, 1),
(18, 11, 7),
(19, 11, 8),
(20, 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `football_fields`
--

CREATE TABLE `football_fields` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_num` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `football_fields`
--

INSERT INTO `football_fields` (`id`, `name`, `address`, `contact_num`) VALUES
(1, 'Freedom Football Field', 'Toktogulova, Bishkek', '0552132258'),
(2, 'Youths Football Fields', 'Tokombaeva, Bishkek', '0772000111'),
(3, 'Bishkek Football Field', 'Isanova, Bishkek', '0550121234'),
(4, 'Asanbay Football Field', 'Asanbay Micro-district, Bishkek', '0500127843'),
(5, 'Alatoo Football Field', 'Alatoo Square, Bishkek', '0557651289'),
(6, 'Panvilov Football Field', 'Kievskaya, Bishkek', '0772908070'),
(7, 'KG Football Field', 'Toktogulova, Bishkek', '0700891267'),
(8, 'Your Football Field', '5th micro-district, Bishkek', '0555119567'),
(9, 'Sportic Football Field', 'Sukhe Batur, Bishkek', '0700981234'),
(10, 'Osh Football Field', 'microdistrict, Osh', '0722901273'),
(11, 'Issyk-kul Football Field', 'Issyk-kul', '0551678890');

-- --------------------------------------------------------

--
-- Table structure for table `football_field_img`
--

CREATE TABLE `football_field_img` (
  `id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `football_field_img`
--

INSERT INTO `football_field_img` (`id`, `field_id`, `image`) VALUES
(1, 1, '5d4127e7b16e67.35191882.jpg'),
(2, 2, '5d412817606cb1.89058037.jpg'),
(3, 3, '5d412920f225a3.70248133.jpg'),
(4, 3, '5d412920f2d7f0.29975252.jpg'),
(5, 4, '5d466789381638.87655478.jpg'),
(6, 4, '5d46678938ff00.89685481.jpg'),
(7, 5, '5d4667f8cee607.27390840.jpeg'),
(8, 5, '5d4667f8cfe0c0.91611254.jpeg'),
(9, 6, '5d466872615f82.10499018.jpg'),
(10, 6, '5d4668726254a4.81591873.jpeg'),
(11, 6, '5d466872632d09.98716480.jpeg'),
(12, 7, '5d466968d5c938.04054694.jpeg'),
(13, 8, '5d466c6fbe28b0.17309777.jpg'),
(14, 8, '5d466c6fbf2497.95612254.jpg'),
(15, 9, '5d466cd3e8ebb0.55903586.jpeg'),
(16, 9, '5d466cd3e9f644.13855029.jpg'),
(17, 10, '5d466d47bea739.94909553.jpg'),
(18, 11, '5d466da2374ae8.47473631.jpg'),
(19, 11, '5d466da2382a22.32961165.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `post_id`, `image`) VALUES
(1, 1, '5d43dcff999a76.48030552.jpeg'),
(2, 2, '5d43dfc42c6655.17204018.jpeg'),
(3, 3, '5d43e030259b21.58088921.jpeg'),
(4, 3, '5d43e030269d07.93043547.jpeg'),
(5, 4, '5d466e926ec738.70721426.jpeg'),
(6, 5, '5d466ee6e72033.96497734.jpeg'),
(7, 6, '5d4acfbce79599.44268442.jpg'),
(8, 6, '5d4acfbce8ca23.09388947.jpeg'),
(9, 7, '5d4ad0edb27cc4.29090312.jpeg'),
(10, 8, '5d4ad165e61d58.06852308.jpeg'),
(11, 8, '5d4ad165e6c0c2.62420571.jpeg'),
(12, 9, '5d4ad1edd368a4.06377033.jpeg'),
(17, 11, '5d8468b1c408d2.41347041.jpg'),
(18, 11, '5d8468b1c4c411.91343265.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `price` varchar(10) NOT NULL,
  `cont_num` varchar(15) NOT NULL,
  `city` varchar(30) NOT NULL,
  `post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `name`, `user_id`, `description`, `status`, `price`, `cont_num`, `city`, `post_date`) VALUES
(1, 'Workout Shirt', 2, 'I have a new workout shirt like the photo below. It is not used. Anyone interested can contact me.', 'New', '1200', '0555221947', 'Bishkek', '2019-08-02'),
(2, 'Soft Classic Ball', 2, 'There is a new soft classic ball is available for sale. It has been used for one year. ', 'Used', '2500', '0772991026', 'Bishkek', '2019-08-02'),
(3, 'Nike Jordan Legacy Basketball', 2, 'New and Original', 'New', '5300', '0772136712', 'Bishkek', '2019-08-02'),
(4, 'Everlast Boxing Gloves', 4, 'Only used one month. It is in a very good condition.', 'Used', '2800', '0550124800', 'Bishkek', '2019-08-04'),
(5, 'Everlast MMA Grappling', 4, 'New one.\r\nAvailable for sale.', 'New', '3600', '0772109327', 'Bishkek', '2019-08-04'),
(6, 'Barcelona New Kit', 5, 'Barcelona New Kit available for sale. If you are interested, contact me!', 'New', '5000', '0555156690', 'Bishkek', '2019-08-07'),
(7, 'Zionor Swimming Goggles', 5, 'In a very good condition. I have used it for six months. I bought it from US.', 'Used', '2200', '0771234456', 'Bishkek', '2019-08-07'),
(8, 'Adidas Basketball Shoes', 5, 'Two colors, black and white available.', 'New', '5500', '0551575565', 'BISHKEK', '2019-08-07'),
(9, 'Nike Football Shoes', 2, 'New Nike Football Shoes. Available sizes: 41, 42, 43', 'New', '6000', '0555234010', 'Bishkek', '2019-08-07'),
(11, 'Sport Bicycle', 11, 'These are totally new bicycles. Two colors are available.', 'New', '19500', '+996550112233', 'Bishkek', '2019-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `profile_photo`
--

CREATE TABLE `profile_photo` (
  `user_id` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_photo`
--

INSERT INTO `profile_photo` (`user_id`, `image`, `date_time`) VALUES
(1, '5d2d68636ca2d9.97854383.jpg', '2019-07-16 12:02:11'),
(1, '5d2d6b4da93e34.93666633.jpg', '2019-07-16 12:14:37'),
(1, '5d4126b05023f7.95340444.png', '2019-07-31 11:27:12'),
(2, '5d412bb1cf1838.19209628.jpg', '2019-07-31 11:48:33'),
(3, '5d412bf4813104.82095911.jpg', '2019-07-31 11:49:40'),
(5, '5d4177f2ad6ee5.17657416.jpg', '2019-07-31 17:13:54'),
(6, '5d43e2b042ab75.90747889.jpg', '2019-08-02 13:13:52'),
(5, '5d83ac1cb3f3b4.74413400.jpg', '2019-09-19 22:26:04'),
(11, '5d8468d5b3dfc8.08393642.jpg', '2019-09-20 11:51:17'),
(1, '5de92f58818091.36197172.jpg', '2019-12-05 22:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `sport_clubs`
--

CREATE TABLE `sport_clubs` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_num` varchar(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sport_clubs`
--

INSERT INTO `sport_clubs` (`id`, `name`, `address`, `contact_num`, `description`) VALUES
(1, 'Thai Boxing Club', 'Orto soi, Bishkek', '0555234010', 'This is the best place for you to train Mauythai or Thai Boxing.'),
(2, '6th Micro-district Boxing Club', '6th Micro-district, Bishkek', '0772314498', 'It is one of the best boxing clubs where you can find the best trainer.'),
(3, 'Muscle Gym and Fitness', 'Moskovskaya, Bishkek', '0555991212', 'The best Fitness Gym you can ever find. It has all types of machines for a complete workout. Your are always welcome to join us.'),
(4, 'Water Park Bishkek', 'Tokombaeva, Bishkek', '0555119988', 'The largest water park in Bishkek. The best swimming environment for you and your children. '),
(5, 'Good Health Swimming Pool', 'Razakova, Bishkek', '0772131344', 'It is the best swimming pool. You can visit this place everyday from 8:00 am to 12:00 pm. Came and Enjoy!'),
(6, 'Bishkek Swimming Pool', 'Karlamarks, Bishkek', '0551341166', 'You are welcomed to enjoy the best service offered by us.');

-- --------------------------------------------------------

--
-- Table structure for table `sport_club_img`
--

CREATE TABLE `sport_club_img` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sport_club_img`
--

INSERT INTO `sport_club_img` (`id`, `club_id`, `image`) VALUES
(1, 1, '5d43d94cc7f030.33164403.jpg'),
(2, 2, '5d43da629032c3.38181869.jpeg'),
(3, 2, '5d43da62913907.42872281.jpeg'),
(4, 3, '5d43dd87e2e051.27166507.jpeg'),
(5, 3, '5d43dd87e3f735.02037435.jpeg'),
(6, 4, '5d4ad271a5e4a7.12076552.jpeg'),
(7, 4, '5d4ad271a6ea24.71856733.jpg'),
(8, 5, '5d4ad31d53f221.26037572.jpg'),
(9, 5, '5d4ad31d54e256.81460269.jpg'),
(10, 6, '5d4ad397db4c08.26144049.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `contact_num` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `contact_num`) VALUES
(2, 'X User', 'xuser@gmail.com', '12345', '0500121356'),
(3, 'Y User', 'yuser@gmail.com', '12345', '0722009912'),
(4, 'Z User', 'zuser@gmail.com', '12345', '0772346511'),
(5, 'User1', 'user1@gmail.com', '12345', '0500111223'),
(6, 'Some User', 'someuser@gmail.com', '12345', '0500120099');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fields_like`
--
ALTER TABLE `fields_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `football_fields`
--
ALTER TABLE `football_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `football_field_img`
--
ALTER TABLE `football_field_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `sport_clubs`
--
ALTER TABLE `sport_clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sport_club_img`
--
ALTER TABLE `sport_club_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fields_like`
--
ALTER TABLE `fields_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `football_fields`
--
ALTER TABLE `football_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `football_field_img`
--
ALTER TABLE `football_field_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sport_clubs`
--
ALTER TABLE `sport_clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sport_club_img`
--
ALTER TABLE `sport_club_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
