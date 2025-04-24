<?php
require '../db.php';

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$name || !$email || !$password) {
    echo "All fields are required.";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashedPassword);

if ($stmt->execute()) {
    session_start();
    $_SESSION['user_id'] = $conn->insert_id;
    header("Location: ../home.php");
} else {
    echo "Error: " . $stmt->error;
}


</body>
</html>
