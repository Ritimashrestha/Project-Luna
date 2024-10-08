<?php
$conn=mysqli_connect("localhost","root", "", "project_luna") or die("Connection failed");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    </style>
</head>
<body>
    <?php include("inc/sidebar.php"); ?>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span>Details</span>
                <h2>Students</h2>
                <button class="btn"><a href="addStudent.php">Add Student</a></button>
            </div>
        </div>
        <div class="tabular--wrapper">
            <h3 class="main--title">Student Data</h3>
            <div class="table-container">
                <table>
                    <tr>
                        <th>SN</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Class</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM `add_student`";
                    $qry = mysqli_query($conn, $sql);
                    while($res = mysqli_fetch_array($qry)){
                    ?>
                    <tr>
                        <td><?php echo $res['id'];?></td>
                        <td><?php echo $res['name'];?></td>
                        <td><?php echo $res['sid'];?></td>
                        <td><?php echo $res['class'];?></td>
                        <td><?php echo $res['address'];?></td>
                        <td><?php echo $res['contact'];?></td>
                        <td>
                            <button><a href="studentDetail.php?id=<?php echo $res['id']; ?>"><i class="fa fa-eye"></i></a></button>
                            <button><a href="editStudent.php?id=<?php echo $res['id']; ?>"><i class="fa fa-edit"></i></a></button>
                            <button><a href="deleteStudent.php?id=<?php echo $res['id']; ?>"><i class="fa fa-trash"></i></a></button>
                        </td>
                    </tr>
                    <?php }; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
