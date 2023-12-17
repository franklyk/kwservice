<?php

namespace App\adms\Models;

/**
 * Apagar o usuário no banco de dados
 *
 * @author Franklin
 */
class AdmsDeleteUsers
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var string $delDirectory Recebe o endereço para excluir o diretório */
    private string $delDirectory;
    
    /** @var string $delImg Recebe o endereço para excluir a imagem */
    private string $delImg;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    public function deleteUser(int $id): void
    {
        $this->id = $id;

        $this->deleteImg();

        if($this->viewUser()){
            $deleteUser = new \App\adms\Models\helper\AdmsDelete();
            $deleteUser->exeDelete("adms_users", "WHERE id=:id", "id={$this->id}");
    
            if($deleteUser->getResult()){
            $_SESSION['msg'] = "<p style='color:#0f0;'>Usuário apagado com sucesso!</p><br>";
            $this->result = true;
            }else{
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não apagado com sucesso!</p><br>";
            $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    
        $urlRedirect = URLADM . "list-users/index";
        header("Location: $urlRedirect");

    }
    private function viewUser(): bool
    {

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT id,image
                                                    FROM adms_users 
                                                    WHERE id=:id 
                                                    LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewUser->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro 006: Usuário não encontrado!</p>";
            return false;
        }
    }

    private function deleteImg(): void
    {
        if((!empty($this->resultBd[0]['image'])) or ($this->resultBd[0]['image'] != null)){
            $this->delDirectory = "app/adms/assets/images/users/" . $this->resultBd[0]['id'] . "/";
            $this->delImg = $this->delDirectory . "/" . $this->resultBd[0]['image'];

            if(file_exists($this->delImg)){
                unlink($this->delImg);
            }

            if(file_exists($this->delDirectory)){
                rmdir($this->delDirectory);
            }
        }
    }
}