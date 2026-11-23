<?php
include 'koneksi.php';

$err_id = "";
$err_kategori = "";

if (isset($_POST['submit'])) {
    $id_tiket = $_POST['id_tiket'] ?? "";
    $kategori = $_POST['kategori'] ?? "";
    $harga    = $_POST['harga'] ?? "";

    $valid = true;

    if (!preg_match("/^[0-9]+$/", $id_tiket)) {
        $err_id = "id hanya boleh berisi angka!";
        $valid = false;
    }

    if (empty($kategori)) {
        $err_kategori = "Kategori tidak boleh kosong!";
        $valid = false;
    } 

    if ($valid) {
        // Menggunakan tb_tiket
        $stmt = mysqli_prepare($koneksi, "INSERT INTO tb_tiket (id_tiket, kategori, harga) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sss', $id_tiket, $kategori, $harga);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Data tiket berhasil disimpan!');
                    window.location.href = 'tampiltiket.php';
                  </script>";
            exit();
        } else {
            echo "Gagal query: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tiket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cyan-100 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Data Tiket</h2>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">id_tiket</label>
                <input type="text" name="id_tiket" value="<?= isset($_POST['id_tiket']) ? htmlspecialchars($_POST['id_tiket']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2">
                <?php if (!empty($err_id)) : ?>
                    <p class="text-red-500 text-xs mt-1"><?= $err_id; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">kategori</label>
                <input type="text" name="kategori" value="<?= isset($_POST['kategori']) ? htmlspecialchars($_POST['kategori']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2">
                <?php if (!empty($err_kategori)) : ?>
                    <p class="text-red-500 text-xs mt-1"><?= $err_kategori; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">harga</label>
                <input type="text" name="harga" value="<?= isset($_POST['harga']) ? htmlspecialchars($_POST['harga']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2">
            </div>

            <div class="flex items-center justify-end space-x-2 pt-2">
                <a href="tampiltiket.php" class="bg-gray-500 text-white px-4 py-2 rounded text-sm hover:bg-gray-600">Batal</a>
                <button type="submit" name="submit" class="bg-blue-300 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 cursor-pointer">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>