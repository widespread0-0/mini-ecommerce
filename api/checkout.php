<?php
require '../db.php';
session_start();

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    header("Location: ../login.php");
    exit;
}

$result = $conn->query("SELECT * FROM cart WHERE user_id = $userId");

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

$conn->query("INSERT INTO orders (user_id, created_at) VALUES ($userId, NOW())");
$orderId = $conn->insert_id;

foreach ($items as $item) {
    $conn->query("INSERT INTO order_items (order_id, product_id, quantity) 
                  VALUES ($orderId, {$item['product_id']}, {$item['quantity']})");
}

$conn->query("DELETE FROM cart WHERE user_id = $userId");

echo "Order placed successfully!";
