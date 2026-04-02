<?php
/**
 * Database Configuration
 * Centralized database connection settings
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'crudsepa_mahasiswa');

/**
 * Create and return database connection
 * @return mysqli|false Database connection or false on failure
 */
function getDbConnection() {
    static $conn = null;
    
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($conn->connect_error) {
            error_log("Database connection failed: " . $conn->connect_error);
            die('Database connection failed. Please check your configuration.');
        }
        
        $conn->set_charset("utf8mb4");
    }
    
    return $conn;
}

/**
 * Close database connection
 */
function closeDbConnection() {
    global $conn;
    if ($conn) {
        $conn->close();
        $conn = null;
    }
}
