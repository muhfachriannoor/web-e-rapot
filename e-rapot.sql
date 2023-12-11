-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2023 pada 19.11
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-rapot`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id_ekstrakurikuler` varchar(36) NOT NULL,
  `rapot_id` varchar(36) DEFAULT NULL,
  `kegiatan_ekstrakurikuler` varchar(50) DEFAULT NULL,
  `keterangan_ekstrakurikuler` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at_ekstrakurikuler` timestamp NULL DEFAULT NULL,
  `updated_at_ekstrakurikuler` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` varchar(36) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama_guru` varchar(255) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama_guru`, `jabatan`, `status`, `created_at`, `updated_at`) VALUES
('a3f1020a-bb1f-49f2-a3c5-af22fc10075f', '123', 'Kepala Sekolah', 'Kepala Sekolah', NULL, '2023-12-11 18:10:15', '2023-12-12 02:10:15'),
('b0ccde49-385f-43fa-a328-feae2c6976ad', '123456789', 'Wali Kelas 1', 'Guru Honorer', NULL, '2023-12-11 18:10:38', '2023-12-12 02:10:38'),
('e09fa4b8-250b-496b-adb3-88ef8ab3d48b', '12345', 'Wakil Kepala Sekolah', 'Wakil Kepala Sekolah', NULL, '2023-12-11 18:10:24', '2023-12-12 02:10:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi_sekolah`
--

CREATE TABLE `informasi_sekolah` (
  `id` varchar(36) NOT NULL,
  `nama_sekolah` varchar(255) DEFAULT NULL,
  `npsn` varchar(100) DEFAULT NULL,
  `nis` varchar(100) DEFAULT NULL,
  `nss` varchar(100) DEFAULT NULL,
  `nds` varchar(100) DEFAULT NULL,
  `alamat_sekolah` varchar(255) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kota_kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `link_website` varchar(255) DEFAULT NULL,
  `email_sekolah` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `no_telp_sekolah` varchar(13) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `informasi_sekolah`
--

INSERT INTO `informasi_sekolah` (`id`, `nama_sekolah`, `npsn`, `nis`, `nss`, `nds`, `alamat_sekolah`, `kelurahan`, `kecamatan`, `kota_kabupaten`, `provinsi`, `link_website`, `email_sekolah`, `kode_pos`, `no_telp_sekolah`, `created_at`, `updated_at`) VALUES
('e4ee506c-8e36-11ee-b34c-c87f546b019b', 'SMP Muhammadiyah 1 Samarinda', '123', '123', '123', '123', 'Jl. Pangeran Hidayatullah Gg. Bakti No. 06, Pelabuhan', NULL, 'Samarinda Kota', 'Kota Samarinda', 'Provinsi Kalimantan Timur', 'https://sekolah.data.kemdikbud.go.id/index.php/chome/profil/e0f3e87e-30f5-e011-8e87-df15afa5a6f0', 'email@mail.com', '123', '0541', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` varchar(36) NOT NULL,
  `tingkat_kelas_id` varchar(36) NOT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id_kelas_siswa` varchar(36) NOT NULL,
  `wali_kelas_id` varchar(36) DEFAULT NULL,
  `siswa_id` varchar(36) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel_kelas`
--

CREATE TABLE `mapel_kelas` (
  `id` varchar(36) NOT NULL,
  `tahun_ajaran_id` varchar(36) DEFAULT NULL,
  `tingkat_kelas_id` varchar(36) DEFAULT NULL,
  `mapel_id` varchar(36) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` varchar(36) NOT NULL,
  `nama_mapel` varchar(255) DEFAULT NULL,
  `nilai_kkm` bigint(10) DEFAULT NULL,
  `kelompok_mapel` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_mapel`
--

CREATE TABLE `nilai_mapel` (
  `id_nilai_mapel` varchar(36) NOT NULL,
  `rapot_id` varchar(36) DEFAULT NULL,
  `id_mapel` varchar(36) DEFAULT NULL,
  `nilai_pengetahuan` int(5) DEFAULT NULL,
  `predikat_pengetahuan` varchar(5) DEFAULT NULL,
  `deskripsi_pengetahuan` varchar(255) DEFAULT NULL,
  `nilai_keterampilan` int(5) DEFAULT NULL,
  `predikat_keterampilan` varchar(5) DEFAULT NULL,
  `deskripsi_keterampilan` varchar(255) DEFAULT NULL,
  `status_kkm` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at_nilai` timestamp NULL DEFAULT NULL,
  `updated_at_nilai` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` varchar(36) NOT NULL,
  `rapot_id` varchar(36) DEFAULT NULL,
  `jenis_prestasi` varchar(50) DEFAULT NULL,
  `keterangan_prestasi` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at_prestasi` timestamp NULL DEFAULT NULL,
  `updated_at_prestasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapot`
--

CREATE TABLE `rapot` (
  `id_rapot` varchar(36) NOT NULL,
  `kelas_siswa_id` varchar(36) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `sakit` varchar(10) DEFAULT NULL,
  `izin` varchar(10) DEFAULT NULL,
  `tanpa_keterangan` varchar(10) DEFAULT NULL,
  `catatan_walikelas` varchar(255) DEFAULT NULL,
  `tanggapan_orangtua_wali` varchar(255) DEFAULT NULL,
  `keputusan_kelas` varchar(20) DEFAULT NULL,
  `keputusan_tingkat_kelas` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at_rapot` timestamp NULL DEFAULT NULL,
  `updated_at_rapot` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sikap`
--

CREATE TABLE `sikap` (
  `id_sikap` varchar(36) NOT NULL,
  `rapot_id` varchar(36) DEFAULT NULL,
  `predikat_spiritual` varchar(50) DEFAULT NULL,
  `deskripsi_spiritual` varchar(255) DEFAULT NULL,
  `predikat_sosial` varchar(255) DEFAULT NULL,
  `deskripsi_sosial` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at_sikap` timestamp NULL DEFAULT NULL,
  `updated_at_sikap` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` varchar(36) NOT NULL,
  `nisn` varchar(50) DEFAULT NULL,
  `nama_siswa` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `status_dalam_keluarga` varchar(50) DEFAULT NULL,
  `anak_ke` varchar(50) DEFAULT NULL,
  `alamat_rumah` varchar(255) DEFAULT NULL,
  `no_telp_rumah` varchar(13) DEFAULT NULL,
  `asal_sekolah` varchar(255) DEFAULT NULL,
  `diterima_dikelas` varchar(100) DEFAULT NULL,
  `diterima_tanggal` date DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `alamat_orangtua` varchar(255) DEFAULT NULL,
  `no_telp_orangtua` varchar(13) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `alamat_wali` varchar(255) DEFAULT NULL,
  `no_telp_wali` varchar(13) DEFAULT NULL,
  `pekerjaan_wali` varchar(100) DEFAULT NULL,
  `foto_siswa` varchar(255) DEFAULT NULL,
  `status_lulus` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` varchar(36) NOT NULL,
  `tahun_ajaran` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tingkat_kelas`
--

CREATE TABLE `tingkat_kelas` (
  `id` varchar(36) NOT NULL,
  `tingkat_kelas` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tingkat_kelas`
--

INSERT INTO `tingkat_kelas` (`id`, `tingkat_kelas`, `created_at`, `updated_at`) VALUES
('4107656f-aa0f-4b11-875b-46023b7ff78c', 'Kelas IX (9)', '2023-11-28 13:41:50', '2023-12-04 18:08:07'),
('54d5d332-da57-479f-88e2-f5b6f145dd46', 'Kelas VII (7)', '2023-11-28 13:41:43', '2023-12-04 17:50:40'),
('95244f62-b978-4500-972e-4b08f7e4a4ee', 'Kelas VIII (8)', '2023-11-28 13:41:46', '2023-11-28 13:41:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `guru_id` varchar(36) DEFAULT NULL,
  `foto_user` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `level`, `guru_id`, `foto_user`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Administrator', 'admin', NULL, '$2y$10$n25dSNvd/OIExPECbW6lteJZmpCyJyBkQk5l3JU7Fix7vZYLXfxLS', NULL, 1, NULL, 'default-foto.png', NULL, NULL),
(5, 'Wakil Kepala Sekolah', 'wakasekolah@gmail.com', 'wakasekolah', NULL, '$2y$10$qWDDLzaiAYpNlfy1NfvL7.O0nB8e9SnyJmhE.q1D660Lglc1O4vaW', NULL, 2, 'e09fa4b8-250b-496b-adb3-88ef8ab3d48b', 'default-foto.png', '2023-12-11 17:08:37', '2023-12-11 18:10:46'),
(6, 'walikelas1', 'a@mail.com', 'walikelas1', NULL, '$2y$10$dYziH/znrt25P/F2xcG7te6hv69mSJcABMX/A3yFQaohWU./ZRrp6', NULL, 3, 'b0ccde49-385f-43fa-a328-feae2c6976ad', 'default-foto.png', '2023-12-11 17:16:10', '2023-12-11 18:10:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id` varchar(36) NOT NULL,
  `tahun_ajaran_id` varchar(36) DEFAULT NULL,
  `kelas_id` varchar(36) DEFAULT NULL,
  `guru_id` varchar(36) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`id_ekstrakurikuler`),
  ADD KEY `rapot_id` (`rapot_id`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `informasi_sekolah`
--
ALTER TABLE `informasi_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tingkat_kelas_id` (`tingkat_kelas_id`);

--
-- Indeks untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id_kelas_siswa`),
  ADD KEY `wali_kelas_id` (`wali_kelas_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indeks untuk tabel `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `matpel_id` (`mapel_id`),
  ADD KEY `tingkat_kelas_id` (`tingkat_kelas_id`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_mapel`
--
ALTER TABLE `nilai_mapel`
  ADD PRIMARY KEY (`id_nilai_mapel`),
  ADD KEY `rapot_id` (`rapot_id`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `rapot_id` (`rapot_id`);

--
-- Indeks untuk tabel `rapot`
--
ALTER TABLE `rapot`
  ADD PRIMARY KEY (`id_rapot`),
  ADD KEY `kelas_siswa_id` (`kelas_siswa_id`);

--
-- Indeks untuk tabel `sikap`
--
ALTER TABLE `sikap`
  ADD PRIMARY KEY (`id_sikap`),
  ADD KEY `rapot_id` (`rapot_id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tingkat_kelas`
--
ALTER TABLE `tingkat_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indeks untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD CONSTRAINT `ekstrakurikuler_ibfk_1` FOREIGN KEY (`rapot_id`) REFERENCES `rapot` (`id_rapot`);

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`tingkat_kelas_id`) REFERENCES `tingkat_kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD CONSTRAINT `kelas_siswa_ibfk_1` FOREIGN KEY (`wali_kelas_id`) REFERENCES `wali_kelas` (`id`),
  ADD CONSTRAINT `kelas_siswa_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`);

--
-- Ketidakleluasaan untuk tabel `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD CONSTRAINT `mapel_kelas_ibfk_1` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`),
  ADD CONSTRAINT `mapel_kelas_ibfk_3` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `mapel_kelas_ibfk_4` FOREIGN KEY (`tingkat_kelas_id`) REFERENCES `tingkat_kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_mapel`
--
ALTER TABLE `nilai_mapel`
  ADD CONSTRAINT `nilai_mapel_ibfk_1` FOREIGN KEY (`rapot_id`) REFERENCES `rapot` (`id_rapot`),
  ADD CONSTRAINT `nilai_mapel_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id`);

--
-- Ketidakleluasaan untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`rapot_id`) REFERENCES `rapot` (`id_rapot`);

--
-- Ketidakleluasaan untuk tabel `rapot`
--
ALTER TABLE `rapot`
  ADD CONSTRAINT `rapot_ibfk_1` FOREIGN KEY (`kelas_siswa_id`) REFERENCES `kelas_siswa` (`id_kelas_siswa`);

--
-- Ketidakleluasaan untuk tabel `sikap`
--
ALTER TABLE `sikap`
  ADD CONSTRAINT `sikap_ibfk_1` FOREIGN KEY (`rapot_id`) REFERENCES `rapot` (`id_rapot`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD CONSTRAINT `wali_kelas_ibfk_1` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`),
  ADD CONSTRAINT `wali_kelas_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `wali_kelas_ibfk_3` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
