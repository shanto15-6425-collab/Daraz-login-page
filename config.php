<?php
// config.php - Database Connection
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'daraz_ecommerce');
define('SITE_URL', 'http://localhost/Lab/');
define('COOKIE_LIFETIME', 30 * 24 * 60 * 60); // 30 days

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

// Session configuration
ini_set('session.gc_maxlifetime', 30 * 24 * 60 * 60); // 30 days
session_start();

// Check if user has remember me cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];
    $result = $conn->query("
        SELECT rt.user_id FROM remember_me_tokens rt
        WHERE rt.token = '" . $conn->real_escape_string($token) . "'
        AND rt.expires_at > NOW()
    ");
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        
        // Get user details
        $user_result = $conn->query("SELECT * FROM users WHERE id = " . $row['user_id']);
        if ($user_result && $user_result->num_rows > 0) {
            $user = $user_result->fetch_assoc();
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name'];
        }
    }
}
?>
