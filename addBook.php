<?php
if (isset($_POST['submit'])){
$name = $_POST['name'];
$genre = $_POST['genre'];
$code = $_POST['code'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'project_luna';

$conn = mysqli_connect($host, $user, $pass,$dbname);

$sql = "INSERT INTO add_book(name, genre, code, author, publisher) VALUES ('$name', '$genre', '$code', '$author', '$publisher' )";
mysqli_query($conn, $sql);

header("Location: books.php");

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
                <h2>Registration</h2>
            </div>
    </div>   

    <div class="container">
        <div class="box form-box">
            <header>Add Book</header>
            <form action="#" method="post">
                <div class="field input">
                     <label for="name">Book Name</label>
                     <input type="text" name="name" id="name" autocomplete="off" required>
                 </div>     
                <div class="field input">
                     <label for="genre">Genre</label>
                     <input type="text" name="genre" id="genre" autocomplete="off" required>
                </div> 
                <div class="field input">
                    <label for="code">Book Code</label>
                    <input type="text" name="code" id="code" autocomplete="off" required>
                </div> 
                <div class="field input">
                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" autocomplete="off" required>
                </div> 
                <div class="field input">
                    <label for="publisher">Publisher</label>
                    <input type="text" name="publisher" id="publisher" autocomplete="off" required>
                </div> 
                <div class="field ">        
                 <input type="submit" class= "btn" name="submit" value="Register">
                </div>
            </form>
    </form>        
    </div>    
</body>
</html>

