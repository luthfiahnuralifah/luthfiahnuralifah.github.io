<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $rating = $_POST['rating'];
    $ulasan = $_POST['ulasan'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];

    $query = "INSERT INTO ulasan (nama, rating, ulasan, tanggal_kunjungan) VALUES ('$nama', '$rating', '$ulasan', '$tanggal_kunjungan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: index.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ulasan Baru</title>
</head>
<body>
    <h2>Tambah Ulasan Baru</h2>
    <form action="" method="POST">
        Nama: <input type="text" name="nama" required><br><br>
        Rating: <input type="number" name="rating" min="1" max="5" required><br><br>
        Ulasan: <textarea name="ulasan" required></textarea><br><br>
        Tanggal Kunjungan: <input type="date" name="tanggal_kunjungan" required><br><br>
        <input type="submit" name="submit" value="Tambah Ulasan">
    </form>
</body>
</html>
