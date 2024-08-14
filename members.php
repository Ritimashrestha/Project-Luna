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
            margin-left: 70rem;
            padding: 10px 20px;
            border: none;
            background-color: rgba(76, 68, 182, 0.808);
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #69399F; 
        }
        .btn a {
            color: white; 
            text-decoration: none; 
        }
        .disabled-btn {
            background-color: #ccc; 
            cursor: not-allowed;
        }
        .disabled-btn i {
            color: #999;
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

                        <?php if ($res['status'] == 'Returned') { ?>
                            <!-- Render a disabled edit button -->
                            <button class="disabled-btn" disabled><i class="fa fa-edit"></i></button>
                        <?php } else { ?>
                            <!-- Render the active edit button -->
                            <button><a href="editMember.php?id=<?php echo $res['id']; ?>"><i class="fa fa-edit"></i></a></button>
                        <?php } ?>

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
