<?php
include 'partials/header.php';
// fetch post from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $qurey = "SELECT *FROM posts WHERE id=$id";
    $result = mysqli_query($connetion, $qurey);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}

?>

<!-- ============== ENED NAV =============== -->
<Section class="singlepost">
    <div class="container singlepost__container">
        <h2><?= $post['title'] ?></h2>
        <div class="post__author">
            <?php
            // fetch author form users using author_id 
            $author_id = $post['author_id'];
            $author_query = "SELECT * FROM users WHERE id=$author_id";
            $author_result = mysqli_query($connetion, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            ?>
            <div class="post__author-avatar">
                <img src="./images/<?= $author['avatar'] ?>">
            </div>
            <div class="post__author-info">
                <h5>By:<?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                <small><?= date("M d,Y - H:i", strtotime($post['date_time'])) ?></small>
            </div>
        </div>
    <div class="singlepost__thumbnail">
        <img src="./images/<?=$post['thumbnail']?>">
    </div>
    <p><?=$post['body'] ?></p>
    </div>
</Section>
<?php
include 'partials/footer.php';

?>