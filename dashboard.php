<?php
session_start();
include './backend/db_connection.php';


// Check if user is logged in
if (!isset($_SESSION['ssn'])  || $_SESSION['user']['is_admin'] == 'T') {
    // Redirect to home page if not logged in or not an admin
    header("Location: admindashboard.php");
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

<?php
$ssn=$_SESSION['ssn'];
$total_reservations_query = "SELECT COALESCE(COUNT(*), 0) as total_reservations FROM reservation WHERE ssn = '$ssn'";
$total_reservations_result = $conn->query($total_reservations_query);
if (mysqli_num_rows($total_reservations_result) > 0) {
    while ($row = mysqli_fetch_assoc($total_reservations_result)) {
        $total_reservations = $row['total_reservations'];
    }
} else {
    $total_reservations = 0;
}

$total_payments_query = "SELECT COALESCE(SUM(total_price), 0) as total_payments FROM reservation WHERE ssn = '$ssn' AND is_paid = 'F'";
$total_payments_result = mysqli_query($conn, $total_payments_query);

if (mysqli_num_rows($total_payments_result) > 0) {
    while ($row = mysqli_fetch_assoc($total_payments_result)) {
        $total_payments = $row['total_payments'];
    }
} else {
    $total_payments = 0;
}


?>

<div class="flex flex-row justify-center">

<div class="flex flex-col bg-[#d2ffd5] w-1/4 h-40 rounded-2xl m-3 hover:scale-110 duration-200 ease-in">
    <h1 class="font-['Josefin_Sans'] text-green-900 p-3 text-4xl font-bold">Your Reservations</h1>
    <p class="font-['Josefin_Sans'] text-green-900 text-center p-3 text-6xl font-bold"><?php echo $total_reservations; ?></p>
</div>

<div class="flex flex-col bg-[#ff2c2c] w-1/4 h-40 rounded-2xl m-3 hover:scale-110 duration-200 ease-in">
    <h1 class="font-['Josefin_Sans'] text-white p-3 text-4xl font-bold">Debt</h1>
    <p class="font-['Josefin_Sans'] text-white text-center p-3 text-6xl font-bold"><?php echo $total_payments; ?></p>
</div>

</div>

    <!-- Search Filters -->
    <?php
    // Function to retrieve distinct values for a given column from the database
function getDistinctValues($conn, $tableName, $columnName) {
    $query = "SELECT DISTINCT $columnName FROM $tableName ORDER BY $columnName ASC";
    $result = $conn->query($query);
    $values = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $values[] = $row[$columnName];
        }
    }
    return $values;
}

$models = getDistinctValues($conn, 'car', 'model');
$years = getDistinctValues($conn, 'car', 'year');
$colors = getDistinctValues($conn, 'car', 'color');
$transmissions = getDistinctValues($conn, 'car', 'transmission');
$powers = getDistinctValues($conn, 'car', 'power');
$locations = getDistinctValues($conn, 'location', 'location');
$branches = getDistinctValues($conn, 'branch', 'branch_name');


?>

    <div class="flex border-2 shadow-2xl rounded-3xl p-10">
  <div class="flex-none w-96 ">
  <form data-ajax-url="backend/filter.php" class="" method="POST">
  <div class="flex-col mr-10 font-semibold border-2 shadow-2xl p-10 rounded-3xl">
                <div class="font-['Sora'] text-4xl font-bold text-gray-700"><h1>Search Filters</h1></div>
                <div class="mt-4">
                    <label for="modelFilter" class="font-bold">Car Model:</label>
                    <select name="modelFilter" id="modelFilter" class="w-full border border-gray-300  rounded-md px-3 py-2">
                        <option value="">Any Model</option>
                        <?php foreach ($models as $model) : ?>
                            <option value="<?php echo $model; ?>"><?php echo $model; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-4">
                    <label  class="font-bold">Car Year:</label>
                    <select name="yearFilter" id="yearFilter" id="yearFilter" class="w-full border border-gray-300  rounded-md px-3 py-2">
                        <option value="">Any Year</option>
                        <?php foreach ($years as $year) : ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="colorFilter" class="font-bold">Car Color:</label>
                    <select name="colorFilter" id="colorFilter" class="w-full border border-gray-300  rounded-md px-3 py-2">
                        <option value="">Any Color</option>
                        <?php foreach ($colors as $color) : ?>
                            <option value="<?php echo $color; ?>"><?php echo $color; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="transmissionFilter" class="font-bold">Transmission:</label>
                    <select name="transmissionFilter" id="transmissionFilter" class="w-full border border-gray-300 rounded-md px-3 py-2">
                        <option value="">Any Transmission</option>
                        <?php foreach ($transmissions as $transmission) : ?>
                            <option value="<?php echo $transmission; ?>"><?php echo $transmission; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-4">
                    <label class="font-bold">Price Range:</label>
                    <div class="flex">
                        <input name="minPrice" type="number" id="minPrice" placeholder="Min" class="w-1/2 border border-gray-300 rounded-md px-3 py-2 mr-2">
                        <input name="maxPrice" type="number" id="maxPrice" placeholder="Max" class="w-1/2 border border-gray-300 rounded-md px-3 py-2">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="font-bold">Power:</label>
                    <div class="flex">
                        <input name="minPower" type="number" id="minPower" placeholder="Min" class="w-1/2 border border-gray-300 rounded-md px-3 py-2 mr-2">
                        <input name="maxPower" type="number" id="maxPower" placeholder="Max" class="w-1/2 border border-gray-300 rounded-md px-3 py-2">
                    </div>
                </div>
                <div class="mt-4">
                    <label for="locationFilter" class="font-bold">Location:</label>
                    <select name="locationFilter" id="locationFilter" class="w-full border border-gray-300 rounded-md px-3 py-2">
                        <option value="">Any Location</option>
                        <?php foreach ($locations as $location) : ?>
                            <option value="<?php echo $location; ?>"><?php echo $location; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="branchFilter" class="font-bold">Branch:</label>
                    <select name="branchFilter" id="branchFilter" class="w-full border border-gray-300 rounded-md px-3 py-2">
                        <option value="">Any Branch</option>
                        <?php foreach ($branches as $branch) : ?>
                            <option value="<?php echo $branch; ?>"><?php echo $branch; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-6 text-center">
                <button id="applyFilters" name="applyFilters" type="submit" class="cen bg-green-700 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-xl">
                    Apply Filters
                </button>
            </div>
            </div>
                        </form>
  </div>
  


  <div >
    
  </div>


    <!-- Results !-->
  <div id="results" class="flex-initial w-full pr-20">
    

</div>

</div>

</div>



<div class="full-page-background"></div>

<script src="js/dashboard.js"></script>

</body>