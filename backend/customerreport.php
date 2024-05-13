<?php
session_start();
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve SSN from form submission
    $ssn = $_POST['customer_ssn'];

    // Query to fetch reservations of the specific customer
    $sql = "SELECT reservation.*, car.model, car.car_id, user.fname, user.lname FROM reservation 
            JOIN car ON reservation.car_id = car.car_id 
            JOIN user ON reservation.ssn = user.ssn 
            WHERE reservation.ssn = '$ssn'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output table header
        echo "<div class='overflow-x-auto'>";
        echo "<table class='min-w-full divide-y divide-gray-200'>";
        echo "<thead class='bg-gray-50'><tr><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Reservation Number</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Reservation Time</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Customer Name</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Car Model</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Car ID</th></tr></thead><tbody class='bg-white divide-y divide-gray-200'>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Output table rows with reservation details and customer information
            echo "<tr><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['reservation_number'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['reservation_time'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['fname'] . " " . $row['lname'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['model'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['car_id'] . "</td></tr>";
        }

        echo "</tbody></table>";
        echo "</div>";
    } else {
        echo "<p class='text-red-500'>No reservations found for the specified customer.</p>";
    }
}
?>
