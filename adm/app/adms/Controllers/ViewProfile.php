<?php



namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Controller da página Visualizar Perfil
 * 
 * @author Franklin <frsbatist@gmail.com>
 */
class ViewProfile
{
    /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
    private array|string|null $data;

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para a View
     *
     * @return void
     */

    public function index(): void
    {

        

        $viewProfile = new \App\adms\Models\AdmsViewProfile();
        $viewProfile->viewProfile();
        if ($viewProfile->getResult()) {
            $this->data['viewProfile'] = $viewProfile->getResultBd();
            $this->loadViewProfile();
        } else {
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    
        $this->data = [];
    }
    private function loadViewProfile(): void
    {
        
        $button = [
            'edit_profile' => ['menu_controller' => 'edit-profile', 'menu_metodo' => 'index'],
            'edit_profile_password' => ['menu_controller' => 'edit-profile-password', 'menu_metodo' => 'index'],
            'edit_profile_image' => ['menu_controller' => 'edit-profile-image', 'menu_metodo' => 'index']];

            $listButton = new \App\adms\Models\helper\AdmsButton();
            $this->data['button'] = $listButton->buttonPermission($button);

            $countUsers = new \App\adms\Models\helper\AdmsMenu();
            $this->data['menu'] = $countUsers->itemMenu();

            $this->data['sidebarActive'] = "list-users";


        $loadView = new \Core\ConfigView("adms/Views/users/viewProfile", $this->data);
        $loadView->loadView();
    }
}