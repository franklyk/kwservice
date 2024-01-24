<?php

namespace App\adms\Controllers;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Controller da página Alterar Ordem do ítem do menu
 * @author Franklin
 */
class OrderPageMenu
{
    //** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|string|null $level Recebe o nivel de acesso */
    private int|string|null $level;

    /** @var array|string|null $page Recebe a pagina atual */
    private int|string|null $pag;

    /**
     * Metodo alterar ordem do nívels de acesso
     * Recebe como parametro o ID que será usado para pesquisar as informações no banco de dados e instancia a MODELS AdmsViewColors
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senão é redirecionado para o listar cores.
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        $this->id = (int) $id;

        $this->level = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);

            $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

            if((!empty($this->id)) and (!empty($this->level)) and (!empty($this->pag))){

                $editOrderPageMenu = new \App\adms\Models\AdmsOrderPageMenu();
                $editOrderPageMenu->orderPageMenu($this->id);

                $urlRedirect = URLADM . "list-permission/index/{$this->pag}?level={$this->level}";
                header("Location: $urlRedirect");
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar um ítem de menu!</p><br>";
            
            $urlRedirect = URLADM . "list-permission-levels/index";
            header("Location: $urlRedirect");
        }
    }

}
