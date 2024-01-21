<?php



namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}

/**
 * Controller da Página Visualizar Tipos de Páginas
 * 
 * @author Franklin (" KLYK ") <frsbatist@gmail.com>
 */

class ViewTypesPages
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

            $viewTypesPages = new \App\adms\Models\AdmsViewTypesPages();
            $viewTypesPages->viewTypesPages($this->id);
            if ($viewTypesPages->getResult()) {
                $this->data['viewTypesPages'] = $viewTypesPages->getResultBd();
                $this->viewType();
            } else {
                
                $urlRedirect = URLADM . "list-types-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Tipo de páginas não encontrado!</p><br>";

            $urlRedirect = URLADM . "list-types-pages/index";
            header("Location: $urlRedirect");
        }
        $this->data = [];
    }
    private function viewType(): void
    {


        $button = [
            'list_types_pages' => ['menu_controller' => 'list-types-pages', 'menu_metodo' => 'index'],
            'edit_types_pages' => ['menu_controller' => 'edit-types-pages', 'menu_metodo' => 'index'],
            'delete_types_pages' => ['menu_controller' => 'delete-types-pages', 'menu_metodo' => 'index']];

            $listButton = new \App\adms\Models\helper\AdmsButton();
            $this->data['button'] = $listButton->buttonPermission($button);

            var_dump($this->data['button']);
            $this->data['sidebarActive'] = "list-users";



        $loadView = new \Core\ConfigView("adms/Views/typesPages/viewTypesPages", $this->data);
        $loadView->loadView();
    }
}