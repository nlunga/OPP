<?php include("includes/init.php"); ?>
<?php
    if (!$session->get_signed_in()) {
        // The function redirect is inside functions.php
        redirect("login.php");
    }
    if (isset($_GET['id']) && !empty($_GET['id'])){
        $user = new User();
        if ($user->delete($_GET['id'])) {
            echo "User deleted successfully";
            redirect("users.php");
        }else {
            redirect("users.php");
        }
    }else {
        redirect("users.php");
    }
?>
