<?php include("includes/header.php"); ?>
<?php
    if (!$session->get_signed_in()) {
        // The function redirect is inside functions.php
        redirect("login.php");
    }

    if (!isset($_GET['id'])) {
        redirect('photos.php');
    }else {
        if (empty($_GET['id'])) {
            redirect('photos.php');
        }else {
            $photos = Photo::find_by_id($_GET['id']);
    
            if (isset($_POST['update'])) {
                $photos->title = $_POST['title'];
                $photos->caption = $_POST['caption'];
                $photos->alternate_text = $_POST['alternate_text'];
                $photos->description = $_POST['description'];
                $photos->save_image_data();
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
                            Photos
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-picture-o"></i>  <a href="photos.php">Photos</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>

                        <form action="edit_photo.php?id=<?php echo $_GET['id'];?>" method="post">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="title" id="title" class="form-control" value="<?php echo (!empty($photos->title)) ? $photos->title : "";?>">
                                </div>

                                <div class="form-group">
                                    <a class="thumbnail" href=""><img src="<?php echo $photos->picture_path();?>" class="editProfileImage" alt=""></a>
                                </div>

                                <div class="form-group">
                                    <label for="caption">Caption</label>
                                    <input type="text" name="caption" id="caption" class="form-control" value="<?php echo (!empty($photos->caption)) ? $photos->caption : "";?>" placeholder="Caption">
                                </div>

                                <div class="form-group">
                                    <label for="alternate_text">Alternate Text</label>
                                    <input type="text" name="alternate_text" id="alternate_text" class="form-control" value="<?php echo (!empty($photos->alternate_text)) ? $photos->alternate_text : "";?>" placeholder="Alternate Text">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <!-- <input type="text" name="description" id="description" class="form-control"> -->
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"><?php echo (!empty($photos->description)) ? $photos->description : "";?></textarea>
                                </div>
                            </div>

                            <div class="col-md-4" >
                                <div  class="photo-info-box">
                                    <div class="info-box-header">
                                    <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                    </div>
                                <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                    <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                    </p>
                                    <p class="text ">
                                        Photo Id: <span class="data photo_id_box"><?php echo $photos->id; ?></span>
                                    </p>
                                    <p class="text">
                                        Filename: <span class="data"><?php echo $photos->filename; ?></span>
                                    </p>
                                    <p class="text">
                                    File Type: <span class="data"><?php echo $photos->type; ?></span>
                                    </p>
                                    <p class="text">
                                    File Size: <span class="data"><?php echo $photos->size; ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a  href="delete_photo.php?id=<?php echo $photos->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                    </div>   
                                </div>
                                </div>          
                            </div>
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