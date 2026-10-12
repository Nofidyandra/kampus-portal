<?php require 'config.php'; wajib_login(); banner(); $role = $_SESSION['role']; ?>
<section class="hero">
  <h1>Halo, <?= htmlspecialchars($_SESSION['nama']) ?> 👋</h1>
  <p>Masuk sebagai <span class="badge <?= $role ?>"><?= $role ?></span></p>
</section>
<div class="grid">
  <a class="card menu" href="nilai.php?id=<?= (int)$_SESSION['uid'] ?>"><span class="ico">📊</span><h3>Nilai</h3><p>Lihat nilai mata kuliah</p></a>
  <a class="card menu" href="upload.php"><span class="ico">📤</span><h3>Unggah Tugas</h3><p>Kirim berkas tugas</p></a>
  <a class="card menu" href="diskusi.php"><span class="ico">💬</span><h3>Diskusi</h3><p>Forum tanya jawab kelas</p></a>
  <?php if ($role==='dosen'): ?><a class="card menu" href="beri_nilai.php"><span class="ico">✍️</span><h3>Beri Nilai</h3><p>Input nilai mahasiswa</p></a><?php endif; ?>
  <?php if ($role==='admin'): ?><a class="card menu" href="admin.php"><span class="ico">👥</span><h3>Kelola Akun</h3><p>Lihat dan hapus akun</p></a><?php endif; ?>
</div>
