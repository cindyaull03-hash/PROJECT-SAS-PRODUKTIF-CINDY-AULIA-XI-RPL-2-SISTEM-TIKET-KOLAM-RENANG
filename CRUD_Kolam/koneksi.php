<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "tiket_kolam_renang"
);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>