<?php
include("db.php");

$student = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM add_student WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $student = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching student: " . mysqli_error($conn);
    }
} else {
    echo "No studnet ID provided";
    exit;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sid = $_POST['sid'];
    $class = $_POST['class'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $sql = "UPDATE add_student SET name='$name', sid='$sid', class='$class', address='$address', contact='$contact' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: students.php");
        exit; // Ensure script stops execution after redirection
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
    <title>Edit Student</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Edit Student</header>
            <?php if ($student): ?>
                <form action="editStudent.php?id=<?php echo $student['id']; ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                    <div class="field input">
                        <label for="name">Student Name</label>
                        <input type="text" name="name" id="name" autocomplete="off" value="<?php echo $student['name']; ?>" required>
                    </div>     
                    <div class="field input">
                     <label for="sid">Student ID</label>
                     <input type="number" name="sid" id="sid" autocomplete="off" value="<?php echo $student['sid']; ?>" required>
                 </div>  
                    <div class="field input">
                        <label for="class">Class</label>
                        <input type="number" name="class" id="class" autocomplete="off" value="<?php echo $student['class']; ?>" required>
                    </div> 
                    <div class="field input">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" autocomplete="off" value="<?php echo $student['address']; ?>" required>
                    </div> 
                    <div class="field input">
                        <label for="contact">Contact No.</label>
                        <input type="text" name="contact" id="contact" autocomplete="off" value="<?php echo $student['contact']; ?>" required>
                    </div> 
                    <div class="field">
                        <input type="submit" class="btn" name="update" value="Update">
                        <a href="students.php" class="btn-cancel">Cancel</a>
                    </div>
                </form>
            <?php else: ?>
                <p>Student not found or ID not provided.</p>
            <?php endif; ?>
        </div>    
    </div>    
</body>
</html>
