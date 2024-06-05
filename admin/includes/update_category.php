<form action="" method="post">
  <div class="form-group">
    <label for="cat_title">Edit Category</label>
    <?php

    if (isset($_GET['edit_id'])) {
      $edit_id = $_GET['edit_id'];
      $query = "SELECT * FROM categories WHERE cat_id = {$edit_id}";
      $select_specifi_category = mysqli_query($connection, $query);
      if (!$select_specifi_category) {
        die("Query Failed..! " . mysqli_error($connection));
      } else {
        while ($row = mysqli_fetch_assoc($select_specifi_category)) {
          $cat_id = $row['cat_id'];
          $cat_title = $row['cat_title'];
          ?>
          <input value="<?php if (isset($cat_title)) {
            echo $cat_title;
          } ?>" id="cat_title" class="form-control" type="text" name="cat_title">
          <?php
        }
      }
    }

    ?>
    <?php
    if (isset($_POST['update_category'])) {
      $update_cat_title = $_POST['cat_title'];
      $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id={$update_cat_id}";
      $update_category_query = mysqli_query($connection, $query);
      if (!$update_category_query) {
        die("Query Failed..! " . mysqli_error($connection));
      }
    }
    ?>

  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
  </div>
</form>