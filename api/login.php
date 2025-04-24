<?php
require '../db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    header("Location: ../home.php");
} else {
    echo "Invalid login credentials.";
}
