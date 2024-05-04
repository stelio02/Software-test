<?php
include 'db_connect.php';
session_start();


$query = "SELECT * FROM trips";
$result = mysqli_query($conn, $query);

if (!$result) {
  die("Error in query: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="1.css">

  <title>Tourist Agency</title>

</head>

<body>

  <nav>
    <ul>
      <li><a href="landing_page.php">Home</a></li>
      <li> <?php

            if (isset($_SESSION['user_id']) && !isset($_SESSION['admin'])) {
              echo '<a class="login-logout-btn" href="my_tickets.php">My Tickets</a>';
            }  ?>
      </li>
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
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <div class="trip-card">
        <img src="<?php echo $row['photo_url']; ?>" alt="Trip Photo">
        <h3><?php echo $row['location']; ?></h3>
        <p>Price: $<?php echo $row['price']; ?></p>
        <p>Tickets Left: <?php echo $row['tickets_left']; ?></p>
        <p>Start Date: <?php echo $row['start_date']; ?></p>
        <p>End Date: <?php echo $row['end_date']; ?></p>
        <p>Duration: <?php
                      $start_date = new DateTime($row['start_date']);
                      $end_date = new DateTime($row['end_date']);
                      $interval = $start_date->diff($end_date);
                      echo $interval->format('%a');
                      ?> days</p>
        <p>Hotel: <?php echo $row['details']; ?></p>
        <a href="book.php?trip_id=<?php echo $row['trip_id']; ?>">Book Now</a>
      </div>
    <?php endwhile; ?>
  </div>

</body>

</html>

<?php
mysqli_close($conn);
?>