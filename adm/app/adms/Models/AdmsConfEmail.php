<?php

namespace App\adms\Models;

use \App\adms\Models\helper\AdmsConn;
use PDO;

/**
 * Confirmar o cadastro do usuário, alterando a situação no banco de dados
 *
 * @author Franklin (" KLYK ") <frsbatist@gmail.com>
 */
class AdmsConfEmail extends helper\AdmsConn
{
    /** @var string $key Recebe a chave para confirmar o cadastro */
    private string $key;


    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;


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
    public function confEmail(string $key): void
    {
        $this->key = $key;

        if (!empty($this->key)) {

            $viewKeyConfEmail = new \App\adms\Models\helper\AdmsRead();
            $viewKeyConfEmail->fullRead("SELECT id 
            FROM adms_users 
            WHERE conf_email =:conf_email 
            LIMIT :limit", "conf_email={$this->key}&limit=1");
            $this->resultBd = $viewKeyConfEmail->getResult();
            if ($this->resultBd) {
                $this->updateSitUser();
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link inválido!!</p>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link inválido!!</p>";
            $this->result = false;
        }
    }

    private function updateSitUser(): void
    {
        $conf_email = null;
        $adms_sits_user_id = 1;

        $query_activate_user = "UPDATE adms_users SET conf_email =:conf_email, adms_sits_user_id =:adms_sits_user_id, modified = NOW() WHERE id=:id LIMIT 1";

        $activate_email = $this->connectDB()->prepare($query_activate_user);
        $activate_email->bindParam(':conf_email', $conf_email);
        $activate_email->bindParam(':adms_sits_user_id', $adms_sits_user_id);
        $activate_email->bindParam(':id', $this->resultBd[0]['id']);
        $activate_email->execute();

        if ($activate_email->rowCount()) {
            $_SESSION['msg'] = "<p style='color: #0f0;'>E-mail ativado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link inválido!!</p>";
            $this->result = false;
        }
    }
}
