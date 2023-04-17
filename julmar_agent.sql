-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 12:00 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `julmar_agent`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_applied_customers`
--

CREATE TABLE `agent_applied_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agent_applied_customers`
--

INSERT INTO `agent_applied_customers` (`id`, `user_id`, `customer_id`, `location_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2022-10-25 11:15:05', '2022-10-25 11:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `agent_users`
--

CREATE TABLE `agent_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agent_users`
--

INSERT INTO `agent_users` (`id`, `user_id`, `full_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'JUANITO MULAT', '2022-10-25 02:51:20', '2022-10-25 02:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `ar_ledgers`
--

CREATE TABLE `ar_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_delivered` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `export_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(15,4) NOT NULL,
  `collected` double(15,4) NOT NULL,
  `balance` double(15,4) NOT NULL,
  `check_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_cm` double(15,4) NOT NULL,
  `final_balance` double(15,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bos`
--

CREATE TABLE `bos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bo_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `principal_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `total_amount` decimal(15,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bo_details`
--

CREATE TABLE `bo_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bo_id` bigint(20) UNSIGNED NOT NULL,
  `sku_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `or_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_collected` date NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `principal_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount_collected` double(15,4) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_cash_checks`
--

CREATE TABLE `collection_cash_checks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `particulars` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(15,4) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_details`
--

CREATE TABLE `collection_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `total_dr_amount` double(15,4) NOT NULL,
  `cash` double(15,4) NOT NULL,
  `check` double(15,4) NOT NULL,
  `over_payment` double(15,4) NOT NULL,
  `delivery_receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_images`
--

CREATE TABLE `collection_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_referals`
--

CREATE TABLE `collection_referals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `refer_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refer_delivery_receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refer_principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refer_cash` double(15,4) NOT NULL,
  `refer_check` double(15,4) NOT NULL,
  `refer_remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kind_of_business` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `location_id`, `detailed_location`, `store_name`, `kind_of_business`, `created_at`, `updated_at`) VALUES
(1, '1', 'ST. IGNITIUS KAUSWAGAN', ' CAGAYAN DE ORO CITY', 'JAYMAR MACAHILOS', '2022-10-25 11:15:05', '2022-10-25 11:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `customer_principal_codes`
--

CREATE TABLE `customer_principal_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `principal_id` int(11) NOT NULL,
  `store_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_principal_prices`
--

CREATE TABLE `customer_principal_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `principal_id` int(11) NOT NULL,
  `price_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_uploads`
--

CREATE TABLE `customer_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_export_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location`, `created_at`, `updated_at`) VALUES
(1, 'CAGAYAN DE ORO CITY', '2022-10-25 10:51:40', '2022-10-25 10:51:40'),
(2, 'MISAMIS ORIENTAL EAST', '2022-10-25 10:51:40', '2022-10-25 10:51:40'),
(4, 'SOUTH BUKIDNON', '2022-10-25 10:51:40', '2022-10-25 10:51:40'),
(5, 'ILIGAN', '2022-10-25 10:51:41', '2022-10-25 10:51:41'),
(6, 'WEST MIS. OR', '2022-10-25 10:51:41', '2022-10-25 10:51:41'),
(7, 'NORTH BUKIDNON', '2022-10-25 10:51:41', '2022-10-25 10:51:41'),
(8, 'LANAO', '2022-10-25 10:51:41', '2022-10-25 10:51:41'),
(9, 'MISAMIS ORIENTAL', '2022-10-25 10:51:41', '2022-10-25 10:51:41'),
(10, 'CENTRAL BUKIDNON', '2022-10-25 10:51:41', '2022-10-25 10:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_03_02_022125_create_principals_table', 1),
(6, '2021_03_02_031904_create_locations_table', 1),
(7, '2021_03_07_012357_create_sku_inventories_table', 1),
(8, '2021_03_07_013419_create_customer_uploads_table', 1),
(9, '2021_03_07_013427_create_customers_table', 1),
(10, '2021_03_08_050429_create_sales_orders_table', 1),
(11, '2021_03_08_050442_create_sales_order_details_table', 1),
(12, '2021_03_10_130601_create_bos_table', 1),
(13, '2021_03_10_130609_create_bo_details_table', 1),
(14, '2021_03_18_004835_create_sku_uploads_table', 1),
(15, '2021_03_18_013438_create_customer_principal_codes_table', 1),
(16, '2021_03_18_073538_create_customer_principal_prices_table', 1),
(17, '2021_03_20_032057_create_agent_applied_customers_table', 1),
(18, '2021_03_22_015054_create_sales_register_uploadeds_table', 1),
(19, '2021_03_22_023605_create_sales_register_details_table', 1),
(20, '2021_04_13_031016_create_summary_of_transaction_ledgers_table', 1),
(21, '2021_04_13_031017_create_van_selling_transactions_table', 1),
(22, '2021_04_13_031018_create_van_selling_transaction_details_table', 1),
(23, '2021_04_16_005138_create_van_selling_uploads_table', 1),
(24, '2021_05_11_005915_create_van_selling_upload_ledgers_table', 1),
(25, '2021_05_15_033531_create_van_selling_upload_transactions_table', 1),
(26, '2021_06_18_002313_create_collections_table', 1),
(27, '2021_06_18_002348_create_collection_details_table', 1),
(28, '2021_06_18_002409_create_collection_images_table', 1),
(29, '2021_06_19_004918_create_collection_cash_checks_table', 1),
(30, '2021_06_21_061409_create_collection_referals_table', 1),
(31, '2021_07_02_015936_create_ar_ledgers_table', 1),
(32, '2021_07_14_030941_create_van_selling_transaction_cms_table', 1),
(33, '2021_07_14_031001_create_van_selling_transaction_cm_details_table', 1),
(34, '2021_08_04_025812_create_van_selling_price_updates_table', 1),
(35, '2021_08_04_025822_create_van_selling_price_update_details_table', 1),
(36, '2021_08_19_002530_create_van_selling_customers_table', 1),
(37, '2021_10_28_004353_create_agent_users_table', 1),
(38, '2021_11_15_015800_create_van_selling_transaction_cart_details_table', 1),
(39, '2021_11_29_010415_create_van_selling_van_loads_table', 1),
(40, '2022_02_03_122936_create_van_selling_cancellations_table', 1),
(41, '2022_02_03_122946_create_van_selling_cancellation_details_table', 2),
(42, '2022_03_03_152102_add_remarks_to_van_selling_transaction_table', 2),
(43, '2022_10_25_122807_add_status_tovscustomer', 3),
(44, '2022_10_31_021507_create_van_selling_inventories_table', 4),
(45, '2022_10_31_025250_create_van_selling_os_cart_details_table', 5),
(46, '2022_10_31_042755_add_collumn', 6),
(47, '2022_10_31_054924_create_van_selling_os_datas_table', 7),
(48, '2022_10_31_055621_add_column_to_os_data', 8),
(49, '2022_10_31_062245_add_status_to_os_data', 9),
(50, '2022_10_31_062926_add_date_to_os_data', 10),
(51, '2022_11_03_115728_add_remarks_to_vansellilng_cusotmer', 11),
(52, '2022_11_06_093806_create_van_selling_calls_table', 12),
(53, '2022_11_08_124739_add_columns_to_os_data', 13),
(54, '2022_11_08_125627_add_customer_id_to_os_data', 14),
(55, '2022_11_12_030533_add_serve_temp_qty', 15),
(56, '2022_11_12_133328_add_code_to_van_selling_os_datas', 16),
(57, '2022_11_12_134320_add_unit_price_to_os_data', 17),
(58, '2022_11_12_134624_add_unit_price_to_vscartdetails', 18),
(59, '2022_11_12_141601_add_temp_up', 19);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `principals`
--

CREATE TABLE `principals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `principals`
--

INSERT INTO `principals` (`id`, `principal`, `created_at`, `updated_at`) VALUES
(1, 'None', '2022-10-25 10:53:53', '2022-10-25 10:53:53'),
(2, 'GCI', '2022-10-25 10:53:53', '2022-10-25 10:53:53'),
(3, 'PFC', '2022-10-25 10:53:53', '2022-10-25 10:53:53'),
(4, 'EPI', '2022-10-25 10:53:53', '2022-10-25 10:53:53'),
(5, 'DOLE', '2022-10-25 10:53:53', '2022-10-25 10:53:53'),
(6, 'ALASKA', '2022-10-25 10:53:54', '2022-10-25 10:53:54'),
(7, 'CIFPI', '2022-10-25 10:53:54', '2022-10-25 10:53:54'),
(8, 'PPMC', '2022-10-25 10:53:54', '2022-10-25 10:53:54'),
(10, 'SUNPRIDE FOODS', '2022-10-25 10:53:54', '2022-10-25 10:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `principal_id` bigint(20) UNSIGNED NOT NULL,
  `sales_order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `mode_of_transaction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_details`
--

CREATE TABLE `sales_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_order_id` bigint(20) UNSIGNED NOT NULL,
  `sku_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `sku_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measurement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_register_details`
--

CREATE TABLE `sales_register_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_register_id` bigint(20) UNSIGNED NOT NULL,
  `sku_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `sku_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_register_uploadeds`
--

CREATE TABLE `sales_register_uploadeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `principal_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `export_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `dr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sku_inventories`
--

CREATE TABLE `sku_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measurement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principal_id` bigint(20) UNSIGNED NOT NULL,
  `running_balance` int(11) NOT NULL,
  `price_1` decimal(15,4) NOT NULL,
  `price_2` decimal(15,4) NOT NULL,
  `price_3` decimal(15,4) NOT NULL,
  `price_4` decimal(15,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sku_uploads`
--

CREATE TABLE `sku_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku_upload_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `summary_of_transaction_ledgers`
--

CREATE TABLE `summary_of_transaction_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `so_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_amount` decimal(15,4) NOT NULL,
  `dr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id` int(11) NOT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_date` date NOT NULL,
  `collection` decimal(15,4) NOT NULL,
  `bo` decimal(15,4) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_calls`
--

CREATE TABLE `van_selling_calls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `van_selling_calls`
--

INSERT INTO `van_selling_calls` (`id`, `store_name`, `location_id`, `address`, `date`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'WEDNESDAY SORE', 'CAGAYAN DE ORO CITY', 'ASDASD', '2022-11-06', 'PRODUCTIVE', '2022-11-06 09:57:54', '2022-11-06 09:57:54'),
(3, 'CUSTOMER 1', 'SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 03:25:16', '2022-11-12 03:25:16'),
(4, 'CUSTOMER 1', 'SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 03:44:53', '2022-11-12 03:44:53'),
(5, 'CUSTOMER 1', 'SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 03:45:55', '2022-11-12 03:45:55'),
(6, 'CUSTOMER 1', 'SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 03:48:11', '2022-11-12 03:48:11'),
(7, 'WEDNESDAY SORE', 'CAGAYAN DE ORO CITY', 'ASDASD', '2022-11-12', 'PRODUCTIVE', '2022-11-12 03:49:30', '2022-11-12 03:49:30'),
(8, 'CUSTOMER 1', 'SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 03:52:02', '2022-11-12 03:52:02'),
(9, 'CUSTOMER 1', 'SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 04:08:16', '2022-11-12 04:08:16'),
(13, 'Geraldine', ' CAGAYAN DE ORO CITY', 'Address', '2022-11-12', 'UNPRODUCTIVE', '2022-11-12 05:29:44', '2022-11-12 05:29:44'),
(14, 'CUSTOMER 1', ' SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'UNPRODUCTIVE', '2022-11-12 05:31:22', '2022-11-12 05:31:22'),
(15, 'CUSTOMER 1', ' SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 05:47:27', '2022-11-12 05:47:27'),
(16, 'CUSTOMER 1', ' SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 13:39:36', '2022-11-12 13:39:36'),
(17, 'CUSTOMER 1', ' SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 13:40:38', '2022-11-12 13:40:38'),
(18, 'CUSTOMER 1', ' SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 13:54:04', '2022-11-12 13:54:04'),
(19, 'CUSTOMER 1', ' SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 13:55:54', '2022-11-12 13:55:54'),
(20, 'CUSTOMER 1', ' SOUTH BUKIDNON', 'ADDRESS', '2022-11-12', 'PRODUCTIVE', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(21, 'SMEPL', ' CAGAYAN DE ORO CITY', 'SITIO', '2022-11-15', 'PRODUCTIVE', '2022-11-15 11:12:35', '2022-11-15 11:12:35'),
(22, 'CUSTOMER 1', ' SOUTH BUKIDNON', 'ADDRESS', '2022-11-16', 'PRODUCTIVE', '2022-11-16 11:23:00', '2022-11-16 11:23:00'),
(23, 'sample', ' ILIGAN', '12', '2023-01-10', 'UNPRODUCTIVE', '2023-01-10 03:10:27', '2023-01-10 03:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_cancellations`
--

CREATE TABLE `van_selling_cancellations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `van_selling_trans_id` bigint(20) UNSIGNED NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_cancellation_details`
--

CREATE TABLE `van_selling_cancellation_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vs_cancelation_id` bigint(20) UNSIGNED NOT NULL,
  `sku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `unit_of_measurement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_customers`
--

CREATE TABLE `van_selling_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `van_selling_customers`
--

INSERT INTO `van_selling_customers` (`id`, `location_id`, `store_name`, `store_type`, `barangay`, `address`, `created_at`, `updated_at`, `contact_person`, `contact_number`, `longitude`, `latitude`, `status`, `remarks`) VALUES
(1, 4, 'CUSTOMER 1', 'STORE TYPE', 'BARANGAY', 'ADDRESS', '2022-11-03 03:56:33', '2022-11-15 03:14:03', 'CONTACT PERSON', '9533844872', '8.478645872692189', '124.63555647301995', 'DONE', 'DONE'),
(2, 1, 'WEDNESDAY SORE', 'SSS', 'SADASD', 'ASDASD', '2022-11-05 01:31:21', '2022-11-15 03:14:03', 'QWEQWE', '123123123', '8.478466793318129', '124.6445375948288', 'DONE', 'DONE'),
(3, 1, 'STORE 3', 'SSS', 'BARANGAY', 'ZONE', '2022-11-05 02:22:53', '2022-11-15 03:14:03', 'SIDNEY', '09533844872', '8.496011803348047', '124.6302921854512', 'DONE', 'DONE'),
(4, 1, 'STORE 3', 'SSS', 'BARANGAY', 'ZONE', '2022-11-05 02:22:54', '2022-11-15 03:14:03', 'SIDNEY', '09533844872', '8.477737232466078', '124.64248838714143', 'DONE', 'DONE'),
(5, 1, 'VAN SELLING HELL', 'SSS', 'BARNAGAY', 'ZONE', '2022-11-12 04:09:42', '2022-11-15 03:14:04', 'SAMPLE', '09533844872', '8.49980608272853', '124.63016546745911', 'DONE', 'DONE'),
(8, 1, 'Geraldine', 'SSS', 'Barangay', 'Address', '2022-11-12 05:29:44', '2022-11-15 03:14:04', 'UUIIUHHI', '09533844872', '8.500331795695448', '124.6293178894104', 'DONE', 'DONE'),
(9, 4, 'CUSTOMER 1', 'STORE TYPE', 'BARANGAY', 'ADDRESS', '2022-11-12 05:31:22', '2022-11-15 03:14:04', 'RUTH', '09554810731', '8.46756917523645', '124.58513177299676', 'DONE', 'DONE'),
(10, 1, 'SMEPL', 'SSS', 'BARANGAY', 'SITIO', '2022-11-15 11:12:35', '2022-11-15 03:14:04', 'QWEQWE', '09533844872', '8.49978462505641', '124.62806798000946', 'DONE', 'DONE'),
(11, 1, 'TRA', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:34', '2022-12-07 19:31:34', 'TRA STORE', '09261713676', '8.46756917523645', '124.5867997463653', 'DONE', NULL),
(12, 1, 'AZ VARIETY', 'GRO', 'CANITOAN', 'HIGHWAY', '2022-12-07 19:31:34', '2022-12-07 19:31:34', 'AZ VARIETY', '09756240518', '8.465972994480358', '124.58513177299676', 'DONE', NULL),
(13, 1, 'RUTH STORE', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:34', '2022-12-07 19:31:34', 'RUTH', '09554810731', '8.461080475194132', '124.58398921523245', 'DONE', NULL),
(14, 1, 'PRINCESS', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:34', '2022-12-07 19:31:34', 'PRINCESS', '09068756452', '8.459736888880755', '124.58422289626395', 'DONE', NULL),
(15, 1, 'NIK', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'NIK', '09171020086', '8.459996179868025', '124.58417486505358', 'DONE', NULL),
(16, 1, 'MOLINA MERCHANDISE', 'GRO', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'MOLINA', 'none', '8.45876173544584', '124.58442781553062', 'DONE', NULL),
(17, 1, 'REBECCA STORE', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'REBECCA', '09066754740', '8.458812472548324', '124.58438306980113', 'DONE', NULL),
(18, 1, 'CAPISTRANO', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'CAPISTRANO', '09059314563', '8.459251534001249', '124.58433569103373', 'DONE', NULL),
(19, 1, 'FARMACIA GICAN', 'PMS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'FARMACIA', '09155803784', '8.467037182745946', '124.58565756137466', 'DONE', NULL),
(20, 1, 'PACAMO STORE', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'PACAMO', 'none', '8.467063290551556', '124.58571355929055', 'DONE', NULL),
(21, 1, 'SABLAS', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'SABLAS', '09659802549', '8.467079821670211', '124.58573759452558', 'DONE', NULL),
(22, 1, 'RAMDLZ', 'SSS', 'CANITOAN', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'RAMDLZ', '09057889796', '8.470602337887334', '124.5907278570435', 'DONE', NULL),
(23, 1, 'MOA-LEGASPI', 'SSS', 'CANITOAN', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'MOA', 'none', '8.472895272297675', '124.59398662225536', 'DONE', NULL),
(24, 1, 'J-KINT', 'SSS', 'CALA-ANAN', 'ZONE 6', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'J-KINT', '09755490301', '8.473435535438307', '124.60807283754173', 'DONE', NULL),
(25, 1, 'MONTEREY MEATSHOP', 'GRO', 'CALA-ANAN', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'MONTEREY', '09958457269', '8.459840417243946', '124.60765992392695', 'DONE', NULL),
(26, 1, 'SALCEDA', 'SSS', 'CALA-ANAN', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'SALCEDA', '09268954875', '8.454642632435398', '124.60432034487171', 'DONE', NULL),
(27, 1, 'NORA STORE', 'SSS', 'CALA-ANAN', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'NORA', '09161514643', '8.454198461837635', '124.60417312896033', 'DONE', NULL),
(28, 1, '3A', 'SSS', 'CALA-ANAN', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'ARLENE', '09974355385', '8.454279135808818', '124.60449977609161', 'DONE', NULL),
(29, 1, 'ALEX LAUNDRY/RETAIL', 'SSS', 'ZAYAS', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'ALEX', '09453050872', '8.474518000176804', '124.62512376205493', 'DONE', NULL),
(30, 1, 'AZ VARIETY', 'GRO', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'AZ', 'None', '8.466519891503504', '124.58522833300708', 'DONE', NULL),
(31, 1, 'MEDIO', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'MENIN', '09450732392', '8.443358723113333', '124.57408588236203', 'DONE', NULL),
(32, 1, 'FIL-AM', 'SSS', 'UPPER CAMARAHAN', 'ZONE 1', '2022-12-07 19:31:35', '2022-12-07 19:31:35', 'FIL-AM', '09171047548', '8.442848995254092', '124.57501721780181', 'DONE', NULL),
(33, 1, 'DOUBLE F', 'SSS', 'LUMBIA', 'PAHIRON', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'FELISA', '0936222679', '8.420458916616022', '124.5793792486867', 'DONE', NULL),
(34, 1, 'ACOSTA', 'SSS', 'LUMBIA', 'HIGHWAY', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'VERGENIA', '09365623020', '8.401182548979316', '124.59150881638186', 'DONE', NULL),
(35, 1, 'ANGEL', 'SSS', 'LUMBIA', 'HIGHWAY', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'ANGEL', '09262359619', '8.400117862055712', '124.59238473563093', 'DONE', NULL),
(36, 1, 'REYES', 'SSS', 'LUMBIA', 'PUB. MKT', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'REYES', '09262908645', '8.402828019680069', '124.59497655478188', 'DONE', NULL),
(37, 1, 'XAVIER ECOVILLE COOP', 'GRO', 'LUMBIA', 'PUB. MKT', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'MARILOU', '09262395030', '8.402892805848714', '124.59444526745912', 'DONE', NULL),
(38, 1, 'BROWN', 'SSS', 'LUMBIA', 'PUB. MKT', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'BROWN', '09051434122', '8.402724509205612', '124.59475309258595', 'DONE', NULL),
(39, 1, 'PICK & PAY', 'SSS', 'LUMBIA', 'PUB. MKT', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'PICK & PAY', 'N/A', '8.402523462329599', '124.59497808470854', 'DONE', NULL),
(40, 1, 'PAJARON', 'SSS', 'LUMBIA', 'PUB. MKT', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'PAJARON', '09268692414', '8.402645181575753', '124.59496937182473', 'DONE', NULL),
(41, 1, 'JANOLINO', 'SSS', 'LUMBIA', 'ZONE 2', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'RITCHELL', '09367716102', '8.398829991057443', '124.59606210597138', 'DONE', NULL),
(42, 1, 'ANSIN', 'SSS', 'LUMBIA', 'HIGHWAY', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'ANSIN', '09369292274', '8.397683650023062', '124.59679177879298', 'DONE', NULL),
(43, 1, 'OGUIMAS', 'SSS', 'LUMBIA', 'HIGHWAY', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'OGUIMAS', 'N/A', '8.401874103515219', '124.61112325958631', 'DONE', NULL),
(44, 1, 'RAJ', 'SSS', 'KAUSWAGAN', 'ZONE 1', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'RAJ', '09069721159', '8.497830067580821', '124.6429768024038', 'DONE', NULL),
(45, 1, 'IBON', 'SSS', 'KAUSWAGAN', 'ST. IGNATIUS', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'IBON', 'N/A', '8.496589380662163', '124.63563512665982', 'DONE', NULL),
(46, 1, 'MEILL', 'SSS', 'KAUSWAGAN', 'ZONE 4', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'MEILL', '09753454021', '8.497840466379726', '124.64379850233198', 'DONE', NULL),
(47, 1, 'LENNETH', 'SSS', 'KAUSWAGAN', 'ZONE 4', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'LENNETH', 'N/A', '8.497772490171107', '124.64392135211487', 'DONE', NULL),
(48, 1, 'TRIPLE C', 'SSS', 'KAUSWAGAN', 'ZONE 4', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'GENIVIVE', 'None', '8.497025728498363', '124.64557896863609', 'DONE', NULL),
(49, 1, 'BE SRP', 'SSS', 'KAUSWAGAN', 'ZONE 1', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'ARMINDA', '09068996499', '8.503822421714178', '124.64291026900362', 'DONE', NULL),
(50, 1, 'DA BARKADAS', 'SSS', 'BONBON', 'ZONE 6', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'DA BARKADAS', 'N/A', '8.507119110907261', '124.64306043128562', 'DONE', NULL),
(51, 1, 'TATA', 'SSS', 'BONBON', 'ZONE 6', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'TATA', 'N/A', '8.507190384941275', '124.64321908769386', 'DONE', NULL),
(52, 1, 'EFRENJOY', 'SSS', 'KAUSWAGAN', 'MANAOAG TOWN CENTER', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'EFREN', 'N/A', '8.502423009035782', '124.6420294426471', 'DONE', NULL),
(53, 1, 'KENT JOHN', 'SSS', 'KAUSWAGAN', 'NEAR STA. BARBARA SUBD.', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'KENT JOHN', '09678432388', '8.495435636877533', '124.63662782954832', 'DONE', NULL),
(54, 1, 'IG', 'SSS', 'BONBON', 'ZONE 6', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'IG', 'N/A', '8.509577321249916', '124.64446065231562', 'DONE', NULL),
(55, 1, 'GUIPETACIO', 'SSS', 'BONBON', 'ZONE 2', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'GUIPETACIO', 'N/A', '8.508323253443574', '124.65216030551102', 'DONE', NULL),
(56, 1, 'IVANNE JOUVE', 'SSS', 'BONBON', 'ZONE 1', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'NAGAC', '09450624738', '8.508219489457936', '124.65332200210888', 'DONE', NULL),
(57, 1, 'ROSE SAJULAN', 'SSS', 'BONBON', 'ZONE 8-PASIL ROAD', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'ROSE', 'N/A', '8.504564383832522', '124.64592075282361', 'DONE', NULL),
(58, 1, 'EMMANUEL', 'SSS', 'NHA', 'PHASE 2', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'EMMANUEL', '09275858003', '8.504232845361685', '124.6332431291106', 'DONE', NULL),
(59, 1, 'TRIPLE W', 'GRO', 'NHA', 'PHASE 2', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'SUZANNE', '09975874917', '8.50434082905539', '124.63328815560439', 'DONE', NULL),
(60, 1, 'CALLO', 'SSS', 'NHA', 'PHASE 1', '2022-12-07 19:31:36', '2022-12-07 19:31:36', 'CALLO', 'N/A', '8.499706014680832', '124.63196594663485', 'DONE', NULL),
(61, 1, 'AJ\'S', 'SSS', 'NHA', 'PHASE 1', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'JOSEPHINE', '09176298006', '8.498117992129156', '124.63121735958693', 'DONE', NULL),
(62, 1, 'BC', 'SSS', 'NHA', 'PHASE 1', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'ERLYN PAQUIT', '09050451815', '8.501258334047172', '124.63258918541104', 'DONE', NULL),
(63, 1, 'GO', 'SSS', 'NHA', 'PHASE 1', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'MARY JANE', '09168678870', '8.501746208682448', '124.63235624819706', 'DONE', NULL),
(64, 1, 'LIBERTY', 'SSS', 'DANSOLIHON', 'ZONE 2', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'LIBERTY', '09708996188', '8.472576284958233', '124.61907577828747', 'DONE', NULL),
(65, 1, 'EMPERADZ', 'GRO', 'DANSOLIHON', 'ZONE 2', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'EMPERADZ', '09672182506', '8.307517', '124.581434', 'DONE', NULL),
(66, 1, 'DANSOLIHON CONSUMER', 'GRO', 'DANSOLIHON', 'ZONE 3', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'TERESITA PANTOSA', '09619355113', '8.308096', '124.582998', 'DONE', NULL),
(67, 1, 'ANALYN', 'SSS', 'DANSOLIHON', 'ZONE 3', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'ANALYN', '09631124808', '8.397395', '124.578591', 'DONE', NULL),
(68, 1, 'J&L', 'SSS', 'MAMBUAYA', 'HIGHWAY', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'J&L', '09925387406', '8.323881', '124.595835', 'DONE', NULL),
(69, 1, 'ALTHEMMPCO', 'GRO', 'MAMBUAYA', 'NEAR HIGHWAY', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'LOVELLA CAHULOGAN', '09268837251', '8.325176', '124.596277', 'DONE', NULL),
(70, 1, 'MATTHEW', 'SSS', 'MAMBUAYA', 'HIGHWAY', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'MATTHEW', 'N/A', '8.325176', '124.596277', 'DONE', NULL),
(71, 1, 'DAUG', 'SSS', 'MAMBUAYA', 'HIGHWAY', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'GLORIA', '09195950890', '8.. 325176', '124.596277', 'DONE', NULL),
(72, 1, 'PALAPAR', 'SSS', 'MAMBUAYA', 'HIGHWAY', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'JUM PALAPAR', '09120020990', '8.325176', '124.596277', 'DONE', NULL),
(73, 1, 'RONSON', 'SSS', 'MAMBUAYA', 'ZONE 3B', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'RON', '09104893543', '8.325176', '124.596277', 'DONE', NULL),
(74, 1, 'BIDLISIW COMMUNITY', 'SSS', 'MAMBUAYA', 'HIGHWAY', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'LOVELLA', '09925389233', '8.305798', '124.591078', 'DONE', NULL),
(75, 1, 'JM&AJ', 'SSS', 'PATAG', 'NEAR BOTOYS/RD PAWNSHOP', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'JM&AJ', '09171489339', '8.489938036492141', '124.62840574300937', 'DONE', NULL),
(76, 1, 'PALER', 'SSS', 'APOVEL', 'ZONE 1', '2022-12-07 19:31:37', '2022-12-07 19:31:37', 'JAYSON', '09273311100', '8.498054073631822', '124.62023969639297', 'DONE', NULL),
(77, 1, 'LUCKY SEVEN', 'SSS', 'APOVEL', 'ZONE 1', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'ANASTACIA', '09187185241', '8.498779926522621', '124.62154478833087', 'DONE', NULL),
(78, 1, 'DEE DANE', 'SSS', 'PATAG', 'ZONE 1', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'MERRYCRIS NAVARRO', '09966607824', '8.489713422197433', '124.6287773930576', 'DONE', NULL),
(79, 1, 'LEN-LEN', 'SSS', 'BULUA', 'ZONE 10', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'LEN-LEN', '09552607390', '8.495485617276403', '124.6120368734386', 'DONE', NULL),
(80, 1, 'QUADRO M', 'SSS', 'BULUA', 'ZONE 10', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'QUADRO M', '09169517016', '8.495391562182565', '124.61183086939955', 'DONE', NULL),
(81, 1, 'JB', 'SSS', 'BULUA', 'ZONE 10', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'JB', 'N/A', '8.494987170706592', '124.61165765935377', 'DONE', NULL),
(82, 1, 'VELASCO', 'SSS', 'BULUA', 'ZONE 10', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'VELASCO', '09658206326', '8.494862280846577', '124.6116397132467', 'DONE', NULL),
(83, 1, 'CANDICE', 'SSS', 'BULUA', 'TERRY HILLS', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'CLEO REYNA', '09174881883', '8.497003806312275', '124.61482395531561', 'DONE', NULL),
(84, 1, 'SYMONZ', 'SSS', 'BULUA', 'TERRY HILLS', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'SYMONZ', '0967578388', '8.495284234585753', '124.6158399484311', 'DONE', NULL),
(85, 1, 'MALCOLMS', 'SSS', 'BULUA', 'TERRY HILLS', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'MALCOLMS', '09631109585', '8.495199692535891', '124.61590170709123', 'DONE', NULL),
(86, 1, 'MILLAMA', 'SSS', 'KAUSWAGAN', 'ZONE 2', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'MILLAMA', '09750065391', '8.503836467606357', '124.63638375529804', 'DONE', NULL),
(87, 1, 'TRES', 'SSS', 'CARMEN', 'BAMBOO LANE SUBD.', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'JERRMIAH', '09977524978', '8.462901887174894', '124.60784187728571', 'DONE', NULL),
(88, 1, 'SHANE', 'GRO', 'CARMEN', 'PUB. MKT', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'SHANE', '09350959458', '8.48066159211032', '124.63675056870838', 'DONE', NULL),
(89, 1, 'MERY', 'SSS', 'CARMEN', 'PUB. MKT', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'MARY', '09067443489', '8.47995071953207', '124.63676111501087', 'DONE', NULL),
(90, 1, 'ANN-ANN', 'SSS', 'CARMEN', 'PUB. MKT', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'ANN-ANN', '09664688848', '8.479929238084067', '124.63683619629518', 'DONE', NULL),
(91, 1, 'NIKTALS', 'SSS', 'CARMEN', 'PUB. MKT', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'NIKTALS', '09676651774', '8.479994722113885', '124.63691461254675', 'DONE', NULL),
(92, 1, 'LABOR', 'SSS', 'CARMEN', 'PUB. MKT', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'LABOR', '09456897215', '8.479868802143878', '124.63691383726771', 'DONE', NULL),
(93, 1, 'ALMIROL', 'SSS', 'CARMEN', 'PUB. MKT', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'ALMIROL', 'None', '8.479889263516066', '124.63673626989075', 'DONE', NULL),
(94, 1, 'RETAZA', 'SSS', 'CARMEN', 'PUB. MKT', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'RETAZA', '09979464826', '8.479862640625097', '124.6368030232788', 'DONE', NULL),
(95, 1, 'LADRA', 'SSS', 'CARMEN', 'PUB. MKT', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'LADRA', '09550492794', '8.479914425614222', '124.63687455396729', 'DONE', NULL),
(96, 1, 'OLITA', 'SSS', 'CARMEN', 'PUB. MKT', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'OLITA', 'N/A', '8.479719160090871', '124.63681329830568', 'DONE', NULL),
(97, 1, 'THIS & THAT', 'SSS', 'BALULANG', 'HIGHWAY', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'MARY ANN', '09176380005', '8.445846957978755', '124.63433422723574', 'DONE', NULL),
(98, 1, 'YAMUT', 'SSS', 'BALULANG', 'MANGGAHAN', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'YAMUT', '09552395838', '8.451763929788303', '124.63206574603272', 'DONE', NULL),
(99, 1, 'A&T', 'SSS', 'BALULANG', 'BLOCK 17 LOT. 1', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'A&T', '09061865078', '8.445785546604572', '124.63667699686314', 'DONE', NULL),
(100, 1, 'CL PHARMACY', 'PMS', 'BALULANG', 'BLOCK 17 LOT. 1', '2022-12-07 19:31:38', '2022-12-07 19:31:38', 'CL PHARMACY', 'None', '8.446072438872768', '124.63645481381725', 'DONE', NULL),
(101, 1, 'MEL', 'SSS', 'BALULANG', 'BLOCK 36 LOT 2', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'MEL', 'None', '8.445973780875418', '124.63656132762577', 'DONE', NULL),
(102, 1, 'GUMAPON', 'SSS', 'BALULANG', 'BLOCK 5 LOT 29', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'GUMAPON', 'None', '8.445307925867805', '124.63573695897801', 'DONE', NULL),
(103, 1, 'ABDULLAH', 'SSS', 'BALULANG', 'BLOCK 5 LOT 29', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'ABDULLAH', 'None', '8.445467725173412', '124.63575081359113', 'DONE', NULL),
(104, 1, 'ABCEDE', 'SSS', 'BALULANG', 'CABALLERO COMP.', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'ABCEDE', '09169731631', '8.440925786565586', '124.63309248919896', 'DONE', NULL),
(105, 1, 'CUGAY', 'SSS', 'BALULANG', 'ILAYA', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'CUGAY', '09261246953', '8.44241031451398', '124.63337252740064', 'DONE', NULL),
(106, 1, 'CATUBIG', 'SSS', 'BALULANG', 'GALOPE COMP.', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'CATUBIG', '09359478894', '8.443186593566795', '124.63371762752487', 'DONE', NULL),
(107, 1, 'MARITES', 'SSS', 'DANSOLIHON', 'ZONE 2', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'MARITES', '09709004398', '8.30843', '124.58329', 'DONE', NULL),
(108, 1, 'SARAH', 'SSS', 'DANSOLIHON', 'ZONE 2', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'SARAH', 'None', '8.30843', '124.58329', 'DONE', NULL),
(109, 1, 'KK AGRIVET & STORE', 'SSS', 'MAMBUAYA', 'HIGHWAY', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'KK', 'None', '8.334686', '124.597727', 'DONE', NULL),
(110, 1, 'BUGTONG', 'SSS', 'MAMBUAYA', 'HIGHWAY', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'BUGTONG', 'None', '8.334686', '124.597727', 'DONE', NULL),
(111, 1, 'NITA', 'SSS', 'MAMBUAYA', 'HIGHWAY', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'NITA', 'None', '8.341523', '123.599343', 'DONE', NULL),
(112, 1, 'BACULIO', 'SSS', 'MAMBUAYA', 'HIGHWAY', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'BACULIO', 'None', '8.34427', '124.600384', 'DONE', NULL),
(113, 1, 'KENDRA', 'SSS', 'MAMBUAYA', 'HIGHWAY', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'KENDRA', 'None', '8.34427', '124.600384', 'DONE', NULL),
(114, 1, 'ROLLY', 'SSS', 'BAYANGA', 'HIGHWAY', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'ROLLY', 'None', '8.356336', '124.601406', 'DONE', NULL),
(115, 1, 'EDADES', 'SSS', 'BAYANGA', 'HIGHWAY', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'EDADES', 'None', '8.356694', '124.601748', 'DONE', NULL),
(116, 1, 'AJRS', 'SSS', 'BAYANGA', 'HIGHWAY', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'AJRS', 'None', '8.356694', '124.601748', 'DONE', NULL),
(117, 1, 'MAHAYAHAY FARMERS', 'SSS', 'BAYANGA', 'HIGHWAY', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'MAHAYAHAY', 'None', '8.3572', '124.602596', 'DONE', NULL),
(118, 1, 'MAAM AMIE', 'SSS', 'KAUSWAGAN', 'WAREHOUSE/JULMAR', '2022-12-07 19:31:39', '2022-12-07 19:31:39', 'AMIE', '09057012305', '8.496723204230006', '124.63569355196725', 'DONE', NULL),
(119, 1, 'MARTINEZ', 'SSS', 'BAIKINGON', 'ZONE 6', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'MARTINEZ', '09058921557', '8.476347', '124.583587', 'DONE', NULL),
(120, 1, 'DABLIO', 'SSS', 'BAIKINGON', 'ZONE 6', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'DABLIO', 'None', '8.476460089938644', '124.58378491570629', 'DONE', NULL),
(121, 1, 'CAPUY', 'SSS', 'BAIKINGON', 'ZONE 5', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'CAPUY', 'None', '8.469686', '124.573442', 'DONE', NULL),
(122, 1, 'YAñEZ', 'SSS', 'BAIKINGON', 'ZONE 3', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'YAñEZ', '09652611549', '8.470229544561777', '124.5728692985428', 'DONE', NULL),
(123, 1, 'TRIPLE R', 'SSS', 'BAIKINGON', 'HIGHWAY', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'TRIPLE R', 'None', '8.464841952799619', '124.56896471229594', 'DONE', NULL),
(124, 1, 'BAVO', 'SSS', 'BAIKINGON', 'ZONE 5', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'BAVO', 'None', '8.469093065368051', '124.57320046235465', 'DONE', NULL),
(125, 1, 'EVA', 'SSS', 'BAIKINGON', 'ZONE 5', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'EVA', 'None', '8.457590328355385', '124.56662972128942', 'DONE', NULL),
(126, 1, 'ROSIE', 'SSS', 'BAIKINGON', 'ZONE 6', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'ROSIE', 'None', '8.461077254400571', '124.56721323729577', 'DONE', NULL),
(127, 1, 'NIK', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'NIK', '09171020086', '8.459958547222477', '124.58413949702032', 'DONE', NULL),
(128, 1, 'TEP-TEP', 'SSS', 'PAGATPAT', 'NEAR HIGHWAY', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'TEPTEP', 'N/A', '8.45991245639827', '124.58432619074003', 'DONE', NULL),
(129, 1, 'TRA', 'SSS', 'PAGATPAT', 'HIGHWAY', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'TRA', '09261713676', '8.467575535258577', '124.58680275680986', 'DONE', NULL),
(130, 1, 'LUCKY 4', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'WILGELYN', '09152090631', '8.486882630311923', '124.59814325381441', 'DONE', NULL),
(131, 1, 'ANNABELLE', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'ANNABELLE', '09553305293', '8.487087550614635', '124.5981120271559', 'DONE', NULL),
(132, 1, 'HOY', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'HOY', '09066747675', '8.486931587460422', '124.59788629679225', 'DONE', NULL),
(133, 1, 'SADIYA', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'SADIYA', '09163358946', '8.486882235869112', '124.59794790093915', 'DONE', NULL),
(134, 1, 'JOSEPH', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'JOSEPH', 'None', '8.486867691321272', '124.59764644513105', 'DONE', NULL),
(135, 1, 'DEN-CIO', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'DENCIO', '09063127749', '8.487345244729505', '124.5979606273514', 'DONE', NULL),
(136, 1, 'HOLLY', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:40', '2022-12-07 19:31:40', 'HOLLY', 'None', '8.486992429283571', '124.5978841720822', 'DONE', NULL),
(137, 1, 'HOLLY', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'HOLLY', 'None', '8.487282963444937', '124.59795955473862', 'DONE', NULL),
(138, 1, 'MANZANADES', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'MANZANADES', '09068229795', '8.486684379028778', '124.59763027824025', 'DONE', NULL),
(139, 1, 'KRYSTAL KORNER', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'MARISSA', '09177079886', '8.48719780357222', '124.59597055466959', 'DONE', NULL),
(140, 1, 'RAYRAY', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'RAYRAY', '09999953802', '8.48608658521081', '124.59940462854347', 'DONE', NULL),
(141, 1, 'REY BADS', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'REY', 'None', '8.48502675216204', '124.59957540324869', 'DONE', NULL),
(142, 1, 'LIM', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'LIM', '09754294976', '8.487676315016556', '124.59872862985246', 'DONE', NULL),
(143, 1, 'LEXEL', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'LEXEL', 'None', '8.488478201187844', '124.6018363036592', 'DONE', NULL),
(144, 1, 'DODOT', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'DODOT', 'None', '8.487506907313833', '124.59701980364285', 'DONE', NULL),
(145, 1, 'ASY', 'SSS', 'IPONAN', 'BLOOMINGDALE SUBD.', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'ASY', 'None', '8.488113369241791', '124.59697810420192', 'DONE', NULL),
(146, 1, 'SAMMY', 'SSS', 'IPONAN', 'VILLAMAR SUBD.', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'SAMMY', 'None', '8.494371074462336', '124.59942070698278', 'DONE', NULL),
(147, 1, 'DONWARD', 'SSS', 'IPONAN', 'HIGHWAY', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'DONWARD', 'Nonep', '8.495644620661237', '124.59581360911397', 'DONE', NULL),
(148, 1, 'ERAñA', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'HIGHWAY', 'ERANA', '124.58623485666985', 'None', 'DONE', NULL),
(149, 1, 'ALVIN', 'SSS', 'KAUSWAGAN', 'ST. IGNATIUS', '2022-12-07 19:31:41', '2022-12-07 19:31:41', 'ALVIN', 'none', '8.496673920772754', '124.63566888845209', 'DONE', NULL),
(150, 6, 'MIRGENE', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:07', '2022-12-07 19:32:07', 'ZONE 4B', 'MIRGENE', '124.5862759834979', 'N/A', 'DONE', NULL),
(151, 6, 'ACTUB', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:07', '2022-12-07 19:32:07', 'ZONE 4B', 'ACTUB', '124.58621709665448', 'N/A', 'DONE', NULL),
(152, 6, 'JG ENCARGUEZ', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:07', '2022-12-07 19:32:07', 'ZONE 4', 'CLEMENCIA', '124.5860703928584', '09204661031', 'DONE', NULL),
(153, 6, 'TAYNEE', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:07', '2022-12-07 19:32:07', 'ZONE 4B', 'TAYNEE', '124.58562405279991', '09553322796', 'DONE', NULL),
(154, 6, 'ANGELIE', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:07', '2022-12-07 19:32:07', 'YOUNGSVILLE SUBD.', 'ANGELIE', '124.57736997121066', '09974329327', 'DONE', NULL),
(155, 6, 'ELLEN', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:07', '2022-12-07 19:32:07', 'YOUNGSVILLE SUBD.', 'ELLEN', '124.57731610814491', '09267643065', 'DONE', NULL),
(156, 6, 'KABAHAYAN', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:07', '2022-12-07 19:32:07', 'YOUNGSVILLE SUBD.', 'NANETTE Z.', '124.5777421260796', '09058356015', 'DONE', NULL),
(157, 6, 'ALLISON', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:07', '2022-12-07 19:32:07', 'YOUNGSVILLE SUBD.', 'ALLISON', '124.57800772090151', '09771571483', 'DONE', NULL),
(158, 6, 'RIVERA', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:07', '2022-12-07 19:32:07', 'CITIHOMES', 'MARITES RIVERA', '124.57094221659985', '09560640733', 'DONE', NULL),
(159, 6, 'OYOG', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:07', '2022-12-07 19:32:07', 'CITIHOMES', 'OYOG', '124.57110794603271', '09351327584', 'DONE', NULL),
(160, 6, 'AJAY', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'AJAY', '124.5700302628777', 'N/A', 'DONE', NULL),
(161, 6, 'AGUILAR', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'AGUILAR', '124.57009658154925', 'N/A', 'DONE', NULL),
(162, 6, 'STOP & SHOP', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'STOP & SHOP', '124.5705055636955', 'N/A', 'DONE', NULL),
(163, 6, 'RAYEN', 'SSS', 'LUYONG', 'BONBON', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'PUB. MKT', 'RAYEN', '124.57063263541446', '09556515298', 'DONE', NULL),
(164, 6, 'CJ & MJ', 'SSS', 'MOLUGAN', 'EL SALVADOR', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'HIGHWAY', 'CJ & MJ', '124.56248175143769', '09358241039', 'DONE', NULL),
(165, 6, 'AMADEA', 'SSS', 'MOLUGAN', 'EL SALVADOR', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'HIGHWAY', 'AMADEA', '124.56189696545091', '09976696140', 'DONE', NULL),
(166, 6, 'JCEL', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'JCEL', '124.57162443113887', '09165573583', 'DONE', NULL),
(167, 6, 'BOYZU', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'BOYZU', '124.57087074977301', 'None', 'DONE', NULL),
(168, 6, 'VILLAR', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'VILLAR', '124.56968563057677', 'N/A', 'DONE', NULL),
(169, 6, 'JR', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'JR', '124.5696741963594', 'None', 'DONE', NULL),
(170, 6, 'RCC GROCERS', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'RCC GROCERS', '124.56949688267848', '09355107883', 'DONE', NULL),
(171, 6, 'CHUBZ', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'CHUBZ', '124.56979862436195', 'None', 'DONE', NULL),
(172, 6, 'ABBYS', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'ABBY', '124.56974340805263', 'None', 'DONE', NULL),
(173, 6, 'NING-NING', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'NING2', '124.57092572590781', 'None', 'DONE', NULL),
(174, 6, 'CHARLIE & VINCE', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:08', '2022-12-07 19:32:08', 'CITIHOMES', 'VINCE', '124.57081047217915', 'None', 'DONE', NULL),
(175, 6, 'DC FAMILY', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'CITIHOMES', 'DC FAMILY', '124.56962639607713', 'None', 'DONE', NULL),
(176, 6, 'GALACIO', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'CITIHOMES', 'GALACIO', '124.57082208871367', 'None', 'DONE', NULL),
(177, 6, 'PADING', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'CITIHOMES', 'PADING', '124.56848131127592', '09361333516', 'DONE', NULL),
(178, 6, 'CHE-CHE', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'CITIHOMES', 'CHE-CHE', '124.56863105855506', 'None', 'DONE', NULL),
(179, 6, 'BALAGULAN', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'CITIHOMES', 'BALAGULAN', '124.5684290574249', 'None', 'DONE', NULL),
(180, 6, 'DOñO', 'SSS', 'MALANANG', 'OPOL', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'ZONE 5', 'DOñO', '124.57900047917153', '09069276957', 'DONE', NULL),
(181, 6, 'JG MINI GROCERY', 'GRO', 'LUYONG', 'BONBON', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'PUB. MKT', 'JG', '124.57080461656811', 'None', 'DONE', NULL),
(182, 6, 'EZRAH REIGN', 'SSS', 'LUYONG', 'BONBON', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'PUB. MKT', 'EZRAH', '124.57079330189858', 'None', 'DONE', NULL),
(183, 6, 'KB', 'SSS', 'LUYONG', 'BONBON', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'PUB. MKT', 'BRYAN', '124.57109872205409', 'None', 'DONE', NULL),
(184, 6, 'CALLO', 'SSS', 'LUYONG', 'BONBON', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'ZONE 2', 'CALLO', '124.5706786804956', '09156953615', 'DONE', NULL),
(185, 6, 'ARLOPZ', 'SSS', 'LUYONG', 'BONBON', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'ZONE 2', 'ARLOPZ', '124.57079844024095', '09066747399', 'DONE', NULL),
(186, 6, 'ANGELIE', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'YOUNGSVILLE SUBD.', 'ANGELIE', '124.57731125486981', '09974329327', 'DONE', NULL),
(187, 6, 'SK', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'YOUNGSVILLE SUBD.', 'SK', '124.57792990371628', '09753923911', 'DONE', NULL),
(188, 6, 'NUNAG', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'YOUNGSVILLE SUBD.', 'NUNAG', '124.57932327431216', 'None', 'DONE', NULL),
(189, 6, 'GRACE ANN', 'SSS', 'IGPIT', 'OPOL', '2022-12-07 19:32:09', '2022-12-07 19:32:09', 'YOUNGSVILLE SUBD.', 'GRACE', '124.57808637060069', 'None', 'DONE', NULL),
(190, 5, 'SAMPLE', 'SSS', '12', '12', '2023-01-10 03:10:27', '2023-01-10 03:10:27', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_inventories`
--

CREATE TABLE `van_selling_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principal` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measurement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` double(15,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `van_selling_inventories`
--

INSERT INTO `van_selling_inventories` (`id`, `sku_code`, `description`, `principal`, `sku_type`, `unit_of_measurement`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, '1018', 'desc1', 'CIFPI', 'CASE', 'CASE', 10.0000, '2022-10-31 02:25:13', '2022-11-12 13:38:19'),
(4, '7604', 'ALL NATURAL SPARKLING CUCUMBER VALUE PACK BY 4\'S X 6', 'DOLE', 'BUTAL', 'PACK', 97.3700, '2022-11-02 12:25:39', '2022-11-02 12:25:39'),
(5, '7605', 'ALL NATURAL SPARKLING PASSION FRUIT VALUE PACK BY 4\'S X 6', 'DOLE', 'BUTAL', 'PACK', 97.3700, '2022-11-02 12:25:39', '2022-11-02 12:25:39'),
(6, '7606', 'ALL NATURAL SPARKLING LEMON LIME VALUE PACK BY 4\'S X 6', 'DOLE', 'BUTAL', 'PACK', 97.3700, '2022-11-02 12:25:39', '2022-11-02 12:25:39'),
(7, '7607', 'ALL NATURAL SPARKLING STRAWBERRY VALUE PACK BY 4\'S X 6', 'DOLE', 'BUTAL', 'PACK', 97.3700, '2022-11-02 12:25:39', '2022-11-02 12:25:39'),
(8, '142', 'PINEAPPLE SLICES 227G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 31.6100, '2022-11-02 12:25:39', '2022-11-02 12:25:39'),
(9, '1234', 'PINEAPPLE SLICES 432G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 62.4400, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(10, '1253', 'PINEAPPLE SLICES 560G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 71.1100, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(11, '1274', 'PINEAPPLE SLICES 822G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 101.3700, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(12, '205', 'PINEAPPLE SLICES 3KG X 6 CANS', 'DOLE', 'BUTAL', 'CAN', 313.9500, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(13, '1275', 'PINEAPPLE CHUNKS 200G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 49.4000, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(14, '1402', 'PINEAPPLE CHUNKS 227G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 32.3200, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(15, '1766', 'PINEAPPLE CHUNKS 432G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 57.5200, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(16, '1162', 'PINEAPPLE CHUNKS 560G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 67.0000, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(17, '1884', 'PINEAPPLE CHUNKS 822G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 91.0400, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(18, '460', 'PINEAPPLE CHUNKS 3KG X 6 CANS', 'DOLE', 'BUTAL', 'CAN', 302.1600, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(19, '508', 'PINEAPPLE TIDBITS 115G X 48 CANS', 'DOLE', 'BUTAL', 'CAN', 14.9600, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(20, '5517', 'PINEAPPLE TIDBITS 227G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 32.6100, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(21, '5513', 'PINEAPPLE TIDBITS 432G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 57.0100, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(22, '5515', 'PINEAPPLE TIDBITS 560G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 64.2500, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(23, '5512', 'PINEAPPLE TIDBITS 822G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 92.9000, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(24, '535', 'PINEAPPLE TIDBITS 3KG X 6 CANS', 'DOLE', 'BUTAL', 'CAN', 311.2700, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(25, '611', 'PINEAPPLE CRUSHED 234G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 29.3500, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(26, '616', 'PINEAPPLE CRUSHED 439G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 51.9000, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(27, '603', 'PINEAPPLE CRUSHED 567G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 64.3600, '2022-11-02 12:25:40', '2022-11-02 12:25:40'),
(28, '625', 'PINEAPPLE CRUSHED 3.17KG X 6 CANS', 'DOLE', 'BUTAL', 'CAN', 323.2600, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(29, '19014', 'TROPICAL FRUIT COCKTAIL 432G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 62.5800, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(30, '9007', 'TROPICAL FRUIT COCKTAIL 822G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 83.6400, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(31, '9144', 'TROPICAL FRUIT COCKTAIL 3KG X 6 CANS', 'DOLE', 'BUTAL', 'CAN', 288.1000, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(32, '58148', 'SEASONS FRUIT MIX 432G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 55.5100, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(33, '59189', 'SEASONS FRUIT MIX 822G X 24 CANS', 'DOLE', 'BUTAL', 'CAN', 79.5200, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(34, '56424', 'SEASONS FRUIT MIX 3KG X 6 CANS', 'DOLE', 'BUTAL', 'CAN', 247.5600, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(35, '7512', '100% PINEAPPLE JUICE 190ML X 24', 'DOLE', 'BUTAL', 'CAN', 22.8500, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(36, '7513', '100% PINEAPPLE JUICE 240ML X 24', 'DOLE', 'BUTAL', 'CAN', 27.5700, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(37, '822', '100% PINEAPPLE JUICE 532ML X 24', 'DOLE', 'BUTAL', 'CAN', 43.5000, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(38, '816', '100% PINEAPPLE JUICE 1.36L X 12', 'DOLE', 'BUTAL', 'CAN', 98.4500, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(39, '858', '100% PINEAPPLE JUICE 2.90L X 6', 'DOLE', 'BUTAL', 'CAN', 151.7500, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(40, '7519', 'PINEAPPLE ORANGE 190ML X 24', 'DOLE', 'BUTAL', 'CAN', 23.4500, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(41, '7534', 'PINEAPPLE ORANGE 240ML X 24', 'DOLE', 'BUTAL', 'CAN', 26.3500, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(42, '7545', 'PINEAPPLE ORANGE 1.36L X 12', 'DOLE', 'BUTAL', 'CAN', 89.0400, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(43, '7548', 'PINEAPPLE ORANGE 2.90L X 6', 'DOLE', 'BUTAL', 'CAN', 152.4200, '2022-11-02 12:25:41', '2022-11-02 12:25:41'),
(44, '7546', 'FOUR SEASONS DRINK 190ML X 24', 'DOLE', 'BUTAL', 'CAN', 23.4500, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(45, '7566', 'FOUR SEASONS DRINK 240ML X 24', 'DOLE', 'BUTAL', 'CAN', 27.6700, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(46, '7509', 'FOUR SEASONS DRINK 1.36L X 12', 'DOLE', 'BUTAL', 'CAN', 89.0400, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(47, '7547', 'SWEETENED PINEAPPLE JUICE 240ML X 24', 'DOLE', 'BUTAL', 'CAN', 27.6700, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(48, '7568', 'SWEETENED PINEAPPLE JUICE 1.36L X 12', 'DOLE', 'BUTAL', 'CAN', 69.2100, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(49, '7513P', '100% PINEAPPLE JUICE 240ML X 5+1 X 4 PACKS', 'DOLE', 'BUTAL', 'PACK', 131.2500, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(50, '7534P', 'PINEAPPLE ORANGE DRINK 240ML X 5+1 X 4 PACKS', 'DOLE', 'BUTAL', 'PACK', 131.7800, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(51, '7588', 'SEASONS MANGO JUICE DRINK 240ML X 24', 'DOLE', 'BUTAL', 'CAN', 28.1500, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(52, '55111', 'SEASONS PINEAPPLE BANANA JUICE 200ML X 12', 'DOLE', 'BUTAL', 'CAN', 15.0000, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(53, '55112', 'SEASONS PINEAPPLE ORANGE JUICE 200ML X 12', 'DOLE', 'BUTAL', 'CAN', 15.0000, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(54, '55113', 'SEASONS PINEAPPLE MANGO JUICE 200ML X 12', 'DOLE', 'BUTAL', 'CAN', 15.0000, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(55, '55114', 'SEASONS PINEAPPLE COCONUT JUICE 200ML X 12', 'DOLE', 'BUTAL', 'CAN', 15.0000, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(56, '55101', 'SEASONS PINEAPPLE BANANA JUICE 1L X 12', 'DOLE', 'BUTAL', 'CAN', 74.5200, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(57, '55102', 'SEASONS PINEAPPLE ORANGE JUICE 1L X 12', 'DOLE', 'BUTAL', 'CAN', 74.5200, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(58, '55103', 'SEASONS PINEAPPLE MANGO JUICE 1L X 12', 'DOLE', 'BUTAL', 'CAN', 74.5200, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(59, '55104', 'SEASONS PINEAPPLE COCONUT JUICE 1L X 12', 'DOLE', 'BUTAL', 'CAN', 74.5200, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(60, '7600', 'DOLE 100% ALL NATURAL SPARKLING CUCUMBER 240MLX24', 'DOLE', 'BUTAL', 'CAN', 26.7300, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(61, '7601', 'DOLE 100% ALL NATURAL SPARKLING PASSION FRUIT 240MLX24', 'DOLE', 'BUTAL', 'CAN', 26.7300, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(62, '7602', 'DOLE 100% ALL NATURAL SPARKLING LEMON LIME 240MLX24', 'DOLE', 'BUTAL', 'CAN', 26.7300, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(63, '7603', 'DOLE 100% ALL NATURAL SPARKLING STRAWBERRY 240MLX24', 'DOLE', 'BUTAL', 'CAN', 26.7300, '2022-11-02 12:25:42', '2022-11-02 12:25:42'),
(64, '4179', 'DOLE SLICED PEACHES IN LS 665G X 8', 'DOLE', 'BUTAL', 'CAN', 155.6600, '2022-11-02 12:25:43', '2022-11-02 12:25:43'),
(65, '4178', 'DOLE MANDARIN ORANGE IN LS 665G X 8', 'DOLE', 'BUTAL', 'CAN', 155.6600, '2022-11-02 12:25:43', '2022-11-02 12:25:43'),
(66, '5814867', 'SEASONS FRUIT MIX 432G X 12 ANGEL EVAP SAVE P5', 'DOLE', 'BUTAL', 'CAN', 68.4000, '2022-11-02 12:25:43', '2022-11-02 12:25:43'),
(67, '915', 'DOLE 100% P/A JUICE 177ML X24', 'DOLE', 'BUTAL', 'BUTAL', 19.8000, '2022-11-02 12:25:43', '2022-11-02 12:25:43'),
(68, '78516', 'DOLE 100% PINEAPPLE JUICE 240ML X 6 BUY 4 SAVE P10', 'DOLE', 'BUTAL', 'BUTAL', 99.7500, '2022-11-02 12:25:43', '2022-11-02 12:25:43'),
(69, 'code2', 'desc2', 'CIFPI', 'CASE', 'CASE', 20.0000, '2022-11-12 13:38:19', '2022-11-12 13:38:19'),
(70, 'code3', 'desc3', 'CIFPI', 'CASE', 'CASE', 30.0000, '2022-11-12 13:38:19', '2022-11-12 13:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_os_cart_details`
--

CREATE TABLE `van_selling_os_cart_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `van_selling_inventory_id` bigint(20) DEFAULT NULL,
  `sku_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `principal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` double(15,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_os_datas`
--

CREATE TABLE `van_selling_os_datas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `van_selling_inventory_id` bigint(20) NOT NULL,
  `sku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `served_quantity` int(11) DEFAULT NULL,
  `served_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vs_customer_id` int(11) DEFAULT NULL,
  `temp_quantity` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` double(15,4) DEFAULT NULL,
  `served_unit_price` double(15,4) DEFAULT NULL,
  `temp_unit_price` double(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `van_selling_os_datas`
--

INSERT INTO `van_selling_os_datas` (`id`, `store_name`, `van_selling_inventory_id`, `sku_code`, `description`, `quantity`, `created_at`, `updated_at`, `principal`, `status`, `date`, `served_quantity`, `served_date`, `vs_customer_id`, `temp_quantity`, `code`, `unit_price`, `served_unit_price`, `temp_unit_price`) VALUES
(36, 'CUSTOMER 1', 69, 'code2', 'desc2', 10, '2022-11-12 13:55:53', '2022-11-12 14:23:35', 'CIFPI', NULL, '2022-11-12', 10, '2022-11-12', NULL, 10, '636fa5e99b6b9', 20.0000, 108.5300, 108.5300),
(37, 'CUSTOMER 1', 70, 'code3', 'desc3', 10, '2022-11-12 13:55:53', '2022-11-12 14:23:35', 'CIFPI', NULL, '2022-11-12', 10, '2022-11-12', NULL, 10, '636fa5e99b6b9', 30.0000, 108.5300, 108.5300);

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_price_updates`
--

CREATE TABLE `van_selling_price_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `van_selling_price_update_export_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_price_update_details`
--

CREATE TABLE `van_selling_price_update_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vs_price_update_id` bigint(20) UNSIGNED NOT NULL,
  `sku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_price` double(15,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_transactions`
--

CREATE TABLE `van_selling_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcm_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bo_amount` double(15,4) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `van_selling_transactions`
--

INSERT INTO `van_selling_transactions` (`id`, `delivery_receipt`, `store_name`, `store_type`, `full_address`, `total_amount`, `status`, `pcm_number`, `bo_amount`, `date`, `created_at`, `updated_at`, `remarks`) VALUES
(1, 'VS-1-2022-10-0001', 'CUSTOMER 1', 'STORE TYPE', '4 - SOUTH BUKIDNON BARANGAY ADDRESS', '226.33', 'PAID', 'NONE', 0.0000, '2022-10-25', '2022-10-25 12:27:15', '2022-10-25 12:27:15', '2022-10-25 | 08:27:09 pm'),
(2, 'VS-1-2022-10-0002', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '1443.07', 'PAID', 'NONE', 0.0000, '2022-10-31', '2022-10-31 05:48:29', '2022-10-31 05:48:29', '2022-10-31 | 01:48:23 pm'),
(3, 'VS-1-2022-10-0003', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '179.03', 'PAID', 'NONE', 0.0000, '2022-10-31', '2022-10-31 05:59:42', '2022-10-31 05:59:42', '2022-10-31 | 01:59:37 pm'),
(4, 'VS-1-2022-10-0004', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '179.03', 'PAID', 'NONE', 0.0000, '2022-10-31', '2022-10-31 06:01:21', '2022-10-31 06:01:21', '2022-10-31 | 02:01:16 pm'),
(5, 'VS-1-2022-10-0005', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '58.43', 'PAID', 'NONE', 0.0000, '2022-10-31', '2022-10-31 06:02:21', '2022-10-31 06:02:21', '2022-10-31 | 02:02:15 pm'),
(6, 'VS-1-2022-10-0006', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '88.58', 'PAID', 'NONE', 0.0000, '2022-10-31', '2022-10-31 06:05:13', '2022-10-31 06:05:13', '2022-10-31 | 02:05:08 pm'),
(7, 'VS-1-2022-10-0007', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '179.03', 'PAID', 'NONE', 0.0000, '2022-10-31', '2022-10-31 06:07:42', '2022-10-31 06:07:42', '2022-10-31 | 02:07:37 pm'),
(8, 'VS-1-2022-10-0008', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '179.03', 'PAID', 'NONE', 0.0000, '2022-10-31', '2022-10-31 06:28:55', '2022-10-31 06:28:55', '2022-10-31 | 02:28:50 pm'),
(9, 'VS-1-2022-10-0009', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '88.58', 'PAID', 'NONE', 0.0000, '2022-10-31', '2022-10-31 06:30:52', '2022-10-31 06:30:52', '2022-10-31 | 02:30:47 pm'),
(10, 'VS-1-2022-11-0001', 'WEDNESDAY SORE', 'SSS', '1 - CAGAYAN DE ORO CITY SADASD ASDASD', '58.43', 'PAID', 'NONE', 0.0000, '2022-11-05', '2022-11-05 01:31:21', '2022-11-05 01:31:21', '2022-11-05 | 09:31:17 am'),
(11, 'VS-1-2022-11-0002', 'STORE 3', 'SSS', '1 - CAGAYAN DE ORO CITY BARANGAY ZONE', '131.25', 'PAID', 'NONE', 0.0000, '2022-11-05', '2022-11-05 02:22:53', '2022-11-05 02:22:53', '2022-11-05 | 10:22:45 am'),
(12, 'VS-1-2022-11-0003', 'WEDNESDAY SORE', 'SSS', 'CAGAYAN DE ORO CITY SADASD ASDASD', '58.43', 'PAID', 'NONE', 0.0000, '2022-11-06', '2022-11-06 09:48:54', '2022-11-06 09:48:54', '2022-11-06 | 05:48:49 pm'),
(13, 'VS-1-2022-11-0004', 'WEDNESDAY SORE', 'SSS', 'CAGAYAN DE ORO CITY SADASD ASDASD', '58.43', 'PAID', 'NONE', 0.0000, '2022-11-06', '2022-11-06 09:50:11', '2022-11-06 09:50:11', '2022-11-06 | 05:50:04 pm'),
(14, 'VS-1-2022-11-0005', 'WEDNESDAY SORE', 'SSS', 'CAGAYAN DE ORO CITY SADASD ASDASD', '58.43', 'PAID', 'NONE', 0.0000, '2022-11-06', '2022-11-06 09:57:53', '2022-11-06 09:57:53', '2022-11-06 | 05:57:51 pm'),
(15, 'VS-1-2022-11-0006', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '354.16', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 03:25:15', '2022-11-12 03:25:15', '2022-11-12 | 11:25:10 am'),
(16, 'VS-1-2022-11-0007', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '2307.70', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 03:44:52', '2022-11-12 03:44:52', '2022-11-12 | 11:44:43 am'),
(17, 'VS-1-2022-11-0008', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '2307.70', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 03:45:54', '2022-11-12 03:45:54', '2022-11-12 | 11:45:45 am'),
(18, 'VS-1-2022-11-0009', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '131.25', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 03:48:11', '2022-11-12 03:48:11', '2022-11-12 | 11:48:03 am'),
(19, 'VS-1-2022-11-0010', 'WEDNESDAY SORE', 'SSS', 'CAGAYAN DE ORO CITY SADASD ASDASD', '131.25', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 03:49:30', '2022-11-12 03:49:30', '2022-11-12 | 11:49:21 am'),
(20, 'VS-1-2022-11-0011', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '88.58', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 03:52:01', '2022-11-12 03:52:01', '2022-11-12 | 11:51:56 am'),
(21, 'VS-1-2022-11-0012', 'CUSTOMER 1', 'STORE TYPE', 'SOUTH BUKIDNON BARANGAY ADDRESS', '2307.70', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 04:08:14', '2022-11-12 04:08:14', '2022-11-12 | 12:08:07 pm'),
(22, 'VS-1-2022-11-0013', 'VAN SELLING HELL', 'SSS', '1 - CAGAYAN DE ORO CITY BARNAGAY ZONE', '656.25', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 04:09:42', '2022-11-12 04:09:42', '2022-11-12 | 12:09:27 pm'),
(23, 'VS-1-2022-11-0014', 'CUSTOMER 1', 'STORE TYPE', '4 - SOUTH BUKIDNON BARANGAY ADDRESS', '131.25', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 05:47:27', '2022-11-12 05:47:27', '2022-11-12 | 01:47:15 pm'),
(24, 'VS-1-2022-11-0015', 'CUSTOMER 1', 'STORE TYPE', '4 - SOUTH BUKIDNON BARANGAY ADDRESS', '30.15', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 13:39:35', '2022-11-12 13:39:35', '2022-11-12 | 09:39:30 pm'),
(25, 'VS-1-2022-11-0016', 'CUSTOMER 1', 'STORE TYPE', '4 - SOUTH BUKIDNON BARANGAY ADDRESS', '2200.75', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 13:40:37', '2022-11-12 13:40:37', '2022-11-12 | 09:40:32 pm'),
(26, 'VS-1-2022-11-0017', 'CUSTOMER 1', 'STORE TYPE', '4 - SOUTH BUKIDNON BARANGAY ADDRESS', '131.25', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 13:54:04', '2022-11-12 13:54:04', '2022-11-12 | 09:52:20 pm'),
(27, 'VS-1-2022-11-0018', 'CUSTOMER 1', 'STORE TYPE', '4 - SOUTH BUKIDNON BARANGAY ADDRESS', '30.15', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 13:55:53', '2022-11-12 13:55:53', '2022-11-12 | 09:55:49 pm'),
(28, 'VS-1-2022-11-0019', 'CUSTOMER 1', 'STORE TYPE', '4 - SOUTH BUKIDNON BARANGAY ADDRESS', '2259.18', 'PAID', 'NONE', 0.0000, '2022-11-12', '2022-11-12 14:23:34', '2022-11-12 14:23:34', '2022-11-12 | 10:23:29 pm'),
(29, 'VS-1-2022-11-0020', 'SMEPL', 'SSS', '1 - CAGAYAN DE ORO CITY BARANGAY SITIO', '58.43', 'PAID', 'NONE', 0.0000, '2022-11-15', '2022-11-15 11:12:35', '2022-11-15 11:12:35', '2022-11-15 | 07:12:31 pm'),
(30, 'VS-1-2022-11-0021', 'CUSTOMER 1', 'STORE TYPE', '4 - SOUTH BUKIDNON BARANGAY ADDRESS', '137.10', 'PAID', 'NONE', 0.0000, '2022-11-16', '2022-11-16 11:22:59', '2022-11-16 11:22:59', '2022-11-16 | 07:22:55 pm');

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_transaction_cart_details`
--

CREATE TABLE `van_selling_transaction_cart_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measurement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `butal_equivalent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_transaction_cms`
--

CREATE TABLE `van_selling_transaction_cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `van_selling_trans_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_transaction_cm_details`
--

CREATE TABLE `van_selling_transaction_cm_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vs_trans_cm_id` bigint(20) UNSIGNED NOT NULL,
  `sku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dr_quantity` int(11) NOT NULL,
  `rgs_quantity` int(11) NOT NULL,
  `bo_quantity` int(11) NOT NULL,
  `unit_price` double(15,4) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_transaction_details`
--

CREATE TABLE `van_selling_transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `van_selling_trans_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `van_selling_transaction_details`
--

INSERT INTO `van_selling_transaction_details` (`id`, `sku_code`, `description`, `quantity`, `principal`, `price`, `amount`, `van_selling_trans_id`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, '1212SW2', 'SUPER HEAVY DUTY AAA BLACK IN SHRINK WRAP', 1, 'EPI', '45.7500', '45.7500', 1, '', '', '2022-10-25 12:27:15', '2022-10-25 12:27:15'),
(2, '1215SW2', 'SUPER HEAVY DUTY AA BLACK IN SHRINK WRAP', 1, 'EPI', '30.7500', '30.7500', 1, '', '', '2022-10-25 12:27:15', '2022-10-25 12:27:15'),
(3, '1222BP1', 'SUPER HEAVY DUTY 9V BLACK IN BLISTER PACK', 1, 'EPI', '75.5000', '75.5000', 1, '', '', '2022-10-25 12:27:15', '2022-10-25 12:27:15'),
(4, '1250SW2N', 'SUPER HEAY DUTY D SIZE BLACK IN SHRINK WRAP', 1, 'EPI', '56.7500', '56.7500', 1, '', '', '2022-10-25 12:27:15', '2022-10-25 12:27:15'),
(5, '912SW4', 'GENERAL PURPOSE AAA BLUE IN SHRINK WRAP', 1, 'EPI', '17.5800', '17.5800', 1, '', '', '2022-10-25 12:27:15', '2022-10-25 12:27:15'),
(6, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 2, '', '', '2022-10-31 05:48:29', '2022-10-31 05:48:29'),
(7, '971', 'CHAMPI CHOCOLATE CHEWY', 2, 'CIFPI', '30.1500', '60.3000', 2, '', '', '2022-10-31 05:48:29', '2022-10-31 05:48:29'),
(8, '809', 'CHOCO JOY', 3, 'CIFPI', '30.1500', '90.4500', 2, '', '', '2022-10-31 05:48:30', '2022-10-31 05:48:30'),
(9, '685', 'CHOCQUIK COOKIE', 4, 'CIFPI', '48.5200', '194.0800', 2, '', '', '2022-10-31 05:48:30', '2022-10-31 05:48:30'),
(10, '7513P', '100% PINEAPPLE JUICE 240ML X 5+1 X 4 PACKS', 1, 'DOLE', '131.2500', '131.2500', 2, '', '', '2022-10-31 05:48:30', '2022-10-31 05:48:30'),
(11, '7534P', 'PINEAPPLE ORANGE DRINK 240ML X 5+1 X 4 PACKS', 2, 'DOLE', '131.7800', '263.5600', 2, '', '', '2022-10-31 05:48:30', '2022-10-31 05:48:30'),
(12, '56424', 'SEASONS FRUIT MIX 3KG X 6 CANS', 3, 'DOLE', '225.0500', '675.1500', 2, '', '', '2022-10-31 05:48:30', '2022-10-31 05:48:30'),
(13, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 3, '', '', '2022-10-31 05:59:43', '2022-10-31 05:59:43'),
(14, '971', 'CHAMPI CHOCOLATE CHEWY', 2, 'CIFPI', '30.1500', '60.3000', 3, '', '', '2022-10-31 05:59:43', '2022-10-31 05:59:43'),
(15, '809', 'CHOCO JOY', 3, 'CIFPI', '30.1500', '90.4500', 3, '', '', '2022-10-31 05:59:43', '2022-10-31 05:59:43'),
(16, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 4, '', '', '2022-10-31 06:01:22', '2022-10-31 06:01:22'),
(17, '971', 'CHAMPI CHOCOLATE CHEWY', 2, 'CIFPI', '30.1500', '60.3000', 4, '', '', '2022-10-31 06:01:22', '2022-10-31 06:01:22'),
(18, '809', 'CHOCO JOY', 3, 'CIFPI', '30.1500', '90.4500', 4, '', '', '2022-10-31 06:01:22', '2022-10-31 06:01:22'),
(19, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 5, '', '', '2022-10-31 06:02:21', '2022-10-31 06:02:21'),
(20, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 5, '', '', '2022-10-31 06:02:21', '2022-10-31 06:02:21'),
(21, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 6, '', '', '2022-10-31 06:05:13', '2022-10-31 06:05:13'),
(22, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 6, '', '', '2022-10-31 06:05:13', '2022-10-31 06:05:13'),
(23, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 6, '', '', '2022-10-31 06:05:13', '2022-10-31 06:05:13'),
(24, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 7, '', '', '2022-10-31 06:07:42', '2022-10-31 06:07:42'),
(25, '971', 'CHAMPI CHOCOLATE CHEWY', 2, 'CIFPI', '30.1500', '60.3000', 7, '', '', '2022-10-31 06:07:42', '2022-10-31 06:07:42'),
(26, '809', 'CHOCO JOY', 3, 'CIFPI', '30.1500', '90.4500', 7, '', '', '2022-10-31 06:07:42', '2022-10-31 06:07:42'),
(27, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 8, '', '', '2022-10-31 06:28:56', '2022-10-31 06:28:56'),
(28, '971', 'CHAMPI CHOCOLATE CHEWY', 2, 'CIFPI', '30.1500', '60.3000', 8, '', '', '2022-10-31 06:28:56', '2022-10-31 06:28:56'),
(29, '809', 'CHOCO JOY', 3, 'CIFPI', '30.1500', '90.4500', 8, '', '', '2022-10-31 06:28:56', '2022-10-31 06:28:56'),
(30, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 9, '', '', '2022-10-31 06:30:52', '2022-10-31 06:30:52'),
(31, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 9, '', '', '2022-10-31 06:30:52', '2022-10-31 06:30:52'),
(32, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 9, '', '', '2022-10-31 06:30:52', '2022-10-31 06:30:52'),
(33, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 10, '', '', '2022-11-05 01:31:21', '2022-11-05 01:31:21'),
(34, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 10, '', '', '2022-11-05 01:31:22', '2022-11-05 01:31:22'),
(35, '7513P', '100% PINEAPPLE JUICE 240ML X 5+1 X 4 PACKS', 1, 'DOLE', '131.2500', '131.2500', 11, '', '', '2022-11-05 02:22:53', '2022-11-05 02:22:53'),
(36, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 12, '', '', '2022-11-06 09:48:54', '2022-11-06 09:48:54'),
(37, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 12, '', '', '2022-11-06 09:48:54', '2022-11-06 09:48:54'),
(38, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 13, '', '', '2022-11-06 09:50:11', '2022-11-06 09:50:11'),
(39, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 13, '', '', '2022-11-06 09:50:11', '2022-11-06 09:50:11'),
(40, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 14, '', '', '2022-11-06 09:57:54', '2022-11-06 09:57:54'),
(41, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 14, '', '', '2022-11-06 09:57:54', '2022-11-06 09:57:54'),
(42, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 15, '', '', '2022-11-12 03:25:15', '2022-11-12 03:25:15'),
(43, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 15, '', '', '2022-11-12 03:25:15', '2022-11-12 03:25:15'),
(44, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 15, '', '', '2022-11-12 03:25:15', '2022-11-12 03:25:15'),
(45, '685', 'CHOCQUIK COOKIE', 1, 'CIFPI', '48.5200', '48.5200', 15, '', '', '2022-11-12 03:25:15', '2022-11-12 03:25:15'),
(46, 'code2', 'desc2', 1, 'CIFPI', '108.5300', '108.5300', 15, '', '', '2022-11-12 03:25:15', '2022-11-12 03:25:15'),
(47, 'code3', 'desc3', 1, 'CIFPI', '108.5300', '108.5300', 15, '', '', '2022-11-12 03:25:16', '2022-11-12 03:25:16'),
(48, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 16, '', '', '2022-11-12 03:44:52', '2022-11-12 03:44:52'),
(49, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 16, '', '', '2022-11-12 03:44:52', '2022-11-12 03:44:52'),
(50, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 16, '', '', '2022-11-12 03:44:52', '2022-11-12 03:44:52'),
(51, '685', 'CHOCQUIK COOKIE', 1, 'CIFPI', '48.5200', '48.5200', 16, '', '', '2022-11-12 03:44:52', '2022-11-12 03:44:52'),
(52, 'code2', 'desc2', 10, 'CIFPI', '108.5300', '1085.3000', 16, '', '', '2022-11-12 03:44:52', '2022-11-12 03:44:52'),
(53, 'code3', 'desc3', 10, 'CIFPI', '108.5300', '1085.3000', 16, '', '', '2022-11-12 03:44:53', '2022-11-12 03:44:53'),
(54, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 17, '', '', '2022-11-12 03:45:55', '2022-11-12 03:45:55'),
(55, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 17, '', '', '2022-11-12 03:45:55', '2022-11-12 03:45:55'),
(56, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 17, '', '', '2022-11-12 03:45:55', '2022-11-12 03:45:55'),
(57, '685', 'CHOCQUIK COOKIE', 1, 'CIFPI', '48.5200', '48.5200', 17, '', '', '2022-11-12 03:45:55', '2022-11-12 03:45:55'),
(58, 'code2', 'desc2', 10, 'CIFPI', '108.5300', '1085.3000', 17, '', '', '2022-11-12 03:45:55', '2022-11-12 03:45:55'),
(59, 'code3', 'desc3', 10, 'CIFPI', '108.5300', '1085.3000', 17, '', '', '2022-11-12 03:45:55', '2022-11-12 03:45:55'),
(60, '7513P', '100% PINEAPPLE JUICE 240ML X 5+1 X 4 PACKS', 1, 'DOLE', '131.2500', '131.2500', 18, '', '', '2022-11-12 03:48:11', '2022-11-12 03:48:11'),
(61, '7513P', '100% PINEAPPLE JUICE 240ML X 5+1 X 4 PACKS', 1, 'DOLE', '131.2500', '131.2500', 19, '', '', '2022-11-12 03:49:30', '2022-11-12 03:49:30'),
(62, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 20, '', '', '2022-11-12 03:52:01', '2022-11-12 03:52:01'),
(63, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 20, '', '', '2022-11-12 03:52:01', '2022-11-12 03:52:01'),
(64, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 20, '', '', '2022-11-12 03:52:01', '2022-11-12 03:52:01'),
(65, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 21, '', '', '2022-11-12 04:08:14', '2022-11-12 04:08:14'),
(66, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 21, '', '', '2022-11-12 04:08:15', '2022-11-12 04:08:15'),
(67, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 21, '', '', '2022-11-12 04:08:15', '2022-11-12 04:08:15'),
(68, '685', 'CHOCQUIK COOKIE', 1, 'CIFPI', '48.5200', '48.5200', 21, '', '', '2022-11-12 04:08:15', '2022-11-12 04:08:15'),
(69, 'code2', 'desc2', 10, 'CIFPI', '108.5300', '1085.3000', 21, '', '', '2022-11-12 04:08:15', '2022-11-12 04:08:15'),
(70, 'code3', 'desc3', 10, 'CIFPI', '108.5300', '1085.3000', 21, '', '', '2022-11-12 04:08:15', '2022-11-12 04:08:15'),
(71, '7513P', '100% PINEAPPLE JUICE 240ML X 5+1 X 4 PACKS', 5, 'DOLE', '131.2500', '656.2500', 22, '', '', '2022-11-12 04:09:42', '2022-11-12 04:09:42'),
(72, '7513P', '100% PINEAPPLE JUICE 240ML X 5+1 X 4 PACKS', 1, 'DOLE', '131.2500', '131.2500', 23, '', '', '2022-11-12 05:47:27', '2022-11-12 05:47:27'),
(73, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 24, '', '', '2022-11-12 13:39:35', '2022-11-12 13:39:35'),
(74, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 25, '', '', '2022-11-12 13:40:37', '2022-11-12 13:40:37'),
(75, 'code2', 'desc2', 10, 'CIFPI', '108.5300', '1085.3000', 25, '', '', '2022-11-12 13:40:37', '2022-11-12 13:40:37'),
(76, 'code3', 'desc3', 10, 'CIFPI', '108.5300', '1085.3000', 25, '', '', '2022-11-12 13:40:37', '2022-11-12 13:40:37'),
(77, '7513P', '100% PINEAPPLE JUICE 240ML X 5+1 X 4 PACKS', 1, 'DOLE', '131.2500', '131.2500', 26, '', '', '2022-11-12 13:54:04', '2022-11-12 13:54:04'),
(78, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 27, '', '', '2022-11-12 13:55:53', '2022-11-12 13:55:53'),
(79, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 28, '', '', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(80, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 28, '', '', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(81, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 28, '', '', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(82, 'code2', 'desc2', 10, 'CIFPI', '108.5300', '1085.3000', 28, '', '', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(83, 'code3', 'desc3', 10, 'CIFPI', '108.5300', '1085.3000', 28, '', '', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(84, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 29, '', '', '2022-11-15 11:12:35', '2022-11-15 11:12:35'),
(85, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 29, '', '', '2022-11-15 11:12:35', '2022-11-15 11:12:35'),
(86, '837', 'BUTTERKIST', 1, 'CIFPI', '28.2800', '28.2800', 30, '', '', '2022-11-16 11:23:00', '2022-11-16 11:23:00'),
(87, '971', 'CHAMPI CHOCOLATE CHEWY', 1, 'CIFPI', '30.1500', '30.1500', 30, '', '', '2022-11-16 11:23:00', '2022-11-16 11:23:00'),
(88, '809', 'CHOCO JOY', 1, 'CIFPI', '30.1500', '30.1500', 30, '', '', '2022-11-16 11:23:00', '2022-11-16 11:23:00'),
(89, '685', 'CHOCQUIK COOKIE', 1, 'CIFPI', '48.5200', '48.5200', 30, '', '', '2022-11-16 11:23:00', '2022-11-16 11:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_uploads`
--

CREATE TABLE `van_selling_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `van_selling_export_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `van_selling_uploads`
--

INSERT INTO `van_selling_uploads` (`id`, `customer_id`, `van_selling_export_code`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 'VAN SELLING ADMIN EXPORT DATA-2022-03-23144933', '2022-10-25', '2022-10-25 11:30:03', '2022-10-25 11:30:03'),
(2, 1, 'VAN SELLING ADMIN EXPORT DATA-2022-03-23144933', '2022-11-12', '2022-11-12 02:33:57', '2022-11-12 02:33:57'),
(3, 1, 'VAN SELLING ADMIN EXPORT DATA-2022-03-23144933', '2022-11-12', '2022-11-12 03:31:17', '2022-11-12 03:31:17'),
(4, 1, 'VAN SELLING ADMIN EXPORT DATA-2022-03-23144933', '2022-11-12', '2022-11-12 03:50:51', '2022-11-12 03:50:51'),
(5, 1, 'VAN SELLING ADMIN EXPORT DATA-2022-03-23144933', '2022-11-12', '2022-11-12 03:52:20', '2022-11-12 03:52:20'),
(6, 1, 'VAN SELLING ADMIN EXPORT DATA-2022-03-23144933', '2022-11-12', '2022-11-12 13:37:29', '2022-11-12 13:37:29'),
(7, 1, 'VAN SELLING ADMIN EXPORT DATA-2022-03-23144933', '2022-11-12', '2022-11-12 13:40:13', '2022-11-12 13:40:13'),
(8, 1, 'VAN SELLING ADMIN EXPORT DATA-2022-03-23144933', '2022-11-12', '2022-11-12 13:55:30', '2022-11-12 13:55:30'),
(9, 1, 'VAN SELLING ADMIN EXPORT DATA-2022-03-23144933', '2022-11-12', '2022-11-12 13:56:12', '2022-11-12 13:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_upload_ledgers`
--

CREATE TABLE `van_selling_upload_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measurement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `butal_equivalent` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beg` int(11) NOT NULL,
  `van_load` int(11) NOT NULL,
  `sales` int(11) NOT NULL,
  `adjustments` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `unit_price` double(15,4) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_cancel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `van_selling_upload_ledgers`
--

INSERT INTO `van_selling_upload_ledgers` (`id`, `store_name`, `principal`, `sku_code`, `description`, `unit_of_measurement`, `sku_type`, `butal_equivalent`, `reference`, `beg`, `van_load`, `sales`, `adjustments`, `end`, `unit_price`, `status`, `status_cancel`, `date`, `created_at`, `updated_at`) VALUES
(1, 'VAN LOAD', 'CIFPI', '1018', 'V FRESH SPEARMINT', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 29, 0, 0, 29, 31.6000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:12', '2022-11-12 13:56:12'),
(2, 'VAN LOAD', 'CIFPI', '1102', 'MON\'AMI STRAWBERRY JAR', 'BUTAL', 'BUTAL', 12, 'VAN SELLING ADMIN EXPORT DATA', 0, 5, 0, 0, 5, 108.5300, NULL, NULL, '2022-11-12', '2022-11-12 13:56:12', '2022-11-12 13:56:12'),
(3, 'VAN LOAD', 'CIFPI', '1103', 'MON\'AMI BUTTER CARAMEL JAR', 'BUTAL', 'BUTAL', 12, 'VAN SELLING ADMIN EXPORT DATA', 0, 1, 0, 0, 1, 108.5300, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(4, 'VAN LOAD', 'EPI', '1212SW2', 'SUPER HEAVY DUTY AAA BLACK IN SHRINK WRAP', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 151, 0, 0, 151, 45.7500, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(5, 'VAN LOAD', 'EPI', '1215SW2', 'SUPER HEAVY DUTY AA BLACK IN SHRINK WRAP', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 347, 0, 0, 347, 30.7500, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(6, 'VAN LOAD', 'EPI', '1222BP1', 'SUPER HEAVY DUTY 9V BLACK IN BLISTER PACK', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 12, 0, 0, 12, 75.5000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(7, 'VAN LOAD', 'EPI', '1250SW2N', 'SUPER HEAY DUTY D SIZE BLACK IN SHRINK WRAP', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 77, 0, 0, 77, 56.7500, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(8, 'VAN LOAD', 'CIFPI', '145', 'JUMBO EASTER EGG GUM BALL JAR', 'BUTAL', 'BUTAL', 12, 'VAN SELLING ADMIN EXPORT DATA', 0, 20, 0, 0, 20, 100.0700, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(9, 'VAN LOAD', 'DOLE', '55101', 'SEASONS PINEAPPLE BANANA JUICE 1L X 12', 'CAN', 'BUTAL', 12, 'VAN SELLING ADMIN EXPORT DATA', 0, 11, 0, 0, 11, 69.0000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(10, 'VAN LOAD', 'DOLE', '55104', 'SEASONS PINEAPPLE COCONUT JUICE 1L X 12', 'CAN', 'BUTAL', 12, 'VAN SELLING ADMIN EXPORT DATA', 0, 12, 0, 0, 12, 69.0000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(11, 'VAN LOAD', 'DOLE', '56424', 'SEASONS FRUIT MIX 3KG X 6 CANS', 'CAN', 'BUTAL', 6, 'VAN SELLING ADMIN EXPORT DATA', 0, 7, 0, 0, 7, 225.0500, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(12, 'VAN LOAD', 'DOLE', '58148', 'SEASONS FRUIT MIX 432G X 24 CANS', 'CAN', 'BUTAL', 24, 'VAN SELLING ADMIN EXPORT DATA', 0, 42, 0, 0, 42, 55.5100, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(13, 'VAN LOAD', 'DOLE', '59189', 'SEASONS FRUIT MIX 822G X 24 CANS', 'CAN', 'BUTAL', 24, 'VAN SELLING ADMIN EXPORT DATA', 0, 43, 0, 0, 43, 77.2100, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(14, 'VAN LOAD', 'CIFPI', '685', 'CHOCQUIK COOKIE', 'BUTAL', 'BUTAL', 20, 'VAN SELLING ADMIN EXPORT DATA', 0, 4, 0, 0, 4, 48.5200, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(15, 'VAN LOAD', 'CIFPI', '710', 'JUMBO CHERRI JAR', 'BUTAL', 'BUTAL', 12, 'VAN SELLING ADMIN EXPORT DATA', 0, 17, 0, 0, 17, 100.0700, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(16, 'VAN LOAD', 'CIFPI', '749', 'POTCHI 26 WORMS JAR', 'BUTAL', 'BUTAL', 12, 'VAN SELLING ADMIN EXPORT DATA', 0, 46, 0, 0, 46, 80.7900, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(17, 'VAN LOAD', 'DOLE', '7513P', '100% PINEAPPLE JUICE 240ML X 5+1 X 4 PACKS', 'PACK', 'BUTAL', 4, 'VAN SELLING ADMIN EXPORT DATA', 0, 11, 0, 0, 11, 131.2500, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(18, 'VAN LOAD', 'DOLE', '7534P', 'PINEAPPLE ORANGE DRINK 240ML X 5+1 X 4 PACKS', 'PACK', 'BUTAL', 4, 'VAN SELLING ADMIN EXPORT DATA', 0, 8, 0, 0, 8, 131.7800, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(19, 'VAN LOAD', 'CIFPI', '808', 'KOOL\'EM 22', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 17, 0, 0, 17, 27.2100, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(20, 'VAN LOAD', 'CIFPI', '809', 'CHOCO JOY', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 168, 0, 0, 168, 30.1500, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(21, 'VAN LOAD', 'CIFPI', '830', 'FRUTOS 22', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 182, 0, 0, 182, 29.6700, NULL, NULL, '2022-11-12', '2022-11-12 13:56:13', '2022-11-12 13:56:13'),
(22, 'VAN LOAD', 'CIFPI', '837', 'BUTTERKIST', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 118, 0, 0, 118, 28.2800, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(23, 'VAN LOAD', 'CIFPI', '865', 'FROOTY RAINBOW POP', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 172, 0, 0, 172, 25.5000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(24, 'VAN LOAD', 'CIFPI', '868', 'FROOTY CHOCOLICIOUS', 'BUTAL', 'BUTAL', 50, 'VAN SELLING ADMIN EXPORT DATA', 0, 8, 0, 0, 8, 19.9200, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(25, 'VAN LOAD', 'CIFPI', '876', 'YAKEE SUPER ASIM GUM BALL', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 178, 0, 0, 178, 25.8200, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(26, 'VAN LOAD', 'CIFPI', '877', 'PINTOORA GUMBALL', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 207, 0, 0, 207, 25.8200, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(27, 'VAN LOAD', 'CIFPI', '890', 'POTCHI STRAWBERRY CREAM', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 174, 0, 0, 174, 29.6700, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(28, 'VAN LOAD', 'EPI', '912SW4', 'GENERAL PURPOSE AAA BLUE IN SHRINK WRAP', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 96, 0, 0, 96, 17.5800, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(29, 'VAN LOAD', 'EPI', '915SW2', 'GENERAL PURPOSE AA BLUE IN SHRINK WRAP', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 143, 0, 0, 143, 8.6900, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(30, 'VAN LOAD', 'EPI', '950SW2', 'GENERAL PURPOSE D SIZE BLUE IN SHRINK WRAP', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 293, 0, 0, 293, 31.5000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(31, 'VAN LOAD', 'CIFPI', '971', 'CHAMPI CHOCOLATE CHEWY', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 180, 0, 0, 180, 30.1500, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(32, 'VAN LOAD', 'CIFPI', '975', 'I COOL MENTHOLATED GUM', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 57, 0, 0, 57, 30.6400, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(33, 'VAN LOAD', 'CIFPI', '979', 'JUMBO REG. JAR', 'BUTAL', 'BUTAL', 12, 'VAN SELLING ADMIN EXPORT DATA', 0, 29, 0, 0, 29, 100.0700, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(34, 'VAN LOAD', 'CIFPI', '988', 'V FRESH WINTER COOL GUM', 'BUTAL', 'BUTAL', 40, 'VAN SELLING ADMIN EXPORT DATA', 0, 176, 0, 0, 176, 31.6000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(35, 'VAN LOAD', 'EPI', 'E303210100', 'CALIFORNIA SCENTS SPILL PROOF CAN CORONADO CHERRY 1PC', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 12, 0, 0, 12, 172.5000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(36, 'VAN LOAD', 'EPI', 'E303210200', 'CALIFORNIA SCENTS SPILL PROOF CAN BLACK ICE 1PC', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 10, 0, 0, 10, 172.5000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(37, 'VAN LOAD', 'EPI', 'E303210300', 'CALIFORNIA SCENTS SPILL PROOF CAN NEW PORT NEW CAR 1PC', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 12, 0, 0, 12, 172.5000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(38, 'VAN LOAD', 'EPI', 'E303210400', 'CALIFORNIA SCENTS SPILL PROOF CAN LA JOLLA LEMON 1PC', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 12, 0, 0, 12, 172.5000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(39, 'VAN LOAD', 'EPI', 'E303211100', 'CALIFORNIA SCENTS COOL GEL NEW PORT NEW CAR 2.5OZ', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 6, 0, 0, 6, 60.0000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(40, 'VAN LOAD', 'EPI', 'E303217500', 'ARMOR ALL PROTECTANT 300ML', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 6, 0, 0, 6, 187.5000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(41, 'VAN LOAD', 'EPI', 'E303217600', 'ARMOR ALL PROTECTANT 120ML', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 5, 0, 0, 5, 86.2500, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(42, 'VAN LOAD', 'EPI', 'E303217700', 'ARMOR ALL PROTECTANT 500ML', 'PACKS', 'BUTAL', 0, 'VAN SELLING ADMIN EXPORT DATA', 0, 6, 0, 0, 6, 262.5000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(43, 'VAN LOAD', 'SUNPRIDE FOODS', 'HBL 100', 'HOLIDAY BEEF LOAF 100G', 'PCS', 'BUTAL', 48, 'VAN SELLING ADMIN EXPORT DATA', 0, 98, 0, 0, 98, 14.8000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(44, 'VAN LOAD', 'SUNPRIDE FOODS', 'HBL 150', 'HOLIDAY BEEF LOAF 150G', 'PCS', 'BUTAL', 100, 'VAN SELLING ADMIN EXPORT DATA', 0, 273, 0, 0, 273, 18.8800, NULL, NULL, '2022-11-12', '2022-11-12 13:56:14', '2022-11-12 13:56:14'),
(45, 'VAN LOAD', 'SUNPRIDE FOODS', 'HBL 215', 'HOLIDAY BEEF LOAF 215G', 'PCS', 'BUTAL', 48, 'VAN SELLING ADMIN EXPORT DATA', 0, 95, 0, 0, 95, 28.8200, NULL, NULL, '2022-11-12', '2022-11-12 13:56:15', '2022-11-12 13:56:15'),
(46, 'VAN LOAD', 'SUNPRIDE FOODS', 'HCB 160', 'HOLIDAY CORNED BEEF 160G', 'PCS', 'BUTAL', 100, 'VAN SELLING ADMIN EXPORT DATA', 0, 163, 0, 0, 163, 35.7000, NULL, NULL, '2022-11-12', '2022-11-12 13:56:15', '2022-11-12 13:56:15'),
(47, 'VAN LOAD', 'SUNPRIDE FOODS', 'HCB 215', 'HOLIDAY CORNED BEEF 215G', 'PCS', 'BUTAL', 48, 'VAN SELLING ADMIN EXPORT DATA', 0, 100, 0, 0, 100, 50.2400, NULL, NULL, '2022-11-12', '2022-11-12 13:56:15', '2022-11-12 13:56:15'),
(48, 'VAN LOAD', 'SUNPRIDE FOODS', 'HCN 100', 'HOLIDAY CARNE NORTE 100G', 'PCS', 'BUTAL', 48, 'VAN SELLING ADMIN EXPORT DATA', 0, 64, 0, 0, 64, 19.8900, NULL, NULL, '2022-11-12', '2022-11-12 13:56:15', '2022-11-12 13:56:15'),
(49, 'VAN LOAD', 'SUNPRIDE FOODS', 'HCN 150', 'HOLIDAY CARNE NORTE 150G', 'PCS', 'BUTAL', 100, 'VAN SELLING ADMIN EXPORT DATA', 0, 228, 0, 0, 228, 28.3100, NULL, NULL, '2022-11-12', '2022-11-12 13:56:15', '2022-11-12 13:56:15'),
(50, 'VAN LOAD', 'SUNPRIDE FOODS', 'HLM 150', 'HOLIDAY LUNCHEON MEAT 150G', 'PCS', 'BUTAL', 100, 'VAN SELLING ADMIN EXPORT DATA', 0, 70, 0, 0, 70, 23.9700, NULL, NULL, '2022-11-12', '2022-11-12 13:56:15', '2022-11-12 13:56:15'),
(51, 'VAN LOAD', 'CIFPI', 'code2', 'desc2', 'BUTAL', 'BUTAL', 12, 'VAN SELLING ADMIN EXPORT DATA', 0, 300, 0, 0, 300, 108.5300, NULL, NULL, '2022-11-12', '2022-11-12 13:56:15', '2022-11-12 13:56:15'),
(52, 'VAN LOAD', 'CIFPI', 'code3', 'desc3', 'BUTAL', 'BUTAL', 12, 'VAN SELLING ADMIN EXPORT DATA', 0, 300, 0, 0, 300, 108.5300, NULL, NULL, '2022-11-12', '2022-11-12 13:56:15', '2022-11-12 13:56:15'),
(53, 'CUSTOMER 1', 'CIFPI', '837', 'BUTTERKIST', 'BUTAL', 'BUTAL', 40, 'VS-1-2022-11-0019', 118, 0, -1, 0, 117, 28.2800, '', '', '2022-11-12', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(54, 'CUSTOMER 1', 'CIFPI', '971', 'CHAMPI CHOCOLATE CHEWY', 'BUTAL', 'BUTAL', 40, 'VS-1-2022-11-0019', 180, 0, -1, 0, 179, 30.1500, '', '', '2022-11-12', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(55, 'CUSTOMER 1', 'CIFPI', '809', 'CHOCO JOY', 'BUTAL', 'BUTAL', 40, 'VS-1-2022-11-0019', 168, 0, -1, 0, 167, 30.1500, '', '', '2022-11-12', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(56, 'CUSTOMER 1', 'CIFPI', 'code2', 'desc2', 'BUTAL', 'BUTAL', 12, 'VS-1-2022-11-0019', 300, 0, -10, 0, 290, 108.5300, '', '', '2022-11-12', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(57, 'CUSTOMER 1', 'CIFPI', 'code3', 'desc3', 'BUTAL', 'BUTAL', 12, 'VS-1-2022-11-0019', 300, 0, -10, 0, 290, 108.5300, '', '', '2022-11-12', '2022-11-12 14:23:35', '2022-11-12 14:23:35'),
(58, 'SMEPL', 'CIFPI', '837', 'BUTTERKIST', 'BUTAL', 'BUTAL', 40, 'VS-1-2022-11-0020', 117, 0, -1, 0, 116, 28.2800, '', '', '2022-11-15', '2022-11-15 11:12:35', '2022-11-15 11:12:35'),
(59, 'SMEPL', 'CIFPI', '971', 'CHAMPI CHOCOLATE CHEWY', 'BUTAL', 'BUTAL', 40, 'VS-1-2022-11-0020', 179, 0, -1, 0, 178, 30.1500, '', '', '2022-11-15', '2022-11-15 11:12:35', '2022-11-15 11:12:35'),
(60, 'CUSTOMER 1', 'CIFPI', '837', 'BUTTERKIST', 'BUTAL', 'BUTAL', 40, 'VS-1-2022-11-0021', 116, 0, -1, 0, 115, 28.2800, '', '', '2022-11-16', '2022-11-16 11:23:00', '2022-11-16 11:23:00'),
(61, 'CUSTOMER 1', 'CIFPI', '971', 'CHAMPI CHOCOLATE CHEWY', 'BUTAL', 'BUTAL', 40, 'VS-1-2022-11-0021', 178, 0, -1, 0, 177, 30.1500, '', '', '2022-11-16', '2022-11-16 11:23:00', '2022-11-16 11:23:00'),
(62, 'CUSTOMER 1', 'CIFPI', '809', 'CHOCO JOY', 'BUTAL', 'BUTAL', 40, 'VS-1-2022-11-0021', 167, 0, -1, 0, 166, 30.1500, '', '', '2022-11-16', '2022-11-16 11:23:00', '2022-11-16 11:23:00'),
(63, 'CUSTOMER 1', 'CIFPI', '685', 'CHOCQUIK COOKIE', 'BUTAL', 'BUTAL', 20, 'VS-1-2022-11-0021', 4, 0, -1, 0, 3, 48.5200, '', '', '2022-11-16', '2022-11-16 11:23:00', '2022-11-16 11:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_upload_transactions`
--

CREATE TABLE `van_selling_upload_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measurement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price_left` decimal(15,4) NOT NULL,
  `total_left` decimal(15,4) NOT NULL,
  `butal_equivalent` int(11) NOT NULL,
  `quantity_butal` int(11) NOT NULL,
  `unit_price_right` decimal(15,4) NOT NULL,
  `total_right` decimal(15,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_selling_van_loads`
--

CREATE TABLE `van_selling_van_loads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_van_load` double(15,4) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_applied_customers`
--
ALTER TABLE `agent_applied_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_users`
--
ALTER TABLE `agent_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ar_ledgers`
--
ALTER TABLE `ar_ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ar_ledgers_customer_id_index` (`customer_id`),
  ADD KEY `ar_ledgers_user_id_index` (`user_id`);

--
-- Indexes for table `bos`
--
ALTER TABLE `bos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bos_customer_id_index` (`customer_id`),
  ADD KEY `bos_principal_id_index` (`principal_id`),
  ADD KEY `bos_user_id_index` (`user_id`);

--
-- Indexes for table `bo_details`
--
ALTER TABLE `bo_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bo_details_bo_id_index` (`bo_id`),
  ADD KEY `bo_details_sku_id_index` (`sku_id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collections_date_collected_index` (`date_collected`),
  ADD KEY `collections_customer_id_index` (`customer_id`),
  ADD KEY `collections_principal_id_index` (`principal_id`),
  ADD KEY `collections_user_id_index` (`user_id`);

--
-- Indexes for table `collection_cash_checks`
--
ALTER TABLE `collection_cash_checks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_cash_checks_collection_id_index` (`collection_id`);

--
-- Indexes for table `collection_details`
--
ALTER TABLE `collection_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_details_collection_id_index` (`collection_id`);

--
-- Indexes for table `collection_images`
--
ALTER TABLE `collection_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_images_collection_id_index` (`collection_id`);

--
-- Indexes for table `collection_referals`
--
ALTER TABLE `collection_referals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_referals_collection_id_index` (`collection_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_principal_codes`
--
ALTER TABLE `customer_principal_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_principal_prices`
--
ALTER TABLE `customer_principal_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_uploads`
--
ALTER TABLE `customer_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `principals`
--
ALTER TABLE `principals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_orders_user_id_index` (`user_id`),
  ADD KEY `sales_orders_customer_id_index` (`customer_id`),
  ADD KEY `sales_orders_principal_id_index` (`principal_id`),
  ADD KEY `sales_orders_date_index` (`date`);

--
-- Indexes for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_order_details_sales_order_id_index` (`sales_order_id`),
  ADD KEY `sales_order_details_sku_id_index` (`sku_id`),
  ADD KEY `sales_order_details_customer_id_index` (`customer_id`);

--
-- Indexes for table `sales_register_details`
--
ALTER TABLE `sales_register_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_register_details_sales_register_id_index` (`sales_register_id`),
  ADD KEY `sales_register_details_sku_id_index` (`sku_id`);

--
-- Indexes for table `sales_register_uploadeds`
--
ALTER TABLE `sales_register_uploadeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_register_uploadeds_customer_id_index` (`customer_id`),
  ADD KEY `sales_register_uploadeds_principal_id_index` (`principal_id`),
  ADD KEY `sales_register_uploadeds_user_id_index` (`user_id`);

--
-- Indexes for table `sku_inventories`
--
ALTER TABLE `sku_inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sku_inventories_principal_id_index` (`principal_id`);

--
-- Indexes for table `sku_uploads`
--
ALTER TABLE `sku_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `summary_of_transaction_ledgers`
--
ALTER TABLE `summary_of_transaction_ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `summary_of_transaction_ledgers_customer_id_index` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `van_selling_calls`
--
ALTER TABLE `van_selling_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van_selling_cancellations`
--
ALTER TABLE `van_selling_cancellations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_cancellations_van_selling_trans_id_index` (`van_selling_trans_id`),
  ADD KEY `van_selling_cancellations_date_index` (`date`);

--
-- Indexes for table `van_selling_cancellation_details`
--
ALTER TABLE `van_selling_cancellation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_cancellation_details_vs_cancelation_id_index` (`vs_cancelation_id`);

--
-- Indexes for table `van_selling_customers`
--
ALTER TABLE `van_selling_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_customers_location_id_index` (`location_id`);

--
-- Indexes for table `van_selling_inventories`
--
ALTER TABLE `van_selling_inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van_selling_os_cart_details`
--
ALTER TABLE `van_selling_os_cart_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van_selling_os_datas`
--
ALTER TABLE `van_selling_os_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van_selling_price_updates`
--
ALTER TABLE `van_selling_price_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_price_updates_date_index` (`date`);

--
-- Indexes for table `van_selling_price_update_details`
--
ALTER TABLE `van_selling_price_update_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_price_update_details_vs_price_update_id_index` (`vs_price_update_id`);

--
-- Indexes for table `van_selling_transactions`
--
ALTER TABLE `van_selling_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_transactions_date_index` (`date`);

--
-- Indexes for table `van_selling_transaction_cart_details`
--
ALTER TABLE `van_selling_transaction_cart_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van_selling_transaction_cms`
--
ALTER TABLE `van_selling_transaction_cms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_transaction_cms_van_selling_trans_id_index` (`van_selling_trans_id`),
  ADD KEY `van_selling_transaction_cms_user_id_index` (`user_id`);

--
-- Indexes for table `van_selling_transaction_cm_details`
--
ALTER TABLE `van_selling_transaction_cm_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_transaction_cm_details_vs_trans_cm_id_index` (`vs_trans_cm_id`);

--
-- Indexes for table `van_selling_transaction_details`
--
ALTER TABLE `van_selling_transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_transaction_details_van_selling_trans_id_index` (`van_selling_trans_id`);

--
-- Indexes for table `van_selling_uploads`
--
ALTER TABLE `van_selling_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_uploads_customer_id_index` (`customer_id`),
  ADD KEY `van_selling_uploads_date_index` (`date`);

--
-- Indexes for table `van_selling_upload_ledgers`
--
ALTER TABLE `van_selling_upload_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van_selling_upload_transactions`
--
ALTER TABLE `van_selling_upload_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van_selling_van_loads`
--
ALTER TABLE `van_selling_van_loads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_selling_van_loads_date_index` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_applied_customers`
--
ALTER TABLE `agent_applied_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agent_users`
--
ALTER TABLE `agent_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ar_ledgers`
--
ALTER TABLE `ar_ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bos`
--
ALTER TABLE `bos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bo_details`
--
ALTER TABLE `bo_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_cash_checks`
--
ALTER TABLE `collection_cash_checks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_details`
--
ALTER TABLE `collection_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_images`
--
ALTER TABLE `collection_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_referals`
--
ALTER TABLE `collection_referals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_principal_codes`
--
ALTER TABLE `customer_principal_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_principal_prices`
--
ALTER TABLE `customer_principal_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_uploads`
--
ALTER TABLE `customer_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `principals`
--
ALTER TABLE `principals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_register_details`
--
ALTER TABLE `sales_register_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_register_uploadeds`
--
ALTER TABLE `sales_register_uploadeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sku_inventories`
--
ALTER TABLE `sku_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sku_uploads`
--
ALTER TABLE `sku_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `summary_of_transaction_ledgers`
--
ALTER TABLE `summary_of_transaction_ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_selling_calls`
--
ALTER TABLE `van_selling_calls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `van_selling_cancellations`
--
ALTER TABLE `van_selling_cancellations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_selling_cancellation_details`
--
ALTER TABLE `van_selling_cancellation_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_selling_customers`
--
ALTER TABLE `van_selling_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `van_selling_inventories`
--
ALTER TABLE `van_selling_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `van_selling_os_cart_details`
--
ALTER TABLE `van_selling_os_cart_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_selling_os_datas`
--
ALTER TABLE `van_selling_os_datas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `van_selling_price_updates`
--
ALTER TABLE `van_selling_price_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_selling_price_update_details`
--
ALTER TABLE `van_selling_price_update_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_selling_transactions`
--
ALTER TABLE `van_selling_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `van_selling_transaction_cart_details`
--
ALTER TABLE `van_selling_transaction_cart_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_selling_transaction_cms`
--
ALTER TABLE `van_selling_transaction_cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_selling_transaction_cm_details`
--
ALTER TABLE `van_selling_transaction_cm_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_selling_transaction_details`
--
ALTER TABLE `van_selling_transaction_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `van_selling_uploads`
--
ALTER TABLE `van_selling_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `van_selling_upload_ledgers`
--
ALTER TABLE `van_selling_upload_ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `van_selling_upload_transactions`
--
ALTER TABLE `van_selling_upload_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_selling_van_loads`
--
ALTER TABLE `van_selling_van_loads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ar_ledgers`
--
ALTER TABLE `ar_ledgers`
  ADD CONSTRAINT `ar_ledgers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `ar_ledgers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bos`
--
ALTER TABLE `bos`
  ADD CONSTRAINT `bos_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `bos_principal_id_foreign` FOREIGN KEY (`principal_id`) REFERENCES `principals` (`id`),
  ADD CONSTRAINT `bos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bo_details`
--
ALTER TABLE `bo_details`
  ADD CONSTRAINT `bo_details_bo_id_foreign` FOREIGN KEY (`bo_id`) REFERENCES `bos` (`id`),
  ADD CONSTRAINT `bo_details_sku_id_foreign` FOREIGN KEY (`sku_id`) REFERENCES `sku_inventories` (`id`);

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `collections_principal_id_foreign` FOREIGN KEY (`principal_id`) REFERENCES `principals` (`id`),
  ADD CONSTRAINT `collections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `collection_cash_checks`
--
ALTER TABLE `collection_cash_checks`
  ADD CONSTRAINT `collection_cash_checks_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`);

--
-- Constraints for table `collection_details`
--
ALTER TABLE `collection_details`
  ADD CONSTRAINT `collection_details_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`);

--
-- Constraints for table `collection_images`
--
ALTER TABLE `collection_images`
  ADD CONSTRAINT `collection_images_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`);

--
-- Constraints for table `collection_referals`
--
ALTER TABLE `collection_referals`
  ADD CONSTRAINT `collection_referals_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`);

--
-- Constraints for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD CONSTRAINT `sales_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_orders_principal_id_foreign` FOREIGN KEY (`principal_id`) REFERENCES `principals` (`id`),
  ADD CONSTRAINT `sales_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  ADD CONSTRAINT `sales_order_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_order_details_sales_order_id_foreign` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`),
  ADD CONSTRAINT `sales_order_details_sku_id_foreign` FOREIGN KEY (`sku_id`) REFERENCES `sku_inventories` (`id`);

--
-- Constraints for table `sales_register_details`
--
ALTER TABLE `sales_register_details`
  ADD CONSTRAINT `sales_register_details_sales_register_id_foreign` FOREIGN KEY (`sales_register_id`) REFERENCES `sales_register_uploadeds` (`id`),
  ADD CONSTRAINT `sales_register_details_sku_id_foreign` FOREIGN KEY (`sku_id`) REFERENCES `sku_inventories` (`id`);

--
-- Constraints for table `sales_register_uploadeds`
--
ALTER TABLE `sales_register_uploadeds`
  ADD CONSTRAINT `sales_register_uploadeds_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_register_uploadeds_principal_id_foreign` FOREIGN KEY (`principal_id`) REFERENCES `principals` (`id`),
  ADD CONSTRAINT `sales_register_uploadeds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sku_inventories`
--
ALTER TABLE `sku_inventories`
  ADD CONSTRAINT `sku_inventories_principal_id_foreign` FOREIGN KEY (`principal_id`) REFERENCES `principals` (`id`);

--
-- Constraints for table `summary_of_transaction_ledgers`
--
ALTER TABLE `summary_of_transaction_ledgers`
  ADD CONSTRAINT `summary_of_transaction_ledgers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `van_selling_cancellations`
--
ALTER TABLE `van_selling_cancellations`
  ADD CONSTRAINT `van_selling_cancellations_van_selling_trans_id_foreign` FOREIGN KEY (`van_selling_trans_id`) REFERENCES `van_selling_transactions` (`id`);

--
-- Constraints for table `van_selling_cancellation_details`
--
ALTER TABLE `van_selling_cancellation_details`
  ADD CONSTRAINT `van_selling_cancellation_details_vs_cancelation_id_foreign` FOREIGN KEY (`vs_cancelation_id`) REFERENCES `van_selling_cancellations` (`id`);

--
-- Constraints for table `van_selling_customers`
--
ALTER TABLE `van_selling_customers`
  ADD CONSTRAINT `van_selling_customers_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `van_selling_price_update_details`
--
ALTER TABLE `van_selling_price_update_details`
  ADD CONSTRAINT `van_selling_price_update_details_vs_price_update_id_foreign` FOREIGN KEY (`vs_price_update_id`) REFERENCES `van_selling_price_updates` (`id`);

--
-- Constraints for table `van_selling_transaction_cms`
--
ALTER TABLE `van_selling_transaction_cms`
  ADD CONSTRAINT `van_selling_transaction_cms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `van_selling_transaction_cms_van_selling_trans_id_foreign` FOREIGN KEY (`van_selling_trans_id`) REFERENCES `van_selling_transactions` (`id`);

--
-- Constraints for table `van_selling_transaction_cm_details`
--
ALTER TABLE `van_selling_transaction_cm_details`
  ADD CONSTRAINT `van_selling_transaction_cm_details_vs_trans_cm_id_foreign` FOREIGN KEY (`vs_trans_cm_id`) REFERENCES `van_selling_transaction_cms` (`id`);

--
-- Constraints for table `van_selling_transaction_details`
--
ALTER TABLE `van_selling_transaction_details`
  ADD CONSTRAINT `van_selling_transaction_details_van_selling_trans_id_foreign` FOREIGN KEY (`van_selling_trans_id`) REFERENCES `van_selling_transactions` (`id`);

--
-- Constraints for table `van_selling_uploads`
--
ALTER TABLE `van_selling_uploads`
  ADD CONSTRAINT `van_selling_uploads_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
