<?php

if (isset($_GET['edit_id'])) {

  $edit_user_id = $_GET['edit_id'];
}
$query = "SELECT * FROM users WHERE user_id = {$edit_user_id}";
$select_user_by_id_query = mysqli_query($connection, $query);
confirm_query($select_user_by_id_query);
while ($row = mysqli_fetch_assoc($select_user_by_id_query)) {
  $user_name = $row['user_name'];
  $user_password = $row['user_password'];
  $user_firstname = $row['user_firstname'];
  $user_lastname = $row['user_lastname'];
  $user_image = $row['user_image'];
  $user_role = $row['user_role'];
  $user_email = $row['user_email'];
}



if (isset($_POST['edit_user'])) {
  $user_name = mysqli_real_escape_string($connection, $_POST['user_name']);

  $query = "SELECT randSalt FROM users LIMIT 1";
  $select_randsalt_query = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($select_randsalt_query);
  $salt = $row['randSalt'];

  $user_password = crypt(mysqli_real_escape_string($connection, $_POST['user_password']), $salt);
  $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
  $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
  $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);
  $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);

  // $image = $_FILES['image']['name'];
  // $image_temp = $_FILES['image']['tmp_name'];

  // move_uploaded_file($image_temp, "../images/$image");

  // if (empty($image)) {

  //   $query = "SELECT * FROM posts WHERE post_id = {$edit_post_id}";
  //   $select_image_query = mysqli_query($connection, $query);
  //   while ($row = mysqli_fetch_assoc($select_image_query)) {
  //     $image = $row['post_image'];
  //   }


  // }

  $query = "UPDATE users SET ";
  $query .= "user_name = '{$user_name}', ";
  $query .= "user_password = '{$user_password}', ";
  $query .= "user_firstname = '{$user_firstname}', ";
  $query .= "user_lastname = '{$user_lastname}', ";
  $query .= "user_role = '{$user_role}', ";
  $query .= "user_email = '{$user_email}' ";
  $query .= "WHERE user_id = {$edit_user_id}";
  $edit_user_by_id = mysqli_query($connection, $query);
  confirm_query($edit_user_by_id);
  header("Location: ./users.php");
}

?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input value="<?php echo $user_firstname; ?>" type="text" name="user_firstname" id="user_firstname"
      class="form-control">
  </div>
  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input value="<?php echo $user_lastname; ?>" type="text" name="user_lastname" id="user_lastname"
      class="form-control">
  </div>
  <div class="form-group">
    <label for="user_name">Username</label>
    <input value="<?php echo $user_name; ?>" type="text" id="user_name" name="user_name" class="form-control">
  </div>
  <div class="form-group">
    <label for="user_password">Password</label>
    <input value="<?php echo $user_password; ?>" type="password" id="user_password" name="user_password"
      class="form-control">
  </div>
  <div class="form-group">
    <select name="user_role" id="user_role">
      <?php

      $query = "SELECT * FROM roles";
      $select_role_query = mysqli_query($connection, $query);
      confirm_query($select_role_query);
      while ($row = mysqli_fetch_assoc($select_role_query)) {
        $role_id = $row['role_id'];
        $role_name = $row['role_name'];
        $role_show = $row['role_show'];
        if ($user_role == $role_name) {
          echo "<option selected value='{$role_name}'>{$role_show}</option>";
        } else {
          echo "<option value='{$role_name}'>{$role_show}</option>";
        }

      } ?>
    </select>
  </div>
  <div class="form-group">
    <label for="user_email">Email</label>
    <input value="<?php echo $user_email; ?>" type="email" name="user_email" id="user_email" class="form-control">
  </div>
  <div class="form-group">
    <input type="submit" name="edit_user" value="Update User" class="btn btn-primary">
  </div>
</form>