<?php

require 'config/database.php';
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'],
    FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //  set is_featured to 0 if unchecked 
    $is_featured = $is_featured == 1 ?: 0;
    //    validate input values 
    if (!$title) {
        $_SESSION['edit-post'] = "Couldn'n update post .Invalid form date edit  post page";
    } elseif (!$body) {
        $_SESSION['edit-post'] = "Couldn'n update post .Invalid form date edit  post page";
    } elseif (!$category_id) {
        $_SESSION['edit-post'] = "Couldn'n update post .Invalid form date edit  post page";
    } else {
        // delete existing  thumnail if new thumbail is avalable
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if ($previous_thumbnail_path) {
                unlink($previous_thumbnail_path);
            }
            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;
            // make sure file is an image 
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extention = explode('.', $thumbnail_name);
            $extention = end($extention);
            if (in_array($extention, $allowed_files)) {
                if ($thumbnail['size'] < 2000000) {
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['edit-post'] = "Couldn'n update post. size too big. Should less than 2mb";
                }
            } else {
                $_SESSION['edit-post'] = "Couldn'n update post. be png,jpg,or jpeg";
            }
        }
    }
    if($_SESSION['edit-post']) {
        header('location: ' . ROOT_URL . 'admin/');
        die();
    } else {
        // set is_featured of all posts to 0 if is_featured for this post is 1
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connetion, $zero_all_is_featured_query);
        }
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
        //updata post
        $query ="UPDATE posts SET title='$title',body='$body',	thumbnail='$thumbnail_to_insert',category_id=$category_id,
        is_featured=$is_featured  WHERE id=$id LIMIT 1";
        $result = mysqli_query($connetion,$query);
    }
    if (!mysqli_errno($connetion)) {
        $_SESSION['edit-post-success'] = "Posts updated successfully";
    }
}
header('location: ' . ROOT_URL . 'admin/');
die();
