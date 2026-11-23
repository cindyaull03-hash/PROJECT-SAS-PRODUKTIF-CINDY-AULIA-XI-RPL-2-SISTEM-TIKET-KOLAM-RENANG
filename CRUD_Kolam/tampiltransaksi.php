<?php
    include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendataan Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cyan-100 p-8">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Pendataan Transaksi</h2>
        <div class="flex justify-between items-center mb-4">
            <a href="index.php" class="bg-blue-300 text-white px-4 py-2 rounded hover:bg-purple-300 text-sm">&laquo; Kembali ke Menu Utama</a>
            <a href="tambahtransaksi.php" class="bg-blue-300 text-white px-4 py-2 rounded hover:bg-purple-300 text-sm">+ Tambah Data Transaksi</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="border border-gray-300 p-2">No</th>
                        <th class="border border-gray-300 p-2">id transaksi</th>
                        <th class="border border-gray-300 p-2">id user</th>
                        <th class="border border-gray-300 p-2">id tiket</th>
                        <th class="border border-gray-300 p-2">jumlah tiket</th>
                        <th class="border border-gray-300 p-2">total harga</th>
                        <th class="border border-gray-300 p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query join yang aman dan sesuai relasi tabel
                    $query = mysqli_query($koneksi, "SELECT * FROM tb_transaksi 
                        LEFT JOIN tb_tiket ON tb_transaksi.id_tiket = tb_tiket.id_tiket 
                        LEFT JOIN tb_user ON tb_transaksi.id_user = tb_user.id_user");
                    
                    if (!$query) {
                        die("Query Error: " . mysqli_error($koneksi));
                    }

                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr class='hover:bg-gray-50'>";
                        echo "<td class='border border-gray-300 p-2'>" . $no++ . "</td>";
                        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['id_transaksi']) . "</td>";
                        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['id_user']) . "</td>";
                        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['id_tiket']) . "</td>";
                        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['jumlah_tiket']) . "</td>";
                        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['total_harga']) . "</td>";
                        echo "<td class='border border-gray-300 p-2 space-x-2'>";
                        echo "<a href='edittransaksi.php?id=" . $row['id_transaksi'] . "' class='bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700'>Edit</a>";
                        echo "<a href='hapustransaksi.php?id=" . $row['id_transaksi'] . "' onclick=\"return confirm('Yakin mau hapus data ini?')\" class='bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>