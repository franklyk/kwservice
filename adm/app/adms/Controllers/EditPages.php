<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar páginas 
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditPages
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data = [];
  
        /** @var array $dataform Recebe os dados do Formulário */
        private array|null $dataForm;

        /** @var array|string|null $id Recebe o id do registro */
        private int|string|null $id;

        /**
        * Instanciar a classe responsável em carregar a View e enviar os dados para a View
        *
        * @return void
        */
        public function index(int|string|null $id = null): void
        {
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);


            if ((!empty($id)) and (empty($this->dataForm['SendEditPages']))) {
                $this->id = (int) $id;
                $viewPages = new \App\adms\Models\AdmsEditPages();
                $viewPages->viewPages($this->id);

                if ($viewPages->getResult()) {
                    $this->data['form'] = $viewPages->getResultBd();
                    $this->viewEditPages();

                } else {
                    $urlRedirect = URLADM . "list-pages/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editPages();
            }
        
        }
        private function viewEditPages() :void
        {
            $listSelect = new \App\adms\Models\AdmsEditPages();
            $this->data['select'] = $listSelect->listSelect();

            $loadView = new \Core\ConfigView("adms/Views/pages/editPages", $this->data);
            $loadView->loadView();
        }


        private function editPages(): void
        {

            if (!empty($this->dataForm['SendEditPages'])) {
                unset($this->dataForm['SendEditPages']);
                $viewPages = new \App\adms\Models\AdmsEditPages();
                $viewPages->update($this->dataForm);

                if($viewPages->getResult()){
                    $urlRedirect = URLADM . "view-pages/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditPages();
                }
            } else {
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página não encontrada!</p>";
                $urlRedirect = URLADM . "list-pages/index";
                header("Location: $urlRedirect");
            }
            
                
            
        }
    }


?>