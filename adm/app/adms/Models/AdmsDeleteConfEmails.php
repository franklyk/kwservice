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
class AdmsDeleteConfEmails
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

    public function deleteConfEmail(int $id): void
    {
        $this->id = (int) $id;

        if($this->viewConfEmail()){
            $deleteConfEmail = new \App\adms\Models\helper\AdmsDelete();
            $deleteConfEmail->exeDelete("adms_confs_emails", "WHERE id=:id", "id={$this->id}");
    
            if($deleteConfEmail->getResult()){
                $_SESSION['msg'] = "<p style='color:#051;'>Configuração apagada com sucesso!</p><br>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Configuração não apagada com sucesso!</p><br>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    
        $urlRedirect = URLADM . "list-conf-emails/index";
        header("Location: $urlRedirect");

    }
    private function viewConfEmail(): bool
    {

        $viewConfEmail = new \App\adms\Models\helper\AdmsRead();
        $viewConfEmail->fullRead("SELECT id FROM adms_confs_emails WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewConfEmail->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Usuário não encontrado!</p>";
            return false;
        }
    }
}