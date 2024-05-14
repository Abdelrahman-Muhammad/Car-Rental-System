<?php
session_start();
include './backend/db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['ssn'])) {
    // Redirect to home page if not logged in
    header("Location: index.php");
    exit();
}
?>


<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora&family=Manrope&family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/uber-move-text" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/mona-sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<header>
    <div class="font-['Sora'] flex p-4 mt-3 mb-5 items-center shadow-md rounded-xl">
    <div class="flex-auto w-72">
        <a href="dashboard.php" title="" class="inline-flex items-center">
            <i class="fas fa-car text-4xl text-blue-800 mr-3"></i>
            <span class="text-3xl font-extrabold text-blue-800 transition-all duration-200 hover:text-blue-900 focus:text-blue-600">Car Rental System</span>
        </a>
    </div>
        

        <div class="font-['Sora'] flex justify-center">
    <div class="inline-flex rounded-md shadow-sm">
        <a href="dashboard.php" aria-current="page" class="flex items-center px-4 py-2 text-xl font-bold text-blue-700 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            <i class="fas fa-home mr-2"></i>
            Home
        </a>
        <a href="userreservations.php" class="flex items-center px-4 py-2 text-xl font-bold text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            <i class="fas fa-calendar-alt mr-2"></i>
            My Reservations
        </a>
        <a href="search.php" class="flex items-center px-4 py-2 text-xl font-bold text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            <i class="fas fa-search mr-2"></i>
            Search
        </a>
        <a href="About.php" class="flex items-center px-4 py-2 text-xl font-bold text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            <i class="fas fa-info-circle mr-2"></i>
            About
        </a>
    </div>
</div>




<div class="font-['Mona_Sans'] flex-auto mr-10 text-right">
    <?php
    $user = $_SESSION['user'];
    $user_fname = $user['fname'];
    $user_lname = $user['lname'];
    ?>
    <div class="flex items-center justify-end space-x-4">
        <div class="flex-none bg-gray-100 rounded-md p-3 font-bold text-xl">
            <p>Welcome, <?php echo $user_fname; ?></p>
        </div>
        <a href="logout.php" class="flex-none bg-red-600 text-white rounded-md p-3 font-bold text-xl hover:bg-red-700">Log Out</a>
    </div>
</div>

</header>



<body>


<div  class=" rounded-2xl shadow-2xl bg-white p-8 w-11/12 mx-auto">
<h2 class="block mt-2 font-bold font-['Sora'] mb-4 text-4xl leading-tight border-blue-800 border-b-8 text-gray-700">My Reservations</h2>

<?php

// Check if user is logged in
if(isset($_SESSION['ssn'])) {
    // Retrieve SSN from session
    $ssn = $_SESSION['ssn'];

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
        echo "<thead class='bg-gray-50'><tr><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Reservation Number</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Reservation Time</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Pickup Time</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Return Time</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Customer Name</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Car Model</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Car ID</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Paid</th><th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200'>Total Payment</th></tr></thead><tbody class='bg-white divide-y divide-gray-200'>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Output table rows with reservation details and customer information
            echo "<tr><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['reservation_number'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['reservation_time'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['pickup_time'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['return_time'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['fname'] . " " . $row['lname'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['model'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['car_id'] . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . ($row['is_paid'] == 'T' ? 'Yes' : 'No') . "</td><td class='px-6 py-4 whitespace-nowrap border border-gray-200'>" . $row['total_price'] . "</td></tr>";
        }

        echo "</tbody></table>";
        echo "</div>";
    } else {
        echo "<p class='text-red-500'>No reservations found for the current user.</p>";
    }
} else {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>



</div>






<div class="full-page-background"></div>
<script src="js/dashboard.js"></script>
</body>