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
class AdmsDeletePages
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

    public function deletePages(int $id): void
    {
        $this->id = (int) $id;

        if($this->viewPages()){
            $deletePage= new \App\adms\Models\helper\AdmsDelete();
            $deletePage->exeDelete("adms_pages", "WHERE id =:id", "id={$this->id}");
            
            if($deletePage->getResult()){
                $_SESSION['msg'] = "<p class='alert-success'>Página apagada com sucesso!</p><br>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página não apagada com sucesso!</p><br>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    
        $urlRedirect = URLADM . "list-pages/index";
        header("Location: $urlRedirect");

    }
    private function viewPages(): bool
    {

        $viewPage = new \App\adms\Models\helper\AdmsRead();
        $viewPage->fullRead("SELECT id 
                            FROM adms_pages 
                            WHERE id=:id 
                            LIMIT :limit", 
                            "id={$this->id}&limit=1");

        var_dump($viewPage);
        $this->resultBd = $viewPage->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Página não encontrada!</p>";
            return false;
        }
    }

    
}