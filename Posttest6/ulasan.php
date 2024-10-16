<?php
include 'koneksi.php';

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $nama = clean_input($_POST['nama']);
            $rating = clean_input($_POST['rating']);
            $ulasan = clean_input($_POST['ulasan']);
            $tanggal_kunjungan = clean_input($_POST['tanggal_kunjungan']);

            $sql = "INSERT INTO ulasan_pengguna (nama, rating, ulasan, tanggal_kunjungan) VALUES (?, ?, ?, ?)";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("siss", $nama, $rating, $ulasan, $tanggal_kunjungan);
            $stmt->execute();
        } elseif ($_POST['action'] == 'edit') {
            $id = clean_input($_POST['id']);
            $nama = clean_input($_POST['nama']);
            $rating = clean_input($_POST['rating']);
            $ulasan = clean_input($_POST['ulasan']);
            $tanggal_kunjungan = clean_input($_POST['tanggal_kunjungan']);

            $sql = "UPDATE ulasan_pengguna SET nama=?, rating=?, ulasan=?, tanggal_kunjungan=? WHERE id=?";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("sissi", $nama, $rating, $ulasan, $tanggal_kunjungan, $id);
            $stmt->execute();
        } elseif ($_POST['action'] == 'delete') {
            $id = clean_input($_POST['id']);

            $sql = "DELETE FROM ulasan_pengguna WHERE id=?";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
    }
}

$sql = "SELECT * FROM ulasan_pengguna ORDER BY tanggal_kunjungan DESC";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Pengunjung - Labuan Cermin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .ulasan-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .ulasan-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .ulasan-form {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .ulasan-form input, .ulasan-form textarea, .ulasan-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .ulasan-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .ulasan-form button:hover {
            background-color: #45a049;
        }
        .edit-delete-buttons {
            margin-top: 10px;
        }
        .edit-delete-buttons button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .edit-button {
            background-color: #008CBA;
            color: white;
        }
        .delete-button {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>

    <main class="ulasan-container">
        <h1>Ulasan Pengunjung Labuan Cermin</h1>

        <div class="ulasan-form">
            <h2>Tambah Ulasan Baru</h2>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <input type="text" name="nama" placeholder="Nama Anda" required>
                <select name="rating" required>
                    <option value="">Pilih Rating</option>
                    <option value="1">1 Bintang</option>
                    <option value="2">2 Bintang</option>
                    <option value="3">3 Bintang</option>
                    <option value="4">4 Bintang</option>
                    <option value="5">5 Bintang</option>
                </select>
                <textarea name="ulasan" placeholder="Tulis ulasan Anda di sini" required></textarea>
                <input type="date" name="tanggal_kunjungan" required>
                <button type="submit">Kirim Ulasan</button>
            </form>
        </div>

        <div class="ulasan-list">
            <h2>Daftar Ulasan</h2>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='ulasan-item'>";
                    echo "<h3>" . htmlspecialchars($row['nama']) . "</h3>";
                    echo "<p>Rating: " . htmlspecialchars($row['rating']) . " Bintang</p>";
                    echo "<p>" . htmlspecialchars($row['ulasan']) . "</p>";
                    echo "<p>Tanggal Kunjungan: " . htmlspecialchars($row['tanggal_kunjungan']) . "</p>";
                    echo "<div class='edit-delete-buttons'>";
                    echo "<button class='edit-button' onclick='editUlasan(" . $row['id'] . ")'>Edit</button>";
                    echo "<button class='delete-button' onclick='deleteUlasan(" . $row['id'] . ")'>Hapus</button>";
                    echo "</div>";
                    
                    echo "</div>";
                }
            } else {
                echo "<p>Belum ada ulasan.</p>";
            }
            ?>
        </div>
    </main>

    <script>
    function editUlasan(id) {
        alert('Edit ulasan dengan ID: ' + id);
    }

    function deleteUlasan(id) {
        if (confirm('Apakah Anda yakin ingin menghapus ulasan ini?')) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = '<input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="' + id + '">';
            document.body.appendChild(form);
            form.submit();
        }
    }
    </script>
</body>
</html>