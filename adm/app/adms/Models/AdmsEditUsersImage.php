<?php

namespace App\adms\Models;

/**
 * Editar a imagem do usuário no banco de dados
 *
 * @author Franklin
 */
class AdmsEditUsersImage
{
    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;
    
    /** @var array|null $dataImage Recebe os dados da imagem */
    private array|null $dataImage;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

    /** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;
    
    /** @var string $delImg Recebe o endereço da imagem que deve ser excluida */
    private string $delImg;
    
    /** @var string $nameImg Recebe o SLUG/NOME da imagem */
    private string $nameImg;

    /** @var string $directory Recebe o endereço de upload da imagem */
    private string $directory;
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
    

    public function viewUser(int $id): bool
    {
        $this->id = $id;

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT id, image

                                        FROM adms_users
                                        WHERE id=:id 
                                        LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewUser->getResult();
        if ($this->resultBd) {
            $this->result = true;
            return true;
        } else {
            $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro 006: Usuário não encontrado!</p>";
            $this->result = false;
            return false;
        }
    }

    public function update(array $data = null):void
    {
        $this->data = $data;

        $this->dataImage = $this->data['new_image'];
        unset($this->data['new_image']);



        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            if(!empty($this->dataImage['name'])){
                $this->valInput();
            
            }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário selecionar uma imagem!</p>";
            $this->result = false;
            }
            
        } else {
            $this->result = false;
        }
    }
    /**
     * Verificar se existe o usuario com o ID recebido
     * 
     * Retorna false se for houver algum erro
     * 
     *
     * @return void
     */
    private function valInput(): void
    {
        $valExtImg = new \App\adms\Models\helper\AdmsValExtImage();
        $valExtImg->validateExtImg($this->dataImage['type']);
        if(($this->viewUser($this->data['id'])) and ($valExtImg->getResult())){
            $this->result = false;
            $this->upload();

        }else{
            $this->result = false;

        }
    }

    private function upload(): void
    {

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->nameImg = $slugImg->slug($this->dataImage['name']);
        

        $this->directory = "app/adms/assets/images/users/" . $this->data['id'] . "/";

        if((!file_exists($this->directory)) and (!is_dir($this->directory))){
            mkdir($this->directory);
        }

        if(move_uploaded_file($this->dataImage['tmp_name'], $this->directory . $this->nameImg)){
            $this->edit();

        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Upload da imagem não realizado com sucesso!</p>";
            $this->result = false;
        }
    }

    private function edit(): void
    {
        $this->data['image'] = $this->nameImg;
        $this->data['modified'] = date("Y-m-d H:i:s");

        
        $this->result = false;
        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($upUser->getResult()){
            $this->deleteImage(); 
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";
            $this->result = false;
        }
    }

    private function deleteImage(): void
    {
        if(((!empty($this->resultBd[0]['image'])) or ($this->resultBd[0]['image'] != null)) and ($this->resultBd[0]['image'] != $this->nameImg)){
            $this->delImg = "app/adms/assets/images/users/" . $this->data['id'] . "/" .$this->resultBd[0]['image'];
    
            if(file_exists($this->delImg)){
                unlink($this->delImg);
            }
        }
        $_SESSION['msg'] = "<p style='color: green;'>Imagem editada com sucesso!</p>";
        $this->result = true;
    }
}