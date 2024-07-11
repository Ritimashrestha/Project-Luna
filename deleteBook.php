<?php
// Include database connection
include("db.php");

// Check if 'id' is set in the GET parameters
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Check if user confirmed deletion using JavaScript
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Construct the SQL query to delete the record
        $query = "DELETE FROM add_book WHERE id='$id'";

        // Perform the deletion query
        $result = mysqli_query($conn, $query);

        // Check if the deletion was successful
        if ($result) {
            // Redirect back to books.php after successful deletion
            header("Location: books.php");
            exit; // Ensure that script stops execution after redirection
        } else {
            echo "Failed to delete record: " . mysqli_error($conn);
        }
    } else {
        // If user hasn't confirmed, show JavaScript confirmation dialog
        echo "<script>
                if (confirm('Are you sure you want to delete this book?')) {
                    window.location.href = 'deleteBook.php?id=$id&confirm=yes';
                } else {
                    window.location.href = 'books.php';
                }
              </script>";
    }
} else {
    echo "No book ID provided";
}
?>
