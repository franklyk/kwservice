<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Editar usuários no banco de dados
 *
 * @author Franklin
 */
class AdmsEditSitsPages
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /** @var array|null $listRegistryAdd Recebe os campos com dados que já foram cadastrados com cores*/
    private array|null $listRegistryAdd;

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

    public function viewSitPages(int $id): void
    {
        $this->id = $id;

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead(
            "SELECT id, name, adms_color_id
                            FROM adms_sits_users
                            WHERE id=:id
                            LIMIT :limit",
            "id={$this->id}&limit=1"
        );

        $this->resultBd = $viewUser->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Situação não encontrada!</p>";
            $this->result = false;
        }
    }

    public function update(array $data = null): void
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    private function edit(): void
    {
        $this->data['modified'] = date("Y-m-d H:i:s");
        

        $upSitUser = new \App\adms\Models\helper\AdmsUpdate();
        $upSitUser->exeUpdate("adms_sits_pages", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upSitUser->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Situação de página editada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Situação de página não editada com sucesso!</p>";
            $this->result = false;
        }
    }



    public function listSelect(): array
    {

        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_col, name name_col FROM adms_color ORDER BY name ASC");
        $registry['col'] = $list->getResult();

        $this->listRegistryAdd = ['col' => $registry['col']];

        return $this->listRegistryAdd;
    }

}