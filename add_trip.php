<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $location = $_POST['location'];
  $price = $_POST['price'];
  $tickets_left = $_POST['tickets_left'];
  $photo_url = $_POST['photo_url'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];

  $insert_query = "INSERT INTO trips (location, price, tickets_left, photo_url, start_date, end_date) VALUES ('$location', '$price', '$tickets_left', '$photo_url', '$start_date', '$end_date')";
  mysqli_query($conn, $insert_query);

  header("Location: admin.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="1.css">

  <title>Add New Trip</title>
</head>

<body>

  <nav>
    <ul>
      <li><a href="landing_page.php">Home</a></li>
      <li><a href="#">About Us</a></li>
      <li><a href="#">Contact</a></li>
      <?php
      if (isset($_SESSION['user_id'])) {
        echo '<a class="login-logout-btn" href="logout.php">Logout</a>';
      } else {
        echo '<a class="login-logout-btn" href="login.php">Login</a>';
      }
      ?>
    </ul>
  </nav>
  <div class="container">

    <form class="login-form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <h2>Add New Trip</h2>

      <label for="location">Location:</label>
      <input type="text" name="location" required><br>

      <label for="price">Price:</label>
      <input type="text" name="price" required><br>

      <label for="tickets_left">Tickets Left:</label>
      <input type="text" name="tickets_left" required><br>

      <label for="photo_url">Photo Url:</label>
      <input type="text" name="photo_url" required><br>

      <label for="start_date">Start Date:</label>
      <input type="date" name="start_date" required><br>

      <label for="end_date">End Date:</label>
      <input type="date" name="end_date" required><br>

      <input type="submit" value="Add Trip">
    </form>
  </div>

</body>

</html>

<?php
mysqli_close($conn);
?>