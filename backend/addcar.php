
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "db_connection.php";

    $model = $_POST["model"];
    $year = $_POST["year"];
    $price = $_POST["price"];
    $color = $_POST["color"];
    $power = $_POST["power"];
    $transmission = $_POST["transmission"];
    $img = $_FILES["img"]["name"]; 
    $branch_name = $_POST["branch_name"];
    $out_of_service = isset($_POST["out_of_service"]) ? "T" : "F";

    $target_dir = "../img/"; // Specify the directory where you want to store uploaded images
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

    $sql = "INSERT INTO car (model, year, price, color, power, transmission, img, branch_name, out_of_service) VALUES ('$model', $year, $price, '$color', $power, '$transmission', '$img', '$branch_name', '$out_of_service')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['toastType'] = 'success';
        $_SESSION['toastMessage'] = 'Car added successfully!';
        } else {
            $_SESSION['toastType'] = 'failure';
            $_SESSION['toastMessage'] = 'Failed to add car.';
        }
    header("Location: ../admindashboard.php");

    // Close statement and connection
    $conn->close();
}
?>
