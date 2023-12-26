<?php

namespace App\adms\Models;

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
class AdmsListUsers
{
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

    public function listUsers(): void
    {
        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id,
                            sit.name AS name_sit, col.color,
                            FROM adms_users AS usr
                            INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                            INNER JOIN adms_color AS col ON col.id=sit.adms_color_id
                            ORDER BY usr.id DESC");

        $this->resultBd = $listUsers->getResult();

        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style= 'color: #640000;'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
       }

    }
    
}
