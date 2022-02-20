<?php

namespace controllers;

use library\Http;

class Erp {

    public $url;
    protected $token;
    protected $password;
    protected $header;

    public function __construct() {
        

        $config = parse_ini_file("config/config.ini");

        $this->url = $config["url_api"];
        $this->token = "Bearer " . $config["token"];
        $this->password = $config["password"];

        $this->header = [

            "access_token" => $this->token,
            "password" => $this->password

        ];
        
    }


    public function table(array $object) {

        // tabela

        $table = file_get_contents("templates/table/table.html");
        $th = file_get_contents("templates/table/th.html");        
        $tr =  file_get_contents("templates/table/tr.html");
        $td = file_get_contents("templates/table/td.html");

        $rowData = "";
        $row = "";

        //  get_object_vars retorna um array com os atributos do objeto 

        $table_columns = get_object_vars($object[0]);

        // array_keys retorna um array com os chaves do arrays

        $table_columns = array_keys($table_columns);
        

        $thData = "";

        foreach($table_columns as $column) {

            $thData .= str_replace("{{thData}}", $column, $th);

        }

        $table = str_replace("{{th}}", $thData, $table);

        foreach($object as $key => $values) {
           
            foreach($values as $value) {
                
                $rowData .= str_replace("{{tdData}}", $value, $td);
            }

            $row .= str_replace("{{trData}}", $rowData, $tr);    
            
            $rowData = "";

        }


        $table = str_replace("{{tr}}", $row, $table);

        return $table;

    } 

    public function listAllProducts() {        

        

        $endpoint = "";        

        $url = $this->url . $endpoint;        

        $data = [ "method" => "products" ];

        $api = new Http();

        $get = $api->http_get_Request($url, $data, $this->header);

        $object = json_decode($get);
        

        $table = $this->table($object);
        
       
        return $table;  

    }

   

    public function selectProducts($column_names, $searched_column, $constraints, $searched_column_value) {
             

        $url = $this->url;    
        

        $data = [ 
            
            "method" => "selectProducts",
            "column_names" => $column_names,
            "searched_column" => $searched_column,
            "constraints" => $constraints,
            "searched_column_value" => $searched_column_value 
        ];

        $api = new Http();

        $post = $api->http_post_Request($url, $data, $this->header);

        $object = json_decode($post);

        

        $table = $this->table($object);

        return $table;        

        
    }


    public function save($id) {
        
    }


}


?>