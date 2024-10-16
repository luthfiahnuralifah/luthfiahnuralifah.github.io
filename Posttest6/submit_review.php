<?php
include 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $rating = intval($_POST['rating']);
    $review = mysqli_real_escape_string($koneksi, $_POST['review']);
    $visit_date = mysqli_real_escape_string($koneksi, $_POST['visit_date']);

    $query = "INSERT INTO ulasan_pengguna (nama, rating, ulasan, tanggal_kunjungan) VALUES ('$name', $rating, '$review', '$visit_date')";

    if (mysqli_query($koneksi, $query)) {
        echo json_encode([
            'success' => true,
            'name' => $name,
            'rating' => $rating,
            'review' => $review,
            'visit_date' => $visit_date
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => mysqli_error($koneksi)
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
}

mysqli_close($koneksi);
?>