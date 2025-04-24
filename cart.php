<?php
require 'db.php';
session_start();

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    header("Location: login.php");
    exit;
}

// Get user cart items
$query = "SELECT c.id AS cart_id, p.name, p.price, c.quantity
          FROM cart c
          JOIN products p ON c.product_id = p.id
          WHERE c.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head><title>Your Cart</title></head>
<body>

<h1>Your Cart</h1>

<?php
$total = 0;
while ($row = $result->fetch_assoc()):
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
?>
  <div>
    <p><strong><?php echo $row['name']; ?></strong></p>
    <p>Price: NGN <?php echo number_format($row['price'], 2); ?></p>
    <p>Quantity: <?php echo $row['quantity']; ?></p>
    <p>Subtotal: NGN <?php echo number_format($subtotal, 2); ?></p>
    
    <form method="POST" action="api/remove_from_cart.php">
      <input type="hidden" name="itemId" value="<?php echo $row['cart_id']; ?>">
      <button type="submit">Remove</button>
    </form>
  </div>
  <hr>
<?php endwhile; ?>

<h3>Total: NGN <?php echo number_format($total, 2); ?></h3>

<form method="POST" action="checkout.php">
  <button type="submit">Proceed to Checkout</button>
</form>

</body>
</html>

