<?php
require 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'register') {
        $firstName = isset($_POST['firstName']) ? $conn->real_escape_string($_POST['firstName']) : '';
        $lastName = isset($_POST['lastName']) ? $conn->real_escape_string($_POST['lastName']) : '';
        $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? $conn->real_escape_string($_POST['phone']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $city = isset($_POST['city']) ? $conn->real_escape_string($_POST['city']) : '';
        $address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : '';

        // Validation
        if (!$firstName || !$lastName || !$email || !$phone || !$password) {
            echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
            exit;
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email format']);
            exit;
        }

        // Validate phone format
        if (!preg_match('/^[0-9]{10,14}$/', $phone)) {
            echo json_encode(['success' => false, 'message' => 'Invalid phone number format']);
            exit;
        }

        // Check if email already exists
        $emailCheck = $conn->query("SELECT id FROM users WHERE email = '$email'");
        if ($emailCheck && $emailCheck->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Email already registered']);
            exit;
        }

        // Check if phone already exists
        $phoneCheck = $conn->query("SELECT id FROM users WHERE phone = '$phone'");
        if ($phoneCheck && $phoneCheck->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Phone number already registered']);
            exit;
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert user
        $query = "INSERT INTO users (email, phone, password, first_name, last_name, city, address) 
                  VALUES ('$email', '$phone', '$hashedPassword', '$firstName', '$lastName', '$city', '$address')";

        if ($conn->query($query)) {
            echo json_encode([
                'success' => true,
                'message' => 'Account created successfully. Please login.',
                'user_id' => $conn->insert_id
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error creating account: ' . $conn->error]);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
