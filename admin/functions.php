<?php

function add_category()
{
  global $connection;
  if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    if ($cat_title == "" || empty($cat_title)) {
      echo "This field cannot be empty..!";
    } else {
      $query = "INSERT INTO categories (cat_title) ";
      $query .= "VALUES('{$cat_title}')";
      $create_category_query = mysqli_query($connection, $query);
      if (!$create_category_query) {
        die("Query Failed..!" . mysqli_error($connection));
      }
    }
  }
}

function show_all_categories()
{
  // Show categories query
  global $connection;
  $query = "SELECT * FROM categories";
  $select_all_categories_query = mysqli_query($connection, $query);
  if (!$select_all_categories_query) {
    die("Connection error" . mysqli_error($connection));
  } else {
    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
      $cat_id = $row['cat_id'];
      $cat_title = $row['cat_title'];
      echo "<tr>";
      echo "<td>{$cat_id}</td>";
      echo "<td>{$cat_title}</td>";
      echo "<td><a href='categories.php?delete_id={$cat_id}'>Delete</a></td>";
      echo "<td><a href='categories.php?edit_id={$cat_id}'>Edit</a></td>";
      echo "</tr>";
    }
  }
}

function delete_category()
{
  //Delete category query
  global $connection;
  if (isset($_GET['delete_id'])) {
    $delete_cat_id = $_GET['delete_id'];
    $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";
    $delete_category_query = mysqli_query($connection, $query);
    if (!$delete_category_query) {
      die("Query Failed..! " . mysqli_error($connection));
    } else {
      header("Location: categories.php");
    }
  }
}



?>