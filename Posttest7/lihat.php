<?php
include 'koneksi.php';

$id = $_GET['id'];
$stmt = $koneksi->prepare("SELECT * FROM ulasan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Ulasan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
    </style>
</head>
<body>
    <h2>Detail Ulasan Kunjungan</h2>
    <p><strong>Nama:</strong> <?php echo htmlspecialchars($data['nama']); ?></p>
    <p><strong>Rating:</strong> <?php echo htmlspecialchars($data['rating']); ?></p>
    <p><strong>Ulasan:</strong> <?php echo nl2br(htmlspecialchars($data['ulasan'])); ?></p>
    <p><strong>Tanggal Kunjungan:</strong> <?php echo htmlspecialchars($data['tanggal_kunjungan']); ?></p>
    <a href="index.php">Kembali ke Daftar Ulasan</a>
</body>
</html>
