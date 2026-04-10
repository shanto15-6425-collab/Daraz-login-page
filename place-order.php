<?php
require 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'place_order') {
        $firstName = $conn->real_escape_string($_POST['firstName']);
        $lastName = $conn->real_escape_string($_POST['lastName']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $address = $conn->real_escape_string($_POST['address']);
        $city = $conn->real_escape_string($_POST['city']);
        $paymentMethod = $conn->real_escape_string($_POST['paymentMethod']);
        $totalAmount = isset($_POST['totalAmount']) ? (float)$_POST['totalAmount'] : 0;

        // Get cart items
        $cartResult = $conn->query("
            SELECT c.*, p.price 
            FROM cart c 
            JOIN products p ON c.product_id = p.id 
            WHERE c.user_id = $user_id
        ");

        if (!$cartResult || $cartResult->num_rows == 0) {
            echo json_encode(['success' => false, 'message' => 'Cart is empty']);
            exit;
        }

        // Prepare shipping address
        $shippingAddress = "$firstName $lastName, $address, $city\nPhone: $phone\nEmail: $email";

        // Insert order
        $orderQuery = "INSERT INTO orders (user_id, total_amount, status, shipping_address) 
                      VALUES ($user_id, $totalAmount, 'pending', '$shippingAddress')";

        if (!$conn->query($orderQuery)) {
            echo json_encode(['success' => false, 'message' => 'Error creating order']);
            exit;
        }

        $orderId = $conn->insert_id;

        // Insert order items
        $cartResult = $conn->query("
            SELECT c.*, p.price 
            FROM cart c 
            JOIN products p ON c.product_id = p.id 
            WHERE c.user_id = $user_id
        ");

        $cartItems = [];
        while ($item = $cartResult->fetch_assoc()) {
            $cartItems[] = $item;
            $quantity = $item['quantity'];
            $price = $item['price'];
            $productId = $item['product_id'];

            $itemQuery = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                         VALUES ($orderId, $productId, $quantity, $price)";
            $conn->query($itemQuery);

            // Reduce stock
            $conn->query("UPDATE products SET stock = stock - $quantity WHERE id = $productId");
        }

        // Clear cart
        $conn->query("DELETE FROM cart WHERE user_id = $user_id");

        echo json_encode([
            'success' => true,
            'message' => 'Order placed successfully',
            'order_id' => $orderId,
            'payment_method' => $paymentMethod
        ]);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get user's orders
    $result = $conn->query("
        SELECT * FROM orders 
        WHERE user_id = $user_id 
        ORDER BY created_at DESC
    ");

    if ($result) {
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            // Get items for each order
            $itemsResult = $conn->query("
                SELECT oi.*, p.name, p.category 
                FROM order_items oi 
                JOIN products p ON oi.product_id = p.id 
                WHERE oi.order_id = " . $row['id']
            );

            $items = [];
            while ($itemRow = $itemsResult->fetch_assoc()) {
                $items[] = $itemRow;
            }

            $row['items'] = $items;
            $orders[] = $row;
        }
        echo json_encode(['success' => true, 'orders' => $orders]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error fetching orders']);
    }
}
?>
