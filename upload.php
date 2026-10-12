<?php require 'config.php'; wajib_login(); $pesan='';
if (isset($_FILES['berkas']) && $_FILES['berkas']['error']===UPLOAD_ERR_OK) {
  // [VULN 4] Validasi berkas lemah: ekstensi/tipe tidak dicek
  $nama = basename($_FILES['berkas']['name']);
  move_uploaded_file($_FILES['berkas']['tmp_name'], "uploads/$nama");
  $n = $db->real_escape_string($nama);
  $db->query("INSERT INTO tugas (mahasiswa_id,nama_file) VALUES ({$_SESSION['uid']},'$n')");
  $pesan = '<div class="alert ok">✅ Terunggah: '.htmlspecialchars($nama).'</div>';
}
banner(); ?>
<h2>📤 Unggah Tugas</h2>
<div class="card">
  <?= $pesan ?>
  <form method="post" enctype="multipart/form-data">
    <label>Pilih berkas tugas</label><input type="file" name="berkas">
    <button>Unggah</button>
  </form>
</div>
<a class="back" href="index.php">← Kembali</a>
