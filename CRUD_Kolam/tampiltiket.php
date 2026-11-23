<?php
    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tiket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cyan-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Tiket</h2>
        <div class="flex justify-between items-center mb-4">
            <a href="index.php" class="bg-blue-300 text-white px-4 py-2 rounded hover:bg-purple-300 text-sm">&laquo; Kembali ke Menu Utama</a>
            <a href="tambahtiket.php" class="bg-blue-300 text-white px-4 py-2 rounded hover:bg-purple-300 text-sm">+ Tambah Data Tiket</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-purple-300">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="border border-gray-300 p-2">No</th>
                        <th class="border border-gray-300 p-2">id tiket</th>
                        <th class="border border-gray-300 p-2">kategori</th>
                        <th class="border border-gray-300 p-2">harga</th>
                        <th class="border border-gray-300 p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Menggunakan tb_tiket sesuai database
                        $query = mysqli_query($koneksi, "SELECT * FROM tb_tiket");
                        
                        if (!$query) {
                            die("Query Error: " . mysqli_error($koneksi));
                        }

                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr class='hover:bg-gray-50'>";
                            echo "<td class='border border-gray-300 p-2'>" . $no++ . "</td>";
                            echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['id_tiket']) . "</td>";
                            echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['kategori']) . "</td>";
                            echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['harga']) . "</td>";
                            echo "<td class='border border-gray-300 p-2 space-x-2'>";
                            echo "<a href='edittiket.php?id=" . $row['id_tiket'] . "' class='bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700'>Edit</a>";
                            echo "<a href='hapustiket.php?id=" . $row['id_tiket'] . "' onclick=\"return confirm('Yakin mau hapus data ini?')\" class='bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700'>Hapus</a>";
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