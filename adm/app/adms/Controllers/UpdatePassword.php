<?php

namespace App\adms\Controllers;

/**
 * Controller da página de editar nova senha
 * 
 * @author Franklin (" KLYK ") <frsbatist@gmail.com>
 *
 * @return void
 */

class UpdatePassword
{
    /** @var string|null $key Recebe a chave para confirmar o cadastro */
    private string|null $key;

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
        /**
         * Recebe a chave de confirmação para cadastrar a nova senha
         */
        $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        if ((!empty($this->key)) and (empty($this->dataForm['SandUpPass']))) {
            $this->validateKey();
        } else {
            $this->updatePassword();
        }
    }

    private function validateKey(): void
    {
        $valkey = new \App\adms\Models\AdmsUpdatePassword();
        $valkey->valkey($this->key);
        if ($valkey->getResult()) {
            $this->viewUpdatePassword();
        } else {
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }
    private function updatePassword(): void
    {
        if (!empty($this->dataForm['SandUpPass'])) {
            unset($this->dataForm['SandUpPass']);
            $this->dataForm['key'] = $this->key;
            $upPassword = new \App\adms\Models\AdmsUpdatePassword();
            $upPassword->editPassword($this->dataForm);

            if ($upPassword->getResult()){
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
            }else{
                $this->viewUpdatePassword();
            }

            $this->viewUpdatePassword();
        }else{

            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

    private function viewUpdatePassword(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/login/updatePassword", $this->data);
        $loadView->loadViewLogin();
    }
}
