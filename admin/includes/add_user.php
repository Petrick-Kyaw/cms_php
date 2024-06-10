<?php

if (isset($_POST['add_user'])) {
  $user_name = $_POST['user_name'];
  $user_password = $_POST['user_password'];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];

  // $image = $_FILES['image']['name'];
  // $image_temp = $_FILES['image']['tmp_name'];

  $user_role = $_POST['user_role'];




  //move_uploaded_file($image_temp, "../images/$image");

  $query = "INSERT INTO users (user_name,user_password,user_firstname,user_lastname,user_email,user_role) ";
  $query .= "VALUES('{$user_name}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}')";
  $add_user_query = mysqli_query($connection, $query);
  confirm_query($add_user_query);

}

?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" name="user_firstname" id="user_firstname" class="form-control">
  </div>
  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" name="user_lastname" id="user_lastname" class="form-control">
  </div>
  <div class="form-group">
    <label for="user_name">Username</label>
    <input type="text" id="user_name" name="user_name" class="form-control">
  </div>
  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="text" id="user_password" name="user_password" class="form-control">
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

        ?>
        <option value="<?php echo $role_name; ?>"><?php echo $role_show; ?></option>
        <?php
      } ?>
    </select>
  </div>
  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" name="user_email" id="user_email" class="form-control">
  </div>
  <!-- <div class="form-group">
    <label for="image">Image</label>
    <input type="file" id="image" name="image">
  </div> -->
  <div class="form-group">
    <input type="submit" name="add_user" value="Create User" class="btn btn-primary">
  </div>
</form>