<?php
session_start();
include './backend/db_connection.php';


?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Car Rental System</title>
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
        <a href="search.php" class="flex items-center px-4 py-2 text-xl font-bold text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            <i class="fas fa-search mr-2"></i>
            Search
        </a>
        <a href="guestAbout.php" class="flex items-center px-4 py-2 text-xl font-bold text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            <i class="fas fa-info-circle mr-2"></i>
            About
        </a>
    </div>
</div>


        <div class="flex-auto mr-10 text-right">
            <button id="loginButtonHeader" href="index.php" title="" class="font-['Sora'] inline-flex  mr-3 px-6  py-2 text-xl font-normal  text-white transition-all duration-200 bg-green-700 border border-transparent rounded-md items-center hover:bg-blue-700 focus:bg-blue-700 z-50" role="button"> Login </button>
            <button id="registerButtonHeader" href="index.php" title="" class="font-['Sora'] inline-flex  px-6  py-2 text-xl font-normal text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md items-center hover:bg-blue-700 focus:bg-blue-700 z-50" role="button"> Register </button>
        </div>
    </div>
</header>


<body>

<div class="flex flex-row justify-center">
    <div class="flex flex-col bg-[#d2ffd5] w-1/p-10 h-100 rounded-2xl m-3 duration-200 ease-in">
        <h1 class="font-Josefin_Sans text-white-900 p-3 text-4xl font-bold">About The System</h1>
        <p class="text-center p-3">The car rental system is designed to cater to both administrative and user needs efficiently. Administrators hold comprehensive control over the system's operations, enabling them to manage various aspects seamlessly. They can Add Car, allowing them to expand the fleet by adding new vehicles with detailed specifications such as model, year, price, color, and more. The Edit Car feature empowers administrators to update existing car details as needed, ensuring accuracy and relevance in the system's database. The ability to Add Admin grants administrators the privilege to extend access and responsibilities to additional staff members, facilitating collaborative management. Moreover, administrators can Add Location, enabling the system to accommodate multiple rental locations, enhancing accessibility and convenience for users across different areas.

Administrators can View Reservations, offering them insights into the current reservation status, facilitating efficient scheduling and resource allocation. The Daily Payments feature enables administrators to track and manage daily rental payments, ensuring financial transparency and accountability. Lastly, The Status feature provides administrators with a comprehensive overview of the system's operational status, including the availability of vehicles, rental locations, and reservation statistics, enabling informed decision-making and proactive management.

On the user side, the system offers a user-friendly interface with essential functionalities tailored to enhance the rental experience. Users can easily reserve a car of their choice, selecting from the available fleet based on their preferences and requirements. The system provides users with visibility into their debt, allowing them to stay informed about their financial obligations and facilitating timely payments. Additionally, users can access their reservation history, enabling them to review past bookings and track their rental activity over time. The All Reservations feature offers users a comprehensive overview of all reservations made within the system, enhancing transparency and facilitating better planning and organization for future rentals. Overall, the car rental system aims to streamline rental operations, ensuring a seamless and satisfactory experience for both administrators and users alike.</p>
    </div>
</div>

<div class="full-page-background"></div>

</body>

</html>
