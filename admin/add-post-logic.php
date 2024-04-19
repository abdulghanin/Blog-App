<?php
require 'config/database.php';
if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $title =filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body =filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id= filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = ($_FILES['thumbnail']);

    //  set is_featured to 0 if unchecked 
    $is_featured = $is_featured == 1 ?: 0;
    //    validate input values 
    if (!$title) {
        $_SESSION['add-post'] = "Enter post title";
    } elseif(!$body) {
        $_SESSION['add-post'] = "Enter post body";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Select post category";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Choose post thumbnail";
    } 
    else {
        //   WORK ON AVATAR 
        // rename avatar 
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        // make sure file is an image 
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $thumbnail_name);
        $extention = end($extention);
        if (in_array($extention, $allowed_files)) {
            if ($thumbnail['size'] < 2_000_000) {
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = "file size too big. Should less than 2mb";
            }
        } else {
            $_SESSION['add-post'] = "file Should be png,jpg,or jpeg";
        }
    }

    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/');
        die();
    } else {
        // set is_featured of all posts to 0 if is_featured for this post is 1

        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connetion, $zero_all_is_featured_query);
        }
        $insert= "INSERT into posts (title,body,thumbnail,category_id,author_id,is_featured) 
        VALUES('$title','$body','$thumbnail_name',$category_id,$author_id,$is_featured)";
        $insert_user_result = mysqli_query($connetion, $insert);
        if(!mysqli_errno($connetion)) {
            $_SESSION['add-post-success'] = "New post added  Successful ";
            header('location: ' . ROOT_URL . 'admin/');
            die();
        }
    }
}
header('location: ' . ROOT_URL . 'admin/add-post.php');
die();


