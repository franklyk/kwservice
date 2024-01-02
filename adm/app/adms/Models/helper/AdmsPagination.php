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
    /** * @var integer Recebe a página atual do usuário */
    private int $page;

    /** * @var integer $limitResult Recebe o limite de registros que retorna do banco de dados*/
    private int $limitResult;

    /** * @var integer $offset Recebe a quantidade de usuários que serão apresentados por página*/
    private int $offset;

    /** * @var string $query Recebe a query de consulta no banco de dados*/
    private string $query;

    /** * @var string|null $parseString Recebe os parametros de conversão para a query*/
    private string|null $parseString;

    /** * @var array Recebe os registros que retornam do banco de dados*/
    private array $resultBd;

    /** * @var string|null Recebe os parametros da paginação*/
    private string|null $result;

    /** * @var integer $totalPages Recebe a quantidade total de páginas*/
    private int $totalPages;

    /** * @var integer $maxLinks Recebe os links que seram usados para a paginação */
    private int $maxLinks = 2;

    /** * @var string $link Recebe o endereço de redirecionamento da página*/
    private string $link;

    /** * @var string|null $var Recebe parâmetros os opcionais para a paginação, não sendo obrigatório*/
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
        $this->result = "<div class='content-pagination'>";

        $this->result .= "<div class='pagination'>";

        $this->result .= "<p>";

        $this->result .= "<a href='{$this->link}{$this->var}'>&laquo</a>";

        for($beforePage = $this->page - $this->maxLinks; $beforePage <= $this->page - 1; $beforePage ++){
            if($beforePage >= 1){
                $this->result .= "<a href='{$this->link}/$beforePage{$this->var}'>$beforePage</a>";
            }
        }

        // $this->result .= "<span class='active'>{$this->page}</span> ";

        for($afterPage = $this->page + 1; $afterPage <= $this->page + $this->maxLinks; $afterPage ++){
            if($afterPage <= $this->totalPages){
                $this->result .= "<a href='{$this->link}/$afterPage{$this->var}'>$afterPage</a> ";
            }

        }

        $this->result .= "<a href='{$this->link}/{$this->totalPages}{$this->var}'>&raquo</a>";


        $this->result .= "</p>";

        $this->result .= "</div>";

        $this->result .= "</div>";
    }
}
