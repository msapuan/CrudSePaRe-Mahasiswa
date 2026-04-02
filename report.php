<?php
/**
 * Generate PDF Report for Students
 */

require_once __DIR__ . '/models/Student.php';

$studentModel = new Student();
$result = $studentModel->getAllForReport();

$content = '
<style type="text/css">
    h2 { text-align: center; }
    th { text-align: center; }
    table { border-collapse: collapse; width: 100%; }
    td, th { border: 1px solid #000; padding: 10px; }
</style>

<h2>Laporan Data Mahasiswa</h2>
<hr><br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No.</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Semester</th>
            <th>Jurusan</th>
        </tr>
    </thead>
    <tbody>
';

$no = 1;
while ($data = $result->fetch_assoc()) {
    $content .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . htmlspecialchars($data['nim']) . '</td>
            <td>' . htmlspecialchars($data['nama']) . '</td>
            <td>' . htmlspecialchars($data['semester']) . '</td>
            <td>' . htmlspecialchars($data['jurusan']) . '</td>
        </tr>
    ';
}

$content .= '
    </tbody>
</table>
';

require_once __DIR__ . '/assets/html2pdf/html2pdf.class.php';
$html2pdf = new HTML2PDF('P', 'A4', 'en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('crudsepa-mahasiswa.pdf', 'D');
?>