<!-- Display student data table -->
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Semester</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>

        <?php
            require_once __DIR__ . '/../models/Student.php';
            
            $limit = 5;
            $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
            $offset = ($page - 1) * $limit;
            
            $studentModel = new Student();
            
            // Check if search is active
            if (isset($_POST['search']) && $_POST['search'] == true && !empty($_POST['keyword'])) {
                $keyword = trim($_POST['keyword']);
                $result = $studentModel->search($keyword, $limit, $offset);
                $totalCount = $studentModel->count($keyword);
            } else {
                $result = $studentModel->getAll($limit, $offset);
                $totalCount = $studentModel->count();
            }
            
            $no = $offset + 1;
            
            while ($data = $result->fetch_assoc()) {
        ?>

        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($data['nim']); ?></td>
            <td><?php echo htmlspecialchars($data['nama']); ?></td>
            <td><?php echo htmlspecialchars($data['semester']); ?></td>
            <td><?php echo htmlspecialchars($data['jurusan']); ?></td>
            <td>
                <a href="edit.php?id_mhs=<?php echo $data['id_mhs']; ?>" class="btn btn-info">
                    <span class="glyphicon glyphicon-edit"></span> 
                    Edit
                </a>
                <a href="delete.php?id_mhs=<?php echo $data['id_mhs']; ?>" class="btn btn-danger" 
                   onclick="return confirm('Are you sure you want to delete this student?')">
                    <span class="glyphicon glyphicon-trash"></span> 
                    Delete
                </a>
            </td>
        </tr>

        <?php } ?>
        
    </table>
</div>

<?php
$count = $result->num_rows;

if ($count > 0):
    $totalPages = ceil($totalCount / $limit);
    $linkPrev = max(1, $page - 1);
    $linkNext = min($totalPages, $page + 1);
?>
    <ul class="pagination">
    <?php if ($page == 1): ?>
        <li class="disabled"><a href="#">First</a></li>
        <li class="disabled"><a href="#">&laquo;</a></li>
    <?php else: ?>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(1, false)">First</a></li>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $linkPrev; ?>, false)">&laquo;</a></li>
    <?php endif; ?>

    <?php
    $jumlahNumber = 3;
    $startNumber = ($page > $jumlahNumber) ? $page - $jumlahNumber : 1;
    $endNumber = ($page < ($totalPages - $jumlahNumber)) ? $page + $jumlahNumber : $totalPages;
    
    for ($i = $startNumber; $i <= $endNumber; $i++):
        $linkActive = ($page == $i) ? ' class="active"' : '';
    ?>
        <li<?php echo $linkActive; ?>>
            <a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $i; ?>, false)"><?php echo $i; ?></a>
        </li>
    <?php endfor; ?>

    <?php if ($page == $totalPages): ?>
        <li class="disabled"><a href="#">&raquo;</a></li>
        <li class="disabled"><a href="#">Last</a></li>
    <?php else: ?>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $linkNext; ?>, false)">&raquo;</a></li>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $totalPages; ?>, false)">Last</a></li>
    <?php endif; ?>
    </ul>
<?php endif; ?>
