<?php

namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Controller da página alterar ordem do nívels de acesso
 * @author Franklin
 */
class OrderAccessLevels
{
    /** @var array|string|null $pag Recebe o número da página */
    private array|string|null $pag;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Metodo alterar ordem do nívels de acesso
     * Recebe como parametro o ID que será usado para pesquisar as informações no banco de dados e instancia a MODELS AdmsViewColors
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senão é redirecionado para o listar cores.
     * @return void
     */
    public function index(int|string|null $id = null): void
    {

        $this->pag = filter_input(INPUT_GET, "pag", FILTER_DEFAULT);
        var_dump($this->pag);

        if ((!empty($id))) {
            $this->id = (int) $id;

            $viewAccessLevel = new \App\adms\Models\AdmsOrderAccessLevels();
            $viewAccessLevel->orderAccessLevels($this->id);

            if ($viewAccessLevel->getResult()) {
                $urlRedirect = URLADM . "list-access-levels/index/{$this->pag}";
                header("Location: $urlRedirect");
            } else {
                $urlRedirect = URLADM . "list-access-levels/index/{$this->pag}";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nível de acesso não encontrado 1 !</p>";
            $urlRedirect = URLADM . "list-access-levels/index";
            header("Location: $urlRedirect");
        }
    }

}
