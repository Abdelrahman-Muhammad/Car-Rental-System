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
    <link rel="stylesheet" href="css/style.css">
</head>

<header>
    <div class="font-['Mona_Sans'] flex p-4 mt-3 mb-5 items-center shadow-md rounded-xl">
        <div class="flex-auto w-44 ">
            <a href="#" title="" class="flex justify-start">
                <a href="dashboard.php" title="" class="font-['Sora'] inline-flex px-8 text-2xl font-extrabold text-blue-800 transition-all duration-200 hover:text-blue-900 focus:text-blue-600 border border-transparent rounded-md items-center hover:bg-slate-100 focus:bg-slate-100"> Car Rental System </a>
            </a>
        </div>
        <div class="flex-auto ">
            <a href="dashboard.php" title="" class="inline-flex px-8 text-xl font-bold text-black transition-all duration-200 hover:text-blue-900 focus:text-blue-600 border border-transparent rounded-md items-center hover:bg-slate-100 focus:bg-slate-100"> Home </a>
            <a href="#" title="" class="inline-flex px-8 text-xl font-bold text-black transition-all duration-200 hover:text-blue-900 focus:text-blue-600 border border-transparent rounded-md items-center hover:bg-slate-100 focus:bg-slate-100"> Catalog </a>
            <a href=" #" title="" class="inline-flex px-8 text-xl font-bold text-black transition-all duration-200 hover:text-blue-900 focus:text-blue-600 border border-transparent rounded-md items-center hover:bg-slate-100 focus:bg-slate-100"> About </a>
        </div>
        <div class="flex-auto mr-10 text-right bg-gray-100 rounded-md">
        <h1></h1>
        
        <?php
        // Example PHP code
        $user = $_SESSION['user'];
        $user_fname = $user['fname'];
        $user_lname = $user['lname'];

        ?>
<div class="flex flex-row ">
        <div class="flex-auto w-10  text-left text-xl bg-gray-100 rounded-md p-3 font-bold ">
        <p>Welcome , <?php echo $user_fname; ?></p>
        </div>
        <a class="flex text-xl bg-red-700 text-white rounded-md p-3 font-bold" href="logout.php">Log Out</a>
        </div>

        </div>
    </div>
</header>


<body>

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

    <div class="flex p-10">
  <div class="flex-none w-96 ">
  <form data-ajax-url="backend/filter.php" class="" method="POST">
  <div class="flex-col mr-10 font-semibold shadow-xl p-10 rounded-3xl">
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
  <div class="flex-initial w-full pr-20">
    <div id="results" class="grid grid-cols-3 gap-4">
    

</div>

</div>

</div>




<script src="js/dashboard.js"></script>

</body>