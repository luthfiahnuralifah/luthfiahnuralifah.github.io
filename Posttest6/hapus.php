<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM ulasan_pengguna WHERE id = $id";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Ulasan berhasil dihapus!'); window.location.href='index.php';</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
