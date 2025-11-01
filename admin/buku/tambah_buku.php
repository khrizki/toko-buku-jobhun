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
  echo "<script>
          localStorage.setItem('suksesTambah', 'true');
          window.location.href = '../admin.php';
        </script>";
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Custom CSS -->
  <style>
    body {
      background: linear-gradient(135deg, #e3f2fd, #fff);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      background: #007bff !important;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .form-container {
      flex-grow: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      backdrop-filter: blur(10px);
      border: none;
      border-radius: 16px;
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .form-label {
      font-weight: 500;
      color: #0d6efd;
    }

    footer {
      background: #007bff;
      color: #fff;
      text-align: center;
      padding: 10px 0;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../../index.php">📚 UNI Bookstore</a>
  </div>
</nav>

<!-- KONTEN -->
<div class="container form-container mt-5 pt-4">
  <div class="card shadow-lg p-4 col-lg-7 col-md-9 col-sm-12 animate__animated animate__fadeInUp">
    <h4 class="text-center text-primary mb-4 fw-semibold">Tambah Buku</h4>
    <form method="POST" id="formTambah">
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
          <input type="number" name="harga" id="hargaInput" class="form-control" required>
          <small class="text-muted" id="hargaPreview">Rp 0</small>
        </div>
        <div class="col-md-6">
          <label class="form-label">Stok</label>
          <input type="number" name="stok" class="form-control" required min="1">
        </div>
        <div class="col-12">
          <label class="form-label">Penerbit</label>
          <select name="id_penerbit" class="form-select" required>
            <option value="">-- Pilih Penerbit --</option>
            <?php while ($p = mysqli_fetch_assoc($penerbit)) { ?>
              <option value="<?= $p['id_penerbit'] ?>"><?= htmlspecialchars($p['nama']) ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="d-flex justify-content-between mt-4">
        <a href="../admin.php" class="btn btn-secondary px-4">← Kembali</a>
        <button type="submit" name="simpan" class="btn btn-success px-4">💾 Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- FOOTER -->
<footer class="mt-auto">
  <p class="mb-0">&copy; <?= date('Y') ?> UNI Bookstore — All Rights Reserved</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS Interaktif -->
<script>
const hargaInput = document.getElementById('hargaInput');
const hargaPreview = document.getElementById('hargaPreview');

// Preview format Rupiah
hargaInput.addEventListener('input', () => {
  const val = hargaInput.value;
  hargaPreview.textContent = "Rp " + new Intl.NumberFormat('id-ID').format(val);
});

// SweetAlert konfirmasi sukses simpan (dari localStorage)
document.addEventListener('DOMContentLoaded', () => {
  if (localStorage.getItem('suksesTambah')) {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: 'Data buku berhasil ditambahkan.',
      showConfirmButton: false,
      timer: 2000
    });
    localStorage.removeItem('suksesTambah');
  }
});

// Validasi input form
document.getElementById('formTambah').addEventListener('submit', (e) => {
  const form = e.target;
  const harga = form.harga.value;
  const stok = form.stok.value;

  if (harga <= 0) {
    e.preventDefault();
    Swal.fire('Oops!', 'Harga harus lebih dari 0', 'warning');
  } else if (stok <= 0) {
    e.preventDefault();
    Swal.fire('Oops!', 'Stok minimal 1', 'warning');
  }
});
</script>
</body>
</html>
