<?php
include '../config.php';
include '../includes/session.php';
check_login();
check_role('admin');

// Ambil semua user dengan role 'user' untuk dropdown
$users = $conn->query("SELECT id, username FROM users WHERE role = 'user'");

// Simpan nilai jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $akademik = $_POST['nilai_akademik'];
    $iq = $_POST['nilai_iq'];
    $keagamaan = $_POST['nilai_keagamaan'];
    $non_akademik = $_POST['nilai_non_akademik'];

    // Contoh perhitungan sederhana hasil:
    $rata = ($akademik + $iq + $keagamaan + $non_akademik) / 4;
    $hasil = ($rata >= 75) ? 'IPA' : 'IPS';

    // Cek jika nilai sudah ada
    $cek = $conn->query("SELECT * FROM nilai_siswa WHERE user_id = '$user_id'");
    if ($cek->num_rows > 0) {
        // update
        $conn->query("UPDATE nilai_siswa SET 
            nilai_akademik = '$akademik',
            nilai_iq = '$iq',
            nilai_keagamaan = '$keagamaan',
            nilai_non_akademik = '$non_akademik',
            hasil = '$hasil'
            WHERE user_id = '$user_id'");
    } else {
        // insert
        $conn->query("INSERT INTO nilai_siswa (user_id, nilai_akademik, nilai_iq, nilai_keagamaan, nilai_non_akademik, hasil)
            VALUES ('$user_id', '$akademik', '$iq', '$keagamaan', '$non_akademik', '$hasil')");
    }

    echo "<script>alert('Data nilai berhasil disimpan!'); window.location.href='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Nilai</title>
    <link href="../assets/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
<div class="container mt-5">
    <h2 class="mb-4">Input Nilai Siswa</h2>
    <form method="post" action="">
        <div class="form-group">
            <label>Username Siswa</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Pilih Siswa --</option>
                <?php while ($row = $users->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['username'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Nilai Akademik</label>
            <input type="number" name="nilai_akademik" class="form-control" required min="0" max="100">
        </div>
        <div class="form-group">
            <label>Nilai IQ</label>
            <input type="number" name="nilai_iq" class="form-control" required min="0" max="100">
        </div>
        <div class="form-group">
            <label>Nilai Keagamaan</label>
            <input type="number" name="nilai_keagamaan" class="form-control" required min="0" max="100">
        </div>
        <div class="form-group">
            <label>Nilai Non-Akademik</label>
            <input type="number" name="nilai_non_akademik" class="form-control" required min="0" max="100">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="../assets/sbadmin2/vendor/jquery/jquery.min.js"></script>
<script src="../assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/sbadmin2/js/sb-admin-2.min.js"></script>
</body>
</html>
