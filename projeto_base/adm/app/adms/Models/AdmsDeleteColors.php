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
class AdmsDeleteColors
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

    public function deleteColor(int $id): void
    {
        $this->id = (int) $id;

        if(($this->viewColor()) and ($this->checkStatusUser())){
            

            /*$deleteLevelPage= new \App\adms\Models\helper\AdmsDelete();
            $deleteLevelPage->exeDelete("adms_level_pages", "WHERE adms_pages_id =:adms_pages_id", "adms_pages_id={$this->id}");*/
            
           
            $deleteColor = new \App\adms\Models\helper\AdmsDelete();
            $deleteColor->exeDelete("adms_color", "WHERE id =:id", "id={$this->id}");
    
            if($deleteColor->getResult()){
                $_SESSION['msg'] = "<p class='alert-success'>Cor apagada com sucesso!</p><br>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Cor não apagada com sucesso!</p><br>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    
        $urlRedirect = URLADM . "list-colors/index";
        header("Location: $urlRedirect");

    }
    private function viewColor(): bool
    {

        $viewColor = new \App\adms\Models\helper\AdmsRead();
        $viewColor->fullRead("SELECT id FROM adms_color WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewColor->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Cor não encontrada!</p>";
            return false;
        }
    }

    private function checkStatusUser(): bool
    {
        $viewUserAdd = new \App\adms\Models\helper\AdmsRead();
        $viewUserAdd->fullRead("SELECT id FROM adms_sits_users WHERE adms_color_id =:adms_color_id LIMIT :limit", "adms_color_id={$this->id}&limit=1");

        if($viewUserAdd->getResult()){
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Esta cor não pode ser apagada, existem situações utilizando este ítem!</p>";
            return false;
        }else{
            return true;
        }
    }

    
}