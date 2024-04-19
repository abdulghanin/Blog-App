<?php
session_start();
require 'config/constants.php';
 $username_email = $_SESSION['signin-data']['username_email'] ?? null;
 $password = $_SESSION['signin-data']['password'] ?? null ;
 unset($_SESSION['signin-data']);
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
        <h2>Sign In</h2>
        <?php if(isset($_SESSION['signup-success'])) :?>
            <div class="alert__message  success">
                <p>
                    <?=$_SESSION['signup-success'];
                    unset($_SESSION['signup-success']);
                    ?>
                </p>
            </div>
       <?php elseif(isset($_SESSION['signin'])) :?>
            <div class="alert__message  error">
                <p>
                    <?= $_SESSION['signin'];
                    unset($_SESSION['signin']);
                    ?>
                </p>
            </div>
       <?php endif ?>
        <form action="<?php ROOT_URL  ?>signin-logic.php" method="POST">
            <input type="text" name="username_email"value="<?php $username_email ?>" placeholder="Username or Email">
            <input type="password" name="password" value="<?php $password ?>" placeholder="Password">
            <button type="submit" name="submit" class="btn">Sign In</button>
            <small>Dont' t have  account <a href="signup.php">Sign In</a></small>
        </form>

    </div>

</section>
 </body>
 </head>