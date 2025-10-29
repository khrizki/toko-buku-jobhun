<?php
include '../../config.php';

// proses simpan data
if (isset($_POST['simpan'])) {
  $id = $_POST['id_buku'];
  $kategori = $_POST['kategori'];
  $nama = $_POST['nama_buku'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $id_penerbit = $_POST['id_penerbit'];

  mysqli_query($koneksi, "INSERT INTO buku VALUES('$id','$kategori','$nama','$harga','$stok','$id_penerbit')");
  header("Location: ../admin.php");
  exit;
}

// ambil data penerbit untuk dropdown
$penerbit = mysqli_query($koneksi, "SELECT * FROM penerbit");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Buku | UNI Bookstore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../../index.php">📚 UNI Bookstore</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
  </div>
</nav>

<!-- KONTEN UTAMA -->
<div class="container form-container mt-5 pt-4">
  <div class="card shadow-lg p-4 rounded-4 mt-5">
    <h4 class="text-center text-primary mb-4 fw-semibold">Tambah Buku</h4>
    <form method="POST">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">ID Buku</label>
          <input type="text" name="id_buku" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Kategori</label>
          <input type="text" name="kategori" class="form-control" required>
        </div>
        <div class="col-12">
          <label class="form-label">Nama Buku</label>
          <input type="text" name="nama_buku" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Harga</label>
          <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Stok</label>
          <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="col-12">
          <label class="form-label">Penerbit</label>
          <select name="id_penerbit" class="form-select">
            <?php while ($p = mysqli_fetch_assoc($penerbit)) { ?>
              <option value="<?= $p['id_penerbit'] ?>"><?= $p['nama'] ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="d-flex justify-content-between mt-4">
        <a href="../admin.php" class="btn btn-secondary px-4">Kembali</a>
        <button type="submit" name="simpan" class="btn btn-success px-4">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- FOOTER -->
<footer class="footer bg-primary text-white text-center py-3 fixed-bottom">
  <p class="mb-0">&copy; <?= date('Y') ?> UNI Bookstore — All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
