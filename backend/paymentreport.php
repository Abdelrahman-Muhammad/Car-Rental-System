<?php
session_start();
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve day from form submission
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "SELECT * FROM reservation WHERE reservation_time BETWEEN '$start_date' AND '$end_date'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Initialize total payment
        $total_payment = 0;
?>

<div class="overflow-x-auto">
    <table class="table-auto min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reservation Number</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reservation Time</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SSN</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paid?</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <?php
                    // Fetch user information (full name and SSN) based on the SSN associated with the reservation
                    $user_ssn = $row['ssn'];
                    $user_sql = "SELECT fname,lname FROM user WHERE ssn='$user_ssn'";
                    $user_result = $conn->query($user_sql);
                    $user_row = $user_result->fetch_assoc();
                    $user_first_name = $user_row['fname'];
                    $user_last_name = $user_row['lname'];

                    // Update total payment if reservation is paid
                    if ($row['is_paid'] == 'T') {
                        $total_payment += $row['total_price'];
                    }
                ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['reservation_number']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['reservation_time']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $user_first_name . " " . $user_last_name; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $user_ssn; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['total_price']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo ($row['is_paid'] == 'T' ? 'Yes' : 'No'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="mt-5">
    <p class="font-bold text-lg">Total Payment for Reservations Paid on <span class="text-blue-500"><?php echo $start_date; ?></span> to <span class="text-blue-500"><?php echo $end_date; ?></span>: </p>
</div>
<div class="mt-5 bg-gray-100 rounded-lg p-4">
    <p class="font-bold text-lg text-green-500">Total Payments</p>
    <p class="text-xl"><?php echo $total_payment; ?></p>
</div>

<?php
    } else {
        echo "<p class='text-red-500'>No reservations found within the specified period.</p>";
    }
}
?>
