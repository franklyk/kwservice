<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar situação 
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditSitsPages
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


            if ((!empty($id)) and (empty($this->dataForm['SendEditSitUser']))) {
                $this->id = (int) $id;
                $viewSitPages = new \App\adms\Models\AdmsEditSitsPages();
                $viewSitPages->viewSitPages($this->id);

                if ($viewSitPages->getResult()) {
                    $this->data['form'] = $viewSitPages->getResultBd();
                    $this->viewEditSitPages();

                } else {

                    $urlRedirect = URLADM . "list-sits-users/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editSitPages();
            }
        
        }
        private function viewEditSitPages() :void
        {
            $listSelect = new \App\adms\Models\AdmsEditSitsPages();
            $this->data['select'] = $listSelect->listSelect();
            
            $loadView = new \Core\ConfigView("adms/Views/sitsPages/editSitsPages", $this->data);
            $loadView->loadView();
        }


        private function editSitPages(): void
        {

            if (!empty($this->dataForm['SendEditSitPages'])) {
                unset($this->dataForm['SendEditSitPages']);
                $editSitUser = new \App\adms\Models\AdmsEditSitsPages();
                $editSitUser->update($this->dataForm);

                if($editSitUser->getResult()){
                    $urlRedirect = URLADM . "view-sits-pages/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditSitPages();
                }
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Situação de página não encontrada!</p>";
                $urlRedirect = URLADM . "list-sits-pages/index";
                header("Location: $urlRedirect");
            }
            
                
            
        }
    }


?>