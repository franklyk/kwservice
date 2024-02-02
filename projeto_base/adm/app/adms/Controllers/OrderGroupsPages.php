<?php

namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Controller da página alterar Ordem do Grupo de Páginas 
 * @author Franklin
 */
class OrderGroupsPages
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

        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);
        var_dump($this->pag);

        if ((!empty($id)) and (!empty($this->pag))) {
            $this->id = (int) $id;
            var_dump($this->id);

            $viewOrdersGroups = new \App\adms\Models\AdmsOrderGroupsPages();
            $viewOrdersGroups->viewOrdersGroups($this->id);

            if ($viewOrdersGroups->getResult()) {
                $urlRedirect = URLADM . "list-groups-pages/index/{$this->pag}";
                header("Location: $urlRedirect");
            } else {
                $urlRedirect = URLADM . "list-groups-pages/index/{$this->pag}";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Grupo de páginas não encontrado!</p>";
            $urlRedirect = URLADM . "list-groups-pages/index";
            header("Location: $urlRedirect");
        }
    }

}
