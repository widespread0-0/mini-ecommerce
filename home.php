<?php
require 'db.php';
session_start();

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head><title>Home</title></head>
<body>

<h1>Available Products</h1>

<?php while ($row = $result->fetch_assoc()): ?>
  <div>
    <p><strong><?php echo $row['name']; ?></strong></p>
    <p><?php echo $row['description']; ?></p>
    <p>Price: NGN <?php echo $row['price']; ?></p>
    <p>Seller: <?php echo $row['seller']; ?></p>
    <form method="POST" action="api/add_to_cart.php">
      <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
      <input type="number" name="quantity" value="1" min="1">
      <button type="submit">Add to Cart</button>
    </form>
  </div>
  <hr>
<?php endwhile; ?>

</body>
</html>
