<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * alterar o nível de acesso no banco de dados
 *
 * @author Franklin
 */
class AdmsOrderTypesPages

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
    public function viewOrdersTypes(int $id): void
    {
        $this->id = $id;

        $viewPrevOrderTypes = new \App\adms\Models\helper\AdmsRead();
        $viewPrevOrderTypes->fullRead("SELECT id, order_type_pg
                        FROM adms_type_pgs                         
                        WHERE id=:id 
                        LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewPrevOrderTypes->getResult();
        if ($this->resultBd) {
            $this->viewPrevOrderTypes();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Grupo de páginas não encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo para recuperar o ordem do nivel de acesso superior
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    private function viewPrevOrderTypes(): void
    {
        $viewPrevOrderTypes = new \App\adms\Models\helper\AdmsRead();
        $viewPrevOrderTypes->fullRead(
            "SELECT id, order_type_pg
                        FROM adms_type_pgs
                        WHERE order_type_pg <:order_type_pg
                        ORDER BY order_type_pg DESC
                        LIMIT :limit",
                        "order_type_pg={$this->resultBd[0]['order_type_pg']}&limit=1"
        );

        $this->resultBdPrev = $viewPrevOrderTypes->getResult();
        if ($this->resultBdPrev) {
            $this->editMoveDown();
            $this->result = true;


        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Ordem do tipo não encontrada!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo para alterar a ordem do nivel de acesso superior para ser inferior
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    private function editMoveDown(): void
    {
        $this->data['order_type_pg'] = $this->resultBd[0]['order_type_pg'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_type_pgs", $this->data, "WHERE id=:id", "id={$this->resultBdPrev[0]['id']}");

        if ($moveDown->getResult()) {
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Ordem do tipo de páginas não editada com sucesso!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo para alterar a ordem do nivel de acesso inferior para ser superior
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    private function editMoveUp(): void
    {
        $this->data['order_type_pg'] = $this->resultBdPrev[0]['order_type_pg'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $moveUp = new \App\adms\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate("adms_type_pgs", $this->data, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Ordem do tipo de páginas editada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Ordem do tipo de páginas não editada com sucesso!</p>";
            $this->result = false;
        }
    }
}
