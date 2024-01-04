<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Editar usuários no banco de dados
 *
 * @author Franklin
 */
class AdmsEditUsers
{
    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;
    
    /** @var array|null $dataExitVal Recebe os campos que devem ser tirados da validação */
    private array|null $dataExitVal;

    private array $listRegistryAdd;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

    /** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;

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

    public function viewUser(int $id): void
    {
        $this->id = $id;

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT id, name, nickname, email, user, adms_sits_user_id
                                                    FROM adms_users
                                                    WHERE id=:id 
                                                    LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewUser->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Usuário não encontrado!</p>";
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
        $valEmailSingle->validateEmailSingle($this->data['email'], true, $this->data['id'],);

        $valUserSingle = new \App\adms\Models\helper\AdmsValUserSingle();
        $valUserSingle->validateUserSingle($this->data['user'], true, $this->data['id']);


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
        
        $this->result = false;
        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($upUser->getResult()){
            $_SESSION['msg'] = "<p class='alert-success'>Usuário editado com sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não editado com sucesso!</p>";
            $this->result = false;
        }
    }

    public function listSelect(): array
    {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id AS id_sit, name AS name_sit FROM adms_sits_users ORDER BY name  ASC");
        $registry['sit'] = $list->getResult();
        
        // $list->fullRead("SELECT id AS id_sit, name AS name_sit FROM adms_sits_users ORDER BY name  ASC");
        // $registry['color'] = $list->getResult();

        // $this->listRegistryAdd = ['sit' => $registry['sit'], 'color' => $registry['color']];
        $this->listRegistryAdd = ['sit' => $registry['sit']];

        return $this->listRegistryAdd;
    }
}