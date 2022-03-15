<?php
    class Database {
        // DB parameters
        private $host = 'kutnpvrhom7lki7u.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        private $db_name = 'zk9mdu0w7i3xzp6a';
        private $username;
        private $password;
        private $conn;

        public function __construct() {
            $this->username = getenv('USER_NAME');
            $this->password = getenv('PASSWORD');
        }

        // DB connect
        public function connect() {
            $this->conn = null;

            try {
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
                $this->conn = new PDO($dsn, $this->username, $this->password);

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }
