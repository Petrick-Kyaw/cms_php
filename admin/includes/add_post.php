<?php
$username = $_SESSION['user_name'];
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


  move_uploaded_file($image_temp, "../images/$image");

  $query = "INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
  $query .= "VALUES({$category},'{$title}','{$author}',now(),'{$image}','{$content}','{$tags}','{$status}')";
  $add_post_query = mysqli_query($connection, $query);
  confirm_query($add_post_query);
  //take the last id of last query
  $the_new_post_id = mysqli_insert_id($connection);
  echo "<p class='bg-success'>Post Added..! <a href='../post.php?p_id={$the_new_post_id}'> View post</a> or <a href='./posts.php'>Edit more posts</a></p>";

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
    <input value="<?php echo $username; ?>" type="text" id="author" name="author" class="form-control" readonly>
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
        if ($ps_name == 'draft') {
          echo "<option value='{$ps_name}' selected>{$ps_show}</option>";
        } else {
          echo "<option value='{$ps_name}'>{$ps_show}</option>";
        }
      }
      ?>
    </select>
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
    <label for="summernote">Post Content</label>
    <textarea name="content" id="summernote" class="form-control" cols="30" rows="10"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" name="add_post" value="Publish Post" class="btn btn-primary">
  </div>
</form>