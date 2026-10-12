<?php require 'config.php'; wajib_login();
if ($_SESSION['role']!=='admin') die('Khusus admin');
if (isset($_GET['hapus'])) { $db->query("DELETE FROM users WHERE id=".(int)$_GET['hapus']); }
banner(); ?>
<h2>👥 Kelola Akun</h2>
<div class="card"><table><thead><tr><th>ID</th><th>Username</th><th>Nama</th><th>Peran</th><th></th></tr></thead><tbody>
<?php $r = $db->query("SELECT * FROM users"); while ($u = $r->fetch_assoc()): ?>
<tr><td><?= (int)$u['id'] ?></td><td><?= htmlspecialchars($u['username']) ?></td><td><?= htmlspecialchars($u['nama']) ?></td>
<td><span class="badge <?= $u['role'] ?>"><?= $u['role'] ?></span></td>
<td><a class="btn sm red" href="?hapus=<?= (int)$u['id'] ?>" onclick="return confirm('Hapus akun ini?')">Hapus</a></td></tr>
<?php endwhile; ?></tbody></table></div>
<a class="back" href="index.php">← Kembali</a>
