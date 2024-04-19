<?php
include 'partials/header.php';
//    fecth all posts from posts
$qurey = "SELECT * FROM posts ORDER BY date_time DESC";
$posts = mysqli_query($connetion, $qurey);

?>

<section class="search__bar">
    <form class="container search__bar-container" action="<?= ROOT_URL ?>search.php" method="GET">
        <div>
            <i class="uil uil-search"></i>
            <input type="search" name="search" placeholder="Search">
        </div>
        <button type="submit" name="submit" class="btn">Go</button>
    </form>
</section>
<!-- =================END OF SEARCH=========== -->
<section class="posts <?= $featured ? '' : 'section__extra-margin' ?>">
    <div class="container posts__container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post__thumbail">
                    <img src="./images/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post__info">
                    <?php
                    // fetch category form categories using category_id of post
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connetion, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    ?>
                    <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <h3 class="post__title"><a href="post.php?id=<?= $post['id']?>"><?= $post['title'] ?></a></h3>
                    <p class="post__body"><?= substr($post['body'], 0, 150) ?>...</p>
                    </p>
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
                </div>
            </article>
        <?php endwhile ?>
    </div>
</section>
<!-- ======== END OF POSTS======== -->
<section class="category__buttons">
    <div class="container category__button-container">
        <?php
        $all_categories_query = "SELECT * FROM categories ";
        $all_categories = mysqli_query($connetion, $all_categories_query);

        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>
<?php
include 'partials/footer.php';

?>