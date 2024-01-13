<?php



namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Controller da Página Vizualizar Situação do Usuário
 * 
 * @author Franklin <frsbatis@gmail.com>
 */
class ViewSitsUsers
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

            $viewUser = new \App\adms\Models\AdmsViewSitsUsers();
            $viewUser->viewSitUser($this->id);

            if ($viewUser->getResult()) {
                $this->data['viewSitUser'] = $viewUser->getResultBd();
                $this->viewSitUser();
            } else {
                $this->data['viewSitUser'] = $viewUser->getResultBd();
                $this->viewSitUser();
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não encontrado!</p><br>";

            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        }
        $this->data = [];
    }
    private function viewSitUser(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/sitsUser/viewSitsUser", $this->data);
        $loadView->loadView();
    }
}
