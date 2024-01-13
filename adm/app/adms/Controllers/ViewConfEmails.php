<?php



namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}

/**
 * Controller da Página Visualizar Configuações de E-mail
 * 
 * @author Franklin (" KLYK ") <frsbatist@gmail.com>
 */

class ViewConfEmails
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

            $viewConfEmails = new \App\adms\Models\AdmsViewConfEmails();
            $viewConfEmails->viewConfEmail($this->id);

            if ($viewConfEmails->getResult()) {
                $this->data['viewConfEmails'] = $viewConfEmails->getResultBd();
                $this->viewConfEmail();
            } else {
                $urlRedirect = URLADM . "list-conf-emails/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Email não encontrado!</p><br>";

            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        }
    }
    private function viewConfEmail(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/confEmails/viewConfEmails", $this->data);
        $loadView->loadView();
    }
}
