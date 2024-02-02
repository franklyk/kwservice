<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Editar o perfil do usuário
 *
 * @author Franklin
 */
class AdmsEditProfile
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;
    
    private array|null $data;

    /** @var array|null $dataExitVal Recebe os campos que devem ser tirados da validação */
    private array|null $dataExitVal;


    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

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

    public function viewProfile(): void
    {
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT id, name, nickname, email, user
                                                    FROM adms_users WHERE id=:id 
                                                    LIMIT :limit", "id=" . $_SESSION['user_id'] ."&limit=1");

        $this->resultBd = $viewUser->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Perfil não encontrado!</p>";
            $this->result = false;
        }
    }

    public function update(array $data = null):void
    {
        $this->data = $data;
        $this->dataExitVal['nickname'] = $this->data['nickname'];
        unset($this->data['nickname']);

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }
    private function valInput(): void
    {
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);

        $valEmailSingle= new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email'], true, $_SESSION['user_id'],);

        $valUserSingle = new \App\adms\Models\helper\AdmsValUserSingle();
        $valUserSingle->validateUserSingle($this->data['user'], true, $_SESSION['user_id']);


        if ($valEmail->getResult() and ($valEmailSingle->getResult()) and ($valUserSingle->getResult())) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }
    private function edit(): void
    {
        $this->data['modified'] = date("Y-m-d H:i:s");

        $this->data['nickname'] = $this->dataExitVal['nickname'];
        
        // $this->result = false;
        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id=" . $_SESSION['user_id']);

        if($upUser->getResult()){
            $_SESSION['user_name'] = $this->data['name'];
            $_SESSION['user_nickname'] = $this->data['nickname'];
            $_SESSION['user_email'] = $this->data['email'];
            $_SESSION['msg'] = "<p class='alert-success'>Perfil editado com sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Perfil não editado com sucesso!</p>";
            $this->result = false;
        }
    }
}