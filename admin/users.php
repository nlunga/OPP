<?php include("includes/header.php"); ?>
<?php
    if (!$session->get_signed_in()) {
        // The function redirect is inside functions.php
        redirect("login.php");
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
                            Users
                        </h1>
                        <a href="add_user.php" class="btn btn-primary">Add User</a>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-users"></i>  <a href="users.php">Users</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Photo</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $users = new User();
                                    $user_result = $users->find_all();
                                    

                                    foreach ($user_result as $value) {
                                        # code...
                                        echo "<tr>";
                                        echo    "<td>" . $value->id . "</td>";
                                        echo    "<td><img src='". $value->user_image_placeholder() ."' class='profileImage'>" ."</td>";
                                        echo    "<td>" . $value->username;
                                        echo        "<div class='pictures_link'>";
                                        echo            "<a href='delete_user.php?id=" . $value->id . "'>Delete</a>";
                                        echo            "<a href='edit_user.php?id=" . $value->id ."'>Edit</a>";
                                        echo            "<a href='#'>View</a>";
                                        echo        "</div>";
                                        echo    "</td>";
                                        echo    "<td>" . $value->first_name . "</td>";
                                        echo    "<td>" . $value->last_name . "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>