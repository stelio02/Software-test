<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['booking_id'])) {
  $booking_id = $_GET['booking_id'];

  $check_booking_query = "SELECT * FROM bookings WHERE user_id = $user_id AND booking_id = $booking_id";
  $check_booking_result = mysqli_query($conn, $check_booking_query);

  if (mysqli_num_rows($check_booking_result) > 0) {
    $cancel_booking_query = "DELETE FROM bookings WHERE user_id = $user_id AND booking_id = $booking_id";
    $cancel_booking_result = mysqli_query($conn, $cancel_booking_query);

    $add_ticket_query = "UPDATE trips SET tickets_left = tickets_left + 1 WHERE trip_id = (SELECT trip_id FROM bookings WHERE booking_id = $booking_id)";
    $add_ticket_result = mysqli_query($conn, $add_ticket_query);

    if ($cancel_booking_result) {
      header("Location: my_tickets.php");
      exit();
    } else {
      echo "Error canceling booking.";
    }
  } else {
    echo "You haven't booked this trip.";
  }
} else {
  echo "Invalid request.";
}
