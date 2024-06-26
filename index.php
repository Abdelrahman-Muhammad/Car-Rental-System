<?php 
include './backend/db_connection.php';
include './backend/user.php';
if (isset($_SESSION['ssn'])) {
    header("Location: dashboard.php");
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
        <a href="index.php" title="" class="inline-flex items-center">
            <i class="fas fa-car text-4xl text-blue-800 mr-3"></i>
            <span class="text-3xl font-extrabold text-blue-800 transition-all duration-200 hover:text-blue-900 focus:text-blue-600">Car Rental System</span>
        </a>
    </div>
        

        <div class="font-['Sora'] flex justify-center">
    <div class="inline-flex rounded-md shadow-sm">
        <a href="index.php" aria-current="page" class="flex items-center px-4 py-2 text-xl font-bold text-blue-700 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            <i class="fas fa-home mr-2"></i>
            Home
        </a>
        <a href="guestsearch.php" class="flex items-center px-4 py-2 text-xl font-bold text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
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
    <div class="z-10 text-center min-h-screen overflow-hidden shadow-xl rounded-3xl">
        <div class="absolute bottom-32 right-2/4 w-3/6  z-0" style="z-index: 1;"></div>
        <div class="text-center mt-10">
            <p class="font-['Sora'] text-8xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-violet-950">Rent A Car</p>
            <ul class="mt-10 flex justify-center text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-violet-900">
                <li class="mr-6">1. Choose</li>
                <li class="mr-6">2. Confirm</li>
                <li>3. Drive</li>
            </ul>
        </div>
    <br>
    <div class="text-center mt-2">
        <a id="loginButton" title="" class="transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110  duration-300 font-['Uber Move'] inline-flex  mr-3 px-8  py-3 text-2xl font-normal  text-white transition-all duration-200 bg-green-700 border border-transparent rounded-md items-center hover:bg-blue-700 focus:bg-blue-700" role="button"> Login </a>
        <a id="registerButton" title="" class="transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110  duration-300 font-['Uber Move'] inline-flex  px-8  py-3 text-2xl font-normal text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md items-center hover:bg-blue-700 focus:bg-blue-700" role="button"> Register </a>
    </div>
    <img src="img/car.png" id="movingImage" class="absolute  bottom-0 right-2/4 w-3/6  z-0 transition-transform duration-1000 " />
</div>

<div class="fade-in-element flex flex-row m-10">
<div class="flex  bg-[#3837e3] w-1/3 h-80 rounded-2xl m-3 ">
    <h1 class="font-['Josefin_Sans'] text-white p-5 text-6xl font-bold   "> Search.</h1>
    </div>
    <div class="flex     bg-[#d2ffd5] w-1/3 h-80 rounded-2xl m-3">
    <h1 class="font-['Josefin_Sans'] text-green-900 p-5 text-6xl font-bold "> Pick.</h1>
    </div>

    <div class="flex     bg-[#6f4bff] w-1/3 h-80 rounded-2xl m-3">
    <h1 class="font-['Josefin_Sans'] text-white p-5 text-6xl font-bold " > Pay.</h1>
    </div>
    <div class="flex     bg-[#001942] w-1/3 h-80 rounded-2xl m-3">
    <h1 class="font-['Josefin_Sans'] text-white p-5 text-6xl font-bold " > Go !</h1>
    </div>
</div>



<div class="flex flex-row  rounded-3xl ">
  <div class="basis-1/2 p-24 rounded-2xl shadow-2xl ">
  <img src="img/home-1.webp">  
  </div>
  <div class="fade-in-element basis-1/2 p-24 font-['Uber Move'] text-gray-900 text-8xl font-extrabold shadow-inner">
    <h1>Request a Car, hop in, and go.</h1>
    <button id="scrollToTopBtn"  onclick="scrollToTop()" class="text-3xl ml-32 bg-blue-800 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
            Get Started
        </button>
    </div>
</div>


<div class="flex flex-row rounded-3xl">
    <div class="fade-in-element basis-1/2 p-24 font-['Uber Move'] text-gray-900 text-8xl font-extrabold shadow-inner">
        <h1>Drive when you want, make what you need</h1>
        <button id="scrollToTopBtn"  onclick="scrollToTop()" class="text-3xl ml-32 bg-blue-800 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
            Get Started
        </button>
    </div>
    <div class="basis-1/2 p-24 rounded-2xl shadow-2xl">
        <img src="img/home-2.webp" alt="Car Image">
    </div>
</div>




<div id="loginPopup" class="hidden flex fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50  items-center justify-center z-50">
    <div class="flex flex-col bg-white rounded-lg shadow-lg p-8 w-96">
        <h2 class="font-['Sora'] text-center text-2xl font-bold mb-4">Login</h2>
        <form action="./backend/user.php" method="post">
            <div class="mb-4">
                <label class="block font-bold mb-1" for="email">Email</label>
                <input name="login-mail" class="w-full border border-gray-300 rounded-md px-3 py-2" type="email" id="email" required />
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1" for="password">Password</label>
                <input name="login-password" class="w-full border border-gray-300 rounded-md px-3 py-2" type="password" id="password" required />
            </div>
            <div class="text-center items-center">
                <button name="login-submit" class=" bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-md " type="submit">Login</button>
            </div>
        </form>
    </div>
</div>

<div id="registerPopup" class="hidden fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="flex flex-col bg-white rounded-lg shadow-lg p-8 w-auto">
        <h2 class="text-center font-['Sora'] text-2xl font-bold mb-4">Register</h2>
        <form action="./backend/user.php" method="post">
            <div class="flex mb-4">
                <div class="flex-col mr-5">
                    <label class="block font-bold mb-1 " >First Name</label>
                    <input name="input_fname" class="w-full border border-gray-300 rounded-md px-3 py-2" type="text" required />
                </div>
                <div class="flex-col">
                    <label class="block font-bold mb-1" >Last Name</label>
                    <input name="input_lname" class="w-full border border-gray-300 rounded-md px-3 py-2" type="text" required />
                </div>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1" for="email">Email</label>
                <input name="input_email"class="w-full border border-gray-300 rounded-md px-3 py-2" type="email" id="email" required />
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1" for="password">Password</label>
                <input name="input_password" class="w-full border border-gray-300 rounded-md px-3 py-2" type="password" id="password" required />
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1" >Mobile Phone</label>
                <input name="input_mobile" class="w-full border border-gray-300 rounded-md px-3 py-2" type="tel" required />
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1" >National ID</label>
                <input name="input_ssn" class="w-full border border-gray-300 rounded-md px-3 py-2" type="text" required />
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1" >Birth Date:</label>
                <input name="input_bdate" class="w-full border border-gray-300 rounded-md px-3 py-2" type="date" required />
            </div>
            <div>
                <div class="flex space-x-4 font-bold mb-1">
                    <label for="gender" >Gender</label>
                    <label class="flex-auto">
                        <input type="radio" class="form-radio h-4 w-4 text-blue-600" name="gender" value="M" required />
                        <span class="ml-2 text-gray-700">Male</span>
                    </label>
                    <label class="flex-auto ">
                        <input type="radio" class="form-radio h-4 w-4 text-blue-600" name="gender" value="F" required />
                        <span class="ml-2 text-gray-700">Female</span>
                    </label>
                </div>
            </div>
            <div class="text-center items-center">
                <button name="register-submit" class=" bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-md " type="submit">Register</button>
            </div>
        </form>
    </div>
</div>


<!-- toast !-->
<div id="toast" class="fixed bottom-0 left-0 mb-4 ml-4 p-4 rounded-md text-white">
    <!-- Toast message content will be displayed here -->
</div>

<?php if(isset($_SESSION['registration_status']) || isset($_SESSION['login_status'])): ?>
    <script>
        <?php if(isset($_SESSION['registration_status'])): ?>
            <?php if($_SESSION['registration_status'] === 'success'): ?>
                showToast('Registration successful', 'bg-green-500');
            <?php elseif($_SESSION['registration_status'] === 'failed'): ?>
                showToast('Registration failed: Email or SSN already exists', 'bg-red-500');
            <?php else: ?>
                showToast('Registration failed: Error occurred', 'bg-red-500');
            <?php endif; ?>
            <?php unset($_SESSION['registration_status']); ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['login_status'])): ?>
            <?php if($_SESSION['login_status'] === 'success'): ?>
                showToast('Login successful', 'bg-green-500');
            <?php elseif($_SESSION['login_status'] === 'incorrect_password'): ?>
                showToast('Login failed: Incorrect password', 'bg-red-500');
            <?php else: ?>
                showToast('Login failed: User not found', 'bg-red-500');
            <?php endif; ?>
            <?php unset($_SESSION['login_status']); ?>
        <?php endif; ?>

        function showToast(message, bgColor) {
            const toast = document.getElementById('toast');
            toast.innerText = message;
            toast.classList.remove('hidden');
            toast.classList.add(bgColor);
            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove(bgColor);
            }, 3000); // Hide toast after 3 seconds
        }
    </script>
<?php endif; ?>

<div class="full-page-background"></div>
<script src="js/script.js"></script>
</body>
<footer class="bg-gray-900 text-white py-8 rounded-t-lg shadow-2xl">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <h3 class="text-2xl font-bold mb-4">Car Rental System</h3>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Faculty Of Engineering</h3>
                <p>Compu Communication</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Team Members</h3>
                <ul>
                    <li><a class="hover:text-blue-500">Ranim Mohareb</a></li>
                    <li><a class="hover:text-blue-500">Jomana Ehab</a></li>
                    <li><a class="hover:text-blue-500">Maya</a></li>
                    <li><a class="hover:text-blue-500">Abdelrahman Muhammad</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Teaching Assistants</h3>
                <ul>
                    <li><a class="hover:text-blue-500">Eng.Hashim</a></li>
                    <li><a class="hover:text-blue-500">Eng.Rewan</a></li>

                </ul>
            </div>
        </div>
    </div>

</footer>

</html>
