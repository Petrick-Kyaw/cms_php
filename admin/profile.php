<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

  <!-- Navigation -->
  <?php include "includes/admin_navigation.php"; ?>
  <?php

  if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];

    $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";
    $select_user_profile_query = mysqli_query($connection, $query);
    confirm_query($select_user_profile_query);
    while ($row = mysqli_fetch_assoc($select_user_profile_query)) {
      $db_user_name = $row['user_name'];
      $db_user_password = $row['user_password'];
      $db_user_firstname = $row['user_firstname'];
      $db_user_lastname = $row['user_lastname'];
      $db_user_role = $row['user_role'];
      $db_user_email = $row['user_email'];
    }
  }

  if (isset($_POST['edit_profile'])) {
    $update_user_firstname = $_POST['user_firstname'];
    $update_user_lastname = $_POST['user_lastname'];
    $update_user_name = $_POST['user_name'];
    $update_user_password = $_POST['user_password'];
    $update_user_role = $_POST['user_role'];
    $update_user_email = $_POST['user_email'];

    $query = "UPDATE users SET user_name = '{$update_user_name}', ";
    $query .= "user_password = '{$update_user_password}', ";
    $query .= "user_firstname = '{$update_user_firstname}', ";
    $query .= "user_lastname = '{$update_user_lastname}', ";
    $query .= "user_role = '{$update_user_role}', ";
    $query .= "user_email = '{$update_user_email}' ";
    $query .= "WHERE user_name = '{$user_name}'";

    $update_profile_query = mysqli_query($connection, $query);
    confirm_query($update_profile_query);
    header("Location: profile.php");
  }

  ?>



  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome To Admin
            <small>Author</small>
          </h1>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="user_firstname">Firstname</label>
              <input value="<?php echo $db_user_firstname; ?>" type="text" name="user_firstname" id="user_firstname"
                class="form-control">
            </div>
            <div class="form-group">
              <label for="user_lastname">Lastname</label>
              <input value="<?php echo $db_user_lastname; ?>" type="text" name="user_lastname" id="user_lastname"
                class="form-control">
            </div>
            <div class="form-group">
              <label for="user_name">Username</label>
              <input value="<?php echo $db_user_name; ?>" type="text" id="user_name" name="user_name"
                class="form-control">
            </div>
            <div class="form-group">
              <label for="user_password">Password</label>
              <input value="<?php echo $db_user_password; ?>" type="text" id="user_password" name="user_password"
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
                  if ($db_user_role == $role_name) {
                    echo "<option selected value='{$role_name}'>{$role_show}</option>";
                  } else {
                    echo "<option value='{$role_name}'>{$role_show}</option>";
                  }

                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="user_email">Email</label>
              <input value="<?php echo $db_user_email; ?>" type="email" name="user_email" id="user_email"
                class="form-control">
            </div>
            <div class="form-group">
              <input type="submit" name="edit_profile" value="Update Profile" class="btn btn-primary">
            </div>
          </form>


        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/admin_footer.php"; ?>