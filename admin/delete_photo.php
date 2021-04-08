<?php include("includes/init.php"); ?>
<?php
    if (!$session->get_signed_in()) {
        // The function redirect is inside functions.php
        redirect("login.php");
    }
    if (isset($_GET['id']) && !empty($_GET['id'])){
        $photo = new Photo();
        $tmp_photo = $photo->find_by_id($_GET['id']);
        if ($tmp_photo->delete_photo($_GET['id'])) {
            redirect("photos.php");
        }else {
            redirect("photos.php");
        }
    }else {
        redirect("photos.php");
    }
?>
