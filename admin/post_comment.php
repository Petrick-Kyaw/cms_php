<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Status</th>
      <th>In Response To</th>
      <th>Date</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (isset($_GET['c_id'])) {
      $c_id = $_GET['c_id'];
    }
    $query = "SELECT * FROM comments WHERE comment_post_id=$c_id";
    $select_all_comments_query = mysqli_query($connection, $query);
    if (!$select_all_comments_query) {
      die("Query Failed..! " . mysqli_error($connection));
    } else {
      while ($row = mysqli_fetch_assoc($select_all_comments_query)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_status}</td>";

        $query = "SELECT * FROM posts WHERE post_id={$comment_post_id}";
        $select_post_as_post_title_query = mysqli_query($connection, $query);
        confirm_query($select_post_as_post_title_query);
        while ($row = mysqli_fetch_assoc($select_post_as_post_title_query)) {
          $post_id = $row['post_id'];
          $post_title = $row['post_title'];
          echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
        }

        echo "<td>{$comment_date}</td>";
        echo "<td><a href='./comments.php?approve_id={$comment_id}'>Approve</td>";
        echo "<td><a href='./comments.php?unapprove_id={$comment_id}'>Unapprove</a></td>";
        echo "<td><a href='./comments.php?delete_id={$comment_id}'>Delete</td>";
        echo "</tr>";

      }
    }

    ?>
  </tbody>
</table>
<?php

if (isset($_GET['delete_id'])) {
  $delete_comment_id = $_GET['delete_id'];
  $query = "DELETE FROM comments WHERE comment_id={$delete_comment_id}";
  $delete_comment_query = mysqli_query($connection, $query);
  confirm_query($delete_comment_query);
  header("Location: ./comments.php");
}

if (isset($_GET['approve_id'])) {
  $comment_approve_id = $_GET['approve_id'];
  $query = "UPDATE comments SET comment_status = 'approved' ";
  $query .= "WHERE comment_id = {$comment_approve_id}";
  $approve_comment_query = mysqli_query($connection, $query);
  confirm_query($approve_comment_query);
  header("Location: ./comments.php");
}

if (isset($_GET['unapprove_id'])) {
  $comment_unapprove_id = $_GET['unapprove_id'];
  $query = "UPDATE comments SET comment_status = 'unapproved' ";
  $query .= "WHERE comment_id = {$comment_unapprove_id}";
  $unapprove_comment_query = mysqli_query($connection, $query);
  confirm_query($unapprove_comment_query);
  header("Location: ./comments.php");
}

?>