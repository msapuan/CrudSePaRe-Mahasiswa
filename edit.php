<?php
/**
 * Edit Student Form
 */

require_once __DIR__ . '/models/Student.php';

$studentModel = new Student();

// Get student ID from URL
if (!isset($_GET['id_mhs'])) {
    die('Student ID is required.');
}

$id_mhs = (int)$_GET['id_mhs'];
$student = $studentModel->getById($id_mhs);

if (!$student) {
    die('Student not found.');
}

include 'top.php';
include 'navbar.php';
?>

<div class="container">
    <h2 class="text-center">Edit Data</h2><hr><br><br>

    <!-- form edit data mahasiswa -->
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form method='post' action='update.php'>
                <input type="hidden" name="id_mhs" value="<?php echo htmlspecialchars($student['id_mhs']); ?>">
                
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" class="form-control" name="nim" placeholder="Masukkan NIM ..." 
                           required value="<?php echo htmlspecialchars($student['nim']); ?>">
                </div>
                <div class="form-group">
                    <label>Nama Mahasiswa</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama ..." 
                           required value="<?php echo htmlspecialchars($student['nama']); ?>">
                </div>
                <div class="form-group">
                    <label>Semester</label>
                    <input type="text" class="form-control" name="semester" placeholder="Masukkan Semester ..." 
                           maxlength="3" required value="<?php echo htmlspecialchars($student['semester']); ?>">
                </div>
                <div class="form-group">
                    <label>Jurusan</label>
                    <select name="jurusan" class="form-control">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="S1 - Teknik Informatika" <?php if($student['jurusan'] == 'S1 - Teknik Informatika'){ echo 'selected'; } ?>>
                            S1 - Teknik Informatika
                        </option>
                        <option value="D3 - Manajemen Informatika" <?php if($student['jurusan'] == 'D3 - Manajemen Informatika'){ echo 'selected'; } ?>>
                            D3 - Manajemen Informatika
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                <button type="submit" class="btn btn-warning" name="back">Back</button>
            </form>
        </div>
    </div>
</div> 

<?php
include 'bottom.php';
?>
