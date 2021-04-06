<?php include("includes/header.php"); ?>
<?php
    if (!$session->get_signed_in()) {
        // The function redirect is inside functions.php
        redirect("login.php");
    }
    $message = "";
    if (isset($_POST['submit'])) {
        $photo = new Photo();
        if (isset($_POST['title']) && !empty($_POST['title']) && isset($_FILES['file_upload'])) {
            $photo->title = trim($_POST['title']);
            $photo->set_file($_FILES['file_upload']);
            if ($photo->save_image_data()) {
                $message = "Photo uploaded Succesfully";
            }else {
                $message = join("<br>", $photo->errors);
            }
        }

    }
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include("includes/top_nav.php"); ?>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include("includes/side_nav.php"); ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Upload
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-upload"></i>  <a href="upload.php">Upload</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>
                <div class="col-md-6">
                    <?php echo $message?>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="file_upload" id="image">
                        </div>
                        <input type="submit" class="fourth form-control" name="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>