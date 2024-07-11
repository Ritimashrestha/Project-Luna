<?php
// Establish database connection
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root";
$password = "";
$dbname = "project_luna";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // Insert data into database
//     $sql = "INSERT INTO login_info (email, password) VALUES ('$email', '$password')";

//     if ($conn->query($sql) === TRUE) {
//         echo "New record created successfully";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }

?>
