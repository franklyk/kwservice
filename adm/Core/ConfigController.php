<?php 
    // require "./Core/Config.php";

    namespace Core;

    class ConfigController extends Config
    {
        private string $url;
        private array $urlArray;
        private string $urlController;
        private string $urlMetodo;
        private string $urlParameter;
        private string $classLoad;
        private array $format;
        private string $urlSlugController;
        private string $urlSlugMetodo;



        public function __construct()
        {
            $this->configAdm();
            if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){
                $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
                var_dump($this->url);
                $this->clearUrl();
                $this->urlArray = explode("/", $this->url);
                var_dump($this->urlArray);

                if(isset($this->urlArray[0])){
                    $this->urlController = $this->slugController($this->urlArray[0]);
                }else{
                    $this->urlController =  $this->slugController(CONTROLLER);
                }
                if(isset($this->urlArray[1])){
                    $this->urlMetodo = $this->slugMetodo($this->urlArray[1]);
                }else{
                    $this->urlMetodo = $this->slugMetodo(METODO);
                }
                if(isset($this->urlArray[2])){
                    $this->urlParameter = $this->urlArray[2];
                }else{
                    $this->urlParameter = "";
                }
            }else{
                $this->urlController = $this->slugController(CONTROLLEERRO);
                $this->urlMetodo = $this->slugMetodo(METODO);
                $this->urlParameter = "";
            }
            echo "Controller: {$this->urlController} <br> ";
            echo "Metodo: {$this->urlMetodo} <br>";
            echo "Parametro: {$this->urlParameter} <br>";
        }

        private function clearUrl(): void
        {
            //Eliminar as tags
            $this->url = strip_tags($this->url);

            //Elimina espaços em branco
            $this->url = trim($this->url);

            //Elimina a barra no final da url
            $this->url = rtrim($this->url, "/"); 

            //Substitui Caracteres especiais
            $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
            $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
            $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);
        }

        public function slugController($slugController) :string
        {
            $this->urlSlugController = $slugController;
            //Converter para minúsculo
            $this->urlSlugController = strtolower($this->urlSlugController);
            //Converter o traço para espaço em branco
            $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
            //Converter a primeira letra de cada palavra para maiúscula
            $this->urlSlugController = ucwords($this->urlSlugController);
            //Retira o espaço em branco
            $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);

            var_dump($this->urlSlugController);
            return $this->urlSlugController;
        }

        private function slugMetodo($urlSlugMetodo):string
        {
            $this->$urlSlugMetodo = $this->slugController($urlSlugMetodo);
            //Converter para minúscula a primeira letra
            $this->$urlSlugMetodo = lcfirst($this->$urlSlugMetodo);
            var_dump($this->$urlSlugMetodo);
            return $this->$urlSlugMetodo;
        }

        public function loadPage(): void
        {
            echo "Carregar Página: {$this->urlController} <br>";

            echo "Carregar Página Corrigida: {$this->urlController} <br>";
            // $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
            // $classePage = new $this->classLoad();
            // $classePage-> {$this->urlMetodo}();

            // require "./app/adms/Controller/Login.php";
            // $login = new \App\adms\Controllers\Login();
            // $login->index();

            // require "./app/adms/Controller/Users.php";
            // $users = new \App\adms\Controllers\Users();
            // $users->index();
        }
    }

?>