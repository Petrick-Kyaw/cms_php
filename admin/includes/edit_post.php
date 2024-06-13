<?php

if (isset($_GET['edit_id'])) {

  $edit_post_id = $_GET['edit_id'];
}
$query = "SELECT * FROM posts WHERE post_id = {$edit_post_id}";
$select_post_by_id_query = mysqli_query($connection, $query);
confirm_query($select_post_by_id_query);
while ($row = mysqli_fetch_assoc($select_post_by_id_query)) {
  $post_title = $row['post_title'];
  $post_category = $row['post_category_id'];
  $post_author = $row['post_author'];
  $post_status = $row['post_status'];
  $post_image = $row['post_image'];
  $post_tags = $row['post_tags'];
  $post_content = $row['post_content'];
}



if (isset($_POST['edit_post'])) {
  $title = $_POST['title'];
  $category = $_POST['category'];
  $author = $_POST['author'];
  $status = $_POST['status'];

  $image = $_FILES['image']['name'];
  $image_temp = $_FILES['image']['tmp_name'];

  $tags = $_POST['tags'];
  $content = $_POST['content'];


  move_uploaded_file($image_temp, "../images/$image");

  if (empty($image)) {

    $query = "SELECT * FROM posts WHERE post_id = {$edit_post_id}";
    $select_image_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_image_query)) {
      $image = $row['post_image'];
    }


  }

  $query = "UPDATE posts SET ";
  $query .= "post_title = '{$title}', ";
  $query .= "post_category_id = {$category}, ";
  $query .= "post_date = now(), ";
  $query .= "post_author = '{$author}', ";
  $query .= "post_status = '{$status}', ";
  $query .= "post_tags = '{$tags}', ";
  $query .= "post_content = '{$content}', ";
  $query .= "post_image = '{$image}' ";
  $query .= "WHERE post_id = {$edit_post_id}";
  $edit_post_by_id = mysqli_query($connection, $query);
  confirm_query($edit_post_by_id);
}

?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title; ?>" type="text" id="title" name="title" class="form-control">
  </div>
  <div class="form-group">
    <select name="category" id="">
      <?php

      $query = "SELECT * FROM categories";
      $select_all_categories_query = mysqli_query($connection, $query);
      confirm_query($select_all_categories_query);
      while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];


        if ($cat_id == $post_category) {


          echo "<option selected value='{$cat_id}'>{$cat_title}</option>";


        } else {

          echo "<option value='{$cat_id}'>{$cat_title}</option>";


        }
      }

      ?>

    </select>
  </div>
  <div class="form-group">
    <label for="author">Post Author</label>
    <input value="<?php echo $post_author; ?>" type="text" id="author" name="author" class="form-control">
  </div>
  <div class="form-group">
    <label for="status">Post Status</label>
    <select name="status" id="status">
      <?php
      $query = "SELECT * FROM post_status";
      $select_post_status_query = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($select_post_status_query)) {
        $ps_name = $row['ps_name'];
        $ps_show = $row['ps_show'];
        if ($ps_name == $post_status) {
          echo "<option value='{$ps_name}' selected>{$ps_show}</option>";
        } else {
          echo "<option value='{$ps_name}'>{$ps_show}</option>";
        }
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <img width="100" src="../images/<?php echo $post_image; ?>" alt=""><br><br>
    <input type="file" name="image" id="">
  </div>
  <div class="form-group">
    <label for="tags">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" name="tags" id="tags" class="form-control">
  </div>
  <div class="form-group">
    <label for="summernote">Post Content</label>
    <textarea name="content" id="summernote" class="form-control" cols="30" rows="10"><?php echo $post_content; ?>
    </textarea>
  </div>
  <div class="form-group">
    <input type="submit" name="edit_post" value="Update Post" class="btn btn-primary">
  </div>
</form>