<?php
include '../config.php';

// Ambil data buku dengan stok <= 20 (karena di atas itu dianggap aman)
$query = "
  SELECT b.nama_buku, p.nama AS penerbit, b.stok
  FROM buku b
  JOIN penerbit p ON b.id_penerbit = p.id_penerbit
  WHERE b.stok <= 20
  ORDER BY b.stok ASC
";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Kebutuhan Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
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
        <li class="nav-item"><a class="nav-link" href="../admin/admin.php">Admin</a></li>
        <li class="nav-item"><a class="nav-link active" href="pengadaan.php">Pengadaan</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Konten Utama -->
<div class="container my-5 fade-in">
  <h3 class="text-center text-primary fw-bold mb-4">📦 Laporan Kebutuhan Buku</h3>

  <div class="card p-4 shadow-sm">
    <h5 class="text-secondary mb-3">Daftar Buku dengan Stok Paling Sedikit</h5>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Nama Penerbit</th>
            <th>Sisa Stok</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              if ($row['stok'] <= 10) {
                $status = "<span class='badge bg-danger'>Segera Dipesan</span>";
              } elseif ($row['stok'] <= 20) {
                $status = "<span class='badge bg-warning text-dark'>Perlu Pengadaan</span>";
              } else {
                $status = "<span class='badge bg-success'>Stok Aman</span>";
              }

              echo "
              <tr>
                <td>{$no}</td>
                <td class='text-start'>{$row['nama_buku']}</td>
                <td>{$row['penerbit']}</td>
                <td>{$row['stok']}</td>
                <td>{$status}</td>
              </tr>";
              $no++;
            }
          } else {
            echo "<tr><td colspan='5' class='text-center text-muted'>Semua stok buku masih aman 📘</td></tr>";
          }
          ?>
        </tbody>
      </table>
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
