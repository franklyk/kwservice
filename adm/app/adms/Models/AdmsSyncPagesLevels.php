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

    /** @var array|null $dataLevelPage Recebe as informações que serão salvas no BD*/
    private array|null $dataLevelPage;

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

    /** @var array|null $resultBdLastOrder Recebe o valor retornado do banco de dados*/
    private array|null $resultBdLastOrder;

    /** @var string|null $levelId Recebe o id do nível de acesso */
    private string|null $levelId;

    /** @var string|null $pageId Recebe o id da página*/
    private string|null $pageId;

    /** @var string|null $publish Recebe o tipo de pemissão*/
    private string|null $publish;

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
        // var_dump($this->resultBdLevels);
        if ($this->resultBdLevels) {
            // $this->result = true;
            // var_dump($this->resultBdLevels);
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
            $this->levelId = $id;
            $this->readPages();
        }
    }

    private function readPages(): void
    {
        foreach($this->resultBdPages as $page){
            extract($page);
            $this->pageId = $id;
            $this->publish = $publish;
            $this->searchLevelPage();
        }
    }

    private function searchLevelPage(): void
    {

        $listLevelPage = new \App\adms\Models\helper\AdmsRead();
        $listLevelPage->fullRead("SELECT id 
                                    FROM adms_levels_pages
                                    WHERE adms_access_level_id=:adms_access_level_id  
                                    AND adms_page_id=:adms_page_id", "adms_access_level_id={$this->levelId}&adms_page_id={$this->pageId}");

        $this->resultBdLevelPage = $listLevelPage->getResult();
        if ($this->resultBdLevelPage) {
            // $this->result = true;
            // var_dump($this->resultBdPages);
            // $this->readLevels();
            // echo "O nível de acesso tem cadastro para a página {$this->pageId}<br>";
            $_SESSION['msg'] = "<p class='alert-success'>Todas a permissões já estão sicronizadas!</p>";
            $this->result = true;
        } else {
            //echo "O nível de acesso não tem cadastro para a página {$this->pageId}<br>";

            //$_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Nenhuma página encontrada!</p>";
            // $this->result = false;
            $this->addLevelPermission();
        }
    }

    private function addLevelPermission(): void
    {
        $this->searchLastOrder();
        $this->dataLevelPage['permission'] = (($this->levelId == 1) OR ($this->publish == 1)) ? 1 : 2;
        $this->dataLevelPage['order_level_page'] = $this->resultBdLastOrder[0]['order_level_page'] + 1;
        $this->dataLevelPage['adms_access_level_id'] = $this->levelId;
        $this->dataLevelPage['adms_page_id'] = $this->pageId;
        $this->dataLevelPage['created'] = date('Y-m-d H:i:s');

        $addAccessLevel = new \App\adms\Models\helper\AdmsCreate();
        $addAccessLevel->exeCreate("adms_levels_pages", $this->dataLevelPage);

        if($addAccessLevel->getResult()){
            $_SESSION['msg'] = "<p class='alert-success'>Permissões sicronizadas com sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Permissões não sicronizadas com sucesso!</p>";
            $this->result = false;
        }

    }

    private function searchLastOrder(): void
    {
        $searchLastOrder = new \App\adms\Models\helper\AdmsRead();        
        $searchLastOrder->fullRead("SELECT order_level_page, adms_access_level_id 
                                    FROM adms_levels_pages
                                    WHERE adms_access_level_id=:adms_access_level_id
                                    ORDER BY order_level_page DESC
                                    LIMIT :limit", "adms_access_level_id={$this->levelId}&limit=1");

        $this->resultBdLastOrder = $searchLastOrder->getResult();
        if(!$this->resultBdLastOrder){
            $this->resultBdLastOrder[0]['order_level_page'] = 0;
        }
        // var_dump($this->resultBdLastOrder);
    }
}
