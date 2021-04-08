<?php include("includes/header.php"); ?>
<?php
    if (!$session->get_signed_in()) {
        // The function redirect is inside functions.php
        redirect("login.php");
    }


    if (!isset($_GET['id'])) {
        redirect('users.php');
    }else {
        if (empty($_GET['id'])) {
            redirect('users.php');
        }else {
            $user = User::find_by_id($_GET['id']);
    
            if (isset($_POST['submit'])) {
                $user->username = $_POST['username'];
                $user->first_name = $_POST['first_name'];
                $user->last_name = $_POST['last_name'];
                if (!empty($_POST['password'])){
                    $user->password = $_POST['password'];
                }
                $user->set_file($_FILES['user_image']);
                $user->save_user_image();
                redirect('users.php');
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
                            Edit User <i class="fa fa-edit"></i>
                        </h1>

                        <div class="col-md-6">
                            <img class="img-responsive" src="<?php echo $user->user_image_placeholder();?>" alt="">
                        </div>

                        <form action="edit_user.php?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
                            

                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" name="user_image">
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" value="<?php echo (!empty($user->username)) ? $user->username : "";?>" placeholder="Username">
                                </div>

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo (!empty($user->first_name)) ? $user->first_name : "";?>" placeholder="First Name">
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo (!empty($user->last_name)) ? $user->last_name : "";?>" placeholder="Last Name">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" value="" placeholder="●●●●●●●●">
                                </div>

                                <div class="form-group">
                                    <a href="delete_user.php?id=<?php echo $user->id;?>" class="btn btn-danger">Delete</a>
                                    <input type="submit" name="submit" class="btn btn-primary pull-right" value="Update">
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