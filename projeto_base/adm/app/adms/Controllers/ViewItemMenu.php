<?php

namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Controller da página Visualizar Cor
 * @author Franklin
 */
class ViewItemMenu
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Metodo visualizar cor
     * Recebe como parametro o ID que será usado para pesquisar as informações no banco de dados e instancia a MODELS AdmsViewColors
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senão é redirecionado para o listar cores.
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;

            $viewItemMenu = new \App\adms\Models\AdmsViewItemMenu();
            $viewItemMenu->viewItemMenu($this->id);
            if ($viewItemMenu->getResult()) {
                $this->data['viewItemMenu'] = $viewItemMenu->getResultBd();
                $this->viewColors();
            } else {
                $urlRedirect = URLADM . "list-item-menu/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Configurção não encontrada!</p>";
            $urlRedirect = URLADM . "list-item-menu/index";
            header("Location: $urlRedirect");
            

        }
    }

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewColors(): void
    {
        
        $button = [
            'list_item_menu' => ['menu_controller' => 'list-item-menu', 'menu_metodo' => 'index'],
            'edit_item_menu' => ['menu_controller' => 'edit-item-menu', 'menu_metodo' => 'index'],
            'delete_item_menu' => ['menu_controller' => 'delete-item-menu', 'menu_metodo' => 'index']];

            $listButton = new \App\adms\Models\helper\AdmsButton();
            $this->data['button'] = $listButton->buttonPermission($button);

            $countUsers = new \App\adms\Models\helper\AdmsMenu();
            $this->data['menu'] = $countUsers->itemMenu();

        $this->data['sidebarActive'] = "list-item-menu"; 

        $loadView = new \Core\ConfigView("adms/Views/itemMenu/viewItemMenu", $this->data);
        $loadView->loadView();
    }
}
