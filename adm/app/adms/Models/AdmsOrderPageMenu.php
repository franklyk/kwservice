<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Alterar a ordem do item do menu no banco de dados
 *
 * @author Franklin
 */
class AdmsOrderPageMenu

{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var array|null $resultBdPrev Recebe os registros do banco de dados */
    private array|null $resultBdPrev;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
    private array|string|null $data;

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

    /**
     * Metodo para alterar ordem do nivel de acesso
     * Recebe o ID do nivel de acesso que sera usado como parametro na pesquisa
     * Retorna FALSE se houver algum erro.
     * @param integer $id
     * @return void
     */
    public function orderPageMenu(int $id): void
    {
        $this->id = $id;
        var_dump($this->id);
        $viewAccessLevel = new \App\adms\Models\helper\AdmsRead();
        $viewAccessLevel->fullRead("SELECT lev_pag.id, lev_pag.order_level_page, lev_pag.adms_access_level_id
                        FROM adms_levels_pages lev_pag   
                        INNER JOIN adms_access_levels AS lev ON lev.id=lev_pag.adms_access_level_id
                        LEFT JOIN adms_pages AS pag ON pag.id=lev_pag.adms_page_id 
                        WHERE lev_pag.id=:id 
                        AND lev.order_level >=:order_level
                        AND (((SELECT permission 
                        FROM adms_levels_pages 
                        WHERE adms_page_id=lev_pag.adms_page_id 
                        AND adms_access_level_id = {$_SESSION['adms_access_level_id']}) = 1) 
                        OR (publish = 1)) 
                        LIMIT :limit", "id={$this->id}&order_level=" . $_SESSION['order_level'] . "&limit=1");

        $this->resultBd = $viewAccessLevel->getResult();
        if ($this->resultBd) {
            $this->viewPrevPageMenu();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nível de acesso não encontrado1!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo para recuperar o ordem do nivel de acesso superior
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    private function viewPrevPageMenu(): void
    {
        $prevPageMenu = new \App\adms\Models\helper\AdmsRead();
        $prevPageMenu->fullRead(
            "SELECT lev_pag.id, lev_pag.order_level_page 
                        FROM adms_levels_pages AS lev_pag
                        INNER JOIN adms_access_levels AS lev ON lev.id=lev_pag.adms_access_level_id
                        LEFT JOIN adms_pages AS pag ON pag.id=lev_pag.adms_page_id 
                        WHERE lev_pag.order_level_page <:order_level_page
                        AND lev_pag.adms_access_level_id =:adms_access_level_id
                        AND (((SELECT permission 
                        FROM adms_levels_pages 
                        WHERE adms_page_id = lev_pag.adms_page_id 
                        AND adms_access_level_id = {$_SESSION['adms_access_level_id']}) = 1) 
                        OR (publish = 1)) 
                        ORDER BY lev_pag.order_level_page DESC
                        LIMIT :limit",
            "order_level_page={$this->resultBd[0]['order_level_page']}&adms_access_level_id={$this->resultBd[0]['adms_access_level_id']}&limit=1"
        );
        var_dump($prevPageMenu);
        $this->resultBdPrev = $prevPageMenu->getResult();
        if ($this->resultBdPrev) {
            $this->editMoveDown();
            $this->result = true;


        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Ítem de menu não encontrado2!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo para alterar a ordem do item do menu superior para ser inferior
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    private function editMoveDown(): void
    {
        $this->data['order_level_page'] = $this->resultBd[0]['order_level_page'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_levels_pages", $this->data, "WHERE id=:id", "id={$this->resultBdPrev[0]['id']}");

        if ($moveDown->getResult()) {
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Ordem do Ítem de menu não editado com sucesso!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo para alterar a ordem do Ítem de menu inferior para ser superior
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    private function editMoveUp(): void
    {
        $this->data['order_level_page'] = $this->resultBdPrev[0]['order_level_page'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $moveUp = new \App\adms\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate("adms_levels_pages", $this->data, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Ordem do Ítem de menu editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Ordem do Ítem de menu não editado com sucesso!</p>";
            $this->result = false;
        }
    }
}
