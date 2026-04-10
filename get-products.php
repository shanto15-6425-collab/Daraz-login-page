<?php
require 'config.php';

header('Content-Type: application/json');

// Get all products or filter by category
$query = "SELECT * FROM products WHERE stock > 0";

if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = $conn->real_escape_string($_GET['category']);
    $query .= " AND category = '$category'";
}

$query .= " ORDER BY created_at DESC";

$result = $conn->query($query);

if ($result) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode(['success' => true, 'products' => $products]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error fetching products']);
}
?>
