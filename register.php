<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $email = $_POST['email'];
  $phone_nr = $_POST['phone_nr'];
  $role = 'user';

  $query = "INSERT INTO users (name, password, email, role, phone_nr) VALUES ('$name', '$password', '$email', '$role', '$phone_nr')";

  if (mysqli_query($conn, $query)) {
    header("Location: login.php");
    exit();
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="1.css">
  <title>User Registration</title>
</head>

<body>


  <body>

    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>

    <div class="login-container">
      <form class="login-form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <h2>User Registration</h2>
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="phone_nr">Phone Nr:</label>
        <input type="phone_nr" name="phone_nr" required><br>

        <button type="submit">Register</button>
      </form>
    </div>



  </body>

</html>

<?php
mysqli_close($conn);
?>