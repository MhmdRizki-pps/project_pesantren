<?php
session_start();
include 'includes/config.php';

$action = $_GET['action'];

if ($action == 'register') {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  $query = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: login.php?success=register");
  } else {
    echo "Gagal daftar: " . mysqli_error($conn);
  }
}

if ($action == 'login') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] == 'admin') {
      header("Location: admin/dashboard.php");
    } else {
      header("Location: user/dashboard.php");
    }
  } else {
    echo "Email atau password salah.";
  }
}
