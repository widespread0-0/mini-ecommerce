// this is under a sub file called api; thus, api/add_to_cart.php
<?php
require '../db.php';
session_start();

$userId = $_SESSION['user_id'] ?? null;
$productId = $_POST['product_id'] ?? null;
$quantity = $_POST['quantity'] ?? 1;

if (!$userId || !$productId) {
    echo "Missing information.";
    exit;
}

$check = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
$check->bind_param("ii", $userId, $productId);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    $conn->query("UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $userId AND product_id = $productId");
} else {
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $userId, $productId, $quantity);
    $stmt->execute();
}

header("Location: ../cart.php");
