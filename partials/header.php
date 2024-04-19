<?php 
require 'config/database.php';
if(isset($_SESSION['user-id'])){
    $id =filter_var($_SESSION['user-id'],FILTER_SANITIZE_NUMBER_INT);
    $qurey= "SELECT avatar FROM users WHERE id=$id";
    $result =mysqli_query($connetion,$qurey);
    $avatar = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,800;0,900;1,300;1,400;1,600&display=swap" rel="stylesheet">
    <title> Blog Website</title>
</head>
<body>
    <nav>
        <div class="container  nav__container">
            <a href="<?= ROOT_URL  ?>"class="nav__logo">Code Man</a>
            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL  ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL  ?>services.php">Services</a></li>
                <li><a href="<?= ROOT_URL  ?>contact.php">Contact</a></li>
                <?php if(isset($_SESSION['user-id'])): ?>
                    <li class="nav__porfile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL .'images/' .$avatar['avatar'] ?>">
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL  ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL  ?>logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li><a href="<?= ROOT_URL  ?>signin.php">Signin</a></li>
                <?php endif ?>
            </ul>    
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>