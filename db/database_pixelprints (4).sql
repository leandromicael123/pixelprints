-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2022 at 11:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_pixelprints`
--

-- --------------------------------------------------------

--
-- Table structure for table `aprovacao`
--

CREATE TABLE `aprovacao` (
  `Codfolha` int(255) NOT NULL,
  `Aprovacao_data` datetime NOT NULL DEFAULT current_timestamp(),
  `Nivel` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aprovacao`
--

INSERT INTO `aprovacao` (`Codfolha`, `Aprovacao_data`, `Nivel`) VALUES
(50, '2022-07-05 17:59:08', 'Montagem');

-- --------------------------------------------------------

--
-- Table structure for table `aprov_necessario`
--

CREATE TABLE `aprov_necessario` (
  `codfolha` int(255) NOT NULL,
  `nivel_necessario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aprov_necessario`
--

INSERT INTO `aprov_necessario` (`codfolha`, `nivel_necessario`) VALUES
(47, 'Faturacao'),
(47, 'Designer'),
(47, 'Montagem'),
(47, 'Producao'),
(48, 'Faturacao'),
(48, 'Designer'),
(48, 'Montagem'),
(48, 'Producao'),
(49, 'Faturacao'),
(49, 'Designer'),
(49, 'Montagem'),
(49, 'Producao'),
(50, 'Faturacao'),
(50, 'Comercial'),
(50, 'Designer'),
(50, 'Montagem'),
(50, 'Producao');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `Codfolha` int(250) NOT NULL,
  `Comentario` varchar(250) NOT NULL,
  `Coduser` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edicao`
--

CREATE TABLE `edicao` (
  `Codedicao` int(255) NOT NULL,
  `Codfolha` int(255) NOT NULL,
  `Pedido_mens` varchar(255) NOT NULL,
  `Ficheirosloc` varchar(255) NOT NULL,
  `Budget_montagem` int(255) NOT NULL,
  `Custo_Montagem` int(255) NOT NULL,
  `Pessoa_Montagem` varchar(255) NOT NULL,
  `Status` varchar(250) NOT NULL,
  `Coduser` int(250) NOT NULL,
  `Datatime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edicao`
--

INSERT INTO `edicao` (`Codedicao`, `Codfolha`, `Pedido_mens`, `Ficheirosloc`, `Budget_montagem`, `Custo_Montagem`, `Pessoa_Montagem`, `Status`, `Coduser`, `Datatime`) VALUES
(16, 47, 'fwesfw', 'asdsa', 124321, 123123, 'dasda', 'Designer', 59, '2022-07-03 22:04:32'),
(17, 48, 'vewvew', 'fdsdfd', 24142, 124, 'fsds', 'Montagem', 59, '2022-07-03 22:35:36'),
(18, 49, 'A descrição é composto por uma descrição', 'sfdfsfds', 1323, 4124, 'fsdfsdfsdfsdf', 'Designer', 59, '2022-07-04 09:40:42'),
(19, 50, 'dasdsa', 'asfsaf', 23412, 4122442, 'fafs', 'Comercial', 59, '2022-07-04 11:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `folha de obra`
--

CREATE TABLE `folha de obra` (
  `Codfolha` int(255) NOT NULL,
  `user_notlogin` int(255) DEFAULT NULL,
  `Utilizador_assoc` int(255) DEFAULT NULL,
  `Status` varchar(40) NOT NULL,
  `Dataadicionada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `folha de obra`
--

INSERT INTO `folha de obra` (`Codfolha`, `user_notlogin`, `Utilizador_assoc`, `Status`, `Dataadicionada`) VALUES
(47, NULL, 59, 'Montagem', '2022-07-03 22:04:32'),
(48, NULL, 59, 'Montagem', '2022-07-03 22:35:36'),
(49, 89, NULL, 'Montagem', '2022-07-04 09:40:42'),
(50, NULL, 59, 'Montagem', '2022-07-04 11:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `niveis`
--

CREATE TABLE `niveis` (
  `Nivel` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `niveis`
--

INSERT INTO `niveis` (`Nivel`) VALUES
('Arquivado'),
('Comercial'),
('Designer'),
('Faturacao'),
('Montagem'),
('Producao'),
('Utilizador');

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `Utilizador_assoc` int(255) NOT NULL,
  `uniqueid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resetpassword`
--

INSERT INTO `resetpassword` (`Utilizador_assoc`, `uniqueid`) VALUES
(59, '49094407962b43e7d68963');

-- --------------------------------------------------------

--
-- Table structure for table `tipoconta`
--

CREATE TABLE `tipoconta` (
  `Tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipoconta`
--

INSERT INTO `tipoconta` (`Tipo`) VALUES
('Cliente-final'),
('Revendedor');

-- --------------------------------------------------------

--
-- Table structure for table `utilizador_bd`
--

CREATE TABLE `utilizador_bd` (
  `Cod_id` int(255) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `NIF` int(9) NOT NULL,
  `Morada` varchar(11) NOT NULL,
  `Codpostal` int(11) NOT NULL,
  `Telefone_pess` int(11) NOT NULL,
  `Nomeempresa` varchar(100) NOT NULL,
  `tipoconta` varchar(30) NOT NULL,
  `Nivel` varchar(40) NOT NULL,
  `Datadeentrada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilizador_bd`
--

INSERT INTO `utilizador_bd` (`Cod_id`, `Nome`, `Email`, `Password`, `NIF`, `Morada`, `Codpostal`, `Telefone_pess`, `Nomeempresa`, `tipoconta`, `Nivel`, `Datadeentrada`) VALUES
(59, 'leandro bernardo', 'feroleandro@gmail.com', '$2y$10$pBq0UQyzMQWVaUCYuInjl.UmGKMpSNNvNUDo1bQLa30JotdxNX5/C', 124241412, 'Rua Dos Mal', 3112312, 935886200, 'Empresa da julia', 'Revendedor', 'Montagem', '2022-06-01 17:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `utilizador_non_log`
--

CREATE TABLE `utilizador_non_log` (
  `Cod_id` int(255) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `NIF` int(9) NOT NULL,
  `Telefone_pess` int(14) NOT NULL,
  `Pessoa-contacto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilizador_non_log`
--

INSERT INTO `utilizador_non_log` (`Cod_id`, `Nome`, `Email`, `NIF`, `Telefone_pess`, `Pessoa-contacto`) VALUES
(80, 'dadssadasd', '', 0, 0, 0),
(81, 'casasccs', 'ascascacs', 0, 0, 0),
(82, 'casasccs', 'ascascacs', 0, 0, 0),
(83, 'casasccs', 'ascascacs', 0, 0, 0),
(84, 'casasccs', 'ascascacs', 0, 0, 0),
(85, 'casasccs', 'ascascacs', 0, 0, 0),
(86, 'casasccs', 'ascascacs', 0, 0, 0),
(87, 'casasccs', 'ascascacs', 0, 0, 0),
(88, 'casasccs', 'ascascacs', 0, 0, 0),
(89, 'casasccs', 'ascascacs', 0, 0, 0),
(90, 'casasccs', 'ascascacs', 0, 0, 0),
(91, 'casasccs', 'ascascacs', 0, 0, 0),
(92, 'casasccs', 'ascascacs', 0, 0, 0),
(93, 'casasccs', 'ascascacs', 0, 0, 0),
(94, 'casasccs', 'ascascacs', 0, 0, 0),
(95, 'casasccs', 'ascascacs', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aprovacao`
--
ALTER TABLE `aprovacao`
  ADD KEY `Codfolha` (`Codfolha`),
  ADD KEY `Nivel` (`Nivel`);

--
-- Indexes for table `aprov_necessario`
--
ALTER TABLE `aprov_necessario`
  ADD KEY `nivel_necessario` (`nivel_necessario`),
  ADD KEY `aprov_necessario_ibfk_3` (`codfolha`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD KEY `comentarios_ibfk_1` (`Codfolha`),
  ADD KEY `comentarios_ibfk_2` (`Coduser`);

--
-- Indexes for table `edicao`
--
ALTER TABLE `edicao`
  ADD PRIMARY KEY (`Codedicao`),
  ADD KEY `edicao_ibfk_1` (`Status`),
  ADD KEY `edicao_ibfk_2` (`Codfolha`),
  ADD KEY `edicao_ibfk_3` (`Coduser`);

--
-- Indexes for table `folha de obra`
--
ALTER TABLE `folha de obra`
  ADD PRIMARY KEY (`Codfolha`),
  ADD KEY `Status` (`Status`),
  ADD KEY `Utilizador_assoc` (`Utilizador_assoc`),
  ADD KEY `user_notlogin` (`user_notlogin`);

--
-- Indexes for table `niveis`
--
ALTER TABLE `niveis`
  ADD PRIMARY KEY (`Nivel`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`uniqueid`),
  ADD KEY `Utilizador_assoc` (`Utilizador_assoc`);

--
-- Indexes for table `tipoconta`
--
ALTER TABLE `tipoconta`
  ADD PRIMARY KEY (`Tipo`);

--
-- Indexes for table `utilizador_bd`
--
ALTER TABLE `utilizador_bd`
  ADD PRIMARY KEY (`Cod_id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Email_2` (`Email`),
  ADD KEY `Nivel` (`Nivel`),
  ADD KEY `tipoconta` (`tipoconta`);

--
-- Indexes for table `utilizador_non_log`
--
ALTER TABLE `utilizador_non_log`
  ADD PRIMARY KEY (`Cod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `edicao`
--
ALTER TABLE `edicao`
  MODIFY `Codedicao` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `folha de obra`
--
ALTER TABLE `folha de obra`
  MODIFY `Codfolha` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `utilizador_bd`
--
ALTER TABLE `utilizador_bd`
  MODIFY `Cod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `utilizador_non_log`
--
ALTER TABLE `utilizador_non_log`
  MODIFY `Cod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aprovacao`
--
ALTER TABLE `aprovacao`
  ADD CONSTRAINT `aprovacao_ibfk_2` FOREIGN KEY (`Nivel`) REFERENCES `niveis` (`Nivel`),
  ADD CONSTRAINT `aprovacao_ibfk_3` FOREIGN KEY (`Codfolha`) REFERENCES `folha de obra` (`Codfolha`);

--
-- Constraints for table `aprov_necessario`
--
ALTER TABLE `aprov_necessario`
  ADD CONSTRAINT `aprov_necessario_ibfk_2` FOREIGN KEY (`nivel_necessario`) REFERENCES `niveis` (`Nivel`),
  ADD CONSTRAINT `aprov_necessario_ibfk_3` FOREIGN KEY (`codfolha`) REFERENCES `folha de obra` (`Codfolha`) ON DELETE CASCADE;

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`Codfolha`) REFERENCES `folha de obra` (`Codfolha`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`Coduser`) REFERENCES `utilizador_bd` (`Cod_id`) ON DELETE CASCADE;

--
-- Constraints for table `edicao`
--
ALTER TABLE `edicao`
  ADD CONSTRAINT `edicao_ibfk_1` FOREIGN KEY (`Status`) REFERENCES `niveis` (`Nivel`) ON DELETE CASCADE,
  ADD CONSTRAINT `edicao_ibfk_2` FOREIGN KEY (`Codfolha`) REFERENCES `folha de obra` (`Codfolha`) ON DELETE CASCADE,
  ADD CONSTRAINT `edicao_ibfk_3` FOREIGN KEY (`Coduser`) REFERENCES `utilizador_bd` (`Cod_id`) ON DELETE CASCADE;

--
-- Constraints for table `folha de obra`
--
ALTER TABLE `folha de obra`
  ADD CONSTRAINT `folha de obra_ibfk_2` FOREIGN KEY (`Utilizador_assoc`) REFERENCES `utilizador_bd` (`Cod_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `folha de obra_ibfk_4` FOREIGN KEY (`Status`) REFERENCES `niveis` (`Nivel`) ON DELETE CASCADE,
  ADD CONSTRAINT `folha de obra_ibfk_5` FOREIGN KEY (`user_notlogin`) REFERENCES `utilizador_non_log` (`Cod_id`) ON DELETE CASCADE;

--
-- Constraints for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD CONSTRAINT `resetpassword_ibfk_1` FOREIGN KEY (`Utilizador_assoc`) REFERENCES `utilizador_bd` (`Cod_id`);

--
-- Constraints for table `utilizador_bd`
--
ALTER TABLE `utilizador_bd`
  ADD CONSTRAINT `utilizador_bd_ibfk_1` FOREIGN KEY (`Nivel`) REFERENCES `niveis` (`Nivel`),
  ADD CONSTRAINT `utilizador_bd_ibfk_2` FOREIGN KEY (`tipoconta`) REFERENCES `tipoconta` (`Tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
