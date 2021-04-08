<?php
    require_once("config.php");
    class Database{
        public $connection;

        function __construct() {
            $this->open_db_connection();
        }

        public function open_db_connection() {
            $host = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            // echo $host;
        
            try {
                $this->connection = new PDO($host, DB_USER, DB_PASSWORD);
        
                // set the PDO error mode to exception
                $this->connection->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::CASE_NATURAL);
                // echo "Connected successfully";
            } catch (PDOException $err) {
                echo "Connection failed: " . $err->getMessage();
            }
        }

        public function query($sql) {
            // try {
            //     $this->connection->exec($sql);
            // } catch (PDOException $e) {
            //     die("Something went wrong");
            // }
            try {
                /*
                $delete_pattern = "/delete/i";
                if (preg_match($delete_pattern, $sql)) {
                    $this->connection->exec($sql);
                    echo "Record deleted successfully";
                    return true;
                }else {
                    $result = $this->connection->prepare($sql);
                    $result->execute();
                    $check = $result->fetchAll(PDO::FETCH_ASSOC);
                    if ($check) {
                        return $check;
                    }else {
                        return true;
                    }
                }
                */
                $result = $this->connection->prepare($sql);
                $result->execute();
                $check = $result->fetchAll(PDO::FETCH_ASSOC);
                $delete_pattern = "/DELETE/i";
                $update_pattern = "/UPDATE/i";
                $insert_pattern = "/INSERT/i";
                
                if ($check) {
                    return $check;
                }else {
                    if (count($check) === 0 && !preg_match($delete_pattern, $sql) && !preg_match($update_pattern, $sql) && !preg_match($insert_pattern, $sql)) {
                        return false;
                    }else {
                        return true;
                    }
                }
            } catch (PDOException $err) {
                die("Something went wrong" . $err);
            }
        }

        public function clean_input($input) {
            $new_input = htmlspecialchars((strip_tags(trim($input))));
            return $new_input;
        }

        public function get_last_id() {
            return $this->connection->lastInsertId();
        }
    }

    $database = new Database();

?>