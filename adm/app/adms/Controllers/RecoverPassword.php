<?php

namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Controller da página de Recuperar senha
 * 
 * @author Franklin (" KLYK ") <frsbatist@gmail.com>
 *
 * @return void
 */

class RecoverPassword
{
    /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
    private array|string|null $data = [];

    /** @var array $dataform Recebe os dados do Formulário */
    private array|null $dataForm;

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para a View
     *
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dataForm['SandRecoverPass'])) {
            unset($this->dataForm['SandRecoverPass']);
            $this->viewRecoverPass();

            $recoverPass = new \App\adms\Models\AdmsRecoverPass();
            $recoverPass->recoverPassword($this->dataForm);

            /**
             * Se o processo for concluido fará o redirecionamento caso contrário 
             * manterá os dados no formulário
             */
            if($recoverPass->getResult()){
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            } else {
                $this->data["form"] =$this->dataForm;
                $this->viewRecoverPass();
            }
        } else {
            $this->viewRecoverPass();
        }
    }

    /**
     * Carregar a view
     *
     * @return void
     */
    private function viewRecoverPass(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/login/recoverPassword", $this->data);
        $loadView->loadViewLogin();
    }
}
