<?php include("includes/init.php"); ?>
<?php
    if (!$session->get_signed_in()) {
        // The function redirect is inside functions.php
        redirect("login.php");
    }
    if (isset($_GET['id']) && !empty($_GET['id'])){
        $photo = new Photo();
        if ($photo->delete($_GET['id'])) {
            echo "Image deleted successfully";
        }else {
            redirect("photos.php");
        }
    }else {
        redirect("photos.php");
    }
?>
