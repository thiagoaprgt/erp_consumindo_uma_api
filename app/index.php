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


    if(isset($_GET["method"]) && !empty($_GET["method"])) {


        ob_start(); // gerenciador de output        

        $method = call_user_func( array( $erp, $_GET["method"] ) );

        echo $method;

        $output = ob_get_contents();

        ob_end_clean();


    }

    
    
    
    if(isset($_POST["method"]) && !empty($_POST["method"])) {

        
        ob_start(); // gerenciador de output    
        
        $method = $_POST["method"];

        array_shift($_POST);   

        $action = call_user_func_array( array( $erp, $method ), $_POST );


        echo $action;

        $output = ob_get_contents();

        ob_end_clean();        

    }

    

    $content .=  $output;

    $template = file_get_contents("templates/home.html");

    $template = str_replace("{{content}}", $content, $template);

    echo $template;



   

?>