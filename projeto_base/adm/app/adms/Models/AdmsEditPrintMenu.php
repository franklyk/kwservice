<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Editar item do menu
 *
 * @author Franklin
 */
class AdmsEditPrintMenu
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int|string|null $id Recebe o id do registro */
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
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    public function editPrintMenu(int $id): void
    {
        $this->id = $id;

        $viewPrintMenu = new \App\adms\Models\helper\AdmsRead();
        $viewPrintMenu->fullRead(
            "SELECT lev_pag.id, lev_pag.print_menu
                            FROM adms_levels_pages lev_pag
                            INNER JOIN adms_access_levels AS lev ON lev.id=lev_pag.adms_access_level_id
                            LEFT JOIN adms_pages AS pgs ON pgs.id=lev_pag.adms_page_id
                            WHERE lev_pag.id =:id
                            AND (lev.order_level >:order_level 
                            OR (lev.order_level = ({$_SESSION['adms_access_level_id']}) = 1))
                            AND (((SELECT permission 
                            FROM adms_levels_pages
                            WHERE adms_page_id =lev_pag.adms_page_id
                            AND adms_access_level_id = {$_SESSION['adms_access_level_id']}) = 1) 
                            OR (publish = 1))
                            LIMIT :limit",
            "id={$this->id}&order_level=".$_SESSION['order_level']."&limit=1"
        );

        $this->resultBd = $viewPrintMenu->getResult();
        if ($this->resultBd) {
            $this->edit();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar um ítem de menu!</p>";
            $this->result = false;
        }
    }

    private function edit(): void
    {
        
        if($this->resultBd[0]['print_menu'] == 1){
            $this->data['print_menu'] = 2;
        }else{
            $this->data['print_menu'] = 1;
        }
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upPrintMenu = new \App\adms\Models\helper\AdmsUpdate();
        $upPrintMenu->exeUpdate("adms_levels_pages", $this->data, "WHERE id=:id", "id={$this->id}");

        if ($upPrintMenu->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Ítem de menu editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Ítem de menu editado não editado com sucesso!</p>";
            $this->result = false;
        }
    }

}