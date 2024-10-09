<?php
include 'koneksi.php';

$query = "SELECT * FROM ulasan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Ulasan</title>
</head>
<body>
    <h1>Daftar Ulasan</h1>

    <h2>Tambah Ulasan Baru</h2>
    <form action="tambah.php" method="POST">
        Nama: <input type="text" name="nama" required><br><br>
        Rating: <input type="number" name="rating" min="1" max="5" required><br><br>
        Ulasan: <textarea name="ulasan" required></textarea><br><br>
        Tanggal Kunjungan: <input type="date" name="tanggal_kunjungan" required><br><br>
        <input type="submit" name="submit" value="Tambah Ulasan">
    </form>

    <h2>List Ulasan</h2>
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Rating</th>
            <th>Ulasan</th>
            <th>Tanggal Kunjungan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($data = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($data['nama']); ?></td>
            <td><?php echo htmlspecialchars($data['rating']); ?></td>
            <td><?php echo htmlspecialchars($data['ulasan']); ?></td>
            <td><?php echo htmlspecialchars($data['tanggal_kunjungan']); ?></td>
            <td>
                <a href="lihat.php?id=<?php echo $data['id']; ?>">Lihat</a> |
                <a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a> |
                <a href="hapus.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <?php mysqli_close($koneksi); ?>
</body>
</html>
