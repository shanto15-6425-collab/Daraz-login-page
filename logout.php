<?php
require 'config.php';

// Clear session
session_destroy();

// Clear remember me cookie
setcookie('remember_token', '', time() - 3600, '/');

header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
?>
