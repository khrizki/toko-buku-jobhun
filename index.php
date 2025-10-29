<?php
include 'config.php';

// Tangkap keyword pencarian (jika ada)
$keyword = isset($_GET['cari']) ? $_GET['cari'] : '';

// Query data buku
$query = "SELECT b.id_buku, b.kategori, b.nama_buku, b.harga, b.stok, p.nama AS penerbit
          FROM buku b
          JOIN penerbit p ON b.id_penerbit = p.id_penerbit";

if (!empty($keyword)) {
    $query .= " WHERE b.nama_buku LIKE '%$keyword%'";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toko Buku Internal</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">📚 Toko Buku Internal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="admin/admin.php">Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="pengadaan/pengadaan.php">Pengadaan</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container mt-5 mb-5 fade-in">
  <div class="card p-4 shadow-sm">
    <h3 class="mb-4 text-center fw-semibold text-primary">Daftar Buku</h3>

    <!-- Form Pencarian -->
    <div class="mb-4 d-flex justify-content-center">
      <input type="text" id="searchInput" class="form-control w-50" placeholder="Cari Nama Buku..." value="<?= htmlspecialchars($keyword) ?>">
    </div>

    <!-- Tabel Buku -->
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle text-center">
        <thead class="table-primary">
          <tr>
            <th>ID Buku</th>
            <th>Kategori</th>
            <th>Nama Buku</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Penerbit</th>
          </tr>
        </thead>
        <tbody id="dataBuku">
          <?php
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>
                      <td>{$row['id_buku']}</td>
                      <td>{$row['kategori']}</td>
                      <td class='text-start'>{$row['nama_buku']}</td>
                      <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                      <td>{$row['stok']}</td>
                      <td>{$row['penerbit']}</td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='6' class='text-center text-muted'>Data tidak ditemukan</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="footer fixed-bottom">
  <p class="mb-0">&copy; <?= date('Y') ?> Toko Buku Internal - All Rights Reserved</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script pencarian otomatis -->
<script>
let typingTimer;
const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("keyup", function() {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(() => {
    const keyword = searchInput.value.trim();
    const url = "index.php?cari=" + encodeURIComponent(keyword);
    window.location.href = url;
  }, 1000); // jeda 1 detik setelah berhenti mengetik
});
</script>

</body>
</html>
