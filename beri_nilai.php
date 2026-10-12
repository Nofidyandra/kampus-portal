<?php require 'config.php'; wajib_login();
if ($_SESSION['role']!=='dosen') die('Khusus dosen');
$pesan='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $stmt = $db->prepare("INSERT INTO nilai (mahasiswa_id,matkul,nilai) VALUES (?,?,?)");
  $stmt->bind_param('isi', $_POST['mid'], $_POST['matkul'], $_POST['nilai']); $stmt->execute();
  $pesan='<div class="alert ok">✅ Nilai tersimpan</div>';
}
banner(); ?>
<h2>✍️ Beri Nilai</h2>
<div class="card"><?= $pesan ?>
<form method="post"><div class="row">
  <div><label>ID Mahasiswa</label><input name="mid" placeholder="3"></div>
  <div><label>Mata Kuliah</label><input name="matkul"></div>
  <div><label>Nilai</label><input name="nilai" type="number" min="0" max="100"></div>
</div><button>Simpan</button></form></div>
<a class="back" href="index.php">← Kembali</a>
