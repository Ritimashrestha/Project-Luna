<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "project_luna") or die("Connection failed");

// Fetch data for the cards
$total_books_query = "SELECT COUNT(*) as total_books FROM add_book";
$total_books_result = mysqli_query($conn, $total_books_query);
$total_books_data = mysqli_fetch_assoc($total_books_result);
$total_books = $total_books_data['total_books'];

$total_transactions_query = "SELECT COUNT(*) as total_transactions FROM add_member"; 
$total_transactions_result = mysqli_query($conn, $total_transactions_query);
$total_transactions_data = mysqli_fetch_assoc($total_transactions_result);
$total_transactions = $total_transactions_data['total_transactions'];

$total_students_query = "SELECT COUNT(*) as total_students FROM add_student"; 
$total_students_result = mysqli_query($conn, $total_students_query);
$total_students_data = mysqli_fetch_assoc($total_students_result);
$total_students = $total_students_data['total_students'];

// Default query without search filter
$sql = "SELECT * FROM `add_member`";

// Check if search query is present
if(isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = mysqli_real_escape_string($conn, $_GET['search_query']);
    // Modify SQL query to include search filter by student ID
    $sql = "SELECT am.* FROM add_student am
            JOIN add_student ast ON am.name = ast.name
            WHERE ast.sid LIKE '%$search_query%'";
}

// Execute SQL query
$qry = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/luna.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Add your custom styles here */
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 15px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include("inc/sidebar.php"); ?>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span>Primary</span>
                <h2>Dashboard</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <form action="dashboard.php" method="GET">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" name="search_query" placeholder="Search by Student ID">
                        <button type="submit">Search</button>
                    </form>
                </div>
                <img src="uploads/aims.jfif" alt="Wait a second" id="companyLogo">
            </div>
        </div>
        <div class="card--container">
            <h3 class="main--title">Today's Data</h3>
            <div class="card--wrapper">
                <div class="payment--card light-red">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Total books</span>
                            <span class="amount-value"><?php echo $total_books; ?></span>
                        </div>
                        <i class="fas fa-book-open icon dark-red"></i>
                    </div>
                    <span class="card-detail">**** **** **** ****</span>
                </div>

                <div class="payment--card light-purple">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Total transactions</span>
                            <span class="amount-value"><?php echo $total_transactions; ?></span>
                        </div>
                        <i class="fas fa-list icon dark-purple"></i>
                    </div>
                    <span class="card-detail">**** **** **** ****</span>
                </div>

                <div class="payment--card light-green">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Total students</span>
                            <span class="amount-value"><?php echo $total_students; ?></span>
                        </div>
                        <i class="fas fa-users icon dark-green"></i>
                    </div>
                    <span class="card-detail">**** **** **** ****</span>
                </div>

                <div class="payment--card light-blue">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Genre</span>
                            <span class="amount-value"><?php echo $total_genre; ?></span>
                        </div>
                        <i class="fa-solid fa-check icon dark-blue"></i>
                    </div>
                    <span class="card-detail">**** **** **** ****</span>
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
                                <th>Return Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php if (mysqli_num_rows($qry) > 0) { 
                            while($res = mysqli_fetch_array($qry)){ ?>
                        <tr class="user-table">
                            <td><?php echo $res['id'];?></td>
                            <td><?php echo $res['name'];?></td>
                            <td><?php echo $res['book'];?></td>
                            <td><?php echo $res['date'];?></td>
                            <td><?php echo $res['duedate'];?></td>
                            <td><?php echo $res['returndate'];?></td>
                            <td><?php echo $res['status'];?></td>
                            <td>
                            <button><a href="transactionDetail.php?id=<?php echo $res['id']; ?>"><i class="fa fa-eye"></i></a></button>
                                <button><a href="editMember.php?id=<?php echo $res['id']; ?>"><i class="fa fa-edit"></i></a></button>
                                <button><a href="deleteMember.php?id=<?php echo $res['id']; ?>"><i class="fa fa-trash"></i></a></button>
                            </td> 
                        </tr>
                        <?php } } else { ?>
                        <tr>
                            <td colspan="8">No transactions found for the given Student ID.</td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="companyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Aims International Collage</h2>
            <p>Location: Lagankhel, Lalitpur</p>
            <p>Contact No: 9876543210</p>
            <p>Email Address: aims@gmail.com</p>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("companyModal");

        // Get the image that opens the modal
        var img = document.getElementById("companyLogo");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the image, open the modal
        img.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
