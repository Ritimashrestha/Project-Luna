<?php
include ('addMember.php');
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$book = $_POST['book'];
$code = $_POST['code'];

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'project_luna';

$conn = mysqli_connect($host, $user, $pass,$dbname);

$sql = "INSERT INTO add_member(name, email, contact, book, code) VALUES ('$name', '$email', '$contact', '$book', '$code' )";
mysqli_query($conn, $sql);
?>