<?php
if (isset($_POST['submit'])){
$name = $_POST['name'];
$class = $_POST['class'];
$address = $_POST['address'];
$contact = $_POST['contact'];

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'project_luna';

$conn = mysqli_connect($host, $user, $pass,$dbname);

$sql = "INSERT INTO add_student(name, class, address, contact) VALUES ('$name', '$class', '$address', '$contact' )";
mysqli_query($conn, $sql);

header("Location: students.php");

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
                <h2>Student Registration</h2>
            </div>
    </div>   
    <div class="container">
        <div class="box form-box">
            <header>Add Student</header>
            <form action="#" method="post">
                <div class="field input">
                     <label for="name">Name</label>
                     <input type="text" name="name" id="name" autocomplete="off" required>
                 </div>     
                <div class="field input">
                     <label for="class">Class</label>
                     <input type="text" name="class" id="class" autocomplete="off" required>
                </div> 
                <div class="field input">
                    <label for="address">Address </label>
                    <input type="text" name="address" id="address" autocomplete="off" required>
                </div> 
                <div class="field input">
                    <label for="contact">Contact No.</label>
                    <input type="text" name="contact" id="contact" autocomplete="off" required>
                </div> 
                <div class="field ">        
                 <input type="submit" class= "btn" name="submit" value="Register">
                </div>
            </form>
    </form>        
    </div>    
</body>
</html>
