<?php

    class Api {

        private $config;
        private $conn;
        private $parameters;
        private $method;

        public function __construct() {

            $this->config = parse_ini_file("../config/config.ini");

            extract($this->config);

            $this->conn = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_password);


            if(isset($_GET["method"])) {

                call_user_func( array( $this, $_GET["method"] ) );

            }else if(isset($_POST["method"])) {

                $this->method = $_POST["method"];

                
                
                call_user_func_array( array( $this, $this->method ), array( $_POST ) );

                

            }else {

                echo "Not Found";

            }

            $conn = null;

        }

        public function products() {
        
            if($_GET["method"] == "products") {
            

                $sql = "SELECT * FROM produtos";  

                $prepare = $this->conn->prepare($sql);
                $prepare->execute();

                $result = $prepare->fetchAll(PDO::FETCH_OBJ);

                $json = json_encode($result);    

                echo $json;   


            }

        }


        public function selectProducts($parameters) {
            
                        

            if($_POST["method"] == "selectProducts") {

                                
                extract($parameters);              
                

                $sql = "SELECT $column_names FROM produtos WHERE $searched_column $constraints $searched_column_value";  

                $prepare = $this->conn->prepare($sql);
                $prepare->execute();

                $result = $prepare->fetchAll(PDO::FETCH_OBJ);

                $json = json_encode($result);    

                echo $json; 

                


            }

        }


        public function save($parameters) {

            if($_POST["method"] == "save") {
                
            }

        }



    }




?>