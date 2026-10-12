<?php require 'config.php'; wajib_login();
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $isi = $db->real_escape_string($_POST['isi']);
  $db->query("INSERT INTO komentar (user_id,isi) VALUES ({$_SESSION['uid']}, '$isi')");
}
banner(); ?>
<h2>💬 Diskusi Kelas</h2>
<div class="card"><form method="post">
  <label>Tulis komentar</label><textarea name="isi" placeholder="Bagikan pertanyaan atau pendapatmu..."></textarea>
  <button>Kirim</button>
</form></div>
<?php
$r = $db->query("SELECT u.nama, k.isi, k.waktu FROM komentar k JOIN users u ON u.id=k.user_id ORDER BY k.id DESC");
// [VULN 3] Stored XSS: isi komentar ditampilkan tanpa htmlspecialchars
while ($row = $r->fetch_assoc()) { ?>
<div class="card post"><span class="avatar"><?= strtoupper(substr($row['nama'],0,1)) ?></span>
  <div class="body"><div class="meta"><b><?= $row['nama'] ?></b> · <?= $row['waktu'] ?></div><div><?= $row['isi'] ?></div></div></div>
<?php } ?>
<a class="back" href="index.php">← Kembali</a>
