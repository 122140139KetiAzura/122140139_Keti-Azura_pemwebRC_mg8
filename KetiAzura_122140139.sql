-- Buat database
CREATE DATABASE IF NOT EXISTS example_db;

-- Pilih database
USE example_db;

-- Buat tabel
CREATE TABLE IF NOT EXISTS data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    alamat VARCHAR(255) NOT NULL
);

-- Tambah data contoh
INSERT INTO data (nama, alamat) VALUES
('Ahmad', 'Jakarta'),
('Budi', 'Bandung'),
('Citra', 'Surabaya'),
('Diana', 'Yogyakarta'),
('Eka', 'Medan'),
('Fajar', 'Balikpapan'),
('Gita', 'Makassar'),
('Hadi', 'Palembang'),
('Ika', 'Pontianak'),
('Joko', 'Denpasar'),
('Kiki', 'Batam'),
('Lina', 'Malang');
