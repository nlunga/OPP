<?php
    class Photo extends Db_object {
        protected static $db_table = "photos";
        protected static $db_table_fields = array('title', 'description', 'filename', 'type', 'size');
        public $id;
        public $title;
        public $description;
        public $filename;
        public $type;
        public $size;

        public $tmp_path;
        public $upload_dir = "images";
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

        // This is passing $_FILES['uploaded_file'] as an argument

        public function set_file($file) {

            if (empty($file) || !$file || !is_array($file)) {
                $this->errors[] = "There was no file uploaded here<br>";
                return false;
            }else if ($file['error'] != 0) {
                $this->errors[] = $this->upload_errors_array[$file['error']];
            }else {
                $this->filename = basename($file['name']);
                echo $this->filename;
                $this->tmp_path = $file['tmp_name'];
                $this->type = $file['type'];
                $this->size = $file['size'];
            }
        }

        public function picture_path() {
            return $this->upload_dir.DS.$this->filename;
        }

        public function save_image_data() {

            if($this->id) {
                $this->update();
            }else {
                if (!empty($this->errors)) {
                    return false;
                }

                if (empty($this->filename) || empty($this->tmp_path)) {
                    $this->errors[] = "The file was not available";
                    return false;
                }

                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->filename;

                if (file_exists($target_path)) {
                    $this->errors[] = "This file {$this->filename} already exists";
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

        public function get_data() {
            echo $this->title . "<br>";
            echo $this->description . "<br>";
            echo $this->filename . "<br>";
            echo $this->type . "<br>";
            echo $this->size . "<br>";
        }
    }
?>