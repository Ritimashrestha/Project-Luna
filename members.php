<?php
$conn=mysqli_connect("localhost","root", "", "project_luna") or die("COnnection failed");
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
                <button class="btn"><a href="addMember.php">Add Transaction</a><button>
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
                                <th>Book</th>
                                <th>Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        $sql = "SELECT * FROM `add_member`";
                        $qry = mysqli_query($conn, $sql);
                        while($res = mysqli_fetch_array($qry)){
                        ?>
                        <tr class="user-table">
                            <td><?php echo $res['id'];?></td>
                            <td><?php echo $res['name'];?></td>
                            <td><?php echo $res['book'];?></td>
                            <td><?php echo $res['date'];?></td>
                            <td><?php echo $res['duedate'];?></td>
                            <td><?php echo $res['status'];?></td>
                            <td>
                            <button> <a href="editMember.php?id=<?php echo $res['id']; ?>&?na=<?php echo $res['name']; ?>&?em=<?php echo $res['book']; ?>&?co=<?php echo $res['date']; ?>&?bo=<?php echo $res['duedate']; ?>&?cod=<?php echo $res['status']; ?>"> <i class="fa fa-edit"></i></a><button>
                            <button> <a href="deleteMember.php?id=<?php echo $res['id']; ?>"> <i class="fa fa-trash"></i></a><button>
                            </td> 
                        </tr>
                        <?php }; ?>
                    </table>
                </div>
            </div>
        </div>
        
</body>
</html>