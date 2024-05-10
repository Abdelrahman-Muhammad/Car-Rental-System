<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register-submit"])) {
    $fname = $_POST["input_fname"];
    $lname = $_POST["input_lname"];
    $email = $_POST["input_email"];
    $password = $_POST["input_password"];
    $mobile = $_POST["input_mobile"];
    $ssn = $_POST["input_ssn"];
    $bdate = $_POST["input_bdate"];
    $gender = $_POST['gender'];
    $is_admin = 'F';


    $sql = "SELECT * FROM user WHERE email = '$email' OR ssn='$ssn' OR phone='$mobile'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Email or SSN or Phone already exists";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `user` (ssn,fname,lname,phone,email,password,sex,birthdate,is_admin) VALUES
        ('$ssn','$fname','$lname','$mobile','$email','$hashed_password','$gender','$bdate','$is_admin')";;
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login-submit"])) {
    $email = $_POST["login-mail"];
    $password = $_POST["login-password"];


    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            echo "Login successful";
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>