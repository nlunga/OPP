<?php
    
    class User extends Db_object {
        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;

        

        

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