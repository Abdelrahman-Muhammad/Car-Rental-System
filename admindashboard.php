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
        <a class="flex text-xl bg-red-600 text-white rounded-md p-3 font-bold" href="logout.php">Log Out</a>
        </div>

        </div>
    </div>
</header>


<body>

<div class="fade-in-element flex flex-row m-10">
  <div class="flex  bg-[#3837e3] w-1/3 h-80 rounded-2xl m-3 relative">
    <h1 class="font-['Josefin_Sans'] text-white p-5 text-6xl font-bold "> Add Car</h1>
    <i class="fa fa-arrow-circle-right absolute bottom-5 right-5 text-white text-4xl bg-[#5c6bc0] rounded-full p-3" aria-hidden="true"></i>
  </div>
  <div class="flex     bg-[#d2ffd5] w-1/3 h-80 rounded-2xl m-3 relative">
    <h1 class="font-['Josefin_Sans'] text-green-900 p-5 text-6xl font-bold "> Edit Car</h1>
    <i class="fa fa-arrow-circle-right absolute bottom-5 right-5 text-green-900 text-4xl bg-[#b4eec0] rounded-full p-3" aria-hidden="true"></i>
  </div>
  <div class="flex     bg-[#6f4bff] w-1/3 h-80 rounded-2xl m-3 relative">
    <h1 class="font-['Josefin_Sans'] text-white p-5 text-6xl font-bold " > View Reservations</h1>
    <i class="fa fa-arrow-circle-right absolute bottom-5 right-5 text-white text-4xl bg-[#89a1f8] rounded-full p-3" aria-hidden="true"></i>
  </div>
  <div class="flex     bg-[#001942] w-1/3 h-80 rounded-2xl m-3 relative">
    <h1 class="font-['Josefin_Sans'] text-white p-5 text-6xl font-bold " > Add Admin</h1>
    <i class="fa fa-arrow-circle-right absolute bottom-5 right-5 text-white text-4xl bg-[#241e84] rounded-full p-3" aria-hidden="true"></i>
  </div>
</div>

<?php




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


<div class="full-page-background"></div>



</body>