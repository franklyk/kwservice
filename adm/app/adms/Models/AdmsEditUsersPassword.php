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
class AdmsEditUsersPassword
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

    public function viewUser(int $id): void
    {
        $this->id = $id;

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT usr.id
                                    FROM adms_users AS usr
                                    INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id
                                    WHERE usr.id=:id AND lev.order_level >:order_level
                                    LIMIT :limit", "id={$this->id}&order_level=" .$_SESSION['order_level'] . "&limit=1");
        /*$viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT usr.id
                            FROM adms_users AS usr
                            INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id
                            WHERE usr.id=:id AND lev.order_levels >:order_levels
                            LIMIT :limit", "id={$this->id}&order_levels=" . $_SESSION['order_levels'] . "&limit=1");*/

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


        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }
    /**
     * Instanciar o helper "AdmsValPassword" para validar a senha
     * 
     * Retorna falso quando houver algum erro
     *
     * @return void
     */
    private function valInput(): void
    {
        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);

        if ($valPassword->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    private function edit(): void
    {
        $this->data['modified'] = date("Y-m-d H:i:s");
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        
        $this->result = false;
        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($upUser->getResult()){
            $_SESSION['msg'] = "<p class='alert-success'>A senha do usuário foi editada com sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro:A senha do usuário não foi editada com sucesso!</p>";
            $this->result = false;
        }
    }
}