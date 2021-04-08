<?php
    
    class User extends Db_object {
        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;
        public $user_image;
        public $upload_dir = "images";
        // http://placehold.it/400x400&text=image
        public $image_placeholder = "https://via.placeholder.com/150";

        public function save_user_image() {

            if($this->id) {
                // Update the user_image here
                if (!empty($this->errors)) {
                    return false;
                }

                if (empty($this->user_image) || empty($this->tmp_path)) {
                    $this->errors[] = "The file was not available";
                    return false;
                }

                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->user_image;

                if (file_exists($target_path)) {
                    $this->errors[] = "This file {$this->user_image} already exists";
                    return false;
                }

                if (move_uploaded_file($this->tmp_path, $target_path)) {
                    if ($this->update()) {
                        unset($this->tmp_path);
                        return true;
                    }
                }else {
                    $this->errors[] = "The file directory probably does not have permissions or it does not exist";
                    return false;
                }
            }else {
                // Insert the user_image here
                if (!empty($this->errors)) {
                    return false;
                }

                if (empty($this->user_image) || empty($this->tmp_path)) {
                    $this->errors[] = "The file was not available";
                    return false;
                }

                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->user_image;

                if (file_exists($target_path)) {
                    $this->errors[] = "This file {$this->user_image} already exists";
                    return false;
                }

                if (move_uploaded_file($this->tmp_path, $target_path)) {
                    if ($this->create()) {
                        unset($this->tmp_path);
                        return true;
                    }
                }else {
                    $this->errors[] = "The file directory probably does not have permissions or it does not exist";
                    return false;
                }
            }
        }

        public function user_image_placeholder(){
            return empty($this->user_image) ? $this->image_placeholder : $this->upload_dir.DS.$this->user_image ;
        }

        public static function verify_user($username, $password) {
            global $database;

            $username = $database->clean_input($username);
            $password = $database->clean_input($password);

            $sql = "SELECT * FROM " . self::$db_table . " WHERE username='{$username}' AND password='{$password}' LIMIT 1"; // might have a bug
            $result_array = self::find_by_query($sql);

            return !empty($result_array) ? array_shift($result_array) : false;
        }
        
    }
?>