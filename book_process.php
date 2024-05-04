<?php
include 'db_connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trip_id'])) {
  $trip_id = $_POST['trip_id'];



  $user_id = $_SESSION['user_id'];
  echo "Trip ID: $trip_id";
  echo "User ID: $user_id";
  $insert_query = "INSERT INTO bookings (user_id, trip_id) VALUES ('$user_id', '$trip_id')";
  $result = mysqli_query($conn, $insert_query);

  if ($result) {
    $update_query = "UPDATE trips SET tickets_left = tickets_left - 1 WHERE trip_id = '$trip_id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
      header("Location: book.php?trip_id=$trip_id&success=true");
      exit();
    } else {
      echo "Error updating tickets_left.";
    }
  } else {
    echo "Error booking the trip.";
  }
} else {
  header("Location: landing_page.php");
  exit();
}
