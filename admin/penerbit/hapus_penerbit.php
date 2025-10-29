<?php
include '../../config.php';

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  mysqli_query($koneksi, "DELETE FROM penerbit WHERE id_penerbit = '$id'");
}

header("Location: ../admin.php");
exit;
?>
