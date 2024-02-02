<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Editar página no item de menu
 *
 * @author Franklin
 */
class AdmsEditPageMenu
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

    /** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    private array $listRegistryEdit;


    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Undocumented function
     *
     * @return array|null
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    public function viewPageMenu(int $id): bool
    {
        $this->id = $id;

        $viewPageMenu = new \App\adms\Models\helper\AdmsRead();
        $viewPageMenu->fullRead(
                                "SELECT lev_pgs.id, lev_pgs.adms_items_menu_id,
                                pgs.name_page 
                                FROM adms_levels_pages AS lev_pgs
                                INNER JOIN adms_pages AS pgs ON pgs.id=lev_pgs.adms_page_id
                                INNER JOIN adms_access_levels AS lev ON lev.id=lev_pgs.adms_access_level_id
                                WHERE lev_pgs.id =:id
                                AND ((lev.order_level >=:order_level)
                                OR ({$_SESSION['adms_access_level_id']} = 1 ))
                                AND (((SELECT permission 
                                FROM adms_levels_pages
                                WHERE adms_page_id = lev_pgs.adms_page_id
                                AND adms_access_level_id = {$_SESSION['adms_access_level_id']}) = 1) 
                                OR (publish = 1))
                                LIMIT :limit", "id={$this->id}&order_level=" . $_SESSION['order_level'] . "&limit=1");

        $this->resultBd = $viewPageMenu->getResult();
        // var_dump($this->resultBd);
        if ($this->resultBd) {
            $this->result = true;
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Página de menu não encontrada!</p>";
            $this->result = false;
            return false;
        }
    }
    public function update(array $data = null): void
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            if($this->viewPageMenu($this->data['id'])){
                $this->edit();
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Sem permissão para editar!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function edit(): void
    {
        $this->data['modified'] = date("Y-m-d H:i:s");
        

        $upColor = new \App\adms\Models\helper\AdmsUpdate();
        $upColor->exeUpdate("adms_levels_pages", $this->data, "WHERE id=:id", "id={$this->data['id']}");
        var_dump($this->data);
        if ($upColor->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Página de menu editada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página de menu não editada com sucesso!</p>";
            $this->result = false;
        }
    }
    public function listSelect(): array
    {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_menu, name name_menu FROM adms_items_menus ORDER BY name ASC");
        $registry['itm'] = $list->getResult();

        $this->listRegistryEdit = ['itm' => $registry['itm']];

        return $this->listRegistryEdit;
        

    }
}
