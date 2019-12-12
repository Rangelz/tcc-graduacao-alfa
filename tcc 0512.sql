-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Dez-2019 às 23:08
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome_categoria`) VALUES
(19, 'Carne bovina'),
(20, 'Carne suína'),
(21, 'Frango');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sobrenome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `endereco` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telefone` varchar(11) CHARACTER SET utf8 NOT NULL,
  `cpf` varchar(11) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `sobrenome`, `endereco`, `email`, `telefone`, `cpf`) VALUES
(1, 'Rangel', 'Zanelato', 'Rua Gazin', 'rangel@gazin.com', '56156156485', '09177456486'),
(2, 'Aldecir', 'Zanelato', 'Rua Gazin', 'adelcir@gazin.com.br', '961564564', '09177771907');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `cpf_cnpj` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id_fornecedor`, `nome`, `sobrenome`, `endereco`, `email`, `telefone`, `cpf_cnpj`) VALUES
(36, 'McBurnes', 'Feliz', 'Rua Da frente do Posto', 'burnes@burnes.com', '153456456', '5413524132454'),
(37, 'Burnes passa', 'eu', 'Vou passar', 'meajuda@apassar.com', '4156456456', '09187485445');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores_produtos`
--

CREATE TABLE `fornecedores_produtos` (
  `id_fornecedor` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `custo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores_produtos`
--

INSERT INTO `fornecedores_produtos` (`id_fornecedor`, `id_produto`, `custo`) VALUES
(36, 44, 10),
(36, 51, 10.5),
(37, 44, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` float NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome`, `quantidade`, `preco`, `id_categoria`, `id_fornecedor`) VALUES
(44, 'Costela ripa', 1005, 25, 19, 37),
(45, 'Costela suína', 1038, 25, 20, 36),
(46, 'Frango recheado inteiro', 1001, 30, 21, 37),
(47, 'Picanha', 1045, 50, 19, 37),
(48, 'Asinha de Frango', 998, 12, 21, 37),
(51, 'Franguinho na panela', 50, 20.5, 21, 36);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_vendas`
--

CREATE TABLE `produtos_vendas` (
  `id_produtos_vendas` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` float NOT NULL,
  `valor_unitario` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos_vendas`
--

INSERT INTO `produtos_vendas` (`id_produtos_vendas`, `id_produto`, `id_venda`, `quantidade`, `valor_total`, `valor_unitario`) VALUES
(22, 45, 21, 2, 50, 25),
(23, 45, 22, 5, 125, 25),
(24, 46, 22, 9, 270, 30),
(25, 44, 23, 10, 250, 25),
(26, 47, 23, 5, 225, 45),
(27, 48, 23, 2, 24, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `user`, `email`, `senha`) VALUES
(10, 'dsdsds', 'admin', '', '$2y$12$ypHVQYnrXJI0GfhQABAPs.5T1eCH2vrQGo28FpJUQW6DHQ5AKNhXW'),
(11, 'admiiiin', 'teste', 'admin@teste.com', '202cb962ac59075b964b07152d234b70'),
(12, 'dsdsds', 'admin2', 'dsdsds@ds.com', 'd41d8cd98f00b204e9800998ecf8427e');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id_venda` int(11) NOT NULL,
  `total_venda` float NOT NULL,
  `dataVenda` date NOT NULL,
  `pagamento` varchar(50) CHARACTER SET utf8 NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id_venda`, `total_venda`, `dataVenda`, `pagamento`, `id_cliente`) VALUES
(9, 3020, '2019-11-30', 'credito', 0),
(10, 3040, '2019-11-30', 'credito', 1),
(11, 3040, '2019-11-30', 'credito', 1),
(12, 3040, '2019-11-30', 'credito', 1),
(13, 1510, '2019-11-30', 'credito', 1),
(14, 2, '2019-11-30', 'credito', 1),
(15, 0, '2019-12-02', 'credito', 1),
(16, 7500, '2019-12-02', 'credito', 1),
(17, 0, '2019-12-02', 'credito', 1),
(18, 0, '2019-12-02', 'credito', 1),
(19, 0, '2019-12-02', 'credito', 1),
(20, 0, '2019-12-02', 'credito', 1),
(21, 50, '2019-12-02', 'credito', 1),
(22, 395, '2019-12-02', 'credito', 1),
(23, 499, '2019-12-02', 'vista', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices para tabela `fornecedores_produtos`
--
ALTER TABLE `fornecedores_produtos`
  ADD PRIMARY KEY (`id_fornecedor`,`id_produto`),
  ADD KEY `fk_fornecedores_has_produtos_produtos1_idx` (`id_produto`),
  ADD KEY `fk_fornecedores_has_produtos_fornecedores1_idx` (`id_fornecedor`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fk_produtos_categorias` (`id_categoria`) USING BTREE;

--
-- Índices para tabela `produtos_vendas`
--
ALTER TABLE `produtos_vendas`
  ADD PRIMARY KEY (`id_produtos_vendas`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_venda` (`id_venda`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id_venda`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `produtos_vendas`
--
ALTER TABLE `produtos_vendas`
  MODIFY `id_produtos_vendas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `fornecedores_produtos`
--
ALTER TABLE `fornecedores_produtos`
  ADD CONSTRAINT `fk_fornecedores_has_produtos_fornecedores1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id_fornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fornecedores_has_produtos_produtos1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produtos_vendas`
--
ALTER TABLE `produtos_vendas`
  ADD CONSTRAINT `produtos_vendas_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`),
  ADD CONSTRAINT `produtos_vendas_ibfk_2` FOREIGN KEY (`id_venda`) REFERENCES `vendas` (`id_venda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
