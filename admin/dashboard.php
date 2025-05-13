<?php
// Memulai session
session_start();

// Memasukkan file konfigurasi dan session
include '../config.php';
include '../includes/session.php';

// Proteksi agar hanya admin yang dapat mengakses halaman ini
check_login();
check_role('admin');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="../assets/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-text mx-3">Admin Pesantren</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="input_nilai.php">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Input Nilai</span>
                </a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <span class="navbar-text font-weight-bold">
                        Halo, <?= $_SESSION['username'] ?>
                    </span>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Nilai Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Username</th>
                                            <th>Nilai Akademik</th>
                                            <th>IQ</th>
                                            <th>Keagamaan</th>
                                            <th>Non-Akademik</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Query untuk menampilkan data nilai siswa
                                        $sql = "SELECT users.username, nilai_siswa.* 
                                                FROM nilai_siswa 
                                                JOIN users ON nilai_siswa.user_id = users.id";
                                        $result = $conn->query($sql);

                                        // Menampilkan data jika ada
                                        if ($result->num_rows > 0):
                                            while ($row = $result->fetch_assoc()):
                                        ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['username']) ?></td>
                                                <td><?= $row['nilai_akademik'] ?></td>
                                                <td><?= $row['nilai_iq'] ?></td>
                                                <td><?= $row['nilai_keagamaan'] ?></td>
                                                <td><?= $row['nilai_non_akademik'] ?></td>
                                                <td><strong><?= strtoupper($row['hasil']) ?></strong></td>
                                            </tr>
                                        <?php endwhile; else: ?>
                                            <tr><td colspan="6" class="text-center">Belum ada data nilai.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End of Page Content -->
            </div>
        </div>
        <!-- End Content Wrapper -->

    </div>
    <!-- End Wrapper -->

    <!-- Scripts -->
    <script src="../assets/sbadmin2/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/sbadmin2/js/sb-admin-2.min.js"></script>

</body>

</html>
