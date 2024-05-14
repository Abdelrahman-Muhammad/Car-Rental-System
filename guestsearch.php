<?php
session_start();
include './backend/db_connection.php';

// Check if user is logged in

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
            <button id="loginButtonHeader" href="#" title="" class="font-['Sora'] inline-flex  mr-3 px-6  py-2 text-xl font-normal  text-white transition-all duration-200 bg-green-700 border border-transparent rounded-md items-center hover:bg-blue-700 focus:bg-blue-700 z-50" role="button"> Login </button>
            <button id="registerButtonHeader" href="#" title="" class="font-['Sora'] inline-flex  px-6  py-2 text-xl font-normal text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md items-center hover:bg-blue-700 focus:bg-blue-700 z-50" role="button"> Register </button>
        </div>
    </div>
</header>



<body>

<form id="searchForm" action="javascript:void(0);" method="POST" class=" mb-5 w-8/12  mx-auto">   
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="search" id="default-search" name="search_query" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-2xl bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Car Model, Color, Transmission ..." required />
        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</form>

<div id="searchResults"></div>

<script>
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        var isAdmin = <?php echo isset($_SESSION['user']['is_admin']) ? ($_SESSION['user']['is_admin'] === 'T' ? 'true' : 'false') : 'false'; ?>;

        // Get the search query from the input field
        var searchQuery = document.getElementById('default-search').value;

        // Create a FormData object and append the search query
        var formData = new FormData();
        formData.append('search_query', searchQuery);

        // Make an AJAX request to the backend PHP file
        var xhr = new XMLHttpRequest();
        if (isAdmin) {
            // User is an admin, send request to adminsearch.php
        xhr.open('POST', 'backend/adminsearch.php', true);
        } else {
            // User is not an admin, send request to usersearch.php
        xhr.open('POST', 'backend/usersearch.php', true);
        }

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Request was successful, update the search results div
                document.getElementById('searchResults').innerHTML = xhr.responseText;
            } else {
                // Request failed, display an error message
                document.getElementById('searchResults').innerHTML = '<p class="text-red-500">An error occurred. Please try again later.</p>';
            }
        };
        xhr.onerror = function() {
            // Request failed, display an error message
            document.getElementById('searchResults').innerHTML = '<p class="text-red-500">An error occurred. Please try again later.</p>';
        };
        xhr.send(formData); // Send the AJAX request with form data
    });
</script>






<div class="full-page-background"></div>
</body>