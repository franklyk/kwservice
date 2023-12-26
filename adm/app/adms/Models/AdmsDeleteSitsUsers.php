<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Apagar o usuário no banco de dados
 *
 * @author Franklin
 */
class AdmsDeleteSitsUsers
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    public function deleteUser(int $id): void
    {
        $this->id = (int) $id;

        if($this->viewSitsUser()){
            $deleteSitUser = new \App\adms\Models\helper\AdmsDelete();
            $deleteSitUser->exeDelete("adms_sits_users", "WHERE id=:id", "id={$this->id}");
    
            if($deleteSitUser->getResult()){
                // $this->deleteImg();
                $_SESSION['msg'] = "<p style='color:#051;'>Situação apagada com sucesso!</p><br>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p style='color:#640000;'>Erro: Situação não apagada com sucesso!</p><br>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    
        $urlRedirect = URLADM . "list-sits-users/index";
        header("Location: $urlRedirect");

    }
    private function viewSitsUser(): bool
    {

        $viewSisUser = new \App\adms\Models\helper\AdmsRead();
        $viewSisUser->fullRead("SELECT id FROM adms_sits_users WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewSisUser->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p style= 'color: #640000;'>Erro 006: Usuário não encontrado!</p>";
            return false;
        }
    }

    
}