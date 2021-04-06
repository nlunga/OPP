<?php
    class Session {
        private $signed_in = false;
        public $user_id;
        public $message;
        
        /*
         * The constructor function bellow starts a session when the
         * class is instantiated.
         */
        
        function __construct() {
            session_start();
            $this->check_login();
            $this->check_message();
        }

        /*
         * The method bellow checks if the session $user_id has been set
         */

        private function check_login() {
            
            if (isset($_SESSION['user_id'])) {
                $this->user_id = $_SESSION['user_id'];
                $this->signed_in = true;
            } else {
                unset($this->user_id);
                $this->signed_in = false;
            }
        }

        /*
         * The method bellow is a getter method which gets the value of $signed_in
         */

        public function get_signed_in() {
            return $this->signed_in;
        }
        
        public function login($user) {
            if ($user) {
                $this->user_id = $_SESSION['user_id'] = $user->id;
                $this->signed_in = true;
            }
        }

        public function message($msg="") {
            if (!empty($msg)) {
                $_SESSION['message'] = $msg;
            }else {
                return $this->message;
            }
        }

        public function check_message() {
            if (isset($_SESSION['message'])) {
                $this->message = $_SESSION['message'];
                unset($_SESSION['message']);
            } else {
                $this->message = "";
            }
        }

        public function logout() {
            unset($_SESSION['user_id']);
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    $session = new Session();
?>