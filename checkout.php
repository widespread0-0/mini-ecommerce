<?php
require 'db.php';
session_start();

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    header("Location: login.php");
    exit;
}

$query = "SELECT p.name, p.price, c.quantity 
          FROM cart c 
          JOIN products p ON c.product_id = p.id 
          WHERE c.user_id = $userId";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head><title>Checkout</title></head>
<body>

<h1>Checkout</h1>

<ul>
<?php while ($row = $result->fetch_assoc()): ?>
  <li><?php echo $row['name']; ?> x<?php echo $row['quantity']; ?> – NGN <?php echo $row['price']; ?></li>
<?php endwhile; ?>
</ul>

<form method="POST" action="api/checkout.php">
  <button type="submit">Confirm Order</button>
</form>

</body>
</html>

