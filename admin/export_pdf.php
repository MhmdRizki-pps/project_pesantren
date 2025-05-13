<?php
require_once '../vendor/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

include '../includes/config.php';

$html = '<h3 style="text-align:center;">Data Hasil Penempatan Kelas Siswa</h3>';
$html .= '<table border="1" width="100%" cellpadding="5" cellspacing="0">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Akademik</th>
    <th>IQ</th>
    <th>Keagamaan</th>
    <th>Non-Akademik</th>
    <th>Hasil</th>
</tr>';

$no = 1;
$query = mysqli_query($conn, "SELECT users.nama, n.* FROM nilai_siswa n JOIN users ON n.user_id = users.id");

while ($row = mysqli_fetch_assoc($query)) {
    $html .= "<tr>
        <td>{$no}</td>
        <td>{$row['nama']}</td>
        <td>{$row['nilai_akademik']}</td>
        <td>{$row['nilai_iq']}</td>
        <td>{$row['nilai_agama']}</td>
        <td>{$row['nilai_nonakademik']}</td>
        <td>{$row['hasil']}</td>
    </tr>";
    $no++;
}

$html .= '</table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('hasil_penempatan_kelas.pdf', ['Attachment' => 0]);
exit;
?>
