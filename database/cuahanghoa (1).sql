-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2022 at 12:30 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuahanghoa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(148, 20, 22, 'Light as a feather', 22, 1, 'giohoa-2.jpg'),
(149, 20, 27, 'Great flourishing', 34, 1, 'khaitruong1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(13, 14, 'shaikh anas', 'shaikh@gmail.com', '0987654321', 'hi, how are you?'),
(14, 20, 'admin111', 'admin@gmail.com', '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(17, 14, 'shaikh anas', '0987654321', 'shaikh@gmail.com', 'credit card', 'flat no. 321, jogeshwari, mumbai, india - 654321', ', cottage rose (3) , pink bouquet (1) , yellow queen rose (1) ', 80, '11-Mar-2022', 'pending'),
(18, 14, 'shaikh anas', '1234567899', 'shaikh@gmail.com', 'paypal', 'flat no. 321, jogeshwari, mumbai, india - 654321', ', yellow queen rose (1) , pink rose (2) ', 40, '11-Mar-2022', 'completed'),
(19, 16, 'Lê Văn Truyền', '123', 'levantruyen57@gmail.com', 'cash on delivery', 'flat no. tam xuab, bich ngo, dn, Vietnam - 2', ', pink rose (1) , cottage rose (1) ', 27, '13-Nov-2022', 'pending'),
(20, 20, 'Lê Văn Truyền', '', 'levantruyen57@gmail.com', 'cash on delivery', 'flat no. tam xuab, bich ngo, dn, Vietnam - 2', ', Đại hồng phát (1) ', 24, '01-Dec-2022', 'pending'),
(21, 20, 'Lê Văn Truyền', '', 'levantruyen57@gmail.com', 'cash on delivery', 'flat no. tam xuab, bich ngo, dn, Vietnam - 2', ', Nhẹ tựa lông hồng (1) ', 22, '04-Dec-2022', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image`) VALUES
(21, 'Blue wave', 'Blue wave is a flower basket with the main color being blue, bringing a very pleasant and comfortable feeling. The green wave is like a young girl of eighteen, fresh and green, full of life, experiencing a beautiful youth with so many ambitions and dreams. Green corrugated iron flower basket is very suitable for birthday gifts for friends and loved ones.', 23, 'giohoa-1.jpg'),
(22, 'Light as a feather', 'The flower basket is as light as pink feathers with a lovely color, expressing purity and innocence, bringing positive connotations.', 22, 'giohoa-2.jpg'),
(23, 'Run towards you', 'Running towards him is a basket of pink and purple flowers with a message of an offer to start a love', 31, 'giohoa-3.jpg'),
(24, 'The world in you', 'The world in me: David Austin traded 15 years of youth to create this wonderful flower, and I will exchange this youth to be with you', 22, 'giohoa-6.jpg'),
(25, 'Suitable choice', 'An appropriate choice is a flower basket with soft and romantic white and pink tones. The flower basket makes people think of an innocent, pure and gentle girl.', 33, 'giohoa-6.jpg'),
(26, 'When the dream comes', 'When the dream is about a beautiful flower basket with orange color full of charm and elegance; This is a delicate gift that is suitable for giving to successful women.', 22, 'giohoa7.jpg'),
(27, 'Great flourishing', '\"Hung\" means promotion, prosperity, great benefits, abundance of fortune; peace and wealth for a lifetime, become a rich man. \"Prosperity\" means prosperity, growth and development; the intention is to always take \"need, thrift, integrity, righteousness\" as a life goal; always try to rise up in all circumstances to achieve the highest results, have the best life. The opening flower shelf of Dai Phat flourishing in May will bring full meaning to the opening day.', 34, 'khaitruong1.jpg'),
(28, 'All things auspicious', 'The word \"sand\" means auspicious, the word \"wall\" stands for good luck. The two words \"Cat wall\" carry the message of good deeds and good omens. And in the mind of each person always wishes and wishes for their loved ones to always wish for anything, to wish to see, to all be favorable. So the auspicious flower shelf is a great choice to give good wishes to the other party on your behalf.', 31, 'khaitruong2.jpg'),
(29, 'Opening Hong Phat', 'Happy opening greetings are always good wishes; that the guests often give to the owner of the business unit when participating in the opening ceremony. Hong Phat opening wishes can be understood as good luck and meaningful wishes; Wish the sales business prosper, business business smoothly, money quickly fill the wallet; met many great successes, radiant, prosperous and prosperous.', 12, 'khaitruong3.jpg'),
(30, 'Dai Hong Phat', 'Happy opening greetings are always good wishes; that the guests often give to the owner of the business unit when participating in the opening ceremony. Hong Phat opening wishes can be understood as good luck and meaningful wishes; Wish the sales business prosper, business business smoothly, money quickly fill the wallet; met many great successes, radiant, prosperous and prosperous.', 24, 'khaitruong4.jpg'),
(31, 'Opening flower shelf', '\"Hung\" means promotion, prosperity, great benefits, abundance of fortune; peace and wealth for a lifetime, become a rich man. \"Prosperity\" means prosperity, growth and development; the intention is to always take \"need, thrift, integrity, righteousness\" as a life goal; always try to rise up in all circumstances to achieve the highest results, have the best life. The opening flower shelf of Dai Phat flourishing in May will bring full meaning to the opening day.', 34, 'khaitruong5.jpg'),
(32, 'Energy for you', 'Energy for you - a beautiful bouquet of purple-pink flowers - outstanding flower basket with O\'hara and Peony roses symbolizing nobility and serenity.', 33, 'khaitruong6.jpg'),
(33, 'The way to the flower domain', 'The way to the flower domain: The bouquet of pink and orange peonies is warm and cheerful, expressing many different good meanings. A great gift for a loved one.', 45, 'bohoa1.jpg'),
(34, 'Cloud legs', 'Cloud legs are gentle baby bouquets, as fragile as clouds; symbolizes pure and innocent love; pure white by the fragile, ethereal beauty brought by the beautiful little flowers.', 112, 'bohoa3.jpg'),
(35, 'Peace', 'Peace flower bouquet has vibrant, delicate, different and unique colors. Full beauty, modern, elegant, romantic, luxurious captivates people.', 32, 'bohoa4.jpg'),
(36, 'Sunny day on', 'A bouquet of pure white flowers, representing pure innocence. The purity, sacred and eternal love of the couple', 20, 'bohoa5.jpg'),
(37, 'Happy', 'Energy for you - a beautiful bouquet of purple-pink flowers - outstanding flower basket with O\'hara and Peony roses symbolizing nobility and serenity.', 21, 'bohoa2.jpg'),
(38, 'Happy as the first', 'Peace flower bouquet has vibrant, delicate, different and unique colors. Full beauty, modern, elegant, romantic, luxurious captivates people.', 45, 'bohoa7.jpg'),
(39, 'Bouquet of blue roses', 'Giving green roses is a great way to express love to someone. Especially on holidays, anniversaries, birthdays, etc.; Sending a bouquet of borage roses as a congratulation will be both unique and different and full of meaning and joy.', 20, 'sn1.jpg'),
(40, 'Was he in love?', 'Bouquet Is You In Love - The perfect combination of strawberry cream roses, purple and white baby. It symbolizes pure, budding love', 21, 'sn2.jpg'),
(41, 'Right person at the right time', 'Kahala roses are coral pink with a little pink mixed with orange to create a unique and rare color.', 34, 'sn3.jpg'),
(42, 'Love', 'Giving green roses is a great way to express love to someone. Especially on holidays, anniversaries, birthdays, etc.; Sending a bouquet of borage roses as a congratulation will be both unique and different and full of meaning and joy.', 32, 'sn4.jpg'),
(43, 'Give me love', 'Love You Flowers Bouquet has a pure and pure pink and white color that attracts all eyes and has a magical charm.', 54, 'sn5.jpg'),
(44, 'An autumn morning', 'An early autumn is a bunch of colorful flowers like a garden full of sweet and fragrant flowers in miniature; captivate many people.', 67, 'sn6.jpg'),
(45, 'Two more love', 'Mayflower believes that pink and tenderness are the closest symbols of a faithful love over the years, lasting, symbolizing happiness.', 45, 'ht1.jpg'),
(46, 'Bó cúc họa mi', 'Cúc họa mi – loài hoa loài hoa tượng trưng cho tình yêu thầm lặng, sự mong manh và thuần khiết; làm say đắm triệu con tim.', 67, 'ht3.jpg'),
(47, 'Bó hoa baby trong anh', 'Bó hoa baby trong anh – bó hoa được kết tinh bởi những bông hoa bi xinh nhất. Bó hoa mang đến một nét đẹp dịu dàng mà vẫn tươi vui.', 87, 'ht4.jpg'),
(48, 'Bó hoa ban mai', 'Hoa hồng xanh có ý nghĩa thể hiện tia sáng đầu tiên của tình yêu, một sự mê mẫn và cảm giác bị hớp hồn.', 43, 'ht5.jpg'),
(49, 'Bó hoa cà phê tình yêu', 'Một bó hoa cà phê tình yêu gửi đến người mình thương . Thay lời nói lên tất cả tình cảm mà mình dành cho họ', 32, 'ht6.jpg'),
(50, 'Bó hoa cam lửa', 'Bó hoa hồng cam lửa rực rỡ là món quà tốt nhất cho người thân, đối tác, bạn bè, đồng nghiệp. Trong phong thủy màu cam rất tốt cho cung danh vọng và cung tình duyên.', 34, 'ht2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `send_email`
--

CREATE TABLE `send_email` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `send_email`
--

INSERT INTO `send_email` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(4, 20, 22, 'Light as a feather', 22, 1, 'giohoa-2.jpg'),
(5, 20, 27, 'Great flourishing', 34, 1, 'khaitruong1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `sex` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `sex`) VALUES
(20, 'lê', 'levantruyen57@gmail.com', '111', 'user', 'male'),
(21, 'user', 'user@gmail.com', '123', 'user', 'female'),
(29, 'admin', 'truyen@gmail.com', '1111', 'user', 'male'),
(31, 'admin', 'truyen1@gmail.com', '111', 'user', 'male'),
(33, 'admin', '123@gmail.com', '111', 'user', 'female'),
(36, 'admin', '123456@gmail.com', '111', 'admin', 'admin'),
(37, 'admin11', '1234545@gmail.com', '123', 'admin', 'male'),
(38, 'admin', 'admin1@gmail.com', '123', 'admin', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_email`
--
ALTER TABLE `send_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `send_email`
--
ALTER TABLE `send_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
