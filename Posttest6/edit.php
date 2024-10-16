<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'labuan_db';

$koneksi = mysqli_connect($host, $user, $password, $dbname);

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    echo "ID tidak diberikan.";
    exit;
}

$id = $_GET['id'];

$stmt = $koneksi->prepare("SELECT * FROM ulasan_pengguna WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Ulasan tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['name'];
    $rating = $_POST['rating'];
    $ulasan = $_POST['review'];
    $tanggal_kunjungan = $_POST['visit_date'];

    $update_stmt = $koneksi->prepare("UPDATE ulasan_pengguna SET nama = ?, rating = ?, ulasan = ?, tanggal_kunjungan = ? WHERE id = ?");
    $update_stmt->bind_param("sissi", $nama, $rating, $ulasan, $tanggal_kunjungan, $id);
    
    if ($update_stmt->execute()) {
        echo "<p>Ulasan berhasil diperbarui!</p>";
        $stmt = $koneksi->prepare("SELECT * FROM ulasan_pengguna WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    } else {
        echo "Error updating record: " . $koneksi->error;
    }
    $update_stmt->close();
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ulasan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Ulasan</h2>
    <form action="" method="POST">
        <div>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
        </div>
        <div>
            <label for="rating">Rating (1-5):</label>
            <select id="rating" name="rating" required>
                <option value="">Pilih rating</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php if ($i == $row['rating']) echo 'selected'; ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div>
            <label for="review">Ulasan:</label>
            <textarea id="review" name="review" required><?php echo htmlspecialchars($row['ulasan']); ?></textarea>
        </div>
        <div>
            <label for="visit-date">Tanggal Kunjungan:</label>
            <input type="date" id="visit-date" name="visit_date" value="<?php echo htmlspecialchars($row['tanggal_kunjungan']); ?>" required>
        </div>
        <div>
            <button type="submit">Perbarui</button>
        </div>
    </form>

    <?php if (isset($row)): ?>
        <h3>Ulasan Terakhir:</h3>
        <p><strong>Nama:</strong> <?php echo htmlspecialchars($row['nama']); ?></p>
        <p><strong>Rating:</strong> <?php echo htmlspecialchars($row['rating']); ?></p>
        <p><strong>Ulasan:</strong> <?php echo htmlspecialchars($row['ulasan']); ?></p>
        <p><strong>Tanggal Kunjungan:</strong> <?php echo htmlspecialchars($row['tanggal_kunjungan']); ?></p>
    <?php endif; ?>

    <div>
    <a href="index.php" class="back-button">Kembali</a>
    </div>
</body>
</html>


