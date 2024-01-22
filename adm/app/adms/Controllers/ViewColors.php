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
class ViewColors
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

            $viewColors = new \App\adms\Models\AdmsViewColors();
            $viewColors->viewColor($this->id);
            if ($viewColors->getResult()) {
                $this->data['viewColor'] = $viewColors->getResultBd();
                $this->viewColors();
            } else {
                $urlRedirect = URLADM . "list-colors/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Cor não encontrada!</p>";
            $urlRedirect = URLADM . "list-colors/index";
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
            'list_colors' => ['menu_controller' => 'list-colors', 'menu_metodo' => 'index'],
            'edit_colors' => ['menu_controller' => 'edit-colors', 'menu_metodo' => 'index'],
            'delete_colors' => ['menu_controller' => 'delete-colors', 'menu_metodo' => 'index']];

            $listButton = new \App\adms\Models\helper\AdmsButton();
            $this->data['button'] = $listButton->buttonPermission($button);

        $this->data['sidebarActive'] = "list-colors"; 

        $loadView = new \Core\ConfigView("adms/Views/colors/viewColors", $this->data);
        $loadView->loadView();
    }
}
