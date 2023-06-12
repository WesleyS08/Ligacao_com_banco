-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/06/2023 às 17:46
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `Id_cliente` int(10) UNSIGNED NOT NULL,
  `Cliente` varchar(45) NOT NULL,
  `Descricao` varchar(45) DEFAULT NULL,
  `Modelo_de_compra` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_contato`
--

CREATE TABLE `tb_contato` (
  `Id_contato` int(10) UNSIGNED NOT NULL,
  `TB_Cliente_Id_cliente` int(10) UNSIGNED NOT NULL,
  `Telefone` decimal(12,0) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Celular` decimal(12,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_endereco`
--

CREATE TABLE `tb_endereco` (
  `Id_endereco` int(10) UNSIGNED NOT NULL,
  `TB_Cliente_Id_cliente` int(10) UNSIGNED NOT NULL,
  `Endereco` varchar(45) NOT NULL,
  `CEP` decimal(9,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_entregas`
--

CREATE TABLE `tb_entregas` (
  `Numero_de_rastreamento` int(10) UNSIGNED NOT NULL,
  `TB_Pedido_TB_Cliente_Id_cliente` int(10) UNSIGNED NOT NULL,
  `TB_Pedido_Numero_do_pedido` int(10) UNSIGNED NOT NULL,
  `Forma_de_envio` varchar(14) DEFAULT NULL,
  `Data_de_envio` datetime DEFAULT NULL,
  `Data_de_entrega` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pagamento`
--

CREATE TABLE `tb_pagamento` (
  `id_Pagamento` int(10) UNSIGNED NOT NULL,
  `TB_Pedido_TB_Cliente_Id_cliente` int(10) UNSIGNED NOT NULL,
  `TB_Pedido_Numero_do_pedido` int(10) UNSIGNED NOT NULL,
  `Forma_de_Pagamento` varchar(8) DEFAULT NULL,
  `Desconto` varchar(45) DEFAULT NULL,
  `Anotacao` varchar(45) DEFAULT NULL,
  `Sinal` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_parcelamento`
--

CREATE TABLE `tb_parcelamento` (
  `TB_Pagamento_id_Pagamento` int(10) UNSIGNED NOT NULL,
  `QT_de_parcelas` varchar(2) NOT NULL,
  `Valor_das_parcelas` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedido`
--

CREATE TABLE `tb_pedido` (
  `Numero_do_pedido` int(10) UNSIGNED NOT NULL,
  `TB_Cliente_Id_cliente` int(10) UNSIGNED NOT NULL,
  `TB_Produto_id_produto` int(10) UNSIGNED NOT NULL,
  `Detalhes_do_pedido` varchar(55) DEFAULT NULL,
  `Qt_itens` varchar(3) DEFAULT NULL,
  `DT_do_pedido` datetime DEFAULT NULL,
  `Valor_do_frete` double DEFAULT NULL,
  `Valor_total_dos_itens` double DEFAULT NULL,
  `Valor_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `Nome_produto` varchar(45) NOT NULL,
  `Valor_do_Produto` double DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`Id_cliente`);

--
-- Índices de tabela `tb_contato`
--
ALTER TABLE `tb_contato`
  ADD PRIMARY KEY (`Id_contato`),
  ADD KEY `TB_Cliente_Id_cliente` (`TB_Cliente_Id_cliente`);

--
-- Índices de tabela `tb_endereco`
--
ALTER TABLE `tb_endereco`
  ADD PRIMARY KEY (`Id_endereco`),
  ADD KEY `TB_Cliente_Id_cliente` (`TB_Cliente_Id_cliente`);

--
-- Índices de tabela `tb_entregas`
--
ALTER TABLE `tb_entregas`
  ADD PRIMARY KEY (`Numero_de_rastreamento`),
  ADD KEY `TB_Entregas_FKIndex1` (`TB_Pedido_Numero_do_pedido`,`TB_Pedido_TB_Cliente_Id_cliente`);

--
-- Índices de tabela `tb_pagamento`
--
ALTER TABLE `tb_pagamento`
  ADD PRIMARY KEY (`id_Pagamento`),
  ADD KEY `TB_Pagamento_FKIndex1` (`TB_Pedido_Numero_do_pedido`,`TB_Pedido_TB_Cliente_Id_cliente`);

--
-- Índices de tabela `tb_parcelamento`
--
ALTER TABLE `tb_parcelamento`
  ADD KEY `TB_Parcelamento_FKIndex1` (`TB_Pagamento_id_Pagamento`);

--
-- Índices de tabela `tb_pedido`
--
ALTER TABLE `tb_pedido`
  ADD PRIMARY KEY (`Numero_do_pedido`),
  ADD KEY `TB_Pedido_FKIndex1` (`TB_Cliente_Id_cliente`),
  ADD KEY `TB_Pedido_FKIndex2` (`TB_Produto_id_produto`);

--
-- Índices de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `Id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_contato`
--
ALTER TABLE `tb_contato`
  MODIFY `Id_contato` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_endereco`
--
ALTER TABLE `tb_endereco`
  MODIFY `Id_endereco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_entregas`
--
ALTER TABLE `tb_entregas`
  MODIFY `Numero_de_rastreamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_pagamento`
--
ALTER TABLE `tb_pagamento`
  MODIFY `id_Pagamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_pedido`
--
ALTER TABLE `tb_pedido`
  MODIFY `Numero_do_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `id_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_endereco`
--
ALTER TABLE `tb_endereco`
  ADD CONSTRAINT `tb_endereco_ibfk_1` FOREIGN KEY (`TB_Cliente_Id_cliente`) REFERENCES `tb_cliente` (`Id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
