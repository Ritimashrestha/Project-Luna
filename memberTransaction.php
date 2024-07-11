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
            <div class="user--info">
            <div class="search--box">
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="Search">
            </div>
        </div>
    </div>   

        <?php
        include("addMember.php");
        ?>
</html>