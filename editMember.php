<?php
include("db.php");

$member = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM add_member WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $member = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching transaction: " . mysqli_error($conn);
    }
} else {
    echo "No transaction ID provided";
    exit;
}

// Fetch student names and book names from the database for dropdowns
$sql_students = "SELECT name FROM add_student";
$result_students = mysqli_query($conn, $sql_students);

$sql_studentsId = "SELECT sid FROM add_student";
$result_studentsId = mysqli_query($conn, $sql_studentsId);

$sql_books = "SELECT name FROM add_book";
$result_books = mysqli_query($conn, $sql_books);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sid = $_POST['sid'];
    $book = $_POST['book'];
    $date = $_POST['date'];
    $duedate = $_POST['duedate'];
    $returndate = $_POST['returndate'];
    $status = $_POST['status'];

        // Get the current status of the transaction
        $sql_current = "SELECT status, book FROM add_member WHERE id='$id'";
        $result_current = mysqli_query($conn, $sql_current);
        $row_current = mysqli_fetch_assoc($result_current);
        $current_status = $row_current['status'];
        $current_book = $row_current['book'];
    
        // Update the transaction
        $sql_update = "UPDATE add_member SET name='$name', sid='$sid', book='$book', date='$date', duedate='$duedate', returndate='$returndate', status='$status' WHERE id='$id'";
        mysqli_query($conn, $sql_update);
    
        // Adjust book quantity
        if ($current_status == 'Pending') {
            $sql_adjust = "UPDATE add_book SET quantity = quantity + 1 WHERE name = '$current_book'";
            mysqli_query($conn, $sql_adjust);
        }
        if ($status == 'Pending') {
            $sql_adjust = "UPDATE add_book SET quantity = quantity - 1 WHERE name = '$book'";
            mysqli_query($conn, $sql_adjust);
        } elseif ($status == 'Returned') {
            $sql_adjust = "UPDATE add_book SET quantity = quantity + 1 WHERE name = '$book'";
            mysqli_query($conn, $sql_adjust);
        }
    
        header("Location: members.php");
        exit();

    $sql = "UPDATE add_member SET name='$name', sid='$sid', book='$book', date='$date', duedate='$duedate', returndate='$returndate', status='$status' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: members.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/form.css">
    <style>
        .btn-cancel {
            background-color: #f44336; /* Red */
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            border-radius: 5px;
        }
        .btn-cancel:hover {
            background-color: #da190b;
        }
    </style>
    <title>Edit Transaction</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Edit Transaction</header>
            <?php if ($member): ?>
                <form action="editmember.php?id=<?php echo $member['id']; ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
                    
                    <div class="field input">
                        <label for="name">Name</label>
                        <select name="name" id="name" required>
                            <?php while ($row = mysqli_fetch_assoc($result_students)) { ?>
                                <option value="<?php echo $row['name']; ?>" <?php if ($row['name'] == $member['name']) echo 'selected'; ?>>
                                    <?php echo $row['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>    
                    <div class="field input">
                        <label for="sid">Student ID</label>
                        <select name="sid" id="sid" required>
                            <?php while ($row = mysqli_fetch_assoc($result_studentsId)) { ?>
                                <option value="<?php echo $row['sid']; ?>" <?php if ($row['sid'] == $member['sid']) echo 'selected'; ?>>
                                    <?php echo $row['sid']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>  
                    
                    <div class="field input">
                        <label for="book">Book</label>
                        <select name="book" id="book" required>
                            <?php while ($row = mysqli_fetch_assoc($result_books)) { ?>
                                <option value="<?php echo $row['name']; ?>" <?php if ($row['name'] == $member['book']) echo 'selected'; ?>>
                                    <?php echo $row['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div> 
                    
                    <div class="field input">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" autocomplete="off" value="<?php echo $member['date']; ?>" required>
                    </div> 
                    
                    <div class="field input">
                        <label for="duedate">Due Date</label>
                        <input type="date" name="duedate" id="duedate" autocomplete="off" value="<?php echo $member['duedate']; ?>" required>
                    </div> 
                    
                    <div class="field input">
                        <label for="returndate">Return Date</label>
                        <input type="date" name="returndate" id="returndate" autocomplete="off" value="<?php echo $member['returndate']; ?>">
                    </div> 
                    
                    <div class="field input">
                        <label for="status">Status</label>
                        <select name="status" id="status" required>
                            <option value="Pending" <?php if ($member['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Returned" <?php if ($member['status'] == 'Returned') echo 'selected'; ?>>Returned</option>
                        </select>
                    </div> 
                    
                    <div class="field">
                        <input type="submit" class="btn" name="update" value="Update">
                        <a href="members.php" class="btn-cancel">Cancel</a>
                    </div>
                </form>
            <?php else: ?>
                <p>Transaction not found or ID not provided.</p>
            <?php endif; ?>
        </div>    
    </div>    
</body>
</html>
