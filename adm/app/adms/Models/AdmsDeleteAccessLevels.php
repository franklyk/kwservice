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
class AdmsDeleteAccessLevels
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

    public function deleteAccess(int $id): void
    {
        $this->id = (int) $id;

        if(($this->viewAccess()) and ($this->checkStatusLevels())){
            $deleteSitUser = new \App\adms\Models\helper\AdmsDelete();
            $deleteSitUser->exeDelete("adms_access_levels", "WHERE id =:id", "id={$this->id}");
    
            if($deleteSitUser->getResult()){
                $_SESSION['msg'] = "<p class='alert-success'>Nível de acesso apagado com sucesso!</p><br>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nível de acesso não apagado com sucesso!</p><br>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    
        $urlRedirect = URLADM . "list-access-levels/index";
        header("Location: $urlRedirect");

    }
    private function viewAccess(): bool
    {

        $viewAccess = new \App\adms\Models\helper\AdmsRead();
        $viewAccess->fullRead("SELECT id 
        FROM adms_access_levels 
        WHERE id=:id AND order_level>:order_level
        LIMIT :limit", 
        "id={$this->id}&order_level={$_SESSION['order_level']}&limit=1");

        $this->resultBd = $viewAccess->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Nível de accesso não encontrado!</p>";
            return false;
        }
    }

    private function checkStatusLevels(): bool
    {
        $viewLevelAdd = new \App\adms\Models\helper\AdmsRead();
        $viewLevelAdd->fullRead("SELECT id FROM adms_users WHERE adms_level_id =:adms_level_id LIMIT :limit", "adms_level_id={$this->id}&limit=1");

        if($viewLevelAdd->getResult()){
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Este nível não pode ser apagado, existem usuários cadastrados com esta função!</p>";
            return false;
        }else{
            return true;
        }
    }

    
}