<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.html");
    exit;
}

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'project_luna';
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Insert transaction into the database
if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $sid = $_POST['sid'];
    $book = $_POST['book'];
    $date = $_POST['date'];
    $duedate = $_POST['duedate'];
    $returndate = $_POST['returndate'];
    $status = $_POST['status'];

    $sql = "INSERT INTO add_member(name, sid, book, date, duedate, returndate, status) 
            VALUES ('$name', '$sid', '$book', '$date', '$duedate', '$returndate', '$status')";
    mysqli_query($conn, $sql);

    // Update book quantity based on initial status
    if ($status == 'Pending') {
        $sql_update = "UPDATE add_book SET quantity = quantity - 1 WHERE name = '$book' AND quantity > 0";
        mysqli_query($conn, $sql_update);
    }

    header("Location: members.php");
    exit();
}

// If this is a status update operation
if (isset($_POST['update_status'])){
    $transaction_id = $_POST['transaction_id'];
    $new_status = $_POST['status'];

    // Fetch the existing status of the transaction
    $sql_get_transaction = "SELECT status, book FROM add_member WHERE id = $transaction_id";
    $result = mysqli_query($conn, $sql_get_transaction);
    $transaction = mysqli_fetch_assoc($result);

    $current_status = $transaction['status'];
    $book = $transaction['book'];

    // Update book quantity based on status change
    if ($current_status == 'Pending' && $new_status == 'Returned') {
        // Book is being returned
        $sql_update = "UPDATE add_book SET quantity = quantity + 1 WHERE name = '$book'";
        mysqli_query($conn, $sql_update);
    } elseif ($current_status == 'Returned' && $new_status == 'Pending') {
        // Book is being borrowed again
        $sql_update = "UPDATE add_book SET quantity = quantity - 1 WHERE name = '$book' AND quantity > 0";
        mysqli_query($conn, $sql_update);
    }

    // Update the transaction status
    $sql_update_status = "UPDATE add_member SET status = '$new_status' WHERE id = $transaction_id";
    mysqli_query($conn, $sql_update_status);

    header("Location: members.php");
    exit();
}

// Fetch student names and books from the database
$sql_students = "SELECT name, sid FROM add_student";
$result_students = mysqli_query($conn, $sql_students);

$sql_books = "SELECT name FROM add_book";
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
    <script>
        // Function to auto-fill Student ID based on selected name
        function fillStudentId() {
            const nameSelect = document.getElementById('name');
            const sidInput = document.getElementById('sid');
            const selectedOption = nameSelect.options[nameSelect.selectedIndex];
            const studentId = selectedOption.getAttribute('data-sid');
            sidInput.value = studentId;
        }

        // Function to disable Return Date based on selected status
        function toggleReturnFields() {
            const statusSelect = document.getElementById('status');
            const returndateField = document.getElementById('returndate');

            if (statusSelect.value === 'Pending') {
                returndateField.disabled = true;
                returndateField.value = '';
            } else {
                returndateField.disabled = false;
            }
        }
    </script>
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
                        <select name="name" id="name" onchange="fillStudentId()">
                            <option value="" disabled selected>Select a student</option>
                            <?php while ($row = mysqli_fetch_assoc($result_students)) { ?>
                                <option value="<?php echo $row['name']; ?>" data-sid="<?php echo $row['sid']; ?>">
                                    <?php echo $row['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div> 
                    <div class="field input">
                        <label for="sid">Student ID</label>
                        <input type="text" name="sid" id="sid" readonly required>
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
                        <input type="date" name="returndate" id="returndate" autocomplete="off" disabled>
                    </div> 
                    <div class="field input">
                        <label for="status">Status</label>
                        <select name="status" id="status" onchange="toggleReturnFields()" required>
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
