<?php require 'config.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = $_POST['username']; $p = $_POST['password'];
  // [VULN 1] SQL Injection: input digabung langsung ke query
  $r = $db->query("SELECT * FROM users WHERE username='$u' AND password='$p'");
  if ($r && $row = $r->fetch_assoc()) {
    $_SESSION['uid'] = $row['id']; $_SESSION['role'] = $row['role']; $_SESSION['nama'] = $row['nama'];
    header('Location: index.php'); exit;
  }
  $err = 'Username atau password salah';
}
banner(); ?>
<div class="card">
  <div class="logo">🎓</div>
  <h2>Portal Kampus</h2>
  <p class="sub">Masuk untuk melanjutkan</p>
  <?php if ($err): ?><div class="alert err"><?= $err ?></div><?php endif; ?>
  <form method="post">
    <label>Username</label><input name="username" autocomplete="off">
    <label>Password</label><input name="password" type="password">
    <button class="block">Masuk</button>
  </form>
  <div class="hint">Akun uji: <b>mhs1</b> / mhs123 &nbsp;·&nbsp; <b>dosen1</b> / dosen123 &nbsp;·&nbsp; <b>admin</b> / admin123</div>
</div>
