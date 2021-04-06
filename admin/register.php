<?php include("includes/header.php"); ?>

<?php
    if ($session->get_signed_in()) {
        redirect("index.php");
    }
    $user = new User();

    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);

        $user->username = $username;
        $user->password = $password;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->create();
    } else {
        $username = "";
        $password = "";
        $first_name = "";
        $last_name = "";
        $message = "";
    }

?>


<div class="col-md-4 col-md-offset-3">

    <h4 class="bg-danger"><?php echo $message; ?></h4>
        
    <form id="register-id" action="" method="post">
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
            
        </div>

        <div class="form-group">
            <label for="first_name">Firstname</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo htmlentities($first_name); ?>" >

        </div>

        <div class="form-group">
            <label for="last_name">Lastname</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo htmlentities($last_name); ?>" >

        </div>



        <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">

        </div>


    </form>
    <p style="color:whitesmoke;">Already have an account? <a href="login.php">login</a></p>


</div>
<?php include("includes/footer.php"); ?>