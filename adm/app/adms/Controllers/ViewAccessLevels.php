<?php



namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Controller da Página Visualizar Nível de Acesso
 * 
 * @author Franklin <frsbatist@gmail.com>
 */


class ViewAccessLevels
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

            $viewAccess = new \App\adms\Models\AdmsViewAccessLevels();
            $viewAccess->viewAccess($this->id);

            if ($viewAccess->getResult()) {
                $this->data['viewAccess'] = $viewAccess->getResultBd();
                $this->viewAccessLevels();
            } else {
                $this->data['viewAccess'] = $viewAccess->getResultBd();
                $this->viewAccessLevels();
                $urlRedirect = URLADM . "list-access-levels/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Nível de acesso não encontrado!</p><br>";

            $urlRedirect = URLADM . "list-access-levels/index";
            header("Location: $urlRedirect");
        }
        $this->data = [];

        $this->data['sidebarActive'] = "list-access-levels"; 

    }
    private function viewAccessLevels(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/accessLevels/viewAccessLevels", $this->data);
        $loadView->loadView();
    }
}
