<?php
/**
 * Student Model
 * Handles all database operations for mahasiswa (students)
 */

require_once __DIR__ . '/../config/database.php';

class Student {
    private $conn;
    private $table = 'tbl_mahasiswa';
    
    public function __construct() {
        $this->conn = getDbConnection();
    }
    
    /**
     * Get all students with pagination
     * @param int $limit Number of records per page
     * @param int $offset Starting record number
     * @return mysqli_result Query result
     */
    public function getAll($limit = 5, $offset = 0) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        return $stmt->get_result();
    }
    
    /**
     * Search students by keyword
     * @param string $keyword Search term
     * @param int $limit Number of records per page
     * @param int $offset Starting record number
     * @return mysqli_result Query result
     */
    public function search($keyword, $limit = 5, $offset = 0) {
        $param = "%{$keyword}%";
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} 
             WHERE nim LIKE ? OR nama LIKE ? OR semester LIKE ? OR jurusan LIKE ? 
             LIMIT ? OFFSET ?"
        );
        $stmt->bind_param("ssssii", $param, $param, $param, $param, $limit, $offset);
        $stmt->execute();
        return $stmt->get_result();
    }
    
    /**
     * Count total students
     * @param string|null $keyword Optional search keyword
     * @return int Total count
     */
    public function count($keyword = null) {
        if ($keyword) {
            $param = "%{$keyword}%";
            $stmt = $this->conn->prepare(
                "SELECT COUNT(*) as jumlah FROM {$this->table} 
                 WHERE nim LIKE ? OR nama LIKE ? OR semester LIKE ? OR jurusan LIKE ?"
            );
            $stmt->bind_param("ssss", $param, $param, $param, $param);
        } else {
            $stmt = $this->conn->prepare("SELECT COUNT(*) as jumlah FROM {$this->table}");
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return (int)$result['jumlah'];
    }
    
    /**
     * Get student by ID
     * @param int $id Student ID
     * @return array|null Student data or null if not found
     */
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id_mhs = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }
    
    /**
     * Create new student
     * @param array $data Student data [nim, nama, semester, jurusan]
     * @return bool Success status
     */
    public function create($data) {
        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->table} (nim, nama, semester, jurusan) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $data['nim'], $data['nama'], $data['semester'], $data['jurusan']);
        return $stmt->execute();
    }
    
    /**
     * Update student data
     * @param int $id Student ID
     * @param array $data Student data [nim, nama, semester, jurusan]
     * @return bool Success status
     */
    public function update($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->table} SET nim=?, nama=?, semester=?, jurusan=? WHERE id_mhs=?"
        );
        $stmt->bind_param("ssssi", $data['nim'], $data['nama'], $data['semester'], $data['jurusan'], $id);
        return $stmt->execute();
    }
    
    /**
     * Delete student
     * @param int $id Student ID
     * @return bool Success status
     */
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id_mhs = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    /**
     * Get all students for report
     * @return mysqli_result Query result
     */
    public function getAllForReport() {
        return $this->conn->query("SELECT * FROM {$this->table} ORDER BY nim ASC");
    }
}
