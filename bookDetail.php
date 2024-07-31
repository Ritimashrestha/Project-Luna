<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.html");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "project_luna") or die("Connection failed");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `add_book` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($result);
} else {
    die("Invalid Book ID");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Detail</title>
    <link rel="stylesheet" href="assets/luna.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include("inc/sidebar.php"); ?>
<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">
            <span>Details</span>
            <h2>Book Detail</h2>
        </div>
    </div>
    <div class="detail--wrapper">
        <div class="book-detail">
            <p><strong>ID:</strong> <?php echo $book['id']; ?></p>
            <p><strong>Name:</strong> <?php echo $book['name']; ?></p>
            <p><strong>Genre:</strong> <?php echo $book['genre']; ?></p>
            <p><strong>Code:</strong> <?php echo $book['code']; ?></p>
            <p><strong>Author:</strong> <?php echo $book['author']; ?></p>
            <p><strong>Publisher:</strong> <?php echo $book['publisher']; ?></p>
        </div>
        <a href="books.php" class="btn">Back to Books</a>
    </div>
</div>
</body>
</html>
