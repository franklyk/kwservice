<?php

namespace App\adms\Controllers;

/**
 * Controller da página para receber novo link para Confirmar Email
 * 
 * @author Franklin (" KLYK ") <frsbatist@gmail.com>
 * 
 * http://localhost/kwservice/adm/new-conf-email/index
 *
 * @return void
 */

class NewConfEmail
{
    /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
    private array|string|null $data = [];
  
    /** @var array $dataform Recebe os dados do Formulário */
    private array|null $dataForm;

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para a View
     * Responsável por reenviar o email de confirmação
     *
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->dataForm['SandNewConfEmail'])){
            unset($this->dataForm['SandNewConfEmail']);
            $newConfEmail = new \App\adms\Models\AdmsNewConfEmail();
            $newConfEmail->newConfEmail($this->dataForm);
            if($newConfEmail->getResult()){
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewNewConfEmail();
            }
        }else{
            $this->viewNewConfEmail();
        }

    }


    /**
     * Responsável por carregar a view
     *
     * @return void
     */
    private function viewNewConfEmail(): void
    {
       $loadView = new \Core\ConfigView("adms/Views/login/newConfEmail", $this->data);
       $loadView->loadViewLogin();
    }

    
}
