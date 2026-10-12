<?php
define('CSS_PATH','../style.css');
session_start();
$db = new mysqli('localhost', 'root', '', 'portal_kampus');
if ($db->connect_error) die('Koneksi gagal');
function wajib_login() { if (!isset($_SESSION['uid'])) { header('Location: login.php'); exit; } }
function banner() {
  $in = isset($_SESSION['uid']);
  echo '<!DOCTYPE html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Portal Kampus</title><link rel="stylesheet" href="'.CSS_PATH.'"></head><body class="'.($in?'':'auth').'">';
  echo '<div class="banner">⚠ Aplikasi LATIHAN, SENGAJA RENTAN, semua data fiktif. Jangan dipakai untuk data asli.</div>';
  if ($in) {
    $nama = htmlspecialchars($_SESSION['nama']); $role = $_SESSION['role'];
    echo '<nav class="nav"><div class="nav-in"><a class="brand" href="index.php">🎓 Portal Kampus</a>';
    echo '<a class="lk" href="index.php">Beranda</a>';
    echo '<a class="lk" href="nilai.php?id='.(int)$_SESSION['uid'].'">Nilai</a>';
    echo '<a class="lk" href="upload.php">Tugas</a><a class="lk" href="diskusi.php">Diskusi</a>';
    if ($role==='dosen') echo '<a class="lk" href="beri_nilai.php">Beri Nilai</a>';
    if ($role==='admin') echo '<a class="lk" href="admin.php">Kelola Akun</a>';
    echo '<span class="spacer"></span><span class="chip"><span class="avatar">'.mb_strtoupper(mb_substr($nama,0,1)).'</span><span class="n">'.$nama.'</span></span>';
    echo '<a class="lk" href="logout.php">Keluar</a></div></nav>';
  }
  echo '<main class="wrap">';
}
