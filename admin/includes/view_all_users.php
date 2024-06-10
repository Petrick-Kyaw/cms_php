<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
    <?php

    $query = "SELECT * FROM users";
    $select_all_users_query = mysqli_query($connection, $query);
    if (!$select_all_users_query) {
      die("Query Failed..! " . mysqli_error($connection));
    } else {
      while ($row = mysqli_fetch_assoc($select_all_users_query)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";
        echo "<td><a href='./users.php?to_admin={$user_id}'>Admin</a></td>";
        echo "<td><a href='./users.php?to_subscriber={$user_id}'>Subscriber</a></td>";
        echo "<td><a href='./users.php?source=edit_user&edit_id={$user_id}'>Edit</a></td>";
        echo "<td><a href='./users.php?delete_id={$user_id}'>Delete</td>";
        echo "</tr>";

      }
    }

    ?>
  </tbody>
</table>
<?php

if (isset($_GET['delete_id'])) {
  $delete_user_id = $_GET['delete_id'];
  $query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
  $delete_user_query = mysqli_query($connection, $query);
  confirm_query($delete_user_query);
  header("Location: ./users.php");
}

if (isset($_GET['to_admin'])) {
  $to_admin_id = $_GET['to_admin'];
  $query = "UPDATE users SET user_role='admin' WHERE user_id = {$to_admin_id}";
  $set_admin_user_query = mysqli_query($connection, $query);
  confirm_query($set_admin_user_query);
  header("Location: ./users.php");
}

if (isset($_GET['to_subscriber'])) {
  $to_subscriber_id = $_GET['to_subscriber'];
  $query = "UPDATE users SET user_role='subscriber' WHERE user_id = {$to_subscriber_id}";
  $set_subscriber_user_query = mysqli_query($connection, $query);
  confirm_query($set_subscriber_user_query);
  header("Location: ./users.php");
}

?>