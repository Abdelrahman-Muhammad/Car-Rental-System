<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] !== 'T') {
    // Redirect to login page or show an error message
    header("Location: login.php"); // Redirect to login page
    exit;
}

// Include the necessary files
require_once "db_connection.php"; // Include your database connection file

// Handle adding a new car if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_car_submit"])) {
    // Handle adding a new car here
    // You'll need to write the code to insert the new car details into the database
    // Example: INSERT INTO cars (model, year, plate_id) VALUES ('$model', '$year', '$plate_id');
    // After adding the car, you can redirect the user to the same page or show a success message
}

// Handle editing an existing car if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_car_submit"])) {
    // Handle editing an existing car here
    // You'll need to write the code to update the car details in the database
    // Example: UPDATE cars SET model='$model', year='$year', plate_id='$plate_id' WHERE id=$car_id;
    // After editing the car, you can redirect the user to the same page or show a success message
}

// HTML content starts here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Add any necessary CSS stylesheets or external CSS files here -->
</head>
<body>
    <h1>Welcome to Admin Dashboard</h1>

    <!-- Add New Car Form -->
    <h2>Add New Car</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Add input fields for car details -->
        <input type="text" name="model" placeholder="Model" required><br>
        <input type="number" name="year" placeholder="Year" required><br>
        <input type="text" name="plate_id" placeholder="Plate ID" required><br>
        <button type="submit" name="add_car_submit">Add Car</button>
    </form>

    <!-- Edit Existing Car Form -->
    <h2>Edit Existing Car</h2>
    <!-- Display list of existing cars with options to edit -->

    <!-- View Reservations -->
    <h2>View Reservations</h2>
    <!-- Display list of reservations -->

    <!-- Add any other content or features as needed -->

</body>
</html>
