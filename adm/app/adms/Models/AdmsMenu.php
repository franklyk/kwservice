<?php

namespace App\adms\Models;

use App\adms\Controllers\ListMenu;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Listar os usuários do banco de dados
 *
 * @author Franklin
 */
class AdmsMenu
{
    private $data;
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBD Recebe os valores retornados do banco de dados*/
    private array|null $resultBd;
   
    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }
    
    /**
     * Retorna os registros vindos do banco de dados
     *
     * @return array|null
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    
    public function listMenu($data): void
    {
        $this->data = $data;

        if(isset($_SESSION['user_id'])){
            $_SESSION['logado'] = "teste";

            $this->data = $_SESSION['logado'];
        }
    }
    
}
