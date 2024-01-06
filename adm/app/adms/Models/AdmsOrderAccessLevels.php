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
class AdmsOrderAccessLevels
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

    /** @var array|null $resultBdPrev Recebe o valor retornado do banco de dados*/
    private array|null $resultBdPrev;

    /** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;

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

    public function orderAccessLevels(int $id): void
    {
        $this->id = $id;

        $viewAccessLevel = new \App\adms\Models\helper\AdmsRead();
        $viewAccessLevel->fullRead(
            "SELECT id, order_level 
                            FROM adms_access_levels
                            WHERE id=:id AND order_level >:order_level
                            LIMIT :limit",
            "id={$this->id}&order_level={$_SESSION['order_level']}&limit=1");

        $this->resultBd = $viewAccessLevel->getResult();
        if ($this->resultBd) {
            var_dump($this->resultBd);
            $this->viewPrevAccessLevel();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Nível de acesso não encontrado!</p>";
            $this->result = false;
        }
    }
    private function viewPrevAccessLevel(): void
    {
        $prevAccessLevel = new \App\adms\Models\helper\AdmsRead();
        $prevAccessLevel->fullRead("SELECT id, order_level
                        FROM adms_access_levels
                        WHERE order_level <:order_level
                        AND order_level >:order_level_user
                        ORDER BY order_level DESC
                        LIMIT :limit", 
                        "order_level={$this->resultBd[0]['order_level']}&order_level_user={$_SESSION['order_level']}&limit=1");

        $this->resultBdPrev = $prevAccessLevel->getResult();
        if($this->resultBdPrev){
            var_dump($this->resultBdPrev);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Nível de acesso não encontrado!</p>";
            $this->result = false;
        }
    }
}
