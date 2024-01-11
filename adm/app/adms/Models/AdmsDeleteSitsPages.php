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
class AdmsDeleteSitsPages
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

    public function deleteSitsPages(int $id): void
    {
        $this->id = (int) $id;

        if(($this->viewSitsPages()) and ($this->checkStatusPages())){
            $deleteSitPage = new \App\adms\Models\helper\AdmsDelete();
            $deleteSitPage->exeDelete("adms_sits_pgs", "WHERE id =:id", "id={$this->id}");
    
            if($deleteSitPage->getResult()){
                $_SESSION['msg'] = "<p class='alert-success'>Situação de página apagada com sucesso!</p><br>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Situação de página não apagada com sucesso!</p><br>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    
        $urlRedirect = URLADM . "list-sits-pages/index";
        header("Location: $urlRedirect");

    }
    private function viewSitsPages(): bool
    {

        $viewSisUser = new \App\adms\Models\helper\AdmsRead();
        $viewSisUser->fullRead("SELECT id FROM adms_sits_pgs WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewSisUser->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Página não encontrada!</p>";
            return false;
        }
    }

    private function checkStatusPages(): bool
    {
        $viewUserAdd = new \App\adms\Models\helper\AdmsRead();
        $viewUserAdd->fullRead("SELECT id FROM adms_pages WHERE adms_sits_pgs_id	=:adms_sits_pgs_id LIMIT :limit", "adms_sits_pgs_id={$this->id}&limit=1");

        if($viewUserAdd->getResult()){
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Esta situação de página não pode ser apagada, existem usuários utilizando este ítem!</p>";
            return false;
        }else{
            return true;
        }
    }

    
}