<?php
$conn = mysqli_connect("localhost", "root", "", "project_luna") or die("Connection failed");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `add_student` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);
} else {
    die("Invalid Student ID");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Detail</title>
    <link rel="stylesheet" href="assets/luna.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include("inc/sidebar.php"); ?>
<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">
            <span>Details</span>
            <h2>Student Detail</h2>
        </div>
    </div>
    <div class="detail--wrapper">
        <div class="student-detail">
            <p><strong>ID:</strong> <?php echo $student['id']; ?></p>
            <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
            <p><strong>Student ID:</strong> <?php echo $student['sid']; ?></p>
            <p><strong>Class:</strong> <?php echo $student['class']; ?></p>
            <p><strong>Address:</strong> <?php echo $student['address']; ?></p>
            <p><strong>Contact:</strong> <?php echo $student['contact']; ?></p>
        </div>
        <a href="students.php" class="btn">Back to Students</a>
    </div>
</div>
</body>
</html>
