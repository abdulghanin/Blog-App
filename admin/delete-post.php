<?php
require 'config/database.php';
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch user from database 
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connetion, $query);

    // make sure we got back only one user 
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $thumbnail_name = $time . $post['thumbnail'];

        $thumbnail_path = '../images/' . $thumbnail_name;
        // delete image if available 
        if ($thumbnail_path) {
            unlink($thumbnail_path);

            $delete_post_qurey = "DELETE FROM posts WHERE id=$id LIMIT 1";
            $delete_post_result = mysqli_query($connetion, $delete_post_qurey);
            if (!mysqli_errno($connetion)) {
                $_SESSION['delete-post-success'] = " Post deleted successfully ";
            } 
        }
       
    }
}
header('location:' . ROOT_URL . 'admin/');
die();

