-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2024 at 01:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netcom`
--

-- --------------------------------------------------------

--
-- Table structure for table `bonsorties`
--

CREATE TABLE `bonsorties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reason` text NOT NULL,
  `magasiner_comments` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'En attente',
  `rejection_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantities_updated` tinyint(1) NOT NULL DEFAULT 0,
  `verified_by_commercial` tinyint(1) NOT NULL DEFAULT 0,
  `reject_justification` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bonsorties`
--

INSERT INTO `bonsorties` (`id`, `user_id`, `stock_id`, `date`, `reason`, `magasiner_comments`, `status`, `rejection_reason`, `created_at`, `updated_at`, `client_id`, `quantities_updated`, `verified_by_commercial`, `reject_justification`) VALUES
(1, 1, 1, '2023-12-29', 'jhfhhfhfhhfhfhfhfhfhfhhfhfhfhhfhfhf  bakar', NULL, '1', NULL, '2023-12-29 15:15:21', '2023-12-29 15:25:31', 12, 0, 1, NULL),
(2, 1, 1, '2024-01-03', 'gqeqnjkhfjksjrfuhgrueghu', NULL, '1', NULL, '2024-01-03 14:47:18', '2024-01-03 14:49:07', 11, 0, 1, NULL),
(3, 1, 1, '2024-01-06', 'hhhwhhfhfhhfhfhhf', NULL, '1', NULL, '2024-01-06 12:03:51', '2024-01-06 12:04:42', 14, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bon_sortie_product`
--

CREATE TABLE `bon_sortie_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bon_sortie_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bon_sortie_product`
--

INSERT INTO `bon_sortie_product` (`id`, `bon_sortie_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, NULL, NULL),
(2, 2, 2, 1, NULL, NULL),
(3, 3, 2, 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'POE', ' est une technologie qui permet de faire passer des données et une alimentation électrique via un même câble Ethernet pour alimenter et connecter des périphériques réseau tels que des points d\'accès sans fil, caméras IP, téléphones VoIP et autres dispositifs alimentés (PD). ', '2023-12-29 13:31:33', '2023-12-29 13:31:33'),
(2, 'MODEM', 'Le modem est un matériel informatique qui permet la connexion au World Wide Web (Internet). De moins en moins utilisés aujourd\'hui car remplacés par les \" box internet \" (ils sont désormais associés à une borne Wi-Fi), ils permettent parfois également d\'accéder à la télévision et à la téléphonie fixe.', '2023-12-29 13:31:33', '2023-12-29 13:31:33'),
(3, 'FTP', 'FTP est l’abréviation de File Transfer Protocol. Ce protocole de communication est utilisé pour l’échange de fichiers entre un serveur et un client.', '2023-12-29 13:31:33', '2023-12-29 13:31:33'),
(4, 'RG45', 'C’est un câble qui permet de relié différent appareils entre eux, pour une transmission de données informatiques.', '2023-12-29 13:31:33', '2023-12-29 13:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'netcom               ', 'netcom@mail.com', '37024199', 'BIM', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(2, 'John                   ', 'john@mail.com', '12345678', 'XYZ', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(3, 'Alice                 ', 'alice@mail.com', '98765432', 'ABC', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(4, 'Bob                     ', 'bob@mail.com', '55555555', 'PQR', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(5, 'Eva                     ', 'eva@mail.com', '77777777', 'LMN', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(6, 'Michael             ', 'michael@mail.com', '99999999', 'EFG', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(7, 'Lily                   ', 'lily@mail.com', '45678901', 'UVW', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(8, 'Alex                   ', 'alex@mail.com', '65432109', 'RST', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(9, 'Sophie               ', 'sophie@mail.com', '98761234', 'JKL', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(10, 'David                 ', 'david@mail.com', '87654321', 'HIJ', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(11, 'Sarah                 ', 'sarah@mail.com', '23456789', 'MNO', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(12, 'Daniel               ', 'daniel@mail.com', '34567890', 'STU', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(13, 'Emma                   ', 'emma@mail.com', '56789012', 'GHI', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(14, 'Oliver               ', 'oliver@mail.com', '78901234', 'NOP', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(15, 'Chloe                 ', 'chloe@mail.com', '89012345', 'DEF', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(16, 'Matthew             ', 'matthew@mail.com', '67890123', 'BTT', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(17, 'Ava                     ', 'ava@mail.com', '89098765', 'BS1', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(18, 'Noah                   ', 'noah@mail.com', '43210987', 'OPQ ', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(19, 'Emily             ', 'emily@mail.com', '54321098', 'LMN', '2023-12-29 13:38:47', '2023-12-29 13:38:47'),
(20, 'William              ', 'william@mail.com', '34567890', 'ABC', '2023-12-29 13:38:47', '2023-12-29 13:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facturedevent`
--

CREATE TABLE `facturedevent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `magasiner_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status_payment` varchar(255) NOT NULL,
  `remiss_applique` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factur_dachats`
--

CREATE TABLE `factur_dachats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `import_logs`
--

CREATE TABLE `import_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `import_logs`
--

INSERT INTO `import_logs` (`id`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'An error occurred: The file field is required.', 'error', '2023-12-29 14:10:32', '2023-12-29 14:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `magasiniers`
--

CREATE TABLE `magasiniers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_09_134345_create_stocks_table', 1),
(6, '2023_11_09_134858_create_categories_table', 1),
(7, '2023_11_09_135051_create_magasiniers_table', 1),
(8, '2023_11_09_135154_create_products_table', 1),
(9, '2023_11_09_135332_create_clients_table', 1),
(10, '2023_11_09_135501_create_employees_table', 1),
(11, '2023_11_10_131830_create_stock_issues_table', 1),
(12, '2023_11_10_184842_create_permission_tables', 1),
(13, '2023_11_10_204121_create_users_tabl', 1),
(14, '2023_11_10_204122_create_facturedevent_table', 1),
(15, '2023_11_13_161718_create_factur_dachats_table', 1),
(16, '2023_11_15_131438_create_notifications_table', 1),
(17, '2023_11_15_192355__create_bonesorties_table', 1),
(18, '2023_11_15_210210_update_notifications_table', 1),
(19, '2023_11_17_090033_add_quantity_issued_to_products_table', 1),
(20, '2023_11_17_132624_create_bon_sortie_product', 1),
(21, '2023_11_17_164448_add_client_id_to_bonsorties_table', 1),
(22, '2023_12_01_124930_add_quantities_updated_to_bonsorties_table', 1),
(23, '2023_12_04_163648_add_unit_to_products_table', 1),
(24, '2023_12_22_162223_add_verifier_by_to_bonsorties_table', 1),
(25, '2023_12_25_130048_add_reject_justification_to_bon_sorties_table', 1),
(26, '2023_11_09_134346_create_stocks_table', 2),
(27, '2023_11_10_131831_create_stock_issues_table', 2),
(28, '2023_12_29_140836_create_import_logs_table', 3),
(29, '2023_12_29_140837_create_import_logs_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notifiable_id`, `notifiable_type`, `data`, `read_at`, `created_at`, `updated_at`, `id`, `type`) VALUES
(1, 'App\\Models\\User', '{\"bon_sortie_id\":3,\"status\":\"sortie\",\"reject_justification\":null,\"message\":\"Bon de Sortie rejected successfully.\"}', NULL, '2024-01-06 12:05:02', '2024-01-06 12:05:02', '002aba01-82bb-466b-b27f-60a4a2bbddc3', 'App\\Notifications\\BonSortieStatusNotification'),
(1, 'App\\Models\\User', '{\"bonSortieId\":3,\"status\":\"accepted\"}', NULL, '2024-01-06 12:04:42', '2024-01-06 12:04:42', '0aaaf95f-efa4-4199-8633-9549d9b27d63', 'App\\Notifications\\BonSortieNotification'),
(1, 'App\\Models\\User', '{\"bon_sortie_id\":1,\"status\":\"sortie\",\"reject_justification\":null,\"message\":\"Bon de Sortie rejected successfully.\"}', NULL, '2023-12-29 15:25:50', '2023-12-29 15:25:50', '3872e899-0e64-482d-9f4d-5d0e5f83b738', 'App\\Notifications\\BonSortieStatusNotification'),
(1, 'App\\Models\\User', '{\"bon_sortie_id\":1,\"status\":\"sortie\",\"reject_justification\":null,\"message\":\"Bon de Sortie rejected successfully.\"}', NULL, '2024-01-03 14:45:55', '2024-01-03 14:45:55', '3da99ef3-e262-43f5-8030-45962e30bac5', 'App\\Notifications\\BonSortieStatusNotification'),
(1, 'App\\Models\\User', '{\"bon_sortie_id\":3}', NULL, '2024-01-06 12:04:28', '2024-01-06 12:04:28', '470563a4-e56c-4c96-9570-4564c70ddef8', 'App\\Notifications\\BonSortieVerificationNotification'),
(1, 'App\\Models\\User', '{\"bonSortieId\":2,\"status\":\"accepted\"}', NULL, '2024-01-03 14:49:07', '2024-01-03 14:49:07', '70255480-c7af-4645-86cc-27032d626bb6', 'App\\Notifications\\BonSortieNotification'),
(1, 'App\\Models\\User', '{\"bon_sortie_id\":2,\"status\":\"sortie\",\"reject_justification\":null,\"message\":\"Bon de Sortie rejected successfully.\"}', NULL, '2024-01-03 14:50:07', '2024-01-03 14:50:07', '81e4e690-e4e2-4f0e-bd0d-448d15560792', 'App\\Notifications\\BonSortieStatusNotification'),
(1, 'App\\Models\\User', '{\"bonSortieId\":1,\"status\":\"accepted\"}', NULL, '2023-12-29 15:25:31', '2023-12-29 15:25:31', 'abd40389-fe4f-48b5-8931-0e29ac3ed071', 'App\\Notifications\\BonSortieNotification'),
(1, 'App\\Models\\User', '{\"bon_sortie_id\":2}', NULL, '2024-01-03 14:48:12', '2024-01-03 14:48:12', 'b855022f-85ac-4992-8faa-8d200fbad893', 'App\\Notifications\\BonSortieVerificationNotification'),
(1, 'App\\Models\\User', '{\"bon_sortie_id\":1}', NULL, '2023-12-29 15:24:56', '2023-12-29 15:24:56', 'bdd865a4-0506-44ee-b0db-d3e3de113ec1', 'App\\Notifications\\BonSortieVerificationNotification');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity_issued` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `reference`, `label`, `description`, `quantity`, `price`, `category_id`, `stock_id`, `created_at`, `updated_at`, `quantity_issued`, `unit`) VALUES
(2, ' Ethernet Cable\n', 'RG45002', 'RG45\n', ' A high-quality Ethernet cable for reliable network connections', 6, 2000, 4, 1, '2023-12-29 15:12:22', '2024-01-06 12:05:02', 0, 'U'),
(3, 'Data Transfer Cable', 'DC1003', 'Cables', 'A data transfer cable connecting two devices for efficient data transfer', 40, 2000, 3, 1, '2023-12-29 15:12:22', '2023-12-29 15:12:22', 0, 'U'),
(4, 'Networking Kit', 'NK2004', 'Networking', 'A networking kit to establish or strengthen your professional network', 40, 2000, 3, 1, '2023-12-29 15:12:22', '2023-12-29 15:12:22', 0, 'U'),
(5, 'Power over Ethernet Adapter', 'CPE3005', 'CPE', 'A Power over Ethernet adapter for implementing wired Ethernet LANs', 30, 2000, 2, 1, '2023-12-29 15:12:22', '2023-12-29 15:12:22', 0, 'U'),
(6, '\nPoE Switch', 'POE4006', 'POE', 'A Power over Ethernet switch to provide power and network connectivity', 50, 2000, 1, 1, '2023-12-29 15:12:22', '2023-12-29 15:12:22', 0, 'U');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `name`, `location`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 'GS1', 'Netcom', 1000, '2023-12-29 13:27:25', '2023-12-29 13:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `stock_issues`
--

CREATE TABLE `stock_issues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bakar', 'Bakar@gmail.com', NULL, '$2y$12$jZFNPyeF7iTR/IBYnhU6ReUYTCiyW35zRWNY8L/XUXzEcQ.r9gG8a', 0, NULL, '2023-12-29 12:37:57', '2023-12-29 13:01:39'),
(2, 'ismail', 'ismail@gmail.com', NULL, '$2y$12$h7w1O5GD9Lqe.NGdeinrYui/P/dUPszjRlo/XWLjuHqAbWSmsUXae', 1, NULL, '2023-12-29 12:39:10', '2023-12-29 12:39:10'),
(3, 'Brahim', 'Brahim@gmail.com', NULL, '$2y$12$GBLlfUtUy54agh/H1qQNGu0ML.5o.td3C3ymYEtyEFrgh0Q3i4NJy', 2, NULL, '2023-12-29 12:40:21', '2023-12-29 12:40:21'),
(4, 'Fall Ba', 'Fall@gmail.com', NULL, '$2y$12$sLWTRejM/VXbIuiKzQFmSOocLx.TXc3QWJ1T3WlWIZsXJt8BNTwXC', 3, NULL, '2023-12-29 12:44:34', '2023-12-29 12:44:34'),
(5, 'Esma', 'Esma@gmail.com', NULL, '$2y$12$qoFMZEJctARg1n749vb7WuTZLsSrfibmfkkSdMubd5Od/.Ch4G7Fq', 3, NULL, '2023-12-29 15:23:59', '2023-12-29 15:23:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonsorties`
--
ALTER TABLE `bonsorties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bonsorties_user_id_foreign` (`user_id`),
  ADD KEY `bonsorties_stock_id_foreign` (`stock_id`),
  ADD KEY `bonsorties_client_id_foreign` (`client_id`);

--
-- Indexes for table `bon_sortie_product`
--
ALTER TABLE `bon_sortie_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bon_sortie_product_bon_sortie_id_foreign` (`bon_sortie_id`),
  ADD KEY `bon_sortie_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_stock_id_foreign` (`stock_id`);

--
-- Indexes for table `facturedevent`
--
ALTER TABLE `facturedevent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturedevent_product_id_foreign` (`product_id`),
  ADD KEY `facturedevent_magasiner_id_foreign` (`magasiner_id`),
  ADD KEY `facturedevent_client_id_foreign` (`client_id`);

--
-- Indexes for table `factur_dachats`
--
ALTER TABLE `factur_dachats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factur_dachats_client_id_foreign` (`client_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `import_logs`
--
ALTER TABLE `import_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `magasiniers`
--
ALTER TABLE `magasiniers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `magasiniers_email_unique` (`email`),
  ADD KEY `magasiniers_stock_id_foreign` (`stock_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_stock_id_foreign` (`stock_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_issues`
--
ALTER TABLE `stock_issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_issues_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bonsorties`
--
ALTER TABLE `bonsorties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bon_sortie_product`
--
ALTER TABLE `bon_sortie_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facturedevent`
--
ALTER TABLE `facturedevent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `factur_dachats`
--
ALTER TABLE `factur_dachats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `import_logs`
--
ALTER TABLE `import_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `magasiniers`
--
ALTER TABLE `magasiniers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_issues`
--
ALTER TABLE `stock_issues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bonsorties`
--
ALTER TABLE `bonsorties`
  ADD CONSTRAINT `bonsorties_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bonsorties_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`),
  ADD CONSTRAINT `bonsorties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bon_sortie_product`
--
ALTER TABLE `bon_sortie_product`
  ADD CONSTRAINT `bon_sortie_product_bon_sortie_id_foreign` FOREIGN KEY (`bon_sortie_id`) REFERENCES `bonsorties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bon_sortie_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`);

--
-- Constraints for table `facturedevent`
--
ALTER TABLE `facturedevent`
  ADD CONSTRAINT `facturedevent_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `facturedevent_magasiner_id_foreign` FOREIGN KEY (`magasiner_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `facturedevent_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `factur_dachats`
--
ALTER TABLE `factur_dachats`
  ADD CONSTRAINT `factur_dachats_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `magasiniers`
--
ALTER TABLE `magasiniers`
  ADD CONSTRAINT `magasiniers_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_issues`
--
ALTER TABLE `stock_issues`
  ADD CONSTRAINT `stock_issues_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
