<?php
$conn = mysqli_connect("localhost", "root", "", "project_luna") or die("Connection failed");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `add_member` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $transaction = mysqli_fetch_assoc($result);
} else {
    die("Invalid Transaction ID");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Detail</title>
    <link rel="stylesheet" href="assets/luna.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include("inc/sidebar.php"); ?>
<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">
            <span>Details</span>
            <h2>Transaction Detail</h2>
        </div>
    </div>
    <div class="detail--wrapper">
        <div class="transaction-detail">
            <p><strong>ID:</strong> <?php echo $transaction['id']; ?></p>
            <p><strong>Name:</strong> <?php echo $transaction['name']; ?></p>
            <p><strong>Book:</strong> <?php echo $transaction['book']; ?></p>
            <p><strong>Date:</strong> <?php echo $transaction['date']; ?></p>
            <p><strong>Due Date:</strong> <?php echo $transaction['duedate']; ?></p>
            <p><strong>Status:</strong> <?php echo $transaction['status']; ?></p>
        </div>
        <a href="members.php" class="btn">Back to Transactions</a>
    </div>
</div>
</body>
</html>
