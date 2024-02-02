<?php

namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Controller da página Visualizar o nivel de acesso novo usuario
 * @author Franklin
 */
class ViewLevelsForms
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;


    public function index(): void
    {
        
        $viewLevelsForm = new \App\adms\Models\AdmsViewLevelsForms();
        $viewLevelsForm->viewLevelsForm();
        if ($viewLevelsForm->getResult()) {
            $this->data['viewLevelsForm'] = $viewLevelsForm->getResultBd();
            $this->viewLevelsForm();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página de configuração não encontrada!</p>";
            $urlRedirect = URLADM . "dashboard/index";
            header("Location: $urlRedirect");
        }
    }

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewLevelsForm(): void
    {
        
        $button = [
            'edit_levels_forms' => ['menu_controller' => 'edit-levels-forms', 'menu_metodo' => 'index']];
            $listButton = new \App\adms\Models\helper\AdmsButton();
            $this->data['button'] = $listButton->buttonPermission($button);
            // var_dump($this->data['button']);

            $countUsers = new \App\adms\Models\helper\AdmsMenu();
            $this->data['menu'] = $countUsers->itemMenu();

        $this->data['sidebarActive'] = "view-levels-forms"; 

        $loadView = new \Core\ConfigView("adms/Views/levelsForms/viewLevelsForms", $this->data);
        $loadView->loadView();
    }
}