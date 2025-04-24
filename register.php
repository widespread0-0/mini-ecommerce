//this is for api/register.php
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

// this is for register.php(html)
<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>

<h1>Register</h1>
<form method="POST" action="api/register.php">
  <label>Name:</label><br>
  <input type="text" name="name" required><br><br>

  <label>Email:</label><br>
  <input type="email" name="email" required><br><br>

  <label>Password:</label><br>
  <input type="password" name="password" required><br><br>

  <button type="submit">Register</button>
</form>

</body>
</html>
