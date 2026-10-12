<?php require 'config.php'; wajib_login();
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $stmt = $db->prepare("INSERT INTO komentar (user_id,isi) VALUES (?,?)");
  $stmt->bind_param('is', $_SESSION['uid'], $_POST['isi']); $stmt->execute();
}
banner(); ?>
<h2>💬 Diskusi Kelas</h2>
<div class="card"><form method="post">
  <label>Tulis komentar</label><textarea name="isi" placeholder="Bagikan pertanyaan atau pendapatmu..."></textarea>
  <button>Kirim</button>
</form></div>
<?php
$r = $db->query("SELECT u.nama, k.isi, k.waktu FROM komentar k JOIN users u ON u.id=k.user_id ORDER BY k.id DESC");
// [FIX 3] Escape output agar tag HTML/JS tidak dieksekusi
while ($row = $r->fetch_assoc()) { ?>
<div class="card post"><span class="avatar"><?= htmlspecialchars(strtoupper(substr($row['nama'],0,1))) ?></span>
  <div class="body"><div class="meta"><b><?= htmlspecialchars($row['nama']) ?></b> · <?= $row['waktu'] ?></div><div><?= nl2br(htmlspecialchars($row['isi'])) ?></div></div></div>
<?php } ?>
<a class="back" href="index.php">← Kembali</a>
