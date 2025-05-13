<?php
session_start();

// Fungsi ini dipanggil di halaman yang hanya boleh diakses user login
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

// Fungsi untuk memeriksa role
function check_role($expected_role) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $expected_role) {
        header('Location: login.php');
        exit;
    }
}
?>
