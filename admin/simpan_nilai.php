<?php
session_start();
include '../includes/config.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_POST['user_id'];
$nilai_akademik = $_POST['nilai_akademik'];
$nilai_iq = $_POST['nilai_iq'];
$nilai_agama = $_POST['nilai_agama'];
$nilai_nonakademik = $_POST['nilai_nonakademik'];

// Logika klasifikasi sederhana (contoh saja, bisa kamu ubah dengan metode MOORA)
$total_ipa = $nilai_akademik + $nilai_iq;
$total_ips = $nilai_agama + $nilai_nonakademik;

$hasil = ($total_ipa > $total_ips) ? 'IPA' : 'IPS';

// Cek apakah nilai sudah ada
$cek = mysqli_query($conn, "SELECT * FROM nilai_siswa WHERE user_id = '$user_id'");
if (mysqli_num_rows($cek) > 0) {
    // Update
    $query = "UPDATE nilai_siswa SET 
        nilai_akademik = '$nilai_akademik',
        nilai_iq = '$nilai_iq',
        nilai_agama = '$nilai_agama',
        nilai_nonakademik = '$nilai_nonakademik',
        hasil = '$hasil'
        WHERE user_id = '$user_id'";
} else {
    // Insert
    $query = "INSERT INTO nilai_siswa 
        (user_id, nilai_akademik, nilai_iq, nilai_agama, nilai_nonakademik, hasil)
        VALUES ('$user_id', '$nilai_akademik', '$nilai_iq', '$nilai_agama', '$nilai_nonakademik', '$hasil')";
}

mysqli_query($conn, $query);

header("Location: dashboard.php");
exit;
