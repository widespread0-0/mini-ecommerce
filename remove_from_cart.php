<?php
require '../db.php';

$itemId = $_POST['itemId'] ?? null;
if ($itemId) {
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
}
header("Location: ../cart.php");
