<?php require 'config.php'; wajib_login(); $pesan='';
if (isset($_FILES['berkas']) && $_FILES['berkas']['error'] === UPLOAD_ERR_OK) {
  // [FIX 4] Whitelist ekstensi + cek MIME + batas ukuran + nama acak
  $boleh = ['pdf'=>'application/pdf','docx'=>'application/vnd.openxmlformats-officedocument.wordprocessingml.document','txt'=>'text/plain'];
  $ext = strtolower(pathinfo($_FILES['berkas']['name'], PATHINFO_EXTENSION));
  $mime = mime_content_type($_FILES['berkas']['tmp_name']);
  if (!isset($boleh[$ext]) || $_FILES['berkas']['size'] > 2*1024*1024 || ($ext!=='docx' && $mime!==$boleh[$ext])) {
    $pesan = '<div class="alert err">⛔ Berkas ditolak (hanya pdf/docx/txt, maks 2 MB)</div>';
  } else {
    $baru = bin2hex(random_bytes(8)).".$ext";
    move_uploaded_file($_FILES['berkas']['tmp_name'], "uploads/$baru");
    $stmt = $db->prepare("INSERT INTO tugas (mahasiswa_id,nama_file) VALUES (?,?)");
    $stmt->bind_param('is', $_SESSION['uid'], $baru); $stmt->execute();
    $pesan = '<div class="alert ok">✅ Terunggah</div>';
  }
}
banner(); ?>
<h2>📤 Unggah Tugas</h2>
<div class="card">
  <?= $pesan ?>
  <form method="post" enctype="multipart/form-data">
    <label>Pilih berkas (pdf/docx/txt, maks 2 MB)</label><input type="file" name="berkas">
    <button>Unggah</button>
  </form>
</div>
<a class="back" href="index.php">← Kembali</a>
