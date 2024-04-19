<?php
include 'partials/header.php';
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connetion, $category_query);
// fetch post data from database if id is set
if (isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * from posts WHERE id=$id";
  $result = mysqli_query($connetion, $query);
  $post = mysqli_fetch_assoc($result);
} else {
  header('location :' . ROOT_URL . 'admin/');
  die();
}

?>
<section class="form__section">
  <div class="container form__section-container">
    <h2>Edit Post</h2>
    <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
      <input type="hidden" name="id" value="<?= $post['id'] ?>">
      <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
      <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title">
      <select name="category">
        <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
          <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
        <?php endwhile ?>
      </select>
      <textarea rows="10" name="body" placeholder="Body"><?= $post['body'] ?></textarea>
      <div class="form__control inline">
        <input type="checkbox" name="is_featured" id="is__featured" value="1" checked>
        <label for="is__featured">Featured</label>
      </div>
      <div class="form__control">
        <label for="thumbnail">Change Thumbnail</label>
        <input type="file" name="	thumbnail" id="thumbnail">
      </div>
      <button type="submit" name="submit" class="btn">Updata Post </button>
    </form>
  </div>
</section>
<?php
include '../partials/footer.php';
?>