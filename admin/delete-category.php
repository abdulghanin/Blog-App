<?php
require 'config/database.php';
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // update ctaegory_id of posts that belong to this category to id of uncategorized category 
    $update_query = "UPDATE  posts  set category_id=5 WHERE category_id=$id";
    $result = mysqli_query($connetion, $update_query);
    if (!mysqli_errno($connetion)) {
        $qurey = "DELETE FROM categories WHERE id=$id LIMIT 1";
        $result = mysqli_query($connetion, $qurey);
        $_SESSION['delete-category-success'] = "Category deleted successfully";
    }
}

// delete user from database 

header('location:' . ROOT_URL . 'admin/manager-categories.php');
die();
