<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM ulasan WHERE id = $id";
$result = mysqli_query($koneksi, $query);

if ($result) {
    header("Location: index.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}
?>
