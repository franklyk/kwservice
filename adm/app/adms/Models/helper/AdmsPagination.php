<?php

namespace App\adms\Models\helper;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}



/**
 * Classe gernérica de paginação
 *
 * @author FRANKLIN <frsbatist@gmail.com>
 */
class AdmsPagination
{
    private int $page;
    private int $limitResult;
    private int $offset;
    private string $query;
    private string|null $parseString;
    private array $resultBd;
    private string|null $result;
    private int $totalPages;
    private int $maxLinks = 2;
    private string $link;
    private string|null $var;

    function getOffset(): int
    {
        return $this->offset;
    }

    function getResult(): string|null
    {
        return $this->result;
    }

    function __construct(string $link, string|null $var = null)
    {
        $this->link = $link;
        $this->var = $var;
        // var_dump($this->link);
    }

    public function condition(int $page, int $limitResult): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->limitResult = (int) $limitResult;
        // var_dump($this->page);
        // var_dump($this->limitResult);
        $this->offset = (int) ($this->page * $this->limitResult) - $this->limitResult;
        // var_dump($this->offset);

    }

    public function pagination(string $query, string|null $parseString = null): void
    {
        $this->query = (string) $query;
        $this->parseString = (string) $parseString;
        // var_dump($this->query);
        // var_dump($this->parseString);
        $count = new \App\adms\Models\helper\AdmsRead();
        $count->fullRead($this->query, $this->parseString);
        $this->resultBd = $count->getResult();
        $this->pageInstrution();
    }

    private function pageInstrution(): void
    {
        // var_dump($this->resultBd[0]['num_result']);
        $this->totalPages = (int) ceil($this->resultBd[0]['num_result'] / $this->limitResult);
        // var_dump($this->totalPages);
        if($this->totalPages >= $this->page){
            $this->layoutPagination();
        }else{
            $_SESSION['msg'] = "<p style= 'color: #640000;'>Erro: Página não encontrada!</p>";
            header("Location: {$this->link}");
        }
    }

    private function layoutPagination(): void
    {
        $this->result = "<ul>";

        $this->result .= "<li><a href='{$this->link}{$this->var}'>Primeira</a></li>";

        for($beforePage = $this->page - $this->maxLinks; $beforePage <= $this->page - 1; $beforePage ++){
            if($beforePage >= 1){
                $this->result .= "<li><a href='{$this->link}/$beforePage{$this->var}'>$beforePage</ax></li>";
            }
        }

        $this->result .= "<li>{$this->page}</li>";

        for($afterPage = $this->page + 1; $afterPage <= $this->page + $this->maxLinks; $afterPage ++){
            if($afterPage <= $this->totalPages){
                $this->result .= "<li><a href='{$this->link}/$afterPage{$this->var}'>$afterPage</ax></li>";
            }

        }

        $this->result .= "<li><a href='{$this->link}/{$this->totalPages}{$this->var}'>Última</a></li>";

        $this->result .= "</ul>";
    }
}
