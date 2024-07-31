<?php
include("db.php");

$book = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM add_book WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $book = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching book: " . mysqli_error($conn);
    }
} else {
    echo "No book ID provided";
    exit;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $genre = $_POST['genre'];
    $code = $_POST['code'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];

    $sql = "UPDATE add_book SET name='$name', genre='$genre', code='$code', author='$author', publisher='$publisher' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: books.php");
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
    <title>Edit Book</title>
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
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Edit Book</header>
            <?php if ($book): ?>
                <form action="editBook.php?id=<?php echo $book['id']; ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                    <div class="field input">
                        <label for="name">Book Name</label>
                        <input type="text" name="name" id="name" autocomplete="off" value="<?php echo $book['name']; ?>" required>
                    </div>     
                    <div class="field input">
                        <label for="genre">Genre</label>
                        <input type="text" name="genre" id="genre" autocomplete="off" value="<?php echo $book['genre']; ?>" required>
                    </div> 
                    <div class="field input">
                        <label for="code">Book Code</label>
                        <input type="text" name="code" id="code" autocomplete="off" value="<?php echo $book['code']; ?>" required>
                    </div> 
                    <div class="field input">
                        <label for="author">Author</label>
                        <input type="text" name="author" id="author" autocomplete="off" value="<?php echo $book['author']; ?>" required>
                    </div> 
                    <div class="field input">
                        <label for="publisher">Publisher</label>
                        <input type="text" name="publisher" id="publisher" autocomplete="off" value="<?php echo $book['publisher']; ?>" required>
                    </div> 
                    <div class="field">
                        <input type="submit" class="btn" name="update" value="Update">
                        <a href="books.php" class="btn-cancel">Cancel</a>
                    </div>
                </form>
            <?php else: ?>
                <p>Book not found or ID not provided.</p>
            <?php endif; ?>
        </div>    
    </div>    
</body>
</html>
