<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

if (isset($_GET['delete_trip_id'])) {
  $delete_trip_id = $_GET['delete_trip_id'];
  $delete_query = "DELETE FROM trips WHERE trip_id = $delete_trip_id";
  mysqli_query($conn, $delete_query);
  header("Location: admin.php");
  exit();
}

if (isset($_GET['edit_trip_id'])) {
  $edit_trip_id = $_GET['edit_trip_id'];
  header("Location: edit_trip.php?trip_id=$edit_trip_id");
  exit();
}

$query = "SELECT * FROM trips";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="1.css">
  <title>Admin Panel</title>
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
    <h1>Welcome, Admin!</h1>


    <table>
      <thead>
        <tr>
          <th>Location</th>
          <th>Price</th>
          <th>Tickets Left</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Duration</th>
          <th>Details</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['tickets_left']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <td><?php
                $start_date = new DateTime($row['start_date']);
                $end_date = new DateTime($row['end_date']);
                $interval = $start_date->diff($end_date);
                echo $interval->format('%a');
                ?> days</td>
            <td><?php echo $row['details']; ?></td>

            <td>
              <a href="admin.php?delete_trip_id=<?php echo $row['trip_id']; ?>" class="admin-a">Delete</a>
              <a href="admin.php?edit_trip_id=<?php echo $row['trip_id']; ?>" class="admin-a">Edit</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <a href="add_trip.php" class="admin-a">Add New Trip</a>

  </div>


</body>

</html>

<?php
mysqli_close($conn);
?>