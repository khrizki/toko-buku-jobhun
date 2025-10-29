<?php
include '../../config.php';

// Pastikan ada ID buku yang dikirim
if (!isset($_GET['id'])) {
    header("Location: ../admin.php");
    exit;
}

$id_buku = $_GET['id'];

// Ambil data buku berdasarkan ID
$query = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data buku tidak ditemukan!'); window.location='../admin.php';</script>";
    exit;
}

// Ambil daftar penerbit untuk dropdown
$penerbit = mysqli_query($koneksi, "SELECT * FROM penerbit");

// Proses update data buku
if (isset($_POST['update'])) {
    $id_buku = $_POST['id_buku'];
    $kategori = $_POST['kategori'];
    $nama_buku = $_POST['nama_buku'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $id_penerbit = $_POST['id_penerbit'];

    $update = "UPDATE buku 
               SET kategori='$kategori', 
                   nama_buku='$nama_buku', 
                   harga='$harga', 
                   stok='$stok', 
                   id_penerbit='$id_penerbit' 
               WHERE id_buku='$id_buku'";

    if (mysqli_query($koneksi, $update)) {
        echo "<script>alert('Data buku berhasil diperbarui!'); window.location='../admin.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data buku!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Toko Buku Internal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../../index.php">📚 Toko Buku Internal</a>
  </div>
</nav>

<!-- Form Edit Buku -->
<div class="container my-5 fade-in">
    <div class="card shadow-lg p-4">
        <h3 class="text-center text-primary fw-bold mb-4">Edit Data Buku</h3>

        <form method="POST">
            <input type="hidden" name="id_buku" value="<?= htmlspecialchars($data['id_buku']) ?>">

            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori</label>
                <input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($data['kategori']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Buku</label>
                <input type="text" name="nama_buku" class="form-control" value="<?= htmlspecialchars($data['nama_buku']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= htmlspecialchars($data['harga']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Stok</label>
                <input type="number" name="stok" class="form-control" value="<?= htmlspecialchars($data['stok']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Penerbit</label>
                <select name="id_penerbit" class="form-select" required>
                    <?php while ($p = mysqli_fetch_assoc($penerbit)): ?>
                        <option value="<?= $p['id_penerbit'] ?>" <?= ($p['id_penerbit'] == $data['id_penerbit']) ? 'selected' : '' ?>>
                            <?= $p['nama'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="update" class="btn btn-primary px-4">💾 Simpan Perubahan</button>
                <a href="../admin.php" class="btn btn-secondary px-4">Kembali</a>
            </div>
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
