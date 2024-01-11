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
class AdmsDeleteGroupsPages
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

    public function deleteGroupPages(int $id): void
    {
        $this->id = (int) $id;

        if(($this->viewGroupsPages()) and ($this->checkStatusUser())){
            $deleteSitUser = new \App\adms\Models\helper\AdmsDelete();
            $deleteSitUser->exeDelete("adms_groups_pgs", "WHERE id =:id", "id={$this->id}");
    
            if($deleteSitUser->getResult()){
                $_SESSION['msg'] = "<p class='alert-success'>Grupo de páginas apagado com sucesso!</p><br>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Grupo de páginas não apagado com sucesso!</p><br>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    
        $urlRedirect = URLADM . "list-groups-pages/index";
        header("Location: $urlRedirect");

    }
    private function viewGroupsPages(): bool
    {

        $viewGroup = new \App\adms\Models\helper\AdmsRead();
        $viewGroup->fullRead("SELECT id FROM adms_groups_pgs WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewGroup->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Grupo de paginas não encontrado!</p>";
            return false;
        }
    }

    private function checkStatusUser(): bool
    {
        $viewGroupAdd = new \App\adms\Models\helper\AdmsRead();
        $viewGroupAdd->fullRead("SELECT id FROM adms_pages WHERE adms_groups_pgs_id =:adms_groups_pgs_id LIMIT :limit", "adms_groups_pgs_id={$this->id}&limit=1");

        if($viewGroupAdd->getResult()){
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Esto grupo não pode ser apagado, existem páginas utilizando este ítem!</p>";
            return false;
        }else{
            return true;
        }
    }

    
}