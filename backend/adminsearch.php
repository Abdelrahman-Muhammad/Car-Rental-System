<?php
session_start();
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve search query from form submission
    $search_query = $_POST['search_query'];

    // Query to fetch reservations based on search query
    $sql = "SELECT 
    reservation.reservation_number,
    reservation.reservation_time,
    reservation.pickup_time,
    reservation.return_time,
    reservation.is_paid,
    reservation.total_price,
    car.car_id AS car_id_res,
    car.model,
    car.year,
    car.out_of_service,
    car.price,
    car.color,
    car.power,
    car.transmission,
    car.img,
    car.branch_name,
    car.plate_id,
    user.ssn AS ssn_user,
    user.fname,
    user.lname,
    user.phone,
    user.email,
    user.password,
    user.sex,
    user.birthdate,
    user.is_admin
FROM user 
LEFT JOIN reservation ON reservation.ssn = user.ssn 
RIGHT JOIN car ON reservation.car_id = car.car_id 
WHERE car.model LIKE '%$search_query%' 
OR car.color LIKE '%$search_query%' 
OR car.transmission LIKE '%$search_query%' 
OR car.year LIKE '%$search_query%' 
OR car.branch_name LIKE '%$search_query%'
OR user.fname LIKE '%$search_query%' 
OR user.lname LIKE '%$search_query%' ";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output table header
        echo "<div class='overflow-x-auto rounded-2xl shadow-xl'>";
        echo "<table class='min-w-full divide-y divide-gray-200  '>";
        echo "<thead class='bg-blue-700 '><tr>";
        
        // Output column headers dynamically
        while ($fieldinfo = $result->fetch_field()) {
            echo "<th scope='col' class='px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider border border-gray-200'>$fieldinfo->name</th>";
        }
        
        echo "</tr></thead><tbody class='bg-white divide-y divide-gray-200'>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<td class='px-6 py-4 whitespace-nowrap border border-gray-200'>$value</td>";
            }
            echo "</tr>";
        }

        echo "</tbody></table>";
        echo "</div>";
    } else {
        echo "<p class='text-red-500'>No reservations found for the specified search query.</p>";
    }
}
?>
