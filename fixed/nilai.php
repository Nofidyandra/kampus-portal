<?php require 'config.php'; wajib_login();
$id = (int)($_GET['id'] ?? 0);
// [FIX 2] Mahasiswa hanya boleh melihat nilainya sendiri; dosen/admin boleh semua
if ($_SESSION['role'] === 'mahasiswa' && $id !== (int)$_SESSION['uid']) { http_response_code(403); banner(); die('<div class="alert err">⛔ Akses ditolak</div>'); }
$stmt = $db->prepare("SELECT u.nama, n.matkul, n.nilai FROM nilai n JOIN users u ON u.id=n.mahasiswa_id WHERE n.mahasiswa_id=?");
$stmt->bind_param('i', $id); $stmt->execute(); $r = $stmt->get_result();
banner(); ?>
<h2>📊 Nilai Mata Kuliah</h2>
<div class="card">
<table><thead><tr><th>Nama</th><th>Mata Kuliah</th><th>Nilai</th></tr></thead><tbody>
<?php $ada=false; while ($row = $r->fetch_assoc()) { $ada=true; $n=(int)$row['nilai']; $g=$n>=85?'g-a':($n>=75?'g-b':'g-c'); ?>
<tr><td><?= htmlspecialchars($row['nama']) ?></td><td><?= htmlspecialchars($row['matkul']) ?></td><td><span class="badge <?= $g ?>"><?= $n ?></span></td></tr>
<?php } ?>
</tbody></table>
<?php if(!$ada): ?><div class="empty">Belum ada nilai.</div><?php endif; ?>
</div>
<a class="back" href="index.php">← Kembali</a>
