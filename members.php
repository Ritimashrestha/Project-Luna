<?php
$conn = mysqli_connect("localhost", "root", "", "project_luna") or die("Connection failed");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="assets/luna.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
.btn {
    padding: 0 0 0 70rem;
    background-color: inherit;
}
    </style>
</head>
<body>
<?php
include("inc/sidebar.php");
?>
<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">
            <span>Details</span>
            <h2>Transaction</h2>
            <button class="btn"><a href="addMember.php">Add Transaction</a></button>
        </div>
    </div>
    <div class="tabular--wrapper">
        <h3 class="main--title">Transaction Data</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th> 
                        <th>Student ID</th> 
                        <th>Book</th>
                        <th>Date</th>
                        <th>Due Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $name = $_POST['name'];
                    $sid = $_POST['sid'];
                    $book = $_POST['book'];
                    $date = $_POST['date'];
                    $duedate = $_POST['duedate'];
                    $returndate = $_POST['returndate'];
                    $status = $_POST['status'];

                    $sql1 = "INSERT INTO add_members(name, sid, book, date, duedate, returndate, status) VALUES ('$name',  '$sid', '$book', '$date', '$duedate', '$returndate', '$status')";
                    mysqli_query($conn, $sql1);
                }

                $sql = "SELECT * FROM `add_member`";
                $qry = mysqli_query($conn, $sql);
                while ($res = mysqli_fetch_array($qry)) {
                ?>
                <tr class="user-table">
                    <td><?php echo $res['id']; ?></td>
                    <td><?php echo $res['name']; ?></td>
                    <td><?php echo $res['sid']; ?></td>
                    <td><?php echo $res['book']; ?></td>
                    <td><?php echo $res['date']; ?></td>
                    <td><?php echo $res['duedate']; ?></td>
                    <td><?php echo $res['returndate']; ?></td>
                    <td><?php echo $res['status']; ?></td>
                    <td>
                        <button><a href="transactionDetail.php?id=<?php echo $res['id']; ?>"><i class="fa fa-eye"></i></a></button>
                        <button><a href="editMember.php?id=<?php echo $res['id']; ?>"><i class="fa fa-edit"></i></a></button>
                        <button><a href="deleteMember.php?id=<?php echo $res['id']; ?>"><i class="fa fa-trash"></i></a></button>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
