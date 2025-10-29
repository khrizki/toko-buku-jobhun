<?php
include '../config.php';

// Ambil data buku
$buku = mysqli_query($koneksi, "SELECT b.*, p.nama AS penerbit 
                                FROM buku b 
                                JOIN penerbit p ON b.id_penerbit = p.id_penerbit");

// Ambil data penerbit
$penerbit = mysqli_query($koneksi, "SELECT * FROM penerbit");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Toko Buku Internal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../index.php">📚 Toko Buku Internal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="admin.php">Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="../pengadaan/pengadaan.php">Pengadaan</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container my-5 fade-in">
  <h3 class="text-center text-primary fw-bold mb-4">Kelola Data Buku & Penerbit</h3>

  <!-- Tabs -->
  <ul class="nav nav-tabs mb-4" id="adminTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="buku-tab" data-bs-toggle="tab" data-bs-target="#buku" type="button">
      📘 Data Buku
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="penerbit-tab" data-bs-toggle="tab" data-bs-target="#penerbit" type="button">
      🏢 Data Penerbit
    </button>
  </li>
</ul>


  <div class="tab-content">
    <!-- Tab Data Buku -->
    <div class="tab-pane fade show active" id="buku">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Daftar Buku</h5>
        <a href="buku/tambah_buku.php" class="btn btn-success btn-sm">+ Tambah Buku</a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
          <thead class="table-primary">
            <tr>
              <th>ID Buku</th>
              <th>Kategori</th>
              <th>Nama Buku</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Penerbit</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($b = mysqli_fetch_assoc($buku)): ?>
            <tr>
              <td><?= htmlspecialchars($b['id_buku']) ?></td>
              <td><?= htmlspecialchars($b['kategori']) ?></td>
              <td class="text-start"><?= htmlspecialchars($b['nama_buku']) ?></td>
              <td>Rp <?= number_format($b['harga'], 0, ',', '.') ?></td>
              <td><?= $b['stok'] ?></td>
              <td><?= htmlspecialchars($b['penerbit']) ?></td>
              <td>
                <a href="buku/edit_buku.php?id=<?= urlencode($b['id_buku']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="buku/hapus_buku.php?id=<?= urlencode($b['id_buku']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Tab Data Penerbit -->
    <div class="tab-pane fade" id="penerbit">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Daftar Penerbit</h5>
        <a href="penerbit/tambah_penerbit.php" class="btn btn-success btn-sm">+ Tambah Penerbit</a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
          <thead class="table-primary">
            <tr>
              <th>ID Penerbit</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Kota</th>
              <th>Telepon</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($p = mysqli_fetch_assoc($penerbit)): ?>
            <tr>
              <td><?= htmlspecialchars($p['id_penerbit']) ?></td>
              <td><?= htmlspecialchars($p['nama']) ?></td>
              <td><?= htmlspecialchars($p['alamat']) ?></td>
              <td><?= htmlspecialchars($p['kota']) ?></td>
              <td><?= htmlspecialchars($p['telepon']) ?></td>
              <td>
                <a href="penerbit/edit_penerbit.php?id=<?= urlencode($p['id_penerbit']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="penerbit/hapus_penerbit.php?id=<?= urlencode($p['id_penerbit']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus penerbit ini?')">Hapus</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
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
