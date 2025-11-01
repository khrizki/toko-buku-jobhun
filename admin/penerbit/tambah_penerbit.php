<?php
include '../../config.php';

$error = '';
$success = '';

if (isset($_POST['simpan'])) {
  $id = mysqli_real_escape_string($koneksi, $_POST['id_penerbit']);
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
  $kota = mysqli_real_escape_string($koneksi, $_POST['kota']);
  $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);

  // Cek apakah ID sudah ada
  $cek = mysqli_query($koneksi, "SELECT * FROM penerbit WHERE id_penerbit = '$id'");
  if (mysqli_num_rows($cek) > 0) {
    $error = "ID Penerbit <b>$id</b> sudah digunakan!";
  } else {
    // Insert data baru
    $query = "INSERT INTO penerbit (id_penerbit, nama, alamat, kota, telepon)
              VALUES ('$id', '$nama', '$alamat', '$kota', '$telepon')";
    if (mysqli_query($koneksi, $query)) {
      $success = "Data penerbit berhasil disimpan!";
      // Redirect setelah 2 detik
      header("refresh:2; url=../admin.php");
    } else {
      $error = "Terjadi kesalahan: " . mysqli_error($koneksi);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Penerbit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../../index.php">📚 Toko Buku Internal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- Form Tambah Penerbit -->
<div class="container my-5 fade-in">
  <h3 class="text-center text-primary fw-bold mb-4">Tambah Penerbit</h3>

  <div class="card shadow-sm p-4">
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error; ?></div>
    <?php elseif ($success): ?>
      <div class="alert alert-success"><?= $success; ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>ID Penerbit</label>
        <input type="text" name="id_penerbit" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Nama Penerbit</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label>Kota</label>
        <input type="text" name="kota" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Telepon</label>
        <input type="text" name="telepon" class="form-control" required>
      </div>
      <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
      <a href="../admin.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<!-- Footer -->
<footer class="footer bg-primary text-white fixed-bottom shadow-lg">
  <div class="container text-center py-2">
    <p class="mb-0 small">&copy; <?= date('Y') ?> Toko Buku Internal - All Rights Reserved</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
