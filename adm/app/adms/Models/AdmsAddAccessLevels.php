<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Cadastrar o usuário no banco de dados
 *
 * @author Franklin <frsbatist@gmail.com>
 */
class AdmsAddAccessLevels
{
    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;
    
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultQuery;

    private array $listRegistryAdd;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /** 
     * Recebe os valores do formulário.
     * Instancia o helper "AdmsValEmptyField" para verificar se todos os campos estão preenchidos 
     * Verifica se todos os campos estão preenchidos e instancia o método "valInput" para validar os dados dos campos
     * Retorna FALSE quando algum campo está vazio
     * 
     * @param array $data Recebe as informações do formulário
     * 
     * @return void
     */
    public function create(array $data = null)
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    /** 
     * Cadastrar usuário no banco de dados
     * Retorna TRUE quando cadastrar o usuário com sucesso
     * Retorna FALSE quando não cadastrar o usuário
     * 
     * @return void
     */
    private function add(): void
    {
        if($this->viewLastAccessLevels()){

            $this->data['created'] = date("Y-m-d H:i:s");
    
            $createAccessLevels = new \App\adms\Models\helper\AdmsCreate();
            $createAccessLevels->exeCreate("adms_access_levels", $this->data);
    
            if ($createAccessLevels->getResult()) {
                $_SESSION['msg'] = "<p class='alert-success'>Nível de acesso cadastrado com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nível de acesso não cadastrado com sucesso!</p>";
                $this->result = false;
            }
        }
        
    }


    private function viewLastAccessLevels()
    {
        $viewlastAccessLevels =new \App\adms\Models\helper\AdmsRead();
        $viewlastAccessLevels->fullRead("SELECT order_level FROM adms_access_levels ORDER BY order_level DESC LIMIT 1");
        $this->resultQuery = $viewlastAccessLevels->getResult();
        var_dump($this->resultQuery);
        if($this->resultQuery){
            $this->data['order_level'] = $this->resultQuery[0]['order_level'] + 1;
            return true;
        }
    }

    // public function listSelect(): array
    // {
    //     $list = new \App\adms\Models\helper\AdmsRead();
    //     $list->fullRead("SELECT id AS id_col, name AS name_col FROM adms_color ORDER BY name  ASC");
    //     $registry['col'] = $list->getResult();

    //     $this->listRegistryAdd = ['col' => $registry['col']];

    //     return $this->listRegistryAdd;
    // }
}
