<?php
  include 'partials/header.php';
  $title = $_SESSION['add-category-data']['title'] ?? null;
  $dsecription = $_SESSION['add-category-data ']['dsecription'] ?? null;

  unset($_SESSION['add-category-data']);
  ?>

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Add Category</h2>
            <?php if (isset($_SESSION['add-category'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                    ?>
                </p>
            </div>
        <?php endif ?>
            <form action="<?php ROOT_URL  ?>add-category-logic.php" method="POST">
                <input type="text" value="<?= $title ?>" name="title" placeholder="Title">
                <textarea rows="4" value="<?= $dsecription ?>" name="dsecription" placeholder="Description"></textarea>
                <button type="submit" name="submit"  class="btn">Add Category </button>
            </form>
        </div>
    </section>
<?php
  include '../partials/footer.php';
  ?>