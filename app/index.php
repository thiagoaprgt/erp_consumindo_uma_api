<?php

    require_once "library/Autoload.php";

    use controllers\Erp;

    $al = new Autoload();

    $al->setDirectories("library");
    $al->setDirectories("controllers");

    $al->register();

    $erp = new Erp();

    $content = "";
    $output = "";

    

    $content = file_get_contents("templates/section/listarProdutos.html");

    $template = file_get_contents("templates/home.html");

    $template = str_replace("{{content}}", $content, $template);

    
    ob_start(); // gerenciador de output   


    if(isset($_GET["method"]) && !empty($_GET["method"]) && count($_GET) > 1) {



        $method = $_GET["method"];

        array_shift($_GET);         
        
        

        $action = call_user_func_array( array( $erp, $method), $_GET );

        echo $action;

        $output = ob_get_contents();

        


    }else if(isset($_GET["method"]) && !empty($_GET["method"])) {

        $action = call_user_func( array( $erp, $_GET["method"] ) );

        echo $action;

        $output = ob_get_contents();

    }

    
    
    
    if(isset($_POST["method"]) && !empty($_POST["method"]) && count($_POST) > 1 ) {

        
        $method = $_POST["method"];      

        array_shift($_POST);   

        $action = call_user_func_array( array( $erp, $method ), $_POST );


        echo $action;

        $output = ob_get_contents();

        
    }else if(isset($_POST["method"]) && !empty($_POST["method"])) {

        $action = call_user_func( array( $erp, $_POST["method"] ));

        echo $action;

        $output = ob_get_contents();

    }


    ob_end_clean(); 

    

    $content .=  $output;

    $template = file_get_contents("templates/home.html");

    $template = str_replace("{{content}}", $content, $template);

    echo $template;



   

?>