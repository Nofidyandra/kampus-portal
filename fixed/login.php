<?php require 'config.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // [FIX 1] Prepared statement mencegah SQL injection
  $stmt = $db->prepare("SELECT id, role, nama FROM users WHERE username=? AND password=?");
  $stmt->bind_param('ss', $_POST['username'], $_POST['password']);
  $stmt->execute();
  if ($row = $stmt->get_result()->fetch_assoc()) {
    session_regenerate_id(true);
    $_SESSION['uid'] = $row['id']; $_SESSION['role'] = $row['role']; $_SESSION['nama'] = $row['nama'];
    header('Location: index.php'); exit;
  }
  $err = 'Username atau password salah';
}
banner(); ?>
<div class="card">
  <div class="logo">🛡️</div>
  <h2>Portal Kampus (Aman)</h2>
  <p class="sub">Versi yang sudah diperbaiki</p>
  <?php if ($err): ?><div class="alert err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <form method="post">
    <label>Username</label><input name="username" autocomplete="off">
    <label>Password</label><input name="password" type="password">
    <button class="block">Masuk</button>
  </form>
</div>
