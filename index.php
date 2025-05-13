<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesantren Modern</title>
    <link href="assets/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero {
            background-color: #4e73df;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 50px;
        }
        .section {
            padding: 50px 0;
            text-align: center;
        }
        .section h2 {
            font-size: 30px;
            margin-bottom: 30px;
        }
        .btn-main {
            background-color: #4e73df;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-main:hover {
            background-color: #2e59d9;
        }
    </style>
</head>
<body id="page-top">

<!-- Hero Section -->
<div class="hero">
    <h1>Selamat Datang di Pesantren Modern</h1>
    <p>Menentukan Kelas IPA atau IPS dengan Metode Terbaru</p>
    <a href="login.php" class="btn-main">Login</a>
    <a href="register.php" class="btn-main">Registrasi</a>
</div>

<!-- About Section -->
<div class="section" id="about">
    <h2>Tentang Kami</h2>
    <p>Pesantren Modern ini bertujuan untuk memberikan pendidikan yang berkualitas dengan pendekatan teknologi terbaru. Kami membantu siswa untuk menentukan kelas IPA atau IPS yang sesuai dengan potensi mereka.</p>
</div>

<!-- Contact Section -->
<div class="section" id="contact">
    <h2>Kontak Kami</h2>
    <p>Jika Anda membutuhkan informasi lebih lanjut, silakan hubungi kami melalui:</p>
    <p>Email: pesantren@example.com</p>
    <p>Telepon: (021) 123456789</p>
</div>

<!-- Footer Section -->
<footer class="section" style="background-color: #f8f9fc;">
    <p>&copy; 2025 Pesantren Modern. All Rights Reserved.</p>
</footer>

<script src="assets/sbadmin2/vendor/jquery/jquery.min.js"></script>
<script src="assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/sbadmin2/js/sb-admin-2.min.js"></script>
</body>
</html>
