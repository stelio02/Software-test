<?php
include 'db_connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  if ($row && password_verify($password, $row['password'])) {
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['email'] = $row['email'];

    if ($row['role'] == 'admin') {
      $_SESSION['admin'] = true;
      header("Location: admin.php");
    } else {
      header("Location: index.php");
    }

    exit();
  } else {
    $login_error = "Invalid email or password";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="1.css">
  <title>Login</title>
</head>

<body>

  <nav>
    <ul>
      <li><a href="landing_page.php">Home</a></li>
      <li><a href="#">About Us</a></li>
      <li><a href="#">Contact</a></li>
      <li><a href="register.php">Register</a></li>
    </ul>
  </nav>

  <div class="login-container">
    <form class="login-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <h2>Login</h2>
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>
  </div>


</body>

</html>