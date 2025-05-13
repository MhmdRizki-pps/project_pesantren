<?php
include '../config.php';
include '../includes/session.php';
check_login();
check_role('admin');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Pesantren</title>
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
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- Tambah menu lain di sini jika perlu -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <span>Logout</span>
                </a>
            </li>
        </ul>
        <!-- End Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Navbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo, <?= $_SESSION['username'] ?></span>
                </nav>
