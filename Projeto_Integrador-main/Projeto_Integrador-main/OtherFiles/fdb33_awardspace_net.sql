--
-- Database: `4005147_db`
--
CREATE DATABASE IF NOT EXISTS `Ocelot`;
USE `Ocelot`;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `description`) VALUES
(1, 'Nike', 'Marca conhecida por sua inovação e qualidade em calçados esportivos.'),
(2, 'Adidas', 'Uma das marcas líderes em artigos esportivos, incluindo tênis de alto desempenho.'),
(3, 'Puma', 'Marca alemã reconhecida por seu estilo único e design diferenciado de calçados esportivos.'),
(4, 'Skechers', 'Marca especializada em calçados esportivos com ênfase em conforto e estilo moderno.'),
(5, 'Asics', 'Marca conhecida por sua tecnologia avançada em calçados esportivos, especialmente tênis de corrida.');

-- --------------------------------------------------------

--
-- Table structure for table `shoe`
--

CREATE TABLE `shoe` (
  `id` int(11) NOT NULL,
  `model` varchar(30) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `data_upload` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoe`
--

INSERT INTO `shoe` (`id`, `model`, `brand_id`, `user_id`, `price`, `size`, `color`, `path`, `file_name`, `data_upload`) VALUES
(1, 'Nagatoro', 1, 1, '2367.99', '', '', '../Assets/ImageFiles/649de61ded348.jpg', '50380295ed51f7d50c14d250c43bff5a.jpg', '2023-06-29 20:14:21'),
(2, 'Fone', 5, 1, '199.99', '', '', '../Assets/ImageFiles/649dea7d34c36.png', 'JBL_TUNE_125TWS_Product Image_Front Case_Black.png', '2023-06-29 20:33:01'),
(3, 'FoneFoneFone', 5, 1, '213.22', '', '', '../Assets/ImageFiles/649dea9ae191d.png', 'fone_jbl_tune_125tws_18871_2_cd101bea647e0543abae8a9515a84aeb.png', '2023-06-29 20:33:30'),
(4, 'Mais um Teste', 1, 1, '999.99', '', '', '../Assets/ImageFiles/649deb76442fa.jpg', 'Gon-Killua.jpg', '2023-06-29 20:37:10'),
(10, 'awetgw', 5, 7, '456.45', '', '', '../Assets/ImageFiles/64da7fb0cbb9e.jpg', 'download.jpg', '2023-08-14 19:25:36'),
(7, 'Tênis Puma RS-X Pikachu', 3, 5, '449.99', '', '', '../Assets/ImageFiles/649df4218f5b8.jpg', 'png.jpg', '2023-06-29 21:14:09'),
(8, 'Tênis Nike Mike ', 1, 5, '230.69', '', '', '../Assets/ImageFiles/649df44177e26.jpg', 'EPj0gMqX4AEASX6.jpg', '2023-06-29 21:14:41'),
(9, 'Air Jordan 1 Retro High OG', 1, 5, '979.99', '', '', '../Assets/ImageFiles/649df5274b507.jpg', '41bXuQfiGuL._AC_.jpg', '2023-06-29 21:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `PasswordConfirmation` varchar(255) NOT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoe`
--
ALTER TABLE `shoe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoe`
--
ALTER TABLE `shoe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


