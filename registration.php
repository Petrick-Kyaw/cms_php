<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php

if (isset($_POST['submit'])) {
    $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
    $user_name = mysqli_real_escape_string($connection, $_POST['user_name']);
    $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);



    $user_password = password_hash(mysqli_real_escape_string($connection, $_POST['user_password']), PASSWORD_BCRYPT, array('cost' => 12));

    if (empty($user_firstname) && empty($user_lastname) && empty($user_name) && empty($user_email) && empty($user_password)) {
        $message = "Fields cannot be empty";
        $class = "bg-danger";
    } else {
        $query = "INSERT INTO users(user_name, user_password, user_firstname, user_lastname,";
        $query .= "user_email,user_role) VALUES('$user_name','$user_password',";
        $query .= "'$user_firstname','$user_lastname','$user_email','subscriber')";
        $add_user_query = mysqli_query($connection, $query);
        confirm_query($add_user_query);
        $message = "Your registeration has been submitted";
        $class = "bg-success";
    }
} else {
    $message = "";
    $class = "bg-light";
}

?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h6 class="<?php echo $class; ?> text-center"><?php echo $message; ?></h6>
                            <div class="form-group">
                                <label for="user_firstname" class="sr-only">Firstname</label>
                                <input type="text" name="user_firstname" id="user_firstname" class="form-control"
                                    placeholder="Enter Firstname">
                            </div>
                            <div class="form-group">
                                <label for="user_lastname" class="sr-only">Lastname</label>
                                <input type="text" name="user_lastname" id="user_lastname" class="form-control"
                                    placeholder="Enter Lastname">
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="sr-only">username</label>
                                <input type="text" name="user_name" id="user_name" class="form-control"
                                    placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="user_email" class="form-control"
                                    placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="user_password" class="sr-only">Password</label>
                                <input type="password" name="user_password" id="user_password" class="form-control"
                                    placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>