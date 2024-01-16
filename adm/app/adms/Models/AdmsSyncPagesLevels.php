<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Sincronizar o nível de acesso e a página
 *
 * @author Franklin
 */
class AdmsSyncPagesLevels
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

    /** @var array|null $resultBdLevels Recebe o valor retornado do banco de dados*/
    private array|null $resultBdLevels;

    /** @var array|null $resultBdPages Recebe o valor retornado do banco de dados*/
    private array|null $resultBdPages;

    /** @var array|null $resultBdLevelPage Recebe o valor retornado do banco de dados*/
    private array|null $resultBdLevelPage;

    /** @var string|null $levelId Recebe o id do nível de acesso */
    private string|null $levelId;

    /** @var string|null $pageId Recebe o id da página*/
    private string|null $pageId;

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

    public function syncPagesLevels(): void
    {

        $listLevel = new \App\adms\Models\helper\AdmsRead();
        $listLevel->fullRead("SELECT id FROM adms_access_levels");

        $this->resultBdLevels = $listLevel->getResult();
        if ($this->resultBdLevels) {
            // $this->result = true;
            var_dump($this->resultBdLevels);
            $this->listPages();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Nível de acesso não encontrado!</p>";
            $this->result = false;
        }
    }

    private function listPages(): void
    {

        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT id, publish FROM adms_pages");

        $this->resultBdPages = $listPages->getResult();
        if ($this->resultBdPages) {
            // $this->result = true;
            // var_dump($this->resultBdPages);
            $this->readLevels();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Nenhuma página encontrada!</p>";
            $this->result = false;
        }
    }

    private function readLevels(): void
    {
        foreach($this->resultBdLevels as $level){
            extract($level);
            echo "ID do nível de Acesso nº = $id <br>";
            $this->levelId = $id;
            $this->readPages();
        }
    }

    private function readPages(): void
    {
        foreach($this->resultBdPages as $page){
            extract($page);
            echo "ID da página nº = $id <br>";
            $this->pageId = $id;
            $this->searchLevelPage();
        }
    }

    private function searchLevelPage(): void
    {

        $listLevelPage = new \App\adms\Models\helper\AdmsRead();
        $listLevelPage->fullRead("SELECT id, publish 
                                    FROM adms_levels_pages
                                    WHERE adms_access_level_id =:adms_access_level_id 
                                    AND adms_page_id =:adms_page_id", "adms_access_level_id={$this->levelId}&adms_access_level_id={$this->pageId}");

        $this->resultBdLevelPage = $listLevelPage->getResult();
        if ($this->resultBdLevelPage) {
            // $this->result = true;
            // var_dump($this->resultBdPages);
            // $this->readLevels();
            echo "O nível de acesso tem cadastro para a página {$this->pageId}<br>";
        } else {
            echo "O nível de acesso não tem cadastro para a página {$this->pageId}<br>";

            //$_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Nenhuma página encontrada!</p>";
            $this->result = false;
        }
    }
}
