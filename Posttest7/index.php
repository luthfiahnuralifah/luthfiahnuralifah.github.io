<?php
include 'koneksi.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
$query = "SELECT * FROM ulasan_pengguna ORDER BY tanggal_kunjungan DESC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Error fetching reviews: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Wisata Labuan Cermin</title>
    <title>Protected Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
        <a href="logout.php">Logout</a>
<header>
    <div class="logo-container">
        <img src="logo.png" alt="Logo Labuan Cermin" class="header-logo">
        <span class="logo">Labuan Cermin</span>
        <ul class="navlist" id="navbar">
            <li><a href="#description">Deskripsi Tempat</a></li>
            <li><a href="#facilities">Fasilitas</a></li>
            <li><a href="#gallery">Galeri</a></li>
            <li><a href="#about-me">Tentang Saya</a></li>
            <li><a href="ulasan.php">Ulasan Pengunjung</a></li>
        </ul>
    </div>
    <div class="header-icons">
        <i id="mode-toggle" class="bx bx-sun"></i>
        <i id="menu-icon" class="bx bx-menu"></i>
    </div>
</header>

<main>
    <section class="home" id="home">
        <img src="labuan_cermin_utama.jpg" alt="Labuan Cermin" class="header-image">
        <div class="home-text">
            <h1>Selamat Datang di Labuan Cermin</h1>
            <p>Tempat wisata yang indah dengan keanekaragaman hayati yang menakjubkan.</p>
        </div>
    </section>

<section class="description" id="description">
    <div class="description-container">
        <div class="center-text">
            <h2>Deskripsi Tempat</h2>
            <p>Danau Labuan Cermin adalah salah satu objek wisata air yang berlokasi di Desa Labuan Kelambu, Kecamatan Biduk-biduk, Kabupaten Berau, Kalimantan Timur. 
                Tempat wisata alam ini dikelola oleh masyarakat sekitar bekerja sama dengan Lembaga Masyarakat Labuan Cermin yang menaunginya. 
                Danau ini memiliki dua rasa, asin (air laut) di bagian dasar dan tawar di bagian permukaan. Fenomena alam disebut juga sebagai Meromictic lake. 
                Dinamakan Labuan Cermin karena airnya begitu bening dan mengkilap layaknya cermin.</p>
        </div>
        <div class="location-info">
            <h4>Lokasi</h4>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3150.123456789012!2d114.1234567890!3d-0.1234567890!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de1234567890abc%3A0x1234567890abcdef!2sDanau%20Labuan%20Cermin!5e0!3m2!1sen!2sid!4v1623456789012!5m2!1sen!2sid" 
                width="250" 
                height="200" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
            <p>
                <a href="https://maps.app.goo.gl/WUiTErEyRFyUyczSA" target="_blank" class="map-button">
                    Lihat di Google Maps
                </a>
            </p>
        </div>
    </div>
</section>

    <section class="facilities" id="facilities">
        <div class="center-text">
            <h2>Fasilitas</h2>
            <div class="facilities-grid">
                <div class="facility-item">Area Parkir</div>
                <div class="facility-item">ATMs</div>
                <div class="facility-item">Cafetaria</div>
                <div class="facility-item">Kamar Mandi Umum</div>
                <div class="facility-item">Kuliner</div>
                <div class="facility-item">Musholla</div>
                <div class="facility-item">Outbound</div>
                <div class="facility-item">Spot Foto</div>
                <div class="facility-item">Kios Souvernir</div>
                <div class="facility-item">Wifi Area</div>
                <div class="facility-item">Jungle Tracking</div>
                <div class="facility-item">Balai Pertemuan</div>
            </div>
        </div>
    </section>

    <section class="gallery" id="gallery">
        <div class="center-text">
            <h2>Galeri</h2>
            <div class="gallery-grid">
                <img src="labuan_cermin1.jpeg" alt="Gallery Photo 1">
                <img src="labuan_cermin2.jpg" alt="Gallery Photo 2">
                <img src="labuan_cermin3.jpg" alt="Gallery Photo 3">
                <img src="labuan_cermin4.jpg" alt="Gallery Photo 4">
                <img src="labuan_cermin5.jpg" alt="Gallery Photo 5">
                <img src="labuan_cermin6.jpg" alt="Gallery Photo 6">
                <img src="labuan_cermin7.jpg" alt="Gallery Photo 7">
                <img src="labuan_cermin8.jpg" alt="Gallery Photo 8">
                <img src="labuan_cermin9.jpeg" alt="Gallery Photo 9">
            </div>
        </div>
    </section>

    <section class="about-me" id="about-me">
        <div class="center-text">
            <h2>Tentang Saya</h2>
            <div class="about-me-content">
                <img src="masha.png" alt="Your Name" class="about-me-photo">
                <div class="about-me-text">
                    <p><strong>Nama :</strong> luffy</p>
                    <p><strong>Usia :</strong> 19 Tahun</p>
                    <p><strong>Asal :</strong> Semarang (Sekitar Marangkayu)</p>
                    <p><strong>Cita-Cita :</strong> Hacker</p>
                </div>
            </div>
        </div>
    </section>    
<section class="feedback" id="feedback">
        <div class="center-text">
            <h2>Berikan Pendapat Anda</h2>
            <form id="feedback-form" action="proses.php" method="POST">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" required placeholder="Masukkan nama Anda">
                </div>
                <div class="form-group">
                    <label for="rating">Rating (1-5):</label>
                    <select id="rating" name="rating" required>
                        <option value="">Pilih rating</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="review">Ulasan:</label>
                    <textarea id="review" name="review" required placeholder="Tulis ulasan Anda di sini"></textarea>
                </div>
                <div class="form-group">
                    <label for="visit-date">Tanggal Kunjungan:</label>
                    <input type="date" id="visit-date" name="visit_date" required>
                </div>
                <div class="form-group">
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </section>

    <section class="reviews" id="reviews">
    <div class="center-text">
        <h2>Ulasan Pengunjung</h2>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='review'>";
                echo "<h3>" . htmlspecialchars($row['nama']) . "</h3>";
                echo "<p>Rating: " . htmlspecialchars($row['rating']) . "/5</p>";
                echo "<p>" . htmlspecialchars($row['ulasan']) . "</p>";
                echo "<p>Tanggal Kunjungan: " . htmlspecialchars($row['tanggal_kunjungan']) . "</p>";
                echo "<div class='review-actions'>";
                echo "<a href='edit.php?id=" . $row['id'] . "' class='edit-button'>Edit</a>";
                echo "<a href='hapus.php?id=" . $row['id'] . "' class='delete-button' onclick='return confirm(\"Yakin ingin menghapus ulasan ini?\")'>Hapus</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Belum ada ulasan.</p>";
        }
        ?>
    </div>
</section>
<form method="POST" action="" class="logout-form">
    <button type="submit" name="logout" class="logout-button">Logout</button>
</form>
<footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <div class="logo">Labuan Cermin</div>
                <p>Menikmati keindahan alam yang memukau di Labuan Cermin.</p>
            </div>
            <div class="contact-info">
                <h4>Kontak Saya</h4>
                <p><i class='bx bx-phone'></i> +62 821 5502 0900</p>
                <p><i class='bx bx-envelope'></i> luthfiahnaa@gmail.com</p>
                <p><i class='bx bxl-instagram'></i> @luthfiahnuralifah</p>
            </div>
        </div>
        <div class="copyright">
            <p>Copyright &copy; 2024 All rights reserved | Labuan Cermin.</p>
        </div>
    </footer>
    <div class="top"></div>
        <i class="bx bx-chevron-up"></i>
    </div>
    <div id="welcome-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Selamat Datang!</h2>
            <p>Terima kasih telah mengunjungi website kami.</p>
        </div>
    </div>
</footer>

<div class="top">
    <i class="bx bx-chevron-up"></i>
</div>

<div id="welcome-popup" class="popup">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <h2>Selamat Datang!</h2>
        <p>Terima kasih telah mengunjungi website kami.</p>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>

<?php
mysqli_close($koneksi);
?>