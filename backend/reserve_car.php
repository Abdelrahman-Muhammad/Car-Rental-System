<?php
session_start();
include 'db_connection.php';

if (isset($_POST['carId']) && isset($_SESSION['ssn'])) {

  $carId = $_POST['carId'];
  $ssn = $_SESSION['ssn'];
  $pickupTime = $_POST['pickup_time'];
  $returnTime = $_POST['return_time'];
  $isPaid = isset($_POST['is_paid'])? 'Y' : 'N';
  $total_price = $_POST['total_price'];

  $query = "SELECT * FROM reservation 
  WHERE car_id = '$carId' 
  AND (( '$pickupTime' >= pickup_time AND '$pickupTime' < return_time) 
    OR ('$returnTime' > pickup_time AND '$returnTime' <= return_time) 
    OR ('$pickupTime' <= pickup_time AND '$returnTime' >= return_time))";
//This query checks for three scenarios:

    //The new pickupTime is within an existing reservation period
    //The new returnTime is within an existing reservation period
    //The new reservation period overlaps with an existing reservation period

    $result = $conn->query($query);

  if ($result->num_rows > 0) {
    // Car is not available for the desired period
    echo "Error: Car is not available for the desired period.";
    exit;
  }

  // Get the car's current location from the database

  $query = "SELECT branch_name FROM car WHERE car_id = '$carId'";
  $result = $conn->query($query);
  if (!$result) {
    echo "Error: ". $conn->error;
  } else {

    // Insert a new reservation into the database
    $query = "INSERT INTO reservation (car_id, ssn, pickup_time, return_time, is_paid, reservation_time,total_price) 
               VALUES ('$carId', '$ssn', '$pickupTime', '$returnTime', '$isPaid', NOW(),'$total_price')";
    if (!$conn->query($query)) {
      echo "Error: ". $conn->error;
    } else {
      echo "Car reserved successfully!";
    }
  }
} else {

  echo "Error: missing car ID or SSN";
}
?>