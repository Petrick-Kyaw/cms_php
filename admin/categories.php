<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

  <!-- Navigation -->
  <?php include "includes/admin_navigation.php"; ?>

  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome To Admin
            <small>Author</small>
          </h1>

          <div class="col-xs-6">

            <?php add_category(); ?>

            <form action="" method="post">
              <div class="form-group">
                <label for="cat_title">Category</label>
                <input id="cat_title" class="form-control" type="text" name="cat_title" required>
              </div>
              <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
              </div>
            </form>

            <?php
            if (isset($_GET['edit_id'])) {
              $update_cat_id = $_GET['edit_id'];
              include "includes/update_category.php";
            }
            ?>

          </div>

          <div class="col-xs-6">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Category Title</th>
                </tr>
              </thead>
              <tbody>

                <?php show_all_categories(); ?>

                <?php delete_category(); ?>

              </tbody>
            </table>
          </div>

        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/admin_footer.php"; ?>