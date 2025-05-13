<?php
// Memulai session
session_start();

// Memasukkan file konfigurasi dan session
include '../config.php';
include '../includes/session.php';

// Proteksi agar hanya user yang dapat mengakses halaman ini
check_login();
check_role('user');

// Mendapatkan user_id dari session
$user_id = $_SESSION['user_id'];

// Query untuk mengambil data nilai siswa berdasarkan user_id
$sql = "SELECT * FROM nilai_siswa WHERE user_id = '$user_id'";
$result = $conn->query($sql);

// Jika ada data, ambil hasilnya
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Ujian - User</title>
    <link href="../assets/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div class="container mt-5">
        <h2 class="mb-4">Hasil Ujian Anda</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>Nama Pengguna:</strong> <?= $_SESSION['username'] ?></p>

                <!-- Jika ada data, tampilkan dalam tabel -->
                <?php if ($data): ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nilai Akademik</th>
                            <td><?= $data['nilai_akademik'] ?></td>
                        </tr>
                        <tr>
                            <th>IQ</th>
                            <td><?= $data['nilai_iq'] ?></td>
                        </tr>
                        <tr>
                            <th>Nilai Keagamaan</th>
                            <td><?= $data['nilai_keagamaan'] ?></td>
                        </tr>
                        <tr>
                            <th>Nilai Non-Akademik</th>
                            <td><?= $data['nilai_non_akademik'] ?></td>
                        </tr>
                        <tr>
                            <th>Hasil</th>
                            <td><strong><?= strtoupper($data['hasil']) ?></strong></td>
                        </tr>
                    </table>
                <?php else: ?>
                    <!-- Jika data tidak ada, tampilkan pesan peringatan -->
                    <div class="alert alert-warning">Belum ada data nilai untuk akun ini.</div>
                <?php endif; ?>

                <!-- Tombol Logout -->
                <a href="../logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>

    <script src="../assets/sbadmin2/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/sbadmin2/js/sb-admin-2.min.js"></script>
</body>

</html>
