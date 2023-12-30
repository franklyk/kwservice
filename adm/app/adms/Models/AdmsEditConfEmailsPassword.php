<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Editar a senha do usuário no banco de dados
 *
 * @author Franklin
 */
class AdmsEditConfEmailsPassword
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

    /** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Undocumented function
     *
     * @return array|null
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    public function viewConfEmailsPassword(int $id): void
    {
        $this->id = $id;

        $viewConfEmails = new \App\adms\Models\helper\AdmsRead();
        $viewConfEmails->fullRead("SELECT id FROM adms_confs_emails
                                    WHERE id=:id 
                                    LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewConfEmails->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style= 'color: #640000;'>Erro 006: Configuração não encontrada!</p>";
            $this->result = false;
        }
    }

    public function update(array $data = null):void
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    private function edit(): void
    {
        $this->data['modified'] = date("Y-m-d H:i:s");
        // $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        
        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_confs_emails", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($upUser->getResult()){
            $_SESSION['msg'] = "<p style='color: #051;'>A senha de configuração foi editada com sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #640000;'>Erro:A senha de configuração não foi editada com sucesso!</p>";
            $this->result = false;
        }
    }
}