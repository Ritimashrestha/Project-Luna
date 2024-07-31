<?php

if (isset($_POST['submit'])){
$name = $_POST['name'];
$sid = $_POST['sid'];
$book = $_POST['book'];
$date = $_POST['date'];
$duedate = $_POST['duedate'];
$returndate = $_POST['returndate'];
$status = $_POST['status'];


$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'project_luna';

$conn = mysqli_connect($host, $user, $pass,$dbname);

$sql = "INSERT INTO add_member(name, sid, book, date, duedate, returndate, status) VALUES ('$name', '$sid', '$book', '$date', '$duedate', '$returndate', '$status')";
mysqli_query($conn, $sql);

header("Location: members.php");

}


// Database connection details
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'project_luna';

// Establish connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch student names from database
$sql_students = "SELECT name FROM add_student";  // Modify this query according to your database schema
$result_students = mysqli_query($conn, $sql_students);

// Fetch book names from database
$sql_books = "SELECT name FROM add_book";  // Modify this query according to your database schema
$result_books = mysqli_query($conn, $sql_books);

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Registration</title>
    <link rel="stylesheet" href="assets/luna.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include("inc/sidebar.php"); ?>

    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span>Library</span>
                <h2>Transaction Registration</h2>
            </div>
        </div>
        
        <div class="container">
            <div class="box form-box">
                <header>Add Transaction</header>
                <form action="#" method="post">
                    <div class="field input">
                        <label for="name">Name</label>
                        <select name="name" id="name">
                            <?php while ($row = mysqli_fetch_assoc($result_students)) { ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div> 
                    <div class="field input">
                        <label for="sid">Student Id</label>
                        <select name="sid" id="sid">
                            <?php while ($row = mysqli_fetch_assoc($result_students)) { ?>
                                <option value="<?php echo $row['sid']; ?>"><?php echo $row['sid']; ?></option>
                            <?php } ?>
                        </select>
                    </div> 
                    <div class="field input">
                        <label for="book">Book</label>
                        <select name="book" id="book">
                            <?php while ($row = mysqli_fetch_assoc($result_books)) { ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div> 
                    <div class="field input">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" autocomplete="off">
                    </div> 
                    <div class="field input">
                        <label for="duedate">Due Date</label>
                        <input type="date" name="duedate" id="duedate" autocomplete="off">
                    </div> 
                    <div class="field input">
                        <label for="returndate">Return Date</label>
                        <input type="date" name="returndate" id="returndate" autocomplete="off">
                    </div> 
                    <div class="field input">
                        <label for="status">Status</label>
                        <select name="status" required>
                        <option value="Pending">Pending</option>
                        <option value="Returned">Returned</option>
                        </select>
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
