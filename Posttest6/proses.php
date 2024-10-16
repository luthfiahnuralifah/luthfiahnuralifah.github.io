<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['name'];
    $rating = $_POST['rating'];
    $ulasan = $_POST['review'];
    $tanggal_kunjungan = $_POST['visit_date'];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $stmt = $koneksi->prepare("UPDATE ulasan SET nama = ?, rating = ?, ulasan = ?, tanggal_kunjungan = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nama, $rating, $ulasan, $tanggal_kunjungan, $id);
    } else {
        $stmt = $koneksi->prepare("INSERT INTO ulasan (nama, rating, ulasan, tanggal_kunjungan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $rating, $ulasan, $tanggal_kunjungan);
    }

    if ($stmt->execute()) {
        header("Location: ulasan.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

mysqli_close($koneksi);
?>
