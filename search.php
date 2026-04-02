<?php
/**
 * Search Handler (AJAX)
 * Returns search results as JSON
 */

header('Content-Type: application/json');

// Capture the output from view.php
ob_start();
include __DIR__ . '/view.php';
$html = ob_get_contents();
ob_end_clean();

echo json_encode(['hasil' => $html]);
?>
