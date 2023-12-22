<?php 

    namespace Core;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    


    /**
     * Recebe a URL e manipula
     * Carrega a CONTROLLER
     * @author FRANKLIN(" KLYK ") <frsbatist@gmail.com>
     * 
     * Segue o link para a PSR-4
     * @link https://www.php-fig.org/psr/
     * @link https://github.com/php-fig/fig/standart/blob/master/proposed/phpdoc.md
     * @link https://github.com/php-fig/fig/standart/blob/master/proposed/phpdoc-tags.md
     */
    class ConfigController extends Config
    {
        /** @var string $url recebe a URL através do .htaccess */
        private string $url;
        /** @var array $urlArray Recebe a URL convertida para array */
        private array $urlArray;
        /** @var string $urlController Recebe a URL e o nome da controller */
        private string $urlController;
        /** @var string $urlMetodo Recebe a URL e o nome do método */
        private string $urlMetodo;
        /** @var string $urlParameter Recebe da URL o parâmetro */
        private string $urlParameter;
        /** @var string $classLoad Controller que deve ser carregada  */
        private string $classLoad;
        /** @var array $format Recebe o array de caracteres especias que deve ser subistitudo */
        private array $format;
        /** @var string $urlSlugController Recebe o controller tratado */
        public string $urlSlugController;
        /** @var string $urlSlugMetodo Recebe o método tratado */
        public string $urlSlugMetodo;


        
        /**
         * Recebe a URL do .htaccess
         * Validar a URL
         */
        public function __construct()
        {
            $this->configAdm();
            if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){
                $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
                // var_dump($this->url);
                $this->clearUrl();
                $this->urlArray = explode("/", $this->url);
                // var_dump($this->urlArray);
                //Verificar a URL Digitada pelo usuario, se for nullo valerá o padrão
                if(isset($this->urlArray[0])){
                    $this->urlController = $this->slugController($this->urlArray[0]);
                }else{
                    $this->urlController =  CONTROLLER;
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
                $this->urlController = $this->slugController(CONTROLLERERRO);
                $this->urlMetodo = $this->slugMetodo(METODO);
                $this->urlParameter = "";
            }

        }

        /**
         * Método privado, NÃO pode ser instanciado fora da classe
         * Limpa a URL, eliminando as tags, retirando os espaços em branco, retia a barra no final da URL e retira os caracteres especiais
         *
         * @return void
         */
        private function clearUrl(): void
        {
            //Eliminar as tags
            $this->url = strip_tags($this->url);

            //Elimina espaços em branco
            $this->url = trim($this->url);

            //Elimina a barra no final da url
            $this->url = rtrim($this->url, "/"); 

            // //Substitui Caracteres especiais
            $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
            $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
            
            $this->url = strtr((utf8_decode($this->url)), utf8_decode($this->format['a']), $this->format['b']);
           
            
        }

        /**
         * Converter o valor obitido da URL "view-users" e converter no formato da classe "ViewUsers".
         * Utilizado as funções para converter tudo em minusculo, Converter o traço pelo espaço,Converter a primeira letra de cada palavra para minúscula, retirar os espaços em branco
         *
         * @param [string] $slugController Nome da classe
         * @return string Retorna a controller "view-users" convertido para o nome da classe "ViewUsers"
         */
        public function slugController(string $slugController) :string
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

            // var_dump($this->urlSlugController);
            return $this->urlSlugController;
        }

        /**
         * Tratar o método
         * Instanciar o método que trata a controller
         * Converter a primeira letra para minúscula
         *
         * @param [string] $urlSlugMetodo
         * @return string
         */
        private function slugMetodo(string $urlSlugMetodo):string
        {
            $this->$urlSlugMetodo = $this->slugController($urlSlugMetodo);
            //Converter para minúscula a primeira letra
            $this->$urlSlugMetodo = lcfirst($this->$urlSlugMetodo);
            // var_dump($this->$urlSlugMetodo);
            return $this->$urlSlugMetodo;
        }

        /**
         * Carregar as Controllers
         * Instanciar as classes da Controller e carregar o método
         *
         * @return void
         */
        public function loadPage(): void
        {

            $loadPgAdm = new \Core\CarregarPgAdm();
            $loadPgAdm->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);
        }
    }

?>