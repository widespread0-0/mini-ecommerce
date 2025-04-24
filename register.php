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
