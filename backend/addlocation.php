<?php
session_start();

include "db_connection.php";

// Populate form options for locations
$sql_locations = "SELECT * FROM location";
$result_locations = $conn->query($sql_locations);
$locations = [];
if ($result_locations->num_rows > 0) {
    while ($row = $result_locations->fetch_assoc()) {
        $locations[] = $row['location'];
    }
}

// Populate form options for branches
$sql_branches = "SELECT * FROM branch";
$result_branches = $conn->query($sql_branches);
$branches = [];
if ($result_branches->num_rows > 0) {
    while ($row = $result_branches->fetch_assoc()) {
        $branches[] = $row['branch_name'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_location'])) {
        // Adding a location
        $location_name = $_POST["location_name"];

        // Insert the data into the locations table
        $sql = "INSERT INTO location (location) VALUES ('$location_name')";
        if ($conn->query($sql)) {
            $_SESSION['toastType'] = "success";
            $_SESSION['toastMessage'] = "Location added successfully!";
        } else {
            $_SESSION['toastType'] = "failure";
            $_SESSION['toastMessage'] = "Error: " . $conn->error;
        }
    } elseif (isset($_POST['add_branch'])) {
        // Adding a branch
        $branch_name = $_POST["branch_name"];
        $location = $_POST["location"];

        // Insert the data into the branches table
        $sql = "INSERT INTO branch (branch_name, location) VALUES ('$branch_name', '$location')";
        if ($conn->query($sql)) {
            $_SESSION['toastType'] = "success";
            $_SESSION['toastMessage'] = "Branch added successfully!";
        } else {
            $_SESSION['toastType'] = "failure";
            $_SESSION['toastMessage'] = "Error: " . $conn->error;
        }
    } elseif (isset($_POST['delete_location'])) {
        // Deleting a location
        $location_name = $_POST["location"];

        // Delete the location from the locations table
        $sql = "DELETE FROM location WHERE location='$location_name'";
        if ($conn->query($sql)) {
            $_SESSION['toastType'] = "success";
            $_SESSION['toastMessage'] = "Location deleted successfully!";
        } else {
            $_SESSION['toastType'] = "failure";
            $_SESSION['toastMessage'] = "Error: " . $conn->error;
        }
    } elseif (isset($_POST['delete_branch'])) {
        // Deleting a branch
        $branch_name = $_POST["branch"];

        // Delete the branch from the branches table
        $sql = "DELETE FROM branch WHERE branch_name='$branch_name'";
        if ($conn->query($sql)) {
            $_SESSION['toastType'] = "success";
            $_SESSION['toastMessage'] = "Branch deleted successfully!";
        } else {
            $_SESSION['toastType'] = "failure";
            $_SESSION['toastMessage'] = "Error: " . $conn->error;
        }
    }

    header("Location: ../admindashboard.php");
    // Close statement and connection
    $conn->close();
}
?>