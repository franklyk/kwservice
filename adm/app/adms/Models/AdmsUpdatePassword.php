<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}



/**
 * Confirmar a chave para recuperar a senha.
 * Cadastrar nova senha.
 *
 * @author Franklin 
 */
class AdmsUpdatePassword
{
    /** @var string $key Recebe a chave para atualizar a senha */
    private string $key;
    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    private array $dataSave;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private string|null|bool $result;

    

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /** 
     * 
     * @return void
     */
    public function valkey(string $key): bool
    {
        $this->key = $key;
        $viewKeyUpPass = new \App\adms\Models\helper\AdmsRead();
        $viewKeyUpPass->fullRead("SELECT id FROM adms_users WHERE recover_password =:recover_password LIMIT :limit", "recover_password={$this->key}&limit=1");

        $this->resultBd = $viewKeyUpPass->getResult();
        if ($this->resultBd) {
            $this->result = true;
            return true;
        } else {
            $_SESSION['msg'] = "<p style='color: #640000;'>Erro: Link inválido solicite um novo link <a href=" . URLADM . "recover-password/index >Clicando Aqui</a>!</p>";
            $this->result = false;
            return false;
        }
    }

    public function editPassword(array $data = null): void
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

    private function valInput(): void
    {
        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);
        if ($valPassword->getResult()) {
            if ($this->valkey($this->data['key'])) {
                $this->updatePassword();
            } else {
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function updatePassword(): void
    {
        $this->dataSave['recover_password'] = null;
        $this->dataSave['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->dataSave['modified'] = date("Y-m-d H:i:s");  

        $upPassword = new \App\adms\Models\helper\AdmsUpdate();
        $upPassword->exeUpdate("adms_users", $this->dataSave, "WHERE id=:id", "id={$this->resultBd[0]['id']}");
        if($upPassword->getResult()){
            $_SESSION['msg'] = "<p style='color: #051;'>Senha atualizada com sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #640000;'>Senha não atualizada com sucesso!</p>";
            $this->result = false;
        }
    }
}
