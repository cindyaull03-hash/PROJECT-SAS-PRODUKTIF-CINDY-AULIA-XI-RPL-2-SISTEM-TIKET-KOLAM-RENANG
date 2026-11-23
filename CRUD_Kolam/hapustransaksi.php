<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $query = "DELETE FROM tb_transaksi WHERE id_transaksi = '$id'";
    mysqli_query($koneksi, $query);
}

header("Location: tampiltransaksi.php");
exit;
?>