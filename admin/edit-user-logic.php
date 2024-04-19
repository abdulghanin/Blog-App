<?php 
require 'config/database.php';
if (isset(($_POST['submit']))) {
    $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin	= filter_var($_POST['userrole'],FILTER_SANITIZE_NUMBER_INT );
    

    //    validate input values 
    if (!$firstname || !$lastname) {
        $_SESSION['edit-user'] = "Invalid form input edit page.";
    } else{
    //  updata user 
    $query = "UPDATE users SET firstname='$firstname',lastname='$lastname',is_admin='$is_admin' WHERE id=$id LIMIT 1";
    $result =mysqli_query($connetion,$query);
    if(mysqli_errno($connetion)){
        $_SESSION['edit-user']= "Failed to update";

    }else {
        $_SESSION['edit-user-success']= "User $firstname $lastname  updated successfully";
    }
    }
}
header('location: ' . ROOT_URL . 'admin/manager-user.php');