<?php
/**
 * Database Connection (Legacy Compatibility)
 * Deprecated: Use config/database.php instead
 */

require_once __DIR__ . '/config/database.php';
$conn = getDbConnection();
?>