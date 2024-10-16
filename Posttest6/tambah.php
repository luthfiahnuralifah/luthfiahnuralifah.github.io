<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $rating = $_POST['rating'];
    $ulasan = $_POST['ulasan'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];

    $stmt = $koneksi->prepare("INSERT INTO ulasan (nama, rating, ulasan, tanggal_kunjungan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $nama, $rating, $ulasan, $tanggal_kunjungan);
    
    if ($stmt->execute()) {
        header("Location: index.php?message=Ulasan berhasil ditambahkan");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ulasan Baru</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { margin: 20px; }
        input, textarea { width: 100%; padding: 10px; margin: 5px 0; }
        input[type="submit"] { width: auto; }
    </style>
</head>
<body>
    <h2>Tambah Ulasan Baru</h2>
    <form action="" method="POST">
        <label>Nama:</label> <input type="text" name="nama" required>
        <label>Rating:</label> <input type="number" name="rating" min="1" max="5" required>
        <label>Ulasan:</label> <textarea name="ulasan" required></textarea>
        <label>Tanggal Kunjungan:</label> <input type="date" name="tanggal_kunjungan" required>
        <input type="submit" name="submit" value="Tambah Ulasan">
    </form>
</body>
</html>
