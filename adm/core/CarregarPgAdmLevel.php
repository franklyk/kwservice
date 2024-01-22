<?php 

    namespace Core;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Verificar se existe a classe
     * Carrega a CONTROLLER
     * @author FRANKLIN(" KLYK ") <frsbatist@gmail.com>
     * 
     */
    
    class CarregarPgAdmLevel
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

    /** @var array|null $resultPage Carrega um array com as páginas*/
    private array|null $resultPage;

    /** @var array|null $resultLevelPage Recebe os dados da permissão de acesso*/
    private array|null $resultLevelPage;



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

            // var_dump($this->urlController);

            $this->searchPage();

        }

        private function searchPage(): void
        {
            $serachPage = new \App\adms\Models\helper\AdmsRead();
            $serachPage->fullRead("SELECT pgs.id, pgs.publish,
                                    typ.type
                                    FROM adms_pages AS pgs
                                    INNER JOIN adms_type_pgs AS typ ON typ.id=pgs.adms_types_pgs_id
                                    WHERE pgs.controller =:controller
                                    AND pgs.metodo =:metodo
                                    LIMIT :limit", 
                                    "controller={$this->urlController}&metodo={$this->urlMetodo}&limit=1
                                    ");
            $this->resultPage = $serachPage->getResult();
            if($this->resultPage){
                // var_dump($this->resultPage);
                if($this->resultPage[0]['publish'] == 1){
                    $this->classLoad = "\\App\\".$this->resultPage[0]['type']."\\Controllers\\" . $this->urlController;
                    $this->loadMetodo();
                }else{
                    $this->verifyLogin();
                }
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Página não encontrada!</p><br>";

                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
                // die("Erro: 004 - Por Favor tente novamente! Se o problema persistir, entre em contato com o administrador em " . EMAILADM); 
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
                $classLoad->{$this->urlMetodo}($this->urlParameter);
            }else{
                die("Erro: 007 - Por Favor tente novamente! Se o problema persistir, entre em contato com o administrador em " . EMAILADM); 
            }
        }

        
        private function verifyLogin() :void
        {
            if((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name'])) and (isset($_SESSION['user_email'])) and ($_SESSION['adms_access_level_id']) and ($_SESSION['order_level'])){
                // $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
                $this->searchLevelPage();
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Necessário realizar o login para acessar esta página!</p><br>";

                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }
        }

        private function searchLevelPage(): void
        {
            
            $serachLevelPage = new \App\adms\Models\helper\AdmsRead();
            $serachLevelPage->fullRead("SELECT id, permission 
                                    FROM adms_levels_pages
                                    WHERE adms_page_id =:adms_page_id
                                    AND adms_access_level_id =:adms_access_level_id 
                                    AND permission =:permission
                                    LIMIT :limit", 
                                    "adms_page_id={$this->resultPage[0]['id']}&adms_access_level_id=".$_SESSION['adms_access_level_id']."&permission=1&limit=1
                                    ");
            $this->resultLevelPage = $serachLevelPage->getResult();
            if($this->resultLevelPage){
                $this->classLoad = "\\App\\".$this->resultPage[0]['type']."\\Controllers\\" . $this->urlController;
                $this->loadMetodo();
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Página restrita Realize o Login!</p><br>";

                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");

            }
        }

        

    }

?>