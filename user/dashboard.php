<?php
session_start();
include '../includes/config.php';

// Pastikan user sudah login dan rolenya 'user'
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['id'];

// Ambil data user dan nilai
$query = "SELECT u.nama, u.email, n.nilai_akademik, n.nilai_iq, n.nilai_agama, n.nilai_nonakademik, n.hasil
          FROM users u
          LEFT JOIN nilai_siswa n ON u.id = n.user_id
          WHERE u.id = '$user_id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link href="../template/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- Topbar -->
            <?php include 'topbar.php'; ?>
            <!-- End of Topbar -->

            <!-- Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Dashboard Saya</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h5>Nama: <?= $data['nama']; ?></h5>
                        <h5>Email: <?= $data['email']; ?></h5>
                        <hr>
                        <h6>Nilai Akademik: <?= $data['nilai_akademik'] ?? '-'; ?></h6>
                        <h6>IQ: <?= $data['nilai_iq'] ?? '-'; ?></h6>
                        <h6>Nilai Keagamaan: <?= $data['nilai_agama'] ?? '-'; ?></h6>
                        <h6>Nilai Non-Akademik: <?= $data['nilai_nonakademik'] ?? '-'; ?></h6>
                        <hr>
                        <h4><strong>Hasil: <?= $data['hasil'] ?? 'Belum Ditentukan'; ?></strong></h4>
                    </div>
                </div>

            </div>
            <!-- End of Page Content -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include 'footer.php'; ?>
        <!-- End of Footer -->
    </div>
</div>

<!-- JS -->
<script src="../template/sb-admin-2/vendor/jquery/jquery.min.js"></script>
<script src="../template/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../template/sb-admin-2/js/sb-admin-2.min.js"></script>

</body>
</html>
