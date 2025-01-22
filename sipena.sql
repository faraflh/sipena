-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 08:44 AM
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
-- Database: `sipena`
--

-- --------------------------------------------------------

--
-- Table structure for table `alurs`
--

CREATE TABLE `alurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaAlur` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alurs`
--

INSERT INTO `alurs` (`id`, `namaAlur`, `created_at`, `updated_at`) VALUES
(3, 'Pengembangan', '2025-01-20 18:06:30', '2025-01-20 20:35:04'),
(4, 'Permohonan', '2025-01-20 20:34:57', '2025-01-20 20:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `aplikasis`
--

CREATE TABLE `aplikasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaAplikasi` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `detail_tim_id` bigint(20) UNSIGNED NOT NULL,
  `detail_dokumen_id` bigint(20) UNSIGNED NOT NULL,
  `alur_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_alurs`
--

CREATE TABLE `detail_alurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `aplikasi_id` bigint(20) UNSIGNED NOT NULL,
  `alur_id` bigint(20) UNSIGNED NOT NULL,
  `keterangan_alur` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_alurs`
--

INSERT INTO `detail_alurs` (`id`, `aplikasi_id`, `alur_id`, `keterangan_alur`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'halo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_dokumens`
--

CREATE TABLE `detail_dokumens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaDokumen` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `aplikasi_id` bigint(20) UNSIGNED NOT NULL,
  `dokumen_id` bigint(20) UNSIGNED NOT NULL,
  `noSurat` int(11) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tanggalSurat` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_tims`
--

CREATE TABLE `detail_tims` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `aplikasi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumens`
--

CREATE TABLE `dokumens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `alur_id` bigint(20) UNSIGNED NOT NULL,
  `jenisDokumen` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumens`
--

INSERT INTO `dokumens` (`id`, `kategori_id`, `alur_id`, `jenisDokumen`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'apa ajalah', '2025-01-20 18:06:49', '2025-01-20 20:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `dpas`
--

CREATE TABLE `dpas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `noSPT` int(11) NOT NULL,
  `noSPPD` int(11) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `noRek` int(11) NOT NULL,
  `noDPA` int(11) NOT NULL,
  `subKeg` varchar(255) NOT NULL,
  `tahun` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dpas`
--

INSERT INTO `dpas` (`id`, `noSPT`, `noSPPD`, `tujuan`, `noRek`, `noDPA`, `subKeg`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 123, 132, 'apa', 876623, 7645, 'app', '2023', '2025-01-19 21:05:59', '2025-01-19 21:06:20');

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
-- Table structure for table `golongans`
--

CREATE TABLE `golongans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaGolPang` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `golongans`
--

INSERT INTO `golongans` (`id`, `namaGolPang`, `created_at`, `updated_at`) VALUES
(1, 'Golongan I', '2025-01-15 07:56:36', '2025-01-15 07:56:36'),
(2, 'Golongan I', '2025-01-15 07:56:36', '2025-01-15 07:56:36'),
(3, 'Golongan I', '2025-01-15 07:56:36', '2025-01-15 07:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_kegiatans`
--

CREATE TABLE `jabatan_kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_status_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan_kegiatans`
--

INSERT INTO `jabatan_kegiatans` (`id`, `pegawai_id`, `kategori_id`, `jabatan_status_id`, `created_at`, `updated_at`) VALUES
(2, 5, 1, 2, '2025-01-19 20:06:07', '2025-01-19 20:06:07'),
(3, 2, 1, 2, '2025-01-20 10:22:43', '2025-01-20 10:22:43'),
(4, 2, 1, 2, '2025-01-21 23:41:27', '2025-01-21 23:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_pegawais`
--

CREATE TABLE `jabatan_pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaJabatan` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan_pegawais`
--

INSERT INTO `jabatan_pegawais` (`id`, `namaJabatan`, `created_at`, `updated_at`) VALUES
(1, 'Manager', NULL, NULL),
(2, 'Staff', NULL, NULL),
(3, 'Supervisor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_statuses`
--

CREATE TABLE `jabatan_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaJabatanStatus` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan_statuses`
--

INSERT INTO `jabatan_statuses` (`id`, `namaJabatanStatus`, `created_at`, `updated_at`) VALUES
(1, 'pptk', '2025-01-19 08:06:24', '2025-01-19 08:06:24'),
(2, 'subbag', '2025-01-19 08:06:30', '2025-01-19 08:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaKategori` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `namaKategori`, `created_at`, `updated_at`) VALUES
(1, 'aplikasi', '2025-01-19 08:07:19', '2025-01-19 08:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaKegiatan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_01_15_054654_create_alurs_table', 1),
(7, '2025_01_15_054758_create_dokumens_table', 1),
(8, '2025_01_15_054820_create_dpas_table', 1),
(9, '2025_01_15_054836_create_golongans_table', 1),
(11, '2025_01_15_054920_create_jabatan_pegawais_table', 1),
(12, '2025_01_15_054948_create_jabatan_statuses_table', 1),
(13, '2025_01_15_055339_create_kategoris_table', 1),
(14, '2025_01_15_055348_create_pegawais_table', 1),
(15, '2014_10_12_000000_create_users_table', 2),
(16, '2025_01_15_054902_create_jabatan_kegiatans_table', 3),
(19, '2025_01_21_082645_create_kegiatans_table', 5),
(20, '2025_01_21_082738_create_aplikasis_table', 6),
(21, '2025_01_21_082807_create_detail_tims_table', 6),
(22, '2025_01_21_082830_create_detail_dokumens_table', 7),
(23, '2025_01_21_084338_create_detail_alurs_table', 7),
(24, '2025_01_13_084444_create_permohonans_table', 8);

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
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip_nik` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `namaRek` varchar(255) NOT NULL,
  `noRek` int(11) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `golongan_id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `nip_nik`, `nama`, `namaRek`, `noRek`, `bank`, `golongan_id`, `jabatan_pegawai_id`, `email`, `created_at`, `updated_at`) VALUES
(2, '6403035709030001', 'Jane Smith', 'Jane Smith', 987654321, 'Bank B', 2, 2, 'janesmith@example.com', '2025-01-15 08:01:11', '2025-01-16 23:06:58'),
(3, '2102045508040002', 'Aisyah', 'Michael Johnson', 112233445, 'Bank C', 3, 3, 'michaeljohnson@example.com', '2025-01-15 08:01:11', '2025-01-17 00:34:53'),
(4, '1409024609040002', 'Sabrina', 'Sabrina Ina', 987654321, 'ABC Bank', 2, 1, 'sabrina@awaliah.com', '2025-01-15 01:26:29', '2025-01-16 22:07:40'),
(5, '6403035709030001', 'farah', 'farah', 14409028, 'bni', 1, 3, 'farahaflah17@gmail.com', '2025-01-16 23:00:11', '2025-01-16 23:00:11'),
(7, '1409024609040001', 'a', 'hm', 876623, 'abc', 2, 3, 'yona.fadia@gmail.com', '2025-01-20 20:27:17', '2025-01-20 20:27:17'),
(8, '1409024609040002', 'uhdfjn', 'hm', 876623, 'abc', 1, 1, 'yona.fadia@gmail.com', '2025-01-20 20:27:44', '2025-01-20 20:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `permohonans`
--

CREATE TABLE `permohonans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pemohon` varchar(255) NOT NULL,
  `nip` bigint(20) NOT NULL,
  `nomor_telepon` bigint(20) NOT NULL,
  `nama_opd` varchar(255) NOT NULL,
  `nama_aplikasi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `generate_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permohonans`
--

INSERT INTO `permohonans` (`id`, `nama_pemohon`, `nip`, `nomor_telepon`, `nama_opd`, `nama_aplikasi`, `email`, `status`, `generate_code`, `created_at`, `updated_at`) VALUES
(1, 'yona', 176556828827363782, 9837663818, 'sapa aja', 'g', 'meow@riau.go.id', 'Ditolak', NULL, '2025-01-21 23:59:20', '2025-01-22 00:00:27'),
(2, 'yona', 176556828827363782, 12345678, 'sapa aja', 'meow', 'meow@riau.go.id', 'Diterima', '731512', '2025-01-22 00:03:12', '2025-01-22 00:03:42');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(10) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email_verified_at`, `password`, `pegawai_id`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, '$2y$10$9g8h8r.kpIPi3uismvuGoup6wonkwyvZ.73KpsMMk3p5G72SgLHPy', 4, 'admin', NULL, '2025-01-15 01:26:29', '2025-01-15 01:26:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alurs`
--
ALTER TABLE `alurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aplikasis`
--
ALTER TABLE `aplikasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_alurs`
--
ALTER TABLE `detail_alurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_dokumens`
--
ALTER TABLE `detail_dokumens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_tims`
--
ALTER TABLE `detail_tims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumens`
--
ALTER TABLE `dokumens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dpas`
--
ALTER TABLE `dpas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `golongans`
--
ALTER TABLE `golongans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan_kegiatans`
--
ALTER TABLE `jabatan_kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan_pegawais`
--
ALTER TABLE `jabatan_pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan_statuses`
--
ALTER TABLE `jabatan_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permohonans`
--
ALTER TABLE `permohonans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alurs`
--
ALTER TABLE `alurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `aplikasis`
--
ALTER TABLE `aplikasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_alurs`
--
ALTER TABLE `detail_alurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_dokumens`
--
ALTER TABLE `detail_dokumens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_tims`
--
ALTER TABLE `detail_tims`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumens`
--
ALTER TABLE `dokumens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dpas`
--
ALTER TABLE `dpas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `golongans`
--
ALTER TABLE `golongans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatan_kegiatans`
--
ALTER TABLE `jabatan_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jabatan_pegawais`
--
ALTER TABLE `jabatan_pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatan_statuses`
--
ALTER TABLE `jabatan_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permohonans`
--
ALTER TABLE `permohonans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
