<?php
include 'config.php';

header('Content-Type: application/json');

// Tangkap keyword pencarian
$keyword = isset($_GET['cari']) ? $_GET['cari'] : '';

$query = "SELECT b.id_buku, b.kategori, b.nama_buku, b.harga, b.stok, p.nama AS penerbit
          FROM buku b
          JOIN penerbit p ON b.id_penerbit = p.id_penerbit";

if (!empty($keyword)) {
    $query .= " WHERE b.nama_buku LIKE '%$keyword%'";
}

$result = mysqli_query($koneksi, $query);
$buku = [];

while ($row = mysqli_fetch_assoc($result)) {
    $buku[] = [
        'id_buku' => $row['id_buku'],
        'kategori' => $row['kategori'],
        'nama_buku' => $row['nama_buku'],
        'harga' => number_format($row['harga'], 0, ',', '.'),
        'stok' => $row['stok'],
        'penerbit' => $row['penerbit']
    ];
}

echo json_encode(['data' => $buku]);
?>
