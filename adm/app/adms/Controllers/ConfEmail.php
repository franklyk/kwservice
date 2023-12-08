<?php

namespace App\adms\Controllers;

/**
 * Controller da página de Confirmar Email
 * 
 * @author Franklin (" KLYK ") <frsbatist@gmail.com>
 *
 * @return void
 */

class ConfEmail
{
    /** @var string|null $key Recebe a chave para confirmar o cadastro */
    private string|null $key;

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para a View
     * Confirmação de email cadastrado
     *
     * @return void
     */
    public function index(): void
    {
        $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);

        if (!empty($this->key)) {
            $this->valkey();
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Link inválido!</p><br>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }
    /**
     * Método para validação da chave que confirma o email cadastrado
     *
     * @return void
     */
    public function valkey(): void
    {
        $confEmail = new \App\adms\Models\AdmsConfEmail();
        $confEmail->confEmail($this->key);

        if($confEmail->getResult()){
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }else{
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }
}
