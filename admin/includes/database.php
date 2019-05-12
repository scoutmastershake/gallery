<?php

    //DB Connection Include
    require_once("new_config.php");

    //Database Class
    class Database{

        //Set Props
        public $connection;
        
        //Construct Runs at Start
        function __construct(){
            $this->open_db_connection();
        }

        //Open DB Connection
        public function open_db_connection(){
            
            //$this->connection = mysqli_connect(Host,User,Pass,Db);

            $this->connection = new mysqli(Host,User,Pass,Db);

            if($this->connection->connect_errno){
                die("Database Connection Failed!" . $this->connection->connect_error);
            }

        }      

        //DB Query Method
        public function query($sql){

                //Execute Query
                //$result = mysqli_query($this->connection, $sql);                
                $result = $this->connection->query($sql);                
                
                //Confirm Query
                $this->confirm_query($result);

                //Reutrn Results
                return $result;
        }

        //Check Query
        private function confirm_query($result){
            //Check Results
            if(!$result){
                die("Query Failed:".$this->connection->error);
            }
        }

        //Escape Strings
        public function escape_string($string){
           $escape_string =  $this->connection->real_escape_string($string);
           return $escape_string;
        }

        //Insert Id
        public function the_insert_id(){
            return $this->connection->insert_id;
        }

    }

    //New DB Instance
    $database = new Database();

?>