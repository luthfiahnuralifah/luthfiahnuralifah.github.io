<?php
include 'koneksilogin.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);
    $nomor_hp = mysqli_real_escape_string($koneksi, $_POST['nomor_hp']);

    if ($password !== $confirm_password) {
        echo "Password tidak sama.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (username, password, nomor_hp) VALUES ('$username', '$hashed_password', '$nomor_hp')";

    if (mysqli_query($koneksi, $query)) {
        echo "Registrasi berhasil!";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <label>Confirm Password:</label><br>
        <input type="password" name="confirm_password" required><br><br>
        <label>Nomor HP:</label><br>
        <input type="text" name="nomor_hp" required><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>