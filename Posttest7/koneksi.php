<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'labuan_db';

$koneksi = mysqli_connect($host, $user, $password, $dbname);

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
