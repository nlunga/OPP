<?php
    class Db_object {

        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');

        public $errors = array();
        public $upload_errors_array = array(
            UPLOAD_ERR_OK => "There is no error, the file uploaded with success.",
            UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
            UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder. Introduced in PHP 5.0.3.",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk. Introduced in PHP 5.1.0.",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
        );

        public function set_file($file) {

            if (empty($file) || !$file || !is_array($file)) {
                $this->errors[] = "There was no file uploaded here<br>";
                return false;
            }else if ($file['error'] != 0) {
                $this->errors[] = $this->upload_errors_array[$file['error']];
            }else {
                $this->user_image = basename($file['name']);
                $this->tmp_path = $file['tmp_name'];
                $this->type = $file['type'];
                $this->size = $file['size'];
            }
        }

        public static function find_all() {
            return self::find_by_query("SELECT * FROM " . static::$db_table . " ");
        }

        public static function find_by_id($id) {
            $result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id=$id LIMIT 1");

            /*
             *  The Code below grabs the first Item within the array and returns it
             */

            /*
            if (!empty($result_array)) {
                $first_item = array_shift($result_array);
                return $first_item;
            } else {
                return false;
            }
            */

            return !empty($result_array) ? array_shift($result_array) : false;
        }

        public static function find_by_query($sql) {
            global $database;
            $obj_array = array();

            if ($result_set = $database->query($sql)) {
                for ($index=0; $index < count($result_set); $index++) {
                    $obj_array[$index] = static::instantiate($result_set[$index]);
                }
            }

            return $obj_array;
        }

        private static function instantiate($result) {
            $calling_class = get_called_class();
            $selfObj = new $calling_class;

            foreach ($result as $key => $value) {
                if ($selfObj->has_the_attribute($key)) {
                    $selfObj->$key = $value;
                }
            }

            return $selfObj;
        }

        private function has_the_attribute ($key) {
            $object_properties = get_object_vars($this);

            return array_key_exists($key, $object_properties);
        }

        protected function properties() {

            $properties = array();
            foreach (static::$db_table_fields as $db_field) {
                if (property_exists($this, $db_field)) {
                    $properties[$db_field] = $this->$db_field;
                }
            }

            return $properties;
        }


        protected function clean_properties() {
            global $database;
            $clean_properties = array();

            foreach ($this->properties() as $key => $value) {
                $clean_properties[$key] = $database->clean_input($value);
            }
            return $clean_properties;
        }

        public function check_entry() {
            return (isset($this->id)) ? $this->update(): $this->create();
        }

        public function create() {
            global $database;
            // $session = new Session();
            $calling_class = get_called_class();
            $userObj = new $calling_class;
            $properties = $this->clean_properties();

            $sql = "INSERT INTO " . static::$db_table . " (" . implode(",",array_keys($properties)) .") VALUES (\"".implode("\",\"",array_values($properties))."\")";
            if ($database->query($sql)) {
                if (static::$db_table == 'photos'){
                    echo "Data has been added to the database";
                    return true;
                }else {
                    $this->id = $database->get_last_id();
                    // $session->user_id = $this->id = $database->get_last_id();
                    // $session->signed_in = true;
                    // redirect("index.php");
                    return true;
                }
            } else {
                echo "This is a test";
                return false;
            }
        }

        public function update() {
            global $database;
            $calling_class = get_called_class();
            $userObj = new $calling_class;
            $properties = $this->clean_properties();

            $property_pairs = array();

            foreach ($properties as $key => $value) {
                $property_pairs[] = "{$key}='{$value}'";
            }
            // $id = $database->clean_input($this->id);
            $sql = "UPDATE " . static::$db_table . " SET ".implode(",", $property_pairs)." WHERE id={$this->id}";
            return ($database->query($sql)) ? true: false;
        }
        
        public function delete($id) {
            global $database;
            $new_id = $database->clean_input($id);
            $sql = "DELETE FROM ". static::$db_table . " WHERE id={$new_id} LIMIT 1";
            return ($database->query($sql)) ? true: false;
        }
 
    }
?>