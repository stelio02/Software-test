<?php
include 'db_connect.php';


session_start();

if (!isset($_GET['trip_id']) || empty($_GET['trip_id'])) {
  header("Location: landing_page.php");
  exit();
}

$trip_id = $_GET['trip_id'];

$query = "SELECT * FROM trips WHERE trip_id = $trip_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
  header("Location: landing_page.php");
  exit();
}

$trip = mysqli_fetch_assoc($result);

$alreadyBooked = false;

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $checkQuery = "SELECT * FROM bookings WHERE user_id = $user_id AND trip_id = $trip_id";
  $checkResult = mysqli_query($conn, $checkQuery);

  if ($checkResult && mysqli_num_rows($checkResult) > 0) {
    $alreadyBooked = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="1.css">
  <title>Book Trip</title>
  <style>
    .confirmation {
      background-color: #dff0d8;
      border: 1px solid #d6e9c6;
      color: #3c763d;
      padding: 15px;
      margin: 20px auto;
      max-width: 400px;
      border-radius: 5px;
    }

    .confirmation h2 {
      margin-top: 0;
      color: #3c763d;
    }

    .login-prompt {
      margin-top: 20px;
      font-weight: bold;
    }

    .login-btn {
      background-color: #3498db;
      color: #fff;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
    }
  </style>
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

  <div class="trip-card-view">
    <h2>Book Trip: <?php echo $trip['location']; ?></h2>
    <img src="<?php echo $trip['photo_url']; ?>" alt="Trip Photo" height="200" width="200">
    <p>Price: $<?php echo $trip['price']; ?></p>
    <p>Tickets Left: <?php echo $trip['tickets_left']; ?></p>
    <p>Start Date: <?php echo $trip['start_date']; ?></p>
    <p>End Date: <?php echo $trip['end_date']; ?></p>
    <p>Duration: <?php
                  $start_date = new DateTime($trip['start_date']);
                  $end_date = new DateTime($trip['end_date']);
                  $interval = $start_date->diff($end_date);
                  echo $interval->format('%a');
                  ?> days</p>
    <p>Hotel: <?php echo $trip['details']; ?></p>

    <?php
    if (!isset($_SESSION['user_id'])) {
      echo '<div class="login-prompt">
                <p>Please log in to book this trip.</p>
                <a class="login-btn" href="login.php?redirect=book.php">Login</a>
              </div>';
    } else {
      if ($alreadyBooked) {
        echo '<div class="confirmation">
                <h2>Trip Already Booked!</h2>
                <p>You have already booked this trip. Thank you for choosing us!</p>
              </div>';
      } else {
        echo '<form method="post" action="book_process.php">
                  <input type="hidden" name="trip_id" value="' . $trip_id . '">
                  <button class="login-btn" type="submit">Book</button>
                </form>';
      }
    }
    ?>
  </div>

  <?php
  if (isset($_GET['success']) && $_GET['success'] == true) {
    echo '<div class="confirmation">
                <h2>Booking Successful!</h2>
                <p>Thank you for booking the trip. We look forward to having you on board!</p>
              </div>';
  }
  ?>

</body>

</html>