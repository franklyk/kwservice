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
class AdmsDeleteItemMenu
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

    public function deleteItemMenu(int $id): void
    {
        $this->id = (int) $id;

        if(($this->viewItemMenu()) and ($this->checkStatusUser())){
            
           
            $deleteItemMenu = new \App\adms\Models\helper\AdmsDelete();
            $deleteItemMenu->exeDelete("adms_items_menus", "WHERE id =:id", "id={$this->id}");
    
            if($deleteItemMenu->getResult()){
                $_SESSION['msg'] = "<p class='alert-success'>Ítem apagado com sucesso!</p><br>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Ítem não apagado com sucesso!</p><br>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    
        $urlRedirect = URLADM . "list-item-menu/index";
        header("Location: $urlRedirect");

    }
    private function viewItemMenu(): bool
    {

        $viewItemMenu = new \App\adms\Models\helper\AdmsRead();
        $viewItemMenu->fullRead("SELECT id FROM adms_items_menus WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewItemMenu->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Ítem não encontrado!</p>";
            return false;
        }
    }

    private function checkStatusUser(): bool
    {
        $viewItemAdd = new \App\adms\Models\helper\AdmsRead();
        $viewItemAdd->fullRead("SELECT id FROM adms_levels_pages WHERE adms_items_menu_id  =:adms_items_menu_id LIMIT :limit", "adms_items_menu_id={$this->id}&limit=1");

        if($viewItemAdd->getResult()){
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Esta ítem não pode ser apagado, existem situações utilizando este ítem!</p>";
            return false;
        }else{
            return true;
        }
    }

    
}