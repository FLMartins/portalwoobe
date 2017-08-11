-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24-Set-2016 às 11:22
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `i2731339_lara1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tecnologia', '2016-09-24 08:45:11', '2016-09-24 08:45:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_08_26_213921_create_categorias_table', 1),
('2016_08_27_050253_create_posts_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_imagem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `destaque` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `title`, `descricao`, `key`, `url_imagem`, `text`, `categoria_id`, `user_id`, `destaque`, `active`, `created_at`, `updated_at`) VALUES
(1, 'asdasdasdasd', 'asdasdasd', 'xSdcsE3L0IcIyW2JMWYN64T3bHOh8u', '', '<p style="margin-bottom: 15px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan metus varius mauris sodales ultricies. Praesent nec nibh ornare, eleifend turpis a, consectetur odio. Donec vitae neque non enim commodo semper sit amet a sem. Duis eros justo, fermentum et bibendum id, iaculis nec magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed pellentesque ipsum sed odio aliquam, ac ultrices est ullamcorper. Maecenas id tellus magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis venenatis sit amet felis sed tempor. Nunc lacinia sed turpis id blandit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p><p style="margin-bottom: 15px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Aenean at pulvinar metus. Mauris fermentum imperdiet rutrum. Donec pellentesque sapien vitae elit euismod bibendum. Quisque ut est neque. Pellentesque bibendum sit amet dolor a semper. Duis imperdiet eget leo nec vulputate. Etiam faucibus eleifend felis vitae laoreet.</p><p style="margin-bottom: 15px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Curabitur interdum euismod dolor quis faucibus. Donec diam purus, consectetur non porttitor in, lacinia in ex. Vivamus faucibus quam enim, et faucibus enim bibendum tempor. Proin efficitur vestibulum felis, et dignissim nulla iaculis at. In hac habitasse platea dictumst. Pellentesque vehicula risus sapien, ac ornare velit porta at. Nulla pellentesque at mi non ornare. Nunc cursus pretium urna, sit amet vulputate velit vehicula ut. Aenean volutpat, neque vel tempor euismod, tortor arcu porta nulla, ac lobortis metus ex eget augue.</p><p style="margin-bottom: 15px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Nunc mollis tempus euismod. Nulla ornare pharetra faucibus. Pellentesque eget risus sed diam accumsan sagittis vitae a elit. Mauris finibus turpis at lectus blandit, a rhoncus dolor lacinia. Nam libero mi, maximus sit amet neque vitae, porta feugiat lorem. Maecenas cursus eget arcu ac lacinia. Aenean vel nibh est. Duis ullamcorper ligula in est suscipit, vitae tincidunt risus efficitur. Curabitur iaculis lacus pretium, iaculis sapien vel, pellentesque sapien. Aliquam in turpis quis dolor bibendum consectetur.</p><p style="margin-bottom: 15px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Maecenas tincidunt orci turpis, quis accumsan lectus porttitor ac. Donec rhoncus sapien mi, quis consectetur diam malesuada id. Duis accumsan eget risus eget luctus. Nulla facilisi. Cras et tellus neque. Aenean ultrices arcu sed erat malesuada, vel interdum augue sollicitudin. Vestibulum vel ultrices eros, in accumsan ligula. Fusce in lorem at massa rhoncus venenatis. Proin quis maximus mi. Donec suscipit, est ut tempor suscipit, elit enim sagittis neque, sit amet hendrerit massa urna a purus. Nulla ultrices, ante ac sagittis venenatis, nibh velit posuere ex, nec congue risus massa vitae tellus. Nam eget placerat velit. Phasellus eu fermentum tellus. Maecenas dignissim molestie dui vitae gravida.</p><p style="margin-bottom: 15px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Duis dapibus luctus lorem nec dapibus. Etiam ultrices ultricies sollicitudin. Suspendisse tincidunt et nunc in ultricies. Etiam vulputate mollis risus vel interdum. Integer vitae nisi urna. Phasellus cursus dictum justo sit amet porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam dui nulla, sagittis sed justo a, malesuada fermentum nisl. Nam hendrerit, orci eget pretium euismod, erat nisi laoreet ex, nec mollis nisl massa et erat. Vivamus dictum vulputate tortor in sodales. Aenean id consequat justo, vitae vestibulum sem. Donec venenatis nec massa at eleifend. Sed placerat ipsum a consequat suscipit. Pellentesque sollicitudin mauris metus, non pulvinar purus fermentum in. Sed ullamcorper mi vel lorem posuere, a tincidunt mi rhoncus. Curabitur faucibus condimentum sapien.</p><p style="margin-bottom: 15px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Phasellus semper sagittis velit. Vestibulum sed sapien quis nunc hendrerit ultrices vel sit amet orci. Curabitur pretium mi eu varius egestas. Nulla ultricies euismod eros, sit amet lacinia magna vulputate non. Mauris vitae lorem sem. Etiam non ipsum rhoncus, malesuada elit lobortis, faucibus lacus. Morbi finibus dapibus facilisis. Vivamus urna lectus, molestie at nunc in, varius auctor nunc. Phasellus laoreet nulla fringilla, euismod dui quis, ultricies nibh. In lobortis nisl porta, iaculis est ut, fringilla sapien. Aliquam erat volutpat. Cras malesuada ante eget orci laoreet imperdiet.</p><p style="margin-bottom: 15px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Vestibulum hendrerit mollis arcu, in lacinia ipsum gravida quis. Etiam venenatis lacus orci, vitae blandit felis facilisis hendrerit. Maecenas vitae dapibus nunc, ut accumsan mi. Duis commodo lacus sit amet sapien volutpat bibendum ut in augue. Nulla semper enim eu molestie pretium. Vestibulum lectus metus, accumsan bibendum tincidunt ut, imperdiet quis nisl. Vivamus hendrerit hendrerit ipsum eu malesuada. Pellentesque odio lectus, posuere in mattis vel, ultrices ultricies ipsum. Vivamus eget varius massa. Cras vitae urna in lorem ultricies facilisis. Duis sagittis quam sit amet elementum faucibus. Nunc eget felis non augue porta semper et id lacus.</p><p style="margin-bottom: 15px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Cras hendrerit erat diam, vitae tincidunt nisi accumsan ut. Sed gravida tempus odio, eu ornare libero lobortis vel. Suspendisse tempus eget ante eget porta. Nullam pulvinar interdum sodales. Nulla fermentum suscipit arcu vitae tempor. Nam egestas lacinia sem, a sollicitudin leo fringilla a. Maecenas eu tortor ac metus lacinia facilisis. Sed sed pharetra enim, et vehicula lorem. Curabitur eu ipsum imperdiet, gravida purus eget, blandit lectus. Praesent egestas nisi ex, vitae volutpat neque pulvinar at. Sed non luctus nisi. Fusce dignissim purus ligula, pretium bibendum massa accumsan in.</p><p style="margin-bottom: 15px; text-align: justify; font-family: " open="" sans",="" arial,="" sans-serif;="" font-size:="" 14px;"="">Mauris porta enim in magna fringilla, sed ullamcorper ipsum interdum. Phasellus nibh eros, iaculis eget sagittis quis, iaculis non quam. Suspendisse potenti. Vestibulum porttitor risus ac ante fermentum interdum. Ut a sapien a metus convallis imperdiet in eget neque. Praesent in mi tellus. Curabitur sodales eu lacus in dignissim. Suspendisse non bibendum nulla.</p>', 1, 1, 0, 1, '2016-09-24 08:45:18', '2016-09-24 12:17:42'),
(2, 'aa', 'aa', 'zhKga4LRVyDDCNSVBP9tcFHS9dmuhn', '', '', 1, 1, 0, 1, '2016-09-24 11:45:27', '2016-09-24 11:46:09'),
(3, 'bb', 'bb', 'JIsXGMu04TJ5IwijPTxP6mYpARicFw', '', '', 1, 1, 0, 1, '2016-09-24 11:45:35', '2016-09-24 11:46:08'),
(4, 'cc', 'cc', 'xrNuFys3rtE7CkSFvJWc8tYELGbUxm', '', '', 1, 1, 0, 1, '2016-09-24 11:45:41', '2016-09-24 11:46:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `moderator` tinyint(1) NOT NULL DEFAULT '0',
  `author` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `moderator`, `author`, `last_login`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Willian Alfeu', 'willian-alfeu@woobe.com.br', '$2y$10$jzqRpByjvriy5Eup/1XCDOsOzVI2cIXQH8e0qqOGxFCFk6aMe2ZzO', 1, 1, 0, '2016-09-24 08:28:50', NULL, '2016-09-24 05:28:32', '2016-09-24 08:28:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_categoria_id_foreign` (`categoria_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
