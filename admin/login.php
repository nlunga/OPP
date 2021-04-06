<?php include("includes/header.php"); ?>

<?php
    if ($session->get_signed_in()) {
        redirect("index.php");
    }
    
    $user = new User();
    if (isset($_POST['submit'])) {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        $user_found = User::verify_user($username, $password);
        
        if ($user_found) {
            $session->login($user_found);
            $_SESSION['name'] = $user_found->first_name . " " . $user_found->last_name;

            redirect("index.php");
        } else {
            $message =  "Your credentials are invalid";
        }
    } else {
        $username = "";
        $password = "";
        $message = "";
    }

?>


<div class="col-md-4 col-md-offset-3">

    <h4 class="bg-danger"><?php echo $message; ?></h4>
        
    <form id="login-id" action="" method="post">
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
            
        </div>


        <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">

        </div>


    </form>
    <p style="color:whitesmoke;">Don't have an account? <a href="register.php">register</a></p>

</div>
<?php include("includes/footer.php"); ?>