<?php
include '../../config.php';

// Pastikan ada ID buku
if (!isset($_GET['id'])) {
    header("Location: ../admin.php");
    exit;
}

$id_buku = $_GET['id'];

// Ambil data buku
$stmt = $koneksi->prepare("SELECT * FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id_buku);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Jika tidak ditemukan
if (!$data) {
    echo "<script>alert('Data buku tidak ditemukan!'); window.location='../admin.php';</script>";
    exit;
}

// Ambil daftar penerbit
$penerbit = $koneksi->query("SELECT * FROM penerbit");
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

        <!-- Alert -->
        <div id="alert-container"></div>

        <form id="editForm">
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
                    <?php while ($p = $penerbit->fetch_assoc()): ?>
                        <option value="<?= $p['id_penerbit'] ?>" <?= ($p['id_penerbit'] == $data['id_penerbit']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['nama']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">💾 Simpan Perubahan</button>
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

<script>
// Tangkap form dan kirim lewat JSON
document.getElementById('editForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());

    const alertBox = document.getElementById('alert-container');
    alertBox.innerHTML = ''; // reset alert

    try {
        const res = await fetch('update_buku_api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await res.json();

        if (result.success) {
            alertBox.innerHTML = `<div class="alert alert-success">✅ ${result.message}</div>`;
        } else {
            alertBox.innerHTML = `<div class="alert alert-danger">❌ ${result.message}</div>`;
        }
    } catch (error) {
        alertBox.innerHTML = `<div class="alert alert-danger">⚠️ Terjadi kesalahan: ${error.message}</div>`;
    }
});
</script>

</body>
</html>
