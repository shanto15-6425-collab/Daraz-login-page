<?php
require 'config.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add' && isset($_POST['product_id'])) {
        $product_id = (int)$_POST['product_id'];
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        // Check if product exists and has stock
        $productResult = $conn->query("SELECT * FROM products WHERE id = $product_id AND stock > 0");
        
        if (!$productResult || $productResult->num_rows == 0) {
            echo json_encode(['success' => false, 'message' => 'Product not available']);
            exit;
        }

        // Check if already in cart
        $existingResult = $conn->query("SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id");
        
        if ($existingResult && $existingResult->num_rows > 0) {
            $existing = $existingResult->fetch_assoc();
            $newQuantity = $existing['quantity'] + $quantity;
            $conn->query("UPDATE cart SET quantity = $newQuantity WHERE user_id = $user_id AND product_id = $product_id");
            echo json_encode(['success' => true, 'message' => 'Product quantity updated in cart']);
        } else {
            $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)");
            echo json_encode(['success' => true, 'message' => 'Product added to cart']);
        }
    } elseif ($action == 'remove' && isset($_POST['product_id'])) {
        $product_id = (int)$_POST['product_id'];
        $conn->query("DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id");
        echo json_encode(['success' => true, 'message' => 'Product removed from cart']);
    } elseif ($action == 'update' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = (int)$_POST['product_id'];
        $quantity = (int)$_POST['quantity'];
        
        if ($quantity <= 0) {
            $conn->query("DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id");
        } else {
            $conn->query("UPDATE cart SET quantity = $quantity WHERE user_id = $user_id AND product_id = $product_id");
        }
        echo json_encode(['success' => true, 'message' => 'Cart updated']);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get cart items
    $result = $conn->query("
        SELECT c.*, p.name, p.price, p.stock 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = $user_id
    ");

    if ($result) {
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        echo json_encode(['success' => true, 'items' => $items]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error fetching cart']);
    }
}
?>
