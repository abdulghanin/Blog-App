 <?php
  include 'partials/header.php';
  if(isset($_GET['id'])){
    $id	= filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT );
    $query = "SELECT * FROM  categories WHERE id=$id";
    $result = mysqli_query($connetion,$query);
    if(mysqli_num_rows($result)== 1){
    $category = mysqli_fetch_assoc($result);
    }
   } else {
    header('location :' . ROOT_URL . 'admin/manager-categories');
    die();
   }
  ?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Edit Category</h2>
            
            <form action="<?php ROOT_URL ?>edit-category-logic.php" method="POST">
              <input type="hidden" name="id" value="<?=$category['id'] ?>">
                <input type="text" name="title" value="<?=$category['title'] ?>"  placeholder="Title">
                <textarea rows="4"  name="dsecription" placeholder="Description"> <?=$category['dsecription'] ?></textarea>
                <button type="submit" name="submit"  class="btn">Updata Category </button>
            </form>
        </div>
    </section>
<?php
  include '../partials/footer.php';
  ?>