<?php

if (isset($_POST['add_post'])) {
  $title = $_POST['title'];
  $category = $_POST['category'];
  $author = $_POST['author'];
  $status = $_POST['status'];

  $image = $_FILES['image']['name'];
  $image_temp = $_FILES['image']['tmp_name'];

  $tags = $_POST['tags'];
  $content = $_POST['content'];
  $post_date = date('d-m-y');
  $comment_count = 4;

  move_uploaded_file($image_temp, "../images/$image");

  $query = "INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
  $query .= "VALUES({$category},'{$title}','{$author}',now(),'{$image}','{$content}','{$tags}',{$comment_count},'{$status}')";
  $add_post_query = mysqli_query($connection, $query);
  confirm_query($add_post_query);

}

?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" id="title" name="title" class="form-control">
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
        echo "<option value='$cat_id'>{$cat_title}</option>";
      }

      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="author">Post Author</label>
    <input type="text" id="author" name="author" class="form-control">
  </div>
  <div class="form-group">
    <label for="status">Post Status</label>
    <input type="text" id="status" name="status" class="form-control">
  </div>
  <div class="form-group">
    <label for="image">Post Image</label>
    <input type="file" id="image" name="image">
  </div>
  <div class="form-group">
    <label for="tags">Post Tags</label>
    <input type="text" name="tags" id="tags" class="form-control">
  </div>
  <div class="form-group">
    <label for="content">Post Content</label>
    <textarea name="content" id="content" class="form-control" cols="30" rows="10"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" name="add_post" value="Publish Post" class="btn btn-primary">
  </div>
</form>