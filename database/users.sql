-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/05/2026 às 17:55
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
-- Banco de dados: `patrimonio`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `papel` enum('master','admin','usuario') NOT NULL DEFAULT 'usuario',
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `cidade_comarca_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `papel`, `ativo`, `cidade_comarca_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador Master', 'rapwara@gmail.com', NULL, '$2y$12$9vh8nEsDfIEKgNA7WFVfR.v7VcyInZlJcJ9IIZUXqiffUEf8cQb5a', 'master', 1, NULL, 'EYVFsyccEOyLfFOPIqezUZRhUK5eM1IvRLtFqVjDx39dh1xW6cSpyzOmVYpl', '2026-05-07 18:01:33', '2026-05-07 18:26:17'),
(2, 'Nilson', 'nrsmnilson@gmail.com', NULL, '$2y$12$QGFqb7cXKoZ35gUAJ5MVouHJsj6JQa9C9r06i30p85IiRZ/PmVVIe', 'admin', 1, NULL, NULL, '2026-05-07 18:33:24', '2026-05-07 18:33:24'),
(3, 'Marivalda', 'marivalda.nascimento@lanlink.com.br', NULL, '$2y$12$6WKtgx8lWWEj4iEhM01uFuVc0wfkT5VBFhPPumYJXvFVWsSKypY5y', 'admin', 1, 23, NULL, '2026-05-07 18:40:33', '2026-05-07 18:48:48'),
(4, 'Ednilson Júnior', 'ednilson.junior@lanlink.com.br', NULL, '$2y$12$GDYtsgXBStyx6UaxPcUVQ.3WaxtX/rHxhpvEwGgE7L/8bb7fgFFNS', 'admin', 1, 31, NULL, '2026-05-07 18:42:21', '2026-05-07 18:50:37'),
(5, 'Elvis', 'elvis.almeida@lanlink.com.br', NULL, '$2y$12$p36heueiWBm1eKKmEQ.J9.JiaZ4J1FCKCgcG/vdWCZm6JgoYadB2K', 'admin', 1, 18, NULL, '2026-05-07 18:43:01', '2026-05-07 18:49:49');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_cidade_comarca_id_foreign` (`cidade_comarca_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_cidade_comarca_id_foreign` FOREIGN KEY (`cidade_comarca_id`) REFERENCES `cidades_comarcas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
