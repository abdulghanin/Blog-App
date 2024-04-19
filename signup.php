<?php
 session_start();
 require 'config/constants.php';
 //get back form data if there was a registration error
 $firstname = $_SESSION['signup-data']['firstname'] ?? null;
 $lastname = $_SESSION['signup-data']['lastname'] ?? null;
 $username = $_SESSION['signup-data']['username'] ?? null;
 $email = $_SESSION['signup-data']['email'] ?? null;
 $createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
 $ofirmpassword = $_SESSION['signup-data']['cofirmpassword'] ?? null ;
 unset($_SESSION['signup-data']);

?>

<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="<?php ROOT_URL ?>css/style.css">
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
     <!-- Google Fonts -->
     <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,800;0,900;1,300;1,400;1,600&display=swap" rel="stylesheet">
     <title> Blog Website</title>
 <body>
 <section class="form__section">
    <div class="container form__section-container">
        <h2>Sign Up</h2>
        <?php if(isset($_SESSION['signup'])) :?>
         <div class="alert__message error">
            <p>
               <?= $_SESSION['signup'];
               unset($_SESSION['signup']);
               ?>
               </p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL  ?>signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstname" value="<?php $firstname ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?php $lastname ?>" placeholder="Last Name">
            <input type="text" name="username" value="<?php $username ?>" placeholder="Username">
            <input type="email" name="email" value="<?php $email ?>" placeholder="Email">
            <input type="password" name="createpassword" value="<?php $createpassword ?>"  placeholder="Create Password">
            <input type="password" name="cofirmpassword" value="<?php $cofirmpassword ?>" placeholder="Confirm Password">
            <div class="form__control">
                <label for="avatar"> User Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sign Up</button>
              <small>Already have an account <a href="signin.php">Sign In</a></small>
        </form>

    </div>
</section>
 </body>
 </head>