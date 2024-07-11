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

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $book = $_POST['book'];
    $date = $_POST['date'];
    $duedate = $_POST['duedate'];
    $status = $_POST['status'];

    $sql = "UPDATE add_member SET name='$name', book='$book', date='$date', duedate='$duedate', status='$status' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: members.php");
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
                        <input type="text" name="name" id="name" autocomplete="off" value="<?php echo $member['name']; ?>" required>
                    </div>     
                    <div class="field input">
                        <label for="book">Book</label>
                        <input type="text" name="book" id="book" autocomplete="off" value="<?php echo $member['book']; ?>" required>
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
                        <label for="status">Status</label>
                        <input type="text" name="status" id="status" autocomplete="off" value="<?php echo $member['status']; ?>" required>
                    </div> 
                    <div class="field">        
                        <input type="submit" class="btn" name="update" value="Update">
                    </div>
                </form>
            <?php else: ?>
                <p>Transaction not found or ID not provided.</p>
            <?php endif; ?>
        </div>    
    </div>    
</body>
</html>
