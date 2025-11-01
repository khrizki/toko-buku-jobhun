<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toko Buku Internal</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">📚 Toko Buku Internal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="admin/admin.php">Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="pengadaan/pengadaan.php">Pengadaan</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container mt-5 mb-5">
  <div class="card p-4 shadow-lg fade-in">
    <h3 class="mb-4 text-center fw-semibold text-primary">📖 Daftar Buku</h3>

    <!-- Search Bar -->
    <div class="mb-4 d-flex justify-content-center">
      <input type="text" id="searchInput" class="form-control form-control-lg w-50 rounded-pill shadow-sm" placeholder="🔍 Ketik nama buku untuk mencari...">
    </div>

    <!-- Loader -->
    <div id="loader" class="text-center my-5 d-none">
      <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
      <p class="mt-3 text-secondary">Memuat data buku...</p>
    </div>

    <!-- Table -->
    <div class="table-responsive">
      <table class="table table-hover align-middle text-center" id="bukuTable">
        <thead class="table-primary rounded-top">
          <tr>
            <th>ID Buku</th>
            <th>Kategori</th>
            <th>Nama Buku</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Penerbit</th>
          </tr>
        </thead>
        <tbody id="dataBuku"></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="footer text-center py-3 mt-auto">
  <p class="mb-0">&copy; <?= date('Y') ?> Toko Buku Internal — <span class="fw-semibold">All Rights Reserved</span></p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="assets/script.js"></script>
</body>
</html>
