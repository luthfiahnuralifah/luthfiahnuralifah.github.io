<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "SELECT * FROM ulasan WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Ulasan</title>
</head>
<body>
    <h2>Detail Ulasan Kunjungan</h2>

    <p><strong>Nama:</strong> <?php echo $data['nama']; ?></p>
    <p><strong>Rating:</strong> <?php echo $data['rating']; ?></p>
    <p><strong>Ulasan:</strong> <?php echo $data['ulasan']; ?></p>
    <p><strong>Tanggal Kunjungan:</strong> <?php echo $data['tanggal_kunjungan']; ?></p>

    <a href="index.php">Kembali ke Daftar Ulasan</a>
</body>
</html>
