<?php
include '../includes/config.php';

// 1. Ambil semua data nilai siswa
$data = mysqli_query($conn, "SELECT * FROM nilai_siswa");

// 2. Hitung pembagi normalisasi (akar jumlah kuadrat tiap kriteria)
$jumlah_akademik = 0;
$jumlah_iq = 0;
$jumlah_agama = 0;
$jumlah_nonakademik = 0;

while ($row = mysqli_fetch_assoc($data)) {
    $jumlah_akademik += pow($row['nilai_akademik'], 2);
    $jumlah_iq += pow($row['nilai_iq'], 2);
    $jumlah_agama += pow($row['nilai_agama'], 2);
    $jumlah_nonakademik += pow($row['nilai_nonakademik'], 2);
}

$pembagi_akademik = sqrt($jumlah_akademik);
$pembagi_iq = sqrt($jumlah_iq);
$pembagi_agama = sqrt($jumlah_agama);
$pembagi_nonakademik = sqrt($jumlah_nonakademik);

// 3. Normalisasi dan hitung skor MOORA untuk masing-masing siswa
$data = mysqli_query($conn, "SELECT * FROM nilai_siswa");

while ($row = mysqli_fetch_assoc($data)) {
    $id = $row['id'];
    $akademik = $row['nilai_akademik'] / $pembagi_akademik;
    $iq = $row['nilai_iq'] / $pembagi_iq;
    $agama = $row['nilai_agama'] / $pembagi_agama;
    $nonakademik = $row['nilai_nonakademik'] / $pembagi_nonakademik;

    // 4. Hitung nilai akhir MOORA
    $skor = (0.4 * $akademik) + (0.3 * $iq) + (0.2 * $agama) + (0.1 * $nonakademik);

    // 5. Logika klasifikasi sederhana (bisa kamu kembangkan lagi)
    if ($akademik >= $nonakademik && $skor >= 0.5) {
        $hasil = 'IPA';
    } else {
        $hasil = 'IPS';
    }

    // 6. Simpan hasil ke database
    mysqli_query($conn, "UPDATE nilai_siswa SET hasil = '$hasil' WHERE id = '$id'");
}

header("Location: dashboard.php?pesan=proses_sukses");
exit;
?>
