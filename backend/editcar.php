<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "db_connection.php";

    $car_id = $_POST["car_id"]; // assume you're passing the car ID as a hidden field in the edit form

    // Initialize an empty array to store the updated fields
    $updated_fields = array();

    // Check if the user changed the model
    if (!empty($_POST["model"])) {
        $updated_fields["model"] = $_POST["model"];
    }

    // Check if the user changed the year
    if (!empty($_POST["year"])) {
        $updated_fields["year"] = $_POST["year"];
    }

    // Check if the user changed the price
    if (!empty($_POST["price"])) {
        $updated_fields["price"] = $_POST["price"];
    }

    // Check if the user changed the color
    if (!empty($_POST["color"])) {
        $updated_fields["color"] = $_POST["color"];
    }

    // Check if the user changed the power
    if (!empty($_POST["power"])) {
        $updated_fields["power"] = $_POST["power"];
    }

    // Check if the user changed the transmission
    if (!empty($_POST["transmission"])) {
        $updated_fields["transmission"] = $_POST["transmission"];
    }

    // Check if the user changed the image
    if (!empty($_FILES["img"]["name"])) {
        $target_dir = "../img/"; // Specify the directory where you want to store uploaded images
        $target_file = $target_dir. basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        $updated_fields["img"] = $_FILES["img"]["name"];
    }

    // Check if the user changed the branch name
    if (!empty($_POST["branch_name"])) {
        $updated_fields["branch_name"] = $_POST["branch_name"];
    }

    // Check if the user changed the out of service status
    if (isset($_POST["out_of_service"])) {
        $updated_fields["out_of_service"] = "T";
    } else {
        $updated_fields["out_of_service"] = "F";
    }

    // Build the UPDATE query
    $sql = "UPDATE car SET ";
    foreach ($updated_fields as $field => $value) {
        $sql.= "$field = '$value', ";
    }
    $sql = rtrim($sql, ", "); // remove trailing comma and space
    $sql.= " WHERE car_id = '$car_id'";


    if ($conn->query($sql) === TRUE) {
        $_SESSION['toastType'] = 'success';
        $_SESSION['toastMessage'] = "Car edited successfully!";
    } else {
        $_SESSION['toastType'] = 'failure';
        $_SESSION['toastMessage'] = "Error: Unable to edit car.";
    }
    header("Location:../admindashboard.php");

    // Close statement and connection
    $conn->close();
}
?>