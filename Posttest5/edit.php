<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM ulasan WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $rating = $_POST['rating'];
    $ulasan = $_POST['ulasan'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];

    $query = "UPDATE ulasan SET nama='$nama', rating='$rating', ulasan='$ulasan', tanggal_kunjungan='$tanggal_kunjungan' WHERE id=$id";
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
    <title>Edit Ulasan</title>
</head>
<body>
    <h2>Edit Ulasan Kunjungan</h2>
    <form action="" method="POST">
        Nama: <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required><br><br>
        Rating: <input type="number" name="rating" value="<?php echo $data['rating']; ?>" min="1" max="5" required><br><br>
        Ulasan: <textarea name="ulasan" required><?php echo $data['ulasan']; ?></textarea><br><br>
        Tanggal Kunjungan: <input type="date" name="tanggal_kunjungan" value="<?php echo $data['tanggal_kunjungan']; ?>" required><br><br>
        <input type="submit" name="submit" value="Update Ulasan">
    </form>
</body>
</html>
