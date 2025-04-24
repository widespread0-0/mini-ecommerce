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

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>

<h1>Login</h1>
<form method="POST" action="api/login.php">
  <label>Email:</label><br>
  <input type="email" name="email" required><br><br>

  <label>Password:</label><br>
  <input type="password" name="password" required><br><br>

  <button type="submit">Login</button>
</form>

</body>
</html>
