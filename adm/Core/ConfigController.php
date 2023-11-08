<?php 
    require "./Core/Config.php";

    class ConfigController extends Config
    {
        private string $url;
        private array $urlArray;
        private string $urlController;
        private string $urlMetodo;
        private string $urlParameter;


        public function __construct()
        {
            if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){
                $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
                var_dump($this->url);
                $this->urlArray = explode("/", $this->url);
                var_dump($this->urlArray);

                if(isset($this->urlArray[0])){
                    $this->urlController = $this->urlArray[0];
                }else{
                    $this->urlController = "Login";
                }
                if(isset($this->urlArray[1])){
                    $this->urlMetodo = $this->urlArray[1];
                }else{
                    $this->urlMetodo = "index";
                }
                if(isset($this->urlArray[2])){
                    $this->urlParameter = $this->urlArray[2];
                }else{
                    $this->urlParameter = "";
                }
            }else{
                $this->urlController = "Login1";
                $this->urlMetodo = "index1";
                $this->urlParameter = "";
            }
            echo "Controller: {$this->urlController} <br> ";
            echo "Metodo: {$this->urlMetodo} <br>";
            echo "Parametro: {$this->urlParameter} <br>";
        }
    }

?>