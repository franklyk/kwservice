<?php



namespace App\adms\Controllers;


class ViewUsers
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

            $viewUser = new \App\adms\Models\AdmsViewUsers();
            $viewUser->viewUser($this->id);
            if ($viewUser->getResult()) {
                $this->data['viewUser'] = $viewUser->getResultBd();
                $this->viewUser();
            } else {
                $this->data['viewUser'] = $viewUser->getResultBd();
                $this->viewUser();
                // $urlRedirect = URLADM . "list-users/index";
                // header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não encontrado!</p><br>";

            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        }
        $this->data = [];
    }
    private function viewUser(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/users/viewUser", $this->data);
        $loadView->loadView();
    }
}
