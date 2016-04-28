<?php

    class DB{
        private $dbhost = 'localhost';
        private $dbname = 'slimblog';
        private $dbuser = 'root';
        private $dbpass = '';

        //Connects to db
        public function connect(){
            $mysql_conn_string = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO($mysql_conn_string, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            return $dbConnection;
        }
    }