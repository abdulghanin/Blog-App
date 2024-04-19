<?php
session_start();
require 'config/database.php';

if (isset(($_POST['submit']))) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cofirmpassword = filter_var($_POST['cofirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin	= filter_var($_POST['userrole'],FILTER_SANITIZE_NUMBER_INT );
    $avatar = ($_FILES['avatar']);

    //    validate input values 
    if (!$firstname) {
        $_SESSION['add-user'] = "please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "please enter your lastname Name";
    } elseif (!$username) {
        $_SESSION['add-user'] = "please enter your User Name Name";
    } elseif (!$email) {
        $_SESSION['add-user'] = "please enter your  a valid email";
    }elseif (!$is_admin) {
        $_SESSION['add-user'] = "please select user role";
    }
    elseif (strlen($createpassword) < 8 || strlen($cofirmpassword) < 8) {
        $_SESSION['add-user'] = "Password should be 8+ characters";
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = "please add avatar";
    } 
    else {
        // check if password dont 
        if ($createpassword !== $cofirmpassword) {
            $_SESSION['signup'] = "Password do not match";
        } else {
            // hash password 
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
            //    check if username or email already in database 
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connetion, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "User or Email already exit";
            } else {
                //   WORK ON AVATAR 
                // rename avatar 
                $time = time();
                $avatar_name = $time. $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' .$avatar_name;

                // make sure file is an image 
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention= end($extention);
                if (in_array($extention, $allowed_files)) {
                    if ($avatar['size'] < 1000000) {
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add-user'] = "file size too big. Should less than 1mb";
                    }
                } else {
                    $_SESSION['add-user'] = "file Should be png,jpg,or jpeg";
                }
            }
        }

    }
    if (isset($_SESSION['add-user'])) {
        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-user.php');
        die();
    } else {
        $insert_user_query="insert into users(firstname,lastname,username,email,password,avatar,is_admin) 
        values ('$firstname','$lastname','$username','$email','$hashed_password','$avatar_name',$is_admin)";
        $insert_user_result= mysqli_query($connetion,$insert_user_query);
        if (!mysqli_errno($connetion)) {
            $_SESSION['add-user-success'] = "New user $firstname $lastname Successful added";
            header('location: ' . ROOT_URL . 'admin/manager-user.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}
