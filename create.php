<h2 class="text-center">Input Data</h2><hr><br><br>

<!-- form input data mahasiswa -->
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form method='post' action='create-action.php'>
            <div class="form-group">
                <label>NIM</label>
                <input type="text" class="form-control" name="nim" placeholder="Masukkan NIM ..." required>
            </div>
            <div class="form-group">
                <label>Nama Mahasiswa</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama ..." required>
            </div>
            <div class="form-group">
                <label>Semester</label>
                <input type="text" class="form-control" name="semester" placeholder="Masukkan Semester ..." maxlength="3" required>
            </div>
            <div class="form-group">
                <label>Jurusan</label>
                <select name="jurusan" class="form-control">
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="S1 - Teknik Informatika">S1 - Teknik Informatika</option>
                    <option value="D3 - Manajemen Informatika">D3 - Manajemen Informatika</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="create">Submit</button>
            <button type="reset" class="btn btn-warning">Reset</button>
        </form>
    </div>
</div>
