<?php
/**
 * Delete Student Action Handler
 */

require_once __DIR__ . '/models/Student.php';

if (isset($_GET['id_mhs'])) {
    $id_mhs = (int)$_GET['id_mhs'];
    
    $student = new Student();
    
    if ($student->delete($id_mhs)) {
        header("Location: index.php?page=tampil");
        exit;
    } else {
        die('Failed to delete student record.');
    }
}
?>