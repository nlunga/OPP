<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>
            <?php
                // $user = new User();
                $photo = new Photo();

                // $user->username = "jayDog";
                // $user->password = "hjbd34$%";
                // $user->first_name = "Jack";
                // $user->last_name = "Ryan";
                
                // $user->check_entry();

                // $photo->title = "The Daily Show";
                // $photo->description = "The Daily Show is an Emmy and Peabody Award-winning program that looks at the day's top headlines through a sharp, reality-based lens. Along with the help ...";
                // $photo->filename = "trevor.png";
                // $photo->type = "image";
                // $photo->size = 29;

                $photo->title = "This is a test";
                $photo->description = "This is a test Description";
                $photo->filename = "test.jpg";
                $photo->type = "image/jpg";
                $photo->size = 29;
                // echo DS . '<br>';
                // echo SITE_ROOT . '<br>';
                // echo INCLUDES_PATH;

                // $photo->delete(38);
                // $photo->get_data();
                // $photo->check_entry();
                // for ($index=34; $index < 38 ; $index++) {
                //     $photo->delete($index);
                // }
                // $photo->insertData();

                // $photo->create();

                // $user_info = $user->get_user_by_id(23);
                // $user->delete(22);
                
                // $user_info = $user->find_all();
                // $photos = $photo->find_all();

                // foreach ($user_info as $pic) {
                //     echo $pic->title . "<br>";
                // }
                // $user_info = $user->find_by_id(5);

                // $user_info->username = "WHATEVER";

                // $user_info->check_entry();
                // print_r($user->properties());

                // $user_info->username = "admin";
                // $user_info->password = "admin";
                // $user_info->first_name = "Admin";
                // $user_info->last_name = "Nistrator";
                // $user_info->check_entry();

            ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div> 