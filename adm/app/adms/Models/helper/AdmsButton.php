<?php

namespace App\adms\Models\helper;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Classe gernérica para selecionar registro no banco de dados
 *
 * @author FRANKLIN <frsbatist@gmail.com>
 */
class AdmsButton
{

    /** @var array $result Recebe os registros do banco de dados e retorna para a Models */
    private array|null $result;

    /** @var array $data Recebe o array de dados */
    private  array $data;

    /**
     * @return array Retorna o array de dados
     */
    function getResult(): array|null
    {
        return $this->result;
    }

    public function buttonPermission(array|null $data): array|null
    {
        $this->data = $data;
        // var_dump($this->data);

        foreach($this->data as $key => $button ){
            // var_dump($key);
            // var_dump($button);
            extract($button);
            $viewButton = new \App\adms\Models\helper\AdmsRead();
            $viewButton->fullRead("SELECT pag.id 
                                    FROM adms_pages AS pag 
                                    INNER JOIN adms_levels_pages AS lev_pag ON lev_pag.adms_page_id=pag.id
                                    WHERE pag.menu_controller =:menu_controller 
                                    AND pag.menu_metodo =:menu_metodo
                                    AND lev_pag.permission =:permission
                                    AND lev_pag.adms_access_level_id =:adms_access_level_id
                                    LIMIT :limit",
                                    "menu_controller={$menu_controller}&menu_metodo={$menu_metodo}&permission=1&adms_access_level_id={$_SESSION['adms_access_level_id']}&limit=1");
            if($viewButton->getResult()){
                // var_dump($viewButton->getResult());
                $this->result[$key] = true;
            } else{
                $this->result[$key] = false;
            }
        }
        return $this->result;

    }

}
