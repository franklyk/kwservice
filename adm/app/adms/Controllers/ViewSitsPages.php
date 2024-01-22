<?php



namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}

/**
 * Controller da Página Visualizar Situação da Página
 * 
 * @author Franklin (" KLYK ") <frsbatis@gmail.com>
 */

class ViewSitsPages
{
    /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
    private array|string|null $data;

    /** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;
    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para a View
     *
     * @return void
     */

    public function index(int|string|null $id = null): void
    {

        if (!empty($id)) {
            $this->id = (int) $id;

            $viewPages = new \App\adms\Models\AdmsViewSitsPages();
            $viewPages->viewSitPages($this->id);

            if ($viewPages->getResult()) {
                $this->data['viewSitPages'] = $viewPages->getResultBd();
                $this->viewSitPages();
            } else {
                $this->data['viewSitPages'] = $viewPages->getResultBd();
                $this->viewSitPages();
                $urlRedirect = URLADM . "list-sits-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Página não encontrada!</p><br>";

            $urlRedirect = URLADM . "list-pages/index";
            header("Location: $urlRedirect");
        }
        $this->data = [];
    }
    private function viewSitPages(): void
    {
        
        $button = [
            'list_sits_pages' => ['menu_controller' => 'list-sits-pages', 'menu_metodo' => 'index'],
            'edit_sits_pages' => ['menu_controller' => 'edit-sits-pages', 'menu_metodo' => 'index'],
            'delete_sits_pages' => ['menu_controller' => 'delete-sits-pages', 'menu_metodo' => 'index']];

            $listButton = new \App\adms\Models\helper\AdmsButton();
            $this->data['button'] = $listButton->buttonPermission($button);

            $this->data['sidebarActive'] = "list-sits-pages";


        $loadView = new \Core\ConfigView("adms/Views/sitsPages/viewSitsPages", $this->data);
        $loadView->loadView();
    }
}
