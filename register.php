<?php
include 'config.php';
include 'includes/session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Validasi password
    if ($password != $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah username sudah ada
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error = "Username sudah terdaftar.";
        } else {
            // Masukkan data ke database
            $sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$hashed_password', '$email', 'user')";
            if ($conn->query($sql) === TRUE) {
                $success = "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Terjadi kesalahan: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Pesantren Modern</title>
    <link href="assets/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg my-5">
                <div class="card-body">
                    <h2 class="text-center">Registrasi Pengguna</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <form action="register.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </form>
                    <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login disini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/sbadmin2/vendor/jquery/jquery.min.js"></script>
<script src="assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/sbadmin2/js/sb-admin-2.min.js"></script>
</body>
</html>
