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
    <div class="font-['Mona_Sans'] flex p-4 mt-3 mb-5 items-center shadow-md rounded-xl">
        <div class="flex-auto w-44 ">
            <a href="#" title="" class="flex justify-start">
                <a href="admindashboard.php" title="" class="font-['Sora'] inline-flex px-8 text-2xl font-extrabold text-blue-800 transition-all duration-200 hover:text-blue-900 focus:text-blue-600 border border-transparent rounded-md items-center hover:bg-slate-100 focus:bg-slate-100"> Car Rental System </a>
            </a>
        </div>
        <div class="flex-auto ">
            <a href="admindashboard.php" title="" class="inline-flex px-8 text-xl font-bold text-black transition-all duration-200 hover:text-blue-900 focus:text-blue-600 border border-transparent rounded-md items-center hover:bg-slate-100 focus:bg-slate-100"> Home </a>
            <a href="About.php" title="" class="inline-flex px-8 text-xl font-bold text-black transition-all duration-200 hover:text-blue-900 focus:text-blue-600 border border-transparent rounded-md items-center hover:bg-slate-100 focus:bg-slate-100"> About </a>
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
        <a class="flex text-xl bg-red-600 text-white rounded-md p-3 font-bold" href="logout.php">Log Out</a>
        </div>

        </div>
    </div>
</header>


<body>



<?php
// get barnch names
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
$ssn_distinct = getDistinctValues($conn, 'user', 'ssn');
$car_id = getDistinctValues($conn, 'car', 'car_id');
$branches = getDistinctValues($conn, 'branch', 'branch_name');
$locations = getDistinctValues($conn, 'location', 'location');

?>

<!-- Dashboard Header !-->
<div class="flex flex-row m-5">
<div style="cursor: pointer;" onclick="showViewReservationsDiv()" class="flex hover:scale-110 ease-in duration-150    bg-[#ffbd66] w-1/3 h-80 rounded-2xl m-3 relative">
    <a  class="font-['Josefin_Sans'] text-[#b0640e] p-8 text-5xl font-bold " > View Reservations</a>
    <i class="fa fa-arrow-circle-right absolute bottom-5 right-5 text-[#ffbd66] text-4xl bg-[#b0640e] rounded-full p-3" aria-hidden="true"></i>
  </div>
  <div style="cursor: pointer;" onclick="showAddCarDiv()" class="flex hover:scale-110 ease-in duration-150 bg-[#d2ffd5] w-1/3 h-80 rounded-2xl m-3 relative">
    <a class="font-['Josefin_Sans'] text-green-900 p-5 text-5xl font-bold "> Add Car</a>
    <i class="fa fa-arrow-circle-right absolute bottom-5 right-5 text-green-900 text-4xl bg-[#b4eec0] rounded-full p-3" aria-hidden="true"></i>
  </div>
  <div style="cursor: pointer;" onclick="showEditCarDiv()" class="flex  hover:scale-110 ease-in duration-150   bg-[#3837e3] w-1/3 h-80 rounded-2xl m-3 relative">
    <a class="font-['Josefin_Sans'] text-white p-5 text-5xl font-bold "> Edit Car</a>
    <i class="fa fa-arrow-circle-right absolute bottom-5 right-5 text-[#3837e3] text-4xl bg-[#18189b] rounded-full p-3" aria-hidden="true"></i>
  </div>
  <div style="cursor: pointer;" onclick="showAddAdminDiv()" class="flex  hover:scale-110 ease-in duration-150   bg-[#5fdfff] w-1/3 h-80 rounded-2xl m-3 relative">
    <a class="font-['Josefin_Sans'] text-[#0d3944] p-5 text-5xl font-bold " > Add Admin</a>
    <i class="fa fa-arrow-circle-right absolute bottom-5 right-5 text-[#5fdfff] text-4xl bg-[#0a6176] rounded-full p-3" aria-hidden="true"></i>
  </div>
  <div class="flex flex-col m-3">
  <div style="cursor: pointer; position: relative;" onclick="showaddLocationAndBranchDiv()" class="hover:scale-110 ease-in duration-150 h-1/2 bg-[#de265d] rounded-2xl mb-3 relative flex justify-between items-end">
    <a class="font-['Josefin_Sans'] text-white p-5 text-3xl font-bold">Add Location</a>
    <i class="fa fa-arrow-circle-right text-[#de265d] text-3xl bg-[#7a0f2f] rounded-full p-3 mb-10 mr-5" aria-hidden="true" ></i>
</div>




<div style="cursor: pointer; position: relative;" onclick="showReportsDiv()" class="hover:scale-110 ease-in duration-150 h-1/2 bg-[#650a5f] rounded-2xl relative flex justify-between items-end">
    <a class="font-['Josefin_Sans'] text-white p-5 text-3xl font-bold">Reports</a>
    <i class="fa fa-arrow-circle-right text-[#650a5f] text-3xl bg-[#360533] rounded-full p-3 mb-10 mr-5" aria-hidden="true" ></i>
</div>
  </div>

</div>
<!-- Dashboard Header END!-->

<!-- Add Car Option !-->
<div id="addCarDiv" class="hidden rounded-2xl shadow-2xl bg-white p-8 w-11/12 mx-auto">
  <h2 class="font-bold font-['Sora'] mb-4 text-5xl text-gray-700">Add Car Info</h2>
  <form class="grid grid-cols-3 gap-4" action="./backend/addcar.php" method="POST" enctype="multipart/form-data">
    <div class="col-span-1">
      <label for="model" class="text-lg">Model:</label>
      <input type="text" id="model" name="model" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <div class="col-span-1">
      <label for="year" class="text-lg">Year:</label>
      <input type="number" id="year" name="year" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <div class="col-span-1">
      <label for="price" class="text-lg">Price:</label>
      <input type="number" id="price" name="price" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <div class="col-span-1">
      <label for="color" class="text-lg">Color:</label>
      <input type="text" id="color" name="color" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <div class="col-span-1">
      <label for="power" class="text-lg">Power:</label>
      <input type="number" id="power" name="power" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <div class="col-span-1">
      <label for="transmission" class="text-lg">Transmission:</label>
      <select id="transmission" name="transmission" class="w-full p-2 border border-gray-300 rounded-md" required>
        <option value="Auto">Auto</option>
        <option value="Manual">Manual</option>
      </select>
    </div>
    <div class="col-span-1">
      <label for="img" class="text-lg">Image:</label>
      <input type="file" id="img" name="img" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <div class="col-span-1">
      <label for="branch_name" class="text-lg">Branch Name:</label>
      <select id="branch_name" name="branch_name" class="w-full p-2 border border-gray-300 rounded-md" required>
        <option value="" disabled selected>Select Branch</option>
        <?php foreach ($branches as $branch) : ?>
          <option value="<?php echo $branch; ?>"><?php echo $branch; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-span-1">
      <label for="out_of_service" class="text-lg">Out of Service:</label>
      <input type="checkbox" id="out_of_service" name="out_of_service" class="w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="col-span-3 flex justify-center"> <!-- Add flex and justify-center classes here -->
      <input type="submit" style="cursor: pointer;" value="Add Car" class="mt-2 bg-green-700 hover:bg-blue-700 text-2xl text-white  py-2 px-4 rounded">
    </div>
  </form>
</div>
<!-- Add Car Option END!-->

<!-- Edit Car Option !-->


<div id="editCarDiv" class="hidden rounded-2xl shadow-2xl bg-white p-8 w-11/12 mx-auto">
<h2 class="font-bold font-['Sora'] mb-4 text-5xl text-gray-700">Cars Table</h2>
<div class="overflow-x-auto rounded-2xl shadow-xl">
    <table class="table-auto text-green-800 w-full uppercase bg-slate-100 rounded-2xl shadow-lg text-sm">
        <thead class="bg-[#b4eec0] text-green-900 text-md h-15  shadow-2xl ">
            <tr>
                <th class="px-4 py-2">Car ID</th>
                <th class="px-4 py-2">Model</th>
                <th class="px-4 py-2">Year</th>
                <th class="px-4 py-2">Out of Service</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Color</th>
                <th class="px-4 py-2">Power</th>
                <th class="px-4 py-2">Transmission</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Branch Name</th>
            </tr>
        </thead>
        <tbody id="carTableBody">
            <?php
            // Include database connection
            // Assuming $conn represents your database connection

            // Query to fetch cars from the database
            $sql = "SELECT * FROM car";

            // Execute the query
            $result = $conn->query($sql);

            // Check if there are any cars
            if ($result->num_rows > 0) {
                // Loop through each car and display them
                while ($row = $result->fetch_assoc()) {
                    // Output car details in table rows
                    echo "<tr>";
                    echo "<td class='border px-4 py-2'>" . $row["car_id"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["model"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["year"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["out_of_service"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["price"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["color"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["power"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["transmission"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["img"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["branch_name"] . "</td>";
                    echo "</tr>";
                }
            } else {
                // If there are no cars, display a message in a single row
                echo "<tr><td colspan='10' class='text-center py-4'>No cars found.</td></tr>";
            }

            // Close the database connection
            ?>
        </tbody>
    </table>
</div>




  <h2 class="font-bold font-['Sora'] mb-4 mt-6 text-5xl text-gray-700">Edit Car Info</h2>
  <form class="grid grid-cols-3 gap-4" action="./backend/editcar.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="car_id" value="<?php echo $car_id;?>"> 
    <div class="col-span-1">
      <label for="car_id" class="car_id-lg ">Car Id:</label>
      <select id="car_id" name="car_id" class="w-full p-2 border border-gray-300 rounded-md">
        <option value="" disabled selected>Select Car Id</option>
        <?php foreach ($car_id as $car_id) :?>
          <option value="<?php echo $car_id;?>"><?php echo $car_id;?></option>
        <?php endforeach;?>
      </select>
    </div>
    <div class="col-span-1">
      <label for="model" class="text-lg">Model:</label>
      <input type="text" id="modelEdit" name="model" class="w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="col-span-1">
      <label for="year" class="text-lg">Year:</label>
      <input type="number" id="yearEdit" name="year" class="w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="col-span-1">
      <label for="price" class="text-lg">Price:</label>
      <input type="number" id="priceEdit" name="price" class="w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="col-span-1">
      <label for="color" class="text-lg">Color:</label>
      <input type="text" id="colorEdit" name="color" class="w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="col-span-1">
      <label for="power" class="text-lg">Power:</label>
      <input type="number" id="powerEdit" name="power" class="w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="col-span-1">
      <label for="transmission" class="text-lg">Transmission:</label>
      <select id="transmissionEdit" name="transmission" class="w-full p-2 border border-gray-300 rounded-md">
        <option value="" disabled selected>Select Transmission</option>
        <option value="Auto">Auto</option>
        <option value="Manual">Manual</option>
      </select>
    </div>
    <div class="col-span-1">
      <label for="img" class="text-lg">Image:</label>
      <input type="file" id="imgEdit" name="img" class="w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="col-span-1">
      <label for="branch_name" class="text-lg">Branch Name:</label>
      <select id="branch_nameEdit" name="branch_name" class="w-full p-2 border border-gray-300 rounded-md">
        <option value="" disabled selected>Select Branch</option>
        <?php foreach ($branches as $branch) :?>
          <option value="<?php echo $branch;?>"><?php echo $branch;?></option>
        <?php endforeach;?>
      </select>
    </div>
    <div class="col-span-1">
      <label for="out_of_service" class="text-lg">Out of Service:</label>
      <input type="checkbox" id="out_of_serviceEdit" name="out_of_service" class="w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="col-span-3 flex justify-center"> <!-- Add flex and justify-center classes here -->
      <input type="submit" style="cursor: pointer;" value="Edit Car" class="mt-2 bg-green-700 hover:bg-blue-700 text-2xl text-white  py-2 px-4 rounded">
    </div>
  </form>
</div>



<!-- Edit Car Option END!-->


<!-- Add Location Options !-->

<div id="addLocationAndBranchDiv" class="hidden rounded-2xl shadow-2xl bg-white p-8 w-11/12 mx-auto">
  <h2 class="font-bold font-['Sora'] mb-4 text-5xl text-gray-700">Add Location and Branch</h2>
  <form class="grid grid-cols-2 gap-4 " action="./backend/addlocation.php" method="post">
    <!-- Add Location Section -->
    <div class="col-span-1">
      <label for="location_name" class="text-lg">Location Name:</label>
      <input type="text" id="location_name" name="location_name" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <div class="col-span-1 flex justify-center items-end"> <!-- Align items to bottom -->
      <button type="submit" name="add_location" class="mt-2 bg-green-700 hover:bg-blue-700 text-2xl text-white py-2 px-4 rounded cursor-pointer">Add Location</button>
    </div>
        </form>
    <!-- Add Branch Section -->
    <form class="grid grid-cols-3 gap-4 " action="./backend/addlocation.php" method="post">
    <div class="col-span-1 ">
      <label for="branch_name" class="text-lg">Branch Name:</label>
      <input type="text" id="branch_name_Add" name="branch_name" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <div class="col-span-1 w-1/2 pr-2">
      <label for="location" class="text-lg">Location:</label>
      <select id="location" name="location" class="w-full p-2 border border-gray-300 rounded-md" required>
        <option value="" disabled selected>Select Location</option>
        <?php foreach ($locations as $location) : ?>
            <option value="<?php echo $location; ?>"><?php echo $location; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-span-1 flex justify-center w-1/2"> <!-- Merge two columns -->
      <button type="submit" name="add_branch" class="mt-2 bg-green-700 hover:bg-blue-700 justify-center text-2xl text-white px-4 rounded cursor-pointer">Add Branch</button>
    </div>
        </form>
    <!-- Delete Location Section -->
    <form class="grid grid-cols-2 gap-4" action="./backend/addlocation.php" method="post">
    <div class="col-span-1">
      <label for="delete_location" class="text-lg">Delete Location:</label>
      <select id="delete_location" name="location" class="w-full p-2 border border-gray-300 rounded-md" required>
        <option value="" disabled selected>Select Location</option>
        <?php foreach ($locations as $location) : ?>
            <option value="<?php echo $location; ?>"><?php echo $location; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-span-1 flex justify-center items-end"> 
      <button type="submit" name="delete_location" class="mt-2 bg-red-700 hover:bg-blue-700 text-2xl text-white py-2 px-4 rounded cursor-pointer">Delete Location</button>
    </div>
        </form>
    <!-- Delete Branch Section -->
    <form class="grid grid-cols-2 gap-4" action="./backend/addlocation.php" method="post">
    <div class="col-span-1">
      <label for="delete_branch" class="text-lg">Delete Branch:</label>
      <select id="delete_branch" name="branch" class="w-full p-2 border border-gray-300 rounded-md" required>
        <option value="" disabled selected>Select Branch</option>
        <?php foreach ($branches as $branch) : ?>
            <option value="<?php echo $branch; ?>"><?php echo $branch; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-span-1 flex justify-center items-end"> 
      <button type="submit" name="delete_branch" class="mt-2 bg-red-700 hover:bg-blue-700 text-2xl text-white py-2 px-4 rounded cursor-pointer">Delete Branch</button>
    </div>
  </form>
</div>
        </form>


<!-- Add Location Options END!-->

<!-- Add Admin Options !-->

<div id="addAdminDiv" class="hidden rounded-2xl shadow-2xl bg-white p-8 w-11/12 mx-auto">
  <h2 class="font-bold font-['Sora'] mb-4 text-5xl text-gray-700">Add Admin</h2>
  <form class="grid grid-cols-2 gap-4" action="./backend/addadmin.php" method="post">
    <!-- First Name -->
    <div class="col-span-1">
      <label for="admin_fname" class="text-lg">First Name:</label>
      <input type="text" id="admin_fname" name="fname" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <!-- Last Name -->
    <div class="col-span-1">
      <label for="admin_lname" class="text-lg">Last Name:</label>
      <input type="text" id="admin_lname" name="lname" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <!-- Email -->
    <div class="col-span-1">
      <label for="admin_email" class="text-lg">Email:</label>
      <input type="email" id="admin_email" name="email" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <!-- Phone -->
    <div class="col-span-1">
      <label for="admin_phone" class="text-lg">Phone:</label>
      <input type="text" id="admin_phone" name="phone" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <!-- SSN -->
    <div class="col-span-1">
      <label for="admin_ssn" class="text-lg">SSN:</label>
      <input type="text" id="admin_ssn" name="ssn" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <!-- Password -->
    <div class="col-span-1">
      <label for="admin_password" class="text-lg">Password:</label>
      <input type="password" id="admin_password" name="password" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <!-- Sex -->
    <div class="col-span-1">
      <label for="admin_sex" class="text-lg">Sex:</label>
      <select id="admin_sex" name="sex" class="w-full p-2 border border-gray-300 rounded-md" required>
        <option value="M">Male</option>
        <option value="F">Female</option>
      </select>
    </div>
    <!-- Birthdate -->
    <div class="col-span-1">
      <label for="admin_birthdate" class="text-lg">Birthdate:</label>
      <input type="date" id="admin_birthdate" name="birthdate" class="w-full p-2 border border-gray-300 rounded-md" required>
    </div>
    <!-- Submit Button -->
    <div class="col-span-2 flex justify-center items-end">
      <button type="submit" name="add_admin" class="mt-2 bg-green-700 hover:bg-blue-700 text-2xl text-white py-2 px-4 rounded cursor-pointer">Add Admin</button>
    </div>
  </form>
</div>



<!-- Add Admin Options END !-->


<!-- View Reservations !-->



<div id="ReservationsDiv" class=" rounded-2xl shadow-2xl bg-white p-8 w-11/12 mx-auto">
<div class="flex items-center">
  <div class="mr-4">
    <h2 class="block mt-2 font-bold font-['Sora'] mb-4 text-4xl text-gray-700">View Reservations</h2>
  </div>

  
  
  <div class="ml-auto">
    <h2 class="block font-bold font-['Sora']  text-xl mr-3 text-gray-700">Sorting</h2>
  </div>
  <div>
    <select id="sortSelect" onchange="sortTable()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <option value="reservation_number ASC">Reservation Number (ASC)</option>
      <option value="reservation_number DESC">Reservation Number (DESC)</option>
      <option value="car_id ASC">Car ID (ASC)</option>
      <option value="car_id DESC">Car ID (DESC)</option>
      <option value="ssn ASC">SSN (ASC)</option>
      <option value="ssn DESC">SSN (DESC)</option>
      <option value="reservation_time ASC">Reservation Time (ASC)</option>
      <option value="reservation_time DESC">Reservation Time (DESC)</option>
      <option value="pickup_time ASC">Pickup Time (ASC)</option>
      <option value="pickup_time DESC">Pickup Time (DESC)</option>
      <option value="return_time ASC">Return Time (ASC)</option>
      <option value="return_time DESC">Return Time (DESC)</option>
      <option value="is_paid ASC">Is Paid (ASC)</option>
      <option value="is_paid DESC">Is Paid (DESC)</option>
      <option value="total_price ASC">Total Price (ASC)</option>
      <option value="total_price DESC">Total Price (DESC)</option>
    </select>
  </div>
</div>


  <div class="overflow-x-auto rounded-2xl shadow-xl">
    <table class="table-auto text-[#53320c] w-full uppercase bg-slate-100 rounded-2xl shadow-lg text-sm">
      <thead class="bg-[#ffbd66] text-[#b0640e] text-md h-15  shadow-2xl ">
        <tr>
          <th class=" py-2">Reservation Number</th>
          <th class=" py-2">Car ID</th>
          <th class=" py-2">SSN</th>
          <th class=" py-2">Reservation Time</th>
          <th class=" py-2">Pickup Time</th>
          <th class=" py-2">Return Time</th>
          <th class=" py-2">Is Paid</th>
          <th class=" py-2">Total Price</th>
        </tr>
      </thead>
      <tbody id="reservationTableBody">
        <?php

        // Default sorting
        $sortColumn = "reservation_number";
        $sortOrder = "ASC";

        // Check if sorting options are set
        if (isset($_GET['sort']) && isset($_GET['order'])) {
            $sortColumn = $_GET['sort'];
            $sortOrder = $_GET['order'];
        }

        // Query to fetch reservations from the database with sorting
        $sql = "SELECT * FROM reservation ORDER BY $sortColumn $sortOrder";

        // Execute the query
        $result = $conn->query($sql);

        // Check if there are any reservations
        if ($result->num_rows > 0) {
          // Loop through each reservation and display them
          while ($row = $result->fetch_assoc()) {
              // Output reservation details in table rows
              echo "<tr>";
              echo "<td class='border px-4 py-2'>" . $row["reservation_number"] . "</td>";
              echo "<td class='border px-4 py-2'>" . $row["car_id"] . "</td>";
              echo "<td class='border px-4 py-2'>" . $row["ssn"] . "</td>";
              echo "<td class='border px-4 py-2'>" . $row["reservation_time"] . "</td>";
              echo "<td class='border px-4 py-2'>" . $row["pickup_time"] . "</td>";
              echo "<td class='border px-4 py-2'>" . $row["return_time"] . "</td>";
              echo "<td class='border px-4 py-2'>" . $row["is_paid"] . "</td>";
              echo "<td class='border px-4 py-2'>" . $row["total_price"] . "</td>";
              echo "</tr>";
          }
        } else {
          // If there are no reservations, display a message in a single row
          echo "<tr><td colspan='8' class='text-center py-4'>No reservations found.</td></tr>";
        }

        // Close the database connection
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Add a dropdown menu to sort the table -->





<!-- View Reservations END !-->












<!-- Reports !-->



<div id="ReportsDiv" class="hidden rounded-2xl shadow-2xl bg-white p-8 w-11/12 mx-auto">
<div class="flex items-center">
  <div class="mr-4">
    <h2 class="block mt-2 font-bold font-['Sora'] mb-4 text-4xl leading-tight border-violet-700 border-b-8 text-gray-700">Reports</h2>
  </div>
  </div>



  <!--General Report 1 !-->


<div class="mr-4">
    <h2 class="block mt-2 font-bold font-sora mb-4 text-2xl text-gray-700 leading-tight border-b-2 border-gray-300 pb-2">Reservation Report</h2>
    <div class="container mx-auto p-4">
        <form id="report3Form" class="mb-4">
            <div class="flex mb-2">
                <div class="mr-4">
                    <label for="report_type" class="font-bold">Select Report Type:</label>
                    <select id="report_type" name="report_type" class="border border-gray-300 rounded-md px-3 py-2">
                        <option value="customer">Reservations of Specific Customer</option>
                        <option value="period_all">All Reservations within Specific Period</option>
                        <option value="period_car">Reservations of Any Car within Specific Period</option>
                    </select>
                </div>
                <div class="mr-4" id="3customer_ssn">
                    <label for="customer_ssn" class="font-bold">Select Customer SSN:</label>
                    <select  name="customer_ssn" class="border border-gray-300 rounded-md px-3 py-2">
                        <option value="">Select SSN</option>
                        <?php foreach ($ssn_distinct as $ssn) : ?>
                            <option value="<?php echo $ssn; ?>"><?php echo $ssn; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="flex mb-2" >
                <div class="mr-4" id="3start_date">
                    <label for="start_date" class="font-bold">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" class="border border-gray-300 rounded-md px-3 py-2">
                </div>
                <div id="3end_date">
                    <label for="end_date" class="font-bold">End Date:</label>
                    <input type="date" id="end_date" name="end_date" class="border border-gray-300 rounded-md px-3 py-2 mr-5">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Generate Report</button>
            </div>
        </form>

        <div id="report3Result"></div>
    </div>
</div>

<script>
    document.getElementById('report3Form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = new FormData(this); // Get form data
        var xhr = new XMLHttpRequest(); // Create AJAX request object

        // Define AJAX request parameters
        xhr.open('POST', './backend/generalreport.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Request was successful, update report result div
                document.getElementById('report3Result').innerHTML = xhr.responseText;
            } else {
                // Request failed, display error message
                document.getElementById('report3Result').innerHTML = '<p class="text-red-500">An error occurred. Please try again later.</p>';
            }
        };

        xhr.onerror = function() {
            // Request failed, display error message
            document.getElementById('report3Result').innerHTML = '<p class="text-red-500">An error occurred. Please try again later.</p>';
        };

        // Send AJAX request with form data
        xhr.send(formData);
    });

    function toggleInputs(reportType) {
        // Get references to input elements
        var customerSSNInput = document.getElementById('3customer_ssn');
        var startDateInput = document.getElementById('3start_date');
        var endDateInput = document.getElementById('3end_date');

        // Hide all inputs initially
        customerSSNInput.style.display = 'none';
        startDateInput.style.display = 'none';
        endDateInput.style.display = 'none';

        // Show inputs based on the selected report type
        if (reportType === 'customer') {
            customerSSNInput.style.display = 'block';
        } else if (reportType === 'period_all' || reportType === 'period_car') {
            startDateInput.style.display = 'block';
            endDateInput.style.display = 'block';
        }
    }

    // Add event listener to the report type select element
    document.getElementById('report_type').addEventListener('change', function() {
        // Get the selected report type
        var reportType = this.value;
        
        // Call the toggleInputs function with the selected report type
        toggleInputs(reportType);
    });

    // Initially call the toggleInputs function with the default selected report type
    toggleInputs(document.getElementById('report_type').value);
</script>

  <!--General Report 1 END !-->

  <!--report 2 !-->

  <div class="mr-4">
  <h2 class="block mt-2 font-bold font-sora mb-4 text-2xl text-gray-700 leading-tight border-b-2 border-gray-300 pb-2">Daily payments within specific period.</h2>
  <div class="container mx-auto p-4">
    <form id="reportForm" class="mb-4">
        <div class="flex mb-2">
            <div class="mr-4">
                <label for="start_date" class="font-bold">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="border border-gray-300 rounded-md px-3 py-2">
            </div>
            <div>
                <label for="end_date" class="font-bold">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="border border-gray-300 rounded-md px-3 py-2 mr-5">
            </div>
            <button type="submit" class=" bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Generate Report</button>

        </div>
    </form>

    <div id="reportResult"></div>
</div>

<script>
    document.getElementById('reportForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = new FormData(this); // Get form data
        var xhr = new XMLHttpRequest(); // Create AJAX request object

        // Define AJAX request parameters
        xhr.open('POST', './backend/paymentreport.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Request was successful, update report result div
                document.getElementById('reportResult').innerHTML = xhr.responseText;
            } else {
                // Request failed, display error message
                document.getElementById('reportResult').innerHTML = '<p class="text-red-500">An error occurred. Please try again later.</p>';
            }
        };

        xhr.onerror = function() {
            // Request failed, display error message
            document.getElementById('reportResult').innerHTML = '<p class="text-red-500">An error occurred. Please try again later.</p>';
        };

        // Send AJAX request with form data
        xhr.send(formData);
    });
</script>

</div>
<!-- Report 3 !-->

<div class="mr-4">
    <h2 class="block mt-2 font-bold font-sora mb-4 text-2xl text-gray-700 leading-tight border-b-2 border-gray-300 pb-2">All Reservations of Specific Customer</h2>
    <div class="container mx-auto p-4">
        <form id="report2Form" class="mb-4">
            <div class="flex mb-2">
                <div class="mr-4">
                    <label for="customer_ssn" class="font-bold">Select Customer SSN:</label>
                    <select id="customer_ssn" name="customer_ssn" class="border border-gray-300 rounded-md px-3 py-2">
                        <option value="">Select SSN</option>
                        <?php foreach ($ssn_distinct as $ssn) : ?>
                            <option value="<?php echo $ssn; ?>"><?php echo $ssn; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class=" bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Get Reservations</button>
            </div>
        </form>

        <div id="report2Result">
            <!-- Reservations table will be displayed here -->
        </div>
    </div>

    <script>
    document.getElementById('report2Form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = new FormData(this); // Get form data
        var xhr = new XMLHttpRequest(); // Create AJAX request object

        // Define AJAX request parameters
        xhr.open('POST', './backend/customerreport.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Request was successful, update report result div
                document.getElementById('report2Result').innerHTML = xhr.responseText;
            } else {
                // Request failed, display error message
                document.getElementById('report2Result').innerHTML = '<p class="text-red-500">An error occurred. Please try again later.</p>';
            }
        };

        xhr.onerror = function() {
            // Request failed, display error message
            document.getElementById('report2Result').innerHTML = '<p class="text-red-500">An error occurred. Please try again later.</p>';
        };

        // Send AJAX request with form data
        xhr.send(formData);
    });
</script>

</div>




<!-- Report 3 END!-->








<!-- Reports END !-->














<!-- Toast Message Container -->
<div id="toastMessage" class="hidden flex mx-auto justify-center items-center w-1/2 p-4 mb-4 text-white bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
    <div id="toastIcon" class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg"></div>
    <div id="toastText" class="ms-3 text-sm font-normal"></div>
</div>
<!-- End of Toast Message Container -->


<div class="full-page-background"></div>

<script src="js/admindashboard.js"></script>

<script>

function showToast(type, message) {
        const toastDiv = document.getElementById('toastMessage');
        const toastText = document.getElementById('toastText');
        const toastIcon = document.getElementById('toastIcon');

        // Set toast message text
        toastText.textContent = message;

        // Set toast icon and color based on type
        if (type === 'success') {
            toastDiv.classList.remove('bg-red-400');
            toastDiv.classList.add('bg-green-400');
            toastIcon.innerHTML = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/></svg>';
        } else if (type === 'failure') {
            toastDiv.classList.remove('bg-green-400');
            toastDiv.classList.add('bg-red-400');
            toastIcon.innerHTML = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/></svg>';
        }

        // Show the toast
        toastDiv.classList.remove('hidden');

        // Set the timer to hide the toast after 2 seconds
        setTimeout(() => {
            toastDiv.classList.add('hidden');
        }, 3000);
    }

    // Check if success or failure message exists in session
    <?php if (isset($_SESSION['toastType']) && isset($_SESSION['toastMessage'])): ?>
        showToast('<?php echo $_SESSION['toastType']; ?>', '<?php echo $_SESSION['toastMessage']; ?>');
        // Remove toast data from session
        <?php unset($_SESSION['toastType']); ?>
        <?php unset($_SESSION['toastMessage']); ?>
    <?php endif; ?>


    ////////////////////////////////////////////////


    function sortTable() {
    var sortColumn = document.getElementById("sortSelect").value;
    var sortOrder = sortColumn.split(" ")[1];
    window.location.href = "?sort=" + sortColumn.split(" ")[0] + "&order=" + sortOrder;
  }
</script>


</body>