CREATE DATABASE IF NOT EXISTS portal_kampus;
USE portal_kampus;
DROP TABLE IF EXISTS komentar, tugas, nilai, users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE,
  password VARCHAR(100),          -- sengaja plaintext (data fiktif)
  nama VARCHAR(100),
  nim VARCHAR(20) UNIQUE,
  email VARCHAR(100) UNIQUE,
  role ENUM('mahasiswa','dosen','admin')
);
CREATE TABLE nilai (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT, matkul VARCHAR(100), nilai INT
);
CREATE TABLE tugas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT, nama_file VARCHAR(255), waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE komentar (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT, isi TEXT, waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO users (username,password,nama,nim,email,role) VALUES
('admin','admin123','Admin Portal',NULL,'admin@portal.test','admin'),
('dosen1','dosen123','Dr. Fiktif Satu',NULL,'dosen1@portal.test','dosen'),
('mhs1','mhs123','Andi Fiktif','2024001','andi@portal.test','mahasiswa'),
('mhs2','mhs456','Budi Fiktif','2024002','budi@portal.test','mahasiswa'),
('mhs3','mhs789','Citra Fiktif','2024003','citra@portal.test','mahasiswa');
INSERT INTO nilai (mahasiswa_id,matkul,nilai) VALUES
(3,'Basis Data',85),(3,'Pemrograman Web',90),
(4,'Basis Data',70),(4,'Pemrograman Web',78),
(5,'Basis Data',92),(5,'Pemrograman Web',88);
