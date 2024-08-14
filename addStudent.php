<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.html");
    exit;
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $sid = $_POST['sid'];
    $class = $_POST['class'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'project_luna';

    // Create a connection
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO add_student (name, sid, class, address, contact) VALUES ('$name', '$sid', '$class', '$address', '$contact')";

    // Execute the query and check for errors
    if (mysqli_query($conn, $sql)) {
        header("Location: students.php"); // Redirect to the students page if the query was successful
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="assets/luna.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include("inc/sidebar.php"); ?>
    
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span>Library</span>
                <h2>Student Registration</h2>
            </div>
        </div>
        
        <div class="container">
            <div class="box form-box">
                <header>Add Student</header>
                <form action="#" method="post">
                    <div class="field input">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="sid">Student ID</label>
                        <input type="number" name="sid" id="sid" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="class">Class</label>
                        <input type="number" name="class" id="class" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="contact">Contact No.</label>
                        <input type="text" name="contact" id="contact" autocomplete="off" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
