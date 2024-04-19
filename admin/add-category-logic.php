<?php 
require 'config/database.php';
if(isset($_POST['submit'])) {
 $title =filter_var($_POST['title'] ,FILTER_SANITIZE_SPECIAL_CHARS);
 $dsecription =filter_var($_POST['dsecription'] ,FILTER_SANITIZE_SPECIAL_CHARS);
 if(!$title) {
    $_SESSION['add-category'] ='Enter title';
 }elseif(!$dsecription) {
    $_SESSION['add-category'] ='Enter dsecription';

 }
 if(isset($_POST['add-category'])) {
    $_SESSION['add-category-data']=$_POST;
    header('location: ' . ROOT_URL . 'admin/add-category-data');
    die();
}else {
    $query ="INSERT INTO categories(title,dsecription) VALUES('$title','$dsecription')";
    $result =mysqli_query($connetion,$query);
    if(mysqli_errno($connetion)){
        $_SESSION['add-category-data']= "Couldn' t add category ";
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        die();
    }else{
        $_SESSION['add-category-success']= "$title added successfully";
        header('location: ' . ROOT_URL . 'admin/manager-categories.php');
        die();
    }
}
}