<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT *
          FROM trips
          JOIN bookings ON trips.trip_id = bookings.trip_id
          WHERE bookings.user_id = $user_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="1.css">
  <title>My Booked Tickets</title>
</head>

<body>

  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li>
        <?php

        if (isset($_SESSION['user_id']) && !isset($_SESSION['admin'])) {
          echo '<a class="login-logout-btn" href="my_tickets.php">My Tickets</a>';
        }  ?> </li>
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
    <h2>My Booked Tickets</h2>

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
              <a href="cancel_trip.php?booking_id=<?php echo $row['booking_id']; ?>" class="admin-a">Cancel Trip</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

  </div>

</body>

</html>

<?php
mysqli_close($conn);
?>