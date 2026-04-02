<?php
/**
 * Update Student Action Handler
 */

require_once __DIR__ . '/models/Student.php';

$student = new Student();

if (isset($_POST['edit'])) {
    // Validate and sanitize input
    $data = [
        'nim' => trim($_POST['nim']),
        'nama' => trim($_POST['nama']),
        'semester' => trim($_POST['semester']),
        'jurusan' => trim($_POST['jurusan'])
    ];
    
    $id_mhs = (int)$_POST['id_mhs'];
    
    // Basic validation
    if (empty($data['nim']) || empty($data['nama']) || empty($data['semester']) || empty($data['jurusan'])) {
        die('All fields are required.');
    }
    
    if ($student->update($id_mhs, $data)) {
        header("Location: index.php?page=tampil");
        exit;
    } else {
        die('Failed to update student record.');
    }
} elseif (isset($_POST['back'])) {
    header("Location: index.php?page=tampil");
    exit;
}
?>