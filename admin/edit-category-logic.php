<?php 
session_start();
require 'config/database.php';
if(isset($_POST['submit'])) {
    $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dsecription = filter_var($_POST['dsecription'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    //    validate input values 
    if (!$title || !$dsecription) {
        $_SESSION['edit-category'] = "Invalid form input edit category page.";
    } else{
    //  updata user 
    $query ="UPDATE categories SET title='$title',dsecription='$dsecription' WHERE id=$id LIMIT 1";
    $result =mysqli_query($connetion,$query);
    if(mysqli_errno($connetion)){
        $_SESSION['edit-category']= "Couldn't update categroy";

    }else {
        $_SESSION['edit-category-success']= "categroy $title  updated successfully";
    }
    }
}
header('location: ' . ROOT_URL . 'admin/manager-categories.php');