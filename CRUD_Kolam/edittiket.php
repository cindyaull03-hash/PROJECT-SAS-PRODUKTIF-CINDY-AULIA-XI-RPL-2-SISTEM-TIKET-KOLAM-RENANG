<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Menggunakan tb_tiket
$stmt = mysqli_prepare($koneksi, "SELECT * FROM tb_tiket WHERE id_tiket = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$tiket = mysqli_fetch_assoc($result);

if (!$tiket) {
    die("Data tiket tidak ditemukan.");
}

$error = "";

if (isset($_POST['ubah'])) {
    $id_tiket = trim($_POST['id_tiket']);
    $kategori = trim($_POST['kategori']);
    $harga    = trim($_POST['harga']);

    if (empty($id_tiket) || empty($kategori) || empty($harga)) {
        $error = "Semua kolom wajib diisi!";
    } else {
        // Menggunakan tb_tiket
        $stmt_update = mysqli_prepare($koneksi, "UPDATE tb_tiket SET id_tiket = ?, kategori = ?, harga = ? WHERE id_tiket = ?");
        mysqli_stmt_bind_param($stmt_update, 'sssi', $id_tiket, $kategori, $harga, $id);
        
        if (mysqli_stmt_execute($stmt_update)) {
            header("Location: tampiltiket.php");
            exit();
        } else {
            $error = "Gagal memperbarui data tiket!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Tiket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Edit Data Tiket</h2>

        <?php if (!empty($error)) : ?>
            <div class="bg-blue-100 border border-blue-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">id_tiket</label>
                <input type="text" name="id_tiket" value="<?= htmlspecialchars($tiket['id_tiket']); ?>" required 
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">kategori</label>
                <input type="text" name="kategori" value="<?= htmlspecialchars($tiket['kategori']); ?>" required 
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">harga</label>
                <input type="text" name="harga" value="<?= htmlspecialchars($tiket['harga']); ?>" required 
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:border-blue-500">
            </div>

            <div class="flex items-center justify-end space-x-2 pt-2">
                <a href="tampiltiket.php" class="bg-gray-500 text-white px-4 py-2 rounded text-sm hover:bg-gray-600">Batal</a>
                <button type="submit" name="ubah" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>