<?php
include '../../config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = "DELETE FROM buku WHERE id_buku = '$id'";
    mysqli_query($koneksi, $query);
}

header("Location: ../admin.php");
exit;
?>
