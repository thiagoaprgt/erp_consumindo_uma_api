<?php

    class Autoload {

        private $directories;

        public function setDirectories(string $directory) {

            $this->directories[] = $directory;


        }        

        public function register() {

            
            spl_autoload_register(

                function() {

                    foreach($this->directories as $dir) {

                        if(is_dir($dir) == true) {

                            // a função scandir escaneia o diretório e retorna um  array com os nomes dos arquivos encontrados.

                            $files = scandir($dir);
                            
    
                            foreach($files as $file) {

                                // a função str_ends_with retorna true se a string terminar com o mesmo valor do segundo parâmetro.

                                $phpFile = str_ends_with($file, ".php");
    
                                if($file != "Autoload.php" && $phpFile == true) {
    
                                    require_once $dir . "/" . $file;
                                }
    
                            }
                            
                        }


                    }

                    

                }

            );

        }

    }

?>