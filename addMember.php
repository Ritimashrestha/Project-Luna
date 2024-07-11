<?php
if (isset($_POST['submit'])){
$name = $_POST['name'];
$book = $_POST['book'];
$date = $_POST['date'];
$duedate = $_POST['duedate'];
$status = $_POST['status'];


$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'project_luna';

$conn = mysqli_connect($host, $user, $pass,$dbname);

$sql = "INSERT INTO add_member(name, book, date, duedate, status) VALUES ('$name', '$book', '$date', '$duedate', '$status' )";
mysqli_query($conn, $sql);

header("Location: members.php");

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/luna.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php
    include("inc/sidebar.php");
    ?></body>
   <div class="main--content">
        <div class="header--wrapper">
             <div class="header--title">
             <span>Libary</span>
                <h2>Transaction Registration</h2>
            </div>
            <div class="user--info">
            <div class="search--box">
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="Search">
            </div>
        </div>
    </div>   
<body>
    <div class="container">
        <div class="box form-box">
            <header>Add Transaction</header>
            <form action="members.php" method="post">
                 <div class="field input">
                     <label for="name">Name</label>
                     <input type="text" name="name" id="name" autocomplete="off" >
                 </div> 
                 <div class="field input">
                     <label for="book">Book</label>
                     <input type="text" name="book" id="book" autocomplete="off" >
                 </div> 
                 <div class="field input">
                     <label for="date">Date</label>
                     <input type="date" name="date" id="date" autocomplete="off" >
                </div> 

                <div class="input-radio-select">

                    <!-- <div id="field-radio-buttons">
                        <label for="teacher">Teacher</label>
                        <input type="radio" name="teacher" id="teacher" class="radio-select">
                        <label for="student">Student</label>
                        <input type="radio" name="student" id="student" class ="radio-select">
                    </div>   -->
                </div>
                    <div class="field input">
                        <label for="duedate">Due Date</label>
                        <input type="date" name="duedate" id="duedate" autocomplete="off" >
                    </div> 
                    <div class="field input">
                    <label for="status">Status </label>
                    <input type="text" name="status" id="status" autocomplete="off" >
                </div>    
                <div class="field ">
                    <input type="submit" class= "btn" name="submit" value="Register" >
                 </div>     
            </form>
        </div>
    </div>
  
</body>
</html>