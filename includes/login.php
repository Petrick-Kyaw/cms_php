<?php include "db.php"; ?>
<?php

if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);

  $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
  $query .= "AND user_password = '{password}'";
  $select_user_query = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_array($select_user_query)) {
    echo mysqli_num_rows($select_user_query);
  }
}

?>