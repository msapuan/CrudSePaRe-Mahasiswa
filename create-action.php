<?php  
/**
 * Create Student Action Handler
 */

require_once __DIR__ . '/models/Student.php';

if (isset($_POST['create'])) {
    // Validate and sanitize input
    $data = [
        'nim' => trim($_POST['nim']),
        'nama' => trim($_POST['nama']),
        'semester' => trim($_POST['semester']),
        'jurusan' => trim($_POST['jurusan'])
    ];
    
    // Basic validation
    if (empty($data['nim']) || empty($data['nama']) || empty($data['semester']) || empty($data['jurusan'])) {
        die('All fields are required.');
    }
    
    $student = new Student();
    
    if ($student->create($data)) {
        header("Location: index.php?page=tampil");
        exit;
    } else {
        die('Failed to create student record.');
    }
}
?>