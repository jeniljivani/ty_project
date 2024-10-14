-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 09:33 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appetizer`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `description`) VALUES
(3, 'Appetizer Restaurant', 'On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word \"and\" and the Little Blind Text should turn around and return to its own, safe country. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner'),
(4, 'Desserts'),
(5, 'Wine Card'),
(6, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Winter Ramos', 'wybico@gmail.com', 'Eum voluptate sit e', 'Est minima velit aut'),
(2, 'Uriah Maxwell', 'kynudyhap@gmail.com', 'Sunt libero totam au', 'Ut odit quidem natus');

-- --------------------------------------------------------

--
-- Table structure for table `items_order`
--

CREATE TABLE `items_order` (
  `id` int(11) NOT NULL,
  `item_list` text NOT NULL,
  `table_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `time_stamp` text NOT NULL DEFAULT current_timestamp(),
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items_order`
--

INSERT INTO `items_order` (`id`, `item_list`, `table_number`, `amount`, `count`, `status`, `time_stamp`, `is_deleted`) VALUES
(1, 'Grilled Beef with potatoes,Khaman Dhokla,drink', 1, 499, 3, 1, '2024-09-30 00:18:54', 1),
(2, 'brownies,drink', 11, 170, 2, 1, '2024-09-30 00:19:03', 1),
(3, 'coco,waffles', 3, 290, 2, 1, '2024-09-30 00:19:08', 1),
(4, 'Khaman Dhokla', 4, 120, 1, 1, '2024-09-30 00:19:17', 1),
(5, 'Grilled Beef with,drink', 2, 445, 2, 1, '2024-09-30 00:19:44', 1),
(6, 'Grilled Beef with,iadi with chatani,brownies', 6, 515, 3, 1, '2024-09-30 00:19:55', 1),
(7, 'cake', 8, 100, 1, 1, '2024-09-30 00:20:06', 1),
(8, 'panner tika masala,rajma chawal,cake', 5, 680, 3, 1, '2024-09-30 00:20:28', 1),
(9, 'waffles', 7, 210, 1, 1, '2024-09-30 00:20:46', 1),
(10, 'butterMilk,soda,mojito', 13, 150, 3, 1, '2024-09-30 00:21:11', 1),
(11, 'icecream', 10, 110, 1, 1, '2024-09-30 00:21:21', 1),
(12, 'Khaman Dhokla,iadi with chatani,tea and coffee', 12, 240, 3, 1, '2024-09-30 00:21:52', 1),
(13, 'kabab,soda', 9, 120, 2, 1, '2024-09-30 00:22:13', 1),
(14, 'Grilled Beef with', 13, 345, 1, 1, '2024-09-30 00:25:52', 1),
(15, 'Khaman Dhokla', 12, 120, 1, 0, '2024-09-30 00:26:18', 0),
(16, 'Grilled Beef with potatoes,Grilled Beef with', 4, 624, 2, 1, '2024-09-30 00:52:12', 1),
(17, 'Grilled Beef with potatoes,Khaman Dhokla,iadi with chatani,dosa,tea and coffee', 1, 659, 5, 0, '2024-09-30 08:34:55', 0),
(18, 'Grilled Beef with potatoes,Grilled Beef with,Khaman Dhokla', 3, 744, 3, 0, '2024-10-14 21:50:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`, `image`, `role_id`) VALUES
(1, 'jenil', 'jenil@gmail.com', '202cb962ac59075b964b07152d234b70', '3991jenil.jpeg', 1),
(10, 'varun kumbhani', 'varun@gmail.com', '202cb962ac59075b964b07152d234b70', '1700varun.jpg', 3),
(11, 'Harsh meshiya', 'harsh@gmail.com', '202cb962ac59075b964b07152d234b70', '10685131chef-3.jpg', 4),
(12, 'test', 'test@gmai.com', '202cb962ac59075b964b07152d234b70', '62121700varun.jpg', 2),
(13, 'akash', 'akash@gmail.com', '202cb962ac59075b964b07152d234b70', 'dd1cb7f55daf970b8b741e7c579e1b9f.jpg', 4),
(14, 'meet', 'meet@gmail.com', '202cb962ac59075b964b07152d234b70', '7922chef-4.jpg', 4),
(16, 'Hardik radaduiya', 'hardik@gmail.com', '202cb962ac59075b964b07152d234b70', '6645882e790fe2f799e9f85c696d299e4008.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `price` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `description`, `image`, `price`, `cat_id`) VALUES
(1, 'Grilled Beef with potatoes', 'Meat, Potatoes, Rice, Tomatoe', '5433breakfast-1.jpg', 279, 1),
(2, 'Grilled Beef with', 'Meat, Potatoes, Rice, Tomatoe', '2024breakfast-2.jpg', 345, 4),
(6, 'Khaman Dhokla', '', '6786KhamanDhokla1.webp', 120, 1),
(7, 'iadi with chatani', 'iadi with chatani', '3300789bg_5.jpg', 100, 0),
(8, 'dosa', '', '8042Plain-Dosa.webp', 140, 1),
(9, 'tea and coffee', 'per cup 10rs', '82691_10a5b343-0378-4596-8afd-cc53f7097ab3.webp', 20, 6),
(10, 'kajukari', '', '4982kaju-masala-recipe-cashew-masala-kaju-kari-kaju-curry-cashew-nut-curry-sri-lanka-sagar-kitchen-.webp', 260, 3),
(11, 'tandoori roti', '', '725975542834.webp', 32, 3),
(12, 'soup', '', '5720Vegetable-Soup-main.jpg', 35, 3),
(13, 'panner tika masala', '', '6508images.jpeg', 280, 3),
(14, 'rajma chawal', '', '2712rajma-chawal-1.jpg', 300, 3),
(15, 'kabab', '', '4709veg-shammi-kabab-recipe-1.webp', 80, 3),
(16, 'jini roll', '', '1091dkbqmue9g7561.jpg', 180, 3),
(17, 'nuddels', '', '7996bbad9959-94a4-40df-9473-e0e069a97479.webp', 240, 2),
(18, 'manchurian', '', '3091iStock-1334115358.jpg', 120, 2),
(19, 'sendwhich', '', '2731vegetarian-grilled-cheese-sandwich-step-by-step-recipe.jpg', 200, 2),
(20, 'panjabi thali', '', '6411628877408582_SKU-0499_0.jpg', 320, 2),
(21, 'gujarati thali', '', '643Vaghareli-khichdi-with-kadhi-ring-bhajiya-WS.jpg', 310, 2),
(22, 'maratathi thali', '', '38151628877408582_SKU-0499_0.jpg', 330, 2),
(23, 'butterMilk', '', '7670Health_benefits_of_buttermilk1716900658.webp', 20, 6),
(24, 'soda', '', '7926colorful-soda-drinks-macro-shot.jpg', 40, 6),
(25, 'mojito', '', '4332strawberry-mojito.jpg', 90, 6),
(26, 'coco', '', '430img_4489.jpg', 80, 6),
(27, 'waffles', '', '6528mini-waffles-1811-500x375.webp', 210, 4),
(28, 'cake', 'only one pices', '1875Rainbow-Cake.jpg', 100, 4),
(29, 'brownies', '', '769brownie-with-vanilla-ice-cream.jpg', 70, 4),
(30, 'icecream', '', '4756Scoops-kinds-ice-cream.webp', 110, 4),
(31, 'drink', 'cold drink', '', 100, 6);

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(510) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `user_id`, `icon`, `title`, `description`, `status`) VALUES
(1, 1, '8664cake-candles-solid.svg', 'Birthday Party', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 1),
(3, 1, '4800handshake-solid.svg', 'Business Meetings', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 1),
(4, 1, '9058champagne-glasses-solid (1).svg', 'Wedding Party', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 1),
(6, 0, '5447breakfast-2.jpg', 'Ut non minim est aut', 'Quidem sint atque o', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` int(11) NOT NULL,
  `table_number` int(11) NOT NULL,
  `reservation_date` text NOT NULL,
  `reservation_time` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `phone`, `table_number`, `reservation_date`, `reservation_time`, `status`) VALUES
(1, 'Rashad Francis', 'mynyho@gmail.com', 2147483647, 3, '2019-09-11', '11:48', 1),
(2, 'Pearl Finch', 'cypalodo@gmail.com', 85858585, 1, '2024-09-26', '12:28', 1),
(3, 'Lavinia Bauer', 'hoboqoc@gmail.com', 2147483647, 1, '2024-09-29', '13:09', 1),
(4, 'Fallon Baker', 'cito@gmail.com', 2147483647, 2, '2024-09-29', '07:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `name`, `email`, `review`, `image`, `status`) VALUES
(2, 'Elizabeth Clarke', 'zylogulory@gmail.com', 'Aute perferendis eli', 'user.png', 1),
(3, 'Xena Price', 'bufeto@gmail.com', 'Voluptatem qui volup', '8_1.webp', 1),
(4, 'Fuller Moran', 'nyxalas@gmail.com', 'Amet optio nesciun', 'user.png', 0),
(10, 'Macy Dean', 'maxiqyjyv@gmail.com', 'Est velit quibusdam', 'user.png', 0),
(11, 'Nelle Watkins', 'cijimo@gmail.com', 'Sit dolore ea elit', '532_1.png', 1),
(12, 'Carissa Hickman', 'nofy@gmail.com', 'Aliquam placeat off', 'user.png', 0),
(13, 'Barrett Cooley', 'zuragew@gmail.com', 'Inventore cupiditate', 'user.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'staff'),
(3, 'manager'),
(4, 'chef');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `image`, `status`) VALUES
(2, 'Our Delicious  ', '7938bg_2.jpg', 1),
(3, 'Our Specialties ', '7938bg_2.jpg', 1),
(9, 'Consequatur eos et', '4142bg_5.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_number`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_order`
--
ALTER TABLE `items_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items_order`
--
ALTER TABLE `items_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
