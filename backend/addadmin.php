<?php
session_start();
include "db_connection.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "db_connection.php";

    $ssn = $_POST["ssn"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sex = $_POST["sex"];
    $birthdate = $_POST["birthdate"];
    $is_admin =  "T" ;

    $sql = "INSERT INTO user (ssn, fname, lname, phone, email, password, sex, birthdate, is_admin) VALUES ('$ssn', '$fname', '$lname', '$phone', '$email', '$password', '$sex', '$birthdate', '$is_admin')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['toastType'] = 'success';
        $_SESSION['toastMessage'] = 'Admin added successfully!';
    } else {
        $_SESSION['toastType'] = 'failure';
        $_SESSION['toastMessage'] = 'Failed to add admin: ' . $conn->error;
    }
    header("Location: ../admindashboard.php");

    // Close statement and connection
    $conn->close();
}
?>
