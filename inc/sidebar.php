<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sidebar</title>
     <link rel="stylesheet" href="../assets/luna.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <script src="./logout.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="logo font" >LUNA</div>
        <ul class="menu">
            <li class="">
                <a href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="addBook.php">
                    <i class="fas fa-plus"></i>
                    <span>Add Book</span>
                </a>
            </li>
            <li>
                <a href="books.php">
                    <i class="fas fa-book-open"></i>
                    <span>Books</span>
                </a>
            </li>            
            <li>
                <a href="addStudent.php">
                    <i class="fas fa-book-reader"></i>
                    <span>Add Student</span>
                </a>
            </li>            
            <li>
                <a href="students.php">
                    <i class="fas fa-users"></i>
                    <span>Students</span>
                </a>
            </li>
            <li>
                <a href="addMember.php">
                    <i class="fas fa-box"></i>
                    <span>Add Transaction</span>
                </a>
            </li> 
            <li>
                <a href="members.php">
                    <i class="fa fa-exchange"></i>
                    <span>Transaction </span>
                </a>
            </li>
            <li class="logout">
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span onclick="confirmButton()">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</body>
</html>
