<?php require 'config.php'; wajib_login(); banner();
$id = $_GET['id'];
// [VULN 2] IDOR: tidak dicek apakah $id milik user yang login
$r = $db->query("SELECT u.nama, n.matkul, n.nilai FROM nilai n JOIN users u ON u.id=n.mahasiswa_id WHERE n.mahasiswa_id=$id");
?>
<h2>📊 Nilai Mata Kuliah</h2>
<div class="card">
<table><thead><tr><th>Nama</th><th>Mata Kuliah</th><th>Nilai</th></tr></thead><tbody>
<?php $ada=false; while ($row = $r->fetch_assoc()) { $ada=true; $n=(int)$row['nilai']; $g=$n>=85?'g-a':($n>=75?'g-b':'g-c'); ?>
<tr><td><?= $row['nama'] ?></td><td><?= $row['matkul'] ?></td><td><span class="badge <?= $g ?>"><?= $n ?></span></td></tr>
<?php } ?>
</tbody></table>
<?php if(!$ada): ?><div class="empty">Belum ada nilai.</div><?php endif; ?>
</div>
<a class="back" href="index.php">← Kembali</a>
