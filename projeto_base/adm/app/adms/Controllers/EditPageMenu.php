<?php

namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Controller da página editar pagina do ítem do menu
 * @author Franklin
 */
class EditPageMenu
{
    /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
    private array|string|null $data = []; 
  
    /** @var array $dataform Recebe os dados do Formulário */
    private array|null $dataForm;

    //** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|string|null $level Recebe o nivel de acesso */
    private int|string|null $level;

    /** @var array|string|null $page Recebe a pagina atual */
    private int|string|null $pag;

    /**
     * Metodo alterar ordem do nívels de acesso
     * Recebe como parametro o ID que será usado para pesquisar as informações no banco de dados e instancia a MODELS AdmsViewColors
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senão é redirecionado para o listar cores.
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        $this->id = (int) $id;

        $this->level = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if((!empty($this->id)) and (!empty($this->level)) and (!empty($this->pag)) and (empty($this->dataForm['SendEditPageMenu']))){

            $viewPageMenu = new \App\adms\Models\AdmsEditPageMenu();
            $viewPageMenu->viewPageMenu($this->id);

            if($viewPageMenu->getResult()){
                $this->data['form'] = $viewPageMenu->getResultBd();
                // var_dump($this->data['form']);
                $this->viewEditPageMenu();
            }else{
                $urlRedirect = URLADM . "list-permission/index/{$this->pag}?level={$this->level}";
                header("Location: $urlRedirect");
            }

                
        } else {
            $this->editPageMenu();
        }
    }
    

    private function viewEditPageMenu(): void
    {
        $button = ['list_permission' => ['menu_controller' => 'list-permission', 'menu_metodo' => 'index']];

        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);

        $this->data['btnLevel'] = $this->level;

        $listselect = new \App\adms\Models\AdmsEditPageMenu();
        $this->data['select'] = $listselect->listSelect();
        // var_dump($this->data['select']['itm']);

        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

    
        $this->data['sidebarActive'] = "list-access-levels";


        $loadView = new \Core\ConfigView("adms/Views/permission/editPageMenu", $this->data);
        $loadView->loadView();
    }
    private function editPageMenu(): void
    {

        if (!empty($this->dataForm['SendEditPageMenu'])) {
            unset($this->dataForm['SendEditPageMenu']);
            $editPageMenu = new \App\adms\Models\AdmsEditPageMenu();
            $editPageMenu->update($this->dataForm);

            if($editPageMenu->getResult()){
                $urlRedirect = URLADM . "list-permission/index/{$this->pag}?level={$this->level}";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditPageMenu();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página de item de menu não encontrada!</p>";
            $urlRedirect = URLADM . "list-access-levels/index";
            header("Location: $urlRedirect");
        }
        
            
        
    }

}
