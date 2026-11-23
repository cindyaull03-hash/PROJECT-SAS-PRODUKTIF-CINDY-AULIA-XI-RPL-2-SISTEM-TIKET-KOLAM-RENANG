<?php
include 'koneksi.php';
$id = isset($_GET['id']) ? (int)($_GET['id']) : 0;
if($id > 0) {
    // Menggunakan tb_tiket
    $stmt = mysqli_prepare($koneksi, 'DELETE FROM tb_tiket WHERE id_tiket = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}
header('Location: tampiltiket.php');
exit;
?>