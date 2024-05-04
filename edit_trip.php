<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $trip_id = $_POST['trip_id'];
  $location = $_POST['location'];
  $price = $_POST['price'];
  $tickets_left = $_POST['tickets_left'];
  $photo_url = $_POST['photo_url'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];

  $update_query = "UPDATE trips SET location='$location', price='$price', tickets_left='$tickets_left', photo_url='$photo_url', start_date='$start_date', end_date='$end_date' WHERE trip_id=$trip_id";
  mysqli_query($conn, $update_query);

  header("Location: admin.php");
  exit();
}

if (isset($_GET['trip_id'])) {
  $edit_trip_id = $_GET['trip_id'];
  $edit_query = "SELECT * FROM trips WHERE trip_id = $edit_trip_id";
  $result = mysqli_query($conn, $edit_query);
  $edit_row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="1.css">

  <title>Edit Trip</title>
</head>

<body>

  <nav>
    <ul>
      <li><a href="admin.php">Home</a></li>
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
      <h2>Edit Trip</h2>
      <input type="hidden" name="trip_id" value="<?php echo $edit_trip_id; ?>">

      <label for="location">Location:</label>
      <input type="text" name="location" value="<?php echo $edit_row['location']; ?>" required><br>

      <label for="price">Price:</label>
      <input type="text" name="price" value="<?php echo $edit_row['price']; ?>" required><br>

      <label for="tickets_left">Tickets Left:</label>
      <input type="text" name="tickets_left" value="<?php echo $edit_row['tickets_left']; ?>" required><br>

      <label for="photo_url">Photo Url:</label>
      <input type="text" name="photo_url" value="<?php echo $edit_row['photo_url']; ?>" required><br>

      <label for="start_date">Start Date:</label>
      <input type="date" name="start_date" value="<?php echo $edit_row['start_date']; ?>" required><br>

      <label for="end_date">End Date:</label>
      <input type="date" name="end_date" value="<?php echo $edit_row['end_date']; ?>" required><br>

      <input type="submit" value="Save Changes">
    </form>

  </div>

</body>

</html>

<?php
mysqli_close($conn);
?>