<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id_user      = trim($_POST['id_user']);
    $id_tiket     = trim($_POST['id_tiket']);
    $jumlah_tiket = trim($_POST['jumlah_tiket']);
    $total_harga  = trim($_POST['total_harga']);

    $query = "INSERT INTO tb_transaksi (id_user, id_tiket, jumlah_tiket, total_harga) VALUES ('$id_user', '$id_tiket', '$jumlah_tiket', '$total_harga')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: tampiltransaksi.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Data Transaksi</h2>
        <form action="" method="POST" class="space-y-4">
             
            <div>
                <label class="block text-sm font-medium text-gray-700">ID User:</label>
                <input type="text" name="id_user" required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:outline-none focus:border-blue-500" 
                    placeholder="Ketik ID User...">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">ID Tiket:</label>
                <input type="text" name="id_tiket" required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:outline-none focus:border-blue-500" 
                    placeholder="Ketik ID Tiket...">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Jumlah Tiket:</label>
                <input type="number" name="jumlah_tiket" required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:outline-none focus:border-blue-500" 
                    placeholder="Ketik jumlah tiket...">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Total Harga:</label>
                <input type="number" name="total_harga" required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:outline-none focus:border-blue-500" 
                    placeholder="Ketik total harga...">
            </div>

            <div class="flex justify-end space-x-2 pt-2">
                <a href="tampiltransaksi.php" class="bg-gray-500 text-white px-4 py-2 rounded text-sm hover:bg-gray-600">Batal</a>
                <button type="submit" name="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">Simpan Data</button>
            </div>
        </form>
    </div>
</body>
</html>