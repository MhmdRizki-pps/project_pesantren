<?php
include 'config.php';
include 'includes/session.php';

check_login();
check_role('user');

// Ambil data user
$user_id = $_SESSION['user_id'];

// Ambil nilai dari database
$sql = "SELECT * FROM nilai_siswa WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $nilai_akademik     = $row['nilai_akademik'];
    $nilai_iq           = $row['nilai_iq'];
    $nilai_keagamaan    = $row['nilai_keagamaan'];
    $nilai_non_akademik = $row['nilai_non_akademik'];
    $hasil              = $row['hasil']; // IPA atau IPS
} else {
    echo "<p style='color:red'>Nilai belum tersedia. Silakan hubungi admin.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Ujian - User</title>
    <link href="assets/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
<div class="container mt-5">
    <h2 class="text-center">Hasil Ujian Anda</h2>
    <table class="table table-bordered mt-4">
        <tr>
            <th>Nilai Akademik</th>
            <td><?= $nilai_akademik ?></td>
        </tr>
        <tr>
            <th>IQ</th>
            <td><?= $nilai_iq ?></td>
        </tr>
        <tr>
            <th>Nilai Keagamaan</th>
            <td><?= $nilai_keagamaan ?></td>
        </tr>
        <tr>
            <th>Nilai Non-Akademik</th>
            <td><?= $nilai_non_akademik ?></td>
        </tr>
        <tr class="table-success">
            <th>Hasil Rekomendasi Kelas</th>
            <td><strong><?= strtoupper($hasil) ?></strong></td>
        </tr>
    </table>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
