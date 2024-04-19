<?php
require 'config/database.php';
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch user from database 
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connetion, $query);
    $user = mysqli_fetch_assoc($result);
    // make sure we got back only one user 
    if (mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        // delete image if available 
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }


    //  FOR LATER 
    // // fetch all thumbnails of user's posts and delete them 
    $thuumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id ";
    $thuumbnails_result = mysqli_query($connetion, $thuumbnails_query);
    if (mysqli_num_rows($thuumbnails_result) > 0) {
        while ($thuumbnails = mysqli_fetch_assoc($thuumbnails_result)) {
            $thuumbnail_path = '../images/' . $thuumbnail['thumbnail'];
            // delete thumbnail from images folder is exist 
            if ($thuumbnail_path) {
                unlink($thuumbnail_path);
            }
        }
    }

    // delete user from database 
    $delete_user_qurey="DELETE FROM users WHERE id=$id ";
    $delete_user_result = mysqli_query($connetion, $delete_user_qurey);
    if (!mysqli_errno($connetion)) {
        $_SESSION['delete-user'] = "Couldn't delete '{$user['firstname']}  '{$user['lastname']}'";
    } else {
        $_SESSION['delete-user-success'] = "{$user['firstname']}  {$user['lastname']}' deleted successfully";
    }
}

header('location:' . ROOT_URL . 'admin/manager-user.php');
die();
