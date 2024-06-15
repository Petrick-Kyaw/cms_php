<?php
if (isset($_POST['checkBoxArray'])) {
  foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
    $bulk_options = $_POST['bulk_options'];

    switch ($bulk_options) {
      case 'published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' ";
        $query .= "WHERE post_id = {$checkBoxValue}";
        $set_post_published_query = mysqli_query($connection, $query);
        confirm_query($set_post_published_query);
        break;
      case 'draft':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' ";
        $query .= "WHERE post_id = {$checkBoxValue}";
        $set_post_draft_query = mysqli_query($connection, $query);
        confirm_query($set_post_draft_query);
        break;
      case 'delete':
        $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
        $delete_post_query = mysqli_query($connection, $query);
        confirm_query($delete_post_query);
        break;
      case 'clone':
        $query = "SELECT * FROM posts WHERE post_id = {$checkBoxValue}";
        $select_post_query = mysqli_query($connection, $query);
        confirm_query($select_post_query);
        while ($row = mysqli_fetch_assoc($select_post_query)) {
          $post_title = $row['post_title'];
          $post_category_id = $row['post_category_id'];
          $post_date = $row['post_date'];
          $post_author = $row['post_author'];
          $post_status = $row['post_status'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_content = $row['post_content'];
        }
        $query = "INSERT INTO posts(post_category_id,post_title,post_author,";
        $query .= "post_date,post_image,post_content,post_tags,post_status) ";
        $query .= "VALUES($post_category_id,'$post_title','$post_author',now(),'$post_image',";
        $query .= "'$post_content','$post_tags','$post_status') ";
        $clone_post_query = mysqli_query($connection, $query);
        confirm_query($clone_post_query);
        break;
    }
  }
}
?>

<form action="" method="post">

  <table class="table table-bordered table-hover">

    <div id="bulkOptionContainer" class="col-xs-4 boc">
      <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
      </select>
    </div>

    <div class="col-xs-4">
      <input type="submit" name="submit" class="btn btn-success" value="Apply">
      <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>

    <thead>
      <tr>
        <th><input type="checkbox" name="" id="selectAllBoxes"></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Count</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php

      $query = "SELECT * FROM posts ORDER BY post_id DESC";
      $select_all_posts_query = mysqli_query($connection, $query);
      if (!$select_all_posts_query) {
        die("Query Failed..! " . mysqli_error($connection));
      } else {
        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
          $post_id = $row['post_id'];
          $post_author = $row['post_author'];
          $post_title = $row['post_title'];
          $post_category_id = $row['post_category_id'];
          $post_status = $row['post_status'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_comment_count = $row['post_comment_count'];
          $post_date = $row['post_date'];
          $post_views_count = $row['post_views_count'];

          echo "<tr>";
          ?>

          <td><input type="checkbox" name="checkBoxArray[]" class="selectBoxes" value="<?php echo $post_id ?>"></td>

          <?php
          echo "<td>{$post_id}</td>";
          echo "<td>{$post_author}</td>";
          echo "<td>{$post_title}</td>";

          $query = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
          $select_category_id_as_name_query = mysqli_query($connection, $query);
          while ($row = mysqli_fetch_assoc($select_category_id_as_name_query)) {
            $cat_title = $row['cat_title'];
            echo "<td>{$cat_title}</td>";
          }

          echo "<td>{$post_status}</td>";
          echo "<td><img width='100' src='../images/$post_image'></td>";
          echo "<td>{$post_tags}</td>";
          echo "<td>{$post_comment_count}</td>";
          echo "<td>{$post_date}</td>";
          echo "<td>{$post_views_count}</td>";
          echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
          echo "<td><a href='./posts.php?source=edit_post&edit_id={$post_id}'>Edit</a></td>";
          echo "<td><a onClick=\"javascript: return confirm('Do you want to delete?'); \" href='./posts.php?delete_id={$post_id}'>Delete</td>";
          echo "</tr>";

        }
      }

      ?>
    </tbody>
  </table>
</form>

<?php

if (isset($_GET['delete_id'])) {
  $delete_post_id = $_GET['delete_id'];
  $query = "DELETE FROM posts WHERE post_id={$delete_post_id}";
  $delete_post_query = mysqli_query($connection, $query);
  confirm_query($delete_post_id);
  header("Location: ./posts.php");
}

?>