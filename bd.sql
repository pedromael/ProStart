-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/07/2024 às 18:50
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
-- Banco de dados: `olx`
--
CREATE DATABASE IF NOT EXISTS `olx` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `olx`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_produto`
--

CREATE TABLE `categoria_produto` (
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(75) NOT NULL,
  `idade_minima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_user_dest` int(11) NOT NULL,
  `data_registro` int(11) NOT NULL,
  `conteudo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `preco_produtos`
--

CREATE TABLE `preco_produtos` (
  `id_preco` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(75) NOT NULL,
  `data_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `stock_produtos`
--

CREATE TABLE `stock_produtos` (
  `id_stock` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `caso` varchar(20) NOT NULL,
  `qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `transacoes`
--

CREATE TABLE `transacoes` (
  `id_transacao` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_user_dest` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `data_fim_transacao` datetime NOT NULL,
  `data_registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(75) NOT NULL,
  `email` text NOT NULL,
  `indereco` varchar(250) NOT NULL,
  `username` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria_produto`
--
ALTER TABLE `categoria_produto`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Índices de tabela `preco_produtos`
--
ALTER TABLE `preco_produtos`
  ADD PRIMARY KEY (`id_preco`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `stock_produtos`
--
ALTER TABLE `stock_produtos`
  ADD PRIMARY KEY (`id_stock`);

--
-- Índices de tabela `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`id_transacao`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria_produto`
--
ALTER TABLE `categoria_produto`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `preco_produtos`
--
ALTER TABLE `preco_produtos`
  MODIFY `id_preco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `stock_produtos`
--
ALTER TABLE `stock_produtos`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `id_transacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
--
-- Banco de dados: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Despejando dados para a tabela `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"olx\",\"table\":\"stock_produtos\"},{\"db\":\"olx\",\"table\":\"transacoes\"},{\"db\":\"olx\",\"table\":\"preco_produtos\"},{\"db\":\"olx\",\"table\":\"produtos\"},{\"db\":\"olx\",\"table\":\"usuarios\"},{\"db\":\"pro_start_outros\",\"table\":\"visto\"},{\"db\":\"pro_start_outros\",\"table\":\"lido\"},{\"db\":\"pro_start\",\"table\":\"cmt\"},{\"db\":\"pro_start_outros\",\"table\":\"gosto\"},{\"db\":\"pro_start_outros\",\"table\":\"versoes_codigos\"}]');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Despejando dados para a tabela `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-07-20 16:50:27', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"pt_BR\",\"NavigationWidth\":653}');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Índices de tabela `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Índices de tabela `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Índices de tabela `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Índices de tabela `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Índices de tabela `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Índices de tabela `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Índices de tabela `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Índices de tabela `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Índices de tabela `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Índices de tabela `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Índices de tabela `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Índices de tabela `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Índices de tabela `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Índices de tabela `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Índices de tabela `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Índices de tabela `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Índices de tabela `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Banco de dados: `pro_start`
--
CREATE DATABASE IF NOT EXISTS `pro_start` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pro_start`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_user_dest` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `texto` varchar(500) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `chat`
--

INSERT INTO `chat` (`id_chat`, `id_user`, `id_user_dest`, `id_doc`, `texto`, `data`) VALUES
(1, 2, 1, 0, 'na cara dos idiota', '2020-01-01 02:29:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cmt`
--

CREATE TABLE `cmt` (
  `id_cmt` int(11) NOT NULL,
  `id_pbl` int(11) NOT NULL,
  `id_cmt_res` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `texto` varchar(250) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `cmt`
--

INSERT INTO `cmt` (`id_cmt`, `id_pbl`, `id_cmt_res`, `id_user`, `id`, `tipo`, `texto`, `data`) VALUES
(1, 0, 0, 2, 1, 'pbl', 'boa', '2020-01-01 02:30:14'),
(2, 0, 0, 2, 1, 'pbl', 'boa', '2020-01-01 02:30:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `codigos`
--

CREATE TABLE `codigos` (
  `id_code` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `titulo` int(11) NOT NULL,
  `linguagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comunidade`
--

CREATE TABLE `comunidade` (
  `id_comunidade` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome` varchar(75) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Despejando dados para a tabela `comunidade`
--

INSERT INTO `comunidade` (`id_comunidade`, `id_user`, `nome`, `descricao`, `data`) VALUES
(1, 2, 'BackManact', 'seja bem vindo', '2020-01-01 02:28:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_user_dest` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `id_user`, `id_user_dest`, `data`) VALUES
(1, 2, 1, '2020-01-01 02:26:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `doc`
--

CREATE TABLE `doc` (
  `id_doc` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `indereco` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia`
--

CREATE TABLE `noticia` (
  `id_noticia` int(11) NOT NULL,
  `conteudo` varchar(1500) NOT NULL,
  `fonte` varchar(100) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pbl`
--

CREATE TABLE `pbl` (
  `id_pbl` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `texto` varchar(500) NOT NULL,
  `data` datetime NOT NULL,
  `id_comunidade` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `pbl`
--

INSERT INTO `pbl` (`id_pbl`, `id_user`, `texto`, `data`, `id_comunidade`) VALUES
(1, 1, 'oi pessoal', '2020-01-01 02:11:18', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `stories`
--

CREATE TABLE `stories` (
  `id_storie` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `indereco_img` text NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `senha` text NOT NULL,
  `code_nome` varchar(20) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nome`, `email`, `id_pais`, `senha`, `code_nome`, `data`) VALUES
(1, 'pedro manue', 'pedro@gmail.com', 7, 'c6cc8094c2dc07b700ffcc36d64e2138', 'pedroM', '2020-01-01 02:02:34'),
(2, 'Ariel Manuel', 'ariel@gmail.com', 7, '4900d0a19b6894a4a514e9ff3afcc2c0', 'arielM', '2020-01-01 02:23:30');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Índices de tabela `cmt`
--
ALTER TABLE `cmt`
  ADD PRIMARY KEY (`id_cmt`);

--
-- Índices de tabela `codigos`
--
ALTER TABLE `codigos`
  ADD PRIMARY KEY (`id_code`);

--
-- Índices de tabela `comunidade`
--
ALTER TABLE `comunidade`
  ADD PRIMARY KEY (`id_comunidade`);

--
-- Índices de tabela `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Índices de tabela `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`id_doc`);

--
-- Índices de tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Índices de tabela `pbl`
--
ALTER TABLE `pbl`
  ADD PRIMARY KEY (`id_pbl`);

--
-- Índices de tabela `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id_storie`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cmt`
--
ALTER TABLE `cmt`
  MODIFY `id_cmt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `codigos`
--
ALTER TABLE `codigos`
  MODIFY `id_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comunidade`
--
ALTER TABLE `comunidade`
  MODIFY `id_comunidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `doc`
--
ALTER TABLE `doc`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pbl`
--
ALTER TABLE `pbl`
  MODIFY `id_pbl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `stories`
--
ALTER TABLE `stories`
  MODIFY `id_storie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Banco de dados: `pro_start_outros`
--
CREATE DATABASE IF NOT EXISTS `pro_start_outros` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pro_start_outros`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `areas_programacao`
--

CREATE TABLE `areas_programacao` (
  `id_area` int(11) NOT NULL,
  `nome` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cmt_mencionar`
--

CREATE TABLE `cmt_mencionar` (
  `id_cmt_mencionar` int(11) NOT NULL,
  `id_cmt` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comunidade_integrante`
--

CREATE TABLE `comunidade_integrante` (
  `id_integrante` int(11) NOT NULL,
  `id_comunidade` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contacto_aceite`
--

CREATE TABLE `contacto_aceite` (
  `id` int(11) NOT NULL,
  `id_contacto` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conteudo_de_lista`
--

CREATE TABLE `conteudo_de_lista` (
  `id_conteudo` int(11) NOT NULL,
  `id_lista` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `denucias`
--

CREATE TABLE `denucias` (
  `id_denuncia` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `escolha_conteudo`
--

CREATE TABLE `escolha_conteudo` (
  `id_e_conteudo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `positivo` tinyint(1) NOT NULL,
  `nivel` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gosto`
--

CREATE TABLE `gosto` (
  `id_gosto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `positivo` varchar(20) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `gosto`
--

INSERT INTO `gosto` (`id_gosto`, `id_user`, `id`, `tipo`, `positivo`, `data`) VALUES
(1, 1, 1, 'pbl', '1', '2020-01-01 02:16:50'),
(2, 2, 1, 'pbl', '1', '2020-01-01 02:27:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `gostos_do_usuario`
--

CREATE TABLE `gostos_do_usuario` (
  `id_GDU` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jogo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

CREATE TABLE `historico` (
  `id_historico` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `historico`
--

INSERT INTO `historico` (`id_historico`, `id_user`, `id`, `tipo`, `data`) VALUES
(1, 1, 1, 'reagir_pbl', '2020-01-01 02:16:50'),
(2, 2, 1, 'reagir_pbl', '2020-01-01 02:27:29'),
(3, 2, 1, 'cmt', '2020-01-01 02:30:14'),
(4, 2, 1, 'cmt', '2020-01-01 02:30:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lido`
--

CREATE TABLE `lido` (
  `id_lido` int(11) NOT NULL,
  `id_visto` int(11) NOT NULL,
  `data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lido`
--

INSERT INTO `lido` (`id_lido`, `id_visto`, `data`) VALUES
(1, 1, 2147483647),
(2, 2, 2147483647);

-- --------------------------------------------------------

--
-- Estrutura para tabela `linguagens_programacao`
--

CREATE TABLE `linguagens_programacao` (
  `id_linguagem` int(11) NOT NULL,
  `nome` varchar(15) NOT NULL,
  `nivel` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista_de_conteudo`
--

CREATE TABLE `lista_de_conteudo` (
  `id_lista` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nome` varchar(75) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `descricao` varchar(10) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `localizacao_usuarios`
--

CREATE TABLE `localizacao_usuarios` (
  `id_localizacao` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `latitude` int(11) NOT NULL,
  `altitude` int(11) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `localizacao_exata` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `logado` tinyint(1) NOT NULL,
  `IP` varchar(20) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`id_login`, `id_user`, `logado`, `IP`, `data`) VALUES
(1, 1, 1, '::1', '2020-01-01 02:22:53'),
(2, 2, 1, '::1', '2020-01-01 02:33:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `nome_pt` varchar(70) NOT NULL,
  `sigla` varchar(4) NOT NULL,
  `bacen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pais`
--

INSERT INTO `pais` (`id_pais`, `nome`, `nome_pt`, `sigla`, `bacen`) VALUES
(1, 'Brazil', 'Brasil', 'BR', 1058),
(2, 'Afghanistan', 'Afeganistão', 'AF', 132),
(3, 'Albania', 'Albânia, Republica da', 'AL', 175),
(4, 'Algeria', 'Argélia', 'DZ', 590),
(5, 'American Samoa', 'Samoa Americana', 'AS', 6912),
(6, 'Andorra', 'Andorra', 'AD', 370),
(7, 'Angola', 'Angola', 'AO', 400),
(8, 'Anguilla', 'Anguilla', 'AI', 418),
(9, 'Antarctica', 'Antártida', 'AQ', 3596),
(10, 'Antigua and Barbuda', 'Antigua e Barbuda', 'AG', 434),
(11, 'Argentina', 'Argentina', 'AR', 639),
(12, 'Armenia', 'Armênia, Republica da', 'AM', 647),
(13, 'Aruba', 'Aruba', 'AW', 655),
(14, 'Australia', 'Austrália', 'AU', 698),
(15, 'Austria', 'Áustria', 'AT', 728),
(16, 'Azerbaijan', 'Azerbaijão, Republica do', 'AZ', 736),
(17, 'Bahamas', 'Bahamas, Ilhas', 'BS', 779),
(18, 'Bahrain', 'Bahrein, Ilhas', 'BH', 809),
(19, 'Bangladesh', 'Bangladesh', 'BD', 817),
(20, 'Barbados', 'Barbados', 'BB', 833),
(21, 'Belarus', 'Belarus, Republica da', 'BY', 850),
(22, 'Belgium', 'Bélgica', 'BE', 876),
(23, 'Belize', 'Belize', 'BZ', 884),
(24, 'Benin', 'Benin', 'BJ', 2291),
(25, 'Bermuda', 'Bermudas', 'BM', 906),
(26, 'Bhutan', 'Butão', 'BT', 1198),
(27, 'Bolivia', 'Bolívia', 'BO', 973),
(28, 'Bosnia and Herzegowina', 'Bósnia-herzegovina (Republica da)', 'BA', 981),
(29, 'Botswana', 'Botsuana', 'BW', 1015),
(30, 'Bouvet Island', 'Bouvet, Ilha', 'BV', 1023),
(31, 'British Indian Ocean Territory', 'Território Britânico do Oceano Indico', 'IO', 7820),
(32, 'Brunei Darussalam', 'Brunei', 'BN', 1082),
(33, 'Bulgaria', 'Bulgária, Republica da', 'BG', 1112),
(34, 'Burkina Faso', 'Burkina Faso', 'BF', 310),
(35, 'Burundi', 'Burundi', 'BI', 1155),
(36, 'Cambodia', 'Camboja', 'KH', 1414),
(37, 'Cameroon', 'Camarões', 'CM', 1457),
(38, 'Canada', 'Canada', 'CA', 1490),
(39, 'Cape Verde', 'Cabo Verde, Republica de', 'CV', 1279),
(40, 'Cayman Islands', 'Cayman, Ilhas', 'KY', 1376),
(41, 'Central African Republic', 'Republica Centro-Africana', 'CF', 6408),
(42, 'Chad', 'Chade', 'TD', 7889),
(43, 'Chile', 'Chile', 'CL', 1589),
(44, 'China', 'China, Republica Popular', 'CN', 1600),
(45, 'Christmas Island', 'Christmas, Ilha (Navidad)', 'CX', 5118),
(46, 'Cocos (Keeling) Islands', 'Cocos (Keeling), Ilhas', 'CC', 1651),
(47, 'Colombia', 'Colômbia', 'CO', 1694),
(48, 'Comoros', 'Comores, Ilhas', 'KM', 1732),
(49, 'Congo', 'Congo', 'CG', 1775),
(50, 'Congo, the Democratic Republic of the', 'Congo, Republica Democrática do', 'CD', 8885),
(51, 'Cook Islands', 'Cook, Ilhas', 'CK', 1830),
(52, 'Costa Rica', 'Costa Rica', 'CR', 1961),
(53, 'Cote dIvoire', 'Costa do Marfim', 'CI', 1937),
(54, 'Croatia (Hrvatska)', 'Croácia (Republica da)', 'HR', 1953),
(55, 'Cuba', 'Cuba', 'CU', 1996),
(56, 'Cyprus', 'Chipre', 'CY', 1635),
(57, 'Czech Republic', 'Tcheca, Republica', 'CZ', 7919),
(58, 'Denmark', 'Dinamarca', 'DK', 2321),
(59, 'Djibouti', 'Djibuti', 'DJ', 7838),
(60, 'Dominica', 'Dominica, Ilha', 'DM', 2356),
(61, 'Dominican Republic', 'Republica Dominicana', 'DO', 6475),
(62, 'East Timor', 'Timor Leste', 'TL', 7951),
(63, 'Ecuador', 'Equador', 'EC', 2399),
(64, 'Egypt', 'Egito', 'EG', 2402),
(65, 'El Salvador', 'El Salvador', 'SV', 6874),
(66, 'Equatorial Guinea', 'Guine-Equatorial', 'GQ', 3310),
(67, 'Eritrea', 'Eritreia', 'ER', 2437),
(68, 'Estonia', 'Estônia, Republica da', 'EE', 2518),
(69, 'Ethiopia', 'Etiópia', 'ET', 2534),
(70, 'Falkland Islands (Malvinas)', 'Falkland (Ilhas Malvinas)', 'FK', 2550),
(71, 'Faroe Islands', 'Feroe, Ilhas', 'FO', 2593),
(72, 'Fiji', 'Fiji', 'FJ', 8702),
(73, 'Finland', 'Finlândia', 'FI', 2712),
(74, 'France', 'Franca', 'FR', 2755),
(76, 'French Guiana', 'Guiana francesa', 'GF', 3255),
(77, 'French Polynesia', 'Polinésia Francesa', 'PF', 5991),
(78, 'French Southern Territories', 'Terras Austrais e Antárticas Francesas', 'TF', 3607),
(79, 'Gabon', 'Gabão', 'GA', 2810),
(80, 'Gambia', 'Gambia', 'GM', 2852),
(81, 'Georgia', 'Georgia, Republica da', 'GE', 2917),
(82, 'Germany', 'Alemanha', 'DE', 230),
(83, 'Ghana', 'Gana', 'GH', 2895),
(84, 'Gibraltar', 'Gibraltar', 'GI', 2933),
(85, 'Greece', 'Grécia', 'GR', 3018),
(86, 'Greenland', 'Groenlândia', 'GL', 3050),
(87, 'Grenada', 'Granada', 'GD', 2976),
(88, 'Guadeloupe', 'Guadalupe', 'GP', 3093),
(89, 'Guam', 'Guam', 'GU', 3131),
(90, 'Guatemala', 'Guatemala', 'GT', 3174),
(91, 'Guinea', 'Guine', 'GN', 3298),
(92, 'Guinea-Bissau', 'Guine-Bissau', 'GW', 3344),
(93, 'Guyana', 'Guiana', 'GY', 3379),
(94, 'Haiti', 'Haiti', 'HT', 3417),
(95, 'Heard and Mc Donald Islands', 'Ilha Heard e Ilhas McDonald', 'HM', 3603),
(96, 'Holy See (Vatican City State)', 'Vaticano, Estado da Cidade do', 'VA', 8486),
(97, 'Honduras', 'Honduras', 'HN', 3450),
(98, 'Hong Kong', 'Hong Kong', 'HK', 3514),
(99, 'Hungary', 'Hungria, Republica da', 'HU', 3557),
(100, 'Iceland', 'Islândia', 'IS', 3794),
(101, 'India', 'Índia', 'IN', 3611),
(102, 'Indonesia', 'Indonésia', 'ID', 3654),
(103, 'Iran (Islamic Republic of)', 'Ira, Republica Islâmica do', 'IR', 3727),
(104, 'Iraq', 'Iraque', 'IQ', 3697),
(105, 'Ireland', 'Irlanda', 'IE', 3751),
(106, 'Israel', 'Israel', 'IL', 3832),
(107, 'Italy', 'Itália', 'IT', 3867),
(108, 'Jamaica', 'Jamaica', 'JM', 3913),
(109, 'Japan', 'Japão', 'JP', 3999),
(110, 'Jordan', 'Jordânia', 'JO', 4030),
(111, 'Kazakhstan', 'Cazaquistão, Republica do', 'KZ', 1538),
(112, 'Kenya', 'Quênia', 'KE', 6238),
(113, 'Kiribati', 'Kiribati', 'KI', 4111),
(114, 'Korea, Democratic People`s Republic of', 'Coreia, Republica Popular Democrática da', 'KP', 1872),
(115, 'Korea, Republic of', 'Coreia, Republica da', 'KR', 1902),
(116, 'Kuwait', 'Kuwait', 'KW', 1988),
(117, 'Kyrgyzstan', 'Quirguiz, Republica', 'KG', 6254),
(118, 'Lao People`s Democratic Republic', 'Laos, Republica Popular Democrática do', 'LA', 4200),
(119, 'Latvia', 'Letônia, Republica da', 'LV', 4278),
(120, 'Lebanon', 'Líbano', 'LB', 4316),
(121, 'Lesotho', 'Lesoto', 'LS', 4260),
(122, 'Liberia', 'Libéria', 'LR', 4340),
(123, 'Libyan Arab Jamahiriya', 'Líbia', 'LY', 4383),
(124, 'Liechtenstein', 'Liechtenstein', 'LI', 4405),
(125, 'Lithuania', 'Lituânia, Republica da', 'LT', 4421),
(126, 'Luxembourg', 'Luxemburgo', 'LU', 4456),
(127, 'Macau', 'Macau', 'MO', 4472),
(128, 'North Macedonia', 'Macedônia do Norte', 'MK', 4499),
(129, 'Madagascar', 'Madagascar', 'MG', 4502),
(130, 'Malawi', 'Malavi', 'MW', 4588),
(131, 'Malaysia', 'Malásia', 'MY', 4553),
(132, 'Maldives', 'Maldivas', 'MV', 4618),
(133, 'Mali', 'Mali', 'ML', 4642),
(134, 'Malta', 'Malta', 'MT', 4677),
(135, 'Marshall Islands', 'Marshall, Ilhas', 'MH', 4766),
(136, 'Martinique', 'Martinica', 'MQ', 4774),
(137, 'Mauritania', 'Mauritânia', 'MR', 4880),
(138, 'Mauritius', 'Mauricio', 'MU', 4855),
(139, 'Mayotte', 'Mayotte (Ilhas Francesas)', 'YT', 4885),
(140, 'Mexico', 'México', 'MX', 4936),
(141, 'Micronesia, Federated States of', 'Micronesia', 'FM', 4995),
(142, 'Moldova, Republic of', 'Moldávia, Republica da', 'MD', 4944),
(143, 'Monaco', 'Mônaco', 'MC', 4952),
(144, 'Mongolia', 'Mongólia', 'MN', 4979),
(145, 'Montserrat', 'Montserrat, Ilhas', 'MS', 5010),
(146, 'Morocco', 'Marrocos', 'MA', 4740),
(147, 'Mozambique', 'Moçambique', 'MZ', 5053),
(148, 'Myanmar', 'Mianmar (Birmânia)', 'MM', 930),
(149, 'Namibia', 'Namíbia', 'NA', 5070),
(150, 'Nauru', 'Nauru', 'NR', 5088),
(151, 'Nepal', 'Nepal', 'NP', 5177),
(152, 'Netherlands', 'Países Baixos (Holanda)', 'NL', 5738),
(154, 'New Caledonia', 'Nova Caledonia', 'NC', 5428),
(155, 'New Zealand', 'Nova Zelândia', 'NZ', 5487),
(156, 'Nicaragua', 'Nicarágua', 'NI', 5215),
(157, 'Niger', 'Níger', 'NE', 5258),
(158, 'Nigeria', 'Nigéria', 'NG', 5282),
(159, 'Niue', 'Niue, Ilha', 'NU', 5312),
(160, 'Norfolk Island', 'Norfolk, Ilha', 'NF', 5355),
(161, 'Northern Mariana Islands', 'Marianas do Norte', 'MP', 4723),
(162, 'Norway', 'Noruega', 'NO', 5380),
(163, 'Oman', 'Oma', 'OM', 5568),
(164, 'Pakistan', 'Paquistão', 'PK', 5762),
(165, 'Palau', 'Palau', 'PW', 5754),
(166, 'Panama', 'Panamá', 'PA', 5800),
(167, 'Papua New Guinea', 'Papua Nova Guine', 'PG', 5452),
(168, 'Paraguay', 'Paraguai', 'PY', 5860),
(169, 'Peru', 'Peru', 'PE', 5894),
(170, 'Philippines', 'Filipinas', 'PH', 2674),
(171, 'Pitcairn', 'Pitcairn, Ilha', 'PN', 5932),
(172, 'Poland', 'Polônia, Republica da', 'PL', 6033),
(173, 'Portugal', 'Portugal', 'PT', 6076),
(174, 'Puerto Rico', 'Porto Rico', 'PR', 6114),
(175, 'Qatar', 'Catar', 'QA', 1546),
(176, 'Reunion', 'Reunião, Ilha', 'RE', 6602),
(177, 'Romania', 'Romênia', 'RO', 6700),
(178, 'Russian Federation', 'Rússia, Federação da', 'RU', 6769),
(179, 'Rwanda', 'Ruanda', 'RW', 6750),
(180, 'Saint Kitts and Nevis', 'São Cristovão e Neves, Ilhas', 'KN', 6955),
(181, 'Saint LUCIA', 'Santa Lucia', 'LC', 7153),
(182, 'Saint Vincent and the Grenadines', 'São Vicente e Granadinas', 'VC', 7056),
(183, 'Samoa', 'Samoa', 'WS', 6904),
(184, 'San Marino', 'San Marino', 'SM', 6971),
(185, 'Sao Tome and Principe', 'São Tome e Príncipe, Ilhas', 'ST', 7200),
(186, 'Saudi Arabia', 'Arábia Saudita', 'SA', 531),
(187, 'Senegal', 'Senegal', 'SN', 7285),
(188, 'Seychelles', 'Seychelles', 'SC', 7315),
(189, 'Sierra Leone', 'Serra Leoa', 'SL', 7358),
(190, 'Singapore', 'Cingapura', 'SG', 7412),
(191, 'Slovakia (Slovak Republic)', 'Eslovaca, Republica', 'SK', 2470),
(192, 'Slovenia', 'Eslovênia, Republica da', 'SI', 2461),
(193, 'Solomon Islands', 'Salomão, Ilhas', 'SB', 6777),
(194, 'Somalia', 'Somalia', 'SO', 7480),
(195, 'South Africa', 'África do Sul', 'ZA', 7560),
(196, 'South Georgia and the South Sandwich Islands', 'Ilhas Geórgia do Sul e Sandwich do Sul', 'GS', 2925),
(197, 'Spain', 'Espanha', 'ES', 2453),
(198, 'Sri Lanka', 'Sri Lanka', 'LK', 7501),
(199, 'St. Helena', 'Santa Helena', 'SH', 7102),
(200, 'St. Pierre and Miquelon', 'São Pedro e Miquelon', 'PM', 7005),
(201, 'Sudan', 'Sudão', 'SD', 7595),
(202, 'Suriname', 'Suriname', 'SR', 7706),
(203, 'Svalbard and Jan Mayen Islands', 'Svalbard e Jan Mayen', 'SJ', 7552),
(204, 'Swaziland', 'Eswatini', 'SZ', 7544),
(205, 'Sweden', 'Suécia', 'SE', 7641),
(206, 'Switzerland', 'Suíça', 'CH', 7676),
(207, 'Syrian Arab Republic', 'Síria, Republica Árabe da', 'SY', 7447),
(208, 'Taiwan, Province of China', 'Formosa (Taiwan)', 'TW', 1619),
(209, 'Tajikistan', 'Tadjiquistao, Republica do', 'TJ', 7722),
(210, 'Tanzania, United Republic of', 'Tanzânia, Republica Unida da', 'TZ', 7803),
(211, 'Thailand', 'Tailândia', 'TH', 7765),
(212, 'Togo', 'Togo', 'TG', 8001),
(213, 'Tokelau', 'Toquelau, Ilhas', 'TK', 8052),
(214, 'Tonga', 'Tonga', 'TO', 8109),
(215, 'Trinidad and Tobago', 'Trinidad e Tobago', 'TT', 8150),
(216, 'Tunisia', 'Tunísia', 'TN', 8206),
(217, 'Turkey', 'Turquia', 'TR', 8273),
(218, 'Turkmenistan', 'Turcomenistão, Republica do', 'TM', 8249),
(219, 'Turks and Caicos Islands', 'Turcas e Caicos, Ilhas', 'TC', 8230),
(220, 'Tuvalu', 'Tuvalu', 'TV', 8281),
(221, 'Uganda', 'Uganda', 'UG', 8338),
(222, 'Ukraine', 'Ucrânia', 'UA', 8311),
(223, 'United Arab Emirates', 'Emirados Árabes Unidos', 'AE', 2445),
(224, 'United Kingdom', 'Reino Unido', 'GB', 6289),
(225, 'United States', 'Estados Unidos', 'US', 2496),
(226, 'United States Minor Outlying Islands', 'Ilhas Menores Distantes dos Estados Unidos', 'UM', 18664),
(227, 'Uruguay', 'Uruguai', 'UY', 8451),
(228, 'Uzbekistan', 'Uzbequistão, Republica do', 'UZ', 8478),
(229, 'Vanuatu', 'Vanuatu', 'VU', 5517),
(230, 'Venezuela', 'Venezuela', 'VE', 8508),
(231, 'Viet Nam', 'Vietnã', 'VN', 8583),
(232, 'Virgin Islands (British)', 'Virgens, Ilhas (Britânicas)', 'VG', 8630),
(233, 'Virgin Islands (U.S.)', 'Virgens, Ilhas (E.U.A.)', 'VI', 8664),
(234, 'Wallis and Futuna Islands', 'Wallis e Futuna, Ilhas', 'WF', 8753),
(235, 'Western Sahara', 'Saara Ocidental', 'EH', 6858),
(236, 'Yemen', 'Iémen', 'YE', 3573),
(237, 'Yugoslavia', 'Iugoslávia, República Fed. da', 'YU', 3883),
(238, 'Zambia', 'Zâmbia', 'ZM', 8907),
(239, 'Zimbabwe', 'Zimbabue', 'ZW', 6653),
(240, 'Bailiwick of Guernsey', 'Guernsey, Ilha do Canal (Inclui Alderney e Sark)', 'GG', 1504),
(241, 'Bailiwick of Jersey', 'Jersey, Ilha do Canal', 'JE', 1508),
(243, 'Isle of Man', 'Man, Ilha de', 'IM', 3595),
(246, 'Crna Gora (Montenegro)', 'Montenegro', 'ME', 4985),
(247, 'SÉRVIA', 'Republika Srbija', 'RS', 7370),
(248, 'Republic of South Sudan', 'Sudao do Sul', 'SS', 7600),
(249, 'Zona del Canal de Panamá', 'Zona do Canal do Panamá', '', 8958),
(252, 'Dawlat Filasṭīn', 'Palestina', 'PS', 5780),
(253, 'Åland Islands', 'Aland, Ilhas', 'AX', 153),
(255, 'Curaçao', 'Curaçao', 'CW', 200),
(256, 'Saint Martin', 'São Martinho, Ilha de (Parte Holandesa)', 'SM', 6998),
(258, 'Bonaire', 'Bonaire', 'AN', 990),
(259, 'Antartica', 'Antartica', 'AQ', 420),
(260, 'Heard Island and McDonald Islands', 'Ilha Herad e Ilhas Macdonald', 'AU', 3433),
(261, 'Saint-Barthélemy', 'São Bartolomeu', 'FR', 6939),
(262, 'Saint Martin', 'São Martinho, Ilha de (Parte Francesa)', 'SM', 6980),
(263, 'Terres Australes et Antarctiques Françaises', 'Terras Austrais e Antárcticas Francesas', 'TF', 7811);

-- --------------------------------------------------------

--
-- Estrutura para tabela `partilha`
--

CREATE TABLE `partilha` (
  `id_partilha` int(11) NOT NULL,
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pbl_definicoes`
--

CREATE TABLE `pbl_definicoes` (
  `id_pbl_def` int(11) NOT NULL,
  `id_pbl` int(11) NOT NULL,
  `titulo` varchar(35) NOT NULL,
  `positivo` tinyint(1) NOT NULL,
  `intencao` varchar(35) NOT NULL,
  `tipo` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pbl_mencionar`
--

CREATE TABLE `pbl_mencionar` (
  `id_mencionar` int(11) NOT NULL,
  `id_pbl` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `preferencias_usuarios`
--

CREATE TABLE `preferencias_usuarios` (
  `id_preferencia` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `preferencia_area`
--

CREATE TABLE `preferencia_area` (
  `id_preferencia` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `preferencia_lp`
--

CREATE TABLE `preferencia_lp` (
  `id_preferencia` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_linguagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `privado`
--

CREATE TABLE `privado` (
  `id_privado` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro_cripto`
--

CREATE TABLE `registro_cripto` (
  `id_registro` int(11) NOT NULL,
  `id_cripto` int(11) NOT NULL,
  `id_cripto2` int(12) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `qtd` decimal(10,0) NOT NULL,
  `caso` varchar(10) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `temas`
--

CREATE TABLE `temas` (
  `id_tema` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_de_conteudo`
--

CREATE TABLE `tipo_de_conteudo` (
  `id_t_conteudo` int(11) NOT NULL,
  `titulo` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `versoes_codigos`
--

CREATE TABLE `versoes_codigos` (
  `id_versao` int(11) NOT NULL,
  `id_code` int(11) NOT NULL,
  `descricao` varchar(5000) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `visto`
--

CREATE TABLE `visto` (
  `id_visto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `visto`
--

INSERT INTO `visto` (`id_visto`, `id_user`, `id`, `tipo`, `data`) VALUES
(1, 1, 1, 'pbl', '2020-01-01 02:16:42'),
(2, 2, 1, 'pbl', '2020-01-01 02:26:06'),
(3, 2, 1, 'notific', '2020-01-01 02:26:40'),
(4, 2, 1, 'chat', '2020-01-01 02:29:13');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cmt_mencionar`
--
ALTER TABLE `cmt_mencionar`
  ADD PRIMARY KEY (`id_cmt_mencionar`);

--
-- Índices de tabela `comunidade_integrante`
--
ALTER TABLE `comunidade_integrante`
  ADD PRIMARY KEY (`id_integrante`);

--
-- Índices de tabela `contacto_aceite`
--
ALTER TABLE `contacto_aceite`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `conteudo_de_lista`
--
ALTER TABLE `conteudo_de_lista`
  ADD PRIMARY KEY (`id_conteudo`);

--
-- Índices de tabela `denucias`
--
ALTER TABLE `denucias`
  ADD PRIMARY KEY (`id_denuncia`);

--
-- Índices de tabela `escolha_conteudo`
--
ALTER TABLE `escolha_conteudo`
  ADD PRIMARY KEY (`id_e_conteudo`);

--
-- Índices de tabela `gosto`
--
ALTER TABLE `gosto`
  ADD PRIMARY KEY (`id_gosto`);

--
-- Índices de tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id_historico`);

--
-- Índices de tabela `lido`
--
ALTER TABLE `lido`
  ADD PRIMARY KEY (`id_lido`);

--
-- Índices de tabela `linguagens_programacao`
--
ALTER TABLE `linguagens_programacao`
  ADD PRIMARY KEY (`id_linguagem`);

--
-- Índices de tabela `lista_de_conteudo`
--
ALTER TABLE `lista_de_conteudo`
  ADD PRIMARY KEY (`id_lista`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Índices de tabela `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Índices de tabela `partilha`
--
ALTER TABLE `partilha`
  ADD PRIMARY KEY (`id_partilha`);

--
-- Índices de tabela `pbl_definicoes`
--
ALTER TABLE `pbl_definicoes`
  ADD PRIMARY KEY (`id_pbl_def`);

--
-- Índices de tabela `pbl_mencionar`
--
ALTER TABLE `pbl_mencionar`
  ADD PRIMARY KEY (`id_mencionar`);

--
-- Índices de tabela `preferencias_usuarios`
--
ALTER TABLE `preferencias_usuarios`
  ADD PRIMARY KEY (`id_preferencia`);

--
-- Índices de tabela `preferencia_area`
--
ALTER TABLE `preferencia_area`
  ADD PRIMARY KEY (`id_preferencia`);

--
-- Índices de tabela `preferencia_lp`
--
ALTER TABLE `preferencia_lp`
  ADD PRIMARY KEY (`id_preferencia`);

--
-- Índices de tabela `privado`
--
ALTER TABLE `privado`
  ADD PRIMARY KEY (`id_privado`);

--
-- Índices de tabela `registro_cripto`
--
ALTER TABLE `registro_cripto`
  ADD PRIMARY KEY (`id_registro`);

--
-- Índices de tabela `tipo_de_conteudo`
--
ALTER TABLE `tipo_de_conteudo`
  ADD PRIMARY KEY (`id_t_conteudo`);

--
-- Índices de tabela `versoes_codigos`
--
ALTER TABLE `versoes_codigos`
  ADD PRIMARY KEY (`id_versao`);

--
-- Índices de tabela `visto`
--
ALTER TABLE `visto`
  ADD PRIMARY KEY (`id_visto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comunidade_integrante`
--
ALTER TABLE `comunidade_integrante`
  MODIFY `id_integrante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contacto_aceite`
--
ALTER TABLE `contacto_aceite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conteudo_de_lista`
--
ALTER TABLE `conteudo_de_lista`
  MODIFY `id_conteudo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `denucias`
--
ALTER TABLE `denucias`
  MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `escolha_conteudo`
--
ALTER TABLE `escolha_conteudo`
  MODIFY `id_e_conteudo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `gosto`
--
ALTER TABLE `gosto`
  MODIFY `id_gosto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id_historico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `lido`
--
ALTER TABLE `lido`
  MODIFY `id_lido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `linguagens_programacao`
--
ALTER TABLE `linguagens_programacao`
  MODIFY `id_linguagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lista_de_conteudo`
--
ALTER TABLE `lista_de_conteudo`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT de tabela `partilha`
--
ALTER TABLE `partilha`
  MODIFY `id_partilha` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pbl_definicoes`
--
ALTER TABLE `pbl_definicoes`
  MODIFY `id_pbl_def` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pbl_mencionar`
--
ALTER TABLE `pbl_mencionar`
  MODIFY `id_mencionar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `preferencias_usuarios`
--
ALTER TABLE `preferencias_usuarios`
  MODIFY `id_preferencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `preferencia_area`
--
ALTER TABLE `preferencia_area`
  MODIFY `id_preferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `preferencia_lp`
--
ALTER TABLE `preferencia_lp`
  MODIFY `id_preferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `privado`
--
ALTER TABLE `privado`
  MODIFY `id_privado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `registro_cripto`
--
ALTER TABLE `registro_cripto`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tipo_de_conteudo`
--
ALTER TABLE `tipo_de_conteudo`
  MODIFY `id_t_conteudo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `versoes_codigos`
--
ALTER TABLE `versoes_codigos`
  MODIFY `id_versao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `visto`
--
ALTER TABLE `visto`
  MODIFY `id_visto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Banco de dados: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
