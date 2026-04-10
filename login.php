<?php
require 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'login') {
        $rememberMe = isset($_POST['rememberMe']) ? 1 : 0;
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Check if login is by email or phone
        if (isset($_POST['email'])) {
            $emailPhone = $_POST['email'];
            $field = 'email';
        } elseif (isset($_POST['phone'])) {
            $emailPhone = $_POST['phone'];
            $field = 'phone';
        } else {
            echo json_encode(['success' => false, 'message' => 'Email or phone is required']);
            exit;
        }

        $emailPhone = $conn->real_escape_string($emailPhone);

        // Query user
        $query = "SELECT * FROM users WHERE $field = '$emailPhone'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name'];
                $_SESSION['logged_in'] = true;
                $_SESSION['login_time'] = time();

                // Save to localStorage preference
                if ($field == 'email') {
                    setcookie('saved_email_preference', $user['email'], time() + COOKIE_LIFETIME, '/');
                } else {
                    setcookie('saved_phone_preference', $user['phone'], time() + COOKIE_LIFETIME, '/');
                }

                // Handle remember me
                if ($rememberMe) {
                    // Generate token
                    $token = bin2hex(random_bytes(32));
                    $expiresAt = date('Y-m-d H:i:s', time() + COOKIE_LIFETIME);

                    // Save token in database
                    $tokenQuery = "INSERT INTO remember_me_tokens (user_id, token, expires_at) 
                                   VALUES (" . $user['id'] . ", '" . $conn->real_escape_string($token) . "', '$expiresAt')";
                    $conn->query($tokenQuery);

                    // Set cookie
                    setcookie('remember_token', $token, time() + COOKIE_LIFETIME, '/', '', false, true);
                }

                echo json_encode([
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => [
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'name' => $_SESSION['name']
                    ]
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid password']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
    }
} else {
    // Return current session info if already logged in
    if (isset($_SESSION['user_id'])) {
        echo json_encode([
            'success' => true,
            'logged_in' => true,
            'user' => [
                'id' => $_SESSION['user_id'],
                'email' => $_SESSION['email'],
                'name' => $_SESSION['name']
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'logged_in' => false]);
    }
}
?>
