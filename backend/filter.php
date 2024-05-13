<?php
include 'db_connection.php';

// Get the search filter values from the POST request
$model = isset($_POST['modelFilter']) ? $_POST['modelFilter'] : "";
$year = isset($_POST['yearFilter']) ? $_POST['yearFilter'] : "";
$color = isset($_POST['colorFilter']) ? $_POST['colorFilter'] : "";
$transmission = isset($_POST['transmissionFilter']) ? $_POST['transmissionFilter'] : "";
$minPrice = isset($_POST['minPrice']) ? $_POST['minPrice'] : "";
$maxPrice = isset($_POST['maxPrice']) ? $_POST['maxPrice'] : "";
$minPower = isset($_POST['minPower']) ? $_POST['minPower'] : "";
$maxPower = isset($_POST['maxPower']) ? $_POST['maxPower'] : "";
$location = isset($_POST['locationFilter']) ? $_POST['locationFilter'] : "";
$branch = isset($_POST['branchFilter']) ? $_POST['branchFilter'] : "";

// Build the SQL query based on the search filter values
$query = "SELECT * FROM car NATURAL JOIN branch WHERE out_of_service = 'F'";

if ($model!= "") {
    $query.= " AND model = '$model'";
}

if ($year!= "") {
    $query.= " AND year = '$year'";
}

if ($color!= "") {
    $query.= " AND color = '$color'";
}

if ($transmission!= "") {
    $query.= " AND transmission = '$transmission'";
}

if ($minPrice !== "" && $maxPrice !== "") {
    // Both min and max price are provided
    $query .= " AND price BETWEEN '$minPrice' AND '$maxPrice'";
} elseif ($minPrice !== "" && $maxPrice === "") {
    // Only min price is provided
    $query .= " AND price >= '$minPrice'";
} elseif ($minPrice === "" && $maxPrice !== "") {
    // Only max price is provided
    $query .= " AND price <= '$maxPrice'";
}

if ($minPower !== "" && $maxPower !== "") {
    // Both min and max power are provided
    $query .= " AND power BETWEEN '$minPower' AND '$maxPower'";
} elseif ($minPower !== "" && $maxPower === "") {
    // Only min power is provided
    $query .= " AND power >= '$minPower'";
} elseif ($minPower === "" && $maxPower !== "") {
    // Only max power is provided
    $query .= " AND power <= '$maxPower'";
}

if ($location!= "") {
    $query.= " AND location = '$location'";
}

if ($branch!= "") {
    $query.= " AND branch_name = '$branch'";
}
$query.= " ORDER BY model ASC";

// Execute the SQL query
$result = $conn->query($query);
$num_results = $result->num_rows;
echo '<h1 class="mt-2 font-bold font-[\'Sora\'] mb-4 text-5xl text-gray-700">' . $num_results . ' results</h1>';

echo'<div  class="grid grid-cols-3 gap-4">';
// Output the results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div style="cursor: pointer;" class="p-2 bg-white rounded-md shadow-md flex flex-col hover:bg-slate-100 hover:scale-125 duration-100 ease-in " data-car-id="'. $row['car_id']. '" onclick="openPopup(\'' . $row['car_id'] . '\', \'' . $row['model'] . '\', \'' . $row['year'] . '\', \'' . $row['color'] . '\', \'' . $row['transmission'] . '\', \'' . $row['price'] . '\', \'' . $row['power'] . '\', \'' . $row['location'] . '\', \'' . $row['branch_name'] . '\')">';
        echo '<img class="rounded-lg shadow-md" src="img/'. $row['img']. '" alt="'. $row['model']. '" class="w-full h-48 object-cover mb-4">';
        echo '<div class="flex-grow">'; // Start of div for text
        echo '</div>'; // End of div for text
        echo '<h3 class="text-xl font-semibold text-gray-800">'. $row['model']. '</h3>';
        echo '<p class="text-gray-600 mt-auto">'. $row['year']. '</p>';
        echo '<p class="text-gray-600 mt-auto">'. $row['branch_name'] . ', ' . $row['location'] . '</p>';
        echo '<p class="text-gray-600 mt-auto">Color: '. $row['color']. ', ' . $row['transmission'] . '</p>';
        echo '<p class="text-green-600 mt-auto font-bold ">Price: $'. $row['price']. '</p>';
        echo '</div>';
    }
} else {
    echo '<h1 class="mt-10 font-bold text-2xl"> 0 results </h1>';
}
echo '</div>';


// Close the database connection
$conn->close();
?>