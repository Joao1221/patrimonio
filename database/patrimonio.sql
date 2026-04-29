-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/04/2026 às 17:59
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
-- Estrutura para tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades_comarcas`
--

CREATE TABLE `cidades_comarcas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `cidades_comarcas`
--

INSERT INTO `cidades_comarcas` (`id`, `nome`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'Aquidabã', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(2, 'Arauá', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(3, 'Areia Branca', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(4, 'Barra dos Coqueiros', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(5, 'Boquim', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(6, 'Campo do Brito', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(7, 'Canindé de São Francisco', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(8, 'Capela', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(9, 'Carira', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(10, 'Carmópolis', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(11, 'Cedro de São João', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(12, 'Cristinápolis', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(13, 'Divina Pastora', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(14, 'Estância', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(15, 'Frei Paulo', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(16, 'Gararu', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(17, 'Indiaroba', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(18, 'Itabaiana', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(19, 'Itabaianinha', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(20, 'Itaporanga d\'Ajuda', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(21, 'Japaratuba', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(22, 'Japoatã', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(23, 'Lagarto', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(24, 'Laranjeiras', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(25, 'Malhador', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(26, 'Maruim', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(27, 'Monte Alegre de Sergipe', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(28, 'Neópolis', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(29, 'Nossa Senhora da Glória', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(30, 'Nossa Senhora das Dores', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(31, 'Nossa Senhora do Socorro', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(32, 'Pacatuba', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(33, 'Pedrinhas', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(34, 'Pirambu', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(35, 'Poço Redondo', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(36, 'Poço Verde', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(37, 'Porto da Folha', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(38, 'Propriá', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(39, 'Riachão do Dantas', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(40, 'Riachuelo', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(41, 'Ribeirópolis', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(42, 'Salgado', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(43, 'Santana do São Francisco', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(44, 'Santo Amaro das Brotas', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(45, 'São Cristóvão', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(46, 'São Domingos', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(47, 'Simão Dias', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(48, 'Tobias Barreto', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(49, 'Umbaúba', 1, '2026-04-29 14:16:55', '2026-04-29 14:16:55'),
(50, 'UFS', 1, '2026-04-29 15:41:27', '2026-04-29 15:41:27'),
(51, 'Marcos Freire II', 1, '2026-04-29 15:42:02', '2026-04-29 15:42:02'),
(52, 'Parque dos Faróis', 1, '2026-04-29 15:42:35', '2026-04-29 15:42:35');

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo_equipamento_id` bigint(20) UNSIGNED NOT NULL,
  `marca_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cidade_comarca_id` bigint(20) UNSIGNED NOT NULL,
  `vara_id` bigint(20) UNSIGNED DEFAULT NULL,
  `setor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `codigo_patrimonio` varchar(255) NOT NULL,
  `modelo` varchar(150) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `marcas`
--

CREATE TABLE `marcas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `marcas`
--

INSERT INTO `marcas` (`id`, `nome`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'Dell', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(2, 'HP', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(3, 'Lenovo', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(4, 'SMS', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(5, 'Epson', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(6, 'Canon', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(7, 'Brother', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(8, 'Outro', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(9, 'Positivo', 1, '2026-04-29 15:29:51', '2026-04-29 15:29:51');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_29_112405_create_tipos_equipamento_table', 1),
(5, '2026_04_29_112406_create_marcas_table', 1),
(6, '2026_04_29_112408_create_cidades_comarcas_table', 1),
(7, '2026_04_29_112410_create_varas_table', 1),
(8, '2026_04_29_112411_create_setores_table', 1),
(9, '2026_04_29_112413_create_equipamentos_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9O6kFUH1gWKPhNgOB51TkTuy46uRk7D5WRuR34Qs', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRlBrVXZLd0ZBRHE1cFFWRVFhZ1Z0QThoSzh6MlllT1ZwdFJRNTVkQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvcGF0cmltb25pby9wdWJsaWMvdmFyYXMiO3M6NToicm91dGUiO3M6MTE6InZhcmFzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMjoibGV2YW50YW1lbnRvIjthOjM6e3M6ODoiY29udGV4dG8iO2E6Njp7czoxNzoiY2lkYWRlX2NvbWFyY2FfaWQiO3M6MToiMSI7czo3OiJ2YXJhX2lkIjtzOjE6IjEiO3M6ODoic2V0b3JfaWQiO3M6MToiMSI7czoxOToidGlwb19lcXVpcGFtZW50b19pZCI7czoxOiIxIjtzOjg6Im1hcmNhX2lkIjtzOjE6IjkiO3M6NjoibW9kZWxvIjtzOjk6Ik1pbmkgMzAwMCI7fXM6ODoiY29udGFkb3IiO2k6MTtzOjExOiJ1bHRpbW9zX2lkcyI7YToxOntpOjA7aToxO319fQ==', 1777477565);

-- --------------------------------------------------------

--
-- Estrutura para tabela `setores`
--

CREATE TABLE `setores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `setores`
--

INSERT INTO `setores` (`id`, `nome`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'Secretaria', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(2, 'Assessoria', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(3, 'Gabinete', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(4, 'Sala de instruções', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(5, 'Atendimento geral', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(7, 'Recepção', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(8, 'Outro', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(9, 'Salão do júri', 1, '2026-04-29 16:58:15', '2026-04-29 16:58:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_equipamento`
--

CREATE TABLE `tipos_equipamento` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tipos_equipamento`
--

INSERT INTO `tipos_equipamento` (`id`, `nome`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'Computador', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(2, 'Monitor', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(3, 'Nobreak', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(4, 'Scanner', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(5, 'Impressora', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32'),
(6, 'Outro', 1, '2026-04-29 15:25:32', '2026-04-29 15:25:32');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `varas`
--

CREATE TABLE `varas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cidade_comarca_id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `varas`
--

INSERT INTO `varas` (`id`, `cidade_comarca_id`, `nome`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 1, 'Vara única', 1, '2026-04-29 17:19:16', '2026-04-29 17:19:16'),
(2, 2, 'Vara única', 1, '2026-04-29 17:19:27', '2026-04-29 17:19:27'),
(3, 3, 'Vara única', 1, '2026-04-29 17:19:39', '2026-04-29 17:19:39'),
(4, 4, '1ª Vara Cível e Criminal', 1, '2026-04-29 17:21:01', '2026-04-29 17:21:01'),
(5, 4, '2ª Vara Cível e Criminal', 1, '2026-04-29 17:21:13', '2026-04-29 17:21:13'),
(6, 4, '3ª Vara Cível e Criminal', 1, '2026-04-29 17:21:24', '2026-04-29 17:21:24'),
(7, 5, 'Vara única', 1, '2026-04-29 17:21:37', '2026-04-29 17:21:37'),
(8, 6, 'Vara única', 1, '2026-04-29 17:21:47', '2026-04-29 17:21:47'),
(9, 7, 'Vara única', 1, '2026-04-29 17:22:02', '2026-04-29 17:22:02'),
(10, 8, 'Vara única', 1, '2026-04-29 17:22:17', '2026-04-29 17:22:17'),
(11, 9, 'Vara única', 1, '2026-04-29 17:22:25', '2026-04-29 17:22:25'),
(12, 10, 'Vara única', 1, '2026-04-29 17:22:34', '2026-04-29 17:22:34'),
(13, 11, 'Vara única', 1, '2026-04-29 17:22:45', '2026-04-29 17:22:45'),
(14, 12, 'Vara única', 1, '2026-04-29 17:23:03', '2026-04-29 17:23:03'),
(15, 13, 'Vara única', 1, '2026-04-29 17:23:16', '2026-04-29 17:23:16'),
(16, 14, '1ª Vara Cível', 1, '2026-04-29 17:23:32', '2026-04-29 17:23:32'),
(17, 14, '2ª Vara Cível', 1, '2026-04-29 17:23:49', '2026-04-29 17:23:49'),
(18, 14, 'Vara Criminal', 1, '2026-04-29 17:25:09', '2026-04-29 17:25:09'),
(19, 14, 'Juizado', 1, '2026-04-29 17:26:12', '2026-04-29 17:26:12'),
(20, 15, 'Vara única', 1, '2026-04-29 17:26:33', '2026-04-29 17:26:33'),
(21, 16, 'Vara única', 1, '2026-04-29 17:26:43', '2026-04-29 17:26:43'),
(22, 17, 'Vara única', 1, '2026-04-29 17:26:54', '2026-04-29 17:26:54'),
(23, 18, '1ª Vara Cível', 1, '2026-04-29 17:27:11', '2026-04-29 17:27:11'),
(24, 18, '2ª Vara Cível', 1, '2026-04-29 17:27:29', '2026-04-29 17:27:29'),
(25, 18, '1ª Vara Criminal', 1, '2026-04-29 17:27:54', '2026-04-29 17:27:54'),
(26, 18, '2ª Vara Criminal', 1, '2026-04-29 17:28:38', '2026-04-29 17:28:38'),
(27, 18, 'Juizado', 1, '2026-04-29 17:28:51', '2026-04-29 17:28:51'),
(28, 18, 'Administração', 1, '2026-04-29 17:29:13', '2026-04-29 17:29:13'),
(29, 4, 'Administração', 1, '2026-04-29 17:29:30', '2026-04-29 17:29:30'),
(30, 14, 'Administração', 1, '2026-04-29 17:29:45', '2026-04-29 17:29:45'),
(31, 19, 'Vara única', 1, '2026-04-29 17:29:57', '2026-04-29 17:29:57'),
(32, 20, 'Administração', 1, '2026-04-29 17:30:14', '2026-04-29 17:30:14'),
(33, 20, '1ª Vara Cível e Criminal', 1, '2026-04-29 17:30:29', '2026-04-29 17:30:29'),
(34, 20, '2ª Vara Cível e Criminal', 1, '2026-04-29 17:30:41', '2026-04-29 17:30:41'),
(35, 21, 'Vara única', 1, '2026-04-29 17:30:53', '2026-04-29 17:30:53'),
(36, 22, 'Vara única', 1, '2026-04-29 17:34:09', '2026-04-29 17:34:09'),
(37, 23, '1ª Vara Cível', 1, '2026-04-29 17:34:27', '2026-04-29 17:34:27'),
(38, 23, '2ª Vara Cível', 1, '2026-04-29 17:34:41', '2026-04-29 17:34:41'),
(39, 23, '1ª Vara e Criminal', 1, '2026-04-29 17:35:07', '2026-04-29 17:35:07'),
(40, 23, '2ª Vara Criminal', 1, '2026-04-29 17:35:34', '2026-04-29 17:35:34'),
(41, 23, 'Juizado', 1, '2026-04-29 17:35:46', '2026-04-29 17:35:46'),
(42, 23, 'Administração', 1, '2026-04-29 17:36:00', '2026-04-29 17:36:00'),
(43, 24, '1ª Vara Cível e Criminal', 1, '2026-04-29 18:26:46', '2026-04-29 18:26:46'),
(44, 24, '2ª Vara Cível e Criminal', 1, '2026-04-29 18:27:00', '2026-04-29 18:27:00'),
(45, 24, 'Administração', 1, '2026-04-29 18:27:21', '2026-04-29 18:27:21'),
(46, 25, 'Vara única', 1, '2026-04-29 18:27:35', '2026-04-29 18:27:35'),
(47, 26, 'Vara única', 1, '2026-04-29 18:27:46', '2026-04-29 18:27:46'),
(48, 27, 'Vara única', 1, '2026-04-29 18:27:58', '2026-04-29 18:27:58'),
(49, 28, '1ª Vara Cível e Criminal', 1, '2026-04-29 18:28:11', '2026-04-29 18:28:11'),
(50, 28, '2ª Vara Cível e Criminal', 1, '2026-04-29 18:28:24', '2026-04-29 18:28:24'),
(51, 28, 'Administração', 1, '2026-04-29 18:28:38', '2026-04-29 18:28:38'),
(52, 29, '1ª Vara Cível e Criminal', 1, '2026-04-29 18:28:59', '2026-04-29 18:28:59'),
(53, 29, '2ª Vara Cível e Criminal', 1, '2026-04-29 18:29:08', '2026-04-29 18:29:08'),
(54, 29, 'Administração', 1, '2026-04-29 18:29:34', '2026-04-29 18:29:34'),
(55, 30, '1ª Vara Cível e Criminal', 1, '2026-04-29 18:30:30', '2026-04-29 18:30:30'),
(56, 30, '2ª Vara Cível e Criminal', 1, '2026-04-29 18:30:40', '2026-04-29 18:30:40'),
(57, 30, 'Administração', 1, '2026-04-29 18:30:51', '2026-04-29 18:30:51'),
(58, 31, '1ª Vara Cível', 1, '2026-04-29 18:31:06', '2026-04-29 18:31:19'),
(59, 31, '2ª Vara Cível', 1, '2026-04-29 18:31:31', '2026-04-29 18:31:31'),
(60, 31, '2º Juizado', 1, '2026-04-29 18:31:47', '2026-04-29 18:45:17'),
(61, 31, '1ª Vara Criminal', 1, '2026-04-29 18:32:02', '2026-04-29 18:32:02'),
(62, 31, '2ª Vara Criminal', 1, '2026-04-29 18:32:17', '2026-04-29 18:32:17'),
(63, 31, '3ª Vara Criminal', 1, '2026-04-29 18:32:34', '2026-04-29 18:32:34'),
(64, 32, 'Vara única', 1, '2026-04-29 18:33:08', '2026-04-29 18:33:08'),
(65, 33, 'Vara única', 1, '2026-04-29 18:33:23', '2026-04-29 18:33:23'),
(66, 34, 'Vara única', 1, '2026-04-29 18:33:35', '2026-04-29 18:33:35'),
(67, 35, 'Vara única', 1, '2026-04-29 18:33:48', '2026-04-29 18:33:48'),
(68, 36, 'Vara única', 1, '2026-04-29 18:34:05', '2026-04-29 18:34:05'),
(69, 37, '1ª Vara Cível e Criminal', 1, '2026-04-29 18:34:19', '2026-04-29 18:34:19'),
(70, 37, '2ª Vara Cível e Criminal', 1, '2026-04-29 18:34:31', '2026-04-29 18:34:31'),
(71, 37, 'Administração', 1, '2026-04-29 18:34:47', '2026-04-29 18:34:47'),
(72, 38, '1ª Vara Cível e Criminal', 1, '2026-04-29 18:34:59', '2026-04-29 18:34:59'),
(73, 38, '2ª Vara Cível e Criminal', 1, '2026-04-29 18:35:10', '2026-04-29 18:35:10'),
(74, 38, 'Administração', 1, '2026-04-29 18:35:20', '2026-04-29 18:35:20'),
(75, 39, 'Vara única', 1, '2026-04-29 18:35:32', '2026-04-29 18:35:32'),
(76, 40, 'Vara única', 1, '2026-04-29 18:36:15', '2026-04-29 18:36:15'),
(77, 41, 'Vara única', 1, '2026-04-29 18:36:25', '2026-04-29 18:36:25'),
(78, 42, 'Vara única', 1, '2026-04-29 18:36:38', '2026-04-29 18:36:38'),
(79, 43, 'Vara única', 1, '2026-04-29 18:36:49', '2026-04-29 18:36:49'),
(80, 44, 'Vara única', 1, '2026-04-29 18:36:59', '2026-04-29 18:36:59'),
(81, 45, '1ª Vara Cível', 1, '2026-04-29 18:37:11', '2026-04-29 18:37:11'),
(82, 45, '1ª Vara Criminal', 1, '2026-04-29 18:37:31', '2026-04-29 18:37:31'),
(83, 45, 'Administração', 1, '2026-04-29 18:37:43', '2026-04-29 18:37:43'),
(84, 46, 'Vara única', 1, '2026-04-29 18:37:57', '2026-04-29 18:37:57'),
(85, 47, '1ª Vara Cível e Criminal', 1, '2026-04-29 18:38:14', '2026-04-29 18:38:14'),
(86, 47, '2ª Vara Cível e Criminal', 1, '2026-04-29 18:38:24', '2026-04-29 18:38:24'),
(87, 47, 'Administração', 1, '2026-04-29 18:38:34', '2026-04-29 18:38:34'),
(88, 48, '1ª Vara Cível e Criminal', 1, '2026-04-29 18:38:44', '2026-04-29 18:38:44'),
(89, 48, '2ª Vara Cível e Criminal', 1, '2026-04-29 18:38:56', '2026-04-29 18:38:56'),
(90, 48, 'Administração', 1, '2026-04-29 18:39:07', '2026-04-29 18:39:07'),
(91, 49, 'Vara única', 1, '2026-04-29 18:39:23', '2026-04-29 18:39:23'),
(92, 51, '1º Juizado', 1, '2026-04-29 18:43:08', '2026-04-29 18:44:34'),
(93, 51, '3ª Vara Cível', 1, '2026-04-29 18:43:31', '2026-04-29 18:43:31'),
(94, 52, '4ª Vara Cível', 1, '2026-04-29 18:44:13', '2026-04-29 18:44:13'),
(95, 51, 'Administração', 1, '2026-04-29 18:45:31', '2026-04-29 18:45:31'),
(96, 50, 'Juizado', 1, '2026-04-29 18:45:52', '2026-04-29 18:45:52'),
(97, 50, '2ª Vara Cível', 1, '2026-04-29 18:46:04', '2026-04-29 18:46:04');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Índices de tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Índices de tabela `cidades_comarcas`
--
ALTER TABLE `cidades_comarcas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cidades_comarcas_nome_unique` (`nome`);

--
-- Índices de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `equipamentos_codigo_patrimonio_unique` (`codigo_patrimonio`),
  ADD KEY `equipamentos_tipo_equipamento_id_index` (`tipo_equipamento_id`),
  ADD KEY `equipamentos_cidade_comarca_id_index` (`cidade_comarca_id`),
  ADD KEY `equipamentos_vara_id_index` (`vara_id`),
  ADD KEY `equipamentos_setor_id_index` (`setor_id`),
  ADD KEY `equipamentos_marca_id_index` (`marca_id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices de tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `marcas_nome_unique` (`nome`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices de tabela `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setores_nome_unique` (`nome`);

--
-- Índices de tabela `tipos_equipamento`
--
ALTER TABLE `tipos_equipamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipos_equipamento_nome_unique` (`nome`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `varas`
--
ALTER TABLE `varas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `varas_cidade_comarca_id_nome_unique` (`cidade_comarca_id`,`nome`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidades_comarcas`
--
ALTER TABLE `cidades_comarcas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `setores`
--
ALTER TABLE `setores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tipos_equipamento`
--
ALTER TABLE `tipos_equipamento`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `varas`
--
ALTER TABLE `varas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD CONSTRAINT `equipamentos_cidade_comarca_id_foreign` FOREIGN KEY (`cidade_comarca_id`) REFERENCES `cidades_comarcas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamentos_marca_id_foreign` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamentos_setor_id_foreign` FOREIGN KEY (`setor_id`) REFERENCES `setores` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamentos_tipo_equipamento_id_foreign` FOREIGN KEY (`tipo_equipamento_id`) REFERENCES `tipos_equipamento` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamentos_vara_id_foreign` FOREIGN KEY (`vara_id`) REFERENCES `varas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `varas`
--
ALTER TABLE `varas`
  ADD CONSTRAINT `varas_cidade_comarca_id_foreign` FOREIGN KEY (`cidade_comarca_id`) REFERENCES `cidades_comarcas` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
