<?php 

    namespace Core;

    /**
     * Verificar se existe a classe
     * Carrega a CONTROLLER
     * @author FRANKLIN(" KLYK ") <frsbatist@gmail.com>
     * 
     */
    
    class CarregarPgAdm
    {
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlMetodo Recebe da URL o nome do método */
    private string $urlMetodo;
    /** @var string $urlParamentro Recebe da URL o parâmetro */
    private string $urlParameter;
    /** @var string $classLoad Controller que deve ser carregada */
    private string $classLoad;
    /** @var string $urlSlugController Recebe o controller tratado */
    public string $urlSlugController;
    /** @var string $urlSlugMetodo Recebe o método tratado */
    public string $urlSlugMetodo;
    /** @var array $listPgPublic Carrega um array com as páginas que são publicas*/
    private array $listPgPublic;
    /** @var array $listPgPublic Carrega um array com as páginas que são privadas*/
    private array $listPgPrivate;



       /**
     * Verificar se existe a classe
     * @param string $urlController Recebe da URL o nome da controller
     * @param string $urlMetodo Recebe da URL o método
     * @param string $urlParamentro Recebe da URL o parâmetro
     */


        public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParameter):void
        {
            $this->urlController = $urlController;
            $this->urlMetodo = $urlMetodo;
            $this->urlParameter = $urlParameter;

            unset($_SESSION['id']);
            
            $this->pgPublic();
            if(class_exists($this->classLoad)){
                $this->loadMetodo();
            }else{
                //Encerra o precesso e emite a mensagem de erro
                die("Erro: 003 - Por Favor tente novamente! Se o problema persistir, entre em contato com o administrador em " . EMAILADM);

                //Cria uma pagina padrao para o caso de pagina nao encontrada
                /*
                $this->urlController = $this->slugController(CONTROLLER);
                $this->urlMetodo = $this->slugMetodo(METODO);
                $this->urlParameter = "";
                $this->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);
                */
            }

        }

        /**
         * Verificar se existe o método e carregar a página
         *
         * @return void
         */
        private function loadMetodo():void
        {
            $classLoad = new $this->classLoad();
            if(method_exists($classLoad, $this->urlMetodo)){
                $classLoad->{$this->urlMetodo}();
            }else{
                die("Erro: 004 - Por Favor tente novamente! Se o problema persistir, entre em contato com o administrador em " . EMAILADM); 
            }
        }

        private function pgPublic():void
        {

            $this->listPgPublic = ["Login", "Erro", "Logout", "NewUser", "ConfEmail", "NewConfEmail", "RecoverPassword", "UpdatePassword"];

            if(in_array($this->urlController, $this->listPgPublic)){
                $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
            }else{
                $this->pgPrivate();
            }
        }

        private function pgPrivate():void
        {
            $this->listPgPrivate = ["Dashboard", "ListUsers", "ViewUsers"];

            if(in_array($this->urlController, $this->listPgPrivate)){
                $this->verifyLogin();
            }else{
                $_SESSION['msg'] = "<p style='color:#f00;'>Página não encontrada!</p><br>";

                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }
        }

        private function verifyLogin() :void
        {
            if((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name']) and (isset($_SESSION['user_email'])))){
                $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
            }else{
                $_SESSION['msg'] = "<p style='color:#f00;'>Necessário realizar o login para acessar esta página!</p><br>";

                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }
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

    }

?>